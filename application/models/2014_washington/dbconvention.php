<?php
class Dbconvention extends CI_Model
{
	function getpage()
	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."pages where page_home=1 ORDER BY page_id DESC LIMIT 3";
		$query = $this->db->query($sql);
		return $query->result();

	}
	/*program*/


	

	function insert_program($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'program_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_program()

	{

		$sql = "SELECT pm_id FROM ".$this->config->item('convention_db_prefix')."program_member";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_program($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."program_member ORDER BY pm_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_ch_name($id)

	{

		$sql="SELECT * FROM chapters WHERE ch_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_program($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."program_member WHERE pm_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	
	function insert_pm_to_participant($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'program_to_participant', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function pm_to_participant($pm_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."program_to_participant WHERE pm_id = '$pm_id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function total_member($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."program_to_participant WHERE pm_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_members()

	{

		$sql="SELECT * FROM member_master ORDER BY mm_fname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function insert_medical($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'medical_form', $data))

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
	
	function get_state_name($state_id)

	{

		$sql="SELECT * FROM states WHERE state_id = '".$state_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_city_name($city_id)

	{

		$sql="SELECT * FROM city WHERE city_id = '".$city_id."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function cities($state_id)

	{

		$sql="SELECT * FROM city WHERE state_id = '".$state_id."' ORDER BY city_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function all_cities()

	{

		$sql="SELECT * FROM city";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_member_name($id)

	{

		$sql="SELECT * FROM member_master WHERE mm_id = '".$id."'";

        $query = $this->db->query($sql);

		return $query->result();

	}
	/*program*/
	
function get_menu()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."menu WHERE menu_status = '1' ORDER BY menu_order ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_submenu($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."sub_menu WHERE menu_id = '".$id."'  ORDER BY sub_menu_order ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	/*<!-----------------------------------------------update-monita20130912------------------------------------------->*/ 
	function getpage_id($id)
	{
        $sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."pages Where page_id = '$id'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getpage_page_seo($page_seo)
	{
        $sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."pages Where page_seo = '$page_seo'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function getpages_loadmore($offset)
	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."pages  where page_home=1  ORDER BY page_id DESC LIMIT ".$offset.",3 ";
		$query = $this->db->query($sql);
		return $query->result();

	}
	function getpages_cnt()
	{

		$sql="SELECT count(page_id) as a FROM ".$this->config->item('convention_db_prefix')."pages where page_home=1 ORDER BY page_id";
		$query = $this->db->query($sql);
		return $query->row();

	}
	/*<!-----------------------------------------------update-monita20130912------------------------------------------->*/ 
	
	function getalbum()
	{
		$sql="SELECT DISTINCT(a.cg_ca_id) , b.* FROM ".$this->config->item('convention_db_prefix')."gallery a, ".$this->config->item('convention_db_prefix')."album b WHERE a.cg_ca_id = b.ca_id  ORDER BY b.ca_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function getgallary($id)
	{

	  $sql="SELECT DISTINCT(b.ca_name) , a.* FROM ".$this->config->item('convention_db_prefix')."gallery a, ".$this->config->item('convention_db_prefix')."album b WHERE a.cg_ca_id = b.ca_id  AND a.cg_ca_id = '$id' ORDER BY RAND()  LIMIT 3";
		$query = $this->db->query($sql);
		return $query->result();

	}
	
	 function get_img_gallary($id)
	{
       $sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."gallery Where cg_ca_id = '$id' AND cg_type ='0' ORDER BY cg_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_video_gallary($id)
	{
       $sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."gallery Where cg_ca_id = '$id' AND cg_type ='1' ORDER BY cg_id DESC";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	
	/****************end gallery**************/
	
	/*program & medical list*/
	function get_all_program_by_user()
	{
		$sql = "SELECT a.* FROM ".$this->config->item('convention_db_prefix')."program_member a  WHERE pm_mm_id='".$this->session->userdata('user_id')."' ORDER BY pm_id DESC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function get_all_medical_by_user()
	{
		$sql = "SELECT a.* FROM ".$this->config->item('convention_db_prefix')."medical_form a  WHERE md_mm_id='".$this->session->userdata('user_id')."' ORDER BY md_id DESC ";		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	/*program & medical list*/
}
?>