<?php
class Dbcovers extends CI_Model
{
	var $covers_tbl='covers';
	var $covers_cat_tbl='covers_cat';
	
	public function get_photos($id)
	{
		$sql="SELECT * FROM $this->covers_tbl WHERE covers_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_covers()
	{
		$sql = "SELECT covers_id FROM $this->covers_tbl WHERE covers_status !=2";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_covers($num,$offset)
	{
		$sql="SELECT * FROM $this->covers_tbl WHERE covers_status !=2 ORDER BY covers_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_photos_search($keyword,$cat)
	{
		if($keyword != '0' && $cat != '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and (a.covers_name like '%".$keyword."%' and b.covers_cat_id = '".$cat."') ORDER BY a.covers_id DESC";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		elseif($keyword != '0' && $cat == '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and a.covers_name like '%".$keyword."%' ORDER BY a.covers_id DESC";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		elseif($keyword == '0' && $cat != '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and b.covers_cat_id = '".$cat."' ORDER BY a.covers_id DESC";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		else
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id ORDER BY a.covers_id DESC";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
	}
		
	function get_all_photos_search($keyword,$cat,$num,$offset)
	{
		if($keyword != '0' && $cat != '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and (a.covers_name like '%".$keyword."%' and b.covers_cat_id = '".$cat."') ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
			$query = $this->db->query($sql);
			return $query->result();
		}
		elseif($keyword != '0' && $cat == '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and a.covers_name like '%".$keyword."%' ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
			$query = $this->db->query($sql);
			return $query->result();
		}
		elseif($keyword == '0' && $cat != '0')
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id and b.covers_cat_id = '".$cat."' ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
			$query = $this->db->query($sql);
			return $query->result();
		}
		else
		{
			$sql = "SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status != 2 AND a.covers_cat_id = b.covers_cat_id ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
	
	function insert($data)
	{
		if($this->db->insert($this->covers_tbl, $data))
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
		$this->db->where("covers_id", $id);
		if($this->db->update($this->covers_tbl, $data))
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
		$this->db->delete($this->covers_tbl, array('covers_id' => $id));
		return true;	
	}
		
	function get_cat($id)
	{
		$sql="SELECT * FROM $this->covers_cat_tbl WHERE covers_cat_id = '$id'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_categories()
	{
		$sql="SELECT * FROM $this->covers_cat_tbl WHERE covers_cat_id !='0' ORDER BY covers_cat_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function check_seo($seo)
	{
		$sql="select * from $this->covers_tbl where covers_seo = '".$seo."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_seo_edit($seo,$id)
	{
		$sql="select * from $this->covers_tbl where covers_seo = '".$seo."' and covers_id !='".$id."'";
        $query = $this->db->query($sql);
		return $query->row();
	}
}
?>