<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_asset_categories');?> <small><?php echo $this->lang->line('text_edit_category');?></small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            
            <div class="control-group <?php if(form_error('assets_cat_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_category_name');?></label>
                <div class="controls">
                    <input type="text" id="assets_cat_name" name="assets_cat_name" value="<?php echo $get_page->assets_cat_name; ?>">
                    <span class="help-inline"><?php echo form_error('assets_cat_name'); ?></span>
                </div>
            </div>
            
            
            <div class="control-group <?php if(form_error('is_bg')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_asset_background');?></label>
                <div class="controls">
                    <select name="is_bg" style="width:100px;">
					<?php if($get_page->is_bg == '0')
                        {
                        ?>
                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_no');?></option>
                        <option value="1"><?php echo $this->lang->line('misc_yes');?></option>
                        <?php
                        }
                        else
                        {
                        ?>
                        <option value="0"><?php echo $this->lang->line('misc_no');?></option>
                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_yes');?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('is_bg'); ?></span>
                </div>
            </div>
            
            
            <div class="control-group <?php if(form_error('is_active')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                    <select name="is_active" style="width:100px;">
					<?php if($get_page->is_active == '0')
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
            
            <input type="hidden" name="id" value="<?php echo $get_page->assets_cat_id; ?>" />
			<input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>