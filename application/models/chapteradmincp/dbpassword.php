<?php

class Dbpassword extends CI_Model

{

	

	function change($data,$id)

	{

		$this->db->where('mm_id', $id);

		if($this->db->update('member_master', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function qur($str)

	{

		$sql="select * from member_master where mm_password='".md5($str)."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_current_user_detail($id)

	{

		$sql="select mm_email as email from member_master where mm_id='".$id."' LIMIT 1";

        $query = $this->db->query($sql);

		

		return $query->row();

	}

}

?>