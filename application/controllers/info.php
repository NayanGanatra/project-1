<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Info extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbinfo');
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		$this->load->model('dbvendor');/////////////////////monita-20130705//////////////////////////////////////////////////
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
		/////////////////////pradip changes for ads 201307111800
		if($this->uri->segment(1) == "info")
		{
			$data['ads'] = $this->dbheader->get_ads_for_general();
		}
		////////////////////////////end///////////////////////
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
		if($this->uri->segment(1) == "info" && $this->uri->segment(2) == "convention")
		{
			//redirect(base_url('convention/welcome.html'));
			redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'));
		}
		if($data['query'])
		{
		$data['sub_title']=$data['query']->sub_title;
		$data['title']=$data['query']->page_title;
		/////////////////////monita-20130705//////////////////////////////////////////////////
		$data['category']=$this->dbvendor->get_category();
		$data['chapters']=$this->dbvendor->get_chapters(); 
		$data['allcategory']=$this->dbvendor->get_all_category();
		/////////////////////monita-20130705//////////////////////////////////////////////////
		$this->load->view('info',$data);
		}
		else
		{
		redirect(base_url());
		}
		
	}
	
}