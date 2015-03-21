<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		
		$login = $this->session->userdata('username');
		
		$this->load->model('admincp/dbuser');
		$this->load->model('admincp/dbadminheader');
		
		if($login=='')
		{
			redirect(base_url().'admincp/login');
		}
		
	}
	
	public function index()
	{	
		$this->view();
	}
	
	public function view()
	{
		$num_rec=$this->dbuser->count_user();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'admincp/user/view/';
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
		
		$data['query'] = $this->dbuser->get_all_user($config['per_page'],$segment);
		
		$this->pagination->initialize($config);
		
		$data['title']="Manage Members";		
		$this->load->view('admincp/user/view',$data);
	}
	
	function edit($id)
	{
		$data['user'] = $this->dbuser->get_user($id);
		
		$this->form_validation->set_rules('mm_fname', $this->lang->line('text_fname'), 'required');
		$this->form_validation->set_rules('mm_lname', $this->lang->line('text_lname'), 'required');
		$this->form_validation->set_rules('mm_city_id', $this->lang->line('text_city'), 'required');
		$this->form_validation->set_rules('mm_state_id', $this->lang->line('text_state'), 'required');
		
		if($this->input->post('mm_password') !='')
		{
			$this->form_validation->set_rules('mm_password', $this->lang->line('text_password'), 'required|trim|max_length[200]|min_length[6]|xss_clean');
		}
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			// Image upload start
			
			$config['upload_path'] = $this->config->item('rootfolderpath').'images/profile/big/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			
			$this->load->library('upload', $config);
		
			if (!$this->upload->do_upload('mm_photo'))
			{
				$filename=$this->input->post('old_photo');
			}
			else
			{

				$filename=$this->upload->file_name;
				
				$this->load->library("image_moo");
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name)
				->resize(500,500,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name,$overwrite=TRUE);
				
				$this->image_moo
				->load($this->config->item('rootfolderpath')."images/profile/big/".$this->upload->file_name)
				->resize_crop(180,180,$pad=TRUE)
				->save($this->config->item('rootfolderpath')."images/profile/thumb/".$this->upload->file_name,$overwrite=TRUE);
				
				if($this->image_moo->errors) print $this->image_moo->display_errors();
				
				//unlink($this->config->item('rootfolderpath')."images/profile/".$this->upload->file_name);			
			}
			// image upload end
			
			$dataA=array(
				'mm_fname'=>$this->input->post('mm_fname'),
				'mm_lname'=>$this->input->post('mm_lname'),
				'mm_city_id'=>$this->input->post('mm_city_id'),
				'mm_state_id'=>$this->input->post('mm_state_id'),
				'mm_hphone'=>$this->input->post('mm_hphone'),
				'mm_cphone'=>$this->input->post('mm_cphone'),
				'mm_photo'=>$filename,
				'mm_modify'=>date('Y-m-d')
				);
				$resultA=$this->dbuser->update($dataA,$data['user']->mm_id);

			if($this->input->post('mm_password') !='')
			{
				$dataB=array(
				'mm_password'=>md5($this->input->post('mm_password'))
				);
				$this->dbuser->update($dataB,$data['user']->mm_id);
			}
			
			if($this->input->post('chapter') != 0)
			{
				$dataC=array(
				'mm_chapter_id'=>$this->input->post('chapter'),
				'mm_type'=>1
				);
				$this->dbuser->update($dataC,$data['user']->mm_id);
			}
			else
			{
				$dataC=array(
				'mm_chapter_id'=>0,
				'mm_type'=>0
				);
				$this->dbuser->update($dataC,$data['user']->mm_id);
			}
			
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', $this->lang->line('misc_success_saved'));
								
				if ($this->agent->is_referral())
				{
					redirect($this->agent->referrer());
				}
				else
				{
					redirect(base_url().'admincp/user.html');
				}
		}
		
			$data['title'] = $this->lang->line('text_edit_profile_title');
			$data['sub_title'] = $this->lang->line('text_edit_profile_sub_title');
			$data['description'] = "";
			$data['keywords'] = "";
			$this->load->view('admincp/user/edit',$data);
	}
	
	function get_city($state_id,$city_id='')
	{
		
		$get_cities = $this->dbadminheader->cities($state_id);
		
		$html = '<select class="input-xlarge" name="mm_city_id" id="mm_city_id"><option>Select State</option>';
		foreach($get_cities as $get_cities_row)
		{
			if($city_id == $get_cities_row->city_id)
			{
				$html .= "<option selected='selected' value='".$get_cities_row->city_id."'>".$get_cities_row->city_name."</option>";
			}
			else
			{
				$html .= "<option value='".$get_cities_row->city_id."'>".$get_cities_row->city_name."</option>";
			}
			
		
		}
		$html .= '</select>';
		echo $html;
	}
	
	public function delete($id)
	{
		$result=$this->dbuser->delete($id);
		
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		if ($this->agent->is_referral())
			{
				redirect($this->agent->referrer());
			}
			else
			{
				redirect(base_url('admincp/categories/view'));
			}
	}
	
}
?>