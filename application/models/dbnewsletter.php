<?php

class Dbnewsletter extends CI_Model {



    function getQueuedNewsletters()

    {

	 	$sql="SELECT * FROM newsletters 

where email_send!=3 AND queued=1 AND email_template_status=1 AND stop_mail=0  ORDER BY uid ASC";

		return $query = $this->db->query($sql);

    }

    function getFirstQueuedMailing(){

  $sql="SELECT * FROM newsletters

where email_send!=3 AND queued=1 AND email_template_status=1 AND stop_mail=0 ORDER BY uid ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}    

	/*function getBatchNewsletterSubscribers($nId)

    {

		$sql="SELECT a.uid,b.ns_email,a.email_send,c.mm_seq,c.mm_family_id,c.mm_relationship,c.mm_username,c.mm_email,c.mm_fname,c.mm_lname,c.mm_birth_month,c.mm_birth_year FROM newsletters a 

INNER JOIN  newsletters_subscribe b ON a.uid=b.newsletter_id

INNER JOIN member_master c ON b.ns_email=c.mm_email

where a.uid='".$nId."' AND a.email_send!=3 AND  a.queued=1 AND a.email_template_status=1 AND a.stop_mail=0 AND b.mail_send_status=0 AND b.queued=1 ORDER BY a.uid ASC";

      	$query = $this->db->query($sql);

		return $query->result();

   }

    

    function countNewsletterSubscribers($nId)

    {

		$sql="SELECT a.uid,b.ns_email,a.email_send,c.mm_seq,c.mm_family_id,c.mm_relationship,c.mm_username,c.mm_email,c.mm_fname,c.mm_lname,c.mm_birth_month,c.mm_birth_year FROM newsletters a 

INNER JOIN  newsletters_subscribe b ON a.uid=b.newsletter_id

INNER JOIN member_master c ON b.ns_email=c.mm_email

where a.uid='".$nId."' AND a.email_send!=3 AND  a.queued=1 AND a.email_template_status=1 AND a.stop_mail=0 AND b.mail_send_status=0 AND b.queued=1 ORDER BY a.uid ASC";

		$query = $this->db->query($sql);

        return $query->num_rows();

    }*/

    function getBatchNewsletterSubscribers($nId)

    {

		$sql="SELECT * FROM newsletters_subscribe where newsletter_id='".$nId."' AND mail_send_status!=1 AND queued=1 ORDER BY subscribe_id ASC";

      	$query = $this->db->query($sql);

		return $query->result();

   }

    

    function countNewsletterSubscribers($nId)

    {

		$sql="SELECT * FROM newsletters_subscribe where newsletter_id='".$nId."' AND mail_send_status!=1 AND queued=1 ORDER BY subscribe_id ASC";

		$query = $this->db->query($sql);

        return $query->num_rows();

    }    

    function updateEmailStartNum($nId, $quant, $totalSubscribers)

    {



		$quant1=$quant;

        $this->db->where('uid', $nId);

		 $this->db->set('startNum', 'startNum+1', FALSE);

        $this->db->update('newsletters'); 	

        

        if($totalSubscribers == $quant1)

        {

            $currentTime = date("Y-m-d H:i:s");

            $this->db->where('uid', $nId);

            //$this->db->set('startNum', '0', FALSE);

            $this->db->set('queued', '0', FALSE);

			$this->db->set('email_send', '3', FALSE);

			$this->db->set('email_template_status', '0', FALSE);

            $this->db->set('sent', $currentTime);

            $this->db->update('newsletters');

        }

		

		

    }

	function email_template_to_member($email_template_id)

	{

		$sql="SELECT b.mm_seq,b.mm_username,b.mm_email FROM verification_template_to_member a 

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

		$this->db->where("uid", $id);

		if($this->db->update('newsletters', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function mail_send_status($nId,$emailID)

	{

		

		$sql="update newsletters_subscribe set mail_send_status=1

WHERE newsletter_id = '".$nId."' AND ns_email = '".$emailID."'";

		

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

	function check_availability($ns_email)

	{

		$sql="SELECT * from member_master WHERE mm_email ='".$ns_email."'";

		$query = $this->db->query($sql);

		return $query->row();

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