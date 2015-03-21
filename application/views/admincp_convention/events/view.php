<?php $this->load->view('admincp_convention/layout/header'); ?>
<div class="min_height" >
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
		<div class="dotted_line">
        	<span class="span8">
		        <h1>Event <small><?php echo $tot_rec; //$this->dbuser->count_user();?></small></h1>
            </span>    
		
        
        <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention/events/view', $form_attributes);

				?>

				<div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">

					<div class="controls">

                        <span class="span4">

                        <input style="margin-top:10px;" class="input-xlarge" type="text" id="search" name="search" placeholder="Search by activity" value="<?php echo $this->session->userdata('search'); ?>">

                        </span>

                        <span class="span2">

                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

                        </span>

					</div>
                    <div >
                    		

                        <a href="<?php echo base_url('admincp_convention/events/event_export_to_excel/');?>" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" >Export to excel</a>

                        

                      
                    </div>

				</div>

                

            </span>

		</div>
      </div>  
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Activity</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col" width="30">Action</th>
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
			$i=0;
		  foreach ($query as $row)
		   {
			?>
		    <tr>
		        <td><?php echo $row->ce_activity; ?></td>
                <td><?php echo $row->ce_created_by; ?></td>
                <td><?php echo $row->ce_created_date; ?></td>
                <td><?php echo $row->ce_modified_by; ?></td>
                <td><?php echo $row->ce_modified_date; ?></td>
		        <td>
				<a href="<?php echo base_url('admincp_convention/events/edit/'.$row->ce_id);?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('admincp_convention/events/delete/'.$row->ce_id);?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    			</tr>
    
		<?php
		$i++;
   }
}
else
{
	echo "<tr><td colspan='9'>No result found!!!</td></tr>";
}
?>

</table>
<?php echo $this->pagination->create_links(); ?>
	</td></tr></table>
</div>
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention/layout/footer'); ?>