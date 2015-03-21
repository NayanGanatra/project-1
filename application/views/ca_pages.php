<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_page.html'); ?>">Add Page</a>
    </div>
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
				foreach($query as $row)
				{
					?>
                    	<h3><?php echo $row->page_title; ?></h3>
                        <div class="space10px"></div>
                        <p class="small">
                        <a href="<?php echo base_url('info/'.$chapter->ch_seo.'/'.$row->page_seo.'.html'); ?>">Read More</a> | 
                        
                        <a href="<?php echo base_url('ca/edit_page/'.$row->page_id.'/'.friendlyURL($row->page_title).'.html'); ?>">Edit</a> | 
                        <a onclick="javascript: return del();" href="<?php echo base_url('ca/delete_page/'.$row->page_id.'/'.friendlyURL($row->page_title).'.html'); ?>">Delete</a></p>
                    <?php
				}
			}
			else
			{
				echo 'No pages found.';
			}
		?>
        
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>