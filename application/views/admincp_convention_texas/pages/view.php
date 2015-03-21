<?php $this->load->view('admincp_convention_texas/layout/header'); ?>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $this->lang->line('text_static_pages');?> <small><?php echo $this->lang->line('text_manage_pages');?></small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
        	<th scope="col" width="20">#</th>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_type');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col">Action</th>
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
    <tr>
        <td><?php echo $row->page_order; ?></td>
        <td><?php echo $row->page_title; ?></td>
        <td><?php echo $row->page_created_by; ?></td>
        <td><?php echo $row->page_created_date; ?></td>
        <td><?php echo $row->type; ?></td>
        <td><?php echo $row->page_modified_by; ?></td>
        <td><?php echo $row->page_modified_date; ?></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention_texas/pages/edit/<?php echo $row->page_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp_convention_texas/pages/delete/<?php echo $row->page_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td>
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
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>