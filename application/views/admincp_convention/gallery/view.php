<?php $this->load->view('admincp_convention/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Gallery <small>Manage Gallery</small></h1>

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

                        <?php if($row->cg_type == 0){ ?>
                        <li class="span2" style=" height:140px">

                        <a  rel="gallery" class="gallery thumbnail" title="<?php echo $row->cg_title; ?>" href="<?php echo base_url('images/convention/gallery/big/'.$row->cg_data); ?>">

                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>">

                        </a>
                        <div align="center"><span><?php echo $row->ca_name ?></span></div>
                        <span><a title="Edit" href="<?php echo base_url('admincp_convention/gallery/edit/'.$row->cg_id.'/'.friendlyURL($row->cg_title).'.html');?>"><i class="icon-edit"></i></a></span>
                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('admincp_convention/gallery/delete/'.$row->cg_id.'/'.friendlyURL($row->cg_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
 </li>  <!-------------------------------------chepters---------------------------------------->
                        <?php

							/*$chapter = $this->dbadminheader->get_chapters();

							$chaptername='';

							foreach($chapter as $chapter_row)

							{

								$ch_to_news = $this->dbgallery->ch_to_gallery($row->cg_id,$chapter_row->ch_id); 

								if($ch_to_news)

								{

									//$chaptername .=$chapter_row->ch_name.',';*/

									?>

									
<!--
									 <span class="label label-inverse" style="display:none"><?php //echo $chapter_row->ch_name;?></span>
-->
								<?php 
                             /*
								}

								

							}*/

						?>     
                                            
           <!-------------------------------------end of chepters---------------------------------------->
                        <?php //} ?>

                    <?php
		         	}
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
        	<div class="dotted_line myclass_video">


		        <h1>Video</h1>
                 
                 <ul class="thumbnails">

            <?php

			if($query)

			{

				foreach($query as $row)

				{

					?>

                        <?php if($row->cg_type == 1)
						     { 
						         $str_temp=$row->cg_data;
								 $str=substr($str_temp,0,4);
						         if($str=='http')
								 {
						?>
                        
                            <li class="span2">
                               <a class="youtube thumbnail cboxElement" href="<?php echo $row->cg_data; ?>" title="<?php echo $row->cg_title;?>">

                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>">

                        </a>
                             
                            <?php 
								 }
								 else
								 {
						     ?>
                              <li class="span2">
                               <a class="video thumbnail cboxElement" href="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_data); ?>" title="<?php echo $row->cg_title;?>">
                               
                        
                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>">
                         </a>
                        
                        <?php
								 }
						?>
                        <div align="center"><span><?php echo $row->ca_name ?></span></div>
                        <span><a title="Edit" href="<?php echo base_url('admincp_convention/gallery/edit/'.$row->cg_id.'/'.friendlyURL($row->cg_title).'.html');?>"><i class="icon-edit"></i></a></span> 

                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('admincp_convention/gallery/delete/'.$row->cg_id.'/'.friendlyURL($row->cg_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
                <!-------------------------------------chepters---------------------------------------->
                        <?php

						/*	$chapter = $this->dbadminheader->get_chapters();

							$chaptername='';

							foreach($chapter as $chapter_row)

							{

								$ch_to_news = $this->dbgallery->ch_to_gallery($row->cg_id,$chapter_row->ch_id); 

								if($ch_to_news)

								{

									

									//$chaptername .=$chapter_row->ch_name.',';*/

									?>

									

									<!-- <span class="label label-inverse" style="display:none"><?php echo $chapter_row->ch_name;?></span>-->

								<?php 

								//}

								

							//}

						?>                     
          <!-------------------------------------end of chepters---------------------------------------->
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
             
		</div>
<?php echo $this->pagination->create_links(); ?>

</div>

	</td></tr></table>

<?php $this->load->view('admincp_convention/layout/footer'); ?>
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
