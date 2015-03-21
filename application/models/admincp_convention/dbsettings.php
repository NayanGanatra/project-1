<?php

class Dbsettings extends CI_Model

{


	
	

	function edit($data,$id)

	{

		$this->db->where('cs_id', $id);

		if($this->db->update($this->config->item('convention_db_prefix').'settings', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	public function getsetting()

	{
		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."settings WHERE cs_id='1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	function get_chapters()

	{

		$sql="SELECT * FROM chapters ORDER BY ch_name ASC";

        $query = $this->db->query($sql);

		return $query->result();

	}
	/*slider*/
	public function count_slider()

	{

		$sql="SELECT cs_id FROM ".$this->config->item('convention_db_prefix')."slider";

		$query = $this->db->query($sql);

		return $query->num_rows();

	}
	
	function get_all_slider()

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."slider ORDER BY cs_id DESC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function insert_slider($data)

	{

		if($this->db->insert($this->config->item('convention_db_prefix').'slider', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit_slider($data,$id)

	{

		$this->db->where("cs_id", $id);

		if($this->db->update($this->config->item('convention_db_prefix').'slider', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	public function get_slide($id)

	{

		$sql="SELECT * FROM ".$this->config->item('convention_db_prefix')."slider WHERE cs_id='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_slider($id)

	{

		$this->db->delete($this->config->item('convention_db_prefix').'slider', array('cs_id' => $id));

		return true;	

	}

	


}

?>