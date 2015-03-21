<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_newsletter');?> <small><?php echo $this->lang->line('btn_text_add_newsletter');?></small></h1>
		</div>
        <hr>
	
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

             <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_subject');?></label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="subject" name="subject" value="<?php echo set_value('subject'); ?>">
                    <span class="help-inline"><?php echo form_error('subject'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php echo set_value('html'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>
                <div class="controls">
                    <select name="queued" style="width:150px;">
						<option <?php if(set_value('queued') == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>
                        <option <?php if(set_value('queued') == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('queued'); ?></span>
                </div>
            </div>
            
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
            
		</form>

</td></tr></table>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>