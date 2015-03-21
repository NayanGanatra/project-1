<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisements extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbadvertisements');
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

		$data['get_ads'] = $this->dbadvertisements->get_ads($id);

		

		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');

		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');

		$this->form_validation->set_rules('ads_start_date', $this->lang->line('text_from'), 'required');

		$this->form_validation->set_rules('ads_end_date', $this->lang->line('text_to'), 'required');

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
 
                ////////////////////////////update-monita 20130809////////////////////////////////////
				if($this->input->post('image1'))
				{
				   $url = $this->input->post('image1');
                   $name = basename($url);
                   $filename = $name;
			       $thumb= $name ;
                   file_put_contents($this->config->item('rootfolderpath').'images/temp/'."$name", file_get_contents($url));
				   file_put_contents($this->config->item('rootfolderpath').'images/ads/'."$name", file_get_contents($url));
				// file_put_contents($this->config->item('rootfolderpath').'images/media/thumbs/'."$name", file_get_contents($url));
				
				    $this->load->library("image_moo");
					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/temp/"."$filename")

					->resize(250,125,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/ads/"."$filename",$overwrite=TRUE);


				}
			

					if($this->upload->do_upload('image') || $this->input->post('image1'))

					{
                      
					    if($this->input->post('image1'))
						{
						}
						else
						{
							$filename=$this->upload->file_name;
	
							
	
							$this->load->library("image_moo");
	
							
	
							$this->image_moo
	
							->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
	
							->resize(250,125,$pad=TRUE)
	
							->save($this->config->item('rootfolderpath')."images/ads/".$this->upload->file_name,$overwrite=TRUE);
	
							
	
							unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);	
	
							
	
							if($this->image_moo->errors) print $this->image_moo->display_errors();

						}

					}

					  ////////////////////////////end of update-monita 20130809////////////////////////////////////	

					else

					{

						

						$url = $this->input->post('image');

						/*if($url=='')

						$url = base_url().'';*/

						

						$filename = substr($url, strrpos($url, '/') + 1);

						if($url!='')

						{

							

							if (file_put_contents($config['upload_path'].$filename, file_get_contents($url)))

							{

								

												

								$this->load->library("image_moo");

								

								$this->image_moo

								->load($this->config->item('rootfolderpath')."images/temp/".$filename)

								->resize(250,125,$pad=TRUE)

								->save($this->config->item('rootfolderpath')."images/ads/".$filename,$overwrite=TRUE);

								

								unlink($this->config->item('rootfolderpath')."images/temp/".$filename);	

								

								if($this->image_moo->errors) print $this->image_moo->display_errors();

							}

						}

						else

						{

							if (!$this->upload->do_upload('image'))

							{

								$filename=$this->input->post('old_image');

							}

						}

						

						

					}

				

				

				// image upload end

				

					$data=array(

					'ads_title'=>$this->input->post('ads_title'),

					'ads_type'=>$this->input->post('ads_type'),

					'ads_link'=>$this->input->post('ads_link'),

					'ads_code'=>$filename,

					'ads_status'=>$this->input->post('ads_status'),

					'ads_start_date'=>$this->input->post('ads_start_date'),

					'ads_end_date'=>$this->input->post('ads_end_date'),

					'ads_created_date'=>$this->input->post('ads_created_date'),

					'ads_created_by'=>$this->input->post('ads_created_by'),

					'ads_modified_date'=>$this->input->post('ads_modified_date'),

					'ads_modified_by'=>$this->input->post('ads_modified_by')

					);

					

					$result=$this->dbadvertisements->edit($data,$id);

					

					$this->dbadminheader->delete_ch_to_ads($id);

				

					$chapter = $this->input->post('chapter');

					

					if($chapter)

					{

						for($b=0; $b < count($chapter); $b++)

						{					

							$dataB=array(

							'ads_id'=>$id,

							'ch_id'=>$chapter[$b]

							);

							$resultB=$this->dbadminheader->insert_ch_to_ads($dataB);

						}

					}

					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp/advertisements');

				

		}

	

	

		$data['title']=$this->lang->line('text_edit_advertisement');

		$this->load->view('admincp/advertisements/edit',$data);

	}

	

	public function add()

	{

		

		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');

		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');

		$this->form_validation->set_rules('ads_start_date', $this->lang->line('text_from'), 'required');

		$this->form_validation->set_rules('ads_end_date', $this->lang->line('text_to'), 'required');

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
                   
			        ////////////////////////////update-monita 20130809////////////////////////////////////
				if($this->input->post('image1'))
				{
				$url = $this->input->post('image1');
                $name = basename($url);
                $filename = $name;
				$thumb= $name ;
                 file_put_contents($this->config->item('rootfolderpath').'images/temp/'."$name", file_get_contents($url));
				 file_put_contents($this->config->item('rootfolderpath').'images/ads/'."$name", file_get_contents($url));
				// file_put_contents($this->config->item('rootfolderpath').'images/media/thumbs/'."$name", file_get_contents($url));
				
				    $this->load->library("image_moo");
					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/temp/"."$filename")

					->resize(250,125,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/ads/"."$filename",$overwrite=TRUE);


				}
				
          
		
				

				     if($this->upload->do_upload('image') || $this->input->post('image1'))
					{
                        if($this->input->post('image1'))
						{
						}
						else
						{
							$filename=$this->upload->file_name;
	
							
	
							$this->load->library("image_moo");
	
							
	
							$this->image_moo
	
							->load($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name)
	
							->resize(250,125,$pad=TRUE)
	
							->save($this->config->item('rootfolderpath')."images/ads/".$this->upload->file_name,$overwrite=TRUE);
	
							
	
							unlink($this->config->item('rootfolderpath')."images/temp/".$this->upload->file_name);	
	
							
	
							if($this->image_moo->errors) print $this->image_moo->display_errors();

						
						}
					}
                      ////////////////////////////end of update-monita 20130809////////////////////////////////////
					else

					{

						$url = $this->input->post('image');
						$filename = substr($url, strrpos($url, '/') + 1);
						if($url!='')

						{

							if (file_put_contents($config['upload_path'].$filename, file_get_contents($url)))

							{

								$this->load->library("image_moo");
								$this->image_moo

								->load($this->config->item('rootfolderpath')."images/temp/".$filename)

								->resize(250,125,$pad=TRUE)

								->save($this->config->item('rootfolderpath')."images/ads/".$filename,$overwrite=TRUE);

								

								unlink($this->config->item('rootfolderpath')."images/temp/".$filename);	

								

								if($this->image_moo->errors) print $this->image_moo->display_errors();

								

							}

						}

						$this->session->set_flashdata('message_type', 'error');

						$this->session->set_flashdata('status_', 'Image not uploaded, please try again');	

						redirect(base_url().'admincp/advertisements/add');

						

					}

					

					// image upload end

					

					$data=array(

						'ads_title'=>$this->input->post('ads_title'),

						'ads_type'=>$this->input->post('ads_type'),

						'ads_code'=>$filename,

						'ads_link'=>$this->input->post('ads_link'),

						'ads_status'=>$this->input->post('ads_status'),

						'ads_start_date'=>$this->input->post('ads_start_date'),

						'ads_end_date'=>$this->input->post('ads_end_date'),

						'ads_created_date'=>$this->input->post('ads_created_date'),

						'ads_created_by'=>$this->input->post('ads_created_by')

						);

						

						$result=$this->dbadvertisements->insert($data);

						

						$inserted_id = $this->db->insert_id();

						

						$chapter = $this->input->post('chapter');

					

						if($chapter)

						{

							for($b=0; $b < count($chapter); $b++)

							{					

								$dataB=array(

								'ads_id'=>$inserted_id,

								'ch_id'=>$chapter[$b]

								);

								$resultB=$this->dbadminheader->insert_ch_to_ads($dataB);

							}

						}

						

						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

						redirect(base_url().'admincp/advertisements');

			

		}

	

	

		$data['title']=$this->lang->line('text_add_advertisement');

		$this->load->view('admincp/advertisements/add',$data);

	}

	
	public function view()
	{
		$num_rec=$this->dbadvertisements->count_ads();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/advertisements/view/';
		$config['total_rows'] = $num_rec;
		$config['per_page'] =20;
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
		
		$config['cur_tag_open'] = '<li class="current"><a>';
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
		
		$data['query'] = $this->dbadvertisements->get_all_ads($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']=$this->lang->line('text_manage_advertisement');
		$this->load->view('admincp/advertisements/view',$data);
		
	}
	
	public function delete($id)
	{
		$result=$this->dbadvertisements->delete($id);
		$this->dbadminheader->delete_ch_to_ads($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));
		
		redirect(base_url().'admincp/advertisements/view');
	}
	
}
?>