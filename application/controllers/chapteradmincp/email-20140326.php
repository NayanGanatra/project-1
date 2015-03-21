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

		$this->load->model('chapteradmincp/dbemail');

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

	function view()

	{

		$num_rec=$this->dbemail->count_email();

		$this->load->library('pagination');

		$config['base_url'] = base_url().'chapteradmincp/email/';

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

		$this->load->view('chapteradmincp/email/view',$data);

	}

	

	function add()

	{

		$this->form_validation->set_rules('subject', 'Subject', 'required');

		$this->form_validation->set_rules('email_template_name', 'Templete', 'required');

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

				'email_created_date'=>$this->input->post('email_created_date'),

				'email_created_by'=>$this->input->post('email_created_by')

				

				);

				$result=$this->dbemail->add($data);

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

					$resultB=$this->dbadminheader->insert_ch_to_email_template($dataB);

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

						$resultC=$this->dbadminheader->insert_email_template_to_member($dataC);

					}

				}

				//$resultC=$this->dbadminheader->update_user($inserted_id);

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', 'Email successfully inserted.');

				

				redirect(base_url().'chapteradmincp/email');

		}

		$data['title'] = 'Email';		

		$this->load->view('chapteradmincp/email/add',$data);

	}

	function edit($id)

	{

		$data['item'] = $this->dbemail->get_email_by_id($id);

		if(!$data['item']){redirect(base_url().'chapteradmincp/email');}

		$this->form_validation->set_rules('subject', 'Subject', 'required');

		$this->form_validation->set_rules('chapter', 'Chapter', 'required');

		$this->form_validation->set_rules('email_template_name', 'Templete', 'required');

		$this->form_validation->set_rules('html', 'Message', 'required');

		$this->form_validation->set_rules('queued', 'Status', 'required');

		$this->form_validation->set_rules('fetch_user_data_after_save','please Select Atleast one user', 'required|trim');		

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			$start_num=$this->dbadminheader->check_all_user_with_send($id);

			$startNum=$this->dbadminheader->check_all_user_with_send_email($id);

			

			if($start_num->start_num1!=$startNum->startNum2)

			{

				$data=array(

				'created'=>date('Y-m-d H:i:s'),

				'subject'=>$this->input->post('subject'),

				'template_id'=>$this->input->post('email_template_name'),

				'html'=>$this->input->post('html'),

				'queued'=>$this->input->post('queued'),

				'email_send'=>0,

				'email_created_date'=>$this->input->post('email_created_date'),

				'email_created_by'=>$this->input->post('email_created_by'),

				'email_modified_date'=>$this->input->post('email_modified_date'),

				'email_modified_by'=>$this->input->post('email_modified_by')

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

				'email_created_date'=>$this->input->post('email_created_date'),

				'email_created_by'=>$this->input->post('email_created_by'),

				'email_modified_date'=>$this->input->post('email_modified_date'),

				'email_modified_by'=>$this->input->post('email_modified_by')

				);	

			}

			

				$result=$this->dbemail->edit($data,$id);

				$this->dbadminheader->delete_ch_to_email_template($id);

				$this->dbadminheader->delete_email_template_to_member_user($id);

				$chapter = $this->input->post('chapter');

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

				$user_details=explode(' ',trim($this->input->post('fetch_user_data_after_save')));

				if($user_details)

				{

					for($b=0; $b < count($user_details); $b++)

					{

						$user_details[$b]=str_replace("-u","",$user_details[$b]);

						$ch_to_template_id = $this->dbadminheader->email_template_to_mm($id,$user_details[$b]);

						

						if($ch_to_template_id->mail_send_status==0)

						{

						//$this->dbadminheader->delete_email_template_to_member_user($id,$user_details[$b]);

						$dataC=array(

						'email_template_id'=>$id,

						'mm_id'=>$user_details[$b]

						);

						$resultC=$this->dbadminheader->insert_email_template_to_member($dataC);

						}

					}

				}

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', 'Email successfully updated.');

				

				$this->resend_mail($id);



		}

		$data['title'] = 'Edit Email';		

		$this->load->view('chapteradmincp/email/edit',$data);

	}

	function queue_mail($id)

	{

		$data=array('email_template_status'=>1);

		$result=$this->dbemail->edit($data,$id);

		redirect(base_url().'chapteradmincp/email');

	}

	function stop_mail($id)

	{

		$data=array('stop_mail'=>1);

		$result=$this->dbemail->edit($data,$id);

		redirect(base_url().'chapteradmincp/email');

	}

	function resend_mail($id)

	{

		$data=array('email_template_status'=>0,'email_send'=>0,'stop_mail'=>0);

		$result=$this->dbemail->edit($data,$id);

		redirect(base_url().'chapteradmincp/email');

	}

	function start_mail($id)

	{

		$data=array('stop_mail'=>0);

		$result=$this->dbemail->edit($data,$id);

		redirect(base_url().'chapteradmincp/email');

	}

	function resume_mail($id)

	{

		$data=array('stop_mail'=>0,'email_send'=>0);

		$result=$this->dbemail->edit($data,$id);

		redirect(base_url().'chapteradmincp/email');

	}

	public function delete($id)

	{

		//$this->dbemail->delete($id);

		$this->dbadminheader->delete_ch_to_email_template($id);

		$this->dbadminheader->delete_email_template_to_member($id);

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', 'Email successfully deleted.');

		if ($this->agent->is_referral())

		{

			redirect($this->agent->referrer());

		}

		else

		{

			redirect(base_url('chapteradmincp/email'));

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

	///////////pradip_201403211130////////
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
		$user_details = $this->dbadminheader->get_all_user_search_email($username,$offset, $limit,$member_id,$id,$mm_type);
		}
		

		?>       

        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table table-hover" >

        <thead>

        <tr>

        	<th scope="col" width="5%"><input onclick="chkall_d()"  type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" name="chkall" value="no"/>

            <input type="hidden" id="chkall_check" value="no"/></th>

			<th scope="col" width="25%">Username</th>

            <th scope="col" width="35%">Email Id</th>

			<th scope="col" width="20%">Chapter Name</th>

            <th scope="col" width="15%">Mail Status</th>

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

			$ch_to_template_id = $this->dbadminheader->email_template_to_mm($id,$user_details->mm_id);

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

                                        <input onclick="user_check_uncheck(<?php echo $id ?>,'<?php echo $user_details->mm_id.'-u'; ?>',this.checked)"    type="checkbox"  name="user_details[]" value="<?php echo $user_details->mm_id; ?>"  />  

                                        

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

		$totalRows= $this->dbadminheader->count_user_search_email($username,$member_id,$id,$mm_type);

		}

		

		foreach($totalRows as $totalRows)

		{

			$j++;

        }

		$config['base_url'] = base_url().'chapteradmincp/email/edit';

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
///////////end////////

	function edit_user($id,$chapter,$user)

	{

		$chapter_id=explode('_',$chapter);

		$this->dbadminheader->delete_ch_to_email_template($id);

		for($i=0;$i<sizeof($chapter_id);$i++)

		{

			$dataB=array(

			'email_template_id'=>$id,

			'ch_id'=>$chapter_id[$i]

			);

			$resultB=$this->dbadminheader->insert_ch_to_email_template($dataB);

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

		$cron_check_id = $this->dbadminheader->cron_check_id($uid);

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

	///////////pradip_201403211130////////
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

			if($action=='true')

			{

				echo $this->get_template_user_check_all($m_search,$m_type,$id,$ch_id,$type,$offeset);

			}

			else

			{

				if($type=='chkall')

				{

					

				echo $this->get_template_user_check_all($m_search,$m_type,$id,$ch_id,$type,$offeset);

				}

				else

				{

				echo '';	

				}

			}

	}
///////////////////end///////////////

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

///////////pradip_201403211130////////
	function get_template_user_check_all($m_search,$m_type,$id,$ch_id,$type,$offeset)

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

		$user_details = $this->dbadminheader->user_details_pagination_with_check_all($member_id,$m_type,$m_search);

		//$user_details = $this->dbadminheader->user_details_pagination($member_id,$offset, $limit);

		}

		else

		{

		$user_details = $this->dbadminheader->user_details_pagination_with_check_all_page($member_id,$offeset,$limit,$m_type,$m_search);

		}

		foreach($user_details as $user_details)

		{

			$ch_to_template_id = $this->dbadminheader->email_template_to_mm($id,$user_details->mm_id);

			if($ch_to_template_id->mail_send_status==0)

			{

				$m_id .=$user_details->mm_id."-u_";

			}

		}

		return $m_id = substr($m_id,0,-1);

	}
///////////end////////////////

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

					$userinfo = '<table width="auto" border="0" cellspacing="0" cellpadding="0"> 

					  				<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Username :</b>rajiv.patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Name :</b>Rajiv Patel</td></tr>

									<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>Email :</b>test@test.com</td></tr>

								  	<tr><td style="text-align:left; padding-left:10px !important;padding-right:10px !important;"><b>DOB :</b>1/1985</td></tr>

					</table>';

					

		$final_message = array('html' =>$html,'fullname' =>'Rajiv Patel','username' =>'rajiv.patel','code' =>'10101010101010101010101010101011','email' =>'test@test.com','familymember' =>$emailData->family,'sitename'=>$settings->sitename,'emailID'=>'id','userinfo' => $userinfo,'subject' => $subject,'segment_data' => 'preview');

						/*$this->email->message($this->parser->parse('parser_for_sendverification', $final_message , TRUE));*/

		//				print_r($final_message) ;

		echo $this->parser->parse('email_layout', $final_message , TRUE);



						

	

	}

	

}

?>