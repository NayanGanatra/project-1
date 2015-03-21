<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popular extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbheader');
		$this->load->model('dbpopular');
		$this->load->library('fb_connect');
		$this->load->model('dbratings', 'ratings');
	}
	
	public function _remap($method, $params = array())
	{
		$this->page();
	}
	
	function page($id='')
	{

		$num_rec=$this->dbpopular->count_popular_data();
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'popular/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
			$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			
			$config['first_link'] = '&laquo;&laquo;';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close']  = '</li>';
			
			$config['last_link'] = '&raquo;&raquo;';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = '&raquo;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = '&laquo;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close']  = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
	
			if ($this->uri->segment(3) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(3)))
				{
					$segment = ($this->uri->segment(3)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbpopular->get_all_popular_data($segment,$config['per_page']);
			
			$this->pagination->initialize($config);

		}
		$data['title']=$this->lang->line('popular_page_title');
		$this->load->view('popular',$data);
	}
	
	
}