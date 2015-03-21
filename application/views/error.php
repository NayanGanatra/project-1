<?php $this->load->view('header'); ?>
<div class="container" style="margin-top:30px;">
	<div class="row" style="min-height:500px;">
        
        <div style="font-size:20px; padding-left:10px;"><?php echo $this->lang->line('text_404_headliine'); ?></div>
        <div style="font-size:12px; padding-left:10px; padding-top:6px;"><?php echo $this->lang->line('text_404_description'); ?></div>
        
        <div class="space10px"></div>
        <div class="not_found_links">
        	<ul>
            	<li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('link_text_latest_cover'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>popular"><?php echo $this->lang->line('link_text_popular_cover'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>random"><?php echo $this->lang->line('link_text_random_cover'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('link_text_back_to_home'); ?></a></li>
            </ul>
        </div>
    
</div></div>
<?php $this->load->view('footer'); ?>


