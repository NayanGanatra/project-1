<?php
class Logout extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}
	
	function index()
	{
		$this->session->unset_userdata('username');
		header("location: ".base_url()."admincp/login");
	}
}
?>
