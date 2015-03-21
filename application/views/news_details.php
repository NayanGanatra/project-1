<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
        <div class="page_content" >
        <?php $this->load->view('action_status'); ?>
        
        <?php
			if($query)
			{
				echo $query->news_content;
			}
			else
			{
				redirect(base_url('error'));
			}
		?>
		
        <div class="clear"></div>
        </div>
</div>


<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('chapter_menu'); ?>
        <?php $this->load->view('ca_menu'); ?>
        <?php $this->load->view('ads_panel'); ?>
        <div class="space20px"></div>
    </div>
</div>


</div></div>
<?php $this->load->view('footer'); ?>