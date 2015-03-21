<?php
class Dbinfo extends CI_Model
{
	
	function getpage($seo)
	{
		$query = $this->db->get_where('pages', array('page_seo' => $seo));
		return $query->row();
	}
	
}
?>