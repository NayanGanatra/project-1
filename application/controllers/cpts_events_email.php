<?php 
	class Cpts_events_email extends CI_Controller 
	{
    function Cpts_events_email(){
       parent::__construct();
    }
    function index()
	{  
		if($_GET['sendthemail']=='true') 
		{
		$this->load->model('dbheader');
		$this->load->model('dbevents');
        $this->load->library('email');
        $this->load->library('parser');
		
		$settings = $this->dbheader->get_setting();
		//$quant = 3;
	    if($this->dbevents->getQueuedEmail()->num_rows > 0)//2
        {
			$status = $this->dbevents->chk_status('cpts_events_email');
			if($status == '1' || $status == 1)
			{
				exit();
				die('No clone process allowed.');
			}
				
			$data = array(
				'mail_info'=>'cpts_events_email'
				);
			$this->dbevents->insert($data);
			
			$this->dbevents->getQueuedEmail()->num_rows;//2
			
			$emailData = $this->dbevents->getFirstQueuedMailing();//1
			
           	foreach ($emailData as $emailData)
			{
				 	$emailID = $emailData->event_id;
					
					/*Sending */
					$data=array('email_send'=>'1');
					$result=$this->dbevents->edit($data,$emailID);
					
					/*Sending */		
					$subscribers = $this->dbevents->getBatchEmailSubscribers($emailID);
					
					$totalSubscribers = $this->dbevents->countEmailSubscribers($emailID);
					
					$i=0;
					$j=0;
					foreach ($subscribers as $address)
					{
								$this->email->clear();
								if($emailData->type == 0 && $address->mm_email!='')
								{
									
									$unique_key = substr(md5(rand(0, 1000000)), 0, 35);
									$get_mm_email = $this->dbevents->get_member_email_by_mm_id($address->mm_id);
									$check_event_invitation = $this->dbevents->check_event_invitation($address->mm_id,$emailID);
									
						
									if($check_event_invitation)
									{
									$dataB=array(
												 'unique_number'=>$unique_key,
										'email_status'=>$check_event_invitation->email_status+1
										);
									
									$resultB=$this->dbevents->edit_event_invitation($dataB,$check_event_invitation->ei_id);
									}
									else
									{
										$dataB=array(
										'mm_id'=>$address->mm_id,
										'event_id'=>$emailID,
										'email_status'=>1,
										'unique_number'=>$unique_key,
										'create_time'=>date('Y-m-d H:m:s')
										);
									$resultB=$this->dbevents->insert_event_invitation($dataB);
									}
									
									
									$config['mailtype'] = 'html';
									$config['protocol'] = 'sendmail';
									$config['mailpath'] = '/usr/sbin/sendmail';
									$config['charset'] = 'iso-8859-1';
									$config['wordwrap'] = TRUE;
									$config['bcc_batch_mode'] = TRUE;
									
									$this->email->initialize($config);
									
									$this->email->from($settings->email);
									$this->email->to($get_mm_email->mm_email);
									//$this->email->to('test7.capital@gmail.com');
									
									$this->email->subject($emailData->subject);
									
									$email_link = base_url('user/invitation_details/'.$emailID.'/'.$unique_key);
									
									$final_message = array('link' => $email_link,'message' => $emailData->html,'site_email' => $settings->email, 'sitename'=>$settings->sitename);
									$this->email->message($this->parser->parse('invite_parser', $final_message , TRUE));
									$email_sent = $this->email->send();
									
									if($email_sent)
									{
									  $data=array(
									  'mail_send_status'=>1
									  );
									  $result=$this->dbevents->mail_send_status($data,$address->mm_id,$emailID);
									  if($result)
									  {
									  $i++;
									  $updateStartNum = $this->dbevents->updateEmailStartNum($emailID, $i, $totalSubscribers);
									  }
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
											  $result=$this->dbevents->mail_send_status($data,$address->mm_id,$emailID);
											  if($result)
											  {
											  $i++;
											  $updateStartNum = $this->dbevents->updateEmailStartNum($emailID, $i, $totalSubscribers);
											  }
										} 
										

									}

								}
								elseif($address->mm_email=='')
								{
									
									$data=array(
									  'mail_send_status'=>1
									  );
									  $result=$this->dbevents->mail_send_status($data,$address->mm_id,$emailID);
									  if($result)
									  {
									  $i++;
									  $updateStartNum = $this->dbevents->updateEmailStartNum($emailID, $i, $totalSubscribers);
									  }
								}
								

								

								$j++;

								echo $this->email->print_debugger();
			

						

					}

					if($j!=$i)

					{

						/*Fail  */

						$data=array('email_send'=>'2');

						$result=$this->dbevents->edit($data,$emailID);

						/*Fail  */

					}
					

						

			}

           $this->dbevents->delete('cpts_events_email');

        }

		echo 'cron_end';
		

		}

		else

		{

		echo "Unathorised Access";	

		}

	}

} 