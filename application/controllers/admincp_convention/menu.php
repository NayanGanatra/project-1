<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Menu extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');
		

		//$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention/dbmenu');
		$this->load->model('admincp_convention/dbsettings');
		$this->load->model('admincp_convention/dbadminheader');

		

		

		//if($login=='')

		//{

		//	redirect(base_url().'admincp/login');

		//}

		/*edit*/

		/*if($this->session->userdata('get_admin_id')=='2' && $this->session->userdata('status')!='1')

		{

			redirect(base_url().'unathorised');

		}*/

		/*edit*/

	}

	

	public function index()

	{

		$this->view();

	}
	
	public function view()

	{
		
		$num_rec=$this->dbmenu->count_menu();
		
		
		$this->load->library('pagination');

		$config['base_url'] = base_url().'admincp_convention/menu/view/';
		
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

		
		$data['query'] = $this->dbmenu->get_all_menu($config['per_page'],$segment);
		
		
		$this->pagination->initialize($config);

		
		$data['title']="Manage Program";

		$this->load->view('admincp_convention/menu/view',$data);

		

	}
	
	
	public function edit($id)

	{
		
		$data['get_menu'] = $this->dbmenu->get_menu($id);
		
		$this->form_validation->set_rules('menu_name', 'Menu title', 'required');
		
		$this->form_validation->set_rules('menu_order', 'Menu Order' , 'required');
		

		/*$data['get_program'] = $this->dbprogram->get_program($id);

		
		$this->form_validation->set_rules('pm_mm_id', 'Member Name', 'required');

		$this->form_validation->set_rules('pm_type', 'Type' , 'required');

		$this->form_validation->set_rules('pm_length', 'Length', 'required');

		//$this->form_validation->set_rules('pm_desc1', 'Description' , 'required');

		//$this->form_validation->set_rules('pm_desc2', 'Description' , 'required');

		$this->form_validation->set_rules('pm_choreo_email', 'Choreographer Email' , 'required|valid_email|xss_clean');
		
		$this->form_validation->set_rules('pm_choreo_phone', 'Choreographer Phone' , 'required');
		
		$this->form_validation->set_rules('pm_choreo_name', 'Choreographer Name' , 'required');
		
		$val = $this->input->post('pm_name');

		if($val)

		{

			foreach($val as $pm_val)

		{

			$this->form_validation->set_rules('pm_name[]', 'participant', 'required|xss_clean');

		}

		}
		
		$val1 = $this->input->post('pm_age');

		if($val1)

		{

			foreach($val as $pm_val1)

		{

			$this->form_validation->set_rules('pm_age[]', 'participant', 'required|xss_clean');

		}

		}

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	*/	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{
			
						if($this->input->post('menu_type') == '0')
						{
						
							$menu_link =$this->input->post('menu_int_link');
							
							if($this->input->post('menu_int_link') == base_url().$this->config->item('convention_folder_with_slash').'convention/pages')
							{
								$menu_link =$this->input->post('int_page');
							}
							elseif($this->input->post('menu_int_link') == base_url().$this->config->item('convention_folder_with_slash').'convention/sponsors')
							{
								$menu_link =$this->input->post('int_sponsors');
							}
						
						}
						else
						{
							$menu_link =$this->input->post('menu_ext_link');
							
						}

			$data=array(

						'menu_name'=>$this->input->post('menu_name'),

						'menu_order'=>$this->input->post('menu_order'),

						'menu_status'=>$this->input->post('menu_status'),
						
						'menu_type'=>$this->input->post('menu_type'),
						
						'menu_link'=>$menu_link,
						
						

						'menu_created_date'=>$this->input->post('menu_created_date'),

						'menu_created_by'=>$this->input->post('menu_created_by'),
						
						'menu_modified_date'=>$this->input->post('menu_modified_date'),

						'menu_modified_by'=>$this->input->post('menu_modified_by')

						);

					

					$result=$this->dbmenu->edit($data,$id);
					
					$this->dbmenu->delete_menu_to_submenu($id);

					$sub_menu_name = $_POST['sub_menu_name'];
						
					$sub_menu_order = $_POST['sub_menu_order'];
					
					$sub_menu_type = $_POST['sub_menu_type'];
					
					
					
					
						for($b=0; $b < count($sub_menu_name); $b++)

							{					
									
									if($sub_menu_type[$b] == '0')
									{
							
										$sub_menu_link = $_POST['sub_menu_int_link'];
										
										if($sub_menu_link[$b] == base_url().$this->config->item('convention_folder_with_slash').'convention/pages')
										{
											
											$sub_menu_link = $_POST['sub_int_pages'];
										}
										elseif($sub_menu_link[$b] == base_url().$this->config->item('convention_folder_with_slash').'convention/sponsors')
										{
											
											$sub_menu_link = $_POST['sub_int_sponsors'];
										}
						
									}
									else
									{
										$sub_menu_link = $_POST['sub_menu_ext_link'];
							
									}
									
								if($sub_menu_name[$b]!='')
								{
								
									
								$dataB=array(

								'menu_id'=>$id,

								'sub_menu_name'=>$sub_menu_name[$b],
								
								'sub_menu_order'=>$sub_menu_order[$b],
								
								'sub_menu_type'=>$sub_menu_type[$b],
								
								'sub_menu_link'=>$sub_menu_link[$b]

								);

								$resultB=$this->dbmenu->insert_menu_to_submenu($dataB);
								}

							}
					
					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp_convention/menu');

				

		}

	

	

		$data['title']="Edit menu";

		$this->load->view('admincp_convention/menu/edit',$data);

	}
	
	
	public function add()
	{
		
		$this->form_validation->set_rules('menu_name', 'Menu title', 'required');
		
		$this->form_validation->set_rules('menu_order', 'Order' , 'required');
		
		
		
		/*$val = $this->input->post('pm_name');

		if($val)

		{

			foreach($val as $pm_val)

		{

			$this->form_validation->set_rules('pm_name[]', 'participant', 'required|xss_clean');

		}

		}
		
		$val1 = $this->input->post('pm_age');

		if($val1)

		{

			foreach($val as $pm_val1)

		{

			$this->form_validation->set_rules('pm_age[]', 'participant', 'required|xss_clean');

		}

		}*/
		
		

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

	
					// image upload end
					//$pm_member = $this->input->post('pm_name');
						
						//$pm_age = $this->input->post('pm_age');
					if($this->input->post('menu_type') == '0')
						{
						
							$menu_link =$this->input->post('menu_int_link');
							
							if($this->input->post('menu_int_link') == base_url().$this->config->item('convention_folder_with_slash').'convention/pages')
							{
								$menu_link =$this->input->post('int_page');
							}
							elseif($this->input->post('menu_int_link') == base_url().$this->config->item('convention_folder_with_slash').'convention/sponsors')
							{
								$menu_link =$this->input->post('int_sponsors');
							}
						}
						else
						{
							$menu_link =$this->input->post('menu_ext_link');
							
						}
					$data=array(

						'menu_name'=>$this->input->post('menu_name'),

						'menu_order'=>$this->input->post('menu_order'),

						'menu_status'=>$this->input->post('menu_status'),
						
						'menu_type'=>$this->input->post('menu_type'),
						
						'menu_link'=>$menu_link,
						
						'menu_created_date'=>$this->input->post('menu_created_date'),

						'menu_created_by'=>$this->input->post('menu_created_by'),
						
						'menu_modified_date'=>$this->input->post('menu_created_date'),

						'menu_modified_by'=>$this->input->post('menu_created_by')
						

						);

						

						$result=$this->dbmenu->insert($data);
						
						$inserted_id = $this->db->insert_id();
						
						$sub_menu_name = $_POST['sub_menu_name'];
						
						$sub_menu_order = $_POST['sub_menu_order'];
						
						$sub_menu_type = $_POST['sub_menu_type'];
						
						
						for($b=0; $b < count($sub_menu_name); $b++)

							{					
								
									if($sub_menu_type[$b] == '0')
									{
							
										$sub_menu_link = $_POST['sub_menu_int_link'];
										
										if($sub_menu_link[$b] == base_url().$this->config->item('convention_folder_with_slash').'convention/pages')
										{
											
											$sub_menu_link = $_POST['sub_int_pages'];
										}
										elseif($sub_menu_link[$b] == base_url().$this->config->item('convention_folder_with_slash').'convention/sponsors')
										{
											
											$sub_menu_link = $_POST['sub_int_sponsors'];
										}
						
									}
									else
									{
										$sub_menu_link = $_POST['sub_menu_ext_link'];
							
									}
									
								if($sub_menu_name[$b]!='')
								{
									
								$dataB=array(

								'menu_id'=>$inserted_id,

								'sub_menu_name'=>$sub_menu_name[$b],
								
								'sub_menu_order'=>$sub_menu_order[$b],
								
								'sub_menu_type'=>$sub_menu_type[$b],
								
								'sub_menu_link'=>$sub_menu_link[$b]
								
								);

								$resultB=$this->dbmenu->insert_menu_to_submenu($dataB);
								}
							}
						
						
						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

						redirect(base_url().'admincp_convention/menu');


	}
		$data['title']="Add Menu";
		$this->load->view('admincp_convention/menu/add',$data);
	}
	
	

	
	public function delete($id)

	{

		$result=$this->dbmenu->delete($id);
		
		$this->dbmenu->delete_menu_to_submenu($id);

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention/menu/view');

	}
	
	
}

?>