<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
		        <h1>Fees structure <small>Manage</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col" width="30">Action</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="6"></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
			$i=0;
		  foreach ($query as $row)
		   {
			?>
		    <tr>
		        <td><?php echo $row->fees_st_title; ?></td>
                <td><?php echo $row->fees_st_created_by; ?></td>
                <td><?php echo $row->fees_st_created_date; ?></td>
                <td><?php echo $row->fees_st_modified_by; ?></td>
                <td><?php echo $row->fees_st_modified_date; ?></td>
		        <td>
				<a href="<?php echo base_url('admincp_convention_texas/fees/edit/'.$row->fees_st_id);?>" title="Edit"><i class="icon-edit"></i></a>
				<!--<a href="<?php //echo base_url('admincp_convention_texas/fees/delete/'.$row->fees_st_id);?>" title="Delete"><i class="icon-minus-sign"></i></a>--></td>
    			</tr>
    
		<?php
		$i++;
   }
}
else
{
	echo "<tr><td colspan='6'>No result found!!!</td></tr>";
}
?>

</table>
	</td></tr></table>
</div>
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>