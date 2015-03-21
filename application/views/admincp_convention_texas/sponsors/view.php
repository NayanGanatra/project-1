<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Sponsors  <small>  Manage Sponsors</small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col"></th>

            <th scope="col"><?php echo $this->lang->line('text_name');?></th>

            <th scope="col"><?php echo $this->lang->line('text_status');?></th>

            <th scope="col"><?php echo $this->lang->line('text_size');?></th>

            <!--<th scope="col">Chapter</th>-->
             <th scope="col">Category</th>

            <th scope="col"><?php echo 'Sidebar';?></th>
            <th scope="col"><?php echo $this->lang->line('text_from');?></th>
            
            

            <th scope="col"><?php echo $this->lang->line('text_to');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col">Action</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan=""></td>

        </tr>

    </tfoot>

    <?php

		if ($query)

		{

		  

		   foreach ($query as $row)

		   {

	?>

    <tr <?php if($row->cs_status == "1") { echo "class=''"; }else{ echo "class='error'"; } ;?>>

        <td>
        <?php if($row->cs_code!='')
		{?>
        <a rel="gallery" class="gallery" href="<?php echo base_url('images/convention/sponsors/'.$row->cs_code); ?>" title="<?php echo $row->cs_title; ?>"><img src="<?php echo base_url('images/convention/sponsors/'.$row->cs_code); ?>"  style="width:30px;height:30px;"/></a><?php }else
		?> </td><td><?php echo $row->cs_title; ?>
        
		</td>
        <td><?php if($row->cs_status == "1") { ?> <img src="<?php echo base_url(); ?>images/approve_icon.gif"><?php }else{ ?><img src="<?php echo base_url(); ?>images/disapprove_icon.gif"><?php } ?></td>

        <td><?php echo $row->cs_type; ?></td>

        <?php

                

					
					
				   /* $chapter = $this->dbsponsors->get_chapter($row->cs_ch_id);

					

					$chaptername='';

                    foreach($chapter as $chapter_row)

                    {
                        
							$chaptername .=$chapter_row->ch_name.','.' ';			

					}*/
                ?>

                

    	<!--<td><div style="width:200px;"><?php //echo $rest = substr($chaptername, 0,-2);?></div></td>-->

         <td><?php   
		 			 if($row->cs_category == "3") 
		             { 
					 echo '<span class="label label-important">Grand</span>';
		             }
					 else if($row->cs_category == "2") 
		             { 
					 echo '<span class="label label-warning">Gold</span>';
		             }
					 else if($row->cs_category == "1")
					 { 
					 echo '<span class="label">Silver</span>';
					 } 
					 else 
					 {
					 echo '<span class="label label-inverse">General</span>';
					 
					 }
			  ?></td>
		<td><?php if($row->cs_sidebar==1) { echo 'Yes' ;} else { echo 'No';} ?></td>
        
        <td><?php echo $row->cs_start_date; ?></td>

        <td><?php echo $row->cs_end_date; ?></td>

        <td><?php echo $row->cs_created_by; ?></td>

        <td><?php echo $row->cs_created_date; ?></td>

        <td><?php echo $row->cs_modified_by; ?></td>

        <td><?php echo $row->cs_modified_date; ?></td>

        <td>

        <a href="<?php echo base_url(); ?>admincp_convention_texas/sponsors/edit/<?php echo $row->cs_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>admincp_convention_texas/sponsors/delete/<?php echo $row->cs_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>

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

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>

<style>

#cboxCurrent

{

	bottom:-22px !important;	

}

</style>