<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
		        <h1>Event member <small>Manage</small></h1>
		</div>
		<div>
			<a href="<?php echo base_url('admincp_convention_texas/event_member/form_export_to_excel/');?>" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" >Export to excel</a>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
        	<th scope="col">Username</th>
        	<th scope="col">LM No</th>
            <th scope="col">Email-id</th>
            <th scope="col">Phone No(H)</th>
            <th scope="col">State</th>
            <th scope="col">Chapter</th>
            <th scope="col"><?php echo "Amount";?></th>
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
		   	$chapter = $this->dbevent_member->get_chapter_from_mm_id($event_amount[0]->mm_id);
		   	if($chapter != "" && $chapter != null ){
		   		$lmno = "L M -".$chapter->mm_life_id;
		   		$chapter_name = $chapter->ch_name;
		   	}
		   	else
		   	{
		   		$lmno = '';
		   		$chapter_name = '';
		   	}
			?>
		    <tr>
		    	<td><?php echo $event_amount[0]->fm_reg_num; ?></td>
		    	<td><?php echo $lmno; ?></td>
		        <td><?php echo $row->email_id;//$member = $this->dbevent_member->get_user_using_id($row->con_mm_id); echo $member->mm_username; ?></td>
                <td><?php echo $event_amount[0]->fm_phoneh; ?></td>
                <td><?php echo $event_amount[0]->state_name; ?></td>
                <td><?php echo $chapter_name; ?></td>
                <td><?php echo $event_amount[0]->event_amount; ?></td>
				<td><?php if($event_amount[0]->payment_type == "by_check") echo "Check"; else echo "Paypal";//$row->payment_type; ?></td>
				<td><?php if($event_amount[0]->payment_status == "0") echo "Unpaid"; else echo "Paid";//$row->payment_type; ?></td>
		        <td>
				<a href="<?php echo base_url('admincp_convention_texas/event_member/edit/'.$row->email_id); ?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('admincp_convention_texas/event_member/delete/'.$row->email_id); ?>" onclick="javascript: return del();" title="Delete"><i class="icon-minus-sign"></i></a></td>
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
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>