<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Media extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
				
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbmedia');
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
	
	public function view()
	{
		$num_rec=count($this->dbmedia->count_media());
		
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp/media/view/';
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
		$data['query'] = $this->dbmedia->get_all_media($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title']= 'Manage Media';
		$this->load->view('admincp/media/view',$data);
	}
	
	public function add()
	{
		
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');
		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		
		if($this->input->post('media_type') == 1)
		{
			$this->form_validation->set_rules('media_data', 'Video Embed URL', 'required');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($this->input->post('media_type') == 0)
			{
				// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('photo'))
				{
					$filename="";
					$thumb = '';
				}
				else
				{
					$filename=$this->upload->file_name;
					
					$thumb = $this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(600,450,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/big/".$this->upload->file_name,$overwrite=TRUE);
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize_crop(140,105)
					->save($this->config->item('rootfolderpath')."images/media/thumbs/".$this->upload->file_name,$overwrite=TRUE);
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);			
				}
				// image upload end
			}
			else
			{
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('thumb'))
				{
					$thumb = '';
				}
				else
				{
					$thumb = $this->upload->file_name;
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(140,105,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/thumb/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);	
				}
				$filename = $this->input->post('media_data');
			}
			
				$data=array(
				'media_title'=>$this->input->post('media_title'),
				'media_data'=>$filename,
				'media_thumb'=>$thumb,
				'media_type'=>$this->input->post('media_type'),
				'media_date'=>date('Y-m-d'),
				'media_status'=>1,
				'media_ch_id'=>$this->input->post('media_ch_id')
				);
				$result=$this->dbmedia->add_media($data);
				
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			
			redirect(base_url().'admincp/media');
		}
	
	
		$data['title']='Add Media';
		$this->load->view('admincp/media/add',$data);
	}
	
	public function edit($id)
	{
		$data['get_media'] = $this->dbmedia->get_media($id);
		
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');
		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			if($this->input->post('media_type') == 0)
			{
				// Image upload start
				
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
			
				if (!$this->upload->do_upload('photo'))
				{
					$filename = $this->input->post('old_media_data');
					$thumb = $this->input->post('old_media_thumb');
				}
				else
				{
	
					$filename=$this->upload->file_name;
					
					$thumb = $this->upload->file_name;
					
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(600,450,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/big/".$this->upload->file_name,$overwrite=TRUE);
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize_crop(140,105)
					->save($this->config->item('rootfolderpath')."images/media/thumbs/".$this->upload->file_name,$overwrite=TRUE);
					
					if($this->image_moo->errors) print $this->image_moo->display_errors();
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);			
				}
				// image upload end
			}
			else
			{
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/media/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('thumb'))
				{
					$thumb = $this->input->post('old_media_thumb');
					$filename = $this->input->post('old_media_data');
				}
				else
				{
					$thumb = $this->upload->file_name;
					$this->load->library("image_moo");
					
					$this->image_moo
					->load($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name)
					->resize(140,105,$pad=TRUE)
					->save($this->config->item('rootfolderpath')."images/media/thumb/".$this->upload->file_name,$overwrite=TRUE);
					
					unlink($this->config->item('rootfolderpath')."images/media/".$this->upload->file_name);
					
					$filename = $this->input->post('media_data');
				}
				
			}
			
				$data=array(
				'media_title'=>$this->input->post('media_title'),
				'media_data'=>$filename,
				'media_thumb'=>$thumb,
				'media_type'=>$this->input->post('media_type'),
				'media_date'=>date('Y-m-d'),
				'media_status'=>1,
				'media_ch_id'=>$this->input->post('media_ch_id')
				);
				$result=$this->dbmedia->edit_media($data,$id);
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

			
			redirect(base_url().'admincp/media');
		}
	
	
		$data['title']='Edit Media';
		$this->load->view('admincp/media/edit',$data);
	}
	
	public function delete($id)
	{
			
		$result=$this->dbmedia->delete_media($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/media/view'));
		}
		
	}
	
}
?>