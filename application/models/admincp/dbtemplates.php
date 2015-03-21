<?php
class Dbtemplates extends CI_Model
{
	var $templates_tbl='templates';
	
	public function get_photos($id)
	{
		$sql="SELECT * FROM $this->templates_tbl WHERE templates_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_photos()
	{
		$sql = "SELECT templates_id FROM $this->templates_tbl";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_photos($num,$offset)
	{
		$sql="SELECT * FROM $this->templates_tbl ORDER BY templates_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function insert($data)
	{
		if($this->db->insert($this->templates_tbl, $data))
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
		$this->db->where("templates_id", $id);
		if($this->db->update($this->templates_tbl, $data))
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
		$this->db->delete($this->templates_tbl, array('templates_id' => $id));
		return true;	
	}
	
	public function getlastinsertedid()
	{
		$sql="SELECT templates_id FROM $this->templates_tbl ORDER BY templates_id DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	public function getnumofpicsintemp($id)
	{
		$sql="SELECT * FROM $this->templates_tbl where templates_id=$id";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert_dimen($data)
	{
		if($this->db->insert('temp_dimention', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_dimen($id)
	{
		$this->db->delete('temp_dimention', array('templates_id' => $id));
		return true;	
	}
}
?>