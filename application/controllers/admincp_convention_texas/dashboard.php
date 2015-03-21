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

		

		$this->load->model('admincp_convention_texas/dbdashboard');
		$this->load->model('admincp_convention_texas/dbsettings');
		//$this->load->model('admincp_convention_texas/dbadminheader');

		

		if($login=='')

		{

			redirect(base_url().'admincp_convention_texas/login');

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
		$date_array = array();
		foreach($data['total_reg'] as $reg_detail){
			$explode=explode(' ',$reg_detail->fm_created_date);
			
			array_push($date_array,$explode[0]);
		}
		$data['date_array'] = $date_array;
		/*echo "<pre>";
		print_r($date_array);
		echo "</pre>";
		exit;*/
		//exit;
		//$sort = array('2013-10-21','2013-09-22','2013-11-10');
		
		$data['total_member'] = $this->dbdashboard->count_member();
		$date_array_member = array();
		foreach($data['total_member'] as $member_detail){
			$explode=explode(' ',$member_detail->fm_created_date);
			
			array_push($date_array_member,$explode[0]);
		}
		$data['date_array_member'] = $date_array_member;
		/*echo "<pre>";
		print_r($date_array_member);
		echo "</pre>";
		exit;*/
		
		$data['total_event'] = $this->dbdashboard->count_event();
		$date_array_event = array();
		foreach($data['total_event'] as $event_detail){
			$explode=explode(' ',$event_detail->ce_mem_created_date);
			
			array_push($date_array_event,$explode[0]);
		}
		$data['date_array_event'] = $date_array_event;
		
		
		
		$data['total_member_to_event'] = $this->dbdashboard->count_member_to_event();
		//print_r($data['total_member_to_event']);
		/*$date_array_event_member = array();
		foreach($data['total_member_to_event'] as $event_member_detail){
			$explode=explode(' ',$event_member_detail->ce_mem_created_date);
			
			array_push($date_array_event_member,$explode[0]);
		}*/
		/*$data['date_array_event_member'] = $date_array_event_member;*/
		
		$data['total_program'] = $this->dbdashboard->count_program();
		
		$data['total_participant_to_program'] = $this->dbdashboard->count_participant_to_program();
		
		$data['total_medical'] = $this->dbdashboard->count_medical();
		
		$data['title']="Dashboard";
		
		$this->load->view('admincp_convention_texas/dashboard/view',$data);

	}

	

	

	

	

	

	

	

	

}

?>