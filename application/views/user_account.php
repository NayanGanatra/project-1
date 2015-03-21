<?php $this->load->view('header'); ?>



<div class="container">

	<h1 class="title"><?php echo $title;?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

</div>



<hr class="header_hr"/>



<div class="container">

	<div class="row">



<div class="span10 nomargin">

	<div class="page_content">

		<?php $this->load->view('action_status'); ?>

        

        <?php

		$event_inv = $this->dbuser->get_event_in_user($user->mm_state_id,$user->mm_id);

		if($event_inv)

		{

		?>

        <div class="alert alert-block">

          <button type="button" class="close" data-dismiss="alert">×</button>

          <h4>Event Invitation!</h4>

          You have new Event Invitation from SPCS.

          <a href="<?php echo base_url('user/invitation'); ?>">Click here to View</a>

        </div>

        <?php } ?>

        <div class="span2" style="width:185px;" >

        	<?php if($user->mm_photo != ''){ ?>

            	<a rel="gallery" class="gallery" title="<?php echo $user->mm_fname.' '.$user->mm_lname; ?>" href="<?php echo base_url('images/profile/big/'.$user->mm_photo); ?>"><img src="<?php echo base_url('images/profile/thumb/'.$user->mm_photo); ?>" class="img-rounded" /></a>

            <?php }else { ?>

            <img src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" />

            <?php } ?>

        </div>

        

        <div class="span7 nomargin">

        	<h3 class="nomargin"><a href="<?php echo base_url('profile/'.$user->mm_username.''); ?>"><?php echo $user->mm_fname.' '.$user->mm_lname; ?></a></h3>

            <p><?php if($user->mm_gender == '0') { echo 'Male';}else{ echo 'Female';} echo ' - '.$user->mm_birth_month.', '.$user->mm_birth_year; ?>

            <br/><?php if($user->mm_hphone != '') { echo 'Phone : '.$user->mm_hphone;} if($user->mm_cphone != '') { echo ' Mobile : '.$user->mm_cphone;} ?></p>

            <p><a href="<?php echo base_url('user/edit_profile.html'); ?>">Edit Profile</a>

            </p>

        </div>

        

        <div class="clear"></div>

         <div class="space20px"></div>

        <?php

        	$get_relationship = $this->dbuser->get_relationship($user->mm_id);

			

			if(!$get_relationship)

			{

				$get_relationship = $this->dbuser->get_relationship_sub($user->mm_family_id,$user->mm_id);

			}

			

			if($get_relationship)

			{ ?>

			<!--updated by ketan 201307291545-->

			<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

			<thead>

				<!--<tr>

		            <th colspan="6" scope="col" width="30"><h3 class="title">Family Members</h3></th>

		        </tr>-->

		        <tr>

		            <th scope="col">Image</th>

		            <th scope="col">Name</th>

		            <th scope="col">Email</th>

					<th scope="col">Date of Birth</th>
                    
                    <th scope="col">Phone</th>
                    
                    <th scope="col">Occupation</th>

					<th scope="col" width="30">Action</th>

		        </tr>

		    </thead>

		    <tfoot>

		    	<tr>

		        	<td colspan="7"></td>

		        </tr>

		    </tfoot>

			<?php

				foreach($get_relationship as $get_relationship_row)

				{

					?>

					<tr>

					<td>

					<?php if($get_relationship_row->mm_photo != ''){ ?>

								<a rel="gallery" class="gallery" title="<?php echo $get_relationship_row->mm_fname.' '.$get_relationship_row->mm_lname; ?>" href="<?php echo base_url('images/profile/big/'.$get_relationship_row->mm_photo); ?>"><img width="60" src="<?php echo base_url('images/profile/thumb/'.$get_relationship_row->mm_photo); ?>" class="img-rounded" /></a>

							<?php }else { ?>

							<img src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" width="60" />

							<?php } ?>

					</td>

					<td>

					<h4 class="nomargin"><a href="<?php echo base_url('profile/'.$get_relationship_row->mm_username.''); ?>"><?php echo $get_relationship_row->mm_fname.' '.$get_relationship_row->mm_lname; ?></a></h4><br />

					

					<?php

								if($user->mm_relationship == 'Son' || $user->mm_relationship == 'Daughter')

								{

									if($get_relationship_row->mm_relationship == 'Wife' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '1'))

									{

										echo 'Mother';

									}

									if($get_relationship_row->mm_relationship == 'Husband' || ($get_relationship_row->mm_relationship == '' && $get_relationship_row->mm_gender == '0') )

									{

										echo 'Father';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										echo 'Brother';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										echo 'Sister';

									}

								}

								

								if($user->mm_relationship == 'Wife')

								{

									if($get_relationship_row->mm_relationship == '')

									{

										echo 'Husband';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										echo 'Son';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										echo 'Daughter';

									}

								}

								

								if($user->mm_relationship == '')

								{

									if($get_relationship_row->mm_relationship == 'Wife')

									{

										echo 'Wife';

									}

									if($get_relationship_row->mm_relationship == 'Husband')

									{

										echo 'Husband';

									}

									if($get_relationship_row->mm_relationship == 'Daughter')

									{

										echo 'Daughter';

									}

									if($get_relationship_row->mm_relationship == 'Son')

									{

										echo 'Son';

									}

								}

							

							?>

					</td>

					

					<td>

					<?php

						echo $get_relationship_row->mm_email;

					?>

					</td>

					<td>

					<?php

						echo $get_relationship_row->mm_birth_month.'/'.$get_relationship_row->mm_birth_year;

					?>

					</td>
                    
                    <td>
					<?php
						echo $get_relationship_row->mm_hphone.'<br />'.$get_relationship_row->mm_cphone;
					?>
					</td>
                    
                    <td>
					<?php
						$occupation = $this->dbuser->get_occupation($get_relationship_row->occupation_id);
						if($occupation)
						{
							echo $occupation->occupation_name;	
						}
					?>
					</td>

					<td>

					<?php

							  if($user->mm_family_id == 0)

							  {

						?>

                        	<a href="<?php echo base_url('user/edit_profile_family/'.$get_relationship_row->mm_id.'.html'); ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>

                            <a href="<?php echo base_url('user/delete_profile/'.$get_relationship_row->mm_id.'/'.$get_relationship_row->mm_fname.' '.$get_relationship_row->mm_lname.'.html'); ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" ><i class="icon-minus-sign"></i></a>

                        <?php } ?>

					</td>

					</tr>

                    <?php

				}

			?>

			</table>

			<!--update end-->

			<?php

			}

		?>

        

        

	</div>

</div>



<div class="span3" style=" margin-left:20px; margin-top:-20px;">

    <div class="sidebar">

        <?php $this->load->view('member_menu'); ?>

        <?php

		if($user->mm_type == 1)

		{

			$this->load->view('ca_menu');

		}

		?>

        

        <?php $this->load->view('ads_panel'); ?>

        <div class="space20px"></div>

    </div>

</div>



</div></div>



<?php $this->load->view('footer'); ?>