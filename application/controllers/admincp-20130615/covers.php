<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Covers extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('fb_connect');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbcovers');
		$this->load->model('admincp/dbadminheader');
		$this->load->model('dbratings', 'ratings');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
	}
	
	public function index()
	{
		$this->view();
	}
	
	public function view()
	{
		$num_rec=$this->dbcovers->count_covers();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp/covers/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 12;
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
		$data['query'] = $this->dbcovers->get_all_covers($config['per_page'],$segment);
		$this->pagination->initialize($config);
		$data['title']= $this->lang->line('text_manage_covers');
		$this->load->view('admincp/covers/view',$data);
	}
	
	function result($keyword='0',$cat='0')
	{
		$num_rec=$this->dbcovers->count_photos_search($keyword,$cat);
	
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/covers/result/'.$keyword.'/'.$cat;
		$config['total_rows'] = $num_rec;
		$config['per_page'] = 12;
		$config['uri_segment'] = 6;
		$config['num_links'] = 4;
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

		if ($this->uri->segment(6) == "")
		{
			$segment  = 0;
		}
		else
		{
			$segment = $this->uri->segment(6);	
		}
		
		$data['query'] = $this->dbcovers->get_all_photos_search($keyword,$cat,$config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']= $this->lang->line('text_covers');
		$this->load->view('admincp/covers/view',$data);
	}
	
	public function add()
	{
		$data['title']= $this->lang->line('text_upload_covers');
		$this->load->view('admincp/covers/add',$data);
	}
	
	function upload_cover($id)
	{
		$settings= $this->dbadminheader->getsettings();
		
		$this->load->library('qquploadedfilexhr');
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
		// max file size in bytes
		$sizeLimit = 2 * 1024 * 1024;
		
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($this->config->item('rootfolderpath').'covers-images/org/');
		// to pass data through iframe you will need to encode all html tags
		
		$jsonData = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
		$vars = json_decode($jsonData); 
		
		$config['image_library'] = 'image_moo';
		
		$this->load->library("image_moo");
		
		if($settings->coll_watermark !=1)
		{
			$this->image_moo
			->load($this->config->item('rootfolderpath').'covers-images/org/'.$vars->covers_image)
			->stretch(851,315)
			->save($this->config->item('rootfolderpath').'covers-images/download/'.$vars->covers_image,$overwrite=TRUE);
			
			$this->image_moo
			->load($this->config->item('rootfolderpath').'covers-images/org/'.$vars->covers_image)
			->stretch(420,155)
			->save($this->config->item('rootfolderpath').'covers-images/thumbs/'.$vars->covers_image,$overwrite=TRUE);
		}
		else
		{
			$this->image_moo
			->load($this->config->item('rootfolderpath').'covers-images/org/'.$vars->covers_image)
			->load_watermark($this->config->item('rootfolderpath').'images/'.$settings->watermark)
			->stretch(851,315)
			->watermark(3,0)
			->save($this->config->item('rootfolderpath').'covers-images/download/'.$vars->covers_image,$overwrite=TRUE);
			
			$this->image_moo
			->load($this->config->item('rootfolderpath').'covers-images/org/'.$vars->covers_image)
			->stretch(420,155)
			->save($this->config->item('rootfolderpath').'covers-images/thumbs/'.$vars->covers_image,$overwrite=TRUE);
			
		}
		
		$covername = friendlyURL($vars->covers_name);
		$newcovername = str_replace("-", " ", $covername);

		$seo_status = $this->dbcovers->check_seo($covername);
		
		if($seo_status)
		{
			$ran_num = rand(10,10000);
			$cov_seo = $covername.$ran_num;
		}
		else
		{
			$cov_seo = $covername;
		}
		
		$data=array(
				'covers_image'=>$vars->covers_image,
				'covers_name'=>ucwords($newcovername),
				'covers_cat_id'=>$id,
				'covers_seo'=>$cov_seo,
				'create'=>date('Y-m-d')
				);
		$result=$this->dbcovers->insert($data);
		$insertedid = $this->db->insert_id(); 
		
		//echo htmlspecialchars(json_encode(base_url()."admincp/covers/view/"), ENT_NOQUOTES);
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
	}
	
	public function edit($id='')
	{
		if($id == "")
		{
			redirect(base_url().'admincp/covers/view');
		}
		$data['get_photos'] = $this->dbcovers->get_photos($id);
		
		$this->form_validation->set_rules('covers_name', $this->lang->line('text_cover_name'), 'required');
		$this->form_validation->set_rules('covers_seo', $this->lang->line('text_slug'),  'trim|required|callback_checkseoedit');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
		
		// Image upload start
			$config['upload_path'] = 'covers-images/org/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('covers_image'))
			{
				$filename=$this->input->post('covers_old_image');
			}
			else
			{
				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
		
				$this->image_moo
				->load("covers-images/org/".$filename)
				->stretch(851,315)
				->save("covers-images/download/".$filename,$overwrite=TRUE);
				
				$this->image_moo
				->load("covers-images/org/".$filename)
				->stretch(420,155)
				->save("covers-images/thumbs/".$filename,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
			
			}
			// image upload end
		
			$data=array(
			'covers_name'=>$this->input->post('covers_name'),
			'covers_cat_id'=>$this->input->post('covers_cat_id'),
			'covers_seo'=>$this->input->post('covers_seo'),
			'covers_image'=>$filename,
			'create'=>date('Y-m-d')		
			);
			$result=$this->dbcovers->edit($data,$id);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			
			if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
		}
		$data['title']=$this->lang->line('text_edit_cover');
		$this->load->view('admincp/covers/edit',$data);
	}
	
	function checkseoedit($str)
	{
		$query = $this->dbcovers->check_seo_edit(friendlyURL($str),$this->uri->segment(4));
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
	
	public function delete($id)
	{
		$get_item = $this->dbcovers->get_photos($id);
		
		$DelFile1 = $this->config->item('rootfolderpath').'covers-images/download/'.$get_item->covers_image;
		$DelFile2 = $this->config->item('rootfolderpath').'covers-images/org/'.$get_item->covers_image;
		$DelFile3 =$this->config->item('rootfolderpath').'covers-images/thumbs/'.$get_item->covers_image;
		$DelFile4 =$this->config->item('rootfolderpath').'covers-images/profile/'.$get_item->covers_image;
		 
		if (file_exists($DelFile1)) { unlink ($DelFile1); }
		if (file_exists($DelFile2)) { unlink ($DelFile2); }
		if (file_exists($DelFile3)) { unlink ($DelFile3); }
		if (file_exists($DelFile4)) { unlink ($DelFile4); }
			
		$result=$this->dbcovers->delete($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp/covers/view'));
		}
		
	}
	
	function approve($id)
	{
		$data = array('covers_status' => '1');
		$result=$this->dbcovers->edit($data,$id);
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
	
	function disapprove($id)
	{
		$data = array('covers_status' => '0');
		$result=$this->dbcovers->edit($data,$id);
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
	
	function approveall()
	{
		$id = $this->input->post('covers_id');
		for($i=0;$i<count($id);$i++)
		{
			$data = array('covers_status' => '1');
			$result=$this->dbcovers->edit($data,$id[$i]);
		}
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
	
	function disapproveall()
	{
		$id = $this->input->post('covers_id');
		for($i=0;$i<count($id);$i++)
		{
			$data = array('covers_status' => '0');
			$result=$this->dbcovers->edit($data,$id[$i]);
		}
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
	
	function deleteall()
	{
		$id = $this->input->post('covers_id');
		for($i=0;$i<count($id);$i++)
		{
			$get_item = $this->dbcovers->get_photos($id[$i]);
			
			$DelFile1 = $this->config->item('rootfolderpath').'covers-images/download/'.$get_item->covers_image;
			$DelFile2 = $this->config->item('rootfolderpath').'covers-images/org/'.$get_item->covers_image;
			$DelFile3 =$this->config->item('rootfolderpath').'covers-images/thumbs/'.$get_item->covers_image;
			$DelFile4 =$this->config->item('rootfolderpath').'covers-images/profile/'.$get_item->covers_image;
			 
			if (file_exists($DelFile1)) { unlink ($DelFile1); }
			if (file_exists($DelFile2)) { unlink ($DelFile2); }
			if (file_exists($DelFile3)) { unlink ($DelFile3); }
			if (file_exists($DelFile4)) { unlink ($DelFile4); }
		
			$abcd=$this->dbcovers->delete($id[$i]);
		}
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
	
	function change_cat($covers_cat_id)
	{
		$id = $this->input->post('covers_id');
		for($i=0;$i<count($id);$i++)
		{
			$data = array('covers_cat_id' => $covers_cat_id);
			$result=$this->dbcovers->edit($data,$id[$i]);
		}
		
		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/covers/view'));
			}
	}
}
?>