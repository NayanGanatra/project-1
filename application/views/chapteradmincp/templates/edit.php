<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1 style="display:inline;">Edit Photo</h1>
		</div>
        
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <div class="space10px"></div>
            <fieldset>
                <legend>Photo Details</legend>
                
                <p>
                <p><label>Photo Name:</label><input type="text" name="covers_name" class="input_text" size="40" value="<?php echo $get_photos->covers_name; ?>" /> <?php echo form_error('covers_name'); ?></p>
                
                 <p><label>Category:</label>
                <select name="covers_cat_id" class="input_text">
                	<?php
						$get_photo_cat = $this->dbtemplates->get_categories();
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
                </select> <?php echo form_error('covers_cat_id'); ?></p>
                
                   <input type="hidden" name="covers_old_image" value="<?php echo $get_photos->covers_image;?>" />
                <p><label>Image:</label><input type="file" name="covers_image" value="<?php echo $get_photos->covers_image ?>" /> <?php echo $get_photos->covers_image;?><?php echo form_error('covers_image'); ?>
                </p>
                <p>
                <label></label><img src="<?php echo base_url().'covers-images/thumbs/'.$get_photos->covers_image; ?>" border="0" width="200" />
                </p>
          
            </fieldset>
               
            <div style="margin-top:6px;"><input type="submit" value="Save" class="submit_btn" /></div>
            <div class="space20px"></div>

	</td>
  </tr>
</table>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>