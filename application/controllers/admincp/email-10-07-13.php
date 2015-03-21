<?php
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbemail');
		$this->load->model('admincp/dbadminheader');
		$this->load->library('email');
		$this->load->library('parser');
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		/*edit*/
		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')
		{
			redirect(base_url().'unathorised');
		}
		/*edit*/
		
	}
	
	public function index()
	{	
		$this->view();
	}
	
	function view()
	{
		$num_rec=$this->dbemail->count_email();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/email/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 20;
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<div align="center" class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close']  = '</li>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close']  = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		if ($this->uri->segment(4) == "")
		{
			$segment  = 0;
		}
		else
		{
			$segment = $this->uri->segment(4);	
		}
		
		$data['query'] = $this->dbemail->get_all_email($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title'] = 'Email';		
		$this->load->view('admincp/email/view',$data);
	}
	
	function add()
	{
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('email_template_name', 'Templete', 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_rules('queued', 'Status', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$data=array(
				'created'=>date('Y-m-d H:i:s'),
				'subject'=>$this->input->post('subject'),
				'template_id'=>$this->input->post('email_template_name'),
				'html'=>$this->input->post('html'),
				'queued'=>$this->input->post('queued')
				);
				$result=$this->dbemail->add($data);
				/*edit virendra 18-06-13*/
					$inserted_id = $this->db->insert_id();
					
					$chapter = $this->input->post('chapter');
					$user_details = $this->input->post('user_details');
				
					if($chapter)
					{
						for($b=0; $b < count($chapter); $b++)
						{					
							$dataB=array(
							'email_template_id'=>$inserted_id,
							'ch_id'=>$chapter[$b]
							);
							$resultB=$this->dbadminheader->insert_ch_to_email_template($dataB);
						}
					}
					if($user_details)
					{
						for($b=0; $b < count($user_details); $b++)
						{					
							$dataC=array(
							'email_template_id'=>$inserted_id,
							'mm_id'=>$user_details[$b]
							);
							$resultC=$this->dbadminheader->insert_email_template_to_member($dataC);
						}
					}
					
					/*edit virendra 18-06-13*/
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Email successfully inserted.');
				
				redirect(base_url().'admincp/email');

		}
		
		$data['title'] = 'Email';		
		$this->load->view('admincp/email/add',$data);
	}
	
	function edit($id)
	{
		$data['item'] = $this->dbemail->get_email_by_id($id);
		
		if(!$data['item']){redirect(base_url().'admincp/email');}
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_rules('email_template_name', 'Templete', 'required');
		$this->form_validation->set_rules('html', 'Message', 'required');
		$this->form_validation->set_rules('queued', 'Status', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			
			$data=array(
				'created'=>date('Y-m-d H:i:s'),
				'subject'=>$this->input->post('subject'),
				'template_id'=>$this->input->post('email_template_name'),
				'html'=>$this->input->post('html'),
				'queued'=>$this->input->post('queued')
				);
				$result=$this->dbemail->edit($data,$id);
				/*edit*/
					$this->dbadminheader->delete_ch_to_email_template($id);
					$this->dbadminheader->delete_email_template_to_member($id);
					
					$chapter = $this->input->post('chapter');
					$user_details = $this->input->post('user_details');
				
					if($chapter)
					{
						for($b=0; $b < count($chapter); $b++)
						{					
							$dataB=array(
							'email_template_id'=>$id,
							'ch_id'=>$chapter[$b]
							);
							$resultB=$this->dbadminheader->insert_ch_to_email_template($dataB);
						}
					}
					if($user_details)
					{
						for($b=0; $b < count($user_details); $b++)
						{					
							$dataC=array(
							'email_template_id'=>$id,
							'mm_id'=>$user_details[$b]
							);
							$resultC=$this->dbadminheader->insert_email_template_to_member($dataC);
						}
					}
					
					/*edit*/
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Email successfully updated.');
				
				redirect(base_url().'admincp/email');

		}
		
		$data['title'] = 'Edit Email';		
		$this->load->view('admincp/email/edit',$data);
	}
	
	public function delete($id)
	{
		$result=$this->dbemail->delete($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Email successfully deleted.');

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/email'));
			}
	}
	function get_template_chapter($template_id)
	{
		$html .= '<div class="space10px"></div>   
                     <div class="row">
                      <div  class="span11">
                      <label class="control-label">Select Chapter</label>
                        <table><tr>';
                        $chapter = $this->dbadminheader->get_chapters();
						$i = 0;
						$ij=0;
						$arr_ch_id=array();
						$arr_ch = array();
						foreach($chapter as $chapter_row)
						{
							if($i%6==0)
							{
								$html .= '</tr><tr>';
							}
							$ch_to_template = $this->dbadminheader->ch_to_template($template_id,$chapter_row->ch_id);
							if($ch_to_template)
							{
								$html .= "<td>
								<span class='span3'>
									<label class='checkbox'>";
									array_push($arr_ch_id,$chapter_row->ch_id);
									$html .= "<input  id='chapter[]' onclick='check_all_ch(this.value)'  type='checkbox' checked='checked' name='chapter[]' value='".$chapter_row->ch_id."'/>".$chapter_row->ch_name;
									$html .= "<input  id='ch_$chapter_row->ch_id'  type='hidden' name='ch_$chapter_row->ch_id' value='yes'/>";
									$html .= "</label>
								</span>
								</td>";
								$i++;
								$ij++;
							}
						}
						$html .= '</tr></table>
                    </div>
                    </div>
                <div class="space10px"></div>   
                <div class="row" >
                <label style="display:none;" >Select All User To Send Mail&nbsp;<input style="margin-top:0px" type="checkbox" id="check_all_user"  name="check_all_user" value="yes" onclick="check_all(this.value)" /></label>
				 <label  >User To Send Mail</label>';
				
				$j = 0;
				$ik=0;
				$i = 0;
				 foreach($arr_ch_id as $arr_ch_id)
                 {
				$html .= "<div style='float:left;' class='span11' id='used_data$arr_ch_id'>
                <table><tr>";
                			$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_ch($template_id,$arr_ch_id);
						
							$arr = array();
							foreach($get_user_details_from_ch as $get_user_details_from_ch)
							{
								array_push($arr,$get_user_details_from_ch->state_id);
							}
							$jj = 0;
							$user_details = $this->dbadminheader->user_details();
							foreach($user_details as $user_details)
							{
								
								if (in_array($user_details->mm_state_id,$arr))
								{
									if($i%6==0)
									{
										$html .= '</tr><tr>';
									}
									$html .= "<td>
									<span class='span3'>
										<label class='checkbox'>";
									$html .= "<input  type='checkbox' onclick='check_all_ch_member(this.value)' checked='checked' name='user_details[]' value='".$user_details->mm_id."'/>".$user_details->mm_username;
									$html .= "<input    id='ch_user$user_details->mm_id'  type='hidden' name='ch_$user_details->mm_id' value='yes'/>";
									$html .= "</label>
									</span>
								</td>";
									$j++;
									$jj++;
									$i++;
									$ik++;
								}
								
							}
							$html .= "<input type='hidden' id='cnt_$arr_ch_id' value='$jj' />";
						$html .= '</tr></table>
						</div>';
						 }
						$html .= '</div>';
						$template_html='';
						$get_chapters_template = $this->dbadminheader->get_chapters_template($template_id);
						foreach($get_chapters_template as $get_chapters_template_row)
						{
							$template_html=$get_chapters_template_row->template_html;	
										
						}
					echo $html."|".$j."|".$template_html."|".$ij."|".$ik;
	}
	function sending_template_mail($id)
	{
		$ids=explode('-',$id);
		$id=$ids[0];
		$template_id=$ids[1];
		
		
		$settings = $this->dbadminheader->getsettings();	
		/*send mail*/
		
			$email_template_id = $this->dbadminheader->email_template_to_member($id);
			$user_email='';
			$ik=0;
			foreach($email_template_id as $email_template_id_row)
			{
				$username[$ik]=$email_template_id_row->mm_username;
				$user_email[$ik]=$email_template_id_row->mm_email;
				$ik++;
			}
			
			$get_template = $this->dbadminheader->get_template();
			$templte_name='';
			foreach($get_template as $get_template_row)
			{
				
				if($get_template_row->template_id==$template_id)
				{
					$templte_name=$get_template_row->template_title;
				}
			}
			
			/*if($user_email != '')
			{
						//$mail_id=$row->mm_email;
						$this->load->library('phpmailer');
						$mail = new PHPMailer();
						$mail->Username = "virendra.testmail@gmail.com"; 
						$mail->Password = "admin123admin"; 
						for($i=0;$i<$ik;$i++)
						{
							$mail->AddAddress($user_email[$i],$username[$i]);
							
						}
						$mail->FromName = "virendra";
						$mail->IsHTML(true);
						$MESSAGE_BODY='';
						$MESSAGE_BODY .= "<b><u>Template Testing</u></b><br>"; 
						
					
						$mail->Subject = 'Template test';
						$mail->Body    = $MESSAGE_BODY ; 
						
						$mail->Host = "ssl://smtp.gmail.com";
						$mail->Port = 465;
						$mail->IsSMTP();
						$mail->SMTPAuth = true;
						$mail->From = $mail->Username;
						$mail->Send();
						if($mail->send())
						{
						$data=array('email_send'=>'1');
						$result=$this->dbemail->edit($data,$id);	
						}
			}*/
			if($user_email != '')
			{
					$email = $settings->email;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->from($settings->email);
					for($i=0;$i<$ik;$i++)
					{
						$this->email->to(trim($user_email[$i]));
					}
					//$this->email->to(trim('test6.capital@gmail.com'));
					$this->email->subject($this->input->post('subject'));
					$final_message = array('template_name' => $templte_name);
					
					
					$this->email->message($this->parser->parse('template_parser_for_admin', $final_message , TRUE));
					
					$this->email->send();
					
						$data=array('email_send'=>'1');
						$result=$this->dbemail->edit($data,$id);	
						
			}
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_send'));
		redirect(base_url().'admincp/email');
		/*send mail*/
	}
	
}
?>