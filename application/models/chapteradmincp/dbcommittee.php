<?php

class Dbcommittee extends CI_Model

{

	/* Committee */

	function get_all_cm($ch_id)

	{

		$sql="SELECT a.*, b.ch_name, c.*, d.* FROM comitte_member a, chapters b, member_master c, states d WHERE a.cm_ch_id = '".$ch_id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id AND c.mm_state_id = d.	state_id ORDER BY c.mm_fname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function add_cm($data)

	{

		if($this->db->insert('comitte_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function edit_cm($data,$id)

	{

		$this->db->where("cm_id", $id);

		if($this->db->update('comitte_member', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	

	function delete_cm($id)

	{

		$this->db->delete('comitte_member', array('cm_id' => $id));

		return true;	

	}

	

	function get_cm($id)

	{

		$sql="SELECT a.*, b.ch_id, c.* FROM comitte_member a, chapters b, member_master c WHERE a.cm_id = '".$id."' AND a.cm_ch_id = b.ch_id AND a.cm_mm_id = c.mm_id LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function all_members()

	{

		$sql="SELECT * FROM member_master ORDER BY mm_fname ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_position()

	{

		$sql="SELECT * FROM position ORDER BY name ASC";

		$query = $this->db->query($sql);

		return $query->result();

	}

	

	function get_pos($id)

	{

		$sql="SELECT * FROM position WHERE id = '".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}

	

	function delete_pos($id)

	{

		$this->db->delete('position', array('id' => $id));

		return true;	

	}

	function add_pos($data)

	{

		if($this->db->insert('position', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

	function edit_position($data,$id)

	{

		$this->db->where("id", $id);

		if($this->db->update('position', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	function edit_mm($data,$id)

	{

		$this->db->where("mm_id", $id);

		if($this->db->update('member_master', $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}

}

?>