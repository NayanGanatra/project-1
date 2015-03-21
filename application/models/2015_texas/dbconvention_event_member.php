<?php


class Dbconvention_event_member extends CI_Model
{
	
	function count_event_member()
	{
	//echo $this->t;
	
		$sql = "SELECT ce_mem_id FROM ".$this->config->item('convention_texas_db_prefix')."events_member";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_event_member($num,$offset)
	{
	
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member ORDER BY ce_mem_id DESC LIMIT ".$offset.", ".$num."";
		//$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member ORDER BY ce_mem_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_user_status()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member WHERE con_mm_id='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_con_event_detail_by_id()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events ORDER BY ce_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function add_con_events_member($data)
	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'events_member', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function add_con_events_member_group($data)
	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'events_member_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_con_events_member_group($data,$ce_mem_id,$ce_id)
	{
	
		$this->db->where("con_mm_id", $ce_mem_id);
		$this->db->where("ce_id", $ce_id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'events_member_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_con_events_member($data,$ce_mem_id)
	{
	
		$this->db->where("ce_mem_id", $ce_mem_id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'events_member', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_con_event_group($data,$sid,$gid)
	{
	
	
		$this->db->where("ce_id", $sid);
		$this->db->where("ce_age_grp", $gid);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'events_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete_con_event($ce_mem_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member', array('ce_mem_id' => $ce_mem_id));
		return true;	
	}
	function delete_con_event_group($ce_mem_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member_group', array('cem_id' => $ce_mem_id));
		return true;	
	}
	function get_event_group_detail_by_id($id)
	{
		$sql="SELECT * FROM  ".$this->config->item('convention_texas_db_prefix')."events_group WHERE ce_id=".$id."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_member_event_group_detail_by_id($ce_mem_id,$ce_id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member_group WHERE cem_id=".$ce_mem_id." AND ce_id=".$ce_id." LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_user_using_id($mm_id)

	{
	

		$sql="SELECT * FROM member_master WHERE mm_id='".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	//added by ketan 20130913
	function get_user_status_of_con_event()
	{
	
	
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member WHERE con_mm_id='".$this->session->userdata('user_id')."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	//update end
	function ce_age_desc($id)
	{
	
		$sql="SELECT ce_age_desc FROM ".$this->config->item('convention_texas_db_prefix')."events where ce_id=".$id;
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_event_member_data($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member where ce_mem_id=".$id;
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>