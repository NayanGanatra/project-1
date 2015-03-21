<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Latestnews extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('chapteradmincp/dblatestnews');
		$this->load->model('chapteradmincp/dbadminheader');
		
		
		if($login=='')
		{
			redirect(base_url().'chapteradmincp/login');
		}
		
	}
	
	public function index()
	{
		$this->view();
	}
	
	public function edit($id)
	{
		$data['get_latestnews'] = $this->dblatestnews->get_latestnews($id);
		
		$this->form_validation->set_rules('latest_news_title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('latest_news_link', 'URL', 'required');
		$this->form_validation->set_rules('latest_news_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
					$data=array(
					'latest_news_title'=>$this->input->post('latest_news_title'),
					'latest_news_link'=>$this->input->post('latest_news_link'),
					'latest_news_tab'=>$this->input->post('latest_news_tab'),
					'latest_news_status'=>$this->input->post('latest_news_status'),
					'latest_news_created_date'=>$this->input->post('latest_news_created_date'),
					'latest_news_created_by'=>$this->input->post('latest_news_created_by'),
					'latest_news_modified_date'=>$this->input->post('latest_news_modified_date'),
					'latest_news_modified_by'=>$this->input->post('latest_news_modified_by')
					
					);
					
					$result=$this->dblatestnews->edit($data,$id);
					
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
					redirect(base_url().'chapteradmincp/latestnews');
				
		}
	
	
		$data['title']="Edit Latest News";
		$this->load->view('chapteradmincp/latestnews/edit',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('latest_news_title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('latest_news_link', 'URL', 'required');
		$this->form_validation->set_rules('latest_news_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
					
			$data=array(
				'latest_news_title'=>$this->input->post('latest_news_title'),
				'latest_news_link'=>$this->input->post('latest_news_link'),
				'latest_news_tab'=>$this->input->post('latest_news_tab'),
				'latest_news_status'=>$this->input->post('latest_news_status'),
				'latest_news_created_date'=>$this->input->post('latest_news_created_date'),
				'latest_news_created_by'=>$this->input->post('latest_news_created_by')
				
				);
				
				$result=$this->dblatestnews->insert($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
				redirect(base_url().'chapteradmincp/latestnews');
			
		}
	
	
		$data['title']="Add Latest News";
		$this->load->view('chapteradmincp/latestnews/add',$data);
	}
	
	public function view()
	{
		$num_rec=$this->dblatestnews->count_latestnews();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'chapteradmincp/latestnews/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] =20;
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
		
		$config['cur_tag_open'] = '<li class="current"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
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
		
		$data['query'] = $this->dblatestnews->get_all_latestnews($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']="Manage Latest News";
		$this->load->view('chapteradmincp/latestnews/view',$data);
		
	}
	
	public function delete($id)
	{
		$result=$this->dblatestnews->delete($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		redirect(base_url().'chapteradmincp/latestnews/view');
	}
	
}
?>