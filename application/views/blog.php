<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">
<?php $this->load->view('action_status'); ?>

<div class="span10 nomargin" style="min-height:480px;">
<?php if(isset($this->session->userdata['user_id'])){ ?>
		<?php if($blog){ 
		foreach($blog as $blogs)
		{
		?>
        <div class="page_content" style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:10px auto; padding:15px;">
		
		
	<div style="margin:10px auto; padding:0px;">
	<?php if($blogs->send_mail_to!=-1){ $addedby = $this->dbheader->user_details_by_id($blogs->send_mail_to); ?>
	<img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($addedby->mm_photo!=''){ echo $addedby->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;" /> <?php } else {?><img src="<?php echo base_url(); ?>images/logo-icon.png" height="40px" width="40px" alt="" style="float:left;" /><?php } ?>
	<span style="float:left; margin-left: 10px; width:92%;">
		<a href="<?php echo base_url().'blog/read_blog/'.$method.'/'.$blogs->bid; ?>">
		<h4 class="nopadding nomargin bold" style="color:#0088CC;">
		<?php echo $blogs->title; ?>
	</h4></a></span>
	<span style="float: left; margin-left: 10px;"><b>Created By:</b>&nbsp; <i><?php echo $blogs->blog_created_by; ?></i></span>
	<span style="float:left; margin-left:40px;"><b>Created Date:</b>&nbsp;<i><?php echo $blogs->blog_created_date; ?></i></span></div><br />
<h6 class="nopadding nomargin"></h6>
<div style="margin: 25px 0px 5px 52px;"><?php echo $blogs->blog_description; ?></div>

     <?php
			$commentCount = $this->dbchapter->get_all_comments_count($blogs->bid);
			$replyCount = $this->dbchapter->get_all_reply_count($blogs->bid);
		?>
			<div style="margin-bottom:10px;">
			<span class="label label-info"><?php echo $commentCount; ?> Comments</span>
			<span class="label label-success"><?php echo $replyCount; ?> Replies</span>
			</div>
		</div>
		<?php } }
		else
		{	?>
			<h6 class="nopadding nomargin">Blog is not available</h6>
		<?php }
		 }else
		{?>
		<h6 class="nopadding nomargin">Please Login to view Blog</h6>
		<?php } ?>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
         <?php 
		if(isset($chapter->ch_seo))
		{
		$this->load->view('chapter_menu');
		}
		else
		{
			$this->load->view('events_menu');
		}
		?>
        <?php $this->load->view('ca_menu'); ?>
        <?php $this->load->view('ads_panel'); ?>
        <div class="space20px"></div>
    </div>
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
$(".reply").click(function(){
	$("#submitreply"+$(this).attr('id')).slideToggle();
	//$(this).slideDown();
});
$(document).ready(function(){
$(".hideall").hide();
});
</script>
<?php $this->load->view('footer'); ?>