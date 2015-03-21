<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_event.html'); ?>">Add Event</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content events_page">
		<?php $this->load->view('action_status'); ?>
        
        <?php
			if($query)
			{
				foreach($query as $row)
				{
					$count_invitation = $this->dbheader->count_invitation($row->event_id);
					$count_rsvp = $this->dbheader->count_rsvp($row->event_id);
					$count_confirm = $this->dbheader->count_confirm($row->event_id);
					$count_maybe = $this->dbheader->count_maybe($row->event_id);
					$count_notcoming = $this->dbheader->count_notcoming($row->event_id);
					$count_people = $this->dbheader->count_people($row->event_id);
					?>
                    	<h3 class="nopadding nomargin"><a href="<?php echo base_url('ca/event_details/'.$chapter->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>"><?php echo $row->event_name;?></a>
                        <?php if($row->event_status == 1){ ?><span class="label label-success">Upcoming</span><?php } ?>
                        <?php if($row->event_status == 2){ ?><span class="label label">Archived</span><?php } ?>
                        </h3>
                        <h6 class="nopadding nomargin"><?php echo date('D, d M Y H:i:s',strtotime($row->event_date_time)); ?></h6>
                        <p><?php echo  character_limiter(strip_tags($row->event_description,400));?></p>
                        <div>
                        <span class="label"><a title="<?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invitation Sent" class="ajax" href="<?php echo base_url('ca/get_invitation/'.$row->event_id); ?>"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invitation Sent</a></span>
                        
                        <span class="label label-info"><a title="<?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP" class="ajax" href="<?php echo base_url('ca/get_rsvp/'.$row->event_id); ?>"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</a></span>
                        
                        <span class="label label-success"><a title="<?php if($count_people) { echo $count_people->adults+$count_people->kids.' Coming | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0'; } ?>" class="ajax" href="<?php echo base_url('ca/get_people/'.$row->event_id); ?>"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Coming | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0'; } ?></a></span>
                        
                        <span class="label label-warning"><a title="<?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe" class="ajax" href="<?php echo base_url('ca/get_maybe/'.$row->event_id); ?>"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</a></span>
                        
                        <span class="label label-important"><a title="<?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming" class="ajax" href="<?php echo base_url('ca/get_notcoming/'.$row->event_id); ?>"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</a></span>
                        
                        <span class="label label-inverse"><a title="<?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending" class="ajax" href="<?php echo base_url('ca/get_pending/'.$row->event_id); ?>"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</a></span>
                        
                        </div>
                        <div class="space10px"></div>
                        <p class="small">
                        <a href="<?php echo base_url('ca/event_details/'.$chapter->ch_seo.'/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Read More</a> | 
                        
                        <a href="<?php echo base_url('ca/edit_event/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Edit</a> | 
                        <a onclick="javascript: return del();" href="<?php echo base_url('ca/delete_event/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Delete</a> | 
                        <a href="<?php echo base_url('ca/invite/event/'.$row->event_id.'/'.friendlyURL($row->event_name).'.html'); ?>">Invite Members</a>
                        
                        </p>
                    <?php
				}
			}
			else
			{
				echo 'No news found.';
			}
		?>
        
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>