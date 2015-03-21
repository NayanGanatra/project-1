<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $this->lang->line('text_admin');?> <small><?php echo $this->lang->line('text_change_password');?></small></h1>

		</div>

        <hr>

	

            <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>

            	<?php

				$get_user_name = $this->dbpassword->get_current_user_detail($this->session->userdata('get_admin_id'));

				?>

            

             <div class="control-group <?php if(form_error('username')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_username');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="text" id="username" name="username" value="<?php echo $get_user_name->email; ?>">

                    <span class="help-inline"><?php echo form_error('username'); ?></span>

                </div>

            </div>

            

             <div class="control-group <?php if(form_error('txtcpass')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_current_password');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="password" id="txtcpass" name="txtcpass" value="<?php echo set_value('txtcpass'); ?>">

                    <span class="help-inline"><?php echo form_error('txtcpass'); ?></span>

                </div>

            </div>

            

             <div class="control-group <?php if(form_error('txtncpass')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_new_password');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="password" id="txtncpass" name="txtncpass" value="<?php echo set_value('txtncpass'); ?>">

                    <span class="help-inline"><?php echo form_error('txtncpass'); ?></span>

                </div>

            </div>

            

             <div class="control-group <?php if(form_error('txtrncpass')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_confirm_password');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="password" id="txtrncpass" name="txtrncpass" value="<?php echo set_value('txtrncpass'); ?>">

                    <span class="help-inline"><?php echo form_error('txtrncpass'); ?></span>

                </div>

            </div>

            

            <input type="hidden" name="old_user" value="<?php echo $get_user_name->email; ?>" />

            <input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />

            

		</form>



</td></tr></table>



<?php $this->load->view('admincp/layout/footer'); ?>