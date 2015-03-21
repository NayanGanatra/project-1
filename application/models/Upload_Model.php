<?php

/**
 * Handle file uploads via XMLHttpRequest
 */
class qqUploadedFileXhr {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);

        if ($realSize != $this->getSize()) {
            return false;
        }

        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);

        return true;
    }

    function getName() {
        return $_GET['qqfile'];
    }

    function getSize() {
        if (isset($_SERVER["CONTENT_LENGTH"])) {
            return (int) $_SERVER["CONTENT_LENGTH"];
        } else {
            throw new Exception('Getting content length is not supported.');
        }
    }

}

/**
 * Handle file uploads via regular form post (uses the $_FILES array)
 */
class qqUploadedFileForm {

    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
    function save($path) {
        if (!move_uploaded_file($_FILES['qqfile']['tmp_name'], $path)) {
            return false;
        }
        return true;
    }

    function getName() {
        return $_FILES['qqfile']['name'];
    }

    function getSize() {
        return $_FILES['qqfile']['size'];
    }

}

class Upload_Model extends CI_Model {

    public $allowedExtensions = array();
    public $sizeLimit;
    private $file;
    public $ftp_path;
    public $temp_path;
    public $user_id;

    function __construct() {

        parent::__construct();
/*        $this->load->config('masterdb_config', TRUE); // lode data base table
        $this->mas_tables = $this->config->item('masterdb_config'); // get masetr table array

        $this->load->library('session');
        $this->load->database();*/
        $this->user_id = $this->session->userdata('profile_id');
        $allowedExtensions = $this->allowedExtensions;
        $sizeLimit = $this->sizeLimit;
        $allowedExtensions = array_map("strtolower", $allowedExtensions);

//        $this->allowedExtensions = $allowedExtensions;
//        $this->sizeLimit = $sizeLimit;

        $this->checkServerSettings();

        if (isset($_GET['qqfile'])) {
            $this->file = new qqUploadedFileXhr();
        } elseif (isset($_FILES['qqfile'])) {
            $this->file = new qqUploadedFileForm();
        } else {
            $this->file = false;
        }
    }

    private function checkServerSettings() {
        $postSize = $this->toBytes(ini_get('post_max_size'));
        $uploadSize = $this->toBytes(ini_get('upload_max_filesize'));

        if ($postSize < $this->sizeLimit || $uploadSize < $this->sizeLimit) {
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            die("{'error':'increase post_max_size and upload_max_filesize to $size'}");
        }
    }

    private function toBytes($str) {
        $val = trim($str);
        $last = strtolower($str[strlen($str) - 1]);
        switch ($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Returns array('success'=>true) or array('error'=>'error message')
     */
    function handleUpload($replaceOldFile = FALSE) {

        $uploadDirectory = $this->temp_path;

        if (!is_writable($uploadDirectory)) {
            return array('error' => "Server error. Upload directory isn't writable.");
        }

        if (!$this->file) {
            return array('error' => 'No files were uploaded.');
        }

        $size = $this->file->getSize();

        if ($size == 0) {
            return array('error' => 'File is empty');
        }

        if ($size > $this->sizeLimit) {
            return array('error' => 'File is too large');
        }

        $pathinfo = pathinfo($this->file->getName());
        //$filename = $pathinfo['filename'];
        $filename = md5($this->user_id) . time();
        $ext = $pathinfo['extension'];

        if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions)) {
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of ' . $these . '.');
        }

        if (!$replaceOldFile) {
            /// don't overwrite previous files that were uploaded
            while (file_exists($uploadDirectory . $filename . '.' . $ext)) {
                $filename .= rand();
            }
        }

        if ($this->file->save($uploadDirectory . $filename . '.' . $ext)) { /// need to upload image ftp
            $this->upload_to_ftp($filename .'.'. $ext);
            return array('success' => true);
        } else {
            return array('error' => 'Could not save uploaded file.' .
                'The upload was cancelled, or server error encountered');
        }
    }

    function upload_to_ftp($file_name) {
        $this->load->library('ftp');

        $config['hostname'] = $this->config->item('media_file_path');
        $config['username'] = $this->config->item('media_username');
        $config['password'] = $this->config->item('media_password');
        $config['port'] = $this->config->item('media_port');
        $config['passive'] = $this->config->item('media_passive');
        $config['debug'] = $this->config->item('media_debug');
        $a = $this->ftp->connect($config);



        if (count($this->ftp->list_files($this->ftp_path . '/' . md5($this->user_id))) == 0) { // check if Client directory exists if not CREATE IT
            $this->ftp->mkdir($this->ftp_path . '/' . md5($this->user_id), DIR_WRITE_MODE);
            $this->ftp->upload($this->temp_path . "/index.html", $this->ftp_path . '/' . md5($this->user_id) . '/index.html', 'auto', 0775);
        }


        $this->ftp->upload($this->temp_path . '/' . $file_name, $this->ftp_path . '/' . md5($this->user_id) . "/" . $file_name, 'auto', 0775);

        unlink($this->temp_path .'/'.$file_name);

        $this->ftp->close();
    }

  

}