<?php

	class Sendnewsletter extends CI_Controller 

	{

    function Sendnewsletter(){

       parent::__construct();

    }

    function index()

	{

		if($_GET['sendthemail']=='true')

		{

		$this->load->model('dbheader');

		$this->load->model('dbnewsletter');

        $this->load->library('email');

        $this->load->library('parser');

		$settings = $this->dbheader->get_setting();

		//$quant = 3;

	

        if($this->dbnewsletter->getQueuedNewsletters()->num_rows > 0)//2

        {

			$status = $this->dbnewsletter->chk_status('send_newsletter');
				
			if($status == '1' || $status == 1)
			{
				exit();
				die('No clone process allowed.');
			}
				
			$data = array(
				'mail_info'=>'send_newsletter'
				);
			$this->dbnewsletter->insert($data);
			
			$newsletterData = $this->dbnewsletter->getFirstQueuedMailing();//1

           	foreach ($newsletterData as $newsletterData)

			{

			 	$newsletterID = $newsletterData->uid;

				/*Sending */

				$data=array('email_send'=>'1');

				$result=$this->dbnewsletter->edit($data,$newsletterID);

				/*Sending */

				$subscribers = $this->dbnewsletter->getBatchNewsletterSubscribers($newsletterID);

				$totalSubscribers = $this->dbnewsletter->countNewsletterSubscribers($newsletterID);

				$i=0;

				$j=0;

				foreach ($subscribers as $address)

				{

					$avail = $this->dbnewsletter->check_availability($address->ns_email);

					if($avail)

					{

						$newsletterData->family='';

						$get_relationship = $this->dbnewsletter->get_relationship($avail->mm_id);
						$test=0;
						if(!$get_relationship)

						{

							$get_relationship = $this->dbnewsletter->get_relationship_sub($avail->mm_family_id,$avail->mm_id);

						}
						$test=sizeof($get_relationship);
$newsletterData->family .= '<table width="980" border="0" cellspacing="0" cellpadding="0"> 

						  <tr>

						  	<td>

								<div>

								        <h1><b><u>Family Members<u></b><br></h1>

								</div>

						        

								<table  border="1" cellspacing="0" cellpadding="0"  width="100%">

									<thead>

										<tr>

											<th scope="col" style="text-align:left; padding-left:10px;">Name</th>

											<th scope="col" style="text-align:left; padding-left:10px;">Username</th>

											<th scope="col" style="text-align:left; padding-left:10px;">Relationship</th>

											<th scope="col" style="text-align:left; padding-left:10px;">Email-id</th>

											 <th scope="col" style="text-align:left; padding-left:10px;">Date of Birth(MM/YY)</th>

											

										</tr>

									</thead>

									<tfoot>

										

									</tfoot> 

									<tbody cellspacing="0" cellpadding="0" >';

									
						foreach($get_relationship as $get_relationship_row)

						{

						$newsletterData->family .= '

									<tr>

										<td style="text-align:left; padding-left:10px;">'.$get_relationship_row->mm_fname." ".$get_relationship_row->mm_lname.'</td>

										<td style="text-align:left; padding-left:10px;">'.$get_relationship_row->mm_username.'</td>

										<td style="text-align:left; padding-left:10px;">';

										if($avail->mm_relationship == 'Son' || $avail->mm_relationship == 'Daughter')

									{

										if($get_relationship_row->mm_relationship == 'Wife' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '1'))

										{

											$newsletterData->family .= 'Mother';

										}

										if($get_relationship_row->mm_relationship == 'Husband' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '0') )

										{

											$newsletterData->family .= 'Father';

										}

										if($get_relationship_row->mm_relationship == 'Son')

										{

											$newsletterData->family .= 'Brother';

										}

										if($get_relationship_row->mm_relationship == 'Daughter')

										{

											$newsletterData->family .= 'Sister';

										}

									}

									

									if($avail->mm_relationship == 'Wife')

									{

										if($get_relationship_row->mm_relationship == '')

										{

											$newsletterData->family .= 'Husband';

										}

										if($get_relationship_row->mm_relationship == 'Son')

										{

											$newsletterData->family .= 'Son';

										}

										if($get_relationship_row->mm_relationship == 'Daughter')

										{

											$newsletterData->family .= 'Daughter';

										}

									}

									

									if($avail->mm_relationship == '')

									{

										if($get_relationship_row->mm_relationship == 'Wife')

										{

											$newsletterData->family .= 'Wife';

										}

										if($get_relationship_row->mm_relationship == 'Husband')

										{

											$newsletterData->family .= 'Husband';

										}

										if($get_relationship_row->mm_relationship == 'Daughter')

										{

											$newsletterData->family .= 'Daughter';

										}

										if($get_relationship_row->mm_relationship == 'Son')

										{

											$newsletterData->family .= 'Son';

										}

									}

									$newsletterData->family .= '

									</td>

									<td style="text-align:left; padding-left:10px;">'.$get_relationship_row->mm_email.'</td>

									<td style="text-align:left; padding-left:10px;">'.$get_relationship_row->mm_birth_month."/".$get_relationship_row->mm_birth_year.'</td>
									

									

									</tr>';
}
						$newsletterData->family .='</tbody>

							</table>

						</td>

						</tr>

					</table>';
					if($test==0)
					{
					$newsletterData->family='';	
					}
					//echo $family;
					$userinfo = '<table width="300" border="0" cellspacing="0" cellpadding="0"> 

					  				<tr><td style="text-align:left; padding-left:10px;"><b>Username :</b>'.$avail->mm_username.'</td></tr>

									<tr><td style="text-align:left; padding-left:10px;"><b>Name :</b>'.$avail->mm_fname." ".$avail->mm_lname.'</td></tr>

									<tr><td style="text-align:left; padding-left:10px;"><b>Email :</b>'.$avail->mm_email.'</td></tr>

								  	<tr><td style="text-align:left; padding-left:10px;"><b>DOB :</b>'.$avail->mm_birth_month."/".$avail->mm_birth_year.'</td></tr>

					</table>';

					

					

					/*echo $userinfo;

					echo $newsletterData->family;*/

					$this->email->clear();

					if($address->ns_email!='')

					{

						//$address->ns_email="test7.capital@gmail.com";

						//$address->mm_email="test2.capital@capitaltechnosys.com";

						$config['mailtype'] = 'html';

						$config['charset'] = 'utf-8';

						$this->email->initialize($config);

					

						$this->email->to(trim($address->ns_email));

						$this->email->from($settings->email);

						$this->email->subject($newsletterData->subject);

						//$this->email->message($newsletterData->html);

						

						$final_message = array('html' =>$newsletterData->html,'fullname' =>$avail->mm_fname." ".$avail->mm_lname,'username' =>$avail->mm_username,'email' =>$avail->mm_email,'familymember' =>$newsletterData->family,'sitename'=>$settings->sitename,'subject'=>$newsletterData->subject,'userinfo' => $userinfo);

						$this->email->message($this->parser->parse('email_layout', $final_message , TRUE));

						//var_dump($final_message);

						$newsletter_sent = $this->email->send();

						if($newsletter_sent)

						{

						/*send to user  */

						  $data=array(

						  'mail_send_status'=>1

						  );

						  $result=$this->dbnewsletter->mail_send_status($newsletterID,$address->ns_email);

						  if($result)

						  {

						  $i++;						  

						  $updateStartNum = $this->dbnewsletter->updateEmailStartNum($newsletterID, $i, $totalSubscribers);

						  }

						/*send to user  */

						}

					}

					}

					else

					{

						$this->email->clear();

						if($address->ns_email!='')

						{

							//$address->ns_email="test7.capital@gmail.com";

							//$address->mm_email="test2.capital@capitaltechnosys.com";

							$config['mailtype'] = 'html';

							$config['charset'] = 'utf-8';

							$this->email->initialize($config);





							$this->email->to(trim($address->ns_email));

							$this->email->from($settings->email);

							$this->email->subject($newsletterData->subject);

							//$this->email->message($newsletterData->html);

							

							$userinfo = '<table width="300" border="0" cellspacing="0" cellpadding="0"> 

					  				<tr><td style="text-align:left; padding-left:10px;"><b>Email :</b>'.$address->ns_email.'</td></tr>

								  	</table>';

					

							$final_message = array('html' =>$newsletterData->html, 'userinfo' =>$userinfo, 'sitename'=>$settings->sitename,'subject'=>$newsletterData->subject);

							$this->email->message($this->parser->parse('email_layout', $final_message , TRUE));

							//var_dump($final_message);

							$newsletter_sent = $this->email->send();

							if($newsletter_sent)

							{

							/*send to user  */

							  $data=array(

							  'mail_send_status'=>1

							  );

							  $result=$this->dbnewsletter->mail_send_status($newsletterID, $address->ns_email);

							  if($result)

							  {

							  $i++;						  

							  $updateStartNum = $this->dbnewsletter->updateEmailStartNum($newsletterID, $i, $totalSubscribers);

							  }

							/*send to user  */

							}

						}

					}

					

					$j++;

					//echo $this->email->print_debugger();

					/*phpmailer*/

					/*$this->load->library('phpmailer');

					$mail = new PHPMailer();

					$mail->Username = "virendra.testmail@gmail.com"; 

					$mail->Password = "admin123admin"; 

					$mail->AddAddress('test7.capital@gmail.com');

					

					$mail->FromName = "virendra";

					$mail->IsHTML(true);

					$MESSAGE_BODY='';

					$MESSAGE_BODY .= $newsletterData->html; 

					

				

					$mail->Subject = $newsletterData->subject;

					$mail->Body    = $MESSAGE_BODY ; 

					

					$mail->Host = "ssl://smtp.gmail.com";

					$mail->Port = 465;

					$mail->IsSMTP();

					$mail->SMTPAuth = true;

					$mail->From = $mail->Username;

					$mail->Send();*/

					//$newsletter_sent=1;

					

					/*if($mail->Send())

					{

						

					  /*send to user  */

					 /* $data=array(

					  'mail_send_status'=>1

					  );

					  $result=$this->dbnewsletter->mail_send_status($data,$address->mm_id,$newsletterID);

					  if($result)

					  {

					  $i++;

					  

					  $updateStartNum = $this->dbnewsletter->updateEmailStartNum($newsletterID, $i, $totalSubscribers);

					  }

					/*send to user  */

					/*}*/

					/*phpmailer*/

					

							

					

				}

				if($j!=$i)

				{

					/*Fail  */

					$data=array('email_send'=>'2');

					$result=$this->dbnewsletter->edit($data,$newsletterID);

					/*Fail  */

				}

					

			}

           $this->dbnewsletter->delete('send_newsletter');

        }

		echo 'cron_end';

		}

		else

		{

		echo "Unathorised Access";	

		}

	}

} 