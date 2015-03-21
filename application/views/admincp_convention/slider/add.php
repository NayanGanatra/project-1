<?php $this->load->view('admincp_convention/layout/header'); ?>



<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $this->lang->line('text_slider');?> <small><?php echo $this->lang->line('text_add_slider');?></small></h1>

		</div>

        <hr />

         <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <div class="control-group <?php if(form_error('title')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>

                <div class="controls">

                    <input type="text" id="title" name="title" value="<?php echo set_value('title'); ?>" placeholder="">

                    <span class="help-inline"><?php echo form_error('title'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('link')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_link');?></label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="link" name="link" value="<?php echo set_value('link'); ?>" placeholder="">

                    <span class="help-inline"><?php echo form_error('link'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('image')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('image');?></label>

            <div class="controls">

            <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline">Select Image</span>
            
            <span class="help-inline"><?php echo form_error('image'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('is_active')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>

                <div class="controls">

                    <select name="is_active" style="width:100px;">

					<?php if(set_value('is_active') == '0')

                        {

                        ?>

                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        else

                        {

                        ?>

                        <option value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        ?>

                    </select>

                    <span class="help-inline"><?php echo form_error('is_active'); ?></span>

                </div>

            </div>
            
             <div class="control-group <?php if(form_error('order')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>

                <div class="controls">

                    <input style="width:90px;" type="text" id="page_order" name="order" value="<?php echo set_value('order'); ?>">

                    <span class="help-inline"><?php echo form_error('order'); ?></span>

                </div>

            </div>
            
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="cs_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="cs_created_by" value="<?php echo 'admin';?>">

            

			<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention/layout/footer'); ?>