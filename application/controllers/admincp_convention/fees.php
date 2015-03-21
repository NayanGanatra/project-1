<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fees extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'html','string'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('text');
		$login = $this->session->userdata('username');
		$this->load->model('admincp_convention/dbfees');
		$this->load->model('admincp_convention/dbsettings');
		$this->load->model('admincp_convention/dbadminheader');
		$this->load->library('email');
		$this->load->library('parser');
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
	function view()
	{
		$data['query'] = $this->dbfees->get_all_fees_st();
		$data['title'] = 'Fees structure';		
		$this->load->view('admincp_convention/fees/view',$data);
	}
	function add()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		
		$this->form_validation->set_rules('txtmemfee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemfee', 'Fees', 'required|numeric'); 
		$this->form_validation->set_rules('txtmemlatefee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemlatefee', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txtchildfee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonchildfee', 'Fees', 'required|numeric'); 
		$this->form_validation->set_rules('txtchildlatefee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonchildlatefee', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txttrad', 'Traditional', 'required');
		$this->form_validation->set_rules('txtcont', 'Continental', 'required'); 
		$this->form_validation->set_rules('txtdate', 'Date', 'required');
		
		
		$this->form_validation->set_rules('txtmemfeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemfeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtmemlatefeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemlatefeeadult', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txtyoungagefrom', 'Age', 'required|numeric');
		$this->form_validation->set_rules('txtyoungageto', 'Age', 'required|numeric');
		
		$this->form_validation->set_rules('txtmenu1', 'menu', 'required');
		$this->form_validation->set_rules('txtmenu2', 'menu', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
				$datafees=array(
				'fees_st_title'=>$this->input->post('title'),
				'trad'=>$this->input->post('txttrad'),
				'cont'=>$this->input->post('txtcont'),
				'first_menu'=>$this->input->post('txtmenu1'),
				'second_menu'=>$this->input->post('txtmenu2'),
				'final_date'=>$this->input->post('txtdate'),
				'fees_st_created_date'=>$this->input->post('fees_created_date'),
				'fees_st_created_by'=>$this->input->post('fees_created_by')
				);
				$result=$this->dbfees->add_fees_st($datafees);
				
				$inserted_id = $this->db->insert_id();
				
				for($i=65;$i<=69;$i++)
				{
					if($i==65)
					{
						$dataGroup=array(
						'fees_st_id'=>$inserted_id,
						'fees_st_age_grp'=>chr($i),
						'start_age'=>0,
						'end_age'=>intval($this->input->post('txtyoungagefrom')),
						'fees_st_mm_fee'=>$this->input->post('txtchildfee'),
						'fees_st_non_mm_fee'=>$this->input->post('txtnonchildfee'),
						'fees_st_mm_late_fee'=>$this->input->post('txtchildlatefee'),
						'fees_st_non_mm_late_fee'=>$this->input->post('txtnonchildlatefee')
						);
					}
					else if($i==66)
					{
						$dataGroup=array(
						'fees_st_id'=>$inserted_id,
						'fees_st_age_grp'=>chr($i),
						'start_age'=>$this->input->post('txtyoungagefrom'),
						'end_age'=>$this->input->post('txtyoungageto'),
						'fees_st_mm_fee'=>$this->input->post('txtmemfee'),
						'fees_st_non_mm_fee'=>$this->input->post('txtnonmemfee'),
						'fees_st_mm_late_fee'=>$this->input->post('txtmemlatefee'),
						'fees_st_non_mm_late_fee'=>$this->input->post('txtnonmemlatefee')
						);
					}
					else if($i==67)
					{
						$dataGroup=array(
						'fees_st_id'=>$inserted_id,
						'fees_st_age_grp'=>chr($i),
						'start_age'=>intval($this->input->post('txtyoungageto'))+1 ,
						'end_age'=>0,
						'fees_st_mm_fee'=>$this->input->post('txtmemfeeadult'),
						'fees_st_non_mm_fee'=>$this->input->post('txtnonmemfeeadult'),
						'fees_st_mm_late_fee'=>$this->input->post('txtmemlatefeeadult'),
						'fees_st_non_mm_late_fee'=>$this->input->post('txtnonmemlatefeeadult')
						);
					}
					else
					{
						$dataGroup=array(
						'fees_st_id'=>$inserted_id,
						'fees_st_age_grp'=>chr($i),
						'start_age'=>0,
						'end_age'=>0,
						'fees_st_mm_fee'=>0,
						'fees_st_non_mm_fee'=>0,
						'fees_st_mm_late_fee'=>0,
						'fees_st_non_mm_late_fee'=>0
						);
					}
					$result=$this->dbfees->add_fees_st_groups($dataGroup);
				}
				
				
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Fees structure successfully inserted.');
				
				redirect(base_url().'admincp_convention/fees');
		}
		$data['title'] = 'Add Fees structure';		
		$this->load->view('admincp_convention/fees/add',$data);
	}
	function edit($id)
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		
		$this->form_validation->set_rules('txtmemfee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemfee', 'Fees', 'required|numeric'); 
		$this->form_validation->set_rules('txtmemlatefee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemlatefee', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txtchildfee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonchildfee', 'Fees', 'required|numeric'); 
		$this->form_validation->set_rules('txtchildlatefee', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonchildlatefee', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txttrad', 'Traditional', 'required');
		$this->form_validation->set_rules('txtcont', 'Continental', 'required'); 
		$this->form_validation->set_rules('txtdate', 'Date', 'required');
		
		
		$this->form_validation->set_rules('txtmemfeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemfeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtmemlatefeeadult', 'Fees', 'required|numeric');
		$this->form_validation->set_rules('txtnonmemlatefeeadult', 'Fees', 'required|numeric');
		
		$this->form_validation->set_rules('txtyoungagefrom', 'Age', 'required|numeric');
		$this->form_validation->set_rules('txtyoungageto', 'Age', 'required|numeric');
		
		$this->form_validation->set_rules('txtmenu1', 'menu', 'required');
		$this->form_validation->set_rules('txtmenu2', 'menu', 'required');
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');	
		
		if ($this->form_validation->run() == FALSE)
		{
			
		}
		else
		{
			$datafees=array(
				'fees_st_title'=>$this->input->post('title'),
				'trad'=>$this->input->post('txttrad'),
				'cont'=>$this->input->post('txtcont'),
				'first_menu'=>$this->input->post('txtmenu1'),
				'second_menu'=>$this->input->post('txtmenu2'),
				'final_date'=>$this->input->post('txtdate'),
				'fees_st_modified_date'=>$this->input->post('fees_modified_date'),
				'fees_st_modified_by'=>$this->input->post('fees_modified_by')
				);
			$result=$this->dbfees->edit_fees_st($datafees,$id);
			
			
				$dataGroupa=array(
					'start_age'=>0,
					'end_age'=>intval($this->input->post('txtyoungagefrom')),
					'fees_st_mm_fee'=>$this->input->post('txtchildfee'),
					'fees_st_non_mm_fee'=>$this->input->post('txtnonchildfee'),
					'fees_st_mm_late_fee'=>$this->input->post('txtchildlatefee'),
					'fees_st_non_mm_late_fee'=>$this->input->post('txtnonchildlatefee')
					);
				$result=$this->dbfees->edit_fees_st_group($dataGroupa,$id,'A');
				
				$dataGroupb=array(
				'start_age'=>$this->input->post('txtyoungagefrom'),
				'end_age'=>$this->input->post('txtyoungageto'),
				'fees_st_mm_fee'=>$this->input->post('txtmemfee'),
				'fees_st_non_mm_fee'=>$this->input->post('txtnonmemfee'),
				'fees_st_mm_late_fee'=>$this->input->post('txtmemlatefee'),
				'fees_st_non_mm_late_fee'=>$this->input->post('txtnonmemlatefee')
				);
				$result=$this->dbfees->edit_fees_st_group($dataGroupb,$id,'B');
			
				$dataGroupc=array(
				'start_age'=>intval($this->input->post('txtyoungageto'))+1 ,
				'end_age'=>0,
				'fees_st_mm_fee'=>$this->input->post('txtmemfeeadult'),
				'fees_st_non_mm_fee'=>$this->input->post('txtnonmemfeeadult'),
				'fees_st_mm_late_fee'=>$this->input->post('txtmemlatefeeadult'),
				'fees_st_non_mm_late_fee'=>$this->input->post('txtnonmemlatefeeadult')
				);
				$result=$this->dbfees->edit_fees_st_group($dataGroupc,$id,'C');
				
				
				$this->session->set_flashdata('message_type', 'success');
				$this->session->set_flashdata('status_', 'Fees structure successfully updated.');
				
				redirect(base_url().'admincp_convention/fees');
		}
		$data['item'] = $this->dbfees->get_fees_st_detail_by_id($id);
		$data['itema'] = $this->dbfees->get_fees_group_detail_by_id($id,'A');
		$data['itemb'] = $this->dbfees->get_fees_group_detail_by_id($id,'B');
		$data['itemc'] = $this->dbfees->get_fees_group_detail_by_id($id,'C');
		
		$data['title'] = 'Edit Fees structure';		
		$this->load->view('admincp_convention/fees/edit',$data);
	}
	public function delete($id)
	{
		$this->dbfees->delete_fees_st($id);
		$this->dbfees->delete_fees_st_group($id);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('status_', 'Fees structure successfully deleted.');
		if ($this->agent->is_referral())
		{
			redirect($this->agent->referrer());
		}
		else
		{
			redirect(base_url('admincp_convention/fees'));
		}
	}
}
?>