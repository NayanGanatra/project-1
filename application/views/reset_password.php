<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10" style="margin:0;">
			<div class="page_content">
            <?php $this->load->view('action_status'); ?>
            <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            <div class="control-group <?php if(form_error('mm_password')){ echo "error";}?>">
            <label class="control-label">Password</label>
            <div class="controls">
            <input class="input-xlarge" type="password" id="mm_password" name="mm_password" placeholder="" value="<?php echo set_value('mm_password'); ?>">
            <span class="help-inline"><?php echo form_error('mm_password'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_cpassword')){ echo "error";}?>">
            <label class="control-label">Confirm Password</label>
            <div class="controls">
            <input class="input-xlarge" type="password" id="mm_cpassword" name="mm_cpassword" placeholder="" value="<?php echo set_value('mm_cpassword'); ?>">
            <span class="help-inline"><?php echo form_error('mm_cpassword'); ?></span>
            </div>
            </div>
            
            
            <div class="clear"></div>
            <div class="control-group">
            <div class="controls">
            <input type="submit" value="Reset Password" class="btn btn-primary" />
            <span class="help-inline"><a href="<?php echo base_url('user/login.html');?>">Login</a></span>
            
            </div>
            </div>        
                    	
        </div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                    <li <?php if($this->uri->segment(2) == 'register'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/register.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_register');?></a></li>
                    <li <?php if($this->uri->segment(2) == 'login'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/login.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_login');?></a></li>
        
            </ul>
        </div>
        
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>