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
                    	<h4 class="nopadding nomargin bold"><a href="<?php echo base_url('chapter/'.$row->ch_seo.'.html'); ?>"><?php echo $row->ch_name;?></a></h4>
                        <p><?php echo  character_limiter(strip_tags($row->ch_desc,150));?></p>
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
    	<div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
            <li <?php if($this->uri->segment(2) == ''){ ?>class="active"<?php } ?>><a href="<?php echo base_url('chapter.html'); ?>"><i class="icon-chevron-left"></i> National</a></li>
        <?php
			if($query)
			{
				$a=0;
				foreach($query as $row)
				{
					?>
                        <li <?php if($this->uri->segment(2) == $row->ch_seo){ ?>class="active"<?php } ?>><a href="<?php echo base_url('chapter/'.$row->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $row->ch_name; ?></a></li>
                    <?php
				$a++;
				}
			}
		?>
        </ul>
      </div>
		<div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>