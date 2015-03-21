<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span6">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span8" align="right">
    	<?php $this->load->view('action_status'); ?>
            <?php
                $form_attributes = array( 'id' => 'myform','class' => 'member_search', 'method' => 'GET');
                echo form_open('members/search/', $form_attributes);
            ?>

            <div class="control-group <?php if(form_error('keywords')){ echo "error";}?>" style="margin-top: 20px;">
            <div class="controls" >
            <input class="input-xlarge" type="text" id="keywords" name="keywords" placeholder="Search by Name, Surname, Phone, Email" value="<?php echo $this->input->get('keywords');?>">
            <span class="help-inline" style="margin-top:-10px;"><input type="submit" value="Search" class="btn btn-primary" /></span>
            </div>
            </div>
            
        </form>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span12 nomargin">
	<div class="page_content" style="border:0;">
		<?php $this->load->view('action_status'); ?>
		
        <?php if($this->input->get('keywords')){?><div>Your search result for : <?php echo $this->input->get('keywords');?></div><?php } ?>
        
        <div class="clear"></div>
         <div class="space20px"></div>
        <?php

			if($query)
			{
				foreach($query as $query_row)
				{
					?>
					<div class="span4" style="margin-bottom:15px;">
						<div class="span1 nomargin">
							<?php if($query_row->mm_photo != ''){ ?>
								<a href="<?php echo base_url('profile/'.$query_row->mm_username.''); ?>"><img width="60" src="<?php echo base_url('images/profile/thumb/'.$query_row->mm_photo); ?>" class="img-rounded" /></a>
							<?php }else { ?>
							<img src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" width="60" />
							<?php } ?>
						</div>
						<span class="span2">
						<p class="nomargin"><a href="<?php echo base_url('profile/'.$query_row->mm_username.''); ?>"><?php echo $query_row->mm_fname.' '.$query_row->mm_lname; ?></a></p>
                        <div><?php if(isset($query_row->state_name)){echo $query_row->state_name;} ?></div>
						</span>
					</div>
					<?php
				}
			}
		?>
        
        
	</div>
    
    <div class="clear"></div>
        
        <div style="clear:both;">
		<?php echo $this->pagination->create_links(); ?>
        </div>
</div>


</div></div>

<?php $this->load->view('footer'); ?>