<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_template');?> <small><?php echo $this->lang->line('text_add_template');?></small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
            
            <div class="control-group <?php if(form_error('template_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="covers_cat_name" name="template_title" value="<?php echo set_value('template_title'); ?>">
                    <span class="help-inline"><?php echo form_error('template_title'); ?></span>
                </div>
            </div>
            
          	<div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php echo set_value('html'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>
            
            
            
             <div class="space10px"></div>   
             <div class="row">
           <input style="visibility:hidden"  checked="checked" type="checkbox" id="chapter[]" name="chapter[]" value="<?php echo $this->session->userdata('get_chapter_id'); ?>"  />
            
            <div class="space10px"></div>   
             
            <div class="control-group <?php if(form_error('template_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="template_status" class="input-medium">
                <option <?php if(set_value('template_status') == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if(set_value('template_status') == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('template_status'); ?></span>
                </div>
            </div>
          <input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>