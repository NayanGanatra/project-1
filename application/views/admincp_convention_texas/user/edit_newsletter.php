<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('html');});
</script>
<div id="user_update" style="display:none" class="alert alert-success">User successfully updated.</div>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		   <h1>Newsletter <small>Edit</small></h1>
		</div>
        <hr>
			<?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">
             <label class="control-label">Subject Title</label>
                <div class="controls">
                    <input style="height:30px;" class="input-xxlarge" type="text" id="subject" name="subject" value="<?php echo $item->subject; ?>">
                    <span class="help-inline"><?php echo form_error('subject'); ?></span>
                </div>
            </div>
            
			<div class="control-group <?php if(form_error('newsletter_template_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Select Template</label>
                <div class="controls">
                <select class="input-medium" name="newsletter_template_name" id="newsletter_template_name">
                <option value="0">Please Select</option>
                <?php
					$get_template = $this->dbadminheader->get_template();
					
					foreach($get_template as $get_template_row)
					{
						if($get_template_row->template_id!=15 && $get_template_row->template_id!=13)
						{
							if($item->template_id==$get_template_row->template_id)
							{?>
								<option selected="selected"  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>
							<?php
							}
							else
							{?>
								<option  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>
							<?php
							}
						}
					}
				?>
                </select>
                <span class="help-inline"><?php echo form_error('newsletter_template_name'); ?></span>
                </div>
            </div>
			
			<div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:750px;min-height:150px;" name="html" id="html"><?php if($item) echo $item->html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
                  <!--  email -->
                <div style="position: absolute;    right: 288px;    top: 280px;    width: 97px;" id="email_preview" ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To See Email Preview.';?>" ><center>Email Preview</center></a></div>
              
                <div class="row" style="display:none;" id="email_information" >
                      <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" 
                      href="javascript:void(0)">
    				<span id="fade_email" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote_email" >
                        <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:20px;">
                                <div class="used_email"  id="used_email" style=" height:100%; ">&nbsp;</div>
							
                        </div>
                	</div>
                </div>
                <!--  email -->
				<div style="position: absolute;    right: 50px;    top: 80px;    width: 200px;">
                    <div  id="quick_add"   ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To Show List Of Tags Which Use In Email ';?>" ><center>Quick Add</center></a></div>
                    <div   id="quick_show" style="border:1px solid #E5E5E5; border-radius:6px; padding:10px;  display:none;" >
                        <b>UserName:</b>{username}<br />
                        <b>Code:</b>{code}<br />
                        <b>FullName:</b>{fullname}<br />
                        <b>Email:</b>{email}<br />
                        <b>Sitename:</b>{sitename}<br />
 <b>User Info:</b>{userinfo}<br />
                    </div>
                </div>
            </div>
            
            <?php /*?><div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php
					echo $item->html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div><?php */?>
            
            <div class="space10px"></div>   
             <div class="row">
            <div class="span11">
            <label class="control-label">Select Chapter</label>
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
                                
                                 <input <?php  $ch_to_newsletters = $this->dbadminheader->ch_to_newsletters($item->uid,$chapter_row->ch_id); 
								 if($ch_to_newsletters){echo 'checked="checked"'; }?> 
                    type="checkbox" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  
								 <?php echo $chapter_row->ch_name; ?>
                        
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
            <!--added by ketan 20130713-->
			 <div class="row" style="display:none" id="user_info" >
			 <script>
			 var checkedemails = new Array();
			 var uncheckedemails = new Array();
			 </script>
                    
                     
                      <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no'; document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" 
                      href="javascript:void(0)">
    <span id="fade1" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote">
                        <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no'; document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:20px;">
                           
                            
                            <div style='float:left;'  class="span111">
                             <div id="top_data">
                                <table style="width:745px">
                                <th colspan="4"><b><center>Member Details<center></b></th>
                                <tr>
								 <td colspan="2">
                               <div style="width:327px;">
                               <div  id="save_cancle" style="float:left;width: 91px;" >
                               <a  id="save_user_data" href="javascript:void(0)" >Save</a>
                               </div>
                               <div id="check_uncheck_all_user"  style="float:right;width: 140px;"  ><a href="javascript:void(0)">Check All user</a></div>
                               <div  id="save_cancle" style="float:right;width: 94px;"  ><a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close">Cancel</a>
                               
                               </div>
                               
                               </div>
                               
                               </td>
                               <td colspan="2" style="text-align:right">
                                <input type="text"  id="username" name="username" value="" placeholder='Search by name, username or email' style="width:230px; height:30px;" />&nbsp;&nbsp;
                                <div id="search" style="float:right">
                                <a href="javascript:void(0)"  >
                                	Search
                                </a>
                                </div>
                                </td></tr>
                                </table>
                                </div>
                                <div  id="used_data"></div>
							</div>
                            
                        </div>
                	</div>
                </div>
             <div  id="cnt_user" ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To See List Of user.';?>"><center>Select user</center></a></div>
             <div class="space10px"></div>
			 <input type="hidden" id="count_user" value="" />
			<!--update end ketan-->
            <div class="space10px"></div>   
            <div class="control-group <?php if(form_error('newsletter_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="newsletter_status" class="input-medium">
                <option <?php if($item->newsletter_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($item->newsletter_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('newsletter_status'); ?></span>
                </div>
            </div>
            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">
            <label class="control-label">Queued Newsletter</label>
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>
                <div class="controls" style="width:160px; height:26px"class="controls" data-tip1="<?php  echo 'First Option Only Save Data. Second Option For Send Data';?>"  >
                    <select name="queued" style="width:150px;">
						<option <?php if($item->queued == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>
                        <option <?php if($item->queued == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('queued'); ?></span>
                </div>
            </div>
			
            <input type="hidden" name="template_id" value="<?php echo $item->uid; ?>" />
	        <br />
	        
	        <textarea style=" display:none" cols="1" rows="2" name="fetch_user_data" id="fetch_user_data"></textarea>
	        <input type="hidden"  id="check_uncheck_all_user_status" name="check_uncheck_all_user_status" value="no"/>
	        <?php 
			$mm_id_edit = $this->dbadminheader->fetch_user_for_edit_newsletter($item->uid);
			$member_id=' ';
			foreach($mm_id_edit as $user_details)
			{
			$member_id .=$user_details->ns_email.' ';
			}
			$member_id = rtrim($member_id);
			?> 
            <?php date_default_timezone_set("Asia/Kolkata"); ?>
            <input type="hidden" id="" name="newsletter_created_date" value="<?php echo $item->newsletter_created_date; ?>">
            <input type="hidden" id="" name="newsletter_created_by" value="<?php echo $item->newsletter_created_by; ?>">
            <input type="hidden" id="" name="newsletter_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="newsletter_modified_by" value="<?php echo 'admin';?>">
            
	        <textarea style="display:none" cols="1" rows="10" name="fetch_user_data_after_save" id="fetch_user_data_after_save"><?php echo $member_id;?></textarea>
			<input type="hidden" id="count_user" value="" />
	        <input type="hidden" id="total_user" value="" />
	        <input onclick="document.getElementById('custom_box').style.display='block'" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
            
		</form>



</td></tr></table>
<script>
$('#newsletter_template_name').change(function() {
	$.ajax({
	  url: BASE_URI+'admincp_convention_texas/user/get_template_chapter/'+$('#newsletter_template_name').val(),
	  success: function(data) {
		$('.nicEdit-main').html(data);
		$('#html').html(data);
		}
	});
});
//added by ketan 20130713
$(function(){
 var keyStop = {
   13: "input:text", // stop enter = submit 
   end: null
 };
 $(document).bind("keydown", function(event){
  var selector = keyStop[event.which];

  if(selector !== undefined && $(event.target).is(selector)) {
      event.preventDefault(); //stop event
  }
  return true;
 });
});
function chkalluser(uid,type)
{
	

	var fetch_user_data = document.getElementById('fetch_user_data').value;
	if(fetch_user_data=='')
	{
	fetch_user_data='0';	
	}
	
	var checkbox = document.getElementsByName('user_details[]');
	var ln = checkbox.length;
	var checkbox_ch = document.getElementsByName('chapter[]');
	
	if(type!='chkall')
	{
	var status = document.getElementById('check_uncheck_all_user_status').value;
	}
	else
	{
	var status = document.getElementById('chkall_check').value;	
	}
	var id='';
	var n='';
	
	if(status=='yes')
	{
		for (var i = 0, l = ln; i < l; i++) {
			if (checkbox[i].disabled==false)
			{
			checkbox[i].checked = true;	
			id +=checkbox[i].value+',';
			}
		}
		if(id!='')
		{
			n=id.substring(0,(id.length-1));
			$.ajax({
				   type: "POST",
			url: BASE_URI+"admincp_convention_texas/user/user_check_uncheck_all/add/"+uid+"/true/"+type+"/"+$('#offset').val(),
				success: function(data) {
					if(type!='chkall')
					{
						document.getElementById('fetch_user_data').value =' '+data.replace(/,/g, " ");
						
					}
					else
					{
						var t=data.replace(/,/g, " ");
						var t=$.trim(data);
						var n=t.split(",");
						for (var ik = 0, l =n.length ; ik < l; ik++) {	
							var x_split=document.getElementById('fetch_user_data').value.split(" ");
							for (var ki = 0, lk =x_split.length ; ki < lk; ki++) {	
							document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(n[ik]),'');
							}
						}
						document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value +' '+data.replace(/,/g, " ");
						var y_split=$.trim(document.getElementById('fetch_user_data').value).split(" ");
						if(y_split.length==$('#total_user').val())
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Uncheck All user</a>");
						$('#check_uncheck_all_user_status').val('yes');
						}
						else
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Check All user</a>");
						$('#check_uncheck_all_user_status').val('no');
						}
					}
$('div#custom_box').removeClass("custom_box_css");
					
					
			}
			});
		}
		
	}
	else
	{
		for (var i = 0, l = ln; i < l; i++) {			
			if (checkbox[i].disabled==false)
			{
			checkbox[i].checked = false;	
			id +=checkbox[i].value+',';
			}
		}
		if(id!='')
		{
			n=id.substring(0,(id.length-1));
			$.ajax({
				   type: "POST",
				  
			url: BASE_URI+"admincp_convention_texas/user/user_check_uncheck_all/add/"+uid+"/false/"+type+"/"+$('#offset').val(),
				success: function(data) {
				
				if(type!='chkall')
					{
					document.getElementById('fetch_user_data').value=data;
					}
					else
					{
						var t=data.replace(/,/g, " ");
						var t=$.trim(data);
						var n=t.split(",");
						for (var ik = 0, l =n.length ; ik < l; ik++) {	
							var x_split=document.getElementById('fetch_user_data').value.split(" ");
							for (var ki = 0, lk =x_split.length ; ki < lk; ki++) {	
							document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(n[ik]),'');
							}
						}
						var y_split=$.trim(document.getElementById('fetch_user_data').value).split(" ");
						if(y_split.length==$('#total_user').val())
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Uncheck All user</a>");
						$('#check_uncheck_all_user_status').val('yes');
						}
						else
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Check All user</a>");
						$('#check_uncheck_all_user_status').val('no');
						}
					}

$('div#custom_box').removeClass("custom_box_css");
			}
			});
		}
		//document.getElementById("chkall_check").value = "yes";
	}
}/*function check_all_chapter(status)
{
	//alert(status);
	var checkbox = document.getElementsByName('chapter[]');
	var ln = checkbox.length;
	//var cnt_user_id = document.getElementById('cnt_user_id').value;
	
	if(status=='yes')
	{
		for (var i = 0, l = ln; i < l; i++) {
			//alert(checkbox[i].disabled);
			if (checkbox[i].disabled==false)
			{
			checkbox[i].checked = true;	
			
			}
			else
			{
			checkbox[i].checked = false;			  		
			//checkbox[i].disabled==false
			
			}
			
			
		}
		document.getElementById("all_ch").value = "no";
		//document.getElementById("cnt_user_id").value=parseInt(document.getElementById("cnt_user_id").value)+parseInt(cnt_user_id);
		
		//document.getElementById("check_all_user").checked=true;
	}
	else
	{
		for (var i = 0, l = ln; i < l; i++) {			
			if (checkbox[i].disabled==false)
			{
			checkbox[i].checked = false;	
			
			}
			else
			{
			checkbox[i].checked = false;			  		
			//checkbox[i].disabled==false
			}
			
			
		}
		document.getElementById("all_ch").value = "yes";
		//document.getElementById("cnt_user_id").value=0;
		
		//document.getElementById("check_all_user").checked=false;
	}
}*/
$('#email_template_name').change(function() {
	$.ajax({
	  url: BASE_URI+'admincp_convention_texas/user/get_template_chapter/'+$('#email_template_name').val(),
	  success: function(data) {
		$('.nicEdit-main').html(data);
		$('#html').html(data);
		}
	});
});
$('#cnt_user').click(function() {
	$('div#custom_box').addClass("custom_box_css");

	document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data_after_save').value;
	var fetch_user_data = document.getElementById('fetch_user_data').value;
	if(fetch_user_data=='')
	{
	fetch_user_data='0';	
	}
	
	document.getElementById("username").value=0;
	var username=document.getElementById("username").value;
	if($.trim(username)=='')
	{
	username=0;	
	}
	checkedemails.splice(0, checkedemails.length);
	uncheckedemails.splice(0, uncheckedemails.length);
	$.ajax({
		type: "POST",
		
	 	//url: BASE_URI+"admincp_convention_texas/user/get_template_user/"+username+"/0/"+<?php echo $item->uid; ?>+"/0/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
		data: "fetch_user_data="+fetch_user_data+"&username="+username+"&id="+'0'+"&nId="+'<?php echo $item->uid; ?>'+"&offset="+'0'+"&check_uncheck_all_user_status="+$('#check_uncheck_all_user_status').val(),
		url: BASE_URI+"admincp_convention_texas/user/get_template_user/",
	   	//url: BASE_URI+"admincp_convention_texas/user/get_template_user/"+username+"/0/"+<?php echo $item->uid; ?>+"/0/"+$('#check_uncheck_all_user_status').val(),
	  	success: function(data) {
		  var str=data.split("|");
			$('#count_user').val(str[1]);
			document.getElementById("username").value='';
			
		//alert(document.getElementById('count_user').value);
		if(document.getElementById('count_user').value!=0)
		{
			document.getElementById('user_info').style.display="block";
			$('#used_data').html(str[0]);
			$('#total_user').val(str[2]);
			document.getElementById('quote').style. zIndex='1031';
			document.getElementById('quote').style.visibility='visible';
			document.getElementById('fade1').style.display='block';
			//new
			var id_u=0;
				var checkbox_u = document.getElementsByName('user_details[]');
				var ln_u = checkbox_u.length;
				
				for (var i_u = 0, l_u = ln_u; i_u < l_u; i_u++) {
					if (checkbox_u[i_u].checked==true)
					{
						id_u ++;
					}
				}
				
				if(id_u==ln_u)
				{
					//$('#chkall').checked(str[1]);
					document.getElementById('chkall').checked=true;
					$('#chkall_check').val('yes');
				}
				else
				{
				document.getElementById('chkall').checked=false;
					$('#chkall_check').val('no');
				}

$('div#custom_box').removeClass("custom_box_css");	
			//end
		}
		else
			{

$('div#custom_box').removeClass("custom_box_css");
				alert('No user Found for this newsletter');
			}
			
		}
		
	});
});
function show(offset)
{
	$('div#custom_box').addClass("custom_box_css");

	var fetch_user_data = document.getElementById('fetch_user_data').value;
	if(fetch_user_data=='')
	{
	fetch_user_data='0';	
	}
	var username=document.getElementById("username").value;
	if($.trim(username)=='')
	{
	username=0;	
	}
	if(typeof(offset)=='undefined')
	{
		offset=0;	
	}
   $.ajax({
		type: "POST",
		
		data: "fetch_user_data="+fetch_user_data+"&username="+username+"&id="+'0'+"&nId="+'<?php echo $item->uid; ?>'+"&offset="+offset+"&check_uncheck_all_user_status="+$('#check_uncheck_all_user_status').val(),
		url: BASE_URI+"admincp_convention_texas/user/get_template_user/",
	   	
	  	success: function(data) {
		  var str=data.split("|");
			document.getElementById("used_data").innerHTML=str[0];
			$('#count_user').val(str[1]);
			$('#total_user').val(str[2]);
			var id_u=0;
			var checkbox_u = document.getElementsByName('user_details[]');
			var ln_u = checkbox_u.length;
			
			for (var i_u = 0, l_u = ln_u; i_u < l_u; i_u++) {
				if (checkbox_u[i_u].checked==true)
				{
					id_u ++;
				}
			}
			
			if(id_u==ln_u)
			{
				//$('#chkall').checked(str[1]);
				document.getElementById('chkall').checked=true;
				$('#chkall_check').val('yes');
			}
			else
			{
			document.getElementById('chkall').checked=false;
				$('#chkall_check').val('no');
			}

$('div#custom_box').removeClass("custom_box_css");
		}
		});
	
}

function user_check_uncheck(uid,m_id,action)
{
	$('div#custom_box').addClass("custom_box_css");

	var fetch_user_data = document.getElementById('fetch_user_data').value;
	if(fetch_user_data=='')
	{
	fetch_user_data='0';	
	}
	$.ajax({
				   type: "POST",
	url: BASE_URI+"admincp_convention_texas/user/user_check_uncheck/edit/"+uid+"/"+m_id+"/"+action,
	success: function(data) {
		if(action==true)
		{
			
				var x_split=document.getElementById('fetch_user_data').value.split(" ");
				for (var ki = 0, lk =x_split.length ; ki < lk; ki++) {
					document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(data),'');
				}
				document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value +' '+ data;
				
			var id_u=0;
			var checkbox_u = document.getElementsByName('user_details[]');
			var ln_u = checkbox_u.length;
			
			for (var i_u = 0, l_u = ln_u; i_u < l_u; i_u++) {
				if (checkbox_u[i_u].checked==true)
				{
					id_u ++;
				}
			}
			var y_split=$.trim(document.getElementById('fetch_user_data').value).split(" ");
						if(y_split.length==$('#total_user').val())
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Uncheck All user</a>");
						$('#check_uncheck_all_user_status').val('yes');
						}
						else
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Check All user</a>");
						$('#check_uncheck_all_user_status').val('no');
						}
			if(id_u==ln_u)
			{
				//$('#chkall').checked(str[1]);
				document.getElementById('chkall').checked=true;
				$('#chkall_check').val('yes');
			}
			else
			{
			document.getElementById('chkall').checked=false;
				$('#chkall_check').val('no');

			}
		}
		else
		{
			var x_split=document.getElementById('fetch_user_data').value.split(" ");
				for (var ki = 0, lk =x_split.length ; ki < lk; ki++) {	
				document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(data),'');
				}
			document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(data),'');
			
			var id_u=0;
			var checkbox_u = document.getElementsByName('user_details[]');
			var ln_u = checkbox_u.length;
			
			for (var i_u = 0, l_u = ln_u; i_u < l_u; i_u++) {
				if (checkbox_u[i_u].checked==true)
				{
					id_u ++;
				}
			}
			var y_split=$.trim(document.getElementById('fetch_user_data').value).split(" ");
						if(y_split.length==$('#total_user').val())
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Uncheck All user</a>");
						$('#check_uncheck_all_user_status').val('yes');
						}
						else
						{
						$('#check_uncheck_all_user').html("<a href='javascript:void(0)'>Check All user</a>");
						$('#check_uncheck_all_user_status').val('no');
						}
			if(id_u==ln_u)
			{
				document.getElementById('chkall').checked=true;
				$('#chkall_check').val('yes');
			}
			else
			{
				document.getElementById('chkall').checked=false;
				$('#chkall_check').val('no');
			}
		}

$('div#custom_box').removeClass("custom_box_css");
	}
	});
}
$('#save_user_data').click(function() {
	$('div#custom_box').addClass("custom_box_css");

	var user_details = document.getElementsByName('user_details[]');
	var ln_user = user_details.length;
	var id_user='';
	var j_user='';
	for (var i = 0, l = ln_user; i < l; i++) {
			
			if (user_details[i].checked == true)
			{
			id_user +=user_details[i].value+'|';
			}
		}
		//alert(n);
		if(document.getElementById('fetch_user_data').value!='')
		{
		//	id_chapter
		//n_chapter=id_chapter.substring(0,(id_chapter.length-1));
		j_user=id_user.substring(0,(id_user.length-1));
		$.ajax({
				   type: "POST",
		  url: BASE_URI+"admincp_convention_texas/user/edit_user",
		  success: function(data) {
			document.getElementById('quote').style.visibility='hidden';
			document.getElementById('fade1').style.display='none';
			//document.getElementById('add_user').style.display="block";
			//location.reload();
			document.getElementById('user_update').style.display='block';
			document.getElementById('fetch_user_data_after_save').value=document.getElementById('fetch_user_data').value;
			window.scrollTo(0,0);			
			// alert("User Added");

$('div#custom_box').removeClass("custom_box_css");
			}
		});
		}
		else
		{

$('div#custom_box').removeClass("custom_box_css");
		alert('please Select Atleast one user')	
		}
});
$('#search').click(function() {
							$('div#custom_box').addClass("custom_box_css");

		var fetch_user_data = document.getElementById('fetch_user_data').value;
		if(fetch_user_data=='')
		{
		fetch_user_data='0';	
		}


		var username=document.getElementById("username").value;
		if($.trim(username)=='')
		{
		username=0;	
		}
		$.ajax({
			   type: "POST",
			   data: "fetch_user_data="+fetch_user_data+"&username="+username+"&id="+'0'+"&nId="+'<?php echo $item->uid; ?>'+"&offset="+'0'+"&check_uncheck_all_user_status="+$('#check_uncheck_all_user_status').val(),
		url: BASE_URI+"admincp_convention_texas/user/get_template_user/",
	   	
			   //data: "fetch_user_data="+fetch_user_data,
	   //	url: BASE_URI+"admincp_convention_texas/user/get_template_user/"+username+"/0/"+<?php echo $item->uid; ?>+"/0/"+$('#check_uncheck_all_user_status').val(),
		//url: BASE_URI+"admincp_convention_texas/user/get_template_user/"+username+"/0/"+<?php echo $item->uid; ?>+"/"+0+"/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
		success: function(data) {
			var str=data.split("|");
			$('#count_user').val(str[1]);
			$('#total_user').val(str[2]);
			$('#used_data').html(str[0]);

$('div#custom_box').removeClass("custom_box_css");
		}
		});
});
/*$('#chkall').click(function(){
	if($('#chkall').val()=="yes")
	{
		$('.chkids').attr('checked','checked');
		$('#chkall').val("no");
	}
	else
	{
		$('.chkids').removeAttr('checked');
		$('#chkall').val("yes");
	}
});*/
/*$('.chkids').click(function(){
	$('#chkall').val("yes");
	$('#chkall').removeAttr('checked');
});*/
function chkall_d()
{
	$('div#custom_box').addClass("custom_box_css");

	$.ajax({
		type: "POST",
	 	url: BASE_URI+'admincp_convention_texas/user/check_uncheck_all_user/'+$('#chkall_check').val(),
	  	success: function(data) {
		  var str=data.split("|");
		  
		  $('#chkall_check').val(str[1]);
		  chkalluser(<?php echo $item->uid; ?>,'chkall');
		  $('div#custom_box').removeClass("custom_box_css");
		}
	});
}
$('#check_uncheck_all_user').click(function() {
											$('div#custom_box').addClass("custom_box_css");

	$.ajax({
			type: "POST",
	  url: BASE_URI+'admincp_convention_texas/user/check_uncheck_all_user/'+$('#check_uncheck_all_user_status').val(),
	  success: function(data) {
		  var str=data.split("|");
		  $('#check_uncheck_all_user').html(str[0]);
		  $('#check_uncheck_all_user_status').val(str[1]);
		 
			if(str[1]=='yes')
			{
				//$('#chkall').checked(str[1]);
				document.getElementById('chkall').checked=true;
				$('#chkall_check').val('yes');
				
			}
			else
			{
				document.getElementById('chkall').checked=false;
				$('#chkall_check').val('no');
				
			}
		  chkalluser(<?php echo $item->uid; ?>,'check_uncheck_all_user');
		  $('div#custom_box').removeClass("custom_box_css");
		  
		}
	});
});
$('#quick_add').click(function() {
$('#quick_show').toggle();
});
$('#email_preview').click(function() {
								   $('div#custom_box').addClass("custom_box_css");

	//alert($('.nicEdit-main').html());
	//$('.nicEdit-main').html(data);
	$.ajax({
		   type: "POST",
		   url: BASE_URI+"admincp_convention_texas/user/email_info/",
		   //$('#html').html(data);
		    data :'emailData='+encodeURIComponent($('.nicEdit-main').html())+'&subject='+$('#subject').val(),
		   //data :'username='+username+'&id='+0+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
		   
		  success: function(data) {
			  	document.getElementById('email_information').style.display="block";
				$('#used_email').html(data);
				
				document.getElementById('quote_email').style. zIndex='1031';
				document.getElementById('quote_email').style.visibility='visible';
				document.getElementById('fade_email').style.display='block';
				(function(jQuery){
						jQuery(document).ready(function() {
							/* custom scrollbar fn call */
							jQuery(".used_email").mCustomScrollbar({
								scrollButtons:{
									enable:true
								},advanced:{  
							updateOnContentResize:true,   
							updateOnBrowserResize:true   
						
						  } 
							});	
							
						});
					})(jQuery);

$('div#custom_box').removeClass("custom_box_css");
							
				
			}
		});
	
		
});
//update end
</script>
<div id="custom_box" style="display:none">

					<div id="overlay">

						<div id="box_frame">

							<div id="box">

							<img src="<?php echo base_url(); ?>images/ajax-loader.gif" />

								<!--<div id="box_upper">

								</div>-->

							</div>

						</div>

					</div>

				</div>  
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>
<script src="<?php echo base_url(); ?>/js/jquery.mCustomScrollbar.js"></script>
<link href="<?php echo base_url(); ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">