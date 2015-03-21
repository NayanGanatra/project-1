<?php 
	$data['reg_status']=$this->dbconvention_event_member->get_user_status();
	$data['items'] = $this->dbconvention_event_member->get_con_event_detail_by_id();
	if($data['items'])
	{
		$this->load->view($this->config->item('convention_texas_folder').'convention_event_member_edit',$data);
		if($data['reg_status']>0)
		{
			$this->load->view($this->config->item('convention_texas_folder').'convention_event_member_view',$data);
		}
		else
		{
			$this->load->view($this->config->item('convention_texas_folder').'convention_event_member_add',$data);
		}
	}
	else
	{ ?>
		<p style="margin-top:30px;">Data not found</p>
	<?php }
	    
?>