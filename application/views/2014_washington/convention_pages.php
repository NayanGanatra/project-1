 <?php 
if(count($page_detail) != 0)
{
?>
<div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
<?php echo $page_detail->page_title;?></div>
       <div class="row-fluid">
           <div class="span8" style="width:100%">		
                        <h2 style="font-size:24px;"><?php //echo $page_detail->page_title;?></h2>
             			<p class="TIME-COLOR"><?php //echo $page_detail->page_created_date;?></p>
             			<p><?php echo $page_detail->page_content;?></p>
                       </p>
         
    	 </div>
       </div>
</div>
<?php 
}
else
{?>
<div class="welcome-title-logo">
Page not found
</div>
<?php
}?>