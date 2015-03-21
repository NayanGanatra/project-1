<?php
class Dblogin extends CI_Model
{
	
	public function checkuser($username,$password)
	{
		$sql="SELECT * FROM member_master WHERE mm_email='".$username."' and mm_password='".md5($password)."' AND mm_status = '1' AND mm_chapter_id!=0 LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	public function valideemail($email)
	{
		$sql="SELECT * FROM member_master WHERE mm_email='".$email."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	public function reset_retrive($code)
	{
		$sql="SELECT * FROM member_master WHERE mm_seq='".$code."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit($data,$id)
	{
		
		$this->db->where("mm_id", $id);
		if($this->db->update('member_master', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function set_password($data,$id)
	{
		$this->db->where("mm_seq", $id);
		if($this->db->update('member_master', $data))
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