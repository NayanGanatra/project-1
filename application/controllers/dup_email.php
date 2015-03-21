<?php
	class Dup_email extends CI_Controller 
	{
		function Dup_email()
		{
		   parent::__construct();
		   
		   	$this->load->helper(array('url'));
			

			
		}
		function index()
		{ 
			if($_GET['sendthemail']=='true') 
			{
				$this->load->model('dbdupemail');
				$event_mm = $this->dbdupemail->dup_email();//84
				$i=1;
				echo "<table><th>Sr.no</th><th>username</th><th>email</th><th>relationship</th>";
				foreach ($event_mm as $event_mm)
				{
					
					if($event_mm->mm_email!='')
					{
						$emailData = $this->dbdupemail->check_email($event_mm->mm_email);
						
						foreach ($emailData as $emailData)
						{
							echo "<tr><td>".$i."</td>";
							echo "<td>".$emailData->mm_username."</td>";
							echo "<td>".$emailData->mm_email."</td>";
							
							if($emailData->mm_relationship!='')
							echo "<td>".$emailData->mm_relationship."</td></tr>";
							else
							echo "<td>Main Member</td></tr>";
							/*$check_log = $this->dbdupemail->check_log($event_mm->mm_id);
							foreach ($check_log as $check_log)
							{
								echo check_log->mm_id;
							}*/
							
						}
						$i++;
					}
				}
				echo "</table>";
			}
		}
		
	}
?>
