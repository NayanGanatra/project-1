<?php $this->load->view('admincp/layout/header'); ?>
<div class="height10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <div class="span12"><h1><?php echo $title; ?> <small></small></h1></div>
                <div class="span2" align="right"><a href="<?php echo base_url(); ?>admincp/settings/add_occupation">Add New</a></div>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col" width="30">Action</th>
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
		  
		   foreach ($query->result() as $row)
		   {
	?>
    <tr>
        <td><a href="<?php echo base_url(); ?>admincp/settings/edit_occupation/<?php echo $row->occupation_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><?php echo $row->occupation_name; ?></a></td>
        <td>
        <a href="<?php echo base_url(); ?>admincp/settings/edit_occupation/<?php echo $row->occupation_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp/settings/delete_occupation/<?php echo $row->occupation_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>
    </tr>
    
		<?php
   }
}
else
{
	echo "<tr><td colspan='5'>No result found!!!</td></tr>";
}
?>
</table>

</div>
	</td></tr></table>
<?php $this->load->view('admincp/layout/footer'); ?>