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



            <div class="control-group <?php if(form_error('mm_email')){ echo "error";}?>">

            <label class="control-label">Email or Username</label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_email" name="mm_email" placeholder="Enter your Email or Username" value="<?php echo set_value('mm_email'); ?>">

            <span class="help-inline"><?php echo form_error('mm_email'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('mm_username')){ echo "error";}?>">

            <label class="control-label">Usename</label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_username" name="mm_username" placeholder="Enter your Registred Username" value="<?php echo set_value('mm_username'); ?>">

            <span class="help-inline"><?php echo form_error('mm_username'); ?></span>

            </div>

            </div>

            

            <div class="clear"></div>

            <div class="control-group">

            <div class="controls">

            <input type="submit" value="<?php echo $this->lang->line('btn_login');?>" class="btn btn-primary" />

            <span class="help-inline"><a href="<?php echo base_url('user/forgot_password.html');?>"><?php echo $this->lang->line('text_forgot_password'); ?></a></span>

            

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

        

        <?php $this->load->view('ads_panel'); ?>

        <div class="space20px"></div>

    </div>

</div>



</div></div>



<?php $this->load->view('footer'); ?>