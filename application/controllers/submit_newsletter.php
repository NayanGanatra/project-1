<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submit_newsletter extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbchapter');
		$this->load->model('dbheader');
		
		
		$ch_id = $this->input->post('hdnch_id');
		$chapurl = $this->input->post('hdnchapter');
		
		$data['newsletters'] = $this->dbchapter->latesr_newsletter($ch_id );
		
		$login = $this->session->userdata('user_email');
		
		
		
			//$this->add_newsletters_subscribe($data['chapter']->ch_id);
			if($login)
			{
				$data['user'] = $this->dbheader->user_details($login);
					
					foreach($data['newsletters'] as $get_newsletter_row)
					{
						
						$uid =  $get_newsletter_row->uid;
						
						$data=array(
						'ns_email'=>$login,
						'newsletter_id'=>$uid,
						'ch_id'=>$ch_id,
						'ns_fname'=>$data['user']->mm_fname,
						'ns_lname'=>$data['user']->mm_lname,
						'ns_username'=>$data['user']->mm_username
						);
								
						$result=$this->dbchapter->add_newsletters_subscribe($data);
					
						$this->session->set_flashdata('message_type', 'success');
						$this->session->set_flashdata('status_', 'you have successfully subscribed to <span style="color:blue">'.$get_newsletter_row->subject.'</span> Newsletter');
					}
			
					
				//	redirect(base_url().'newsletter');
					
			}
		
			else
			{
			
			
		//	$this->form_validation->set_rules('ns_email', 'Email', 'required');
			$this->form_validation->set_rules('ns_email', $this->lang->line('text_ns_email'), 'required|valid_email|xss_clean');
			$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
			
				if ($this->form_validation->run() == FALSE)
				{
					
				}
				else
				{	
					
					foreach($data['newsletters'] as $get_newsletter_row)
					{
						$uid =  $get_newsletter_row->uid;
						$email = $this->input->post('ns_email');
						
						if($email)
						{
							$data['email_available'] = $this->dbchapter->
							latesr_check($uid,$email);
						}
						
							if($data['email_available'] == 0)
							{
								$data=array(
								'ns_email'=>$email,
								'newsletter_id'=>$uid,
								'ch_id'=>$ch_id
								);
										
								$result=$this->dbchapter->add_newsletters_subscribe($data);
							
							$this->session->set_flashdata('message_type', 'success');
							$this->session->set_flashdata('status_', 'you have successfully subscribed to <span style="color:blue">'.$get_newsletter_row->subject.'</span> Newsletter');
							
							}
							else
							{				
								$this->session->set_flashdata('message_type', 'error');
								$this->session->set_flashdata('status_', ''.$email.' have already subscribed this 
								newsletter');
							}
				//	redirect(base_url().'newsletter');
						
					}
			
										
				}
			}
		
		redirect(base_url().'chapter/'.$chapurl);
	}
	
}
?>