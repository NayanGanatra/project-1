<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbsearch');
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		$this->load->model('dbratings', 'ratings');
	}
	
	function result($keyword)
	{
			$num_rec=$this->dbsearch->count_data($keyword);
		
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'search/result/'.$keyword.'/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = 'Last';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = 'Prev';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="current">';
			$config['cur_tag_close'] = '</li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				$segment = $this->uri->segment(4);	
			}
			
			$data['query'] = $this->dbsearch->get_all_data($keyword,$config['per_page'],$segment);
			
			$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_search_result');
		$this->load->view('search',$data);
	}
	
}