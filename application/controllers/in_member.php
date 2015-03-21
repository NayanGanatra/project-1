<?php
	class In_member extends CI_Controller 
	{
		function In_member()
		{
		   parent::__construct();
		}
		function index()
		{ 
			if($_GET['sendthemail']=='true') 
			{
					$this->load->model('dbch_member');
					
						
						$events = $this->dbch_member->events();
						foreach($events as $events)
						{
							$get_chapters = $this->dbch_member->get_all_in($events->event_id);
							$i=0;
							foreach($get_chapters as $get_chapters_row)
							{
								if($get_chapters_row->mm_state_id==0)
								{
									$query = $this->dbch_member->get_all_mm($get_chapters_row->mm_state_id,$get_chapters_row->mm_id);
									if($query)
									{
										foreach($query as $query)
										{
											echo $get_chapters_row->event_id." : ".$query->mm_id."<br>";
											$get_chapters = $this->dbch_member->update_user_state($query->mm_id);
											$i++;
										}
									}
								}
							}
							echo '<br>Total User:'.$i."<br>";
						}
						
					
			}
		}
	}
?>
