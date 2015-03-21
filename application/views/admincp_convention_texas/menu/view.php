<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	
              
              <div class="dotted_line">

        	<span class="span8">

		         <h1>Menu <small>Manage Menu</small></h1>

            </span>

            <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention_texas/program/view', $form_attributes);

				?>

			</span>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col">Menu Title</th>

            <th scope="col">Submenu Title(Order)</th>

            <th scope="col">Menu Order</th>
            
            <th scope="col">Menu Status</th>
            
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col">Action</th>

        </tr>

    </thead>

   <tfoot>

    	<tr>

        	<td colspan="9"></td>

        </tr>

    </tfoot>
    
    <?php
		
		if ($query)

		{

		  foreach ($query as $row)

		   {

	?>

    <tr >

        <td>
			<?php echo $row->menu_name; ?>
        	

        </td>
        
		<?php
				
				$submenu='';
				
				$menu_to_submenu = $this->dbmenu->menu_to_submenu($row->menu_id);
				
				foreach($menu_to_submenu as $allsubmenu)
				{
					$submenu .=$allsubmenu->sub_menu_name.'('.$allsubmenu->sub_menu_order.') '.' ';
					
				}
					
				
		
		?>
        <td><div style="width:80px;"><?php echo $rest = substr($submenu, 0,-2);?></div></td>
        
        <td>
        	<?php echo $row->menu_order; ?>
        </td>
        
        <td>
        	<?php if($row->menu_status == '1')
				  {?>
            	<img src="<?php echo base_url(); ?>images/approve_icon.gif">
            <?php }else { ?>
            	<img src="<?php echo base_url(); ?>images/disapprove_icon.gif">
				<?php } ?>
        </td>

       <td><?php echo $row->menu_created_by; ?></td>

        <td><?php echo $row->menu_created_date; ?></td>

        <td><?php echo $row->menu_modified_by; ?></td>

        <td><?php echo $row->menu_modified_date; ?></td>

        <td>

        <a href="<?php echo base_url(); ?>admincp_convention_texas/menu/edit/<?php echo $row->menu_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>admincp_convention_texas/menu/delete/<?php echo $row->menu_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>

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
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>

