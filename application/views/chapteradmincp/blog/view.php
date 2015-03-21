<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
		        <h1>Blog <small>Manage</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
			<th scope="col">Confirmed</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col" width="30">Action</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="8"></td>
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
		        <td><?php echo $row->title; ?></td>
                <td><?php if($row->status==1) { echo 'Active';} else { echo 'Inactive';} ?></td>
				<td style="text-align: center;"><?php if($row->verify==1) { ?><img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" /><?php } else { ?><img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><?php } ?></td>
				<td><?php echo $row->blog_created_by; ?></td>
                <td><?php echo $row->blog_created_date; ?></td>
                <td><?php echo $row->blog_modified_by; ?></td>
                <td><?php echo $row->blog_modified_date; ?></td>
		        <td>
				<a href="<?php echo base_url('chapteradmincp/blog/edit/'.$row->bid);?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('chapteradmincp/blog/delete/'.$row->bid);?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    			</tr>
    
		<?php
		$i++;
   }
}
else
{
	echo "<tr><td colspan='8'>No result found!!!</td></tr>";
}
?>

</table>
<?php echo $this->pagination->create_links(); ?>

	</td></tr></table>
</div>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>