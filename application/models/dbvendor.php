<?php
class Dbvendor extends CI_Model
{
	function get_venders($id)
	{	
	
	    $sql="select a.*,b.* ,ch.* from category a, vendors b , chapter_to_vendor ch where a.category_id = '".$id."' AND a.category_id = b.category_id AND ch.vendor_id= b.vendor_id AND ch.ch_id = 0";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_category()
	{
$sql="SELECT DISTINCT (
a.category_id
), a. *
FROM category a
INNER JOIN vendors b ON a.category_id = b.category_id
INNER JOIN chapter_to_vendor ch ON ch.vendor_id = b.vendor_id WHERE ch.ch_id =0";
				$query = $this->db->query($sql);
		return $query->result();
	}
	
		function get_all_chapters($id)
	{
	$sql= "SELECT DISTINCT (
a.ch_id
), a. *
FROM chapters a
INNER JOIN chapter_to_vendor b ON a.ch_id = b.ch_id INNER JOIN vendors ven ON ven.vendor_id=b.vendor_id INNER JOIN category cat ON cat.category_id=ven.category_id
 WHERE b.ch_id !=0 AND cat.category_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
		function get_all_category()
	{
      $sql="SELECT DISTINCT (
a.category_id
), a. *
FROM category a
INNER JOIN vendors b ON a.category_id = b.category_id
INNER JOIN chapter_to_vendor ch ON ch.vendor_id = b.vendor_id WHERE ch.ch_id != 0 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
		function get_all_venders($ch_id,$id)
	{	
	    $sql="select a.*,b.* ,ch.* from category a, vendors b , chapter_to_vendor ch where a.category_id = b.category_id AND ch.vendor_id= b.vendor_id AND ch.ch_id = '".$ch_id."' AND a.category_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
		function get_chapters()
	{
		
		$sql= "SELECT DISTINCT (
a.ch_id
), a. *
FROM chapters a
INNER JOIN chapter_to_vendor b ON a.ch_id = b.ch_id
 WHERE b.ch_id=0";
		$query = $this->db->query($sql);
		return $query->result();
	}
		/*function get_all_chapters()
	{
		
		$sql= "SELECT DISTINCT (
a.ch_id
), a. *
FROM chapters a
INNER JOIN chapter_to_vendor b ON a.ch_id = b.ch_id
 WHERE b.ch_id !=0";
		$query = $this->db->query($sql);
		return $query->result();
		$query = $this->db->query($sql);
		return $query->result();
	}*/
}
?>