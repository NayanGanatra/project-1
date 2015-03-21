<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Position <small>Add</small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            <div class="span3">
            <div class="control-group <?php if(form_error('name')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Title</label>
                <div class="controls">
                    <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>">
                    <span class="help-inline"><?php echo form_error('name'); ?></span>
                </div>
            </div>
            </div>
           
            <div class="space20px"></div>
			<input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>