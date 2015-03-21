<?php

class Dblogin extends CI_Model

{

	

	public function checkuser($username,$password)

	{

		$sql="SELECT * FROM admin WHERE (email='".$username."' OR username='".$username."') and password='".md5($password)."' AND status = '1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	public function valideemail($email)

	{

		$sql="SELECT * FROM admin WHERE email='".$email."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	public function reset_retrive($code)

	{

		$sql="SELECT * FROM admin WHERE seq_code='".$code."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("id", $id);

		if($this->db->update('admin', $data))

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

		$this->db->where("seq_code", $id);

		if($this->db->update('admin', $data))

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