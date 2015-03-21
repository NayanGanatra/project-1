<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->model('chapteradmincp/dbadminheader');
		$this->load->model('chapteradmincp/dbpassword');
		
		$login = $this->session->userdata('username');
		
		if($login=='')
		{
			redirect(base_url().'chapteradmincp/login');
		}
		
	}
	public function index()
	{
		$this->form_validation->set_rules('username',$this->lang->line('text_username'),'required');
		$this->form_validation->set_rules('txtcpass',$this->lang->line('text_current_password'),'required|callback_checkcurrentpwd');
		$this->form_validation->set_rules('txtncpass',$this->lang->line('text_new_password'),'required|matches[txtrncpass]');
		$this->form_validation->set_rules('txtrncpass',$this->lang->line('text_confirm_password'),'required');
		$this->form_validation->set_error_delimiters('', '');
		
		if($this->form_validation->run()==FALSE)
		{
			$data['title']=$this->lang->line('text_change_password');
			$data['msg']="";
			$this->load->view('chapteradmincp/user/change_pass',$data);
		}
		else
		{
			$xyz=array("mm_password" => md5($this->input->post('txtncpass')),"mm_email" => $this->input->post('username'));
			$this->dbpassword->change($xyz,$this->session->userdata('chapter_mm_id'));
			$data['title']="Change Password";
			$this->load->view('chapteradmincp/user/change_pass',$data);
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_',$this->lang->line('misc_success_updated'));
				
			redirect(base_url().'chapteradmincp/password');
				
		}
	}
	
	public function checkcurrentpwd($str)
	{
		$abc=$this->dbpassword->qur($str);
		
		if($abc)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('checkcurrentpwd', '%s '.$this->lang->line('text_is_wrong'));
			return FALSE;
		}
	}
}
?>