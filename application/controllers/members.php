<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbmembers');
		$this->load->model('dbheader');
	}
	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2) == "search")
		{
			$this->search();
		}
		elseif($this->uri->segment(2) != "search")
		{
			$this->view();
		}
	}
	
	function view()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Member Directory');
			
			redirect(base_url('user/login.html'));
		}
			$num_rec = count($this->dbmembers->count_all_members());
		
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'members/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 30;
			$config['uri_segment'] = 3;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
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
			
			$data['query'] = $this->dbmembers->get_all_members($segment,$config['per_page']);
			
			$this->pagination->initialize($config);
			
			$data['title'] = 'Directory';
			$data['sub_title'] = 'Member Directory';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('members',$data);

	}
	
	function search()
	{
			$keyword = $this->input->get('keywords');
			$num_rec = count($this->dbmembers->count_search_members($keyword));
		
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'members/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 100;
			$config['uri_segment'] = 3;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
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
			
			$data['query'] = $this->dbmembers->get_search_members($segment,$config['per_page'],$keyword);
			
			$this->pagination->initialize($config);
			
			$data['title'] = 'Directory';
			$data['sub_title'] = 'Member Directory';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('members',$data);

	}

}