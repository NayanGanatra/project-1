<?php $this->load->view('header'); ?>



<div class="container">

	<h1 class="title"><?php echo $title;?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

</div>



<hr class="header_hr"/>



<div class="container">

	<div class="row">



<div class="span10 nomargin">

	<div class="page_content">

		<?php $this->load->view('action_status'); ?>

        <ul class="thumbnails">

        <?php

			if($query)

			{

				foreach($query as $row)

				{

					?>

                    	<li class="span2" style="height:110px;">

                        <?php if($row->media_type == 0){ ?>

                        <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->media_title; ?>" href="<?php echo base_url('images/media/big/'.$row->media_data); ?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">

                        </a>

                        <span class="label label-inverse"><?php echo $row->ch_name;?></span>

                        <?php }else{
							/************************update-monita 20130823*********************************/
							     $str_temp=$row->media_data;
								 $str=substr($str_temp,0,4);
								
						         if($str=='http')
								 {?>

                        <a class="youtube thumbnail" href="<?php echo $row->media_data; ?>" title="<?php echo $row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">

                        </a>
                        <?php  }   else { ?>
                        
                                  <a class="video thumbnail cboxElement" href="<?php echo base_url('images/media/thumbs/'.$row->media_data); ?>" title="<?php echo $row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">

                        </a>  
                           <?php } 
						    /************************end of update-monita20130823*********************************/
						    ?>
                    
                       
                        <span class="label label-inverse"><?php echo $row->ch_name;?></span>

                        <?php } ?>

                    	</li>

                    <?php

				}

			}

			else

			{

				echo '<li>No news found.</li>';

			}

		?>

        </ul>

	</div>

</div>



<div class="span3" style=" margin-left:20px; margin-top:-20px; margin-bottom:20px;">

    <div class="sidebar">

    <?php $this->load->view('ca_menu'); ?>

        <?php 

		if(isset($chapter->ch_seo))

		{

			$this->load->view('chapter_menu');

		}

		else

		{

			$this->load->view('media_menu');

		}

		?>

        

        <?php $this->load->view('ads_panel'); ?>

    </div>

</div>



</div></div>

<?php $this->load->view('footer'); ?>

<!-------------------update-monita20130823------------------------>
<script src="<?php echo base_url(); ?>js/jwplayer.js"></script>
<script src="<?php echo base_url(); ?>js/jwplayer.html5.js"></script>
 <script type="text/javascript">jwplayer.key="MdrDQi1Fh+k7bKYiQHg7vMzh5lcZLMIsUFntqw==";</script>
<script type="text/javascript"> 
$(document).ready(function() {
							   
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
<!-------------------end of update-monita20130823------------------------->
