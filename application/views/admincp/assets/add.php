<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_asset');?> <small><?php echo $this->lang->line('text_add_asset');?></small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <div class="control-group <?php if(form_error('assets_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input type="text" id="assets_name" name="assets_name" value="<?php echo set_value('assets_name'); ?>">
                    <span class="help-inline"><?php echo form_error('assets_name'); ?></span>
                </div>
            </div>
            
            <div class="control-group">
            <label class="control-label"><?php echo $this->lang->line('assets_image');?></label>
            <div class="controls">
            <input type="file" name="assets_image" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline">Select Image</span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('assets_cat_id')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_asset_categories');?></label>
                <div class="controls">
                    <select name="assets_cat_id">
                    <?php
						$cats = $this->dbassets->get_cats();
						
						foreach($cats as $cats_row)
						{
							if(set_value('assets_cat_id') == $cats_row->assets_cat_id)
							{
						?>
                        <option selected="selected" value="<?php echo $cats_row->assets_cat_id;?>"><?php echo $cats_row->assets_cat_name;?></option>
                        <?php
							}
							else
							{
						?>
                        <option value="<?php echo $cats_row->assets_cat_id;?>"><?php echo $cats_row->assets_cat_name;?></option>
                        <?php
							}
						
						}
					?>
                    </select>
                    <span class="help-inline"><?php echo form_error('assets_cat_id'); ?></span>
                </div>
            </div>
            
            
            
			<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>