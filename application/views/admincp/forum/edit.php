<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('description');});
</script>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/chap_page.css" rel="stylesheet" type="text/css">
<style>
[data-tip1] {
	position:absolute;
	margin-top:-10px;
}
[data-tip1]:before {
	border:none;
}
</style>
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
				<div class="control-group <?php if(form_error('chapter')){ echo "error"; } ?>" >
				<span class="help-inline"><?php echo form_error('chapter'); ?></span>
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
			
			<div  id="cnt_user"><a href="javascript:void(0)" style="padding:3px 10px; width:190px;"><center>Pending comments and replies</center></a></div>
			<div class="space10px"></div>   
            <input id="submit_form" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
		</form>  
		  
</td></tr></table>
</div>
<!--updated by ketan 20130814-->
			<form action="<?php echo base_url().'admincp/forum/edit_comment/'.$item->bid; ?>" method="POST" id="savecommentreply">
			<div class="space10px"></div>
			<div class="row" style="display:none" id="user_info" >
                      <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'; clearAll();" 

                      href="javascript:void(0)">

    <span id="fade1" class="black_overlay"></span>

                    </a>

                  	<div class="white_content" id="quote" style="width:755px; height:625px;">

                        <a onclick="document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none';clearAll();" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>

                       <div style="height:90%; margin-top:0px;">

                           

                            

                            <div style='float:left;'  class="span111">

                             <div id="top_data">

                                <table style="width:745px; margin-top:15px;">

                               

                                <th colspan="4">

                                 <b><center>Pending comments and replies<center></b></th>

                                <tr style="display:none;">

                               <td colspan="2">

                                 <div style="float:left; ">
                                  <div id="check_uncheck_all_user"  style="float:right;width: 140px;"  ><a href="javascript:void(0)">Check All user</a></div>
                                   </div>
    
                                   </td></tr>

                                </table>

                                </div>

                                <div  id="used_data">
								<?php $user_detail = $this->dbadminheader->fetch_pending_comments($item->bid);
								$reply_details = $this->dbadminheader->fetch_pending_reply($item->bid);
								$counter = count($user_detail)+ count($reply_details);
		?>
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table table-hover" id="data-table">

        <thead>
		<tr>
        	<th scope="col" width="100%" colspan="6">
                    <select name="commverify" class="ar" style="width:93px;">
						<option value="1">Approve</option>
                        <option value="0">Reject</option>
                    </select>
                
            </th>
        </tr>
        <tr>

        	<th scope="col" width="5%" style="border-top:0 none;"><input type="checkbox" style="margin: 0 5px 2px 0;" id="chkall" name="chkall" value="no"/>
            </th>

			<th scope="col" width="30px" style="border-top:0 none;">Type</th>
			<th scope="col" width="38%" style="border-top:0 none;">Text</th>
            <th scope="col" width="23%" style="border-top:0 none;">Commented on</th>
			<!--<th scope="col" width="20%">Chapter Name</th>-->
			<th scope="col" width="12%" style="border-top:0 none;">Username</th>
			<th scope="col" width="12%" style="border-top:0 none;">Verify</th>
        </tr>
 			
    	</thead>

        <?php

		$i = 0;

		foreach($user_detail as $user_details)
		{
			?>

            <tr>
            <td style="width:5%;">
			<span class="span3" >
			<label class="checkbox">
				<input type="checkbox"  name="commentdetails[]" value="<?php echo $user_details->comment_id; ?>" class="commentcheck disable_comment<?php echo $user_details->comment_id; ?>"" />
			</label>
			</span>
			</td>
			<td style="width:10%;"><span class="span3 commreply">comment</span>
			</td>
			<td style="width:38%;">
                    <span class="span3 commreply" style="width:250px; margin-bottom:5px;" data-tip1="<?php echo ($user_details->text); ?>"><?php echo character_limiter($user_details->text,30); ?></span>
                </td>
                <td style="width:23%;">
                    <span class="span3" style="width:150px;"><?php echo $user_details->comment_date; ?></span>
                </td>
               <!-- <td style="width:20%;"><?php $state = $this->dbadminheader->user_details_by_id($user_details->mm_id); ?>
					<?php
					$ch_name = $this->dbadminheader->fetch_ch_name($state->mm_state_id); ?>
                    <span class="span3" ><?php echo $ch_name->ch_name; ?></span>
                </td>-->
				<td style="width:12%;">
				<?php $state = $this->dbadminheader->user_details_by_id($user_details->mm_id); echo($state->mm_username);?>
				</td>
				<td style="width:12%;">
				 <a class="disable_approve<?php echo $user_details->comment_id; ?>" onclick="edit_comment_one(<?php echo $user_details->comment_id; ?>,'comment','approve')" href="javascript:void(0)" style="width:70px;"><img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" /></a>
				<a class="disable_reject<?php echo $user_details->comment_id; ?>" onclick="edit_comment_one(<?php echo $user_details->comment_id; ?>,'comment','reject')" href="javascript:void(0)" style="width:70px;"><img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /></a>
				</td>
			</tr>
			<?php

			$i++;

        }
		
		
		foreach($reply_details as $reply_detail)
		{
			?>

            <tr>
            <td style="width:5%;">
			<span class="span3" >
			<label class="checkbox">
				<input type="checkbox"  name="replydetails[]" value="<?php echo $reply_detail->reply_id; ?>" class="commentcheck disable_reply<?php echo $reply_detail->reply_id; ?>" />
			</label>
			</span>
			</td>
			<td style="width:10%;"><span class="span3 commreply">reply</span>
			</td>
			<td style="width:38%;">
                    <span class="span3 commreply" style="width:250px;" data-tip1="<?php echo ($reply_detail->text); ?>"><?php echo character_limiter($reply_detail->text,30); ?></span>
                </td>
                <td style="width:23%;">
                    <span class="span3" style="width:150px;"><?php echo $reply_detail->reply_date; ?></span>
                </td>
               <!-- <td style="width:20%;"><?php $state = $this->dbadminheader->user_details_by_id($reply_detail->mm_id); ?>
					<?php
					$ch_name = $this->dbadminheader->fetch_ch_name($state->mm_state_id); ?>
                    <span class="span3" ><?php echo $ch_name->ch_name; ?></span>
                </td>-->
				<td style="width:12%;">
				<?php $state = $this->dbadminheader->user_details_by_id($reply_detail->mm_id); echo($state->mm_username);?>
				</td>
				<td style="width:12%;">
				<a class="disable_reply_approve<?php echo $reply_detail->reply_id; ?>" onclick="edit_comment_one(<?php echo $reply_detail->reply_id; ?>,'reply','approve')" href="javascript:void(0)" style="width:70px;"><img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" /></a>
				<a class="disable_reply_reject<?php echo $reply_detail->reply_id; ?>" onclick="edit_comment_one(<?php echo $reply_detail->reply_id; ?>,'reply','reject')" href="javascript:void(0)" style="width:70px;"><img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /></a>
				</td>


			<?php

			$i++;

        }
		if($i==0)

		{

			echo "<td colspan='6'>No result found!!!</td>";

		}?>

        

		</tr>

        </table>

								</div>
 <div style="bottom: 15%;    left: 37%;    position: absolute;" >

                               <div  id="save_cancle" style="float:left;" >
								
                              <a onclick="save_user_data();"  id="save_user_data" href="javascript:void(0)" >Save</a>

                               </div>
<div  id="save_cancle" style="float:left; margin-left:6px;"  ><a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none';clearAll();" href="javascript:void(0)" class="quote-close">Cancel</a>

                               </div>
           </div>
							</div>

                            

                        </div>

                	</div>

                </div></form>
			<!--updated end-->
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
	$("#chkall").click(function () {
	$('.commentcheck').attr('checked', this.checked);
		var checkbox_u = $('.commentcheck');
		var ln_u = checkbox_u.length;
		for (var i_u = 0, l_u = ln_u; i_u < l_u; i_u++) {
			if (checkbox_u[i_u].disabled==true)
			{
				checkbox_u[i_u].checked = false;
				//id_u ++;
			}
		}
		/*var aTrs = oTable.fnGetNodes();
		alert(aTrs[0]);*/
	});
	
	$(".commentcheck").click(function(){
	if($(".commentcheck").not(':disabled').length == $(".commentcheck:checked").length) {
	$("#chkall").attr("checked", "checked");
	} else {
	$("#chkall").removeAttr("checked");
	}
	});
});
</script>
<!--updated by ketan 20130814-->
<script>
/*$('#cnt_user').click(function() {

$('div#custom_box').addClass("custom_box_css");

			$.ajax({
				   type: "POST",

			url: BASE_URI+"admincp/forum/get_template_user/",

		   data :'id='+<?php echo $item->bid; ?>,

		  success: function(data) {
		  
			document.getElementById('user_info').style.display="block";

			//$('#used_data').html(data);

			document.getElementById('quote').style. zIndex='1031';

			document.getElementById('quote').style.visibility='visible';

			document.getElementById('fade1').style.display='block';


$('div#custom_box').removeClass("custom_box_css");

			}

		});
//$('div#custom_box').removeClass("custom_box_css");
});*/
var oTable;
$('#cnt_user').click(function() {
		$('div#custom_box').addClass("custom_box_css");  
		document.getElementById('user_info').style.display="block";
		document.getElementById('quote').style. zIndex='1031';
		document.getElementById('quote').style.visibility='visible';
		document.getElementById('fade1').style.display='block';
		$('div#custom_box').removeClass("custom_box_css");
		addTablePaging('false');
		oTable = addTablePaging('false');		
});
function checkuncheck()
{
	if($(".commentcheck").not(':disabled').length == $(".commentcheck:checked").length) {
	$("#chkall").attr("checked", "checked");
	} else {
	$("#chkall").removeAttr("checked");
	}
}
function addTablePaging(getit)
	  {
	  	if(getit=='false')
		{
			return $('#data-table').dataTable({
	          "iDisplayLength": 10,
			  "bLengthChange": false,
			  "bFilter": false,
			  "bSort": false,
			  "bInfo": true,
			  "sPaginationType": "full_numbers",
			  "bRetrieve": true,
			  "fnDrawCallback": function( oSettings ) {
    			checkuncheck();
				}
	        });
		}
		else
		{
			return $('#data-table').dataTable({
	          "iDisplayLength": 10,
			  "bLengthChange": false,
			  "bFilter": false,
			  "bSort": false,
			  "bInfo": true,
			  "sPaginationType": "full_numbers",
			  "bRetrieve": true,
		  	  "bDestroy": true
	        });
		}
	  }
function clearAll()
{
	var oTable = addTablePaging('true');
	oTable.fnDestroy();
	$(".commentcheck").removeAttr("checked");
	$("#chkall").removeAttr("checked");
	$(".ar").val(1);
	
}
function save_user_data()
{
	var oTable = addTablePaging('true');
	oTable.fnDestroy();
	$("#savecommentreply").submit();
}
function edit_comment_one(com_rep_id,type,action)
{
	if(type=='comment')
	{
		if ($(".disable_comment"+com_rep_id).hasClass('disabled'))
		{
			return false;
		}
		$.ajax({
			type: "POST",
	
			url: BASE_URI+"admincp/forum/edit_comment_one/",
			data :'blog_id='+<?php echo $item->bid; ?>+'&com_rep_id='+com_rep_id+'&type='+type+'&action='+action,
		  	success: function(data) {
		  }
		});
		$(".disable_comment"+com_rep_id).addClass('disabled');
		$(".disable_comment"+com_rep_id).attr('disabled','true');
		$(".disable_comment"+com_rep_id).removeAttr('checked','false');
		if(action=='approve')
		{
			$(".disable_reject"+com_rep_id).hide();
		}
		else
		{
			$(".disable_approve"+com_rep_id).hide();
		}
	}
	if(type=='reply')
	{
		if ($(".disable_reply"+com_rep_id).hasClass('disabled'))
		{
			return false;
		}
		
		$.ajax({
			type: "POST",
	
			url: BASE_URI+"admincp/forum/edit_comment_one/",
			data :'blog_id='+<?php echo $item->bid; ?>+'&com_rep_id='+com_rep_id+'&type='+type+'&action='+action,
		  	success: function(data) {
		  }
		});
		$(".disable_reply"+com_rep_id).addClass('disabled');
		$(".disable_reply"+com_rep_id).attr('disabled','true');
		$(".disable_reply"+com_rep_id).removeAttr('checked','false');
		if(action=='approve')
		{
			$(".disable_reply_reject"+com_rep_id).hide();
		}
		else
		{
			$(".disable_reply_approve"+com_rep_id).hide();
		}
	}
}
</script>
<style>				a.disabled { color:gray !important; }
					

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