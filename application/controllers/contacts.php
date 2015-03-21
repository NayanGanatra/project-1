<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contacts extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		$this->load->library('parser');
		$this->load->model('dbheader');
	}
	
	public function index()
	{
		$this->form_validation->set_rules('name', $this->lang->line('contact_name'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('contact_email'), 'required|trim|valid_email');
		$this->form_validation->set_rules('comments', $this->lang->line('contact_comments'), 'required');
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		
		
		$settings = $this->dbheader->get_setting();
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$email = $this->dbheader->get_setting('email');

			$config['mailtype'] = 'html';
			$this->email->initialize($config);

			$this->email->from($_POST['email'], $_POST['name']);
			$this->email->to($settings->email);
			
			$this->email->subject($this->lang->line('contact_email_subject'));
			
			$final_message = array('comments' => $_POST['comments'], 'name' => $_POST['name'], 'email' => $_POST['email'],'sitename'=>$settings->sitename);
			
			$this->email->message($this->parser->parse('contact_parser', $final_message , TRUE));
			
			$this->email->send();
			//echo $this->email->print_debugger();	
			
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('status_', $this->lang->line('contact_success_msg_sent'));
			
			redirect(base_url().'contacts.html');
			
			
		}
		$data['title'] = $this->lang->line('contact_headline');
		$this->load->view('contacts',$data);
	}
	
}