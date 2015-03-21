<?php $this->load->view('admincp_convention_texas/layout/header'); ?>



<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $title;?> <small></small></h1>

		</div>

        <hr />

         <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>



            

            <div class="control-group <?php if(form_error('field_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Name</label>

                <div class="controls">

                    <input type="text" id="field_name" name="field_name" value="<?php echo $get_item->field_name; ?>">

                    <span class="help-inline"><?php echo form_error('field_name'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('field_for')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Field For</label>

                <div class="controls">

                    <select name="field_for">

                    	<option <?php if($get_item->field_for == 'register'){ echo 'selected="selected"';} ?> value="register">Registration Page</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('field_for'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('field_type')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Field Type</label>

                <div class="controls">

                    <select name="field_type">

                    	<option <?php if($get_item->field_type == '1'){ echo 'selected="selected"';} ?> value="1">Text</option>

                        <option <?php if($get_item->field_type == '2'){ echo 'selected="selected"';} ?> value="2">Drop Down</option>

                        <option <?php if($get_item->field_type == '3'){ echo 'selected="selected"';} ?> value="3">Multiple Choice</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('field_type'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('field_order')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Sort Order</label>

                <div class="controls">

                    <input class="input-small"  type="text" id="field_order" name="field_order" value="<?php echo $get_item->field_order; ?>">

                    <span class="help-inline"><?php echo form_error('field_order'); ?></span>

                </div>

            </div>

            

            <input type="hidden" name="id" value="<?php echo $get_item->field_id; ?>" />

			<input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>