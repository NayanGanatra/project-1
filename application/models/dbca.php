<?php
class Dbca extends CI_Model
{
	/* News */	
	function count_ch_news($ch_id)
	{
		$sql="SELECT news_id FROM news WHERE news_ch_id = '".$ch_id."' ORDER BY news_create DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_news($offset,$num,$ch_id)
	{
		$sql="SELECT * FROM news WHERE news_ch_id = '".$ch_id."' ORDER BY news_create DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_news($id,$ch_id)
	{
		$sql="SELECT * FROM news WHERE news_ch_id = '".$ch_id."' AND news_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit_news($data,$id)
	{
		$this->db->where("news_id", $id);
		if($this->db->update('news', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function add_news($data)
	{
		if($this->db->insert('news', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_news($id)
	{
		$this->db->delete('news', array('news_id' => $id));
		return true;	
	}
	/* Events */
	function count_ch_events($ch_id)
	{
		$sql="SELECT event_id FROM events WHERE event_ch_id = '".$ch_id."' ORDER BY event_date_time DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_events($offset,$num,$ch_id)
	{
		$sql="SELECT * FROM events WHERE event_ch_id = '".$ch_id."' ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_event($id,$ch_id)
	{
		$sql="SELECT * FROM events WHERE event_ch_id = '".$ch_id."' AND event_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit_event($data,$id)
	{
		$this->db->where("event_id", $id);
		if($this->db->update('events', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function add_event($data)
	{
		if($this->db->insert('events', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_event($id)
	{
		$this->db->delete('events', array('event_id' => $id));
		return true;	
	}
	
	function event_inv_msg($event_id,$ch_id)
	{
		$sql="SELECT * FROM event_inv_msg WHERE event_id ='".$event_id."' AND msg_to_ch_id = '".$ch_id."' ORDER BY msg_time DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_user_by_id($mm_id)
	{
		$sql="SELECT mm_id,mm_username, mm_fname, mm_lname FROM member_master WHERE mm_id = '".$mm_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert_event_inv_msg($data)
	{
		if($this->db->insert('event_inv_msg', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/* Media */
	function count_ch_media($ch_id)
	{
		$sql="SELECT media_id FROM media WHERE media_ch_id = '".$ch_id."' ORDER BY media_id DESC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_media($offset,$num,$ch_id)
	{
		$sql="SELECT * FROM media WHERE media_ch_id = '".$ch_id."' ORDER BY media_id DESC LIMIT ".$offset.", ".$num."";
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
	
	function get_media($id,$ch_id)
	{
		$sql="SELECT * FROM media WHERE media_ch_id = '".$ch_id."' AND media_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	/* Committee */
	function count_ch_cm($ch_id)
	{
		$sql="SELECT a.cm_id, b.mm_id FROM comitte_member a, member_master b WHERE a.cm_mm_id=b.mm_id AND a.cm_ch_id = '".$ch_id."' ORDER BY cm_order ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_cm($offset,$num,$ch_id)
	{
		$sql="SELECT a.*, b.* FROM comitte_member a, member_master b WHERE a.cm_mm_id=b.mm_id AND a.cm_ch_id = '".$ch_id."' ORDER BY cm_order ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function add_cm($data)
	{
		if($this->db->insert('comitte_member', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_cm($data,$id)
	{
		$this->db->where("cm_id", $id);
		if($this->db->update('comitte_member', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_cm($id)
	{
		$this->db->delete('comitte_member', array('cm_id' => $id));
		return true;	
	}
	
	function get_cm($id,$ch_id)
	{
		$sql="SELECT * FROM comitte_member WHERE cm_ch_id = '".$ch_id."' AND cm_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	///// members
	
	function get_members($ch_id)
	{
		$sql="SELECT *
		FROM member_master a
		INNER JOIN chapter_to_state b
		ON a.mm_state_id = b.state_id WHERE b.ch_id = ".$ch_id." AND a.mm_status = 1 ORDER BY mm_fname ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_state_from_ch_id($ch_id)
	{
		$sql="SELECT state_id FROM chapter_to_state WHERE ch_id = '".$ch_id."' ORDER BY state_id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function insert_event_msg($data)
	{
		if($this->db->insert('event_msg', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function insert_event_invitation($data)
	{
		if($this->db->insert('event_invitation', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_member_email_by_mm_id($mm_id)
	{
		$sql="SELECT mm_email,mm_fname,mm_lname FROM member_master WHERE mm_id = '".$mm_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_event_invitation($mm_id,$event_id)
	{
		$sql="SELECT ei_id,email_status FROM event_invitation WHERE mm_id = '".$mm_id."' AND event_id = '".$event_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit_event_invitation($data,$id)
	{
		$this->db->where("ei_id", $id);
		if($this->db->update('event_invitation', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/////////////// page
	
	function check_seo($slug)
	{
		$sql="SELECT * FROM pages WHERE page_seo = '".$slug."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_seo_edit($slug,$id)
	{
		$sql="SELECT * FROM pages WHERE page_seo = '".$slug."' AND page_id !='".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	
	function count_ch_pages($ch_id)
	{
		$sql="SELECT page_id FROM pages WHERE page_ch_id = '".$ch_id."' ORDER BY page_order ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_pages($offset,$num,$ch_id)
	{
		$sql="SELECT * FROM pages WHERE page_ch_id = '".$ch_id."' ORDER BY page_order ASC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_page($id,$ch_id)
	{
		$sql="SELECT * FROM pages WHERE page_id = '".$id."' AND page_ch_id = '".$ch_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function edit_page($data,$id)
	{
		$this->db->where("page_id", $id);
		if($this->db->update('pages', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function add_page($data)
	{
		if($this->db->insert('pages', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_page($id)
	{
		$this->db->delete('pages', array('page_id' => $id));
		return true;	
	}
	
	function get_position()
	{
		$sql="SELECT * FROM position ORDER BY name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
////////////////////// Users
	
	function get_user($ch_id,$id)
	{
		$sql="SELECT a.* FROM member_master a WHERE a.mm_id = '".$id."' AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_all_ch_user($ch_id,$num,$offset)
	{
		$sql="SELECT a.* FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') AND a.mm_family_id = '0' ORDER BY a.mm_fname, a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_ch_user($ch_id)
	{
		$sql="SELECT a.mm_id FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')  AND a.mm_family_id = '0'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_ch_user_search($ch_id,$keyword,$num,$offset)
	{
		$sql="SELECT a.* FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') AND a.mm_family_id = '0' AND (mm_username  LIKE '%".$keyword."%' OR mm_lname  LIKE '%".$keyword."%' OR mm_fname  LIKE '%".$keyword."%') ORDER BY a.mm_fname, a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_ch_user_search($ch_id,$keyword)
	{
		$sql="SELECT a.mm_id FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')  AND a.mm_family_id = '0'  AND (mm_username  LIKE '%".$keyword."%' OR mm_lname  LIKE '%".$keyword."%' OR mm_fname  LIKE '%".$keyword."%')  ";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_ch_history($ch_id,$num,$offset)
	{
		$sql="SELECT a.mm_id,a.mm_fname,a.mm_lname,a.mm_email,a.mm_hphone,c.ip,c.date_time FROM member_master a, login_log c WHERE a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') ORDER BY c.date_time DESC LIMIT ".$offset.", ".$num." ";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_all_ch_history($ch_id)
	{
		$sql=$sql="SELECT a.mm_id FROM member_master a, login_log c WHERE a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
}
?>