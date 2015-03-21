<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
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
				$a=0;
				foreach($query as $row)
				{
					?>
                    	<?php if(isset($chapter->ch_seo)) { ?>
                    	<h4 class="nopadding nomargin bold"><a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>"><?php echo $row->news_title;?></a> <span class="label label-inverse" style="float:right;"><?php echo $row->ch_name; ?></span> </h4>
                         <h6 class="nopadding nomargin"><?php echo $row->news_create; ?></h6>
                        <p><?php echo  character_limiter(strip_tags($row->news_content,150));?></p>
                        <p class="small">
                        <a href="<?php echo base_url('news/'.$chapter->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Read More</a>
                        
                        <?php }else { ?>
                        <h4 class="nopadding nomargin bold"><a href="<?php echo base_url('news/'.$row->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>"><?php echo $row->news_title;?></a> <span class="label label-inverse" style="float:right;"><?php echo $row->ch_name; ?></span> </h4>
                         <h6 class="nopadding nomargin"><?php echo $row->news_create; ?></h6>
                        <p><?php echo  character_limiter(strip_tags($row->news_content,150));?></p>
                        <p class="small">
                        <a href="<?php echo base_url('news/'.$row->ch_seo.'/'.$row->news_id.'/'.friendlyURL($row->news_title).'.html'); ?>">Read More</a>
                        
                        <?php }?>
                       
                        </p>
                        <hr class="hr_2px nomargin"/>
                    <?php
				$a++;
				}
			}
			else
			{
				echo 'No news found.';
			}
		?>
		
        <div class="clear"></div>
        
        <div style="clear:both;">
		<?php echo $this->pagination->create_links(); ?>
        </div>

        </div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
    <?php $this->load->view('ca_menu'); ?>
        <?php 
		
		if(isset($chapter->ch_seo))
		{
			$this->load->view('chapter_menu');
		}
		else
		{
			$this->load->view('news_menu');
		}
		?>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>