<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Events <small>Manage Events</small></h1>
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
    	<td><?php echo $row->event_date_time; ?></td>
        <td><a class="inline" href="#ads_code_<?php echo $row->event_id; ?>" title="<?php echo $row->event_name; ?>"><?php echo $row->event_name; ?></a></td>
        <td><?php echo $row->ch_name; ?></td>
        <td><?php if($row->event_status == '0'){ echo 'Inactive'; }elseif($row->event_status == '1'){ echo 'Upcoming'; }elseif($row->event_status == '2'){ echo 'Archived'; } ?></td>
        <td><a href="<?php echo base_url(); ?>admincp/events/edit/<?php echo $row->event_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><?php echo $this->lang->line('misc_edit');?></a></td>
        <td><a href="<?php echo base_url();?>admincp/events/delete/<?php echo $row->event_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></td>
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