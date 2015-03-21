<?php $this->load->view('admincp/layout/header'); ?>



<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Committee Members <small>Manage</small></h1>

		</div>

        <hr />

          

        <?php

			$get_chapters = $this->dbadminheader->get_chapters();

			if($get_chapters)

			{

				foreach($get_chapters as $get_chapters_row)

				{

					?>

                    <h4><?php echo $get_chapters_row->ch_name; ?> Committee Members <span style="float:right; font-size:14px;"><a href="<?php echo base_url('admincp/committee/add/'.$get_chapters_row->ch_id); ?>">Add Member</a></span></h4>

                    <?php

					$query = $this->dbcommittee->get_all_cm($get_chapters_row->ch_id);

					if($query)

                       {

					?>

                    

                    <table class="table table-hover">

                        <thead>

                            <tr>

                                <td width="50"><strong>Photo</strong></td>

                                <td><strong>Name</strong></td>

                                <td><strong>Position</strong></td>

                                <td width="50"><strong>Year</strong></td>

                                <td width="50"><strong>Status</strong></td>

                                <td width="50"><strong>Action</strong></td>

                            </tr>

                        </thead>

                        <?php

							

                            

                                foreach($query as $row)

                                {

                                    ?>

                                        <tr <?php if($row->cm_status == '0'){ ?> class="error" <?php } ?> ><td>

                                        <?php if($row->mm_photo !=''){?>

                                            <img width="50" height="50" class="img-rounded" src="<?php echo base_url('images/profile/thumb/'.$row->mm_photo.'');?>" alt="<?php echo $row->mm_fname.' '.$row->mm_lname; ?>">

                                            <?php }else{ ?>

                                            <img width="50" height="50" class="img-rounded" src="<?php echo base_url('images/profile/thumb/no_photo.jpg');?>" alt="<?php echo $row->mm_fname.' '.$row->mm_lname; ?>">

                                        <?php } ?>

                                        

                                        </td>

                                        <td><a target="_blank" href="<?php echo base_url('profile').'/'.$row->mm_username;?>"><?php echo $row->mm_fname.' '.$row->mm_lname; ?></a>

                                        <br/><?php echo $row->state_name.' | '.$row->ch_name; ?>

                                        </td>

                                        <td><?php echo $row->cm_position;?></td>

                                        <td><?php echo $row->cm_year.' '.$row->cm_year2;?></td>

                                        <td><?php if($row->cm_status == '0'){ echo 'Deactive'; }else{ echo 'Active'; } ?></td>

                                        <td><a title="Edit" href="<?php echo base_url('admincp/committee/edit/'.$row->cm_id.'/'.friendlyURL($row->mm_fname).'.html');?>"><i class="icon-edit"></i></a> <a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('admincp/committee/delete/'.$row->cm_id.'/'.$row->cm_mm_id.'/'.friendlyURL($row->mm_fname).'.html');?>"><i class="icon-minus-sign"></i></a></td>

                                        </tr>

                                    <?php

                                }

                            

                        ?>

                        </table>

                    <?php

					   }

					   else

					   {

						   echo 'No Committee Members found in '.$get_chapters_row->ch_name.' Committee <hr class="hr_2px"/>';

					   }

				}

			}

		?>

        



	</td>

  </tr>

</table>

<?php $this->load->view('admincp/layout/footer'); ?>