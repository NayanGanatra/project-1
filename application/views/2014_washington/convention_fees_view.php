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
.tdtxt
{
	width:33px;
}
#txttrad
{
	margin-bottom:0px !important;	
}
#txtcont
{
	margin-bottom:0px !important;
}
#txtmenu1
{
	width:91%;
	margin-bottom:0px !important;	
}
#txtmenu2
{
	width:91%;
	margin-bottom:0px !important;	
}
.tbl_class1 tr td
{ 
border-radius:5px; background:#f9f8f8; border:solid #E8E8E8 1px; text-align:left;	
}
.menu_clr
{
	color:#469AE9;

}
</style>

<div class="welcome-title-logo">
<div class="logo-text2" style=" font-size:24px; "><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Registration Form</div>
 </div>
 <div class="space10px"></div>
<div class="container"  style="width:auto">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:100%;"> 
  <tr>
  	<td>
    	<!--<div class="dotted_line" style="text-align:center; font-size:20px; font-weight:bold;">Registration Form</div>-->
        <hr>
		    <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
           		 <div class="space10px"></div> 
				<table  border="1" cellspacing="0" cellpadding="5" style="width:100%; "  class="tbl_class1"> 
					<tr>
				  		<td class="tdfees menu_clr" >Menu Choice</td>
						<td class="tdfees" style="font-weight:normal;" >Please indicate menu choice “T” or “C” for each person registered in this form below<br />
Attendee will have a type of wrist-band and access to only his/her chosen menu for all three days of convention</td>
					</tr>
					<tr>
				  		<td class="tdfees menu_clr" ><?php echo $item->first_menu; ?></td>
						<td><?php echo $item->trad; ?></td>
					</tr>
					<tr>
				  		<td class="tdfees menu_clr" ><?php echo $item->second_menu; ?></td>
						<td><?php echo $item->cont; ?></td>
					</tr>
				</table>
				 <div class="space10px"></div> 
				 <table  border="1" cellspacing="0" cellpadding="5" style="min-height:300px; width:100%; " class="tbl_class1"> 
					<tr>
				  		<td class="tdfees menu_clr" rowspan="3">Age Group</td>
						<td class="tdfees menu_clr" colspan="4">Fees in US $</td>
					</tr>
					<tr>
				  		<td class="tdfees menu_clr" colspan="2">Post Marked by <?php echo $item->final_date; ?></td>
						<td class="tdfees menu_clr" colspan="2">After <span id="txtdateafter"><?php echo $item->final_date; ?></span></td>
					</tr>
					<tr>
				  		<td class="tdfees menu_clr">Member</td>
						<td class="tdfees menu_clr">Non-Member</td>
						<td class="tdfees menu_clr">Member</td>
						<td class="tdfees menu_clr">Non-Member</td>
					</tr>
					<tr>
				  		<td><b class="menu_clr">A</b> – Kids under <span id="txtchildage"><?php echo $itema->end_age; ?></span> years old</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;"></label><?php if($itema->fees_st_mm_fee=='0'){ echo "Free";} else { echo '$'.$itema->fees_st_mm_fee; } ?></td>
                        <td class="tdaligncenter"><label style="line-height:32px; display:inline;"></label><?php if($itema->fees_st_non_mm_fee=='0'){ echo "Free";} else { echo '$'.$itema->fees_st_non_mm_fee; } ?></td>
                        <td class="tdaligncenter"><label style="line-height:32px; display:inline;"></label><?php if($itema->fees_st_mm_late_fee=='0'){ echo "Free";} else { echo '$'.$itema->fees_st_mm_late_fee; } ?></td>
                        <td class="tdaligncenter"><label style="line-height:32px; display:inline;"></label><?php if($itema->fees_st_non_mm_late_fee=='0'){ echo "Free";} else { echo '$'.$itema->fees_st_non_mm_late_fee; } ?></td>
					</tr>
					<tr>
					
				  		<td><b class="menu_clr">B</b> – Kids and Young Adults <?php echo $itemb->start_age; ?>-<?php echo $itemb->end_age; ?> years</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php  echo $itemb->fees_st_mm_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemb->fees_st_non_mm_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemb->fees_st_mm_late_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemb->fees_st_non_mm_late_fee; ?></td>
					</tr>
					<tr>
				  		<td><b class="menu_clr">C</b> – Adults <span id="txtadultage"><?php echo $itemc->start_age; ?></span> years and up</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemc->fees_st_mm_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemc->fees_st_non_mm_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemc->fees_st_mm_late_fee; ?></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><?php echo $itemc->fees_st_non_mm_late_fee; ?></td>
					</tr>
					<tr>
				  		<td><b class="menu_clr">D</b> – International Guests</td>
						<td class="tdaligncenter" colspan="4">Treated as member for fee amount</td>
					</tr>
					<tr>
				  		<td><b class="menu_clr">E</b> – Complimentary admission for sponsorship</td>
						<td class="tdaligncenter" colspan="4">Free - Use Age group code E for complimentary admissions received for your sponsorship<br />(Must attach a copy of sponsorship check or receipt of payment to select code E)</td>
					</tr>
				</table>
				 <div class="space10px"></div> 
                
			<?php if(form_error('txtmemfee') || form_error('txtnonmemfee') || form_error('txtmemlatefee') || form_error('txtnonmemlatefee') || form_error('txtmemfeeadult') || form_error('txtnonmemfeeadult') || form_error('txtmemlatefeeadult') || form_error('txtnonmemlatefeeadult') || form_error('txtyoungagefrom') || form_error('txtyoungageto') || form_error('txttrad') || form_error('txtcont') || form_error('txtdate') || form_error('txtmenu1') || form_error('txtmenu2') || form_error('txtchildfee') || form_error('txtnonchildfee') || form_error('txtchildlatefee') || form_error('txtnonchildlatefee')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } ?>
            <input type="hidden" id="" name="fees_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			
            <input type="hidden" id="" name="fees_modified_by" value="<?php echo 'admin';?>">
        
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
	if(parseInt($("#txtyoungagefrom").val())>=parseInt($("#txtyoungageto").val()))
	{
		alert("start age can not be grater than end age");
		return false;
	}
	else
	{
		$("#myform").submit();
	}
}
</script>
