<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo 'Convention'; ?> <small><?php echo 'Manage Convention';?></small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
        	
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col">Link</th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
            <th scope="col"><?php echo $this->lang->line('text_from');?></th>
            <th scope="col"><?php echo $this->lang->line('text_to');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="10"></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
		  
		   foreach ($query as $row)
		   {
	?>
    <tr <?php if($row->con_status == "1") { echo "class=''"; }else{ echo "class='error'"; } ;?>>
        <td><?php echo $row->con_name; ?>
        	
        </td>
        <td><?php echo base_url().$row->con_year; ?>/<?php echo $row->con_link; ?></td>
        <td><?php if($row->con_status == "1") { ?> <img src="<?php echo base_url(); ?>images/approve_icon.gif"><?php }else{ ?><img src="<?php echo base_url(); ?>images/disapprove_icon.gif"><?php } ?></td>
        
        
        <td><?php echo $row->con_start_date; ?></td>
        <td><?php echo $row->con_end_date; ?></td>
        <td><?php echo $row->con_created_by; ?></td>
        <td><?php echo $row->con_created_date; ?></td>
        <td><?php echo $row->con_modified_by; ?></td>
        <td><?php echo $row->con_modified_date; ?></td>
        <td>
        <a href="<?php echo base_url(); ?>admincp/convention/edit/<?php echo $row->con_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp/convention/delete/<?php echo $row->con_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>
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
<style>
#cboxCurrent
{
	bottom:-22px !important;	
}
</style>