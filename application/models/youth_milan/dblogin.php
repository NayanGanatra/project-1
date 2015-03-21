<?php

class Dblogin extends CI_Model

{

	

	public function checkuser($username,$password)

	{

		//$sql="SELECT * FROM member_master WHERE mm_username='".$username."' and mm_password='".md5($password)."' LIMIT 1";

		$sql="SELECT * FROM member_master WHERE (mm_email ='".$username."' OR mm_username ='".$username."') and mm_password='".md5($password)."' AND mm_status = '1' LIMIT 1";
		
		$query = $this->db->query($sql);

		return $query->row();

	}

}

?>