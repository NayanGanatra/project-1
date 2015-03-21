<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
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
            <th scope="col">Email-id</th>
            <!--<th scope="col"><?php echo "Age Group";//$this->lang->line('age group');?></th>
            <th scope="col"><?php echo "Event Name";//$this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo "Number Of Participants";//$this->lang->line('text_modified_by');?></th>-->
            <th scope="col"><?php echo "Amount";//$this->lang->line('text_modified_date');?></th>
			<th scope="col"><?php echo "Payment Type"?></th>
			<th scope="col"><?php echo "Paid/Unpaid"?></th>
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
		   	$event_amount = $this->dbevent_member->get_event_amount($row->email_id);
			?>
		    <tr>
		        <td><?php echo $row->email_id;//$member = $this->dbevent_member->get_user_using_id($row->con_mm_id); echo $member->mm_username; ?></td>
                <!--<td><?php echo "";//$row->age_group; ?></td>
                <td><?php echo "";//$row->event_id; ?></td>
                <td><?php echo "";//$row->number_of_participant; ?></td>-->
                <td><?php echo $event_amount[0]->event_amount; ?></td>
				<td><?php if($event_amount[0]->payment_type == "by_check") echo "Check"; else echo "Paypal";//$row->payment_type; ?></td>
				<td><?php if($event_amount[0]->payment_status == "0") echo "Unpaid"; else echo "Paid";//$row->payment_type; ?></td>
		        <td>
				<a href="<?php echo base_url('admincp_convention_texas/event_member/edit/'.$row->email_id); ?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('admincp_convention_texas/event_member/delete/'.$row->email_id); ?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    			</tr>
    
		<?php
		$i++;
   }
}
else
{
	echo "<tr><td colspan='8' align='center'>No result found!!!</td></tr>";
}
?>

</table>
<?php echo $this->pagination->create_links(); ?>
	</td></tr></table>
</div>
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>