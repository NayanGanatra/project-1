<?php $this->load->view('admincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>

        <div class="dotted_line">
		        <h1><?php echo $title;?> <small></small></h1>
		</div>
        <hr>
        
            <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>
		<span class="span5">            
            <div class="control-group <?php if(form_error('select_option')){ echo "error";}?>">
            <label class="control-label">Send Email To:</label>
            <div class="controls">
            	<select name="select_option" id="select_option">
                	<option value="all">All Members</option>
                    <option value="selected">Selected Members</option>
                </select>
            <span class="help-inline"><?php echo form_error('select_option'); ?></span>
            </div>
            </div> 
            
            <div class="control-group <?php if(form_error('members_id')){ echo "error";}?>" id="members_id_block" style="display:none;">
            <label class="control-label">Select Members</label>
            <div class="controls">
            	<select name="members_id[]" id="members_id" multiple="multiple" data-placeholder="Type Name To Select Members..." class="chzn-select" style="width:400px;" tabindex="1">
                  <option value="" <?php if(set_value('members_id') == '') {?> <?php } ?> ></option>
                  <?php
				  	$members = $this->dbuser->list_all_members_for_email();
					foreach($members as $members_row)
					{
						?>
							
						<option <?php if(set_value('members_id') == $members_row->mm_id) { ;?> selected="selected" <?php }?> value="<?php echo $members_row->mm_id; ?>"><?php echo $members_row->mm_fname.' '.$members_row->mm_lname.' - '.$members_row->mm_email; ?></option>
                        <?php 
					}
				  ?>                  
                </select>
            <span class="help-inline"><?php echo form_error('members_id'); ?></span>
            </div>
            </div>
            
            

            </div>
            </div>
            </span>
                        
            <div class="clear"></div>
            <div class="control-group">
            <div class="controls">
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-primary" />
            </div>
            </div>
            
        </span>
        
        
	</td></tr></table>
    
<script type="text/javascript">

$('#select_option').change(function() {

	if($('#select_option').val() == 'all')
	{
		$('#members_id_block').hide();
	}
	else
	{
		$('#members_id_block').show();
	}
	
});
</script>
<?php $this->load->view('admincp/layout/footer'); ?>