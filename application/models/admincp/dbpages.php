<?php

class Dbpages extends CI_Model

{

	var $page_tbl='pages';

	

	function get_page($id)

	{

		$sql="SELECT * FROM $this->page_tbl WHERE page_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function count_pages()

	{

		$sql = "SELECT page_id FROM $this->page_tbl  where type=0";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_pages($num,$offset)

	{

		$sql="SELECT * FROM $this->page_tbl  where type=0 ORDER BY page_sub_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}
	function count_pages_chapter()

	{

		$sql = "SELECT page_id FROM $this->page_tbl where type=1";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_pages_chapter($num,$offset)

	{

		$sql="SELECT * FROM $this->page_tbl where type=1 ORDER BY page_sub_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_subpage($subpage)

	{

		$sql="SELECT page_name FROM $this->page_tbl WHERE page_id = '$subpage'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function get_parent_page()

	{

		$sql="SELECT page_id, page_sub_id, page_name FROM $this->page_tbl ORDER BY page_name ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function insert($data)

	{

		if($this->db->insert($this->page_tbl, $data))

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

		if($this->db->update($this->page_tbl, $data))

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

		$this->db->delete($this->page_tbl, array('page_id' => $id));

		return true;	

	}
	

	

	function check_seo($seoname,$subpageid)

	{

		$sql="select page_seo from pages where page_seo = '".$seoname."' and page_sub_id ='".$subpageid."' LIMIT 1";

        $query = $this->db->query($sql);

		return $query->row();

	}

	



}

?>