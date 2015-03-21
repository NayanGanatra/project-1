<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<style>
.tdfees
{
	font-weight:bold;
	min-width:120px;
	text-align:center;
}
.tdaligncenter
{
	text-align:center;
}
.tdactivity
{
	width:90%;
	margin-bottom:0px !important;
}
.tdtxt
{
	width:30%;
	margin-bottom:0px !important;
}
.tddescription
{
	width:96%;
	margin-bottom:0px !important;
}
.trodd
{
	background-color:#FCE9D9;
}
.treven
{
	background-color:#FFFFFF;
}
</style>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:950px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Event Member <small>Add</small></h1>
		</div>
        <hr>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            	 <div class="space10px"></div> 
				 <table  border="1" cellspacing="0" cellpadding="0" style="min-height:300px; width:57%; background-color:#FF9A00; text-align:center;"> 
					<tr>
				  		<th class="tdfees" style="width:50px;">Age Group</th>
						<th class="tdfees" style="width:200px;">Activity</th>
						<th class="tdfees" style="width:630px;">Number of Participant</th>
						<th class="tdfees" style="width:50px;">Amount</th>
					</tr>
					<?php if($items) { foreach($items as $itemsgroup){ ?>
					<tr class="trodd">
				  		<td><?php echo $itemsgroup->ce_start_age; ?>-<?php echo $itemsgroup->ce_end_age; ?>
						<input type="hidden" value="<?php echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
						<input type="hidden" value="<?php echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
						</td>
						<td class="tdaligncenter"><?php echo $itemsgroup->ce_activity; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;"><input type="text" class="tdtxt" style="width: 20px; margin-right: 2px;" name="txtpcount[]" id="txtpcounta" onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();"/>x $</label><?php echo $itemsgroup->ce_age_fee; ?>
						<input type="hidden" value="<?php echo $itemsgroup->ce_age_fee; ?>" name="getamount[]"/>
						<input type="hidden" value="<?php echo $itemsgroup->ce_id; ?>" name="eventid[]"/>
						</td>
						<td class="tdaligncenter"><input type="text" value="0" style="margin-bottom: 0px; width: 106px; text-align: center;" name="amount[]" readonly=""/> </td>
					</tr> <?php }}?>
					<tr class="treven">
				  		<td colspan="3"><b style="float: right; margin-right: 5px;">Total:</b></td>
						<td class="tdaligncenter" id="totalamount">0</td>
						</tr>
					</table>
				 <div class="space10px"></div> 
                
				<?php if(form_error('txtpcount[]')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } ?>
            <input type="hidden" id="" name="event_mem_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			
            <input type="hidden" id="" name="event_mem_created_by" value="<?php echo 'admin';?>">
			<input id="submit_form" type="button" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" onclick="submit_myform();"/>
             
		</form>    
</td>
</tr></table>

</div>
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>
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
	$("#txtyoungagefrom").blur(function(){
	$("#txtchildage").text($("#txtyoungagefrom").val());
	});
	$("#txtyoungageto").blur(function(){
	$("#txtadultage").text(parseInt($("#txtyoungageto").val())+1);
	});
});
function submit_myform()
{
	var t=0;
	var pcount = document.getElementsByName('txtpcount[]');
	var amount = document.getElementsByName('amount[]');
	var getamount = document.getElementsByName('getamount[]');
	
	var ln = pcount.length;
	for (var i = 0, l = ln; i < l; i++) 
	{
		if(pcount[i].value=='' || pcount[i].value==null)
		{
			amount[i].value = 0;
		}
		else
		{
			amount[i].value = parseInt(pcount[i].value)*parseInt(getamount[i].value);
		}
		t += parseInt(amount[i].value);
	}
	document.getElementById('totalamount').innerHTML=t;
	
	$("#myform").submit();
	
}
$('#txtdate').datepicker({dateFormat: 'yy-mm-dd'});
$('#txtdate').change(function(){
	$("#txtdateafter").text($('#txtdate').val());
});
</script>
<script language="javascript">
function ageof()
{
	var t=0;
	var pcount = document.getElementsByName('txtpcount[]');
	var amount = document.getElementsByName('amount[]');
	var getamount = document.getElementsByName('getamount[]');
	
	var ln = pcount.length;
	for (var i = 0, l = ln; i < l; i++) 
	{
		if(pcount[i].value=='' || pcount[i].value==null)
		{
			amount[i].value = 0;
		}
		else
		{
			amount[i].value = parseInt(pcount[i].value)*parseInt(getamount[i].value);
		}
		t += parseInt(amount[i].value);
	}
	document.getElementById('totalamount').innerHTML=t;
}
</script>