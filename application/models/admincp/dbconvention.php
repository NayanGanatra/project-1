<?php

class Dbconvention extends CI_Model

{

	var $tbl='admin_convention';

	

	function insert($data)

	{

		if($this->db->insert($this->tbl, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_convention()

	{

		$sql = "SELECT con_id FROM $this->tbl";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_con($num,$offset)

	{

		$sql="SELECT * FROM $this->tbl ORDER BY con_id LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function con_detail($id)

	{

		$sql="SELECT * FROM $this->tbl WHERE con_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("con_id", $id);

		if($this->db->update($this->tbl, $data))

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

		$this->db->delete($this->tbl, array('con_id' => $id));

		return true;	

	}

	function get_chapter()

	{

		$sql="SELECT * FROM chapters WHERE ch_id != '0'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
}

?>