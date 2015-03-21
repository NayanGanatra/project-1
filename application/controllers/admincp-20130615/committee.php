<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Committee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbcommittee');
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
	
	public function view()
	{
		$data['title']= 'Committee';
		$this->load->view('admincp/committee/view',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('cm_mm_id', 'Select Member', 'required');
		$this->form_validation->set_rules('cm_position', 'Position', 'required');
		$this->form_validation->set_rules('cm_year', 'Year', 'required');
		$this->form_validation->set_rules('cm_status', 'Status', 'required');
		$this->form_validation->set_rules('cm_ch_id', 'Chapter', 'required');
		$this->form_validation->set_rules('cm_order', 'Sort Order', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'cm_mm_id'=>$this->input->post('cm_mm_id'),
				'cm_position'=>$this->input->post('cm_position'),
				'cm_year'=>$this->input->post('cm_year'),
				'cm_year2'=>$this->input->post('cm_year2'),
				'cm_status'=>$this->input->post('cm_status'),
				'cm_ch_id'=>$this->input->post('cm_ch_id'),
				'cm_order'=>$this->input->post('cm_order')
				);
				$result=$this->dbcommittee->add_cm($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/committee');
		}
	
		$data['title']='Add Committee Member';
		$this->load->view('admincp/committee/add',$data);
	}
	
	public function edit()
	{
		$id = $this->uri->segment(4);
		$data['get_cm'] = $this->dbcommittee->get_cm($id);
		
		$this->form_validation->set_rules('cm_mm_id', 'Select Member', 'required');
		$this->form_validation->set_rules('cm_position', 'Position', 'required');
		$this->form_validation->set_rules('cm_year', 'Year', 'required');
		$this->form_validation->set_rules('cm_status', 'Status', 'required');
		$this->form_validation->set_rules('cm_ch_id', 'Chapter', 'required');
		$this->form_validation->set_rules('cm_order', 'Sort Order', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{

				$data=array(
				'cm_mm_id'=>$this->input->post('cm_mm_id'),
				'cm_position'=>$this->input->post('cm_position'),
				'cm_year'=>$this->input->post('cm_year'),
				'cm_year2'=>$this->input->post('cm_year2'),
				'cm_status'=>$this->input->post('cm_status'),
				'cm_ch_id'=>$this->input->post('cm_ch_id'),
				'cm_order'=>$this->input->post('cm_order')
				);
				$result=$this->dbcommittee->edit_cm($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/committee');
		}
	
		$data['title']='Edit Committee Member';
		$this->load->view('admincp/committee/edit',$data);
	}
	
	function delete($id)
	{
		$result=$this->dbcommittee->delete_cm($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/committee'));
			}
	}
	
	////////// position
	
	function position()
	{
		$data['query'] = $this->dbcommittee->get_position();
		$data['title']= 'Position';
		$this->load->view('admincp/committee/position',$data);
	}
	
	function edit_position()
	{
		$id = $this->uri->segment(4);
		$data['get_pos'] = $this->dbcommittee->get_pos($id);
		
		$this->form_validation->set_rules('name', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{

				$data=array(
				'name'=>$this->input->post('name')
				);
				$result=$this->dbcommittee->edit_position($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/committee/position');
		}
	
	
		$data['title']= 'Position';
		$this->load->view('admincp/committee/edit_position',$data);
	}
	
	function add_position()
	{
		
		$this->form_validation->set_rules('name', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{

				$data=array(
				'name'=>$this->input->post('name')
				);
				$result=$this->dbcommittee->add_pos($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/committee/position');
		}
	
	
		$data['title']= 'Add New Position';
		$this->load->view('admincp/committee/add_position',$data);
	}
	
	function delete_position($id)
	{
		$result=$this->dbcommittee->delete_pos($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/committee'));
			}
	}
	
}
?>