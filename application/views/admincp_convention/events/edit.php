<?php $this->load->view('admincp_convention/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:500px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Event <small>Edit</small></h1>
		</div>
        <hr>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            <div class="control-group <?php if(form_error('activity')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Activity</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="activity" name="activity" value="<?php echo $item->ce_activity; ?>">
                    <span class="help-inline"><?php echo form_error('activity'); ?></span>
                </div>
            </div>
            <div class="space10px"></div>
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>" style="width:750px;">
            	<label class="control-label" for="inputError">Event Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description" ><?php echo $item->ce_age_desc; ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>
			
			<div class="space10px"></div>
				 <div class="controls">
				<label class="control-label" for="inputError">Insert Age</label>
               		<input type="text" id="fromage" name="fromage" value="<?php echo $item->ce_start_age; ?>" style="width:22px;"><span> - </span>
					<input type="text" id="toage" name="toage" value="<?php echo $item->ce_end_age; ?>" style="width:22px;">
                    <div class="control-group error" style="width:750px;">
					<span class="help-inline"><?php echo form_error('fromage'); ?></span>
					<span class="help-inline"><?php echo form_error('toage'); ?></span>
					</div>
                </div>
            
			<div class="space10px"></div>
			<div class="control-group <?php if(form_error('cost')){ echo "error"; } ?>" style="width:750px;">
				 <div class="controls">
				<label class="control-label" for="inputError">Cost($)</label>
               		<input type="text" id="cost" name="cost" value="<?php echo $item->ce_age_fee; ?>" style="width:22px;">
					<span class="help-inline"><?php echo form_error('cost'); ?></span>
                </div>
            </div>
			<div class="space10px"></div>
            <input type="hidden" id="" name="ce_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="ce_modified_by" value="<?php echo 'admin';?>">
        
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
             
		</form>    
</td>
</tr></table>
</div>
<?php $this->load->view('admincp_convention/layout/footer'); ?>
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
<script>
/*function submit_form()
{
	if($("#fromage").val()=='' || $("#toage").val()=='')
	{
		alert("Please insert start and end age.");
	}
	else if(parseInt($("#fromage").val())>=parseInt($("#toage").val()))
	{
		alert("you can not set start age greater than end age.");
	}
	else
	{
		$("#myform").submit();
	}
	
}*/
</script>