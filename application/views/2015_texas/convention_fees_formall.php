<?php 
	$data['item'] = $this->dbconvention_registration->get_fees_st_detail_by_id();
	if($data['item'])
	{
		$id = $data['item']->fees_st_id;
		
		$data['get_relationship'] = $this->dbconvention_registration->get_relationship($this->session->userdata('user_id'));
		if(!$data['get_relationship'])
		{
			$userinfo = $this->dbconvention_registration->get_chapter_from_mm_id($this->session->userdata('user_id'));
			$data['get_relationship'] = $this->dbconvention_registration->get_relationship_sub($userinfo->mm_family_id,$this->session->userdata('user_id'));
		}
		$data['itema'] = $this->dbconvention_registration->get_fees_group_detail_by_id($data['item']->fees_st_id,'A');
		$data['itemb'] = $this->dbconvention_registration->get_fees_group_detail_by_id($data['item']->fees_st_id,'B');
		$data['itemc'] = $this->dbconvention_registration->get_fees_group_detail_by_id($data['item']->fees_st_id,'C');
		
	    if(isset($payment_type) && $payment_type == "paypal"){
			
			$this->load->view($this->config->item('convention_texas_folder').'convention_paypal',$data);
		}
		else 
		{
			$this->load->view($this->config->item('convention_texas_folder').'convention_fees_view',$data);
			$data['reg_status']=$this->dbconvention_registration->get_user_status();
			$this->load->view($this->config->item('convention_texas_folder').'convention_fees_add_all',$data);
		}
		
	}
	else
	{ ?>
		<p style="margin-top:30px;">Data not found</p>
	<?php }
	    
?>