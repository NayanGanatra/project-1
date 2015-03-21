<?php
class Dbvendor extends CI_Model
{
	var $page_tbl='vendors';
	
	function get_venders($id)
	{
		
	$sql= "SELECT cat.*,ven.* FROM $this->page_tbl ven LEFT JOIN category cat ON cat.category_id=ven.category_id WHERE vendor_id='".$id."' LIMIT 1";
	
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_venders()
	{
		$sql = "SELECT vendor_id FROM $this->page_tbl";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_venders($num,$offset)
	{
		$sql="SELECT a.*,b.*,cat.* FROM vendors a LEFT JOIN category cat ON cat.category_id=a.category_id , chapter_to_vendor b WHERE  a.vendor_id = b.vendor_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY vendor_name DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
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
	
	function insert_ch_to_vender($id,$ch_id)
	{
		$sql= "INSERT INTO chapter_to_vendor(vendor_id, ch_id) VALUES ('$id','$ch_id')";
		$query = $this->db->query($sql);
		return true;
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
	
	/*function delete($id)
	{
		$this->db->delete($this->page_tbl, array('vender_id' => $id));
		return true;	
	}*/
	
	function delete_ch_to_vender($id)
	{
		//$this->db->delete('chapter_to_ads', array('ads_id' => $id));
		$this->db->query("DELETE FROM chapter_to_vendor WHERE vendor_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");
		return true;	
	}
	
	function get_catgory()
	{
		$sql="SELECT * FROM category ORDER BY category_name ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
}
?>