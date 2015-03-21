<?php
class Dbassets extends CI_Model
{
	var $page_tbl='assets_cat';
	var $page_tbl2='assets';
	
	function get_cat($id)
	{
		$sql="SELECT * FROM $this->page_tbl WHERE assets_cat_id='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_cat()
	{
		$sql = "SELECT assets_cat_id FROM $this->page_tbl";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_cat($num,$offset)
	{
		$sql="SELECT * FROM $this->page_tbl ORDER BY assets_cat_name ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_cats()
	{
		$sql="SELECT * FROM $this->page_tbl ORDER BY assets_cat_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function insert_cat($data)
	{
		if($this->db->insert($this->page_tbl, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_cat($data,$id)
	{
		$this->db->where("assets_cat_id", $id);
		if($this->db->update($this->page_tbl, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_cat($id)
	{
		$this->db->delete($this->page_tbl, array('assets_cat_id' => $id));
		return true;	
	}
	
	function insert($data)
	{
		if($this->db->insert($this->page_tbl2, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function count_assets()
	{
		$sql = "SELECT assets_cat_id FROM $this->page_tbl2";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	
	function get_all_assets($num,$offset)
	{
		$sql="SELECT a.*,b.* FROM $this->page_tbl2 a, $this->page_tbl b WHERE a.assets_cat_id = b.assets_cat_id ORDER BY a.assets_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_asset($id)
	{
		$sql="SELECT a.*,b.* FROM $this->page_tbl2 a,$this->page_tbl b WHERE a.assets_cat_id = b.assets_cat_id AND a.assets_id='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function delete($id)
	{
		$this->db->delete($this->page_tbl2, array('assets_id' => $id));
		return true;	
	}
	
	function edit($data,$id)
	{
		$this->db->where("assets_id", $id);
		if($this->db->update($this->page_tbl2, $data))
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