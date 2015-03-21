<?php
class Dbadminheader extends CI_Model
{
	function get_first_menu()
	{
		$sql="select page_id,page_sub_id,page_title,page_menu_name,page_seo,page_order,page_status,islink,page_link from pages where page_sub_id = '0' ORDER BY page_order ASC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_sub_menu($id)
	{
		$sql="select page_id,page_sub_id,page_title,page_menu_name,page_seo,page_order,page_status,islink,page_link from pages where page_sub_id = '$id' ORDER BY page_order ASC";
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
		//$this->db->delete('chapter_to_ads', array('ads_id' => $id));
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
		//$this->db->delete('chapter_to_ads', array('ads_id' => $id));
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
		//$this->db->delete('chapter_to_ads', array('ads_id' => $id));
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
		//$this->db->delete('chapter_to_ads', array('ads_id' => $id));
		$this->db->query("DELETE FROM chapter_to_media WHERE media_id =$id AND ch_id='".$this->session->userdata('get_chapter_id')."'");
		return true;	
	}
	
	
	function get_chapters_media($media_id)
	{
		$sql="select a.media_id,b.* from chapter_to_media a, media b where a.media_id = '".$media_id."' AND a.media_id = b.media_id";
        $query = $this->db->query($sql);
		return $query->result();
	}
	function count_user_not_varify()
	{
//		$sql = "SELECT mm_id FROM member_master WHERE b.mm_varify='0' AND mm_chapter_id='".$this->session->userdata('get_chapter_id')."'";
		$sql="SELECT b.mm_id FROM chapter_to_state a, member_master b WHERE b.mm_varify='0' AND b.mm_chapter_id=0 AND a.state_id = b.mm_state_id AND a.ch_id = '".$this->session->userdata('get_chapter_id')."'";
		
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	/*edit*/
	
	
}
?>