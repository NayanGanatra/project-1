<?php

	class Sendverification extends CI_Controller 

	{

    function Sendverification(){

       parent::__construct();

    }

    function index()

	{

		if($_GET['sendthemail']=='true')

		{

		$this->load->model('dbheader');

		$this->load->model('dbverification');

        $this->load->library('email');

        $this->load->library('parser');

		$settings = $this->dbheader->get_setting();

		//$quant = 3;

	

        if($this->dbverification->getQueuedEmail()->num_rows > 0)//2

        {

			$status = $this->dbverification->chk_status('send_verification');
				
			if($status == '1' || $status == 1)
			{
				exit();
				die('No clone process allowed.');
			}
				
			$data = array(
				'mail_info'=>'send_verification'
				);
			$this->dbverification->insert($data);
			
			$this->dbverification->getQueuedEmail()->num_rows;//2

			$emailData = $this->dbverification->getFirstQueuedMailing();//1

           	foreach ($emailData as $emailData)

			{

			 	$emailID = $emailData->uid;

				

				/*Sending */

				$data=array('email_send'=>'1');

				$result=$this->dbverification->edit($data,$emailID);

				/*Sending */		

				$subscribers = $this->dbverification->getBatchEmailSubscribers($emailID);

				$totalSubscribers = $this->dbverification->countEmailSubscribers($emailID);

				$i=0;

				$j=0;
				$test=0;
				foreach ($subscribers as $address)

				{

					$emailData->family='';

					$get_relationship = $this->dbverification->get_relationship($address->mm_id);
					
					if(!$get_relationship)
					{
						$get_relationship = $this->dbverification->get_relationship_sub($address->mm_family_id,$address->mm_id);
						

					}
					$test=sizeof($get_relationship);
					$emailData->family ='<table width="980" border="0" cellspacing="0" cellpadding="0"> 

					  <tr>

					  	<td>
							<div>

							        <h1><b><u>Family Members<u></b><br></h1>

							</div>

					        

							<table  border="1" cellspacing="0" cellpadding="0"  width="auto">

								<thead>

									<tr>

										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Name</th>

										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Username</th>

										<th scope="col" style="text-align:center; width:90px;">Relationship</th>

										<th scope="col" style="text-align:left; padding-left:10px;padding-right:10px;">Email-id</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px;">Date of Birth<br>(MM/YY)</th>

										 <th scope="col" style="text-align:center; width:90px;padding-right:10px;">Edit</th>

										

									</tr>

								</thead>

								<tfoot>

									

								</tfoot> 

								<tbody cellspacing="0" cellpadding="0" >
';
					
					foreach($get_relationship as $get_relationship_row)

					{

					$emailData->family .= '
								<tr>

									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_fname." ".$get_relationship_row->mm_lname.'</td>

									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_username.'</td>

									<td style="text-align:left; padding-left:10px;padding-right:10px;">';

									if($address->mm_relationship == 'Son' || $address->mm_relationship == 'Daughter')

								{

									if($get_relationship_row->mm_relationship == 'Wife' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '1'))

									{

										$emailData->family .= 'Mother';

									}

									if($get_relationship_row->mm_relationship == 'Husband' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '0') )

									{

										$emailData->family .= 'Father';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										$emailData->family .= 'Brother';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										$emailData->family .= 'Sister';

									}

								}

								

								if($address->mm_relationship == 'Wife')

								{

									if($get_relationship_row->mm_relationship == '')

									{

										$emailData->family .= 'Husband';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										$emailData->family .= 'Son';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										$emailData->family .= 'Daughter';

									}

								}

								

								if($address->mm_relationship == '')

								{

									if($get_relationship_row->mm_relationship == 'Wife')

									{

										$emailData->family .= 'Wife';

									}

									if($get_relationship_row->mm_relationship == 'Husband')

									{

										$emailData->family .= 'Husband';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										$emailData->family .= 'Daughter';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										$emailData->family .= 'Son';

									}

								}

								$emailData->family .= '

								</td>

								<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_email.'</td>

								<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$get_relationship_row->mm_birth_month."/".$get_relationship_row->mm_birth_year.'</td>

								<td style="text-align:left; padding-right:10px;"><center><a href="'.base_url().'user/verify_edit_family_meber/'.$address->mm_seq.'/'.$address->mm_username.'/'.$get_relationship_row->mm_id.'">Edit Profile</a></center></td>

								

								</tr>';

					

					}
					
$emailData->family .='</tbody>

							</table>
							</td>

						</tr>

					</table>';
					if($test==0)
					{
					$emailData->family='';	
					}
					//echo $family;
					$state_name='';
					$get_states = $this->dbverification->states();
					foreach($get_states as $get_states_row)
					{
						if($get_states_row->state_id == $address->mm_state_id)
						{$state_name=$get_states_row->state_name; }

					}
					
					$city_name='';
					$get_cities = $this->dbverification->cities($address->mm_state_id);
					
					foreach($get_cities as $get_cities_row)
					{
						if($address->mm_city_id ==$get_cities_row->city_id)
						{
							$city_name = $get_cities_row->city_name;
						}
						
					}
					$occupation_name='';
					$occupations = $this->db->get('occupations');
					foreach($occupations->result() as $occupation_row)
					{
						if($address->occupation_id == $occupation_row->occupation_id)
						{ 
							$occupation_name=$occupation_row->occupation_name; 
						}
					}
					if($address->mm_disp_dir==1)
					{
						$mm_disp_dir='yes';	
					}
					else
					{
						$mm_disp_dir='no';	
					}
					if($address->mm_disp_birth==1)
					{
						$mm_disp_birth='yes';	
					}
					else
					{
						$mm_disp_birth='no';	
					}
					if($address->mm_photo != ''){
						
						$mm_photo1=base_url('images/profile/thumb/'.$address->mm_photo);
						$mm_photo= "<img width='50' src='".$mm_photo1."'/>";
					}
					else
					{
						//$mm_photo= "<img width='50' src=".base_url('images/profile/thumb/no_photo'.)."'/>";
						$mm_photo1=base_url('images/profile/thumb/no_photo.jpg');
						$mm_photo= "<img width='50' src='".$mm_photo1."'/>";
					}

            
					$userinfo = '<table width="auto" border="1" cellspacing="0" cellpadding="0"> 

					  				<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>First Name :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_fname.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Mothers Maiden Name :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_mother_maiden_name.'</td>
									</tr>
									
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Father Name:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_father_name.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Hometown:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_hometown.'</td>
									
									
									</tr>
									
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Original Surname If last name is Patel:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_original_surname.'</td>
									
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Username :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_username.'</td>
									
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Last Name:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_lname.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Password :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">&nbsp;</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Email:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_email.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Address :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_address.'</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Mobile:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_cphone.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>State :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$state_name.'</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Phone:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_hphone.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>City :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$city_name.'</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Dob:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_birth_month.'/'.$address->mm_birth_year.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Occupation :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$occupation_name.'</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Education Qualification:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->edu_qualification.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>University/College  :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->univercity_college_name.'</td>
									</tr>
									<tr>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Photo:</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$mm_photo.'</td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;"><b>Life Member Number :</b></td>
									<td style="text-align:left; padding-left:10px;padding-right:10px;">'.$address->mm_life_id.'</td>
									</tr>
									
									
									
					</table>';

					

						

					$this->email->clear();

					if($emailData->type == 0 && $address->mm_email!='')

					{

						//$address->mm_email="test7.capital@gmail.com";

						//$address->mm_email="test2.capital@capitaltechnosys.com";

						$config['mailtype'] = 'html';

						$config['charset'] = 'utf-8';

						$this->email->initialize($config);

					

						$this->email->to(trim($address->mm_email));

						$this->email->from($settings->email);

						$this->email->subject($emailData->subject);

						//$this->email->message($emailData->html);

						

						$final_message = array('html' =>$emailData->html,'fullname' =>$address->mm_fname." ".$address->mm_lname,'username' =>$address->mm_username,'code' =>$address->mm_seq,'email' =>$address->mm_email,'familymember' =>$emailData->family,'sitename'=>$settings->sitename,'emailID'=>$emailID,'userinfo' => $userinfo,'subject' => $emailData->subject,'segment_data' => 'verification');

						/*$this->email->message($this->parser->parse('parser_for_sendverification', $final_message , TRUE));*/

						$this->email->message($this->parser->parse('email_layout', $final_message , TRUE));

						

						$email_sent = $this->email->send();
						//$email_sent=1;

						if($email_sent)

						{

						/*send to user  */

						  $data=array(

						  'mail_send_status'=>1

						  );

						  $result=$this->dbverification->mail_send_status($data,$address->mm_id,$emailID);

						  if($result)

						  {

						  $i++;						  

						  $updateStartNum = $this->dbverification->updateEmailStartNum($emailID, $i, $totalSubscribers);

						  }

						/*send to user  */

						}
						else
									{
										//$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
										$regex = '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/'; 
										// Run the preg_match() function on regex against the email address
										if (!preg_match($regex, $address->mm_email)) {
											//echo "email:".$address->mm_email."<br>";
											$data=array(

											  'mail_send_status'=>1
					
											  );
					
											  $result=$this->dbverification->mail_send_status($data,$address->mm_id,$emailID);
					
											  if($result)
					
											  {
					
											  $i++;						  
					
											  $updateStartNum = $this->dbverification->updateEmailStartNum($emailID, $i, $totalSubscribers);
					
											  }
										} 
										

									}

					}
					elseif($address->mm_email=='')
								{
									
												$data=array(

											  'mail_send_status'=>1
					
											  );
					
											  $result=$this->dbverification->mail_send_status($data,$address->mm_id,$emailID);
					
											  if($result)
					
											  {
					
											  $i++;						  
					
											  $updateStartNum = $this->dbverification->updateEmailStartNum($emailID, $i, $totalSubscribers);
					
											  }
								}

					

					$j++;

					echo $this->email->print_debugger();

					/*phpmailer*/

					/*$this->load->library('phpmailer');

					$mail = new PHPMailer();

					$mail->Username = "virendra.testmail@gmail.com"; 

					$mail->Password = "admin123admin"; 

					$mail->AddAddress('test7.capital@gmail.com');

					

					$mail->FromName = "virendra";

					$mail->IsHTML(true);

					$MESSAGE_BODY='';

					$MESSAGE_BODY .= $emailData->html; 

					

				

					$mail->Subject = $emailData->subject;

					$mail->Body    = $MESSAGE_BODY ; 

					

					$mail->Host = "ssl://smtp.gmail.com";

					$mail->Port = 465;

					$mail->IsSMTP();

					$mail->SMTPAuth = true;

					$mail->From = $mail->Username;

					$mail->Send();*/

					//$email_sent=1;

					

					/*if($mail->Send())

					{

						

					  /*send to user  */

					 /* $data=array(

					  'mail_send_status'=>1

					  );

					  $result=$this->dbverification->mail_send_status($data,$address->mm_id,$emailID);

					  if($result)

					  {

					  $i++;

					  

					  $updateStartNum = $this->dbverification->updateEmailStartNum($emailID, $i, $totalSubscribers);

					  }

					/*send to user  */

					/*}*/

					/*phpmailer*/

					

							

					

				}

				if($j!=$i)

				{

					/*Fail  */

					$data=array('email_send'=>'2');

					$result=$this->dbverification->edit($data,$emailID);

					/*Fail  */

				}

					

			}

           $this->dbverification->delete('send_verification');

        }

		echo 'cron_end';

		}

		else

		{

		echo "Unathorised Access";	

		}

	}

} 