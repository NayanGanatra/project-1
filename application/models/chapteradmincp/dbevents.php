<?php

class Dbevents extends CI_Model

{

	var $tbl='events';

	var $ch_events_tbl='chapter_to_events';

	function insert($data)

	{

		if($this->db->insert($this->tbl, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_events()

	{

		//$sql = "SELECT a.event_id,b.ch_id FROM events a, chapters b WHERE a.event_ch_id = b.ch_id";

		//$sql = "SELECT a.event_id,b.ch_id FROM events a, chapters b,chapter_to_events c WHERE a.event_id =c.events_id AND c.ch_id = '".$this->session->userdata('get_chapter_id')."'";

		$sql = "SELECT a.event_id,b.ch_id FROM events a , chapter_to_events b WHERE a.event_id = b.events_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_events($num,$offset)

	{

		//$sql="SELECT a.*,b.* FROM events a, chapters b WHERE a.event_ch_id = b.ch_id ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";

//		$sql="SELECT a.*,b.* FROM events a, chapters b,chapter_to_events c WHERE a.event_id = c.events_id AND c.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";

		$sql="SELECT a.*,b.* FROM events a,chapter_to_events b WHERE  a.event_id = b.events_id AND b.ch_id = '".$this->session->userdata('get_chapter_id')."' ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";

//		$sql="SELECT b.*,c.* FROM  $this->ch_events_tbl a,$this->tbl b, chapters c WHERE  a.events_id = b.event_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."' AND a.ch_id = c.ch_id ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";

		

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_event_by_id($id)

	{

		$sql = "SELECT a.*,b.* FROM events a, chapters b WHERE a.event_id = '".$id."' AND a.event_ch_id = b.ch_id LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("event_id", $id);

		if($this->db->update($this->tbl, $data))

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

		$this->db->delete($this->tbl, array('event_id' => $id));

		return true;	

	}
	
	/////////////////////////////////////pradip changes for event invitation///////////////
	function get_event($id,$ch_id)
	{
		$sql="SELECT a.*,b.* FROM events a,chapter_to_events b WHERE b.ch_id = '".$ch_id."' AND b.events_id = '".$id."' AND a.event_id = b.events_id";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function get_member_email_by_mm_id($mm_id)
	{
		$sql="SELECT mm_email,mm_fname,mm_lname FROM member_master WHERE mm_id = '".$mm_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function check_event_invitation($mm_id,$event_id)
	{
		$sql="SELECT ei_id,email_status FROM event_invitation WHERE mm_id = '".$mm_id."' AND event_id = '".$event_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function insert_event_invitation($data)
	{
		if($this->db->insert('event_invitation', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function edit_event_invitation($data,$id)
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
	
	function insert_event_msg($data)
	{
		if($this->db->insert('event_msg', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_state_from_ch_id($ch_id)
	{
		$sql="SELECT state_id FROM chapter_to_state WHERE ch_id = '".$ch_id."' ORDER BY state_id";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_members($ch_id)
	{
		$sql="SELECT *
		FROM member_master a
		INNER JOIN chapter_to_state b
		ON a.mm_state_id = b.state_id WHERE b.ch_id = ".$ch_id." AND a.mm_status = 1 ORDER BY mm_fname ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function mail_send_status($data,$id,$emailID)
	{
		
		$sql="update  events_to_member set mail_send_status=1
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
	function get_rsvp($event_id)

	{

		 $sql="SELECT a.*,b.mm_username, b.mm_fname, b.mm_lname,b.mm_email,b.mm_hphone,b.mm_cphone FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id  ORDER BY b.mm_fname, b.mm_lname";

        $query = $this->db->query($sql);

		return $query->result();

	}
	/*function count_invitation($event_id)

	{

		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE event_id = '".$event_id."' GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function count_rsvp($event_id)

	{

		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE isrsvp = '1' AND  event_id = '".$event_id."' GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function count_confirm($event_id)

	{

		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function count_maybe($event_id)

	{

		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '2' AND  event_id = '".$event_id."'  GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function count_notcoming($event_id)

	{

		$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '3' AND  event_id = '".$event_id."'  GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function count_people($event_id)

	{

		$sql="SELECT SUM(adult_count) as adults,SUM(kids_count) as kids FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";

        $query = $this->db->query($sql);

		return $query->row();

	}*/
	
	function get_chapters($uid)

	{

		$sql="SELECT ch_id FROM chapter_to_events WHERE events_id = '".$uid."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_invitation($event_id)

	{

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE event_id = '".$event_id."' GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_rsvp($event_id)

	{

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE isrsvp = '1' AND  event_id = '".$event_id."' GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_confirm($event_id)

	{

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_people($event_id)

	{

		//$sql="SELECT SUM(adult_count) as adults,SUM(kids_count) as kids FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,SUM(a.adult_count) as adults,SUM(a.kids_count) as kids FROM event_invitation a, member_master b WHERE status_id = '1' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_maybe($event_id)

	{

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '2' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	function count_notcoming($event_id)

	{

		//$sql="SELECT COUNT(mm_id) as total FROM event_invitation WHERE status_id = '3' AND  event_id = '".$event_id."'  GROUP BY event_id";
		
		$sql="SELECT a.*,b.*,COUNT(b.mm_id) as total FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id ORDER BY a.mm_id ASC";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
	/////////////////////////////////////////////////////pradip_201403271600 start///////////////////////////////////////////////////	
	function counteventSubscribers($id)
    {
		/*$sql="SELECT a.email_send,c.mm_username,c.mm_email FROM email a 
INNER JOIN  email_template_to_member b ON a.uid=b.email_template_id
INNER JOIN member_master c ON b.mm_id=c.mm_id where email_template_id='".$id."'";*/
		$sql="SELECT b.mm_id FROM events a 
		INNER JOIN events_to_member b ON a.event_id=b.email_template_id
		INNER JOIN member_master c ON b.mm_id=c.mm_id
		INNER JOIN chapter_to_state d ON c.mm_state_id=d.state_id
		WHERE d.ch_id='".$this->session->userdata('get_chapter_id')."' AND a.event_id='".$id."'";
		$query = $this->db->query($sql);
        return $query->num_rows();
    }
	/////////////////////////////////////////////////////end///////////////////////////////////////////////////
}

?>