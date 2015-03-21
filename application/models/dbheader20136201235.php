<?php
class Dbheader extends CI_Model
{
	function get_setting()
	{
		$sql="select * from settings where id = '1' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_ads($type)
	{
		$sql="select * from ads where ads_type = '".$type."' AND ads_status = '1' ORDER BY rand()";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_cat()
	{
		$sql="SELECT * FROM covers_cat WHERE covers_cat_id !=0 ORDER BY covers_cat_order_by ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	

	function get_count_all_data($num,$offset)
	{
		$sql="SELECT a.*, b.* FROM covers a, covers_cat b WHERE a.covers_status='1' AND a.covers_cat_id = b.covers_cat_id ORDER BY a.covers_id DESC LIMIT ".$offset.", ".$num."";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	
	function get_footer_menu()
	{
		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE page_status = 1 AND page_ch_id = 0 ORDER BY page_order ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_info_menu()
	{
		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE page_status = 1 AND page_ch_id = 0 ORDER BY page_order ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_info_ch_menu($ch_id)
	{
		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE page_status = 1 AND page_ch_id = '".$ch_id."' ORDER BY page_order ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}



	function get_home_slider()
	{
		$sql = "SELECT * FROM slider WHERE is_active = 1 ORDER BY rand()";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function user_details($email)
	{
		$sql = "SELECT * FROM member_master WHERE mm_email = '".$email."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function chk_sub_member($mm_id)
	{
		$sql = "SELECT * FROM member_master WHERE mm_family_id = '".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function user_details_by_id($id)
	{
		$sql = "SELECT * FROM member_master WHERE mm_id = '".$id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function user_details_by_familyid($id,$main_id)
	{
		$sql = "SELECT * FROM member_master WHERE mm_id = '".$id."' AND mm_family_id = '".$main_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function states()
	{
		$sql="SELECT * FROM states ORDER BY state_name ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function cities($state_id)
	{
		$sql="SELECT * FROM city WHERE state_id = '".$state_id."' ORDER BY city_name ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function check_username($username)
	{
		$sql="select mm_username from member_master where mm_username = '".$username."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_email($email)
	{
		$sql="select mm_email from member_master where mm_email = '".$email."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_chapter_by_user($ch_id)
	{
		$sql="select * from chapters where ch_id = '".$ch_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_chapter_by_seo($seo)
	{
		$sql="select * from chapters where ch_seo = '".$seo."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function user_details_by_username_or_email($email_or_username)
	{
		$sql="select * from member_master where (mm_username = '".$email_or_username."' OR mm_email = '".$email_or_username."') AND mm_status = 1 LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	function check_user_pass($username,$pass)
	{
		$sql="select * from member_master where (mm_username = '".$username."' OR mm_email = '".$username."') AND mm_password = '".md5($pass)."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	function verify_user($seq,$username)
	{
		$sql="select * from member_master where mm_username = '".$username."' AND mm_seq = '".$seq."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_all_chapters()
	{
		$sql="SELECT * FROM chapters WHERE ch_id !=0 ORDER BY ch_name ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_invitation($event_id)
	{
		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE event_id = '".$event_id."' GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_invitation($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY b.mm_fname, b.mm_lname";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_pending($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.isrsvp = '0' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_rsvp($event_id)
	{
		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE isrsvp = '1' AND  event_id = '".$event_id."' GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_rsvp($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.isrsvp = '1' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_confirm($event_id)
	{
		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function count_people($event_id)
	{
		$sql="SELECT SUM(adult_count) as adults,SUM(kids_count) as kids FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_people($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.status_id = '1' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname";
        $query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_maybe($event_id)
	{
		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '2' AND  event_id = '".$event_id."'  GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_maybe($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.status_id = '2' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname";
        $query = $this->db->query($sql);
		return $query->result();
	}
	function count_notcoming($event_id)
	{
		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '3' AND  event_id = '".$event_id."'  GROUP BY event_id";
        $query = $this->db->query($sql);
		return $query->row();
	}
	function get_notcoming($event_id)
	{
		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.status_id = '3' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname ";
        $query = $this->db->query($sql);
		return $query->result();
	}
}
?>