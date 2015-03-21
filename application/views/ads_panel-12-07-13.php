<?php 
error_reporting(0);

$login = $this->session->userdata('user_email');
if($login)
{
	foreach($state_to_chapter as $alldata)
			{
				if($alldata->ch_id == $chapter->ch_id)
					{
						$data['ads_login_user'] = $this->dbchapter->latesr_ads_login_user($alldata->ch_id);
						date_default_timezone_set("Asia/Kolkata");
						$today = date("Y-m-d H:i:s");
							?>
						<div id="ads_slider">
						<ul>
    					<?php
							foreach($data['ads_login_user'] as $get_ads_row)
								{
									if($today > $get_ads_row->ads_start_date && $today < $get_ads_row->ads_end_date) 
										{
								?>
                				<li style="height:130px;"><?php if($get_ads_row->ads_link !=''){ ?><a target="_blank" href="<?php echo $get_ads_row->ads_link;?>"> <?php } ?>
                						<img title="<?php echo $get_ads_row->ads_title;?>" alt="<?php echo $get_ads_row->ads_title;?>" 
                						src="<?php echo base_url('images/ads/'.$get_ads_row->ads_code);?>" border="0" width="250" /></a>
                				</li>
                				<?php
										}
					
								}
								?>
   						</ul>
						</div>
		
        				<?php						
					
					}
			}
			
}

if($ads)
{
	
	date_default_timezone_set("Asia/Kolkata");
	$today = date("Y-m-d H:i:s");
	
?>
<div id="ads_slider">
	<ul>
    	<?php
			
			
			foreach($ads as $get_ads_row)
			{
				if($today > $get_ads_row->ads_start_date && $today < $get_ads_row->ads_end_date) 
					{
				
					?>
                		<li style="height:130px;"><?php if($get_ads_row->ads_link !=''){ ?><a target="_blank" href="<?php echo $get_ads_row->ads_link;?>"> <?php } ?>
                			<img title="<?php echo $get_ads_row->ads_title;?>" alt="<?php echo $get_ads_row->ads_title;?>" 
                			src="<?php echo base_url('images/ads/'.$get_ads_row->ads_code);?>" border="0" width="250" /></a>
                		</li>
                	<?php
					}
					
			}
		?>
    	
    </ul>
</div>
<?php 
} ?>




