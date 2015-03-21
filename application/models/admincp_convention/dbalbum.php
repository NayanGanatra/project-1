<?php
class Dbalbum extends CI_Model
{
	function insert($data)
	{
		if($this->db->insert($this->config->item('convention_db_prefix').'album', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function count_album()
	{
		$sql = "SELECT ca_id FROM ".$this->config->item('convention_db_prefix')."album";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	

	function get_all_album($num,$offset)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."album ORDER BY ca_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	function get_album($id)

	{

		 $sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."album WHERE ca_id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();

	}
    
	function edit($data,$id)

	{

		$this->db->where("ca_id", $id);

		if($this->db->update($this->config->item('convention_db_prefix').'album', $data))

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

		$this->db->delete($this->config->item('convention_db_prefix').'album', array('ca_id' => $id));

		return true;	

	}
	
}

?>