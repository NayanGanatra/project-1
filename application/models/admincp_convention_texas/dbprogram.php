<?php

class Dbprogram extends CI_Model

{

	

	

	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'program_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_program($search_key)

	{

		$sql = "SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."program_member a  WHERE a.pm_id IN (SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_member_name like '%".$search_key."%') OR a.pm_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR (a.pm_type like '%".$search_key."%'

				 OR a.pm_created_by like '%".$search_key."%'
				 
				 )

				  ORDER BY pm_id DESC ";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_program($search_key,$num,$offset)

	{
		

		 $sql = "SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."program_member a  WHERE a.pm_id IN (SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_member_name like '%".$search_key."%') OR a.pm_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR (a.pm_type like '%".$search_key."%'

				 OR a.pm_created_by like '%".$search_key."%'
				 
				 )

				  ORDER BY pm_id DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	function count_program_export_to_excel($search_key)

	{

		$sql = "SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."program_member a  WHERE a.pm_id IN (SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_member_name like '%".$search_key."%') OR a.pm_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR (a.pm_type like '%".$search_key."%'

				 OR a.pm_created_by like '%".$search_key."%'
				 
				 )

				  ORDER BY pm_id DESC ";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_program_export_to_excel($search_key)

	{
		

		 $sql = "SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."program_member a  WHERE a.pm_id IN (SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_member_name like '%".$search_key."%') OR a.pm_mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%') OR (a.pm_type like '%".$search_key."%'

				 OR a.pm_created_by like '%".$search_key."%'
				 
				 )

				  ORDER BY pm_id DESC";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_ch_name($id)

	{

		$sql="SELECT * FROM chapters WHERE ch_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_program($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("pm_id", $id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'program_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function delete($id)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'program_member', array('pm_id' => $id));

		return true;	

	}
	
	function insert_pm_to_participant($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'program_to_participant', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function pm_to_participant($pm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_id = '$pm_id' ORDER BY pm_to_participant_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function total_member($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function delete_pm_to_participant($id)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'program_to_participant', array('pm_id' => $id));

		return true;	

	}
	
	function status_update($data,$id)

	{

		$this->db->where("pm_id", $id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'program_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function get_program_update($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function get_member_name($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."'";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	////////////////////////////////////////////////////
	
	function all_members()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_con_members($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."' ORDER BY mm_fname ASC ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_program_detail_export_to_excel($id)

	{
		

		$sql = "SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_id = '".$id."' LIMIT 1 ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_ch_name_from_setting()

	{	

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."settings";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function get_ch_id($ch_name)

	{	

		$sql="SELECT * FROM chapters WHERE ch_name = '".$ch_name."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

}

?>