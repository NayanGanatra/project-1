<div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                    
                    <li <?php if($this->uri->segment(2) == ''){ ?>class="active"<?php } ?>><a href="<?php echo base_url('news.html'); ?>"><i class="icon-chevron-left"></i> National Events</a></li>
                    <?php
					$get_all_chapters = $this->dbheader->get_all_chapters();
					
					foreach($get_all_chapters as $get_all_chapters_row)
					{
						?>
                        <li <?php if($this->uri->segment(2) == $get_all_chapters_row->ch_seo){ ?>class="active"<?php } ?>><a href="<?php echo base_url('events/'.$get_all_chapters_row->ch_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $get_all_chapters_row->ch_name; ?> Events</a></li>
                        <?php
					}
					?>
                    
                    
            </ul>
</div>