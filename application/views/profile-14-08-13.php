<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span12 nomargin">
	<div class="page_content" style="border:0;">
		<?php $this->load->view('action_status'); ?>
        
        <?php
		if($user->mm_disp_dir == 1)
		{
		?>
        
        <div class="span2" style="width:185px;" >
        	<?php if($user->mm_photo != ''){ ?>
            	<a rel="gallery" class="gallery" title="<?php echo $user->mm_fname.' '.$user->mm_lname; ?>" href="<?php echo base_url('images/profile/big/'.$user->mm_photo); ?>"><img src="<?php echo base_url('images/profile/thumb/'.$user->mm_photo); ?>" width="120" class="img-rounded" /></a>
            <?php }else { ?>
            <img src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" />
            <?php } ?>
        </div>
        
        <div class="span7 nomargin">
        	<h3 class="nomargin"><a href="<?php echo base_url('profile/'.$user->mm_username.''); ?>"><?php echo $user->mm_fname.' '.$user->mm_lname; ?></a></h3>
            <p><?php if($user->mm_gender == '0') { echo 'Male';}else{ echo 'Female';}?> 
            <?php
			if($user->mm_disp_birth == 1)
			{
				if($user->mm_birth_month ==1){ $b_month = 'Jan';}
				if($user->mm_birth_month ==2){ $b_month = 'Feb';}
				if($user->mm_birth_month ==3){ $b_month = 'Mar';}
				if($user->mm_birth_month ==4){ $b_month = 'Apr';}
				if($user->mm_birth_month ==5){ $b_month = 'May';}
				if($user->mm_birth_month ==6){ $b_month = 'Jun';}
				if($user->mm_birth_month ==7){ $b_month = 'Jul';}
				if($user->mm_birth_month ==8){ $b_month = 'Aug';}
				if($user->mm_birth_month ==9){ $b_month = 'Sep';}
				if($user->mm_birth_month ==10){ $b_month = 'Oct';}
				if($user->mm_birth_month ==11){ $b_month = 'Nov';}
				if($user->mm_birth_month ==12){ $b_month = 'Dec';}
            echo ' - Birth Date: '.$b_month.', '.$user->mm_birth_year;
			}
			?>
            <br/><?php if($user->mm_address != '') { echo 'Address : '.$user->mm_address;} ?>
            <br/><?php if($user->mm_hphone != '') { echo 'Phone : '.$user->mm_hphone;} if($user->mm_cphone != '') { echo ' Mobile : '.$user->mm_cphone;} ?>
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
			{
				foreach($get_relationship as $get_relationship_row)
				{
					?>
                    <div class="space10px"></div>
					<div class="span5">
						<div class="span1 nomargin">
							<?php if($get_relationship_row->mm_photo != ''){ ?>
								<a rel="gallery" class="gallery" title="<?php echo $get_relationship_row->mm_fname.' '.$get_relationship_row->mm_lname; ?>" href="<?php echo base_url('images/profile/big/'.$get_relationship_row->mm_photo); ?>"><img width="60" src="<?php echo base_url('images/profile/thumb/'.$get_relationship_row->mm_photo); ?>" class="img-rounded" /></a>
							<?php }else { ?>
							<img src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" width="60" />
							<?php } ?>
						</div>
						<span class="span3">
						<h4 class="nomargin"><a href="<?php echo base_url('profile/'.$get_relationship_row->mm_username.''); ?>"><?php echo $get_relationship_row->mm_fname.' '.$get_relationship_row->mm_lname; ?></a></h4>
                        
						<p>
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
                            
						<?php //echo $get_relationship_row->mm_relationship; ?><br/>

                            </p>
						</span>
					</div>
					<?php
				}
			}
		?>
        
        <?php }else{ ?>
        <div class="alert alert-error">User has disabled directory listing</div>
        <?php } ?>
	</div>
</div>


</div></div>

<?php $this->load->view('footer'); ?>