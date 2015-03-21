<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forgotpassword extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('chapteradmincp/dblogin');
		$this->load->model('chapteradmincp/dbadminheader');
		$this->load->library('email');
		$this->load->library('parser');
	}

	public function index()
	{
	
		$settings = $this->dbadminheader->getsettings();
		
		$this->form_validation->set_rules('email', $this->lang->line('text_email'), 'required|valid_email|callback__checkUser');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$get_data = $this->dblogin->valideemail($this->input->post('email'));
			
			if ($get_data)
			{
				$random = substr(number_format(time() * rand(),0,'',''),0,10);
				$random = md5($random);
				$data=array(
				'mm_seq'=>$random
				);
				$result=$this->dblogin->edit($data,$get_data->mm_id);
				
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($settings->email);
			$this->email->to($get_data->mm_email);
			
			$this->email->subject($this->lang->line('mail_forgot_subject'));
			
			$final_message = array('code' => $random, 'username' => $get_data->mm_username);
			
			$this->email->message($this->parser->parse('chapteradmincp/user/forgot_parser', $final_message , TRUE));
			
			$this->email->send();
			//echo $this->email->print_debugger();
			
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('mail_pass_reset_info_msg'));
				
				redirect($this->config->item('url').'chapteradmincp/login');
			}
			else
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', $this->lang->line('misc_email_not_exists'));
				
				redirect($this->config->item('url').'chapteradmincp/forgotpassword');
			}
		}
	
	
		$data['title']=$this->lang->line('text_forgot_password');
		$this->load->view('chapteradmincp/user/forgotpassword',$data);
	}
	
	function _checkUser() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->dblogin->valideemail($this->input->post('email'));

        if(!$user)
        {
            $this->form_validation->set_message('_checkUser', $this->lang->line('misc_email_not_exists'));
            return FALSE;
        }else{
            return TRUE;
        }   
	}
	
	function reset()
	{
		$settings = $this->dbadminheader->getsettings();
		$uniqueid = xss_clean($this->uri->segment(4));
		
		$get_data = $this->dblogin->reset_retrive($uniqueid);
		
		if($get_data)
		{
				$random = substr(number_format(time() * rand(),0,'',''),0,5);
				$data=array(
				'mm_password'=>md5($random)
				);
				$result=$this->dblogin->set_password($data,$get_data->mm_seq);
				
			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($settings->email);
			$this->email->to($get_data->mm_email);
			
			$this->email->subject('Reset Admin Password');
			
			$final_message = array('newpassword' => $random);
			
			$this->email->message($this->parser->parse('chapteradmincp/user/newpass_parser', $final_message , TRUE));
			
			$this->email->send();
			//echo $this->email->print_debugger();
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('mail_pass_reset_info_msg'));
			
			redirect($this->config->item('url').'chapteradmincp/login');

		}
		else
		{
			echo $this->lang->line('misc_invalide_link');
		}
		
	}
}
?>