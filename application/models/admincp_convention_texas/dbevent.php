<?php
class Dbevent extends CI_Model
{
	
	function get_event($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events WHERE ce_id ='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function count_event()

	{

		$sql = "SELECT ce_id FROM ".$this->config->item('convention_texas_db_prefix')."events";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_event($num,$offset)
	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events ORDER BY ce_activity ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}



	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'events', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

}

?>