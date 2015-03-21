<?php
class Dbcategory extends CI_Model
{
	var $page_tbl='vendors';
	var $page_tb2='category';
	
	function get_category($id)
	{
		$sql="SELECT * FROM $this->page_tb2 WHERE category_id = '$id' ";
		
		//$sql="SELECT * FROM $this->page_tbl ven LEFT JOIN category cat ON cat.category_id=ven.category_id UNION SELECT * FROM $this->page_tbl ven RIGHT JOIN category cat ON cat.category_id=ven.category_id WHERE cat.category_id = '$id'";
		
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_category()
	{
		$sql = "SELECT category_id FROM $this->page_tb2";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_data($num,$offset)
	{
		$sql="SELECT * FROM WHERE category_id !=0 ORDER BY category_name ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_category($num,$offset)
	{ 
	   $sql="SELECT * FROM category LIMIT ".$offset.", ".$num."";
	   
/*		$sql="SELECT * FROM $this->page_tbl ven LEFT JOIN category cat ON cat.category_id=ven.category_id UNION SELECT * FROM $this->page_tbl ven RIGHT JOIN category cat ON cat.category_id = ven.category_id LIMIT ".$offset.", ".$num."";*/
		
		//$sql= "SELECT cat.*,ven.* FROM $this->page_tbl ven Right JOIN category cat ON cat.category_id=ven.category_id ORDER BY vender_name ASC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
    function insert($data)
	{
		if($this->db->insert($this->page_tb2, $data))
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
		$this->db->where("category_id", $id);
		if($this->db->update($this->page_tb2, $data))
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
		$this->db->delete($this->page_tb2, array('category_id' => $id));
		
		return true;	
	}
	
	function update_vender_category($id)
	{
		$sql = "UPDATE vendors SET category_id=0
WHERE category_id =$id";
		$query = $this->db->query($sql);
		return true;	
	}
	
	
	function get_ven($category_id)
	{
		
	   $sql="select a.*,b.* from category a, vendors b where a.category_id = '".$category_id."' AND a.category_id = b.category_id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
}
?>
