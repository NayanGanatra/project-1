<?php
class Dbvendor extends CI_Model
{
	var $page_tbl='vendors';
	
	function get_venders($id)
	{
		//$sql="SELECT cat.*,ven.* FROM $this->page_tbl ven INNER JOIN category cat ON cat.category_id=ven.category_id WHERE vender_id='".$id."' LIMIT 1";
		
		$sql= "SELECT cat.*,ven.* FROM vendors ven LEFT JOIN category cat ON cat.category_id=ven.category_id WHERE vendor_id='".$id."' LIMIT 1";
		
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_venders()
	{
		$sql = "SELECT vendor_id FROM vendors";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_venders($num,$offset)
	{
		//$sql="SELECT * FROM $this->page_tbl ven LEFT JOIN category cat ON cat.category_id=ven.category_id UNION SELECT * FROM $this->page_tbl ven RIGHT JOIN category cat ON cat.category_id = ven.category_id LIMIT ".$offset.", ".$num."";
		
		$sql= "SELECT cat.*,ven.* FROM vendors ven LEFT JOIN category cat ON cat.category_id=ven.category_id ORDER BY vendor_name ASC LIMIT ".$offset.", ".$num."";
		
		//"SELECT cat.*,ven.* FROM $this->page_tbl ven LEFT JOIN category cat ON cat.category_id=ven.category_id ORDER BY vender_name ASC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
    function insert($data)
	{
		
		if($this->db->insert('vendors', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function insert_ch_to_vender($data)
	{
		if($this->db->insert('chapter_to_vendor', $data))
		{
			
		}
		else
		{
			return false;
		}
	}
	
	function edit($data,$id)
	{
		$this->db->where("vendor_id", $id);
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
		$this->db->delete($this->page_tbl, array('vendor_id' => $id));
		return true;	
	}
	
    function delete_ch_to_vender($id)
	{
		$this->db->delete('chapter_to_vendor', array('vendor_id' => $id));
		return true;	
	}
	
	  function ch_to_vender($vender_id,$ch_id)
	{
		$sql="select * from chapter_to_vendor where vendor_id = '".$vender_id."' AND ch_id = '".$ch_id."' LIMIT 1";
        
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>