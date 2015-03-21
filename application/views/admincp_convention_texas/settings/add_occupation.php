<?php $this->load->view('admincp_convention_texas/layout/header'); ?>



<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <div class="span12"><h1><?php echo $title; ?> <small></small></h1></div>

               <div class="span3" align="right"><a href="<?php echo base_url(); ?>admincp/settings/occupations">Manage Occupations</a></div>

		</div>

        <hr />

         <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>



            

            <div class="control-group <?php if(form_error('covers_cat_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Title</label>

                <div class="controls">

                    <input type="text" id="occupation_name" name="occupation_name" value="<?php echo set_value('occupation_name'); ?>">

                    <span class="help-inline"><?php echo form_error('occupation_name'); ?></span>

                </div>

            </div>

            

			<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>