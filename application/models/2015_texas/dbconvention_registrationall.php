<?php

class Dbconvention_registrationall extends CI_Model

{

	/**
	* 
	* update start nirav 20150120
	* 
	*/
function insert_event_data($data)
	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'event_registration', $data))

		{

			return true;

		}

		else

		{

			return false;

		}
	}
	
	function get_event_data()
	{
		$sql="show columns FROM con_texas_fees_allmember";

		$query = $this->db->query($sql);

		return $query->result();
	}
	function check_event($email_id)
	{
		$sql = "select DISTINCT(event_amount) from con_texas_event_registration where email_id ='$email_id'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	/**
	* 
	* update end nirav 20150120
	* 
	*/
	function insert_program($data)

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

	

	function count_program()

	{

		$sql = "SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_member";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_program($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member ORDER BY pm_id DESC LIMIT ".$offset.", ".$num."";

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

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_id = '$pm_id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function total_member($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_to_participant WHERE pm_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_members()

	{

		$sql="SELECT * FROM member_master ORDER BY mm_fname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function insert_medical($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'medical_form', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

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
	
	function all_cities()

	{

		$sql="SELECT * FROM city";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_member_name($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."'";

        $query = $this->db->query($sql);

		return $query->result();

	}
	/*ketan*/
	function count_fees_st()
	{
		$sql = "SELECT fees_st_id FROM ".$this->config->item('convention_texas_db_prefix')."fees_structure";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_fees_st()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_structure ORDER BY fees_st_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_user_status()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member WHERE mm_id='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_user_status_for_program()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_mm_id='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_user_status_for_medical()
	{
		$sql="SELECT * FROM   ".$this->config->item('convention_texas_db_prefix')."medical_form WHERE md_mm_id='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_fees_st_detail_by_id()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_structure LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function add_fees_st($data)
	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'fees_structure', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function add_fees_st_groups($data)
	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'fees_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function edit_fees_st($data,$id)
	{
		$this->db->where("fees_st_id", $id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_structure', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_fees_st_group($data,$sid,$gid)
	{
		$this->db->where("fees_st_id", $sid);
		$this->db->where("fees_st_age_grp", $gid);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_group', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete_fees_st($id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_structure', array('fees_st_id' => $id));
		return true;	
	}
	function delete_fees_st_group($id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_group', array('fees_st_id' => $id));
		return true;	
	}
	function get_fees_group_detail_by_id($id,$gid)
	{
		$sql="SELECT * FROM  ".$this->config->item('convention_texas_db_prefix')."fees_group WHERE fees_st_id=".$id." AND fees_st_age_grp='".$gid."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_chapter_from_mm_id($mm_id)
	{
$sql="SELECT c.*,a.ch_id,a.ch_name 
FROM chapters a 
INNER JOIN chapter_to_state b ON a.ch_id = b.ch_id
INNER JOIN member_master c ON b.state_id = c.mm_state_id
WHERE c.mm_id = '".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function cities_reg($mm_city_id)

	{

		$sql="SELECT city_name FROM city WHERE city_id = '".$mm_city_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function state_reg($mm_state_id)

	{

		$sql="SELECT state_name FROM states WHERE state_id = '".$mm_state_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function get_relationship($user_id)

	{

		$sql="SELECT * FROM member_master WHERE mm_family_id ='".$user_id."' ORDER by mm_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_relationship_sub($family_id,$user_id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id ='".$family_id."' OR mm_family_id ='".$family_id."' AND mm_id !='".$user_id."' AND mm_family_id !='0' ORDER by mm_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function insert_fmg($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'fees_allmember_group', $data))

		{
	
			return true;

		}

		else

		{

			return false;

		}

	}
	function insert_member($data)

	{
		if($this->db->insert($this->config->item('convention_texas_db_prefix').'fees_allmember', $data))
		{
			
			
			return true;

		}

		else

		{

			return false;

		}

	}
/*ketan*/
//added by ketan 20130912
function con_fees_member_edit($data,$id)
{
	$this->db->where("fm_id", $id);
	if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_allmember', $data))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function con_fees_member_payment_status($data,$id)
{
	$this->db->where("fm_id", $id);
	if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_allmember', $data))
	{
		return true;
	}
	else
	{
		return false;
	}
}
//update end
//added by ketan 20130913
function get_user_status_of_con_fees()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member WHERE mm_id='".$this->session->userdata('user_id')."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_page($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member_group WHERE fm_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_page1()
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_member WHERE mm_id='".$this->session->userdata('user_id')."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
//update end
function edit_member($data,$id)
	{
		$this->db->where("fm_id", $id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_member', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function delete_data($up_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_member_group', array('fm_id' => $up_id));
		return true;
	}
	
	function delete_program_registration($mm_id)
	{
		
		$this->db->delete($this->config->item('convention_texas_db_prefix').'program_member', array('pm_mm_id' => $mm_id));
		return true;
	}
	
	function delete_medical_registration($mm_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'medical_form', array('md_mm_id' => $mm_id));
		return true;
	}
	
	function delete_program_participant_registration($pm_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'program_to_participant', array('pm_id' => $pm_id));
		return true;
	}
	
	function delete_event_registration($mm_id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member', array('con_mm_id' => $mm_id));
		$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member_group', array('con_mm_id' => $mm_id));
		return true;
	}
	
	
	function get_pm_id($mm_id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_mm_id='".$mm_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function fetch_data($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember WHERE fm_id = '".$id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	function fetch_data_group($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember_group WHERE fm_id = '".$id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function get_confirm($email_id,$reg_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember WHERE fm_email = '".$email_id."' AND fm_reg_num = '".$reg_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function edit_payment_status($id,$data)
	{
		$this->db->where("fm_id",$id);
		if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_allmember', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function get_fm_id($email_id)

	{

		$sql="SELECT * FROM con_texas_fees_allmember where fm_email = '$email_id'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	function get_reg_number($email_id)

	{

		$sql="SELECT fm_reg_num FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember WHERE fm_email = '".$email_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
}

?>