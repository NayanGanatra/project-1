<?php
class Dbch_member extends CI_Model {
	function update_user_ch()
	{
		$sql="update  member_master set mm_chapter_id=0";
		$i=0;
		$query = $this->db->query($sql);
		if($query)
		{
			$i++;
			return $i;
		}
		else
		{
			return $i;
		}
	}
	function get_chapters()

	{

		$sql="SELECT * FROM chapters ORDER BY ch_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function get_all_cm($ch_id)

	{

$sql="SELECT a.*, b.ch_name, c.*, d.* FROM comitte_member a, chapters b, member_master c, states d WHERE a.cm_ch_id = '".$ch_id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id AND c.mm_state_id = d.state_id ORDER BY c.mm_fname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function update_user($mm_id,$ch_id)
	{
		$sql="update  member_master set mm_chapter_id='".$ch_id."' WHERE mm_id = ".$mm_id;
		$query = $this->db->query($sql);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/*check invitation user*/
	
	function events()
	{
		$sql="SELECT * FROM events";
		$query = $this->db->query($sql);

		return $query->result();
	}
	function get_all_in($event_id)
	{
		$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";
		$query = $this->db->query($sql);

		return $query->result();
	}
	function get_all_mm($mm_state_id,$mm_id)
	{
		
		$sql="SELECT b.mm_id FROM member_master b WHERE b.mm_state_id='".$mm_state_id."' AND b.mm_id='".$mm_id."'";
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	function update_user_state($mm_id)
	{
		$sql="update  member_master set mm_state_id='46' WHERE mm_id = ".$mm_id;
		$query = $this->db->query($sql);
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function ver()

    {

		//$sql="SELECT mm_id FROM verification_template_to_member where email_template_id=27 and mm_id!=".$mm_id;
		echo $sql="SELECT mm_id FROM verification_template_to_member WHERE email_template_id=27 AND mm_id NOT IN (SELECT mm_id FROM member_master)";

		$query = $this->db->query($sql);

        return $query->result();

    }
	function mm_data()

    {

		$sql="SELECT mm_id FROM member_master";

		$query = $this->db->query($sql);

        return $query->result();

    }
}
?> 