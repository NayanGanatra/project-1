<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Polls extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbpolls');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
	
		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')
		{
			redirect(base_url().'unathorised');
		}
		$this->load->library('pagination');
	
		
	}
	
/*	public function index()
	{
		$this->view();
	}
	*/
	public function view()
	{
		
		$data['query'] = $this->dbpolls->get_polls_details();
		$data['title']= 'Manage Poll';
		$this->load->view('admincp/polls/view',$data);
		
		
	}

	public function add()
	{
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('polls_question', 'Poll Question', 'required');
		$this->form_validation->set_rules('polls_type', 'Poll Type', 'required');
		//$this->form_validation->set_rules('polls_fields[]', 'Poll Fields', 'required|xss_clean');
		$pfVal = $this->input->post('polls_fields');
		if($pfVal)
		{
			foreach($pfVal as $pf)
		{
			$this->form_validation->set_rules('polls_fields[]', 'Poll Fields', 'required|xss_clean');
		}
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			
			
		}
		else
		{
			$pollQuestion = $this->input->post('polls_question');
			$pollType = $this->input->post('polls_type');
			$pollFields = $this->input->post('polls_fields');
			$pollStatus = $this->input->post('poll_status');
			$displayAs = $this->input->post('poll_display');
			$data=array(
				'poll_question'=>$pollQuestion,
				'poll_type'=>$pollType,
				'poll_status'=>$pollStatus,
				'display'=>$displayAs,
				'user'=>'admin',
				'poll_fields'=>$pollFields
				);	
			$pollId = $this->dbpolls->add_poll($data);
			
			$chapter = $this->input->post('chapter');
			if($chapter)
			{
				for($index=0; $index < count($chapter); $index++)
				{					
					$dataChap=array(
					'poll_id'=>$pollId,
					'ch_id'=>$chapter[$index]
					);
					$resultChap=$this->dbadminheader->insert_ch_to_polls($dataChap);
				}
			}
				
			
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/polls/view');
		}
			$data['title']='Add poll';	
			$this->load->view('admincp/polls/add',$data);
		
		
	}
	
	public function edit($id)
	{
		$data['query'] = $this->dbpolls->get_polls_details_edit($id);
		$data['title']= 'Edit Poll';
		
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('polls_question', 'Poll Question', 'required');
		$this->form_validation->set_rules('polls_type', 'Poll Type', 'required');
		//$this->form_validation->set_rules('polls_fields[]', 'Poll Fields', 'required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$pollQuestion = $this->input->post('polls_question');
			$pollType = $this->input->post('polls_type');
			$pollFields = $this->input->post('polls_fields');
			$pollStatus = $this->input->post('poll_status');
			$pollDisplay = $this->input->post('poll_display');
			$pollData=array(
				'poll_question'=>$pollQuestion,
				'poll_type'=>$pollType,
				'poll_status'=>$pollStatus,
				'poll_display'=>$pollDisplay
				);	
			$this->dbpolls->edit_poll($pollData,$id);
			if($pollFields)
			{
				foreach($pollFields as $pf)
				{	
					if($pf!='')
					{
						$fieldData=array(
						'poll_field_name'=>$pf,
						'poll_id'=>$id
						);
						$this->db->insert('polls_field', $fieldData);	
					}
					
				}
			}
			
			$d = $this->db->delete('chapter_to_polls', array('poll_id' => $id));
			$chapter = $this->input->post('chapter');
			if($chapter)
			{
				for($index=0; $index < count($chapter); $index++)
				{					
					$dataChap=array(
					'poll_id'=>$id,
					'ch_id'=>$chapter[$index]
					);
					$resultChap=$this->dbadminheader->insert_ch_to_polls($dataChap);
				}
			}
				
			
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/polls/view');
		}
	
	
		$data['title']='Edit Poll';
		//var_dump($data['query']);
		$this->load->view('admincp/polls/edit',$data);
	}
	
	public function delete($id)
	{
			
		$result=$this->dbpolls->delete_poll($id);
		$result=$this->dbpolls->delete_fields($id);
		$this->dbadminheader->delete_ch_to_polls($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/polls/view'));
		}
		
	}
	
}
?>