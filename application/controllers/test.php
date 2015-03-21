<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbtest');
		$this->load->model('dbheader');
	}


	
	function view()
	{
		$a = $this->dbtest->getall();
		
		foreach($a as $a_row)
		{
			$cities = $this->dbtest->get_cities($a_row->state_sname);
			
			foreach($cities as $cities_row)
			{
			$data=array(
				'city_name'=>$cities_row->city,
				'state_id'=>$a_row->state_id,
				'latitude'=>$cities_row->latitude,
				'longitude'=>$cities_row->longitude
				);
				$result=$this->dbtest->insert($data);
			}
			echo $a_row->state_id;
		}
		
	}
	
}