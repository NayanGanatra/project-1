<?php

class Dbmenu extends CI_Model

{

	

	

	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'menu', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_menu()

	{

		$sql = "SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."menu WHERE menu_status = '1' ORDER BY menu_id ASC";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_menu($num,$offset)

	{
		

		$sql = "SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."menu ORDER BY menu_id ASC LIMIT ".$offset.", ".$num." ";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	function get_ch_name($id)

	{

		$sql="SELECT * FROM chapters WHERE ch_id = '$id'";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function get_menu($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."menu WHERE menu_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("menu_id", $id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'menu', $data))

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

		$this->db->delete($this->config->item('convention_texas_db_prefix').'menu', array('menu_id' => $id));

		return true;	

	}
	
	function insert_menu_to_submenu($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'sub_menu', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function menu_to_submenu($menu_id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."sub_menu WHERE menu_id = '$menu_id' ORDER BY sub_menu_order";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function total_submenu($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."sub_menu WHERE menu_id = '$id' ORDER BY sub_menu_order ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	function delete_menu_to_submenu($id)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'sub_menu', array('menu_id' => $id));

		return true;	

	}
	
	function get_pages()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."pages ORDER BY page_title ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}
	
	
	
}

?>