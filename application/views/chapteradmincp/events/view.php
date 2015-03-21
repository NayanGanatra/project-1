<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="space10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Events <small>Manage Events</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

            <th scope="col">Date</th>

            <th scope="col">Title</th>

            <th scope="col">Status</th>
			<?php /////////////////////////////////////////////////////pradip_201403271600 start/////////////////////////////////////////////////	?>
            <th scope="col"><center>(Sent/Total)</center></th>

            <th style="display:none" scope="col">Queued</th>
            <?php      /////////////////////////////////////////////////////end///////////////////////////////////////////////////	?>
            <th scope="col" width="200" >Mail Status</th>

            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col" width="135">Action</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="7"></td>

        </tr>

    </tfoot>

    <?php

		if ($query)

		{

		  

		   foreach ($query as $row)

		   {

	?>

    <tr>

    	<td><?php echo $row->event_date_time; ?></td>

        <td><a onclick="cnt_user(<?php echo $row->event_id;?>,'<?php echo $row->event_name;;?>')" class="inline1" href="javascript:void(0)" title="<?php echo $row->event_name; ?>"><?php echo $row->event_name; ?></a></td>

        <?php /*?><td><?php if($row->event_status == '0'){ ?><img src="<?php echo base_url(); ?>images/disapprove_icon.gif"><?php }elseif($row->event_status == '1'){ echo 'Upcoming'; }elseif($row->event_status == '2'){ echo 'Archived'; } ?></td><?php */?>
			 <td>
         <!---------------- update-monita(06/08/2013)-------------------------->
		   <?php if($row->event_status == '0')
		          {  
				      echo 'Deactive'; 
				  }
				  elseif($row->event_status == '1')
				  { 
				       echo 'Upcoming'; 
				  }
				  elseif($row->event_status == '2')
				  { 
				       echo 'Archived'; 
				  } 
			?>
            <!----------------end of update-monita(06/08/2013)-------------------------->
        </td>

          <?php  //////////////////////////////////////////////////pradip_201403271600 start///////////////////////////////////////////////////	?>
			<td><?php $tot_sub = $this->dbevents->counteventSubscribers($row->event_id); echo $row->startNum.'/'.$tot_sub; ?></td>
         <?php      /////////////////////////////////////////////////////end///////////////////////////////////////////////////	?>
		 <td>

				<?php 

					if($row->queued == 1) 

					{

						if($row->email_template_status  == 0 && $row->email_send  == 0 && $row->stop_mail  == 0)

						{?>

						  <a href="<?php echo base_url().'chapteradmincp/events/queue_mail/'.$row->event_id;?>" title="send"><b>Send</b></a>

						<?php 

						}

						

						elseif($row->email_template_status  == 1 && $row->email_send  == 0 && $row->stop_mail  == 0)

						{?>

						  <a href="#" title="send"><b>Queue</b></a>

						<?php 							

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 1 && $row->stop_mail  == 1)

						{

						?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Stopped</a>

							</div>

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/events/start_mail/'.$row->event_id;?>" ><center>start</center></a></div> 

							<div style="clear:both"></div>

							</div>

							<?php	

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 1 && $row->stop_mail  == 0)

						{

						?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Sending</a>

							</div>

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/events/stop_mail/'.$row->event_id;?>" ><center>stop</center></a></div> 

							<div style="clear:both"></div>

							</div>

							<?php	

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 2 && $row->stop_mail  == 0)

						{?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Failed</a>

							</div>

							<div  id="stop"  ><a href="<?php echo base_url().'chapteradmincp/events/resume_mail/'.$row->event_id;?>" ><center>Resume</center></a></div> 

							<div style="clear:both"></div>

							</div>

						<?php

                        }

						

						

                }

                else

				{

					if($row->email_template_status  == 0 && $row->email_send  == 3 && $row->stop_mail  == 0)

						{?>

							<a  href="#" title="send">Complete</a>  

						<?php

                        }

						else

						{

					?>

                   <a style="display:none;" href="#" title="send"></a>

					<?php

						}

                }

                ?>

                </td>
        <td><?php echo $row->event_created_by; ?></td>

        <td><?php echo $row->event_created_date; ?></td>

        <td><?php echo $row->event_modified_by; ?></td>

        <td><?php echo $row->event_modified_date; ?></td>

        

        <td><a href="<?php echo base_url(); ?>chapteradmincp/events/edit/<?php echo $row->event_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>chapteradmincp/events/delete/<?php echo $row->event_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a>
        <a onclick="check_cron(<?php echo $row->event_id;?>,'edit')" href="javascript:void(0)" >Invite Members</a>
        </td>

    </tr>

    

		<?php

   }

}

else

{

	echo "<tr><td colspan='5'>".$this->lang->line('text_no_result')."</td></tr>";

}

?>

</table>



<?php echo $this->pagination->create_links(); ?>

</div>

</td></tr></table>

<script>

function check_cron(uid,status)

{
$('div#custom_box').addClass("custom_box_css");

	$.ajax({

		  url: BASE_URI+"chapteradmincp/events/cron_check/"+uid,

		  success: function(data) {

					var str=data.split("|");

					if(str[0]==1 && str[1] ==0 &&  str[3] ==1 && (str[2] ==0 || str[2] ==1))

					{

						alert('     Please Wait\nEvents are Sending.');

					}

					else

					{

						if(status=='edit')

						{
							
							
						var url = BASE_URI+"chapteradmincp/events/invite/event/"+uid;
				//		var url = "<?php //echo base_url('chapteradmincp/events/invite/event/'.$row->event_id.'.html'); ?>";    

						$(location).attr('href',url);

						}

						

						

					}

$('div#custom_box').removeClass("custom_box_css");

			}

		});	

}
</script>
<style>

#stop

{

	width:60px;

	float:right;

}

#stop a

{

	width:60px;

	background-color: #0081C2;

    background-image: linear-gradient(to bottom, #fff, #bbb);

    background-repeat: repeat-x;

    color: #333333;

    display: block;

    font-weight: normal;

    line-height: 20px;

    padding-bottom: 3px;

    padding-left: 5px;

    padding-right: 5px;

    padding-top: 0px;

    white-space: nowrap;

}

#stop a:hover

{

	-moz-text-blink: none;

    -moz-text-decoration-color: -moz-use-text-color;

    -moz-text-decoration-line: none;

    -moz-text-decoration-style: solid;

    background-color: #0081C2;

    background-image: linear-gradient(to bottom, #0088CC, #0077B3);

    background-repeat: repeat-x;

    color: #FFFFFF;

}

</style>
<?php /*?><div class="row" style="display:none" id="user_info" >
                    <a onclick="document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" 
                      href="javascript:void(0)">
    <span id="fade1" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote"  style="width:20%; top:25%; left:42%; height:auto">
                        <a onclick="document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:0px;">
                           
                            
                            <div style='float:left;'  class="span111">
                             	<div  id="used_data"></div>
							</div>
                            
                        </div>
                	</div>
                </div>
<script>
function cnt_user(uid) 
{
	$.ajax({
			    type: "POST",
				url: BASE_URI+"chapteradmincp/events/rsvp/",
		   		data :'id='+uid,
		 		success: function(data) 
				{
			  	document.getElementById('user_info').style.display="block";
				$('#used_data').html(data);
				document.getElementById('quote').style. zIndex='1031';
				document.getElementById('quote').style.visibility='visible';
				document.getElementById('fade1').style.display='block';
				}
		});
}
</script><?php */?>
<div class="row" style="display:none" id="user_info" >
                    <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" 
                      href="javascript:void(0)">
    <span id="fade1" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote">
                        <a onclick="$('#check_uncheck_all_user').html('<a href=javascript:void(0)>Check All user</a>');document.getElementById('fetch_user_data').value='';document.getElementById('check_uncheck_all_user_status').value='no';document.getElementById('quote').style.visibility='hidden';document.getElementById('fade1').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:20px;">
                           
                            
                            <div style='float:left;'  class="span111">
                             <div id="top_data">
                                <table style="width:800px">
                                 <center><b><div id="event_name"></div></b></center>
                                <th colspan="4"><b><center>Member Details<center></b></th>
                                <tr>
                               
                              
                                <td colspan="3" style="text-align:right">
                                <div style="float:left;">
        <strong><u>RSVP Details</u></strong>
        </div>
                                <select id="mm_type" name="mm_type" class="input-large" style="margin:0; display:none;  width:172px; margin-left:180px;">
        
                                <option id="mm_type_sel" value="0"  <?php // if($this->input->get('mm_type') == 0){ echo 'selected="selected"'; } ?> >All Members</option>
        
                                <option value="1" <?php //if($this->input->get('mm_type') == 1){ echo 'selected="selected"'; } ?>>Invited members</option>
        
                                <option value="2" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >RSVP members</option>
                                
                                <option value="3" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Confirmed members</option>
                                
                                <option value="4" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Maybe members</option>
                                
                                <option value="5" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Not Coming members</option>
                                
                                <option value="6" <?php //if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Pending members</option>
        
                                </select></td>
                                <td>
                                <div id="search" style="float:right;">
                                <a  href="javascript:void(0)"  >
                                	Search
                                </a>
                                </div>
                                <input type="text"  id="username" name="username" value="" placeholder='Search by name, username or email' style="float:right; margin-right:15px; margin-bottom: 0px !important ; margin-left:10px; width:230px;" />&nbsp;&nbsp;
                                
                                
                                </td></tr>
                                <tr>
                                <td>
                                <div id="rsvp_data"></div>
                                </td>
                                
                                </tr>
                                </table>
                                </div>
                                
                                <div  id="used_data"></div>
							</div>
                            
                        </div>
                        
                	</div>
                    
                </div>
                
                
            <textarea style="display:none" cols="1" rows="2" name="fetch_user_data" id="fetch_user_data"></textarea>
            <textarea style="display:none" cols="1" rows="2" name="fetch_user_data_after_save" id="fetch_user_data_after_save"><?php //echo $member_id;?></textarea>
           	<input type="hidden"  id="check_uncheck_all_user_status" name="check_uncheck_all_user_status" value="no"/>
			<input type="hidden" id="count_user" value="" />
            <input type="hidden" id="total_user" value="" />
            <input type="hidden" id="event_id" value="" />
            <input type="hidden" id="mm_type" value="0" />
            <input style="visibility:hidden"  checked="checked" type="checkbox" id="chapter[]" name="chapter[]" value=""  />
            
            
        </form>
    
<script>
/*function get_chapters(uid)
{
	$.ajax({url:BASE_URI+"admincp/events/get_template_user/",success:function(result){
    $("#div1").html(result);
  }});
}*/
function cnt_user(uid,ename) {
	//alert(uid);
	$('div#custom_box').addClass("custom_box_css");
	document.getElementById('event_name').innerHTML = ename;
	fetch_user(uid);
	get_chapters(uid);
	rsvp_user(uid,ename);
	//cnt_user1(uid);
}
/*
function cnt_user(uid) {
	
	$('div#custom_box').addClass("custom_box_css");
	
	//alert(uid);
	fetch_user(uid);
	get_chapters(uid);
	rsvp_user(uid);
	//cnt_user1(uid);
	//$('div#custom_box').removeClass("custom_box_css");


}*/
function fetch_user(uid)
{
	$.ajax({
	  type: "POST",
	  url: BASE_URI+'chapteradmincp/events/get_members/'+uid,
	  success: function(data) {
		  //alert(data);
		  document.getElementById('fetch_user_data_after_save').value=data;
		  document.getElementById('fetch_user_data').value=document.getElementById('fetch_user_data_after_save').value;
		  
		}
	});
}

function get_chapters(uid)
{
	$.ajax({
	  type: "POST",
	  url: BASE_URI+'chapteradmincp/events/get_chapters/'+uid,
	  success: function(data) {
		  //alert(data);
		  document.getElementById('chapter[]').value=data;
		  cnt_user1(uid);
		}
	});
}

function cnt_user1(uid) {
	//alert(uid);
	
	/*$.ajax({url:BASE_URI+"admincp/events/get_chapters/"+uid,success:function(result){
																			
    document.getElementById('chapter[]').value = result;
	
  }});
	
	$.ajax({url:BASE_URI+"admincp/events/get_members/"+uid,success:function(result){
																			
																			
    document.getElementById('fetch_user_data_after_save').value = result;
	
  }});*/
	
	//document.getElementById("mm_type_sel").selected=true;
	document.getElementById('event_id').value = uid;
	
	
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
		var mm_type=document.getElementById('mm_type').value;;
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
		
		$.ajax({
				   type: "POST",
		 //url: BASE_URI+"chapteradmincp/events/get_template_user/"+username+"/<?php //echo $item->uid; ?>/"+n+"/0/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
		 
		 url: BASE_URI+"chapteradmincp/events/get_template_user1/",
		  data :'mm_type='+mm_type+'&username='+username+'&id='+uid+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
		 success: function(data) {
			 //alert(data);
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
				
				/*var id_u=0;
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
				}*/
			}
			}
		});
		}
		else
		{
		alert('data not found')	;
		}
}
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
	var mm_type=document.getElementById('mm_type').value;;
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
	
    $.ajax({
				   type: "POST",
			  
		  url: BASE_URI+"chapteradmincp/events/get_template_user1/",
		   data :'mm_type='+mm_type+'&username='+username+'&id='+document.getElementById('event_id').value+'&ch_id='+ n+'&offset='+offset+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
		   
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
function search_rsvp(mm_type_data) {
	$("#username").val("");
$('div#custom_box').addClass("custom_box_css");
							
	document.getElementById('mm_type').value = mm_type_data;
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
			var mm_type=mm_type_data;
			
			
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
			
			$.ajax({
				   type: "POST",
			//url: BASE_URI+"chapteradmincp/events/get_template_user/"+username+"/<?php //echo $item->uid; ?>/"+n+"/"+0+"/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
			url: BASE_URI+"chapteradmincp/events/get_template_user1/",
			data :'mm_type='+mm_type+'&username='+username+'&id='+document.getElementById('event_id').value+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
			success: function(data) {
				var str=data.split("|");
				$('#count_user').val(str[1]);
				$('#total_user').val(str[2]);
				$('#used_data').html(str[0]);

$('div#custom_box').removeClass("custom_box_css");
			}
			});
		}
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
			//url: BASE_URI+"chapteradmincp/events/get_template_user/"+username+"/<?php //echo $item->uid; ?>/"+n+"/"+0+"/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
			url: BASE_URI+"chapteradmincp/events/get_template_user1/",
			data :'mm_type='+mm_type+'&username='+username+'&id='+document.getElementById('event_id').value+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
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
/*
function rsvp_user(uid) 
{
	

	$.ajax({
			    type: "POST",
				url: BASE_URI+"chapteradmincp/events/rsvp/",
		   		data :'id='+uid,
		 		success: function(data) 
				{
					//alert(data);
			  		//document.getElementById('rsvp_data').=data;
					$('#rsvp_data').html(data);
				$('div#custom_box').removeClass("custom_box_css");
				}
		});
}*/
function export_to_excel(mm_type_data,event_name,count) {
							//alert("hi");
							//alert(count);
	document.getElementById('mm_type').value = mm_type_data;
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
			var mm_type=mm_type_data;
			
			
			if($.trim(mm_type)=='')
			{
			mm_type=0;	
			}
			
			$.ajax({
				   type: "POST",
			//url: BASE_URI+"chapteradmincp/events/get_template_user/"+username+"/<?php //echo $item->uid; ?>/"+n+"/"+0+"/"+fetch_user_data+"/"+$('#check_uncheck_all_user_status').val(),
			url: BASE_URI+"chapteradmincp/events/get_template_user2/",
			data :'count='+count+'&event_name='+event_name+'&mm_type='+mm_type+'&username='+username+'&id='+document.getElementById('event_id').value+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
			success: function(data) {
				var str=data.split("|");
				$('#count_user').val(str[1]);
				$('#total_user').val(str[2]);
				//$('#used_data').html(str[0]);
				//alert(data);
				$('#theexcelfile').attr('href',data);
				$('#theexcelfile').click();
window.open(data,'_blank');
			}
			});
		}
}
function rsvp_user(uid,ename) 
{
	
	$.ajax({
			    type: "POST",
				url: BASE_URI+"chapteradmincp/events/rsvp/",
		   		data :'id='+uid+'&ename='+ename,
		 		success: function(data) 
				{
					//alert(data);
			  		//document.getElementById('rsvp_data').=data;
					$('#rsvp_data').html(data);
					$('div#custom_box').removeClass("custom_box_css");
				}
		});
}
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
<?php $this->load->view('chapteradmincp/layout/footer'); ?>