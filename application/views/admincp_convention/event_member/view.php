<?php $this->load->view('admincp_convention/layout/header'); ?>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
		        <h1>Event member <small>Manage</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Username</th>
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
		        <td><?php $member = $this->dbevent_member->get_user_using_id($row->con_mm_id); echo $member->mm_username; ?></td>
                <td><?php echo $row->ce_mem_created_by; ?></td>
                <td><?php echo $row->ce_mem_created_date; ?></td>
                <td><?php echo $row->ce_mem_modified_by; ?></td>
                <td><?php echo $row->ce_mem_modified_date; ?></td>
		        <td>
				<a href="<?php echo base_url('admincp_convention/event_member/edit/'.$row->ce_mem_id); ?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('admincp_convention/event_member/delete/'.$row->ce_mem_id); ?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
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
<?php echo $this->pagination->create_links(); ?>
	</td></tr></table>
</div>
<?php $this->load->view('admincp_convention/layout/footer'); ?>