<?php
error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('chapteradmincp/dbblog');
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
		$num_rec=$this->dbblog->count_blogs();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'chapteradmincp/blog';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 5;
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
		$data['title'] = 'Blog';		
		$this->load->view('chapteradmincp/blog/view',$data);
	}
	function add()
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
				'verify'=>0,
				'status'=>0,
				'blog_created_date'=>$this->input->post('blog_created_date'),
				'blog_created_by'=>$this->input->post('blog_created_by'),
				'send_mail_to'=>$this->session->userdata('chapter_mm_id')
				);
				$result=$this->dbblog->add($data);
				$inserted_id = $this->db->insert_id();
		
				$dataChap=array(
				'blog_id'=>$inserted_id,
				'ch_id'=>$this->session->userdata('get_chapter_id')
				);
				$resultChap=$this->dbadminheader->insert_ch_to_blog($dataChap);
				$memData=$this->dbadminheader->user_details_by_id($this->session->userdata('chapter_mm_id'));
				
				//code to send mail to the admin
				/*$settings = $this->dbadminheader->getsettings();
				$email = $settings->email;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);	
				$this->email->from($memData->mm_email);
				$this->email->to(trim($settings->email));
				$this->email->subject('New blog have been added to in spcs');
				$final_message = 'New blog have been added by '.$this->input->post('blog_created_by').' please verify the blog detail';
				$this->email->send();*/
				//$this->email->message($this->parser->parse('register_parser_for_admin', $final_message , TRUE));
				//mail script end
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Blog successfully inserted.');
				
				redirect(base_url().'chapteradmincp/blog');
		}
		$data['title'] = 'Add Blog';		
		$this->load->view('chapteradmincp/blog/add',$data);
	}
	function edit($id)
	{
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'chapteradmincp/blog');}
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
				
				redirect(base_url().'chapteradmincp/blog');
		}
		$data['title'] = 'Edit Blog';		
		$this->load->view('chapteradmincp/blog/edit',$data);
	}
	public function delete($id)
	{
		$this->dbblog->delete($id);
		$this->dbadminheader->delete_chapter_to_blogs($id);
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
			redirect(base_url('chapteradmincp/blog'));
		}
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
			'send_mail_to'=>$this->session->userdata('chapter_mm_id'),
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
			
			redirect(base_url().'chapteradmincp/blog/mem_view');
		}
		$data['title'] = 'Add Blog';
		//$data['sub_title'] = 'Add/Edit/Delete News';
		$this->load->view('chapteradmincp/blog/mem_add',$data);
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
			redirect(base_url('chapteradmincp/blog/mem_view'));
		}
	}
	function mem_edit($id)
	{
		$data['item'] = $this->dbblog->get_blog_by_id($id);
		if(!$data['item']){redirect(base_url().'chapteradmincp/blog/mem_view');}
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
				
				redirect(base_url().'chapteradmincp/blog/mem_view');
		}
		$data['title'] = 'Edit Blog';		
		$this->load->view('chapteradmincp/blog/mem_edit',$data);
	}
	function mem_view()
	{
		$num_rec=$this->dbblog->count_member_blog();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'chapteradmincp/blog/mem_view';
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
		$this->load->view('chapteradmincp/blog/mem_view',$data);
	}
}
?>