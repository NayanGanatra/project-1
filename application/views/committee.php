<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div>
		<?php $this->load->view('action_status'); ?>
        <ul class="thumbnails">
        <?php
			if($query)
			{
				foreach($query as $row)
				{
					?>
                    	<li class="span2_2">
                        
                        <?php if($row->mm_photo !=''){?>
                        <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->mm_fname.' '.$row->mm_lname; ?>" href="<?php echo base_url('images/profile/big/'.$row->mm_photo); ?>">
							<img width="180" height="180" src="<?php echo base_url('images/profile/thumb/'.$row->mm_photo.'');?>" alt="<?php echo $row->mm_fname.' '.$row->mm_lname; ?>"></a>
                            <?php }else{ ?>
                            <a class="thumbnail" href="javascript:void(0);"><img width="180" height="180" src="<?php echo base_url('images/profile/thumb/no_photo.jpg');?>" alt="<?php echo $row->mm_fname.' '.$row->mm_lname; ?>"></a>
						<?php } ?>

                        <div><?php echo $row->mm_fname.' '.$row->mm_lname;?></div>
                        <span class="label label-info"><?php echo $row->cm_position;?></span>
                        <span class="label"><?php 
								if($row->cm_year == date('Y'))
								{
									echo $row->cm_year;
								}
								elseif($row->cm_year2 == date('Y'))
								{
									echo $row->cm_year2;
								}
								else
								{
									echo $row->cm_year.' '.$row->cm_year2;
								}
								?>
                               </span>
                        <div class="label label-inverse" style="margin-top:3px;"><?php if($row->ch_name == 'National'){echo $row->ch_name.' Committee';}else {echo $row->ch_name;} ?></div>
                    	</li>
                    <?php
				}
			}
			else
			{
				echo '<li>No committee members found in '.date('Y').'.</li>';
			}
		?>
        </ul>
	</div>
    
    <hr/>
    <?php
	$get_cm_years = $this->dbchapter->get_cm_years($chapter->ch_id,date('Y'));
	
		if($get_cm_years)
		{
	?>
    <h3>Past Year's Committee Members</h3>
        <table class="table table-hover">
        <thead>
        	<tr>
            	<td width="50"><strong>Photo</strong></td>
                <td><strong>Name</strong></td>
                <td><strong>Position</strong></td>
                <td width="50"><strong>Year</strong></td>
            </tr>
        </thead>
        <?php
			
				foreach($get_cm_years as $get_cm_years_row)
				{
					$yearly_cm = $this->dbchapter->get_all_ch_cm_by_year($chapter->ch_id,$get_cm_years_row->cm_year);
					
					foreach($yearly_cm as $yearly_cm_row)
					{
						?>
							<tr><td>
                            <?php if($yearly_cm_row->mm_photo !=''){?>
							<img width="50" height="50" class="img-rounded" src="<?php echo base_url('images/profile/thumb/'.$yearly_cm_row->mm_photo.'');?>" alt="<?php echo $yearly_cm_row->mm_fname.' '.$yearly_cm_row->mm_lname; ?>">
                            <?php }else{ ?>
                            <img width="50" height="50" class="img-rounded" src="<?php echo base_url('images/profile/thumb/no_photo.jpg');?>" alt="<?php echo $yearly_cm_row->mm_fname.' '.$yearly_cm_row->mm_lname; ?>">
							<?php } ?>
							</td>
							<td><a href="<?php echo base_url('profile').'/'.$yearly_cm_row->mm_username;?>"><?php echo $yearly_cm_row->mm_fname.' '.$yearly_cm_row->mm_lname; ?></a></td>
							<td><?php echo $yearly_cm_row->cm_position;?></td>
							<td><?php echo $yearly_cm_row->cm_year.' '.$yearly_cm_row->cm_year2;?></td>
							
							</tr>
						<?php
					}
				}
			
		?>
        </table>
	<?php } ?>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;margin-bottom:20px;">
    <div class="sidebar">
    <?php $this->load->view('ca_menu'); ?>
        <?php 
		if(isset($chapter->ch_seo))
		{
			$this->load->view('chapter_menu');
		}
		else
		{
			$this->load->view('media_menu');
		}
		?>
        
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>