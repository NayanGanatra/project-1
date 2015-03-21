<?php $this->load->view('header'); ?>



<!--		pradip changes for chaptermenu 201307261700-->

<div class="welcome-back-bg">



    <div class="container">

        <h1 class="title"><?php

		

		echo $title;?></h1>

        <?php if(isset($sub_title)) { ?>

        

        <?php 

            if($this->uri->segment(3) =='')

            {

                ?>

                <div class="ch_menu_links">

                <ul>

                <li style="background:none;"><b>Chapters :</b></li>

                <li <?php if($this->uri->segment(2) == "national") { ?> class="act" <?php } ?>><a href="<?php echo base_url('chapter/national.html'); ?>">National</a></li>

                <?php $chapters = $this->dbheader->get_all_chapters();

                    foreach($chapters as $chapters_row)

                    {

                        ?>

                        <li <?php if($this->uri->segment(2) == $chapters_row->ch_seo) { ?> class="act" <?php } ?>><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><?php

                            echo str_replace("Chapter", "", $chapters_row->ch_name); ?></a></li>

                        <?php

                    }

        ?>

            </ul>

            </div>

        <?php }else{ ?>

            <div class="sub_title"><?php echo $sub_title;?></div>

            <?php } } ?>

    

    </div>

</div>

<!--				end-->



<div class="container">

	<h1 class="title"><?php ?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

    

    <?php 

	if( $this->uri->segment(2) != 'national')

	{

		if(isset($states_of_chapter)){ 

			$num_state = count($states_of_chapter);

			$num_a = 1;

			echo '<div class="sub_title"> Chapter States (';

			foreach($states_of_chapter as $states_of_chapter_row)

			{

				if($num_a == $num_state)

				{

					echo $states_of_chapter_row->state_name;

				}

				else

				{

					echo $states_of_chapter_row->state_name.', ';

				}

				$num_a++;

			}

			echo ')<div class="space10px"></div></div><a class="inline" href="#chapter_description">About '.$title.'</a>';

		 }

	}?>

</div>



<div style="display:none;"><div style=" width:500px;" id="chapter_description"><?php echo $chapter->ch_desc; ?></div></div>

<hr class="header_hr"/>



<div class="container">

	<div class="row">



<div class="span10 nomargin">

        <div class="page_content">

        <?php $this->load->view('action_status'); ?>

        

        

        <h3 class="nomargin">Events <?php if($events){ ?><span class="offset6 small" style="float: right;"><a href="<?php echo base_url('events/'.$chapter->ch_seo.'.html'); ?>">more</a></span><?php } ?></h3>

        <hr class="hr_2px nomargin"/>

        <?php

			if($events)

			{

				foreach($events as $events_row)

				{

						

					?>

    

                    	<div class="span9 nomargin">

                    	<h4 class="nopadding nomargin bold"><a href="<?php echo base_url('events/'.$chapter->ch_seo.'/'.$events_row->event_id.'/'.friendlyURL($events_row->event_name).'.html'); ?>"><?php echo $events_row->event_name;?></a> 

						

						<?php if($events_row->event_status == 1){ ?><span class="label label-success">Upcoming</span><?php } ?>

                        <?php if($events_row->event_status == 2){ ?><span class="label label">Archived</span><?php } ?>

                        </h4>

                        <h6 class="nopadding nomargin"><?php echo date('D, d M Y H:i:s',strtotime($events_row->event_date_time)); ?></h6>

                        <p><?php echo  character_limiter(strip_tags($events_row->event_description,150));?></p>



<?php if($events_row->event_status == 1){ ?>                      

  <div>    

    <?php

	$count_invitation = $this->dbheader->count_invitation($events_row->event_id);

	$count_rsvp = $this->dbheader->count_rsvp($events_row->event_id);

	$count_confirm = $this->dbheader->count_confirm($events_row->event_id);

	$count_maybe = $this->dbheader->count_maybe($events_row->event_id);

	$count_notcoming = $this->dbheader->count_notcoming($events_row->event_id);

	$count_people = $this->dbheader->count_people($events_row->event_id);

	?>

    <span class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span>

    <span class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span>

    <span class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span>

    <span class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span>

    <span class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span>

    <span class="label label-inverse"><?php if($count_invitation) { if(isset($count_rsvp->total)){echo ($count_invitation->total-$count_rsvp->total);}else{echo $count_invitation->total; }}else{ echo '0'; } ?> Pending</span>

    </div>

<?php } ?>  

                        <p class="small">

                        <a href="<?php echo base_url('events/'.$chapter->ch_seo.'/'.$events_row->event_id.'/'.friendlyURL($events_row->event_name).'.html'); ?>">Read More</a>

                        </p>

                        </div>

                    <?php

				}

			}

			else

			{

				echo 'No Events found.';

			}

		?>



        <div class="clear"></div>

        <hr class="hr_2px"/>

 

		<h3 class="nomargin">Latest News <?php if($news){ ?><span class="offset6 small" style="float: right;"><a href="<?php echo base_url('news/'.$chapter->ch_seo.'.html'); ?>">more</a></span><?php } ?></h3>

        <hr class="hr_2px nomargin"/>

        <?php

			if($news)

			{

				$a=0;

				foreach($news as $row)

				{

						if($a%2==0)

						{

							if(count($news) == 1)

							{

								?><div class="span9"><?php

							}

							else

							{

								?><div class="span5 nomargin"><?php

							}

						}

						else

						{

							

							?><div class="span5" style="margin-left:25px;"><?php

						}

					?>

                    	

                    	<h4 class="nopadding nomargin bold"><a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>"><?php echo $row->news_title;?></a></h4>

                        <h6 class="nopadding nomargin"><?php echo date('D, d M Y H:i:s',strtotime($row->news_create)); ?></h6>

                        <p><?php echo  character_limiter(strip_tags($row->news_content,100));?></p>

                        <p class="small">

                        <a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Read More</a>

                        </p>

                        </div>

                    <?php

				$a++;

				}

			}

			else

			{

				echo 'No News found.';

			}

		?>

		

        <div class="clear"></div>

        <hr class="hr_2px"/>

        

        <h3 class="nomargin">Media Gallery <?php if($media){ ?><span class="offset6 small" style="float: right;"><a href="<?php echo base_url('media/'.$chapter->ch_seo.'.html'); ?>">more</a></span><?php } ?></h3>

        <hr class="hr_2px nomargin"/>

        <ul class="thumbnails">

        <?php

			if($media)

			{

				foreach($media as $media_row)

				{

						

					?>

                    

  					<li class="span2">

                        <?php if($media_row->media_type == 0){ ?>

                        <a rel="gallery" class="gallery thumbnail" title="<?php echo $media_row->media_title; ?>" href="<?php echo base_url('images/media/big/'.$media_row->media_data); ?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$media_row->media_thumb.'');?>" alt="<?php echo $media_row->media_title; ?>">

                        </a>

                        <?php }else{
							/************************update-monita 20130823*********************************/
							     $str_temp=$media_row->media_data;
								 $str=substr($str_temp,0,4);
								
						         if($str=='http')
								 {?>

                        <a class="youtube thumbnail" href="<?php echo $media_row->media_data; ?>" title="<?php echo $media_row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$media_row->media_thumb.'');?>" alt="<?php echo $media_row->media_title; ?>">

                        </a>
                        <?php  }   else { ?>
                        
                                  <a class="video thumbnail cboxElement" href="<?php echo base_url('images/media/thumbs/'.$media_row->media_data); ?>" title="<?php echo $media_row->media_title;?>">

                          <img src="<?php echo base_url('images/media/thumbs/'.$media_row->media_thumb.'');?>" alt="<?php echo $media_row->media_title; ?>">

                        </a>  
                           <?php }  ?>

                    	</li>

                        

                    <?php
						}

				}

			}

			else

			{

				echo '<li style="padding-left:6px;">No Media found.</li>';

			}

		?>

        </ul>

        <div class="clear"></div>

        <hr class="hr_2px"/>

        

        

              	

        </div>

</div>



<div class="span3" style=" margin-left:20px; margin-top:-20px; margin-bottom:20px;">

    <div class="sidebar">

    	<?php $this->load->view('ca_menu'); ?>

        <?php $this->load->view('chapter_menu'); ?>

        

        <div class="space20px"></div>

        <!-- ketan update 20130624-->

		<?php $this->load->view('poll_action_status'); ?>

		<?php $this->load->view('polls',$chapter_id); ?>

		<!-- ketan update end 20130624-->

        <?php $this->load->view('ads_panel'); ?>

        <?php $this->load->view('newsletter'); ?>

    </div>

</div>



</div></div>
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
<?php $this->load->view('footer'); ?>