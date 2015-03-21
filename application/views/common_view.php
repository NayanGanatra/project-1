<div class="home_content">
       	<?php
		$i=0;
		if($query)
		{
			foreach ($query as $row) {
				if($i%2==0) { $boxstyle = ""; 	} else { $boxstyle="";} $i++;
			?>
            	
            	<div class="cat_cover_box span6" style=" <?php echo $boxstyle; ?> ">
                	
                        <div class="cat_cover_title"> <div class="viewcountBox"></div></div>
                        
                        <div class="coverimage" style="position:relative;">
                            
                            <span class="hidden_box">
                            	<a href="<?php echo base_url().'covers/'.$row->covers_cat_seo.'/'.$row->covers_seo.'.html'; ?>" title="<?php if($row->covers_name) { echo $row->covers_name; }else{ echo "Untitled"; } ?> <?php echo $this->lang->line('category_headline_prefix');?>">
                                <div class="cover_title_bg_top"></div>
                            	<div class="cover_title"><h3><?php if($row->covers_name) { echo $row->covers_name; }else{ echo $this->lang->line('text_untitled'); } ?></h3></div>
                                <div class="rating_box"><?php echo $this->ratings->bar($row->covers_id,5); ?></div>
                                <div class="cover_title_bg_btm"></div>
                                <div class="cover_title_counter">
                                <div class="counter_view"><?php echo $this->lang->line('text_totalviews');?> <em class="badge badge-important"><?php echo $row->covers_views;?></em></div>
                                <div class="counter_download"><?php echo $this->lang->line('text_totaldownload');?> <em class="badge badge-success"><?php echo $row->covers_downloads;?></em></div>
                                </div>
                                </a>
                                <div class="download_btn"><a href="<?php echo base_url().'covers/'.$row->covers_cat_seo.'/'.$row->covers_seo.'.html'; ?>" title="<?php if($row->covers_name) { echo $row->covers_name; }else{ echo $this->lang->line('text_untitled'); } ?> <?php echo $this->lang->line('category_headline_prefix');?>" class="btn btn-large btn-primary" ><?php echo $this->lang->line('btn_download_cover');?></a></div>
                            </span>
                            <img alt="<?php if($row->covers_name) { echo $row->covers_name; }else{ echo $this->lang->line('text_untitled'); } ?> <?php echo $this->lang->line('category_headline_prefix'); ?>" class="thumb_style" src="<?php echo base_url();?>covers-images/thumbs/<?php echo $row->covers_image;?>" width="420" height="155" border="0" />
                        </div>

                    <div class="item_share_block">
                         <div class="downloadscountBox"></div>
                    </div>
                    
                </div>
            <?php }
		}
		else
		{
		echo $this->lang->line('text_noresultfound');
		}
		 ?>
</div>