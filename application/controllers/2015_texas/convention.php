<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Convention extends CI_Controller {

function __construct()
	{
		parent::__construct(); 
		//echo $this->config->item('convention_db_prefix');
		$this->load->helper(array('form', 'html','string','url'));
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_header');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_sponsors');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_settings');
		
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_registration');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_registrationall');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_event_member');
		$this->load->model($this->config->item('convention_texas_folder').'dbconvention_slider');
		$this->load->model($this->config->item('convention_texas_folder').'captcha_model');
		$this->load->library('fb_connect');
		$this->load->library('email');
		$this->load->library('parser');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('dbheader');
		
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
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	
	//updated by ketan 20130912
	function registration()
	{
		$user_id = $this->uri->segment(5);
		$data['user_id'] = $user_id;
		// if($user_id == "" || $user_id == null)
		// {
			// redirect(base_url('2015/texas/convention/allregistration'));
		// }
		if(0 === strpos($user_id, 'LM'))
		{
			redirect(base_url('2015/texas/convention/allregistration'));
		}
		/*$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_registration'));
		}*/
		
		$hdnids=$this->input->post('hdnids');
		$menu_ch=$this->input->post('menu_ch');
		$name=$this->input->post('name');
		
		$data['total_name'] = count($name);
		/*if($this->uri->segment(5)!='' || $this->uri->segment(5) != NULL)
		{
		$this->form_validation->set_rules('name[]', 'name', 'required');
		}
		else
		{
		$this->form_validation->set_rules('name[]', 'name', 'required|callback__countusers');
		}*/
		$this->form_validation->set_rules('name[]', 'name', 'required');
		$this->form_validation->set_rules('rel[]', 'rel', 'required');
		//$this->form_validation->set_rules('age[]', 'age', 'required|numeric');
		$this->form_validation->set_rules('txtzipcode', 'Zipcode', 'required|numeric');
		if($user_id == "" || $user_id == null){
			$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email|xss_clean|callback_checkemail');
		}
		$this->form_validation->set_rules('txtem_con_number', 'Contact Number', 'required');
		$this->form_validation->set_rules('txtem_life_member', 'Life Membership', 'trim');
		$this->form_validation->set_rules('txtpcount[]', 'Number of Participant', 'trim');
		$this->form_validation->set_rules('mm_state_id', 'State', 'required');
		$this->form_validation->set_rules('mm_city_id', 'City', 'required');
		$this->form_validation->set_rules('txtem_con_name', 'Emergency contact name', 'required');
		$this->form_validation->set_rules('txtphoneh', 'Phoneh', 'required');
		$this->form_validation->set_rules('address', 'address', 'required');

		$this->form_validation->set_rules('tshirt_size[]', 'tshirt_size', 'trim');
		
		$k=0;
		for($k=0;$k<sizeof($hdnids);$k++)
		{
			if($this->input->post('chkbx'.$hdnids[$k]))
			{
				$this->form_validation->set_rules('age['.$k.']', 'age', 'required|numeric');
				//$this->form_validation->set_rules('menu_ch['.$k.']', 'menu_ch', 'required|alpha|max_length[1]');
				
			}
			
		}
		for($l=$k;$l<sizeof($name);$l++)
		{ 
			$this->form_validation->set_rules('age['.$l.']', 'age', 'required|numeric');
				//$this->form_validation->set_rules('menu_ch['.$l.']', 'menu_ch', 'required|alpha|max_length[1]');
		}
		
		//$this->form_validation->set_rules('age_grp[]', 'age_grp', 'required');
		//$this->form_validation->set_rules('fees[]', 'fees', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		$name=$this->input->post('name');
		/*print_r($this->input->post('mm_id'));
		exit;*/
		$data['address'] = $address=$this->input->post('address');
		$data['total_name'] = count($name);
		$data['total_mem_name'] = $this->input->post('name');
		$data['total_mem_rel'] = $this->input->post('rel');
			$data['total_mem_bod'] = $this->input->post('bod');
			$data['total_mem_age'] = $this->input->post('age');
			$data['total_mem_menu'] = $this->input->post('menu_ch');
			$data['total_mem_age_group'] = $this->input->post('age_grp');
			$data['total_mem_age_fee'] = $this->input->post('fees');
			$data['total_mem_age_fee_total'] = $this->input->post('fees_total');
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			

				$name=$this->input->post('name');
				$fname=$this->input->post('fname');
				$lname=$this->input->post('lname');
				$address=$this->input->post('address');
				$city=$this->input->post('hdn_mm_city_id');
				$state=$this->input->post('hdn_mm_state_id');
				$mm_city_name=$this->input->post('mm_city_id');
				$mm_state_name=$this->input->post('mm_state_id');
				$phoneh=$this->input->post('txtphoneh');
				$phonec=$this->input->post('txtphonec');
				$email=$this->input->post('txtemail');
				$zipcode=$this->input->post('txtzipcode');
				$payment_type = $this->input->post('payment');
				$con_number=$this->input->post('txtem_con_number');
				$con_name=$this->input->post('txtem_con_name');
				$rel=$this->input->post('rel');
				$bod=$this->input->post('bod');
				$age=$this->input->post('age');
				$menu_ch=$this->input->post('menu_ch');
				$age_grp=$this->input->post('age_grp');
				$fees=$this->input->post('fees');
				$fees_total=$this->input->post('registrationfeeshidden');
				$r = mt_rand()."";
				$rand = $rand = $fname.'_'.$lname.'_'.$r;
				$hdnids=$this->input->post('hdnids');
				$settings=$this->dbconvention->get_setting();
				$life_member=$this->input->post('txtem_life_member');
				$totalamounthidden=$this->input->post('totalamounthidden');

				$tshirt_size=$this->input->post('tshirt_size');
				$lifemember_fees=$this->input->post('lifememberfeehidden');
				$sponsorfeehidden=$this->input->post('sponsorfeehidden');
				$free_ticket=$this->input->post('free_ticket');
				
				$data=array(
					'mm_id'=>$this->input->post('mm_id'),
					'fm_created_date'=>$this->input->post('fees_created_date'),
					'fm_created_by'=>$this->input->post('fees_created_by'),
					'fees_st_id'=>$this->input->post('fees_st_id'),
					'fm_reg_num'=>$rand,
					'fm_total_fee'=>$fees_total,
					'fm_fname'=>$fname,
					'fm_lname'=>$lname,
					'fm_email'=>$email,
					'fm_address'=>$address,
					'fm_state'=>$state,
					'fm_city'=>$city,
					'fm_phoneh'=>$phoneh,
					'fm_phonec'=>$phonec,
					'fm_zipcode'=>$zipcode,
					'payment_type'=>$payment_type,
					'fm_em_con_name'=>$con_name,
					'fm_em_con_num'=>$con_number,
					'fm_life_member'=>$life_member,
					'event_amount'=>$totalamounthidden,
					'fm_spamount'=>$sponsorfeehidden,
					//'lifemember_amount'=>$lifemember_fees,
					//'sponsor_freeticket_status'=>$free_ticket
						
					);
					
					$mm_id_text = 'L M - <b style=" border-bottom:0px solid #000; padding-bottom:3px;">'.$this->input->post('mm_life_id').'</b>';
						
					$result=$this->dbconvention_registrationall->insert_member($data);
					
					$inserted_id = $this->db->insert_id();
				$j = 0;	
				$total = 0;
				$total = 0;
				$life_member_text = '';
				if($life_member == "1")
				{
					$life_member_text = 'Is Register for Life Member : Yes';
					$total = 250;
				}
				else
				{
					$life_member_text = 'Is Register for Life Member : No';
					$total = 0;
				}
				for($j=0;$j<sizeof($hdnids);$j++)
				{
					if($this->input->post('chkbx'.$hdnids[$j]))
					{
						$data=array(
						'fm_id'=>$inserted_id,
						'fm_rel_mm_id'=>$hdnids[$j],
						'fmg_att_name'=>$name[$j],
						'fmg_mm_rel'=>$rel[$j],
						'fmg_mm_bod'=>$bod[$j],
						'fmg_mm_age'=>$age[$j],
						'fmg_menu_choice'=>$menu_ch[$j],
						'fmg_age_grp'=>$age_grp[$j],
						'fmg_fees'=>$fees[$j],
						'status'=>1
						);
						$result=$this->dbconvention_registrationall->insert_fmg($data);
						$total += $fees[$j];
					}
					
				}
				$amount_event = $this->input->post('amount');
				$age_grp_event = $this->input->post('age-grup-event');
				$activity_id = $this->input->post('eventid');
				$number_of_participant = $this->input->post('txtpcount');
				$tshirt_size = $this->input->post('tshirt_size');
				
				$activity_html = '';
				$activity_fee = 0;
				for($i=0;$i<sizeof($amount_event);$i++)
				{ 
					if($number_of_participant[$i] == 0)
						continue;
					$data_event=array(
					'email_id'=>$email,
					'age_group'=>$age_grp_event[$i],
					'event_id'=>$activity_id[$i],
					'number_of_participant'=>$number_of_participant[$i],
					'amount'=>$amount_event[$i],
					'tshirt_size' =>$tshirt_size[$i]
					);
					$age_group_text = '';
					switch($age_grp_event[$i])
					{
						case '6-11':
							$age_group_text = '6yrs - 11yrs (1st - 5th Grade) - Perot Museum';
							break;
						case '12-17':
							$age_group_text = '12yrs - 17yrs (6th - 12th Grade) - Trinity Forest & Southern cross Ranch';
							break;
						case '18-30':
							$age_group_text = '18yrs - 30yrs(College) - Group Dynamix';
							break;
						case '55-100':
							$age_group_text = '55+yrs(Seniors) - Dallas Ni Mulakat';
							break;
					}
					$activity_html .= '<tr><td width="40%">'.$age_group_text.'</td><td width="20%">'.$number_of_participant[$i].'</td><td width="20%">'.$tshirt_size[$i].'</td><td width="20%">'.$amount_event[$i].'</td></tr>';
					$result=$this->dbconvention_registrationall->insert_event_data($data_event);
					$activity_fee += $amount_event[$i];
				}
				if ($activity_html != '')
					$activity_html = '<table width="100%" border="1" class="add_rm_before" style="" >'.$activity_html.'</table>';
				else 
					$activity_html = '<table width="100%" border="1" class="add_rm_before" style="" ><td colspan="4">No Activities selected</td></table>';
				for($i=$j;$i<sizeof($name);$i++)
				{ 
					$data=array(
					'fm_id'=>$inserted_id,
					'fm_rel_mm_id'=>0,
					'fmg_att_name'=>$name[$i],
					'fmg_mm_rel'=>$rel[$i],
					'fmg_mm_bod'=>$bod[$i],
					'fmg_mm_age'=>$age[$i],
					'fmg_menu_choice'=>$menu_ch[$i],
					'fmg_age_grp'=>$age_grp[$i],
					'fmg_fees'=>$fees[$i],
					'status'=>1
					);
					$result=$this->dbconvention_registrationall->insert_fmg($data);
					$total += $fees[$i];
				}
					$updatetotal=array(
					'fm_total_fee'=>$total,
					);
					$result=$this->dbconvention_registration->con_fees_member_edit($updatetotal,$inserted_id);
					
					if($payment_type == "by_check")
					{
						$update_payment_status=array(
						'payment_status'=>1,
						);
						$result=$this->dbconvention_registrationall->con_fees_member_payment_status($update_payment_status,$inserted_id);
					}
				$mem_html = "";
				$mem_html.= '<table width="100%" border="1" class="add_rm_before" style="" >';
				
               for($j=0;$j<sizeof($hdnids);$j++)
				{
					
					if($this->input->post('chkbx'.$hdnids[$j]))
					{
							
						$mem_html.= '<tr><td width="24%" style="">'.$name[$j].'</td><td width="13%">'.$rel[$j].'</td><td width="12%">'.$bod[$j].'</td><td  width="7%">'.$age[$j].'</td> <td width="15%">'.$menu_ch[$j].'</td><td width="15%">'.$age_grp[$j].'</td><td width="10%">'.$fees[$j].'</td></tr>';	
						
					}
				}
				
				for($i=$j;$i<sizeof($name);$i++)
				{ 
				
					$mem_html.= '<tr><td width="24%" style="">'.$name[$i].'</td><td width="13%">'.$rel[$i].'</td><td width="12%">'.$bod[$i].'</td><td  width="7%">'.$age[$i].'</td> <td width="15%">'.$menu_ch[$i].'</td><td width="15%">'.$age_grp[$i].'</td><td width="10%">'.$fees[$i].'</td></tr>';	
				}
			$mem_html.= '</table>';
			$event_html = "";
			$event_html.= '<table width="100%" border="1" class="add_rm_before" style="" >';
			
			for($i=$j;$i<sizeof($amount_event);$i++)
			{ 
			
				$event_html.= '<tr><td width="24%" style="">'.$age_grp_event[$i].'</td><td width="13%">'.$activity_id[$i].'</td><td width="12%">'.$number_of_participant[$i].'</td><td  width="7%">'.$amount_event[$i].'</td> <td width="15%">'.$tshirt_size[$i].'</td></tr>';	
			}
			$event_html.= '</table>';
            $con_title = $settings->ch_name.' Convention '.$settings->ch_year;   
			
				//$email = $settings->cs_email;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
	
				$this->email->from($settings->cs_email);
				$this->email->to($email);
				//$this->email->to($settings->cs_email);
				
				$this->email->subject('Texas Convention registration registration '.$settings->cs_sitename);
				
				$totalFee = $_POST['fees_total']+$_POST['totalamounthidden'];
				$total_with_paypal = round($totalFee + ($totalFee * 0.022) + 0.30, 2);
				$total_payment_with_paypal_fee_text = '<b style="color:#dd0e78;">Total : $'.$total_with_paypal.'</b> ($'.$_POST['fees_total'].' + $'.$_POST['totalamounthidden'].' + $'.($total_with_paypal - $totalFee).' (2.2% + $0.30 - Paypal Processing Fee))';
				
				$final_message = array('name' => '', 'sitename'=> $settings->cs_sitename, 'user_email' => $email, 'con_hdn_ch_name' => '', 'con_hdn_reg_number' => $rand, 'con_hdn_lm_number' => $mm_id_text, 'con_hdn_last_name' => $lname, 'con_hdn_first_name' => $fname, 'con_hdn_addr' => $address, 'con_hdn_city' => $mm_city_name, 'con_hdn_state' => $mm_state_name, 'con_hdn_phnH' => $phoneh, 'con_hdn_phnC' => $phonec, 'con_hdn_email' => $email, 'zipcode'=> $zipcode, 'con_hdn_payment_method' => $payment_type, 'con_hdn_payment_status' => 'Un-Paid', 'con_em_name' => $con_name, 'con_em_number' => $con_number, 'member' => $mem_html, 'event' => $event_html, 'total_fees' => $total, 'activities' => $activity_html, 'activity_fee' => $activity_fee, 'logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title, 'life_member_text' => $life_member_text, 'total_payment_with_paypal_fee_text' => $total_payment_with_paypal_fee_text);
				
				$this->email->message($this->parser->parse('con_register_parser', $final_message , TRUE));
				
				$this->email->send();
				//echo $this->email->print_debugger();
				
				if($settings->cs_email != "") {
				/*	$config['mailtype'] = 'html';
				$this->email->initialize($config);
	
				$this->email->from($settings->cs_email);
				$this->email->to($settings->cs_email);
				//$this->email->to($settings->cs_email);
				
				$this->email->subject('testconvention registration '.$settings->cs_sitename);
				
				$final_message = array('name' => '', 'sitename'=> $settings->cs_sitename, 'user_email' => $email, 'con_hdn_ch_name' => '', 'con_hdn_reg_number' => $rand, 'con_hdn_lm_number' => '', 'con_hdn_last_name' => $lname, 'con_hdn_first_name' => $fname, 'con_hdn_addr' => $address, 'con_hdn_city' => $mm_city_name, 'con_hdn_state' => $mm_state_name, 'con_hdn_phnH' => $phoneh, 'con_hdn_phnC' => $phonec, 'con_hdn_email' => $email, 'zipcode'=> $zipcode, 'con_hdn_payment_method' => $payment_type, 'con_em_name' => $con_name, 'con_em_number' => $con_number, 'member' => $mem_html, 'total_fees' => $total, 'logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title);
				
				$this->email->message($this->parser->parse('con_register_parser', $final_message , TRUE));
				
				$this->email->send();*/
				}
				
				
				if($payment_type == "by_paypal"){
					redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/process_payment/'.$inserted_id.'.html'));
					
				}
				else {
				$this->session->set_flashdata('message_type', 'success');	
				$this->session->set_flashdata('welcome_status', 'success');
				$p = "";
				if($payment_type == "by_check") $p = "Cheque"; else $p = "Paypal";
				$this->session->set_flashdata('status_', 'You registration completed successfully, 
				<br>Please also find below registration confirmation as well we have sent you registration confirmation in email.
				<br>
					You have selected pay by <b>'.$p.'</b> method.
				<br> 
					Please make your deposit electronically via online Payments system or Cheque payable to "SPCS Convention" and  enclose with this fully complete form mail to:
				<br>
				<p>Bharat Sutaria
				<br>
				3465 Technology Drive
				<br>
				Plano,TX, 75074
				<br>
				Phone:214-440-1234 EXT 101
				<br>
				Cell:214-418-7562
				<br>
				Fax:214-440-1222</p>
				For any question regarding registration, email at  spcs2015reg@gmail.com
				<br>
				Registration will be first come, first serve basis based on limited capacity available.  
				<br>At the door registration is not guaranteed.');
				$this->session->set_flashdata('registration_number',$rand);
				$full_name = $fname." ".$lname;
				
				$t = $totalamounthidden+$fees_total;
				$this->session->set_flashdata('Name',$full_name);
				$this->session->set_flashdata('html',$mem_html);
				$this->session->set_flashdata('life',$life_member);
				$this->session->set_flashdata('amount',$t);
				if($p == "Cheque")
				{
					$this->session->set_flashdata('cheque_instruction','<br>You have selected pay by <b>'.$p.'</b> method.
					<br> 
					Please make your deposit electronically via online Payment system or Cheque payable to &quot;SPCS Convention&quot; and  enclose with this fully complete form mail to:
					<br>
					<p>Bharat Sutaria
					<br>
					Svtronics Inc.
					<br>
					3465 Technology Drive
					<br>
					Plano,TX, 75074
					<br>
					Phone:214-440-1234 EXT 101
					<br>
					Cell:214-418-7562
					<br>
					Fax:214-440-1222</p>
					For any question regarding registration, email at  spcs2015reg@gmail.com');
				}
				else
				{
					$this->session->set_flashdata('cheque_instruction','');
				}
				
				$today = date("d-m-Y"); 
				$this->session->set_flashdata('date_created',$today);
				redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
				}
				

			//}
			
	
		}
		
		$data['reg_status']=$this->dbconvention_registration->get_user_status();
		
		$data['title']="Registration Form";
		$data['items'] = $this->dbconvention_event_member->get_con_event_detail_by_id();
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	
	function search()
	{
		if($this->input->post('search_email') != "" || $this->input->post('search_email') != NULL) {
			$user_id = $this->dbconvention_registration->get_mm_id($this->input->post('search_email'));
			
			$count = count($user_id);
			if($count == 0) {
				redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/allregistration.html'));
			}
			else if($count == 1) {
				redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/registration/'.$user_id->mm_id.'.html'));
			}
			else
			{
				echo "<script type='text/javascript'>alert('Contact Administrator for registration. Duplicate Name Found!')</script>";
			}
		}
		else {
			redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/allregistration.html'));
		}
	
	}
	function ipn_payment()
	{
		
			//$payment_status = $_POST['payment_status'];
			//if($payment_status == "Completed") {
			$custom = $_POST['custom'];
			$custom_exploded = explode('/',$custom);
			$email_id = $custom_exploded[0];
			$reg_num_id = $custom_exploded[1];
			$get_confirm = $this->dbconvention_registrationall->get_confirm($email_id,$reg_num_id);
			$pay_status = 1;
			$transaction_id = $_POST['txn_id'];
			$fm_id = $get_confirm->fm_id;
			$fm_reg_num = $get_confirm->fm_reg_num;
			$fm_fname = $get_confirm->fm_fname;
			$data=array(
				'payment_status'=>$pay_status
			);
			
			$result=$this->dbconvention_registrationall->edit_payment_status($fm_id,$data);
			/*$settings = $this->dbconvention->get_setting();
			$con_title = $settings->ch_name.' Convention '.$settings->ch_year;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($settings->cs_email);
			$this->email->to($get_confirm->fm_email);
			//$this->email->to($settings->cs_email);
			
			$this->email->subject('Texas Convention registration Paypal successfully done '.$settings->cs_sitename);
			
			$final_message = array('logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title, 'con_reg_num' => $fm_reg_num, 'con_first_name' => $fm_fname, 'sitename' => $settings->cs_sitename, 'con_hdn_email' => $get_confirm->fm_email);
			
			$this->email->message($this->parser->parse('con_paypal_confirm', $final_message , TRUE));
			
			$this->email->send();	
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Thanks for registration');
			redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));*/
		//}
	}
	
	function cancel_payment()
	{
		$payment_status = $_POST['payment_status'];
		if($payment_status != "Completed") 
		{
//email modification start				
			$custom = $_POST['custom'];
			$custom_exploded = explode('/',$custom);
			$email_id = $custom_exploded[0];
			$reg_num_id = $custom_exploded[1];
			$get_confirm = $this->dbconvention_registrationall->get_confirm($email_id,$reg_num_id);
			$pay_status = 1;
			$transaction_id = $_POST['txn_id'];
			$fm_id = $get_confirm->fm_id;
			$fm_reg_num = $get_confirm->fm_reg_num;
			$fm_fname = $get_confirm->fm_fname;
			$fm_lname = $get_confirm->fm_lname;
			$fm_life_member = $get_confirm->fm_life_member;
			$fm_total_fee = $get_confirm->fm_total_fee;
			$event_amount = $get_confirm->event_amount;
			$data=array(
				'payment_status'=>$pay_status,
				'transaction_id'=>$transaction_id
				);
			
			$result=$this->dbconvention_registrationall->edit_payment_status($fm_id,$data);
			$settings = $this->dbconvention->get_setting();
			$con_title = $settings->ch_name.' Convention '.$settings->ch_year;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($settings->cs_email);
			$this->email->to($get_confirm->fm_email);
			//$this->email->to($settings->cs_email);
			
			$this->email->subject('Texas Convention registration not done successfully '.$settings->cs_sitename);
			
			$final_message = array('logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title, 'con_reg_num' => $fm_reg_num, 'con_first_name' => $fm_fname, 'sitename' => $settings->cs_sitename, 'con_hdn_email' => $get_confirm->fm_email);
			
			$this->email->message($this->parser->parse('con_paypal_confirm', $final_message , TRUE));
			
			$this->email->send();
//email modification over	
			$this->session->set_flashdata('welcome_status', 'Failed');
				$p = "Paypal";
				$this->session->set_flashdata('status_', 'You registration did not completed successfully, 
				<br>Please try again or call administrator.
				 <br>
				You have selected pay by <b>'.$p.'</b> method.
				<br> 
				Please make your deposit electronically via online Payments system or ');
				
				redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
		}
	}
	function success_payment()
	{
		$payment_status = $_POST['payment_status'];
		if($payment_status == "Completed") 
		{
			$custom = $_POST['custom'];
			$custom_exploded = explode('/',$custom);
			$email_id = $custom_exploded[0];
			$reg_num_id = $custom_exploded[1];
			$get_confirm = $this->dbconvention_registrationall->get_confirm($email_id,$reg_num_id);
			$pay_status = 1;
			$transaction_id = $_POST['txn_id'];
			$fm_id = $get_confirm->fm_id;
			$fm_reg_num = $get_confirm->fm_reg_num;
			$fm_fname = $get_confirm->fm_fname;
			$fm_lname = $get_confirm->fm_lname;
			$fm_life_member = $get_confirm->fm_life_member;
			$fm_total_fee = $get_confirm->fm_total_fee;
			$event_amount = $get_confirm->event_amount;
			$data=array(
				'payment_status'=>$pay_status,
				'transaction_id'=>$transaction_id
				);
			
			$result=$this->dbconvention_registrationall->edit_payment_status($fm_id,$data);
			$settings = $this->dbconvention->get_setting();
			$con_title = $settings->ch_name.' Convention '.$settings->ch_year;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($settings->cs_email);
			$this->email->to($get_confirm->fm_email);
			//$this->email->to($settings->cs_email);
			
			$this->email->subject('Texas Convention registration Paypal successfully done '.$settings->cs_sitename);
			
			$final_message = array('logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title, 'con_reg_num' => $fm_reg_num, 'con_first_name' => $fm_fname, 'sitename' => $settings->cs_sitename, 'con_hdn_email' => $get_confirm->fm_email);
			
			$this->email->message($this->parser->parse('con_paypal_confirm', $final_message , TRUE));
			
			$this->email->send();	
			
			$this->session->set_flashdata('message_type', 'success');
			/*$this->session->set_flashdata('status_', 'Thank You for Registration');*/
			
			
			$this->session->set_flashdata('welcome_status', 'success');
				$p = "Paypal";
				$this->session->set_flashdata('status_', 'You registration completed successfully, 
				<br>Please also find below registration confirmation as well we have sent you registration confirmation in email.
				<br>
					You have selected pay by <b>'.$p.'</b> method.
				<br> 
					Please make your deposit electronically via online Payments system or Cheque payable to "SPCS Convention" and  enclose with this fully complete form mail to:
				<br>
				<p>Bharat Sutaria
				<br>
				3465 Technology Drive
				<br>
				Plano,TX, 75074
				<br>
				Phone:214-440-1234 EXT 101
				<br>
				Cell:214-418-7562
				<br>
				Fax:214-440-1222</p>
				For any question regarding registration, email at  spcs2015reg@gmail.com
				<br>
				Registration will be first come, first serve basis based on limited capacity available.  
				<br>At the door registration is not guaranteed.');
			$this->session->set_flashdata('registration_number',$reg_num_id);
				$full_name = $fm_fname." ".$fm_lname;
				
				$t = $event_amount+$fm_total_fee;
				$this->session->set_flashdata('Name',$full_name);
				//$this->session->set_flashdata('html',$mem_html);
				$this->session->set_flashdata('life',$fm_life_member);
				$this->session->set_flashdata('amount',$t);
			
			redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
		}
		
	}
	
	
	/*
	Update - nirav20150120 - start
	function process_payment()
	{
		$inserted_id = $this->uri->segment(5);
		//$amount = $_GET['amount'];

		$data['query'] = $this->dbconvention_registrationall->fetch_data($inserted_id);
		
		if($data['query'] == "" || $data['query'] == null)
		{
			$email = "joshinirav139@gmail.com";//$this->session->userdata('user_email');
			$data['query'] = $this->dbconvention_registrationall->get_fm_id($email);
			$data['query1'] = $this->dbconvention_event_member->get_event_member_data($inserted_id);
			print_r($data['query1']);
			
			//$data['query']['fm_total_fee'] = $amount;
			//$data['query'] = $data1;
			//$data['query'] = $email;//$this->dbconvention_event_member->get_user_using_id($inserted_id); 		
			$data['payment_type'] = "paypal";
			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
					

			}
			$data['reg_status']=$this->dbconvention_event_member->get_user_status();
			
			$data['title']="Event Membership Form";
			
			$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
			
			$data['settings']=$this->dbconvention_settings->get_settings();
			
			$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
		}
		else
		{
			$data['payment_type'] = "paypal";
			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
					

			}
			$data['reg_status']=$this->dbconvention_registration->get_user_status();
			
			$data['title']="Registration Form";
			
			$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
			
			$data['settings']=$this->dbconvention_settings->get_settings();
			
			$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
		}
		
	}
	Update - nirav20150120 - End
	*/
	function process_payment()
	{
		$inserted_id = $this->uri->segment(5);
		
		$data['query'] = $this->dbconvention_registrationall->fetch_data($inserted_id);
		
		$data['payment_type'] = "paypal";
		//$this->form_validation->set_rules('age_grp[]', 'age_grp', 'required');
		//$this->form_validation->set_rules('fees[]', 'fees', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				
				

		}
		$data['reg_status']=$this->dbconvention_registration->get_user_status();
		
		$data['title']="Registration Form";
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	function allregistration()
	{/*var_dump($_POST);
		die();*/
		/*$login = $this->session->userdata('user_email');
		if(!$login)
		{
			redirect(base_url('user/login/convention_registration'));
		}*/
		
		/*$hdnids=$this->input->post('hdnids');*/
		
		/*echo "<pre>";
		print_r($_POST['']);
		echo "</pre>";
		exit;*/
		$menu_ch=$this->input->post('menu_ch');
		$name=$this->input->post('name');
		
		$data['total_name'] = count($name);
		$data['total_mem_name'] = $this->input->post('name');
		$data['total_mem_rel'] = $this->input->post('rel');
		$data['total_mem_bod'] = $this->input->post('bod');
		$data['total_mem_age'] = $this->input->post('age');
		$data['total_mem_menu'] = $this->input->post('menu_ch');
		$data['total_mem_age_group'] = $this->input->post('age_grp');
		$data['total_mem_age_fee'] = $this->input->post('fees');
		$data['total_mem_age_fee_total'] = $this->input->post('fees_total');
	   if(empty($_POST['confirmCaptcha']))
		{
			$captcha = $this->captcha_model->generateCaptcha();

			$_SESSION['captchaWord'] = $captcha['word'];
			
			$data['captcha'] = $captcha;
			$this->form_validation->set_rules('confirmCaptcha', 'Captcha', 'callback_validate_captcha');
		}
		else
		{
			//
			//check captcha matches
			if(isset($_SESSION['captchaWord']) && isset($_POST['confirmCaptcha']))
			{
				if(strcasecmp($_SESSION['captchaWord'], $_POST['confirmCaptcha']) == 0)
				{
					
				     $captcha = $this->captcha_model->generateCaptcha();

				$_SESSION['captchaWord'] = $captcha['word'];
				
				$data['captcha'] = $captcha;    
					//$this->load->view('success_view');
			}
			else
			{
				
				
			     $captcha = $this->captcha_model->generateCaptcha();

				$_SESSION['captchaWord'] = $captcha['word'];
				
				$data['captcha'] = $captcha;
				 $this->form_validation->set_rules('confirmCaptcha', 'Captcha', 'callback_validate_captcha');
			}
			}
		}
		
		/*if($this->uri->segment(5)!='' || $this->uri->segment(5) != NULL)
		{
		$this->form_validation->set_rules('name[]', 'name', 'required');
		}
		else
		{
		$this->form_validation->set_rules('name[]', 'name', 'required|callback__countusers');
		}*/
		$this->form_validation->set_rules('name[]', 'name', 'required');
		$this->form_validation->set_rules('rel[]', 'rel', 'required');
		$this->form_validation->set_rules('age[]', 'age', 'required|numeric');
		$this->form_validation->set_rules('bod[]', 'bod', 'required');
		$this->form_validation->set_rules('fname', 'Fname', 'required');
		$this->form_validation->set_rules('lname', 'Lname', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('txtemail', 'Email', 'required|valid_email|xss_clean|callback_checkemail');
		//$this->form_validation->set_rules('txtemail2', 'Email', 'valid_email');
		$this->form_validation->set_rules('txtem_life_member', 'Life Membership', 'trim');
		$this->form_validation->set_rules('txtpcount[]', 'Number of Participant', 'trim');
		$this->form_validation->set_rules('txtzipcode', 'Zipcode', 'required|numeric');
		$this->form_validation->set_rules('txtem_con_number', 'Contact Number', 'required');
		$this->form_validation->set_rules('txtphoneh', 'Phoneh', 'required');
		$this->form_validation->set_rules('txtphonec', 'Phonec', 'required');
		$this->form_validation->set_rules('txtem_con_name', 'Emergency contact name', 'required');
		$this->form_validation->set_rules('mm_state_id', 'State', 'required');
		$this->form_validation->set_rules('mm_city_id', 'City', 'required');

		$this->form_validation->set_rules('tshirt_size[]', 'tshirt_size', 'trim');
		

		$k=0;
		/*for($k=0;$k<sizeof($hdnids);$k++)
		{
			if($this->input->post('chkbx'.$hdnids[$k]))
			{
				$this->form_validation->set_rules('age['.$k.']', 'age', 'required|numeric');
				//$this->form_validation->set_rules('menu_ch['.$k.']', 'menu_ch', 'required|alpha|max_length[1]');
				
			}
			
		}*/
		
		for($l=$k;$l<sizeof($name);$l++)
		{ 
			$this->form_validation->set_rules('age['.$l.']', 'age', 'required|numeric');
				//$this->form_validation->set_rules('menu_ch['.$l.']', 'menu_ch', 'required|alpha|max_length[1]');
		}
		
		//$this->form_validation->set_rules('age_grp[]', 'age_grp', 'required');
		//$this->form_validation->set_rules('fees[]', 'fees', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$settings = $this->dbconvention->get_setting();
				$name=$this->input->post('name');
				$fname=$this->input->post('fname');
				$lname=$this->input->post('lname');
				$address=$this->input->post('address');
				$city=$this->input->post('mm_city_id');
				$state=$this->input->post('mm_state_id');
				$mm_city_name=$this->input->post('mm_city_id');
				$mm_state_name=$this->input->post('mm_state_id');
				$phoneh=$this->input->post('txtphoneh');
				$phonec=$this->input->post('txtphonec');
				$email=$this->input->post('txtemail');
				$email2=$this->input->post('txtemail2');
				$zipcode=$this->input->post('txtzipcode');
				$payment_type = $this->input->post('payment');
				$con_number=$this->input->post('txtem_con_number');
				$con_name=$this->input->post('txtem_con_name');
				$rel=$this->input->post('rel');
				$bod=$this->input->post('bod');
				$age=$this->input->post('age');
				$menu_ch=$this->input->post('menu_ch');
				$age_grp=$this->input->post('age_grp');
				$fees=$this->input->post('fees');
				$fees_total=$this->input->post('fees_total');
				$totalamounthidden = $this->input->post('totalamounthidden');
				$tshirt_size = $this->input->post('tshirt_size');
				
				$r = mt_rand()."";
				$rand = $r;
				$life_member = $this->input->post('txtem_life_member');
				
				$lifemember_fees=$this->input->post('lifememberfeehidden');
				$sponsorfeehidden=$this->input->post('sponsorfeehidden');
				$free_ticket=$this->input->post('free_ticket');
				
				//$hdnids=$this->input->post('hdnids');
				
				
				$data=array(
					//'mm_id'=>$this->input->post('mm_id'),
					'fm_created_date'=>$this->input->post('fees_created_date'),
					'fm_created_by'=>$this->input->post('fname').' '.$this->input->post('lname'),
					'fees_st_id'=>$this->input->post('fees_st_id'),
					'fm_reg_num'=>$rand,
					'fm_total_fee'=>$fees_total,
					'fm_fname'=>$fname,
					'fm_lname'=>$lname,
					'fm_email'=>$email,
					'fm_secondary_email'=>$email2,
					'fm_address'=>$address,
					'fm_state'=>$state,
					'fm_city'=>$city,
					'fm_phoneh'=>$phoneh,
					'fm_phonec'=>$phonec,
					'fm_zipcode'=>$zipcode,
					'payment_type'=>$payment_type,
					'fm_em_con_name'=>$con_name,
					'fm_em_con_num'=>$con_number,
					'fm_life_member'=>$life_member,
					'event_amount'=>$totalamounthidden,
					'fm_spamount'=>$sponsorfeehidden,
					//'lifemember_amount'=>$lifemember_fees,
					//'sponsor_freeticket_status'=>$free_ticket
					);
					$result = $this->dbconvention_registrationall->insert_member($data);
					$inserted_id = $this->db->insert_id();
				
				$amount_event = $this->input->post('amount');
				
				$age_grp_event = $this->input->post('age-grup-event');
				$activity_id = $this->input->post('eventid');
				$number_of_participant = $this->input->post('txtpcount');
				$tshirt_size = $this->input->post('tshirt_size');
				
					$activity_html = '';
					$activity_fee = 0;
					for($i=0;$i<sizeof($amount_event);$i++)
					{ 
						if($number_of_participant[$i] == 0)
							continue;
						
						$data_event=array(
						'email_id'=>$email,
						'age_group'=>$age_grp_event[$i],
						'event_id'=>$activity_id[$i],
						'number_of_participant'=>$number_of_participant[$i],
						'amount'=>$amount_event[$i],
						'tshirt_size' =>$tshirt_size[$i]
						);
						$age_group_text = '';
						switch($age_grp_event[$i])
						{
							case '6-11':
								$age_group_text = '6yrs - 11yrs (1st - 5th Grade) - Perot Museum';
								break;
							case '12-17':
								$age_group_text = '12yrs - 17yrs (6th - 12th Grade) - Trinity Forest & Southern cross Ranch';
								break;
							case '18-30':
								$age_group_text = '18yrs - 30yrs(College) - Group Dynamix';
								break;
							case '55-100':
								$age_group_text = '55+yrs(Seniors) - Dallas Ni Mulakat';
								break;
						}
						$activity_html .= '<tr><td width="40%">'.$age_group_text.'</td><td width="20%">'.$number_of_participant[$i].'</td><td width="20%">'.$tshirt_size[$i].'</td><td width="20%">'.$amount_event[$i].'</td></tr>';
						$result=$this->dbconvention_registrationall->insert_event_data($data_event);
						$activity_fee += $amount_event[$i];
					}
					if ($activity_html != '')
						$activity_html = '<table width="100%" border="1" class="add_rm_before" style="" >'.$activity_html.'</table>';
					else 
						$activity_html = '<table width="100%" border="1" class="add_rm_before" style="" ><td colspan="4">No Activities selected</td></table>';
				
				$j = 0;	
				$total = 0;
				$life_member_text = '';
				if($life_member == "1")
				{
					$life_member_text = 'Is Register for Life Member : Yes';
					$total = 250;
				}
				else
				{
					$life_member_text = 'Is Register for Life Member : No';
					$total = 0;
				}
				
				if($free_ticket == "Y"){
					$total = $total + 1000;
				}
				
				for($i=$j;$i<sizeof($name);$i++)
				{ 
					$data=array(
					'fm_id'=>$inserted_id,
					'fm_rel_mm_id'=>0,
					'fmg_att_name'=>$name[$i],
					'fmg_mm_rel'=>$rel[$i],
					'fmg_mm_bod'=>$bod[$i],
					'fmg_mm_age'=>$age[$i],
					'fmg_menu_choice'=>$menu_ch[$i],
					'fmg_age_grp'=>$age_grp[$i],
					'fmg_fees'=>$fees[$i],
					'status'=>1
					);
					$result=$this->dbconvention_registrationall->insert_fmg($data);
					$total += $fees[$i];
				}
					$updatetotal=array(
					'fm_total_fee'=>$total,
					);
					$result=$this->dbconvention_registrationall->con_fees_member_edit($updatetotal,$inserted_id);
					
					if($payment_type == "by_check")
					{
						$update_payment_status=array(
						'payment_status'=>1,
						);
						$result=$this->dbconvention_registrationall->con_fees_member_payment_status($update_payment_status,$inserted_id);
					}
					/*//print_r($mem_html1);
					//$members = $mem_html1->[''];
					//exit;
					//print_r($mem_html1);
				$mem_html = "";
				
				$mem_html.= 'Dear Member - '.$name[$j].'<br><br><br>';
				$mem_html.= 'Thank you for your registration for 7th SPCS International Convention.<br><br><br>';
				$mem_html.= 'Registration Confirmation Number: '.$rand.'<br><br>';
				$mem_html.= 'Convention Location: <br><br>';
				$mem_html.= 'Convention Date: <br><br>';
				$mem_html.= 'Convention Site: '.$settings->cs_sitename.'<br><br>';*/
				$str = "";
				if($life_member == 1)
				{
					$str = "Yes"; 
				}
				else
				{
					$str = "No";				
				}
				/*<!--$mem_html.= 'Life Time Membership: '.$str.'<br><br>';-->*/
				/*$mem_html.= 'Payment Method: '.$payment_type.'<br><br>';
				$mem_html.= '(NOTE: Write a Name, Phone Number, Confirmation Number on back of the check and mail to below address)';*/
				$mem_html = "";
				$mem_html.= '<table width="100%" border="1" class="add_rm_before" style="" >';
               /*for($j=0;$j<sizeof($hdnids);$j++)
				{
					
					if($this->input->post('chkbx'.$hdnids[$j]))
					{
						$mem_html.= '<tr><td width="30%" style="">'.$name[$j].'</td><td width="12%">'.$rel[$j].'</td><td  width="8%">'.$age[$j].'</td> <td width="15%">'.$menu_ch[$j].'</td><td width="15%">'.$age_grp[$j].'</td><td width="10%">'.$fees[$j].'</td></tr>';	
						
					}
				}*/
				for($i=$j;$i<sizeof($name);$i++)
				{ 
					$mem_html.= '<tr><td width="24%" style="">'.$name[$i].'</td><td width="12%">'.$rel[$i].'</td><td width="12%">'.$bod[$i].'</td><td  width="7%">'.$age[$i].'</td> <td width="15%">'.$menu_ch[$i].'</td><td width="15%">'.$age_grp[$i].'</td><td width="10%">'.$fees[$i].'</td></tr>';	
				}
			$mem_html.= '</table>';
			$event_html = "";
			$event_html.= '<table width="100%" border="1" class="add_rm_before" style="" >';
			
			for($i=$j;$i<sizeof($amount_event);$i++)
			{ 
			
				$event_html.= '<tr><td width="24%" style="">'.$age_grp_event[$i].'</td><td width="13%">'.$activity_id[$i].'</td><td width="12%">'.$number_of_participant[$i].'</td><td  width="7%">'.$amount_event[$i].'</td> <td width="15%">'.$tshirt_size[$i].'</td></tr>';	
			}
			$event_html.= '</table>';
            $con_title = $settings->ch_name.' Convention '.$settings->ch_year;   	
					
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
	
				$this->email->from($settings->cs_email);
				$this->email->to($email);
				//$this->email->to($settings->cs_email);
				
				$this->email->subject('7th SPCS International Convention Registration Confirmation - 2015');
				
				 //$get_state = $this->dbconvention_registration->state_reg();
				 // $get_cities = $this->dbconvention_registration->cities_reg();
				   $get_cities = $this->dbconvention_registration->cities_reg($mm_city_name);
				  $get_state = $this->dbconvention_registration->state_reg($mm_state_name);
				  if($payment_type == "by_check") {
				  	$p_type = "Cheque";
				  }
				  else
				  {
				  	$p_type = "Paypal";
				  }
				  
				$totalFee = $_POST['fees_total']+$_POST['totalamounthidden'];
				$total_with_paypal = round($totalFee + ($totalFee * 0.022) + 0.30, 2);
				$total_payment_with_paypal_fee_text = '<b style="color:#dd0e78;">Total : $'.$total_with_paypal.'</b> ($'.$_POST['fees_total'].' + $'.$_POST['totalamounthidden'].' + $'.($total_with_paypal - $totalFee).' (2.2% + $0.30 - Paypal Processing Fee))';
				  
				$final_message = array('name' => '', 'sitename'=> $settings->cs_sitename, 'user_email' => $email, 'con_hdn_ch_name' => '', 'con_hdn_reg_number' => $rand,'con_hdn_lm_number' => 'N/A', 'con_hdn_last_name' => $lname, 'con_hdn_first_name' => $fname, 'con_hdn_addr' => $address, 'con_hdn_city' => $city, 'con_hdn_state' => $get_state->state_name, 'con_hdn_phnH' => $phoneh, 'con_hdn_phnC' => $phonec, 'con_hdn_email' => $email, 'zipcode'=> $zipcode, 'con_hdn_payment_method' => $p_type, 'con_hdn_payment_status' => 'Un-Paid', 'con_em_name' => $con_name, 'con_em_number' => $con_number, 'member' => $mem_html, 'total_fees' => $total, 'activities' => $activity_html, 'activity_fee' => $activity_fee, 'logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title, 'life_member_text' => $life_member_text, 'total_payment_with_paypal_fee_text' => $total_payment_with_paypal_fee_text);
		
				$this->email->message($this->parser->parse('con_register_parser', $final_message , TRUE));	
				//$this->email->message($mem_html);
				
				
				$this->email->send();
				//echo $this->email->print_debugger();
				
				if($settings->cs_email != "") {
				/*$config['mailtype'] = 'html';
				$this->email->initialize($config);
	
				$this->email->from($settings->cs_email);
				$this->email->to($settings->cs_email);
				//$this->email->to($settings->cs_email);
				
				$this->email->subject('testconvention registration '.$settings->cs_sitename);
				
				$final_message = array('name' => '', 'sitename'=> $settings->cs_sitename, 'user_email' => $email, 'con_hdn_ch_name' => '', 'con_hdn_reg_number' => $rand,'con_hdn_lm_number' => '', 'con_hdn_last_name' => $lname, 'con_hdn_first_name' => $fname, 'con_hdn_addr' => $address, 'con_hdn_city' => $mm_city_id, 'con_hdn_state' => $mm_state_id, 'con_hdn_phnH' => $phoneh, 'con_hdn_phnC' => $phonec, 'con_hdn_email' => $email, 'zipcode'=> $zipcode, 'con_hdn_payment_method' => $payment_type, 'con_em_name' => $con_name, 'con_em_number' => $con_number, 'member' => $mem_html, 'total_fees' => $total, 'logo' => $settings->cs_logo, 'logo2' => $settings->cs_logo2, 'con_title' => $con_title);
				
				$this->email->message($this->parser->parse('con_register_parser', $final_message , TRUE));
				
				$this->email->send();*/
				}	
					
				if($payment_type == "by_paypal"){
					redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/process_payment/'.$inserted_id.'.html'));
					
				}
				else {
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('welcome_status', 'success');
				$p = "";
				if($payment_type == "by_check") $p = "Cheque"; else $p = "Paypal";
				$this->session->set_flashdata('status_', 'You registration completed successfully, 
				<br>Please also find below registration confirmation as well we have sent you registration confirmation in email.
 <br>
You have selected pay by <b>'.$p.'</b> method.
<br> 
Please make your deposit electronically via online Payments system or Cheque payable to "SPCS Convention" and  enclose with this fully complete form mail to:
<br>
<p>Bharat Sutaria
<br>
Svtronics Inc.
<br>
3465 Technology Drive
<br>
Plano,TX, 75074
<br>
Phone:214-440-1234 EXT 101
<br>
Cell:214-418-7562
<br>
Fax:214-440-1222</p>
For any question regarding registration, email at  spcs2015reg@gmail.com
<br>
Registration will be first come, first serve basis based on limited capacity available.  
<br>At the door registration is not guaranteed.');
				$this->session->set_flashdata('registration_number',$rand);
				$full_name = $fname." ".$lname;
				$t = $totalamounthidden+$fees_total;
				$this->session->set_flashdata('Name',$full_name);
				$this->session->set_flashdata('html',$mem_html);
				$this->session->set_flashdata('life',$life_member);
				$this->session->set_flashdata('amount',$t);
				
				if($p == "Cheque")
				{
				$this->session->set_flashdata('cheque_instruction','<br>You have selected pay by <b>'.$p.'</b> method.
<br> 
Please make your deposit electronically via online Payments system or Cheque payable to &quot;SPCS Convention&quot; and enclose with this fully complete form mail to:
<br>
<p>Bharat Sutaria
<br>
Svtronics Inc.
<br>
3465 Technology Drive
<br>
Plano,TX, 75074
<br>
Phone:214-440-1234 EXT 101
<br>
Cell:214-418-7562
<br>
Fax:214-440-1222</p>
For any question regarding registration, email at  spcs2015reg@gmail.com');
				}
				else
				{
					$this->session->set_flashdata('cheque_instruction','');
				}
				
				$today = date("d-m-Y"); 
				$this->session->set_flashdata('date_created',$today);
				redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
				}

			}
		$data['reg_status']=$this->dbconvention_registration->get_user_status();
		
		$data['title']="Registration Form";
		$data['items'] = $this->dbconvention_event_member->get_con_event_detail_by_id();
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	
	function validate_captcha()
	{
			 $this->form_validation->set_message('validate_captcha', 'Captcha Code Doesnot match.'); 
	        return false;
	}
	
	function eventmembership()
	{
		
		$login = $this->session->userdata('user_email');
		/*if(!$login)
		{
			redirect(base_url('user/login/convention_event'));
		}*/
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
			$payment_type = $this->input->post('payment');
			$dataevent=array(
			'con_mm_id'=>$this->session->userdata('user_id'),
			'ce_mem_created_date'=>$this->input->post('event_mem_created_date'),
			'ce_mem_created_by'=>$this->input->post('event_mem_created_by'),
			'payment_type'=> $payment_type
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
			
			if($payment_type == "by_paypal"){
					redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/process_payment/'.$inserted_id.'.html'));
					
				}
			
			redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
				
		}
		
		$data['items'] = $this->dbconvention_event_member->get_con_event_detail_by_id();
		
		$data['reg_status']=$this->dbconvention_event_member->get_user_status();
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		
		$data['title']="Event Membership Form";
		$data['settings']=$this->dbconvention_settings->get_settings();
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
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
		
		$this->form_validation->set_rules('pm_choreo_phone', 'Phone No' , 'required');///////////monita////////////
		
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

						redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));


	}
		
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['reg_status']=$this->dbconvention_registration->get_user_status_for_program();
		$data['query'] = $this->dbconvention->get_all_program_by_user();
		$data['title'] = 'Program Entry Form';
		$data['sub_title'] = "Add Program";
		$data['description'] = "";
		$data['keywords'] = "";
		
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
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
		
		$this->form_validation->set_rules('md_home_phone', 'Home Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone', 'Cell Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_name1', 'Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_rel1', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address1', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone1', 'Home Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone1', 'Cell Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state1', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city1', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip1', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_name2', 'Name' , 'required|alpha');
		
		$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address2', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone2', 'Home Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');/////////update_monita20130927//////
		
		$this->form_validation->set_rules('md_state2', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city2', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip2', 'Zip' , 'required|numeric');
		
		
		
		$this->form_validation->set_rules('md_dr_name3', 'Name' , 'required|alpha');
		
		//$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_dr_address3', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_dr_phone3', 'Phone' , 'required');/////////update_monita20130927//////
		
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

						redirect(base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'.''));
						

	}
		$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['reg_status']=$this->dbconvention_registration->get_user_status_for_medical();
		$data['query'] = $this->dbconvention->get_all_medical_by_user();
		$data['title']="Medical Release Form";
		
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	
	function get_city($state_id,$city_id='')
	{
		
		$get_cities = $this->dbconvention->cities($state_id);
		//$html = "";
		$html = '<option value="0">Select City</option>'; 
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
		/*$html .= '</select>';*/
		echo $html;
	}
	/*program*/
	function detail_page($id)
	{
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='convention';
		$data['page_detail'] = $this->dbconvention->getpage_id($id);
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	function pages($page_seo)
	{
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		
		$data['page_detail'] = $this->dbconvention->getpage_page_seo($page_seo);
		$data['title']=$data['page_detail']->page_title;
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
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
	    $this->load->view($this->config->item('convention_texas_folder').'convention_welcomepage' , $test);	
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
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	/*update end*/

	function gallery()
	{   
	
	  	$data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='convention';
		$data['album']=$this->dbconvention->getalbum();
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
		
	}
	
	function convention_gallarypage($id)
	{   
	    $data['sponsors'] = $this->dbconvention_sponsors->get_sponsors_for_general();
		$data['settings']=$this->dbconvention_settings->get_settings();
		$data['title']='Gallery';
		$data['image']=$this->dbconvention->get_img_gallary($id);
		$data['video']=$this->dbconvention->get_video_gallary($id);
		$this->load->view($this->config->item('convention_texas_folder').'convention',$data);
	}
	
	function checkemail($str)
	{
		
		$query = $this->dbconvention_registration->check_email($str);
		if ($query)
		{
			$this->form_validation->set_message('checkemail', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}
