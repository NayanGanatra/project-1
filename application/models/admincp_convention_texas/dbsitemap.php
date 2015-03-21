<?php

class Dbsitemap extends CI_Model

{

	public function gettotalpics()

	{

		$sql="SELECT * FROM covers WHERE covers_status='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	public function gettotalcategory()

	{

		$sql="SELECT * FROM covers_cat";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	public function gettotalpicsfromcategory($id)

	{

		$sql="SELECT * FROM covers where covers_cat_id=$id";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	public function gettotalpages()

	{

		$sql="SELECT * FROM pages where type=0";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	public function gettotaltemp()

	{

		$sql="SELECT * FROM templates where temp_show='1'";

		$query = $this->db->query($sql);

		return $query->result();

	}

}

?>