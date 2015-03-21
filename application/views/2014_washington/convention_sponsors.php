<?php 
if(count($sponsors) != 0)
{
?>
<div class="bs-docs-sidebar bs-docs-sidenav add-border">
<p class="lleft-hd-ex2" style="float:none">Our Sponsors</p>  
	<div id="sponsors">
		<ul>
    	<?php
			foreach($sponsors as $sp)
			{
				?>
                		<li style="height:130px;"><?php if($sp->cs_link !=''){ ?><a target="_blank" href="<?php echo $sp->cs_link;?>"> <?php } ?>
                			<img title="<?php echo $sp->cs_title;?>" alt="<?php echo $sp->cs_title;?>" 
                			src="<?php echo base_url('images/convention/sponsors/'.$sp->cs_code);?>" border="0" width="222" style="padding-top:10px;" /></a>
                		</li>
              	<?php
			}
		?>
    	</ul>
    </div>
</div>
<?php 
} ?>