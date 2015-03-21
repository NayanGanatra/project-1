<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		$this->load->model('dbratings', 'ratings');
	}
	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2))
		{
			$this->page($this->uri->segment(2));
		}
		else
		{
			$this->page();
		}
	}
	
	function page($id='')
	{

		$num_rec=$this->dbheader->count_all_covers();
		
		if($num_rec)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 2;
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
	
			if ($this->uri->segment(2) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(2)))
				{
					$segment = ($this->uri->segment(2)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbheader->get_all_covers($segment,$config['per_page']);
			
			$this->pagination->initialize($config);

		}
		else
		{
			if($this->uri->segment(2))
			{
			redirect(base_url());
			}
			else
			{
			$data['query'] ="";
			}
		}
		
		$data['title']="";
		$this->load->view('home',$data);
	}
	
	
}