<?php
class Dbcategories extends CI_Model
{
	var $page_tbl='covers_cat';
	
	function get_cat($id)
	{
		$sql="SELECT * FROM $this->page_tbl WHERE covers_cat_id='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_cat()
	{
		$sql = "SELECT covers_cat_id FROM $this->page_tbl WHERE covers_cat_id !=0";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_cat($num,$offset)
	{
		$sql="SELECT * FROM $this->page_tbl WHERE covers_cat_id !=0 ORDER BY covers_cat_order_by ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function check_seo($seo)
	{
		$sql="select * from $this->page_tbl where covers_cat_seo = '".$seo."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_seo_edit($seo,$id)
	{
		$sql="select * from $this->page_tbl where covers_cat_seo = '".$seo."' and covers_cat_id !='$id'";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert($data)
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
	
	function edit($data,$id)
	{
		$this->db->where("covers_cat_id", $id);
		if($this->db->update($this->page_tbl, $data))
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
		$this->db->delete($this->page_tbl, array('covers_cat_id' => $id));
		return true;	
	}
	
}
?>