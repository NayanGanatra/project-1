<?php
	class Ch_member extends CI_Controller 
	{
		function Ch_member()
		{
		   parent::__construct();
		}
		function index()
		{ 
			if($_GET['sendthemail']=='true') 
			{
					$this->load->model('dbch_member');
					
						
							/*$mm = $this->dbch_member->ver();
							foreach($mm as $mm)
							{
								echo $mm->mm_id;
							}*/
						

					$this->dbch_member->update_user_ch();
					$get_chapters = $this->dbch_member->get_chapters();
					if($get_chapters)
					{
						$i=0;
					foreach($get_chapters as $get_chapters_row)
					{
						
	                   	$query = $this->dbch_member->get_all_cm($get_chapters_row->ch_id);
						if($query)
   	                    {
						    foreach($query as $row)
                            {
						
								// $this->dbch_member->update_user($row->cm_mm_id,$row->cm_ch_id);
								 $i++;
							}
					   }
					  
					}
					echo $i;
					
					}
		
			}
		}
	}
?>
