<?php

	class Cpts_email extends CI_Controller 

	{

    function Cpts_email(){

       parent::__construct();

    }

    function index()

	{

		if($_GET['sendthemail']=='true')

		{ 

		

		$this->load->model('dbheader');

		$this->load->model('dbemail');

        $this->load->library('email');

        $this->load->library('parser');

		$settings = $this->dbheader->get_setting();

		//$quant = 3;

		

        if($this->dbemail->getQueuedEmail()->num_rows > 0)//2

        {

			$status = $this->dbemail->chk_status('cpts_email');
        	if($status == '1' || $status==1)
			{
				exit();
				die('No clone process allowed.');
			}
			$datacpts = array(
				'mail_info'=>'cpts_email'
				);
			$this->dbemail->insert($datacpts);
			
			$this->dbemail->getQueuedEmail()->num_rows;//2

			$emailData = $this->dbemail->getFirstQueuedMailing();//1

           	foreach ($emailData as $emailData)

			{

				 	$emailID = $emailData->uid;



					/*Sending */

					$data=array('email_send'=>'1');

					$result=$this->dbemail->edit($data,$emailID);

					/*Sending */		

					$subscribers = $this->dbemail->getBatchEmailSubscribers($emailID);

					$totalSubscribers = $this->dbemail->countEmailSubscribers($emailID);

					$i=0;

					$j=0;

					foreach ($subscribers as $address)

					{

								

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

									$final_message = array('html' =>$emailData->html,'fullname' =>$address->mm_fname." ".$address->mm_lname,'username' =>$address->mm_username,'code' =>$address->mm_seq,'email' =>$address->mm_email,'sitename'=>$settings->sitename,'emailID'=>$emailID,'subject' => $emailData->subject,'segment_data' => 'cpts_email');

									/*$this->email->message($this->parser->parse('parser_for_email_template', $final_message , TRUE));*/

									$this->email->message($this->parser->parse('email_layout', $final_message , TRUE));

									

									$email_sent = $this->email->send();

									if($email_sent)

									{

									/*send to user  */

									  $data=array(

									  'mail_send_status'=>1

									  );

									  $result=$this->dbemail->mail_send_status($data,$address->mm_id,$emailID);

									  if($result)

									  {

									  $i++;

									  

									  $updateStartNum = $this->dbemail->updateEmailStartNum($emailID, $i, $totalSubscribers);

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
		
											  $result=$this->dbemail->mail_send_status($data,$address->mm_id,$emailID);
		
											  if($result)
		
											  {
		
											  $i++;
		
											  
		
											  $updateStartNum = $this->dbemail->updateEmailStartNum($emailID, $i, $totalSubscribers);
		
											  }

										} 
										

									}

								}
								elseif($address->mm_email=='')
								{
									
									 $data=array(

									  'mail_send_status'=>1

									  );

									  $result=$this->dbemail->mail_send_status($data,$address->mm_id,$emailID);

									  if($result)

									  {

									  $i++;

									  

									  $updateStartNum = $this->dbemail->updateEmailStartNum($emailID, $i, $totalSubscribers);

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

								  $result=$this->dbemail->mail_send_status($data,$address->mm_id,$emailID);

								  if($result)

								  {

								  $i++;

								  

								  $updateStartNum = $this->dbemail->updateEmailStartNum($emailID, $i, $totalSubscribers);

								  }

								/*send to user  */

								/*}*/

								/*phpmailer*/

								

								

						

					}

					if($j!=$i)

					{

						/*Fail  */

						$data=array('email_send'=>'2');

						$result=$this->dbemail->edit($data,$emailID);

						/*Fail  */

					}

						

			}

           $this->dbemail->delete('cpts_email');

        }

		echo 'cron_end';

		}

		else

		{

		echo "Unathorised Access";	

		}

	}

} 