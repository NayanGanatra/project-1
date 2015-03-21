<?php

class Dbpages extends CI_Model

{

	

	

	function get_page($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."pages WHERE page_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function count_pages()

	{

		$sql = "SELECT page_id FROM ".$this->config->item('convention_texas_db_prefix')."pages";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_pages($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."pages ORDER BY page_sub_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_subpage($subpage)

	{

		$sql="SELECT page_name FROM ".$this->config->item('convention_texas_db_prefix')."pages WHERE page_id = '$subpage'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_parent_page()

	{

		$sql="SELECT page_id, page_sub_id, page_name FROM ".$this->config->item('convention_texas_db_prefix')."pages ORDER BY page_name ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'pages', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit($data,$id)

	{

		$this->db->where("page_id", $id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'pages', $data))

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

		$this->db->delete($this->config->item('convention_texas_db_prefix').'pages', array('page_id' => $id));

		return true;	

	}

	

	function check_seo($seoname,$subpageid)

	{

		$sql="select page_seo from ".$this->config->item('convention_texas_db_prefix')."pages where page_seo = '".$seoname."' and page_sub_id ='".$subpageid."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	



}

?>