<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbcategory');
		$this->load->model('admincp/dbadminheader');
		
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
	
	public function add()
	{
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'category_name'=>$this->input->post('category_name'),
				
				);
			$result=$this->dbcategory->insert($data);
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/category');
		}
	
	
		$data['title']='Add Category';
		$this->load->view('admincp/category/add',$data);
	}
	
	public function view()
	{
	    $num_rec=$this->dbcategory->count_category();
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp/category/view/';
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
		$data['query'] = $this->dbcategory->get_all_category($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title']="Manage Category";		
		$this->load->view('admincp/category/view',$data);
	}
	
	public function edit($id)
	{
		$data['query']= $this->dbcategory->get_category($id);
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'category_name'=>$this->input->post('category_name'),
				);
			$result=$this->dbcategory->edit($data,$id);
			/*edit*/
					//$this->dbadminheader->delete_ch_to_events($id);
					/*edit*/
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/category');
		}
	
	
		$data['title']='Edit Category';
		$this->load->view('admincp/category/edit',$data);
	}
	
	 public function delete($id)
	{
		
		$result=$this->dbcategory->delete($id);
		$result=$this->dbcategory->update_vender_category($id);
		//$result1=$this->dbcategory->delete_ven($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/category/view'));
		}
		
	}
}
?>