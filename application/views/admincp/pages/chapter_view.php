<?php $this->load->view('admincp/layout/header'); ?>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Chapter <small><?php echo $this->lang->line('text_manage_pages');?></small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col" width="20">#</th>

            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
             <th scope="col" >Chapter</th>

            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

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

		  

		   foreach ($query as $row)

		   {

	?>

    <tr>

        <td><?php echo $row->page_order; ?></td>

        <td><?php echo $row->page_menu_name; ?></td>
        <?php

				$chapter = $this->dbadminheader->get_chapters();

					$chaptername='';

                    foreach($chapter as $chapter_row)

                    {

						$ch_to_pages = $this->dbadminheader->ch_to_pages($row->page_id,$chapter_row->ch_id); 

						

						if($ch_to_pages)

						{

							

							$chaptername .=$chapter_row->ch_name.', ';

						}

						

					}

				?>

                <td><div style="width:200px;"><?php echo $rest = substr($chaptername, 0,-2);?></div></td>

        <td><?php echo $row->page_created_by; ?></td>

        <td><?php echo $row->page_created_date; ?></td>

        <td><?php echo $row->page_modified_by; ?></td>

        <td><?php echo $row->page_modified_date; ?></td>

        

        <td><a href="<?php echo base_url(); ?>admincp/pages/edit_chapter/<?php echo $row->page_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>admincp/pages/delete_chapter/<?php echo $row->page_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td>

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