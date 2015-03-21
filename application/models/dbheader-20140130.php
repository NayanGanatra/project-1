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

		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE type=0 AND page_status = 1 AND page_ch_id = 0 ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_info_menu()

	{

		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE type=0 AND  page_status = 1 AND page_ch_id = 0 ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_info_ch_menu($ch_id)

	{

		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE type=2 AND  page_status = 1 AND page_ch_id = '".$ch_id."' ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_info_ch_menu1($ch_id)

	{

		//$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE page_status = 1 AND page_ch_id = '".$ch_id."' ORDER BY page_order ASC";
		$sql="select b.page_id, b.page_content,b.page_menu_name,b.page_seo from chapter_to_pages a, pages b where type=1 AND   b.page_status = 1 AND a.ch_id = '".$ch_id."' AND a.page_id = b.page_id ORDER BY b.page_order ASC";

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

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE event_id = '".$event_id."' GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

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

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE isrsvp = '1' AND  event_id = '".$event_id."' GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

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

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	function count_people($event_id)

	{

		//$sql="SELECT SUM(adult_count) as adults,SUM(kids_count) as kids FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,SUM(a.adult_count) as adults,SUM(a.kids_count) as kids FROM event_invitation a, member_master b WHERE status_id = '1' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

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

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '2' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

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

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '3' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}

	function get_notcoming($event_id)

	{

		$sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE a.status_id = '3' AND a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname ";

        $query = $this->db->query($sql);

		return 

		$query->result();

	}

	//add ketan 20130622

	/*function get_polls($chapId)

	{

		$result = array();

		$index = 0;

		$sqlChap="select poll_id from chapter_to_polls where ch_id = '".$chapId."'";

		$queryChap = $this->db->query($sqlChap);

		foreach($queryChap->result() as $pollId)

			{

			$sqlPoll="select * from polls where poll_id = '".$pollId->poll_id."' AND poll_status='active'";

			$queryPoll = $this->db->query($sqlPoll);

			foreach($queryPoll->result() as $temp)

			{

				$pId = $temp->poll_id;

			}

			if($pId)

			{

				$sqlField="select * from polls_field where poll_id = '".$pId."'";

				$queryField = $this->db->query($sqlField);

				$result[$index] = array();

				array_push($result[$index],$queryPoll->result(),$queryField->result());

				$index++;	

			}	

		}

		return $result;

		

	}*/

	function get_polls($chapId)

	{

		$result = array();

		$index = 0;

		$sqlChap="select poll_id from chapter_to_polls where ch_id = '".$chapId."'";

		$queryChap = $this->db->query($sqlChap);

		foreach($queryChap->result() as $pollId)

			{

			$sqlPoll="select * from polls where poll_id = '".$pollId->poll_id."' AND poll_status='active'";

			$queryPoll = $this->db->query($sqlPoll);

			foreach($queryPoll->result() as $temp)

			{

				$pId = $temp->poll_id;

			}

			if($pId!='')

			{

				$sqlField="select * from polls_field where poll_id = '".$pId."'";

				$queryField = $this->db->query($sqlField);

				$result[$index] = array();

				array_push($result[$index],$queryPoll->result(),$queryField->result());

				$index++;	

			}

			$pId='';	

		}

		return $result;

		

	}

	//end

	//////////////////////////pradip changes for ads 201307081100//////////////////

	function get_ads_for_general()

	{

		date_default_timezone_set("Asia/Kolkata");

		$sql="SELECT * FROM ads WHERE '".date("Y-m-d H:i:s")."' > ads_start_date AND '".date("Y-m-d H:i:s")."' < ads_end_date AND ads_status !=0 ORDER BY ads_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	////////////////////////////end///////////////////////////////////////

	//////////////////////////pradip changes for get occupations of user//////////////////

	

	function get_chapter($ch_id)

	{	

		$sql="SELECT * FROM chapters WHERE ch_id = '".$ch_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_position($mm_id)

	{	

		$sql="SELECT * FROM comitte_member WHERE cm_mm_id = '".$mm_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_latest_news()

	{

		$sql="SELECT * FROM latest_news WHERE latest_news_status = '1' ORDER BY latest_news_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	

	//////////////////////////////end///////////////////////////////////

	

	////////////////////////pradip changes for newsletter myaccount//////////////////

	

	function get_admin_by_user($email)

	{

		$sql="SELECT * FROM admin WHERE email = '".$email."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	

	///////////////////////////////end/////////////////////////////////////////////
	
	//added by ketan 20130730
	function get_all_blogs($chapter_id)
	{
		$sql="SELECT a.* FROM blog a, chapter_to_blogs b WHERE a.bid = b.blog_id AND b.ch_id = '".$chapter_id."' ORDER BY a.bid DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_blog_member($bid)
	{
		$sql="SELECT * FROM blog_to_member WHERE blog_id = '".$bid."' ORDER BY blog_to_member_id DESC LIMIT 5";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function insert_member_to_blog($data)
	{
		if($this->db->insert('member_to_blogs', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function ch_to_blog($blog_id,$ch_id)
	{
		 $sql="select * from chapter_to_blogs where blog_id = '".$blog_id."' AND ch_id = '".$ch_id."' LIMIT 1";
       	$query = $this->db->query($sql);
		return $query->row();
	}
	function delete_member_to_blogs($id)
	{
		$this->db->delete('member_to_blogs', array('blog_id' => $id));
		return true;	
	}
	function delete_blog_comment($id)
	{
		$this->db->delete('blog_comment', array('blog_id' => $id));
		return true;	
	}
	function delete_blog_reply($id)
	{
		$this->db->delete('blog_reply', array('blog_id' => $id));
		return true;	
	}
	//update end

	function get_info_ch_menu_title($ch_id)

	{

		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE type=2 AND  page_status = 1 AND page_ch_id = '".$ch_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

}

?>