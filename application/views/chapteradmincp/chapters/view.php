<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="height10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Chapters <small>Manage Chapters</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Chapter Name</th>
            <th scope="col">States</th>
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
        <td><a href="<?php echo base_url(); ?>chapteradmincp/chapters/show/<?php echo $row->ch_id; ?>" title="<?php echo $this->lang->line('misc_show');?>" ><?php echo $row->ch_name; ?></a></td>
        <td>
			<?php 
				$chapters_states = $this->dbchapters->get_chapters_states($row->ch_id);
				$i=1;
				foreach($chapters_states as $chapters_states_row)
				{
					echo $chapters_states_row->state_name;
					if($i != count($chapters_states))
					{
						echo ', ';
					}
					
				$i++;
				}
			 ?>
        </td> 
        <td>
        <a href="<?php echo base_url(); ?>chapteradmincp/chapters/show/<?php echo $row->ch_id; ?>" title="<?php echo $this->lang->line('misc_show');?>" ><i class="icon-edit"></i></a>
       <!-- <a href="<?php //echo base_url();?>chapteradmincp/chapters/delete/<?php //echo $row->ch_id; ?>" title='<?php //echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a>--></td>
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
<?php $this->load->view('chapteradmincp/layout/footer'); ?>