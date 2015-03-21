<?php $this->load->view('header'); ?>
<div class="container" style="margin-top:60px;">
	<div class="row">
<div class="span3" style="margin-left:0; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('sidebar'); ?>
    </div>
    
</div>
<div class="span11">
		<?php $header_ads = $this->dbheader->get_ads('728x90'); if($header_ads){ ?>
        <div class="banner728" align="center"><?php echo $header_ads->ads_code; ?></div>
        <div class="space10px"></div>
        <?php } ?>
        
            <div class="navbar">
                <div class="navbar-inner">
                   <h1><?php echo $this->lang->line('text_search_result');?></h1>
                   <div class="addthis_nav">
                   	<span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                    <span class='st_sharethis_large' displayText='ShareThis'></span>
                   </div>
                </div>
            </div>
    
        <div class="space5px"></div>
        <?php $this->load->view('common_view'); ?>
        
        <div class="clear"></div><div class="space10px"></div>
		<?php 
		if($query)
		{
			echo $this->pagination->create_links();
		}
		?>
</div>
    
</div></div>
<?php $this->load->view('footer'); ?>