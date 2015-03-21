<?php 

if(count($ads) != 0)
{
?>
<!--<div id="ads_slider">-->
<div class="bs-docs-sidebar bs-docs-sidenav add-border">
	<div id="ads_slider">
		<ul>
    	<?php
			
			foreach($ads as $get_ads_row)
			{
				?>
                		<li style="height:130px;"><?php if($get_ads_row->ads_link !=''){ ?><a target="_blank" href="<?php echo $get_ads_row->ads_link;?>"> <?php } ?>
                			<img title="<?php echo $get_ads_row->ads_title;?>" alt="<?php echo $get_ads_row->ads_title;?>" 
                			src="<?php echo base_url('images/ads/'.$get_ads_row->ads_code);?>" border="0" width="222" /></a>
                		</li>
                	<?php
			}
		?>
    	
    	</ul>
    </div>
</div>
<?php 
} ?>




