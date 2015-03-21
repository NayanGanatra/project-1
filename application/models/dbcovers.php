<?php
class Dbcovers extends CI_Model
{
	
	function count_cat_data($catseo)
	{
		$sql = "SELECT a.covers_id, b.covers_cat_id FROM covers a, covers_cat b WHERE b.covers_cat_seo = '".$catseo."' AND a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_cat_data($offset,$num,$catseo)
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE b.covers_cat_seo = '".$catseo."' AND a.covers_cat_id = b.covers_cat_id AND a.covers_status = '1' ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function cat_details($catseo)
	{
		$sql = "SELECT * FROM covers_cat WHERE covers_cat_seo = '".$catseo."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function getcover($seo)
	{
		$sql="select a.*,b.* from covers a, covers_cat b where a.covers_seo = '".$seo."' AND a.covers_cat_id = b.covers_cat_id";
        $query = $this->db->query($sql);
		return $query->row();
	}

}
?>