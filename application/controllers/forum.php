<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbuser');
		$this->load->model('dbheader');
		$this->load->model('dbblog');
		$this->load->library('email');
		$this->load->library('parser');
		$this->load->helper('text');
	}
	function add_forum()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Forum');
			redirect(base_url('user/login.html'));
		}
		
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
			'title'=>$this->input->post('title'),
			'blog_description'=>$this->input->post('description'),
			'send_mail_to'=>$this->session->userdata('user_id'),
			'verify'=>0,
			'status'=>0,
			'by_mem'=>1,
			'blog_created_date'=>$this->input->post('forum_created_date'),
			'blog_created_by'=>$this->input->post('forum_created_by')
			);
			$result=$this->dbblog->add($data);
			$inserted_id = $this->db->insert_id();
	
			$dataChap=array(
			'blog_id'=>$inserted_id,
			'm_id'=>$this->session->userdata('user_id')
			);
			
			$resultChap=$this->dbheader->insert_member_to_blog($dataChap);
			
			$forumuser = $this->dbheader->user_details_by_id($this->session->userdata('user_id'));
				
			$user_ch = $this->dbblog->get_ch_from_state($forumuser->mm_state_id);
			
			if($user_ch)
			{
				$get_user_chapter = $this->dbheader->get_chapter($user_ch->ch_id);
			}
			$dataChap=array(
			'blog_id'=>$inserted_id,
			'ch_id'=>$user_ch->ch_id
			);
			$resultChap=$this->dbblog->insert_ch_to_blog($dataChap);   
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'your forum will be verified by administrator and will be posted soon.');
			
			redirect(base_url().'forum/manage_forum');
		}
		$data['title'] = 'Add Forum';
		//$data['sub_title'] = 'Add/Edit/Delete News';
		$this->load->view('forum_add',$data);
	}
	function manage_forum()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		
		$forumuser = $this->dbheader->user_details_by_id($this->session->userdata('user_id'));
		$user_ch = $this->dbblog->get_ch_from_state($forumuser->mm_state_id);
		
		$data['query'] = $this->dbblog->get_all_blogs($user_ch->ch_id);
		$data['title'] = 'Manage Forum';
		$this->load->view('forum_view',$data);
	}
	function edit_forum($id)
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'forum/manage_forum');}
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Forum Description', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'title'=>$this->input->post('title'),
				'blog_description'=>$this->input->post('description'),
				'status'=>$this->input->post('status'),
				'blog_created_date'=>$this->input->post('forum_created_date'),
				'blog_created_by'=>$this->input->post('forum_created_by'),
				'blog_modified_date'=>$this->input->post('forum_modified_date'),
				'blog_modified_by'=>$this->input->post('forum_modified_by')
				);
				$result=$this->dbblog->edit($data,$id);
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Forum successfully updated.');
				
				redirect(base_url().'forum/manage_forum');
		}
		$data['title'] = 'Edit Forum';		
		$this->load->view('forum_edit',$data);
	}
	function delete_forum($id)
	{
		$this->dbblog->delete($id);
		$this->dbheader->delete_member_to_blogs($id);
		$this->dbheader->delete_blog_comment($id);
		$this->dbheader->delete_blog_reply($id);
		
		$this->db->delete('chapter_to_blogs', array('blog_id' => $id));
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Forum successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('forum/manage_forum'));
		}
	}
	function mem_forum()
	{
		/*$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Forum');
			
			redirect(base_url('user/login.html'));
		}*/
			$data['blog'] = $this->dbblog->member_blog_details();
			$data['title'] = 'Forums';
			$this->load->view('forum',$data);
		
	}
	function read_forum($id)
	{
		$this->form_validation->set_rules('hdncorr', 'corr', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$login = $this->session->userdata('user_email');

			if(!$login)
			{
				$this->session->set_flashdata('message_type', 'info');
				$this->session->set_flashdata('status_', 'Please login to access Forum');
				
				redirect(base_url('user/login.html'));
			}
			$forumuser = $this->dbheader->user_details_by_id($this->session->userdata('user_id'));
			$user_ch = $this->dbblog->get_ch_from_state($forumuser->mm_state_id);
			$blog_chs = $this->dbblog->get_all_chapters($id);
			$charr = array();
			foreach($blog_chs as $blog_ch)
			{
				array_push($charr,$blog_ch->ch_id);
			}
			if(in_array($user_ch->ch_id,$charr) || in_array(0,$charr))
			{
				if($this->input->post('hdncorr')==1)
				{
					date_default_timezone_set("Asia/Kolkata");
					$commentData=array(
					'blog_id'=>$this->input->post('hdnbid'),
					'mm_id'=>$this->session->userdata['user_id'],
					'text'=>$this->input->post('commentbox'),
					'comment_date'=>date("Y-m-d H:i:s"),
					'verify'=>0
					);
					$this->db->insert('blog_comment',$commentData);	
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', 'your comment will be verified by administrator and will be posted soon.');
				}
				if($this->input->post('hdncorr')==0)
				{
					date_default_timezone_set("Asia/Kolkata");
					$replyData=array(
					'blog_id'=>$this->input->post('hdnbid'),
					'comment_id'=>$this->input->post('hdncid'),
					'mm_id'=>$this->session->userdata['user_id'],
					'text'=>$this->input->post('replybox'),
					'reply_date'=>date("Y-m-d H:i:s"),
					'verify'=>0
					);
					$this->db->insert('blog_reply',$replyData);	
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_flashdata('status_', 'your reply will be verified by administrator and will be posted soon.');
				}
			}
			else
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'You can not submit comment or reply in this forum.');
			}
			
			redirect(base_url().'forum/read_forum/'.$id);
		}
			$data['blog'] = $this->dbblog->member_blog_details_row($id);
			$data['title'] = 'Forum';
			$this->load->view('read_forum',$data);
		
	}
	function loadmore_comments()
	{
		$id = $_POST['id'];
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$query = $this->dbblog->get_all_comments($id,$limit,$offset);
		$login = $this->session->userdata('user_email');
		if($query)
		{
			
			foreach($query as $row)
			{?>
				<?php $commentUser = $this->dbheader->user_details_by_id($row->mm_id); ?>
				<div style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:5px auto; padding:5px;">
					<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($commentUser->mm_photo!=''){ echo $commentUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:10px; float:left; font-size:13px;"><b><?php echo $commentUser->mm_username; ?></b></span>&nbsp;&nbsp;&nbsp;<span style="font-size:13px;">Commented on </span><i><?php echo $row->comment_date; ?></i></div>
					<div style="margin:0px 0 0 50px;">
					<p style="margin:0;"><?php echo $row->text; ?></p>
					<?php if($login){ ?>
					<a onclick="reply_toggle(this);" href="javascript: void(0)" class="reply" id="<?php echo $row->comment_id; ?>">reply</a><br />
					<?php } else {?>
					<a href="<?php echo base_url().'user/login.html' ?>">Login to reply</a><br />
					<?php } ?>
					</div>
				<?php
					$queryReply = $this->dbblog->get_all_reply($row->comment_id,$id);
					if($queryReply)
					{
						foreach($queryReply as $reply)
						{ ?>
							<?php $replyUser = $this->dbheader->user_details_by_id($reply->mm_id); ?>
							<div class="row" style="border-radius:5px; border:1px solid #E7E7E7; margin:5px 0 0 45px; padding:5px;">
								<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($replyUser->mm_photo!=''){ echo $replyUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:6px; font-size:13px;"><b><?php echo $replyUser->mm_username; ?></b></span>&nbsp;&nbsp;&nbsp;<span style="font-size:13px;">Replied on </span><i><?php echo $reply->reply_date; ?></i></div>
					<div style="margin:0px 0 0 50px;">
					<p><?php echo $reply->text; ?></p>
					</div>
					</div>
						<?php }
					}
				?>
				<form class="hideall" id="submitreply<?php echo $row->comment_id; ?>" action="<?php echo base_url().'forum/read_forum/'.$id; ?>" method="POST" style="margin:5px 0 0 45px;">
					<input type="hidden" name="hdncorr" value="0"/>
					<input type="hidden" value="<?php echo $row->comment_id; ?>" name="hdncid"/>
					<input type="hidden" value="<?php echo $id; ?>" name="hdnbid"/>
					<input type="text" value="" placeholder="type your reply here" name="replybox" id="replybox<?php echo $row->comment_id; ?>" style="height:20px; width:400px;" />
					<input type="button" value="Reply" class="btn" onclick="return submit_reply(<?php echo $row->comment_id; ?>);" style="margin-bottom:10px;">
					</form>
				</div>
				<?php
			}	
		}
		
	}
}
?>