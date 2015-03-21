<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?>
    
    <?php
		if($this->uri->segment(3) =='')
		{
			?>
            <div class="ch_menu_links">
            <ul>
            <li><b>Chapters :</b></li>
			<li><a href="<?php echo base_url('chapter/national.html'); ?>">National</a></li>
        	<?php $chapters = $this->dbheader->get_all_chapters();
				foreach($chapters as $chapters_row)
				{
					?>
                    <li><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><?php
						echo str_replace("Chapter", "", $chapters_row->ch_name); ?></a></li>
                    <?php
				}
	?>
    	</ul>
    	</div>
    <?php }else{ ?>
    	<div class="sub_title"><?php echo $sub_title;?></div>
		<?php } } ?>

</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
        <div class="page_content">
        <?php $this->load->view('action_status'); ?>
			<?php echo $query->page_content; ?>            	
        </div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php if($chapter){ $this->load->view('chapter_menu'); } else {?>
        <?php $this->load->view('sidebar'); ?>
        <?php }?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>