<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>News <small>Manage News</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Title</th>
            <th scope="col">Chapter</th>
            <th scope="col">Status</th>
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
    	<td><?php echo $row->news_create; ?></td>
        <td><a class="inline" href="#ads_code_<?php echo $row->news_id; ?>" title="<?php echo $row->news_title; ?>"><?php echo $row->news_title; ?></a></td>
        <td><?php echo $row->ch_name; ?></td>
        <td><?php if($row->news_status == '0'){ echo 'Inactive'; }elseif($row->news_status == '1'){ echo 'Active'; } ?></td>
        <td><a href="<?php echo base_url(); ?>admincp/news/edit/<?php echo $row->news_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><?php echo $this->lang->line('misc_edit');?></a></td>
        <td><a href="<?php echo base_url();?>admincp/news/delete/<?php echo $row->news_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></td>
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