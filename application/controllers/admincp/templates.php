<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Templates extends CI_Controller
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
		
		$this->load->model('admincp/dbtemplates');
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
		$num_rec=$this->dbtemplates->count_photos();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/templates/view/';
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
		
		$data['query'] = $this->dbtemplates->get_all_photos($config['per_page'],$segment);

		$this->pagination->initialize($config);
		
		$data['title']="templates";
		$this->load->view('admincp/templates/view',$data);
	}
	
	public function add()
	{
		$this->form_validation->set_rules('templates_name', 'Template Name', 'required');
		//$this->form_validation->set_rules('templates_img', 'Image', 'callback_images');
		$this->form_validation->set_rules('temp_numofpics', 'Num of Pics In Temp', 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
		
		// Image upload start
			$config['upload_path'] = $this->config->item('rootfolderpath').'covers-images/org/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('photo_image'))
			{
				$error = array('error' => $this->upload->display_errors());

			}
			else
			{
				$filename = $this->upload->file_name;
				
				
				$this->load->library("image_moo");
		
				$this->image_moo
				->load($this->config->item('rootfolderpath')."covers-images/org/".$filename)
				->stretch(851,315)
				->save($this->config->item('rootfolderpath')."covers-images/download/".$filename,$overwrite=TRUE);
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."covers-images/org/".$filename)
				->stretch(728,269)
				->save($this->config->item('rootfolderpath')."covers-images/preview/".$filename,$overwrite=TRUE);
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."covers-images/org/".$filename)
				->stretch(360,133)
				->save($this->config->item('rootfolderpath')."covers-images/thumbs/".$filename,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
					//unlink("uploads/temp/".$filename);				
				// image upload end
			
				$data=array(
				'templates_name'=>$_POST['templates_name'],
				'temp_numofpics'=>$_POST['temp_numofpics'],
				'templates_img'=>$filename,
				'temp_img_size'=>$_POST['temp_img_size'],
				'temp_show'=>$_POST['temp_show']			
				);
				$result=$this->dbtemplates->insert($data);
				
				$last_id = $this->dbtemplates->getlastinsertedid();
				
				redirect(base_url().'admincp/templates/adddimention/'.$last_id->templates_id);
			}
		}
		$data['title']="Add New Templates";
		$this->load->view('admincp/templates/add',$data);
	}
	
	public function adddimention($id)
	{
		$numofpics = $this->dbtemplates->getnumofpicsintemp($id);

		if(isset($_POST['submit']))
		{
			for($i=1;$i<=$numofpics->temp_numofpics;$i++)
			{
				$data=array(
				'templates_id'=>$id,
				'temp_imgid'=>$i,
				'x1'=>$_POST['imagex1-'.$i],
				'y1'=>$_POST['imagey1-'.$i],
				'x2'=>$_POST['imagex1-'.$i]+170,
				'y2'=>$_POST['imagey1-'.$i]+170,
				);
				$result=$this->dbtemplates->insert_dimen($data);
			}
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', 'Template successfully Inserted.');
			
			redirect(base_url().'admincp/templates/view/');
		}
		
		$data['query']=$numofpics;
		$data['title']="Add New Templates";
		$this->load->view('admincp/templates/adddimention',$data);
	}

	public function delete($id)
	{
		$get_item = $this->dbtemplates->get_photos($id);
		
		unlink($this->config->item('rootfolderpath').'covers-images/download/'.$get_item->templates_img);
		unlink($this->config->item('rootfolderpath').'covers-images/preview/'.$get_item->templates_img);
		unlink($this->config->item('rootfolderpath').'covers-images/thumbs/'.$get_item->templates_img);
						
		$result=$this->dbtemplates->delete($id);
		$result_dimen=$this->dbtemplates->delete_dimen($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Data successfully deleted');
		
		redirect(base_url().'admincp/templates/view');
	}
	
	function active($id)
	{
		$data = array('temp_show' => '1');
		$result=$this->dbtemplates->edit($data,$id);
		
		redirect(base_url().'admincp/templates/view');
	}
	
	function deactive($id)
	{
		$data = array('temp_show' => '0');
		$result=$this->dbtemplates->edit($data,$id);
		
		redirect(base_url().'admincp/templates/view');
	}
	
	function activeall()
	{
		$id = $_POST['templates_id'];
		for($i=0;$i<count($id);$i++)
		{
			$data = array('temp_show' => '1');
			$result=$this->dbtemplates->edit($data,$id[$i]);
		}
		
		redirect(base_url().'admincp/templates/view');
	}
	
	function deactiveall()
	{
		$id = $_POST['templates_id'];
		for($i=0;$i<count($id);$i++)
		{
			$data = array('temp_show' => '0');
			$result=$this->dbtemplates->edit($data,$id[$i]);
		}
		
		redirect(base_url().'admincp/templates/view');
	}
	
	function deleteall()
	{
		$id = $_POST['templates_id'];
		for($i=0;$i<count($id);$i++)
		{
			$abcd=$this->dbtemplates->delete($id[$i]);
			$result_dimen=$this->dbtemplates->delete_dimen($id[$i]);
		}
		
		redirect(base_url().'admincp/templates/view');
	}
	
	public function images()
	{
		$config['upload_path'] = 'covers-images/org/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('templates_img'))
		{
			$this->form_validation->set_message('images', 'The Image field is required.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>