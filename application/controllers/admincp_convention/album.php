<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

				

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention/dbalbum');
		$this->load->model('admincp_convention/dbsettings');
		$this->load->model('admincp_convention/dbadminheader');

		

		if($login=='')

		{

			redirect(base_url().'admincp_convention/login');

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

		$num_rec=count($this->dbalbum->count_album());

		

		$this->load->library('pagination');

		$config['base_url'] = base_url().'admincp_convention/album/view/';

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

		$data['query'] = $this->dbalbum->get_all_album($config['per_page'],$segment);

		$this->pagination->initialize($config);

		$data['title']= 'Manage Gallery';

		$this->load->view('admincp_convention/album/view',$data);
		

	}

	

	public function add()

	{

		
		$this->form_validation->set_rules('ca_name', 'Album Name', 'required');
				
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		if ($this->form_validation->run() == FALSE)

		{

			

			

		}
		else
	    {
				$data=array(

				     'ca_name'=>$this->input->post('ca_name'),
				   
				     'ca_created_date'=>$this->input->post('ca_created_date'),

					 'ca_created_by'=>$this->input->post('ca_created_by'),
					 
					 'ca_modified_date'=>$this->input->post('ca_created_date'),

					 'ca_modified_by'=>$this->input->post('ca_created_by')

				);
     
             $result=$this->dbalbum->insert($data);
                    
			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

			redirect(base_url().'admincp_convention/album');
		}

		$data['title']='Add Media';

		$this->load->view('admincp_convention/album/add',$data);

	}

	public function edit($id)

	{
		$data['get_album'] = $this->dbalbum->get_album($id);
		$this->form_validation->set_rules('ca_name', 'Album Name', 'required');			
		$this->form_validation->set_error_delimiters('<span class="help-inline">', '</span>');
		
	
		if ($this->form_validation->run() == FALSE)

		{
			

		}

		else

		{
		      $data=array(
					
			   'ca_name'=>$this->input->post('ca_name'),
	
               'ca_created_date'=>$this->input->post('ca_created_date'),

				'ca_created_by'=>$this->input->post('ca_created_by'),

				'ca_modified_date'=>$this->input->post('ca_modified_date'),

				'ca_modified_by'=>$this->input->post('ca_modified_by')
				);
				$result=$this->dbalbum->edit($data,$id);
			    $this->session->set_flashdata('message_type', 'success');
			    $this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

			   redirect(base_url().'admincp_convention/album');
			  
		}

		$data['title']='Edit Media';

		$this->load->view('admincp_convention/album/edit',$data);

	}

	

	public function delete($id)

	{

			

		$result=$this->dbalbum->delete($id);

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		if ($this->agent->is_referral())

		{

			redirect($this->agent->referrer());

		}

		else

		{

			redirect(base_url('admincp_convention/album/view'));

		}

		

	}

	

}

?>