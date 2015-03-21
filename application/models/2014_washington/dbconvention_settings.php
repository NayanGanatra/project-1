<?php

class Dbconvention_settings extends CI_Model
{

	//var $tbl='con_sponsors';

	function get_settings()

	{

		$sql="select * from ".$this->config->item('convention_db_prefix')."settings where cs_id = '1' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
}

?>