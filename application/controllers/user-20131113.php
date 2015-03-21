<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
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
		$data['ads'] = $this->dbheader->get_ads_for_general();
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
		$data['ads'] = $this->dbheader->get_ads_for_general();
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

		$data['ads'] = $this->dbheader->get_ads_for_general();
		
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

				///update pradip 2013/10/29
					
				if($user->mm_state_id !='' || $user->mm_state_id !='0')
				{
					$state_id = $this->dbuser->get_ch_id_from_state_id($user->mm_state_id);
					$ch_seo = $this->dbuser->get_ch_seo($state_id->ch_id);
					redirect(base_url('chapter/'.$ch_seo->ch_seo.'.html'));
				}
				else
				{
					redirect(base_url('chapter/national.html'));
				}
				
				//end
				
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
	function checkemail1($str)
	{
		
		if($str!='')
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
		
		
	}
	function register()
	{
		$settings = $this->dbheader->get_setting();
		
		$login = $this->session->userdata('user_email');
		
		$data['ads'] = $this->dbheader->get_ads_for_general();

		if($login)
		{
			$data['user'] = $this->dbheader->user_details($login);
			if($this->uri->segment(2)!='add_family_member')
			$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'valid_email|xss_clean|callback_checkemail');
			else
			$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'valid_email|xss_clean|callback_checkemail1');
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
				'mm_username'=>friendlyURL_user($this->input->post('mm_username')),
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
					  	$admin_email_id='';
						$MESSAGE_BODY='';
					  	$ch_id=$this->input->post('mm_state_id');
						$ch_email=$this->dbuser->fetch_ch_email($ch_id);
						$admin_email=$this->dbuser->get_admin_id();
						$admin_email_id=$admin_email->email;
						/*print_r($admin_email_id);	
						print_r($ch_email->mm_email);	
						exit;*/
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
								//$this->email->to(trim('test6.capital@gmail.com'));
								$this->email->subject( $this->input->post('mm_username').' Registered with your Chapter');
								
								$final_message = array(
														   'name' => $this->input->post('mm_fname').' '. $this->input->post('mm_lname'),
															'mm_username' => friendlyURL_user($this->input->post('mm_username')),
															'mm_email'=>$this->input->post('mm_email'),
															'mm_hphone'=>$this->input->post('mm_hphone')
													);
								
								
								
								$this->email->message($this->parser->parse('register_parser_for_admin', $final_message , TRUE));
								
								$this->email->send();
							}
							
							if($admin_email_id != '')
							{
								$email = $settings->email;
								$mail_id = $admin_email_id;
						
								$config['mailtype'] = 'html';
								$this->email->initialize($config);
					
								$this->email->from($settings->email);
								$this->email->to(trim($mail_id));
								//$this->email->to(trim('test6.capital@gmail.com'));
								$this->email->Subject( $this->input->post('mm_username').' Registered' );
								
								$final_message = array(
														   'name' => $this->input->post('mm_fname').' '. $this->input->post('mm_lname'),
															'mm_username' => friendlyURL_user($this->input->post('mm_username')),
															'mm_email'=>$this->input->post('mm_email'),
															'mm_hphone'=>$this->input->post('mm_hphone')
													);
								
								$this->email->message($this->parser->parse('register_parser_for_admin', $final_message , TRUE));
								
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
						
						$final_message = array('name' => $this->input->post('mm_fname'), 'site_email' => $settings->email, 'user_email' => $this->input->post('mm_email'),'sitename'=>$settings->sitename,'seq_code'=>$random,'username'=>friendlyURL_user($this->input->post('mm_username')));
						
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
		$data['ads'] = $this->dbheader->get_ads_for_general();
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

				//update pradip 2013/11/11
				if($data['user']->mm_family_id == 0)
				{
					
					
					$dataC=array(
									'mm_state_id'=>$this->input->post('mm_state_id'),
									'mm_city_id'=>$this->input->post('mm_city_id')
						
						 );
					$get_child = $this->dbuser->get_child($data['user']->mm_id);
					foreach($get_child as $child)
					{
						$resultC=$this->dbuser->update($dataC,$child->mm_id);
					
					}
					
				
				}
				
				//end

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
		$data['ads'] = $this->dbheader->get_ads_for_general();

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
		//var_dump($data['invitations']->ei_id);
		//$data['ads'] = $this->dbheader->get_ads_for_general();
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
			redirect(base_url().'user/invitation_details/'.$event_id.'/'.$unique_key);
		}
		if($this->uri->segment(5) == 'no')
		{
			$dataT=array(
			'mm_id'=>$data['invitations']->mm_id,
			'event_id'=>$data['invitations']->event_id,
			'isrsvp'=>1,
			'status_id'=>3,
			'rsvp_time'=>date('Y-m-d H:i:s')
			);
			//var_dump($data);
			//var_dump($data['invitations']->ei_id);
			$result=$this->dbuser->update_rsvp($dataT,$data['invitations']->ei_id);
			redirect(base_url().'user/invitation_details/'.$event_id.'/'.$unique_key);
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
		$data['ads'] = $this->dbheader->get_ads_for_general();
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
		
		$data['ads'] = $this->dbheader->get_ads_for_general();

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
		//update start ketan 201306281152
		$this->session->unset_userdata('user_id');
		//end
		header("location: ".base_url()."user/login.html");
	}
	///////////////pradip changes for newsletter 201307090320 ///////////////////
	
	function newsletter()
	{

		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		
		$num_rec = $this->dbuser->count_all_subscribe_newsletter($login);
		
		if($num_rec)
		{
			
			$this->load->library('pagination');
			
			$config['base_url'] = base_url().'user/newsletter.html';
			$config['total_rows'] = $num_rec;
			$config['per_page'] = 20;
			$config['uri_segment'] = 4;
			$config['num_links'] = 4;
			$config['use_page_numbers'] = TRUE;
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
				if(is_numeric($this->uri->segment(4)))
				{
					$segment = ($this->uri->segment(4)-1)*$config['per_page'];
				}
				else
				{
					$segment  = 0;
				}
				
			}
			
			$data['query'] = $this->dbuser->get_all_subscribe_newsletter($segment,$config['per_page'],$login);
			
			$this->pagination->initialize($config);
		}
		else
		{
			$data['query'] = '';
		}
			$data['title'] = 'Newsletter Management';
			//$data['sub_title'] = 'Add/Edit/Delete News';
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('user_newsletter',$data);
	}
	
	function unsubscribe_newsletter()
	{
		$id = $this->uri->segment(3);
		$subject = $this->uri->segment(4);
		
		$result=$this->dbuser->delete_newsletter($id);
		
		
		$string = str_replace("%20", " ", $subject);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'you have successfully unsubscribed to <span style="color:blue">'.$string.'</span> newsletter');

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url().'user/newsletter.html');
			}
	}
	/*edit*/
	function needtochange()
	{
		$login = $this->session->userdata('user_email');
		$data['ads'] = $this->dbheader->get_ads_for_general();
		if(!$login)
		{
			redirect(base_url('user/login.html'));
		}
		$data['user'] = $this->dbheader->user_details($login);
		$is_fam = 0;
		
		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');
		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');
		$this->form_validation->set_rules('mm_city_id', $this->lang->line('text_city'), 'required');
		$this->form_validation->set_rules('mm_state_id', $this->lang->line('text_state'), 'required');
		$this->form_validation->set_rules('mm_address', 'Address', 'required');
		
		$this->form_validation->set_rules('mm_username', $this->lang->line('text_username'), 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditUsername');
		$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required');
		
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
				//'mm_hphone'=>$this->input->post('mm_hphone'),
				//'mm_cphone'=>$this->input->post('mm_cphone'),
				'mm_username'=>$this->input->post('mm_username'),
				'mm_birth_month'=>$this->input->post('mm_birth_month'),
				'mm_birth_year'=>$this->input->post('mm_birth_year'),
				'mm_gender'=>$this->input->post('mm_gender'),
				//'occupation_id'=>$this->input->post('occupation_id'),
				//'edu_qualification'=>$this->input->post('edu_qualification'),
				//'univercity_college_name'=>$this->input->post('univercity_college_name'),
				//'mm_life_id'=>$this->input->post('mm_life_id'),
				//'mm_photo'=>$filename,
				'mm_modify'=>date('Y-m-d'),
				//'mm_disp_dir'=>$mm_disp_dir,
				//'mm_disp_birth'=>$mm_disp_birth,
				//'mm_father_name'=>$this->input->post('mm_father_name'),
				//'mm_original_surname'=>$this->input->post('mm_original_surname'),
				//'mm_mother_maiden_name'=>$this->input->post('mm_mother_maiden_name'),
				//'mm_hometown'=>$this->input->post('mm_hometown')
				);
				$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);
				
				if($this->input->post('mm_password') !='')
				{
					$dataB=array(
					'mm_password'=>md5($this->input->post('mm_password'))
					);
					$resultB=$this->dbuser->update($dataB,$data['user']->mm_id);
				}
				if($this->uri->segment(2)=='needtochange')
				{
					$settings = $this->dbheader->get_setting();
					$address = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));
					if($address)
					{						
						
						$emailData->family='';
						$get_relationship = $this->dbuser->get_relationship($address->mm_id);
						if(!$get_relationship)
						{
							$get_relationship = $this->dbuser->get_relationship_sub($address->mm_family_id,$address->mm_id);
						}
						$emailData->family = '<table width="980" border="0" cellspacing="0" cellpadding="0"> 
						  <tr>
							<td>
								<div>
										<h1><b><u>Family Members<u></b><br></h1>
								</div>
								
								<table  border="1" cellspacing="0" cellpadding="0"  width="auto">
									<thead>
										<tr>
											<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Name</th>
										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Username</th>
										<th scope="col" style="text-align:center; width:90px;padding-right:10px;">Relationship</th>
										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Email-id</th>
										 <th scope="col" style="text-align:center; width:90px;">Date of Birth<br>(MM/YY)</th>
											<th scope="col" style="text-align:center; width:90px;padding-right:10px;">Edit</th>
										</tr>
									</thead>
									<tfoot>
										
									</tfoot> 
									<tbody cellspacing="0" cellpadding="0" >';
						foreach($get_relationship as $get_relationship_row)
						{
						$emailData->family .= '<tr>
										<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_fname." ".$get_relationship_row->mm_lname.'</td>
										<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_username.'</td>
										<td style="text-align:left; padding-left:10px;padding-right:10px;">';
										if($address->mm_relationship == 'Son' || $address->mm_relationship == 'Daughter')
									{
										if($get_relationship_row->mm_relationship == 'Wife' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '1'))
										{
											$emailData->family .= 'Mother';
										}
										if($get_relationship_row->mm_relationship == 'Husband' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '0') )
										{
											$emailData->family .= 'Father';
										}
										if($get_relationship_row->mm_relationship == 'Son')
										{
											$emailData->family .= 'Brother';
										}
										if($get_relationship_row->mm_relationship == 'Daughter')
										{
											$emailData->family .= 'Sister';
										}
									}
									
									if($address->mm_relationship == 'Wife')
									{
										if($get_relationship_row->mm_relationship == '')
										{
											$emailData->family .= 'Husband';
										}
										if($get_relationship_row->mm_relationship == 'Son')
										{
											$emailData->family .= 'Son';
										}
										if($get_relationship_row->mm_relationship == 'Daughter')
										{
											$emailData->family .= 'Daughter';
										}
									}
									
									if($address->mm_relationship == '')
									{
										if($get_relationship_row->mm_relationship == 'Wife')
										{
											$emailData->family .= 'Wife';
										}
										if($get_relationship_row->mm_relationship == 'Husband')
										{
											$emailData->family .= 'Husband';
										}
										if($get_relationship_row->mm_relationship == 'Daughter')
										{
											$emailData->family .= 'Daughter';
										}
										if($get_relationship_row->mm_relationship == 'Son')
										{
											$emailData->family .= 'Son';
										}
									}
									$emailData->family .= '
									</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_email.'</td>
									<td style="text-align:left; padding-left:10px;">'.$get_relationship_row->mm_birth_month."/".$get_relationship_row->mm_birth_year.'</td>
									<td style="text-align:left; padding-right:10px;"><center><a href="'.base_url().'user/verify_edit_family_meber/'.$address->mm_seq.'/'.$address->mm_username.'/'.$get_relationship_row->mm_id.'">Edit Profile</a></center></td>
									</tr>';
						
							}
							$emailData->family .= '
									
									</tbody>
								</table>
							</td>
							</tr>
						</table>';
							$userinfo = '<table width="auto" border="0" cellspacing="0" cellpadding="0"> 
					  				<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Username :</b>'.$address->mm_username.'</td></tr>
									
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Password :</b>'.$this->input->post('mm_password').'</td></tr>
									<tr>&nbsp;</tr>
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Name :</b>'.$address->mm_fname." ".$address->mm_lname.'</td></tr>
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Email :</b>'.$address->mm_email.'</td></tr>
								  	<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>DOB :</b>'.$address->mm_birth_month."/".$address->mm_birth_year.'</td></tr>
					</table>';
							$config['mailtype'] = 'html';
							$this->email->initialize($config);
				
							$this->email->from($settings->email);
							$this->email->to($address->mm_email);
							
							$this->email->subject('Your Information successfully Changed for '.$settings->sitename);
							
							$final_message = array('fullname' =>$address->mm_fname." ".$address->mm_lname,'username' =>$address->mm_username,'code' =>$address->mm_seq,'email' =>$address->mm_email,'familymember' =>$emailData->family,'sitename'=>$settings->sitename,'status'=>'Changing','userinfo' => $userinfo,'subject' => 'Your Information successfully Changed for '.$settings->sitename,'segment_data' => 'verifydata');
							
							$this->email->message($this->parser->parse('parser_for_verify', $final_message , TRUE));
							
							$email_sent = $this->email->send();
							
							if($email_sent==1)
							{
							
							  $status=2;
							  $resultC=$this->dbuser->verify_profile($status,$address->mm_id,$this->uri->segment(5));
							
							
								if($resultC)
								{
									$this->session->set_flashdata('message_type', 'success');
									$this->session->set_flashdata('status_','Changes saved successfully');
									
									redirect(base_url().'user/account.html');
								}
							}
							else
							{
								$this->session->set_flashdata('message_type', 'error');
								$this->session->set_flashdata('status_', 'Invalide or Expired link');
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
			}
			$data['title'] = 'Need to change User information';
			$data['sub_title'] = $this->lang->line('text_edit_profile_sub_title');
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('verify',$data);
	}
	function verifydata()
	{
				$this->session->unset_userdata('user_email');			
				$this->session->unset_userdata('user_id');
				$settings = $this->dbheader->get_setting();
				$address = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));
				if($address)
				{						
					
					$emailData->family='';
					$get_relationship = $this->dbuser->get_relationship($address->mm_id);
					if(!$get_relationship)
					{
						$get_relationship = $this->dbuser->get_relationship_sub($address->mm_family_id,$address->mm_id);
					}
					$emailData->family = '<table width="980" border="0" cellspacing="0" cellpadding="0"> 
					  <tr>
					  	<td>
							<div>
							        <h1><b><u>Family Members<u></b><br></h1>
							</div>
					        
							<table  border="1" cellspacing="0" cellpadding="0"  width="auto">
								<thead>
									<tr>
										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Name</th>
										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Username</th>
										<th scope="col" style="text-align:center; width:90px;padding-right:10px;">Relationship</th>
										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Email-id</th>
										 <th scope="col" style="text-align:center; width:90px;">Date of Birth<br>(MM/YY)</th>
										<th scope="col" style="text-align:center; width:90px;padding-right:10px;">Edit</th>
									</tr>
								</thead>
								<tfoot>
									
								</tfoot> 
								<tbody cellspacing="0" cellpadding="0" >';
					foreach($get_relationship as $get_relationship_row)
					{
					$emailData->family .= '<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_fname." ".$get_relationship_row->mm_lname.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_username.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">';
									if($address->mm_relationship == 'Son' || $address->mm_relationship == 'Daughter')
								{
									if($get_relationship_row->mm_relationship == 'Wife' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '1'))
									{
										$emailData->family .= 'Mother';
									}
									if($get_relationship_row->mm_relationship == 'Husband' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '0') )
									{
										$emailData->family .= 'Father';
									}
									if($get_relationship_row->mm_relationship == 'Son')
									{
										$emailData->family .= 'Brother';
									}
									if($get_relationship_row->mm_relationship == 'Daughter')
									{
										$emailData->family .= 'Sister';
									}
								}
								
								if($address->mm_relationship == 'Wife')
								{
									if($get_relationship_row->mm_relationship == '')
									{
										$emailData->family .= 'Husband';
									}
									if($get_relationship_row->mm_relationship == 'Son')
									{
										$emailData->family .= 'Son';
									}
									if($get_relationship_row->mm_relationship == 'Daughter')
									{
										$emailData->family .= 'Daughter';
									}
								}
								
								if($address->mm_relationship == '')
								{
									if($get_relationship_row->mm_relationship == 'Wife')
									{
										$emailData->family .= 'Wife';
									}
									if($get_relationship_row->mm_relationship == 'Husband')
									{
										$emailData->family .= 'Husband';
									}
									if($get_relationship_row->mm_relationship == 'Daughter')
									{
										$emailData->family .= 'Daughter';
									}
									if($get_relationship_row->mm_relationship == 'Son')
									{
										$emailData->family .= 'Son';
									}
								}
								$emailData->family .= '
								</td>
								<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_email.'</td>
								<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_birth_month."/".$get_relationship_row->mm_birth_year.'</td>
								<td style="text-align:left;padding-right:10px;"><center><a href="'.base_url().'user/verify_edit_family_meber/'.$address->mm_seq.'/'.$address->mm_username.'/'.$get_relationship_row->mm_id.'">Edit Profile</a></center></td>
								
								</tr>';
					
						}
						$emailData->family .='
								
								</tbody>
							</table>
						</td>
						</tr>
					</table>';
						$userinfo = '<table width="auto" border="0" cellspacing="0" cellpadding="0"> 
					  				<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Username :</b>'.$address->mm_username.'</td></tr>
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Password :</b>'.$this->uri->segment(6).'</td></tr>
									<tr>&nbsp;</tr>
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Name :</b>'.$address->mm_fname." ".$address->mm_lname.'</td></tr>
									<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Email :</b>'.$address->mm_email.'</td></tr>
								  	<tr><td style="text-align:left; padding-left:10px;padding-right:10px;"><b>DOB :</b>'.$address->mm_birth_month."/".$address->mm_birth_year.'</td></tr>
					</table>';
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
			
						$this->email->from($settings->email);
						$this->email->to($address->mm_email);
						
						$this->email->subject('Your Information successfully verified for '.$settings->sitename);
						
						$final_message = array('fullname' =>$address->mm_fname." ".$address->mm_lname,'username' =>$address->mm_username,'code' =>$address->mm_seq,'email' =>$address->mm_email,'familymember' =>$emailData->family,'sitename'=>$settings->sitename,'status'=>'verifying','userinfo' => $userinfo,'subject' => 'Your Information successfully verified for '.$settings->sitename,'segment_data' => 'verifydata');
						
						$this->email->message($this->parser->parse('parser_for_verify', $final_message , TRUE));
						
						$email_sent = $this->email->send();
						
						if($email_sent==1)
						{
						
						  $status=1;
						  $resultC=$this->dbuser->verify_profile($status,$address->mm_id,$this->uri->segment(5));
							if($resultC)
							{
								$this->session->set_flashdata('message_type', 'success');
								$this->session->set_flashdata('status_', 'Thank you for verifying your information.<br>
A confirmation email has been sent to your email address.<br>');
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
				else
				{
						$this->session->set_flashdata('message_type', 'error');
						$this->session->set_flashdata('status_', 'Invalide or Expired link');
						redirect(base_url().'user/login.html');
				}
	}
	function verify_info()
	{
				$data['ads'] = $this->dbheader->get_ads_for_general();
				$user = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));
				$this->session->set_userdata('user_email',$user->mm_email);
				
				$data=array(
					'mm_id'=>$user->mm_id,
					'ip'=>$this->input->ip_address(),
					'browser'=>$this->input->user_agent(),
					'date_time'=>date('Y-m-d H:i:s')
					);
					$result=$this->dbuser->insert_log($data);
				
				$this->session->set_userdata('user_id',$user->mm_id);
				redirect(''.base_url().'user/needtochange/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5));
	}
	function verify_edit_family_meber()
	{
				$data['ads'] = $this->dbheader->get_ads_for_general();
				$user = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));
				$this->session->set_userdata('user_email',$user->mm_email);
				
				$data=array(
					'mm_id'=>$user->mm_id,
					'ip'=>$this->input->ip_address(),
					'browser'=>$this->input->user_agent(),
					'date_time'=>date('Y-m-d H:i:s')
					);
					$result=$this->dbuser->insert_log($data);
				
				$this->session->set_userdata('user_id',$user->mm_id);
				redirect(''.base_url().'user/edit_profile_family/'.$this->uri->segment(5));
	}
	public function verifyinfo()
	{
		$data['ads'] = $this->dbheader->get_ads_for_general();
		//$this->form_validation->set_rules('username',$this->lang->line('text_username'),'required');
		$this->form_validation->set_rules('txtcpass',$this->lang->line('text_current_password'),'required|callback_checkcurrentpwd');
		$this->form_validation->set_rules('txtncpass',$this->lang->line('text_new_password'),'required|matches[txtrncpass]');
		$this->form_validation->set_rules('txtrncpass',$this->lang->line('text_confirm_password'),'required');
		$this->form_validation->set_error_delimiters('', '');
		
		if($this->form_validation->run()==FALSE)
		{
			$data['title']='Verify Information';
			$data['msg']="";
			$this->load->view('change_pass',$data);
		}
		else
		{
			$user = $this->dbheader->verify_user($this->uri->segment(3),$this->uri->segment(4));
			$data=array('mm_password'=>md5($this->input->post('txtncpass')));
			$this->dbuser->update($data,$user->mm_id);
			
			redirect(base_url().'user/verifydata/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.
$this->input->post('txtncpass'));
		}
	}

	public function checkcurrentpwd($str)
	{
		$abc=$this->dbuser->qur($str);
		
		if($abc)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('checkcurrentpwd', '%s Is Wrong');
			return FALSE;
		}
	}
	
	///////////////////////end//////////////////////////////////////
	/*pradip*/
	function delete_profile()
	{
		$id = $this->uri->segment(3);
		$subject = $this->uri->segment(4);
		
		$result=$this->dbuser->delete_profile($id);
		
		$string = str_replace("%20", " ", $subject);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'you have successfully deleted <span style="color:blue">'.$string.'</span> profile');

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url().'user/account.html');
			}
	}
	/*pradip*/
	/*ketan*/
	function edit_profile_family()
	{
		$login = $this->session->userdata('user_email');
		$data['ads'] = $this->dbheader->get_ads_for_general();
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
			redirect(base_url().'user/account.html');
		}
		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');
		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');
		$this->form_validation->set_rules('mm_city_id', $this->lang->line('text_city'), 'required');
		$this->form_validation->set_rules('mm_state_id', $this->lang->line('text_state'), 'required');
		
		$this->form_validation->set_rules('mm_username', $this->lang->line('text_username'), 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditUsername');
		
		$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'max_length[40]|xss_clean|callback__checkEditEmailfamily');
		
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
		$this->load->view('user_edit_profile_family',$data);
	}
	/*ketan*/
	
}