<style>
  .small
  {
	  float:right;
	  margin-top:-42px;
	  margin-right:96px;
  }
  </style>
   <!------------------------pagination--------------------->
<script type="text/javascript">

		jQuery(document).ready(function() {
		jQuery(window).scroll(function(){

		if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()){

		jQuery('#hdnstart').val(parseInt(jQuery('#hdnstart').val())+4);

		jQuery('#hdnend').val(parseInt(jQuery('#hdnend').val())+4);

		jQuery("#LoadingImage").show();

		jQuery.ajax({

	   type: "POST", 

	   data: "limit="+jQuery('#hdnstart').val()+"&offset="+jQuery('#hdnend').val(),

	   url:'<?php echo base_url().$this->config->item("convention_folder");?>convention/convention_moreimage/<?php echo $this->uri->segment(5);?>',

	success: function(data) {
	
      //alert(data);
	if(data=='' || data==null || data==0)

	{

		jQuery("#LoadingImage").hide();

		jQuery('#nomore').css("display","block");

	}

	else

		{
		        
				jQuery("#LoadingImage").hide();
				jQuery('#content_gallery').append(data);
				jQuery('.gallery').colorbox({rel:'gallery'});
                jQuery(".inline").colorbox({inline:true,innerWidth:640, innerHeight:350});
                jQuery(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:480});
                jQuery(".video").colorbox({iframe:true, innerWidth:640, innerHeight:480});
                jQuery(".iframe").colorbox({iframe:true, width:"640", height:"480"});
                jQuery(".ajax").colorbox({maxHeight:"90%"});
				jQuery(".hideall").hide();	
		
			}

	

		}

		});

		}

	});

});	
	</script>
    <!------------------------endof pagination--------------------->
<div class="welcome-title-logo">
       <div class="logo-text2" style="margin-bottom:15px;font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
Image Gallery</div>
       <div class="row-fluid">
           <div class="span8" style="width:113.957%!important;">
           <div id="content_gallery">
              <ul class="thumbnails">
               <?php 
                if($image1)
				{
               ?>
              <?php
              foreach($image1 as $row)
			 {
              ?>
               <?php 
			     if($row->cg_type == 0)
			     { 
				?>
                      <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;">
                    <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->cg_title; ?>" href="<?php echo base_url('images/convention/gallery/big/'.$row->cg_data); ?>" style="height:90px !important; width:150px !important; margin-right:3em!important;">
                  <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>" style="height:90px !important; width:150px !important;">
                 </a>
                    </li>
             <?php 
				 }
			  }
			}
			?>
              </ul>
         </div>
       </div>
       </div>
</div>
<input type="hidden" id="hdnend" value="0"/>

<input type="hidden" id="hdnstart" value="4"/>

		<div id="LoadingImage" style="display:none; margin:10px 0 0 0px; text-align:center; float:left; width:100%"><img src="<?php echo base_url('images/working.gif');?>" alt="" style="height:20px;float:left;"/> </div>

		<div id="nomore" style="display:none; margin:10px 0 0 0px;"><b><i>No more images</i></b></div>