<?php
class Dbfees extends CI_Model
{

	function count_fees_st()
	{
		$sql = "SELECT fees_st_id FROM ".$this->config->item('convention_db_prefix')."fees_structure";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_fees_st()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."fees_structure ORDER BY fees_st_id DESC";
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
	function get_fees_st_detail_by_id($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."fees_structure WHERE fees_st_id = '".$id."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function add_fees_st($data)
	{
		if($this->db->insert($this->config->item('convention_db_prefix').'fees_structure', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function add_fees_st_groups($data)
	{
		if($this->db->insert($this->config->item('convention_db_prefix').'fees_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_fees_st($data,$id)
	{
		$this->db->where("fees_st_id", $id);
		if($this->db->update($this->config->item('convention_db_prefix').'fees_structure', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_fees_st_group($data,$sid,$gid)
	{
		$this->db->where("fees_st_id", $sid);
		$this->db->where("fees_st_age_grp", $gid);
		if($this->db->update($this->config->item('convention_db_prefix').'fees_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete_fees_st($id)
	{
		$this->db->delete($this->config->item('convention_db_prefix').'fees_structure', array('fees_st_id' => $id));
		return true;	
	}
	function delete_fees_st_group($id)
	{
		$this->db->delete($this->config->item('convention_db_prefix').'fees_group', array('fees_st_id' => $id));
		return true;	
	}
	function get_fees_group_detail_by_id($id,$gid)
	{
		$sql="SELECT * FROM  ".$this->config->item('convention_db_prefix')."fees_group WHERE fees_st_id=".$id." AND fees_st_age_grp='".$gid."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>