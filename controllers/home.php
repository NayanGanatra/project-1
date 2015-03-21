<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbheader');
	}
	
	public function _remap($method, $params = array())
	{
		if($method == 'index' || $method = '')
		{
			$data['title'] = "Welcome";
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('home',$data);
		}
	}
	
}