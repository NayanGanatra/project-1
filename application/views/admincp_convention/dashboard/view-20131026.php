<?php $this->load->view('admincp_convention/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	
              
<div class="dotted_line">

        	<span class="span8">

		         <h1>Dashboard <small><?php //echo $tot_rec; //$this->dbuser->count_user();?></small></h1>

            </span>

            <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention/dashboard/view', $form_attributes);

				?>

			</div>

        <hr>

<table border="1" style="margin: 10px 0px 0px 0px; width:70%; border:#000 1px solid;" class="table">

    

        <tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:left;">Convention Dashboard</th>
			<td></td>
			</tr>
			
			<tr class="error">
            <td>Total registration </td>
			<td><?php echo $total_reg; ?></td>
			</tr>	
			
			<tr class="info">
            <td>Total member to attend convention</td>
			<td><?php echo $total_member; ?></td>
			</tr>
            
            <tr class="error">
            <td>Total event registration </td>
			<td><?php echo $total_event; ?></td>
			</tr>

    		<tr class="info">
            <td>Total member to attend event</td>
			<td><?php echo $total_member_to_event; ?></td>
			</tr>
            
            <tr class="error">
            <td>Total program registration </td>
			<td><?php echo $total_program; ?></td>
			</tr>

   			<tr class="info">
            <td>Total partcipant of program</td>
			<td><?php echo $total_participant_to_program; ?></td>
			</tr>
            
            <tr class="error">
            <td>Total medical registration </td>
			<td><?php echo $total_medical; ?></td>
			</tr>

</table>





</div>

	</td></tr></table>
<style>
 .table th, .table td
 {
 	line-height:20px;
 }
</style>
<?php $this->load->view('admincp_convention/layout/footer'); ?>

