<?php

class Help extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('session');

	}

	

	function index()

	{

		$file =$this->config->item('rootfolderpath').'pdf_file/SPCSUSA_admincp.pdf';
		// readfile($file);
		$filename = "SPCSUSA_admincp.pdf";
	
		/*if(!$file){ // file does not exist
			die('file not found');
		} else {
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$fname");
			header("Content-Type: application/pdf");
			header("Content-Transfer-Encoding: binary");
		
			readfile($file);
		}*/

//$file = $pdf_file_path;
//$filename = $file_name;

    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $filename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($file));
    header('Accept-Ranges: bytes');

    @readfile($file);
	}

}

?>