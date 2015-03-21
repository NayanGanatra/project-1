<?php
class Dbcon_detail extends CI_Model
{
	
	function all_members()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_con_members($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."' ORDER BY mm_fname ASC ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	function get_all_reg_form($mm_id)
	{
		$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_member a WHERE a.mm_id IN (SELECT mm_id from member_master WHERE mm_id = '".$mm_id."')";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_chapter_from_mm_id($mm_id)
	{
		$sql="SELECT c.*,a.ch_id,a.ch_name 
		FROM chapters a 
		INNER JOIN chapter_to_state b ON a.ch_id = b.ch_id
		INNER JOIN member_master c ON b.state_id = c.mm_state_id
		WHERE c.mm_id = '".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_member_from_mm_id($mm_id)

	{

		$sql="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_member a, con_fees_member_group b where a.mm_id = '".$mm_id."' and a.fm_id = b.fm_id";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_program_from_mm_id($mm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member where pm_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function count_medical_from_mm_id($mm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."medical_form where md_mm_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function subtotal_reg($mm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member where mm_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_event_from_mm_id($mm_id)

	{

		$sql="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."events_member a, con_events_member_group b where a.con_mm_id = '".$mm_id."' and a.ce_mem_id = b.cem_id";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function subtotal_event($mm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member where con_mm_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
}

?>