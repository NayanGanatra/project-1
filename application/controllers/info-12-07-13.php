<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbinfo');
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
	}

	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(3))
		{
			$this->view();
		}
		elseif($this->uri->segment(2))
		{
			$this->view();
		}
		else
		{
		redirect('/');
		}
	}
	
	function view()
	{
		if($this->uri->segment(3) !='')
		{
			$data['query'] = $this->dbinfo->getpage($this->uri->segment(3));
			
			$data['chapter'] = $this->dbheader->get_chapter_by_seo($this->uri->segment(2));
		}
		else
		{
			$data['query'] = $this->dbinfo->getpage($this->uri->segment(2));
			$data['chapter'] ='';
		}
		
		if($data['query'])
		{
		$data['sub_title']=$data['query']->sub_title;
		$data['title']=$data['query']->page_title;
		$this->load->view('info',$data);
		}
		else
		{
		redirect(base_url());
		}
		
	}
	
}