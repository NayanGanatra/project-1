<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span3">
    <h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <?php
		if($invitations->status_id == 0)
		{
	?>
    <div class="span10 offset sub_link" align="right">
    	<span><strong>Will you attend this event?</strong></span> 
        <span><a class="btn btn-success inline cboxElement" href="#yes">Yes</a></span>
        <span><a class="btn btn-warning" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/maybe'); ?>">Maybe</a></span>
        <span><a class="btn btn-danger" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/no'); ?>">No</a></span>
    </div>
    <?php } ?>
    <?php
		if($invitations->status_id == 1)
		{
	?>
    <div class="span10 offset sub_link" align="right">
    	<?php
			$get_rsvp_by_count = $this->dbuser->get_rsvp_by_count($invitations->rsvp_by_mm_id,$invitations->event_id,$invitations->rsvp_by_mm_id);
		?>
    	<span><strong>RSVP already done, <span class="label label-success">You will attend this event!</span></strong></span> 
        <span class="badge badge-warning">Adult : <?php echo $get_rsvp_by_count->adult_count; ?></span>
        <span class="badge badge-info">Kids : <?php echo $get_rsvp_by_count->kids_count; ?></span>
    </div>
    <div class="span10 offset sub_link" align="right"  style=" width:480px; float:right"> 
    <div style="width:345px; float:left">
    	<span><strong>Did you change your mind for this event?</strong></span> <br />
        <span><strong>Are you attending this event ?</strong></span> 
    </div>
		<div style="float:right">
        <span><a class="btn btn-warning" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/maybe'); ?>">Maybe</a></span>
        <span><a class="btn btn-danger" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/no'); ?>">No</a></span>
        </div>
    </div>
    <?php } ?>
    <?php
		if($invitations->status_id == 2)
		{
	?>
    <div class="span10 offset sub_link" align="right">
    	<span><strong>RSVP already done, <span class="label label-warning">You will not attend this event!</span></strong></span> 
        <span><a class="btn btn-success inline cboxElement" href="#yes">Change</a></span>
    </div>
   
    <div class="span10 offset sub_link" align="right">
    	<span><strong>Did you change your mind for this event?</strong></span> 
        <span><a class="btn btn-success inline cboxElement" href="#yes">Yes</a></span>
        
        <span><a class="btn btn-danger" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/no'); ?>">No</a></span>
    </div>
    <?php } ?>
    <?php
		if($invitations->status_id == 3)
		{
	?>
        <div class="span10 offset sub_link" align="right"  style=" width:450px; float:right"> 
    	<div style="width:315px; float:left">
        <span><strong>Did you change your mind for this event?</strong></span>
        <span><strong>Are you not attending this event ?</strong></span> 
        </div>
		<div style="float:right">
        <span><a class="btn btn-success inline cboxElement" href="#yes">Yes</a></span>
        <span><a class="btn btn-warning" href="<?php echo base_url('user/invitation_details/'.$invitations->event_id.'/'.$invitations->unique_number.'/maybe'); ?>">Maybe</a></span>
       </div>
   		</div>
    <?php } ?>
    
    	<div style="display:none">
			<div style="padding:10px; background:#fff;" id="yes">
			<p><strong>Yes, I'll attend this event.</strong></p>
				<?php
                $form_attributes = array( 'id' => 'yes');
                echo form_open('', $form_attributes);
           		?>
                <label>No. of person will attend this event</label>
                <input class="input-small" type="text" name="adults" id="adults" placeholder="Adults" />
                <input class="input-small" type="text" name="child" id="child" placeholder="Child" />
                
                <div class="control-group <?php if(form_error('comments')){ echo "error";}?>">
                <div class="controls">
                <textarea class="input-xxlarge" type="text" id="comments" name="comments" placeholder="Comments"></textarea>
                <span class="help-inline"><?php echo form_error('comments'); ?></span>
                </div>
                </div>
                
                <div class="clear"></div>
                <span><a style="float:left;" href="javascript:void(0);" class="btn btn-primary" id="yes_btn">Confirm</a></span><span id="yes_loading" class="loading" style="display:none; padding-left:6px; padding-top:10px; background-position:center;"></span>
            </form>
			</div>
		</div>
        
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>                
       	<?php
			if($invitations)
			{
				$row = $invitations;
					?>
                    <h3><a href="javascript:void(0);"><?php echo $row->event_name; ?></a></h3>
                    
                    <?php
					$event_msg = $this->dbuser->get_event_msg_from_event_id($row->event_id);
					?>
                    
					<h4><?php echo $event_msg->event_subject; ?></h4>
                    <p><?php echo $event_msg->event_msg; ?></p>
                    <hr class="hr_2px nomargin"/>
                    
                    <div class="space10px"></div>
                    <?php
					$form_attributes = array( 'id' => 'pcomm');
					echo form_open('', $form_attributes);
					?>
                    <div class="control-group <?php if(form_error('comments')){ echo "error";}?>">
                    <div class="controls">
                    <label>Send Message to Admin</label>
                    <textarea style="width:98%; height:80px;" type="text" id="page_comments" name="page_comments" placeholder="Comments"></textarea>
                    <span class="error"><?php echo form_error('page_comments'); ?></span>
                    </div>
                    <input type="submit" value="Submit Message" class="btn btn-primary" />
                    </div>
                    
                    </form>
					<?php
					
					$event_inv_msg = $this->dbuser->event_inv_msg($row->event_id,$row->ei_id,$user->mm_id);
					if($event_inv_msg)
					{
						foreach($event_inv_msg as $event_inv_msg_row)
						{
						?>
                        	<div class="<?php if($event_inv_msg_row->msg_frm == $event_inv_msg_row->mm_id) { echo 'alert alert-info'; } else { echo 'alert alert-block'; } ?>" >
								<strong>Message From <?php if($event_inv_msg_row->msg_frm == $event_inv_msg_row->mm_id) { echo 'Me'; } else { echo 'Admin'; } ?></strong> | <em><?php echo $event_inv_msg_row->msg_time;?></em>
                            	<div><?php echo $event_inv_msg_row->msg;?></div>
                            </div>
                        <?php
						}
					}
			}
			else
			{
				?>
                <div class="alert alert-info">
                	Still you don't have any invitation so nothing to display here!
                </div>
                <?php
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
        <?php //$this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<script type="text/javascript">
$('#yes_btn').click(function() {

	$('#yes_loading').show();

	var adults = $("input#adults").val();
  		if (isNaN(adults)) {
        $("label#adults_error").show();
        $("input#adults").focus();
		alert('Please enter number of adults');
		$('#yes_loading').hide();
        return false;
      }
	
	var adults = $("input#adults").val();
	var child = $("input#child").val();
	var comments = $("#comments").val();
	var mm_id = '<?php echo $row->mm_id; ?>';
	var unique_number = '<?php echo $row->unique_number; ?>';
	var event_id = '<?php echo $row->event_id; ?>';
	var ei_id = '<?php echo $row->ei_id; ?>';
	var event_ch_id = '<?php echo $row->event_ch_id; ?>';
	var dataString = 'adults='+ adults + '&child=' + child + '&comments=' + comments + '&mm_id=' + mm_id + '&unique_number=' + unique_number + '&event_id=' + event_id + '&ei_id=' + ei_id + '&event_ch_id=' + event_ch_id;
  
	$.ajax({
      type: "POST",
      url: "<?php echo base_url('user/rsvp/');?>",
      data: dataString,
      success: function(data) {
		if(data == 'ok')
		{
			/*$('#yes').html("<div id='message'></div>");
			$('#message').html("<h2>Thanks for your RSVP!</h2><a href='javascript:void(0);' id='cboxcancelbtn'>Okey</a>")
			.hide()
			.fadeIn(1500, function() {
			});*/
			$('#yes_loading').hide();
			location.reload(true);
		}
		if(data == 'error')
		{
			$('#message').html("<p class='error'>Sorry, RSVP coun't sent, please refresh this page and try again.</p>");
			$('#yes_loading').hide();
		}
      }
    });
    return false;
});

</script>

<?php $this->load->view('footer'); ?>