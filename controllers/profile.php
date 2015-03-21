<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbuser');
		$this->load->model('dbheader');
	}
	
	public function _remap($method, $params = array())
	{
		if($this->uri->segment(2) != "")
		{
			$this->view();
		}
		else
		{
			redirect('error');
		}
		
	}
	
	function view()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Member Directory');
			
			redirect(base_url('user/login.html'));
		}
		
		$username = $this->uri->segment(2);
		$data['user'] = $this->dbheader->user_details_by_username_or_email($username);
		
		if(!$data['user'])
		{
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('status_', 'Profile not found!');
			
			redirect(base_url('user/account.html'));
		}
		
		$data['title'] = $data['user']->mm_fname.' '.$data['user']->mm_lname;
		$data['sub_title'] = $data['user']->mm_fname."'s Profile";
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('profile',$data);
	}
	

}