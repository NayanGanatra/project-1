<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('admincp_convention/dbevents');
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
	
	public function destroy()
	{
		//$this->session->unset_userdata('mm_type');
		$this->session->unset_userdata('search');
		//header("location: ".base_url()."admincp/user/view");
		redirect(base_url()."admincp_convention/events/view");
	}
	function view()
	{
		
		if($this->uri->segment(4))
		{
			
			$search_key = $this->uri->segment(4);
			//$mm_type = $this->uri->segment(5);
		}
		else
		{
			$search_key = 0;
			//$mm_type = 0;
		}
		
		if(isset($_POST['search']))
		{
		$search_key = $_POST['search'];
		$this->session->set_userdata('search',$search_key);
		}
		
		if($search_key == '0')
		{
			$search_key = "";
			$num_rec=$this->dbevents->count_events($search_key);
		}
		else
		{
			$num_rec=$this->dbevents->count_events($search_key);
		}
		$data['tot_rec'] = $num_rec;
		
		$this->load->library('pagination');
		//$config['base_url'] = base_url().'admincp_convention/events/view/';
		
		if($search_key == "")
		{
			$search_key = 0;
			$config['base_url'] = base_url().'admincp_convention/events/view/'.$search_key.'/';
		}
		else
		{
			$config['base_url'] = base_url().'admincp_convention/events/view/'.$search_key.'/';
		}
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 20;
		$config['uri_segment'] = 5;
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

		if ($this->uri->segment(5) == "")
		{
			$segment  = 0;
		}
		else
		{
			$segment = $this->uri->segment(5);	
		}
		
		//$data['query'] = $this->dbevents->get_all_events($config['per_page'],$segment);
		
		if($search_key == '0')
		{
			$search_key = "";
			$data['query'] = $this->dbevents->get_all_events($search_key,$config['per_page'],$segment);
		}
		else
		{
			$data['query'] = $this->dbevents->get_all_events($search_key,$config['per_page'],$segment);
		}
		$this->pagination->initialize($config);
		$data['title'] = 'Event';		
		$this->load->view('admincp_convention/events/view',$data);
	}
	function add()
	{
		$this->form_validation->set_rules('activity', 'Activity', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('fromage', 'Start age', 'required|numeric|callback__countusers');
		$this->form_validation->set_rules('toage', 'End age', 'required|numeric');
		$this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'ce_activity'=>$this->input->post('activity'),
				'ce_age_desc'=>$this->input->post('description'),
				'ce_start_age'=>$this->input->post('fromage'),
				'ce_end_age'=>$this->input->post('toage'),
				'ce_age_fee'=>$this->input->post('cost'),
				'ce_created_date'=>$this->input->post('ce_created_date'),
				'ce_created_by'=>$this->input->post('ce_created_by'),
				'ce_modified_date'=>$this->input->post('ce_created_date'),
				'ce_modified_by'=>$this->input->post('ce_created_by')
				);
				$result=$this->dbevents->add($data);
				$inserted_id = $this->db->insert_id();
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Event successfully inserted.');
				redirect(base_url().'admincp_convention/events');
		}
		$data['title'] = 'Add Event';		
		$this->load->view('admincp_convention/events/add',$data);
	}
	function _countusers()
	{
       	$fromage=$this->input->post('fromage');
		$toage=$this->input->post('toage');
		if($fromage>=$toage)
        {
            $this->form_validation->set_message('_countusers','you can not set start age greater than an end age.');
            return FALSE;
        }
		else
		{
        	return TRUE;
        }
	}
	function edit($id)
	{
		$data['item'] = $this->dbevents->get_event_by_id($id);
		if(!$data['item']){redirect(base_url().'admincp_convention/events');}
		$this->form_validation->set_rules('activity', 'Activity', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('fromage', 'Start age', 'required|numeric|callback__countusers');
		$this->form_validation->set_rules('toage', 'End age', 'required|numeric');
		$this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
		
			$data=array(
			'ce_activity'=>$this->input->post('activity'),
			'ce_age_desc'=>$this->input->post('description'),
			'ce_start_age'=>$this->input->post('fromage'),
			'ce_end_age'=>$this->input->post('toage'),
			'ce_age_fee'=>$this->input->post('cost'),
			'ce_modified_date'=>$this->input->post('ce_modified_date'),
			'ce_modified_by'=>$this->input->post('ce_modified_by')
			);
			
			$result=$this->dbevents->edit($data,$id);
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Forum successfully updated.');
			
			redirect(base_url().'admincp_convention/events');
		}
		$data['title'] = 'Edit Event';		
		$this->load->view('admincp_convention/events/edit',$data);
	}
	public function delete($id)
	{
		$this->dbevents->delete($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Event successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp_convention/events'));
		}
	}
	
	function ExportToCSV($content,$filename = '', $filedArr = '',$countprograms,$heading,$ce_mem_created_by,$ce_mem_num_participant,$ce_mem_amount,$ce_total,$ce_id1,$ce_id2)
	{
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	$filename =''.$filename;
	date_default_timezone_set("Asia/Kolkata");
	$string= "";
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		//$fp = fopen($filename, 'w');
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.="<tr><td colspan='6' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='8' align='left'>";
				$string.="<font size=4><b>$countprograms</b></font>";
				$string.="</td></tr>";
				for($i=0;$i<count($content);$i++)
				{
					$string.= "<tr>";
				
					$string.= "</tr>";
					$string.= "<tr>";
					$field = array();
					foreach($filedArr as $filed)
					{
						$string.= "<th width='auto' bordercolor='#d0d7e5'>$filed</th>";
					}
					$string.= "</tr>";
					$string.= "<tr>";
					foreach($content[$i] as $line)
					{
						$string.= "<td bordercolor='#d0d7e5'><center>$line</center></td>";
						
					}
					$string.= "</tr>";
					$string.= "<tr>";
					
					$string.= "</tr>";
					
					$string.= "<tr>";
					$string.= "<th colspan='3' width='auto' bordercolor='#d0d7e5'>Username</th>";
					$string.= "<th colspan='3' width='auto' bordercolor='#d0d7e5'>Number of Participant</th>";
					$string.= "<th colspan='2' width='auto' bordercolor='#d0d7e5'>Member Amount</th>";
					$d=0;
					for($k=0;$k<count($ce_mem_created_by);$k++)
					{
						if($ce_id1[$i]==$ce_id2[$k])
						{
						$string.= "<tr>";
						$string.= "<td colspan='3' bordercolor='#d0d7e5'><center>$ce_mem_created_by[$k]</center></td>";
						$string.= "<td colspan='3' bordercolor='#d0d7e5'><center>$ce_mem_num_participant[$k]</center></td>";
						$string.= "<td colspan='2' bordercolor='#d0d7e5'><center>$ce_mem_amount[$k]</center></td>";
						$string.= "</tr>";	
						$d +=$ce_total[$k];
						}
					}
					$string.= "<tr>";
					$string.= "<td  colspan='6' bordercolor='#d0d7e5'><center>total</center></td>";
					$string.= "<td  colspan='2'  bordercolor='#d0d7e5'><center>$d</center></td>";
					$string.= "</tr>";
					
				
				}
				$string.= "</table>";
				
	
		header('Content-Type: application/force-download');  
		header('Content-disposition: attachment; filename="'.$filename.'"');
		header("Pragma:");  
		header("Cache-Control:"); 
		echo $string;
			
	
	}
	
	function event_export_to_excel()
	{
		$search_key = $this->session->userdata('search');
		
		$num_rec=$this->dbevents->count_events($search_key);
		$event_deatails = $this->dbevents->get_event_export_to_excel($search_key);
		
		$filename = 'event_list'.date('Y-m-d').'_'.time().'.xls';
		$heading = 'Event list';
		$countprograms = $num_rec.' Events';
		
		$content = '';
		$num = 0;
		$filedArr =array('Event Name','Start age','End age','Age fee','Created by','Created date','Modified by','Modified date');		
		$content=array();
		$ce_mem_created_by=array();
						$ce_mem_num_participant=array();
									$ce_mem_amount=array();
											$ce_total=array();
											$ce_id1=array();
											$ce_id2=array();
									
		foreach($event_deatails as $all_events)
		{
			
			$event_member = $this->dbevents->get_event_member_export_to_excel($all_events->ce_id);
			
			foreach($event_member as $event_member)
			{
				array_push($ce_mem_created_by,$event_member->ce_mem_created_by);
				array_push($ce_mem_num_participant,$event_member->ce_mem_num_participant);
				array_push($ce_mem_amount,$event_member->ce_mem_amount);
				array_push($ce_total,$event_member->ce_total);
				array_push($ce_id2,$event_member->ce_id);
				
			}
			
			$content[$num]['Activity'] = $all_events->ce_activity;
			$content[$num]['Start age'] = $all_events->ce_start_age;
			
			$content[$num]['End age'] = $all_events->ce_end_age;
			$content[$num]['age fee'] = $all_events->ce_age_fee;
			
			$content[$num]['Created by'] = $all_events->ce_created_by;
			$content[$num]['Created date'] = $all_events->ce_created_date;
			
			$content[$num]['Modified by'] = $all_events->ce_modified_by;
			$content[$num]['Modified date'] = $all_events->ce_modified_date;
			array_push($ce_id1,$all_events->ce_id);
			
			$num++;
			
		}
		
		$this->ExportToCSV($content,$filename,$filedArr,$countprograms,$heading,$ce_mem_created_by,$ce_mem_num_participant,$ce_mem_amount,$ce_total,$ce_id1,$ce_id2);
		
		
	}
}
?>