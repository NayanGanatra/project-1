<?php
class Dbpassword extends CI_Model
{
	
	function change($data,$id)
	{
		$this->db->where('id', $id);
		if($this->db->update('admin', $data))
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
		$sql="select * from admin where password='".md5($str)."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_current_user_detail($id)
	{
		$sql="select email from admin where id='$id'";
        $query = $this->db->query($sql);
		return $query->row();
	}
}
?>