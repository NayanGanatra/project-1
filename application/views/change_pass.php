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
            <?php //$this->load->view('action_status'); ?>
             <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
             <?php /*?><div class="control-group <?php if(form_error('username')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><em>* </em><?php echo $this->lang->line('text_username');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="username" name="username" value="<?php //echo $get_user_name->email; ?>">
                    <span class="help-inline"><?php echo form_error('username'); ?></span>
                </div>
            </div><?php */?>
            
             <div class="control-group <?php if(form_error('txtcpass')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><em>* </em><?php echo $this->lang->line('text_current_password');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="password" id="txtcpass" name="txtcpass" value="<?php //echo set_value('txtcpass'); ?>">
                    <span class="help-inline"><?php echo form_error('txtcpass'); ?></span>
                </div>
            </div>
            
             <div class="control-group <?php if(form_error('txtncpass')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><em>* </em><?php echo $this->lang->line('text_new_password');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="password" id="txtncpass" name="txtncpass" value="<?php //echo set_value('txtncpass'); ?>">
                    <span class="help-inline"><?php echo form_error('txtncpass'); ?></span>
                </div>
            </div>
            
             <div class="control-group <?php if(form_error('txtrncpass')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><em>* </em><?php echo $this->lang->line('text_confirm_password');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="password" id="txtrncpass" name="txtrncpass" value="<?php //echo set_value('txtrncpass'); ?>">
                    <span class="help-inline"><?php echo form_error('txtrncpass'); ?></span>
                </div>
            </div>
            <input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />
       
                    	
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