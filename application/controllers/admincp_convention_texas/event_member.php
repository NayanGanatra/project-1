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
		$this->load->model('admincp_convention_texas/dbevent_member');
		$this->load->model('admincp_convention_texas/dbadminheader');
		$this->load->model('admincp_convention_texas/dbsettings');
		$this->load->library('email');
		$this->load->library('parser');
		if($login=='')
		{
			redirect(base_url().'admincp_convention_texas/login');
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
		$num_rec=$this->dbevent_member->count_distinct_event_member();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp_convention_texas/event_member/view/';
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
		$this->load->view('admincp_convention_texas/event_member/view',$data);
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
			'ce_mem_created_by'=>$this->input->post('event_mem_created_by')
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
			
			redirect(base_url().'admincp_convention_texas/event_member');
				
		}
		
		$data['items'] = $this->dbevent_member->get_con_event_detail_by_id();
		$data['title'] = 'Add event member';		
		$this->load->view('admincp_convention_texas/event_member/add',$data);
	}
	function edit($ce_mem_id)
	{
		$email = $this->uri->segment(4);
		
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
			/*for($i=0;$i<count($pcount);$i++)
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
			*/
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Event member successfully inserted.');
			
			redirect(base_url().'admincp_convention_texas/event_member');
				
		}
		
		$data['items'] = $this->dbevent_member->get_con_event_detail_by_id1($email);
		$data['title'] = 'Edit event member';
		$data['ce_mem_id'] = $ce_mem_id;
		$this->load->view('admincp_convention_texas/event_member/edit',$data);
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
			redirect(base_url('admincp_convention_texas/event_member'));
		}
	}
	
	function form_export_to_excel()
	{
		
		$num_rec=$this->dbevent_member->count_distinct_event_member();
	
		$reg_deatails = $this->dbevent_member->get_all_event_member();
		
		$filename = 'Event_member_list_'.date('Y-m-d').'_'.time().'.xls';
		$heading = 'Event Member list';
		$countform = $num_rec.' Event members';
		
		$content = '';
		$num = 0;
		$number=1;
		$filedArr =array('No.', 'Username','Email', 'Phone No(H)', 'LM No','State', 'Chapter','Age Group','Activity','Tshirts', 'Number of Participant','Amount','Payment Method','Payment Status');		
		$content=array();
		
		foreach($reg_deatails as $all_form)
		{
			$event_amount = $this->dbevent_member->get_event_amount($all_form->email_id);
			
		   	$chapter = $this->dbevent_member->get_chapter_from_mm_id($event_amount[0]->mm_id);
		   	if($chapter != "" && $chapter != null ){
		   		$lmno = "L M -".$chapter->mm_life_id;
		   		$chapter_name = $chapter->ch_name;
		   	}
		   	else
		   	{
		   		$lmno = '';
		   		$chapter_name = '';
		   	}
		   	
		   	$all_details = $this->dbevent_member->get_con_event_detail_by_id1($all_form->email_id);
		   	
			$temp=0;
			$content[$num]['No.'] = $number;
					
			$content[$num]['Username'] = $event_amount[0]->fm_reg_num;;
			$content[$num]['Email'] = $all_form->email_id;
			$content[$num]['Phone No(H)'] = $event_amount[0]->fm_phoneh;
			$content[$num]['LM No'] = $lmno;
			$content[$num]['State'] = $event_amount[0]->state_name;
			$content[$num]['Chapter'] = $chapter_name;
			
			$content[$num]['Age Group'] = '';
			$content[$num]['Activity'] = '';
			$content[$num]['Tshirts'] = '';
			$content[$num]['Number of Participant'] = '';
			$content[$num]['Amount'] = '$'.$event_amount[0]->event_amount;
			
			if($event_amount[0]->payment_type == "by_check") $p_type = "CHECK"; else $p_type = "PAYPAL";
			if($event_amount[0]->payment_status == 0)
				$p_status = "UNPAID";
			else
				$p_status = "PAID";
			$content[$num]['Payment Method'] = $p_type;
			$content[$num]['Payment Status'] = $p_status;
			
			$num++;
			
			foreach($all_details as $all_detail)
			{
				if ($all_detail->number_of_participant == 0)
					continue;
				$getfromeventid = $this->dbevent_member->get_con_event($all_detail->event_id);
				
				$content[$num]['No.'] = '';
				
				$content[$num]['Username'] = '';
				$content[$num]['Email'] = '';
				$content[$num]['Phone No(H)'] = '';
				$content[$num]['LM No'] = '';
				$content[$num]['State'] = '';
				$content[$num]['Chapter'] = '';
				
				$content[$num]['Age Group'] = $all_detail->age_group;
				$content[$num]['Activity'] = $getfromeventid[0]->ce_activity;
				$content[$num]['Tshirts'] = $all_detail->tshirt_size;
				$content[$num]['Number of Participant'] = $all_detail->number_of_participant;
				$content[$num]['Amount'] = '$'.$getfromeventid[0]->ce_age_fee * $all_detail->number_of_participant;
				
				$content[$num]['Payment Method'] = '';
				$content[$num]['Payment Status'] = '';
				$num++;
			}
			
			$content[$num]['No.'] = '';
			$content[$num]['Username'] = '';
			$content[$num]['Email'] = '';
			$content[$num]['Phone No(H)'] = '';
			$content[$num]['LM No'] = '';
			$content[$num]['State'] = '';
			$content[$num]['Chapter'] = '';
			$content[$num]['Age Group'] = '';
			$content[$num]['Activity'] = '';
			$content[$num]['Tshirts'] = '';
			$content[$num]['Number of Participant'] = '';
			$content[$num]['Amount'] = '';
			$content[$num]['Payment Method'] = '';
			$content[$num]['Payment Status'] = '';
			
		$num++;
		$number++;
			
		}
		
		$this->ExportToCSV($content,$filename,$filedArr,$countform,$heading);
		
		
	}
	function ExportToCSV($content,$filename = '', $filedArr = '',$countprograms,$heading)
	{
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename =''.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	//date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		$fp = fopen($filename, 'w');
		//$fp = fopen('registration_form/'.$filename, 'w');
				
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.="<tr><td colspan='7' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='9' align='left'>";
				$string.="<font size=4><b>$countprograms</b></font>";
				$string.="</td></tr>";
				/*$string.="<tr><td colspan='8' align='left'>";
				$string.="<font size=4><b><center>CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='6' align='left'>";
				$string.="<font size=4><b><center>IN CASE OF EMERGENCY, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='6' align='left'>";
				$string.="<font size=4><b><center>IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='5' align='left'>";
				$string.="<font size=4><b><center>IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='2' align='left'>";
				$string.="<font size=4><b><center>Health Insurance Company</center></b></font>";
				$string.="</td></tr>";
				$string.= "<tr>";*/
				$field = array();
				foreach($filedArr as $filed)
				{
					
					$string.= "<th width='auto' bordercolor='#d0d7e5'>$filed</th>";
					
					
					
				}
				
				
				$string.= "</tr>";
				
				$string.= "<tr>";
				
				for($i=0;$i<count($content);$i++)
				{
					if($content[$i]['No.']=='' && $content[$i]['Age Group'] == '')
					{
						$string.= "<td bgcolor='#fff' colspan='14'></td>";	
						
					}
					else
					{
						foreach($content[$i] as $line)
						{
							$string.= "<td bgcolor='#fff'><center>$line</center></td>";	
						}
					}
					$string.= "</tr>";
				}
				
				
			$string.= "</table>";
			
			header('Content-Type: application/force-download');  
		header('Content-disposition: attachment; filename="'.$filename.'"');
		header("Pragma:");  
		header("Cache-Control:"); 
		echo $string;
		fwrite($fp,$string);	
	
	}
}
?>