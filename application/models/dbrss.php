<?php
class Dbrss extends CI_Model
{
	function GetLatestCatCovers($catseo)
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE b.covers_cat_seo = '".$catseo."' AND a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1' ORDER BY a.covers_id DESC LIMIT 100";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function GetLatestCovers()
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1' ORDER BY a.covers_id DESC LIMIT 100";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_category($catseo)
	{
		$sql="SELECT * FROM covers_cat WHERE covers_cat_seo = '".$catseo."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>