<script type="text/javascript">

		jQuery(document).ready(function() {
		jQuery(window).scroll(function(){

		if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()){

		jQuery('#hdnstart').val(parseInt(jQuery('#hdnstart').val())+3);

		jQuery('#hdnend').val(parseInt(jQuery('#hdnend').val())+3);

		jQuery("#LoadingImage").show();

		jQuery.ajax({

	   type: "POST", 

	   data: "limit="+jQuery('#hdnstart').val()+"&offset="+jQuery('#hdnend').val(),

	   url:'<?php echo base_url().$this->config->item("convention_texas_folder");?>convention/pages1',

	success: function(data) {
	
      //alert(data);
	if(data=='' || data==null)

	{

		jQuery("#LoadingImage").hide();

		jQuery('#nomore').css("display","block");

	}

	else

		{
		        
				jQuery("#LoadingImage").hide();
		
				jQuery('#content_gallery').append(data);
				
		
				jQuery(".hideall").hide();	
		
			}

	

		}

		});

		}

	});

});
		
	</script>

<?php 
if(count($allpages) != 0)
{
	
?>

<div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Post</div>
       <div class="row-fluid">
           <div class="span8" style="width:100%">
           <div id="content_gallery">
    	<?php
			foreach($allpages as $allpages)
			{
				?>
                		
                        <h2 style="font-size:24px;"><?php echo $allpages->page_title;?></h2>
             			<p class="TIME-COLOR"><?php echo $allpages->page_created_date;?></p>
             			<p><?php $string = $allpages->page_content;
						    echo $str = word_limiter($string,50); ?></p>
                         <p class="small"><a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id.""); ?>">Read More</a>

                        </p>
              	<?php
			}
		?>
         </div>
    	 </div>
       </div>
</div>
<?php 
} ?>

<input type="hidden" id="hdnend" value="0"/>

<input type="hidden" id="hdnstart" value="3"/>

		<div id="LoadingImage" style="display:none; margin:10px 0 0 0px; text-align:center; float:left; width:100%"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif" alt="" style="height:20px;float:left;"/> </div>

		<div id="nomore" style="display:none; margin:10px 0 0 0px;"><b><i>No more Post</i></b></div>
  

