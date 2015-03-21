<?php
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('chapteradmincp/dbtemplate');
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
		$data['get_template'] = $this->dbtemplate->get_template($id);
		
		$this->form_validation->set_rules('template_title', $this->lang->line('text_name'), 'required');
		//$this->form_validation->set_rules('template_type', $this->lang->line('text_size'), 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
		$this->form_validation->set_rules('template_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
					$data=array(
					'template_title'=>$this->input->post('template_title'),
					'template_html'=>$this->input->post('html'),
					'template_status'=>$this->input->post('template_status')
					);
					
					$result=$this->dbtemplate->edit($data,$id);
					/*edit*/
					/*$this->dbadminheader->delete_ch_to_template($id);
				
					$chapter = $this->input->post('chapter');
					
					if($chapter)
					{
						for($b=0; $b < count($chapter); $b++)
						{					
							$dataB=array(
							'template_id'=>$id,
							'ch_id'=>$chapter[$b]
							);
							$resultB=$this->dbadminheader->insert_ch_to_template($dataB);
						}
					}*/
					/*edit*/
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
					redirect(base_url().'chapteradmincp/template');
				
		}
	
	
		$data['title']=$this->lang->line('text_edit_template');
		$this->load->view('chapteradmincp/template/edit',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('template_title', $this->lang->line('text_name'), 'required');
		//$this->form_validation->set_rules('template_type', $this->lang->line('text_size'), 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
		$this->form_validation->set_rules('template_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
					$data=array(
					'template_title'=>$this->input->post('template_title'),
					'template_html'=>$this->input->post('html'),
					'template_status'=>$this->input->post('template_status')					
					);
					
					$result=$this->dbtemplate->insert($data);
					/*edit virendra 18-06-13*/
					$inserted_id = $this->db->insert_id();
					
					$chapter = $this->input->post('chapter');
				
					if($chapter)
					{
						for($b=0; $b < count($chapter); $b++)
						{					
							$dataB=array(
							'template_id'=>$inserted_id,
							'ch_id'=>$chapter[$b]
							);
							$resultB=$this->dbadminheader->insert_ch_to_template($dataB);
						}
					}
					/*edit virendra 18-06-13*/
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
					redirect(base_url().'chapteradmincp/template');
				
				// image upload end
		}
	
	
		$data['title']=$this->lang->line('text_add_template');
		$this->load->view('chapteradmincp/template/add',$data);
	}
	
	public function view()
	{
		$num_rec=$this->dbtemplate->count_template();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'chapteradmincp/template/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 50;
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
		
		$data['query'] = $this->dbtemplate->get_all_template($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_manage_template');
		$this->load->view('chapteradmincp/template/view',$data);
		
	}
	
	public function delete($id)
	{
		//$result=$this->dbtemplate->delete($id);
		$this->dbadminheader->delete_ch_to_template($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		redirect(base_url().'chapteradmincp/template/view');
	}
	
}
?>