<?php
class Dbpolls extends CI_Model
{
	function count_polls()
	{
		$sql="SELECT * FROM polls";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	function get_all_polls($num,$offset)
	{
		$sql="SELECT * FROM polls";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	function get_polls_details()
	{
	$id='';
		if($id=="")
		{
			$result = array();
			$index = 0;
			$sqlPolls="select * from polls";
			$queryPolls = $this->db->query($sqlPolls);
			foreach($queryPolls->result() as $polls)
				{	
				$result[$index] = array();
				$sqlPollDetail="select * from polls where poll_id = '".$polls->poll_id."'";
				$sqlField="select * from polls_field where poll_id = '".$polls->poll_id."'";
				$sqlChapter="select * from chapter_to_polls where poll_id = '".$polls->poll_id."'";
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
			$sqlPollDetail="select * from polls where poll_id = '".$id."'";
			$sqlField="select * from polls_field where poll_id = '".$id."'";
			$sqlChapter="select * from chapter_to_polls where poll_id = '".$id."'";
			$queryPollDetail = $this->db->query($sqlPollDetail);
			$queryField = $this->db->query($sqlField);
			$queryChapters = $this->db->query($sqlChapter);
			array_push($result,$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
		}
		return $result;
		
	}
	function get_polls_details_edit($id)
	{
	//$id='';
		if($id=="")
		{
			$result = array();
			$index = 0;
			$sqlPolls="select * from polls";
			$queryPolls = $this->db->query($sqlPolls);
			foreach($queryPolls->result() as $polls)
				{	
				$result[$index] = array();
				$sqlPollDetail="select * from polls where poll_id = '".$polls->poll_id."'";
				$sqlField="select * from polls_field where poll_id = '".$polls->poll_id."'";
				$sqlChapter="select * from chapter_to_polls where poll_id = '".$polls->poll_id."'";
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
			$sqlPollDetail="select * from polls where poll_id = '".$id."'";
			$sqlField="select * from polls_field where poll_id = '".$id."'";
			$sqlChapter="select * from chapter_to_polls where poll_id = '".$id."'";
			$queryPollDetail = $this->db->query($sqlPollDetail);
			$queryField = $this->db->query($sqlField);
			$queryChapters = $this->db->query($sqlChapter);
			array_push($result,$queryPollDetail->result(),$queryField->result(),$queryChapters->result());
		}
		return $result;
		
	}
	
	function add_poll($data)
	{
		$pollData = array(
		'poll_question'=>$data['poll_question'],
		'poll_type'=>$data['poll_type'],
		'poll_status'=>$data['poll_status'],
		'user'=>$data['user'],
		'display'=>$data['display']
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
	
	function delete_poll($id)
	{
		$this->db->delete('polls', array('poll_id' => $id));
		return true;	
	}
	function delete_fields($id)
	{
		$this->db->delete('polls_field', array('poll_id' => $id));
		return true;	
	}
	
}
?>