<?php
class Dbblog extends CI_Model
{
	function count_blogs()
	{
		$sql="SELECT b.* FROM blog a, chapter_to_blogs b WHERE a.bid = b.blog_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_blogs($chId)
	{
		//$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE a.bid = b.blog_id AND b.m_id = '".$this->session->userdata('user_id')."' ORDER BY a.bid DESC ";
		$sql="SELECT a.* FROM blog a, chapter_to_blogs b WHERE a.bid = b.blog_id AND a.send_mail_to = '".$this->session->userdata('user_id')."' AND b.ch_id = '".$chId."' ORDER BY a.bid DESC ";
		$query = $this->db->query($sql);
		return $query->result();
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
	function blog_details($ch_id)
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT a.* FROM blog a, chapter_to_blogs b WHERE  a.bid = b.blog_id AND b.ch_id= '".$ch_id."' AND a.status = 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function member_blog_details()
	{
		//$sql="SELECT a.* FROM blog a, member_to_blogs b WHERE  a.bid = b.blog_id AND a.status = 1 ";
		$sql="SELECT * FROM blog WHERE status=1 AND verify=1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function member_blog_details_row($id)
	{
		$sql="SELECT * FROM blog WHERE bid='".$id."' AND status = 1 AND verify=1 ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_all_comments($blog_id,$limit,$offset) 
	{
		$sql="SELECT * FROM blog_comment WHERE blog_id= '".$blog_id."' AND verify=1 ORDER BY comment_id DESC LIMIT ".$offset.",".$limit."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_all_comments_count($blog_id)
	{
		$sql="SELECT * FROM blog_comment WHERE blog_id= '".$blog_id."' AND verify = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_reply_count($blog_id)
	{
		$sql="SELECT * FROM blog_reply WHERE blog_id= '".$blog_id."' AND verify = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_reply($comment_id,$blog_id)
	{
		$sql="SELECT * FROM blog_reply WHERE comment_id= '".$comment_id."' AND blog_id= '".$blog_id."' AND verify=1 ORDER BY reply_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_ch_from_state($state_id)
	{
		$sql="SELECT ch_id FROM chapter_to_state WHERE state_id = '".$state_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function insert_ch_to_blog($data)
	{
		if($this->db->insert('chapter_to_blogs', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_all_chapters($bid)
	{
		$sql="SELECT * FROM chapter_to_blogs WHERE blog_id = '".$bid."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>