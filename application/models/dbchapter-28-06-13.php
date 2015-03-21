<?php
class Dbchapter extends CI_Model
{
	////// Chapters ////////
	function chapter($ch_seo)
	{
		$sql="SELECT * FROM chapters WHERE ch_seo = '".$ch_seo."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function states_of_chapter($ch_id)
	{
		$sql="SELECT a.*,b.state_name FROM chapter_to_state a, states b WHERE a.ch_id = '".$ch_id."' AND a.state_id = b.state_id ORDER BY b.state_name";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function chapter_byid($id)
	{
		$sql="SELECT * FROM chapters WHERE ch_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function chapter_to_state($ch_id)
	{
		$sql="SELECT * FROM chapter_to_state WHERE ch_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_chapters()
	{
		$sql="SELECT ch_id FROM chapters WHERE ch_id !=0 ORDER BY ch_name ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_all_chapters($offset,$num)
	{
		$sql="SELECT * FROM chapters WHERE ch_id !=0 ORDER BY ch_name ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	////// News ////////
	function count_ch_news($ch_id)
	{
		$sql="SELECT a.*, b.*  FROM news a, chapters b WHERE a.news_ch_id = '".$ch_id."' AND a.news_ch_id = b.ch_id AND news_status !=0 ORDER BY news_create DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_news($offset,$num,$ch_id)
	{
		$sql="SELECT a.*, b.*  FROM news a, chapters b WHERE a.news_ch_id = '".$ch_id."' AND a.news_ch_id = b.ch_id  AND news_status !=0 ORDER BY news_create DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_news()
	{
		$sql="SELECT a.news_id, b.ch_id FROM news a, chapters b WHERE a.news_ch_id = 0 AND a.news_ch_id = b.ch_id  AND news_status !=0  ORDER BY a.news_create DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_all_news($offset,$num)
	{
		$sql="SELECT a.*, b.* FROM news a, chapters b WHERE a.news_ch_id = 0 AND a.news_ch_id = b.ch_id ORDER BY a.news_create DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function latesr_news($ch_id,$limit)
	{
		$sql="SELECT * FROM news WHERE news_ch_id = '".$ch_id."' AND news_status !=0 ORDER BY news_create DESC LIMIT ".$limit."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_news($id,$ch_id)
	{
		$sql="SELECT * FROM news WHERE news_ch_id = '".$ch_id."' AND news_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function news_byid($id)
	{
		$sql="SELECT * FROM news WHERE news_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	////// Events ////////
	function event_byid($id)
	{
		$sql="SELECT * FROM events WHERE event_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function latesr_events($ch_id,$limit)
	{
		$sql="SELECT * FROM events WHERE event_ch_id = '".$ch_id."' AND event_status !=0 ORDER BY event_date_time DESC LIMIT ".$limit."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_ch_events($ch_id)
	{
		$sql="SELECT event_id FROM events WHERE event_ch_id = '".$ch_id."' AND event_status !=0  ORDER BY event_date_time DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_events($offset,$num,$ch_id)
	{
		$sql="SELECT * FROM events WHERE event_ch_id = '".$ch_id."' AND event_status !=0 ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_events()
	{
		$sql="SELECT a.event_id, b.ch_id FROM events a, chapters b WHERE a.event_ch_id = 0 AND a.event_ch_id = b.ch_id ORDER BY event_date_time DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_all_events($offset,$num)
	{
		$sql="SELECT a.*, b.* FROM events a, chapters b WHERE a.event_ch_id = 0 AND a.event_ch_id = b.ch_id ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	////// Media ////////
	function latesr_media($ch_id,$limit)
	{
		$sql="SELECT * FROM media WHERE media_ch_id = '".$ch_id."' ORDER BY media_id DESC LIMIT ".$limit."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_ch_media($ch_id)
	{
		$sql="SELECT a.media_id,b.ch_id FROM media a, chapters b WHERE a.media_ch_id = b.ch_id AND a.media_ch_id = '".$ch_id."' ORDER BY a.media_id DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_ch_media($offset,$num,$ch_id)
	{
		$sql="SELECT a.*,b.* FROM media a, chapters b WHERE a.media_ch_id = b.ch_id AND a.media_ch_id = '".$ch_id."'  ORDER BY media_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_media()
	{
		$sql="SELECT a.media_id, b.ch_id FROM media a, chapters b WHERE a.media_ch_id = 0 AND a.media_ch_id = b.ch_id ORDER BY a.media_date DESC";		
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_all_media($offset,$num)
	{
		$sql="SELECT a.*, b.* FROM media a, chapters b WHERE a.media_ch_id = 0 AND a.media_ch_id = b.ch_id ORDER BY a.media_date DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	////// Committee ////////
	
	function get_all_ch_cm_by_year($ch_id,$year)
	{
	$sql="SELECT a.*, b.ch_name, c.* FROM comitte_member a, chapters b, member_master c WHERE a.cm_ch_id = '".$ch_id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id AND a.cm_year = '".$year."' AND a.cm_status = '1' ORDER BY a.cm_order ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_ch_cm_by_current_year($ch_id,$year,$year2)
	{
	$sql="SELECT a.*, b.ch_name, c.* FROM comitte_member a, chapters b, member_master c WHERE a.cm_ch_id = '".$ch_id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id AND 
	(a.cm_year = '".$year."' OR a.cm_year2 = '".$year."') AND a.cm_status = '1' ORDER BY a.cm_order ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_cm_years($ch_id,$year)
	{
		$sql="SELECT * FROM comitte_member WHERE cm_ch_id = '".$ch_id."' AND cm_year != '".$year."' AND cm_status = '1' GROUP BY cm_year ORDER BY cm_year DESC";		
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_ch_cm_notin_year($ch_id,$year)
	{
	$sql="SELECT a.*, b.ch_name, c.* FROM comitte_member a, chapters b, member_master c WHERE a.cm_ch_id = '".$ch_id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id AND a.cm_year != '".$year."' AND a.cm_status = '1' ORDER BY a.cm_order ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>