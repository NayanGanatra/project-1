<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Covers extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbcovers');
		$this->load->model('dbheader');
		$this->load->library('fb_connect');
		$this->load->model('dbratings', 'ratings');
	}

	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2) && $this->uri->segment(3) == '' || $this->uri->segment(3) == 'page')
		{
			$this->view($method);
		}
		elseif($this->uri->segment(3))
		{
			$this->details();
		}
		else
		{
		redirect('/');
		}
	}
	
	function view($method)
	{
		$cat_details=$this->dbcovers->cat_details($method);
		$num_rec=$this->dbcovers->count_cat_data($method);
		
		if($cat_details)
		{
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'covers/'.$method.'/page/';
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
			
			$data['query'] = $this->dbcovers->get_all_cat_data($segment,$config['per_page'],$method);
			
			$this->pagination->initialize($config);
			
			$data['title']=$cat_details->covers_cat_name." ".$this->lang->line('category_headline_prefix');
			$this->load->view('covers',$data);
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
	}
	
	function details()
	{
		$method = $this->uri->segment(3);
		$data['row']=$this->dbcovers->getcover($method);
		
		if($data['row'])
		{
		
			$data['row']->covers_name;
	
			$download_data=array("covers_views" => $data['row']->covers_views+1);
			$update_download=$this->dbheader->update_cover($download_data,$data['row']->covers_id);
			
			$data['query'] = $this->dbheader->get_related(8,$this->uri->segment(2),$this->uri->segment(3));
			
				if($this->uri->segment(2)=='custom')
				   {
					   $data['title']= $this->lang->line('text_your')." ".$this->lang->line('category_headline_prefix');
					}
				   else
				   {
					$data['title']=$data['row']->covers_name." ".$this->lang->line('category_headline_prefix');
				   }
			
			$this->load->view('details',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
}