<?php
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('admincp/dbblog');
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
		$num_rec=$this->dbblog->count_blogs();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp/forum';
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
		
		$data['query'] = $this->dbblog->get_all_blogs($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		$data['title'] = 'Forum';		
		$this->load->view('admincp/forum/view',$data);
	}
	function mem_view()
	{
		$num_rec=$this->dbblog->count_member_blog();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp/blog/mem_view';
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
		
		$data['query'] = $this->dbblog->member_blog_details($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title'] = 'Member Blog';		
		$this->load->view('admincp/blog/mem_view',$data);
	}
	function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Forum Description', 'required');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'title'=>$this->input->post('title'),
				'blog_description'=>$this->input->post('description'),
				'send_mail_to'=>-1,
				'verify'=>1,
				'status'=>$this->input->post('status'),
				'blog_created_date'=>$this->input->post('forum_created_date'),
				'blog_created_by'=>$this->input->post('forum_created_by')
				);
				$result=$this->dbblog->add($data);
				$inserted_id = $this->db->insert_id();
				
				$chapter = $this->input->post('chapter');
				
				if($chapter)
				{
					for($b=0; $b < count($chapter); $b++)
					{					
						$dataChap=array(
						'blog_id'=>$inserted_id,
						'ch_id'=>$chapter[$b]
						);
						$resultChap=$this->dbadminheader->insert_ch_to_blog($dataChap);
					}
				}
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Forum successfully inserted.');
				
				redirect(base_url().'admincp/forum');
		}
		$data['title'] = 'Add Forum';		
		$this->load->view('admincp/forum/add',$data);
	}
	function mem_add()
	{
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
			'send_mail_to'=>-1,
			'verify'=>1,
			'status'=>$this->input->post('status'),
			'by_mem'=>1,
			'blog_created_date'=>$this->input->post('blog_created_date'),
			'blog_created_by'=>$this->input->post('blog_created_by')
			);
			$result=$this->dbblog->add($data);
			$inserted_id = $this->db->insert_id();
	
			$dataChap=array(
			'blog_id'=>$inserted_id,
			'm_id'=>-1
			);
			$resultChap=$this->dbadminheader->insert_member_to_blog($dataChap);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Blog successfully inserted.');
			
			redirect(base_url().'admincp/blog/mem_view');
		}
		$data['title'] = 'Add Blog';
		//$data['sub_title'] = 'Add/Edit/Delete News';
		$this->load->view('admincp/blog/mem_add',$data);
	}
	function edit($id)
	{
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'admincp/forum');}
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Blog Description', 'required');
		$this->form_validation->set_rules('chapter', 'Chapter', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($data['item']->verify==1)
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
			}
			else
			{
				if($this->input->post('verify')==1)
				{
					$data=array(
					'title'=>$this->input->post('title'),
					'blog_description'=>$this->input->post('description'),
					'verify'=>$this->input->post('verify'),
					'status'=>1,
					'blog_created_date'=>$this->input->post('forum_created_date'),
					'blog_created_by'=>$this->input->post('forum_created_by'),
					'blog_modified_date'=>$this->input->post('forum_modified_date'),
					'blog_modified_by'=>$this->input->post('forum_modified_by')
					);
				}
				else
				{
					$data=array(
					'title'=>$this->input->post('title'),
					'blog_description'=>$this->input->post('description'),
					'verify'=>$this->input->post('verify'),
					'status'=>$this->input->post('status'),
					'blog_created_date'=>$this->input->post('forum_created_date'),
					'blog_created_by'=>$this->input->post('forum_created_by'),
					'blog_modified_date'=>$this->input->post('forum_modified_date'),
					'blog_modified_by'=>$this->input->post('forum_modified_by')
					);
				}
				
			}
				$result=$this->dbblog->edit($data,$id);
				$this->dbadminheader->delete_chapter_to_blogs($id);
				
				$chapter = $this->input->post('chapter');
				
				if($chapter)
				{
					for($b=0; $b < count($chapter); $b++)
					{					
						$dataChap=array(
						'blog_id'=>$id,
						'ch_id'=>$chapter[$b]
						);
						$resultChap=$this->dbadminheader->insert_ch_to_blog($dataChap);
					}
				}
						
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Forum successfully updated.');
				
				redirect(base_url().'admincp/forum');
		}
		$data['title'] = 'Edit Forum';		
		$this->load->view('admincp/forum/edit',$data);
	}
	function mem_edit($id)
	{
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'admincp/blog/mem_view');}
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
				'verify'=>$this->input->post('verify'),
				'status'=>$this->input->post('status'),
				'blog_created_date'=>$this->input->post('blog_created_date'),
				'blog_created_by'=>$this->input->post('blog_created_by'),
				'blog_modified_date'=>$this->input->post('blog_modified_date'),
				'blog_modified_by'=>$this->input->post('blog_modified_by')
				);
				$result=$this->dbblog->edit($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Blog successfully updated.');
				
				redirect(base_url().'admincp/blog/mem_view');
		}
		$data['title'] = 'Member Blog';		
		$this->load->view('admincp/blog/mem_edit',$data);
	}
	public function delete($id)
	{
		$this->dbblog->delete($id);
		$this->dbadminheader->delete_chapter_to_blogs($id);
		$this->dbadminheader->delete_member_to_blogs($id);
		$this->dbadminheader->delete_blog_comment($id);
		$this->dbadminheader->delete_blog_reply($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Blog successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/blog'));
		}
	}
	function mem_delete($id)
	{
		$this->dbblog->delete($id);
		$this->dbadminheader->delete_member_to_blogs($id);
		$this->dbadminheader->delete_blog_comment($id);
		$this->dbadminheader->delete_blog_reply($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Blog successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/blog/mem_view'));
		}
	}
	function get_template_user()
	{
		
		$id=$_POST['id'];
		
		$user_details = $this->dbadminheader->fetch_pending_comments($id);

		?>
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="paginated table table-hover">

        <thead>

        <tr>

        	<th scope="col" width="5%"><input type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" name="chkall" value="no"/>
            </th>

			<th scope="col" width="25%">Comment</th>

            <th scope="col" width="35%">Commented on</th>
			<th scope="col" width="35%">Chapter Name</th>

        </tr>

    	</thead>

        <?php

		$i = 0;

		foreach($user_details as $user_details)
		{
			?>

            <tr>
            <td>
			<span class="span3" >
			<label class="checkbox">
				<input type="checkbox"  name="user_details[]" value="<?php echo $user_details->comment_id; ?>"  />
			</label>
			</span>
			</td>
                <td>
                    <span class="span3" ><?php echo character_limiter($user_details->text,30); ?></span>
                </td>
                <td>
                     <span class="span3" ><?php echo $user_details->comment_date; ?></span>
                </td>
                <td>
				<span class="span3" >ketan</span>
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
<div  id="save_cancle" style="float:left; margin-left:6px;"  ><a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close">Cancel</a>

                               </div>
           </div>
    <?php   
	}
	
	function edit_comment($blog_id)
	{
		$comment_ids = $this->input->post('commentdetails');
		
		if($comment_ids)
		{
			for($b=0; $b < count($comment_ids); $b++)
			{			
				if($this->input->post('commverify')==1)
				{
					$dataComm=array(
					'comment_id'=>$comment_ids[$b],
					'verify'=>1
					);
					$resultComm=$this->dbadminheader->update_comment_blog($comment_ids[$b],$dataComm);
				}
				else
				{
					$resultComm=$this->dbadminheader->delete_blog_comment_by_cid($comment_ids[$b]);	
				}
				
			}
		}
		$reply_ids = $this->input->post('replydetails');
		
		if($reply_ids)
		{
			for($b=0; $b < count($reply_ids); $b++)
			{			
				if($this->input->post('commverify')==1)
				{
					$dataRep=array(
					'reply_id'=>$reply_ids[$b],
					'verify'=>1
					);
					$resultRep=$this->dbadminheader->update_reply_blog($reply_ids[$b],$dataRep);
				}
				else
				{
					$resultRep=$this->dbadminheader->delete_blog_reply_by_cid($reply_ids[$b]);	
				}
				
			}
		}
		echo $this->session->set_flashdata('message_type', 'success');
		echo $this->session->set_flashdata('status_', 'Comments successfully updated.');
		redirect(base_url().'admincp/forum/edit/'.$blog_id);
	}
	function edit_comment_one()
	{
		$action = $_POST['action'];
		$blog_id = $_POST['blog_id'];
		$com_rep_id = $_POST['com_rep_id'];
		$type = $_POST['type'];
		
	
		if($type=='comment')
		{
			
			if($action=='approve')
			{
				$dataComm=array(
				'comment_id'=>$com_rep_id,
				'verify'=>1
				);
				$resultComm=$this->dbadminheader->update_comment_blog($com_rep_id,$dataComm);
			}
			else
			{
				$resultComm=$this->dbadminheader->delete_blog_comment_by_cid($com_rep_id);	
			}
			
		}
		if($type=='reply')
		{
			if($action=='approve')
			{
				$dataRep=array(
				'reply_id'=>$com_rep_id,
				'verify'=>1
				);
				$resultRep=$this->dbadminheader->update_reply_blog($com_rep_id,$dataRep);
			}
			else
			{
				$resultRep=$this->dbadminheader->delete_blog_reply_by_cid($com_rep_id);	
			}
		}
	}
}
?>