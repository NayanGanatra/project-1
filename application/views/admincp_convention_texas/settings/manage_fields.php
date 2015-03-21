<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $title; ?> <small></small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

            <th scope="col"><?php echo $this->lang->line('text_name');?></th>

            <th scope="col">Field For</th>

            <th scope="col">Type</th>

            <th scope="col" width="30"><?php echo $this->lang->line('misc_edit');?></th>

            <th scope="col" width="30"><?php echo $this->lang->line('misc_delete');?></th>

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

        <td><?php echo $row->field_name; ?></td>

        <td><?php echo $row->field_for; ;?></td>

        <td><?php if($row->field_type == 1){ echo 'Text'; }elseif($row->field_type == 2){ echo 'Drop Down'; }elseif($row->field_type == 3){ echo 'Multiple Choice'; } ?></td>

        <td><a href="<?php echo base_url(); ?>admincp/settings/edit_field/<?php echo $row->field_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><?php echo $this->lang->line('misc_edit');?></a></td>

        <td><a href="<?php echo base_url();?>admincp/settings/delete_field/<?php echo $row->field_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></td>

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



</div>

	</td></tr></table>

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>