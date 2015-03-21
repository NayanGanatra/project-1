<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		

		$this->load->helper(array('form', 'url', 'html','string'));

		$this->load->library('form_validation');
		
		$this->load->library('session');

		$this->load->helper('text');

		$this->load->model('youth_milan/dbyouthmilan');
		
		//updated by ketan 20130924
		$this->load->model('youth_milan/dbyouthmilan_header');

		$login = $this->session->userdata('id');
		
		
		if($login=='')
		{
			//$this->session->set_userdata('ref_url',base_url()."youth_milan/registration/view");	
			$this->session->set_flashdata('message_type', 'info');

			$this->session->set_flashdata('status_', 'Please login to access Youthmilan!!!');
			redirect(base_url().'user/login/youthmilan');
		}
		
		//update end

	}

	

	/*public function index()

	{

		$this->view();

	}*/

	public function view()
	
	{
		//added by dharati 201309301835
		$file_size_error=FALSE;
					
		$data['file_size_error']=FALSE;
		//end
		
		if($this->uri->segment(4) != NULL && $this->uri->segment(4) != '')
		{
			
			$id = $this->uri->segment(4);
			
		}
		else
		{
			$id = $this->session->userdata('id');
			
			$data['family_member'] = $this->dbyouthmilan->get_family_member($id);
		} 
		
		
		
		if(isset($_POST['ym_update1']))
		{
	
			$this->form_validation->set_rules('ym_name', 'Name' , 'required');
			
			$this->form_validation->set_rules('ym_gender', 'Gender' , 'required');
			
			$this->form_validation->set_rules('ym_marital_status', 'Marital Status' , 'required');
			
			$this->form_validation->set_rules('ym_children', 'Having Children' , 'required');
			
			$this->form_validation->set_rules('ym_height', 'Height' , 'required');
			
			$this->form_validation->set_rules('ym_physical_status', 'Physical Status' , 'required');
			
		
			if ($this->form_validation->run() == FALSE)

			{

				

			}

			else

			{
				
				$data=array(

						'ym_name'=>$this->input->post('ym_name'),

						'ym_gender'=>$this->input->post('ym_gender'),
						
						'ym_marital_status'=>$this->input->post('ym_marital_status'),
						
						'ym_children'=>$this->input->post('ym_children'),
						
						'ym_height'=>$this->input->post('ym_height'),
						
						'ym_weight'=>$this->input->post('ym_weight'),
						
						'ym_body_type'=>$this->input->post('ym_body_type'),
						
						'ym_complexion'=>$this->input->post('ym_complexion'),
						
						'ym_physical_status'=>$this->input->post('ym_physical_status'),
						
						'ym_blood_group'=>$this->input->post('ym_blood_group'));
						
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_name'=>$this->input->post('ym_name'),

						'ym_gender'=>$this->input->post('ym_gender'),
						
						'ym_marital_status'=>$this->input->post('ym_marital_status'),
						
						'ym_children'=>$this->input->post('ym_children'),
						
						'ym_height'=>$this->input->post('ym_height'),
						
						'ym_weight'=>$this->input->post('ym_weight'),
						
						'ym_body_type'=>$this->input->post('ym_body_type'),
						
						'ym_complexion'=>$this->input->post('ym_complexion'),
						
						'ym_physical_status'=>$this->input->post('ym_physical_status'),
						
						'ym_blood_group'=>$this->input->post('ym_blood_group'),
						
						'ym_status'=>'1');//added by dharati 201310091125
						
				
				$check_id1=$this->dbyouthmilan->check_exists_id1($id);
				
				if(sizeof($check_id1)==0)
				{
							
					$result=$this->dbyouthmilan->insert1($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update1($data,$id);
					
				}
						
				//$this->session->set_flashdata('tab_msg','tab1');
				
				$this->session->set_userdata('tab_msg1','Profile successfully updated');
			
			}
		
			//$data['query'] = $this->dbyouthmilan->get_detail();
		
		
		}
		
		
		if(isset($_POST['ym_update2']))
		{
	
			$this->form_validation->set_rules('ym_mother_tongue', 'Mother Tongue' , 'required');
			
			$this->form_validation->set_rules('ym_community', 'Religion' , 'required');
			
			$this->form_validation->set_rules('ym_caste', 'Caste' , 'required');
			
		
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
				$data=array(

						'ym_mother_tongue'=>$this->input->post('ym_mother_tongue'),

						'ym_community'=>$this->input->post('ym_community'),
						
						'ym_caste'=>$this->input->post('ym_caste'),
						
						'ym_sub_caste'=>$this->input->post('ym_sub_caste'),
						
						'ym_gothram'=>$this->input->post('ym_gothram'));
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_mother_tongue'=>$this->input->post('ym_mother_tongue'),

						'ym_community'=>$this->input->post('ym_community'),
						
						'ym_caste'=>$this->input->post('ym_caste'),
						
						'ym_sub_caste'=>$this->input->post('ym_sub_caste'),
						
						'ym_gothram'=>$this->input->post('ym_gothram'));
						
						
				$check_id2=$this->dbyouthmilan->check_exists_id2($id);
				
				if(sizeof($check_id2)==0)
				{
							
					$result=$this->dbyouthmilan->insert2($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update2($data,$id);
					
				}
				
				//$this->session->set_flashdata('tab_msg','tab2');	
				
				$this->session->set_userdata('tab_msg2','Profile successfully updated');	
			
			}
		
			//$data['query'] = $this->dbyouthmilan->get_detail();
		
		
		}
		
		
		if(isset($_POST['ym_update3']))
		{
	
			$this->form_validation->set_rules('ym_age', 'Age' , 'required|numeric|max_length[2]');
			
			$this->form_validation->set_rules('ym_manglik', 'Manglik' , 'required');
			
			
		
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
			
				$hour=$this->input->post('ym_hour');
				
				$ampm=$this->input->post('ym_am_pm');
				
				$minute=$this->input->post('ym_minute');
				
				if($hour!="" && $minute!="" && $ampm!="")
				{
					$time=$hour.":".$minute." ".$ampm;
				}
				else
				{
					$time="";
				}
					
				
				$data=array(

						'ym_age'=>$this->input->post('ym_age'),

						'ym_birth_date'=>$this->input->post('ym_birth_date'),
						
						'ym_birth_time'=>$time,
						
						'ym_birth_place'=>$this->input->post('ym_birth_place'),
						
						'ym_nakshatra'=>$this->input->post('ym_nakshatra'),
						
						'ym_raasi'=>$this->input->post('ym_raasi'),
						
						'ym_manglik'=>$this->input->post('ym_manglik'));
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_age'=>$this->input->post('ym_age'),

						'ym_birth_date'=>$this->input->post('ym_birth_date'),
						
						'ym_birth_time'=>$time,
						
						'ym_birth_place'=>$this->input->post('ym_birth_place'),
						
						'ym_nakshatra'=>$this->input->post('ym_nakshatra'),
						
						'ym_raasi'=>$this->input->post('ym_raasi'),
						
						'ym_manglik'=>$this->input->post('ym_manglik'));
						
						
				$check_id3=$this->dbyouthmilan->check_exists_id3($id);
				
				if(sizeof($check_id3)==0)
				{
							
					$result=$this->dbyouthmilan->insert3($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update3($data,$id);
					
				}
				
				//$this->session->set_flashdata('tab_msg','tab3');	
				
				$this->session->set_userdata('tab_msg3','Profile successfully updated');
			
			}
		
			//$data['query'] = $this->dbyouthmilan->get_detail();
		
		
		}
	
		if(isset($_POST['ym_update4']))
		{
	
			$this->form_validation->set_rules('ym_degree_level', 'Degree Level' , 'required');
			
			$this->form_validation->set_rules('ym_study_area', 'Study Area' , 'required');
			
			$this->form_validation->set_rules('ym_occupation', 'Occupation' , 'required');
			
			//added by dharati 201309251510
			
			$this->form_validation->set_rules('ym_annual_income', 'Annual Income' , 'numeric');
			
			//end
						
		
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
				
				$data=array(

						'ym_degree_level'=>$this->input->post('ym_degree_level'),

						'ym_study_area'=>$this->input->post('ym_study_area'),
						
						'ym_education_detail'=>$this->input->post('ym_education_detail'),
						
						'ym_occupation'=>$this->input->post('ym_occupation'),
						
						'ym_occupation_detail'=>$this->input->post('ym_occupation_detail'),
						
						'ym_annual_income'=>$this->input->post('ym_annual_income'));
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_degree_level'=>$this->input->post('ym_degree_level'),

						'ym_study_area'=>$this->input->post('ym_study_area'),
						
						'ym_education_detail'=>$this->input->post('ym_education_detail'),
						
						'ym_occupation'=>$this->input->post('ym_occupation'),
						
						'ym_occupation_detail'=>$this->input->post('ym_occupation_detail'),
						
						'ym_annual_income'=>$this->input->post('ym_annual_income'));
						
						
				$check_id4=$this->dbyouthmilan->check_exists_id4($id);
				
				if(sizeof($check_id4)==0)
				{
							
					$result=$this->dbyouthmilan->insert4($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update4($data,$id);
					
				}		
				
				//$this->session->set_flashdata('tab_msg','tab4');
				
				$this->session->set_userdata('tab_msg4','Profile successfully updated');
			
			}
		
			//$data['query'] = $this->dbyouthmilan->get_detail();
		
		
		}
		
		if(isset($_POST['ym_update5']))
		{
		
			$this->form_validation->set_rules('ym_diet_preferences', 'Diet Preferences' , 'required');
			
			$this->form_validation->set_rules('ym_smoking', 'Smoking' , 'required');
			
			$this->form_validation->set_rules('ym_drinking', 'Drinking' , 'required');
			
			
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
				
				$data=array(

						'ym_diet_preferences'=>$this->input->post('ym_diet_preferences'),

						'ym_smoking'=>$this->input->post('ym_smoking'),
						
						'ym_drinking'=>$this->input->post('ym_drinking'));
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_diet_preferences'=>$this->input->post('ym_diet_preferences'),

						'ym_smoking'=>$this->input->post('ym_smoking'),
						
						'ym_drinking'=>$this->input->post('ym_drinking'));
						
						
						
				$check_id5=$this->dbyouthmilan->check_exists_id5($id);
				
				if(sizeof($check_id5)==0)
				{
							
					$result=$this->dbyouthmilan->insert5($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update5($data,$id);
					
				}		
				
				//$this->session->set_flashdata('tab_msg','tab5');
				
				$this->session->set_userdata('tab_msg5','Profile successfully updated');
			
			}
			
		}
		
		if(isset($_POST['ym_update6']))
		{
			
			$this->form_validation->set_rules('ym_citizen_country', 'Country' , 'required');
			
			$this->form_validation->set_rules('ym_citizen_state', 'State' , 'required');
			
			$this->form_validation->set_rules('ym_citizen_city', 'City' , 'required');
			
			$this->form_validation->set_rules('ym_living_country', 'Country' , 'required');
			
			$this->form_validation->set_rules('ym_living_state', 'State' , 'required');
			
			$this->form_validation->set_rules('ym_living_city', 'City' , 'required');
			
			$this->form_validation->set_rules('ym_living_status', 'Living Status' , 'required');
			
			//added by dharati 201309251500
			
			$this->form_validation->set_rules('ym_email', 'Email' , 'valid_email');
			
			//end
			
			$this->form_validation->set_rules('ym_phone', 'Contact Phone Number' , 'numeric');
			
			
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
				
				$data=array(

						'ym_citizen_country'=>$this->input->post('ym_citizen_country'),

						'ym_citizen_state'=>$this->input->post('ym_citizen_state'),
						
						'ym_citizen_city'=>$this->input->post('ym_citizen_city'),
						
						'ym_living_country'=>$this->input->post('ym_living_country'),
						
						'ym_living_state'=>$this->input->post('ym_living_state'),
						
						'ym_living_city'=>$this->input->post('ym_living_city'),
						
						'ym_living_status'=>$this->input->post('ym_living_status'),
						
						'ym_address'=>$this->input->post('ym_address'),
						
						'ym_phone'=>$this->input->post('ym_phone'),
						
						'ym_email'=>$this->input->post('ym_email'));
						
				$data_in=array(
				
						'ym_id'=>$id,

						'ym_citizen_country'=>$this->input->post('ym_citizen_country'),

						'ym_citizen_state'=>$this->input->post('ym_citizen_state'),
						
						'ym_citizen_city'=>$this->input->post('ym_citizen_city'),
						
						'ym_living_country'=>$this->input->post('ym_living_country'),
						
						'ym_living_state'=>$this->input->post('ym_living_state'),
						
						'ym_living_city'=>$this->input->post('ym_living_city'),
						
						'ym_living_status'=>$this->input->post('ym_living_status'),
						
						'ym_address'=>$this->input->post('ym_address'),
						
						'ym_phone'=>$this->input->post('ym_phone'),
						
						'ym_email'=>$this->input->post('ym_email'));
						
						
				$check_id6=$this->dbyouthmilan->check_exists_id6($id);
				
				if(sizeof($check_id6)==0)
				{
							
					$result=$this->dbyouthmilan->insert6($data_in);
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update6($data,$id);
					
				}		
				
				//$this->session->set_flashdata('tab_msg','tab6');
				
				$this->session->set_userdata('tab_msg6','Profile successfully updated');
				
			}
			
		}
/*************************************update_monita(20131015)**************************************************/		
		if(isset($_POST['ym_update7']))
		{
							
							
			$config['upload_path'] = './images/youth_milan/profile';
				
			$config['allowed_types'] = 'gif|jpg|png';
			
			//$config['max_size']= '100';
		
			$this->load->library('upload', $config);
			
			// $this->load->library('image_lib');
	
							
			//$this->upload->do_upload('ym_photo');
				
			//added by dharati 201309261715
				
			 foreach($_FILES['ym_photo'] as $key=>$val)
	        {
	           	$i = 1;
					
	           	foreach($val as $v)
	            {
				
	               	$field_name = "file_".$i;
					
	               	$_FILES[$field_name][$key] = $v;
						
	               	$i++; 
						
	            }
	        }
				
			unset($_FILES['ym_photo']);
			
			foreach($_FILES as $field_name => $file)
			{
				if($_FILES[$field_name]['size']>=1000000)
				{
					$file_size_error=TRUE;
					
					$data['file_size_error']=TRUE;
				}
				else if(!$file_size_error)
				{
					$file_size_error=FALSE;
					
					$data['file_size_error']=FALSE;
				}
			}
				
			if(!$file_size_error)
			{
				
				foreach($_FILES as $field_name => $file)
		       	{
					
					
			          	if ( ! $this->upload->do_upload($field_name))
			            {
			                // if upload fail, grab error 
			                $error['upload'][] = $this->upload->display_errors();
			            }
			           	else
			           	{
			               	// otherwise, put the upload datas here.
			               	// if you want to use database, put insert query in this loop
							
							/*$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] = true;
							$config['width'] = 600;
							$config['height'] =450;
					
							$this->load->library('image_lib', $config);*/
							
							$upload_data = $this->upload->data();
                
			                // set the resize config
							   $this->load->library("image_moo");
							   
					            $this->image_moo

					           ->load($this->config->item('rootfolderpath')."/images/youth_milan/profile/".$this->upload->file_name)

				            	->resize(600,450)

					           ->save($this->config->item('rootfolderpath')."/images/youth_milan/profile/big/".$this->upload->file_name,$overwrite=TRUE);
							   
							   
							     $this->image_moo

				            	->load($this->config->item('rootfolderpath')."/images/youth_milan/profile/".$this->upload->file_name)

					          // ->resize(175,163)
							  //->resize_crop(175,163)
							  	->resize(175,163)

					            ->save($this->config->item('rootfolderpath')."/images/youth_milan/profile/thumbs/".$this->upload->file_name,$overwrite=TRUE);
			                $resize_conf = array(
			                  /*  // it's something like "/full/path/to/the/image.jpg" maybe
			                    'source_image'  => $this->upload->upload_path.$this->upload->file_name, 
			                    // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
			                    // or you can use 'create_thumbs' => true option instea
			                    'width'         => 600,
			                    'height'        => 450*/
			                    );
			
			                // initializing
			              //  $this->image_lib->initialize($resize_conf);
					
							/*if ( ! $this->image_lib->resize()){
								//$this->session->set_flashdata('message', $this->image_lib->display_errors('', ''));
							}*/
							/***********************End of update_monita(20131015)****************************/	
							if($this->image_moo->errors) 
								{
									
								   print $this->image_moo->display_errors();
					            
			                    }
							   
					    unlink($this->config->item('rootfolderpath')."/images/youth_milan/profile/".$this->upload->file_name);	
							
							$data2_in=array(
		
									'ym_photo'=>$this->upload->file_name,
									
									'ym_id'=>$id);
								
							$result2=$this->dbyouthmilan->insert7_2($data2_in);	
								
			               	$upload_data = $this->upload->data();
			                
			               
			         	}
					
				}
			}
			//added by dharati 201309281530
			
			$check_id7_2=$this->dbyouthmilan->check_exists_id7_2($id);
						
			if(sizeof($check_id7_2)==0)
			{
				
				$data2_in=array(

							'ym_photo'=>'',
							
							'ym_id'=>$id);
						
					$result2=$this->dbyouthmilan->insert7_2($data2_in);	
				
			}	
			else
			{
				$result_del=$this->dbyouthmilan->delete_no_photo($id);	
			}
			
			//end		
			
			//updated by dharati 201309301830
			
			if(!$file_size_error)
        	{        	
				$data1=array(

						'ym_brief_about_self'=>$this->input->post('ym_brief_about_self'));
						
				$data1_in=array(
				
							'ym_id'=>$id,
	
							'ym_brief_about_self'=>$this->input->post('ym_brief_about_self'));
							
				
				//updated by dharati 201309251835//
				
				$check_id7_1=$this->dbyouthmilan->check_exists_id7_1($id);
					
				if(sizeof($check_id7_1)==0)
				{ 
								
					$result1=$this->dbyouthmilan->insert7_1($data1_in);
								
				}
				else
				{
								
					$result1=$this->dbyouthmilan->update7_1($data1,$id);
						
				}	
				//end 201309261715	
			
				$this->session->set_userdata('tab_msg7','Profile successfully updated');
				
			}
			
			//end
		

			
		}
		
		if(isset($_POST['ym_update8']))
		{
			
				$data=array(
										
						'ym_status'=>$this->input->post('ym_status'));
						
				
				$check_id1=$this->dbyouthmilan->check_exists_id1($id);
				
				if(sizeof($check_id1)==0)
				{
					$this->session->set_userdata('tab_msg8_error',"Please, insert Basic Information.");
							
				}
				else
				{
							
					$result=$this->dbyouthmilan->update1($data,$id);
					
					if($this->input->post('ym_status')==1)
					{
						$this->session->set_userdata('tab_msg8','Profile successfully activated.');
					}
					else
					{
						$this->session->set_userdata('tab_msg8','Profile successfully Inactivated.');
					}
						
				}		
				
				//$this->session->set_flashdata('tab_msg','tab5');
				
		}
		
		/*if(isset($_POST['ym_update8']))
		{
			
			$this->form_validation->set_rules('ym_login_id', 'Login Id' , 'required');
			
			if($this->input->post('ym_password')!="")
			{
			
				$this->form_validation->set_rules('ym_password', 'Password' , 'callback_password_check');
			
				$this->form_validation->set_rules('ym_new_password', 'New Password' , 'required');
				
				$this->form_validation->set_rules('ym_confirm_new_password', 'Confirm New Password' , 'required|matches[ym_new_password]');
				
			}
			
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else

			{
				if($this->input->post('ym_password')!="")
				{
				
					$data=array(
	
							'mm_username'=>$this->input->post('ym_login_id'),
							
							'mm_password'=>md5($this->input->post('ym_new_password')));
				}
				else
				{
					$data=array(
	
							'mm_username'=>$this->input->post('ym_login_id'));
					
				}
							
				$result=$this->dbyouthmilan->update8($data,$id);	
				
				$this->session->set_userdata('tab_msg8','Profile successfully updated');
			}
			
		}*/
		
		//id exits or not for tab1
		
		$check_id1=$this->dbyouthmilan->check_exists_id1($id);
		
		if(sizeof($check_id1)==0)
		{
					
			$data['check1']=true;
					
		}
		else
		{
					
			$data['check1']=false;
						
		}
		
		$data['query1'] = $check_id1;
		
		
		//id exits or not for tab2
		
		$check_id2=$this->dbyouthmilan->check_exists_id2($id);
		
		if(sizeof($check_id2)==0)
		{
					
			$data['check2']=true;
					
		}
		else
		{
					
			$data['check2']=false;
			
			
		}
		
		$data['query2'] = $check_id2;
		
		
		//id exits or not for tab3
		
		$check_id3=$this->dbyouthmilan->check_exists_id3($id);
		
		if(sizeof($check_id3)==0)
		{
					
			$data['check3']=true;
					
		}
		else
		{
					
			$data['check3']=false;
			
			
		}
		
		$data['query3'] = $check_id3;
		
		
		//id exits or not for tab4
		
		$check_id4=$this->dbyouthmilan->check_exists_id4($id);
		
		if(sizeof($check_id4)==0)
		{
					
			$data['check4']=true;
					
		}
		else
		{
					
			$data['check4']=false;
			
			
		}
		
		$data['query4'] = $check_id4;
		
		
		//id exits or not for tab5
		
		$check_id5=$this->dbyouthmilan->check_exists_id5($id);
		
		if(sizeof($check_id5)==0)
		{
					
			$data['check5']=true;
					
		}
		else
		{
					
			$data['check5']=false;
			
			
		}
		
		$data['query5'] = $check_id5;
		
		
		//id exits or not for tab6
		
		$check_id6=$this->dbyouthmilan->check_exists_id6($id);
		
		if(sizeof($check_id6)==0)
		{
					
			$data['check6']=true;
					
		}
		else
		{
					
			$data['check6']=false;
			
			
		}
		
		$data['query6'] = $check_id6;
		
		
		//id exits or not for tab7
		
		$check_id7_1=$this->dbyouthmilan->check_exists_id7_1($id);
		
		if(sizeof($check_id7_1)==0)
		{
					
			$data['check7']=true;
					
		}
		else
		{
					
			$data['check7']=false;
			
			
		}
		
		$data['query7'] = $check_id7_1;
		
		//added by dharati 201310091400
		if(!$file_size_error)
		{
			$file_size_error=FALSE;
					
			$data['file_size_error']=FALSE;
		}
		//end
		
		//get data for tab8
		
		$check_id8=$this->dbyouthmilan->check_exists_id8($id);
		
		$data['query8'] = $check_id8;
		
		
	
		//$data['query'] = $this->dbyouthmilan->get_detail($id);
	
		$data['title']="Youth Milan - Registration";

		$this->load->view('youth_milan/registration/registration',$data);

	}
	
	function password_check($password)
	{
		//$pid=$this->uri->segment(4);
		
		$result=$this->dbyouthmilan->get_old_password($this->session->userdata('id'));
		
		$dbpassword=$result->mm_password;
		
		$txtpassword=md5($password);
		
		if($dbpassword!=$txtpassword)
		{
					
			$this->form_validation->set_message('password_check', 'please,enter the correct password.');
			
			return FALSE;
		}
		else
		{
			return TRUE;
			
		}
		
		
	}
	
	
	//search profile
	
	/*function search()
	{
	
		$id = $this->session->userdata('id');
		
		if($id!="")
		{
			
			redirect(''.base_url().'youth_milan/login');
			
		}
		
		$data['flag']=FALSE;
	
		if(isset($_POST["ym_search_btn"]))
		{
		
			$this->form_validation->set_rules('ym_search', 'Search' , 'required');
			
			if ($this->form_validation->run() == FALSE)

			{

		

			}

			else
			{
				
				$search=$this->input->post('ym_search');
				
				$data['flag']=TRUE;
				
				$data['search']=$this->dbyouthmilan->get_search_profile($search);
				
			}

			
		}
		
		$data['title']="Youth Milan - Search Profile";
		
		$this->load->view('youth_milan/search_profile',$data);
		
		
	}*/
	
	public function more_detail()
	{
		if ($this->uri->segment(4) == "")
		{
			redirect(base_url().'youth_milan/registration/search');
		}
		else
		{
			$id = $this->uri->segment(4);
		}
		// updated by dharati 201310011130
		$query1=$this->dbyouthmilan->check_exists_id1($id);
		
		$query2=$this->dbyouthmilan->check_exists_id2($id);
		
		$query3=$this->dbyouthmilan->check_exists_id3($id);
		
		$query4=$this->dbyouthmilan->check_exists_id4($id);
		
		$query5=$this->dbyouthmilan->check_exists_id5($id);
		
		$query6=$this->dbyouthmilan->check_exists_id6($id);
		
		$query7_1=$this->dbyouthmilan->check_exists_id7_1($id);
		
		$query7_2=$this->dbyouthmilan->get_all_photo($id);		
		
		$query8=$this->dbyouthmilan->check_exists_id8($id);
	
	
		if(!$query1 && !$query2 && !$query3 && !$query4 && !$query5 && !$query6 && !$query7_1 && !$query7_2)
		{
			redirect(base_url().'youth_milan/registration/search');
		}		
		
		
		$data['query1']=$query1;
		
		$data['query2']=$query2;
		
		$data['query3']=$query3;
		
		$data['query4']=$query4;
		
		$data['query5']=$query5;
		
		$data['query6']=$query6;
		
		$data['query7_1']=$query7_1;
		
		//updated by dharati 201309271800
		$data['query7_2']=$query7_2;
		//end
		
		//added by dharati 201309261715
		
		$data['query8']=$query8;
		
		//end
		
		//end 201301101130
		$data['title']="Youth Milan - More detail";
		
		$this->load->view('youth_milan/more_detail',$data);
	}
	//added by ketan 201310021200
	public function search()
	{
		/*if ($this->uri->segment(4) == "")
		{
			$this->session->set_userdata('rdcriteria','');
			$this->session->set_userdata('search_name','');
			$this->session->set_userdata('ym_gender','');
			$this->session->set_userdata('ym_marital_status','');
			$this->session->set_userdata('ym_body_type','');
			$this->session->set_userdata('ym_height','');
			$this->session->set_userdata('ym_weight','');
			$this->session->set_userdata('ym_community','');
			$this->session->set_userdata('ym_caste','');
			$this->session->set_userdata('ym_sub_caste','');
		}*/
		if(isset($_POST['rdcriteria']))
		{
			$rdcriteria = $_POST['rdcriteria'];
			$data['rdcriteria'] = $_POST['rdcriteria'];
			$this->session->set_userdata('rdcriteria',$_POST['rdcriteria']);
		}
		else
		{
			if($this->session->userdata('rdcriteria'))
			{
				$rdcriteria = $this->session->userdata('rdcriteria');
				$data['rdcriteria'] = $this->session->userdata('rdcriteria');
			}
			else
			{
				$rdcriteria = 'allcriteria';
				$data['rdcriteria'] = 'allcriteria';
			}
			
		}
		if(isset($_POST['ym_search']))
		{
			$search_name = $_POST['ym_search'];
			$data['search_name'] = $_POST['ym_search'];
			$this->session->set_userdata('search_name',$_POST['ym_search']);
		}
		else
		{
			if($this->session->userdata('search_name'))
			{
				$search_name = $this->session->userdata('search_name');
				$data['search_name'] = $this->session->userdata('search_name');
			}
			else
			{
				$search_name = '';
				$data['search_name'] = '';
			}
			
		}
		if(isset($_POST['ym_gender']))
		{
			$ym_gender = $_POST['ym_gender'];
			$data['ym_gender'] = $_POST['ym_gender'];
			$this->session->set_userdata('ym_gender',$_POST['ym_gender']);
		}
		else
		{
			if($this->session->userdata('ym_gender'))
			{
				$ym_gender = $this->session->userdata('ym_gender');
				$data['ym_gender'] = $this->session->userdata('ym_gender');
			}
			else
			{
				$ym_gender = '';
				$data['ym_gender'] = '';
			}
			
		}
		if(isset($_POST['ym_marital_status']))
		{
			$ym_marital_status = $_POST['ym_marital_status'];
			$data['ym_marital_status'] = $_POST['ym_marital_status'];
			$this->session->set_userdata('ym_marital_status',$_POST['ym_marital_status']);
		}
		else
		{
			if($this->session->userdata('ym_marital_status'))
			{
				$ym_marital_status = $this->session->userdata('ym_marital_status');
				$data['ym_marital_status'] = $this->session->userdata('ym_marital_status');
			}
			else
			{
				$ym_marital_status = '';
				$data['ym_marital_status'] = '';
			}
			
		}
		if(isset($_POST['ym_body_type']))
		{
			$ym_body_type = $_POST['ym_body_type'];
			$data['ym_body_type'] = $_POST['ym_body_type'];
			$this->session->set_userdata('ym_body_type',$_POST['ym_body_type']);
		}
		else
		{
			if($this->session->userdata('ym_body_type'))
			{
				$ym_body_type = $this->session->userdata('ym_body_type');
				$data['ym_body_type'] = $this->session->userdata('ym_body_type');
			}
			else
			{
				$ym_body_type = '';
				$data['ym_body_type'] = '';
			}
			
		}
		if(isset($_POST['ym_height_start']))
		{
			$ym_height_start = $_POST['ym_height_start'];
			$data['ym_height_start'] = $_POST['ym_height_start'];
			$this->session->set_userdata('ym_height_start',$_POST['ym_height_start']);
		}
		else
		{
			if($this->session->userdata('ym_height_start'))
			{
				$ym_height_start = $this->session->userdata('ym_height_start');
				$data['ym_height_start'] = $this->session->userdata('ym_height_start');
			}
			else
			{
				$ym_height_start = '';
				$data['ym_height_start'] = '';
			}
			
		}
		if(isset($_POST['ym_height_end']))
		{
			$ym_height_end = $_POST['ym_height_end'];
			$data['ym_height_end'] = $_POST['ym_height_end'];
			$this->session->set_userdata('ym_height_end',$_POST['ym_height_end']);
		}
		else
		{
			if($this->session->userdata('ym_height_end'))
			{
				$ym_height_end = $this->session->userdata('ym_height_end');
				$data['ym_height_end'] = $this->session->userdata('ym_height_end');
			}
			else
			{
				$ym_height_end = '';
				$data['ym_height_end'] = '';
			}
			
		}
		if(isset($_POST['ym_age_start']))
		{
			$ym_age_start = $_POST['ym_age_start'];
			$data['ym_age_start'] = $_POST['ym_age_start'];
			$this->session->set_userdata('ym_age_start',$_POST['ym_age_start']);
		}
		else
		{
			if($this->session->userdata('ym_age_start'))
			{
				$ym_age_start = $this->session->userdata('ym_age_start');
				$data['ym_age_start'] = $this->session->userdata('ym_age_start');
			}
			else
			{
				$ym_age_start = '';
				$data['ym_age_start'] = '';
			}
			
		}
		if(isset($_POST['ym_age_end']))
		{
			$ym_age_end = $_POST['ym_age_end'];
			$data['ym_age_end'] = $_POST['ym_age_end'];
			$this->session->set_userdata('ym_age_end',$_POST['ym_age_end']);
		}
		else
		{
			if($this->session->userdata('ym_age_end'))
			{
				$ym_age_end = $this->session->userdata('ym_age_end');
				$data['ym_age_end'] = $this->session->userdata('ym_age_end');
			}
			else
			{
				$ym_age_end = '';
				$data['ym_age_end'] = '';
			}
			
		}
		if(isset($_POST['ym_weight_start']))
		{
			$ym_weight_start = $_POST['ym_weight_start'];
			$data['ym_weight_start'] = $_POST['ym_weight_start'];
			$this->session->set_userdata('ym_weight_start',$_POST['ym_weight_start']);
		}
		else
		{
			if($this->session->userdata('ym_weight_start'))
			{
				$ym_weight_start = $this->session->userdata('ym_weight_start');
				$data['ym_weight_start'] = $this->session->userdata('ym_weight_start');
			}
			else
			{
				$ym_weight_start = '';
				$data['ym_weight_start'] = '';
			}
			
		}
		if(isset($_POST['ym_weight_end']))
		{
			$ym_weight_end = $_POST['ym_weight_end'];
			$data['ym_weight_end'] = $_POST['ym_weight_end'];
			$this->session->set_userdata('ym_weight_end',$_POST['ym_weight_end']);
		}
		else
		{
			if($this->session->userdata('ym_weight_end'))
			{
				$ym_weight_end = $this->session->userdata('ym_weight_end');
				$data['ym_weight_end'] = $this->session->userdata('ym_weight_end');
			}
			else
			{
				$ym_weight_end = '';
				$data['ym_weight_end'] = '';
			}
			
		}
		if(isset($_POST['ym_community']))
		{
			$ym_community = $_POST['ym_community'];
			$data['ym_community'] = $_POST['ym_community'];
			$this->session->set_userdata('ym_community',$_POST['ym_community']);
		}
		else
		{
			if($this->session->userdata('ym_community'))
			{
				$ym_community = $this->session->userdata('ym_community');
				$data['ym_community'] = $this->session->userdata('ym_community');
			}
			else
			{
				$ym_community = '';
				$data['ym_community'] = '';
			}
			
		}
		if(isset($_POST['ym_caste']))
		{
			$ym_caste = $_POST['ym_caste'];
			$data['ym_caste'] = $_POST['ym_caste'];
			$this->session->set_userdata('ym_caste',$_POST['ym_caste']);
		}
		else
		{
			if($this->session->userdata('ym_caste'))
			{
				$ym_caste = $this->session->userdata('ym_caste');
				$data['ym_caste'] = $this->session->userdata('ym_caste');
			}
			else
			{
				$ym_caste = '';
				$data['ym_caste'] = '';
			}
			
		}
		if(isset($_POST['ym_sub_caste']))
		{
			$ym_sub_caste = $_POST['ym_sub_caste'];
			$data['ym_sub_caste'] = $_POST['ym_sub_caste'];
			$this->session->set_userdata('ym_sub_caste',$_POST['ym_sub_caste']);
		}
		else
		{
			if($this->session->userdata('ym_sub_caste'))
			{
				$ym_sub_caste = $this->session->userdata('ym_sub_caste');
				$data['ym_sub_caste'] = $this->session->userdata('ym_sub_caste');
			}
			else
			{
				$ym_sub_caste = '';
				$data['ym_sub_caste'] = '';
			}
		}
		if($search_name!='' || $ym_gender!='' || $ym_marital_status!='' || $ym_height_start!='' || $ym_height_end!='' || $ym_weight_start!='' || $ym_weight_end!='' || $ym_body_type!='' || $ym_community!='' || $ym_caste!='' || $ym_sub_caste!='' || $ym_age_start!='' || $ym_age_end!='')
		{
			if($rdcriteria=='allcriteria')
			{
				$num_rec=$this->dbyouthmilan->get_all_data_count_allcriteria($search_name,$ym_gender,$ym_marital_status,$ym_height_start,$ym_height_end,$ym_weight_start,$ym_weight_end,$ym_body_type,$ym_community,$ym_caste,$ym_sub_caste,$ym_age_start,$ym_age_end);
			}
			else
			{
				$num_rec=$this->dbyouthmilan->get_all_data_count_anycriteria($search_name,$ym_gender,$ym_marital_status,$ym_height_start,$ym_height_end,$ym_weight_start,$ym_weight_end,$ym_body_type,$ym_community,$ym_caste,$ym_sub_caste,$ym_age_start,$ym_age_end);
			}
			
		}
		else
		{
			$num_rec=0;
		}
		
		
		
		$this->load->library('pagination');

		$data['tot_rec'] = $num_rec;
		
		
		if($search_name == "")
		{
			$config['base_url'] = base_url().'youth_milan/registration/search';
		}
		else
		{
			$config['base_url'] = base_url().'youth_milan/registration/search';
		}
		
		
		

		$config['total_rows'] = $num_rec;

		$config['per_page'] = 10;

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
		if($search_name!='' || $ym_gender!='' || $ym_marital_status!='' || $ym_height_start!='' || $ym_height_end!='' || $ym_weight_start!='' || $ym_weight_end!='' || $ym_body_type!='' || $ym_community!='' || $ym_caste!='' || $ym_sub_caste!='' || $ym_age_start!='' || $ym_age_end!='')
		{
			if($rdcriteria=='allcriteria')
			{
				$data['search'] = $this->dbyouthmilan->get_all_data_allcriteria($search_name,$ym_gender,$ym_marital_status,$ym_height_start,$ym_height_end,$ym_weight_start,$ym_weight_end,$ym_body_type,$ym_community,$ym_caste,$ym_sub_caste,$ym_age_start,$ym_age_end,$config['per_page'],$segment);
			}
			else
			{
				$data['search'] = $this->dbyouthmilan->get_all_data_anycriteria($search_name,$ym_gender,$ym_marital_status,$ym_height_start,$ym_height_end,$ym_weight_start,$ym_weight_end,$ym_body_type,$ym_community,$ym_caste,$ym_sub_caste,$ym_age_start,$ym_age_end,$config['per_page'],$segment);
			}
		}
		else
		{
			$data['search']=FALSE;
		}
		$this->pagination->initialize($config);

		

		
					
		$data['title']="Youth Milan - Search Profile";
		
		$this->load->view('youth_milan/search_profile',$data);
		

		

	}
	//update end
	//added by dharati 2013096281200
	
	function manage_album()
	{
	
		$id=$this->session->userdata('id');
		
		$photos=$this->dbyouthmilan->get_all_photo($id);
		
		$data['photos']=$photos;
		
		$data['title']="Youth Milan - Manage Album";
		
		$this->load->view('youth_milan/manage_album',$data);
	}
	
	function delete_img()
	{
		$id1=$this->uri->segment(4);
		
		$result=$this->dbyouthmilan->delete_img($id1);
		
		redirect(base_url('youth_milan/registration/manage_album'));
		
		/*$id=$this->session->userdata('id');
		
		$photos=$this->dbyouthmilan->get_all_photo($id);
		
		$data['photos']=$photos;
		
		$data['title']="Youth Milan - Manage Album";
		
		$this->load->view('youth_milan/manage_album',$data);*/
		
	}
	
	//added by dharati 201310011600
	function get_state($country_id,$state_id='')
	{
		$get_state=$this->dbyouthmilan->state($country_id);
		
		$html = '<select style="width:150px;" class="combo" id="ym_citizen_state" name="ym_citizen_state"><option value="">State</option>';
		foreach($get_state as $get_state_row)
		{
			
				if($state_id == $get_state_row->stateid)

			{

				$html .= "<option selected='selected' value='".$get_state_row->stateid."'>".$get_state_row->statename."</option>";

			}
			else
			{

				$html .= "<option value='".$get_state_row->stateid."'>".$get_state_row->statename."</option>";
				
			}
			
		
		}
		$html .= '</select>';
		echo $html;
	}
	
	function get_living_state($country_id,$state_id='')
	{
		$get_state=$this->dbyouthmilan->state($country_id);
		
		$html = '<select style="width:150px;" class="combo" id="ym_living_state" name="ym_living_state"><option value="">State</option>';
		foreach($get_state as $get_state_row)
		{
			
				if($state_id == $get_state_row->stateid)

			{

				$html .= "<option selected='selected' value='".$get_state_row->stateid."'>".$get_state_row->statename."</option>";

			}
			else
			{

				$html .= "<option value='".$get_state_row->stateid."'>".$get_state_row->statename."</option>";
				
			}
			
		
		}
		$html .= '</select>';
		echo $html;
	}
	//end 201310011600
	//added by ketan 201310031830
	function clear()
	{
		$this->session->unset_userdata('search_profile');
		$this->session->unset_userdata('rdcriteria');
		$this->session->unset_userdata('search_name');
		$this->session->unset_userdata('ym_gender');
		$this->session->unset_userdata('ym_marital_status');
		$this->session->unset_userdata('ym_body_type');
		$this->session->unset_userdata('ym_height_start');
		$this->session->unset_userdata('ym_height_end');
		$this->session->unset_userdata('ym_weight_start');
		$this->session->unset_userdata('ym_weight_end');
		//for age
		$this->session->unset_userdata('ym_age_start');
		$this->session->unset_userdata('ym_age_end');
		//end
		$this->session->unset_userdata('ym_community');
		$this->session->unset_userdata('ym_caste');
		$this->session->unset_userdata('ym_sub_caste');
		redirect(base_url().'youth_milan/registration/search');
	}
	//update end
}

?>