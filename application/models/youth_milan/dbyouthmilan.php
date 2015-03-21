<?php

class Dbyouthmilan extends CI_Model

{

	var $tbl1='youthmilan_basic_info';
	
	var $tbl2='youthmilan_social_info';
	
	var $tbl3='youthmilan_astrological_info';
	
	var $tbl4='youthmilan_edu_prof_info';
	
	var $tbl5='youthmilan_life_style';
	
	var $tbl6='youthmilan_contact_info';
	
	var $tbl7_1='youthmilan_brief_info';
	
	var $tbl7_2='youthmilan_album';
	
	var $tbl8='member_master';
	
	
	
	public function getsettings()

	{

		$sql="SELECT * FROM settings WHERE id='1' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}
	

	function check_exists_id1($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl1);
		
		return $query->row();
		
	}
	
	function check_exists_id2($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl2);
		
		return $query->row();
		
	}
	
	function check_exists_id3($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl3);
		
		return $query->row();
		
	}
	
	function check_exists_id4($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl4);
		
		return $query->row();
		
	}
	
	function check_exists_id5($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl5);
		
		return $query->row();
		
	}
	
	function check_exists_id6($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl6);
		
		return $query->row();
		
	}
	
	function check_exists_id7_1($id)
	{
		
		$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl7_1);
		
		return $query->row();
		
	}
	
	function check_exists_id7_2($id)
	{
		
		/*$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl7_2);
		
		return $query->row();*/
		
		$sql ="SELECT * FROM youthmilan_album WHERE ym_id=".$id." ORDER BY ym_album_id ASC";
		
		$query=$this->db->query($sql);
		
		return $query->row();
		
	}
	
	function check_exists_id8($id)
	{
		
		$this->db->where("mm_id", $id);
		
		$query=$this->db->get($this->tbl8);
		
		return $query->row();
		
	}
	
	function insert1($data)
	{
		if($this->db->insert($this->tbl1, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}
	
	function insert2($data)
	{
		if($this->db->insert($this->tbl2, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}
	
	function insert3($data)
	{
		if($this->db->insert($this->tbl3, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}

	function insert4($data)
	{
		if($this->db->insert($this->tbl4, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}
	
	function insert5($data)
	{
		if($this->db->insert($this->tbl5, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}

	function insert6($data)
	{
		if($this->db->insert($this->tbl6, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}
	
	function insert7_1($data)
	{
		if($this->db->insert($this->tbl7_1, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}
	
	function insert7_2($data)
	{
		if($this->db->insert($this->tbl7_2, $data))

		{

			return true;

		}

		else

		{

			return false;

		}
		
		
	}

	function update1($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl1, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update2($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl2, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update3($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl3, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update4($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl4, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update5($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl5, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update6($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl6, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update7_1($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);

		if($this->db->update($this->tbl7_1, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update7_2($data,$id)//2 arguments 2nd id

	{
		$this->db->where("ym_id", $id);
		
		if($this->db->update($this->tbl7_2, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	function update8($data,$id)//2 arguments 2nd id

	{
		$this->db->where("mm_id", $id);

		if($this->db->update($this->tbl8, $data))

		{

			return true;

		}

		else

		{

			return false;

		}

	}
	
	/*function get_detail($id)

	{

		$sql="SELECT * FROM youthmilan_basic_info a,youthmilan_social_info b,youthmilan_astrological_info c,youthmilan_edu_prof_info d,youthmilan_life_style e,youthmilan_contact_info f,youthmilan_brief_info g,member_master h WHERE a.ym_id='".$id."' and b.ym_id='".$id."' and c.ym_id='".$id."' and d.ym_id='".$id."' and e.ym_id='".$id."' and f.ym_id='".$id."' and g.ym_id='".$id."' and h.mm_unqid='".$id."' LIMIT 1";

		$query = $this->db->query($sql);

		return $query->row();

	}*/
	
	function get_old_password($id)
	{
		
		$this->db->where("mm_id", $id);
		
		$query=$this->db->get($this->tbl8);
		
		return $query->row();
		
		
	}
	
	function get_search_profile($search)
	{
		
		$this->db->like("ym_name", $search);
		
		$query=$this->db->get($this->tbl1);
		
		return $query->result();
		
		
	}
	//added by ketan 20130924
	function count_search_profile($search)
	{
		
		$this->db->like("ym_name", $search);
		
		$query=$this->db->get($this->tbl1);
		
		return $query->num_rows();
		
		
	}
	function get_search_profile_pagination($search_key,$num,$offset)
	{
		$sql ="SELECT * FROM $this->tbl1 WHERE ym_name like '%".$search_key."%' LIMIT ".$offset.", ".$num."";
		
		$query = $this->db->query($sql);

		return $query->result();

	}
	//update end
	
	//added by dharati 201309271830
	
	function get_all_photo($id)
	{
		
		/*$this->db->where("ym_id", $id);
		
		$query=$this->db->get($this->tbl7_2);
		
		return $query->result();*/
		
		$sql ="SELECT * FROM youthmilan_album WHERE ym_id=".$id." ORDER BY ym_album_id ASC";
		
		$query=$this->db->query($sql);
		
		return $query->result();
		
	}
	//end
	
	function get_photo($id)
	{
		
		$this->db->where("ym_album_id", $id);
		
		$query=$this->db->get($this->tbl7_2);
		
		return $query->row();
		
	}
	
	function delete_img($id)
	{
		$query=$this->dbyouthmilan->get_photo($id);
		
		
		$this->db->delete($this->tbl7_2, array('ym_album_id' => $id));
		
		
		
		//unlink($this->config->item('rootfolderpath')."images/youth_milan/profile/".$query->ym_photo);

		return true;	

		
	}
	
	//added by dharati 201310011620
	function state($country_id)
	{
	
		$this->db->where("countryid", $country_id);
		
		$query=$this->db->get('tstate');
		
		return $query->result();
		
	}
	
	function country()
	{
	
		$query=$this->db->get('tcountry');
		
		return $query->result();
		
	}
	//end 201310011620
	
	//added by dharati 201310091230
	
	function get_state_name($state_id)
	{
	
		$this->db->where("stateid", $state_id);
		
		$query=$this->db->get('tstate');
		
		return $query->row();
		
	}
	
	function get_country_name($country_id)
	{
	
		$this->db->where("countryid", $country_id);
		
		$query=$this->db->get('tcountry');
		
		return $query->row();
		
	}
	
	//end
	//added by ketan 201310021215
	function get_all_data_count_allcriteria($search_name,$search_gender,$search_marital,$search_height_start,$search_height_end,$search_weight_start,$search_weight_end,$search_body_type,$search_community,$search_caste,$search_sub_caste,$search_age_start,$search_age_end)
	{
		$sql = "SELECT a.* FROM youthmilan_basic_info a LEFT JOIN youthmilan_social_info b ON a.ym_id = b.ym_id LEFT JOIN youthmilan_astrological_info c ON a.ym_id=c.ym_id WHERE a.ym_id!='".$this->session->userdata('id')."' AND a.ym_status='1' AND (a.ym_name like '%".$search_name."%' AND a.ym_gender like '%".$search_gender."%' AND a.ym_marital_status like '%".$search_marital."%' AND a.ym_body_type like '%".$search_body_type."%'" ;
		if($search_height_start!='' && $search_height_end!='')
		{
			$sql .="AND (a.ym_height>=".$search_height_start." AND a.ym_height<=".$search_height_end.")";
		}
		if($search_weight_start!='' && $search_weight_end!='')
		{
			$sql .="AND (a.ym_weight>=".$search_weight_start." AND a.ym_weight<=".$search_weight_end.")";
		}
		if($search_caste!='' || $search_community!='' || $search_sub_caste!='')
		{
			$sql .="AND b.ym_community like '%".$search_community."%' AND b.ym_caste like '%".$search_caste."%' AND b.ym_sub_caste like '%".$search_sub_caste."%'"; 
		}
		if($search_age_start!='' && $search_age_end!='')
		{
			$sql .="AND (c.ym_age>=".$search_age_start." AND c.ym_age<=".$search_age_end.")";
		}
		$sql .=") ORDER BY a.ym_id ASC";
		//echo($sql);
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_data_count_anycriteria($search_name,$search_gender,$search_marital,$search_height_start,$search_height_end,$search_weight_start,$search_weight_end,$search_body_type,$search_community,$search_caste,$search_sub_caste,$search_age_start,$search_age_end)
	{
		$sql = "SELECT a.* FROM youthmilan_basic_info a LEFT JOIN youthmilan_social_info b ON a.ym_id = b.ym_id LEFT JOIN youthmilan_astrological_info c ON a.ym_id=c.ym_id WHERE a.ym_id!='".$this->session->userdata('id')."' AND a.ym_status='1' AND (a.ym_name like '%".$search_name."%' OR a.ym_gender like '%".$search_gender."%' OR a.ym_marital_status like '%".$search_marital."%' OR a.ym_body_type like '%".$search_body_type."%'" ;
		if($search_height_start!='' && $search_height_end!='')
		{
			$sql .="OR (a.ym_height>=".$search_height_start." AND a.ym_height<=".$search_height_end.")";
		}
		if($search_weight_start!='' && $search_weight_end!='')
		{
			$sql .="OR (a.ym_weight>=".$search_weight_start." AND a.ym_weight<=".$search_weight_end.")";
		}
		if($search_caste!='' || $search_community!='' || $search_sub_caste!='')
		{
			$sql .="OR b.ym_community like '%".$search_community."%' OR b.ym_caste like '%".$search_caste."%' OR b.ym_sub_caste like '%".$search_sub_caste."%'"; 
		}
		if($search_age_start!='' && $search_age_end!='')
		{
			$sql .="OR (c.ym_age>=".$search_age_start." AND c.ym_age<=".$search_age_end.")";
		}
		$sql .=") ORDER BY a.ym_id ASC";
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	function get_all_data_allcriteria($search_name,$search_gender,$search_marital,$search_height_start,$search_height_end,$search_weight_start,$search_weight_end,$search_body_type,$search_community,$search_caste,$search_sub_caste,$search_age_start,$search_age_end,$num,$offset)
	{
		$sql = "SELECT a.* FROM youthmilan_basic_info a LEFT JOIN youthmilan_social_info b ON a.ym_id = b.ym_id LEFT JOIN youthmilan_astrological_info c ON a.ym_id=c.ym_id WHERE a.ym_id!='".$this->session->userdata('id')."' AND a.ym_status='1' AND (a.ym_name like '%".$search_name."%' AND a.ym_gender like '%".$search_gender."%' AND a.ym_marital_status like '%".$search_marital."%' AND a.ym_body_type like '%".$search_body_type."%'" ;
		if($search_height_start!='' && $search_height_end!='')
		{
			$sql .="AND (a.ym_height>=".$search_height_start." AND a.ym_height<=".$search_height_end.")";
		}
		if($search_weight_start!='' && $search_weight_end!='')
		{
			$sql .="AND (a.ym_weight>=".$search_weight_start." AND a.ym_weight<=".$search_weight_end.")";
		}
		if($search_caste!='' || $search_community!='' || $search_sub_caste!='')
		{
			$sql .="AND b.ym_community like '%".$search_community."%' AND b.ym_caste like '%".$search_caste."%' AND b.ym_sub_caste like '%".$search_sub_caste."%'"; 
		}
		if($search_age_start!='' && $search_age_end!='')
		{
			$sql .="AND (c.ym_age>=".$search_age_start." AND c.ym_age<=".$search_age_end.")";
		}
		$sql .=") ORDER BY a.ym_id ASC LIMIT ".$offset.", ".$num." ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	function get_all_data_anycriteria($search_name,$search_gender,$search_marital,$search_height_start,$search_height_end,$search_weight_start,$search_weight_end,$search_body_type,$search_community,$search_caste,$search_sub_caste,$search_age_start,$search_age_end,$num,$offset)
	{
		$sql = "SELECT a.* FROM youthmilan_basic_info a LEFT JOIN youthmilan_social_info b ON a.ym_id = b.ym_id LEFT JOIN youthmilan_astrological_info c ON a.ym_id=c.ym_id WHERE a.ym_id!='".$this->session->userdata('id')."' AND a.ym_status='1' AND (a.ym_name like '%".$search_name."%' OR a.ym_gender like '%".$search_gender."%' OR a.ym_marital_status like '%".$search_marital."%' OR a.ym_body_type like '%".$search_body_type."%'" ;
		if($search_height_start!='' && $search_height_end!='')
		{
			$sql .="OR (a.ym_height>=".$search_height_start." AND a.ym_height<=".$search_height_end.")";
		}
		if($search_weight_start!='' && $search_weight_end!='')
		{
			$sql .="OR (a.ym_weight>=".$search_weight_start." AND a.ym_weight<=".$search_weight_end.")";
		}
		if($search_caste!='' || $search_community!='' || $search_sub_caste!='')
		{
			$sql .="OR b.ym_community like '%".$search_community."%' OR b.ym_caste like '%".$search_caste."%' OR b.ym_sub_caste like '%".$search_sub_caste."%'"; 
		}
		if($search_age_start!='' && $search_age_end!='')
		{
			$sql .="OR (c.ym_age>=".$search_age_start." AND c.ym_age<=".$search_age_end.")";
		}
		$sql .=") ORDER BY a.ym_id ASC LIMIT ".$offset.", ".$num." ";
		$query=$this->db->query($sql);
		return $query->result();
	}
	//update end
	
	function delete_no_photo($id)
	{
		
		$this->db->delete($this->tbl7_2, array('ym_id' => $id,'ym_photo'=>''));
		
		return true;
		
	}
	
	//update pradip 2013/11/15
	
	function get_family_member($id)
	{
	
		$this->db->where("mm_family_id", $id);
		
		$query=$this->db->get('member_master');
		
		return $query->result();
		
	}
	
	function is_registered($id)
	{
	
		$sql = "SELECT * FROM $this->tbl1 WHERE ym_id = '".$id."'" ;
		
		$query = $this->db->query($sql);
		
		return $query->row();
		
	}
	//end
}
?>