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
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('search_profile');
		header("location: ".base_url()."user/login");
		

	}

}

?>