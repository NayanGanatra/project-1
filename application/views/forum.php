<?php $this->load->view('header'); ?>
<link href="<?php echo base_url(); ?>css/chap_page.css" rel="stylesheet" type="text/css">
<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container" style="min-height:500px; margin-bottom:30px;">
	<div class="row">
<?php $this->load->view('action_status'); ?>

<div class="span10 nomargin" style="width:100%;">
		<?php if($blog){ 
		foreach($blog as $blogs)
		{
			$login = $this->session->userdata('user_id');
			if($login)
			{
				$forumuser = $this->dbheader->user_details_by_id($this->session->userdata('user_id'));
				$user_ch = $this->dbblog->get_ch_from_state($forumuser->mm_state_id);
				$blog_chs = $this->dbblog->get_all_chapters($blogs->bid);
				$charr = array();
				foreach($blog_chs as $blog_ch)
				{
					array_push($charr,$blog_ch->ch_id);
				}
				if(in_array($user_ch->ch_id,$charr) || in_array(0,$charr)){
			
			?>
        <div class="page_content" style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:5px auto; padding:0 0 0 15px;">
	<div style="margin:10px auto; padding:0px;">
	<?php if($blogs->send_mail_to!=-1){ $addedby = $this->dbheader->user_details_by_id($blogs->send_mail_to); ?>
	<img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($addedby->mm_photo!=''){ echo $addedby->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;" /> <?php } else {?><img src="<?php echo base_url(); ?>images/logo-small.png" height="40px" width="40px" alt="" style="float:left;" /><?php } ?>
	<div style="float:left; margin: 0 10px; width:94%;">
		<a href="<?php echo base_url().'forum/read_forum/'.$blogs->bid; ?>" style="float:left; margin-right:10px;">
		<h4 class="nopadding nomargin bold" style="color:#0088CC;">
		<?php echo $blogs->title; ?>
	</h4></a>
	<span style="float: left; margin-left: 0px; font-size:13px;"><span>Created By:</span>&nbsp; <i><?php echo $blogs->blog_created_by; ?></i></span>
	<span style="float:left; margin-left:40px; font-size:13px;"><span>Created Date:</span>&nbsp;<i><?php echo $blogs->blog_created_date; ?></i></span>
	</div>
	<div style="margin: 0px 0px 0px 52px; width:94%;">
<?php echo word_limiter($blogs->blog_description,110); if(str_word_count($blogs->blog_description)>=110){ ?>

                        <a href="<?php echo base_url().'forum/read_forum/'.$blogs->bid; ?>">Read More</a>
                      <?php } ?></div>
	</div>
	
        <?php
			$commentCount = $this->dbblog->get_all_comments_count($blogs->bid);
			$replyCount = $this->dbblog->get_all_reply_count($blogs->bid);
			
			$blog_chs = $this->dbblog->get_all_chapters($blogs->bid);
		?>
		<div style="margin:0px 0 5px 52px;">
		<span class="label label-info"><?php echo $commentCount; ?> Comments</span>
		<span class="label label-success"><?php echo $replyCount; ?> Replies</span>
		<?php 
		if($blog_chs)
		{
			foreach($blog_chs as $blog_ch)
			{
				$chapter_name = $this->dbheader->get_chapter($blog_ch->ch_id);
				$color = '';
					if($chapter_name->ch_name=='California')
					{
						$color = 'cal';
					}
					else if($chapter_name->ch_name=='Canada')
					{
						$color = 'cnd';
					}
					else if($chapter_name->ch_name=='Florida')
					{
						$color = 'fld';
					}
					else if($chapter_name->ch_name=='Georgia')
					{
						$color = 'geo';
					}
					else if($chapter_name->ch_name=='Illinois')
					{
						$color = 'ill';
					}
					else if($chapter_name->ch_name=='Michigan')
					{
						$color = 'mich';
					}
					else if($chapter_name->ch_name=='Washington-DC')
					{
						$color = 'washing';
					}
					else if($chapter_name->ch_name=='Texas')
					{
						$color = 'tex';
					}
					else if($chapter_name->ch_name=='North Carolina')
					{
						$color = 'north-car';
					}
					else if($chapter_name->ch_name=='New Jersey')
					{
						$color = 'nj';
					}
					else if($chapter_name->ch_name=='National')
					{
						$color = 'nat';
					}
				?><span class="label label-inverse <?php echo $color; ?>" style="float:right; margin:3px 3px 0 0;"><?php echo $chapter_name->ch_name; ?></span>
		<?php }
		}
		
		?>
		</div>
		</div>
		<?php } } else { ?>
		<div class="page_content" style="min-height:50px; border-radius:5px; border:1px solid #E7E7E7; margin:5px auto; padding:0 0 0 15px;">
	<div style="margin:10px auto; padding:0px;">
	<?php if($blogs->send_mail_to!=-1){ $addedby = $this->dbheader->user_details_by_id($blogs->send_mail_to); ?>
	<img src="<?php echo base_url(); ?>images/profile/thumb/<?php if($addedby->mm_photo!=''){ echo $addedby->mm_photo; } else{ echo 'nophoto.png'; }?>" height="40px" width="40px" alt="" style="float:left;" /> <?php } else {?><img src="<?php echo base_url(); ?>images/logo-small.png" height="40px" width="40px" alt="" style="float:left;" /><?php } ?>
	<div style="float:left; margin-left: 10px; width:94%;">
		<a href="<?php echo base_url().'forum/read_forum/'.$blogs->bid; ?>" style="float:left; margin-right:10px;">
		<h4 class="nopadding nomargin bold" style="color:#0088CC;">
		<?php echo $blogs->title; ?>
	</h4></a>
	<span style="float: left; margin-left: 0px; font-size:13px;"><span>Created By:</span>&nbsp; <i><?php echo $blogs->blog_created_by; ?></i></span>
	<span style="float:left; margin-left:40px; font-size:13px;"><span>Created Date:</span>&nbsp;<i><?php echo $blogs->blog_created_date; ?></i></span></div>
	</div>
	<br />
<h6 class="nopadding nomargin"></h6>
						<div style="margin: 0px 0px 0px 52px; width:94%;">
<?php echo word_limiter($blogs->blog_description,110); if(str_word_count($blogs->blog_description)>=110){ ?>

                        <a href="<?php echo base_url().'forum/read_forum/'.$blogs->bid; ?>">Read More</a>
                      <?php } ?></div>

        <?php
			$commentCount = $this->dbblog->get_all_comments_count($blogs->bid);
			$replyCount = $this->dbblog->get_all_reply_count($blogs->bid);
			
			$blog_chs = $this->dbblog->get_all_chapters($blogs->bid);
		?>
		<div style="margin:0 0 5px 52px;">
		<span class="label label-info"><?php echo $commentCount; ?> Comments</span>
		<span class="label label-success"><?php echo $replyCount; ?> Replies</span>
		<?php 
		if($blog_chs)
		{
			foreach($blog_chs as $blog_ch)
			{
				$chapter_name = $this->dbheader->get_chapter($blog_ch->ch_id);
				$color = '';
					if($chapter_name->ch_name=='California')
					{
						$color = 'cal';
					}
					else if($chapter_name->ch_name=='Canada')
					{
						$color = 'cnd';
					}
					else if($chapter_name->ch_name=='Florida')
					{
						$color = 'fld';
					}
					else if($chapter_name->ch_name=='Georgia')
					{
						$color = 'geo';
					}
					else if($chapter_name->ch_name=='Illinois')
					{
						$color = 'ill';
					}
					else if($chapter_name->ch_name=='Michigan')
					{
						$color = 'mich';
					}
					else if($chapter_name->ch_name=='Washington-DC')
					{
						$color = 'washing';
					}
					else if($chapter_name->ch_name=='Texas')
					{
						$color = 'tex';
					}
					else if($chapter_name->ch_name=='North Carolina')
					{
						$color = 'north-car';
					}
					else if($chapter_name->ch_name=='New Jersey')
					{
						$color = 'nj';
					}
					else if($chapter_name->ch_name=='National')
					{
						$color = 'nat';
					}
				?><span class="label label-inverse <?php echo $color; ?>" style="float:right; margin:3px 3px 0 0;"><?php echo $chapter_name->ch_name; ?></span>
		<?php }
		}
		
		?>
		</div>
		</div>
		<?php } } }
		else { ?>
		<h6 class="nopadding nomargin">Forum not available</h6>	
		<?php }
		?>
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