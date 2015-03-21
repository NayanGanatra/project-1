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

		$this->session->unset_userdata('status');

		$this->session->unset_userdata('get_admin_id');

		header("location: ".base_url()."admincp_convention/login");

	}

}

?>