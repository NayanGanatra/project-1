<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('chapteradmincp/dbvendor');
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
	
	public function add()
	{
		
		$this->form_validation->set_rules('vender_name', 'Vendor Name', 'required');
		$this->form_validation->set_rules('vender_email', 'Vendor Email', 'trim|required|valid_email|is_unique[vendors.vendor_email]|xss_clean');
		$this->form_validation->set_rules('vender_address', 'Vendor Address', 'required');
		$this->form_validation->set_rules('category_id', 'Category_id', 'required');
		$this->form_validation->set_rules('vender_desc', 'Vendor Description', 'required');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'vendor_name'=>$this->input->post('vender_name'),
				'vendor_email'=>$this->input->post('vender_email'),
				'vendor_address'=>$this->input->post('vender_address'),
				'category_id'=>$this->input->post('category_id'),
				'vendor_desc'=>$this->input->post('vender_desc'),
				'vendor_created_date'=>$this->input->post('vendor_created_date'),
				'vendor_created_by'=>$this->input->post('vendor_created_by')
				);
			
			
			$result=$this->dbvendor->insert($data);
			
			$inserted_id = $this->db->insert_id();
			$chapter = $this->session->userdata('get_chapter_id');
			
			$result=$this->dbvendor->insert_ch_to_vender($inserted_id,$chapter);	
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'chapteradmincp/vendor');
		}
	
	
		$data['title']='Add Vendor';
		$this->load->view('chapteradmincp/vendor/add',$data);
	}
	
	public function view()
	{
	    $num_rec=$this->dbvendor->count_venders();
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'chapteradmincp/vendor/view/';
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
		$data['query'] = $this->dbvendor->get_all_venders($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title']="Manage Vendors";		
		$this->load->view('chapteradmincp/vendor/view',$data);
	}
	
    public function edit($id)
	{
		$data['query']= $this->dbvendor->get_venders($id);
		
		$this->form_validation->set_rules('vender_name', 'Vendor Name', 'required');
		$this->form_validation->set_rules('vender_email', 'Vendor Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('vender_address', 'Vendor Address', 'required');
		$this->form_validation->set_rules('category_id', 'Category_id', 'required');
		$this->form_validation->set_rules('vender_desc', 'Vendor Description', 'required');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				 'vendor_name'=>$this->input->post('vender_name'),
				 'vendor_email'=>$this->input->post('vender_email'),
				 'vendor_address'=>$this->input->post('vender_address'),
				'category_id'=>$this->input->post('category_id'),
				'vendor_desc'=>$this->input->post('vender_desc'),
				'vendor_created_date'=>$this->input->post('vendor_created_date'),
				'vendor_created_by'=>$this->input->post('vendor_created_by'),
				'vendor_modified_date'=>$this->input->post('vendor_modified_date'),
				'vendor_modified_by'=>$this->input->post('vendor_modified_by')
				);
			$result=$this->dbvendor->edit($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'chapteradmincp/vendor');
		}
	
	
		$data['title']='Edit Vendor';
		$this->load->view('chapteradmincp/vendor/edit',$data);
	}
	
	 public function delete($id)
	{
			
		$result=$this->dbvendor->delete_ch_to_vender($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('chapteradmincp/vendor/view'));
		}
		
	}
}
?>