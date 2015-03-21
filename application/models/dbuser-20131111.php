<?php

class Dbuser extends CI_Model

{

	

	function states()

	{

		$sql="SELECT * FROM states ORDER BY state_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function cities($state_id)

	{

		$sql="SELECT * FROM city WHERE state_id = '".$state_id."' ORDER BY city_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function insert_log($data)

	{

		if($this->db->insert('login_log', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function insert($data)

	{

		if($this->db->insert('member_master', $data))

		{

			

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function update($data,$id)

	{

		$this->db->where("mm_id", $id);

		if($this->db->update('member_master', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	public function checkuser($email,$password)

	{

		$sql="SELECT * FROM member_master WHERE (mm_email ='".$email."' OR mm_username ='".$email."') and mm_password='".md5($password)."' AND mm_status = '1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	public function valide_user_email($email)

	{

		$sql="SELECT * FROM member_master WHERE (mm_email ='".$email."' OR mm_username ='".$email."') AND mm_status = '1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function reset_retrive($uniqueid,$username)

	{

		$sql="SELECT * FROM member_master WHERE mm_seq = '".$uniqueid."' AND mm_username = '".$username."' LIMIT 1";

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

	

	function user_invitations($user_id)

	{

		$sql="SELECT a.*,b.* FROM event_invitation a, events b WHERE a.mm_id = '".$user_id."' AND b.event_id = a.event_id ORDER by b.event_date_time DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_invitation($event_id,$unique_key,$user_id)

	{

		$sql="SELECT a.*,b.* FROM event_invitation a, events b WHERE a.unique_number = '".$unique_key."' AND a.event_id = '".$event_id."' AND a.mm_id = '".$user_id."' AND b.event_id = a.event_id LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_event_msg_from_event_id($event_id)

	{

		$sql="SELECT * FROM event_msg WHERE event_id = '".$event_id."' ORDER by event_msg_id DESC LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_event_in_user($state_id,$mm_id)

	{

		$sql="SELECT a.ch_id,b.*,c.* FROM chapter_to_state a, events b, event_invitation c WHERE a.state_id = '".$state_id."' AND a.ch_id = b.event_ch_id AND c.event_id = b.event_id AND c.status_id = 0 AND mm_id = '".$mm_id."' ORDER by b.event_date_time DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function update_rsvp($data,$id)

	{

		$this->db->where("ei_id", $id);

		if($this->db->update('event_invitation', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function update_rsvp_family($data,$mm_id,$event_id)

	{

		$where = "mm_id = '".$mm_id."' AND event_id = '".$event_id."'";

		$this->db->where($where);

		if($this->db->update('event_invitation', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function get_rsvp_by_count($mm_id,$event_id,$rsvp_by_mm_id)

	{

		$sql="SELECT * FROM event_invitation WHERE mm_id = '".$mm_id."' AND event_id ='".$event_id."' AND rsvp_by_mm_id = '".$rsvp_by_mm_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function check_edit_user($mm_id,$username)

	{

		$sql="SELECT * FROM member_master WHERE mm_username = '".$username."' AND mm_id !='".$mm_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function check_edit_email($mm_id,$email)

	{

		$sql="SELECT * FROM member_master WHERE mm_id != '".$mm_id."' AND mm_email ='".$email."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_user_by_event_unique($event_id,$unique_id)

	{

		$sql="SELECT a.*, b.* FROM member_master a, event_invitation b WHERE b.event_id = '".$event_id."' AND b.unique_number ='".$unique_id."' AND b.mm_id = a.mm_id LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function insert_event_inv_msg($data)

	{

		if($this->db->insert('event_inv_msg', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function event_inv_msg($event_id,$ei_id,$mm_id)

	{

		$sql="SELECT a.*, b.* FROM event_inv_msg a, event_invitation b WHERE b.mm_id = '".$mm_id."' AND (b.ei_id = '".$ei_id."' OR b.ei_id = '0') AND b.event_id ='".$event_id."' AND (a.msg_frm = '".$mm_id."' OR a.msg_frm = '0') AND b.event_id = a.event_id ORDER BY a.msg_time DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function delete($id)

	{

		$this->db->delete('member_master', array('mm_id' => $id));

		return true;	

	}

	/*edit*/

	function fetch_ch_email($mm_chapter_id)

	{

		$sql="SELECT a.ch_id,b.mm_email FROM chapter_to_state a, member_master b WHERE a.state_id = '".$mm_chapter_id."' AND a.ch_id = b.mm_chapter_id LIMIT 1";

		

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_admin_id()

	{

		$sql="select email from admin where id=1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	function verify_profile($status,$id,$emailID)

	{

		

		$sql="update  verification_template_to_member set profile_status='".$status."'

WHERE mm_id = '".$id."' AND email_template_id = '".$emailID."'";

		

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

	function qur($str)

	{

		$sql="select * from member_master where mm_password='".md5($str)."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	/*edit*/

	////////////////////////////////////////////pradip changes for newsletter myaccount 201307101100/////////////////////

	

	function count_all_subscribe_newsletter($email)

	{

		$sql="SELECT * FROM newsletters_subscribe WHERE ns_email = '".$email."' ORDER BY subscribe_id DESC";

        $query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_subscribe_newsletter($offset,$num,$email)

	{

		$sql="SELECT a.newsletter_id,b.* FROM newsletters_subscribe a, newsletters b WHERE ns_email = '".$email."' and a.newsletter_id = b.uid ORDER BY a.subscribe_id DESC LIMIT ".$offset.", ".$num."";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function delete_newsletter($id)

	{

		$this->db->delete('newsletters_subscribe', array('newsletter_id' => $id));

		return true;	

	}

	

	

	/*function get_all_subscribe_newsletter($email)

	{

		$sql="SELECT a.newsletter_id,b.* FROM newsletters_subscribe a, newsletters b WHERE ns_email = '".$email."' and a.newsletter_id = b.uid ORDER BY a.subscribe_id DESC";

        $query = $this->db->query($sql);

		return $query->result();

	}*/

	

	/////////////////////////////////end//////////////////////////

	

	function delete_profile($id)

	{

		$this->db->delete('member_master', array('mm_id' => $id));

		return true;	

	}
	//added by ketan 20130729
	function get_occupation($occupation_id)
	{
		$sql="select * from occupations where occupation_id='".$occupation_id."' LIMIT 1";
        $query = $this->db->query($sql);
		return $query->row();
	}
	//update end

	//update pradip 2013/10/29
	function get_ch_seo($ch_id)

	{

		$sql = "SELECT * FROM chapters WHERE ch_id = '".$ch_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function get_ch_id_from_state_id($state_id)

	{

		$sql = "SELECT * FROM chapter_to_state WHERE state_id = '".$state_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	//end

}

?>