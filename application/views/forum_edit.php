<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <?php /*?><div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_news.html'); ?>">Add News</a>
    </div><?php */?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left"> 
  <tr>
  	<td>
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
			<div class="row">
            <div class="span11">
			<div class="space10px"></div>   
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>">
            	<label class="control-label" for="inputError">Forum Description</label>
                <div class="controls">
                    <textarea style="width:750px; min-height:300px;" name="description" id="description"><?php echo $item->blog_description; ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>
            <div class="space10px"></div>   
            </div>   
             <div class="control-group <?php if(form_error('chapter')){ echo "error";}?>">
			<div class="controls">  
			<span class="help-inline"><?php echo form_error('chapter'); ?></span>
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
            <input type="hidden" id="" name="forum_created_date" value="<?php echo $item->blog_created_date; ?>">
            <input type="hidden" id="" name="forum_created_by" value="<?php echo $item->blog_created_by; ?>">
            <input type="hidden" id="" name="forum_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <?php 
				$get_username = $this->dbheader->user_details($this->session->userdata('user_email'));
			?>
        			<input type="hidden" id="" name="forum_modified_by" value="<?php echo $get_username->mm_username;?>">
        	<input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
		</form>    
</td></tr></table>
</div>
</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
       
        <?php $this->load->view('ads_panel'); ?>
         <div class="space20px"></div>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>
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