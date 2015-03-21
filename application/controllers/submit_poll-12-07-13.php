<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submit_poll extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$userId = $this->session->userdata('user_id');
		$chapurl = $this->input->post('hdnchapter');
		if($userId)
		{
		$countPost = count($this->input->post());
		$pollId = $this->input->post('hdnpollid');
		$fieldId = $this->input->post('fields');
		$chapurl = $this->input->post('hdnchapter');
		//var_dump($chapurl);
		$sqlMember="select * from polls_member where mm_id = '".$userId."' AND poll_ids = '".$pollId."'";
		$queryMember = $this->db->query($sqlMember);
			if(!count($queryMember->result()))
			{
				$ids = array(
				'mm_id'=> $userId,
				'poll_ids'=>$pollId
				);
				$this->db->insert('polls_member',$ids);
				foreach($fieldId as $fieldIds)
				{
					$sqlField="select * from polls_field where poll_field_id = '".$fieldIds."'";
					$queryField = $this->db->query($sqlField);
					foreach($queryField->result() as $fieldData)
					{
						$updateField = array(
		      	         'field_count' => $fieldData->field_count + 1,
		      	      );
		
						$this->db->where('poll_field_id', $fieldData->poll_field_id);
						$this->db->update('polls_field', $updateField); 
					}
				}
				//echo '<span style="color:#B40001;">Poll submitted successsfully.</span>';
				$this->session->set_flashdata('message_type', 'pollsuccess');
				$this->session->set_flashdata('status_','Poll submitted successsfully.');
				//echo '<span style="color:#B94A48;">Poll submitted successsfully.</span>';
			}
			else
			{
				//echo '<span style="color:#B40001;">You have already submitted this poll.</span>';
				$this->session->set_flashdata('message_type', 'pollsubmitted');
				$this->session->set_flashdata('status_','You have already submitted this poll.');	
				
			}
		
		}
		else
		{
			//echo '<span style="color:#B40001;">Please Login and Try Again.</span>';
			$this->session->set_flashdata('message_type', 'polllogin');
			$this->session->set_flashdata('status_','Please Login and Try Again.');
		}
		
		redirect(base_url().'chapter/'.$chapurl);
	}
	
}
?>