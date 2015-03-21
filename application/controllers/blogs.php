<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogs extends CI_Controller {

function __construct()
	{
		parent::__construct();
		
		$this->load->model('dbuser');
		$this->load->model('dbheader');
		$this->load->model('dbblog');
		$this->load->library('email');
		$this->load->library('parser');
	}
	function add_blog()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Member Directory');
			
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
			'blog_created_date'=>$this->input->post('blog_created_date'),
			'blog_created_by'=>$this->input->post('blog_created_by')
			);
			$result=$this->dbblog->add($data);
			$inserted_id = $this->db->insert_id();
	
			$dataChap=array(
			'blog_id'=>$inserted_id,
			'm_id'=>$this->session->userdata('user_id')
			);
			$resultChap=$this->dbheader->insert_member_to_blog($dataChap);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Blog successfully inserted.');
			
			redirect(base_url().'blogs/manage_blog');
		}
		$data['title'] = 'Add Blog';
		//$data['sub_title'] = 'Add/Edit/Delete News';
		$this->load->view('blog_add',$data);
	}
	function manage_blog()
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		$data['query'] = $this->dbblog->get_all_blogs();
		$data['title'] = 'Manage Blog';
		$this->load->view('blog_view',$data);
	}
	function edit_blog($id)
	{
		$login = $this->session->userdata('user_email');
		$data['user'] = $this->dbheader->user_details($login);
		$data['ads'] = $this->dbheader->get_ads_for_general();
		
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'blogs/manage_blog');}
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Blog Description', 'required');
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
				'blog_created_date'=>$this->input->post('blog_created_date'),
				'blog_created_by'=>$this->input->post('blog_created_by'),
				'blog_modified_date'=>$this->input->post('blog_modified_date'),
				'blog_modified_by'=>$this->input->post('blog_modified_by')
				);
				$result=$this->dbblog->edit($data,$id);
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Blog successfully updated.');
				
				redirect(base_url().'blogs/manage_blog');
		}
		$data['title'] = 'Edit Blog';		
		$this->load->view('blog_edit',$data);
	}
	function delete_blog($id)
	{
		$this->dbblog->delete($id);
		$this->dbheader->delete_member_to_blogs($id);
		$this->dbheader->delete_blog_comment($id);
		$this->dbheader->delete_blog_reply($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Blog successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('blogs/manage_blog'));
		}
	}
	function mem_blogs()
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Member Directory');
			
			redirect(base_url('user/login.html'));
		}
			$data['blog'] = $this->dbblog->member_blog_details();
			$data['title'] = 'Member Blog';
			$this->load->view('blogs',$data);
		
	}
	function read_blog($id)
	{
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			$this->session->set_flashdata('message_type', 'info');
			$this->session->set_flashdata('status_', 'Please login to access Member Directory');
			
			redirect(base_url('user/login.html'));
		}
		$this->form_validation->set_rules('hdncorr', 'corr', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
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
			redirect(base_url().'blogs/read_blog/'.$id);
		}
			$data['blog'] = $this->dbblog->member_blog_details_row($id);
			$data['title'] = 'Member Blog';
			$this->load->view('read_blogs',$data);
		
	}
	function loadmore_comments()
	{
		$id = $_POST['id'];
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$query = $this->dbblog->get_all_comments($id,$limit,$offset);
		if($query)
		{
			
			foreach($query as $row)
			{?>
				<?php $commentUser = $this->dbheader->user_details_by_id($row->mm_id); ?>
				<div style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:10px auto; padding:15px;">
					<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($commentUser->mm_photo!=''){ echo $commentUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:6px; float:left;"><?php echo $commentUser->mm_username; ?></span>&nbsp;&nbsp;&nbsp;<b>Commented on </b><i><?php echo $row->comment_date; ?></i></div>
					<div style="margin:25px 0 0 50px;">
					<p><?php echo $row->text; ?></p>
					
					<a onclick="reply_toggle(this);" href="javascript: void(0)" class="reply" id="<?php echo $row->comment_id; ?>">reply</a><br />
					</div>
				<?php
					$queryReply = $this->dbblog->get_all_reply($row->comment_id,$id);
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
						<?php }
					}
				?>
				<form class="hideall" id="submitreply<?php echo $row->comment_id; ?>" action="<?php echo base_url().'blogs/read_blog/'.$id; ?>" method="POST" style="margin:10px 0 0 45px;">
					<input type="hidden" name="hdncorr" value="0"/>
					<input type="hidden" value="<?php echo $row->comment_id; ?>" name="hdncid"/>
					<input type="hidden" value="<?php echo $id; ?>" name="hdnbid"/>
					<textarea value="" placeholder="type your reply here" name="replybox" id="replybox<?php echo $row->comment_id; ?>" style="height:50px; width:400px; margin-bottom:20px;"></textarea><br />
					
					<input type="button" value="Reply" class="btn" style="margin-top:-10px;" onclick="return submit_reply(<?php echo $row->comment_id; ?>);">
					</form>
				</div>
				<?php
			}	
		}
		
	}
}
?>