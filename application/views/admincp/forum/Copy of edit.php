<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<div class="space10px"></div>
<div class="container"  style="width:1020px">
<table  border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; float:left"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		    <h1>Forum <small>Edit</small></h1>
		</div>
        <hr>
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
			<div style="width:750px;" class="control-group <?php if(form_error('description')){ echo "error"; } ?>">
            	<label class="control-label" for="inputError">Forum Description</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="description" id="description"><?php echo $item->blog_description; ?></textarea>
                    <span class="help-inline"><?php echo form_error('description'); ?></span>
                </div>
            	<div class="space10px"></div>   
                 <div class="row">
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
										<input type="checkbox" class="check" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" <?php $chk = $this->dbadminheader->ch_to_blog($item->bid,$chapter_row->ch_id); if($chk){ echo 'checked="checked"'; } ?> />  <?php echo $chapter_row->ch_name; ?>
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
               <div class="control-group <?php if(form_error('verify')){ echo "error";}?>" <?php if($item->verify==1){ ?> style="display:none;"<?php } ?> >
            	<label class="control-label" for="inputError">Confirm and Verify</label>
                <div class="controls">
                    <select name="verify" style="width:150px;">
						<option <?php if($item->verify == 0) { echo 'selected="selected"'; } ?> value="0">Reject</option>
                        <option <?php if($item->verify == 1) { echo 'selected="selected"'; } ?> value="1">Approve</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('verify'); ?></span>
                </div>
            </div>
			 <div class="space10px" <?php if(form_error('verify')){ echo "error";}?>" <?php if($item->verify==1){ ?> style="display:none;"<?php } ?>></div>   
               <div class="control-group <?php if(form_error('status')){ echo "error";}?>" <?php if($item->verify==0){ ?> style="display:none;"<?php } ?> >
            	<label class="control-label" for="inputError">status</label>
                <div class="controls">
                    <select name="status" style="width:150px;" >
						<option <?php if($item->status == 0) { echo 'selected="selected"'; } ?> value="0">Inactive</option>
                        <option <?php if($item->status == 1) { echo 'selected="selected"'; } ?> value="1">Active</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('status'); ?></span>
                </div>
            </div> 
         
            <input type="hidden" id="" name="forum_created_date" value="<?php echo $item->blog_created_date; ?>">
            <input type="hidden" id="" name="forum_created_by" value="<?php echo $item->blog_created_by; ?>">
            <input type="hidden" id="" name="forum_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="forum_modified_by" value="<?php echo 'admin';?>">
			<!--updated by ketan 20130814-->
			<?php 

			 $mm_id_edit = $this->dbadminheader->fetch_user_for_approve_comment($item->bid);

			 $member_id=' ';

			 foreach($mm_id_edit as $user_details)

			 {
				$member_id .=$user_details->comment_id.'-u'.' ';
			 }

			 $member_id = rtrim($member_id);

			 ?>
			<textarea style=" display:block" cols="1" rows="2" name="fetch_user_data" id="fetch_user_data"></textarea>
			<textarea style="display:block" cols="1" rows="2" name="fetch_user_data_after_save" id="fetch_user_data_after_save"></textarea>
              <input type="text"  id="check_uncheck_all_user_status" name="check_uncheck_all_user_status" value="no"/>
			<div  id="cnt_user"><a href="javascript:void(0)" style="padding:3px 10px; width:130px;"><center>Pending Comments</center></a></div>
			<div class="space10px"></div>
			 <input type="text" id="count_user" value="" />
             <input type="text" id="total_user" value="" />
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

                               

                                <th colspan="4">

                                 <b><center>Pending Comments<center></b></th>

                                <tr>

                               <td colspan="2">

                                 <div style="float:left; ">
                                  <div id="check_uncheck_all_user"  style="float:right;width: 140px;"  ><a href="javascript:void(0)">Check All user</a></div>
                                   </div>
    
                                   </td></tr>

                                </table>

                                </div>

                                <div  id="used_data"></div>

							</div>

                            

                        </div>

                	</div>

                </div>
			<!--updated end-->
            <input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
		</form>    
</td></tr></table>
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
});
</script>
<!--updated by ketan 20130814-->
<script>
$('#cnt_user').click(function() {

$('div#custom_box').addClass("custom_box_css");

	document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data_after_save').value;

	var fetch_user_data = document.getElementById('fetch_user_data').value;

	if(fetch_user_data=='')

	{
		fetch_user_data='0';	
	}
			$.ajax({
				   type: "POST",

			url: BASE_URI+"admincp/forum/get_template_user/",

		   data :'id='+<?php echo $item->bid; ?>+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),

		  success: function(data) {

			  	var str=data.split("|");

				$('#count_user').val(str[1]);

				$('#total_user').val(str[2]);

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
//$('div#custom_box').removeClass("custom_box_css");
});
function chkall_d()
{

$('div#custom_box').addClass("custom_box_css");


	$.ajax({

				   type: "POST",

	  url: BASE_URI+'admincp/forum/check_uncheck_all_user/'+$('#chkall_check').val(),

	  success: function(data) {

		  var str=data.split("|");

		  

		  $('#chkall_check').val(str[1]);

		  chkalluser(<?php echo $item->bid; ?>,'chkall');

		}

	});

}
function chkalluser(uid,type)

{

	var fetch_user_data = document.getElementById('fetch_user_data').value;

	if(fetch_user_data=='')

	{

	fetch_user_data='0';	

	}
	var checkbox = document.getElementsByName('user_details[]');

	var ln = checkbox.length;

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

			id +=checkbox[i].value+'_';

			}

		}

		if(id!='')

		{

			n=id.substring(0,(id.length-1));

			$.ajax({

				   type: "POST",
				   
				url: BASE_URI+"admincp/forum/user_check_uncheck_all/",

				data :'status=edit&id='+uid+'&action=true&type='+type+'&offeset='+$('#offset').val(),

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

				  

			//url: BASE_URI+"admincp/email/user_check_uncheck_all/edit/"+uid+"/"+n_ch+"/false/"+type+"/"+$('#offset').val(),

			url: BASE_URI+"admincp/email/user_check_uncheck_all/",

			data :'status=edit&id='+uid+'&ch_id='+n_ch+'&action=false&type='+type+'&offeset='+$('#offset').val(),

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

		//document.getElementById("chkall_check").value = "yes";

	}

}

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
<!--update end-->