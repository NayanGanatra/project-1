<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

				

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention_texas/dbgallery');
		$this->load->model('admincp_convention_texas/dbsettings');
		//$this->load->model('admincp_convention_texas/dbadminheader');/////update_monita20130919

		

		if($login=='')

		{

			redirect(base_url().'admincp_convention_texas/login');

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

		$num_rec=count($this->dbgallery->count_gallery());

		

		$this->load->library('pagination');

		$config['base_url'] = base_url().'admincp_convention_texas/gallery/view/';

		$config['total_rows'] = $num_rec;

		$config['per_page'] = 24;

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

		$data['query'] = $this->dbgallery->get_all_gallery($config['per_page'],$segment);

		$this->pagination->initialize($config);

		$data['title']= 'Manage Gallery';

		$this->load->view('admincp_convention_texas/gallery/view',$data);
		

	}

	

	public function add()

	{

		
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');

		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		
		//$this->form_validation->set_rules('year', 'Chapter', 'required');////////update_monita20130919///////////
		 $this->form_validation->set_rules('cg_ca_id', 'Album', 'required');////////update_monita20130919///////////
				
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		
		if($this->input->post('media_type') == 1)

		{
			     $config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/thumbs';
				 $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|wma|flv';
				 $this->load->library('upload', $config);
				 $this->load->library("image_moo");
                  
			if($this->upload->do_upload('media_data1') || $this->input->post('media_data'))
			{
				 $this->form_validation->set_rules('media_data', 'required');
				 $filename=$this->upload->file_name;
			}
			else
			{ 
				   if($this->input->post('media_data'))
					{
						$this->form_validation->set_rules('media_data', 'Video Embed URL', 'required');
					}
					else
					{	

					   if($this->image_moo->errors) print $this->image_moo->display_errors();
				    }
				}
          
		}

		/*****************************************update-monita 20130812***************************************/

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{
                      
			if($this->input->post('media_type') == 0)

			{
				// Image upload start
				 $config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/';
				 $config['allowed_types'] = 'gif|jpg|png|jpeg';
				 $this->load->library('upload', $config);
				 
				if($this->input->post('photo1'))
				{  
				$url = $this->input->post('photo1');
                $name = basename($url);
                $filename = $name;
				$thumb= $name ;
				
				 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/'."$name", file_get_contents($url));
				 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/big/'."$name", file_get_contents($url));
				 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/thumbs/'."$name",file_get_contents($url));
				 
				
						 
				    $this->load->library("image_moo");
					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/"."$filename")

					->resize(600,450,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/big/"."$filename",$overwrite=TRUE);
					
					
				    $this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/"."$filename")

					->resize_crop(140,105)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/"."$thumb",$overwrite=TRUE);


				}
				if (!$this->upload->do_upload('photo')&&!$this->input->post('photo1'))

				{
					$filename="";
					$thumb = '';
				/*	echo $config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/';
					$error = array('error' => $this->upload->display_errors());
                    print_r($error);
					exit();*/
				}

				else

				{
					if($this->input->post('photo1'))
					{
						
					}
					else
					{
						
					
					$filename=$this->upload->file_name;

					

					 $thumb = $this->upload->file_name;
					

					$this->load->library("image_moo");

					

					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)

					->resize(600,450,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/big/".$this->upload->file_name,$overwrite=TRUE);

					

					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)

					->resize(140,105)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/".$this->upload->file_name,$overwrite=TRUE);

					

					if($this->image_moo->errors) print $this->image_moo->display_errors();

					

					unlink($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name);	

				     }
				}
                 
				// image upload end
			}

			else

			{
              
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/';

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

					->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)

					->resize(140,105,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/".$this->upload->file_name,$overwrite=TRUE);
					 
                    if($_FILES['media_data1']['name'])
					{
						
					}
					else
					{
					//unlink($this->config->item('rootfolderpath')."images/media".$this->upload->file_name);
					}
				   }
				   if($_FILES['media_data1']['name'])
					{
						
					}
					 
					 else
					 {
                        $filename = $this->input->post('media_data');
					 }

               
			}
				$data=array(

				'cg_title'=>$this->input->post('media_title'),

				'cg_data'=>$filename,

				'cg_thumb'=>$thumb,

				'cg_type'=>$this->input->post('media_type'),

				'cg_date'=>date('Y-m-d'),

				'cg_status'=>1,
				
				'cg_ca_id'=>$this->input->post('cg_ca_id')////////update_monita20130919///////////

				);
     
				$result=$this->dbgallery->add_gallery($data);
                 /***************for checkbox************************/

					/*$inserted_id = $this->db->insert_id();

					

					$chapter = $this->input->post('chapter');

				

					if($chapter)

					{

						for($b=0; $b < count($chapter); $b++)

						{					

							$dataB=array(

							'cg_id'=>$inserted_id,

							'ch_id'=>$chapter[$b]

							);

							$resultB=$this->dbgallery->insert_ch_to_gallery($dataB);

						}

					}

				
*/
                    /***************end of checkbox************************/
			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

			

			redirect(base_url().'admincp_convention_texas/gallery');

		}

	

	

		$data['title']='Add Media';

		$this->load->view('admincp_convention_texas/gallery/add',$data);

	}

	public function edit($id)

	{
		$data['get_gallery'] = $this->dbgallery->get_gallery($id);
		$this->form_validation->set_rules('media_title', 'Media Title', 'required');

		$this->form_validation->set_rules('media_type', 'Media Type', 'required');
		
		//$this->form_validation->set_rules('year', 'Year', 'required');////////update_monita20130919///////////
		
		$this->form_validation->set_rules('cg_ca_id', 'Album', 'required');////////update_monita20130919///////////
				
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');	
		
		if($this->input->post('media_type') == 1)

		{
			     $config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/thumbs/';
				 $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|wma|flv';
				 $this->load->library('upload', $config);
				 $this->load->library("image_moo");
				       if($this->upload->do_upload('media_data1') || $this->input->post('media_data'))
			          {
						   $this->form_validation->set_rules('media_data', 'required');
						   $filename=$this->upload->file_name;
			           }
					  else
					   {
						
						 $filename = $this->input->post('old_media_data');
					
						 
						 if($this->input->post('media_data'))
						  {
							  $this->form_validation->set_rules('media_data', 'Video Embed URL', 'required');
						  }
						  else
						  {
							  $this->form_validation->set_rules('media_data', 'required');		
	  
							 if($this->image_moo->errors) print $this->image_moo->display_errors();
						  }
					  }
          
		}
     
		if ($this->form_validation->run() == FALSE)

		{
			

		}

		else

		{

			if($this->input->post('media_type') == 0)

			{
				

				$config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);
				if($this->input->post('photo1'))
				{
				$url = $this->input->post('photo1');
                $name = basename($url);
                $filename = $name;
				$thumb= $name ;
                 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/'."$name", file_get_contents($url));
				 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/big/'."$name", file_get_contents($url));
				 file_put_contents($this->config->item('rootfolderpath').'images/convention/gallery/thumbs/'."$name", file_get_contents($url));
				
				    $this->load->library("image_moo");
					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/"."$filename")

					->resize(600,450,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/big/"."$filename",$overwrite=TRUE);
					
					
				    $this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/"."$filename")

					->resize_crop(140,105)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/"."$thumb",$overwrite=TRUE);


				}

			

				if (!$this->upload->do_upload('photo') && !$this->input->post('photo1'))

				{
					
					 $filename = $this->input->post('old_media_data');
					$thumb = $this->input->post('old_media_thumb');
					
				}

				else

				{
                  
	                if($this->input->post('photo1'))
					{
						
					}
				    else
					{
                         
						$filename=$this->upload->file_name;
	
						
	
						$thumb = $this->upload->file_name;
	
						
	
						$this->load->library("image_moo");
	
						
	
						$this->image_moo
	
						->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)
	
						->resize(600,450,$pad=TRUE)
	
						->save($this->config->item('rootfolderpath')."images/convention/gallery/big/".$this->upload->file_name,$overwrite=TRUE);
	
						
	
						$this->image_moo
	
						->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)
	
						->resize_crop(140,105)
	
						->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/".$this->upload->file_name,$overwrite=TRUE);
	
						
	
						if($this->image_moo->errors) print $this->image_moo->display_errors();
	
						
	
					unlink($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name);	
					}
				}

				
			}

			else

			{
                
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/gallery/';

				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				

				$this->load->library('upload', $config);

				

				if (!$this->upload->do_upload('thumb'))

				{

					$thumb = $this->input->post('old_media_thumb');

				}

				else

				{
                     	
					$thumb = $this->upload->file_name;

					$this->load->library("image_moo");

					

					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/gallery/".$this->upload->file_name)

					->resize(140,105,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/gallery/thumbs/".$this->upload->file_name,$overwrite=TRUE);
                      if($_FILES['media_data1']['name'])
					{
						
					}
					else
					{
					//unlink($this->config->item('rootfolderpath')."images/media/thumb".$this->upload->file_name);	
					
					}
				   }
				   if($_FILES['media_data1']['name'])
					{
						  
					}
					 
					 else
					 {
						  if(!$this->upload->do_upload('media_data1') && !$this->input->post('media_data'))
				         {
					        //$thumb = $this->input->post('old_media_thumb');
					        $filename = $this->input->post('old_media_data');
				          }
					
					     else
					    {
                          $filename = $this->input->post('media_data');
					    }
						
					 }
                   
				}

$data=array(

			   'cg_title'=>$this->input->post('media_title'),

				'cg_data'=>$filename,

				'cg_thumb'=>$thumb,

				'cg_type'=>$this->input->post('media_type'),

				'cg_date'=>date('Y-m-d'),

				'cg_status'=>1,

				'cg_ca_id'=>$this->input->post('cg_ca_id')////////update_monita20130919///////////

				);

				$result=$this->dbgallery->edit_gallery($data,$id);

				/*edit*/
                   /*******************checkbox************************/
					/*$this->dbgallery->delete_ch_to_gallery($id);

				

					$chapter = $this->input->post('chapter');

					

					if($chapter)

					{

						for($b=0; $b < count($chapter); $b++)

						{					

							$dataB=array(

							'cg_id'=>$id,

							'ch_id'=>$chapter[$b]

							);

							$resultB=$this->dbgallery->insert_ch_to_gallery($dataB);

						}

					}
*/
                       /*******************end of checkbox************************/
					/*edit*/

				

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));



			

			redirect(base_url().'admincp_convention_texas/gallery');

		}

	

	

		$data['title']='Edit Media';

		$this->load->view('admincp_convention_texas/gallery/edit',$data);

	}

	

	public function delete($id)

	{

			

		$result=$this->dbgallery->delete_gallery($id);

		//$this->dbgallery->delete_ch_to_gallery($id);

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		if ($this->agent->is_referral())

		{

			redirect($this->agent->referrer());

		}

		else

		{

			redirect(base_url('admincp_convention_texas/gallery/view'));

		}

		

	}

	

}

?>