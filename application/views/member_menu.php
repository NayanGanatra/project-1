<div class="bs-docs-sidebar">

            <ul class="nav nav-list bs-docs-sidenav">

            <?php $login = $this->session->userdata('user_email'); ?>

                    <li <?php if($this->uri->segment(2) == 'account'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/account.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_my_account');?></a></li>

                    

                    <li <?php if($this->uri->segment(2) == 'invitation' || $this->uri->segment(2) == 'invitation_details'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/invitation.html'); ?>"><i class="icon-chevron-left"></i> Invitation</a></li>

                    

                     <!-- pradip changes for newsletter-->

                    <li <?php if($this->uri->segment(2) == 'newsletter'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/newsletter.html'); ?>"><i class="icon-chevron-left"></i> Manage Newsletter</a></li>

                   <!-- end-->
                    <!--added by ketan 20130806-->
					<li <?php if($this->uri->segment(2) == 'manage_blog'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('forum/manage_forum'); ?>"><i class="icon-chevron-left"></i> Manage Forum</a></li>
					<!--update end-->

                    

                    <?php if($login) { ?>

                    <li <?php if($this->uri->segment(2) == 'edit_profile'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/edit_profile.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_edit_profile');?></a></li>

                    <?php }?>

                    

                    <?php

					if($user->mm_family_id == 0 && $login !='')

					{

						?>

                        <li <?php if($this->uri->segment(2) == 'add_family_member'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/add_family_member/'.$user->mm_id); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('text_family_members');?></a></li>

                        <?php

					}

					?>                 

              <?php if($login) { ?>

                	<li <?php if($this->uri->segment(2) == 'logout'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/logout.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_logout');?></a></li>

             	<?php }?>

            </ul>

</div>
<?php
/*
$login = $this->session->userdata('user_email');
if($login)
{?>
<div class="bs-docs-sidebar">
    <ul class="nav nav-list bs-docs-sidenav">
    	<?php
		
			$ch_id = $this->session->userdata('mm_chapter_id');
			if($ch_id!=0)
			{
				$menu = $this->dbheader->get_info_ch_menu($ch_id);
				$chapter = $this->dbheader->get_chapter_by_user($ch_id);
				foreach($menu as $menu_row)
				{
				?>
				<li><a href="<?php echo base_url('info/'.$chapter->ch_seo.'/'.$menu_row->page_seo.'.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $menu_row->page_menu_name; ?></a></li>
			<?php 
				}
			}?>
    </ul>
</div>
<?php
}*/?>
