<?php $this->load->view('admincp_convention/layout/header'); ?>
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
</style>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left; width:950px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Fees structure <small>Edit</small></h1>
		</div>
        <hr>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
          <div class="control-group <?php if(form_error('title')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Title</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="title" name="title" value="<?php echo $item->fees_st_title; ?>">
                    <span class="help-inline"><?php echo form_error('title'); ?></span>
                </div>
            </div>
            <!--<div class="space10px"></div>
			<div class="control-group <?php if(form_error('description')){ echo "error"; } ?>" style="width:750px;">
            	<label class="control-label" for="inputError">Forum Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description"><?php echo set_value('description'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	</div>-->
				 <div class="space10px"></div> 
				<table  border="1" cellspacing="0" cellpadding="0" style="width:930px; background-color:#FFCC99"> 
					<tr>
				  		<td class="tdfees">Menu Choice</td>
						<td class="tdfees">Please indicate menu choice “T” or “C” for each person registered in this form below<br />
Attendee will have a type of wrist-band and access to only his/her chosen menu for all three days of convention</td>
					</tr>
					<tr>
				  		<td class="tdfees"><input type="text" id="txtmenu1" class="tdtxt" name="txtmenu1" value="<?php echo $item->first_menu; ?>"/></td>
						<td><input type="text" id="txttrad" class="tdtxt" name="txttrad" value="<?php echo $item->trad; ?>" style="width:98%;"/></td>
					</tr>
					<tr>
				  		<td class="tdfees"><input type="text" id="txtmenu2" class="tdtxt" name="txtmenu2" value="<?php echo $item->second_menu; ?>"/></td>
						<td><input type="text" id="txtcont" class="tdtxt" name="txtcont" value="<?php echo $item->cont; ?>" style="width:98%;"/></td>
					</tr>
				</table>
				 <div class="space10px"></div> 
				 <table  border="1" cellspacing="0" cellpadding="5" style="min-height:300px; width:930px; background-color:#CCEBFF;"> 
					<tr>
				  		<td class="tdfees" rowspan="3">Age Group</td>
						<td class="tdfees" colspan="4">Fees in US $</td>
					</tr>
					<tr>
				  		<td class="tdfees" colspan="2"><span style="float:left; padding-top: 4px;">Post Marked by</span> <input type="text" id="txtdate" class="tdtxt" name="txtdate" value="<?php echo $item->final_date; ?>" style="width:50%; float:left; margin-left:5px;"/></td>
						<td class="tdfees" colspan="2">After <span id="txtdateafter"><?php echo $item->final_date; ?></span></td>
					</tr>
					<tr>
				  		<td class="tdfees">Member</td>
						<td class="tdfees">Non-Member</td>
						<td class="tdfees">Member</td>
						<td class="tdfees">Non-Member</td>
					</tr>
					<tr>
				  		<td><b>A</b> – Kids under <span id="txtchildage"><?php echo $itema->end_age; ?></span> years old</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtchildfee" value="<?php echo $itema->fees_st_mm_fee; ?>"/></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonchildfee" value="<?php echo $itema->fees_st_non_mm_fee; ?>"/></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtchildlatefee" value="<?php echo $itema->fees_st_mm_late_fee; ?>"/></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonchildlatefee" value="<?php echo $itema->fees_st_non_mm_late_fee; ?>"/></td>
					</tr>
					<tr>
					
				  		<td><b>B</b> – Kids and Young Adults <input type="text" id="txtyoungagefrom" class="tdtxt" name="txtyoungagefrom" value="<?php echo $itemb->start_age; ?>" style="width:20px;"/>-<input type="text" id="txtyoungageto" class="tdtxt" name="txtyoungageto" value="<?php echo $itemb->end_age; ?>" style="width:20px;" /> years</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtmemfee" value="<?php echo $itemb->fees_st_mm_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonmemfee" value="<?php echo $itemb->fees_st_non_mm_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtmemlatefee" value="<?php echo $itemb->fees_st_mm_late_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonmemlatefee" value="<?php echo $itemb->fees_st_non_mm_late_fee; ?>" /></td>
					</tr>
					<tr>
				  		<td><b>C</b> – Adults <span id="txtadultage"><?php echo $itemc->start_age; ?></span> years and up</td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtmemfeeadult" value="<?php echo $itemc->fees_st_mm_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonmemfeeadult" value="<?php echo $itemc->fees_st_non_mm_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtmemlatefeeadult" value="<?php echo $itemc->fees_st_mm_late_fee; ?>" /></td>
						<td class="tdaligncenter"><label style="line-height:32px; display:inline;">$</label><input type="text" class="tdtxt" name="txtnonmemlatefeeadult" value="<?php echo $itemc->fees_st_non_mm_late_fee; ?>" /></td>
					</tr>
					<tr>
				  		<td><b>D</b> – International Guests</td>
						<td class="tdaligncenter" colspan="4">Treated as member for fee amount</td>
					</tr>
					<tr>
				  		<td><b>E</b> – Complimentary admission for sponsorship</td>
						<td class="tdaligncenter" colspan="4">Free - Use Age group code E for complimentary admissions received for your sponsorship<br />(Must attach a copy of sponsorship check or receipt of payment to select code E)</td>
					</tr>
				</table>
				 <div class="space10px"></div> 
                <!-- <div class="row">
                    <div class="span11">
                    Select Chapter <input type="checkbox" name="" id="selectall" style="margin-top:-1px;">
            		<div class="space10px"></div>
                    <table><tr>
                    <?php
						$chapter = $this->dbadminheader->get_chapters();
						$i = 0;
						foreach($chapter as $chapter_row)
						{
							if($i%6==0)
							{
								?>
								</tr><tr>
								<?php
							}
							?>
							<td>
								<span class="span3">
									<label class="checkbox">
										<input type="checkbox" class="check" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
									</label>
								</span>
							</td>
							<?php
						$i++;
						}
					?>
                     </tr></table>
            	</div>
	            </div>
				<div class="control-group <?php if(form_error('chapter')){ echo "error"; } ?>" >
				<span class="help-inline"><?php echo form_error('chapter'); ?></span>
				</div>
			 <div class="space10px"></div>  --> 
           <!--    <div class="control-group <?php if(form_error('status')){ echo "error";}?>">
            	<label class="control-label" for="inputError">status</label>
                <div class="controls">
                    <select name="status" style="width:150px;">
						<option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('status'); ?></span>
                </div>
            </div>-->
			<?php if(form_error('txtmemfee') || form_error('txtnonmemfee') || form_error('txtmemlatefee') || form_error('txtnonmemlatefee') || form_error('txtmemfeeadult') || form_error('txtnonmemfeeadult') || form_error('txtmemlatefeeadult') || form_error('txtnonmemlatefeeadult') || form_error('txtyoungagefrom') || form_error('txtyoungageto') || form_error('txttrad') || form_error('txtcont') || form_error('txtdate') || form_error('txtmenu1') || form_error('txtmenu2') || form_error('txtchildfee') || form_error('txtnonchildfee') || form_error('txtchildlatefee') || form_error('txtnonchildlatefee')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } ?>
            <input type="hidden" id="" name="fees_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			
            <input type="hidden" id="" name="fees_modified_by" value="<?php echo 'admin';?>">
        
            <input id="submit_form" type="button" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" onclick="submit_myform();"/>
             
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
$('#txtdate').datepicker({dateFormat: 'yy-mm-dd'});
$('#txtdate').change(function(){
	$("#txtdateafter").text($('#txtdate').val());
});
</script>
