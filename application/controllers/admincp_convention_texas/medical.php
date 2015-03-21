<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Medical extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');
		

		//$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention_texas/dbmedical');
		$this->load->model('admincp_convention_texas/dbsettings');
		$this->load->model('admincp_convention_texas/dbadminheader');

		

		

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
	
	public function destroy()
	{
		//$this->session->unset_userdata('mm_type');
		$this->session->unset_userdata('search');
		//header("location: ".base_url()."admincp/user/view");
		redirect(base_url()."admincp_convention_texas/medical/view");
	}
	

	public function view()

	{
		
		if($this->uri->segment(4))
		{
			$search_key = $this->uri->segment(4);
			//$mm_type = $this->uri->segment(5);
		}
		else
		{
			$search_key = 0;
			//$mm_type = 0;
		}
		
		if(isset($_POST['search']))
		{
		$search_key = $_POST['search'];
		$this->session->set_userdata('search',$search_key);
		}
		
		//$search_key = $this->input->post('search');
		if($search_key == '0')
		{
			$search_key = "";
			$num_rec=$this->dbmedical->count_medical($search_key);
		}
		else
		{
			$num_rec=$this->dbmedical->count_medical($search_key);
		}
		
		
		
		$this->load->library('pagination');

		$data['tot_rec'] = $num_rec;
		
		
		if($search_key == "")
		{
			$search_key = 0;
			$config['base_url'] = base_url().'admincp_convention_texas/medical/view/'.$search_key.'/';
		}
		else
		{
			$config['base_url'] = base_url().'admincp_convention_texas/medical/view/'.$search_key.'/';
		}
		
		
		

		$config['total_rows'] = $num_rec;

		$config['per_page'] = 20;

		$config['uri_segment'] = 5;

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



		if ($this->uri->segment(5) == "")

		{

			$segment  = 0;

		}

		else

		{

			$segment = $this->uri->segment(5);	

		}

		
		if($search_key == '0')
		{
			$search_key = "";
			$data['query'] = $this->dbmedical->get_all_medical($search_key,$config['per_page'],$segment);
		}
		else
		{
			$data['query'] = $this->dbmedical->get_all_medical($search_key,$config['per_page'],$segment);
		}

		
		
		//$data['query'] = $this->dbprogram->get_all_program($search_key,$config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title']="Manage Medical Release Form";

		$this->load->view('admincp_convention_texas/medical/view',$data);

		

	}
	
	
	public function edit($id)

	{

		$data['get_details'] = $this->dbmedical->get_details($id);

		
		$this->form_validation->set_rules('md_mm_id', 'Member Name' , 'required');
		
		$this->form_validation->set_rules('md_name', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_birth_month', 'Birth Month' , 'required');
		
		$this->form_validation->set_rules('md_birth_year', 'Birth Year' , 'required');
		
		$this->form_validation->set_rules('md_sex', 'Sex' , 'required');
		
		$this->form_validation->set_rules('md_address', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_name1', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_rel1', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address1', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone1', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone1', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state1', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city1', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip1', 'Zip' , 'required');
		
		
		
		
		
		$this->form_validation->set_rules('md_name2', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address2', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone2', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state2', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city2', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip2', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_dr_name3', 'Name' , 'required');
		
		//$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_dr_address3', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_dr_phone3', 'Phone' , 'required');
		
		//$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_dr_state3', 'State' , 'required');
		
		$this->form_validation->set_rules('md_dr_city3', 'City' , 'required');
		
		$this->form_validation->set_rules('md_dr_zip3', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_insurance_cmp_name', 'Company Name' , 'required');
		
		$this->form_validation->set_rules('md_insurance_plc_no', 'Policy Number' , 'required');
		
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		
		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

	
					// image upload end
					//$pm_member = $this->input->post('pm_name');
						
						//$pm_age = $this->input->post('pm_age');
						
						
					

					$data=array(

						'md_mm_id'=>$this->input->post('md_mm_id'),

						'md_name'=>$this->input->post('md_name'),

						'md_birth_month'=>$this->input->post('md_birth_month'),
						
						'md_birth_year'=>$this->input->post('md_birth_year'),
						
						'md_sex'=>$this->input->post('md_sex'),

						'md_address'=>$this->input->post('md_address'),
						
						'md_home_phone'=>$this->input->post('md_home_phone'),
						
						'md_cellphone'=>$this->input->post('md_cellphone'),
						
						'md_state'=>$this->input->post('md_state'),
						
						'md_city'=>$this->input->post('md_city'),
						
						'md_zip'=>$this->input->post('md_zip'),
						
						
						
						'md_name1'=>$this->input->post('md_name1'),
						
						'md_rel1'=>$this->input->post('md_rel1'),
						
						'md_address1'=>$this->input->post('md_address1'),
						
						'md_home_phone1'=>$this->input->post('md_home_phone1'),
						
						'md_cellphone1'=>$this->input->post('md_cellphone1'),
						
						'md_state1'=>$this->input->post('md_state1'),
						
						'md_city1'=>$this->input->post('md_city1'),
						
						'md_zip1'=>$this->input->post('md_zip1'),
						
						
						
						'md_name2'=>$this->input->post('md_name2'),
						
						'md_rel2'=>$this->input->post('md_rel2'),
						
						'md_address2'=>$this->input->post('md_address2'),
						
						'md_home_phone2'=>$this->input->post('md_home_phone2'),
						
						'md_cellphone2'=>$this->input->post('md_cellphone2'),
						
						'md_state2'=>$this->input->post('md_state2'),
						
						'md_city2'=>$this->input->post('md_city2'),
						
						'md_zip2'=>$this->input->post('md_zip2'),
						
						
						
						
						'md_dr_name3'=>$this->input->post('md_dr_name3'),
						
						'md_dr_address3'=>$this->input->post('md_dr_address3'),
						
						'md_dr_phone3'=>$this->input->post('md_dr_phone3'),
						
						'md_dr_state3'=>$this->input->post('md_dr_state3'),
						
						'md_dr_city3'=>$this->input->post('md_dr_city3'),
						
						'md_dr_zip3'=>$this->input->post('md_dr_zip3'),
						
						
						
						'md_lim_activities'=>$this->input->post('radio'),
						
						'md_allergic'=>$this->input->post('radio1'),
						
						'md_take_med'=>$this->input->post('radio2'),
						
						'md_other_med_info'=>$this->input->post('radio3'),
						
						
						
						
						'md_insurance_cmp_name'=>$this->input->post('md_insurance_cmp_name'),
						
						'md_insurance_plc_no'=>$this->input->post('md_insurance_plc_no'),
						
						
					
						'md_created_date'=>$this->input->post('md_created_date'),

						'md_created_by'=>$this->input->post('md_created_by'),
						
						'md_modified_by'=>$this->input->post('md_modified_by'),
						
						'md_modified_date'=>$this->input->post('md_modified_date')
						

						);

					

					$result=$this->dbmedical->edit($data,$id);
					
					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp_convention_texas/medical');

				

		}

	

	

		$data['title']="Edit Medical";

		$this->load->view('admincp_convention_texas/medical/edit',$data);

	}
	
	
	public function add()
	{
		
		
		$this->form_validation->set_rules('md_mm_id', 'Member Name' , 'required');
		
		$this->form_validation->set_rules('md_name', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_birth_month', 'Birth Month' , 'required');
		
		$this->form_validation->set_rules('md_birth_year', 'Birth Year' , 'required');
		
		$this->form_validation->set_rules('md_sex', 'Sex' , 'required');
		
		$this->form_validation->set_rules('md_address', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_name1', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_rel1', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address1', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone1', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone1', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state1', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city1', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip1', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_name2', 'Name' , 'required');
		
		$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_address2', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_home_phone2', 'Home Phone' , 'required');
		
		$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_state2', 'State' , 'required');
		
		$this->form_validation->set_rules('md_city2', 'City' , 'required');
		
		$this->form_validation->set_rules('md_zip2', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_dr_name3', 'Name' , 'required');
		
		//$this->form_validation->set_rules('md_rel2', 'Relationship' , 'required');
		
		$this->form_validation->set_rules('md_dr_address3', 'Address' , 'required');
		
		$this->form_validation->set_rules('md_dr_phone3', 'Phone' , 'required');
		
		//$this->form_validation->set_rules('md_cellphone2', 'Cell Phone' , 'required');
		
		$this->form_validation->set_rules('md_dr_state3', 'State' , 'required');
		
		$this->form_validation->set_rules('md_dr_city3', 'City' , 'required');
		
		$this->form_validation->set_rules('md_dr_zip3', 'Zip' , 'required');
		
		
		
		$this->form_validation->set_rules('md_insurance_cmp_name', 'Company Name' , 'required');
		
		$this->form_validation->set_rules('md_insurance_plc_no', 'Policy Number' , 'required');
		
		
		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');
		
		
		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

	
					// image upload end
					//$pm_member = $this->input->post('pm_name');
						
						//$pm_age = $this->input->post('pm_age');
						
						
					

					$data=array(

						'md_mm_id'=>$this->input->post('md_mm_id'),

						'md_name'=>$this->input->post('md_name'),

						'md_birth_month'=>$this->input->post('md_birth_month'),
						
						'md_birth_year'=>$this->input->post('md_birth_year'),
						
						'md_sex'=>$this->input->post('md_sex'),

						'md_address'=>$this->input->post('md_address'),
						
						'md_home_phone'=>$this->input->post('md_home_phone'),
						
						'md_cellphone'=>$this->input->post('md_cellphone'),
						
						'md_state'=>$this->input->post('md_state'),
						
						'md_city'=>$this->input->post('md_city'),
						
						'md_zip'=>$this->input->post('md_zip'),
						
						
						
						'md_name1'=>$this->input->post('md_name1'),
						
						'md_rel1'=>$this->input->post('md_rel1'),
						
						'md_address1'=>$this->input->post('md_address1'),
						
						'md_home_phone1'=>$this->input->post('md_home_phone1'),
						
						'md_cellphone1'=>$this->input->post('md_cellphone1'),
						
						'md_state1'=>$this->input->post('md_state1'),
						
						'md_city1'=>$this->input->post('md_city1'),
						
						'md_zip1'=>$this->input->post('md_zip1'),
						
						
						
						'md_name2'=>$this->input->post('md_name2'),
						
						'md_rel2'=>$this->input->post('md_rel2'),
						
						'md_address2'=>$this->input->post('md_address2'),
						
						'md_home_phone2'=>$this->input->post('md_home_phone2'),
						
						'md_cellphone2'=>$this->input->post('md_cellphone2'),
						
						'md_state2'=>$this->input->post('md_state2'),
						
						'md_city2'=>$this->input->post('md_city2'),
						
						'md_zip2'=>$this->input->post('md_zip2'),
						
						
						
						
						'md_dr_name3'=>$this->input->post('md_dr_name3'),
						
						'md_dr_address3'=>$this->input->post('md_dr_address3'),
						
						'md_dr_phone3'=>$this->input->post('md_dr_phone3'),
						
						'md_dr_state3'=>$this->input->post('md_dr_state3'),
						
						'md_dr_city3'=>$this->input->post('md_dr_city3'),
						
						'md_dr_zip3'=>$this->input->post('md_dr_zip3'),
						
						
						
						'md_lim_activities'=>$this->input->post('radio'),
						
						'md_allergic'=>$this->input->post('radio1'),
						
						'md_take_med'=>$this->input->post('radio2'),
						
						'md_other_med_info'=>$this->input->post('radio3'),
						
						
						
						
						'md_insurance_cmp_name'=>$this->input->post('md_insurance_cmp_name'),
						
						'md_insurance_plc_no'=>$this->input->post('md_insurance_plc_no'),
						
						
					
						'md_created_date'=>$this->input->post('md_created_date'),

						'md_created_by'=>$this->input->post('md_created_by')
						

						);

						

						$result=$this->dbmedical->insert($data);
						
								
						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

						redirect(base_url().'admincp_convention_texas/medical');


	}
		
		$data['title']="Medical Release Form";
		
		$this->load->view('admincp_convention_texas/medical/add',$data);
	}
	
	

	
	public function delete($id)

	{

		$result=$this->dbmedical->delete($id);
		
		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention_texas/medical/view');

	}
	
	
	
	
	
	
	function ExportToCSV($content,$filename = '', $filedArr = '',$countprograms,$heading)
	{
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename =''.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	//date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		$fp = fopen($filename, 'w');
				
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.="<tr><td colspan='29' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='31' align='left'>";
				$string.="<font size=4><b>$countprograms</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='8' align='left'>";
				$string.="<font size=4><b><center>CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='6' align='left'>";
				$string.="<font size=4><b><center>IN CASE OF EMERGENCY, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='6' align='left'>";
				$string.="<font size=4><b><center>IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='5' align='left'>";
				$string.="<font size=4><b><center>IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</center></b></font>";
				$string.="</td>";
				$string.="<td colspan='2' align='left'>";
				$string.="<font size=4><b><center>Health Insurance Company</center></b></font>";
				$string.="</td></tr>";
				$string.= "<tr>";
				$field = array();
				foreach($filedArr as $filed)
				{
					
					$string.= "<th width='auto' bordercolor='#d0d7e5'>$filed</th>";
					
					
					
				}
				
				
				$string.= "</tr>";
				
				$string.= "<tr>";
				
				for($i=0;$i<count($content);$i++)
				{
				foreach($content[$i] as $line)
				{
					$string.= "<td bordercolor='#d0d7e5'><center>$line</center></td>";
					
				}
				$string.= "</tr>";
				}
				
				
			$string.= "</table>";
			
			header('Content-Type: application/force-download');  
		header('Content-disposition: attachment; filename="'.$filename.'"');
		header("Pragma:");  
		header("Cache-Control:"); 
		echo $string;
		fwrite($fp,$string);	
			//chmod($filename, 0755);

		//fwrite($fp,$string); 
			//echo($string);die();
		//fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-type: application/excel');
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:"); 
		//echo $string;
	/*
	//if($content != '' && (!(empty($content)))  ){
		$fp = fopen($filename, 'w');
		//if($filedArr != ''  &&  is_array($filedArr))
			fputcsv($fp, $filedArr);
		//else
		//	echo  'Please  Provide Filed Name  In Array.'; 
		foreach($content as $line){
			//$val = implode(",",$line);
			fputcsv($fp, $line);
		}
		fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:");
		//header('Content-type: application/excel');
		//header('Content-Disposition: attachment; filename="'.$filename.'"');
		
		//readfile($filename);
		//unlink($filename);
		*/

	/*}else{
		echo  'No Content Found ' ;
	}*/
	
	}
	
	function medical_export_to_excel()
	{
		
		$search_key = $this->session->userdata('search');
		
		
		
			$num_rec=$this->dbmedical->count_medical_export_to_excel($search_key);
		
			$medical_deatails = $this->dbmedical->get_all_medical_export_to_excel($search_key);
			
			$filename = 'Medical_release_list'.date('Y-m-d').'_'.time().'.xls';
			$heading = 'Medical release list';
			$countmedical = $num_rec.' Medical release';
		
		$content = '';
		$num = 0;
		$filedArr =array('Member Name','Name','DOB','Sex','Address','Home/Cell Phone','State/City','Zip','Name','Relationship','Address','Home/Cell Phone','State/City','Zip','Name','Relationship','Address','Home/Cell Phone','State/City','Zip','Name','Address','Phone','State/City','Zip','Company Name','Policy No','Created by','Created date','Modified by','Modified date');		
		$content=array();
		
		foreach($medical_deatails as $all_medical)
		{
			

			  

			  // $user_ch = $this->dbuser->get_ch_from_state($all_users->mm_state_id);

			   

			  // if($user_ch)

			   //{

			  // 	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   //}
			   
			$member_name = $this->dbmedical->get_member_name($all_medical->md_mm_id); 
			
			foreach($member_name as $member) 
			{
					$content[$num]['Member Name'] = $member->mm_fname.' '.$member->mm_lname;
			}
			
			$content[$num]['Name'] = $all_medical->md_name;
			
			$content[$num]['DOB'] = $all_medical->md_birth_month.'/'.$all_medical->md_birth_year;
			if($all_medical->md_sex == '0')
			{
				$content[$num]['Sex'] = "Male";
			}
			else
			{
				$content[$num]['Sex'] = "Female";
			}
			
			$content[$num]['Address'] = $all_medical->md_address;
			
			$content[$num]['Home/Cell Phone'] = $all_medical->md_home_phone.'/'.$all_medical->md_cellphone;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_state);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_city);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$content[$num]['State/City'] = $state->state_name.'/'.$city->city_name;
				}
			}
			
			
			$content[$num]['Zip'] = $all_medical->md_zip;
			
			
			
			$content[$num]['Name1'] = $all_medical->md_name1;
			
			$content[$num]['Relationship1'] = $all_medical->md_rel1;
			
			$content[$num]['Address1'] = $all_medical->md_address1;
			
			$content[$num]['Home/Cell Phone1'] = $all_medical->md_home_phone1.'/'.$all_medical->md_cellphone1;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_state1);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_city1);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$content[$num]['State/City1'] = $state->state_name.'/'.$city->city_name;
				}
			}
			
			$content[$num]['Zip1'] = $all_medical->md_zip1;
			
			
			
			$content[$num]['Name2'] = $all_medical->md_name2;
			
			$content[$num]['Relationship2'] = $all_medical->md_rel2;
			
			$content[$num]['Address2'] = $all_medical->md_address2;
			
			$content[$num]['Home/Cell Phone2'] = $all_medical->md_home_phone2.'/'.$all_medical->md_cellphone2;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_state2);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_city2);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$content[$num]['State/City2'] = $state->state_name.'/'.$city->city_name;
				}
			}
			
			$content[$num]['Zip2'] = $all_medical->md_zip2;
			
			
			
			
			$content[$num]['Name3'] = $all_medical->md_dr_name3;
			
			$content[$num]['Address3'] = $all_medical->md_dr_address3;
			
			$content[$num]['Phone3'] = $all_medical->md_dr_phone3;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_dr_state3);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_dr_city3);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$content[$num]['State/City3'] = $state->state_name.'/'.$city->city_name;
				}
			}
			
			$content[$num]['Zip3'] = $all_medical->md_dr_zip3;
			
			
			
			
			$content[$num]['Company Name'] = $all_medical->md_insurance_cmp_name;
			
			$content[$num]['Policy No'] = $all_medical->md_insurance_plc_no;
			
			
			$content[$num]['Created by'] = $all_medical->md_created_by;
			
			$content[$num]['Created date'] = $all_medical->md_created_date;
			
			$content[$num]['Modified by'] = $all_medical->md_modified_by;
			
			$content[$num]['Modified date'] = $all_medical->md_modified_date;
		
		$num++;
			
		}
		
		$this->ExportToCSV($content,$filename,$filedArr,$countmedical,$heading);
		
		
	}
	
	function get_city($state_id,$city_id='')
	{
		
		$get_cities = $this->dbmedical->cities($state_id);
		
		$html = '<select class="input-xlarge" name="" id="mm_city_id"><option value="">Select City</option>';
		foreach($get_cities as $get_cities_row)
		{
			if($city_id ==$get_cities_row->city_id)
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
	
	
	
	function ExportToCSV_medical_detail($content,$filename = '', $filedArr = '',$heading)
	{
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename =''.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	//date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	
		$fp = fopen($filename, 'w');
				
			$string.= "<table width='600' id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
			$string.="<tr><td colspan='6'>";
			$string.="<font size=4><b>$heading</b></font>";
			$string.="</td><td colspan='2'>";
			$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
			$string.="</td></tr>";
			$string.="<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='4' align='left'>$filedArr[0]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='4'><center>$content[0]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[1]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='1' align='left'>$filedArr[2]</th>";
			$string.= "<th style='border:none;' colspan='1' align='left'>$filedArr[3]</th>";
			$string.= "<th style='border:none;' colspan='1' align='left'>$filedArr[4]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[1]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='1'><center>$content[2]</center></td>";
			$string.= "<td colspan='1'><center>$content[3]</center></td>";
			$string.= "<td colspan='1'><center>$content[4]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[5]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[6]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[7]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[5]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[6]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[7]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[8]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[9]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[10]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[8]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[9]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[10]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.="<tr><td colspan='8' style='border:none;'>";
			$string.="<font size=3><b>IN CASE OF EMERGENCY, CONTACT</b></font>";
			$string.="</td></tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[11]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[12]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[11]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[12]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[13]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[14]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[15]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[13]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[14]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[15]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[16]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[17]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[18]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[16]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[17]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[18]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.="<tr><td colspan='8' style='border:none;'>";
			$string.="<font size=3><b>IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</b></font>";
			$string.="</td></tr>";
			$string.= "<tr></tr>";
			
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[19]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[20]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[19]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[20]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[21]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[22]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[23]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[21]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[22]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[23]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[24]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[25]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[26]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[24]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[25]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[26]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.="<tr><td colspan='8' style='border:none;'>";
			$string.="<font size=3><b>PERSONAL DOCTOR</b></font>";
			$string.="</td></tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[27]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[27]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[28]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[29]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[28]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[29]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[30]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[31]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[32]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[30]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[31]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[32]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			
			for($i=33;$i<=36;$i++)
			{
			$string.="<tr><td colspan='5' style='border:none;'>";
			$string.="<font size=2><b>$filedArr[$i]</b></font>";
			$string.="</td><td style='border:none;'></td><td colspan='1'><center>$content[$i]</center></td></tr>";
			}
			$string.= "<tr></tr>";
			
			$string.="<tr><td colspan='8' style='border:none;'>";
			$string.="<font size=3><b>Name of Health Insurance Company & Policy Number</b></font>";
			$string.="</td></tr>";
			$string.= "<tr></tr>";
			
			$string.= "<tr>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[37]</th><th style='border:none;'></th>";
			$string.= "<th style='border:none;' colspan='2' align='left'>$filedArr[38]</th>";
			$string.= "</tr>";
			$string.= "<tr>";
			$string.= "<td colspan='2'><center>$content[37]</center></td><td style='border:none;'></td>";
			$string.= "<td colspan='2'><center>$content[38]</center></td>";
			$string.= "</tr>";
			$string.= "<tr></tr>";
			$string.= "</table>";
			
			header('Content-Type: application/force-download');  
		header('Content-disposition: attachment; filename="'.$filename.'"');
		header("Pragma:");  
		header("Cache-Control:"); 
		echo $string;
		fwrite($fp,$string);
			
			//chmod($filename, 0755);

		//fwrite($fp,$string); 
			//echo($string);die();
		//fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-type: application/excel');
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:"); 
		//echo $string;
	/*
	//if($content != '' && (!(empty($content)))  ){
		$fp = fopen($filename, 'w');
		//if($filedArr != ''  &&  is_array($filedArr))
			fputcsv($fp, $filedArr);
		//else
		//	echo  'Please  Provide Filed Name  In Array.'; 
		foreach($content as $line){
			//$val = implode(",",$line);
			fputcsv($fp, $line);
		}
		fclose($fp);
		//header('Content-Type: application/force-download');  
		//header('Content-disposition: attachment; filename="'.$filename.'"');
		//header("Pragma:");  
		//header("Cache-Control:");
		//header('Content-type: application/excel');
		//header('Content-Disposition: attachment; filename="'.$filename.'"');
		
		//readfile($filename);
		//unlink($filename);
		*/

	/*}else{
		echo  'No Content Found ' ;
	}*/
	
	}
	
	function medical_detail_export_to_excel()
	{
		
		//$search_key = $this->session->userdata('search');
		
		$id = $this->uri->segment(4);
		
			//$num_rec=$this->dbmedical->count_medical_export_to_excel($search_key);
		
			$medical_deatails = $this->dbmedical->get_medical_detail_export_to_excel($id);
			
			$filename = 'Medical_details'.date('Y-m-d').'_'.time().'.xls';
			$heading = 'Medical Details';
			
		
		$content = array();
		$num = 0;
		$filedArr =array('Member Name','Name','Birth Month','Birth Year','Gender','Address','Home Phone','Cell Phone','State','City','Zip','Name','Relationship','Address','Home Phone','Cell Phone','State','City','Zip','Name','Relationship','Address','Home Phone','Cell Phone','State','City','Zip','Name','Address','Phone','State','City','Zip','Are there any limitations in physical activities?','Are you allergic to any food or medications?','Are you currently taking any medication?','Is there any other medical information that should be disclosed in case of emergency?','Company Name','Policy Number');
		/*,'Name','Relationship','Address','Home Phone','Cell Phone','State','City','Zip','Name','Relationship','Address','Home/Cell Phone','State/City','Zip','Name','Address','Phone','State/City','Zip','Company Name','Policy No','Created by','Created date','Modified by','Modified date'*/		
		$content=array();
		
		foreach($medical_deatails as $all_medical)
		{
			

			  

			  // $user_ch = $this->dbuser->get_ch_from_state($all_users->mm_state_id);

			   

			  // if($user_ch)

			   //{

			  // 	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   //}
			   
			$member_name = $this->dbmedical->get_member_name($all_medical->md_mm_id); 
			
			foreach($member_name as $member) 
			{
					$member_name = $member->mm_fname.' '.$member->mm_lname;
			}
			
			$name = $all_medical->md_name;
			$birth_month = '';
			if($all_medical->md_birth_month == '1'){ $birth_month = "Jan";} 
			if($all_medical->md_birth_month == '2'){ $birth_month = "Feb";}
			if($all_medical->md_birth_month == '3'){ $birth_month = "Mar";}
			if($all_medical->md_birth_month == '4'){ $birth_month = "Apr";}
			if($all_medical->md_birth_month == '5'){ $birth_month = "May";}
			if($all_medical->md_birth_month == '6'){ $birth_month = "Jun";}
			if($all_medical->md_birth_month == '7'){ $birth_month = "Jul";}
			if($all_medical->md_birth_month == '8'){ $birth_month = "Aug";}
			if($all_medical->md_birth_month == '9'){ $birth_month = "Sep";}
			if($all_medical->md_birth_month == '10'){ $birth_month = "Oct";}
			if($all_medical->md_birth_month == '11'){ $birth_month = "Nov";}
			if($all_medical->md_birth_month == '12'){ $birth_month = "Dec";}
			
			$birth_year = $all_medical->md_birth_year;
			
			if($all_medical->md_sex == '0')
			{
				$gender = "Male";
			}
			else
			{
				$gender = "Female";
			}
			
			$address = $all_medical->md_address;
			
			$home_phone = $all_medical->md_home_phone;
			$cell_phone = $all_medical->md_cellphone;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_state);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_city);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$state_name = $state->state_name;
					$city_name = $city->city_name;
				}
			}
			
			
			$zip = $all_medical->md_zip;
			
			
			
			$name1 = $all_medical->md_name1;
			
			$relationship1 = $all_medical->md_rel1;
			
			$address1 = $all_medical->md_address1;
			
			$home_phone1 = $all_medical->md_home_phone1;
			$cell_phone1 = $all_medical->md_cellphone1;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_state1);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_city1);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$state_name1 = $state->state_name;
					$city_name1 = $city->city_name;
				}
			}
			
			$zip1 = $all_medical->md_zip1;
			
			
			
			$name2 = $all_medical->md_name2;
			
			$relationship2 = $all_medical->md_rel2;
			
			$address2 = $all_medical->md_address2;
			
			$home_phone2 = $all_medical->md_home_phone2;
			$cell_phone2 = $all_medical->md_cellphone2;
			
			$state_detai2 = $this->dbmedical->get_state_name($all_medical->md_state2);
			
			$city_detai2 = $this->dbmedical->get_city_name($all_medical->md_city2);
			
			foreach($state_detai2 as $state)
			{
				foreach($city_detai2 as $city)
				{
					$state_name2 = $state->state_name;
					$city_name2 = $city->city_name;
				}
			}
			
			$zip2 = $all_medical->md_zip2;
			
			
			
			
			$name3 = $all_medical->md_dr_name3;
			
			$address3 = $all_medical->md_dr_address3;
			
			$phone3 = $all_medical->md_dr_phone3;
			
			$state_detail = $this->dbmedical->get_state_name($all_medical->md_dr_state3);
			
			$city_detail = $this->dbmedical->get_city_name($all_medical->md_dr_city3);
			
			foreach($state_detail as $state)
			{
				foreach($city_detail as $city)
				{
					$state_name3 = $state->state_name;
					$city_name3 = $city->city_name;
				}
			}
			
			$zip3 = $all_medical->md_dr_zip3;
			
			if($all_medical->md_lim_activities == '1')
			{
				$q1 = "Yes";
			}
			else
			{
				$q1 = "No";
			}
			if($all_medical->md_allergic == '1')
			{
				$q2 = "Yes";
			}
			else
			{
				$q2 = "No";
			}
			if($all_medical->md_take_med == '1')
			{
				$q3 = "Yes";
			}
			else
			{
				$q3 = "No";
			}
			if($all_medical->md_other_med_info == '1')
			{
				$q4 = "Yes";
			}
			else
			{
				$q4 = "No";
			}
			
			$company_name = $all_medical->md_insurance_cmp_name;
			
			$policy_no = $all_medical->md_insurance_plc_no;
			
			
			array_push($content,$member_name,$name,$birth_month,$birth_year,$gender,$address,$home_phone,$cell_phone,$state_name,$city_name,$zip,$name1,$relationship1,$address1,$home_phone1,$cell_phone1,$state_name1,$city_name1,$zip1,$name2,$relationship2,$address2,$home_phone2,$cell_phone2,$state_name2,$city_name2,$zip2,$name3,$address3,$phone3,$state_name3,$city_name3,$zip3,$q1,$q2,$q3,$q4,$company_name,$policy_no);
			
		}
		
		$this->ExportToCSV_medical_detail($content,$filename,$filedArr,$heading);
		
		
	}

	

}

?>