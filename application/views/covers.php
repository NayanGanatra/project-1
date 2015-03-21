<?php $this->load->view('header'); ?>
<div class="container" style="margin-top:60px;">
	<div class="row">
<div class="span4">
    <div class="sidebar">
        <?php $this->load->view('sidebar'); ?>
    </div>
    
</div>
<div class="span9">
<?php $header_ads = $this->dbheader->get_ads('728x90'); if($header_ads){ ?>
        
        <div class="728banner"><?php echo $header_ads->ads_code; ?></div>
        <div class="space10px"></div>
        <?php } ?>
    
            <div class="navbar">
                <div class="navbar-inner">
                   <h1><?php $cat_details = $this->dbcovers->cat_details($this->uri->segment(2)); echo $cat_details->covers_cat_name; ?> <?php echo $this->lang->line('category_headline_prefix');?></h1>
                   <div class="addthis_nav">
                   	<span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                    <span class='st_sharethis_large' displayText='ShareThis'></span>
                    <a class='rss_icon' href="<?php echo base_url().'rss/'.$this->uri->segment(2);?>" title='<?php echo $this->lang->line('rss_icon_text');?>'></a>
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