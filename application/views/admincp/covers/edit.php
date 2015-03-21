<?php $this->load->view('admincp/layout/header'); ?>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_covers');?> <small><?php echo $this->lang->line('text_edit_cover');?></small></h1>
		</div>
        
         	<?php
                $form_attributes = array('id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
            <p style="float:right;"><img src="<?php echo base_url().'covers-images/download/'.$get_photos->covers_image; ?>" border="0" /></p>
            <div class="control-group <?php if(form_error('covers_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_title');?></label>
                <div class="controls">
                    <input type="text" id="covers_name" name="covers_name" value="<?php echo $get_photos->covers_name; ?>">
                    <span class="help-inline"><?php echo form_error('covers_name'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('covers_seo')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_friendly_url');?></label>
                <div class="controls">
                    <input type="text" id="covers_seo" name="covers_seo" value="<?php echo $get_photos->covers_seo; ?>">
                    <span class="help-inline"><?php echo form_error('covers_seo'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('covers_cat_id')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_categories');?></label>
                <div class="controls">
                    <select name="covers_cat_id" class="input_text">
                	<?php
						$get_photo_cat = $this->dbcovers->get_categories();
						foreach ($get_photo_cat as $photo_row)
						{
							if ($photo_row->covers_cat_id == $get_photos->covers_cat_id)
							{
							echo "<option selected value='".$photo_row->covers_cat_id."'>".$photo_row->covers_cat_name."</option>";
							}
							else
							{
							echo "<option value='".$photo_row->covers_cat_id."'>".$photo_row->covers_cat_name."</option>";
							}
						}
					?>
                </select>
                    <span class="help-inline"><?php echo form_error('covers_cat_id'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('covers_image')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_covers');?></label>
                <div class="controls">
                    <input type="file" name="covers_image" value="<?php echo $get_photos->covers_image ?>" />
                    <span class="help-inline"><?php echo form_error('covers_image'); ?> <?php echo $get_photos->covers_image;?></span>
                </div>
            </div>
            
            <br/>
            <input type="hidden" name="covers_old_image" value="<?php echo $get_photos->covers_image;?>" />
            <p><input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" /></p>
        </form>
	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>