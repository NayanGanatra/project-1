<?php

class Dbadvertisements extends CI_Model

{

	var $tbl='ads';

	

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

	

	function count_ads()

	{

		$sql = "SELECT ads_id FROM $this->tbl";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_ads($num,$offset)

	{

		$sql="SELECT * FROM $this->tbl ORDER BY ads_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_ads($id)

	{

		$sql="SELECT * FROM $this->tbl WHERE ads_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("ads_id", $id);

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

		$this->db->delete($this->tbl, array('ads_id' => $id));

		return true;	

	}

	
	
}

?>