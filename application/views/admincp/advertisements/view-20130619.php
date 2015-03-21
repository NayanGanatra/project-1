<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_advertisement');?> <small><?php echo $this->lang->line('text_manage_advertisement');?></small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
            <th scope="col"><?php echo $this->lang->line('text_size');?></th>
            <th scope="col" width="30"><?php echo $this->lang->line('misc_edit');?></th>
            <th scope="col" width="30"><?php echo $this->lang->line('misc_delete');?></th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="7"></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
		  
		   foreach ($query as $row)
		   {
	?>
    <tr <?php if($row->ads_status == "1") { echo "class=''"; }else{ echo "class='error'"; } ;?>>
        <td><a rel="gallery" class="gallery" href="<?php echo base_url('images/ads/'.$row->ads_code); ?>" title="<?php echo $row->ads_title; ?>"><?php echo $row->ads_title; ?></a>
        	
        </td>
        <td><?php if($row->ads_status == "1") { echo $this->lang->line('misc_active'); }else{ echo $this->lang->line('misc_deactive'); } ;?></td>
        <td><?php echo $row->ads_type; ?></td>
        <td><a href="<?php echo base_url(); ?>admincp/advertisements/edit/<?php echo $row->ads_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><?php echo $this->lang->line('misc_edit');?></a></td>
        <td><a href="<?php echo base_url();?>admincp/advertisements/delete/<?php echo $row->ads_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></td>
    </tr>
    
		<?php
   }
}
else
{
	echo "<tr><td colspan='5'>".$this->lang->line('text_no_result')."</td></tr>";
}
?>
</table>

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
<?php $this->load->view('admincp/layout/footer'); ?>