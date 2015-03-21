<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Media <small>Manage Media</small></h1>

		</div>

        <hr>
           <div class="dotted_line">

		        <h1>Images</h1>
                 <ul class="thumbnails">
                   <?php

			if($query)

			{

				foreach($query as $row)

				{

					?>

                        <?php if($row->media_type == 0){   ?>
                        <li class="span2">
                            
                        <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->media_title; ?>" href="<?php echo base_url('images/media/big/'.$row->media_data); ?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">

                        </a>

                         

                        <span><a title="Edit" href="<?php echo base_url('chapteradmincp/media/edit/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span>

                        

                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('chapteradmincp/media/delete/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>

                        <span class="label label-inverse" style="display:none"><?php $chapter = $this->dbadminheader->get_chapter($this->session->userdata('get_chapter_id')); if($chapter){echo $chapter->ch_name;}?></span>
                            </li>
                        <?php }  ?>
                    	

                    <?php

				}

			}

			else

			{

				echo '<li>No media found.</li>';

			}

		?>

                </ul>
		</div>
         <hr>
            <div class="dotted_line myclass_video"><!----------monita-update20130813----------------->

		        <h1>Video</h1>
                 <ul class="thumbnails">
              <!------------update-monita20130812--------------------->
            <?php

			if($query)

			{

				foreach($query as $row)

				{

					?>

                        <?php if($row->media_type == 1)
						     { 
						         $str_temp=$row->media_data;
								 $str=substr($str_temp,0,4);
						         if($str=='http')
								 {
						?>
                        
                            <li class="span2">
                               <a class="youtube thumbnail cboxElement" href="<?php echo $row->media_data; ?>" title="<?php echo $row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">

                        </a>
                            <?php 
								 }
								 else
								 {
						     ?>
                              <li class="span2">
                               <a class="video thumbnail cboxElement" href="<?php echo base_url('images/media/thumbs/'.$row->media_data.'');?>" title="<?php echo $row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">
                          </a>
                        <?php
								 }
						?>

                        <span><a title="Edit" href="<?php echo base_url('chapteradmincp/media/edit/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span> 

                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('chapteradmincp/media/delete/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>

                        <?php

							$chapter = $this->dbadminheader->get_chapters();

							$chaptername='';

							foreach($chapter as $chapter_row)

							{

								$ch_to_news = $this->dbadminheader->ch_to_media($row->media_id,$chapter_row->ch_id); 

								if($ch_to_news)

								{

									

									//$chaptername .=$chapter_row->ch_name.',';

									?>

									

									 <span class="label label-inverse" style="display:none"><?php echo $chapter_row->ch_name;?></span>

								<?php 

								}

								

							}

						?>                     

                        <?php } ?>

                    	</li>

                    <?php

				}

			}

			else

			{

				echo '<li>No media found.</li>';

			}

		?>

                      </li>

                </ul>
             <!------------end of update-monita20130812--------------------->
		</div>

        <hr>
        <ul class="thumbnails">


        </ul>



<?php echo $this->pagination->create_links(); ?>

</div>

	</td></tr></table>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>
<!-------------------update-monita20130813------------------------->
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