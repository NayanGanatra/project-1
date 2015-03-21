<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbuser');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		/*edit*/
		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')
		{
			redirect(base_url().'unathorised');
		}
		/*edit*/
		
	}
	
	public function index()
	{
/*		$alluers = $this->dbuser->get_all_user_test();
		
		$i=1;
		$count_alluers = count($alluers);
		
		foreach($alluers as $alluers_row)
		{
		echo  $alluers_row->c;	
			if(($alluers_row->c) < $i)
			{
				$id = $alluers_row->mm_id;
				
				$data=array(
					'mm_username'=>friendlyURL($alluers_row->mm_username).$i
					);
				$result=$this->dbuser->update($data,$id);
				
				echo friendlyURL($alluers_row->mm_username).$i;
				echo '<br/>';
			}
			$i++;
		}*/
	}
	
}
?>