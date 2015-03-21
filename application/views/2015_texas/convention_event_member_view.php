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
<?php
$avail_mem = $this->dbconvention_event_member->get_user_status_of_con_event();
?>


<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="float:left; width:950px;"> 
  <tr>
  	<td>
        <hr><span style="font-weight: bold;">Table 2. Outing Registration</span>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            	 <div class="space10px"></div> 
				 <table  border="1" cellspacing="0" cellpadding="0" style="width:78%; class="tbl_class1" text-align:center;"> 
					<tr>
				  		<th class="tdfees title-bor" style="width:50px;">Age Group</th>
						<th class="tdfees title-bor" style="width:200px;">Activity</th>
						<th class="tdfees title-bor" style="width:630px;">Number of Participant</th>
						<th class="tdfees title-bor" style="width:50px;">Amount</th>
					</tr>
					<?php if($items) { foreach($items as $itemsgroup){ 
					$member_data = $this->dbconvention_event_member->get_member_event_group_detail_by_id($avail_mem->ce_mem_id,$itemsgroup->ce_id);
					if($member_data){
					?>
					<tr class="trodd">
				  		<td class="tdaligncenter"> <?php echo $itemsgroup->ce_start_age; ?>-<?php echo $itemsgroup->ce_end_age; ?>
						<input type="hidden" value="<?php echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
						<input type="hidden" value="<?php echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
						</td>
						<td class="tdaligncenter"><?php echo $itemsgroup->ce_activity; ?></td>
						
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;"><input type="text" readonly="" class="tdtxt" style="width: 20px; margin-right: 2px;" name="txtpcount[]" id="txtpcounta" value="<?php echo $member_data->ce_mem_num_participant; ?>"/>x $</label><?php echo $itemsgroup->ce_age_fee; ?>
						<input type="hidden" value="<?php echo $itemsgroup->ce_age_fee; ?>" name="getamount[]"/>
						<input type="hidden" value="<?php echo $itemsgroup->ce_id; ?>" name="eventid[]"/>
						</td>
						<td class="tdaligncenter"><input type="text" value="<?php echo $member_data->ce_mem_amount; ?>" style="margin-bottom: 0px; width: 106px; text-align: right;" name="amount[]" readonly=""/> </td>
					</tr> <?php }}}?>
					<tr class="treven">
				  		<td colspan="3"><b style="float: right; margin-right: 5px; color:#469AE9;">Total:</b></td>
						<td class="tdaligncenter" id="totalamount" style="text-align:right; padding-right:8px;"><?php echo $avail_mem->ce_total; ?></td>
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
			<?php $chapter = $this->dbconvention_registration->get_chapter_from_mm_id($this->session->userdata('user_id')); ?>
            <input type="hidden" id="" name="event_mem_created_by" value="<?php echo $chapter->mm_fname; ?>">
			
			 
             <div class="space20px"></div>
		</form>    
</td>
</tr></table>

</div>
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