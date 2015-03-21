<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class News extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		
		$this->load->model('chapteradmincp/dbnews');
		$this->load->model('chapteradmincp/dbadminheader');
		
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
		$num_rec=$this->dbnews->count_news();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'chapteradmincp/news/view/';
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
		$data['query'] = $this->dbnews->get_all_news($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title']= 'Manage News';
		$this->load->view('chapteradmincp/news/view',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('news_title', 'News Title', 'required');
		$this->form_validation->set_rules('news_content', 'News Content', 'required');
		$this->form_validation->set_rules('news_create', 'Date', 'required');
		$this->form_validation->set_rules('news_ch_id', 'Chapter', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'news_title'=>$this->input->post('news_title'),
				'news_content'=>$this->input->post('news_content'),
				'news_ch_id'=>$this->input->post('news_ch_id'),
				'news_create'=>$this->input->post('news_create'),
				'news_status'=>$this->input->post('news_status'),
				'news_created_date'=>$this->input->post('news_created_date'),
				'news_created_by'=>$this->input->post('news_created_by')
				);
			$result=$this->dbnews->insert($data);
			
			$inserted_id = $this->db->insert_id();
			$chapter_id = $this->session->userdata('get_chapter_id');
					
				$dataB=array(
						'news_id'=>$inserted_id,
						'ch_id'=>$chapter_id
						);
			$resultB=$this->dbadminheader->insert_ch_to_news($dataB);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'chapteradmincp/news');
		}
	
	
		$data['title']='Add News';
		$this->load->view('chapteradmincp/news/add',$data);
	}
	
	public function edit($id)
	{
		$data['query']= $this->dbnews->get_news_by_id($id);
		
		$this->form_validation->set_rules('news_title', 'News Title', 'required');
		$this->form_validation->set_rules('news_content', 'News Content', 'required');
		$this->form_validation->set_rules('news_create', 'Date', 'required');
		$this->form_validation->set_rules('news_ch_id', 'Chapter', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'news_title'=>$this->input->post('news_title'),
				'news_content'=>$this->input->post('news_content'),
				'news_ch_id'=>$this->input->post('news_ch_id'),
				'news_create'=>$this->input->post('news_create'),
				'news_status'=>$this->input->post('news_status'),
				'news_created_date'=>$this->input->post('news_created_date'),
				'news_created_by'=>$this->input->post('news_created_by'),
				'news_modified_date'=>$this->input->post('news_modified_date'),
				'news_modified_by'=>$this->input->post('news_modified_by')
				);
			$result=$this->dbnews->edit($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'chapteradmincp/news');
		}
	
	
		$data['title']='Edit News';
		$this->load->view('chapteradmincp/news/edit',$data);
	}
	
	public function delete($id)
	{
			
		//$result=$this->dbnews->delete($id);
		$this->dbadminheader->delete_ch_to_news($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('chapteradmincp/news/view'));
		}
		
	}
	
}
?>