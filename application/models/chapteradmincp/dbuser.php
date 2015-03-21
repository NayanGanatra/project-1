<?php

class Dbuser extends CI_Model

{

	var $tbl='member_master';

	var $ch_st_tbl='chapter_to_state';

	var $ch_tbl='chapters';

	

	function get_user($id)

	{

		$sql="SELECT * FROM $this->tbl WHERE  mm_id='".$id."' LIMIT 1";



		$query = $this->db->query($sql);

		return $query->row();

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

	function get_ch_from_state($state_id)

	{

		$sql="SELECT ch_id FROM chapter_to_state WHERE state_id = '".$state_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	//pradip changes for newsletter 201307081100/////////

	function count_newsletter()

	{

		$sql = "SELECT b.* FROM chapter_to_newsletters a, newsletters b  where a.newsletter_id = b.uid AND a.ch_id = '".$this->session->userdata('get_chapter_id')."'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}



	

	function get_all_newsletter($num,$offset)

	{

		$sql="SELECT  * FROM chapter_to_newsletters a, newsletters b  where a.ch_id = '".$this->session->userdata('get_chapter_id')."' and  a.newsletter_id = b.uid ORDER BY newsletter_id DESC LIMIT ".$offset.", ".$num."";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function countNewsletterSubscribers()

    {

		$where = "mm_email !='' ";

		$this->db->where($where);

        $query = $this->db->get('member_master');

        return $query->num_rows();

    }

	

	function get_newsletter_by_id($id)

	{

		$sql="SELECT * FROM newsletters WHERE uid = '".$id."' ";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function add_newsletter($data)

	{

		if($this->db->insert('newsletters', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit_newsletter($data,$id)

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

	/*

	function delete_newsletter($id)

	{

		$this->db->delete('newsletters', array('uid' => $id));

		return true;	

	}*/

	

	

	//End coding for newsletter 

	

	///////////////////////pradip changes for login_history 201307181700/////////////////

	

	

	function get_all_ch_history($ch_id,$num,$offset)

	{

		/*$sql="SELECT a.mm_id,a.mm_fname,a.mm_lname,a.mm_email,a.mm_hphone,c.ip,c.date_time FROM member_master a, login_log c WHERE a.mm_chapter_id=0 AND a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') ORDER BY c.date_time DESC LIMIT ".$offset.", ".$num." ";*/

		$sql="SELECT a.mm_id,a.mm_fname,a.mm_lname,a.mm_email,a.mm_hphone,c.ip,c.date_time FROM member_master a, login_log c WHERE a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') ORDER BY c.date_time DESC LIMIT ".$offset.", ".$num." ";
		
		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_all_ch_history($ch_id)

	{

		/*$sql=$sql="SELECT a.mm_id FROM member_master a, login_log c WHERE a.mm_chapter_id=0 AND a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')";*/
		
		$sql=$sql="SELECT a.mm_id FROM member_master a, login_log c WHERE a.mm_id = c.mm_id  AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	////////////////////////////////end///////////////////////////////////////



	////////////////////////////////pradip changes for manage users ///////////////

	

	function count_user($ch_id)
	{
		//$sql = "SELECT mm_id FROM $this->tbl";
		
		$sql="SELECT a.mm_id FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')  AND a.mm_family_id = '0'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_user($ch_id,$num,$offset)
	{

		$sql="SELECT a.* FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_user_search($ch_id,$search_key)
	{
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";
				
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_user_search($ch_id,$search_key,$num,$offset)
	{
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function count_user_search_verified($ch_id,$search_key)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'	

		AND a.mm_varify = '1' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC ";*/
				 
				 $sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1'	AND a.mm_family_id = '0'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_verified($ch_id,$search_key,$num,$offset)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'

		AND a.mm_varify = '1' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";*/

		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' AND a.mm_family_id = '0'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_user_search_unverified($ch_id,$search_key)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'	

		AND a.mm_varify = '0' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC ";*/

		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' AND a.mm_family_id = '0'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_unverified($ch_id,$search_key,$num,$offset)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'

		AND a.mm_varify = '0' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";*/
				 
				 
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0'	AND a.mm_family_id = '0'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";
		

		$query = $this->db->query($sql);

		return $query->result();

	}
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function count_user_search1($ch_id,$search_key)
	{
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC ";
				
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_all_user_search1($ch_id,$search_key,$num,$offset)
	{
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	

	

	function count_user_search_verified1($ch_id,$search_key)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'	

		AND a.mm_varify = '1' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC ";*/
				 
				 $sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_verified1($ch_id,$search_key,$num,$offset)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'

		AND a.mm_varify = '1' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";*/

		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_user_search_unverified1($ch_id,$search_key)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'	

		AND a.mm_varify = '0' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC ";*/

		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0'		
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC ";				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_unverified1($ch_id,$search_key,$num,$offset)

	{

		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE a.mm_chapter_id=0 AND b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_family_id = '0'

		AND a.mm_varify = '0' AND   (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%') 

				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";*/
				 
				 
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC LIMIT ".$offset.", ".$num." ";
		

		$query = $this->db->query($sql);

		return $query->result();

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

	function delete_newsletter($id)

	{

		$this->db->delete('newsletters', array('uid' => $id));

		return true;	

	}

	

	//////////////////////////////////////end//////////////////////////////////////
	
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
	
	function delete($id)

	{

		$this->db->delete('member_master', array('mm_id' => $id));

		return true;	

	}
////////////////////////////////pradip changes for export to excel////////////////
	
	function count_user_for_export($type,$ch_id)

	{
		if($type==1)
		{
			$sql="SELECT a.mm_id FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."')  AND a.mm_family_id = '0'";
		}
		elseif($type==2)
		{
			
			$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1'	AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";
		}
		elseif($type==3)
		{

			$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";
		}
		
		$query = $this->db->query($sql);
		return $query->num_rows();

	}
	
	
	function get_all_user_for_export($type,$ch_id)

	{

		if($type==1)
		{
			$sql="SELECT a.* FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC";
		}
		elseif($type==2)
		{

			$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC";
		}
		elseif($type==3)
		{

			$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0'	AND a.mm_family_id = '0' ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC";
		}
		
		

		$query = $this->db->query($sql);

		return $query->result();

	}

	function search_all($search_key)

	{

		$sql = "SELECT * FROM member_master WHERE mm_family_id='0' AND mm_lname like '%".$search_key."%'";

		

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	//added by ketan 201310161110
	function get_all_user_search_unverified_ketan($ch_id,$search_key)
	{			 
		
		
		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' */
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND a.mm_varify = '0' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC";
		

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_all_user_search_ketan($ch_id,$search_key)
	{
	
	 /*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."'	*/
	$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id	
				AND (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_all_user_search_verified_ketan($ch_id,$search_key)
	{
		
		
		/*$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' */
		$sql = "SELECT a.* FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_all_user_ketan($ch_id)
	{

		$sql="SELECT a.* FROM member_master a WHERE a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$ch_id."') AND a.mm_family_id = '0' ORDER BY a.mm_fname DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_user_detail_by_id($mm_id)
	{
		$sql="SELECT * FROM member_master WHERE mm_id ='".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
//added by ketan 20131018
	function count_user_search_final($ch_id,$search_key)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";
				
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function count_user_search_verified_final($ch_id,$search_key)

	{		 
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	function count_user_search_unverified_final($ch_id,$search_key)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' AND 
		 (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC ";				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	function get_all_user_search_final($ch_id,$search_key,$num,$offset)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."'
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_all_user_search_verified_final($ch_id,$search_key,$num,$offset)

	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_all_user_search_unverified_final($ch_id,$search_key,$num,$offset)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0'	AND (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%' ) 
				 ORDER BY a.mm_varify, a.mm_fname,a.mm_lname ASC LIMIT ".$offset.", ".$num." ";
		

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_all_user_search_counts($ch_id,$search_key)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID
    FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1'	AND (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%' ) 
				 ORDER BY a.mm_varify, a.mm_fname,a.mm_lname ASC";
		$query = $this->db->query($sql);

		return $query->num_rows();

	}
//update end
}

?>