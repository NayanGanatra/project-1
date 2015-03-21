<?php
class Dbsettings extends CI_Model
{
	
	public function getsettings($name)
	{
		$sql="SELECT value FROM settings WHERE name='".$name."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit($data,$id)
	{
		$this->db->where('id', $id);
		if($this->db->update('settings', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function count_slider()
	{
		$sql="SELECT id FROM slider";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_slider()
	{
		$sql="SELECT * FROM slider ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function insert_slider($data)
	{
		if($this->db->insert('slider', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_slider($data,$id)
	{
		$this->db->where("id", $id);
		if($this->db->update('slider', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get_slide($id)
	{
		$sql="SELECT * FROM slider WHERE id='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function delete_slider($id)
	{
		$this->db->delete('slider', array('id' => $id));
		return true;	
	}
	
	function get_fields()
	{
		$sql="SELECT * FROM fields ORDER BY field_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_field_by_id($id)
	{
		$sql="SELECT * FROM fields WHERE field_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>