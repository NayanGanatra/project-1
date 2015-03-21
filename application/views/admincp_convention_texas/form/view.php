<?php $this->load->view('admincp_convention_texas/layout/header'); ?>


<style>
.span8 {
width: 835px !important;
}
table tr td, table tr th 
{
padding: 0px 0px !important;
}
</style>
<table width="1200" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

			<span class="span8">
		        <h1>Form <small>Manage Form</small></h1>
			</span>
		 <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention_texas/form/view', $form_attributes);

				?>

				<div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">

					<div class="controls">

						<?php /*?><span class="span4">


                        <select name="mm_type" class="input-large" style="margin:0;">

                        <option value="0" <?php  ?> >All members</option>

                        </select>

                        </span><?php */?>

                        <span class="span4">

                        <input style="margin-top:10px;" class="input-xlarge" type="text" id="search" name="search" placeholder="Search member by name or email" value="<?php echo $this->session->userdata('search'); ?>">

                        </span>

                        <span class="span2">

                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

                        </span>

					</div>
                    <div >
                    		

                        <a href="<?php echo base_url('admincp_convention_texas/form/form_export_to_excel/');?>" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" >Export to excel</a>

                        

                      
                    </div>

				</div>
				

                

           

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col" width="20">#</th>
            <th scope="col">Username</th>
			<th scope="col">Life Member ID</th>
          	<th scope="col">Email </th>
          	<th scope="col">Phone No(H) </th>
          	<th scope="col">State </th>
          	<th scope="col">Chapter </th>
			<th scope="col">Adults Guest Count</th>
			<th scope="col">Kids Guest Count</th>
			<th scope="col">Payment Method</th>
			<th scope="col">Payment Status</th>
			<th scope="col">Total </th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col">Action</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="14"></td>

        </tr>

    </tfoot>

    <?php
    
		if ($query)
		{
			$i=0;
			foreach ($query as $row)
		    {
				$i++;
				$chapter = $this->dbform->get_chapter_from_mm_id($row->mm_id);
				$get_members = $this->dbform->get_page($row->fm_id);
				$counter_adult = 0;
				$counter_kids = 0;
				foreach($get_members as $a)
				{
					if($a->fmg_age_grp == "A")
					{
						$counter_kids++;	
					}
					else
					{
						$counter_adult++;
					}
				}
				
				
				
				
	?>
    <tr>
		<td><?php echo $i; ?></td>
        <td><?php echo $row->fm_reg_num; ?></td>
		<td><?php if($chapter != "" && $chapter != null ) echo "L M -".$chapter->mm_life_id; ?></td>
        <td><?php echo $row->fm_email; ?></td>
        <td><?php echo $row->fm_phoneh; ?></td>
        <td><?php echo $row->state_name; ?></td>
        <td><?php if($chapter != "" && $chapter != null ) echo $chapter->ch_name; ?></td>
		<td><?php echo $counter_adult; ?></td>
		<td><?php echo $counter_kids; ?></td>
		<td><?php if($row->payment_type == "by_check") echo "Check"; else echo "Paypal"; ?></td>
		<td><?php if($row->payment_status == 0) echo "Unpaid"; else echo "Paid"; ?></td>
		<td><?php echo $row->fm_total_fee; ?></td>
        <td><?php echo $row->fm_created_by; ?></td>
        <td><?php echo $row->fm_created_date; ?></td>
        <td><?php echo $row->fm_modified_by; ?></td>
        <td><?php echo $row->fm_modified_date; ?></td>
        <td><a href="<?php echo base_url(); ?>admincp_convention_texas/form/edit/<?php echo $row->fm_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp_convention_texas/form/delete/<?php echo $row->fm_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td>
    </tr>
	<?php
   }
}
else
{
	echo "<tr><td colspan='14'>".$this->lang->line('text_no_result')."</td></tr>";
}
?>

</table>
<?php echo $this->pagination->create_links();  ?>
</div>
</td></tr></table>
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>