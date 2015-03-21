<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Program extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');

		$this->load->library('session');

		$this->load->helper('text');
		

		//$login = $this->session->userdata('username');

		

		$this->load->model('admincp_convention_texas/dbprogram');
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
	
	function status($id)

	{

		$data['program'] = $this->dbprogram->get_program_update($id);

		if($data['program']->pm_confirmed=='0')

		{

			$dataA=array('pm_confirmed'=>'1');

			$resultA=$this->dbprogram->status_update($dataA,$data['program']->pm_id);

		}

		else

		{

			$dataA=array('pm_confirmed'=>'0');

			$resultA=$this->dbprogram->status_update($dataA,$data['program']->pm_id);

		}

		

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_saved'));

								

		redirect(base_url().'admincp_convention_texas/program');

		

	}
	
	public function destroy()
	{
		//$this->session->unset_userdata('mm_type');
		$this->session->unset_userdata('search');
		//header("location: ".base_url()."admincp/user/view");
		redirect(base_url()."admincp_convention_texas/program/view");
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
			$num_rec=$this->dbprogram->count_program($search_key);
		}
		else
		{
			$num_rec=$this->dbprogram->count_program($search_key);
		}
		
		
		$data['tot_rec'] = $num_rec;
		
		$this->load->library('pagination');

		if($search_key == "")
		{
			$search_key = 0;
			$config['base_url'] = base_url().'admincp_convention_texas/program/view/'.$search_key.'/';
		}
		else
		{
			$config['base_url'] = base_url().'admincp_convention_texas/program/view/'.$search_key.'/';
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
			$data['query'] = $this->dbprogram->get_all_program($search_key,$config['per_page'],$segment);
		}
		else
		{
			$data['query'] = $this->dbprogram->get_all_program($search_key,$config['per_page'],$segment);
		}
		//$data['query'] = $this->dbprogram->get_all_program($search_key,$config['per_page'],$segment);

		

		$this->pagination->initialize($config);

		

		$data['title']="Manage Program";

		$this->load->view('admincp_convention_texas/program/view',$data);

		

	}
	
	
	public function edit($id)

	{

		$data['get_program'] = $this->dbprogram->get_program($id);

		
		$this->form_validation->set_rules('pm_mm_id', 'Member Name', 'required');

		$this->form_validation->set_rules('pm_type', 'Type' , 'required|trim|xss_clean|callback__alpha_dash_space');

		$this->form_validation->set_rules('pm_length', 'Length', 'required|trim|min_length[5]|xss_clean|callback__alpha_dash_space');

		$this->form_validation->set_rules('pm_desc1', 'Description' , 'required');

		$this->form_validation->set_rules('pm_desc2', 'Description' , 'required');

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

		$this->form_validation->set_error_delimiters('<span class="form_error_msg">', '</span>');		

		

		if ($this->form_validation->run() == FALSE)

		{

			

		}

		else

		{

			
			
				

					$data=array(

						'pm_mm_id'=>$this->input->post('pm_mm_id'),

						'pm_type'=>$this->input->post('pm_type'),

						'pm_length'=>$this->input->post('pm_length'),
						
						'pm_ch1'=>$this->input->post('pm_desc1'),
						
						'pm_ch2'=>$this->input->post('pm_desc2'),

						'pm_ch_id'=>$this->input->post('pm_ch_id'),
						
						'pm_choreo_name'=>$this->input->post('pm_choreo_name'),
						
						'pm_choreo_email'=>$this->input->post('pm_choreo_email'),
						
						'pm_choreo_phone'=>$this->input->post('pm_choreo_phone'),
						
						

						'pm_created_date'=>$this->input->post('pm_created_date'),

						'pm_created_by'=>$this->input->post('pm_created_by'),
						
						'pm_modified_date'=>$this->input->post('pm_modified_date'),

						'pm_modified_by'=>$this->input->post('pm_modified_by')

						);

					

					$result=$this->dbprogram->edit($data,$id);
					
					$this->dbprogram->delete_pm_to_participant($id);

					$pm_name = $_POST['pm_name'];
					
						
						$pm_age = $_POST['pm_age'];
						
						
						
						for($b=0; $b < count($pm_name); $b++)

							{					

								$dataB=array(

								'pm_id'=>$id,

								'pm_member_name'=>$pm_name[$b],
								
								'pm_age'=>$pm_age[$b]

								);

								$resultB=$this->dbprogram->insert_pm_to_participant($dataB);

							}

					
					

					$this->session->set_flashdata('message_type', 'success');

					$this->session->set_flashdata('status_', $this->lang->line('misc_success_updated'));

					redirect(base_url().'admincp_convention_texas/program');

				

		}

	

	

		$data['title']="Edit Program";

		$this->load->view('admincp_convention_texas/program/edit',$data);

	}
	
	
	public function add()
	{
		
		$this->form_validation->set_rules('pm_mm_id', 'Member Name', 'required');
		
		$this->form_validation->set_rules('pm_type', 'Type' , 'required|trim|xss_clean|callback__alpha_dash_space');

		$this->form_validation->set_rules('pm_length', 'Length', 'required|trim|min_length[5]|xss_clean|callback__alpha_dash_space');

		$this->form_validation->set_rules('pm_desc1', 'Description' , 'required');

		$this->form_validation->set_rules('pm_desc2', 'Description' , 'required');

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

						'pm_mm_id'=>$this->input->post('pm_mm_id'),

						'pm_type'=>$this->input->post('pm_type'),

						'pm_length'=>$this->input->post('pm_length'),
						
						'pm_ch1'=>$this->input->post('pm_desc1'),
						
						'pm_ch2'=>$this->input->post('pm_desc2'),

						'pm_ch_id'=>$this->input->post('pm_ch_id'),
						
						'pm_choreo_name'=>$this->input->post('pm_choreo_name'),
						
						'pm_choreo_email'=>$this->input->post('pm_choreo_email'),
						
						'pm_choreo_phone'=>$this->input->post('pm_choreo_phone'),
						
						

						'pm_created_date'=>$this->input->post('pm_created_date'),

						'pm_created_by'=>$this->input->post('pm_created_by')
						

						);

						

						$result=$this->dbprogram->insert($data);
						
						$inserted_id = $this->db->insert_id();
						
						$pm_name = $_POST['pm_name'];
						
						$pm_age = $_POST['pm_age'];
						
						for($b=0; $b < count($pm_name); $b++)

							{					

								$dataB=array(

								'pm_id'=>$inserted_id,

								'pm_member_name'=>$pm_name[$b],
								
								'pm_age'=>$pm_age[$b]

								);

								$resultB=$this->dbprogram->insert_pm_to_participant($dataB);

							}
								
								
						$this->session->set_flashdata('message_type', 'success');

						$this->session->set_flashdata('status_', $this->lang->line('misc_success_inserted'));

						redirect(base_url().'admincp_convention_texas/program');


	}
		$data['title']="Add Program";
		$this->load->view('admincp_convention_texas/program/add',$data);
	}
	
	

	
	public function delete($id)

	{

		$result=$this->dbprogram->delete($id);
		
		$this->dbprogram->delete_pm_to_participant($id);

		$this->session->set_flashdata('message_type', 'success');

		$this->session->set_flashdata('status_', $this->lang->line('misc_success_deleted'));

		

		redirect(base_url().'admincp_convention_texas/program/view');

	}
	
	
	function ExportToCSV($content,$filename = '', $filedArr = '',$countprograms,$heading)
	{
		
		
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename =''.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	date_default_timezone_set("Asia/Kolkata");
	$string= "";
	
	$string.= "<table id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
		$fp = fopen($filename, 'w');
				
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.="<tr><td colspan='11' align='left'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr><td colspan='13' align='left'>";
				$string.="<font size=4><b>$countprograms</b></font>";
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
	
	function program_export_to_excel()
	{
		
		$search_key = $this->session->userdata('search');
		
		
		
			$num_rec=$this->dbprogram->count_program_export_to_excel($search_key);
		
			$program_deatails = $this->dbprogram->get_all_program_export_to_excel($search_key);
			
			$filename = 'Program_list'.date('Y-m-d').'_'.time().'.xls';
			$heading = 'Program list';
			$countprograms = $num_rec.' programs';
		
		$content = '';
		$num = 0;
		$filedArr =array('Member Name','Type','Length','Chapter','Participant Name(Age)','Choreographer Name','Choreographer Email','Choreographer Phone','Confirmed','Created by','Created date','Modified by','Modified date');		
		$content=array();
		
		foreach($program_deatails as $all_programs)
		{
			$get_chapter = $this->dbadminheader->get_chapter($all_programs->pm_ch_id);

			  

			  // $user_ch = $this->dbuser->get_ch_from_state($all_users->mm_state_id);

			   

			  // if($user_ch)

			   //{

			  // 	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   //}
			   
			$member_name = $this->dbprogram->get_member_name($all_programs->pm_mm_id); 
			
			foreach($member_name as $member) 
			{
					$content[$num]['Member Name'] = $member->mm_fname.' '.$member->mm_lname;
			}
			
			$content[$num]['Type'] = $all_programs->pm_type;
			$content[$num]['Length'] = $all_programs->pm_length;
			
			$content[$num]['Chapter'] = $get_chapter->ch_name;
			
			$participant='';
				
				$pm_to_participant = $this->dbprogram->pm_to_participant($all_programs->pm_id);
				
				foreach($pm_to_participant as $allparticipant)
				{
					$participant .=$allparticipant->pm_member_name.'('.$allparticipant->pm_age.'),'.' ';
					
				}
			
			$content[$num]['Participant Name(Age)'] = $participant;
			
			$content[$num]['Choreographer Name'] = $all_programs->pm_choreo_name;
			
			$content[$num]['Choreographer Email'] = $all_programs->pm_choreo_email;
			
			$content[$num]['Choreographer Phone'] = $all_programs->pm_choreo_phone;
			
			
			if($all_programs->pm_confirmed=="1")
			{
				$content[$num]['Confirmed'] = "yes";
			}
			else
			{
				$content[$num]['Confirmed'] = "No";
			}
			
			$content[$num]['Created by'] = $all_programs->pm_created_by;
			
			$content[$num]['Created date'] = $all_programs->pm_created_date;
			
			$content[$num]['Modified by'] = $all_programs->pm_modified_by;
			
			$content[$num]['Modified date'] = $all_programs->pm_modified_date;
		
		$num++;
			
		}
		
		$this->ExportToCSV($content,$filename,$filedArr,$countprograms,$heading);
		
		
	}
	
	
	
	function ExportToCSV_program_detail($content,$filename = '', $filedArr = '',$heading)
	{
		
		
		
	//$filename = __DIR__.'\\excelfile\\'.$filename;
	//$filename =''.$filename;
	$filename =$this->config->item('rootfolderpath').'excel_files/'.$filename;
	date_default_timezone_set("Asia/Kolkata");
	$string= "";
	/*echo "<pre>";
	print_r($filedArr);
	echo "</pre>";
	
	echo "<pre>";
	print_r($content);
	echo "</pre>";
	exit;*/
	
		$fp = fopen($filename, 'w');
				
				//$string.="<tr><td colspan='6' align='center'>";
				//$string.="<font size=5><b>$event_name</b></font>";
				//$string.="</td></tr>";
				$string.= "<table width='600' id='ReportTable' cellpadding='2' cellspacing='2' border='1' bordercolor='#d0d7e5'>";
				$string.="<tr><td colspan='5'>";
				$string.="<font size=4><b>$heading</b></font>";
				$string.="</td><td colspan='2'>";
				$string.="<font size=4><b>".date("Y-m-d H:i:s")."</b></font>";
				$string.="</td></tr>";
				$string.="<tr></tr>";
				
				
				$string.= "<tr>";
				$string.= "<th style='border:none;' colspan='5' align='left'>$filedArr[0]</th>";
				$string.= "</tr>";
				$string.= "<tr>";
				$string.= "<td colspan='5'><center>$content[0]</center></td>";
				$string.= "</tr>";
				$string.= "<tr></tr>";
				
				$string.= "<tr>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[1]</th><th style='border:none;'></th>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[2]</th>";
				$string.= "</tr>";
				$string.= "<tr>";
				$string.= "<td colspan='3'><center>$content[1]</center></td><td style='border:none;'></td>";
				$string.= "<td colspan='3'><center>$content[2]</center></td>";
				$string.= "</tr>";
				$string.= "<tr></tr>";
				
				$string.= "<tr>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[3]</th><th style='border:none;'></th>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[4]</th>";
				$string.= "</tr>";
				$string.= "<tr>";
				$string.= "<td colspan='3'><center>$content[3]</center></td><td style='border:none;'></td>";
				$string.= "<td colspan='3'><center>$content[4]</center></td>";
				$string.= "</tr>";
				$string.= "<tr></tr>";
				
				$string.= "<tr>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[5]</th><th style='border:none;'></th>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[6]</th>";
				$string.= "</tr>";
				$string.= "<tr>";
				$string.= "<td colspan='3'><center>$content[5]</center></td><td style='border:none;'></td>";
				$string.= "<td colspan='3'><center>$content[6]</center></td>";
				$string.= "</tr>";
				$string.= "<tr></tr>";
				
				$string.= "<tr>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[7]</th><th style='border:none;'></th>";
				$string.= "<th style='border:none;' colspan='3' align='left'>$filedArr[8]</th>";
				$string.= "</tr>";
				$string.= "<tr>";
				$string.= "<td colspan='3'><center>$content[7]</center></td><td style='border:none;'></td>";
				$string.= "<td colspan='3'><center>$content[8]</center></td>";
				$string.= "</tr>";
				
				$string.= "<tr></tr>";
				$string.= "<tr><th style='border:none;' colspan='3' align='left'>Participant</th></tr>";
				
				
				$string.= "<td colspan='3' align='left'>$filedArr[9]</th>";
				$string.= "<td colspan='2' align='left'>$filedArr[10]</th>";
				$string.= "</tr>";
				
				
				
				foreach($content[9] as $all_participant_name)
				{
						for($i=0;$i<count($all_participant_name);$i++)
						{
							$string.= "<tr>";
							$string.= "<td colspan='3'>$all_participant_name[$i]</td>";
				
							foreach($content[10] as $all_participant_age)
							{
							$string.= "<td colspan='2'>$all_participant_age[$i]</td>";
							
							}
							$string.= "</tr>";
						}
					
				}
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
	
	
	function program_detail_export_to_excel()
	{
		
		//$search_key = $this->session->userdata('search');
		
		$id = $this->uri->segment(4);
		
			//$num_rec=$this->dbprogram->count_program_export_to_excel($search_key);
		
			$program_deatails = $this->dbprogram->get_program_detail_export_to_excel($id);
			
			$filename = 'Program_detail'.date('Y-m-d').'_'.time().'.xls';
			$heading = 'Program Detail';
			//$countprograms = $num_rec.' programs';
		
		$content = '';
		$num = 0;
		$filedArr =array('Member Name','Type','Length','Description1','Description2','Choreographer Name','Choreographer Email','Choreographer Phone','Confirmed','Name of Participant','Age');		
		$content=array();
		foreach($program_deatails as $all_programs)
		{
			//$get_chapter = $this->dbadminheader->get_chapter($all_programs->pm_ch_id);

			  

			  // $user_ch = $this->dbuser->get_ch_from_state($all_users->mm_state_id);

			   

			  // if($user_ch)

			   //{

			  // 	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   //}
			   
			$member_name = $this->dbprogram->get_member_name($all_programs->pm_mm_id); 
			
			foreach($member_name as $member) 
			{
					$member_name = $member->mm_fname.' '.$member->mm_lname;
			}
			
			$type = $all_programs->pm_type;
			$length = $all_programs->pm_length;
			
			//$content[$num]['Chapter'] = $get_chapter->ch_name;
			
			
			$description1 = $all_programs->pm_ch1;
			
			$description2 = $all_programs->pm_ch2;
			
			$choreo_name = $all_programs->pm_choreo_name;
			
			$choreo_email = $all_programs->pm_choreo_email;
			
			$choreo_phone = $all_programs->pm_choreo_phone;
			
			
			if($all_programs->pm_confirmed=="1")
			{
				$confirmed = "yes";
			}
			else
			{
				$confirmed = "No";
			}
			
			$participant_name=array();
			$participant_age=array();
				
				$pm_to_participant = $this->dbprogram->pm_to_participant($all_programs->pm_id);
				
				foreach($pm_to_participant as $allparticipant)
				{
					array_push($participant_name,$allparticipant->pm_member_name);
					array_push($participant_age,$allparticipant->pm_age);
					
				}
			
			
		array_push($content,$member_name,$type,$length,$description1,$description2,$choreo_name,$choreo_email,$choreo_phone,$confirmed,array($participant_name),array($participant_age));
		
			
		}
		
		
		$this->ExportToCSV_program_detail($content,$filename,$filedArr,$heading);
		
		
	}

	function alpha_dash_space($str)
	{
	 	return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
	}

}

?>