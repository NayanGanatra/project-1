<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>

        <div class="dotted_line">
        	<span class="span8">
		        <h1>Polls <small><?php //echo $num_rec; //$this->dbuser->count_user();?></small></h1>
            </span>
            
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
        	<th scope="col">Questions</th>
            <th scope="col">Types</th>
            <th scope="col">Fields</th>
            <th scope="col">Chapters</th>
			<th scope="col">Status</th>
            <th scope="col">Action<?php //var_dump($query[23][2][0]->ch_id);?></th>
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
		  
		   for($index=0;$index<count($query);$index++)
			{
		   	$chapter_name = "";
			$field_name = "";
			
			if($query[$index][1])
			{
				foreach($query[$index][1] as $field)
				{
					$field_name .= $field->poll_field_name.', ';
				}
				
			}
			
			if($query[$index][2])
			{
				foreach($query[$index][2] as $chapters)
				{
					$get_chapter = $this->dbadminheader->get_chapter($chapters->ch_id);
					$chapter_name .= $get_chapter->ch_name.', ';
					//var_dump($chapters->poll_status);
				}
				
			}
			
			
			
	?>
    <tr>
    	<td><?php echo $query[$index][0][0]->poll_question; ?></td>
        <td><?php echo $query[$index][0][0]->poll_type; ?></td>
        <td><?php echo rtrim($field_name,", "); ?></td>
        <td><?php echo rtrim($chapter_name,", "); ?></td>
		<td><?php echo $query[$index][0][0]->poll_status; ?></td>
        <td><a href="<?php echo base_url('chapteradmincp/polls/edit/'.$query[$index][0][0]->poll_id.'');?>" title="Edit"><i class="icon-edit"></i></a> 
        <a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/polls/delete/'.$query[$index][0][0]->poll_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
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