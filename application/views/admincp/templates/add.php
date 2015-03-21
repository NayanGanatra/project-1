<?php $this->load->view('admincp/layout/header'); ?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1 style="display:inline;">Add New Templates</h1>
		</div>
        
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <div class="space10px"></div>
            <fieldset>
                <legend>Template Details</legend>
                
                <p><label>Template Name:</label><input type="text" name="templates_name" class="input_text" size="40" value="<?php echo set_value('templates_name'); ?>" /> <?php echo form_error('templates_name'); ?></p>
                
                <p><label>Image:</label><input type="file" name="photo_image" /> <?php echo form_error('photo_image'); ?></p>
                
                <p><label>Num of Pics In Temp:</label><input type="text" name="temp_numofpics"  id="temp_numofpics"  value="<?php echo set_value('temp_numofpics'); ?>" /> <?php echo form_error('temp_numofpics'); ?></p>
                
                <p><label>Size</label>
                <select name="temp_img_size" id="temp_img_size" style="width:80px;">
                	<?php
                    for($i=50;$i<=170;)
					{
						?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?>X<?php echo $i; ?></option>
                        <?php
						$i+=10;
					}
					?>
                </select>
                </p>
                
                <p><label>Status:</label>
                <select name="temp_show" id="temp_show">
                	<?php
					if(isset($_POST['temp_show']) && $_POST['temp_show']=='0')
					{
						?>
                        <option value="0" selected="selected">Deactive</option>
                        <option value="1">Active</option>
                        <?php
					}
					else
					{
						?>
                        <option value="1" selected="selected">Active</option>
                        <option value="0">Deactive</option>
                        <?php
					}
					?>
                </select>
                </p>
                
<div style="margin-top:6px;"><input type="submit" value="Next >>" class="submit_btn" /></div>
            <div class="space20px"></div>
         
</table>
<?php $this->load->view('admincp/layout/footer'); ?>