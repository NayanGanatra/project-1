<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Random extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		$this->load->model('dbratings', 'ratings');
	}
	
	public function _remap($method, $params = array())
	{
		$this->page();
	}
	
	function page($id='')
	{

		$num_rec = '10';
		
		if($num_rec)
		{		
			$data['query'] = $this->dbheader->random($num_rec);	
		}
		else
		{
			redirect(base_url());
		}
		
		$data['title']=$this->lang->line('randome_page_title');
		$this->load->view('random',$data);
	}
	
	
}