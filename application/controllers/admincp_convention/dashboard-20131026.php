<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention/dbdashboard');
		$this->load->model('admincp_convention/dbsettings');
		//$this->load->model('admincp_convention/dbadminheader');

		

		if($login=='')

		{

			redirect(base_url().'admincp_convention/login');

		}

	

		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')

		{

			redirect(base_url().'unathorised');

		}

		

		

	}	

	public function index()

	{

		$this->view();

		
	}
	
	
	function view()

	{
		$data['total_reg'] = $this->dbdashboard->count_reg();
		
		$data['total_member'] = $this->dbdashboard->count_member();
		
		$data['total_event'] = $this->dbdashboard->count_event();
		
		$data['total_member_to_event'] = $this->dbdashboard->count_member_to_event();
		
		$data['total_program'] = $this->dbdashboard->count_program();
		
		$data['total_participant_to_program'] = $this->dbdashboard->count_participant_to_program();
		
		$data['total_medical'] = $this->dbdashboard->count_medical();
		
		$data['title']="Dashboard";
		
		$this->load->view('admincp_convention/dashboard/view',$data);

	}

	

	

	

	

	

	

	

	

}

?>