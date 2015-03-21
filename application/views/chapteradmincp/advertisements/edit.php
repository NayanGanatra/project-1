<?php $this->load->view('chapteradmincp/layout/header'); ?>
<!----------------------------------------------update_monita_20130807--------------------------------->
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.min.js' type='text/javascript'></script>
<!----------------------------------------------end of update_monita_20130807--------------------------------->
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_advertisement');?> <small><?php echo $this->lang->line('text_edit_advertisement');?></small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
            
            <div class="control-group <?php if(form_error('ads_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="covers_cat_name" name="ads_title" value="<?php echo $get_ads->ads_title; ?>">
                    <span class="help-inline"><?php echo form_error('ads_title'); ?></span>
                </div>
            </div>
            
            
            <div class="control-group <?php if(form_error('ads_link')){ echo "error";}?>">
            	<label class="control-label" for="inputError">URL</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="covers_cat_name" name="ads_link" value="<?php echo $get_ads->ads_link; ?>">
                    <span class="help-inline"><?php echo form_error('ads_link'); ?></span>
                </div>
            </div>
            
            <div class="row">
            <div class="control-group <?php if(form_error('ads_type')){ echo "error";}?>" style="width:290px;float:left;">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_size');?></label>
                <div class="controls">
                <select name="ads_type" class="input-medium">
                <option <?php if($get_ads->ads_type == '250x125'){ echo 'selected="selected"'; } ?> value="250x125">250px X 125px</option>
                </select>                	
                    <span class="help-inline"><?php echo form_error('ads_type'); ?></span>
                </div>
            </div>
            
            	<label class="control-label" style="width:700px;float:left">Image</label>
			<div class="row">
	            <div class="controls" style="float:left;">
  
             	<input style="margin-top:-1px;" type="radio" id="selectimage" name="rdo_image" value="1" checked="checked"> Select Image
            	<input style="margin-left:50px;margin-top:-1px;" type="radio" id="imageurl"  name="rdo_image" value=""> Image URL
                
				</div>
			</div>             
          
          
          		<div class="controls" id="browse" style="margin-left:290px;">
                	<!----------------------------------------------update_monita_20130807--------------------------------->
                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;"><img src="<?php echo base_url('images/ads/'.$get_ads->ads_code);?>" style="height:87px; padding-bottom:0.1em;padding-top:0.1em;"/></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
     <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
           <!----------------------------------------------end of update_monita_20130807--------------------------------->
                    <input type="hidden" name="old_image" value="<?php echo $get_ads->ads_code; ?>" />
				</div>
            
            	<div class="controls" id="url" style="margin-left:290px;">
             		< <input class="input-xlarge" type="text" name="image1" placeholder="http://img.youtube.com/default.jpg"><!--update_monita_20130809-->
                    <span class="help-inline"><img src="<?php echo base_url('images/ads/'.$get_ads->ads_code);?>" height="50" /></span>
                    <input type="hidden" name="old_image" value="<?php echo $get_ads->ads_code; ?>" />			
				</div>
                
                <div class="space10px"></div>
                
           <div class="row"> 
            <div class="control-group <?php if(form_error('ads_start_date')){ echo "error";}?>" style="width:290px;float:left;">
            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_from');?></label>
                <div class="controls" style="width:290px;">
                    <input class="" type="text" id="datetimepickerFrom" name="ads_start_date" value="<?php echo $get_ads->ads_start_date; ?>">
                    <span class="help-inline"><?php echo form_error('ads_start_date'); ?></span>
                </div>
            </div>
            
            
            <div class="control-group <?php if(form_error('ads_end_date')){ echo "error";}?>" style="width:290px;float:left;">
            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_to');?></label>
                <div class="controls" style="width:290px;">
                    <input class="" type="text" id="datetimepickerTo" name="ads_end_date" value="<?php echo $get_ads->ads_end_date; ?>">
                    <span class="help-inline"><?php echo form_error('ads_end_date'); ?></span>
                </div>
            </div>
           </div>
            
            <div class="control-group <?php if(form_error('ads_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="ads_status" class="input-medium">
                <option <?php if($get_ads->ads_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($get_ads->ads_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('ads_status'); ?></span>
                </div>
            </div>
            
            <?php date_default_timezone_set("Asia/Kolkata"); ?>
            <input type="hidden" id="" name="ads_created_date" value="<?php echo $get_ads->ads_created_date; ?>">
            <input type="hidden" id="" name="ads_created_by" value="<?php echo $get_ads->ads_created_by; ?>">
            <input type="hidden" id="" name="ads_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <?php 
				$get_username = $this->dbadminheader->get_username($this->session->userdata('username'));
				
				foreach($get_username as $username)
				{
			?>
        			<input type="hidden" id="" name="ads_modified_by" value="<?php echo $username->mm_username;?>">
        	<?php
                }
       	 	?>
            
			<input type="submit" value="<?php echo $this->lang->line('btn_save_changes'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

<script type="text/javascript">
$(document).ready(function(){
		$('#url').hide();
		$('#browse').show();
		$("#imageurl").click(function() {
			$('#url').show();
			$('#browse').hide();
		});
		$("#selectimage").click(function() {
			$('#browse').show();
			$('#url').hide();
		});
	
});
</script>

		<!--	end-->