<?php
class Dbmedia extends CI_Model
{
	function count_media()
	{
		$sql="SELECT a.media_id, b.ch_id FROM media a, chapters b WHERE a.media_ch_id = b.ch_id ORDER BY a.media_id DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_media($num,$offset)
	{
		$sql="SELECT a.*, b.* FROM media a, chapters b WHERE a.media_ch_id = b.ch_id ORDER BY a.media_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add_media($data)
	{
		if($this->db->insert('media', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_media($data,$id)
	{
		$this->db->where("media_id", $id);
		if($this->db->update('media', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_media($id)
	{
		$this->db->delete('media', array('media_id' => $id));
		return true;	
	}
	
	function get_media($id)
	{
		$sql="SELECT * FROM media WHERE media_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
}
?>