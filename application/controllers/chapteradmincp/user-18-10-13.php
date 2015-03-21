<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('get_chapter_id');
		

		

		$this->load->model('chapteradmincp/dbuser');

		$this->load->model('chapteradmincp/dbadminheader');
		
		$this->load->library('email');
		$this->load->library('parser');

		

		if($login=='')

		{

			redirect(base_url().'chapteradmincp/login');

		}

		

	}

	

	public function index()

	{	

		$this->view();

	}

	

	function online()

	{

		if($this->online_users->get_online())

		{

			$data['query'] = $this->online_users->get_online();

		}

		

		$data['title']="Online Members";		

		$this->load->view('chapteradmincp/user/online',$data);

		

	}

	

	//////////////////////////////pradip changes for manage user///////////////////

	public function view()

	{
		$this->session->unset_userdata('member_type');
		$this->session->unset_userdata('member_search');
		if(isset($_POST['member_type']))
		{
			$member_type = $_POST['member_type'];
			$data['member_type'] = $_POST['member_type'];
			$this->session->set_userdata('member_type',$_POST['member_type']);
		}
		else
		{
			if($this->session->userdata('member_type'))
			{
				$member_type = $this->session->userdata('member_type');
				$data['member_type'] = $this->session->userdata('member_type');
			}
			else
			{
				$member_type = 0;
				$data['member_type'] = 0;
			}
			
		}
		if(isset($_POST['member_search']))
		{
			$member_search = $_POST['member_search'];
			$data['member_search'] = $_POST['member_search'];
			$this->session->set_userdata('member_search',$_POST['member_search']);
		}
		else
		{
			if($this->session->userdata('member_search'))
			{
				$member_search = $this->session->userdata('member_search');
				$data['member_search'] = $this->session->userdata('member_search');
			}
			else
			{
				$member_search = '';
				$data['member_search'] = '';
			}
			
		}
		/*$search_world = $this->input->get('search');

		$mm_type = $this->input->get('mm_type');*/

		

		$chapter_id = $this->session->userdata('get_chapter_id');

			if($member_type == '0')
			{
				$data['query'] = $this->dbuser->get_all_user_search_ketan($chapter_id,$member_search);
			}
			
			if($member_type == '1')
			{
				$data['query'] = $this->dbuser->get_all_user_search_verified_ketan($chapter_id,$member_search);
				
			}
			
			if($member_type == '2')
			{
				$data['query'] = $this->dbuser->get_all_user_search_unverified_ketan($chapter_id,$member_search);
				
			}
		//var_dump(count($data['query']));
		$data['title']="Manage Members";		

		$this->load->view('chapteradmincp/user/view',$data);

	}

	function edit($id)

	{

		$data['user'] = $this->dbuser->get_user($id);

		

		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');

		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');

		$this->form_validation->set_rules('mm_city_id', $this->lang->line('text_city'), 'required');

		$this->form_validation->set_rules('mm_state_id', $this->lang->line('text_state'), 'required');

		

		$this->form_validation->set_rules('mm_username', 'Username', 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditUsername');

		

		$this->form_validation->set_rules('mm_email', 'Email', 'required|max_length[40]|min_length[3]|xss_clean|callback__checkEditEmail');

		

		if($this->input->post('mm_password') !='')

		{

			$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|min_length[6]|xss_clean');

		}

		

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

				'mm_status'=>$this->input->post('mm_status'),

				'mm_photo'=>$filename,

				'mm_modify'=>date('Y-m-d'),

				'mm_disp_dir'=>$mm_disp_dir,

				'mm_disp_birth'=>$mm_disp_birth

				);

				$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);

				

				

			if($this->input->post('mm_password') !='')

			{

				$dataB=array(

				'mm_password'=>md5($this->input->post('mm_password'))

				);

				$this->dbuser->update($dataB,$data['user']->mm_id);

			}

			

			if($this->input->post('chapter') != 0)

			{

				$dataC=array(

				'mm_chapter_id'=>$this->input->post('chapter'),

				'mm_type'=>1

				);

				$this->dbuser->update($dataC,$data['user']->mm_id);

			}

			else

			{

				$dataC=array(

				'mm_chapter_id'=>0,

				'mm_type'=>0

				);

				$this->dbuser->update($dataC,$data['user']->mm_id);

			}

			

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', $this->lang->line('misc_success_saved'));

								

				redirect(base_url().'chapteradmincp/user.html');

		}

		

			$data['title'] = $this->lang->line('text_edit_profile_title');

			$data['sub_title'] = $this->lang->line('text_edit_profile_sub_title');

			$data['description'] = "";

			$data['keywords'] = "";

			$this->load->view('chapteradmincp/user/edit',$data);

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

	

	function get_city($state_id,$city_id='')

	{

		

		$get_cities = $this->dbadminheader->cities($state_id);

		

		$html = '<select class="input-xlarge" name="mm_city_id" id="mm_city_id"><option>Select City</option>';

		foreach($get_cities as $get_cities_row)

		{

			if($city_id == $get_cities_row->city_id)

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

	

	public function delete($id)

	{

		$result=$this->dbuser->delete($id);

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));



		if ($this->agent->is_referral())

			{

				redirect($this->agent->referrer());

			}

			else

			{

				redirect(base_url('chapteradmincp/categories/view'));

			}

	}

	

	

	/*public function status()

	{

		$search_world = $this->input->get('search');

		$mm_type = $this->input->get('mm_type');

		

		$chapter_id = $this->session->userdata('get_chapter_id');

		

		if($search_world || $mm_type !='')

		{

			if($mm_type == '0')

			{

				$num_rec=$this->dbuser->count_user_search($search_world);

			}

			if($mm_type == '1')

			{

				$num_rec=$this->dbuser->count_user_search_assign($search_world);

			}

			if($mm_type == '2')

			{

				$num_rec=$this->dbuser->count_user_search_unassign($search_world);

			}

		}

		else

		{

			$num_rec=$this->dbuser->count_user($chapter_id);

		}

		

		$data['tot_rec'] = $num_rec;

		

		$this->load->library('pagination');

		

		$config['base_url'] = base_url().'chapteradmincp/user/status/';

		$config['total_rows'] = $num_rec;

		$config['per_page'] = 40;

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

		

		$data['query'] = $this->dbuser->get_all_user($chapter_id,$config['per_page'],$segment);

		

		

		

		

		$this->pagination->initialize($config);

		

		$data['title']="Manage Members";		

		$this->load->view('chapteradmincp/user/status',$data);

	}*/

	

	function status($id)

	{

		$data['user'] = $this->dbuser->get_user($id);

		if($data['user']->mm_varify=='0')

		{

			$dataA=array('mm_varify'=>'1','mm_status'=>'1');

			$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);

		}

		else

		{

			$dataA=array('mm_varify'=>'0','mm_status'=>'0');

			$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);

		}

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_saved'));

								

		redirect(base_url().'chapteradmincp/user.html');

		

	}

	//////////////////////////////////////////end//////////////////////////////////////

	

	///////////////////////pradip changes for login_history 201307181700 //////////////////

		

		function login_history()

		{

			

			$chapter_id = $this->session->userdata('get_chapter_id');

			

			$num_rec=$this->dbuser->count_all_ch_history($chapter_id);

			

			$data['tot_rec'] = $num_rec;

			

			$this->load->library('pagination');

			

			$config['base_url'] = base_url().'chapteradmincp/user/login_history/';

			$config['total_rows'] = $num_rec;

			$config['per_page'] = 40;

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

			$this->pagination->initialize($config);

			$data['query'] = $this->dbuser->get_all_ch_history($chapter_id,$config['per_page'],$segment);

			

			$data['title'] = 'Member Login History';

			$data['sub_title'] = '';

			$data['description'] = "";

			$data['keywords'] = "";

			$this->load->view('chapteradmincp/user/login_history',$data);

		}

	

	/////////////////////////////end//////////////////////////////
	
	
	//////////////////////////////////////pradip changes for add family members 201308011100////////////////////////
	
	function add_user_family_member()
	{
		$this->load->model('dbheader');
		$settings = $this->dbadminheader->getsettings();
		
		$data['user'] = $this->dbadminheader->user_detail($this->session->userdata('get_chapter_id'));
		
		
		
		$data['mm_family_id'] = $this->uri->segment(4);
		
		$this->form_validation->set_rules('mm_email', $this->lang->line('text_email'), 'valid_email|xss_clean|callback_checkemail');
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
					$data['mm_family_id'] = $this->uri->segment(4);
					
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
				
				if(isset($data['user']))
				{
					
					
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', $this->lang->line('misc_success_family_register'));
					redirect(base_url().'chapteradmincp/user/view');
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
					redirect(base_url().'chapteradmincp/login');
					
				}
						
				$data=array(
					'mm_id'=>$new_mm_id,
					'ip'=>$this->input->ip_address(),
					'browser'=>$this->input->user_agent(),
					'date_time'=>date('Y-m-d H:i:s')
					);
					$result=$this->dbuser->insert_log($data);
				
				
				
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
			
			$this->load->view('chapteradmincp/user/register',$data);
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
	
	/////////////////////////////////////end//////////////////////////////////////////////////

	

	//pradip changes for newsletter 201307081100///////////////

		function newsletter()

		{

			$num_rec=$this->dbuser->count_newsletter();

			

			$this->load->library('pagination');

			

			$config['base_url'] = base_url().'chapteradmincp/user/newsletter/';

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

			

			$data['query'] = $this->dbuser->get_all_newsletter($config['per_page'],$segment);

			

			$this->pagination->initialize($config);

			

			$data['title'] = 'Newsletter';		

			$this->load->view('chapteradmincp/user/newsletter',$data);



		}

		

		function add_newsletter()

		{

			$this->form_validation->set_rules('subject', 'Subject', 'required');

			$this->form_validation->set_rules('html', 'Message', 'required');

			$this->form_validation->set_rules('queued', 'Status', 'required');

			$this->form_validation->set_rules('newsletter_status', 'Newsletter Status', 'required');			

			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

			

			if ($this->form_validation->run() == FALSE)

			{

				

			}

			else

			{

				

				$data=array(

					'created'=>date('Y-m-d H:i:s'),

					'subject'=>$this->input->post('subject'),

					'template_id'=>$this->input->post('newsletter_template_name'),

					'html'=>$this->input->post('html'),

					'newsletter_status'=>$this->input->post('newsletter_status'),

					'queued'=>$this->input->post('queued'),

					'newsletter_created_date'=>$this->input->post('newsletter_created_date'),

					'newsletter_created_by'=>$this->input->post('newsletter_created_by')

					);

				

				

					$chapter_id =  $this->session->userdata('get_chapter_id');

				

					

					$result=$this->dbuser->add_newsletter($data);

					

					

					

					

						$inserted_id = $this->db->insert_id();

						

						$chapter = $this->input->post('chapter');

						

						$chapter_id =  $this->session->userdata('get_chapter_id');

						

									

								$dataB=array(

								'newsletter_id'=>$inserted_id,

								'ch_id'=>$chapter_id

								);

								$resultB=$this->dbadminheader->insert_ch_to_newsletters($dataB);

								

							

						

						

					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', 'Newsletter successfully inserted.');

					

					redirect(base_url().'chapteradmincp/user/newsletter');

	

			}

			

			$data['title'] = 'Newsletter';		

			$this->load->view('chapteradmincp/user/add_newsletter',$data);

		}

		

		/*function edit_newsletter($id)

		{

			$data['item'] = $this->dbuser->get_newsletter_by_id($id);

			

			if(!$data['item']){redirect(base_url().'chapteradmincp/user/newsletter');}

			

			$this->form_validation->set_rules('subject', 'Subject', 'required');

			$this->form_validation->set_rules('html', 'Message', 'required');

			$this->form_validation->set_rules('newsletter_status', 'Newsletter_status', 'required');

			$this->form_validation->set_rules('queued', 'Status', 'required');

			

			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

			

			if ($this->form_validation->run() == FALSE)

			{

				

			}

			else

			{

				

				$data=array(

					'created'=>date('Y-m-d H:i:s'),

					'subject'=>$this->input->post('subject'),

					'template_id'=>$this->input->post('newsletter_template_name'),

					'html'=>$this->input->post('html'),

					'newsletter_status'=>$this->input->post('newsletter_status'),

					'queued'=>$this->input->post('queued')

					);

					$result=$this->dbuser->edit_newsletter($data,$id);

					

					

					

						$chapter = $this->input->post('chapter');

						

						if($chapter)

						{

							for($b=0; $b < count($chapter); $b++)

							{					

								$dataB=array(

								'newsletter_id'=>$id,

								'ch_id'=>$chapter[$b]

								);

								$resultB=$this->dbadminheader->insert_ch_to_newsletters($dataB);

							}

						}

					

					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', 'Newsletter successfully updated.');

					

					redirect(base_url().'chapteradmincp/user/newsletter');

	

			}

			

			$data['title'] = 'Edit Newsletter';		

			$this->load->view('chapteradmincp/user/edit_newsletter',$data);

		}*/

		//added by ketan 20130724

		function edit_newsletter($id)

		{

			$data['item'] = $this->dbuser->get_newsletter_by_id($id);

			

			if(!$data['item']){redirect(base_url().'chapteradmincp/user/newsletter');}

			

			$this->form_validation->set_rules('subject', 'Subject', 'required');

			$this->form_validation->set_rules('html', 'Message', 'required');

			$this->form_validation->set_rules('newsletter_status', 'Newsletter_status', 'required');

			$this->form_validation->set_rules('queued', 'Status', 'required');

			

			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

			

			if ($this->form_validation->run() == FALSE)

			{

				

			}

			else

			{

				

				$data=array(

					'created'=>date('Y-m-d H:i:s'),

					'subject'=>$this->input->post('subject'),

					'template_id'=>$this->input->post('newsletter_template_name'),

					'html'=>$this->input->post('html'),

					'newsletter_status'=>$this->input->post('newsletter_status'),

					'queued'=>0,

					'newsletter_created_date'=>$this->input->post('newsletter_created_date'),

					'newsletter_created_by'=>$this->input->post('newsletter_created_by'),

					'newsletter_modified_date'=>$this->input->post('newsletter_modified_date'),

					'newsletter_modified_by'=>$this->input->post('newsletter_modified_by'),

					'email_template_status'=>0,

					'email_send'=>0,

					'startNum'=>0,

					'stop_mail'=>0

					);

					$result=$this->dbuser->edit_newsletter($data,$id);

					

					

					

						/*$chapter = $this->input->post('chapter');

						

						if($chapter)

						{

							for($b=0; $b < count($chapter); $b++)

							{					

								$dataB=array(

								'newsletter_id'=>$id,

								'ch_id'=>$chapter[$b]

								);

								$resultB=$this->dbadminheader->insert_ch_to_newsletters($dataB);

							}

						}*/

				$dataA=array(

				'queued'=>0

				);

				$this->db->where("newsletter_id", $id);

				$this->db->where("mail_send_status",0);

				$this->db->update('newsletters_subscribe', $dataA);

				

				$user_details=explode(' ',trim($this->input->post('fetch_user_data_after_save')));

				

				if($user_details)

				{

					for($b=0; $b < count($user_details); $b++)

					{					

						$dataB=array(

						'queued'=>1

						);

						$this->db->where("newsletter_id", $id);

						$this->db->where("mail_send_status",'0');

						$this->db->where("ns_email", $user_details[$b]);

						/*if($this->db->update('newsletters_subscribe', $dataB))

						{

							$count++;

						}*/

						$this->db->update('newsletters_subscribe', $dataB);

					}

					//updated by ketan 201307251755

					$count = $this->dbadminheader->countQueuedNewsletterSubscriber($id);

					if($count>0)

					{

						$countData = array(

						'count_queue'=> $count,

						'queued'=>$this->input->post('queued')

						);

					}

					else

					{

						$countData = array(

						'count_queue'=> $count

						);

					}

					$result=$this->dbuser->edit_newsletter($countData,$id);

					//update end

				}	

					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', 'Newsletter successfully updated.');

					

					redirect(base_url().'chapteradmincp/user/newsletter');

	

			}

			

			$data['title'] = 'Edit Newsletter';		

			$this->load->view('chapteradmincp/user/edit_newsletter',$data);

		}

		//update end

		

		public function delete_newsletter($id)

		{

			//added by ketan 20130720

			$this->dbadminheader->delete_ch_to_newsletters_new($id);

			$this->dbuser->delete_newsletter($id);

			$this->dbadminheader->delete_newsletters_subscribe($id);

			//update end

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', 'Newsletter successfully deleted.');

	

			if ($this->agent->is_referral())

				{

					redirect($this->agent->referrer());

				}

				else

				{

					redirect(base_url('chapteradmincp/user/newsletter'));

				}

		}

		

		function view_newsletter($id)

		{

			$data['item'] = $this->dbuser->get_newsletter_by_id($id);

			echo '<html><title>'.$data['item']->subject.'</title><body>';

			echo $data['item']->html;

			echo '</body></html>';

		}

		

		function get_template_chapter($template_id)

		{

			$template_html='';

			$get_chapters_template = $this->dbadminheader->get_chapters_template($template_id);

			foreach($get_chapters_template as $get_chapters_template_row)

			{

				$template_html=$get_chapters_template_row->template_html;	

			}

			echo $template_html;

		}

		//////////////////////////////////////////

		//End coding for newsletter 



	//added by ketan 20130713

	function get_template_user()

	{

		$fetch_user_data = $_POST['fetch_user_data'];

		$username = $_POST['username'];

		$id = $_POST['id'];

		$nId = $_POST['nId'];

		$offset = $_POST['offset'];

		$check_uncheck_all_user_status = $_POST['check_uncheck_all_user_status'];

		

		$limit=10;

		$i = 0;

		$base_url=base_url();

		$state = '';

		$member_id = '';

		$temp=0;

		$member_email='';

		$this->load->library('pagination');

		//$ex_ch_id=explode('_',$ch_id);

		

		$state = substr($state, 0,-1);

		$user_details_data= $this->dbadminheader->get_mem_using_newsletter_sub($nId);

		$queuedarr = array();

		$sendedarr = array();

		foreach($user_details_data as $user_details_data)

		{

			$member_email .=$user_details_data->ns_email.',';

			if($user_details_data->queued==1)

			{

				array_push($queuedarr,$user_details_data->ns_email);	

			}

			if($user_details_data->mail_send_status==1)

			{

				array_push($sendedarr,$user_details_data->ns_email);	

			}

		}

		$member_email = substr($member_email, 0,-1);

		if($username=='0')

		{

		$subscribers= $this->dbadminheader->get_mem_using_newsletter_sub_for_pagination($nId, $offset, $limit);

		//$user_details = $this->dbadminheader->user_details_pagination_newsletter($member_email,$offset, $limit);

		}

		else

		{

		$subscribers = $this->dbadminheader->get_all_user_search_newsletter($username,$nId,$offset, $limit);

		//$user_details = $this->dbadminheader->get_all_user_search_newsletter($username,$member_email,$offset, $limit);

		}

		?>   

        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table table-hover" >

        <thead>

        <tr>

        	<!--<th scope="col" width="5%"><input type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" onclick="chkalluser(<?php echo $id ?>)" value="yes"/>

			

             <input type="hidden" id="chkall_check" value="yes" /></th>-->

			 <th scope="col" width="5%"><input onclick="chkall_d()"  type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" name="chkall" value="no"/>

            <input type="hidden" id="chkall_check" value="no"/>

            </th>

			<th scope="col" width="25%">Username</th>

            <th scope="col" width="35%">Email Id</th>

			<th scope="col" width="20%">Chapter Name</th>

            <th scope="col" width="15%">Mail Status</th>

        </tr>

    	</thead>

        <tr>

        <?php

		$i = 0;

		foreach($subscribers as $user_details)

		{

			if($i%1==0)

			{

			?>

            </tr><tr>

			<?php

			}

			$ch_name1 = $this->dbadminheader->get_chapter($user_details->ch_id);

			//$ch_to_template_id = $this->dbadminheader->get_mem_using_newsletter_sub($nId);

			?>

                 <td>

                 	<?php

					if(in_array($user_details->ns_email,$sendedarr))

					{?>

                    <span class="span3" >

                        <label class="checkbox">

                            <input disabled="disabled"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->ns_email; ?>"  />  

                            <!--<input  id='ch_user<?php echo $user_details->ns_email; ?>' size="20"  type='hidden' name='ch_user<?php echo $user_details->ns_email; ?>' value='yes'/>-->	        </label>

                    </span>

                    <?php

					}

					else

					{

					$fetch_user_data=str_replace("%20"," ",$fetch_user_data);

					$fetch_user_data=trim($fetch_user_data);

					$fetch_user_data=str_replace(" ",",",$fetch_user_data);

					$fetch_user_data_array=explode(",",$fetch_user_data);

					

					if($fetch_user_data!='')

					{	

						$mm_id_set = 0;

						if (in_array($user_details->ns_email,$fetch_user_data_array))

						{

							$mm_id_set =1;

						}

						

							if($check_uncheck_all_user_status=="yes")

							{

							?>

							<span class="span3" >

												<label class="checkbox">

													<input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->ns_email; ?>',this.checked)"  checked="checked"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->ns_email; ?>"  />  

													

												 </label>

											</span>

							

							<?php

							}

							else

							{

							?>

							

							

		                    <span class="span3" >

		                        <label class="checkbox">

		                            <input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->ns_email; ?>',this.checked)" type="checkbox"  name="user_details[]" value="<?php echo $user_details->ns_email; ?>" <?php if($mm_id_set==1){ echo 'checked=checked'; } ?> />

								</label>

		                    </span>

		                    

							<?php 

							}

						}

					else

						{

							

							

							?>

                        	<span class="span3" >

                                <label class="checkbox">

                                    <input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->ns_email; ?>',this.checked)"  <?php  if(in_array($user_details->ns_email,$queuedarr)) { echo 'checked="checked"'; }?>  type="checkbox"  name="user_details[]" value="<?php echo $user_details->ns_email; ?>"  />  

                                    

                                 </label>

                            </span>

						<?php

							

						}

					}

					

					?>

                </td>

                <td>

                    <span class="span3" ><?php $uname = $this->dbadminheader->get_user_using_email($user_details->ns_email); if($uname){ echo $uname->mm_username; } else { echo ""; } ?></span>

                </td>

                <td>

                     <span class="span3" ><?php echo $user_details->ns_email; ?></span>

                </td>

                <td>

                 

                    <span class="span3" ><?php echo $ch_name1->ch_name; ?> </span>

                </td>

                <td>

                 <?php if(in_array($user_details->ns_email,$sendedarr))

				 {?>

                 <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />

				 <?php

                 }

				 else

				 {?>

                  <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" />

				 <?php

                 }

				 ?>

                   

                </td>

			<?php

			$i++;

        }

		

		if($i==0)

		{

			echo "<td colspan='5'>No result found!!!</td>";

		}?>

        

		</tr>

        </table>

        <?php

		$j=0;

		if($username=='0')

		{

		$totalRows= $this->dbadminheader->user_details_pagination_newsletter_for_pagination($nId);

		}

		else

		{

		$totalRows= $this->dbadminheader->get_all_user_search_newsletter_for_pagination($username,$nId);

		}

		

		foreach($totalRows as $totalRows)

		{

			$j++;

        }

		$config['base_url'] = base_url().'chapteradmincp/user/edit_newsletter';

        $config['total_rows'] = $j;

		$config['per_page'] = $limit;

		$config['cur_page'] =$offset;

		$this->pagination->initialize($config);

        $jsFunction['name'] = 'show';

        $jsFunction['params'] = array();

        $this->pagination->initialize_js_function($jsFunction);

        $data['base_url'] = $config['base_url'];

        $data['page_link'] = $this->pagination->create_js_links();

		?>

		<input type="hidden" id="offset" value="<?php echo $offset;?>" />

		<tfoot>

    	<tr>

        	<?php print_r('<div align="center" class="pagination"><ul><li>'.$data['page_link'].'</li></ul></div>');?>

        </tr>

	    </tfoot>

		<?php

		echo "|".$i."|".$j;

	

	}

	function add_user($nId)

	{

		$checkedemails = $_GET['checkedemails'];

		$uncheckedemails = $_GET['uncheckedemails'];

		$checkedemails=explode(',',$checkedemails);

		$uncheckedemails=explode(',',$uncheckedemails);

		//for unchecked

		for($i=0;$i<count($uncheckedemails);$i++)

		{

			$emailId = $uncheckedemails[$i];

			$dataA=array(

			'queued'=>0

			);

			$this->db->where("newsletter_id", $nId);

			$this->db->where("mail_send_status",'0');

			$this->db->where("ns_email", $emailId);

			$this->db->update('newsletters_subscribe', $dataA);

		}

		//for checked

		for($i=0;$i<count($checkedemails);$i++)

		{

			$emailId = $checkedemails[$i];

			$dataB=array(

			'queued'=>1

			);

			$this->db->where("newsletter_id", $nId);

			$this->db->where("mail_send_status",'0');

			$this->db->where("ns_email", $emailId);

			$this->db->update('newsletters_subscribe', $dataB);

		}

		echo $this->session->set_flashdata('message_type', 'success');

		echo $this->session->set_flashdata('status_', 'User successfully updated.');		

				

	}

	function queue_mail($id)

	{

		$data=array('email_template_status'=>1);

		$result=$this->dbuser->edit_newsletter($data,$id);

		redirect(base_url().'chapteradmincp/user/newsletter');

	}

	function stop_mail($id)

	{

		$data=array('stop_mail'=>1);

		$result=$this->dbuser->edit_newsletter($data,$id);

		redirect(base_url().'chapteradmincp/user/newsletter');

	}

	function start_mail($id)

	{

		$data=array('stop_mail'=>0);

		$result=$this->dbuser->edit_newsletter($data,$id);

		redirect(base_url().'chapteradmincp/user/newsletter');

	}

	function resume_mail($id)

	{

		$data=array('stop_mail'=>0,'email_send'=>0);

		$result=$this->dbuser->edit_newsletter($data,$id);

		redirect(base_url().'chapteradmincp/user/newsletter');

	}

	function cron_check($uid)

	{

		

		$email_template_status=0;

		$stop_mail=0;

		$cron_check_id = $this->dbadminheader->cron_check_id_newsletter($uid);

		foreach($cron_check_id as $row)

		{

			$email_template_status=$row->email_template_status;	

			$stop_mail=$row->stop_mail;	

			$email_send =$row->email_send;	

			$queued=$row->queued;

		}

		echo $email_template_status."|".$stop_mail."|".$email_send."|".$queued;

	}

	function check_uncheck_all_user($status)

	{

		if($status=='no')

		{

			echo "<a href='javascript:void(0)'>Uncheck All user</a>|yes";

		}

		else

		{

			echo "<a href='javascript:void(0)'>Check All user</a>|no";

		}

	}

	function user_check_uncheck_all($status,$id,$action,$type,$offeset)

	{

		if($action=='true')

		{

			echo $this->get_template_user_check_all($id,$type,$offeset);

		}

		else

		{

			if($type=='chkall')

			{

				

			echo $this->get_template_user_check_all($id,$type,$offeset);

			}

			else

			{

			echo '';	

			}

		}

	}

	function get_template_user_check_all($id,$type,$offeset)

	{

		

		$base_url=base_url();

		$m_id='';

		$member_id = '';

		$temp=0;

		$limit=10;



		if($type=='check_uncheck_all_user')

		{

			$user_details_data= $this->dbadminheader->get_mem_using_newsletter_sub_for_pagination_checkall($id);

		}

		else

		{

			$user_details_data= $this->dbadminheader->get_mem_using_newsletter_sub_for_pagination($id, $offeset, $limit);

		}

		foreach($user_details_data as $user_details_data)

		{

			$member_id .=$user_details_data->ns_email.',';

		}

		$member_id = substr($member_id, 0,-1);

		

		return $member_id;

	}

	function user_check_uncheck($status,$id,$user,$action)

	{

		echo $user;

	}

	function edit_user()

	{

		echo $this->session->set_flashdata('message_type', 'success');

		echo $this->session->set_flashdata('status_', 'User successfully updated.');		

	}

	//update end

	function email_info()

	{

		

		$html=$_POST['emailData'];

		$subject=$_POST['subject'];

		//print_r($emailData);

		$this->load->model('dbheader');

		$this->load->library('parser');

		$settings = $this->dbheader->get_setting();

		$emailData->family = '<table  border="0" cellspacing="0" cellpadding="0"> 

					  <tr>

					  	<td>

							<div>

							        <h1><b><u>Family Members</u></b><br></h1>

							</div>

					        

							<table  border="1" cellspacing="0" cellpadding="0"  width="auto">

								<thead>

									<tr>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Name</th>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Username</th>

										<th scope="col" style="text-align:center; width:90px;">Relationship</th>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Email-id</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px !important;">Date of Birth<br>(MM/YY)</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px !important;">Edit</th>

										

									</tr>

								</thead>

								<tfoot>

									

								</tfoot> 

								<tbody cellspacing="0" cellpadding="0" >

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Ramila Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Ramila.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Wife</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1965</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rahul Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rahul.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Son</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1990</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rina Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rina.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Daughter</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>	

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1995</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								

								</tbody>

							</table>

						</td>

						</tr>

					</table>';

					$userinfo = '<table width="auto" border="0" cellspacing="0" cellpadding="0"> 

					  				<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Username :</b>rajiv.patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Name :</b>Rajiv Patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Email :</b>test@test.com</td></tr>

								  	<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>DOB :</b>1/1985</td></tr>

					</table>';

					

		$final_message = array('html' =>$html,'fullname' =>'Rajiv Patel','username' =>'rajiv.patel','code' =>'10101010101010101010101010101011','email' =>'test@test.com','familymember' =>$emailData->family,'sitename'=>$settings->sitename,'emailID'=>'id','userinfo' => $userinfo,'subject' => $subject,'segment_data' => 'preview');

						/*$this->email->message($this->parser->parse('parser_for_sendverification', $final_message , TRUE));*/

		//				print_r($final_message) ;

		echo $this->parser->parse('email_layout', $final_message , TRUE);



						

	

	}

	//////////////////////////////////////pradip changes for user export to excel ////////////
	
	
	function ExportToCSV($content,$filename = '', $filedArr = '',$countmembers,$heading)
	{
		
		
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	$filename =''.$filename;
	date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		$fp = fopen($filename, 'w');
				
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.="<tr><td colspan='4' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='6' align='left'>";
				$string.="<font size=4><b>$countmembers</b></font>";
				$string.="</td></tr>";
				
				$string.= "<tr>";
				$field = array();
				foreach($filedArr as $filed)
				{
					
					$string.= "<th width='auto' bordercolor='#d0d7e5'>$filed</th>";
					
				}
				
				
				$string.= "</tr>";
				
				$string.= "<tr>";
				
				for($i=0;$i<count($content);$i++)
				{
				foreach($content[$i] as $line)
				{
					$string.= "<td bordercolor='#d0d7e5'><center>$line</center></td>";
					
				}
				$string.= "</tr>";
				}
				
				
			$string.= "</table>";
			
			header('Content-Type: application/force-download');  
		header('Content-disposition: attachment; filename="'.$filename.'"');
		header("Pragma:");  
		header("Cache-Control:"); 
		echo $string;
			
			//chmod($filename, 0755);

		//fwrite($fp,$string); 
			//echo($string);die();
		//fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-type: application/excel');
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:"); 
		//echo $string;
	/*
	//if($content != '' && (!(empty($content)))  ){
		$fp = fopen($filename, 'w');
		//if($filedArr != ''  &&  is_array($filedArr))
			fputcsv($fp, $filedArr);
		//else
		//	echo  'Please  Provide Filed Name  In Array.'; 
		foreach($content as $line){
			//$val = implode(",",$line);
			fputcsv($fp, $line);
		}
		fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:");
		//header('Content-type: application/excel');
		//header('Content-Disposition: attachment; filename="'.$filename.'"');
		
		//readfile($filename);
		//unlink($filename);
		*/

	/*}else{
		echo  'No Content Found ' ;
	}*/
	
	}
	
	
	function user_export_to_excel()
	{
		$type = $this->uri->segment(4);
		$chapter_id = $this->session->userdata('get_chapter_id');
		$chapter_name = $this->dbadminheader->get_chapter($chapter_id);
		
		if($type == 1)
		{
			$num_rec=$this->dbuser->count_user_for_export($type,$chapter_id);
		
			$user_deatails = $this->dbuser->get_all_user_for_export($type,$chapter_id);
			
			$filename = $chapter_name->ch_name.'_members_list'.date('Y-m-d').'_'.time().'.xls';
			$heading = $chapter_name->ch_name.' members list';
			$countmembers = $num_rec.' members';
		}
		elseif($type == 2)
		{
			$num_rec=$this->dbuser->count_user_for_export($type,$chapter_id);
		
			$user_deatails = $this->dbuser->get_all_user_for_export($type,$chapter_id);
			
			$filename = $chapter_name->ch_name.'_Verified_members_list'.date('Y-m-d').'_'.time().'.xls';
			$heading = $chapter_name->ch_name.' Verified members list';
			$countmembers = $num_rec.' members';
		}
		elseif($type == 3)
		{
			$num_rec=$this->dbuser->count_user_for_export($type,$chapter_id);
		
			$user_deatails = $this->dbuser->get_all_user_for_export($type,$chapter_id);
			
			$filename = $chapter_name->ch_name.'_Un_verified_members_list'.date('Y-m-d').'_'.time().'.xls';
			$heading = $chapter_name->ch_name.' Un-verified members list';
			$countmembers = $num_rec.' members';
		}
		
		$content = '';
		$num = 0;
		$filedArr =array('Username','Name','Phone','Email','Type','status');		
		$content=array();
		
		foreach($user_deatails as $all_users)
		{
			
			$get_chapter = $this->dbadminheader->get_chapter($all_users->mm_chapter_id);
			
			$content[$num]['Username'] = $all_users->mm_username;
			$content[$num]['Name'] = $all_users->mm_fname.' '.$all_users->mm_lname;
			
			$content[$num]['Phone'] = $all_users->mm_hphone;
			
			$content[$num]['Email'] = $all_users->mm_email;
			
			
			//$chkadmin = $this->dbuser->get_admin_user($all_users->mm_email);
			
			//$admin = 0;
		
				
		
				if($all_users->mm_type == '0')
				{
					$content[$num]['Type']='Member';
				}
				else
				{ 
                	$content[$num]['Type']='C.A. of '.$get_chapter->ch_name;
				}
			
			
			if($all_users->mm_varify=="1")
			{
				$content[$num]['Status'] = "Verified";
			}
			else
			{
				$content[$num]['Status'] = "Un-verified";
			}
		
		$num++;
			
		}
		
		$this->ExportToCSV($content,$filename,$filedArr,$countmembers,$heading);
		
		//echo __DIR__.'\\excelfile\\'.$filename;
		//echo '\\excel_files\\'.$filename;
		//echo 'C:\\wamp\\www\\spcsusa\\excel_files\\'.$filename;
		
	}
	
	///////////////////////////////////////////////////////////////////////////////////

}

?>