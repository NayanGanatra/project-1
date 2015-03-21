<?php $this->load->view('admincp/layout/header'); ?>
<div class="height10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_categories');?> <small><?php echo $this->lang->line('text_manage_categories');?></small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
        	<th scope="col" width="10">#</th>
            <th scope="col"><?php echo $this->lang->line('text_category_name');?></th>
            <th scope="col"><?php echo $this->lang->line('text_slug');?></th>
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
    <tr>
    	<td><?php echo $row->covers_cat_order_by; ?></td>
        <td><?php echo $row->covers_cat_name; ?></td>
        <td><?php echo $row->covers_cat_seo; ?></td> 
        <td><a href="<?php echo base_url(); ?>admincp/categories/edit/<?php echo $row->covers_cat_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><?php echo $this->lang->line('misc_edit');?></a></td>
        <td><a href="<?php echo base_url();?>admincp/categories/delete/<?php echo $row->covers_cat_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></td>
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

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
<?php $this->load->view('admincp/layout/footer'); ?>