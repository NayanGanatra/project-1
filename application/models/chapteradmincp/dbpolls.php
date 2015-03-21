<?php
class Dbpolls extends CI_Model
{
	function add_poll($data)
	{
		$pollData = array(
		'poll_question'=>$data['poll_question'],
		'poll_type'=>$data['poll_type'],
		'display'=>$data['display'],
		'poll_status'=>$data['poll_status'],
		'user'=>$data['user']
		);
		if($this->db->insert('polls', $pollData))
		{
			$this->db->select_max('poll_id');
    		$settable = $this->db->get('polls');
			$result = $settable->result_array();
        	
			$pollId = $result[0]['poll_id'];
			
			foreach($data['poll_fields'] as $pollFields)
			{
				$pollFieldData = array(
				'poll_id'=>$pollId,
				'poll_field_name'=>$pollFields
				);
				$this->db->insert('polls_field', $pollFieldData);
			}
			return $pollId;
		}
		else
		{
			return false;
		}
	}
	
	function edit_poll($data,$id)
	{
		$pollData = array(
		'poll_question'=>$data['poll_question'],
		'poll_type'=>$data['poll_type'],
		'poll_status'=>$data['poll_status'],
		'display'=>$data['poll_display']
		);
		$this->db->where("poll_id", $id);
		$this->db->update('polls', $pollData);
		return true;
	}
	//add ketan 20130622
	function get_polls_details()
	{
		$pollId='';
		$chapId=$this->session->userdata('get_chapter_id');
		if($pollId=="")
		{
			$result = array();
			$index = 0;
			$sqlChapter="select * from chapter_to_polls where ch_id = '".$chapId."'";
			//$sqlPolls="select * from chapter_to_polls where ch_id='".$chapId."'";
			
			$queryChapter = $this->db->query($sqlChapter);
			foreach($queryChapter->result() as $chap)
			{	
				$result[$index] = array();
				$sqlPollDetail="select * from polls where poll_id = '".$chap->poll_id."'";
				$sqlField="select * from polls_field where poll_id = '".$chap->poll_id."'";
				$sqlChapter="select * from chapter_to_polls where poll_id = '".$chap->poll_id."'";
				$queryPollDetail = $this->db->query($sqlPollDetail);
				$queryField = $this->db->query($sqlField);
				$queryChapters = $this->db->query($sqlChapter);
				array_push($result[$index],$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
				$index++;
			}
			
		}
		else
		{
			$result = array();
			$sqlPollDetail="select * from polls where poll_id = '".$pollId."'";
			$sqlField="select * from polls_field where poll_id = '".$pollId."'";
			$sqlChapter="select * from chapter_to_polls where poll_id = '".$pollId."'";
			$queryPollDetail = $this->db->query($sqlPollDetail);
			$queryField = $this->db->query($sqlField);
			$queryChapters = $this->db->query($sqlChapter);
			array_push($result,$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
		}
		return $result;
		
	}
	function get_polls_details_edit($chapId,$pollId)
	{
		if($pollId=="")
		{
			$result = array();
			$index = 0;
			$sqlChapter="select * from chapter_to_polls where ch_id = '".$chapId."'";
			//$sqlPolls="select * from chapter_to_polls where ch_id='".$chapId."'";
			
			$queryChapter = $this->db->query($sqlChapter);
			foreach($queryChapter->result() as $chap)
			{	
				$result[$index] = array();
				$sqlPollDetail="select * from polls where poll_id = '".$chap->poll_id."'";
				$sqlField="select * from polls_field where poll_id = '".$chap->poll_id."'";
				$sqlChapter="select * from chapter_to_polls where poll_id = '".$chap->poll_id."'";
				$queryPollDetail = $this->db->query($sqlPollDetail);
				$queryField = $this->db->query($sqlField);
				$queryChapters = $this->db->query($sqlChapter);
				array_push($result[$index],$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
				$index++;
			}
			
		}
		else
		{
			$result = array();
			$sqlPollDetail="select * from polls where poll_id = '".$pollId."'";
			$sqlField="select * from polls_field where poll_id = '".$pollId."'";
			$sqlChapter="select * from chapter_to_polls where poll_id = '".$pollId."'";
			$queryPollDetail = $this->db->query($sqlPollDetail);
			$queryField = $this->db->query($sqlField);
			$queryChapters = $this->db->query($sqlChapter);
			array_push($result,$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
		}
		return $result;
		
	}
	function delete_poll($id)
	{
	$chId=$this->session->userdata('get_chapter_id');
		$pollData = $this->db->get_where('polls', array('poll_id' => $id, 'user' => $chId));
		foreach($pollData->result() as $pd)
		{
			$pollId = $pd->poll_id;
		}
		//$this->db->delete('polls', array('poll_id' => $id, 'user' => $chId));
		return $pollId;	
	}
	function delete_fields($id)
	{
		$this->db->delete('polls_field', array('poll_id' => $id));
		return true;	
	}
	//end
}
?>