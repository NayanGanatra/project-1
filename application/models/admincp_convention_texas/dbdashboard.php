<?php

class Dbdashboard extends CI_Model

{

	//var $tbl='con_medical_form';

	
	
	function count_reg()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember ORDER BY fm_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_member()

	{

		$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember a, ".$this->config->item('convention_texas_db_prefix')."fees_member_group b where a.fm_id = b.fm_id ORDER BY a.fm_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_event()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	function count_member_to_event()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."event_registration ";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	/*function count_member_to_event()

	{

		$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."events_member a, con_events_member_group b where a.ce_mem_id = b.cem_id ORDER BY a.ce_mem_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}*/
	
	function count_program()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_participant_to_program()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_medical()

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."medical_form";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	
}

?>