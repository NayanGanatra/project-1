<?php
class Dbpopular extends CI_Model
{
	
	function count_popular_data()
	{
		$sql = "SELECT a.covers_id, b.covers_cat_id FROM covers a, covers_cat b WHERE a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_popular_data($offset,$num)
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1' ORDER BY a.covers_downloads DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}

}
?>