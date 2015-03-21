<?php $this->load->view('admincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>

        <div class="dotted_line">
        	<span class="span8">
		        <h1><?php echo $title;?> <small>Total Logins : <?php echo $tot_rec; //$this->dbuser->count_user();?></small></h1>
            </span>
            <div class="span5 offset sub_link" align="right">
            	
                
            </span>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Date & Time</th>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col">Phone</th>
            <th scope="col"><?php echo $this->lang->line('text_email');?></th>
            <th scope="col">IP</th>
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
    	<td><?php echo $row->date_time; ?></td>
        <td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>
        <td><?php echo $row->mm_hphone; ?></td>
        <td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>
        <td><?php echo $row->ip; ?></td>
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