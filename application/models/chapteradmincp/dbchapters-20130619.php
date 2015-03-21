<?php
class Dbchapters extends CI_Model
{
	var $page_tbl='chapters';
	
	function get_item($id)
	{
		$sql="SELECT * FROM $this->page_tbl WHERE ch_id='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_data()
	{
		$sql = "SELECT ch_id FROM $this->page_tbl WHERE ch_id !=0 AND ch_id ='".$this->session->userdata('get_chapter_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_data($num,$offset)
	{
		$sql="SELECT * FROM $this->page_tbl WHERE ch_id !=0 AND ch_id ='".$this->session->userdata('get_chapter_id')."' ORDER BY ch_name ASC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function check_seo($seo)
	{
		$sql="select * from $this->page_tbl where ch_seo = '".$seo."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_seo_edit($seo,$id)
	{
		$sql="select * from $this->page_tbl where ch_seo = '".$seo."' and ch_id !='$id'";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_busy_states($id)
	{
		$sql="select * from chapter_to_state where state_id = '".$id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_busy_states_edit($id,$ch_id)
	{
		$sql="select * from chapter_to_state where state_id = '".$id."' and ch_id !='".$ch_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert($data)
	{
		if($this->db->insert($this->page_tbl, $data))
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
		$this->db->where("ch_id", $id);
		if($this->db->update($this->page_tbl, $data))
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
		$this->db->delete($this->page_tbl, array('ch_id' => $id));
		return true;	
	}
	
	function ch_to_state($state_id,$ch_id)
	{
		$sql="select * from chapter_to_state where state_id = '".$state_id."' AND ch_id = '".$ch_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert_ch_to_state($data)
	{
		if($this->db->insert('chapter_to_state', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_ch_to_state($id)
	{
		$this->db->delete('chapter_to_state', array('ch_id' => $id));
		return true;	
	}
	
	function get_chapters_states($ch_id)
	{
		$sql="select a.ch_id,b.* from chapter_to_state a, states b where a.ch_id = '".$ch_id."' AND a.state_id = b.state_id";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
}
?>