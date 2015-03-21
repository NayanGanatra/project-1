<?php $this->load->view('admincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>

        <div class="dotted_line">
		        <h1>Email <small>Manage</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><?php echo $this->lang->line('text_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_subject');?></th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
            <th scope="col">Queued</th>
             <th scope="col" >Mail Status</th>
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
		  
		   foreach ($query as $row)
		   {
			?>
		    <tr>
		        <td><?php echo date("Y-m-d",strtotime($row->created)); ?></td>
		        <td><a href="<?php echo base_url('admincp/email/view/'.$row->uid);?>" target="_blank"><?php echo $row->subject; ?></a></td>
		        <td><?php $tot_sub = $this->dbemail->countemailSubscribers(); echo $tot_sub.'/'.$row->startNum; ?></td>
		        <td><?php if($row->queued == 1){ echo 'Yes';}else{echo 'No';} ?></td>
                 <td >
				<?php 
                if($row->queued == "1") 
                {
                    if($row->email_send  == "1")
                    {?>
                    <a  href="#" title="send">Sent</a>
                    <?php }
                    else
                    {
                    ?>
                        <a href="<?php echo base_url(); ?>admincp/email/sending_template_mail/<?php echo $row->uid.'-'.$row->template_id; ?>" title="send"><b>Send</b></a>
                    <?php
                    }
                }
                else 
                {?>
                   <a style="display:none;" href="#" title="send"></a>
                <?php
                }
                ?>
                </td>
		        <td><a href="<?php echo base_url('admincp/email/edit/'.$row->uid.'');?>" title="Edit"><i class="icon-edit"></i></a> 
		        <a onclick="javascript: return del();" href="<?php echo base_url('admincp/email/delete/'.$row->uid.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    </tr>
    
		<?php
   }
}
else
{
	echo "<tr><td colspan='6'>No result found!!!</td></tr>";
}
?>
</table>

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
</div>
<?php $this->load->view('admincp/layout/footer'); ?>