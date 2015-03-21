<?php $this->load->view('admincp_convention/layout/header'); ?>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

			<span class="span8">
		        <h1>Convention <small></small></h1>
			</span>
		 <div class="span5 offset sub_link" align="">

            	<?php

                //$form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                //echo form_open(base_url() . 'admincp_convention/form/view', $form_attributes);

				?>
				<form method="post" id="myform" name="myform">
				<div class="control-group <?php if(form_error('pm_mm_id')){ echo "error";}?>">

                <label class="control-label">Member Name</label>

                <div class="controls">

                <select name="pm_mm_id" data-placeholder="Select a Member..." onchange="show(this.value)" class="chzn-select" style="width:400px;" tabindex="1">

                  <option value="" <?php if(set_value('pm_mm_id') == '') {?> <?php } ?> ></option>

                  <?php
					$members = $this->dbcon_detail->all_members();
				  	
					foreach($members as $members_row)

					{
						
						$con_members = $this->dbcon_detail->all_con_members($members_row->mm_id);
						foreach($con_members as $con_members_row)
						{
							
						?>

							

						<option <?php if(isset($query)){foreach($query as $row1){if($row1->mm_id == $con_members_row->mm_id) { ;?> selected="selected" <?php } } }?> 
                                    value="<?php echo $con_members_row->mm_id; ?>"><?php echo $con_members_row->mm_fname.' '.$con_members_row->mm_lname.' - '.$con_members_row->mm_email; ?></option>

                        <?php 
							
						}
					}

				  ?>                  

                </select>

                <span class="help-inline"> <?php echo form_error('pm_mm_id'); ?></span>

                </div>

                </div>
				

                

           

		</div>

        <hr>
<?php if (isset($query))
		{
			?>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col" width="20">#</th>
            <th scope="col">Name</th>
          	<th scope="col">Email </th>
            <th scope="col">No. of program reg</th>
            <th scope="col">No. of medical reg</th>
            <th scope="col">No. of member</th>
            <th scope="col">Sub amt. of reg</th>
            <th scope="col">No. of event reg.</th>
            <th scope="col">Sub amt. of event</th>
            <th scope="col">Total amt.</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="11"></td>

        </tr>

    </tfoot>

    <?php

		
			$i=0;
			foreach ($query as $row)
		    {
			  	$i++;
				$chapter = $this->dbcon_detail->get_chapter_from_mm_id($row->mm_id);
	?>

    <tr>
		<td><?php echo $i; ?></td>
        <td><?php echo $chapter->mm_username; ?></td>
        <td><?php echo $chapter->mm_email; ?></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention/program/view"/><?php echo $program; ?></a></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention/medical/view"/><?php echo $medical; ?></a></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention/form/edit/<?php echo $row->fm_id; ?>"/><?php echo $attend; ?></a></td>
        <td><?php $total = 0;
		foreach($subtotal_of_reg as $subtotal){ echo $subtotal->fm_total_fee; 
		$total += $subtotal->fm_total_fee;
		}?></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention/event_member/view"/><?php echo $event; ?></a></td>
        <td><?php foreach($subtotal_of_event as $subtotal_event){ echo $subtotal_event->ce_total; 
		$total += $subtotal_event->ce_total;
		} ?></td>
        <td><?php echo $total; ?></td>
        <?php /*?><td><a href="<?php echo base_url(); ?>admincp_convention/form/edit/<?php echo $row->fm_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp_convention/form/delete/<?php echo $row->fm_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td><?php */?>
    </tr>
	<?php
   }
}

?>
</table>

</div>
</td></tr></table>
</form>

<?php $this->load->view('admincp_convention/layout/footer'); ?>
<script>
function show($id)
{
	var id = $id;
	//alert('http://localhost/spcsusa/admincp_convention/view'+id);
	document.getElementById('myform').action = BASE_URI+'admincp_convention/convention_detail/view/'+id;
	document.getElementById('myform').submit();
			
			/*$.ajax({
				   type: "POST",
			
			url: BASE_URI+"admincp_convention/convention_detail/show",
			data :'mm_id='+id,
			success: function(data) {
				alert(data);
				return true;
			}
			});*/
}

</script>