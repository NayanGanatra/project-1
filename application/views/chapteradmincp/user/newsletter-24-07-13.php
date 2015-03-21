<?php error_reporting(0);		
$this->load->view('chapteradmincp/layout/header'); 
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
            <th scope="col"><?php echo $this->lang->line('text_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_title');?></th>
             <th scope="col">Chapter</th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
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
        <td><a href="<?php echo base_url('chapteradmincp/user/view_newsletter/'.$row->uid);?>" target="_blank"><?php echo $row->subject; ?></a></td>
        
          
         <td ><?php $chapter = $this->dbadminheader->get_chapter($this->session->userdata('get_chapter_id')); if($chapter){echo $chapter->ch_name;}?></td>
        
         <td><?php if($row->newsletter_status == '0'){ echo 'Inactive'; }elseif($row->newsletter_status == '1'){ echo 'Active'; } ?></td>
        <td><?php if($row->queued == 1){ echo 'Yes';}else{echo 'No';} ?></td>
		<?php
				$num_rec = $this->dbadminheader->count_chapter_for_newslatter($row->uid);
		?>
        <td><a href="<?php echo base_url('chapteradmincp/user/edit_newsletter/'.$row->uid.'');?>" title="Edit"><?php if(count($num_rec)>1) {  } else {?><i class="icon-edit"></i><?php } ?></a> 
        <a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete_newsletter/'.$row->uid.'');?>" title="Delete"><?php if(count($num_rec)>1) {  } else {?><i class="icon-minus-sign"></i><?php } ?></a></td>
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
<?php $this->load->view('chapteradmincp/layout/footer'); ?>