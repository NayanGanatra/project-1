<?php $this->load->view('admincp/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_template');?> <small><?php echo $this->lang->line('text_edit_template');?></small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
            
            <div class="control-group <?php if(form_error('template_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="covers_cat_name" name="template_title" value="<?php echo $get_template->template_title; ?>">
                    <span class="help-inline"><?php echo form_error('template_title'); ?></span>
                </div>
            </div>
            
             <div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php echo $get_template->template_html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>
           <div class="space10px"></div>   
             <div class="row">
            <div style="display:none;" class="span11">
            <label class="control-label">Select Chapter</label>
            <table><tr>
            <?php
				$chapter = $this->dbadminheader->get_chapters();
				$i = 0;
				foreach($chapter as $chapter_row)
				{
					if($i%6==0)
					{
						?>
                        </tr><tr>
                        <?php
					}
					?>
                    <td>
						<span class="span3">
                            <label class="checkbox">
                                
                                 <input checked="checked"  type="checkbox" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
                        
                            </label>
                        </span>
                    </td>
                    <?php
				$i++;
				}
			?>
            </tr></table>
            </div>
            </div>
             <div class="control-group <?php if(form_error('template_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="template_status" class="input-medium">
                <option <?php if($get_template->template_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($get_template->template_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('template_status'); ?></span>
                </div>
            </div>
                  <input type="hidden" name="template_id" value="<?php echo $get_template->template_id; ?>" />
          <input type="submit" value="<?php echo $this->lang->line('btn_save_changes'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>