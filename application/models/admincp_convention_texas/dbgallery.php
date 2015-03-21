<?php

class Dbgallery extends CI_Model

{

	function count_gallery()

	{


        $sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."gallery ORDER BY cg_id DESC";
        $query = $this->db->query($sql);
		return $query->result();

	}

	

	function get_all_gallery($num,$offset)

	{

		$sql="SELECT a.*, b.* FROM ".$this->config->item('convention_texas_db_prefix')."gallery a, ".$this->config->item('convention_texas_db_prefix')."album b WHERE a.cg_ca_id = b.ca_id ORDER BY cg_id DESC LIMIT ".$offset.", ".$num."";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function add_gallery($data)

	{

		if($this->db->insert($this->config->item('convention_texas_db_prefix').'gallery', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit_gallery($data,$id)

	{

		$this->db->where("cg_id", $id);

		if($this->db->update($this->config->item('convention_texas_db_prefix').'gallery', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function delete_gallery($id)

	{

		$this->db->delete($this->config->item('convention_texas_db_prefix').'gallery', array('cg_id' => $id));

		return true;	

	}

	

	function get_gallery($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."gallery WHERE cg_id = '".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	
	function get_album()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_texas_db_prefix')."album ORDER BY ca_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}	

	

}

?>