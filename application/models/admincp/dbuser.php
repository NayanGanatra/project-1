<?php

class Dbuser extends CI_Model

{

	var $tbl='member_master';

	

	function get_user($id)

	{

		$sql="SELECT * FROM $this->tbl WHERE mm_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	function get_user_update($id)

	{

		$sql="SELECT * FROM $this->tbl WHERE   mm_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	/*function count_user()

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE mm_varify='1'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}*/

	function count_user_not_varify()

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE mm_varify='0'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	function count_user_update()

	{

		$sql = "SELECT mm_id FROM $this->tbl";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	/*function get_all_user($num,$offset)

	{

		$sql="SELECT * FROM $this->tbl WHERE mm_varify='1' ORDER BY mm_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}*/

	function get_all_user_update($num,$offset)

	{

		$sql="SELECT * FROM $this->tbl  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

///////////////////////////	pradip changes for manage user/////////////////////////



	function count_user()

	{

		$sql = "SELECT mm_id FROM $this->tbl";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

		

	function get_all_user($num,$offset)

	{

		$sql="SELECT * FROM $this->tbl ORDER BY mm_varify ASC,mm_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function count_user_search($search_key)

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl WHERE (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_varify ASC,mm_id DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_user_search_assign($search_key)

	{

		$sql = "SELECT a.mm_id,b.state_id, c.c_to_s_id FROM $this->tbl a, states b, chapter_to_state c WHERE b.state_id = c.state_id AND a.mm_state_id = b.state_id AND (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' 

				  )  ORDER BY mm_id DESC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_assign($search_key,$num,$offset)

	{

		$sql = "SELECT a.*,b.state_id, c.c_to_s_id FROM $this->tbl a, states b, chapter_to_state c WHERE b.state_id = c.state_id AND a.mm_state_id = b.state_id AND (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%'  ) 

				  ORDER BY a.mm_varify ASC,a.mm_id DESC LIMIT ".$offset.", ".$num." ";

				  

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_user_search_unassign($search_key)

	{

		$sql = "SELECT a.mm_id FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id ) AND (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' 

				  )  GROUP BY a.mm_id  ORDER BY mm_id DESC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_unassign($search_key,$num,$offset)

	{

		$sql = "SELECT a.* FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id ) AND (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%'  ) 

				  GROUP BY a.mm_id  ORDER BY a.mm_varify ASC,a.mm_id DESC LIMIT ".$offset.", ".$num." ";

				  

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_user_search_verified($search_key)

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE mm_varify = '1' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_verified($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '1' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_varify ASC,mm_id DESC LIMIT ".$offset.", ".$num." ";


		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_user_search_unverified($search_key)

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE mm_varify = '0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_unverified($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}
	function count_user_search_chapteradmin($search_key)

	{

		$sql="SELECT mm_id FROM $this->tbl WHERE mm_type = '1' AND mm_chapter_id!='0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

		

	function get_all_user_search_chapteradmin($search_key,$num,$offset)

	{
		

		$sql="SELECT * FROM $this->tbl WHERE mm_type = '1' AND mm_chapter_id!='0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_varify ASC,mm_id DESC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function count_user_search_members($search_key)

	{

		$sql="SELECT mm_id FROM $this->tbl WHERE mm_type = '0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

		

	function get_all_user_search_members($search_key,$num,$offset)

	{
		

		$sql="SELECT * FROM $this->tbl WHERE mm_type = '0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_varify ASC,mm_id DESC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	/*function count_user_search_assign($search_key)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify='1' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' 

				  )  ORDER BY mm_id DESC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_assign($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify='1' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%'  ) 

				  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";

				  

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_user_search_unassign($search_key)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify='0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' 

				  )  GROUP BY mm_id  ORDER BY mm_id DESC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search_unassign($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl  WHERE mm_varify='0' AND (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%'  ) 

				  GROUP BY mm_id  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";

				  

		$query = $this->db->query($sql);

		return $query->result();

	}*/

	



////////////////////////////////end////////////////////////////////////////////

	

	/*function count_user_search($search_key)

	{

		$sql = "SELECT mm_id FROM $this->tbl WHERE mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_user_search($search_key,$num,$offset)

	{

		$sql = "SELECT * FROM $this->tbl WHERE mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}*/

	

	

	

	

	

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

	function status_update($data,$id)

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

	

	function delete($id)

	{

		$this->db->delete('member_master', array('mm_id' => $id));

		return true;	

	}

	

	function get_ch_from_state($state_id)

	{

		$sql="SELECT ch_id FROM chapter_to_state WHERE state_id = '".$state_id."' LIMIT 1";

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

	

	function get_user_by_id($mm_id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$mm_id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_all_user_test()

	{

		$sql="SELECT  `mm_username` ,mm_id, COUNT( * ) c

				FROM member_master WHERE mm_varify='1' 

				GROUP BY  `mm_username` 

				HAVING c >1";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	//////////////////////////////////pradip changes for newsletter 201307081100///////////////

	

	function count_newsletter()

	{

		$sql = "SELECT uid FROM newsletters";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_newsletter($num,$offset)

	{

		$sql="SELECT * FROM newsletters ORDER BY uid DESC LIMIT ".$offset.", ".$num."";

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

	

	function delete_newsletter($id)

	{

		$this->db->delete('newsletters', array('uid' => $id));

		return true;	

	}

	

	////////////////////////////////end//////////////////////////

	

	function list_all_members_for_email()

	{

		$sql="SELECT * FROM member_master WHERE mm_varify='1' AND  mm_email !='' ORDER BY mm_fname ASC, mm_lname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_history($num,$offset)

	{

		$sql="SELECT a.mm_id,a.mm_fname,a.mm_lname,a.mm_email,a.mm_hphone,c.ip,c.date_time FROM member_master a, login_log c WHERE a.mm_varify='1' AND  a.mm_id = c.mm_id ORDER BY c.date_time DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_all_history()

	{

		$sql=$sql="SELECT a.mm_id FROM member_master a, login_log c WHERE a.mm_varify='1' AND  a.mm_id = c.mm_id ";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	//added by ketan 20130724

	function get_admin_user($id)

	{

		$sql="SELECT * FROM admin WHERE (email='".$id."' OR username='".$id."')";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function get_admin_user_12($id)

	{

		$sql="SELECT * FROM admin WHERE email='".$id."'";


		$query = $this->db->query($sql);

		return $query->result();

	}
	/*pradip*/

	function count_user_for_export($type)

	{
		if($type==1)
		{
			$sql="SELECT * FROM $this->tbl ORDER BY mm_varify ASC,mm_id DESC";
		}
		elseif($type==2)
		{

			$sql = "SELECT a.*,b.state_id, c.c_to_s_id FROM $this->tbl a, states b, chapter_to_state c WHERE b.state_id = c.state_id AND a.mm_state_id = b.state_id 

				  ORDER BY a.mm_varify ASC,a.mm_id DESC";
		}
		elseif($type==3)
		{

			$sql = "SELECT a.* FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )

				  GROUP BY a.mm_id  ORDER BY a.mm_varify ASC,a.mm_id DESC";
		}
		elseif($type==4)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '1'

				  ORDER BY mm_varify ASC,mm_id DESC";
		}
		elseif($type==5)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '0'

				  ORDER BY mm_id DESC";
		}
		elseif($type==6)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_type = '1' AND mm_chapter_id!='0'

				  ORDER BY mm_id DESC";
		}
		
		elseif($type==7)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_type = '0'

				  ORDER BY mm_id DESC";
		}

		$query = $this->db->query($sql);
		return $query->num_rows();

	}
	
	
	function get_all_user_for_export($type)

	{

		if($type==1)
		{
			$sql="SELECT * FROM $this->tbl ORDER BY mm_varify ASC,mm_id DESC";
		}
		elseif($type==2)
		{

			$sql = "SELECT a.*,b.state_id, c.c_to_s_id FROM $this->tbl a, states b, chapter_to_state c WHERE b.state_id = c.state_id AND a.mm_state_id = b.state_id 

				  ORDER BY a.mm_varify ASC,a.mm_id DESC";
		}
		elseif($type==3)
		{

			$sql = "SELECT a.* FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )

				  GROUP BY a.mm_id  ORDER BY a.mm_varify ASC,a.mm_id DESC";
		}
		elseif($type==4)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '1'

				  ORDER BY mm_varify ASC,mm_id DESC";
		}
		elseif($type==5)
		{

			$sql = "SELECT * FROM $this->tbl WHERE mm_varify = '0'

				  ORDER BY mm_id DESC";
		}
		elseif($type==6)
		{
			$sql = "SELECT * FROM $this->tbl WHERE mm_type = '1' AND mm_chapter_id!='0' ORDER BY mm_varify ASC,mm_id DESC ";
		}
		elseif($type==7)
		{
				  
			$sql = "SELECT * FROM $this->tbl WHERE mm_type = '0' ORDER BY mm_varify ASC,mm_id DESC ";		  
		}
		

		$query = $this->db->query($sql);

		return $query->result();

	}


	//update end

	//added by ketan 20131018
	function get_user_detail_by_id($mm_id)
	{
		$sql="SELECT * FROM member_master WHERE mm_id ='".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function count_user_search_final($ch_id,$search_key)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE			   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname DESC ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname DESC ";
		}
		
				
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE			   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_assign_final($ch_id,$search_key)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE			   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname DESC ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify,a.mm_fname,a.mm_lname DESC ";
		}
		
				
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_assign_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE			   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_unassign_final($search_key)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id ) AND (a.mm_username like '%".$search_key."%'
		 OR a.mm_fname like '%".$search_key."%' 
		 OR a.mm_lname like '%".$search_key."%' 
		 OR a.mm_email like '%".$search_key."%' ) 
		  GROUP BY a.mm_id  ORDER BY a.mm_varify ASC, a.mm_id DESC";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_unassign_final($search_key,$num,$offset)
	{
		$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id ) AND (a.mm_username like '%".$search_key."%'
		 OR a.mm_fname like '%".$search_key."%' 
		 OR a.mm_lname like '%".$search_key."%' 
		 OR a.mm_email like '%".$search_key."%' ) 
		  GROUP BY a.mm_id  ORDER BY a.mm_varify ASC, a.mm_id DESC LIMIT ".$offset.", ".$num." ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_verified_final($ch_id,$search_key)
	{		 
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE a.mm_varify = '1'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC";
		}
		

				

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	function get_all_user_search_verified_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '1' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_unverified_final($ch_id,$search_key)
	{		 
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE a.mm_varify = '0'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0'	
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_unverified_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM member_master a WHERE a.mm_varify = '0' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE  b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' AND a.mm_varify = '0' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_chapteradmin_final($ch_id,$search_key)
	{
		if($ch_id==0)
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '1' AND mm_chapter_id!='0' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%' )
				 ORDER BY a.mm_varify ASC, mm_id DESC";
		}
		else
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '1' AND mm_chapter_id='".$ch_id."' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%' )
				  ORDER BY a.mm_varify ASC, mm_id DESC";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_chapteradmin_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '1' AND mm_chapter_id!='0' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%' )
				  ORDER BY a.mm_varify ASC, mm_id DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '1' AND mm_chapter_id='".$ch_id."' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%' )
				  ORDER BY a.mm_varify ASC, mm_id DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_search_members_final($ch_id,$search_key)
	{
		if($ch_id==0)
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '0' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%')
				 ORDER BY mm_id DESC ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC ";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_user_search_members_final($ch_id,$search_key,$num,$offset)
	{
		if($ch_id==0)
		{
			$sql="SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM $this->tbl a WHERE mm_type = '0' AND (mm_username like '%".$search_key."%'
				 OR mm_fname like '%".$search_key."%' 
				 OR mm_lname like '%".$search_key."%' 
				 OR mm_email like '%".$search_key."%')
				 ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";
		}
		else
		{
			$sql = "SELECT Distinct ( case when a.mm_family_id = 0 THEN a.mm_id else a.mm_family_id END ) as familyID FROM chapter_to_state b, member_master a WHERE b.state_id = a.mm_state_id AND b.ch_id = '".$ch_id."' 
		AND   (a.mm_username like '%".$search_key."%'
				 OR a.mm_fname like '%".$search_key."%' 
				 OR a.mm_lname like '%".$search_key."%' 
				 OR a.mm_email like '%".$search_key."%') 
				 ORDER BY a.mm_varify ASC,a.mm_fname,a.mm_lname DESC LIMIT ".$offset.", ".$num." ";
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	function chk_sub_member($mm_id)

	{

		$sql = "SELECT * FROM member_master WHERE mm_family_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	//update end
}

?>