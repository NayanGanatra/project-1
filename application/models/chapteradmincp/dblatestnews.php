<?php
class Dblatestnews extends CI_Model
{
	var $tbl='latest_news';
	
	function insert($data)
	{
		if($this->db->insert($this->tbl, $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function count_latestnews()
	{
		$sql = "SELECT latest_news_id FROM $this->tbl";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_latestnews($num,$offset)
	{
		$sql="SELECT * FROM $this->tbl ORDER BY latest_news_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_latestnews($id)
	{
		$sql="SELECT * FROM $this->tbl WHERE latest_news_id = '$id'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit($data,$id)
	{
		$this->db->where("latest_news_id", $id);
		if($this->db->update($this->tbl, $data))
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
		$this->db->delete($this->tbl, array('latest_news_id' => $id));
		return true;	
	}
	
}
?>