<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisements extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('chapteradmincp/dbadvertisements');
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
		$data['get_ads'] = $this->dbadvertisements->get_ads($id);
		
		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');
		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/temp/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('image'))
				{
					$filename=$this->input->post('old_image');
				}
				else
				{
					$filename=$this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
					->resize(250,125,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/ads/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);	
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
				
					
				}
				
				// image upload end
				
					$data=array(
					'ads_title'=>$this->input->post('ads_title'),
					'ads_type'=>$this->input->post('ads_type'),
					'ads_code'=>$filename,
					'ads_status'=>$this->input->post('ads_status'),
					'ads_link'=>$this->input->post('ads_link')
					);
					$result=$this->dbadvertisements->edit($data,$id);
									
					
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
					redirect(base_url().'chapteradmincp/advertisements');
				
		}
	
	
		$data['title']=$this->lang->line('text_edit_advertisement');
		$this->load->view('chapteradmincp/advertisements/edit',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');
		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
		
		// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/temp/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if ($this->upload->do_upload('image'))
				{
					$filename=$this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
					->resize(250,125,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/ads/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);	
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
				
					$data=array(
					'ads_title'=>$this->input->post('ads_title'),
					'ads_type'=>$this->input->post('ads_type'),
					'ads_code'=>$filename,
					'ads_status'=>$this->input->post('ads_status'),
					'ads_link'=>$this->input->post('ads_link')
					);
					
					$result=$this->dbadvertisements->insert($data);
					
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
					redirect(base_url().'chapteradmincp/advertisements');
				}
				else
				{
					$this->session->set_flashdata('message_type', 'error');
					$this->session->set_flashdata('status_', 'Image not uploaded, please try again');	
					redirect(base_url().'chapteradmincp/advertisements');
				}
				// image upload end
		}
	
	
		$data['title']=$this->lang->line('text_add_advertisement');
		$this->load->view('chapteradmincp/advertisements/add',$data);
	}
	
	public function view()
	{
		$num_rec=$this->dbadvertisements->count_ads();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'chapteradmincp/advertisements/view/';
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
		
		$data['query'] = $this->dbadvertisements->get_all_ads($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_manage_advertisement');
		$this->load->view('chapteradmincp/advertisements/view',$data);
		
	}
	
	public function delete($id)
	{
		//$result=$this->dbadvertisements->delete($id);
		$this->dbadminheader->delete_ch_to_ads($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		redirect(base_url().'chapteradmincp/advertisements/view');
	}
	
}
?>