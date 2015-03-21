<?php
class Dbevents extends CI_Model
{
	function count_events($search_key)
	{
		$sql = "SELECT ce_id FROM ".$this->config->item('convention_db_prefix')."events WHERE ce_activity like '%".$search_key."%'";

		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_events($search_key,$num,$offset)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."events WHERE ce_activity like '%".$search_key."%' ORDER BY ce_activity ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_event_export_to_excel($search_key)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."events WHERE ce_activity like '%".$search_key."%' ORDER BY ce_activity ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_event_member_export_to_excel($ce_id)
	{
		$sql="SELECT a.*,b.* FROM ".$this->config->item('convention_db_prefix')."events_member_group  a 
INNER JOIN  ".$this->config->item('convention_db_prefix')."events_member b ON a.cem_id=b.ce_mem_id 	
WHERE a.ce_id='".$ce_id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function member_blog_details($num,$offset)
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE  a.bid = b.blog_id AND a.by_mem =1 ORDER BY bid DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_member_blog()
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE  a.bid = b.blog_id AND a.by_mem =1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_event_by_id($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."events WHERE ce_id = '".$id."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function add($data)
	{
		if($this->db->insert($this->config->item('convention_db_prefix').'events', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit($data,$id)
	{
		$this->db->where("ce_id", $id);
		if($this->db->update($this->config->item('convention_db_prefix').'events', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete($id)
	{
		$this->db->delete($this->config->item('convention_db_prefix').'events', array('ce_id' => $id));
		return true;
	}
}
?>