<?php
class Dbtest extends CI_Model
{
	
	function getall()
	{
		$sql="SELECT * FROM states ORDER BY state_name ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_cities($state_code)
	{
		$sql="SELECT * FROM cities WHERE state_code = '".$state_code."' GROUP BY city ORDER BY city ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function insert($data)
	{
		if($this->db->insert('city', $data))
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