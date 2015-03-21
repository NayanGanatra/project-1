<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Album <small> ADD Album</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>

		<div class="control-group <?php if(form_error('ca_name')){ echo "error";}?>">

			<label class="control-label" for="inputError">Album Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="ca_name" name="ca_name" value="<?php echo set_value('ca_name'); ?>">

                    <span class="help-inline"><?php echo form_error('ca_name'); ?></span>

                </div>

		</div>
        	

		<?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="ca_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="ca_created_by" value="<?php echo 'admin';?>">

          

		
                <div class="control-group">

                <div class="controls">

                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />

                </div>

                </div>




	</td>

  </tr>

</table>

<?php $this->load->view('admincp/layout/footer'); ?>