<?php $this->load->view('admincp_convention/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	
              
              <div class="dotted_line">

        	<span class="span8">

		         <h1>Program <small><?php echo $tot_rec; //$this->dbuser->count_user();?></small></h1>

            </span>

            <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention/program/view', $form_attributes);

				?>

				<div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">

					<div class="controls">

						<?php /*?><span class="span4">


                        <select name="mm_type" class="input-large" style="margin:0;">

                        <option value="0" <?php  ?> >All members</option>

                        </select>

                        </span><?php */?>

                        <span class="span4">

                        <input style="margin-top:10px;" class="input-xlarge" type="text" id="search" name="search" placeholder="Search by type, created by or participant name" value="<?php echo $this->session->userdata('search'); ?>">

                        </span>

                        <span class="span2">

                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

                        </span>

					</div>
                    <div >
                    		

                        <a href="<?php echo base_url('admincp_convention/program/program_export_to_excel/');?>" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" >Export to excel</a>

                        

                      
                    </div>

				</div>

                

            </span>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col">Type</th>

            <th scope="col">Member Name</th>

            <th scope="col">Participant Name(age)</th>

          <!--  <th scope="col">Choreographer Name</th>
            
            <th scope="col">Choreographer Email</th>
            
            <th scope="col">Choreographer Phone</th>-->
            
            <th scope="col">Confirmed</th>

            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col">Action</th>

        </tr>

    </thead>

   <tfoot>

    	<tr>

        	<td colspan="13"></td>

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
			<?php echo $row->pm_type; ?>
        	

        </td>
         <td>
			<?php $member_name = $this->dbprogram->get_member_name($row->pm_mm_id); 
			
			foreach($member_name as $member) 
			{
					echo $member->mm_fname.' '.$member->mm_lname;
			}?>
			
        	

        </td>
        
        <?php
				$participant='';
				
				$pm_to_participant = $this->dbprogram->pm_to_participant($row->pm_id);
				
				foreach($pm_to_participant as $allparticipant)
				{
					$participant .=$allparticipant->pm_member_name.'('.$allparticipant->pm_age.'),'.' ';
					
				}
		
		?>
        <td><div style="width:200px;"><?php echo $rest = substr($participant, 0,-2);?></div></td>
        
       <?php /*?> <td>
        	<?php echo $row->pm_choreo_name; ?>
        </td>
        
        <td>
        	<?php echo $row->pm_choreo_email; ?>
        </td>

       <td>
       		<?php echo $row->pm_choreo_phone; ?>
       </td><?php */?>

         <td>

        <?php if($row->pm_confirmed=="1")

		{?>

        <a href="<?php echo base_url('admincp_convention/program/status/'.$row->pm_id.'');?>" title="status">
        <span class="label label-important" title="Press Here to UnConfirm" >Confirm</span>

        </a>

        <?php }

		else

		{?> 

        <a  href="<?php echo base_url('admincp_convention/program/status/'.$row->pm_id.'');?>" title="status">
		<span class="label label-inverse" title="Press Here to Confirm">UnConfirm</span>
          

        </a>

        <?php }?>

        </td>

        

       

        <td><?php echo $row->pm_created_by; ?></td>

        <td><?php echo $row->pm_created_date; ?></td>

        <td><?php echo $row->pm_modified_by; ?></td>

        <td><?php echo $row->pm_modified_date; ?></td>

        <td>

        <a href="<?php echo base_url(); ?>admincp_convention/program/edit/<?php echo $row->pm_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>

        <a href="<?php echo base_url();?>admincp_convention/program/delete/<?php echo $row->pm_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>

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
<?php $this->load->view('admincp_convention/layout/footer'); ?>

