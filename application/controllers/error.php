<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('dbheader');
	}
	
	public function index()
	{
		$data['title'] = $this->lang->line('text_404');
		$this->load->view('error',$data);
	}
	
}