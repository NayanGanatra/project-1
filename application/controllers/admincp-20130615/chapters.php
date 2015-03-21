<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chapters extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbchapters');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
	}
	
	public function index()
	{
		$this->view();
	}
	
	public function edit($id)
	{
		$data['get_page'] = $this->dbchapters->get_item($id);
		
		$this->form_validation->set_rules('ch_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_rules('ch_desc', 'Description', 'required');
		$this->form_validation->set_rules('ch_seo', $this->lang->line('text_slug'), 'trim|required|callback_checkseoedit');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'ch_name'=>$this->input->post('ch_name'),
				'ch_desc'=>$this->input->post('ch_desc'),
				'ch_seo'=>friendlyURL($this->input->post('ch_seo'))
				);
				$result=$this->dbchapters->edit($data,$id);
				
				$this->dbchapters->delete_ch_to_state($id);
				
				$states = $this->input->post('states');
				
				if($states)
				{
					for($b=0; $b < count($states); $b++)
					{					
						$dataB=array(
						'ch_id'=>$id,
						'state_id'=>$states[$b]
						);
						$resultB=$this->dbchapters->insert_ch_to_state($dataB);
					}
				}
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/chapters');
		}
	
	
		$data['title'] = 'Edit Chapter';
		$this->load->view('admincp/chapters/edit',$data);
	}
	
	function checkseoedit($str)
	{
		$query = $this->dbchapters->check_seo_edit(friendlyURL($str),$this->input->post('ch_id'));
		if ($query)
		{
			$this->form_validation->set_message('checkseoedit', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('ch_name', 'Chapter Name', 'required');
		$this->form_validation->set_rules('ch_desc', 'Description', 'required');
		$this->form_validation->set_rules('ch_seo', 'Chapter Seo', 'required|callback_checkseo');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'ch_name'=>$this->input->post('ch_name'),
				'ch_desc'=>$this->input->post('ch_desc'),
				'ch_seo'=>friendlyURL($this->input->post('ch_seo')),
				);
			$result=$this->dbchapters->insert($data);
			
			$inserted_id = $this->db->insert_id();
			
			$states = $this->input->post('states');
				
				if($states)
				{
					for($b=0; $b < count($states); $b++)
					{					
						$dataB=array(
						'ch_id'=>$inserted_id,
						'state_id'=>$states[$b]
						);
						$resultB=$this->dbchapters->insert_ch_to_state($dataB);
					}
				}
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/chapters');
		}
	
	
		$data['title']= 'Add Chapter';
		$this->load->view('admincp/chapters/add',$data);
	}
	
	function checkseo($str)
	{
		$query = $this->dbchapters->check_seo(friendlyURL($str));
		if ($query)
		{
			$this->form_validation->set_message('checkseo', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function view()
	{
		$num_rec=$this->dbchapters->count_data();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/chapters/view/';
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
		
		$data['query'] = $this->dbchapters->get_all_data($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']='Chapters';
		$this->load->view('admincp/chapters/view',$data);
		
	}
	
	public function delete($id)
	{
		$result=$this->dbchapters->delete($id);
		
		$this->dbchapters->delete_ch_to_state($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/chapters/view'));
			}
	}
	
}
?>