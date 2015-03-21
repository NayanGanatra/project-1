<?php $this->load->view('admincp_convention/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Album <small> Edit Album</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>

            

            <div class="control-group <?php if(form_error('ca_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('ca_name');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="text" id="ca_name" name="ca_name" value="<?php echo $get_album->ca_name; ?>">

                    <span class="help-inline"><?php echo form_error('ca_name'); ?></span>

                </div>

            </div>

                  
  <!--------------------------------------------------------------------------------------------------->   
                
            <?php date_default_timezone_set("Asia/Kolkata"); ?>

            <input type="hidden" id="" name="ca_created_date" value="<?php echo $get_album->ca_created_date; ?>">

            <input type="hidden" id="" name="ca_created_by" value="<?php echo $get_album->ca_created_by; ?>">

            <input type="hidden" id="" name="ca_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

            <input type="hidden" id="" name="ca_modified_by" value="<?php echo 'admin';?>">
            
          	<input type="submit" value="<?php echo $this->lang->line('btn_save_changes'); ?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp/layout/footer'); ?>



<!--pradip changes for ads 201307041133-->

<script type="text/javascript">



$(document).ready(function(){

	$('#url').hide();

	$('#browse').show();

		$("#imageurl").click(function() {

			$('#url').show();

			$('#browse').hide();

		});

		$("#selectimage").click(function() {

			$('#browse').show();

			$('#url').hide();

		});

	

});

</script>



<script language="javascript">

$(function(){



	$("#selectall").click(function () {

	$('.check').attr('checked', this.checked);

	});

	

	$(".check").click(function(){

	if($(".check").length == $(".check:checked").length) {

	$("#selectall").attr("checked", "checked");

	} else {

	$("#selectall").removeAttr("checked");

	}

	});

});

</script>