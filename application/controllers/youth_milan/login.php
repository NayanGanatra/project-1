<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {



	public function index()

	{

		$this->load->helper(array('form', 'html','string'));

		$this->load->model('youth_milan/dblogin');

		$this->load->library('form_validation');
		
		$this->logincheck();

		

	}
	
	function logincheck()
	{
		
		$this->form_validation->set_rules('loginid', 'Login ID', 'required');

		$this->form_validation->set_rules('password', 'Password', 'required');

		

		//$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');

		

		if($this->form_validation->run()==FALSE)

		{

		}

		else

		{

			//$this->session->set_userdata('username',$this->input->post('username'));
			
			$loginid = $this->input->post('loginid');

        	$password = $this->input->post('password');



        	$user = $this->dblogin->checkuser($loginid,$password);
			
			if(! $user)

        	{
				$this->session->set_userdata('error','error');

        	}
			else
			{

				$this->session->set_userdata('id',$user->mm_id);
				$this->session->set_userdata('email',$user->mm_email);

				redirect(''.base_url().'youth_milan/registration/view');
			
            	//return TRUE;
			
			}


		}

		//$data['title']="Youth Milan - Login";

		$this->load->view('youth_milan/login');

		
	}


}

?>