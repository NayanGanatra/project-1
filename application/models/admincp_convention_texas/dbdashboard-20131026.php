<?php

class Dbdashboard extends CI_Model

{

	//var $tbl='con_medical_form';

	
	
	function count_reg()

	{

		$sql ="SELECT * FROM con_fees_member";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_member()

	{

		$sql ="SELECT * FROM con_fees_member_group";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_event()

	{

		$sql ="SELECT * FROM  con_events_member";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_member_to_event()

	{

		$sql ="SELECT * FROM con_events_member_group";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

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