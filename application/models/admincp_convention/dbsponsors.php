<?php
class Dbsponsors extends CI_Model
{

	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'sponsors', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function count_sponsors()

	{

		$sql = "SELECT cs_id FROM ".$this->config->item('convention_db_prefix')."sponsors";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_sponsors($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."sponsors ORDER BY cs_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_sponsors($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."sponsors WHERE cs_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function edit($data,$id)

	{

		$this->db->where("cs_id", $id);

		if($this->db->update($this->config->item('convention_db_prefix').'sponsors', $data))

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

		$this->db->delete($this->config->item('convention_db_prefix').'sponsors', array('cs_id' => $id));

		return true;	

	}

	function get_chapters()

	{

		$sql="SELECT * FROM chapters ORDER BY ch_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	
      function get_chapter($ch_id)
	{

		$sql="SELECT a.* , b.* FROM  ".$this->config->item('convention_db_prefix')."sponsors a INNER JOIN chapters b ON a.cs_ch_id=b.ch_id  AND a.cs_ch_id= '".$ch_id."'LIMIT 1";	

        $query = $this->db->query($sql);

		return $query->result();

	}
	
}

?>