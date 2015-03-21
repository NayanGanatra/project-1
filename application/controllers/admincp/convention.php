<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Convention extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp/dbconvention');

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

		$data['con_detail'] = $this->dbconvention->con_detail($id);

		

		$this->form_validation->set_rules('con_name', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('con_convention', 'Convention', 'required');
		
		$this->form_validation->set_rules('con_year', 'Year', 'required');

		$this->form_validation->set_rules('con_status', $this->lang->line('text_status'), 'required');

		$this->form_validation->set_rules('con_start_date', $this->lang->line('text_from'), 'required');

		$this->form_validation->set_rules('con_end_date', $this->lang->line('text_to'), 'required');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			$data=array(

					'con_name'=>$this->input->post('con_name'),

					'con_link'=>$this->input->post('con_convention'),
				
					'con_year'=>$this->input->post('con_year'),
	
					'con_status'=>$this->input->post('con_status'),
	
					'con_start_date'=>$this->input->post('con_start_date'),
	
					'con_end_date'=>$this->input->post('con_end_date'),

					'con_modified_date'=>$this->input->post('con_modified_date'),

					'con_modified_by'=>$this->input->post('con_modified_by')

					);

					$result=$this->dbconvention->edit($data,$id);

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp/convention');

				

		}

	

	

		$data['title']='Edit Convention';

		$this->load->view('admincp/convention/edit',$data);

	}

	

	public function add()

	{

		$this->form_validation->set_rules('con_name', $this->lang->line('text_name'), 'required');

		$this->form_validation->set_rules('con_convention', 'Convention', 'required');
		
		$this->form_validation->set_rules('con_year', 'Year', 'required');

		$this->form_validation->set_rules('con_status', $this->lang->line('text_status'), 'required');

		$this->form_validation->set_rules('con_start_date', $this->lang->line('text_from'), 'required');

		$this->form_validation->set_rules('con_end_date', $this->lang->line('text_to'), 'required');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{
			//$con_link = base_url().$this->input->post('con_year').$this->input->post('con_convention');
				
			$data=array(

				'con_name'=>$this->input->post('con_name'),
				
				'con_link'=>$this->input->post('con_convention'),
				
				'con_year'=>$this->input->post('con_year'),

				'con_status'=>$this->input->post('con_status'),

				'con_start_date'=>$this->input->post('con_start_date'),

				'con_end_date'=>$this->input->post('con_end_date'),

				'con_created_date'=>$this->input->post('con_created_date'),

				'con_created_by'=>$this->input->post('con_created_by')

				);

				$result=$this->dbconvention->insert($data);

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

				redirect(base_url().'admincp/convention');

		}

		$data['title']='Add Convention';

		$this->load->view('admincp/convention/add',$data);

	}

	

	public function view()

	{

		$num_rec=$this->dbconvention->count_convention();

		

		$this->load->library('pagination');

		

		$config['base_url'] = base_url().'admincp/convention/view/';

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

		

		$data['query'] = $this->dbconvention->get_all_con($config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title']='Manage Convention';

		$this->load->view('admincp/convention/view',$data);

		

	}

	

	public function delete($id)

	{

		$result=$this->dbconvention->delete($id);

		
		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp/convention/view');

	}

	

}

?>