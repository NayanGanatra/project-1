<div class="bs-docs-sidebar">

    <ul class="nav nav-list bs-docs-sidenav">

    	<?php

			$menu = $this->dbheader->get_info_menu();

			foreach($menu as $menu_row)

			  {

		?>

        	<li <?php if($this->uri->segment(2) == $menu_row->page_seo){ ?>class="active"<?php } ?>><a href="<?php echo base_url('info/'.$menu_row->page_seo.''); ?>"><i class="icon-chevron-left"></i> <?php echo $menu_row->page_menu_name; ?></a></li>

        <?php } ?>



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
}
*/?>