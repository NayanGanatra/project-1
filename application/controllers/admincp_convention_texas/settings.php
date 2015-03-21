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

		

		$this->load->model('admincp_convention_texas/dbsettings');

		//$this->load->model('admincp_convention_texas/dbadminheader');

		

		if($login=='')

		{

			redirect(base_url().'admincp_convention_texas/login');

		}

	

		if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')

		{

			redirect(base_url().'unathorised');

		}

		

		

	}	

	public function index()

	{

		

		$this->form_validation->set_rules('sitename', $this->lang->line('text_site_title').'Sitename', 'required');

		$this->form_validation->set_rules('keywords', $this->lang->line('text_meta_keywords'), 'required');

		$this->form_validation->set_rules('email',$this->lang->line('text_email'), 'trim|required|valid_email');

		$this->form_validation->set_rules('description', $this->lang->line('text_meta_description'), 'required');
		
		$this->form_validation->set_rules('date', $this->lang->line('text_date'), 'required');
		
		$this->form_validation->set_rules('year', 'Year', 'required');
		
		$this->form_validation->set_rules('cs_ch_id', 'Chapter', 'required');
		//$this->form_validation->set_rules('favicon', 'Valid File Type', 'required');
				
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			// Image upload start			

			$config['upload_path'] = 'images/spcs_convention';

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

			
			if (!$this->upload->do_upload('logo1'))

			{
				
				  $logo1=$_POST['old_logo1'];
				
			}
			else

			{

				$logo1=$this->upload->file_name;
			}

			/*if (!$this->upload->do_upload('favicon'))

			{

				$favicon=$_POST['old_favicon'];

			}

			else

			{

				$path = $_FILES['favicon']['name'];
			    $ext = pathinfo($path, PATHINFO_EXTENSION);
				 if($ext=="gif" || $ext=="png" || $ext=="jpg" || $ext=="jpeg")
				 {
					 $this->form_validation->set_rules('favicon', 'Valid File', 'required');
					 echo $error = array('error' => $this->upload->display_errors());
				 }
				 else
				 {
				   $favicon=$this->upload->file_name;
				 }

			}*/
			

			

			// image upload end
			$data = array(
			'cs_sitename'=>$this->input->post('sitename'),
			'cs_keywords'=>$this->input->post('keywords'),
			'cs_description'=>$this->input->post('description'),
			'cs_email'=>$this->input->post('email'),
			'cs_tracking'=>$this->input->post('tracking'),
			//'cs_favicon'=>$favicon,
			'cs_logo'=>$logo,
			'cs_logo2'=>$logo1,
			'cs_date'=>$this->input->post('date'),
			'cs_place'=>$this->input->post('cs_place'),
			'cs_sharethis_id'=>$this->input->post('sharethis_id'),
			'ch_name'=>$this->input->post('cs_ch_id'),
			'ch_year'=>$this->input->post('year')
			);
			$result=$this->dbsettings->edit($data,'1');
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));
			redirect(base_url().'admincp_convention_texas/settings');
		}
        $data['settings'] = $this->dbsettings->getsetting();
		$data['title']=$this->lang->line('text_settings');
		
		$this->load->view('admincp_convention_texas/layout/settings',$data);
	}
	
	
	function slider()

	{

		$num_rec=$this->dbsettings->count_slider();

		//echo $num_rec;

		$this->load->library('pagination');

		

		$config['base_url'] = base_url().'admincp_convention_texas/settings/slider/';

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

		$this->load->view('admincp_convention_texas/slider/view',$data);

	}

	

	public function add_slider()

	{

		

		$this->form_validation->set_rules('title', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('is_active', $this->lang->line('text_status'), 'required');
		
		//$this->form_validation->set_rules('image', 'image', 'required');
		
		$this->form_validation->set_rules('order', 'Order', 'required');

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

				->resize(763,256,$pad=TRUE)

				->save($this->config->item('rootfolderpath')."images/convention/slider/".$this->upload->file_name,$overwrite=TRUE);

				

				if($this->image_moo->errors) print $this->image_moo->display_errors();

				

				unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);			

			}

			// image upload end

			

			$data=array(

				'cs_name'=>$this->input->post('title'),

				'cs_image'=>$filename,

				'cs_link'=>$this->input->post('link'),

				'cs_status'=>$this->input->post('is_active'),
				
				'cs_order'=>$this->input->post('order'),
				
				'cs_created_date'=>$this->input->post('cs_created_date'),
						
				'cs_created_by'=>$this->input->post('cs_created_by')

				);

			$result=$this->dbsettings->insert_slider($data);

			

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

			

			redirect(base_url().'admincp_convention_texas/settings/slider');

		}

	

	

		$data['title']=$this->lang->line('menu_text_slider_add');

		$this->load->view('admincp_convention_texas/slider/add',$data);

	}

	

	public function edit_slider($id)

	{

		$data['get_item'] = $this->dbsettings->get_slide($id);

		$this->form_validation->set_rules('title', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('is_active', $this->lang->line('text_status'), 'required');
		
		
		
		$this->form_validation->set_rules('order', 'Order', 'required');	


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

				->resize(763,256,$pad=TRUE)

				->save($this->config->item('rootfolderpath')."images/convention/slider/".$this->upload->file_name,$overwrite=TRUE);

				

				if($this->image_moo->errors) print $this->image_moo->display_errors();

				

				unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);			

			}

			// image upload end

			

			$data=array(

				'cs_name'=>$this->input->post('title'),

				'cs_image'=>$filename,

				'cs_link'=>$this->input->post('link'),

				'cs_status'=>$this->input->post('is_active'),
				
				'cs_order'=>$this->input->post('order'),
				
				
				'cs_modified_by'=>$this->input->post('cs_modified_by'),
						
				'cs_modified_date'=>$this->input->post('cs_modified_date')

				);

			$result=$this->dbsettings->edit_slider($data,$id);

			

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

			

			redirect(base_url().'admincp_convention_texas/settings/slider');

		}

	

	

		$data['title']=$this->lang->line('text_edit_slider');

		$this->load->view('admincp_convention_texas/slider/edit',$data);

	}

	

	public function delete_slider($id)

	{

		$get_item = $this->dbsettings->get_slide($id);

		

		$DelFile1 = $this->config->item('rootfolderpath').'images/convention/slider/'.$get_item->cs_image;

		 

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

				redirect(base_url('admincp_convention_texas/settings/slider'));

			}

	}

	

	

}

?>