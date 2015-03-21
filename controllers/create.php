<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbcreate');
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		//$this->load->library('sffacebookphoto');
	}

	function customize()
	{
		$this->index();
	}
	function index()
	{
		$data['assets_cat'] = $this->dbcreate->get_cats();
		$data['title']="Create Cover";
		$this->load->view('create',$data);
		
	}
	
	function createimage($a)
	{
		
		if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
		{
			$imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
			$filteredData=substr($imageData, strpos($imageData, ",")+1);
			$unencodedData=base64_decode($filteredData);
			//echo "unencodedData".$unencodedData;
			$ran_num = rand(10,100000000);
			
			$newfilename = $ran_num.".jpg";

			$fp = fopen($this->config->item('rootfolderpath')."covers-images/download/".$newfilename, "wb");
			fwrite( $fp, $unencodedData);
			fclose( $fp );
			
			$config['image_library'] = 'image_moo';
		
			$this->load->library("image_moo");
		
			$this->image_moo
			->load($this->config->item('rootfolderpath')."covers-images/download/".$newfilename)
			->stretch(420,155)
			->save($this->config->item('rootfolderpath')."covers-images/thumbs/".$newfilename,$overwrite=TRUE);
			
			$data=array(
				'covers_cat_id'=> '0',
				'covers_name'=>$ran_num,
				'covers_seo'=>$ran_num,
				'covers_image'=>$newfilename,
				'create'=>date('Y-m-d')
				);
			$result = $this->dbcreate->insert($data);
			$inserted_id = $this->db->insert_id();
			
			
				echo base_url().'oauth/facebook/uploadcover/'.$inserted_id.'/'.$ran_num.'.html';
		}
	}
	
	
}