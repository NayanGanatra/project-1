 <script src="<?php echo base_url(); ?>/js/jquery.mCustomScrollbar.js"></script>
<link href="<?php echo base_url(); ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
<style>
.testing_my{
	
	height:280px;
	width:90%;
}
.testing_my2{
	height:280px;
	width:90%;
}
</style>

 <!------------------------jwplayer--------------------->
<script src="<?php echo base_url(); ?>js/spcs_convention/jwplayer.js"></script>
<script src="<?php echo base_url(); ?>js/spcs_convention/jwplayer.html5.js"></script>
 <script type="text/javascript">jwplayer.key="MdrDQi1Fh+k7bKYiQHg7vMzh5lcZLMIsUFntqw==";</script>
<script type="text/javascript"> 
$(document).ready(function() {
			(function($){
							/* custom scrollbar fn call */
                  /******************update-monita20130920*******************/
							$(".testing_my").mCustomScrollbar({

								scrollButtons:{

									enable:true

								},advanced:{  

							updateOnContentResize:true,   

							updateOnBrowserResize:true   

						

						  } 

							});		

					})($);	
			
			(function($){
							/* custom scrollbar fn call */

							$(".testing_my2").mCustomScrollbar({

								scrollButtons:{

									enable:true

								},advanced:{  

							updateOnContentResize:true,   

							updateOnBrowserResize:true   

						

						  } 

							});		

					})($);
			/* end of custom scrollbar fn call */
			/******************end of update-monita20130920*******************/
  $(".video").live('click', function(event) {

        event.preventDefault();

        var videoFile = $(this).attr('href');
		jwplayer('cboxLoadedContent').setup({
          flashplayer: "<?php echo base_url(); ?>js/jwplayer.flash.swf",
          file:videoFile,
          streamer: "rtmp://s14flalja9b5hr.cloudfront.net/cfx/st",
          width: 640,
          height: 480,
          autostart: false 
								   
      });
       
		
});

});  
  </script>
  <!------------------------end of jwplayer--------------------->
<style>
  .small
  {
	  float:right;
	  margin-top:-42px;
	  margin-right:96px;
  }
  </style>
<div class="welcome-title-logo">
       <div class="logo-text2" style="margin-bottom:15px;font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Gallery</div>
       <div class="row-fluid">
           <div class="span8" style="width:113.957%!important;">
           <div id="content_gallery">
             <h1>Images</h1>
             <?php $count=count($image); 
			  if($count!=0)
			  {?>
             <!--  <p class="small"><a href="<?php //echo base_url($this->config->item('convention_folder_with_slash').'convention/image/'.$this->uri->segment(5)); ?>">Read More</a></p>--><!-------------------update-monita20130920--------------------->
               <?php
			    }
				else
				{
					echo "<strong><span>"."No Image"."</span></strong>";
				}
			   ?>
                <div style="height:90%; margin-top:20px;"><!-------------------update-monita20130920--------------------->
                 <div  id="used_data" class="testing_my"><!-------------------update-monita20130920--------------------->
              <ul class="thumbnails">
               <?php 
                if($image)
				{
				  //$count=count($image);
               ?>
              <?php
              foreach($image as $row)
			 {
              ?>
               <?php 
			     if($row->cg_type == 0)
			     { 
				?>
                      <li class="span2" style=" width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;">
                    <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->cg_title; ?>" href="<?php echo base_url('images/convention/gallery/big/'.$row->cg_data); ?>" style="height:90px !important; width:150px !important; margin-right:3em!important;">
                  <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>" style="height:90px !important; width:150px !important;">
                 </a>
                    </li>
                   
             <?php 
				 }
			  }
			  ?>
			  
               <?php
			}
			?>
              </ul>            
               </div><!-------------------update-monita20130920--------------------->
			</div><!-------------------update-monita20130920--------------------->
         </div>
           
           <hr width="85%!important"></hr>
            <h1>Video</h1>
            <?php $count=count($video);
			      if($count!=0)
				  {
			      ?>
          <!--  <p class="small"><a href="<?php //echo base_url($this->config->item('convention_folder_with_slash').'convention/video/'.$this->uri->segment(5)); ?>">Read More</a></p>--><!-------------------update-monita20130920--------------------->
           <?php } 
		        else
				{
					echo "<strong><span>"."No Video"."</span></strong>";
				}?>
                 <div style="height:90%; margin-top:20px;"><!-------------------update-monita20130920--------------------->
                 <div  id="used_data" class="testing_my2"><!-------------------update-monita20130920--------------------->
             <ul class="thumbnails">
            <?php

			if($video)

			{

				foreach($video as $row1)

				{

					?>
                     <?php if($row1->cg_type == 1)
						     { 
						         $str_temp=$row1->cg_data;
								 $str=substr($str_temp,0,4);
						         if($str=='http')
								 {
						?>
                          <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;">
                               <a class="youtube thumbnail cboxElement" href="<?php echo $row1->cg_data; ?>" title="<?php echo $row1->cg_title;?>" style="height:90px !important; width:150px !important; margin-right:3em!important;">

                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_thumb.'');?>" alt="<?php echo $row1->cg_title; ?>" style="height:90px !important; width:150px !important;">

                        </a>
                        </li>
						<?php 
							 }
						      else
							  {
						     ?>
                              <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;">
                               <a class="video thumbnail cboxElement" href="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_data); ?>" title="<?php echo $row1->cg_title;?>" style="height:90px !important; width:150px !important; margin-right:3em!important;">
                               
                        
                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_thumb.'');?>" alt="<?php echo $row1->cg_title; ?>" style="height:90px !important; width:150px !important;">
                         </a>
                         </li>
							<?php 
								}
							 }
						 ?>
                    <?php 
				 }
			 }
			 ?>

             </ul>
             </div><!-------------------update-monita20130920--------------------->
             </div><!-------------------update-monita20130920--------------------->
    	 </div>
       </div>
</div>