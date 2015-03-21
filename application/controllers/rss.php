<?php
class Rss extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();	
		$this->load->helper(array('xml','text'));
		$this->load->model('dbrss');
		$this->load->model('dbheader');
	}
	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2) == 'latest')
		{
			$this->latest();
		}
		else
		{
			$this->catfeed();
		}
	}
	
	public function latest()
	{
		$settings = $this->dbheader->get_setting();
		
		$data['feed_name'] = 'Latest '.$this->lang->line('rss_page_title');
		$data['encoding'] = 'utf-8';
		$data['feed_url'] = base_url().'rss';
		$data['page_description'] = 'Latest '.$this->lang->line('rss_page_description');
		$data['page_language'] = 'en-en';
		$data['creator_email'] = $settings->email;
		$data['query'] = $this->dbrss->GetLatestCovers();  
		header("Content-Type: application/rss+xml");
		if($data['query'])
		{
			$this->load->view('rss', $data);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	public function catfeed()
	{
		$settings = $this->dbheader->get_setting();
		$cat_details = $this->dbrss->get_category($this->uri->segment(2));
		
		$data['feed_name'] = $cat_details->covers_cat_name.' '.$this->lang->line('rss_page_title');
		$data['encoding'] = 'utf-8';
		$data['feed_url'] = base_url().'rss';
		$data['page_description'] = $cat_details->covers_cat_name.' '.$this->lang->line('rss_page_description');
		$data['page_language'] = 'en-en';
		$data['creator_email'] = $settings->email;
		$data['query'] = $this->dbrss->GetLatestCatCovers($this->uri->segment(2));  
		header("Content-Type: application/rss+xml");
		
		if($data['query'])
		{
			$this->load->view('rss', $data);
		}
		else
		{
			redirect(base_url());
		}
	}

}
?>