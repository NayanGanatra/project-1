<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Convention_detail extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention_texas/dbcon_detail');
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

	public function view()

	{
		if($this->uri->segment(4)!='' || $this->uri->segment(4) != NULL)
		{
				$mm_id = $this->uri->segment(4);
				$data['query'] = $this->dbcon_detail->get_all_reg_form($mm_id);
				$data['program'] = $this->dbcon_detail->count_program_from_mm_id($mm_id);
				$data['medical'] = $this->dbcon_detail->count_medical_from_mm_id($mm_id);
				$data['attend'] = $this->dbcon_detail->count_member_from_mm_id($mm_id);
				$data['subtotal_of_reg'] = $this->dbcon_detail->subtotal_reg($mm_id);
				$data['event'] = $this->dbcon_detail->count_event_from_mm_id($mm_id);
				$data['subtotal_of_event'] = $this->dbcon_detail->subtotal_event($mm_id);
				
		}

		$data['title']="Convention";
		
		$this->load->view('admincp_convention_texas/convention_detail/view',$data);

		
	}
	
	
	/*public function show()

	{
		//$mm_id = $_POST['mm_id'];
		
		//exit;
	
		
		
		
		$data['title']="Convention";
		
		$this->load->view('admincp_convention_texas/convention_detail/view',$data);

	}*/

	

	

	

	

	

	

	

	

}

?>