<?php
class Dbsearch extends CI_Model
{
	
	function count_data($keyword)
	{
		$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status='1' AND a.covers_cat_id = b.covers_cat_id and a.covers_name like '%".$keyword."%' ORDER BY a.covers_id DESC";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_data($keyword,$num,$offset)
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status='1' AND a.covers_cat_id = b.covers_cat_id and a.covers_name like '%".$keyword."%' ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
}