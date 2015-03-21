<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/events.html'); ?>">Manage Events</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        
        <input type="button" onclick="selectAllCheckBoxes('members', 'mm_id[]', true);" value="Select All" class="btn btn-link">
        <input type="button" onclick="selectAllESentCheckBoxes('members', '.email_sent', true);" value="Email Sent" class="btn btn-link">
        <input type="button" onclick="selectAllESentCheckBoxes('members', '.not_sent', true);" value="Email Not Sent" class="btn btn-link">
        <input type="button" class="btn btn-link" onclick="selectAllCheckBoxes('members', 'mm_id[]', false);" value="Clear All">
        
        <span class="<?php if(form_error('mm_id[]')){ echo "error";}?>"> <?php echo form_error('mm_id[]'); ?></span>
        <div class="space10px"></div>   
		<?php
		$form_attributes = array( 'id' => 'members', 'name' => 'members');
		echo form_open('', $form_attributes);
        ?>
        
		<?php

			if($query)
			{
				foreach($query as $query_row)
				{
					$check_invitation = $this->dbca->check_event_invitation($query_row->mm_id,$queryC->event_id);
					?>
					<div class="span240" style="margin-bottom:15px;">
                    <label class="checkbox">
                  	<input class="<?php if($check_invitation && $query_row->mm_email != ''){echo 'email_sent';}else{ if($query_row->mm_email !=='') { echo 'not_sent';}}?>" type="checkbox" name="mm_id[]" id="mm_id[]" <?php echo set_checkbox('mm_id[]', $query_row->mm_id); ?> <?php if($query_row->mm_email == ''){ echo 'disabled="disabled"'; } ?> value="<?php echo $query_row->mm_id; ?>"> <?php echo $query_row->mm_fname.' '.$query_row->mm_lname; ?>
                    </label>
					</div>
					<?php
				}
			}
		?>
        <div class="clear"></div>
        	<div class="control-group <?php if(form_error('subject')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Email Subject</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" name="subject" value="<?php echo set_value('subject'); ?>" />
                    <span class="help-inline"><?php echo form_error('subject'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('event_msg')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Event Message</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:200px;"name="event_msg" id="event_msg"><?php 
						if(set_value('event_msg'))
						{
							echo set_value('event_msg');
						}
						else
						{
							?>
                            Dear SPCS Member,<br/>
                            You are invited to be a part of following event.
                            
                            <h4>Event Details</h4>
                            <h5><b><?php echo $queryC->event_name;?> </b></h5>
                            <b>Date &amp; Time:</b>
                            <?php echo $queryC->event_date_time;?><br/>
                            <b>Location:</b>
                            <?php echo $queryC->event_location;?><br/>
                            <?php
						}
						?>
                    </textarea>
                    <span class="help-inline"><?php echo form_error('event_msg'); ?></span>
                </div>
            </div>
        <div class="clear"></div>   
        <button type="submit" class="btn btn-primary">Send Invitation</button>
        </form>
        
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