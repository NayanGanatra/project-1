<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Latest News <small>Add Latest News</small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
		<div class="control-group <?php if(form_error('latest_news_title')){ echo "error";}?>">
			<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
				<div class="controls">
                    <input class="input-xlarge" type="text" id="covers_cat_name" name="latest_news_title" value="<?php echo set_value('latest_news_title'); ?>">
                    <span class="help-inline"><?php echo form_error('latest_news_title'); ?></span>
                </div>
		</div>
            
		<div class="control-group <?php if(form_error('latest_news_link')){ echo "error";}?>">
			<label class="control-label" for="inputError">URL</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" id="covers_cat_name" name="latest_news_link" value="<?php echo set_value('latest_news_link'); ?>">
                <span class="help-inline"><?php echo form_error('latest_news_link'); ?></span>
			</div>
		</div>
        
        <div class="control-group <?php if(form_error('latest_news_tab')){ echo "error";}?>">
			Open in new tab <input class="" type="checkbox" id="covers_cat_name" name="latest_news_tab" value="1" style="margin-top:-2px;margin-left:20px;">
                <span class="help-inline"><?php echo form_error('latest_news_tab'); ?></span>
			
		</div>
       <div class="space10px"></div>
        
		<div class="control-group <?php if(form_error('latest_news_status')){ echo "error";}?>">
			<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
			<div class="controls">
                <select name="latest_news_status" class="input-medium">
                <option <?php if(set_value('latest_news_status') == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if(set_value('latest_news_status') == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('latest_news_status'); ?></span>
			</div>
		</div>
          
          <?php date_default_timezone_set("Asia/Kolkata"); ?>    
        <input type="hidden" id="" name="latest_news_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" id="" name="latest_news_created_by" value="<?php echo 'admin';?>">
        
		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>

<script type="text/javascript">


</script>