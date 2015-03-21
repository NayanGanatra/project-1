<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_slider');?> <small><?php echo $this->lang->line('text_edit_slider');?></small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <div class="control-group <?php if(form_error('title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input type="text" id="title" name="title" value="<?php echo $get_item->title; ?>">
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('link')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_link');?></label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="link" name="link" value="<?php echo $get_item->link; ?>">
                    <span class="help-inline"><?php echo form_error('link'); ?></span>
                </div>
            </div>
            
            <div class="control-group">
            <label class="control-label"><?php echo $this->lang->line('image');?></label>
            <div class="controls">
            <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline">Select Image</span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('is_active')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                    <select name="is_active" style="width:100px;">
					<?php if(set_value('is_active') == $get_item->is_active)
                        {
                        ?>
                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_deactive');?></option>
                        <option value="1"><?php echo $this->lang->line('misc_active');?></option>
                        <?php
                        }
                        else
                        {
                        ?>
                        <option value="0"><?php echo $this->lang->line('misc_deactive');?></option>
                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_active');?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('is_active'); ?></span>
                </div>
            </div>
            <input type="hidden" name="old_image" value="<?php echo $get_item->image;?>" />
			<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>