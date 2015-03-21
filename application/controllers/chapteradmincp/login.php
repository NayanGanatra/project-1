<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	
	public function index()
	{
		$this->load->helper(array('form', 'html','string'));
		$this->load->model('chapteradmincp/dblogin');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('username', $this->lang->line('text_username'), 'required|valid_email|trim|max_length[99]|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('text_password'), 'required|trim|max_length[200]|xss_clean|callback__checkUsernamePassword');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		if($this->form_validation->run()==FALSE)
		{
		}
		else
		{
			$this->session->set_userdata('username',$this->input->post('username'));
			redirect(''.base_url().'chapteradmincp/chapters');
		}
		
		
		
		$this->load->view('chapteradmincp/user/login');
	}
	
	function _checkUsernamePassword() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->dblogin->checkuser($username,$password);

        if(! $user)
        {
            $this->form_validation->set_message('_checkUsernamePassword', $this->lang->line('text_incorrect_login'));
            return FALSE;
        }else{
			$this->session->set_userdata('get_chapter_id',$user->mm_chapter_id);
			$this->session->set_userdata('chapter_mm_id',$user->mm_id);
			$this->session->set_userdata('get_admin_id','2');
            return TRUE;
			
        }
	}
		
	function auto_login()
	{
			
			$this->load->model('chapteradmincp/dblogin');
			$login = $this->uri->segment(4);
			
			$user = $this->dblogin->valideemail($login);
			if($user)	
			{
				$this->session->set_userdata('username',$login);
				
				$this->session->set_userdata('get_chapter_id',$user->mm_chapter_id);
				$this->session->set_userdata('chapter_mm_id',$user->mm_id);
				$this->session->set_userdata('get_admin_id','2');
	
				redirect(''.base_url().'chapteradmincp/chapters');
			}
		
	}
}
?>