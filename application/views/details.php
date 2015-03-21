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
                   <h1>
				   <?php 
				   if($this->uri->segment(2)=='custom')
				   {
					   echo $this->lang->line('text_your');
					}
				   else
				   {
				   	echo $row->covers_name;
				   }
				   ?> <?php echo $this->lang->line('text_facebook_cover');?></h1>
                   <div class="addthis_nav">
                   	<span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                    <span class='st_sharethis_large' displayText='ShareThis'></span>
                   </div>
                </div>
            </div>
    
        <div class="space5px"></div>

        
        <?php
			if($this->uri->segment(4)=='uploaded')
			{
			?>
			<div class="alert alert-success"><?php echo $this->lang->line('text_uploaded_msg');?><a target="_blank" href="<?php echo $this->fb_connect->user['link'];?>?preview_cover=<?php echo $this->uri->segment(5); ?>">click here</a></div>
            <?php
			}
		?>
        <div class="category_content">
			
        <div class="cover_box" style="text-align:center;">
                
                    
                    <div class="coverimage coverimage_preview" style="position:relative; text-align:center;">
                        
                        	<span class="hidden_box" style="width:849px;">
                            <a href="<?php echo base_url().'oauth/facebook/uploadcover/'.$row->covers_id.'/'.friendlyURL($row->covers_name).'.html';?>">
                            	<div class="cover_title_bg_top"></div>
                            	<div class="cover_title"><h3><?php if($row->covers_name) { echo $row->covers_name; }else{ echo $this->lang->line('text_untitled'); } ?></h3></div>
                                <div class="rating_box"><?php echo $this->ratings->bar($row->covers_id,5); ?></div>
                                <div class="cover_title_bg_btm_big"></div>
                                <div class="cover_title_counter_big">
                                <div class="counter_view"><?php echo $this->lang->line('text_totalviews');?> <em class="badge badge-important"><?php echo $row->covers_views;?></em></div>
                                <div class="counter_download"><?php echo $this->lang->line('text_totaldownload');?> <em class="badge badge-success"><?php echo $row->covers_downloads;?></em></div>
                                </div>
                            </a>
                            <div class="download_btn_big"><a href="<?php echo base_url().'oauth/facebook/uploadcover/'.$row->covers_id.'/'.friendlyURL($row->covers_name).'.html';?>" title="<?php echo $this->lang->line('btn_download_cover');?>" class="btn btn-large btn-primary download_img_btn" ><?php echo $this->lang->line('btn_download_cover');?></a></div>
                            </span>
                            
                            <?php
                            $pi = pathinfo($row->covers_image);
                            $txt = $pi['filename'];
                            $ext = isset($pi['extension']);
                            if(!$ext)
                            {
                            ?>
                            <img src="<?php echo base_url();?>covers-images/download/<?php echo $row->covers_image;?>.jpg" border="0" width="851" height="315" />
                            <?php
                            }
                            else
                            {
                            ?>
                        	<img src="<?php echo base_url();?>covers-images/download/<?php echo $row->covers_image;?>" border="0" width="851" height="315" />
                            <?php
                            }
                            ?>
                            <div class="profile-header-inner-overlay"></div>
                    </div>
                </a>
            </div>

<div align="center">
    <span class="download_btn_fixed">
    <a href="<?php echo base_url().'oauth/facebook/uploadcover/'.$row->covers_id.'/'.friendlyURL($row->covers_name).'.html';?>" title="<?php echo $this->lang->line('btn_download_cover');?>" class="btn btn-large btn-primary no_profile" ><?php echo $this->lang->line('btn_download_cover');?></a>
    </span>
        
    <span class="download_btn_fixed">
    <a href="<?php echo base_url().'create/customize/'.friendlyURL($row->covers_name).'.html';?>" title="<?php echo $this->lang->line('text_customize');?>" class="btn btn-large btn-primary" ><?php echo $this->lang->line('text_customize');?></a>
    </span>
</div>

<div class="space10px"></div>
<div class="clear"></div>

<?php $this->load->view('common_view'); ?>
        
<div class="space10px"></div>
<div class="fb-comments" data-href="<?php echo base_url().'covers/'.$row->covers_cat_seo.'/'.friendlyURL($row->covers_seo).'.html';?>" data-num-posts="5" data-width="851"></div>
            
        </div>
            
    </div>
    
</div>
</div>
<script type="text/javascript">
$('.with_profile').click(function(){
	$('.with_profile').text('<?php echo $this->lang->line('btn_uploading_please_wait');?>');
	$('.with_profile').addClass('disabled');
	});
$('.no_profile').click(function(){
	$('.no_profile').text('<?php echo $this->lang->line('btn_uploading_please_wait');?>');
	$('.no_profile').addClass('disabled');
	});
$('.download_img_btn').click(function(){
	$('.no_prodownload_img_btnile').text('<?php echo $this->lang->line('btn_uploading_please_wait');?>');
	$('.no_prodownload_img_btnile').addClass('disabled');
	});

</script>
<?php $this->load->view('footer'); ?>