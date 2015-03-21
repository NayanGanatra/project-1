<?php
class Dbuser extends CI_Model
{
	var $tbl='member_master';
	var $ch_st_tbl=' chapter_to_state';
	var $ch_tbl='chapters';
	
	function get_user($id)
	{
		$sql="SELECT * FROM $this->tbl WHERE mm_chapter_id=0 AND mm_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_user()
	{
		//$sql = "SELECT mm_id FROM $this->tbl";
		$sql="SELECT b.* FROM $this->ch_st_tbl a, $this->tbl b WHERE b.mm_chapter_id=0 AND a.state_id = b.mm_state_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."'";
		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_user($num,$offset)
	{
$sql="SELECT b.* FROM  $this->ch_st_tbl a,$this->tbl b WHERE  b.mm_chapter_id=0 AND a.state_id = b.mm_state_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY mm_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function update($data,$id)
	{
		$this->db->where("mm_id", $id);
		if($this->db->update('member_master', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_ch_from_state($state_id)
	{
		$sql="SELECT ch_id FROM chapter_to_state WHERE state_id = '".$state_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

}
?>