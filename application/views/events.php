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

        

        <?php

			if($query)

			{

				$a=0;

				foreach($query as $row)

				{

					$count_invitation = $this->dbheader->count_invitation($row->event_id);

					$count_rsvp = $this->dbheader->count_rsvp($row->event_id);

					$count_confirm = $this->dbheader->count_confirm($row->event_id);

					$count_maybe = $this->dbheader->count_maybe($row->event_id);

					$count_notcoming = $this->dbheader->count_notcoming($row->event_id);

					$count_people = $this->dbheader->count_people($row->event_id);

					?>

                    	<?php if(isset($chapter->ch_seo)) { ?>

                    	<h4 class="nopadding nomargin bold"><a href="<?php echo base_url('events/'.$chapter->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>"><?php echo $row->event_name;?></a>

                        <?php if($row->event_status == 1){ ?><span class="label label-success">Upcoming</span><?php } ?>

                        <?php if($row->event_status == 2){ ?><span class="label label">Archived</span><?php } ?><span class="label label-inverse" style="float:right;"><?php echo $row->ch_name; ?></span>

                        </h4>

                        <h6 class="nopadding nomargin">Date : <b><?php echo $row->event_date_time; ?></b> | Location : <b><?php echo $row->event_location; ?></b></h6>

                        <p><?php echo  character_limiter(strip_tags($row->event_description,150));?></p>

                        <div>

                        <span class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span>

                        <span class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span>

                        <span class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span>

                        <span class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span>

                        <span class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span>

                        <span class="label label-inverse"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</span>

                        </div>

                        <div class="space10px"></div>

                        <p class="small">

                        <a href="<?php echo base_url('events/'.$chapter->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Read More</a>

                        </p>

                        <?php } else {?>

                        <h4 class="nopadding nomargin bold"><a href="<?php echo base_url('events/'.$row->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>"><?php echo $row->event_name;?></a>

                        <?php if($row->event_status == 1){ ?><span class="label label-success">Upcoming</span><?php } ?>

                        <?php if($row->event_status == 2){ ?><span class="label label">Archived</span><?php } ?><span class="label label-inverse" style="float:right;"><?php echo $row->ch_name; ?></span>

                        </h4>

                        <h6 class="nopadding nomargin">Date : <b><?php echo $row->event_date_time; ?></b> | Location : <b><?php echo $row->event_location; ?></b></h6>

                        <p><?php echo  character_limiter(strip_tags($row->event_description,150));?></p>

                        

                        <div>

                        <span class="label"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invited</span>

                        <span class="label label-info"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</span>

                        <span class="label label-success"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Confirm | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0 Coming'; } ?></span>

                        <span class="label label-warning"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</span>

                        <span class="label label-important"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</span>

                        <span class="label label-inverse"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</span>

                        </div>

                        <div class="space10px"></div>

                        <p class="small">

                        <a href="<?php echo base_url('events/'.$row->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Read More</a>

                        </p>

                        <?php } ?>

                        <hr class="hr_2px nomargin"/>

                    <?php

				$a++;

				}

			}

			else

			{

				echo 'No Events found.';

			}

		?>

		

        <div class="clear"></div>

        

        <div style="clear:both;">

		<?php echo $this->pagination->create_links(); ?>

        </div>



        </div>

</div>



<div class="span3" style=" margin-left:20px; margin-top:-20px;">

    <div class="sidebar">

    <?php $this->load->view('ca_menu'); ?>

         <?php 

		if(isset($chapter->ch_seo))

		{

		$this->load->view('chapter_menu');

		}

		else

		{

			$this->load->view('events_menu');

		}

		?>

        

        <?php $this->load->view('ads_panel'); ?>

        <div class="space20px"></div>

    </div>

</div>



</div></div>

<?php $this->load->view('footer'); ?>