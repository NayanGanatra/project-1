<?php $this->load->view('admincp/layout/header'); ?>
<link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
<!--autosugestion-->

<!--	<script type="text/javascript" src="<?php //echo base_url(); ?>js/autocomplete/jquery.autocomplete.js"></script>

	<link rel="stylesheet" href="<?php //echo base_url(); ?>css/autocomplete/jquery.autocomplete.css" type="text/css" />-->

<!--autosugestion-->

<?php //echo $this->session->userdata('chapter_data');?>

<?php //$this->session->userdata('user_data');?>

<div id="user_update" style="display:none" class="alert alert-success">User successfully updated.</div>

<script type="text/javascript">

	<!--bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });-->

	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('html');});

</script>

<div class="space10px"></div>

<div class="container"  style="width:1020px">

	

<table border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left">

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Verification <?php echo $this->lang->line('text_email');?> <small>Add</small></h1>

		</div>

        <hr>

            <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>

            <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_subject');?></label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="subject" name="subject" value="">

                    <span class="help-inline"><?php echo form_error('subject'); ?></span>

                </div>

            </div>

            <div style="display:none" class="control-group <?php if(form_error('email_template_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Select Template</label>

                <div class="controls">

                <select class="input-medium" name="email_template_name" id="email_template_name">

                <option value="">Please Select</option>

                <?php

					$get_template = $this->dbadminheader->get_template();

					

					foreach($get_template as $get_template_row)

					{

						/*if($item->template_id==$get_template_row->template_id)*/

						if($item->template_id==15)

						{?>

                            <option selected="selected"  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>

                        <?php

						}

						/*else

						{?>

                            <option  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>

                        <?php

						}*/

					}

				?>

                </select>

                <span class="help-inline"></span>

                </div>

            </div>

            <div class="control-group <?php if(form_error('html')){ echo "error";}?>" style="float:left; width:950px;"  >

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>

                <div class="controls" style="float:left">

                    <textarea style="width:750px; min-height:150px;" name="html" id="html">
                    <?php
					$template_html='';
					$get_chapters_template = $this->dbadminheader->get_chapters_template(15);
					foreach($get_chapters_template as $get_chapters_template_row)
					{
						$template_html=$get_chapters_template_row->template_html;	
					}
					echo $template_html;
					?>
                    </textarea>

                    <span class="help-inline"><?php echo form_error('html'); ?></span>

                </div>

                 <!--  email -->

                <div style="position: absolute;    right: 288px;    top: 206px;    width: 87px;" id="email_preview" ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To See Email Preview.';?>"><center>Email Preview</center></a></div>

              

                <div class="row" style="display:none;" id="email_information" >

                      <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" 

                      href="javascript:void(0)">

    				<span id="fade_email" class="black_overlay"></span>

                    </a>

                  	<div class="white_content" id="quote_email" >

                        <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>

                        <div style="height:90%; margin-top:0px;">

                                <div class="used_email"  id="used_email" style=" height:100%; ">&nbsp;</div>

							

                        </div>

                	</div>

                </div>

                <!--  email -->

                <div style="position: absolute;    right: 50px;    top: 80px;    width: 230px;">
 
                    <div  id="quick_add"   ><a href="javascript:void(0)"  data-tip1="<?php  echo 'Press Here To Show List Of Tags Which Use In Email ';?>"><center>Quick Add</center></a></div>

                    <div   id="quick_show" style="border:1px solid #E5E5E5; border-radius:6px; padding:10px;  display:none;" >

                    

                    <b>UserName:</b>{username}<br />

                    <b>Code:</b>{code}<br />

                    <b>FullName:</b>{fullname}<br />

                    <b>Email:</b>{email}<br />

                    <b>Sitename:</b>{sitename}<br />

 <b>User Info:</b>{userinfo}<br />

                    <b>Family Member:</b>{familymember}<br />

                    </div>

                </div>

            </div>

            <div class="space10px"></div>   

             <div class="row">

            <div class="span11">Chapters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input style=" margin-top:-1px" type="checkbox" id="all_ch"  name="all_ch" value="yes" onclick="check_all_chapter(this.value)" />&nbsp;&nbsp;Check All Chapter

            <div class="space10px"></div>   

            <table><tr>

            <?php

				$chapter = $this->dbadminheader->get_chapters();

				$i = 0;

				$ij=0;

				$arr_ch_id=array();

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

                                

                                 <input   type="checkbox" id="chapter[]" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>"  />  <?php echo $chapter_row->ch_name; ?>

                        <input  id='ch_<?php echo $chapter_row->ch_id; ?>' size="20"  type='hidden' name='ch_<?php echo $chapter_row->ch_id; ?>' value='yes'/>

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

               <div class="space10px"></div>   

                 <div class="row" style="display:none" id="user_info" >

                    

                     

                      <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" 

                      href="javascript:void(0)">

    <span id="fade1" class="black_overlay"></span>

                    </a>

                  	<div class="white_content" id="quote">

                        <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>

                        <div style="height:90%; margin-top:0px;">

                           

                            

                            <div style='float:left;'  class="span111">

                             <div id="top_data">

                               <table style="width:745px">

                                <th colspan="4"><b><center>Member Details<center></b></th>

                                <tr>

                               <td colspan="2">

                                <div style=" float:left ;"  >
									<div id="check_uncheck_all_user"  style="float:right;width: 140px;"  ><a href="javascript:void(0)">Check All user</a></div>
							    </div>
                              	</td>

                                <td colspan="2" style="text-align:right">
								 <select id="mm_type" name="mm_type" class="input-large" style="margin:0;  width:172px">
        
                                <option id="mm_type_sel" value="0"  <?php // if($this->input->get('mm_type') == 0){ echo 'selected="selected"'; } ?> >All Members</option>
        
                             
        
                                <option value="2" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Assigned members</option>
                                
                                <option value="3" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Un-Assigned members</option>
                                
                                <option value="4" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Verified members</option>
                                
                                <option value="5" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Un-Verified members</option>
                                
                               </select>
                                <input type="text"  id="username" name="username" value="" placeholder='Search by name, username or email' style=" margin-bottom: 0px !important ; width:230px"/>&nbsp;&nbsp;

                                <div id="search" style="float:right">

                                <a  href="javascript:void(0)"  >

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

             <div class="control-group <?php if(form_error('fetch_user_data_after_save')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('fetch_user_data_after_save');?></label>

                <div class="controls">

                    <div  id="cnt_user" ><a href="javascript:void(0)" data-tip1="<?php  echo 'Please Select At Least One Chapter Before Select User. Press Here To See List Of user.';?>" ><center>Select user</center></a></div>

                    <span class="help-inline"><?php if(form_error('fetch_user_data_after_save')==true) { echo "Please Select Atleast One User";} ?></span>

                </div>

              </div>

             <div class="space10px"></div>   

            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>

                <div class="controls" style="width:160px; height:26px"class="controls" data-tip1="<?php  echo 'First option only saves data.
Second option will prepare template for sending.
Use Send button from list page to start sending emails.';?>"  >

                    <select name="queued" style="width:150px;">

						<option <?php if($item->queued == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>

                        <option <?php if($item->queued == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('queued'); ?></span>

                </div>

            </div>
<div class="space20px"></div>   

            

            <?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="verification_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="verification_created_by" value="<?php echo 'admin';?>">

            

              <input type="hidden" id="cnt_ch_id" value="<?php echo $ij;?>" />

            <textarea style="display:none" cols="1" rows="2" name="fetch_user_data" id="fetch_user_data"></textarea>

            <textarea style="display:none" cols="1" rows="2" name="fetch_user_data_after_save" id="fetch_user_data_after_save"></textarea>

           	<input type="hidden"  id="check_uncheck_all_user_status" name="check_uncheck_all_user_status" value="no"/>

			<input type="hidden" id="count_user" value="" />

            <input type="hidden" id="total_user" value="" />

             <input onclick="document.getElementById('custom_box').style.display='block'"  id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>

		</form>    

</td></tr></table>



</div>

<script>

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

	//alert(status);

	var checkbox = document.getElementsByName('user_details[]');

	var ln = checkbox.length;

	var checkbox_ch = document.getElementsByName('chapter[]');

	var ln_ch = checkbox_ch.length;

	

	var id_ch='';

	var n_ch='';

		for (var i = 0, l = ln_ch; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (checkbox_ch[i].checked == true)

			{

			id_ch +=checkbox_ch[i].value+'_';

			}

		}

		n_ch=id_ch.substring(0,(id_ch.length-1));

		

	if(type!='chkall')

	{

	var status = document.getElementById('check_uncheck_all_user_status').value;

	}

	else

	{

	var status = document.getElementById('chkall_check').value;	

	}

	var id='0_';

	var n='';

	if(status=='yes')

	{

		for (var i = 0, l = ln; i < l; i++) {

			if (checkbox[i].disabled==false)

			{

			checkbox[i].checked = true;	

			id +=checkbox[i].value+'_';

			}

		}

		if(id!='')

		{

			n=id.substring(0,(id.length-1));

			$.ajax({

				   type: "POST",

			//url: BASE_URI+"admincp/verification/user_check_uncheck_all/add/"+uid+"/"+n_ch+"/true/"+type+"/"+$('#offset').val(),

			url: BASE_URI+"admincp/verification/user_check_uncheck_all/",

			data :'status=add&id='+uid+'&ch_id='+n_ch+'&action=true&type='+type+'&offeset='+$('#offset').val(),

			success: function(data) {

					if(type!='chkall')

					{

					document.getElementById('fetch_user_data').value =' '+data.replace(/_/g, " ");

					}

					else

					{

						var t=data.replace(/_/g, " ");

						var t=$.trim(data);

						var n=t.split("_");

						//alert(n.length);

						for (var ik = 0, l =n.length ; ik < l; ik++) {	

							var x_split=document.getElementById('fetch_user_data').value.split(" ");

							for (var ki = 0, lk =x_split.length ; ki < lk; ki++) {	

							document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value.replace(' '+$.trim(n[ik]),'');

							}

						}

						document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data').value +' '+data.replace(/_/g, " ");

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

		//document.getElementById("chkall_check").value = "no";

	}

	else

	{

		for (var i = 0, l = ln; i < l; i++) {			

			if (checkbox[i].disabled==false)

			{

			checkbox[i].checked = false;	

			id +=checkbox[i].value+'_';

			}

		}

		if(id!='')

		{

			n=id.substring(0,(id.length-1));

			$.ajax({

				   type: "POST",

			//url: BASE_URI+"admincp/verification/user_check_uncheck_all/add/"+uid+"/"+n_ch+"/false/"+type+"/"+$('#offset').val(),

			url: BASE_URI+"admincp/verification/user_check_uncheck_all/",

			data :'status=add&id='+uid+'&ch_id='+n_ch+'&action=false&type='+type+'&offeset='+$('#offset').val(),

			success: function(data) {

				

				if(type!='chkall')

					{

					document.getElementById('fetch_user_data').value=data;

					}

					else

					{

						var t=data.replace(/_/g, " ");

						var t=$.trim(data);

						var n=t.split("_");

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

	}

}

function check_all_chapter(status)

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

}

$('#email_template_name').change(function() {

	$.ajax({

	  url: BASE_URI+'admincp/verification/get_template_chapter/'+$('#email_template_name').val(),

	  success: function(data) {

		$('.nicEdit-main').html(data);

		$('#html').html(data);

		}

	});

});

$('#check_uncheck_all_user').click(function() {
$('div#custom_box').addClass("custom_box_css");

	$.ajax({

				   type: "POST",

	  url: BASE_URI+'admincp/verification/check_uncheck_all_user/'+$('#check_uncheck_all_user_status').val(),

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

		  chkalluser(0,'check_uncheck_all_user');

		  

		}

	});

});

function chkall_d()

{
$('div#custom_box').addClass("custom_box_css");



	$.ajax({

				   type: "POST",

	  url: BASE_URI+'admincp/verification/check_uncheck_all_user/'+$('#chkall_check').val(),

	  success: function(data) {

		  var str=data.split("|");

		  

		  $('#chkall_check').val(str[1]);

		  chkalluser(0,'chkall');

		}

	});

}

$('#quick_add').click(function() {

$('#quick_show').toggle();

});

$('#cnt_user').click(function() {

$('div#custom_box').addClass("custom_box_css");
document.getElementById("mm_type_sel").selected=true;

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

	var checkbox = document.getElementsByName('chapter[]');

	var ln = checkbox.length;

	

	var id='';

	var n='';

		for (var i = 0, l = ln; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (checkbox[i].checked == true)

			{

			id +=checkbox[i].value+'_';

			}

		}

		//alert(n);

		if(id!='')

		{

	//	alert(id);

		n=id.substring(0,(id.length-1));

		
var mm_type=document.getElementById('mm_type').value;
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
		$.ajax({

				   type: "POST",

		  

		  url: BASE_URI+"admincp/verification/get_template_user/",

		   data :'mm_type='+mm_type+'&username='+username+'&id='+0+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),

		 success: function(data) {

			  	var str=data.split("|");

				$('#count_user').val(str[1]);

				$('#total_user').val(str[2]);

				document.getElementById("username").value='';

				

			//alert(document.getElementById('count_user').value);

			if(document.getElementById('count_user').value!=0)

			{

				document.getElementById('user_info').style.display="block";

				$('#used_data').html(str[0]);

				

				document.getElementById('quote').style. zIndex='1031';

				document.getElementById('quote').style.visibility='visible';

				document.getElementById('fade1').style.display='block';

				

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

			}

$('div#custom_box').removeClass("custom_box_css");

}


		});

		}

		else

		{

$('div#custom_box').removeClass("custom_box_css");
		alert('please Select Atleast one chapter')	;

		}

});

function show(offset)

{
$('div#custom_box').addClass("custom_box_css");

	var fetch_user_data = document.getElementById('fetch_user_data').value;

	if(fetch_user_data=='')

	{

	fetch_user_data='0';	

	}

	//alert(offset)

	var username=document.getElementById("username").value;

	if($.trim(username)=='')

	{

	username=0;	

	}

	var checkbox = document.getElementsByName('chapter[]');

	var ln = checkbox.length;

	var id='';

		for (var i = 0, l = ln; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (checkbox[i].checked == true)

			{

			id +=checkbox[i].value+'_';

			}

		}

		var n=id.substring(0,(id.length-1));

	if(typeof(offset)=='undefined')

	{

		offset=0;	

	}
var mm_type=document.getElementById('mm_type').value;
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
    $.ajax({

				   type: "POST",

			  

		  url: BASE_URI+"admincp/verification/get_template_user/",

		   data :'mm_type='+mm_type+'&username='+username+'&id='+0+'&ch_id='+ n+'&offset='+offset+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),

		   

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

	url: BASE_URI+"admincp/verification/user_check_uncheck/add/"+uid+"/"+m_id+"/"+action,

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


$('div#custom_box').removeClass("custom_box_css");

		

	}

	});

}
function save_user_data()
{
//$('#save_user_data').click(function() {
$('div#custom_box').addClass("custom_box_css");

	var chapter = document.getElementsByName('chapter[]');

	var ln_chapter = chapter.length;

	var id_chapter='';

	var n_chapter='';

	for (var i = 0, l = ln_chapter; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (chapter[i].checked == true)

			{

			id_chapter +=chapter[i].value+'_';

			}

		}

		

	var user_details = document.getElementsByName('user_details[]');

	var ln_user = user_details.length;

	var id_user='';

	var j_user='';

	for (var i = 0, l = ln_user; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (user_details[i].checked == true)

			{

			id_user +=user_details[i].value+'_';

			}

		}

		//alert(n);

		if(document.getElementById('fetch_user_data').value!='')

		{

		

		n_chapter=id_chapter.substring(0,(id_chapter.length-1));

		j_user=id_user.substring(0,(id_user.length-1));

		

		$.ajax({

				   type: "POST",

		  url: BASE_URI+"admincp/verification/add_user/<?php echo '0' ?>/"+n_chapter+"/"+j_user,

		  success: function(data) {

			document.getElementById('quote').style.visibility='hidden';

			document.getElementById('fade1').style.display='none';

			document.getElementById('user_update').style.display='block';

			

			document.getElementById('fetch_user_data_after_save').value=document.getElementById('fetch_user_data').value;

			//location.reload();

			window.scrollTo(0,0);			

$('div#custom_box').removeClass("custom_box_css");
			}

		});

		}

		else

		{

$('div#custom_box').removeClass("custom_box_css");

		alert('please Select Atleast one user');

		}

//});
}

$('#search').click(function() {
$('div#custom_box').addClass("custom_box_css");

	var fetch_user_data = document.getElementById('fetch_user_data').value;

	if(fetch_user_data=='')

	{

	fetch_user_data='0';	

	}

	var checkbox = document.getElementsByName('chapter[]');

	var ln = checkbox.length;

	

	var id='';

	var n='';

		for (var i = 0, l = ln; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (checkbox[i].checked == true)

			{

			id +=checkbox[i].value+'_';

			}

		}

		//alert(n);

		if(id!='')

		{

		//	alert(id);

			n=id.substring(0,(id.length-1));

			var username=document.getElementById("username").value;

			if($.trim(username)=='')

			{

			username=0;	

			}
var mm_type=document.getElementById('mm_type').value;
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
			$.ajax({

				   type: "POST",

		
			url: BASE_URI+"admincp/verification/get_template_user/",

			data :'mm_type='+mm_type+'&username='+username+'&id='+0+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),

			success: function(data) {

				var str=data.split("|");

				$('#count_user').val(str[1]);

				$('#total_user').val(str[2]);

				$('#used_data').html(str[0]);

$('div#custom_box').removeClass("custom_box_css");
			}

			});

		}

});

$('#email_preview').click(function() {
								   $('div#custom_box').addClass("custom_box_css");


	//alert($('.nicEdit-main').html());

	//$('.nicEdit-main').html(data);


$.ajax({

		   type: "POST",

		   url: BASE_URI+"admincp/verification/email_info/",

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



/*autosuggestion*/

</script>

<style>

					#overlay

					{

					background-color: black;

					opacity:0.5;

					filter:alpha(opacity=40);

					

					width:100%;

					height:100%;

					position:fixed;

					top:0;

					left:0;

					

					}

				#box_frame

					{

					width:100%;

					position:fixed;

					top:40%;

					}

				#box

					{	

					/*background-image:url(p_p/loader.gif);*/

					background-repeat: no-repeat;				

					width:128px;

					height:128px;	

					/*padding:10px;*/

					margin:auto;

					text-align:center;

					/*background-color:white;

					border:1px solid black;

					font-size:20px;		*/		

					

						

					

					

					

					}			

				#box_botom

					{

					/*position:fixed;*/

					/*top:65%;*/					

					width:200px;

					height:36px;	

					margin-top:51px;

					text-align:right;				

					}	

				#box_upper

					{

					padding-top:36px;

					text-align:center;

					font-size:20px;	

					}

				#box_button

					{

					/*position:fixed;					

					float:right;*/

					margin-right:28px;					

					}

				 </style>

				

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

<?php $this->load->view('admincp/layout/footer'); ?>

 <script src="<?php echo base_url(); ?>/js/jquery.mCustomScrollbar.js"></script>

<link href="<?php echo base_url(); ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">