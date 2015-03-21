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
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbuser');
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
	
	function online()
	{
		if($this->online_users->get_online())
		{
			$data['query'] = $this->online_users->get_online();
		}
		
		$data['title']="Online Members";		
		$this->load->view('admincp/user/online',$data);
		
	}
	
	public function view()
	{
		$search_world = $this->input->get('search');
		$mm_type = $this->input->get('mm_type');
		
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
			$num_rec=$this->dbuser->count_user();
		}
		
		$data['tot_rec'] = $num_rec;
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/user/view/';
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
		
		if($search_world || $mm_type !='')
		{
			if($mm_type == '0')
			{
				$data['query'] = $this->dbuser->get_all_user_search($search_world,$config['per_page'],$segment);
			}
			if($mm_type == '1')
			{
				$data['query'] = $this->dbuser->get_all_user_search_assign($search_world,$config['per_page'],$segment);
			}
			if($mm_type == '2')
			{
				$data['query'] = $this->dbuser->get_all_user_search_unassign($search_world,$config['per_page'],$segment);
			}
		}
		else
		{
			$data['query'] = $this->dbuser->get_all_user($config['per_page'],$segment);
		}
		
		
		
		$this->pagination->initialize($config);
		
		$data['title']="Manage Members";		
		$this->load->view('admincp/user/view',$data);
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
								
				redirect(base_url().'admincp/user.html');
		}
		
			$data['title'] = $this->lang->line('text_edit_profile_title');
			$data['sub_title'] = $this->lang->line('text_edit_profile_sub_title');
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('admincp/user/edit',$data);
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
		
		$html = '<select class="input-xlarge" name="mm_city_id" id="mm_city_id"><option>Select State</option>';
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
				redirect(base_url('admincp/categories/view'));
			}
	}
	
	function newsletter()
	{
		$num_rec=$this->dbuser->count_newsletter();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/user/newsletter/';
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
		$this->load->view('admincp/user/newsletter',$data);
	}
	
	function add_newsletter()
	{
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
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
				'html'=>$this->input->post('html'),
				'queued'=>$this->input->post('queued')
				);
				$result=$this->dbuser->add_newsletter($data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Newsletter successfully inserted.');
				
				redirect(base_url().'admincp/user/newsletter');

		}
		
		$data['title'] = 'Newsletter';		
		$this->load->view('admincp/user/add_newsletter',$data);
	}
	
	function edit_newsletter($id)
	{
		$data['item'] = $this->dbuser->get_newsletter_by_id($id);
		
		if(!$data['item']){redirect(base_url().'admincp/user/newsletter');}
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
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
				'html'=>$this->input->post('html'),
				'queued'=>$this->input->post('queued')
				);
				$result=$this->dbuser->edit_newsletter($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Newsletter successfully updated.');
				
				redirect(base_url().'admincp/user/newsletter');

		}
		
		$data['title'] = 'Edit Newsletter';		
		$this->load->view('admincp/user/edit_newsletter',$data);
	}
	
	public function delete_newsletter($id)
	{
		$result=$this->dbuser->delete_newsletter($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Newsletter successfully deleted.');

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/user/newsletter'));
			}
	}
	
	function view_newsletter($id)
	{
		$data['item'] = $this->dbuser->get_newsletter_by_id($id);
		echo '<html><title>'.$data['item']->subject.'</title><body>';
		echo $data['item']->html;
		echo '</body></html>';
	}
	
	function passreset()
	{
		$settings = $this->dbadminheader->getsettings();
		
		$this->load->library('email');
		$this->load->library('parser');
		
		$this->form_validation->set_rules('select_option', 'Select', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == TRUE)
		{
			if($this->input->post('select_option') == 'all')
			{
				$data=array(
				'created'=>date('Y-m-d H:i:s'),
				'subject'=>'Password Recovery Email',
				'html'=>'Auto generated email!',
				'type'=>1,
				'queued'=>1
				);
				$result=$this->dbuser->add_newsletter($data);
			}
			else
			{
				$mem_ids = $this->input->post('members_id');
				
				for($i=0; $i < count($mem_ids); $i++)
				{
					$get_user_by_id = $this->dbuser->get_user_by_id($mem_ids[$i]);
					
					$random = substr(number_format(time() * rand(),0,'',''),0,10);
					$random = md5($random);
					$data=array(
					'mm_seq'=>$random
					);
					$result=$this->dbuser->update($data,$get_user_by_id->mm_id);
				
					$config['mailtype'] = 'html';
					$config['charset'] = 'utf-8';
					$this->email->initialize($config);
					$this->email->from($settings->email);
					$this->email->to($get_user_by_id->mm_email);
					$this->email->subject('Pasword Recovery - '.$settings->sitename);
					$final_message = array('code' => $random, 'email' => $get_user_by_id->mm_email, 'username'=>$get_user_by_id->mm_username, 'fname'=>$get_user_by_id->mm_fname, 'sitename'=>$settings->sitename);
					$this->email->message($this->parser->parse('admincp/forgot_parser', $final_message , TRUE));
					
					$email_sent = $this->email->send();
					//echo $this->email->print_debugger();
				}
			}
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Email successfully queued.');
			redirect(base_url('admincp/user/newsletter'));
		}
		
		$data['title'] = 'Password Reset Email';
		$data['sub_title'] = '';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('admincp/user/passreset',$data);
	}
	
	function login_history()
	{
		$num_rec=$this->dbuser->count_all_history();
		$data['tot_rec'] = $num_rec;
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/user/login_history/';
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
		$data['query'] = $this->dbuser->get_all_history($config['per_page'],$segment);
		
		$data['title'] = 'Member Login History';
		$data['sub_title'] = '';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('admincp/user/login_history',$data);
	}
}
?>