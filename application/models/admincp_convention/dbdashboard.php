<?php

class Dbdashboard extends CI_Model

{

	//var $tbl='con_medical_form';

	
	
	function count_reg()

	{

		$sql ="SELECT * FROM con_fees_member ORDER BY fm_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_member()

	{

		$sql ="SELECT a.* FROM con_fees_member a, con_fees_member_group b where a.fm_id = b.fm_id ORDER BY a.fm_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_event()

	{

		$sql ="SELECT * FROM con_events_member";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_member_to_event()

	{

		$sql ="SELECT a.* FROM con_events_member a, con_events_member_group b where a.ce_mem_id = b.cem_id ORDER BY a.ce_mem_id";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_program()

	{

		$sql ="SELECT * FROM con_program_member";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_participant_to_program()

	{

		$sql ="SELECT * FROM con_program_to_participant";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_medical()

	{

		$sql ="SELECT * FROM con_medical_form";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	
}

?>