<?php
error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

				

		$login = $this->session->userdata('username');

		

		$this->load->model('chapteradmincp/dbevents');

		$this->load->model('chapteradmincp/dbadminheader');
		
		$this->load->library('email');
		$this->load->library('parser');

		

		if($login=='')

		{

			redirect(base_url().'chapteradmincp/login');

		}

		

		

	}

	

	public function index()

	{

		$this->view();

	}

	

	public function view()

	{

		$num_rec=$this->dbevents->count_events();

		

		$this->load->library('pagination');

		$config['base_url'] = base_url().'chapteradmincp/events/view/';

		$config['total_rows'] = $num_rec;

		$config['per_page'] = 20;

		$config['uri_segment'] =  4;

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

		$data['query'] = $this->dbevents->get_all_events($config['per_page'],$segment);

		$this->pagination->initialize($config);

		$data['title']= 'Manage Events';

		$this->load->view('chapteradmincp/events/view',$data);

	}

	

	public function add()

	{

		$this->form_validation->set_rules('event_name', 'Event Title', 'required');

		$this->form_validation->set_rules('event_description', 'Event Description', 'required');

		$this->form_validation->set_rules('event_date_time', 'Date', 'required');

		//$this->form_validation->set_rules('event_ch_id', 'Chapter', 'required');

		$this->form_validation->set_rules('event_location', 'Event Location', 'required');

		$this->form_validation->set_rules('event_status', 'Event Status', 'required');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			$data=array(

				'event_name'=>$this->input->post('event_name'),

				'event_description'=>$this->input->post('event_description'),

				//'event_ch_id'=>$this->input->post('event_ch_id'),

				'event_date_time'=>$this->input->post('event_date_time'),

				'event_location'=>$this->input->post('event_location'),

				'event_status'=>$this->input->post('event_status'),

				'event_created_date'=>$this->input->post('event_created_date'),

				'event_created_by'=>$this->input->post('event_created_by')

				);

			$result=$this->dbevents->insert($data);

			

			$inserted_id = $this->db->insert_id();

			$chapter_id = $this->session->userdata('get_chapter_id');

					

				$dataB=array(

						'events_id'=>$inserted_id,

						'ch_id'=>$chapter_id

						);

			$resultB=$this->dbadminheader->insert_ch_to_events($dataB);

			

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

			

			redirect(base_url().'chapteradmincp/events');

		}

		$data['title']='Add Event';
		$this->load->view('chapteradmincp/events/add',$data);

	}

	

	public function edit($id)

	{

		$data['query']= $this->dbevents->get_event_by_id($id);

		

		$this->form_validation->set_rules('event_name', 'Event Title', 'required');

		$this->form_validation->set_rules('event_description', 'Event Description', 'required');

		$this->form_validation->set_rules('event_date_time', 'Date', 'required');

		$this->form_validation->set_rules('event_ch_id', 'Chapter', 'required');

		$this->form_validation->set_rules('event_location', 'Event Location', 'required');

		$this->form_validation->set_rules('event_status', 'Event Status', 'required');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			$data=array(

				'event_name'=>$this->input->post('event_name'),

				'event_description'=>$this->input->post('event_description'),

				'event_ch_id'=>$this->input->post('event_ch_id'),

				'event_date_time'=>$this->input->post('event_date_time'),

				'event_location'=>$this->input->post('event_location'),

				'event_status'=>$this->input->post('event_status'),

				'event_created_date'=>$this->input->post('event_created_date'),

				'event_created_by'=>$this->input->post('event_created_by'),

				'event_modified_date'=>$this->input->post('event_modified_date'),

				'event_modified_by'=>$this->input->post('event_modified_by')

				);

			$result=$this->dbevents->edit($data,$id);
			
			

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

			

			redirect(base_url().'chapteradmincp/events');

		}

	

	

		$data['title']='Edit Event';

		$this->load->view('chapteradmincp/events/edit',$data);

	}

	

	public function delete($id)

	{

			

		//$result=$this->dbevents->delete($id);/*--------update by monita(06/08/2013)-------*/

		$this->dbadminheader->delete_ch_to_events($id);
		$this->dbadminheader->delete_events_template_to_member($id);
		
		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		if ($this->agent->is_referral())

		{

			redirect($this->agent->referrer());

		}

		else

		{

			redirect(base_url('chapteradmincp/events/view'));

		}

		

	}
	
	function invite()
	{
		
		$this->load->model('dbheader');
		
		$settings = $this->dbheader->get_setting();
		
		$id = $this->uri->segment(5);
		
		$data['user'] = $this->dbadminheader->user_detail($this->session->userdata('get_chapter_id'));
		
		$data['queryC'] = $this->dbevents->get_event($id,$this->session->userdata('get_chapter_id'));
		
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_rules('event_msg', 'Message', 'required');
		$this->form_validation->set_rules('queued', 'Status', 'required');
		$this->form_validation->set_rules('fetch_user_data_after_save','please Select Atleast one user', 'required|trim');		
		
		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
			$start_num=$this->dbadminheader->check_all_user_with_send_verification_from_member($id);
			$startNum=$this->dbadminheader->check_all_user_with_send_verification($id);
			if($start_num->start_num1!=$startNum->startNum2)
			{
				$data=array(
				'subject'=>$this->input->post('subject'),
				'html'=>$this->input->post('event_msg'),
				'queued'=>$this->input->post('queued'),
				'email_send'=>0
				);
			}
			else
			{
				$data=array(
				'subject'=>$this->input->post('subject'),
				'html'=>$this->input->post('event_msg'),
				'queued'=>$this->input->post('queued')
				);	
			}
			$result=$this->dbevents->edit($data,$id);
			$this->dbadminheader->delete_events_template_to_member_user($id);
			
				$user_details=explode(' ',trim($this->input->post('fetch_user_data_after_save')));
				$mm_type_sel_data=$this->input->post('mm_type_sel_data');
				//exit;
				if($user_details)
				{
					for($b=0; $b < count($user_details); $b++)
					{
						$user_details[$b]=str_replace("-u","",$user_details[$b]);
						$ch_to_template_id = $this->dbadminheader->events_to_mm($id,$user_details[$b]);
						if($ch_to_template_id->mail_send_status==0)
						{
							//$this->dbadminheader->delete_email_template_to_member_user($id,$user_details[$b]);
							$dataC=array(
							'email_template_id'=>$id,
							'mm_id'=>$user_details[$b]
							);
							$resultC=$this->dbadminheader->insert_events_to_member($dataC);
						}
						else if($mm_type_sel_data==6)
						{
							
							$dataC=array(
							'email_template_id'=>$id,
							'mm_id'=>$user_details[$b]
							);
							$resultC=$this->dbadminheader->update_pending_user_event($dataC);	
							if($resultC)
							{
								$resultD=$this->dbadminheader->update_startnum($id);
							}
						}
					}
				}
			$mm_ids = $user_details;
			/*for($i=0;$i < count($mm_ids); $i++)
			{
				$mm_ids[$i]=str_replace("-u","",$mm_ids[$i]);
				$unique_key = substr(md5(rand(0, 1000000)), 0, 35);
				$get_mm_email = $this->dbevents->get_member_email_by_mm_id($mm_ids[$i]);
				$check_event_invitation = $this->dbevents->check_event_invitation($mm_ids[$i],$id);
				
	
				if($check_event_invitation)
				{
				$dataB=array(
					'email_status'=>$check_event_invitation->email_status+1
					);
				
				$resultB=$this->dbevents->edit_event_invitation($dataB,$check_event_invitation->ei_id);
				}
				else
				{
					$dataB=array(
					'mm_id'=>$mm_ids[$i],
					'event_id'=>$id,
					'email_status'=>1,
					'unique_number'=>$unique_key,
					'create_time'=>date('Y-m-d H:m:s')
					);
				$resultB=$this->dbevents->insert_event_invitation($dataB);
				}
				
				
				$config['mailtype'] = 'html';
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['bcc_batch_mode'] = TRUE;
				
				$this->email->initialize($config);
				
				$this->email->from($settings->email);
				$this->email->to($get_mm_email->mm_email);
				
				$this->email->subject($this->input->post('subject'));
				
				$email_link = base_url('user/invitation_details/'.$id.'/'.$unique_key);
				
				$final_message = array('link' => $email_link,'message' => $this->input->post('event_msg'),'site_email' => $settings->email, 'sitename'=>$settings->sitename);
				$this->email->message($this->parser->parse('invite_parser', $final_message , TRUE));
				$email_sent = $this->email->send();
				if($email_sent)
				{
						$data=array(
						'mail_send_status'=>1
						);
						$result=$this->dbevents->mail_send_status($data,$mm_ids[$i],$id);
				}
				
				//echo $this->email->print_debugger();	
				
			}*/
			if($data['user']->mm_chapter_id=='')
			{
			$data['user']->mm_chapter_id=0;	
			}
			$dataA=array(
				'event_id'=>$id,
				'event_msg'=>$this->input->post('event_msg'),
				'event_subject'=>$this->input->post('subject'),
				'mm_ca_id'=>$data['user']->mm_chapter_id,
				'em_create'=>date('Y-m-d H:i:s')
				);
				$resultA=$this->dbevents->insert_event_msg($dataA);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Invitation email sent to members!');
				$this->resend_mail($id);
				//redirect(base_url('chapteradmincp/events'));
				
		}
		
		$data['get_state'] = $this->dbevents->get_state_from_ch_id($this->session->userdata('get_chapter_id'));
		
		$data['query'] = $this->dbevents->get_members($this->session->userdata('get_chapter_id'));
		
		$data['title'] = 'Invitation for Event';
		
		$data['sub_title'] = 'Send invitation to members for '.$data['queryC']->event_name.' Event';
		$data['description'] = "";
		$data['keywords'] = "";
		$this->load->view('chapteradmincp/events/ca_members',$data);
	}
	function queue_mail($id)

	{

		$data=array('email_template_status'=>1);

		$result=$this->dbevents->edit($data,$id);

		redirect(base_url().'chapteradmincp/events');

	}

	function stop_mail($id)

	{

		$data=array('stop_mail'=>1);

		$result=$this->dbevents->edit($data,$id);

		redirect(base_url().'chapteradmincp/events');

	}

	function start_mail($id)

	{

		$data=array('stop_mail'=>0);

		$result=$this->dbevents->edit($data,$id);

		redirect(base_url().'chapteradmincp/events');

	}

	function resend_mail($id)

	{

		$data=array('email_template_status'=>0,'email_send'=>0,'stop_mail'=>0);

		$result=$this->dbevents->edit($data,$id);

		redirect(base_url().'chapteradmincp/events');

	}

	function resume_mail($id)

	{

		$data=array('stop_mail'=>0,'email_send'=>0);

		$result=$this->dbevents->edit($data,$id);

		redirect(base_url().'chapteradmincp/events');

	}
	
	/////////////////////////////////////////////////////pradip_201403260330///////////////////////////////////////////////////	
	function get_template_user()
	{
		$mm_type=$_POST['mm_type'];
		$username=$_POST['username'];
		$id=$_POST['id'];
		$ch_id=$_POST['ch_id'];
		$offset=$_POST['offset'];
		$fetch_user_data=$_POST['fetch_user_data'];
		$check_uncheck_all_user_status=$_POST['check_uncheck_all_user_status'];
		if(isset($_POST['user_count']))
		{
			$user_count = $_POST['user_count'];
		}
		$fetch_user_data_after_save=$_POST['fetch_user_data_after_save'];	
		$just_use=$_POST['just_use'];
		//$edit=$_POST['edit'];
		
		
		$limit=10;
		$i = 0;
		$base_url=base_url();
		$state = '';
		$member_id = '';
		$temp=0;
		$this->load->library('pagination');
		$ex_ch_id=explode('_',$ch_id);
		for($i=0;$i<sizeof($ex_ch_id);$i++)
		{
			$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_chapter($ex_ch_id[$i]);
				foreach($get_user_details_from_ch as $get_user_details_from_ch)
				{
					$state .=$get_user_details_from_ch->mm_state_id.',';
				}	
			
			
		}
		$state = substr($state, 0,-1);
		$user_details_data= $this->dbadminheader->user_details_state($state);
		/*foreach($user_details_data as $user_details_data)
		{
			$member_id .=$user_details_data->mm_id.',';
		}
		$member_id = substr($member_id, 0,-1);*/
		if($just_use == '0' || $just_use == 0)
		{
			if($fetch_user_data=="" || $fetch_user_data=='0')
			{
				if($fetch_user_data_after_save == "" || $fetch_user_data_after_save == '0')
				
				{
					$user_details_data1 = $this->dbadminheader->user_details_for_edit_invitation($id);
					if(count($user_details_data1)!=0 || count($user_details_data1)!='0')
					{
						
						//$user_details_data= $this->dbadminheader->user_details_state($state);
						
						foreach($user_details_data1 as $user_details_data)
		
						{
		
							$member_id .=$user_details_data->mm_id.',';
		
						}
				
		
						$member_id = substr($member_id, 0,-1);
					}
					else
					{
						foreach($user_details_data as $user_details_data)
		
						{
			
							$member_id .=$user_details_data->mm_id.',';
			
						}		
						$member_id = substr($member_id, 0,-1);
					}
					
				}
				else
				{
					$fetch_user_data_after_save=str_replace("-u","",$fetch_user_data_after_save);

						

						$fetch_user_data_after_save=str_replace("%20"," ",$fetch_user_data_after_save);

						$fetch_user_data_after_save=trim($fetch_user_data_after_save);

						$fetch_user_data_after_save=str_replace(" ",",",$fetch_user_data_after_save);
				
						
						$member_id = $fetch_user_data_after_save;
				}
				
			}
			else
			{
				if($fetch_user_data_after_save=="" || $fetch_user_data_after_save=='0')
				{
					$fetch_user_data=str_replace("-u","",$fetch_user_data);

						

						$fetch_user_data=str_replace("%20"," ",$fetch_user_data);

						$fetch_user_data=trim($fetch_user_data);

						$fetch_user_data=str_replace(" ",",",$fetch_user_data);
				
						
					$member_id = $fetch_user_data;
				}
				else
				{
					$fetch_user_data_after_save=str_replace("-u","",$fetch_user_data_after_save);

						

						$fetch_user_data_after_save=str_replace("%20"," ",$fetch_user_data_after_save);

						$fetch_user_data_after_save=trim($fetch_user_data_after_save);

						$fetch_user_data_after_save=str_replace(" ",",",$fetch_user_data_after_save);
				
						
					$member_id = $fetch_user_data_after_save;
				}
				
			}
			
			
			
		}
		else
		{
			foreach($user_details_data as $user_details_data)
	
				{
	
					$member_id .=$user_details_data->mm_id.',';
	
				}		
				$member_id = substr($member_id, 0,-1);
				
		}
		
		if($username=='0' && $mm_type=='0')
		{
		$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);
		}
		else
		{
		//$user_details = $this->dbadminheader->get_all_user_search($username,$offset, $limit,$member_id);
		$user_details = $this->dbadminheader->get_all_user_search1($username,$offset,$limit,$member_id,$id,$mm_type);
		}
		?>       
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table table-hover" >
        <thead>
        <tr>
        	<th scope="col" width="3%"><input onclick="chkall_d()"  type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" name="chkall" value="no"/>
            <input type="hidden" id="chkall_check" value="no"/></th>
			<th scope="col" width="20%">Username</th>
            <th scope="col" width="32%">Email Id</th>
			<th scope="col" width="18%">Chapter Name</th>
            <th scope="col" width="12%">Mail Status</th>
            <th scope="col" width="15%">Profile Status</th>
        </tr>
    	</thead>
        <tr>
        <?php
		$i = 0;
		foreach($user_details as $user_details)
		{
			if($i%1==0)
			{
			?>
            </tr><tr>
			<?php
			}
			$ch_name1 = $this->dbadminheader->fetch_ch_name($user_details->mm_state_id);
			//var_dump($id);
			//var_dump($user_details->mm_id);
			$ch_to_template_id = $this->dbadminheader->events_to_mm($id,$user_details->mm_id);
			//var_dump($ch_to_template_id);
			//echo $user_details->mm_id."-".$ch_to_template_id->mail_send_status;
			?>
                 <td>
                 	<?php
					if($ch_to_template_id->mail_send_status==1)
					{?>
                    <span class="span3" >
                        <label class="checkbox">
                        
                            <input disabled="disabled"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
                            <input  id='ch_user<?php echo $user_details->mm_id; ?>' size="20"  type='hidden' name='ch_user<?php echo $user_details->mm_id; ?>' value='yes'/>	        </label>
                    </span>
                    <?php
					}
					else
					{ 
						$fetch_user_data=str_replace("-u","",$fetch_user_data);
						$fetch_user_data=str_replace("%20"," ",$fetch_user_data);
						$fetch_user_data=trim($fetch_user_data);
						$fetch_user_data=str_replace(" ",",",$fetch_user_data);
						$fetch_user_data_array=explode(",",$fetch_user_data);
						
						if($fetch_user_data!=0)
						{
							//$mm_id_set = $this->dbadminheader->user_details_from_checked($user_details->mm_id,$fetch_user_data);
							$mm_id_set = 0;
							if (in_array($user_details->mm_id,$fetch_user_data_array))
							{
								$mm_id_set =1;
							}
							if($check_uncheck_all_user_status=="yes")
							{
								/*echo "if_yes1<br>";
								echo $check_uncheck_all_user_status."<br>";*/
							?>
									
                                    <span class="span3" >
										<label class="checkbox">
											<input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"  checked="checked"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
									 		 
										 </label>
									</span>
							<?php
							}
							else
							{
								/*echo "else_no1<br>";
								echo $check_uncheck_all_user_status."<br>";*/
								?>
									<span class="span3" >
										<label class="checkbox">
											<input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"  <?php  if($mm_id_set==1){echo 'checked="checked"'; }?>  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
											
										 </label>
									</span>	
							<?php
                            }
							
						}
						else
							{
								?>
                            	<span class="span3" >
                                    <label class="checkbox">
                                        <input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"   type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
                                     
                                     </label>
                                </span>
							<?php
								
							}
					}
					?>
                </td>
                <td>
                    <span class="span3" ><?php echo $user_details->mm_username; ?></span>
                </td>
                <td>
                     <span class="span3" ><?php echo $user_details->mm_email; ?></span>
                </td>
                <td>
                 
                    <span class="span3" ><?php echo $ch_name1->ch_name; ?> </span>
                </td>
                <td>
                 <?php if($ch_to_template_id->mail_send_status==1)
				 {?>
                 <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
				 <?php
                 }
				 else
				 {?>
                  <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" />
				 <?php
                 }
				 ?>
                </td>
                <td>
                 <?php
				 $invite_satus = $this->dbadminheader->events_to_mm_status($id,$user_details->mm_id);
				 if($invite_satus->status_id ==1)
				 {
					 echo "<div>
                        <span class='label label-success'>Confirmed</span>
                        </div>";
                 }
				 else if($invite_satus->status_id ==2)
				 {
					 echo "<div>
                        <span class='label label-warning'>Maybe</span>
                        </div>";
                 }
				 else if($invite_satus->status_id ==3)
				 {
					 echo "<div>
                        <span class='label label-important'>Not Coming</span>
                        </div>";
                 }	
				
				 ?>
                </td>
			<?php
			$i++;
        }
		
		if($i==0)
		{
			echo "<td colspan='5'>No result found!!!</td>";
		}?>
        
		</tr>
        </table>
        <?php
		$j=0;
		//if($username=='0' && $mm_type=='0')
		//{
		////$totalRows= $this->dbadminheader->user_details_state($state);
		//}
		//else
		//{
		$totalRows= $this->dbadminheader->count_user_search1($username,$member_id,$id,$mm_type);
		//}
		
		foreach($totalRows as $totalRows)
		{
			$j++;
        }
		$config['base_url'] = base_url().'chapteradmincp/verification/edit';
        $config['total_rows'] = $j;
		$config['per_page'] = $limit;
		$config['cur_page'] =$offset;
		$this->pagination->initialize($config);
        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);
        $data['base_url'] = $config['base_url'];
        $data['page_link'] = $this->pagination->create_js_links();
		?>
		<input type="hidden" id="offset" value="<?php echo $offset;?>" />
		<tfoot>
    	<tr>
        	<?php print_r('<div align="center" class="pagination"><ul><li>'.$data['page_link'].'</li></ul></div>');?>
        </tr>
	    </tfoot>
		<?php
		echo "|".$i."|".$j;
	
	}
/////////////////////////////////////////////////////end///////////////////////////////////////////////////	

	function get_template_user1()
	{
		
		$mm_type=$_POST['mm_type'];
		
		$username=$_POST['username'];
		$id=$_POST['id'];
		$ch_id=$_POST['ch_id'];
		$offset=$_POST['offset'];
		$fetch_user_data=$_POST['fetch_user_data'];
		$check_uncheck_all_user_status=$_POST['check_uncheck_all_user_status'];
		
		$limit=10;
		$i = 0;
		$base_url=base_url();
		$state = '';
		$member_id = '';
		$temp=0;
		$this->load->library('pagination');
		$ex_ch_id=explode('_',$ch_id);
		for($i=0;$i<sizeof($ex_ch_id);$i++)
		{
			$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_chapter($ex_ch_id[$i]);
				foreach($get_user_details_from_ch as $get_user_details_from_ch)
				{
					$state .=$get_user_details_from_ch->mm_state_id.',';
				}	
			
			
		}
		$state = substr($state, 0,-1);
		$user_details_data= $this->dbadminheader->user_details_state($state);
		foreach($user_details_data as $user_details_data)
		{
			$member_id .=$user_details_data->mm_id.',';
		}
		$member_id = substr($member_id, 0,-1); 
		
		if($username=='0' && $mm_type=='0')
		{
		$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);
		}
		else
		{
		$user_details = $this->dbadminheader->get_all_user_search1($username,$offset,$limit,$member_id,$id,$mm_type);
		}
		?>       
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table table-hover" >
        <thead>
        <tr>
        	<th scope="col" width="3%">
            <input  onclick="chkall_d()"  type="checkbox" style="margin: 0 5px 2px 0; display:none" id="chkall" name="chkall" value="no"/>
            <input type="hidden" id="chkall_check" value="no"/></th>
			<th scope="col" width="15%">Username</th>
            <th scope="col" width="25%">Email Id</th>
            <?php if($mm_type == 0 || $mm_type == 1) { 
				 ?>
            <th scope="col" width="12%">Mail Status</th>
            <th scope="col" width="15%">Profile Status</th>
            <?php if($mm_type == 1){
					?>
					<th scope="col" width="18%">Sent Date & Time</th>
					<?php } ?>
            <?php }else {?>
			<th scope="col" width="5%">Adults</th>
            <th scope="col" width="5%">Kids</th>
            <th scope="col" width="15%">RSVP Date & Time</th>
            <?php } ?>
        </tr>
    	</thead>
        <tr>
        <?php
		$i = 0;
		foreach($user_details as $user_details)
		{
			if($i%1==0)
			{
			?>
            </tr><tr>
			<?php
			}
			$ch_name1 = $this->dbadminheader->fetch_ch_name($user_details->mm_state_id);
			//var_dump($id);
			//var_dump($user_details->mm_id);
			$ch_to_template_id = $this->dbadminheader->events_to_mm($id,$user_details->mm_id);
			//var_dump($ch_to_template_id);
			?>
                 <td>
                 	<?php
					if($ch_to_template_id->mail_send_status==1)
					{?>
                    <span class="span3" >
                        <label class="checkbox">
                            <input style="display:none" disabled="disabled"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
                            <input  id='ch_user<?php echo $user_details->mm_id; ?>' size="20"  type='hidden' name='ch_user<?php echo $user_details->mm_id; ?>' value='yes'/>	        </label>
                    </span>
                    <?php
					}
					else
					{
						$fetch_user_data=str_replace("-u","",$fetch_user_data);
						$fetch_user_data=str_replace("%20"," ",$fetch_user_data);
						$fetch_user_data=trim($fetch_user_data);
						$fetch_user_data=str_replace(" ",",",$fetch_user_data);
						$fetch_user_data_array=explode(",",$fetch_user_data);
						if($fetch_user_data!=0)
						{
							//$mm_id_set = $this->dbadminheader->user_details_from_checked($user_details->mm_id,$fetch_user_data);
							$mm_id_set = 0;
							if (in_array($user_details->mm_id,$fetch_user_data_array))
							{
								$mm_id_set =1;
							}
							if($check_uncheck_all_user_status=="yes")
							{
								/*echo "if_yes1<br>";
								echo $check_uncheck_all_user_status."<br>";*/
							?>
									
                                    <span class="span3" >
										<label class="checkbox">
											<input style="display:none" onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"  checked="checked"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
											
										 </label>
									</span>
							<?php
							}
							else
							{
								/*echo "else_no1<br>";
								echo $check_uncheck_all_user_status."<br>";*/
								?>
									<span class="span3" >
										<label class="checkbox">
											<input style="display:none" onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"  <?php  if($mm_id_set==1){echo 'checked="checked"'; }?>  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
											
										 </label>
									</span>	
							<?php
                            }
							
						}
						else
							{
								?>
                            	<span class="span3" >
                                    <label class="checkbox">
                                        <input style="display:none" onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"   type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  
                                        
                                     </label>
                                </span>
							<?php
								
							}
					}
					?>
                </td>
                <td>
                    <span class="span3" ><?php echo $user_details->mm_username; ?></span>
                </td>
                <td>
                     <span class="span3" ><?php echo $user_details->mm_email; ?></span>
                </td>
                <?php if($mm_type == 0 || $mm_type == 1) { ?>
                <?php /*?><td>
                 
                    <span class="span3" ><?php echo $ch_name1->ch_name; ?> </span>
                </td><?php */?>
                <td>
                 <?php if($ch_to_template_id->mail_send_status==1)
				 {?>
                 <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
				 <?php
                 }
				 else
				 {?>
                  <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" />
				 <?php
                 }
				 ?>
                   
                </td>
                <td>
                 <?php
				 
				 $invite_satus = $this->dbadminheader->events_to_mm_status($id,$user_details->mm_id);
				 if($invite_satus->status_id ==1)
				 {
					 echo "<div>
                        <span class='label label-success'>Confirmed</span>
                        </div>";
                 }
				 else if($invite_satus->status_id ==2)
				 {
					 echo "<div>
                        <span class='label label-warning'>Maybe</span>
                        </div>";
                 }
				 else if($invite_satus->status_id ==3)
				 {
					 echo "<div>
                        <span class='label label-important'>Not Coming</span>
                        </div>";
                 }	
				
				 ?>
                </td>
                <?php if($mm_type == 1){
					?>
					<td><span class="span3" ><?php echo $user_details->create_time; ?></span> </td>
					<?php } ?>
                <?Php } else { ?>
               <td> <span class="span3" ><?php echo $user_details->adult_count; ?></span></td>
               <td> <span class="span3" ><?php echo $user_details->kids_count; ?></span></td>
               <td> <span class="span3" ><?php echo date('D, d M Y H:i:s',strtotime($user_details->rsvp_time)); ?></span></td>
                
                <?php } ?>
			<?php
			$i++;
        }
		
		if($i==0)
		{
			echo "<td colspan='5'>No result found!!!</td>";
		}?>
        
		</tr>
        </table>
        <?php
		$j=0;
		
		if($username=='0' && $mm_type=='0')
		{
		$totalRows= $this->dbadminheader->user_details_state($state);
		}
		else
		{
			
		$totalRows= $this->dbadminheader->count_user_search1($username,$member_id,$id,$mm_type);
		}
		
		foreach($totalRows as $totalRows)
		{
			$j++;
        }
		$config['base_url'] = base_url().'chapteradmincp/verification/edit';
        $config['total_rows'] = $j;
		$config['per_page'] = $limit;
		$config['cur_page'] =$offset;
		$this->pagination->initialize($config);
        $jsFunction['name'] = 'show';
        $jsFunction['params'] = array();
        $this->pagination->initialize_js_function($jsFunction);
        $data['base_url'] = $config['base_url'];
        $data['page_link'] = $this->pagination->create_js_links();
		?>
		<input type="hidden" id="offset" value="<?php echo $offset;?>" />
		<tfoot>
    	<tr>
        	<?php print_r('<div align="center" class="pagination"><ul><li>'.$data['page_link'].'</li></ul></div>');?>
        </tr>
	    </tfoot>
		<?php
		echo "|".$i."|".$j;
	
	}
	
	function edit_user($id,$chapter,$user)
	{
		$chapter_id=explode('_',$chapter);
		$this->dbadminheader->delete_ch_to_events($id);
		for($i=0;$i<sizeof($chapter_id);$i++)
		{
			$dataB=array(
			'events_id'=>$id,
			'ch_id'=>$chapter_id[$i]
			);
			$resultB=$this->dbadminheader->insert_ch_to_events($dataB);
		}
		
		echo $this->session->set_flashdata('message_type', 'success');
		echo $this->session->set_flashdata('status_', 'User successfully updated.');		
				
	}
	function add_user($id,$chapter,$user)
	{
		$this->session->set_userdata('chapter_data',$chapter);
		//$this->session->set_userdata('user_data',$user);	
	}
	function cron_check($uid)
	{
		
		$email_template_status=0;
		$stop_mail=0;
		$cron_check_id = $this->dbadminheader->cron_check_id_events($uid);
		foreach($cron_check_id as $row)
		{
			$email_template_status=$row->email_template_status;	
			$stop_mail=$row->stop_mail;	
			$email_send =$row->email_send;	
			$queued=$row->queued;
		}
		echo $email_template_status."|".$stop_mail."|".$email_send."|".$queued;
	}
	function user_check_uncheck($status,$id,$user,$action)
	{
		echo $user;
	}
	
	/////////////////////////////////////////////////////pradip_201403260330///////////////////////////////////////////////////	
	function user_check_uncheck_all()
	{
		//$status,$id,$ch_id,$action,$type,$offeset;
			$status=$_POST['status'];
			$id=$_POST['id'];
			$ch_id=$_POST['ch_id'];
			$action=$_POST['action'];
			$type=$_POST['type'];
			$offeset=$_POST['offeset'];
			$m_type = $_POST['m_type'];
			
		
			$m_search = $_POST['m_search'];
			
			$fetch_user_data=$_POST['fetch_user_data'];
			
			$fetch_user_data_after_save=$_POST['fetch_user_data_after_save'];
			
			$just_use=$_POST['just_use'];
			
			if($action=='true')
			{
				echo $this->get_template_user_check_all($fetch_user_data,$fetch_user_data_after_save,$just_use,$m_search,$m_type,$id,$ch_id,$type,$offeset);
			}
			else
			{
				if($type=='chkall')
				{
					
				echo $this->get_template_user_check_all($fetch_user_data,$fetch_user_data_after_save,$just_use,$m_search,$m_type,$id,$ch_id,$type,$offeset);
				}
				else
				{
				echo '';	
				}
			}
	}
	function check_uncheck_all_user($status)
	{
		if($status=='no')
		{
			echo "<a href='javascript:void(0)'>Uncheck All user</a>|yes";
		}
		else
		{
			echo "<a href='javascript:void(0)'>Check All user</a>|no";
		}
	}
	function get_template_user_check_all($fetch_user_data,$fetch_user_data_after_save,$just_use,$m_search,$m_type,$id,$ch_id,$type,$offeset)
	{
		
		$base_url=base_url();
		$m_id='';
		$state = '';
		$member_id = '';
		$temp=0;
		$limit=10;
		$ex_ch_id=explode('_',$ch_id);
		for($i=0;$i<sizeof($ex_ch_id);$i++)
		{
			if($ex_ch_id[$i]==0)
			{
				$temp=1;
				break;
			}
			else
			{
				$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_chapter($ex_ch_id[$i]);
				foreach($get_user_details_from_ch as $get_user_details_from_ch)
				{
					$state .=$get_user_details_from_ch->mm_state_id.',';
				}	
			}
			
		}
		if($temp==1)
		{
			$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_chapter_for_national(0);
			foreach($get_user_details_from_ch as $get_user_details_from_ch)
			{
				$state .=$get_user_details_from_ch->mm_state_id.',';
			}
		}
		
		$state = substr($state, 0,-1);
		$user_details_data= $this->dbadminheader->user_details_state($state);
		/*foreach($user_details_data as $user_details_data)
		{
			$member_id .=$user_details_data->mm_id.',';
		}
		$member_id = substr($member_id, 0,-1);*/
		
		if($just_use == '0' || $just_use == 0)
		{
			if($fetch_user_data=="" || $fetch_user_data=='0' )
			{
				if($fetch_user_data_after_save == "" || $fetch_user_data_after_save == '0')
				{
					foreach($user_details_data as $user_details_data)
	
					{
		
						$member_id .=$user_details_data->mm_id.',';
		
					}		
					$member_id = substr($member_id, 0,-1);
				}
				else
				{
					$fetch_user_data_after_save=str_replace("-u","",$fetch_user_data_after_save);

						

						$fetch_user_data_after_save=str_replace("%20"," ",$fetch_user_data_after_save);

						$fetch_user_data_after_save=trim($fetch_user_data_after_save);

						$fetch_user_data_after_save=str_replace(" ",",",$fetch_user_data_after_save);
				
						
					$member_id = $fetch_user_data_after_save;
				}
			
				
				
				
			}
			else
			{
				$fetch_user_data_after_save=str_replace("-u","",$fetch_user_data_after_save);

						

						$fetch_user_data_after_save=str_replace("%20"," ",$fetch_user_data_after_save);

						$fetch_user_data_after_save=trim($fetch_user_data_after_save);

						$fetch_user_data_after_save=str_replace(" ",",",$fetch_user_data_after_save);
				
						
				$member_id = $fetch_user_data_after_save;
			}
			
			
			
		}
		else
		{
			/*$fetch_user_data=str_replace("-u","",$fetch_user_data);

						

						$fetch_user_data=str_replace("%20"," ",$fetch_user_data);

						$fetch_user_data=trim($fetch_user_data);

						$fetch_user_data=str_replace(" ",",",$fetch_user_data);
				
						
				$member_id = $fetch_user_data;*/
				foreach($user_details_data as $user_details_data)
	
				{
	
					$member_id .=$user_details_data->mm_id.',';
	
				}		
				$member_id = substr($member_id, 0,-1);
				
		}
		
		
		
		if($type=='check_uncheck_all_user')
		{
			
		$user_details = $this->dbadminheader->user_details_pagination_with_check_all_for_event($member_id,$m_type,$m_search);
		//$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);
		}
		else
		{
			
		$user_details = $this->dbadminheader->user_details_pagination_with_check_all_page_for_event($member_id,$offeset,$limit,$m_type,$m_search);
		}
		foreach($user_details as $user_details)
		{
			
			$ch_to_template_id = $this->dbadminheader->events_to_mm($id,$user_details->mm_id);
			if($ch_to_template_id->mail_send_status==0 && $mm_type!=6)
			{
				$m_id .=$user_details->mm_id."-u_";
			}
			else if($mm_type==6)
			{
				$m_id .=$user_details->mm_id."-u_";
			}
		}
		
		return $m_id = substr($m_id,0,-1);
		
	}
	/////////////////////////////////////////////////////pradip_201403260330///////////////////////////////////////////////////
/*	function rsvp()
	{
		
		$query->event_id=$_POST['id'];
		$count_invitation = $this->dbevents->count_invitation($query->event_id);?>
        
        
        <div style="width:100px; float:left; clear:both;">
        <table>
		<tr><td ><a  href="javascript:void(0)" onclick="search_rsvp(1)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span></a></td>
<?php
		$count_rsvp = $this->dbevents->count_rsvp($query->event_id);
		?>
          <td><a  href="javascript:void(0)" onclick="search_rsvp(2)" ><span id="" style="margin-top:5px; margin-right:10px;float:left" class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span></a></td>
          <?php
		  
		$count_confirm = $this->dbevents->count_confirm($query->event_id);
		?>
         <?php
		$count_people = $this->dbevents->count_people($query->event_id);
		?>
         <td><a  href="javascript:void(0)" onclick="search_rsvp(3)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span></a></td>
         <?php
		$count_maybe = $this->dbevents->count_maybe($query->event_id);
		?>
        <td> <a  href="javascript:void(0)" onclick="search_rsvp(4)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span></a></td>
          <?php
		$count_notcoming = $this->dbevents->count_notcoming($query->event_id);
		?>
       <td><a  href="javascript:void(0)" onclick="search_rsvp(5)" > <span style="margin-top:5px;margin-right:10px; float:left" class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span></a></td>
       
         <td><a  href="javascript:void(0)" onclick="search_rsvp(6)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-inverse"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</span></a></td></tr>
         </table>
         </div>
         
         <?php
		
		
	}*/
	
	public function get_chapters()

	{
		
		$uid = 	$this->uri->segment(4);
		
		$result = $this->dbevents->get_chapters($uid);
		
		echo $result->ch_id;
	}
	
	public function get_members()

	{
		
		$item->uid=$this->uri->segment(4);
		
			 $mm_id_edit = $this->dbadminheader->fetch_user_for_edit_events($item->uid);
			 
			 $member_id=' ';
			 foreach($mm_id_edit as $user_details)
			 {
				$ch_to_template_id = $this->dbadminheader->events_to_mm($item->uid,$user_details->mm_id);
				if($ch_to_template_id->mail_send_status==0)
				{
					$member_id .=$user_details->mm_id.'-u'.' ';
					
					
				}
			 }
			echo $member_id = rtrim($member_id);
	
	}
	//////////////////////////////////////////////////////for excel file////////////////////////////////////////
	function ExportToCSV($content,$filename = '', $filedArr = '',$event_name,$countmembers,$heading){
		
		
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename ='C:\\wamp\\www\\spcsusa\\excel_files\\'.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		$fp = fopen($filename, 'w');
				
				$string.="<tr><td colspan='6' align='center'>";
				$string.="<font size=5><b>$event_name</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='5' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='6' align='left'>";
				$string.="<font size=4><b>$countmembers</b></font>";
				$string.="</td></tr>";
				
				$string.= "<tr>";
				$field = array();
				foreach($filedArr as $filed)
				{
					
					$string.= "<th width='auto' bordercolor='#d0d7e5'>$filed</th>";
					
					
					
				}
				
				
				$string.= "</tr>";
				
				$string.= "<tr>";
				
				for($i=0;$i<count($content);$i++)
				{
				foreach($content[$i] as $line)
				{
					$string.= "<td bordercolor='#d0d7e5'><center>$line</center></td>";
					
				}
				$string.= "</tr>";
				}
				
				
			$string.= "</table>";
			
			chmod($filename, 0755);

		fwrite($fp,$string); 
			//echo($string);die();
		fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-type: application/excel');
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:"); 
		//echo $string;
	/*
	//if($content != '' && (!(empty($content)))  ){
		$fp = fopen($filename, 'w');
		//if($filedArr != ''  &&  is_array($filedArr))
			fputcsv($fp, $filedArr);
		//else
		//	echo  'Please  Provide Filed Name  In Array.'; 
		foreach($content as $line){
			//$val = implode(",",$line);
			fputcsv($fp, $line);
		}
		fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:");
		//header('Content-type: application/excel');
		//header('Content-Disposition: attachment; filename="'.$filename.'"');
		
		//readfile($filename);
		//unlink($filename);
		*/

	/*}else{
		echo  'No Content Found ' ;
	}*/
	
}
	
	function get_template_user2()
	{
		
		$mm_type=$_POST['mm_type'];
		$event_name=$_POST['event_name'];
		$count=$_POST['count'];
		$username=$_POST['username'];
		$id=$_POST['id'];
		$ch_id=$_POST['ch_id'];
		$offset=$_POST['offset'];
		$fetch_user_data=$_POST['fetch_user_data'];
		//$check_uncheck_all_user_status=$_POST['check_uncheck_all_user_status'];
		
		$limit=10;
		$i = 0;
		$base_url=base_url();
		$state = '';
		$member_id = '';
		$temp=0;
		//$this->load->library('pagination');
		$ex_ch_id=explode('_',$ch_id);
		for($i=0;$i<sizeof($ex_ch_id);$i++)
		{
			$get_user_details_from_ch = $this->dbadminheader->get_user_details_from_chapter($ex_ch_id[$i]);
				foreach($get_user_details_from_ch as $get_user_details_from_ch)
				{
					$state .=$get_user_details_from_ch->mm_state_id.',';
				}	
		}
		$state = substr($state, 0,-1);
		$user_details_data= $this->dbadminheader->user_details_state($state);
		foreach($user_details_data as $user_details_data)
		{
			$member_id .=$user_details_data->mm_id.',';
		}
		$member_id = substr($member_id, 0,-1); 
		
		//if($username=='0' && $mm_type=='0')
		//{
		//$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);
		//}
		if($mm_type == 1)
		{
			$user_details = $this->dbadminheader->get_all_user_search_event1($username,$offset,$limit,$member_id,$id,$mm_type);
		
		
		
			$filename = 'Invited_members_'.date('Y-m-d').'_'.time().'.xls';
			$heading = 'Invited members list';

			$countmembers = $count.' Invited';
			$content = '';
			$num = 0;
			$filedArr =array('Username','Name','Email Id','Mail Status','Status','Sent Date & Time');		
			$content=array();
			foreach($user_details as $user_details){
			
			$content[$num]['Username'] = $user_details->mm_username;
			$content[$num]['Name'] = $user_details->mm_fname.' '.$user_details->mm_lname;
			
			$content[$num]['Email Id'] = $user_details->mm_email;
			$ch_to_template_id = $this->dbadminheader->events_to_mm($id,$user_details->mm_id);
			if($ch_to_template_id->mail_send_status==1)
					 {
					  $content[$num]['Mail Status'] = "yes";  
					 
					 }
					 else
					 {
					  $content[$num]['Mail Status'] = "no";
					 
					 }
			$invite_satus = $this->dbadminheader->events_to_mm_status($id,$user_details->mm_id);
					 if($invite_satus->status_id ==1)
					 {
						$content[$num]['Status'] = "Confirmed"; /*echo "<div>
							<span class='label label-success'>Confirmed</span>
							</div>"*/
					 }
					 else if($invite_satus->status_id ==2)
					 {
						 $content[$num]['Status'] = "Maybe"; /*echo "<div>
							<span class='label label-warning'>Maybe</span>
							</div>"*/;
					 }
					 else if($invite_satus->status_id ==3)
					 {
						$content[$num]['Status'] = "Not Coming"; /*echo "<div>
							<span class='label label-important'>Not Coming</span>
							</div>"*/;
					 }	
					 else
					 {
					 $content[$num]['Status'] = "";
					 }
			$content[$num]['Sent Date & Time'] = date('D, d M Y H:i:s',strtotime($user_details->create_time));		 
					 
			$num++;
			
			
			}
		}
		elseif($mm_type == 2 || $mm_type == 3 || $mm_type == 4 || $mm_type == 5 || $mm_type == 6)
		{
			
			$user_details = $this->dbadminheader->get_all_user_search_event1($username,$offset,$limit,$member_id,$id,$mm_type);
			if($mm_type == 2)
			{
				$filename = 'RSVP_members_'.date('Y-m-d').'_'.time().'.xls';
				$heading = 'RSVP member list';
				$countmembers = $count.' RSVP';
			}
			if($mm_type == 3)
			{
				$filename = 'Confirmed_members_'.date('Y-m-d').'_'.time().'.xls';
				$heading = 'Confirmed member list';
				$countmembers = $count;
			}
			if($mm_type == 4)
			{
				$filename = 'Maybe_members_'.date('Y-m-d').'_'.time().'.xls';
				$heading = 'Maybe member list';
				$countmembers = $count.' Maybe';
			}
			if($mm_type == 5)
			{
				$filename = 'Not_coming_members_'.date('Y-m-d').'_'.time().'.xls';
				$heading = 'Not coming member list';
				$countmembers = $count.' Not coming';
			}
			if($mm_type == 6)
			{
				$filename = 'Pending_members_'.date('Y-m-d').'_'.time().'.xls';
				$heading = 'Pending member list';
				$countmembers = $count.' Pending';
			}
			$content = '';
			$num = 0;
			$filedArr =array('Username','Name','Email Id','Adults','Kids','RSVP Date & Time');		
			$content=array();
			foreach($user_details as $user_details){
			
			$content[$num]['Username'] = $user_details->mm_username;
			$content[$num]['Name'] = $user_details->mm_fname.' '.$user_details->mm_lname;
			$content[$num]['Email Id'] = $user_details->mm_email;
			$content[$num]['Adults'] = $user_details->adult_count;
			$content[$num]['Kids'] = $user_details->kids_count;
			$content[$num]['RSVP Date & Time'] = date('D, d M Y H:i:s',strtotime($user_details->rsvp_time));
			
			$num++;
			
			
			}
			
		}
		$this->ExportToCSV($content,$filename,$filedArr,$event_name,$countmembers,$heading);
		
		//echo __DIR__.'\\excelfile\\'.$filename;
		//echo '\\excel_files\\'.$filename;
		//echo 'C:\\wamp\\www\\spcsusa\\excel_files\\'.$filename;
		echo base_url().'excel_files/'.$filename;
		
		
	}
	function rsvp()
	{
		
		$query->event_id=$_POST['id'];
		$event_name=$_POST['ename'];
		
		$count_invitation = $this->dbevents->count_invitation($query->event_id);?>
        
        
        <div style="width:100px; float:left; clear:both;">
        <table>
		<tr><td ><a  href="javascript:void(0)" onclick="search_rsvp(1)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span></a></td>
<?php
		$count_rsvp = $this->dbevents->count_rsvp($query->event_id);
		?>
          <td><a  href="javascript:void(0)" onclick="search_rsvp(2)" ><span id="" style="margin-top:5px; margin-right:10px;float:left" class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span></a></td>
          <?php
		  
		$count_confirm = $this->dbevents->count_confirm($query->event_id);
		?>
         <?php
		$count_people = $this->dbevents->count_people($query->event_id);
		?>
         <td><a  href="javascript:void(0)" onclick="search_rsvp(3)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span></a></td>
         <?php
		$count_maybe = $this->dbevents->count_maybe($query->event_id);
		?>
        <td> <a  href="javascript:void(0)" onclick="search_rsvp(4)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span></a></td>
          <?php
		$count_notcoming = $this->dbevents->count_notcoming($query->event_id);
		?>
       <td><a  href="javascript:void(0)" onclick="search_rsvp(5)" > <span style="margin-top:5px;margin-right:10px; float:left" class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span></a></td>
       
         <td><a  href="javascript:void(0)" onclick="search_rsvp(6)" ><span style="margin-top:5px;margin-right:10px; float:left" class="label label-inverse"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</span></a></td>
         
          <td style="position:absolute; right:55px;">
         			<li class="dropdown" style=" clear:both;float:right;width:150px;list-style:none">

                        <a href="#" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle dropdown" data-toggle="dropdown">Export to excel </a><a href="javascript:void(0)" id="theexcelfile" target="_blank" style="display:none"></a>

                        <ul class="dropdown-menu" style="width:100px;float:right;" >

                          <li><a href="javascript:void(0)" onclick="export_to_excel(1,'<?php echo $event_name; ?>','<?php echo $count_invitation->total; ?>')">Invited members</a></li>

                          <li><a href="javascript:void(0)" onclick="export_to_excel(2,'<?php echo $event_name; ?>','<?php echo $count_rsvp->total; ?>')">RSVP members</a></li>
                          
                          <li><a href="javascript:void(0)" onclick="export_to_excel(3,'<?php echo $event_name; ?>','<?php echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids; ?>')">Confirmed members</a></li>
                          
                          <li><a href="javascript:void(0)" onclick="export_to_excel(4,'<?php echo $event_name; ?>','<?php echo $count_maybe->total; ?>')">Maybe members</a></li>
                          
                          <li><a href="javascript:void(0)" onclick="export_to_excel(5,'<?php echo $event_name; ?>','<?php echo $count_notcoming->total; ?>')">Not Coming members</a></li>
                          
                          <li><a href="javascript:void(0)" onclick="export_to_excel(6,'<?php echo $event_name; ?>','<?php echo $count_invitation->total-$count_rsvp->total; ?>')">Pending members</a></li>

                        </ul>

                      </li></td>
                      
                      
         </tr>
         </table>
         </div>
         
         <?php
		
		
	}
	//////////////////////////////////////////////end/////////////////////////////////////////////
}

?>