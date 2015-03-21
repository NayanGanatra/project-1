<?php $this->load->view('header'); ?>

<div class="container events_page">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
	
    <div>    
    <?php
	$count_invitation = $this->dbheader->count_invitation($query->event_id);
	$count_rsvp = $this->dbheader->count_rsvp($query->event_id);
	$count_confirm = $this->dbheader->count_confirm($query->event_id);
	$count_maybe = $this->dbheader->count_maybe($query->event_id);
	$count_notcoming = $this->dbheader->count_notcoming($query->event_id);
	$count_people = $this->dbheader->count_people($query->event_id);
	?>
    <span class="label"><a title="<?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invitation Sent" class="ajax" href="<?php echo base_url('ca/get_invitation/'.$query->event_id); ?>"><?php if($count_invitation) {echo $count_invitation->total;}else{ echo '0'; } ?> Invitation Sent</a></span>
                        
    <span class="label label-info"><a title="<?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP" class="ajax" href="<?php echo base_url('ca/get_rsvp/'.$query->event_id); ?>"><?php if($count_rsvp) { echo $count_rsvp->total;}else{ echo '0'; } ?> RSVP</a></span>
    
    <span class="label label-success"><a title="<?php if($count_people) { echo $count_people->adults+$count_people->kids.' Coming | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0'; } ?>" class="ajax" href="<?php echo base_url('ca/get_people/'.$query->event_id); ?>"><?php if($count_people) { echo $count_people->adults+$count_people->kids.' Coming | Adults : '.$count_people->adults.' | Kids : '.$count_people->kids;}else{ echo '0'; } ?></a></span>
    
    <span class="label label-warning"><a title="<?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe" class="ajax" href="<?php echo base_url('ca/get_maybe/'.$query->event_id); ?>"><?php if($count_maybe) { echo $count_maybe->total;}else{ echo '0'; } ?> Maybe</a></span>
    
    <span class="label label-important"><a title="<?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming" class="ajax" href="<?php echo base_url('ca/get_notcoming/'.$query->event_id); ?>"><?php if($count_notcoming) { echo $count_notcoming->total;}else{ echo '0'; } ?> Not Coming</a></span>
    
    <span class="label label-inverse"><a title="<?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending" class="ajax" href="<?php echo base_url('ca/get_pending/'.$query->event_id); ?>"><?php if($count_invitation) {echo ($count_invitation->total-$count_rsvp->total);}else{ echo '0'; } ?> Pending</a></span>
    </div>
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
				echo $query->event_description;
			}
			else
			{
				redirect(base_url('error'));
			}
		?>
		
        
        <h4>Event Location</h4>
            
        <p><?php echo $query->event_location; ?></p>
        
        <div class="clear"></div>
        
        <hr class="hr_2px" />
        
         <div class="space10px"></div>
		<?php
        $form_attributes = array( 'id' => 'pcomm');
        echo form_open('', $form_attributes);
        ?>
        <div class="control-group <?php if(form_error('comments')){ echo "error";}?>">
        <div class="controls">
        <label>Broadcast Message</label>
        <textarea style="width:98%; height:80px;" type="text" id="page_comments" name="page_comments" placeholder="Comments"></textarea>
        <span class="error"><?php echo form_error('page_comments'); ?></span>
        </div>
        <input type="submit" value="Submit Message" class="btn btn-primary" />
        </div>
        </form>
        
        <?php
					$event_inv_msg = $this->dbca->event_inv_msg($query->event_id,$chapter->ch_id);
					
					if($event_inv_msg)
					{
						foreach($event_inv_msg as $event_inv_msg_row)
						{
						?>
                        	<div class="<?php if($event_inv_msg_row->msg_frm != 0) { echo 'alert alert-block'; } else { echo 'alert alert-info'; } ?>" >
								<strong>Message From <?php 
														if($event_inv_msg_row->ei_id != 0)
														{
															if($event_inv_msg_row->msg_frm == 0) {
																$user_details = $this->dbca->get_user_by_id($event_inv_msg_row->msg_to);
																if($user_details){
																echo "Me"; 
																$reply_box_id = $user_details->mm_id;
																}
															}
															else
															{
																$user_details = $this->dbca->get_user_by_id($event_inv_msg_row->msg_frm);
																if($user_details){
																echo $user_details->mm_fname.' '.$user_details->mm_lname.' ('.$user_details->mm_username.')'; 
																$reply_box_id = $user_details->mm_id;
																}
															}
														}else
														{ echo 'Me'; } ?></strong> | <em><?php echo $event_inv_msg_row->msg_time;?></em>
                                
                                
                                
                            	<div><?php echo $event_inv_msg_row->msg;?></div>
                                
                                <?php if($event_inv_msg_row->msg_frm != 0) { ?>
                                <div id="rep_msg_box_<?php echo $reply_box_id; ?>" style="display:none;">
								<?php
								$form_attributes = array( 'id' => 'reply_msg_form');
								echo form_open('', $form_attributes);
								?>
                                <textarea style="width:100%; height:40px;" type="text" id="reply_comments" name="page_comments" placeholder="Reply..."></textarea>
                                <input type="hidden" name="user_id" value="<?php echo $reply_box_id; ?>" />
                                <input type="hidden" name="ei_id" value="<?php echo $event_inv_msg_row->ei_id; ?>" />
                                <input type="submit" value="Send Message" class="btn btn-primary" />
                                </form>
                                </div>
                                <a href="javascript:void(0);" id="<?php echo $reply_box_id; ?>" class="reply">Reply</a>
                                
                                <?php } ?>
                            </div>
                        <?php
						}
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
<script type="text/javascript">
$('.reply').click(function() {
	$('#rep_msg_box_'+this.id).toggle();
	
	if ($(this).text() == "Reply")
       $(this).text("Close")
    else
       $(this).text("Reply");
	
  
});
</script>
<?php $this->load->view('footer'); ?>