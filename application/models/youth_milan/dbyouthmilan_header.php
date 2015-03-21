<?php
class Dbyouthmilan_header extends CI_Model
{
	function get_setting()
	{
		$sql="select * from settings where id = '1' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	function get_chapter_by_seo($seo)

	{

		$sql="select * from chapters where ch_seo = '".$seo."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function get_footer_menu()

	{

		$sql = "SELECT page_id, page_menu_name,page_seo FROM pages WHERE type=0 AND page_status = 1 AND page_ch_id = 0 ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_username($email)

	{

		$sql="SELECT * FROM member_master where mm_email = '".$email."'";

        $query = $this->db->query($sql);

		return $query->result();

	}
	function user_details($email)

	{

		$sql = "SELECT * FROM member_master WHERE mm_email = '".$email."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	function get_position($mm_id)

	{	

		$sql="SELECT * FROM comitte_member WHERE cm_mm_id = '".$mm_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function get_chapter($ch_id)

	{	

		$sql="SELECT * FROM chapters WHERE ch_id = '".$ch_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}


}
?>