<?php
class Dbtemplate extends CI_Model
{
	var $tbl='template';
	var $ch_template_tbl='chapter_to_template';
	
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
	
	function count_template()
	{
		$sql="SELECT b.* FROM $this->ch_template_tbl a, $this->tbl b WHERE a.template_id = b.template_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_template($num,$offset)
	{
		$sql="SELECT b.* FROM  $this->ch_template_tbl a,$this->tbl b WHERE  a.template_id = b.template_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY template_title ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_template($id)
	{
		$sql="SELECT * FROM $this->tbl WHERE template_id = '$id'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit($data,$id)
	{
		$this->db->where("template_id", $id);
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
		$this->db->delete($this->tbl, array('template_id' => $id));
		return true;	
	}
	
}
?>