<?php $get_ads = $this->dbheader->get_ads('250x125');
if($get_ads){
 ?>
<div id="ads_slider">
	<ul>
    	<?php
			
			
			foreach($get_ads as $get_ads_row)
			{
				if($get_ads_row->ads_link !='')
				{
				?>
                	<li style="height:130px;"><a target="_blank" href="<?php echo $get_ads_row->ads_link;?>"><img title="<?php echo $get_ads_row->ads_title;?>" alt="<?php echo $get_ads_row->ads_title;?>" src="<?php echo base_url('images/ads/'.$get_ads_row->ads_code);?>" border="0" width="250" /></a></li>
                <?php
				}
				else
				{
					?>
                	<li style="height:130px;"><img title="<?php echo $get_ads_row->ads_title;?>" alt="<?php echo $get_ads_row->ads_title;?>" src="<?php echo base_url('images/ads/'.$get_ads_row->ads_code);?>" border="0" width="250" /></li>
                <?php
				}
			}
		?>
    	
    </ul>
</div>
<?php } ?>