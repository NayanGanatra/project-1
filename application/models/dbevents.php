<?php
class Dbevents extends CI_Model {
	function getQueuedEmail()
	{
		$sql="SELECT * FROM events 
where email_send!=3 AND queued=1 AND email_template_status=1 AND stop_mail=0  ORDER BY event_id ASC";
		return $query = $this->db->query($sql);
    }
    function getFirstQueuedMailing(){
		$sql="SELECT * FROM events 
where email_send!=3 AND queued=1 AND email_template_status=1 AND stop_mail=0 ORDER BY event_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}   
    function getBatchEmailSubscribers($emailID)
    {
		$sql="SELECT a.event_id,b.mm_id,a.email_send,c.mm_seq,c.mm_username,c.mm_email FROM events a 
INNER JOIN  events_to_member b ON a.event_id=b.email_template_id
INNER JOIN member_master c ON b.mm_id=c.mm_id
where  a.event_id='".$emailID."' AND a.email_send!=3 AND  a.queued=1 AND a.email_template_status=1 AND a.stop_mail=0 AND b.mail_send_status=0 ORDER BY a.event_id ASC";
      	$query = $this->db->query($sql);
		return $query->result();
   }
   function countEmailSubscribers($emailID)
   {
		$sql="SELECT a.email_send,c.mm_seq,c.mm_username,c.mm_email FROM events a 
INNER JOIN  events_to_member b ON a.event_id=b.email_template_id
INNER JOIN member_master c ON b.mm_id=c.mm_id 
where a.event_id='".$emailID."' AND a.email_send!=3 AND a.queued=1 AND a.email_template_status=1 AND a.stop_mail=0 AND b.mail_send_status=0";
		$query = $this->db->query($sql);
        return $query->num_rows();
   }
	function updateEmailStartNum($emailID, $quant, $totalSubscribers)
    {
		//echo $emailID;
		$quant1=$quant;
		//echo $totalSubscribers;
		//exit;

        $this->db->where('event_id', $emailID);

        //$this->db->set('startNum', $quant, FALSE);

		 $this->db->set('startNum', 'startNum+1', FALSE);

        $this->db->update('events'); 	

        

        if($totalSubscribers == $quant1)

        {

            $currentTime = date("Y-m-d H:i:s");

            $this->db->where('event_id', $emailID);

            //$this->db->set('startNum', '0', FALSE);

            $this->db->set('queued', '0', FALSE);

			$this->db->set('email_send', '3', FALSE);

			$this->db->set('email_template_status', '0', FALSE);

            $this->db->set('sent', $currentTime);

            $this->db->update('events');

        }

		

		

    }

	function email_template_to_member($email_template_id)

	{

		$sql="SELECT b.mm_seq,b.mm_username,b.mm_email FROM events_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

WHERE a.email_template_id='".$email_template_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_template()

	{

		$sql="select * from template where template_status = '1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function edit($data,$id)

	{

		$this->db->where("event_id", $id);

		if($this->db->update('events', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

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
	
	//////////////update_pradip_20140107//////
	
	function chk_status($info)

	{

		$sql="SELECT * FROM mail_status WHERE mail_info = '".$info."'";

        	$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function insert($data)

	{

		if($this->db->insert('mail_status', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function delete($info)

	{

		$this->db->delete('mail_status', array('mail_info' => $info));

		return true;	

	}
	
	/////////////////////////////update_pradip_20140107 end///////////////////
}

?> 