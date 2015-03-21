<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Committee Members <small>Add New</small></h1>
		</div>
        <hr />
          <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('cm_mm_id')){ echo "error";}?>">
                <label class="control-label">Member Name</label>
                <div class="controls">
                <select name="cm_mm_id" data-placeholder="Select a Member..." class="chzn-select" style="width:400px;" tabindex="1">
                  <option value="" <?php if(set_value('cm_mm_id') == '') {?> <?php } ?> ></option>
                  <?php
				  	$members = $this->dbcommittee->all_members();
					foreach($members as $members_row)
					{
						?>
							
						<option <?php if(set_value('cm_mm_id') == $members_row->mm_id) { ;?> selected="selected" <?php }?> value="<?php echo $members_row->mm_id; ?>"><?php echo $members_row->mm_fname.' '.$members_row->mm_lname.' - '.$members_row->mm_email; ?></option>
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
                	<?php $get_position = $this->dbcommittee->get_position();
							foreach($get_position as $get_position_row)
							{
					?>
                			<option <?php if(set_value('cm_position')==$get_position_row->name){ echo 'selected="selected"'; }?>  value="<?php echo $get_position_row->name; ?>"><?php echo $get_position_row->name; ?></option>
                    <?php
							}
					?>
                </select>
                
                <span class="help-inline"> <?php echo form_error('cm_position'); ?></span>
                </div>
                </div>
                
                <span class="span2">
                <div class="control-group <?php if(form_error('cm_year')){ echo "error";}?>">
                <label class="control-label">First Year</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_year" name="cm_year" placeholder="Year" value="<?php echo set_value('cm_year'); ?>">
                <span class="help-inline"> <?php echo form_error('cm_year'); ?></span>
                </div>
                </div>
                </span>
                
                <span class="span2">
                <div class="control-group <?php if(form_error('cm_year2')){ echo "error";}?>">
                <label class="control-label">Second Year</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_year2" name="cm_year2" placeholder="Year" value="<?php echo set_value('cm_year2'); ?>">
                <span class="help-inline"> <?php echo form_error('cm_year2'); ?></span>
                </div>
                </div>
                </span>
                
                <div class="control-group <?php if(form_error('cm_ch_id')){ echo "error";}?>">
                <label class="control-label">Chapter</label>
                <div class="controls">
                	<select name="cm_ch_id">
                        <?php
							$chapters = $this->dbadminheader->get_chapters();
							foreach($chapters as $chapters_row)
							{
								if(set_value('cm_ch_id') == $chapters_row->ch_id || $this->uri->segment(4) == $chapters_row->ch_id)
								{
								?>
                                <option selected="selected" value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>
                                <?php
								}
								else
								{
								?>
                                <option value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>
                                <?php
								}
							}
						?>
                        
                    </select>
                <span class="help-inline"><?php echo form_error('cm_ch_id'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('cm_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Status</label>
                <div class="controls">
                    <select name="cm_status" style="width:100px;">
						<option <?php if(set_value('cm_status') == '1') { ?> selected="selected" <?php }?> value="1">Active</option>
                        <option <?php if(set_value('cm_status') == '0') { ?> selected="selected" <?php }?> value="0">Deactive</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('cm_status'); ?></span>
                </div>
            	</div>
                
                <div class="control-group <?php if(form_error('cm_order')){ echo "error";}?>">
                <label class="control-label">Sort Order</label>
                <div class="controls">
                <input class="input-small" type="text" id="cm_order" name="cm_order" value="<?php echo set_value('cm_order'); ?>">
                <span class="help-inline"> <?php echo form_error('cm_order'); ?></span>
                </div>
                </div>
                
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>