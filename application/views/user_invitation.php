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
			if($invitations)
			{
				foreach($invitations as $row)
				{
					?>
                    <h3><a href="<?php echo base_url('user/invitation_details/'.$row->event_id.'/'.$row->unique_number);?>"><?php echo $row->event_name; ?></a></h3>
                    <p><strong>Date & Time:</strong> <?php echo $row->event_date_time; ?></p>
                    <p><strong>Location:</strong> <?php echo $row->event_location; ?></p>
                    <hr class="hr_2px nomargin"/>
					<?php
				}
			}
			else
			{
				?>
                <div class="alert alert-info">
                	Still you don't have any invitation so nothing to display here!
                </div>
                <?php
			}
		?>
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
    <?php $this->load->view('ca_menu'); ?>
        <?php $this->load->view('member_menu'); ?>
        
        
        <?php $this->load->view('ads_panel'); ?>
        <div class="space20px"></div>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>