<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbchapter');
		$this->load->model('dbheader');
	}

	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2) == 'page' || $this->uri->segment(2) == '')
		{
			$this->view_all();
		}
		elseif($this->uri->segment(3) == 'page' || $this->uri->segment(3) == '')
		{
			$this->view();
		}
		elseif($this->uri->segment(3) != 'page' && $this->uri->segment(3) != '')
		{
			$this->details();
		}
		elseif($this->uri->segment(2) == 'page' && $this->uri->segment(2) != '')
		{
			$this->details();
		}
	}
	
	function view()
	{
		$method = $this->uri->segment(2);
		
		$data['chapter'] = $this->dbchapter->chapter($method);
		
		$num_rec = count($this->dbchapter->count_ch_events($data['chapter']->ch_id));
		
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'events/'.$method.'/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
			$config['uri_segment'] = 4;
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
	
			if ($this->uri->segment(4) == "")
			{
				$segment  = 0;
			}
			else
			{
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbchapter->get_all_events($segment,$config['per_page'],$data['chapter']->ch_id);
			
			$this->pagination->initialize($config);
			
			$data['title'] = 'Events';
			$data['sub_title'] = $data['chapter']->ch_name.' Events';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('events',$data);
		
	}
	
	function view_all()
	{
				
		$num_rec = count($this->dbchapter->count_all_events());
		
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'events/page/';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 10;
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
			
			$data['query'] = $this->dbchapter->get_all_all_events($segment,$config['per_page']);
			
			$this->pagination->initialize($config);
			
			$data['title'] = 'National Events';
			$data['sub_title'] = 'Latest Events';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('events',$data);
		
	}
	
	function details()
	{
		$data['chapter'] = $this->dbchapter->chapter($this->uri->segment(2));
		
		$data['query'] = $this->dbchapter->event_byid($this->uri->segment(3));
		
		$data['title'] = $data['query']->event_name;
		$data['sub_title'] = 'Event Date and Time: '.$data['query']->event_date_time;
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('event_details',$data);
	}
	
}