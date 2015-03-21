<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {



	public function index()

	{

		$this->load->helper(array('form', 'html','string'));

		$this->load->model('admincp_convention_texas/dblogin');

		$this->load->library('form_validation');

		

		$this->form_validation->set_rules('username', $this->lang->line('text_username'), 'required|trim|max_length[99]|xss_clean');

		$this->form_validation->set_rules('password', $this->lang->line('text_password'), 'required|trim|max_length[200]|xss_clean|callback__checkUsernamePassword');

		

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');

		

		if($this->form_validation->run()==FALSE)

		{

		}

		else

		{

			$this->session->set_userdata('username',$this->input->post('username'));

			redirect(''.base_url().'admincp_convention_texas/dashboard');

		}

		

		$this->load->view('admincp_convention_texas/user/login');

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

			$this->session->set_userdata('get_admin_id',$user->id);

			$this->session->set_userdata('status','1');

            return TRUE;

        }   

	}

}

?>