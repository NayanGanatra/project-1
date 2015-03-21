<?php
class Dbcreate extends CI_Model
{
	
	function insert($data)
	{
		if($this->db->insert('covers', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update_covers_status($data,$id)
	{
		$this->db->where("covers_id", $id);
		if($this->db->update('covers', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_cats()
	{
		$sql="SELECT * FROM assets_cat ORDER BY assets_cat_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function assets_by_cat($id)
	{
		$sql="SELECT * FROM assets WHERE assets_cat_id = ".$id." ORDER BY assets_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getcover($seo)
	{
		$query = $this->db->get_where('covers', array('covers_seo' => $seo));
		return $query->row();
	}

}
?>