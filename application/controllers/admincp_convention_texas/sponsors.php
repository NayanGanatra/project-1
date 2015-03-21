<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Sponsors extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention_texas/dbsponsors');
		$this->load->model('admincp_convention_texas/dbsettings');
		$this->load->model('admincp_convention_texas/dbadminheader');

		
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

	

	public function edit($id)

	{
		$error_image=0;

		$data['get_sponsors'] = $this->dbsponsors->get_sponsors($id);

		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');
		if($this->input->post('cs_category')!=0)
		{
		$this->form_validation->set_rules('cs_category', $this->lang->line('text_category'), 'required');
		}
		$this->form_validation->set_rules('cs_donation', 'Donation', 'required');
		

		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');

		$this->form_validation->set_rules('ads_start_date', $this->lang->line('text_from'), 'required');

		$this->form_validation->set_rules('ads_end_date', $this->lang->line('text_to'), 'required');
		
	    //$this->form_validation->set_rules('cs_ch_id', $this->lang->line('text_chapter'), 'required');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		if ($this->form_validation->run() == FALSE)
		{
		}
		else
		{
			//var_dump($_POST);
			//exit;

			// Image upload start
				if($this->input->post('cs_category')!=0)
				{
				

				$config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
 

				if($this->input->post('image1'))
				{
				   $url = $this->input->post('image1');
                   $name = basename($url);
                   $filename = $name;
			       $thumb= $name ;
                   file_put_contents($this->config->item('rootfolderpath').'images/convention/'."$name", file_get_contents($url));
				   file_put_contents($this->config->item('rootfolderpath').'images/convention/sponsors/'."$name", file_get_contents($url));
				// file_put_contents($this->config->item('rootfolderpath').'images/media/thumbs/'."$name", file_get_contents($url));
				
				    $this->load->library("image_moo");
					$this->image_moo

					->load($this->config->item('rootfolderpath')."images/convention/"."$filename")

					->resize(250,125,$pad=TRUE)

					->save($this->config->item('rootfolderpath')."images/convention/sponsors/"."$filename",$overwrite=TRUE);


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
	
							->load($this->config->item('rootfolderpath')."images/convention/".$this->upload->file_name)
	
							->resize(250,125,$pad=TRUE)
	
							->save($this->config->item('rootfolderpath')."images/convention/sponsors/".$this->upload->file_name,$overwrite=TRUE);
	
							
	
							unlink($this->config->item('rootfolderpath')."images/convention/".$this->upload->file_name);	
	
							
	
							if($this->image_moo->errors) print $this->image_moo->display_errors();

						}

					}



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

								->load($this->config->item('rootfolderpath')."images/convention/".$filename)

								->resize(250,125,$pad=TRUE)

								->save($this->config->item('rootfolderpath')."images/convention/sponsors/".$filename,$overwrite=TRUE);

								unlink($this->config->item('rootfolderpath')."images/convention/".$filename);	

								if($this->image_moo->errors) print $this->image_moo->display_errors();

							}

						}

						else

						{

							if (!$this->upload->do_upload('image'))
							{
								if($this->input->post('old_image')=='')
								{
									$this->session->set_flashdata('message_type', 'error');
									$this->session->set_flashdata('status_', 'Image not uploaded, please try again');	
									redirect(base_url().'admincp_convention_texas/sponsors/edit/'.$id);
								}
								else
								{
									$filename=$this->input->post('old_image');
								}
							}

						}
					}
				}
					// image upload end
					if($this->input->post('cs_category')==0)
					{
						$filename='';	
						$a='2';
					}
					else
					{
					$a=$this->input->post('cs_sidebar');	
					}
				
					$data=array(

					'cs_title'=>$this->input->post('ads_title'),

					'cs_type'=>$this->input->post('ads_type'),

					'cs_link'=>$this->input->post('ads_link'),
					
					'cs_category'=>$this->input->post('cs_category'),

					'cs_code'=>$filename,

					'cs_status'=>$this->input->post('ads_status'),

					'cs_start_date'=>$this->input->post('ads_start_date'),

					'cs_end_date'=>$this->input->post('ads_end_date'),

					'cs_created_date'=>$this->input->post('ads_created_date'),

					'cs_created_by'=>$this->input->post('ads_created_by'),

					'cs_modified_date'=>$this->input->post('ads_modified_date'),

					'cs_modified_by'=>$this->input->post('ads_modified_by'),
					'cs_sidebar'=>$a,
					'cs_donation'=>$this->input->post('cs_donation')
					
					//'cs_ch_id'=>$this->input->post('cs_ch_id')

					);

					

					$result=$this->dbsponsors->edit($data,$id);

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp_convention_texas/sponsors');

				

		}

	

	

		$data['title']='Edit Sponsors';

		$this->load->view('admincp_convention_texas/sponsors/edit',$data);

	}

	

	public function add()
	{
		$error_image=0;

		$this->form_validation->set_rules('ads_title', $this->lang->line('text_name'), 'required');
		$this->form_validation->set_rules('ads_type', $this->lang->line('text_size'), 'required');
		$this->form_validation->set_rules('ads_status', $this->lang->line('text_status'), 'required');
		if($this->input->post('cs_category')!=0)
		{
		$this->form_validation->set_rules('cs_category', $this->lang->line('text_category'), 'required');
		}
		$this->form_validation->set_rules('cs_donation', 'Donation', 'required');

		
		$this->form_validation->set_rules('ads_start_date', $this->lang->line('text_from'), 'required');
		$this->form_validation->set_rules('ads_end_date', $this->lang->line('text_to'), 'required');

        //$this->form_validation->set_rules('cs_ch_id', $this->lang->line('text_chapter'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
		}
		else
		{
				if($this->input->post('cs_category')!=0)
				{
				$config['upload_path'] = $this->config->item('rootfolderpath').'images/convention/';
				//\convention/sponsors
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				if($this->input->post('image1'))
				{
				$url = $this->input->post('image1');
                $name = basename($url);
                $filename = $name;
				$thumb= $name;
                file_put_contents($this->config->item('rootfolderpath').'images/convention/'."$name", file_get_contents($url));
				file_put_contents($this->config->item('rootfolderpath').'images/convention/sponsors/'."$name", file_get_contents($url));
				// file_put_contents($this->config->item('rootfolderpath').'images/media/thumbs/'."$name", file_get_contents($url));
				$this->load->library("image_moo");
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/convention/"."$filename")
				->resize(250,125,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/convention/sponsors/"."$filename",$overwrite=TRUE);
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
	
							->load($this->config->item('rootfolderpath')."images/convention/".$this->upload->file_name)
	
							->resize(250,125,$pad=TRUE)
	
							->save($this->config->item('rootfolderpath')."images/convention/sponsors/".$this->upload->file_name,$overwrite=TRUE);

							unlink($this->config->item('rootfolderpath')."images/convention/".$this->upload->file_name);	
	
							if($this->image_moo->errors) print $this->image_moo->display_errors();
						}
					}

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

								->load($this->config->item('rootfolderpath')."images/convention/".$filename)

								->resize(250,125,$pad=TRUE)

								->save($this->config->item('rootfolderpath')."images/convention/sponsors/".$filename,$overwrite=TRUE);

								unlink($this->config->item('rootfolderpath')."images/convention/".$filename);	

								if($this->image_moo->errors) print $this->image_moo->display_errors();

							}

						}
						else

						{

							//$this->session->set_flashdata('message_type', 'error');
							//$this->session->set_flashdata('status_', 'Image not uploaded, please try again');	
							//redirect(base_url().'admincp_convention_texas/sponsors/add');
									
							$error_image=1;
							

						}

						
						
						

					}

				}
					
					// image upload end
					if($this->input->post('cs_category')==0)
					{
						$filename='';	
						$this->input->post('cs_sidebar')=='2';
					}

					if($error_image!=1)
					{
					$data=array(
						'cs_title'=>$this->input->post('ads_title'),
						'cs_type'=>$this->input->post('ads_type'),
						'cs_code'=>$filename,
						'cs_link'=>$this->input->post('ads_link'),
						'cs_category'=>$this->input->post('cs_category'),
						'cs_status'=>$this->input->post('ads_status'),
						'cs_start_date'=>$this->input->post('ads_start_date'),
						'cs_end_date'=>$this->input->post('ads_end_date'),
						'cs_created_date'=>$this->input->post('ads_created_date'),
						//'cs_ch_id'=>$this->input->post('cs_ch_id'),
						'cs_created_by'=>$this->input->post('ads_created_by'),
						'cs_sidebar'=>$this->input->post('cs_sidebar'),
						'cs_donation'=>$this->input->post('cs_donation')
						);
						$result=$this->dbsponsors->insert($data);
						$this->session->set_flashdata('message_type', 'success');
						$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
						redirect(base_url().'admincp_convention_texas/sponsors');
					}
					else
					{
						/*echo "<script language='javascript'>document.getElementById('user_update').style.display='block';</script>";*/
						?>
						
						<style>#user_update{display:block !important;}input[type="text"]{height:auto !important; }</style>
					<?php }
		}
		$data['title']='Add Sponsors';
		$this->load->view('admincp_convention_texas/sponsors/add',$data);
	}
	public function view()
	{
		$num_rec=$this->dbsponsors->count_sponsors();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'admincp_convention_texas/sponsors/view/';
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

		

		$data['query'] = $this->dbsponsors->get_all_sponsors($config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title']='Manage Sponsors';

		$this->load->view('admincp_convention_texas/sponsors/view',$data);

		

	}

	

	public function delete($id)

	{

		$result=$this->dbsponsors->delete($id);

		//$this->dbadminheader->delete_ch_to_ads($id);

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention_texas/sponsors/view');

	}

	

}

?>