<div class="bs-docs-sidebar">

            <ul class="nav nav-list bs-docs-sidenav">

            

            <?php if($this->uri->segment(2) != 'national' || $this->uri->segment(1) == 'events'){ ?>

            

                    <li <?php if($this->uri->segment(1) == 'chapter'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('chapter/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $chapter->ch_name; ?></a></li>

                    

                    <li <?php if($this->uri->segment(1) == 'news'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('news/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> News</a></li>

                    

                    <li <?php if($this->uri->segment(1) == 'events'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('events/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> Events</a></li>

                    

                    <li <?php if($this->uri->segment(1) == 'media'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('media/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> Media Gallery</a></li>

                    

                    <li <?php if($this->uri->segment(1) == 'committee'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('committee/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> Committee</a></li>
                   

                    

                    <li <?php if($this->uri->segment(1) == 'downloads'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('downloads/'.$chapter->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> Downloads</a></li>

            <?php }else { ?>

            

            	<li <?php if($this->uri->segment(2) == 'national'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('committee/national.html'); ?>"><i class="icon-chevron-left"></i> National Committee</a></li>

				<?php $chapters = $this->dbheader->get_all_chapters();

					foreach($chapters as $chapters_row)

					{
						

						if($this->uri->segment(1) == 'chapter'){

						?>

                        <li <?php if($this->uri->segment(2) == $chapters_row->ch_seo){ ?>class="active"<?php } ?>><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $chapters_row->ch_name;?></a></li>

                        <?php

						}

						elseif($this->uri->segment(1) == 'committee' || $this->uri->segment(2) == 'national'){
 
						?>

                        <li <?php if($this->uri->segment(2) == $chapters_row->ch_seo){ ?>class="active"<?php } ?>><a href="<?php echo base_url('committee/'.$chapters_row->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $chapters_row->ch_name;?></a></li>

                        <?php

						}

					}

				?>            

            <?php } ?>

            </ul>

</div>


<?php
/*
$login = $this->session->userdata('user_email');
if($login)
{*/?>
<?php 
if($this->uri->segment(1) != 'committee'){?>
<div class="bs-docs-sidebar">
    <ul class="nav nav-list bs-docs-sidenav">
    	<?php
		
			/*$ch_id = $this->session->userdata('mm_chapter_id');
			if($ch_id!=0)
			{*/
			
				$menu = $this->dbheader->get_info_ch_menu1($chapter->ch_id);
				$chapter = $this->dbheader->get_chapter_by_user($chapter->ch_id);
				foreach($menu as $menu_row)
				{
					
				?>
				<li  <?php if($this->uri->segment(3) == $menu_row->page_seo){ ?>class="active"<?php } ?>><a  href="<?php echo base_url('info/'.$chapter->ch_seo.'/'.$menu_row->page_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $menu_row->page_menu_name; ?></a></li>
			<?php 
				}
			//}?>
    </ul>
</div>
<?php
}?>
