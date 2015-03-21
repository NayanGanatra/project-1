<?php $this->load->view('header'); ?>



<div class="container">

	<span class="span10">

	<h1 class="title"><?php echo $title;?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

    </span>

    

    

</div>



<hr class="header_hr"/>



<div class="container">

	<div class="row">



<div class="span12 nomargin">

	<div class="page_content" style="border:0;">

		<?php $this->load->view('action_status'); ?>

        

			<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>



            <fieldset>

                

                <p class="<?php if(form_error('name')){ echo "error";} ?>"><label><strong><?php echo $this->lang->line('contact_name');?>:</strong></label><span class="space5px"></span><input type="text" name="name" class="input_text" size="36" value="<?php echo set_value('name'); ?>"/> <?php echo form_error('name'); ?></p>
				


                <p class="<?php if(form_error('email')){ echo "error";} ?>"><label><strong><?php echo $this->lang->line('contact_email');?>:</strong></label><span class="space5px"></span><input type="text" name="email" class="input_text" value="<?php echo set_value('email'); ?>" size="36" /> <?php echo form_error('email'); ?></p>



                <p class="<?php if(form_error('comments')){ echo "error";} ?>"><label><strong><?php echo $this->lang->line('contact_comments');?>:</strong></label><span class="space5px"></span><textarea name="comments" class="input_textarea_auto" style="width:680px; height:200px;"><?php echo set_value('comments'); ?></textarea> <?php echo form_error('comments'); ?></p>



                <p><input type="submit" value="<?php echo $this->lang->line('contact_submit_btn');?>" class="btn" /></p>

            </fieldset>

          </div>

</div>





</div></div>



<?php $this->load->view('footer'); ?>