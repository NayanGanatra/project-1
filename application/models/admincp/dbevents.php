<?php

class Dbevents extends CI_Model

{

	var $tbl='events';

	

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

		$sql = "SELECT a.event_id,b.ch_id FROM events a, chapters b WHERE a.event_ch_id = b.ch_id";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_events($num,$offset)

	{

		$sql="SELECT a.*,b.* FROM events a, chapters b WHERE a.event_ch_id = b.ch_id ORDER BY event_date_time DESC LIMIT ".$offset.", ".$num."";

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
	function get_chapters($uid)

	{

		$sql="SELECT ch_id FROM chapter_to_events WHERE events_id = '".$uid."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function fetch_user_for_edit_events($uid)

	{

	$sql="SELECT * FROM `events_to_member` WHERE `email_template_id` ='".$uid."'";

	$query = $this->db->query($sql);

	return $query->result();

	}
	
	function events_to_mm($template_id,$mm_id)

	{

		$sql="select * from  events_to_member where email_template_id = '".$template_id."' AND mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();

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
	
	function count_people($event_id)

	{

		$sql="SELECT SUM(adult_count) as adults,SUM(kids_count) as kids FROM event_invitation WHERE status_id = '1' AND  event_id = '".$event_id."'  GROUP BY event_id";

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

	}*/
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

	

}

?>