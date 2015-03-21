<?php

class Dbadminheader extends CI_Model

{

	function get_first_menu()

	{

		$sql="select page_id,page_sub_id,page_title,page_menu_name,page_seo,page_order,page_status,islink,page_link from pages where page_sub_id = '0' AND type=0 ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_sub_menu($id)

	{
		

		$sql="select page_id,page_sub_id,page_title,page_menu_name,page_seo,page_order,page_status,islink,page_link from pages where page_sub_id = '$id' AND type=0 ORDER BY page_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	public function getsettings()

	{

		$sql="SELECT * FROM settings WHERE id='1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

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

	

	function get_chapters()

	{

		$sql="SELECT * FROM chapters ORDER BY ch_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_chapter($ch_id)

	{

		$sql="SELECT * FROM chapters WHERE ch_id = '".$ch_id."' LIMIT 1";

		

        $query = $this->db->query($sql);

		return $query->row();

	}

	

function buildtree($id,$title,$islink)

 { 
$querySUB="SELECT page_id,page_sub_id,page_title,page_menu_name,page_seo,page_order,page_status,islink,page_link FROM pages WHERE page_sub_id=$id order by page_order";

	$resultSUB=mysql_query($querySUB);

	$numSUB=mysql_numrows($resultSUB);

	// FIRST IF START

	if	($numSUB==0)

	{  

	// If No Of Sum Menu = 0 then it will show first item

	

		if ($islink == '1')

			{	

			echo "<li><a href='".base_url()."chapteradmincp/pages/edit_link/".$id."'>".$title."</a></li>";

			}

			else

			{

				echo "<li><a href='".base_url()."chapteradmincp/pages/edit/".$id."'>".$title."</a></li>";

			}

	



	}

	else

	{

		if ($islink == '1')

			{	

			echo "<li><a href='".base_url()."chapteradmincp/pages/edit_link/".$id."'>".$title."</a>";

			}

			else

			{

			echo "<li><a href='".base_url()."'chapteradmincp/pages/edit/".$id."'>".$title."</a></li>";

			}

		

	//echo "<li><a href='edit_page.php?id=$id'>$title</a><ul>";

	// CREATE SUB MENU START

		$iSUB=0;

		while ($iSUB < $numSUB)

		 { //WHILE START

			$idSUB=mysql_result($resultSUB,$iSUB,"page_id");

			$base_idSUB=mysql_result($resultSUB,$iSUB,"page_sub_id");

			$titleSUB=mysql_result($resultSUB,$iSUB,"page_menu_name");

			$seoSUB=mysql_result($resultSUB,$iSUB,"page_seo");

			$sort_orderSUB=mysql_result($resultSUB,$iSUB,"page_order");	

			$islinkSUB=mysql_result($resultSUB,$iSUB,"islink");

			//echo "<li><a href='edit_page.php?id=$idSUB'>$titleSUB</a></li>";

			

			

			$this->buildtree($idSUB,$titleSUB,$islinkSUB);

			$iSUB++;

		 } // WHILE END

	

	if($numSUB=$iSUB)

	{

		echo "</ul>";

	}

	

	// CREATE SUB MENU END

	}	

	

	// FIRST IF END

} // FUNCTION END

	

	

	function add($add_tbl,$data)

	{

		if($this->db->insert($add_tbl, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit($edit_tbl,$data,$field,$id)

	{

		$this->db->where($field, $id);

		if($this->db->update($edit_tbl, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function delete($del_tbl,$field,$id)

	{

		$this->db->delete($del_tbl, array($field => $id));

		return true;	

	}

	

	function get_one($get_tbl,$field,$id)

	{

		$sql="SELECT * FROM ".$get_tbl." WHERE ".$field." = '".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	/*edit ads*/

	function insert_ch_to_ads($data)

	{

		if($this->db->insert('chapter_to_ads', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_ads($ads_id,$ch_id)

	{

		$sql="select * from chapter_to_ads where ads_id = '".$ads_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_ads($id)

	{

		$this->db->query("DELETE FROM chapter_to_ads WHERE ads_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_ads($ads_id)

	{

		$sql="select a.ads_id,b.* from chapter_to_ads a, ads b where a.ads_id = '".$ads_id."' AND a.ads_id = b.ads_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	/*edit*/

	/*edit news*/

	function insert_ch_to_news($data)

	{

		if($this->db->insert('chapter_to_news', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_news($news_id,$ch_id)

	{

		$sql="select * from chapter_to_news where news_id = '".$news_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_news($id)

	{

		$this->db->query("DELETE FROM chapter_to_news WHERE news_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_news($news_id)

	{

		$sql="select a.news_id,b.* from chapter_to_news a, news b where a.news_id = '".$news_id."' AND a.news_id = b.news_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	/*edit*/

	/*edit events*/

	function insert_ch_to_events($data)

	{

		if($this->db->insert('chapter_to_events', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_events($events_id,$ch_id)

	{

		$sql="select * from chapter_to_events where events_id = '".$events_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_events($id)

	{

		$this->db->query("DELETE FROM chapter_to_events WHERE events_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_events($events_id)

	{

		$sql="select a.events_id,b.* from chapter_to_events a, events b where a.event_id = '".$events_id."' AND a.events_id = b.event_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	/*edit*/

	/*edit media*/

	function insert_ch_to_media($data)

	{

		if($this->db->insert('chapter_to_media', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_media($media_id,$ch_id)

	{

		$sql="select * from chapter_to_media where media_id = '".$media_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_media($id)

	{

		$this->db->query("DELETE FROM chapter_to_media WHERE media_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_media($media_id)

	{

		$sql="select a.media_id,b.* from chapter_to_media a, media b where a.media_id = '".$media_id."' AND a.media_id = b.media_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	/*end*/

	/*template start*/

	function insert_ch_to_template($data)

	{

		if($this->db->insert('chapter_to_template', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_template($template_id,$ch_id)

	{

		$sql="select * from chapter_to_template where template_id = '".$template_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_template($id)

	{

		$this->db->query("DELETE FROM chapter_to_template WHERE template_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_template($template_id)

	{

		$sql="select a.template_id,b.* from chapter_to_template a, template b where a.template_id = '".$template_id."' AND a.template_id = b.template_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function get_template()

	{

		$sql="SELECT b.* FROM  chapter_to_template a,template b WHERE  a.template_id = b.template_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."' AND template_status = '1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	/*template end*/

	/*email_template*/

	function count_user_not_varify()

	{

		
		
		$sql="SELECT a.* FROM member_master a WHERE a.mm_varify='0' AND a.mm_state_id IN (SELECT b.state_id FROM chapter_to_state b WHERE b.ch_id = '".$this->session->userdata('get_chapter_id')."') AND a.mm_family_id = '0'";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	function user_details()

	{

		$sql = "SELECT * FROM member_master WHERE mm_varify='1' AND mm_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}	

	function get_user_details_from_ch($template_id,$arr_ch_id)

	{

		 $sql="SELECT d.state_id,c.ch_id,c.ch_name,e.mm_username,e.mm_email FROM template a 

INNER JOIN chapter_to_template b ON a.template_id=b.template_id

INNER JOIN chapters c ON b.ch_id=c.ch_id

INNER JOIN chapter_to_state d ON c.ch_id=d.ch_id

INNER JOIN member_master e ON d.state_id=e.mm_state_id

WHERE a.template_id='".$template_id."' AND c.ch_id='".$this->session->userdata('get_chapter_id')."' AND e.mm_status='1' AND e.mm_varify='1'";



		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_user_details_from_chapter($ch_id)

	{

 $sql="SELECT e.mm_state_id,e.mm_username,e.mm_id

FROM chapters c

INNER JOIN chapter_to_state d ON c.ch_id = d.ch_id

INNER JOIN member_master e ON d.state_id = e.mm_state_id

WHERE c.ch_id = '".$this->session->userdata('get_chapter_id')."'

AND e.mm_status = '1'";



		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function ch_to_template_id($template_id,$ch_id)

	{

		$sql="select * from chapter_to_email_template where email_template_id = '".$template_id."' AND ch_id = '".$this->session->userdata('get_chapter_id')."'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function ch_to_state($state_id)

	{

		$sql="select * from chapter_to_state where state_id = '".$state_id."'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function state_to_user($state_id)

	{

		$sql="select * from member_master where mm_state_id = '".$state_id."'  AND mm_varify='1' AND mm_status='1'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function not_state_to_user($state_id)

	{

		$sql="select * from member_master where mm_state_id != '".$state_id."'  AND mm_varify='1' AND mm_status='1'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function insert_ch_to_email_template($data)

	{

		if($this->db->insert('chapter_to_email_template', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function insert_email_template_to_member($data)

	{

		if($this->db->insert('email_template_to_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function get_template_id($template_id)

	{

		$sql="select * from template where template_id='".$template_id."' AND template_status = '1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	

	

	function delete_ch_to_email_template($id)

	{

		$this->db->query("DELETE FROM chapter_to_email_template WHERE email_template_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	function delete_email_template_to_member($id)

	{

		

		$sql="SELECT a.mm_id FROM email_template_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

INNER JOIN chapter_to_state c ON b.mm_state_id=c.state_id

WHERE c.ch_id='".$this->session->userdata('get_chapter_id')."'";

		

		$query = $this->db->query($sql);

		$result=$query->result();

		foreach($result as $result)

		{		

			$this->db->query("DELETE FROM email_template_to_member WHERE email_template_id =$id AND mm_id='".$result->mm_id."'");

		}

		return true;

	}



	function email_template_to_member($email_template_id)

	{

		$sql="SELECT b.mm_username,b.mm_email FROM email_template_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

WHERE a.email_template_id='".$email_template_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function email_template_to_mm($template_id,$mm_id)

	{

		$sql="select * from  email_template_to_member where email_template_id = '".$template_id."' AND mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();

	}

	

	

	/*ajax*/

	function count_user_pagination()

	{

		$sql = "SELECT * FROM member_master WHERE mm_varify='1' AND mm_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function user_details_pagination($mm_id,$offset,$num)

	{

	$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' AND mm_status='1' ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function fetch_ch_name($mm_state_id)

	{

$sql="SELECT b.ch_name FROM chapter_to_state a, chapters b WHERE a.state_id = '".$mm_state_id."' AND b.ch_id = '".$this->session->userdata('get_chapter_id')."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function search_fetch_ch_name($mm_state_id)

	{

		$sql="SELECT b.ch_name FROM  chapter_to_state a, chapters b WHERE a.state_id = '".$mm_state_id."' AND b.ch_id = '".$this->session->userdata('get_chapter_id')."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function user_details_state($mm_state_id)

	{

		$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_state_id,'".$mm_state_id."')  AND mm_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function search_user_details_pagination($mm_id)

	{

		$sql="SELECT * FROM member_master WHERE  `mm_username` LIKE '%".$mm_id."%'  AND mm_varify='1' AND mm_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function member_master_check_id($mem_id,$mm_id)

	{

		 $sql="select * from  member_master where mm_id='".$mem_id."' AND FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' AND mm_status='1'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function cron_check_id($uid)

	{

		$sql="SELECT * FROM email where uid='".$uid."'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function delete_email_template_to_member_user($id)

	{

		//$this->db->delete('email_template_to_member', array('email_template_id' => $id,'mm_id' => $mm_id));

		$this->db->delete('email_template_to_member', array('email_template_id' => $id,'mail_send_status ' => '0'));

		return true;	

	}

	function update_user($email_template_id)

	{

		

		$sql="update  email_template_to_member set email_template_id='".$email_template_id."' WHERE email_template_id = 0";

		

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

	function get_user_details_from_chapter_for_national($ch_id)

	{

 $sql="SELECT e.mm_state_id,e.mm_username,e.mm_id

FROM chapters c

INNER JOIN chapter_to_state d ON c.ch_id = d.ch_id

INNER JOIN member_master e ON d.state_id = e.mm_state_id

WHERE c.ch_id 	= '".$this->session->userdata('get_chapter_id')."'

AND e.mm_status = '1'";



		$query = $this->db->query($sql);

		return $query->result();

	}	

	function check_all_user_with_send($id)

	{

		$sql="SELECT COUNT(mail_send_status) as start_num1 FROM email_template_to_member WHERE email_template_id = '".$id."'";

		

		$query = $this->db->query($sql);

		return $query->row();

	}

	function check_all_user_with_send_email($id)

	{

		$sql="SELECT startNum as startNum2 FROM email WHERE uid = '".$id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}
	function count_user_search($search_key,$member_id)

	{

	

		

		$sql = "SELECT mm_id FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_user_search($search_key,$offset,$num,$member_id)

	{

		$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id DESC LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}
	function count_user_search1($search_key,$member_id,$event_id,$mm_type)

	{

if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND mm_status='1'  ORDER BY mm_id ASC ";
	
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC";
			}
		}
		elseif($mm_type==1)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC ";
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==6)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC ";
			}
		}
		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_user_search1($search_key,$offset,$num,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND mm_status='1'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
	
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==1)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==6)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	function ch_to_email($email_template_id,$ch_id)

	{

		 $sql="select * from chapter_to_email_template where email_template_id = '".$email_template_id."' AND ch_id = '".$this->session->userdata('get_chapter_id')."' LIMIT 1";

       	$query = $this->db->query($sql);

		return $query->row();

	}

	/*ajax end*/

	/*emailend*/

	

	/*verification start*/

	function insert_ch_to_verification_template($data)

	{

		if($this->db->insert('chapter_to_verification_template', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function update_user_verification($email_template_id)

	{

		$sql="update verification_template_to_member set email_template_id='".$email_template_id."' WHERE email_template_id = 0";
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

	function verification_template_to_mm($template_id,$mm_id)

	{

		$sql="select * from  verification_template_to_member where email_template_id = '".$template_id."' AND mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function verification_template_to_mm_test($mm_id)

	{

		$sql="select * from  member_master where mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();


	}

	function insert_verification_template_to_member($data)

	{

		if($this->db->insert('verification_template_to_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function delete_verification_template_to_member_user($id)

	{

		$this->db->delete('verification_template_to_member', array('email_template_id' => $id,'mail_send_status ' => '0'));

		return true;	

	}

	function cron_check_id_verification($uid)

	{

		$sql="SELECT * FROM verification where uid='".$uid."' AND email_template_status=1 AND stop_mail=0";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function ch_to_template_id_verification($template_id,$ch_id)

	{

		$sql="select * from chapter_to_verification_template where email_template_id = '".$template_id."' AND ch_id = '".$this->session->userdata('get_chapter_id')."'";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	

	

	function delete_ch_to_verification_template($id)

	{

		$this->db->query("DELETE FROM chapter_to_verification_template WHERE email_template_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	function delete_verification_template_to_member($id)

	{

		

		$sql="SELECT a.mm_id FROM verification_template_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

INNER JOIN chapter_to_state c ON b.mm_state_id=c.state_id

WHERE c.ch_id='".$this->session->userdata('get_chapter_id')."'";

		

		$query = $this->db->query($sql);

		$result=$query->result();

		foreach($result as $result)

		{		

			$this->db->query("DELETE FROM verification_template_to_member WHERE email_template_id =$id AND mm_id='".$result->mm_id."'");

		}

		return true;

	}

	

	function check_all_user_with_send_verification_from_member($id)

	{

		$sql="SELECT COUNT(mail_send_status) as start_num1 FROM verification_template_to_member WHERE email_template_id = '".$id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	function check_all_user_with_send_verification($id)

	{

		$sql="SELECT startNum as startNum2 FROM verification WHERE uid = '".$id."'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	function ch_to_verification($email_template_id,$ch_id)

	{

		 $sql="select * from chapter_to_verification_template where email_template_id = '".$email_template_id."' AND ch_id = '".$ch_id."' LIMIT 1";

       	$query = $this->db->query($sql);

		return $query->row();

	}

	//ketan update end

	///////////////pradip changes for ads 201307041133//////////////

	

	function get_chapters_without_national()

	{

		$sql="SELECT * FROM chapters where ch_id != 0 ORDER BY ch_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	///////////////////end/////////////////////

	/* for polls by ketan 20130622*/

	function insert_ch_to_polls($data)

	{

		if($this->db->insert('chapter_to_polls', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function delete_ch_to_polls($id,$chId)

	{

		$this->db->delete('chapter_to_polls', array('poll_id' => $id, 'ch_id' => $chId));

		return true;	

	}

	/* end */

	/////////////////////////pradip changes for newsletter 201307081100///////////////////

	function insert_ch_to_newsletters($data)

	{

		if($this->db->insert('chapter_to_newsletters', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_newsletters($uid,$ch_id)

	{

		$sql="select * from chapter_to_newsletters where newsletter_id = = '".$uid."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_newsletters($id)

	{

		

		$this->db->query("DELETE FROM chapter_to_newsletters WHERE newsletter_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	function get_chapters_newsletters($newsletter_id)

	{

		$sql="select a.newsletter_id, b.* from chapter_to_newsletters a, newsletters b where a.newsletter_id = '".$newsletter_id."' AND a.newsletter_id = b.uid";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_template_for_newsletter()

	{

		$sql="select * from template where template_status = '1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function count_chapter_for_newslatter($newsletter_id)

	{

		$sql="SELECT ch_id FROM chapter_to_newsletters WHERE newsletter_id = '".$newsletter_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	////////////////////////end///////////////////////

	

	///////////////pradip changes for ads 201307041133//////////////

	function count_chapter_for_ads($ads_id)

	{

		$sql="SELECT ch_id FROM chapter_to_ads WHERE ads_id = '".$ads_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_username($username)

	{

		$sql="SELECT mm_username FROM member_master where mm_email = '".$username."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->result();

	}

	

	/////////end///////////////////////////

	

	function user_details_from_checked($mm_id,$mm_id_set)

	{

	 $sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$mm_id_set."') AND mm_id='".$mm_id."' AND mm_varify='1' AND mm_status='1' ORDER BY mm_id ASC LIMIT 1";



		$query = $this->db->query($sql);

		return $query->row();

	}
/*
	function user_details_pagination_with_check_all($mm_id)

	{

	$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' AND mm_status='1'  ORDER BY mm_id ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
*/
///////////pradip_201403211130////////
	function user_details_pagination_with_check_all($mm_id,$m_type,$m_search)

	{
		
		
		if($m_type==0)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$mm_id."') ORDER BY mm_id ASC";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$mm_id."') AND  (mm_username like '%".$m_search."%'
		
						 OR mm_fname like '%".$m_search."%' 
		
						 OR mm_lname like '%".$m_search."%' 
		
						 OR mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
			}
		}
		elseif($m_type==1)
		{
			
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$mm_id."') ORDER BY mm_id ASC";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$mm_id."') AND  (mm_username like '%".$m_search."%'
		
						 OR mm_fname like '%".$m_search."%' 
		
						 OR mm_lname like '%".$m_search."%' 
		
						 OR mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
			}
		}
		elseif($m_type==2)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND
				FIND_IN_SET(a.mm_id,'".$mm_id."') ORDER BY mm_id ASC";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  AND  (a.mm_username like '%".$m_search."%'

				 OR a.mm_fname like '%".$m_search."%' 

				 OR a.mm_lname like '%".$m_search."%' 

				 OR a.mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
			}
		}
		elseif($m_type==3)
		{
			if($m_search=='' || $m_search=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE  a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND
				FIND_IN_SET(a.mm_id,'".$mm_id."') ORDER BY mm_id ASC";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  AND  (a.mm_username like '%".$m_search."%'

				 OR a.mm_fname like '%".$m_search."%' 

				 OR a.mm_lname like '%".$m_search."%' 

				 OR a.mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
			}
		}
		elseif($m_type==4)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' ORDER BY mm_id ASC";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' AND  (mm_username like '%".$m_search."%'

				 OR mm_fname like '%".$m_search."%' 

				 OR mm_lname like '%".$m_search."%' 

				 OR mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
				
			}
		}
		elseif($m_type==5)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='0' ORDER BY mm_id ASC";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='0'  AND  (mm_username like '%".$m_search."%'

				 OR mm_fname like '%".$m_search."%' 

				 OR mm_lname like '%".$m_search."%' 

				 OR mm_email like '%".$m_search."%' ) ORDER BY mm_id ASC";
				
			}
		}
		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	function user_details_pagination_with_check_all_page($mm_id,$offset,$num,$m_type,$m_search)

	{

	 /*$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1' AND mm_status='1'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();*/
		
		if($m_type==0)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$mm_id."') ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$mm_id."') AND  (mm_username like '%".$m_search."%'
		
						 OR mm_fname like '%".$m_search."%' 
		
						 OR mm_lname like '%".$m_search."%' 
		
						 OR mm_email like '%".$m_search."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($m_type==1)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$mm_id."') ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$mm_id."') AND  (mm_username like '%".$m_search."%'
		
						 OR mm_fname like '%".$m_search."%' 
		
						 OR mm_lname like '%".$m_search."%' 
		
						 OR mm_email like '%".$m_search."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($m_type==2)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  AND  (a.mm_username like '%".$m_search."%'

				 OR a.mm_fname like '%".$m_search."%' 

				 OR a.mm_lname like '%".$m_search."%' 

				 OR a.mm_email like '%".$m_search."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($m_type==3)
		{
			if($m_search=='' || $m_search=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE  a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND
				FIND_IN_SET(a.mm_id,'".$mm_id."')  AND  (a.mm_username like '%".$m_search."%'

				 OR a.mm_fname like '%".$m_search."%' 

				 OR a.mm_lname like '%".$m_search."%' 

				 OR a.mm_email like '%".$m_search."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($m_type==4)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='1'  AND  (mm_username like '%".$m_search."%'

				 OR mm_fname like '%".$m_search."%' 

				 OR mm_lname like '%".$m_search."%' 

				 OR mm_email like '%".$m_search."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		elseif($m_type==5)
		{
			if($m_search=='' || $m_search=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='0'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$mm_id."') AND mm_varify='0'  AND  (mm_username like '%".$m_search."%'

				 OR mm_fname like '%".$m_search."%' 

				 OR mm_lname like '%".$m_search."%' 

				 OR mm_email like '%".$m_search."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		
		$query = $this->db->query($sql);

		return $query->result();



	}
	
	/////////////////////////end////////////////////

	function fetch_user_for_edit_email($uid)

	{

	$sql="SELECT * FROM `email_template_to_member` WHERE `email_template_id` ='".$uid."'";

	$query = $this->db->query($sql);

	return $query->result();

	}

	function fetch_user_for_edit_verification($uid)

	{

	$sql="SELECT * FROM `verification_template_to_member` WHERE `email_template_id` ='".$uid."'";

	$query = $this->db->query($sql);

	return $query->result();

	}

	//added by ketan 20130716

	function get_mem_using_newsletter_sub($nId)

	{

		$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id = '".$nId."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function user_details_pagination_newsletter($mm_email,$offset,$num)

	{

	$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_email,'".$mm_email."') AND mm_varify='1' AND mm_status='1' LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_all_user_search_newsletter($search_key,$nId,$offset,$num)

	{

				$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id='".$nId."' AND  (ns_username like '%".$search_key."%'			 

				OR ns_fname like '%".$search_key."%' 

				OR ns_lname like '%".$search_key."%' 

				OR ns_email like '%".$search_key."%' )

				LIMIT ".$offset.", ".$num." ";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	function fetch_ch_name_newsletter($mm_state_id)

	{

		$sql="SELECT b.ch_name FROM chapter_to_state a, chapters b WHERE a.state_id = '".$mm_state_id."' AND a.ch_id = b.ch_id LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	function user_details_state_newsletter($mm_state_id)

	{

		$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_state_id,'".$mm_state_id."') AND mm_varify='1' AND mm_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function count_user_search_newsletter($search_key)

	{

		$sql = "SELECT mm_id FROM member_master WHERE mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%') 

				 ORDER BY mm_id DESC ";

				

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_ch_to_newsletters($uid)

	{

		$sql="select * from chapter_to_newsletters where newsletter_id ='".$uid."'";

        

		$query = $this->db->query($sql);

		return $query->result();

	}

	function countAllNewsletterSubscriber($id)

    {

		$sql="SELECT * FROM newsletters_subscribe where newsletter_id='".$id."'";

		$query = $this->db->query($sql);

        return $query->num_rows();

    }

	function countQueuedNewsletterSubscriber($id)

    {

		$sql="SELECT * FROM newsletters_subscribe where newsletter_id='".$id."' AND queued=1 AND mail_send_status!=1";

		$query = $this->db->query($sql);

		return $query->num_rows();

    }

	function get_all_user_search_newsletter_for_pagination($search_key,$nId)

	{

			$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id='".$nId."' AND  (ns_username like '%".$search_key."%'			 

				OR ns_fname like '%".$search_key."%' 

				OR ns_lname like '%".$search_key."%' 

				OR ns_email like '%".$search_key."%' )

				";

		

		$query = $this->db->query($sql);

		return $query->result();

	}

	function user_details_pagination_newsletter_for_pagination($nId)

	{

	$sql="SELECT * FROM newsletters_subscribe WHERE newsletter_id='".$nId."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_user_using_email($mm_email)

	{

		$sql="SELECT * FROM member_master WHERE mm_email='".$mm_email."' AND mm_varify='1' AND mm_status='1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	function get_mem_using_newsletter_sub_for_pagination($nId, $offset, $num)

	{

		$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id = '".$nId."' LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function cron_check_id_newsletter($uid)

	{

		$sql="SELECT * FROM newsletters where uid='".$uid."' AND email_template_status=1 AND stop_mail=0";

        $query = $this->db->query($sql);

		return $query->result();

	}

	function delete_newsletters_subscribe($id)

	{

		$this->db->delete('newsletters_subscribe', array('newsletter_id' => $id));

		return true;	

	}

	function get_mem_using_newsletter_sub_queued_yes($nId)

	{

		$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id = '".$nId."' AND mail_send_status!='1' AND queued='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_mem_using_newsletter_sub_queued_no($nId)

	{

		$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id = '".$nId."' AND mail_send_status!='1' AND queued='0'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function fetch_user_for_edit_newsletter($uid)

	{

	$sql="SELECT * FROM `newsletters_subscribe` WHERE newsletter_id = '".$uid."' AND queued=1";

	$query = $this->db->query($sql);

	return $query->result();

	}

	function get_mem_using_newsletter_sub_for_pagination_checkall($nId)

	{

		$sql = "SELECT * FROM newsletters_subscribe WHERE newsletter_id = '".$nId."'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function delete_ch_to_newsletters_new($id)

	{

		$this->db->delete('chapter_to_newsletters', array('newsletter_id' => $id));

		return true;	

	}

	function delete_newsletter($id)

	{

		$this->db->delete('newsletters', array('uid' => $id));

		return true;	

	}
	
	
	function user_detail($mm_chapter_id)
	{
		$sql = "SELECT * FROM member_master WHERE 	mm_chapter_id  = '".$mm_chapter_id."' LIMIT 1";
		$query = $this->db->query($sql);
		return $query->row();
	}

	//update end
	//event//
	    function insert_events_to_member($data)

	{

		if($this->db->insert('events_to_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
    function events_to_member($email_template_id)

	{

		$sql="SELECT b.mm_username,b.mm_email FROM events_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

WHERE a.email_template_id='".$email_template_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
    function delete_events_template_to_member_user($id)

	{

		//$this->db->delete('email_template_to_member', array('email_template_id' => $id,'mm_id' => $mm_id));

		$this->db->delete('events_to_member', array('email_template_id' => $id,'mail_send_status ' => '0'));

		return true;	

	}
    
    function delete_events_template_to_member($id)

	{

		

		$sql="SELECT a.mm_id FROM events_to_member a 

INNER JOIN member_master b ON a.mm_id=b.mm_id

INNER JOIN chapter_to_state c ON b.mm_state_id=c.state_id

WHERE c.ch_id='".$this->session->userdata('get_chapter_id')."'";

		

		$query = $this->db->query($sql);

		$result=$query->result();

		foreach($result as $result)

		{		

			$this->db->query("DELETE FROM events_to_member WHERE email_template_id =$id AND mm_id='".$result->mm_id."'");

		}

		return true;

	}
    
  
	function events_to_mm($template_id,$mm_id)

	{

		$sql="select * from  events_to_member where email_template_id = '".$template_id."' AND mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function fetch_user_for_edit_events($uid)

	{

	$sql="SELECT * FROM `events_to_member` WHERE `email_template_id` ='".$uid."'";

	$query = $this->db->query($sql);

	return $query->result();

	}
	function events_to_mm_status($template_id,$mm_id)

	{

		$sql="select * from  event_invitation where event_id = '".$template_id."' AND mm_id = '".$mm_id."'";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function cron_check_id_events($uid)

	{

		$sql="SELECT * FROM events where event_id='".$uid."' AND email_template_status=1 AND stop_mail=0";

        $query = $this->db->query($sql);

		return $query->result();

	}
	function chk_sub_member($mm_id)

	{

		$sql = "SELECT * FROM member_master WHERE mm_family_id = '".$mm_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function chk_parent_member($mm_family_id)

	{

		$sql = "SELECT * FROM member_master WHERE mm_id = '".$mm_family_id."'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function user_details_by_id($id)

	{

		$sql = "SELECT * FROM member_master WHERE mm_id = '".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function check_email($email)

	{

		$sql="select mm_email from member_master where mm_email = '".$email."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	//event
	/*email popupfilter*/
	
	function count_user_search_email($search_key,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$member_id."')";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==1)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$member_id."')";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."') ";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )";
				
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0'";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' ) ";
				
			}
		}
		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_user_search_email($search_key,$offset,$num,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==1)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$member_id."') ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  mm_family_id = '0'  AND  FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'   ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'  AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	/*email popup filter*/
	/*verification popupfilter*/
	
	function count_user_search_verification($search_key,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$member_id."')";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."') ";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )";
				
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0'";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' ) ";
				
			}
		}
		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_all_user_search_verification($search_key,$offset,$num,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE  FIND_IN_SET(mm_id,'".$member_id."') AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE  b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
			else
			{
				$sql="SELECT a.*,b.* FROM member_master a, states b,chapter_to_state c WHERE   b.state_id = c.state_id AND a.mm_state_id = b.state_id   AND FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
				
				
	
			}
			else
			{
				$sql="SELECT a.* FROM member_master a WHERE   a.mm_state_id NOT IN (SELECT state_id FROM chapter_to_state GROUP BY state_id )  AND  FIND_IN_SET(a.mm_id,'".$member_id."')  AND  (a.mm_username like '%".$search_key."%'

				 OR a.mm_fname like '%".$search_key."%' 

				 OR a.mm_lname like '%".$search_key."%' 

				 OR a.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC LIMIT ".$offset.", ".$num." ";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'   ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1'  AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0'  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num."";
			}
			else
			{
				$sql="SELECT * FROM member_master WHERE   FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='0' AND  (mm_username like '%".$search_key."%'

				 OR mm_fname like '%".$search_key."%' 

				 OR mm_lname like '%".$search_key."%' 

				 OR mm_email like '%".$search_key."%' )

				  ORDER BY mm_id ASC LIMIT ".$offset.", ".$num." ";
				
			}
		}
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	/*verification popup filter*/
	
/*edit events*/

	function insert_ch_to_pages($data)

	{

		if($this->db->insert('chapter_to_pages', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function ch_to_pages($page_id,$ch_id)

	{

		$sql="select * from chapter_to_pages where page_id = '".$page_id."' AND ch_id = '".$ch_id."' LIMIT 1";

        

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_ch_to_pages($id)

	{

		$this->db->query("DELETE FROM chapter_to_pages WHERE page_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");

		return true;	

	}

	

	

	function get_chapters_pages($page_id)

	{

		$sql="select a.page_id,b.* from chapter_to_pages a, pages b where a.page_id = '".$page_id."' AND a.page_id = b.page_id";

        $query = $this->db->query($sql);

		return $query->result();

	}

	/*edit*/
	
////////////////////////////////////////////////////////////////export excel/////////////////////////////////////////////////////
	function get_all_user_search_event1($search_key,$offset,$num,$member_id,$event_id,$mm_type)
	{
		if($mm_type==0)
		{
			if($search_key=='0')
			{
				$sql="SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND mm_status='1' AND mm_chapter_id='0' ORDER BY mm_id ASC";
	
			}
			else
			{
				$sql = "SELECT * FROM member_master WHERE FIND_IN_SET(mm_id,'".$member_id."') AND mm_varify='1' AND  (mm_username like '%".$search_key."%'
		
						 OR mm_fname like '%".$search_key."%' 
		
						 OR mm_lname like '%".$search_key."%' 
		
						 OR mm_email like '%".$search_key."%' )
		
						  ORDER BY mm_id ASC";
			}
		}
		elseif($mm_type==1)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==2)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==3)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE  status_id = '1' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==4)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '2' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==5)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE status_id = '3' AND   a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}
		elseif($mm_type==6)
		{
			if($search_key=='0')
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' ORDER BY a.mm_id ASC";
				
	
			}
			else
			{
				$sql="SELECT a.*,b.* FROM event_invitation a, member_master b WHERE isrsvp = '0' AND  a.event_id = '".$event_id."' AND a.mm_id=b.mm_id AND FIND_IN_SET(a.mm_id,'".$member_id."') AND b.mm_varify='1' AND  (b.mm_username like '%".$search_key."%'

				 OR b.mm_fname like '%".$search_key."%' 

				 OR b.mm_lname like '%".$search_key."%' 

				 OR b.mm_email like '%".$search_key."%' )

				  ORDER BY a.mm_id ASC";
			}
		}

		

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	///////////////////////////////////////////////////////////end//////////////////////////////////////////////////

//added by ketan 20130730
	function insert_ch_to_blog($data)
	{
		if($this->db->insert('chapter_to_blogs', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function ch_to_blog($blog_id,$ch_id)
	{
		 $sql="select * from chapter_to_blogs where blog_id = '".$blog_id."' AND ch_id = '".$ch_id."' LIMIT 1";
       	$query = $this->db->query($sql);
		return $query->row();
	}
	function delete_chapter_to_blogs($id)
	{
		$this->db->delete('chapter_to_blogs', array('blog_id' => $id));
		return true;	
	}
	function delete_blog_comment($id)
	{
		$this->db->delete('blog_comment', array('blog_id' => $id));
		return true;	
	}
	function delete_blog_reply($id)
	{
		$this->db->delete('blog_reply', array('blog_id' => $id));
		return true;	
	}
	function delete_member_to_blogs($id)
	{
		$this->db->delete('member_to_blogs', array('blog_id' => $id));
		return true;	
	}
	function insert_member_to_blog($data)
	{
		if($this->db->insert('member_to_blogs', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//update end
	//added by ketan 20130815
	function count_comment_not_verify($id)
	{
		$sql = "SELECT comment_id FROM blog_comment WHERE blog_id='".$id."' AND verify='0'";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function fetch_pending_comments($id)
	{
		$sql="SELECT * FROM blog_comment WHERE verify=0 AND blog_id= '".$id."' ORDER BY comment_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function fetch_pending_reply($id)
	{
		$sql="SELECT * FROM blog_reply WHERE verify=0 AND blog_id= '".$id."' ORDER BY reply_id ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function delete_blog_comment_by_cid($id)
	{
		$this->db->delete('blog_comment', array('comment_id' => $id));
		return true;	
	}
	function update_comment_blog($id,$data)
	{
		$this->db->where("comment_id", $id);
		if($this->db->update('blog_comment', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function delete_blog_reply_by_cid($id)
	{
		$this->db->delete('blog_reply', array('reply_id' => $id));
		return true;	
	}
	function update_reply_blog($id,$data)
	{
		$this->db->where("reply_id", $id);
		if($this->db->update('blog_reply', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//update end
	function update_pending_user_event($dataC)
	{
		$sql="update  events_to_member set mail_send_status='0' WHERE email_template_id = '".$dataC['email_template_id']."' AND mm_id='".$dataC['mm_id']."'";
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
	function update_startnum($id)
	{
		$sql="SELECT startNum FROM events WHERE event_id='".$id."'";//10
		$query = $this->db->query($sql);
		$result=$query->result();
		foreach($result as $result)
		{		
			$st=$result->startNum-1;
			$sql="update events set startNum='".$st."' WHERE event_id = '".$id."'";//10+1
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
	}
}

?>