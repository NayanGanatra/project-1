<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbchapter');
		$this->load->model('dbheader');
		$this->load->library('form_validation');
	}

	
	function view($method)
	{
		$data['method'] = $method;
		$data['chapter'] = $this->dbchapter->chapter($method);
		$data['ads'] = $this->dbchapter->latesr_ads($data['chapter']->ch_id);
		$data['blog'] = $this->dbchapter->blog_details($data['chapter']->ch_id);
		$data['title'] = 'Blog';
		$data['sub_title'] = $data['chapter']->ch_name.' Blog';
		$this->load->view('blog',$data);
		
	}
	function read_blog($method,$id)
	{
		$data['method'] = $method;
		$data['chapter'] = $this->dbchapter->chapter($method);
		$data['ads'] = $this->dbchapter->latesr_ads($data['chapter']->ch_id);
		$data['blog'] = $this->dbchapter->blog_details_row($data['chapter']->ch_id,$id);
		$this->form_validation->set_rules('hdncorr', 'corr', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			//$this->session->set_flashdata('message_type', 'error');
			//$this->session->set_flashdata('status_', 'You can not submit a blank comment.');
		}
		else
		{
			if($this->input->post('hdncorr')==1)
			{
				date_default_timezone_set("Asia/Kolkata");
				$commentData=array(
				'blog_id'=>$this->input->post('hdnbid'),
				'mm_id'=>$this->session->userdata['user_id'],
				'text'=>$this->input->post('commentbox'),
				'comment_date'=>date("Y-m-d H:i:s")
				);
				$this->db->insert('blog_comment',$commentData);	
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Comment successfully added.');
			}
			if($this->input->post('hdncorr')==0)
			{
				date_default_timezone_set("Asia/Kolkata");
				$replyData=array(
				'blog_id'=>$this->input->post('hdnbid'),
				'comment_id'=>$this->input->post('hdncid'),
				'mm_id'=>$this->session->userdata['user_id'],
				'text'=>$this->input->post('replybox'),
				'reply_date'=>date("Y-m-d H:i:s")
				);
				$this->db->insert('blog_reply',$replyData);	
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Reply successfully added.');
			}
			redirect(base_url().'blog/read_blog/'.$method.'/'.$id);
		}
		$data['title'] = 'Blog';
		$data['sub_title'] = $data['chapter']->ch_name.' Blog';
		$this->load->view('read_blog',$data);
	}
	function loadmore_comments()
	{
		$id = $_POST['id'];
		$limit = $_POST['limit'];
		$method = $_POST['method'];
		$offset = $_POST['offset'];
		$query = $this->dbchapter->get_all_comments($id,$limit,$offset);
		if($query)
		{
			
			foreach($query as $row)
			{?>
				<?php $commentUser = $this->dbheader->user_details_by_id($row->mm_id); ?>
				<div style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:10px auto; padding:15px;">
				<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($commentUser->mm_photo!=''){ echo $commentUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" />
					<span style="margin-left:6px;"><?php echo $commentUser->mm_username; ?></span>&nbsp;&nbsp;&nbsp;<b>Commented on </b><i><?php echo $row->comment_date; ?></i></div>
					<div style="margin-left:50px;">
					<p><?php echo $row->text; ?></p>
					
					<a onclick="reply_toggle(this);" href="javascript: void(0)" class="reply" id="<?php echo $row->comment_id; ?>">reply</a><br />
					</div>
				<?php
					$queryReply = $this->dbchapter->get_all_reply($row->comment_id,$id);
					if($queryReply)
					{
						foreach($queryReply as $reply)
						{ ?>
							<?php $replyUser = $this->dbheader->user_details_by_id($reply->mm_id); ?>
							<div class="row" style="border-radius:5px; border:1px solid #E7E7E7; margin:10px 0 0 45px; padding:15px;">
								<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($replyUser->mm_photo!=''){ echo $replyUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:6px;"><?php echo $replyUser->mm_username; ?></span>&nbsp;&nbsp;&nbsp;<b>Replied on </b><i><?php echo $reply->reply_date; ?></i></div>
					<div style="margin:25px 0 0 50px;">
					<p><?php echo $reply->text; ?></p>
					</div>
					</div>
						<!--	<span style="margin-left:30px;"><?php echo 'reply: By ';?><b><?php echo $replyUser->mm_username; ?></b><i> <?php echo $reply->text; ?></i> <?php echo $reply->reply_date; ?></span><br />-->
						<?php }
					}
				?>
				<form class="hideall" id="submitreply<?php echo $row->comment_id; ?>" action="<?php echo base_url().'blog/read_blog/'.$method.'/'.$id; ?>" method="POST" style="margin:10px 0 0 45px;">
				<input type="hidden" name="hdncorr" value="0"/>
				<input type="hidden" value="<?php echo $row->comment_id; ?>" name="hdncid"/>
				<input type="hidden" value="<?php echo $id; ?>" name="hdnbid"/>
				<input type="hidden" value="<?php echo $method; ?>" name="hdnurl"/>
				<textarea value="" placeholder="type your reply here" name="replybox" id="replybox<?php echo $row->comment_id; ?>" style="height:50px; width:400px; margin-bottom:20px;"></textarea><br />
				<input type="button" value="Reply" class="btn" style="margin-top:-10px;" onclick="return submit_reply(<?php echo $row->comment_id; ?>);"/>
				</form>
				</div>
				<?php
			}	
		}
		
	}
	
}