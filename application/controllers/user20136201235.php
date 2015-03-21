<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbuser');
		$this->load->model('dbheader');
		$this->load->library('email');
		$this->load->library('parser');
	}
	
	public function _remap($method, $params = array())
	{
		if($method == 'index' || $method = '')
		{
			$this->login();
		}
		elseif($this->uri->segment(2) == "register")
		{
			$this->register();
		}
		elseif($this->uri->segment(2) == "add_family_member")
		{
			$this->register();
		}
		elseif($this->uri->segment(2) == "add_user_family_member")
		{
			$this->register();
		}
		elseif($this->uri->segment(2) == "login")
		{
			$this->login();
		}
		elseif($this->uri->segment(2) == "get_city")
		{
			$this->get_city($this->uri->segment(3),$this->uri->segment(4));
		}
		else
		{
			$page = $this->uri->segment(2);
			$this->$page();
		}
	}
	
	function forgot_password()
	{
		$settings = $this->dbheader->get_setting();
		
		$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'required|trim|max_length[99]|xss_clean');
		
		if($this->form_validation->run()==FALSE)
		{
		}
		else
		{
			
			$get_data = $this->dbuser->valide_user_email($this->input->post('mm_email'));
			
			if ($get_data)
			{
				$random = substr(number_format(time() * rand(),0,'',''),0,10);
				$random = md5($random);
				$data=array(
				'mm_seq'=>$random
				);
				$result=$this->dbuser->update($data,$get_data->mm_id);
				
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from($settings->email);
			$this->email->to($get_data->mm_email);
			$this->email->subject('Pasword Recovery - '.$settings->sitename);
			$final_message = array('code' => $random, 'email' => $get_data->mm_email, 'username'=>$get_data->mm_username, 'fname'=>$get_data->mm_fname,'lname'=>$get_data->mm_lname, 'sitename'=>$settings->sitename);
			$this->email->message($this->parser->parse('forgot_parser', $final_message , TRUE));
			$this->email->send();
			//echo $this->email->print_debugger();

				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Password reset information sent to your email address.');
				redirect($this->config->item('url').'user/login');
			}
			else
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', "Email or Username doesn't exist.");
				redirect($this->config->item('url').'user/forgot_password');
			}
		}
		
			$data['title'] = "Forgot Password";
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('forgot',$data);
	}
	
	function reset_password()
	{
		$uniqueid = xss_clean($this->uri->segment(3));
		$username = xss_clean($this->uri->segment(4));
		
		$get_data = $this->dbuser->reset_retrive($uniqueid,$username);
		
		if($get_data)
		{
		$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|xss_clean');
		$this->form_validation->set_rules('mm_cpassword', 'Confirm Password', 'required|matches[mm_password]');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
			if($this->form_validation->run()==FALSE)
			{
			}
			else
			{
					$data=array(
					'mm_password'=>md5($this->input->post('mm_password')),
					'mm_status'=>'1'
					);
					$result=$this->dbuser->update($data,$get_data->mm_id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Password successfully reset. now you may login to your account');
				
				redirect(base_url().'user/login');
			}
		}
		else
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'Invalide Link');
			
			redirect(base_url().'user/login');
		}
		$data['title'] = 'Reset Password';
		$data['sub_title'] = '';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('reset_password',$data);
	}
	
	function login()
	{
		$login = $this->session->userdata('user_email');

		if($login)
		{
			redirect(base_url('user/account.html'));
		}
				
		if(!$this->session->userdata('ref_url'))
		{
			$this->session->set_userdata('ref_url',$this->agent->referrer());
		}
		
		$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'required|trim|max_length[99]|xss_clean');
		$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|xss_clean|callback__checkUsernamePassword');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		if($this->form_validation->run()==FALSE)
		{
		}
		else
		{
			$user = $this->dbheader->check_user_pass($this->input->post('mm_email'),$this->input->post('mm_password'));
			
			if($user->mm_status == 1)
			{
				$this->session->set_userdata('user_email',$user->mm_email);
				
				$data=array(
					'mm_id'=>$user->mm_id,
					'ip'=>$this->input->ip_address(),
					'browser'=>$this->input->user_agent(),
					'date_time'=>date('Y-m-d H:i:s')
					);
					$result=$this->dbuser->insert_log($data);
				
				$this->session->set_userdata('user_id',$user->mm_id);
				
				if($this->session->userdata('ref_url'))
				{
					//echo $this->session->userdata('ref_url');
					redirect($this->session->userdata('ref_url'));
				}
				else
				{
					redirect(''.base_url().'user/account.html');
				}
			}
			else
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'Your email address not verify yet, please check your email to verify your email.');
				redirect(''.base_url().'user/login.html');
			}
		}
					
		$data['title'] = $this->lang->line('text_login_title');
		$data['sub_title'] = $this->lang->line('text_login_sub_title');
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('login',$data);
	}
	
	function _checkUsernamePassword() {

        $email = $this->input->post('mm_email');
        $password = $this->input->post('mm_password');

        $user = $this->dbheader->check_user_pass($email,$password);

        if(! $user)
        {
            $this->form_validation->set_message('_checkUsernamePassword', $this->lang->line('text_incorrect_login'));
            return FALSE;
        }else{
            return TRUE;
        }   
	}
	
	function checkuser($str)
	{
		$query = $this->dbheader->check_username($str);
		if ($query)
		{
			$this->form_validation->set_message('checkuser', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function checkemail($str)
	{
		$query = $this->dbheader->check_email($str);
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
	
	function register()
	{
		$settings = $this->dbheader->get_setting();
		
		$login = $this->session->userdata('user_email');

		if($login)
		{
			$data['user'] = $this->dbheader->user_details($login);
			$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'valid_email|xss_clean|callback_checkemail');
			$data['mm_family_id'] = $this->uri->segment(3);
		}
		else
		{
			$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'required|valid_email|xss_clean|callback_checkemail');
			$data['mm_family_id'] = 0;
		}
		
		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');
		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');
		$this->form_validation->set_rules('mm_username', $this->lang->line('text_username'), 'required|max_length[40]|min_length[3]|xss_clean|is_unique[member_master.mm_username]');
		
		$this->form_validation->set_message('is_unique', 'Username already in used.');
				
		$this->form_validation->set_rules('mm_city_id', 'City', 'required');
		$this->form_validation->set_rules('mm_state_id', 'State', 'required');
		$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|min_length[6]|xss_clean');
		
		$this->form_validation->set_rules('occupation_id', 'Occupation', 'xss_clean');
		$this->form_validation->set_rules('edu_qualification', 'Education Qualification', 'xss_clean');
		$this->form_validation->set_rules('univercity_college_name', 'Univercity/College Name', 'xss_clean');
		$this->form_validation->set_rules('mm_life_id', 'Life Member Number', 'xss_clean');
		
		$this->form_validation->set_rules('mm_father_name', 'Father Name', 'xss_clean');
		$this->form_validation->set_rules('mm_original_surname', 'Original Surname', 'xss_clean');
		$this->form_validation->set_rules('mm_mother_maiden_name', 'Mother Maiden Name', 'xss_clean');
		$this->form_validation->set_rules('mm_hometown', 'Hometown', 'xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'images/profile/big/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('mm_photo'))
			{
				$filename="";
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name)
				->resize(500,500,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name,$overwrite=TRUE);
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name)
				->resize_crop(180,180,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/thumb/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				//unlink($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name);			
			}
			// image upload end
			
			if(isset($data['user']))
				{
					$mm_status = 1;
					$data['mm_family_id'] = $this->uri->segment(3);
					
					if($this->input->post('mm_relationship') == 'Wife' || $this->input->post('mm_relationship') == 'Mother' || $this->input->post('mm_relationship') == 'Sister' || $this->input->post('mm_relationship') == 'Daughter')
					{
						$mm_gender = 1;
						
					}
					else
					{
						$mm_gender =  0;
					}
					
					$mm_relationship =  $this->input->post('mm_relationship');
				}
				else
				{
					$mm_status = 0;
					$data['mm_family_id'] = '0';
					$mm_gender = $this->input->post('mm_gender');
					$mm_relationship =  '';
				}
				
				$random = substr(number_format(time() * rand(),0,'',''),0,10);
				$random = md5($random);
				
			$dataA=array(
				'mm_fname'=>$this->input->post('mm_fname'),
				'mm_lname'=>$this->input->post('mm_lname'),
				'mm_gender'=>$mm_gender,
				'mm_city_id'=>$this->input->post('mm_city_id'),
				'mm_state_id'=>$this->input->post('mm_state_id'),
				'mm_address'=>$this->input->post('mm_address'),
				'mm_username'=>friendlyURL($this->input->post('mm_username')),
				'mm_email'=>$this->input->post('mm_email'),
				'mm_password'=>md5($this->input->post('mm_password')),
				'mm_hphone'=>$this->input->post('mm_hphone'),
				'mm_cphone'=>$this->input->post('mm_cphone'),
				'mm_birth_month'=>$this->input->post('mm_birth_month'),
				'mm_birth_year'=>$this->input->post('mm_birth_year'),
				'occupation_id'=>$this->input->post('occupation_id'),
				'edu_qualification'=>$this->input->post('edu_qualification'),
				'univercity_college_name'=>$this->input->post('univercity_college_name'),
				'mm_life_id'=>$this->input->post('mm_life_id'),
				'mm_photo'=>$filename,
				'mm_create'=>date('Y-m-d'),
				'mm_status'=>$mm_status,
				'mm_modify'=>date('Y-m-d'),
				'mm_family_id'=>$this->input->post('mm_family_id'),
				'mm_relationship'=>$mm_relationship,
				'mm_life_id'=>$this->input->post('mm_life_id'),
				'mm_father_name'=>$this->input->post('mm_father_name'),
				'mm_original_surname'=>$this->input->post('mm_original_surname'),
				'mm_mother_maiden_name'=>$this->input->post('mm_mother_maiden_name'),
				'mm_hometown'=>$this->input->post('mm_hometown'),
				'mm_seq'=>$random
				);
				$resultA=$this->dbuser->insert($dataA);
				
				$new_mm_id = $this->db->insert_id();
				/*edit*/
				  if($new_mm_id != '')
				  {
					  	$ch_id=$this->input->post('mm_state_id');
						$ch_email=$this->dbuser->fetch_ch_email($ch_id);
						$admin_email=$this->dbuser->get_admin_id();
						$admin_email_id=$admin_email->email;
												
						foreach($ch_email as $row)
						{
							/*
							if($row->mm_email != '')
							{
								$mail_id=$row->mm_email;
								$this->load->library('phpmailer');
								$mail = new PHPMailer();
								$mail->Username = "virendra.testmail@gmail.com"; 
								$mail->Password = "admin123admin"; 
								$mail->AddAddress($mail_id);
								$mail->FromName = "virendra";
								$mail->IsHTML(true);
								$MESSAGE_BODY='';
								$MESSAGE_BODY .= "<b><u>User Details</u></b><br>"; 
								$MESSAGE_BODY .= "Name: ". $this->input->post('mm_fname').' '. $this->input->post('mm_lname')."<br>"; 
								$MESSAGE_BODY .= "Username: ".$this->input->post('mm_username')."<br>"; 
								$MESSAGE_BODY .= "Email: ".$this->input->post('mm_email')."<br>"; 
								$MESSAGE_BODY .= "Contact Number: ".$this->input->post('mm_hphone'); 
							
								$mail->Subject = $this->input->post('mm_username').' Registered with your Chapter';
								$mail->Body    = $MESSAGE_BODY ; 
								
								$mail->Host = "ssl://smtp.gmail.com";
								$mail->Port = 465;
								$mail->IsSMTP();
								$mail->SMTPAuth = true;
								$mail->From = $mail->Username;
								$mail->Send();
							}
							if(admin_email_id != '')
							{
								$mail_id=$admin_email_id;
								$this->load->library('phpmailer');
								$mail = new PHPMailer();
								$mail->Username = "virendra.testmail@gmail.com"; 
								$mail->Password = "admin123admin"; 
								$mail->AddAddress($mail_id);
								$mail->FromName = "virendra";
								$mail->IsHTML(true);
								$MESSAGE_BODY='';
								$MESSAGE_BODY .= "<b><u>User Details</u></b><br>"; 
								$MESSAGE_BODY .= "Name: ". $this->input->post('mm_fname').' '. $this->input->post('mm_lname')."<br>"; 
								$MESSAGE_BODY .= "Username: ".$this->input->post('mm_username')."<br>"; 
								$MESSAGE_BODY .= "Email: ".$this->input->post('mm_email')."<br>"; 
								$MESSAGE_BODY .= "Contact Number: ".$this->input->post('mm_hphone'); 
							
								$mail->Subject = $this->input->post('mm_username').' Registered';
								$mail->Body    = $MESSAGE_BODY ; 
								
								$mail->Host = "ssl://smtp.gmail.com";
								$mail->Port = 465;
								$mail->IsSMTP();
								$mail->SMTPAuth = true;
								$mail->From = $mail->Username;
								$mail->Send();
							}
							*/
							if($row->mm_email != '')
							{
								$email = $settings->email;
						
								$config['mailtype'] = 'html';
								$this->email->initialize($config);
					
								$this->email->from($settings->email);
								$this->email->to(trim($row->mm_email));
								
								$this->email->subject( $this->input->post('mm_username').' Registered with your Chapter');
								
								$MESSAGE_BODY .= "<b><u>User Details</u></b><br>"; 
								$MESSAGE_BODY .= "Name: ". $this->input->post('mm_fname').' '. $this->input->post('mm_lname')."<br>"; 
								$MESSAGE_BODY .= "Username: ".$this->input->post('mm_username')."<br>"; 
								$MESSAGE_BODY .= "Email: ".$this->input->post('mm_email')."<br>"; 
								$MESSAGE_BODY .= "Contact Number: ".$this->input->post('mm_hphone'); 
								
								$this->email->message($this->parser->parse('register_parser', $MESSAGE_BODY , TRUE));
								
								$this->email->send();
							}
							
							if(admin_email_id != '')
							{
								$email = $settings->email;
								$mail_id = $admin_email_id;
						
								$config['mailtype'] = 'html';
								$this->email->initialize($config);
					
								$this->email->from($settings->email);
								$this->email->to(trim($mail_id));
								
								$this->email->Subject( $this->input->post('mm_username').' Registered' );
								
								$MESSAGE_BODY .= "<b><u>User Details</u></b><br>"; 
								$MESSAGE_BODY .= "Name: ". $this->input->post('mm_fname').' '. $this->input->post('mm_lname')."<br>"; 
								$MESSAGE_BODY .= "Username: ".$this->input->post('mm_username')."<br>"; 
								$MESSAGE_BODY .= "Email: ".$this->input->post('mm_email')."<br>"; 
								$MESSAGE_BODY .= "Contact Number: ".$this->input->post('mm_hphone'); 
								
								$this->email->message($this->parser->parse('register_parser', $MESSAGE_BODY , TRUE));
								
								$this->email->send();
							}
						}
						
				  }
				/*edit*/
						
				$data=array(
					'mm_id'=>$new_mm_id,
					'ip'=>$this->input->ip_address(),
					'browser'=>$this->input->user_agent(),
					'date_time'=>date('Y-m-d H:i:s')
					);
					$result=$this->dbuser->insert_log($data);
				
				if(isset($data['user']))
				{
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_family_register'));
					redirect(base_url().'user/account.html');
				}
				else
				{
					if($this->input->post('mm_email') != '')
						{
						$email = $settings->email;
						
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
			
						$this->email->from($settings->email);
						$this->email->to($this->input->post('mm_email'));
						
						$this->email->subject('Thank you for registering at '.$settings->sitename);
						
						$final_message = array('name' => $this->input->post('mm_fname'), 'site_email' => $settings->email, 'user_email' => $this->input->post('mm_email'),'sitename'=>$settings->sitename,'seq_code'=>$random,'username'=>$this->input->post('mm_username'));
						
						$this->email->message($this->parser->parse('register_parser', $final_message , TRUE));
						
						$this->email->send();
						//echo $this->email->print_debugger();
						}
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_register'));
					redirect(base_url().'user/login.html');
					
				}
				
		}
		
			if(isset($data['user']))
				{
					$data['title'] = $this->lang->line('text_family_member_title');
					$data['sub_title'] = $this->lang->line('text_family_member_sub_title');
				}
				else
				{
					$data['title'] = $this->lang->line('text_register_title');
					$data['sub_title'] = $this->lang->line('text_register_sub_title');
				}
				
			
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('register',$data);
	}
	
	function _checkEditUsername() {

        $mm_username = $this->input->post('mm_username');
		$mm_id = $this->input->post('mm_id');

        $user = $this->dbuser->check_edit_user($mm_id,$mm_username);

        if($user)
        {
            $this->form_validation->set_message('_checkEditUsername','Username already exist');
            return FALSE;
        }else{
            return TRUE;
        }   
	}
	
	function _checkEditEmail() {

        $mm_email = $this->input->post('mm_email');
		$mm_id = $this->input->post('mm_id');

        $user = $this->dbuser->check_edit_email($mm_id,$mm_email);

        if($user)
        {
            $this->form_validation->set_message('_checkEditEmail','Email already exist.');
            return FALSE;
        }else{
            return TRUE;
        }   
	}
	
	
	function edit_profile()
	{
		$login = $this->session->userdata('user_email');
		
		if(!$login)
		{
			redirect(base_url('user/login.html'));
		}
		
		if($this->uri->segment(3))
		{
			$current_user = $this->dbheader->user_details($login);
			$data['user'] = $this->dbheader->user_details_by_familyid($this->uri->segment(3),$current_user->mm_id);
			
			if(!$data['user'])
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
				
				redirect(base_url().'user/account.html');
			}
			$is_fam = 1;
		}
		else
		{
			$data['user'] = $this->dbheader->user_details($login);
			$is_fam = 0;
		}
				
		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');
		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');
		$this->form_validation->set_rules('mm_city_id', $this->lang->line('text_city'), 'required');
		$this->form_validation->set_rules('mm_state_id', $this->lang->line('text_state'), 'required');
		$this->form_validation->set_rules('mm_address', 'Address', 'required');
		
		$this->form_validation->set_rules('mm_username', $this->lang->line('text_username'), 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditUsername');
		
		$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditEmail');
		
		if($this->input->post('mm_password') !='')
		{
			$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|min_length[6]|xss_clean');
		}
		
		$this->form_validation->set_rules('occupation_id', 'Occupation', 'xss_clean');
		$this->form_validation->set_rules('edu_qualification', 'Education Qualification', 'xss_clean');
		$this->form_validation->set_rules('univercity_college_name', 'Univercity/College Name', 'xss_clean');
		$this->form_validation->set_rules('mm_life_id', 'Life Member Number', 'xss_clean');
		
		$this->form_validation->set_rules('mm_father_name', 'Father Name', 'xss_clean');
		$this->form_validation->set_rules('mm_original_surname', 'Original Surname', 'xss_clean');
		$this->form_validation->set_rules('mm_mother_maiden_name', 'Mother Maiden Name', 'xss_clean');
		$this->form_validation->set_rules('mm_hometown', 'Hometown', 'xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'images/profile/big/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('mm_photo'))
			{
				$filename=$this->input->post('old_photo');
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name)
				->resize(500,500,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name,$overwrite=TRUE);
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name)
				->resize_crop(180,180,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/thumb/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				//unlink($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name);			
			}
			// image upload end
			
			if($this->input->post('mm_disp_dir')){ $mm_disp_dir = 1; }else { $mm_disp_dir = 0; }
			if($this->input->post('mm_disp_birth')){ $mm_disp_birth = 1; }else { $mm_disp_birth = 0; }
			
			$dataA=array(
				'mm_fname'=>$this->input->post('mm_fname'),
				'mm_lname'=>$this->input->post('mm_lname'),
				'mm_address'=>$this->input->post('mm_address'),
				'mm_email'=>$this->input->post('mm_email'),
				'mm_city_id'=>$this->input->post('mm_city_id'),
				'mm_state_id'=>$this->input->post('mm_state_id'),
				'mm_hphone'=>$this->input->post('mm_hphone'),
				'mm_cphone'=>$this->input->post('mm_cphone'),
				'mm_username'=>$this->input->post('mm_username'),
				'mm_birth_month'=>$this->input->post('mm_birth_month'),
				'mm_birth_year'=>$this->input->post('mm_birth_year'),
				'mm_gender'=>$this->input->post('mm_gender'),
				'occupation_id'=>$this->input->post('occupation_id'),
				'edu_qualification'=>$this->input->post('edu_qualification'),
				'univercity_college_name'=>$this->input->post('univercity_college_name'),
				'mm_life_id'=>$this->input->post('mm_life_id'),
				'mm_photo'=>$filename,
				'mm_modify'=>date('Y-m-d'),
				'mm_disp_dir'=>$mm_disp_dir,
				'mm_disp_birth'=>$mm_disp_birth,
				'mm_father_name'=>$this->input->post('mm_father_name'),
				'mm_original_surname'=>$this->input->post('mm_original_surname'),
				'mm_mother_maiden_name'=>$this->input->post('mm_mother_maiden_name'),
				'mm_hometown'=>$this->input->post('mm_hometown')
				);
				$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);

			if($this->input->post('mm_password') !='')
			{
				$dataB=array(
				'mm_password'=>md5($this->input->post('mm_password'))
				);
				$resultB=$this->dbuser->update($dataB,$data['user']->mm_id);
			}
			
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_saved'));
				
				redirect(base_url().'user/account.html');
		}
		
			$data['title'] = $this->lang->line('text_edit_profile_title');
			$data['sub_title'] = $this->lang->line('text_edit_profile_sub_title');
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('user_edit_profile',$data);
	}
	
	function verify()
	{
		$user = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));

		if($user)
		{
			if($user->mm_status == '0')
			{
				$random = substr(number_format(time() * rand(),0,'',''),0,10);
				$random = md5($random);
				
				$data=array(
				'mm_status'=>1,
				'mm_seq'=>$random
				);
				$this->dbuser->update($data,$user->mm_id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Your email successfully verify, Now your account is ready to go.');
				redirect(base_url().'user/login.html');
			}
			elseif($user->mm_status == '1' )
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'Your email already verifed.');
				redirect(base_url().'user/login.html');
			}
		}
		else
		{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'Invalide or Expired link');
				redirect(base_url().'user/login.html');
		}
		
	}
	
	function get_city($state_id,$city_id='')
	{
		
		$get_cities = $this->dbuser->cities($state_id);
		
		$html = '<select class="input-xlarge" name="mm_city_id" id="mm_city_id"><option>Select City</option>';
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
	
	function invitation()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			redirect(base_url('user/login.html'));
		}
		
		$data['user'] = $this->dbheader->user_details($login);
		
		$data['invitations'] = $this->dbuser->user_invitations($data['user']->mm_id);
		
		$data['title'] = 'Invitation';
		$data['sub_title'] = 'Manage your event invitation.';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('user_invitation',$data);
	}
	
	function invitation_details()
	{
		$this->form_validation->set_rules('page_comments', 'Comment Required', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		$event_id = $this->uri->segment(3);
		$unique_key = $this->uri->segment(4);
		
		$data['user'] = $this->dbuser->get_user_by_event_unique($event_id,$unique_key);
		$data['invitations'] = $this->dbuser->get_invitation($event_id,$unique_key,$data['user']->mm_id);
		
		if ($this->form_validation->run() == TRUE)
		{
			$dataB=array(
				'msg'=>$this->input->post('page_comments'),
				'msg_time'=>date('Y-m-d H:i:s'),
				'msg_frm'=>$data['invitations']->mm_id,
				'msg_to_ch_id'=>$data['invitations']->event_ch_id,
				'event_id'=>$data['invitations']->event_id,
				'ei_id'=>$data['invitations']->ei_id
				);
			$resultB=$this->dbuser->insert_event_inv_msg($dataB);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Message successfully sent to admin');
			redirect($this->uri->uri_string());
		}
		
		$event_id = $this->uri->segment(3);
		$unique_key = $this->uri->segment(4);
		
		if($data['user'])
		{
			$data['title'] = 'Invitation';
			$data['sub_title'] = 'Manage your event invitation.';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('user_invitation_details',$data);
		}
		else
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'Invalide Invitation Link!');
			redirect(base_url().'info/welcome.html');
		}
		
		if($this->uri->segment(5) == 'maybe')
		{
			$dataA=array(
			'mm_id'=>$data['invitations']->mm_id,
			'event_id'=>$data['invitations']->event_id,
			'isrsvp'=>1,
			'status_id'=>2,
			'rsvp_time'=>date('Y-m-d H:i:s')
			);
			$resultA=$this->dbuser->update_rsvp($dataA,$data['invitations']->ei_id);
		}
		if($this->uri->segment(5) == 'no')
		{
			$data=array(
			'mm_id'=>$data['invitations']->mm_id,
			'event_id'=>$data['invitations']->event_id,
			'isrsvp'=>1,
			'status_id'=>3,
			'rsvp_time'=>date('Y-m-d H:i:s')
			);
			$result=$this->dbuser->update_rsvp($data,$data['invitations']->ei_id);
		}
	}
	
	function rsvp()
	{
		$data=array(
		'mm_id'=>$this->input->post('mm_id'),
		'event_id'=>$this->input->post('event_id'),
		'isrsvp'=>1,
		'status_id'=>1,
		'adult_count'=>$this->input->post('adults'),
		'kids_count'=>$this->input->post('child'),
		'rsvp_by_mm_id'=>$this->input->post('mm_id'),
		'rsvp_time'=>date('Y-m-d H:i:s')
		);
		$result=$this->dbuser->update_rsvp($data,$this->input->post('ei_id'));
		
		$get_relationship = $this->dbuser->get_relationship($this->input->post('mm_id'));
		if($get_relationship)
		{
			foreach($get_relationship as $get_relationship_row)
			{
				$dataC=array(
				'mm_id'=>$get_relationship_row->mm_id,
				'event_id'=>$this->input->post('event_id'),
				'isrsvp'=>1,
				'status_id'=>1,
				'rsvp_by_mm_id'=>$this->input->post('mm_id'),
				'rsvp_time'=>date('Y-m-d H:i:s')
				);
				$resultC=$this->dbuser->update_rsvp_family($dataC,$get_relationship_row->mm_id,$this->input->post('event_id'));
			}
		}
		
		if($this->input->post('comments') !='')
		{
		$dataB=array(
		'ei_id'=>$this->input->post('ei_id'),
		'event_id'=>$this->input->post('event_id'),
		'msg'=>$this->input->post('comments'),
		'msg_frm'=>$this->input->post('mm_id'),
		'msg_to_ch_id'=>$this->input->post('event_ch_id'),
		'msg_time'=>date('Y-m-d H:i:s')
		);
		$resultB=$this->dbuser->insert_event_inv_msg($dataB);
		}
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Thanks for your RSVP!');
		
		if($result) { echo 'ok'; } else { echo 'error';}
	}
	
	function account()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			redirect(base_url('user/login.html'));
		}
		
		$data['user'] = $this->dbheader->user_details($login);
		
		if($data['user'])
		{
			$data['title'] = $this->lang->line('text_account_title');
			$data['sub_title'] = $data['user']->mm_fname.' '.$data['user']->mm_lname;
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('user_account',$data);
		}
		else
		{
			$this->session->unset_userdata('user_email');
			header("location: ".base_url()."user/login.html");
		}
	}
	
	function logout()
	{
		$this->session->unset_userdata('user_email');
		header("location: ".base_url()."user/login.html");
	}
	
}