<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('admincp_convention/dbevent_member');
		$this->load->model('admincp_convention/dbadminheader');
		$this->load->model('admincp_convention/dbsettings');
		$this->load->library('email');
		$this->load->library('parser');
		if($login=='')
		{
			redirect(base_url().'admincp_convention/login');
		}
		/*edit*/
		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')
		{
			redirect(base_url().'unathorised');
		}
		/*edit*/
		
	}
	
	public function index()
	{	
		$this->view();
	}
	function view()
	{
		$num_rec=$this->dbevent_member->count_event_member();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp_convention/event_member/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 20;
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
			$segment = $this->uri->segment(4);	
		}
		
		$data['query'] = $this->dbevent_member->get_all_event_member($config['per_page'],$segment);
		$this->pagination->initialize($config);
		
		$data['title'] = 'Event member manage';		
		$this->load->view('admincp_convention/event_member/view',$data);
	}
	function add()
	{
		$this->form_validation->set_rules('txtpcount[]', 'Participant', 'required|numeric');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required|numeric');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$pcount = $this->input->post('txtpcount');
			$amount = $this->input->post('amount');
			$eventid = $this->input->post('eventid');
			
			$dataevent=array(
			'con_mm_id'=>7,
			'ce_mem_created_date'=>$this->input->post('event_mem_created_date'),
			'ce_mem_created_by'=>$this->input->post('event_mem_created_by'),
			'ce_mem_modified_date'=>$this->input->post('event_mem_created_date'),
			'ce_mem_modified_by'=>$this->input->post('event_mem_created_by')
			);
			
			$result = $this->dbevent_member->add_con_events_member($dataevent);
			$inserted_id = $this->db->insert_id();
			
			for($i=0;$i<count($pcount);$i++)
			{
				$dataGroup=array(
				'ce_id'=>$eventid[$i],
				'cem_id'=>$inserted_id,
				'con_mm_id'=>7,
				'ce_mem_num_participant'=>$pcount[$i],
				'ce_mem_amount'=>$amount[$i]
				);
			
				$result=$this->dbevent_member->add_con_events_member_group($dataGroup);
			}
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Event member successfully inserted.');
			
			redirect(base_url().'admincp_convention/event_member');
				
		}
		
		$data['items'] = $this->dbevent_member->get_con_event_detail_by_id();
		$data['title'] = 'Add event member';		
		$this->load->view('admincp_convention/event_member/add',$data);
	}
	function edit($ce_mem_id)
	{
		$this->form_validation->set_rules('txtpcount[]', 'Participant', 'required|numeric');
		$this->form_validation->set_rules('amount[]', 'Amount', 'required|numeric');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$pcount = $this->input->post('txtpcount');
			$amount = $this->input->post('amount');
			$eventid = $this->input->post('eventid');
			$total = 0;
			for($i=0;$i<count($pcount);$i++)
			{
				$dataGroup=array(
				'ce_mem_num_participant'=>$pcount[$i],
				'ce_mem_amount'=>$amount[$i]
				);
				$total += $amount[$i];
				$result=$this->dbevent_member->edit_con_events_member_group($dataGroup,$ce_mem_id,$eventid[$i]);
			}
			$dataevent=array(
			'ce_mem_modified_date'=>$this->input->post('ce_mem_modified_date'),
			'ce_mem_modified_by'=>$this->input->post('ce_mem_modified_by'),
			'ce_total'=>$total
			);
			$result = $this->dbevent_member->edit_con_events_member($dataevent,$ce_mem_id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Event member successfully inserted.');
			
			redirect(base_url().'admincp_convention/event_member');
				
		}
		
		$data['items'] = $this->dbevent_member->get_con_event_detail_by_id();
		$data['title'] = 'Edit event member';
		$data['ce_mem_id'] = $ce_mem_id;
		$this->load->view('admincp_convention/event_member/edit',$data);
	}
	public function delete($ce_mem_id)
	{
		$this->dbevent_member->delete_con_event($ce_mem_id);
		$this->dbevent_member->delete_con_event_group($ce_mem_id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Event member successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp_convention/event_member'));
		}
	}
}
?>