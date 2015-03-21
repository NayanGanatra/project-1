<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:500px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Blog <small>Add</small></h1>
		</div>
        <hr>
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
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>" style="width:750px;">
            	<label class="control-label" for="inputError">Blog Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description"><?php echo set_value('description'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>
				<div class="space10px"></div>
               <div class="space10px"></div>   
               <div class="control-group <?php if(form_error('chapter')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Chapters</label>
                <div class="controls">
				<?php $chapter = $this->dbadminheader->get_chapters(); ?>
                    <select name="chapter" style="width:150px;">
						<?php foreach($chapter as $chs) { ?>
						<option value="<?php echo $chs->ch_id; ?>"><?php echo $chs->ch_name; ?></option>
						<?php } ?>
					</select>
                    <span class="help-inline"><?php echo form_error('chapter'); ?></span>
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
            <input type="hidden" id="" name="blog_created_by" value="<?php echo 'admin';?>">
        
            <input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
             
		</form>    
</td>
</tr></table>

</div>
<?php $this->load->view('admincp/layout/footer'); ?>
<script language="javascript">
$(function(){

	$("#selectall").click(function () {
	$('.check').attr('checked', this.checked);
	});
	
	$(".check").click(function(){
	if($(".check").length == $(".check:checked").length) {
	$("#selectall").attr("checked", "checked");
	} else {
	$("#selectall").removeAttr("checked");
	}
	});
});
</script>
