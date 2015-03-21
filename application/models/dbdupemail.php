<?php
class Dbdupemail extends CI_Model {
	
	function dup_email()
	{
		
$sql="SELECT mm_email
FROM member_master
GROUP BY mm_email
HAVING count( mm_email ) >1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function check_email($email)
	{
		
		$sql="SELECT * FROM member_master where mm_email='".$email."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function check_log($id)
	{
		
		$sql = "SELECT * FROM `login_log` WHERE `mm_id` =".$id;
		$query = $this->db->query($sql);
		return $query->result();
	}
	
}
?> 