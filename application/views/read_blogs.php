<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container" style="min-height:500px;">
	
	<div class="row" style="min-height:500px; border-radius:5px; border:1px solid #E7E7E7; margin:10px auto; padding:15px;">
<?php $this->load->view('action_status'); ?>

<div class="span10 nomargin" style="width:100%;">
<?php if(isset($this->session->userdata['user_id'])){ ?>
		<?php if($blog){ 
		?>
        
	<div style="margin:10px auto; padding:0px;">
	<?php if($blog->send_mail_to!=-1){ $addedby = $this->dbheader->user_details_by_id($blog->send_mail_to); ?>
	<img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($addedby->mm_photo!=''){ echo $addedby->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;" /> <?php } else {?><img src="<?php echo base_url(); ?>images/logo-icon.png" height="40px" width="40px" alt="" style="float:left;" /><?php } ?>
	<span style="float:left; margin-left: 10px; width:94%;"><h4 class="nopadding nomargin bold" style="color:#0088CC;">
		<?php echo $blog->title; ?>
	</h4></span>
	<br />
	<span style="float:left; margin-left: 10px;"><b>Created By:</b>&nbsp; <i><?php echo $blog->blog_created_by; ?></i></span>
	<span style="float:left; margin-left:40px;"><b>Created Date:</b>&nbsp;<i><?php echo $blog->blog_created_date; ?></i></span></div><br />
<h6 class="nopadding nomargin"></h6>
<div style="margin: 25px 0px 5px 52px;"><?php echo $blog->blog_description; ?></div>
<div id="comments">
			<?php 
				$commentCount = $this->dbblog->get_all_comments_count($blog->bid);
				$replyCount = $this->dbblog->get_all_reply_count($blog->bid);
			?>
			<div style="margin-bottom:10px;">
			<span class="label label-info"><?php echo $commentCount; ?> Comments</span>
			<span class="label label-success"><?php echo $replyCount; ?> Replies</span>
			</div>
        <?php
			$query = $this->dbblog->get_all_comments($blog->bid,10,0);
			if($query)
			{	
			foreach($query as $row)
				{?>
					<?php $commentUser = $this->dbheader->user_details_by_id($row->mm_id); ?>
					<div style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:10px auto; padding:15px;">
					<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($commentUser->mm_photo!=''){ echo $commentUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:6px; float:left;"><?php echo $commentUser->mm_username; ?></span>&nbsp;&nbsp;&nbsp;<b>Commented on </b><i><?php echo $row->comment_date; ?></i></div>
					<div style="margin:25px 0 0 50px;">
					<p><?php echo $row->text; ?></p>
					
					<a onclick="reply_toggle(this);" href="javascript: void(0)" class="reply" id="<?php echo $row->comment_id; ?>">reply</a><br />
					</div>
					<?php
						$queryReply = $this->dbblog->get_all_reply($row->comment_id,$blog->bid);
						if($queryReply)
						{
							foreach($queryReply as $reply)
							{ ?>
								<?php $replyUser = $this->dbheader->user_details_by_id($reply->mm_id); ?>
								<div class="row" style="border-radius:5px; border:1px solid #E7E7E7; margin:10px 0 0 45px; padding:15px;">
								<div><img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($replyUser->mm_photo!=''){ echo $replyUser->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;"/>
					<span style="margin-left:6px;"><?php echo $replyUser->mm_username; ?></span>&nbsp;&nbsp;&nbsp;<b>Replied on </b><i><?php echo $reply->reply_date; ?></i></div>
					<div style="margin:25px 0 0 50px;">
					<p><?php echo $reply->text; ?></p>
					</div>
					</div>
							<?php }
						}
					?>
					<form class="hideall" id="submitreply<?php echo $row->comment_id; ?>" action="<?php echo base_url().'blogs/read_blog/'.$blog->bid; ?>" method="POST" style="margin:10px 0 0 45px;">
					<input type="hidden" name="hdncorr" value="0"/>
					<input type="hidden" value="<?php echo $row->comment_id; ?>" name="hdncid"/>
					<input type="hidden" value="<?php echo $blog->bid; ?>" name="hdnbid"/>
					<textarea value="" placeholder="type your reply here" name="replybox" id="replybox<?php echo $row->comment_id; ?>" style="height:50px; width:400px; margin-bottom:20px;"></textarea><br />
					
					<input type="button" value="Reply" class="btn" style="margin-top:-10px;" onclick="return submit_reply(<?php echo $row->comment_id; ?>);">
					</form>
					</div>
					<?php
				}
			}
			
		?>
		</div>
		<input type="hidden" id="hdnend" value="0"/>
		<input type="hidden" id="hdnstart" value="10"/>
		<div id="LoadingImage" style="display:none; margin:10px 0 0 0px; text-align:center;"><img src="<?php echo base_url(); ?>images/bx_loader.gif" alt="" style="height:20px; width:auto;"/> </div>
		<div id="nomore" style="display:none; margin:10px 0 0 0px;"><b><i>No more comments found</i></b></div>
		<form id="submitcomment<?php echo $blog->bid; ?>" action="<?php echo base_url().'blogs/read_blog/'.$blog->bid; ?>" method="POST" style="margin:10px 0 0 0px;">
		<input type="hidden" name="hdncorr" value="1"/>
		<input type="hidden" value="<?php echo $blog->bid; ?>" name="hdnbid"/>
		<textarea value="" placeholder="type your comment here" name="commentbox" id="commentbox<?php echo $blog->bid; ?>" style="height:75px; width:400px; margin-bottom:20px;"></textarea><br />
		<input type="button" value="Comment" class="btn" style="margin-top:-10px;" onclick="return submit_form(<?php echo $blog->bid; ?>);"/>
		</form>
		
		<?php  }
		else { ?>
		<h6 class="nopadding nomargin">Member Blog not available</h6>	
		<?php }
		} else
		{?>
		<h6 class="nopadding nomargin">Please Login to view Blog</h6>
		<?php } ?>
</div>
</div></div>
<script>
function submit_form(bid)
{
	if($("#commentbox"+bid).val()=='' || $("#commentbox"+bid).val()==null)
	{
		alert("You can not submit a blank comment");
		return false;
	}
	else
	{
		$("#submitcomment"+bid).submit();
		return true;
	}
}
function submit_reply(cid)
{
	if($("#replybox"+cid).val()=='' || $("#replybox"+cid).val()==null)
	{
		alert("You can not submit a blank reply");
		return false;
	}
	else
	{
		$("#submitreply"+cid).submit();
		return true;
	}
}
function reply_toggle(item)
{
	$("#submitreply"+$(item).attr('id')).slideToggle();
}
$(document).ready(function(){
$(".hideall").hide();
});
$(document).ready(function() {
		$(window).scroll(function(){
		if ($(window).scrollTop() == $(document).height() - $(window).height()){
		/*$('#hdnstart').val(parseInt($('#hdnstart').val())+10);*/
		$('#hdnend').val(parseInt($('#hdnend').val())+10);
		$("#LoadingImage").show();
		$.ajax({
	   type: "POST", 
	   data: "id="+<?php echo $blog->bid; ?>+"&limit="+$('#hdnstart').val()+"&offset="+$('#hdnend').val(),
	url: BASE_URI+"blogs/loadmore_comments",
	success: function(data) {
	if(data=='' || data==null)
	{
		$("#LoadingImage").hide();
		$('#nomore').css("display","block");
	}
	else
	{
		$("#LoadingImage").hide();
		$('#comments').append(data);		
		$(".hideall").hide();	
	}
	
		}
		});
		}
	});
});
</script>
<?php $this->load->view('footer'); ?>