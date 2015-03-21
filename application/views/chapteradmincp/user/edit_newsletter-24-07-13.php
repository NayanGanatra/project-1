<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <?php /*?><h1><?php echo $this->lang->line('text_newsletter');?> <small><?php echo $this->lang->line('btn_text_edit_newsletter');?></small></h1><?php */?>
                  <h1>Newsletter <small>Edit</small></h1> <!-- add by mayank 19/06/2013/13:33  -->
		</div>
        <hr>
	
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

             <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">
             <label class="control-label">Subject Title</label>
            	<?php /*?><label class="control-label" for="inputError"><?php echo $this->lang->line('text_subject');?></label><?php */?>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="subject" name="subject" value="<?php echo $item->subject; ?>">
                    <span class="help-inline"><?php echo form_error('subject'); ?></span>
                </div>
            </div>
			
			<div class="control-group <?php if(form_error('newsletter_template_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Select Template</label>
                <div class="controls">
                <select class="input-medium" name="newsletter_template_name" id="newsletter_template_name">
                <option value="">Please Select</option>
                <?php
					$get_template = $this->dbadminheader->get_template_for_newsletter();
					
					foreach($get_template as $get_template_row)
					{
					
						if($item->template_id==$get_template_row->template_id)
						{?>
                            <option selected="selected"  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>
                        <?php
						}
						else
						{?>
                            <option  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>
                        <?php
						}
					}
				?>
                </select>
                <span class="help-inline"><?php echo form_error('newsletter_template_name'); ?></span>
                </div>
            </div>
			
			<div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:70%; min-height:150px;" name="html" id="html"><?php if($item) echo $item->html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>
            
            <!--<div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php echo $item->html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>-->
            
            <div class="control-group <?php if(form_error('newsletter_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="newsletter_status" class="input-medium">
                <option <?php if($item->newsletter_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($item->newsletter_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('newsletter_status'); ?></span>
                </div>
            </div>
            
            
            
            
            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">
            <label class="control-label">Queued Newsletter</label>
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>
                <div class="controls">
                    <select name="queued" style="width:150px;">
						<option <?php if($item->queued == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>
                        <option <?php if($item->queued == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('queued'); ?></span>
                </div>
            </div>
            
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
            
		</form>

</td></tr></table>

<script>
$('#newsletter_template_name').change(function() {
	$.ajax({
	  url: BASE_URI+'chapteradmincp/user/get_template_chapter/'+$('#newsletter_template_name').val(),
	  success: function(data) {
		$('.nicEdit-main').html(data);
		$('#html').html(data);
		}
	});
});
</script>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>