<?php
class Dbform extends CI_Model
{
	
	
	function get_page($id)
	{
		$sql="SELECT con_texas_fees_allmember.payment_status,con_texas_fees_allmember.payment_type,con_texas_fees_allmember.fm_total_fee,con_texas_fees_allmember.fm_life_member, con_texas_fees_allmember_group. * FROM con_texas_fees_allmember_group INNER JOIN con_texas_fees_allmember ON con_texas_fees_allmember_group.fm_id = con_texas_fees_allmember.fm_id WHERE con_texas_fees_allmember_group.fm_id = '$id'"; 
		//$sql = "select * from con_texas_fees_allmember_group WHERE fmg.id = '$id'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_page1($id)
	{
        $sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember WHERE fm_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function fetch_mm_id($id)
	{
		$sql="SELECT mm_id FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember WHERE fm_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function count_pages()

	{

		$sql = "SELECT  * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_pages($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember ORDER BY fm_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	



	function insert($data)

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

	

	function edit($data,$id)

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

	
	function edit_fmg($data,$id,$fmg_id)

	{

		$this->db->where("fm_id", $id);
		$this->db->where("fmg_id", $fmg_id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'fees_allmember_group', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	
function delete($id,$email)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_allmember', array('fm_id' => $id));
		
		$this->db->delete($this->config->item('convention_texas_db_prefix').'event_registration', array('email_id' => $email));

		return true;	

	}
	/*function delete($id)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_allmember', array('fm_id' => $id));

		return true;	

	}*/
	function delete_fmg($id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'fees_allmember_group', array('fm_id' => $id));
		return true;	
	}
	function delete_program($id)
	{
		$sql="SELECT pm_id FROM ".$this->config->item('convention_texas_db_prefix')."program_member WHERE pm_mm_id='".$id."'";
		$query = $this->db->query($sql);
		$result=$query->result();
		foreach($result as $result)
		{		
			$this->db->delete($this->config->item('convention_texas_db_prefix').'program_member', array('pm_mm_id' => $id));
			$this->db->delete($this->config->item('convention_texas_db_prefix').'program_to_participant', array('pm_id' => $result->pm_id));
		}
		
		return true;	
	}
	function delete_medical($id)
	{
		$this->db->delete($this->config->item('convention_texas_db_prefix').'medical_form', array('md_mm_id' => $id));
		return true;	
	}
	function delete_con_event($id)
	{
		
		$sql="SELECT ce_mem_id FROM ".$this->config->item('convention_texas_db_prefix')."events_member WHERE con_mm_id='".$id."'";
		$query = $this->db->query($sql);
		$result=$query->result();
		foreach($result as $result)
		{		
			$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member', array('con_mm_id' => $id));
			$this->db->delete($this->config->item('convention_texas_db_prefix').'events_member_group', array('cem_id' => $result->ce_mem_id));
		}
		return true;	
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
	function get_chapter_from_fm_id($fm_id)
	{
$sql="SELECT * from con_texas_fees_allmember WHERE fm_id = '".$fm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function cities($mm_city_id)

	{

		$sql="SELECT city_name FROM city WHERE city_id = '".$mm_city_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function state($mm_state_id)

	{

		$sql="SELECT state_name FROM states WHERE state_id = '".$mm_state_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	//added by ketan 20130912
	function get_fees_st_detail_by_id($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_structure WHERE fees_st_id = '".$id."' ";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function get_fees_group_detail_by_id($id,$gid)
	{
		$sql="SELECT * FROM  ".$this->config->item('convention_texas_db_prefix')."fees_group WHERE fees_st_id=".$id." AND fees_st_age_grp='".$gid."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	//update end
	
	//added by ketan 20130919
	
	function count_reg_form($search_key)

	{

		$sql ="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	/*function count_reg_form($search_key)

	{
		$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember a WHERE a.mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%' OR mm_email like '%".$search_key."%') ORDER BY fm_id DESC";
		
		$query = $this->db->query($sql);

		return $query->num_rows();

	}*/
	function get_all_reg_form($search_key,$num,$offset)
	{
        $sql ="SELECT a.*, b.state_name FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember a LEFT JOIN states b ON a.fm_state = b.state_id WHERE a.fm_id IN (SELECT fm_id from con_texas_fees_allmember WHERE fm_fname like '%".$search_key."%' OR fm_lname like '%".$search_key."%' OR fm_email like '%".$search_key."%') ORDER BY fm_id DESC LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	function count_reg_form_export_to_excel($search_key)

	{

		//$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember a WHERE a.mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%' OR mm_email like '%".$search_key."%') ORDER BY fm_id DESC";
$sql = "select * from ".$this->config->item('convention_texas_db_prefix')."fees_allmember";
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function get_all_reg_form_export_to_excel($search_key)

	{
		//$sql ="SELECT a.* FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember a WHERE a.mm_id IN (SELECT mm_id from member_master WHERE mm_fname like '%".$search_key."%' OR mm_lname like '%".$search_key."%' OR mm_email like '%".$search_key."%') ORDER BY fm_id DESC";
		$sql = "select a.*, b.state_name from ".$this->config->item('convention_texas_db_prefix')."fees_allmember a LEFT JOIN states b ON a.fm_state = b.state_id ";
		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_member_name($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."'";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function get_edit_reg_export_to_excel($id)
	{
		$sql = "SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."fees_allmember  WHERE fm_id=".$id;
		$query = $this->db->query($sql);
		return $query->row();
		
	}
	//update end
	
}

?>