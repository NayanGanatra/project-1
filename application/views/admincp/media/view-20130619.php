<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Media <small>Manage Media</small></h1>
		</div>
        <hr>
		
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
                        <span><a title="Edit" href="<?php echo base_url('admincp/media/edit/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span> 
                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('admincp/media/delete/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
                        <span class="label label-inverse"><?php echo $row->ch_name;?></span>
                        <?php }else{ ?>
                        <a class="youtube thumbnail" href="<?php echo $row->media_data; ?>" title="<?php echo $row->media_title;?>">
                          <img src="<?php echo base_url('images/media/thumbs/'.$row->media_thumb.'');?>" alt="<?php echo $row->media_title; ?>">
                        </a>
                        <span><a title="Edit" href="<?php echo base_url('admincp/media/edit/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-edit"></i></a></span> 
                        <span><a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('admincp/media/delete/'.$row->media_id.'/'.friendlyURL($row->media_title).'.html');?>"><i class="icon-minus-sign"></i></a></span>
                        <span class="label label-inverse"><?php echo $row->ch_name;?></span>
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

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
<?php $this->load->view('admincp/layout/footer'); ?>