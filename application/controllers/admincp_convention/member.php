<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('admincp_convention/dbmember');
		$this->load->model('admincp_convention/dbform');
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
		$data['query'] = $this->dbmember->get_page($id);
		
		$this->form_validation->set_rules('name', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('rel', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('age', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('menu_ch', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('age_grp', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('fees', $this->lang->line('fees_total'), 'required');
		/*$this->form_validation->set_rules('fees_total', $this->lang->line('fees_total'), 'required');*/
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	

		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
				$name=$this->input->post('name');
				$rel=$this->input->post('rel');
				$age=$this->input->post('age');
				$menu_ch=$this->input->post('menu_ch');
				$age_grp=$this->input->post('age_grp');
				$fees=$this->input->post('fees');
				/*var_dump($name);
				exit;*/
				for($i=0;$i<sizeof($name);$i++)
				{ 
					$data=array(
					'mm_id'=>$this->input->post('mm_id'),
					'fees_st_id'=>0,
					'fees_att_name'=>$name[$i],
					'fees_mm_rel'=>$rel[$i],
					'fees_mm_age'=>$age[$i],
					'fees_menu_choice'=>$menu_ch[$i],
					'fees_age_grp'=>$age_grp[$i],
					'fees'=>$fees[$i],
					'fees_created_date'=>$this->input->post('fees_created_date'),
					'fees_created_by'=>$this->input->post('fees_created_by')
					);
					$result=$this->dbmember->edit($data,$id);
				}
				
				

				$this->session->set_flashdata('message_type', 'success');

				$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

				

				redirect(base_url().'admincp_convention/member');

		}

	

	

		$data['title']=$this->lang->line('text_edit_page');

		$this->load->view('admincp_convention/member/edit',$data);

	}

	


	

	public function add()
	{
		//var_dump($_POST);
		//exit;
		$this->form_validation->set_rules('name', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('rel', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('age', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('menu_ch', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('age_grp', $this->lang->line('fees_total'), 'required');
		$this->form_validation->set_rules('fees', $this->lang->line('fees_total'), 'required');
		/*$this->form_validation->set_rules('fees_total', $this->lang->line('fees_total'), 'required');*/
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
			$name=$this->input->post('name');
			$rel=$this->input->post('rel');
			$age=$this->input->post('age');
			$menu_ch=$this->input->post('menu_ch');
			$age_grp=$this->input->post('age_grp');
			$fees=$this->input->post('fees');
			/*var_dump($name);
			exit;*/
			for($i=0;$i<sizeof($name);$i++)
			{ 
				$data=array(
				'mm_id'=>$this->input->post('mm_id'),
				'fees_st_id'=>0,
				'fees_att_name'=>$name[$i],
				'fees_mm_rel'=>$rel[$i],
				'fees_mm_age'=>$age[$i],
				'fees_menu_choice'=>$menu_ch[$i],
				'fees_age_grp'=>$age_grp[$i],
				'fees'=>$fees[$i],
				'fees_created_date'=>$this->input->post('fees_created_date'),
				'fees_created_by'=>$this->input->post('fees_created_by')
				);
				$result=$this->dbmember->insert($data);
			}
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));
			redirect(base_url().'admincp_convention/member');
		}
		$data['title']=$this->lang->line('menu_text_add_page');
		$this->load->view('admincp_convention/member/add',$data);
	}
	public function view()
	{
		$num_rec=$this->dbmember->count_pages();
		$this->load->library('pagination');

		

		$config['base_url'] = base_url().'admincp_convention/member/view/';

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

		

		$data['query'] = $this->dbmember->get_all_pages($config['per_page'],$segment);
		
		

		$this->pagination->initialize($config);

		

		$data['title']=$this->lang->line('menu_text_manage_pages');

		$this->load->view('admincp_convention/member/view',$data);

		

	}

	

	public function delete($id)

	{

		$result=$this->dbmember->delete($id);

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention/member/view');

	}

	

}

?>