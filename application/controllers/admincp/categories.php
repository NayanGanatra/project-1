<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbcategories');
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
	
	public function edit($id)
	{
		$data['get_page'] = $this->dbcategories->get_cat($id);
		
		$this->form_validation->set_rules('covers_cat_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_rules('covers_cat_order_by', $this->lang->line('text_order'), 'required');
		$this->form_validation->set_rules('covers_cat_seo', $this->lang->line('text_slug'), 'trim|required|callback_checkseoedit');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'covers_cat_name'=>$this->input->post('covers_cat_name'),
				'covers_cat_seo'=>friendlyURL($this->input->post('covers_cat_seo')),
				'covers_cat_order_by'=>$this->input->post('covers_cat_order_by')
				);
				$result=$this->dbcategories->edit($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/categories');
		}
	
	
		$data['title']=$this->lang->line('text_edit_category');
		$this->load->view('admincp/categories/edit',$data);
	}
	
	function checkseoedit($str)
	{
		$query = $this->dbcategories->check_seo_edit(friendlyURL($str),$_POST['id']);
		if ($query)
		{
			$this->form_validation->set_message('checkseoedit', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('covers_cat_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_rules('covers_cat_order_by', $this->lang->line('text_order'), 'required');
		$this->form_validation->set_rules('covers_cat_seo',$this->lang->line('text_slug'), 'trim|required|callback_checkseo');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'covers_cat_name'=>$this->input->post('covers_cat_name'),
				'covers_cat_seo'=>friendlyURL($this->input->post('covers_cat_seo')),
				'covers_cat_order_by'=>$this->input->post('covers_cat_order_by')
				);
			$result=$this->dbcategories->insert($data);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/categories');
		}
	
	
		$data['title']=$this->lang->line('text_add_category');
		$this->load->view('admincp/categories/add',$data);
	}
	
	function checkseo($str)
	{
		$query = $this->dbcategories->check_seo(friendlyURL($str));
		if ($query)
		{
			$this->form_validation->set_message('checkseo', '%s '.$this->lang->line('misc_already_exists'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function view()
	{
		$num_rec=$this->dbcategories->count_cat();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/categories/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 50;
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
		
		$config['cur_tag_open'] = '<li class="current">';
		$config['cur_tag_close'] = '</li>';
		
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
		
		$data['query'] = $this->dbcategories->get_all_cat($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_categories');
		$this->load->view('admincp/categories/view',$data);
		
	}
	
	public function delete($id)
	{
		$result=$this->dbcategories->delete($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/categories/view'));
			}
	}
	
}
?>