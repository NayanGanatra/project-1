<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_media.html'); ?>">Add Media</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        <ul class="thumbnails">
        <?php
			if($query)
			{
				foreach($query as $row)
				{
					?>
                    	<li class="span2">
                        <?php if($row->media_type == 0){ ?>
                        <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->media_title; ?>" href="<?php echo base_url('images/media/big/'.$row->media_data); ?>">
                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">
                        </a>
                        <span><a title="Edit" href="<?php echo base_url('ca/edit_media/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span> 
                        <span><a title="Delete" href="<?php echo base_url('ca/delete_media/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
                        <?php }else{ ?>
                        <a class="youtube thumbnail" href="<?php echo $row->media_data; ?>" title="<?php echo $row->media_title;?>">
                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">
                        </a>
                        <span><a title="Edit" href="<?php echo base_url('ca/edit_media/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span> 
                        <span><a title="Delete" href="<?php echo base_url('ca/delete_media/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
                        <?php } ?>
                    	</li>
                    <?php
				}
			}
			else
			{
				echo '<li>No media found.</li>';
			}
		?>
        </ul>
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