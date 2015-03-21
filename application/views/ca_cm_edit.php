<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/committee.html'); ?>">Manage Committee Members</a>
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
                echo form_open_multipart('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('cm_mm_id')){ echo "error";}?>">
                <label class="control-label">Member Name</label>
                <div class="controls">
                <select name="cm_mm_id" data-placeholder="Select a Member..." class="chzn-select" style="width:285px;" tabindex="1">
                  <option value=""></option>
                  <?php
				  	$members = $this->dbca->get_members($user->mm_chapter_id);
					foreach($members as $members_row)
					{
						?>
							
						<option <?php if($get_cm->cm_mm_id == $members_row->mm_id) { ;?> selected="selected" <?php }?> value="<?php echo $members_row->mm_id; ?>"><?php echo $members_row->mm_fname.' '.$members_row->mm_lname; ?></option>
                        <?php 
					}
				  ?>                  
                </select>
                <span class="help-inline"> <?php echo form_error('cm_mm_id'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('cm_position')){ echo "error";}?>">
                <label class="control-label">Position</label>
                <div class="controls">                
                <select class="input-xlarge" id="cm_position" name="cm_position">
                	<?php $get_position = $this->dbca->get_position();
							foreach($get_position as $get_position_row)
							{
					?>
                			<option <?php if($get_cm->cm_position==$get_position_row->name){ echo 'selected="selected"'; }?>  value="<?php echo $get_position_row->name; ?>"><?php echo $get_position_row->name; ?></option>
                    <?php
							}
					?>
                </select>
                
                <span class="help-inline"> <?php echo form_error('cm_position'); ?></span>
                </div>
                </div>
                
              
                <span class="span2 nomargin">
                <div class="control-group <?php if(form_error('cm_year')){ echo "error";}?>">
                <label class="control-label">First Year</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_year" name="cm_year" placeholder="Year" value="<?php echo $get_cm->cm_year; ?>">
                <span class="help-inline"> <?php echo form_error('cm_year'); ?></span>
                </div>
                </div>
                </span>
                
                <span class="span2">
                <div class="control-group <?php if(form_error('cm_year2')){ echo "error";}?>">
                <label class="control-label">Second Year</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_year2" name="cm_year2" placeholder="Year" value="<?php echo $get_cm->cm_year2; ?>">
                <span class="help-inline"> <?php echo form_error('cm_year2'); ?></span>
                </div>
                </div>
                </span>
                
                <div class="control-group <?php if(form_error('cm_order')){ echo "error";}?>">
                <label class="control-label">Short Order</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_order" name="cm_order" placeholder="Order" value="<?php echo $get_cm->cm_order; ?>">
                <span class="help-inline"> <?php echo form_error('cm_order'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('cm_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Status</label>
                <div class="controls">
                    <select name="cm_status" style="width:100px;">
						<option <?php if($get_cm->cm_status == '1') { ?> selected="selected" <?php }?> value="1">Active</option>
                        <option <?php if($get_cm->cm_status == '0') { ?> selected="selected" <?php }?> value="0">Deactive</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('cm_status'); ?></span>
                </div>
            	</div>
                
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
                
            
                <?php
			
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
	$('#media_type').change(function() {
		
		if($('#media_type').val() == 1)
		{
			$('#photo_holder').hide();
			$('#media_data_holder').show();
			$('#thumb_holder').show();
		}
		else
		{
			$('#photo_holder').show();
			$('#media_data_holder').hide();
			$('#thumb_holder').hide();
		}
	});
</script>
<?php $this->load->view('footer'); ?>