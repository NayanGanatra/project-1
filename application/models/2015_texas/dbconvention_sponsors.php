<?php
class Dbconvention_sponsors extends CI_Model
{
	//var $tbl='con_sponsors';
	/*function get_sponsors_for_general()
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT * FROM $this->tbl WHERE '".date("Y-m-d H:i:s")."' > cs_start_date AND '".date("Y-m-d H:i:s")."' < cs_end_date AND cs_status !=0 ORDER BY cs_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}*/
	//added by ketan 201309181215
	function get_sponsors_by_category($category)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."sponsors WHERE '".date("Y-m-d H:i:s")."' > cs_start_date AND '".date("Y-m-d H:i:s")."' < cs_end_date AND cs_status !=0 AND cs_category ='".$category."' ORDER BY cs_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//update end
	//added by ketan 201309201300
	function get_sponsors_for_general()
	{
		date_default_timezone_set("Asia/Kolkata");
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."sponsors WHERE '".date("Y-m-d H:i:s")."' > cs_start_date AND '".date("Y-m-d H:i:s")."' < cs_end_date AND cs_status !=0 AND cs_sidebar=1 AND cs_category!=0 AND cs_code!='' ORDER BY cs_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//update end
}
?>