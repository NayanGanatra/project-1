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
        

                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('event_name')){ echo "error";}?>">
                <label class="control-label">Event Title</label>
                <div class="controls">
                <input class="input-xlarge" type="text" id="event_name" name="event_name" placeholder="Event Title" value="<?php echo set_value('event_name'); ?>">
                <span class="help-inline"><?php echo form_error('event_name'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('event_description')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Event Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;"name="event_description" id="event_description"><?php echo set_value('event_description'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('event_description'); ?></span>
                </div>
            	</div>
                
                <div class="control-group <?php if(form_error('event_date_time')){ echo "error";}?>">
                <label class="control-label">Date</label>
                <div class="controls">
                <input class="input-large" type="text" id="datetimepicker" name="event_date_time" placeholder="Date" value="<?php echo set_value('event_date_time'); ?>">
                <span class="help-inline"><?php echo form_error('event_date_time'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('event_location')){ echo "error";}?>">
                <label class="control-label">Event Location</label>
                <div class="controls">
                <input class="input-xxlarge" type="text" id="event_location" name="event_location" placeholder="Event Location" value="<?php echo set_value('event_location'); ?>">
                <span class="help-inline"><?php echo form_error('event_location'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('event_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                    <select name="event_status" style="width:100px;">
                        <option <?php if(set_value('event_status') == 1){echo 'selected="selected"'; }?> value="1">Active</option>
                        <option <?php if(set_value('event_status') == 2){echo 'selected="selected"'; }?> value="2">Archived</option>
                        <option <?php if(set_value('event_status') == 0){echo 'selected="selected"'; }?> value="0">Inactive</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('event_status'); ?></span>
                </div>
            </div>
                
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>

        
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