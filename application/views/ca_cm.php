<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_committee.html'); ?>">Add Committee Member</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
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
			if($query)
			{
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
                        <td><a href="<?php echo base_url('profile').'/'.$row->mm_username;?>"><?php echo $row->mm_fname.' '.$row->mm_lname; ?></a></td>
                        <td><?php echo $row->cm_position;?></td>
                        <td><?php echo $row->cm_year.' '.$row->cm_year2;?></td>
                    	<td><?php if($row->cm_status == '0'){ echo 'Deactive'; }else{ echo 'Active'; } ?></td>
                        <td><a title="Edit" href="<?php echo base_url('ca/edit_committee/'.$row->cm_id.'/'.friendlyURL($row->mm_fname).'.html');?>"><i class="icon-edit"></i></a> <a onclick="javascript: return del();" title="Delete" href="<?php echo base_url('ca/delete_committee/'.$row->cm_id.'/'.friendlyURL($row->mm_fname).'.html');?>"><i class="icon-minus-sign"></i></a></td>
                    	</tr>
                    <?php
				}
			}
			else
			{
				echo '<li>No members found.</li>';
			}
		?>
        </table>
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
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>