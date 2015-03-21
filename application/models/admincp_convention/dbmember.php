<?php
class Dbmember extends CI_Model
{
	
	
	function get_page($id)
	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."fees WHERE mm_id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function count_pages()

	{

		$sql = "SELECT  DISTINCT mm_id FROM ".$this->config->item('convention_db_prefix')."fees";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}

	

	function get_all_pages($num,$offset)

	{

		$sql="SELECT DISTINCT mm_id FROM ".$this->config->item('convention_db_prefix')."fees ORDER BY fees_id ASC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	



	function insert($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'fees', $data))

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

		$this->db->where("mm_id", $id);

		if($this->db->update($this->config->item('convention_db_prefix').'fees', $data))

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

		$this->db->delete($this->config->item('convention_db_prefix').'fees', array('mm_id' => $id));

		return true;	

	}
	function get_chapter_from_mm_id($mm_id)
	{
$sql="SELECT c.*,a.ch_id,a.ch_name 
FROM chapters a 
INNER JOIN chapter_to_state b ON a.ch_id = b.ch_id
INNER JOIN member_master c ON b.state_id = c.mm_state_id
WHERE c.mm_id = '".$mm_id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function cities($mm_city_id)

	{

		$sql="SELECT city_name FROM city WHERE city_id = '".$mm_city_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	function state($mm_state_id)

	{

		$sql="SELECT state_name FROM states WHERE state_id = '".$mm_state_id."' limit 1";

        $query = $this->db->query($sql);

		return $query->row();

	}
	
}

?>