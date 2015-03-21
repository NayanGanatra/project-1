<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		    <h1>Blog <small>Edit</small></h1>
		</div>
        <hr>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            <div class="control-group <?php if(form_error('title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_title');?></label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="title" name="title" value="<?php echo $item->title; ?>">
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
            </div>
            <div class="space10px"></div>   
             
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>" style="width:750px;">
            	<label class="control-label" for="inputError">Blog Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description"><?php echo $item->blog_description; ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>
             <div class="space10px"></div>   
               <div class="control-group <?php if(form_error('status')){ echo "error";}?>">
            	<label class="control-label" for="inputError">status</label>
                <div class="controls">
				    <select name="status" style="width:150px;" <?php if($item->verify==0){ echo 'disabled="disabled"'; } ?>>
						<option <?php if($item->status == 0) { echo 'selected="selected"'; } ?> value="0">Inactive</option>
                        <option <?php if($item->status == 1) { echo 'selected="selected"'; } ?> value="1">Active</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('status'); ?></span>
                </div>
            </div> 
         
            <?php date_default_timezone_set("Asia/Kolkata"); ?>
            <input type="hidden" id="" name="blog_created_date" value="<?php echo $item->blog_created_date; ?>">
            <input type="hidden" id="" name="blog_created_by" value="<?php echo $item->blog_created_by; ?>">
            <input type="hidden" id="" name="blog_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <?php 
				$get_username = $this->dbadminheader->get_username($this->session->userdata('username'));
				
				foreach($get_username as $username)
				{
			?>
        			<input type="hidden" id="" name="blog_modified_by" value="<?php echo $username->mm_username;?>">
        	<?php
                }
       	 	?>
            <input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
		</form>    
</td></tr></table>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>
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