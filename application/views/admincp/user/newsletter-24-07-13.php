<?php error_reporting(0);		
 $this->load->view('admincp/layout/header'); 
?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>

        <div class="dotted_line">
		        <h1>Newsletter <small>Manage</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
             <th scope="col">Date</th>
            <th scope="col">Title</th>
            <th scope="col">Chapter</th>
            <th scope="col">Status</th>
            <th scope="col">Queued</th>
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
        <td><a href="<?php echo base_url('admincp/user/view_newsletter/'.$row->uid);?>" target="_blank"><?php echo $row->subject; ?></a></td>
        
        	<?php
               
					$chapter = $this->dbadminheader->get_chapters();
				
					$chaptername='';
                    foreach($chapter as $chapter_row)
                    {
						
						$ch_to_newsletters = $this->dbadminheader->ch_to_newsletters($row->uid,$chapter_row->ch_id); 
					
						if($ch_to_newsletters)
						{
							
							$chaptername .=$chapter_row->ch_name.',';
							
						}
						
					}
                ?>
    	<td style="width:30%"><?php echo $rest = substr($chaptername, 0,-1);?></td>

        
       <td><?php if($row->newsletter_status == '0'){ echo 'Inactive'; }elseif($row->newsletter_status == '1'){ echo 'Active'; } ?></td>
        <td><?php if($row->queued == 1){ echo 'Yes';}else{echo 'No';} ?></td>
        <td><a href="<?php echo base_url('admincp/user/edit_newsletter/'.$row->uid.'');?>" title="Edit"><i class="icon-edit"></i></a> 
        <a onclick="javascript: return del();" href="<?php echo base_url('admincp/user/delete_newsletter/'.$row->uid.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
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