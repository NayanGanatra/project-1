<?php
class Dbnews extends CI_Model
{
	var $tbl='news';
	
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
	
	function count_news()
	{
		$sql = "SELECT a.news_id,b.ch_id FROM news a, chapters b WHERE a.news_ch_id = b.ch_id";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_news($num,$offset)
	{
		$sql="SELECT a.*,b.* FROM news a, chapters b WHERE a.news_ch_id = b.ch_id ORDER BY news_create DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_news_by_id($id)
	{
		$sql = "SELECT a.*,b.* FROM news a, chapters b WHERE a.news_id = '".$id."' AND a.news_ch_id = b.ch_id LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit($data,$id)
	{
		$this->db->where("news_id", $id);
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
		$this->db->delete($this->tbl, array('news_id' => $id));
		return true;	
	}
	
}
?>