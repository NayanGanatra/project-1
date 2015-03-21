<?php
class Dbverification extends CI_Model
{
	var $tbl='member_master';
	var $tbl1='verification';
	
	/*function get_user_by_id($mm_id)
	{
		$sql="SELECT * FROM member_master WHERE mm_id = '".$mm_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_all_user_test()
	{
		$sql="SELECT  `mm_username` ,mm_id, COUNT( * ) c
				FROM member_master WHERE mm_varify='1' 
				GROUP BY  `mm_username` 
				HAVING c >1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	*/
	function count_verification()
	{
		$sql = "SELECT uid FROM verification";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_verification($num,$offset)
	{
		$sql="SELECT * FROM verification ORDER BY uid DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	function countemailSubscribers($id)
    {
		$sql="SELECT a.email_send,c.mm_username,c.mm_email FROM verification a 
INNER JOIN  verification_template_to_member b ON a.uid=b.email_template_id
INNER JOIN member_master c ON b.mm_id=c.mm_id where email_template_id='".$id."'";
		$query = $this->db->query($sql);
        return $query->num_rows();
    }
	
	function get_email_by_id($id)
	{
		$sql="SELECT * FROM verification WHERE uid = '".$id."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function add($data)
	{
		if($this->db->insert('verification', $data))
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
		$this->db->where("uid", $id);
		if($this->db->update('verification', $data))
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
		$this->db->delete('verification', array('uid' => $id));
		return true;	
	}
	/*
	function list_all_members_for_email()
	{
		$sql="SELECT * FROM member_master WHERE mm_varify='1' AND  mm_email !='' ORDER BY mm_fname ASC, mm_lname ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}*/
	
}
?>