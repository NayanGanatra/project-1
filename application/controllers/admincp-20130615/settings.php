<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbsettings');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
	}
	
	public function index()
	{
		
		$this->form_validation->set_rules('sitename', $this->lang->line('text_site_title').'Sitename', 'required');
		$this->form_validation->set_rules('keywords', $this->lang->line('text_meta_keywords'), 'required');
		$this->form_validation->set_rules('email',$this->lang->line('text_email'), 'trim|required|valid_email');
		$this->form_validation->set_rules('description', $this->lang->line('text_meta_description'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start			
			$config['upload_path'] = 'images/';
			$config['overwrite'] = TRUE;
			$config['allowed_types'] = 'ico|gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('logo'))
			{
				$logo=$_POST['old_logo'];
			}
			else
			{
				$logo=$this->upload->file_name;
			}
			
			if (!$this->upload->do_upload('favicon'))
			{
				$favicon=$_POST['old_favicon'];
			}
			else
			{
				$favicon=$this->upload->file_name;
				echo $error = array('error' => $this->upload->display_errors());
			}
			
			
			// image upload end
			
			$data = array(
			'sitename'=>$this->input->post('sitename'),
			'keywords'=>$this->input->post('keywords'),
			'description'=>$this->input->post('description'),
			'email'=>$this->input->post('email'),
			'tracking'=>$this->input->post('tracking'),
			'favicon'=>$favicon,
			'logo'=>$logo,
			'sharethis_id'=>$this->input->post('sharethis_id'),
			);
			
			$result=$this->dbsettings->edit($data,'1');

			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/settings');
		}
	
	
		$data['title']=$this->lang->line('text_settings');		
		$this->load->view('admincp/layout/settings',$data);
	}
	
	function slider()
	{
		$num_rec=$this->dbsettings->count_slider();
		echo $num_rec;
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/settings/slider/';
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
		
		$data['query'] = $this->dbsettings->get_all_slider($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_slider');
		$this->load->view('admincp/slider/view',$data);
	}
	
	public function add_slider()
	{
		
		$this->form_validation->set_rules('title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('is_active', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'images/temp/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image'))
			{
				$filename="";
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
				->resize(1000,600,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/slider/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);			
			}
			// image upload end
			
			$data=array(
				'title'=>$this->input->post('title'),
				'image'=>$filename,
				'link'=>$this->input->post('link'),
				'is_active'=>$this->input->post('is_active')
				);
			$result=$this->dbsettings->insert_slider($data);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/settings/slider');
		}
	
	
		$data['title']=$this->lang->line('menu_text_slider_add');
		$this->load->view('admincp/slider/add',$data);
	}
	
	public function edit_slider($id)
	{
		$data['get_item'] = $this->dbsettings->get_slide($id);
			
		$this->form_validation->set_rules('title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('is_active', $this->lang->line('text_status'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'images/temp/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('image'))
			{
				$filename=$this->input->post('old_image');
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
				->resize(1000,600,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/slider/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);			
			}
			// image upload end
			
			$data=array(
				'title'=>$this->input->post('title'),
				'image'=>$filename,
				'link'=>$this->input->post('link'),
				'is_active'=>$this->input->post('is_active')
				);
			$result=$this->dbsettings->edit_slider($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/settings/slider');
		}
	
	
		$data['title']=$this->lang->line('text_edit_slider');
		$this->load->view('admincp/slider/edit',$data);
	}
	
	public function delete_slider($id)
	{
		$get_item = $this->dbsettings->get_slide($id);
		
		$DelFile1 = $this->config->item('rootfolderpath').'images/slider/'.$get_item->image;
		 
		if (file_exists($DelFile1)) { unlink ($DelFile1); }
			
		$result=$this->dbsettings->delete_slider($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/settings/slider'));
			}
	}
	
	function manage_fields()
	{
		$data['query'] = $this->dbsettings->get_fields();
		
		$data['title'] = 'Manage Fields';
		$this->load->view('admincp/settings/manage_fields',$data);
	}
	
	function edit_field($id)
	{
		$data['get_item'] = $this->dbsettings->get_field_by_id($id);
		
		$this->form_validation->set_rules('field_name', 'Field Name', 'required');
		$this->form_validation->set_rules('field_for', 'Field For', 'required');
		$this->form_validation->set_rules('field_type', 'Field Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
		}
		else
		{
			$data=array(
				'title'=>$this->input->post('title'),
				'image'=>$filename,
				'link'=>$this->input->post('link'),
				'is_active'=>$this->input->post('is_active')
				);
			$result=$this->dbsettings->edit_slider($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			redirect(base_url().'admincp/settings/slider');
		}
		
		$data['title'] = 'Edit Field';
		$this->load->view('admincp/settings/edit_field',$data);
	}
	
	//////////////// occupations
	
	function occupations()
	{
		$data['query'] =  $this->db->get('occupations');
		
		$data['title']= 'Occupations';
		$this->load->view('admincp/settings/occupations',$data);
	}
	
	function edit_occupation()
	{
		$id = $this->uri->segment(4);
		$tbl = 'occupations';
		$field = 'occupation_id';
		
		$data['get_one'] = $this->dbadminheader->get_one($tbl,$field,$id);
		
		$this->form_validation->set_rules('occupation_name', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
		}
		else
		{
				$data=array(
				'occupation_name'=>$this->input->post('occupation_name')
				);
				$result=$this->dbadminheader->edit($tbl,$data,$field,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/settings/occupations');
		}
	
		$data['title']= 'Edit Occupation';
		$this->load->view('admincp/settings/edit_occupation',$data);
	}
	
	function add_occupation()
	{
		$tbl = 'occupations';
		
		$this->form_validation->set_rules('occupation_name', 'Title', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$data=array(
					'occupation_name'=>$this->input->post('occupation_name')
				);
				$result=$this->dbadminheader->add($tbl,$data);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
				
				redirect(base_url().'admincp/settings/occupations');
		}
	
	
		$data['title']= 'Add Occupation';
		$this->load->view('admincp/settings/add_occupation',$data);
	}
	
	function delete_occupation($id)
	{
		$tbl = 'occupations';
		$field = 'occupation_id';
		
		$result=$this->dbadminheader->delete($tbl,$field,$id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/settings/occupations'));
			}
	}
}
?>