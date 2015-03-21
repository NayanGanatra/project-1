<?php $this->load->view('admincp/layout/header'); ?>

<div class="space40px"></div>
<div class="row">
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    <?php
	$form_attributes = array('id' => 'covers','name' => 'covers', 'onsubmit' => 'javascript: goforsearch();');
	echo form_open('', $form_attributes);
	?>
    	<div class="dotted_line">
		        <h1>Slider <small>Homepage Slider</small></h1>
                <hr>
		</div>
            
            <div class="row-fluid">
            	<ul class="thumbnails">
                <?php
				if ($query)
					{
					   $i = 0;
					   foreach ($query as $row)
					   {
						   if ($i%4==0)
	   						{
								$span_margin = "style='margin-left: 0;'";
							}
							else
							{
								$span_margin = '';
							}
				?>
                	<li class="span3" <?php echo $span_margin; ?> >
                    	<div class="thumbnail">
                        	<a rel="gallery" title="<?php echo $row->title; ?>" class="gallery" href="<?php echo base_url();?>images/slider/<?php echo $row->image; ?>" >
                            <div style="height:107px;"><img src="<?php echo base_url();?>images/slider/<?php echo $row->image; ?>" width="230" border="0" /></div>
                            </a>
                                <div class="caption">
                               
                                <div class="btn-group" align="center">
                               
                               	<a  class="btn" href="<?php echo base_url();?>admincp/settings/edit_slider/<?php echo $row->id; ?>" title='<?php echo $this->lang->line('misc_edit');?>'><?php echo $this->lang->line('misc_edit');?></a>
                                <a onclick="javascript: return del();" class="btn btn-danger" href="<?php echo base_url();?>admincp/settings/delete_slider/<?php echo $row->id; ?>" title='<?php echo $this->lang->line('misc_delete');?>'><?php echo $this->lang->line('misc_delete');?></a> 
                                
                               </div>
                              
                              </div>
                              
                              
                        </div>
                    </li>
                <?php
					$i++;
					   }
					}
				?>
                </ul>
            </div>


<div style="clear:both;">
<?php echo $this->pagination->create_links(); ?>
</div>
</form>

	</td></tr></table>
</div>
<?php $this->load->view('admincp/layout/footer'); ?>