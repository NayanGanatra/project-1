<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assets extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbassets');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
	}
	
	public function index()
	{
		$this->view();
	}
	
	public function edit_cat($id)
	{
		$data['get_page'] = $this->dbassets->get_cat($id);
		
		$this->form_validation->set_rules('assets_cat_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
				'assets_cat_name'=>$this->input->post('assets_cat_name'),
				'is_bg'=>friendlyURL($this->input->post('is_bg')),
				'is_active'=>$this->input->post('is_active')
				);
				$result=$this->dbassets->edit_cat($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/assets/cat');
		}
	
	
		$data['title']=$this->lang->line('text_edit_category');
		$this->load->view('admincp/assets/edit_cat',$data);
	}
	

	public function add_cat()
	{
		
		$this->form_validation->set_rules('assets_cat_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$data=array(
				'assets_cat_name'=>$this->input->post('assets_cat_name'),
				'is_bg'=>friendlyURL($this->input->post('is_bg')),
				'is_active'=>$this->input->post('is_active')
				);
			$result=$this->dbassets->insert_cat($data);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/assets/cat');
		}
	
	
		$data['title']=$this->lang->line('text_add_category');
		$this->load->view('admincp/assets/add_cat',$data);
	}
	
	public function cat()
	{
		$num_rec=$this->dbassets->count_cat();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/assets/cat/';
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
		
		$data['query'] = $this->dbassets->get_all_cat($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_asset_categories');
		$this->load->view('admincp/assets/view_cat',$data);
		
	}
	
	public function delete_cat($id)
	{
		$result=$this->dbassets->delete_cat($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/assets/view'));
			}
	}
	
	
	public function add()
	{
		
		$this->form_validation->set_rules('assets_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'covers-images/assets/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('assets_image'))
			{
				$filename="";
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."covers-images/assets/".$this->upload->file_name)
				->resize(290,145,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."covers-images/assets/thumbs/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				unlink($this->config->item('rootfolderpath')."covers-images/temp/".$this->upload->file_name);			
			}
			// image upload end
			
			$data=array(
				'assets_name'=>$this->input->post('assets_name'),
				'assets_image'=>$filename,
				'assets_cat_id'=>$this->input->post('assets_cat_id')
				);
			$result=$this->dbassets->insert($data);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/assets/view');
		}
	
	
		$data['title']=$this->lang->line('menu_text_assets_add');
		$this->load->view('admincp/assets/add',$data);
	}
	
	public function view()
	{
		$num_rec=$this->dbassets->count_assets();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/assets/view/';
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
		
		$data['query'] = $this->dbassets->get_all_assets($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_asset');
		$this->load->view('admincp/assets/view',$data);
		
	}
	
	public function delete($id)
	{
		$get_item = $this->dbassets->get_asset($id);
		
		$DelFile1 = $this->config->item('rootfolderpath').'covers-images/assets/'.$get_item->assets_image;
		$DelFile2 = $this->config->item('rootfolderpath').'covers-images/assets/thumbs/'.$get_item->assets_image;
		 
		if (file_exists($DelFile1)) { unlink ($DelFile1); }
		if (file_exists($DelFile2)) { unlink ($DelFile2); }
			
		$result=$this->dbassets->delete($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/assets/view'));
			}
	}
	
	function edit($id)
	{
		$data['get_item'] = $this->dbassets->get_asset($id);
		
		$this->form_validation->set_rules('assets_name', $this->lang->line('text_category_name'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'covers-images/assets/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('assets_image'))
			{
				$filename=$this->input->post('old_image');
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."covers-images/assets/".$this->upload->file_name)
				->resize(290,145,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."covers-images/assets/thumbs/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				unlink($this->config->item('rootfolderpath')."covers-images/temp/".$this->upload->file_name);			
			}
			// image upload end
			
			$data=array(
				'assets_name'=>$this->input->post('assets_name'),
				'assets_image'=>$filename,
				'assets_cat_id'=>$this->input->post('assets_cat_id')
				);
			$result=$this->dbassets->edit($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/assets/view');
		}
	
	
		$data['title']=$this->lang->line('text_edit_asset');
		$this->load->view('admincp/assets/edit',$data);
	}
	
}
?>