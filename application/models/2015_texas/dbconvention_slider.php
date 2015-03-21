<?php
class Dbconvention_slider extends CI_Model
{
	function get_sliders()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."slider WHERE cs_status = 1 ORDER BY cs_order ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>