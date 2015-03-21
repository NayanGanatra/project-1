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
	background-color:#F9F8F8;
}
.treven
{
	background-color:#F9F8F8;
}
.tbl_class1 tr td
{ 
 background:#f9f8f8; 
}
.tbl_class2 tr td,.tbl_class2 th
{ 
  border:solid #5A5A5A 1px;	
}

.tbl_class3 tr td,.tbl_class2 th
{ 
  border-left:solid #5A5A5A 1px;	 border-right:solid #5A5A5A 1px;	
}

.menu_clr
{
	color:#469AE9;

}
.ped_l {
	padding-left:5px;
}
.title-bor{background-color:#469AE9; color:#FFF; border:solid #004e97 1px; padding:0 0 0 5px;}
</style>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="float:left; width:950px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Event Member <small>Edit</small></h1>
		</div>
        <hr>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            	 <div class="space10px"></div> 
				 <table class="tbl_class1"  border="1" cellspacing="0" cellpadding="0" style="width:57%; text-align:center;"> 
					<tr>
                    	<th class="tdfees title-bor" style="width:50px;">Email</th>
				  		<th class="tdfees title-bor" style="width:50px;">Age Group</th>
						<th class="tdfees title-bor" style="width:200px;">Activity</th>
						<th class="tdfees title-bor" style="width:200px;">T-Shirts</th>
						<th class="tdfees title-bor" style="width:630px;">Number of Participant</th>
						<th class="tdfees title-bor" style="width:50px;">Amount</th>
					</tr>
					<?php 
					$total = 0;
					/*echo "<pre>";
					print_r($items);
					echo "</pre>";
					exit;*/
					if($items) 
					{
					foreach($items as $itemsgroup)
					{
					//$member_data = $this->dbevent_member->get_member_event_group_detail_by_id($ce_mem_id);
					/*if($member_data)
					{*/
						
					?>
					<tr class="trodd">
                    	<td class="tdaligncenter"><?php //echo $itemsgroup->ce_start_age; ?><?php echo $itemsgroup->email_id; ?> 
				  		<td class="tdaligncenter"><?php //echo $itemsgroup->ce_start_age; ?><?php echo $itemsgroup->age_group; ?>
						<input type="hidden" value="<?php //echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
						<input type="hidden" value="<?php //echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
						</td>
						<?php 
						$getfromeventid = $this->dbevent_member->get_con_event($itemsgroup->event_id);
						//print_r($getfromeventid);
						?>
						<td class="tdaligncenter"><?php echo $getfromeventid[0]->ce_activity; ?></td>
						<td><?php echo $itemsgroup->tshirt_size; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;"><input type="text" class="tdtxt" style="width: 20px; margin-right: 2px;" name="txtpcount[]" id="txtpcounta" value="<?php //echo $member_data->ce_mem_num_participant; ?><?php echo $itemsgroup->number_of_participant; ?>" onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();"/>x $</label><?php echo $getfromeventid[0]->ce_age_fee; ?>
						<input type="hidden" value="<?php echo $getfromeventid[0]->ce_age_fee; ?>" name="getamount[]"/>
						<input type="hidden" value="<?php //echo $itemsgroup->ce_id; ?>" name="eventid[]"/>
						</td>
						<td class="tdaligncenter"><input type="text" value="<?php //echo $member_data->ce_mem_amount;  ?><?php echo $itemsgroup->amount; ?>" style="margin-bottom: 0px; width: 106px; text-align: center;" name="amount[]" readonly=""/> </td>
					</tr> <?php 
					$total += $itemsgroup->amount;
					//}
					}} ?>
					<tr class="treven">
				  		<td colspan="4"><b style="float: right; margin-right: 5px; color:#469AE9;">Total:</b></td>
                        <td></td>
						<td class="tdaligncenter" id="totalamount"><?php echo $total; ?></td>
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
            <input type="hidden" id="" name="ce_mem_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			
            <input type="hidden" id="" name="ce_mem_modified_by" value="<?php echo 'admin';?>">
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