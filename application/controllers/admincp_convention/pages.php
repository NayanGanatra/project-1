<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Pages extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');

		

		$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention/dbpages');
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

	

	public function edit($id)

	{

		$data['get_page'] = $this->dbpages->get_page($id);

		

		//$this->form_validation->set_rules('page_menu_name', $this->lang->line('text_page_name'), 'required');

		$this->form_validation->set_rules('page_title', $this->lang->line('text_page_title'), 'required');

		$this->form_validation->set_rules('page_content', $this->lang->line('text_content'), 'required');

		$this->form_validation->set_rules('page_seo', $this->lang->line('text_slug'), 'trim|required|callback_checkseo');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			

				$data=array(

				'page_sub_id'=>$this->input->post('page_sub_id'),

				'page_title'=>$this->input->post('page_title'),

				//'sub_title'=>$this->input->post('sub_title'),

				//'page_menu_name'=>$this->input->post('page_menu_name'),

				'page_content'=>$this->input->post('page_content'),

				'page_seo'=>$this->input->post('page_seo'),

				'page_order'=>$this->input->post('page_order'),

				'page_status'=>$this->input->post('page_status'),

				'page_seo'=>friendlyURL($this->input->post('page_seo')),

				'page_link'=>friendlyURL($this->input->post('page_link')),

				'islink'=>friendlyURL($this->input->post('islink')),
				
				'type'=>$this->input->post('type'),
				'page_home'=>$this->input->post('page_home'),

				'page_created_date'=>$this->input->post('page_created_date'),

				'page_created_by'=>$this->input->post('page_created_by'),

				'page_modified_date'=>$this->input->post('page_modified_date'),

				'page_modified_by'=>$this->input->post('page_modified_by')

				);

				$result=$this->dbpages->edit($data,$id);

				

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

				

				redirect(base_url().'admincp_convention/pages');

		}

	

	

		$data['title']=$this->lang->line('text_edit_page');

		$this->load->view('admincp_convention/pages/edit',$data);

	}

	

	function checkuser($seo)

	{

		

		$query = $this->dbpages->check_seo(friendlyURL($seo),$this->input->post('page_sub_id'));

		if ($query)

		{

			$this->form_validation->set_message('page_seo', '%s '.$this->lang->line('misc_already_exists'));

			return FALSE;

		}

		else

		{

			return TRUE;

		}

	}

	

	public function add()

	{

		

		//$this->form_validation->set_rules('page_menu_name', $this->lang->line('text_page_name'), 'required');

		$this->form_validation->set_rules('page_title', $this->lang->line('text_page_title'), 'required');

		$this->form_validation->set_rules('page_content', $this->lang->line('text_content'), 'required');

		$this->form_validation->set_rules('page_seo', $this->lang->line('text_slug'), 'trim|required|callback_checkseo');

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			$data=array(

				'page_sub_id'=>$this->input->post('page_sub_id'),

				'page_title'=>$this->input->post('page_title'),

				//'sub_title'=>$this->input->post('sub_title'),

				//'page_menu_name'=>$this->input->post('page_menu_name'),

				'page_content'=>$this->input->post('page_content'),

				'page_seo'=>$this->input->post('page_seo'),

				'page_order'=>$this->input->post('page_order'),

				'page_status'=>$this->input->post('page_status'),

				'page_seo'=>friendlyURL($this->input->post('page_seo')),

				'page_link'=>friendlyURL($this->input->post('page_link')),

				'islink'=>friendlyURL($this->input->post('islink')),
				'type'=>$this->input->post('type'),
				'page_home'=>$this->input->post('page_home'),
				'page_created_date'=>$this->input->post('page_created_date'),

				'page_created_by'=>$this->input->post('page_created_by'),
				'page_modified_date'=>$this->input->post('page_created_date'),

				'page_modified_by'=>$this->input->post('page_created_by')

				);

			$result=$this->dbpages->insert($data);

			

			$this->session->set_flashdata('message_type', 'success');

			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

			

			redirect(base_url().'admincp_convention/pages');

		}

	

	

		$data['title']=$this->lang->line('menu_text_add_page');

		$this->load->view('admincp_convention/pages/add',$data);

	}

	

	public function view()

	{

		$num_rec=$this->dbpages->count_pages();

		

		$this->load->library('pagination');

		

		$config['base_url'] = base_url().'admincp_convention/pages/view/';

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

		

		$data['query'] = $this->dbpages->get_all_pages($config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title']=$this->lang->line('menu_text_manage_pages');

		$this->load->view('admincp_convention/pages/view',$data);

		

	}

	

	public function delete($id)

	{

		$result=$this->dbpages->delete($id);

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention/pages/view');

	}

	

}

?>