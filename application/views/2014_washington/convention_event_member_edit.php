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
<div class="welcome-title-logo">
<div class="logo-text2" style=" font-size:24px; "><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />Event Membership Form</div>
 </div>

 
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="float:left; width:950px;"> 
  <tr>
  	<td>
        <hr><span style="font-weight: bold;">Table 1. Outdoor Activities with Various Age Groups</span>
           <div class="space10px"></div> 
				 <table class="tbl_class1"  border="1" cellspacing="0" cellpadding="0"  style="width:78%;  text-align:center;"> 
					<tr>
				  		<th class="tdfees title-bor" style="width:50px;">Age Group</th>
						<th class="tdfees title-bor" style="width:200px;">Activity</th>
						<th class="tdfees title-bor" style="width:630px;">Description</th>
						<th class="tdfees title-bor" style="width:50px;">Cost</th>
					</tr>
					<?php 
					if($items) { 
					foreach($items as $itemsgroup){
					
					?>
					<tr class="trodd">
				  		<td class="tdaligncenter"><?php echo $itemsgroup->ce_start_age; ?>-<?php echo $itemsgroup->ce_end_age; ?>
						<input type="hidden" value="<?php echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
						<input type="hidden" value="<?php echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
						</td>
						<td class="tdaligncenter"><?php echo $itemsgroup->ce_activity; ?></td>
						<td class="tdaligncenter"><?php echo word_limiter($itemsgroup->ce_age_desc,15); ?> <a style="cursor:pointer" onclick="desc_data('<?php echo $itemsgroup->ce_id;?> ')">Read more</a></td>
						<td class="tdaligncenter"><?php echo '$'.$itemsgroup->ce_age_fee; ?></td>
					</tr> <?php 
					}} ?>
					</table>
				 <div class="space10px"></div> 
            
            <input type="hidden" id="" name="ce_mem_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			
            <input type="hidden" id="" name="ce_mem_modified_by" value="<?php echo 'admin';?>">
		  
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
function desc_data(id)
{
	$.ajax({
   		type: "POST",
	  	url: '<?php echo base_url().$this->config->item("convention_folder");?>convention/fetch_desc_data/'+id,
		success: function(data) {
			
				document.getElementById('user_info').style.display="block";
				$('#used_data').html(data);
				
				document.getElementById('quote').style. zIndex='1031';
				document.getElementById('quote').style.visibility='visible';
				document.getElementById('fade1').style.display='block';
				(function($){

						

							/* custom scrollbar fn call */

							$("#used_data").mCustomScrollbar({

								scrollButtons:{

									enable:true

								},advanced:{  

							updateOnContentResize:true,   

							updateOnBrowserResize:true   

						

						  } 

							});	

							

						

					})($);
		
		}
	});
}
</script>
<div class="row" style="display:none" id="user_info" >
                    <a onclick="document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" 
                      href="javascript:void(0)">
    				<span id="fade1" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote">
                        <a onclick="document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:20px;">
                           <div  id="used_data"></div>
						</div>
                            
                     </div>
</div>
<style>
.white_content {

    background-color: white;

    border: 1px solid #827A1D;

    border-radius: 10px 10px 10px 10px;

   /* display: none;*/

    height: 50%;

    left: 27%;

    padding: 10px 10px 0px 10px;

    position: fixed;

    top: 25%;

    width:40%;

   

	visibility:hidden;

	/*overflow-y: scroll;*/

	

	

}

.black_overlay {

    background-color: black;

    display: none;

    height: 100%;

    left: 0;

    opacity: 0.8;

    position: fixed;

    top: 0;

    width: 100%;

    z-index: 1031;

}
#used_data
{
	height:97%;
}
</style>
 <script src="<?php echo base_url(); ?>/js/jquery.mCustomScrollbar.js"></script>

<link href="<?php echo base_url(); ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">