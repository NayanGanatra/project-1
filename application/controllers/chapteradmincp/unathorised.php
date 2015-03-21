<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Unathorised extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('session');
		$this->load->helper('text');
		
		if($login=='')
		{
			redirect(base_url().'chapterchapteradmincp/login');
		}
		
	}
	public function index()
	{
		$data['title']='Unathorised';
		$this->load->view('chapterchapteradmincp/layout//unathorised',$data);
	}
	
}
?>