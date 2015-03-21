<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_news.html'); ?>">Add News</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        
        <?php
			if($query)
			{
				foreach($query as $row)
				{
					?>
                    	<h3 class="nopadding nomargin"><a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>"><?php echo $row->news_title;?></a></h3>
                        <h6 class="nopadding nomargin"><?php echo $row->news_create; ?></h6>
                        <p><?php echo  character_limiter(strip_tags($row->news_content,400));?></p>
                        <p class="small">
                        <a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Read More</a> | 
                        <a href="<?php echo base_url('ca/edit_news/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Edit</a> | 
                        <a onclick="javascript: return del();" href="<?php echo base_url('ca/delete_news/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Delete</a>
                        </p>
                    <?php
				}
			}
			else
			{
				echo 'No news found.';
			}
		?>
        
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>