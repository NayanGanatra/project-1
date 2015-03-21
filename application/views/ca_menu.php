<?php $login = $this->session->userdata('user_email');
if($login){
?>
<div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
            <?php
			
			
			$user = $this->dbheader->user_details($login);
			
			if($user->mm_chapter_id != 0)
			{
				$get_chapter_by_user = $this->dbheader->get_chapter_by_user($user->mm_chapter_id);
			
				if(count($get_chapter_by_user) != 0)
				{
				?>
					<li><a href="<?php echo base_url('admincp/login.html'); ?>" target="_blank">Main Admin panel</a></li>
					<li><a href="<?php echo base_url('chapteradmincp/login/auto_login/'.$login); ?>" target="_blank"><?php echo $get_chapter_by_user->ch_name; ?> Admin panel</a></li>
				<?php 
				}
			}
			?>
			
                   <?php /*?><li <?php if($this->uri->segment(2) == 'users' || $this->uri->segment(2) == 'add_user_family_member' || $this->uri->segment(2) == 'search_users'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/users.html'); ?>"><i class="icon-chevron-left"></i> Manage Members</a></li>
                     <li <?php if($this->uri->segment(2) == 'login_history'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/login_history.html'); ?>"><i class="icon-chevron-left"></i> Member Login History</a></li>
                    <li <?php if($this->uri->segment(2) == 'news' || $this->uri->segment(2) == 'edit_news' || $this->uri->segment(2) == 'add_news'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/news.html'); ?>"><i class="icon-chevron-left"></i> Manage News</a></li>
                   
                    <li <?php if($this->uri->segment(2) == 'events' || $this->uri->segment(2) == 'event_details' || $this->uri->segment(2) == 'edit_event' || $this->uri->segment(2) == 'add_event' || $this->uri->segment(3) == 'event'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/events.html'); ?>"><i class="icon-chevron-left"></i> Manage Events</a></li>
                                        
                    <li <?php if($this->uri->segment(2) == 'media' || $this->uri->segment(2) == 'edit_media' || $this->uri->segment(2) == 'add_media'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/media.html'); ?>"><i class="icon-chevron-left"></i> Manage Media</a></li>
                    
                    <li <?php if($this->uri->segment(2) == 'committee' || $this->uri->segment(2) == 'add_committee' || $this->uri->segment(2) == 'edit_committee'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/committee.html'); ?>"><i class="icon-chevron-left"></i> Committee</a></li>
                    
                    <li <?php if($this->uri->segment(2) == 'pages' || $this->uri->segment(2) == 'add_page' || $this->uri->segment(2) == 'edit_page'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/pages.html'); ?>"><i class="icon-chevron-left"></i> Manage Pages</a></li>
                    
                    <li <?php if($this->uri->segment(2) == 'downloads'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('ca/downloads.html'); ?>"><i class="icon-chevron-left"></i> Download/Resources</a></li><?php */?>
                    
            </ul>
</div>
<?php }?>