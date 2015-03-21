<?php $this->load->view('admincp_convention/layout/header'); ?>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Form <small>Manage Form</small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col" width="20">#</th>
            <th scope="col">Name</th>
            <th scope="col">Chapter</th>
            <th scope="col">Email </th>
            
            
			<th scope="col">Action</th>

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
			$i=0;
			foreach ($query as $row)
		    {
			   	$i++;
				$chapter = $this->dbform->get_chapter_from_mm_id(12363);
	?>

    <tr>
		<td><?php echo $i; ?></td>
        <td><?php echo $chapter->mm_username; ?></td>

        <td><?php echo $chapter->ch_name; ?></td>
        <td><?php echo $chapter->mm_email; ?></td>

        

        <td><a href="<?php echo base_url(); ?>admincp_convention/form/edit/<?php echo $row->mm_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>admincp_convention/form/delete/<?php echo $row->mm_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td>

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

<?php $this->load->view('admincp_convention/layout/footer'); ?>