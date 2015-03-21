<?php

error_reporting(0);

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends CI_Controller {



	function __construct()

	{

		parent::__construct();

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		$login = $this->session->userdata('username');

		$this->load->model('admincp/dbverification');

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

		$num_rec=$this->dbverification->count_verification();

		$this->load->library('pagination');

		$config['base_url'] = base_url().'admincp/verification/';

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

		

		$data['query'] = $this->dbverification->get_all_verification($config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title'] = 'Verification Email';		

		$this->load->view('admincp/verification/view',$data);

	}

	

	function add()

	{

		$this->form_validation->set_rules('subject', 'Subject', 'required');

		//$this->form_validation->set_rules('email_template_name', 'Templete', 'required');

		$this->form_validation->set_rules('html', 'Message', 'required');

		$this->form_validation->set_rules('chapter', 'Chapter', 'required');

		$this->form_validation->set_rules('queued', 'Status', 'required');

		$this->form_validation->set_rules('fetch_user_data_after_save','please Select Atleast one user', 'required|trim');

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

				'queued'=>$this->input->post('queued'),

				'verification_created_date'=>$this->input->post('verification_created_date'),

				'verification_created_by'=>$this->input->post('verification_created_by')

				

				);

				$result=$this->dbverification->add($data);

				$inserted_id = $this->db->insert_id();

				$set_chapter=explode('_',$this->session->userdata('chapter_data'));

				if($set_chapter)

				{

					for($b=0; $b < sizeof($set_chapter); $b++)

					{

						

						$dataB=array(

						'email_template_id'=>$inserted_id,

						'ch_id'=>$set_chapter[$b]

						);

					$resultB=$this->dbadminheader->insert_ch_to_verification_template($dataB);

					}

				$this->session->unset_userdata('chapter_data');

				}

				

				$user_details=explode(' ',trim($this->input->post('fetch_user_data_after_save')));

				if($user_details)

				{

					for($b=0; $b < count($user_details); $b++)

					{	

						$user_details[$b]=str_replace("-u","",$user_details[$b]);

						$dataC=array(

						'email_template_id'=>$inserted_id,

						'mm_id'=>$user_details[$b]

						);

						$resultC=$this->dbadminheader->insert_verification_template_to_member($dataC);

					}

				}

				

				//$resultC=$this->dbadminheader->update_user_verification($inserted_id);

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', 'Verification Email successfully inserted.');

				

				redirect(base_url().'admincp/verification');

		}

		$data['title'] = 'Verification Email';		

		$this->load->view('admincp/verification/add',$data);

	}

	function edit($id)

	{

	

		$data['item'] = $this->dbverification->get_email_by_id($id);

		if(!$data['item']){redirect(base_url().'admincp/verification');}

		$this->form_validation->set_rules('subject', 'Subject', 'required');

		$this->form_validation->set_rules('chapter', 'Chapter', 'required');

		//$this->form_validation->set_rules('email_template_name', 'Templete', 'required');

		$this->form_validation->set_rules('fetch_user_data_after_save','please Select Atleast one user', 'required|trim');

		$this->form_validation->set_rules('html', 'Message', 'required');

		$this->form_validation->set_rules('queued', 'Status', 'required');

		

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

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

				'created'=>date('Y-m-d H:i:s'),

				'subject'=>$this->input->post('subject'),

				'template_id'=>$this->input->post('email_template_name'),

				'html'=>$this->input->post('html'),

				'queued'=>$this->input->post('queued'),

				'email_send'=>0,

				'verification_created_date'=>$this->input->post('verification_created_date'),

				'verification_created_by'=>$this->input->post('verification_created_by'),

				'verification_modified_date'=>$this->input->post('verification_modified_date'),

				'verification_modified_by'=>$this->input->post('verification_modified_by')

				);

			}

			else

			{

				$data=array(

				'created'=>date('Y-m-d H:i:s'),

				'subject'=>$this->input->post('subject'),

				'template_id'=>$this->input->post('email_template_name'),

				'html'=>$this->input->post('html'),

				'queued'=>$this->input->post('queued'),

				'verification_created_date'=>$this->input->post('verification_created_date'),

				'verification_created_by'=>$this->input->post('verification_created_by'),

				'verification_modified_date'=>$this->input->post('verification_modified_date'),

				'verification_modified_by'=>$this->input->post('verification_modified_by')

				);	

			}

			

			$result=$this->dbverification->edit($data,$id);

			$this->dbadminheader->delete_ch_to_verification_template($id);

			$this->dbadminheader->delete_verification_template_to_member_user($id);

			$chapter = $this->input->post('chapter');

			if($chapter)

			{

				for($b=0; $b < count($chapter); $b++)

				{					

					$dataB=array(

					'email_template_id'=>$id,

					'ch_id'=>$chapter[$b]

					);

					$resultB=$this->dbadminheader->insert_ch_to_verification_template($dataB);

				}

			}

				$user_details=explode(' ',trim($this->input->post('fetch_user_data_after_save')));

				

				if($user_details)

				{

					for($b=0; $b < count($user_details); $b++)

					{	

						$user_details[$b]=str_replace("-u","",$user_details[$b]);

						$ch_to_template_id = $this->dbadminheader->verification_template_to_mm($id,$user_details[$b]);

						

						if($ch_to_template_id->mail_send_status==0)

						{

						//$this->dbadminheader->delete_verification_template_to_member_user($id,$user_details[$b]);

						$dataC=array(

						'email_template_id'=>$id,

						'mm_id'=>$user_details[$b]

						);

						$resultC=$this->dbadminheader->insert_verification_template_to_member($dataC);

						}

					}

				}

				

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', 'Verification Email successfully updated.');

			

			$this->resend_mail($id);

			



		}

		$data['title'] = 'Edit Verification Email';		

		$this->load->view('admincp/verification/edit',$data);

	}

	function queue_mail($id)

	{

		$data=array('email_template_status'=>1);

		$result=$this->dbverification->edit($data,$id);

		redirect(base_url().'admincp/verification');

	}

	function stop_mail($id)

	{

		$data=array('stop_mail'=>1);

		$result=$this->dbverification->edit($data,$id);

		redirect(base_url().'admincp/verification');

	}

	function start_mail($id)

	{

		$data=array('stop_mail'=>0);

		$result=$this->dbverification->edit($data,$id);

		redirect(base_url().'admincp/verification');

	}

	function resend_mail($id)

	{

		$data=array('email_template_status'=>0,'email_send'=>0,'stop_mail'=>0);

		$result=$this->dbverification->edit($data,$id);

		redirect(base_url().'admincp/verification');

	}

	function resume_mail($id)

	{

		$data=array('stop_mail'=>0,'email_send'=>0);

		$result=$this->dbverification->edit($data,$id);

		redirect(base_url().'admincp/verification');

	}

	public function delete($id)

	{

		$this->dbverification->delete($id);

		

		$this->dbadminheader->delete_ch_to_verification_template($id);

		$this->dbadminheader->delete_verification_template_to_member($id);

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', 'Verification Email successfully deleted.');

		if ($this->agent->is_referral())

		{

			redirect($this->agent->referrer());

		}

		else

		{

			redirect(base_url('admincp/verification'));

		}

	}

	function get_template_chapter($template_id)

	{

		$template_html='';

		$get_chapters_template = $this->dbadminheader->get_chapters_template($template_id);

		foreach($get_chapters_template as $get_chapters_template_row)

		{

			$template_html=$get_chapters_template_row->template_html;	

		}

		echo $template_html;

	}

	function get_template_user()

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

		$user_details = $this->dbadminheader->get_all_user_search_verification($username,$offset, $limit,$member_id,$id,$mm_type);

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

            <th scope="col" width="15%">Status</th>

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

			$ch_to_template_id = $this->dbadminheader->verification_template_to_mm($id,$user_details->mm_id);

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

                                        <input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"  type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  

                                        

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

				 if($ch_to_template_id->profile_status ==1)

				 {

					 echo "Verified";

                 }

				 else if($ch_to_template_id->profile_status ==2)

				 {

					 echo "Changed";

                 }
				 else if($ch_to_template_id->profile_status ==0)
				 {
					 $profile_status = $this->dbadminheader->verification_template_to_mm_test($user_details->mm_id);
					 if($profile_status->mm_varify==1)
					 {
						  echo "Verified";
		             }
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
 <div style="bottom: 10%;    left: 32%;    position: absolute;" >

                               <div  id="save_cancle" style="float:left;" >

                              <a onclick="save_user_data();"  id="save_user_data" href="javascript:void(0)" >Save</a>

                               </div>
<div  id="save_cancle" style="float:left; margin-left:6px;"  ><a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close">Cancel</a>

                               </div>
           </div>
        <?php

		$j=0;

		if($username=='0' && $mm_type=='0')
		{

		$totalRows= $this->dbadminheader->user_details_state($state);

		}

		else

		{

		$totalRows= $this->dbadminheader->count_user_search_verification($username,$member_id,$id,$mm_type);
		}

		

		foreach($totalRows as $totalRows)

		{

			$j++;

        }

		$config['base_url'] = base_url().'admincp/verification/edit';

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

		$this->dbadminheader->delete_ch_to_verification_template($id);

		for($i=0;$i<sizeof($chapter_id);$i++)

		{

			$dataB=array(

			'email_template_id'=>$id,

			'ch_id'=>$chapter_id[$i]

			);

			$resultB=$this->dbadminheader->insert_ch_to_verification_template($dataB);

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

		$cron_check_id = $this->dbadminheader->cron_check_id_verification($uid);

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

	function user_check_uncheck_all()

	{

		//$status,$id,$ch_id,$action,$type,$offeset;

			$status=$_POST['status'];

			$id=$_POST['id'];

			$ch_id=$_POST['ch_id'];

			$action=$_POST['action'];

			$type=$_POST['type'];

			$offeset=$_POST['offeset'];

			if($action=='true')

			{

				echo $this->get_template_user_check_all($id,$ch_id,$type,$offeset);

			}

			else

			{

				if($type=='chkall')

				{

					

				echo $this->get_template_user_check_all($id,$ch_id,$type,$offeset);

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

	function get_template_user_check_all($id,$ch_id,$type,$offeset)

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

		foreach($user_details_data as $user_details_data)

		{

			$member_id .=$user_details_data->mm_id.',';

		}

		$member_id = substr($member_id, 0,-1);

		if($type=='check_uncheck_all_user')

		{

		$user_details = $this->dbadminheader->user_details_pagination_with_check_all($member_id);

		//$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);

		}

		else

		{

		$user_details = $this->dbadminheader->user_details_pagination_with_check_all_page($member_id,$offeset, $limit);

		}

		foreach($user_details as $user_details)

		{

			

				$ch_to_template_id = $this->dbadminheader->verification_template_to_mm($id,$user_details->mm_id);

				if($ch_to_template_id->mail_send_status==0)

				{

					$m_id .=$user_details->mm_id."-u_";

				}

		}

		return $m_id = substr($m_id,0,-1);

	}

	function email_info()

	{

		

		$html=$_POST['emailData'];

		$subject=$_POST['subject'];

		//print_r($emailData);

		$this->load->model('dbheader');

		$this->load->library('parser');

		$settings = $this->dbheader->get_setting();

		$emailData->family = '<table  border="0" cellspacing="0" cellpadding="0"> 

					  <tr>

					  	<td>

							<div>

							        <h1><b><u>Family Members</u></b><br></h1>

							</div>

					        

							<table  border="1" cellspacing="0" cellpadding="0"  width="auto">

								<thead>

									<tr>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Name</th>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Username</th>

										<th scope="col" style="text-align:center; width:90px;">Relationship</th>

										<th scope="col" style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Email-id</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px !important;">Date of Birth<br>(MM/YY)</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px !important;">Edit</th>

										

									</tr>

								</thead>

								<tfoot>

									

								</tfoot> 

								<tbody cellspacing="0" cellpadding="0" >

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important; ">Ramila Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Ramila.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Wife</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1965</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rahul Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rahul.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Son</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1990</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								<tr>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rina Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Rina.Patel</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">Daughter</td>

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">test@test.com</td>	

									<td style="text-align:left; padding-left:10px !important;padding-right:10px !important;">1/1995</td>

									<td style="text-align:left; padding-right:10px !important;"><center><a href="#">Edit Profile</a></center></td>

								</tr>

								

								</tbody>

							</table>

						</td>

						</tr>

					</table>';

					/*$userinfo = '<table width="auto" border="0" cellspacing="0" cellpadding="0"> 

					  				<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Username :</b>rajiv.patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Name :</b>Rajiv Patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Email :</b>test@test.com</td></tr>

								  	<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>DOB :</b>1/1985</td></tr>

					</table>';*/
					$userinfo = '<table width="auto" border="1" cellspacing="0" cellpadding="0"> 

					  				<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>First Name :</b></td>
									<td  style=" width:20%;text-align:left; padding-left:10px;padding-right:10px;">Rajiv</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Mothers Maiden Name :</b></td>
									<td style=" width:20%;text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Father Name:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Hometown:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									
									
									</tr>
									
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Original Surname If last name is Patel:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Username :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">rajiv.patel</td>
									
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Last Name:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Password :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Email:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">test@test.com</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Address :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Mobile:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"&nbsp;></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>State :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Phone:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>City :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Dob:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">1/1985</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Occupation :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Education Qualification:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>University/College  :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Photo:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Life Member Number :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									
									
									
					</table>';

					

		$final_message = array('html' =>$html,'fullname' =>'Rajiv Patel','username' =>'rajiv.patel','code' =>'10101010101010101010101010101011','email' =>'test@test.com','familymember' =>$emailData->family,'sitename'=>$settings->sitename,'emailID'=>'id','userinfo' => $userinfo,'subject' => $subject,'segment_data' => 'preview');

						/*$this->email->message($this->parser->parse('parser_for_sendverification', $final_message , TRUE));*/

		//				print_r($final_message) ;

		echo $this->parser->parse('email_layout', $final_message , TRUE);



						

	

	}

}

?>