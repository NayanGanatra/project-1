<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
		        <h1>Member Blog <small>Add</small></h1>
		</div>
		<hr>
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:750px;"> 
  <tr>
  	<td>
    	    <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            <div class="control-group <?php if(form_error('title')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Title</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="title" name="title" value="<?php echo set_value('title'); ?>">
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
            </div>
			<div class="space10px"></div>
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>">
            	<label class="control-label" for="inputError">Blog Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description"><?php echo set_value('description'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>
			<div class="space10px"></div>	
			   <div class="control-group <?php if(form_error('status')){ echo "error";}?>">
            	<label class="control-label" for="inputError">status</label>
                <div class="controls">
                    <select name="status" style="width:150px;">
						<option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('status'); ?></span>
                </div>
            </div>
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="blog_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            	<input type="hidden" id="" name="blog_created_by" value="admin">
				
            <input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
             
		</form>    
</td>
</tr></table>
</td></tr></table>
</div>
<?php $this->load->view('admincp/layout/footer'); ?>