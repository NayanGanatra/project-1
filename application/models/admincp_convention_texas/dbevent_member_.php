<?php
class Dbevent_member extends CI_Model
{

	function count_event_member()
	{
		$sql = "SELECT ce_mem_id FROM ".$this->config->item('convention_texas_db_prefix')."events_member";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_event_member($num,$offset)
	{
		$sql="SELECT distinct(email_id) FROM ".$this->config->item('convention_texas_db_prefix')."event_registration ORDER BY email_id DESC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_event_amount($email)
	{
		$sql="SELECT event_amount,payment_type,payment_status FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember where fm_email='$email'";
		
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
	function get_con_event_detail_by_id()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events ORDER BY ce_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_con_event($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events where ce_id=$id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_con_event_detail_by_id1($email)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."event_registration where email_id='".$email."'";
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
		$this->db->where("email_id", $ce_mem_id);
		//$this->db->where("ce_id", $ce_id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'event_registration', $data))
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
		$this->db->where("email_id", $ce_mem_id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'event_registration', $data))
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
	function delete_con_event($email)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'event_registration', array('email_id' => $email));
		return true;	
	}
	function delete_con_event_group($ce_mem_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member_group', array('cem_id' => $ce_mem_id));
		return true;	
	}
	function get_event_group_detail_by_id($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_group WHERE ce_id=".$id."";
		$query = $this->db->query($sql);
		return $query->result();
	}
/*	function get_member_event_group_detail_by_id($email,$ce_id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member_group WHERE cem_id=".$email." AND ce_id=".$ce_id." LIMIT 1";
		
		$query = $this->db->query($sql);
		return $query->row();
	}*/
	function get_member_event_group_detail_by_id($email)
	{
		//$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."events_member_group WHERE cem_id=".$ce_mem_id." AND ce_id=".$ce_id." LIMIT 1";
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."event_registration WHERE email_id='".$email."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_user_using_id($mm_id)
	{
		$sql="SELECT * FROM member_master WHERE mm_id='".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>