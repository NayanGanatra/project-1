<?php
class Dbblog extends CI_Model
{
	function count_blogs()
	{
		$sql="SELECT b.* FROM blog a, chapter_to_blogs b WHERE a.bid = b.blog_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_blogs($num,$offset)
	{
		$sql="SELECT a.* FROM blog a, chapter_to_blogs b WHERE a.bid = b.blog_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY a.bid DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function member_blog_details($num,$offset)
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE  a.bid = b.blog_id AND a.by_mem =1 ORDER BY bid DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_member_blog()
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE  a.bid = b.blog_id AND a.by_mem =1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_blog_by_id($id)
	{
		$sql="SELECT * FROM blog WHERE bid = '".$id."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function add($data)
	{
		if($this->db->insert('blog', $data))
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
		$this->db->where("bid", $id);
		if($this->db->update('blog', $data))
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
		$this->db->delete('blog', array('bid' => $id));
		return true;	
	}
}
?>