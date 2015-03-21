<?php

class Dbmembers extends CI_Model

{

	function count_all_members()

	{

		//$sql="SELECT mm_id FROM member_master WHERE mm_disp_dir = '1'";

		$sql="SELECT a.mm_id FROM member_master a, states b WHERE a.mm_disp_dir = '1' AND a.mm_state_id = b.state_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_members($offset,$num)

	{

		$sql="SELECT a.*,b.* FROM member_master a, states b WHERE a.mm_disp_dir = '1' AND a.mm_state_id = b.state_id ORDER BY a.mm_fname, a.mm_lname ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_search_members($keywords)

	{

		$sql="SELECT mm_id FROM member_master WHERE mm_disp_dir = '1' AND (mm_fname like '%".$keywords."%' OR  mm_lname like '%".$keywords."%' OR  mm_username like '%".$keywords."%'  OR  mm_email  like '%".$keywords."%' OR  mm_hphone like '%".$keywords."%' OR  mm_cphone like '%".$keywords."%')";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_search_members($offset,$num,$keywords)

	{

		$sql="SELECT * FROM member_master WHERE mm_disp_dir = '1' AND (mm_fname like '%".$keywords."%' OR  mm_lname like '%".$keywords."%' OR  mm_username like '%".$keywords."%'  OR  mm_email  like '%".$keywords."%' OR  mm_hphone like '%".$keywords."%' OR  mm_cphone like '%".$keywords."%') ORDER BY mm_fname, mm_lname ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}
function get_city_name($city_id)

	{

		$sql="SELECT * FROM city WHERE city_id = '".$city_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

}

?>