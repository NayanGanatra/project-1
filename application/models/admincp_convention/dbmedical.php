<?php

class Dbmedical extends CI_Model

{

	

	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'medical_form', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function edit($data,$id)

	{

		$this->db->where("md_id", $id);

		if($this->db->update($this->config->item('convention_db_prefix').'medical_form', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function count_medical($search_key)

	{

		$sql ="SELECT a.* FROM ".$this->config->item('convention_db_prefix')."medical_form a WHERE a.md_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR md_name like '%".$search_key."%' OR md_cellphone like '%".$search_key."%' OR md_home_phone like '%".$search_key."%' ORDER BY md_id DESC";
		
		

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function get_all_medical($search_key,$num,$offset)

	{

		

		$sql ="SELECT a.* FROM ".$this->config->item('convention_db_prefix')."medical_form a WHERE a.md_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR md_name like '%".$search_key."%' OR md_cellphone like '%".$search_key."%' OR md_home_phone like '%".$search_key."%' ORDER BY md_id DESC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_medical_export_to_excel($search_key)

	{

		$sql ="SELECT a.* FROM ".$this->config->item('convention_db_prefix')."medical_form a WHERE a.md_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR md_name like '%".$search_key."%' OR md_cellphone like '%".$search_key."%' OR md_home_phone like '%".$search_key."%' ORDER BY md_id DESC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function get_all_medical_export_to_excel($search_key)

	{

		$sql ="SELECT a.* FROM ".$this->config->item('convention_db_prefix')."medical_form a WHERE a.md_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR md_name like '%".$search_key."%' OR md_cellphone like '%".$search_key."%' OR md_home_phone like '%".$search_key."%' ORDER BY md_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_details($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."medical_form WHERE md_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function all_members()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."fees_member";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_con_members($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."' ORDER BY mm_fname ASC ";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function states()

	{

		$sql="SELECT * FROM states ORDER BY state_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_state_name($state_id)

	{

		$sql="SELECT * FROM states WHERE state_id = '".$state_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_city_name($city_id)

	{

		$sql="SELECT * FROM city WHERE city_id = '".$city_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function cities($state_id)

	{

		$sql="SELECT * FROM city WHERE state_id = '".$state_id."' ORDER BY city_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_member_name($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."'";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function delete($id)

	{

		$this->db->delete($this->config->item('convention_db_prefix').'medical_form', array('md_id' => $id));

		return true;	

	}
	
	
	function get_medical_detail_export_to_excel($id)

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_db_prefix')."medical_form WHERE md_id = '".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->result();

	}
	

	
	
}

?>