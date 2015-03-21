<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo 'Convention'; ?> <small><?php echo 'Add Convention'?></small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
		<div class="control-group <?php if(form_error('con_name')){ echo "error";}?>">
			<label class="control-label" for="inputError">Name</label>
				<div class="controls">
                    <select id="covers_cat_name" name="con_name">
                    <option value="">Please select</option>
                     <?php $get_chapter = $this->dbconvention->get_chapter();
					foreach($get_chapter as $chapter){ ?>
					<option <?php if($con_detail->con_name == $chapter->ch_name) { ?> selected="selected" <?php } ?>
                    value="<?php echo $chapter->ch_name; ?>"><?php echo $chapter->ch_name; ?></option>
					<?php }
					?>
                    </select>
                    <span class="help-inline"><?php echo form_error('con_name'); ?></span>
                </div>
		</div>
            
		<div class="row">    
		<div class="control-group <?php if(form_error('con_convention')){ echo "error";}?>" style="width:290px;float:left;">
			<label class="control-label" for="inputError" style="width:290px;">Convention</label>
			<div class="controls" style="width:290px;">
				<!--<input class="input-xxlarge" type="text" id="covers_cat_name" name="con_convention" value="<?php //echo set_value('con_convention'); ?>">-->
                <select id="covers_cat_name" name="con_convention">
                <option value="">Please select</option>
                <option <?php if($con_detail->con_link == "washington/convention/welcome.html") { ?> selected="selected" <?php } ?> value="washington/convention/welcome.html">Washington-DC</option>
                <option <?php if($con_detail->con_link == "california/convention/welcome.html") { ?> selected="selected" <?php } ?> value="california/convention/welcome.html">California</option>
                <option <?php if($con_detail->con_link == "florida/convention/welcome.html") { ?> selected="selected" <?php } ?> value="florida/convention/welcome.html">Florida</option>
                <option <?php if($con_detail->con_link == "carolina/convention/welcome.html") { ?> selected="selected" <?php } ?> value="carolina/convention/welcome.html">North Carolina</option>
                <option <?php if($con_detail->con_link == "texas/convention/welcome.html") { ?> selected="selected" <?php } ?> value="texas/convention/welcome.html">Texas</option>
                <option <?php if($con_detail->con_link == "illinois/convention/welcome.html") { ?> selected="selected" <?php } ?> value="illinois/convention/welcome.html">Illinois</option>
                <option <?php if($con_detail->con_link == "georgia/convention/welcome.html") { ?> selected="selected" <?php } ?> value="georgia/convention/welcome.html">Georgia</option>
                <option <?php if($con_detail->con_link == "michigan/convention/welcome.html") { ?> selected="selected" <?php } ?> value="michigan/convention/welcome.html">Michigan</option>
                <option <?php if($con_detail->con_link == "canada/convention/welcome.html") { ?> selected="selected" <?php } ?> value="canada/convention/welcome.html">Canada</option>
                <option <?php if($con_detail->con_link == "Jersey/convention/welcome.html") { ?> selected="selected" <?php } ?> value="Jersey/convention/welcome.html">New Jersey</option>
                </select>
                <span class="help-inline"><?php echo form_error('con_convention'); ?></span>
			</div>
		</div>
        
        <div class="control-group <?php if(form_error('con_year')){ echo "error";}?>" style="width:290px;float:left;">
			<label class="control-label" for="inputError" style="width:290px;">Year</label>
			<div class="controls" style="width:290px;">
				<!--<input class="input-xxlarge" type="text" id="covers_cat_name" name="con_convention" value="<?php //echo set_value('con_convention'); ?>">-->
                <select id="covers_cat_name" name="con_year">
                <option value="">Please select</option>
                <?php for($i=2014;$i<=2050;$i++)
				{
					?>
                 <option <?php if($con_detail->con_year == $i) { ?> selected="selected" <?php } ?> value="<?php echo $i; ?>/"><?php echo $i; ?></option>
                 <?php
				}
				?>
                </select>
                <span class="help-inline"><?php echo form_error('con_year'); ?></span>
			</div>
		</div>
        
        </div>
        
         
        <div class="row">    
            <div class="control-group <?php if(form_error('con_start_date')){ echo "error";}?>" style="width:290px;float:left;">
            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_from');?></label>
                <div class="controls" style="width:290px;">
                    <input class="" type="text" id="datetimepickerFrom" name="con_start_date" value="<?php echo $con_detail->con_start_date; ?>">
                    <span class="help-inline"><?php echo form_error('con_start_date'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('con_end_date')){ echo "error";}?>" style="width:290px;float:left;">
            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_to');?></label>
                <div class="controls" style="width:290px;">
                    <input class="" type="text" id="datetimepickerTo" name="con_end_date" value="<?php echo $con_detail->con_end_date; ?>">
                    <span class="help-inline"><?php echo form_error('con_end_date'); ?></span>
                </div>
            </div>
		</div>
             
		
		<div class="control-group <?php if(form_error('con_status')){ echo "error";}?>">
			<label class="control-label" for="inputError">Status</label>
			<div class="controls">
                <select name="con_status" class="input-medium">
                <option <?php if($con_detail->con_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($con_detail->con_status == '0'){ echo 'selected="selected"'; } ?> value="0">Inactive</option>
                </select>
                    <span class="help-inline"><?php echo form_error('con_status'); ?></span>
			</div>
		</div>
       
            	
		<?php date_default_timezone_set("Asia/Kolkata"); ?>    
        <input type="hidden" id="" name="con_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" id="" name="con_modified_by" value="<?php echo 'admin';?>">
          
		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>
<style>
.ui-datepicker
{
	top:45px !important;
}
</style>