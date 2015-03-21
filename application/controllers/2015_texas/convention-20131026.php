<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Convention extends CI_Controller {
function __construct()
	{
		
		parent::__construct(); 
		//echo $this->config->item('convention_db_prefix');
		$this->load->helper(array('form', 'html','string','url'));
		$this->load->model($this->config->item('convention_folder').'dbconvention');
		$this->load->model($this->config->item('convention_folder').'dbconvention_header');
		$this->load->model($this->config->item('convention_folder').'dbconvention_sponsors');
		$this->load->model($this->config->item('convention_folder').'dbconvention_settings');
		
		$this->load->model($this->config->item('convention_folder').'dbconvention_registration');
		$this->load->model($this->config->item('convention_folder').'dbconvention_event_member');
		$this->load->model($this->config->item('convention_folder').'dbconvention_slider');
		
		$this->load->library('fb_connect');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		
	}
	
	function index()
	{
		$this->view();	
	}
	function welcome()
	{
		$this->view();	
	}
	function view()
	{
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['pages'] = $this->dbconvention->getpage();
		$data['title']='Welcome to spcsusa';
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	
	//updated by ketan 20130912
	function registration()
	{
		
		$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_registration'));
		}
		
		$hdnids=$this->input->post('hdnids');
		$menu_ch=$this->input->post('menu_ch');
		$name=$this->input->post('name');
		
		$data['total_name'] = count($name);
		$this->form_validation->set_rules('name[]', 'name', 'required|callback__countusers');
		$this->form_validation->set_rules('rel[]', 'rel', 'required');
		//$this->form_validation->set_rules('age[]', 'age', 'required|numeric');
		$this->form_validation->set_rules('txtzipcode', 'Zipcode', 'required|numeric');
		$this->form_validation->set_rules('txtem_con_number', 'Contact Number', 'required|numeric');
		$this->form_validation->set_rules('txtem_con_name', 'Emergency contact name', 'required|alpha');
		$k=0;
		for($k=0;$k<sizeof($hdnids);$k++)
		{
			if($this->input->post('chkbx'.$hdnids[$k]))
			{
				$this->form_validation->set_rules('age['.$k.']', 'age', 'required|numeric');
				$this->form_validation->set_rules('menu_ch['.$k.']', 'menu_ch', 'required|alpha|max_length[1]');
				
			}
			
		}
		for($l=$k;$l<sizeof($name);$l++)
		{ 
			$this->form_validation->set_rules('age['.$l.']', 'age', 'required|numeric');
				$this->form_validation->set_rules('menu_ch['.$l.']', 'menu_ch', 'required|alpha|max_length[1]');
		}
		
		//$this->form_validation->set_rules('age_grp[]', 'age_grp', 'required');
		//$this->form_validation->set_rules('fees[]', 'fees', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			if($this->uri->segment(5)!='' || $this->uri->segment(5) != NULL)
			{
				$up_id = $this->uri->segment(5);
				
				
				$zipcode=$this->input->post('txtzipcode');
				$con_number=$this->input->post('txtem_con_number');
				$con_name=$this->input->post('txtem_con_name');
				$rel=$this->input->post('rel');
				$age=$this->input->post('age');
				
				$age_grp=$this->input->post('age_grp');
				$fees=$this->input->post('fees');
				
				
				$data=array(
					'mm_id'=>$this->input->post('mm_id'),
					'fm_modified_date'=>$this->input->post('fees_modified_date'),
					'fm_modified_by'=>$this->input->post('fees_modified_by'),
					'fees_st_id'=>$this->input->post('fees_st_id'),
					'fm_zipcode'=>$zipcode,
					'fm_em_con_name'=>$con_name,
					'fm_em_con_num'=>$con_number
					);
					
					$result=$this->dbconvention_registration->edit_member($data,$up_id);
					
					
					$delete=$this->dbconvention_registration->delete_data($up_id); 
				$j = 0;	
				$total = 0;
				$record = 0;
				for($j=0;$j<sizeof($hdnids);$j++)
				{
					
					if($this->input->post('chkbx'.$hdnids[$j]))
					{
						$data=array(
						'fm_id'=>$up_id,
						'fm_rel_mm_id'=>$hdnids[$j],
						'fmg_att_name'=>$name[$j],
						'fmg_mm_rel'=>$rel[$j],
						'fmg_mm_age'=>$age[$j],
						'fmg_menu_choice'=>$menu_ch[$j],
						'fmg_age_grp'=>$age_grp[$j],
						'fmg_fees'=>$fees[$j],
						'status'=>1
						);
						$result=$this->dbconvention_registration->insert_fmg($data);
						$total += $fees[$j];
						$record++;
					}
					
					/*else
					{
						$data=array(
						'fm_id'=>$inserted_id,
						'fm_rel_mm_id'=>$hdnids[$j],
						'fmg_att_name'=>$name[$j],
						'fmg_mm_rel'=>$rel[$j],
						'fmg_mm_age'=>$age[$j],
						'fmg_menu_choice'=>$menu_ch[$j],
						'fmg_age_grp'=>$age_grp[$j],
						'fmg_fees'=>0,
						'status'=>0
						);	
					}*/
					
				}
				
				if($record == 0)
				{
					$hdn_mm_id = $this->input->post('hdn_mm_id');
					$get_pm_id = $this->dbconvention_registration->get_pm_id($hdn_mm_id);
					foreach($get_pm_id as $all_pm_id)
					{
						
						$this->dbconvention_registration->delete_program_participant_registration($all_pm_id->pm_id);
					}
					$this->dbconvention_registration->delete_program_registration($hdn_mm_id);
					$this->dbconvention_registration->delete_medical_registration($hdn_mm_id);
					$this->dbconvention_registration->delete_event_registration($hdn_mm_id);
		
					
					
				}
				
				for($i=$j;$i<sizeof($name);$i++)
				{ 
					
					$data=array(
					'fm_id'=>$up_id,
					'fm_rel_mm_id'=>0,
					'fmg_att_name'=>$name[$i],
					'fmg_mm_rel'=>$rel[$i],
					'fmg_mm_age'=>$age[$i],
					'fmg_menu_choice'=>$menu_ch[$i],
					'fmg_age_grp'=>$age_grp[$i],
					'fmg_fees'=>$fees[$i],
					'status'=>1
					);
					$result=$this->dbconvention_registration->insert_fmg($data);
					$total += $fees[$i];
				}
				
					$updatetotal=array(
					'fm_total_fee'=>$total,
					);
					$result=$this->dbconvention_registration->con_fees_member_edit($updatetotal,$up_id);
					
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Information successfully updated');
				redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));
			}
			else
			{
				
				$name=$this->input->post('name');
				$zipcode=$this->input->post('txtzipcode');
				$con_number=$this->input->post('txtem_con_number');
				$con_name=$this->input->post('txtem_con_name');
				$rel=$this->input->post('rel');
				$age=$this->input->post('age');
				$menu_ch=$this->input->post('menu_ch');
				$age_grp=$this->input->post('age_grp');
				$fees=$this->input->post('fees');
				$hdnids=$this->input->post('hdnids');
				
				$data=array(
					'mm_id'=>$this->input->post('mm_id'),
					'fm_created_date'=>$this->input->post('fees_created_date'),
					'fm_created_by'=>$this->input->post('fees_created_by'),
					'fees_st_id'=>$this->input->post('fees_st_id'),
					'fm_zipcode'=>$zipcode,
					'fm_em_con_name'=>$con_name,
					'fm_em_con_num'=>$con_number
					);
					$result=$this->dbconvention_registration->insert_member($data);
					
					$inserted_id = $this->db->insert_id();
				$j = 0;	
				$total = 0;
				for($j=0;$j<sizeof($hdnids);$j++)
				{
					if($this->input->post('chkbx'.$hdnids[$j]))
					{
						$data=array(
						'fm_id'=>$inserted_id,
						'fm_rel_mm_id'=>$hdnids[$j],
						'fmg_att_name'=>$name[$j],
						'fmg_mm_rel'=>$rel[$j],
						'fmg_mm_age'=>$age[$j],
						'fmg_menu_choice'=>$menu_ch[$j],
						'fmg_age_grp'=>$age_grp[$j],
						'fmg_fees'=>$fees[$j],
						'status'=>1
						);
						$result=$this->dbconvention_registration->insert_fmg($data);
						$total += $fees[$j];
					}
					/*else
					{
						$data=array(
						'fm_id'=>$inserted_id,
						'fm_rel_mm_id'=>$hdnids[$j],
						'fmg_att_name'=>$name[$j],
						'fmg_mm_rel'=>$rel[$j],
						'fmg_mm_age'=>$age[$j],
						'fmg_menu_choice'=>$menu_ch[$j],
						'fmg_age_grp'=>$age_grp[$j],
						'fmg_fees'=>0,
						'status'=>0
						);	
					}*/
					
				}
				for($i=$j;$i<sizeof($name);$i++)
				{ 
					$data=array(
					'fm_id'=>$inserted_id,
					'fm_rel_mm_id'=>0,
					'fmg_att_name'=>$name[$i],
					'fmg_mm_rel'=>$rel[$i],
					'fmg_mm_age'=>$age[$i],
					'fmg_menu_choice'=>$menu_ch[$i],
					'fmg_age_grp'=>$age_grp[$i],
					'fmg_fees'=>$fees[$i],
					'status'=>1
					);
					$result=$this->dbconvention_registration->insert_fmg($data);
					$total += $fees[$i];
				}
					$updatetotal=array(
					'fm_total_fee'=>$total,
					);
					$result=$this->dbconvention_registration->con_fees_member_edit($updatetotal,$inserted_id);
					
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Thanks for registration');
				redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));

			}
			
	
		}
		
		$data['reg_status']=$this->dbconvention_registration->get_user_status();
		
		$data['title']="Registration Form";
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	function registration_bak()
	{
		$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_registration'));
		}
	
		$this->form_validation->set_rules('name[]', 'name', 'required|callback__countusers');
		$this->form_validation->set_rules('rel[]', 'rel', 'required');
		$this->form_validation->set_rules('age[]', 'age', 'required|numeric');
		$this->form_validation->set_rules('txtzipcode', 'Zipcode', 'required|numeric');
		$this->form_validation->set_rules('txtem_con_number', 'Contact Number', 'required|numeric');
		$this->form_validation->set_rules('txtem_con_name', 'Emergency contact name', 'required|alpha');
		$this->form_validation->set_rules('menu_ch[]', 'menu_ch', 'required|alpha|max_length[1]');
		$this->form_validation->set_rules('age_grp[]', 'age_grp', 'required');
		$this->form_validation->set_rules('fees[]', 'fees', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
		
			$name=$this->input->post('name');
			$zipcode=$this->input->post('txtzipcode');
			$con_number=$this->input->post('txtem_con_number');
			$con_name=$this->input->post('txtem_con_name');
			$rel=$this->input->post('rel');
			$age=$this->input->post('age');
			$menu_ch=$this->input->post('menu_ch');
			$age_grp=$this->input->post('age_grp');
			$fees=$this->input->post('fees');
			$hdnids=$this->input->post('hdnids');
			
			$data=array(
				'mm_id'=>$this->input->post('mm_id'),
				'fm_created_date'=>$this->input->post('fees_created_date'),
				'fm_created_by'=>$this->input->post('fees_created_by'),
				'fees_st_id'=>$this->input->post('fees_st_id'),
				'fm_zipcode'=>$zipcode,
				'fm_em_con_name'=>$con_name,
				'fm_em_con_num'=>$con_number
				);
				$result=$this->dbconvention_registration->insert_member($data);
				
				$inserted_id = $this->db->insert_id();
			$j = 0;	
			$total = 0;
			for($j=0;$j<sizeof($hdnids);$j++)
			{
				if($this->input->post('chkbx'.$hdnids[$j]))
				{
					$data=array(
					'fm_id'=>$inserted_id,
					'fm_rel_mm_id'=>$hdnids[$j],
					'fmg_att_name'=>$name[$j],
					'fmg_mm_rel'=>$rel[$j],
					'fmg_mm_age'=>$age[$j],
					'fmg_menu_choice'=>$menu_ch[$j],
					'fmg_age_grp'=>$age_grp[$j],
					'fmg_fees'=>$fees[$j],
					'status'=>1
					);
					$result=$this->dbconvention_registration->insert_fmg($data);
					$total += $fees[$j];
				}
				/*else
				{
					$data=array(
					'fm_id'=>$inserted_id,
					'fm_rel_mm_id'=>$hdnids[$j],
					'fmg_att_name'=>$name[$j],
					'fmg_mm_rel'=>$rel[$j],
					'fmg_mm_age'=>$age[$j],
					'fmg_menu_choice'=>$menu_ch[$j],
					'fmg_age_grp'=>$age_grp[$j],
					'fmg_fees'=>0,
					'status'=>0
					);	
				}*/
				
			}
			for($i=$j;$i<sizeof($name);$i++)
			{ 
				$data=array(
				'fm_id'=>$inserted_id,
				'fm_rel_mm_id'=>0,
				'fmg_att_name'=>$name[$i],
				'fmg_mm_rel'=>$rel[$i],
				'fmg_mm_age'=>$age[$i],
				'fmg_menu_choice'=>$menu_ch[$i],
				'fmg_age_grp'=>$age_grp[$i],
				'fmg_fees'=>$fees[$i],
				'status'=>1
				);
				$result=$this->dbconvention_registration->insert_fmg($data);
				$total += $fees[$i];
			}
				$updatetotal=array(
				'fm_total_fee'=>$total,
				);
				$result=$this->dbconvention_registration->con_fees_member_edit($updatetotal,$inserted_id);
				
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Thanks for registration');
			redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));
		}
		$data['reg_status']=$this->dbconvention_registration->get_user_status();
		$data['title']="Registration Form";
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	function eventmembership()
	{
		$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_event'));
		}
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
			'con_mm_id'=>$this->session->userdata('user_id'),
			'ce_mem_created_date'=>$this->input->post('event_mem_created_date'),
			'ce_mem_created_by'=>$this->input->post('event_mem_created_by')
			);
			
			$result = $this->dbconvention_event_member->add_con_events_member($dataevent);
			$inserted_id = $this->db->insert_id();
			$total = 0;
			for($i=0;$i<count($pcount);$i++)
			{
				$dataGroup=array(
				'ce_id'=>$eventid[$i],
				'cem_id'=>$inserted_id,
				'con_mm_id'=>$this->session->userdata('user_id'),
				'ce_mem_num_participant'=>$pcount[$i],
				'ce_mem_amount'=>$amount[$i]
				);
				$total += $amount[$i];
				$result=$this->dbconvention_event_member->add_con_events_member_group($dataGroup);
			}
			$dataevent=array(
				'ce_total'=>$total
			);
			$result = $this->dbconvention_event_member->edit_con_events_member($dataevent,$inserted_id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Event member successfully inserted.');
			
			redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));
				
		}
		
		$data['items'] = $this->dbconvention_event_member->get_con_event_detail_by_id();
		
		$data['reg_status']=$this->dbconvention_event_member->get_user_status();
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['title']="Event Membership Form";
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	function _countusers()
	{
       		$name=$this->input->post('name');
			$hdnids=$this->input->post('hdnids');
			$j = 0;
			$l = 0;
			
			for($j=0;$j<sizeof($hdnids);$j++)
			{
				if($this->input->post('chkbx'.$hdnids[$j]))
				{
					$l++;
				}
				
			}
			for($i=$j;$i<sizeof($name);$i++)
			{ 
				$l++;
			}
		if($l==0)
        {
            $this->form_validation->set_message('_countusers','Please select atleast one member');
            return FALSE;
        }
		else
		{
        	return TRUE;
        }
	}
	//update end
	/*prgram*/
	function program()
	{
		
		$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_program'));
		}
		$this->form_validation->set_rules('pm_mm_id', 'Member Name' , 'required');
		 
		$this->form_validation->set_rules('pm_type', 'Type' , 'required|alpha');

		$this->form_validation->set_rules('pm_length', 'Length', 'required');///////////monita////////////

		$this->form_validation->set_rules('pm_desc1', 'Description' , 'required');

		$this->form_validation->set_rules('pm_desc2', 'Description' , 'required');

		$this->form_validation->set_rules('pm_choreo_email', 'Choreographer Email' , 'required|valid_email|xss_clean');
		
		$this->form_validation->set_rules('pm_choreo_phone', 'Phone No' , 'required|numeric');///////////monita////////////
		
		$this->form_validation->set_rules('pm_choreo_name', 'Choreographer Name' , 'required|alpha');
		
		$val = $this->input->post('pm_name');

		if($val)

		{

			foreach($val as $pm_val)

		{

			$this->form_validation->set_rules('pm_name[]', 'participant', 'required|alpha|xss_clean');//update_monita20130927

		}

		}
		
		$val1 = $this->input->post('pm_age');

		if($val1)

		{

			foreach($val as $pm_val1)

		{

			$this->form_validation->set_rules('pm_age[]', 'participant', 'required|numeric|max_length[2]|xss_clean');//update_monita20130927

		}

		}
		
		

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

	
					// image upload end
					//$pm_member = $this->input->post('pm_name');
						
						//$pm_age = $this->input->post('pm_age');
						
						
					

					$data=array(

						'pm_mm_id'=>$this->input->post('pm_mm_id'),

						'pm_type'=>$this->input->post('pm_type'),

						'pm_length'=>$this->input->post('pm_length'),
						
						'pm_ch1'=>$this->input->post('pm_desc1'),
						
						'pm_ch2'=>$this->input->post('pm_desc1'),

						'pm_ch_id'=>$this->input->post('pm_ch_id'),
						
						'pm_choreo_name'=>$this->input->post('pm_choreo_name'),
						
						'pm_choreo_email'=>$this->input->post('pm_choreo_email'),
						
						'pm_choreo_phone'=>$this->input->post('pm_choreo_phone'),
					

						'pm_created_date'=>$this->input->post('pm_created_date'),

						'pm_created_by'=>$this->input->post('pm_created_by'),
						
						

						);

						

						$result=$this->dbconvention->insert_program($data);
						
						$inserted_id = $this->db->insert_id();
						
						$pm_name = $_POST['pm_name'];
						
						$pm_age = $_POST['pm_age'];
						
						for($b=0; $b < count($pm_name); $b++)

							{					

								$dataB=array(

								'pm_id'=>$inserted_id,

								'pm_member_name'=>$pm_name[$b],
								
								'pm_age'=>$pm_age[$b]

								);

								$resultB=$this->dbconvention->insert_pm_to_participant($dataB);

							}
								
								
						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_','Program successfully Inserted');

						redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));


	}
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['reg_status']=$this->dbconvention_registration->get_user_status_for_program();
		$data['query'] = $this->dbconvention->get_all_program_by_user();
		$data['title'] = 'Program Entry Form';
		$data['sub_title'] = "Add Program";
		$data['description'] = "";
		$data['keywords'] = "";
		
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	
	
	public function medical()
	{
		$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_medical'));
		}
		
		$this->form_validation->set_rules('md_mm_id', 'Member Name' , 'required');
		
		$this->form_validation->set_rules('md_name', 'Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_birth_month', 'Month' , 'required');
		
		$this->form_validation->set_rules('md_birth_year', 'Year' , 'required|numeric|max_length[4]|min_length[4]');
		
		$this->form_validation->set_rules('md_sex', 'Sex' , 'required');
		
		$this->form_validation->set_rules('md_address', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone', 'Home Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone', 'Cell Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_name1', 'Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_rel1', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address1', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone1', 'Home Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone1', 'Cell Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state1', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city1', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip1', 'Zip' , 'required|numeric');
		
		
		
		
		
		$this->form_validation->set_rules('md_name2', 'Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address2', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone2', 'Home Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required|numeric');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state2', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city2', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip2', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_dr_name3', 'Name' , 'required|alpha');
		
		//$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_dr_address3', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_dr_phone3', 'Phone' , 'required|numeric');/////////update_monita20130927//////
		
		//$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_dr_state3', 'State' , 'required');
		
		$this->form_validation->set_rules('md_dr_city3', 'City' , 'required');
		
		$this->form_validation->set_rules('md_dr_zip3', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_insurance_cmp_name', 'Company Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_insurance_plc_no', 'Policy Number' , 'required|numeric');
		
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
	
		
		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

	
					// image upload end
					//$pm_member = $this->input->post('pm_name');
						
						//$pm_age = $this->input->post('pm_age');
						
						
					

					$data=array(

						'md_mm_id'=>$this->input->post('md_mm_id'),

						'md_name'=>$this->input->post('md_name'),

						'md_birth_month'=>$this->input->post('md_birth_month'),
						
						'md_birth_year'=>$this->input->post('md_birth_year'),
						
						'md_sex'=>$this->input->post('md_sex'),

						'md_address'=>$this->input->post('md_address'),
						
						'md_home_phone'=>$this->input->post('md_home_phone'),
						
						'md_cellphone'=>$this->input->post('md_cellphone'),
						
						'md_state'=>$this->input->post('md_state'),
						
						'md_city'=>$this->input->post('md_city'),
						
						'md_zip'=>$this->input->post('md_zip'),
						
						
						
						'md_name1'=>$this->input->post('md_name1'),
						
						'md_rel1'=>$this->input->post('md_rel1'),
						
						'md_address1'=>$this->input->post('md_address1'),
						
						'md_home_phone1'=>$this->input->post('md_home_phone1'),
						
						'md_cellphone1'=>$this->input->post('md_cellphone1'),
						
						'md_state1'=>$this->input->post('md_state1'),
						
						'md_city1'=>$this->input->post('md_city1'),
						
						'md_zip1'=>$this->input->post('md_zip1'),
						
						
						
						'md_name2'=>$this->input->post('md_name2'),
						
						'md_rel2'=>$this->input->post('md_rel2'),
						
						'md_address2'=>$this->input->post('md_address2'),
						
						'md_home_phone2'=>$this->input->post('md_home_phone2'),
						
						'md_cellphone2'=>$this->input->post('md_cellphone2'),
						
						'md_state2'=>$this->input->post('md_state2'),
						
						'md_city2'=>$this->input->post('md_city2'),
						
						'md_zip2'=>$this->input->post('md_zip2'),
						
						
						
						
						'md_dr_name3'=>$this->input->post('md_dr_name3'),
						
						'md_dr_address3'=>$this->input->post('md_dr_address3'),
						
						'md_dr_phone3'=>$this->input->post('md_dr_phone3'),
						
						'md_dr_state3'=>$this->input->post('md_dr_state3'),
						
						'md_dr_city3'=>$this->input->post('md_dr_city3'),
						
						'md_dr_zip3'=>$this->input->post('md_dr_zip3'),
						
						
						
						'md_lim_activities'=>$this->input->post('radio'),
						
						'md_allergic'=>$this->input->post('radio1'),
						
						'md_take_med'=>$this->input->post('radio2'),
						
						'md_other_med_info'=>$this->input->post('radio3'),
						
						
						
						
						'md_insurance_cmp_name'=>$this->input->post('md_insurance_cmp_name'),
						
						'md_insurance_plc_no'=>$this->input->post('md_insurance_plc_no'),
						
						
					
						'md_created_date'=>$this->input->post('md_created_date'),

						'md_created_by'=>$this->input->post('md_created_by')
						

						);

						

						$result=$this->dbconvention->insert_medical($data);
						
								
						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_', 'Medical release form successfully Inserted');

						redirect(base_url($this->config->item('convention_folder_with_slash').'convention/welcome.html'.''));
						

	}
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['reg_status']=$this->dbconvention_registration->get_user_status_for_medical();
		$data['query'] = $this->dbconvention->get_all_medical_by_user();
		$data['title']="Medical Release Form";
		
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	
	function get_city($state_id,$city_id='')
	{
		
		$get_cities = $this->dbconvention->cities($state_id);
		
		$html = '<select class="input-xlarge" name="mm_city_id" id="mm_city_id"><option value="">Select City</option>'; 
		foreach($get_cities as $get_cities_row)
		{
			if($city_id ==$get_cities_row->city_id)
			{
				$html .= "<option selected='selected' value='".$get_cities_row->city_id."'>".$get_cities_row->city_name."</option>";
			}
			else
			{
				$html .= "<option value='".$get_cities_row->city_id."'>".$get_cities_row->city_name."</option>";
			}
			
		
		}
		$html .= '</select>';
		echo $html;
	}
	/*program*/
	function detail_page($id)
	{
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='convention';
		$data['page_detail'] = $this->dbconvention->getpage_id($id);
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	function pages($page_seo)
	{
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		
		$data['page_detail'] = $this->dbconvention->getpage_page_seo($page_seo);
		$data['title']=$data['page_detail']->page_title;
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	function convention_welcomepage()
	{   
	    $data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$offset = $_POST['offset'];
        $limit = $_POST['limit'];
		$t=$this->dbconvention->getpages_cnt();
		
		if($offset <= $t->a )
		{
		$test['test'] = $this->dbconvention->getpages_loadmore($offset);
	    $this->load->view($this->config->item('convention_folder').'convention_welcomepage' , $test);	
		}
	}
	function fetch_desc_data($id)
	{
		$d = $this->dbconvention_event_member->ce_age_desc($id);
		echo $d->ce_age_desc;
	}
	/*added by ketan 201309181120*/
	function sponsors()
	{
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['grandsponsors'] = $this->dbconvention_sponsors->get_sponsors_by_category(3);
		$data['goldsponsors'] = $this->dbconvention_sponsors->get_sponsors_by_category(2);
		$data['silversponsors'] = $this->dbconvention_sponsors->get_sponsors_by_category(1);
		$data['generalsponsors'] = $this->dbconvention_sponsors->get_sponsors_by_category(0);
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['pages'] = $this->dbconvention->getpage();
		$data['title']='Sponsors';
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	/*update end*/

	function gallery()
	{   
	
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='convention';
		$data['album']=$this->dbconvention->getalbum();
		$this->load->view($this->config->item('convention_folder').'convention',$data);
		
	}
	
	function convention_gallarypage($id)
	{   
	    $data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='Gallery';
		$data['image']=$this->dbconvention->get_img_gallary($id);
		$data['video']=$this->dbconvention->get_video_gallary($id);
		$this->load->view($this->config->item('convention_folder').'convention',$data);
	}
	
	
	

}