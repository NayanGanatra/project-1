<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<style>
.loading{ background-image:url(<?php echo base_url(); ?>images/loading.gif); background-repeat:no-repeat; width:16px; height:16px; display:inline-block;}
</style>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Medical Release Form<small></small></h1>
                <h2><small>(Only for Kids under 18 years)</small></h2>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>
            
            <div class="control-group <?php if(form_error('md_mm_id')){ echo "error";}?>">

                <label class="control-label">Member Name</label>

                <div class="controls">

                <select name="md_mm_id" data-placeholder="Select a Member..." class="chzn-select" style="width:400px;" tabindex="1">

                  <option value="" <?php if(set_value('md_mm_id') == '') {?> <?php } ?> ></option>

                  <?php

				  	$members = $this->dbmedical->all_members();

					foreach($members as $members_row)

					{
						$con_members = $this->dbmedical->all_con_members($members_row->mm_id);
						foreach($con_members as $con_members_row)
						{
						?>

							

						<option <?php if(set_value('md_mm_id') == $con_members_row->mm_id) { ;?> selected="selected" <?php }?> value="<?php echo $con_members_row->mm_id; ?>"><?php echo $con_members_row->mm_fname.' '.$con_members_row->mm_lname.' - '.$con_members_row->mm_email; ?></option>

                        <?php 
						}
					}

				  ?>                  

                </select>

                <span class="help-inline"> <?php echo form_error('md_mm_id'); ?></span>

                </div>

                </div>
            

	<div class="row">
		<div class="control-group <?php if(form_error('md_name')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_name" value="<?php echo set_value('md_name'); ?>" placeholder="Enter Name">
</br>
                    <span class="help-inline"><?php echo form_error('md_name'); ?></span>

                </div>

		</div>

    
    <div style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">
    		<span class="span100 nomargin" style="">

            <div class="control-group <?php if(form_error('md_birth_month')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_birth_month');?></label>

            <div class="controls">

            	<select tabindex="15" class="input-small" name="md_birth_month">

                	<option value="">Select</option>               

                	<option <?php if(set_value('md_birth_month') == 1){ echo 'selected="selected"';}?> value="1">Jan</option>

                    <option <?php if(set_value('md_birth_month') == 2){ echo 'selected="selected"';}?> value="2">Feb</option>

                    <option <?php if(set_value('md_birth_month') == 3){ echo 'selected="selected"';}?> value="3">Mar</option>

                    <option <?php if(set_value('md_birth_month') == 4){ echo 'selected="selected"';}?> value="4">Apr</option>

                    <option <?php if(set_value('md_birth_month') == 5){ echo 'selected="selected"';}?> value="5">May</option>

                    <option <?php if(set_value('md_birth_month') == 6){ echo 'selected="selected"';}?> value="6">Jun</option>

                    <option <?php if(set_value('md_birth_month') == 7){ echo 'selected="selected"';}?> value="7">Jul</option>

                    <option <?php if(set_value('md_birth_month') == 8){ echo 'selected="selected"';}?> value="8">Aug</option>

                    <option <?php if(set_value('md_birth_month') == 9){ echo 'selected="selected"';}?> value="9">Sep</option>

                    <option <?php if(set_value('md_birth_month') == 10){ echo 'selected="selected"';}?> value="10">Oct</option>

                    <option <?php if(set_value('md_birth_month') == 11){ echo 'selected="selected"';}?> value="11">Nov</option>

                    <option <?php if(set_value('md_birth_month') == 12){ echo 'selected="selected"';}?> value="12">Dec</option>

                </select>
</br>
            <span class="help-inline"><?php echo form_error('md_birth_month'); ?></span>

            </div>

            </div>

            </span>



            <span class="span100 nomargin">

            <div class="control-group <?php if(form_error('md_birth_year')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_birth_year');?></label>

            <div class="controls">

            <input tabindex="16" class="span1" type="text" id="mm_birth_year" name="md_birth_year" placeholder="Year" value="<?php echo set_value('md_birth_year'); ?>">

 </br>
            <span class="help-inline"><?php echo form_error('md_birth_year'); ?></span>

            </div>

            </div>

            </span>

   </div>   

            <span class="span2 nomargin">

             

         	

            <div class="control-group <?php if(form_error('md_sex')){ echo "error";}?>">

            <label class="control-label">Sex</label>

            <div class="controls">

            	<select tabindex="18" class="input-small" name="md_sex">

                	<option value="">Select</option>     

                	<option <?php if(set_value('md_sex') == 0){ echo 'selected="selected"';}?> value="0">Male</option>

                    <option <?php if(set_value('md_sex') == 1){ echo 'selected="selected"';}?> value="1">Female</option>

                </select>

</br>
            <span class="help-inline"><?php echo form_error('md_sex'); ?></span>

            </div>

            </div>

            </span>
     </div>       
    
    <div class="row">
    
    	<div class="control-group <?php if(form_error('md_address')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Address</label>
			
				<div class="controls">

                    <textarea class="input-xlarge" id="covers_cat_name" name="md_address" placeholder="Enter Address"><?php echo set_value('md_address'); ?></textarea>
</br>
                    <span class="help-inline"><?php echo form_error('md_address'); ?></span>

                </div>
       </div>    
        
        <div class="control-group <?php if(form_error('md_home_phone')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Home Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_home_phone" value="<?php echo set_value('md_home_phone'); ?>" placeholder="Enter home phone">
</br>
                    <span class="help-inline"><?php echo form_error('md_home_phone'); ?></span>

                </div>

		</div>      

		<div class="control-group <?php if(form_error('md_cellphone')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Cell Phone</label>

			<div class="controls">

				<input class="input-xlarge" type="text" id="covers_cat_name" name="md_cellphone" value="<?php echo set_value('md_cellphone'); ?>" placeholder="Enter cell phone">
</br>
                <span class="help-inline"><?php echo form_error('md_cellphone'); ?></span>

			</div>

		</div>
        
        
    </div>   
    
    	
       
    <div class="row">
    
    
    		<div class="control-group <?php if(form_error('md_state')){ echo "error";}?>" style="float:left;width:290px;;;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_state');?></label>

            <div class="controls">
				<div class="row">
            	<select tabindex="13" class="input-xlarge" name="md_state" id="mm_state_id" style="width:270px;float:left">

                <!--/*edit*/-->

                <option value="">Please Select</option>

               <!-- /*edit*/-->

                <?php

					$get_states = $this->dbmedical->states();

					

					foreach($get_states as $get_states_row)

					{

						

						

						?>

                        <option <?php if(set_value('md_state') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>

                        <?php

						

					}

				?>

                </select>
                <span id="mm_state_id_loading" class="loading" style="display:none;float:left;margin-top:5px;width:15px;margin-left:5px;"></span>
                </div>
</br>                

            <span class="help-inline"><?php echo form_error('md_state'); ?></span>

            </div>

            </div>
    
    
    		
            
            <div class="control-group <?php if(form_error('md_city')){ echo "error";}?>" style="float:left;width:auto;margin-left:45px;">

            <label class="control-label"><?php echo $this->lang->line('text_city');?></label>

            <div class="controls">

            	<select tabindex="14" class="input-xlarge" name="md_city" id="mm_city_id">

                <option value="">Select City</option>

                </select>

</br>
            <span class="help-inline"><?php echo form_error('md_city'); ?></span>

            </div>

            </div>
            
            <div class="control-group <?php if(form_error('md_zip')){ echo "error";}?>" style="float:left;width:auto;margin-left:65px;margin-bottom:0px;">

            <label class="control-label">Zip</label>

            <div class="controls">

            	<input class="" type="text" id="covers_cat_name" name="md_zip" value="<?php echo set_value('md_zip'); ?>" placeholder="Enter Zip Code">

</br>
            <span class="help-inline"><?php echo form_error('md_zip'); ?></span>

            </div>

            </div>
    
    </div>
    
    <h3 style="font-size:15px;"><b style="border-bottom: 1px solid #000000;
    padding-bottom: 3px;">IN CASE OF EMERGENCY, CONTACT</b></h3>
    
       <div class="row">
		<div class="control-group <?php if(form_error('md_name1')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_name1" value="<?php echo set_value('md_name1'); ?>" placeholder="Enter Name">
</br>
                    <span class="help-inline"><?php echo form_error('md_name1'); ?></span>

                </div>

		</div>

    
    
    <div class="control-group <?php if(form_error('md_rel1')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_relationship');?></label>

            <div class="controls">

            	<select tabindex="17" class="input-small" name="md_rel1">

                	<option value="">Select</option>

                	<?php //if($cur_user->mm_gender == 0) {?>

                    <option <?php if(set_value('md_rel1') == 'Wife'){ echo 'selected="selected"';}?> value="Wife">Wife</option>

                    <?php //} else { ?>

                    <option <?php if(set_value('md_rel1') == 'Husband'){ echo 'selected="selected"';}?> value="Husband">Husband</option>

                    <?php //} ?>

                    <option <?php if(set_value('md_rel1') == 'Father'){ echo 'selected="selected"';}?> value="Father">Father</option>

                    <option <?php if(set_value('md_rel1') == 'Mother'){ echo 'selected="selected"';}?> value="Mother">Mother</option>

                    <option <?php if(set_value('md_rel1') == 'Brother'){ echo 'selected="selected"';}?> value="Brother">Brother</option>

                    <option <?php if(set_value('md_rel1') == 'Sister'){ echo 'selected="selected"';}?> value="Sister">Sister</option>

                    <option <?php if(set_value('md_rel1') == 'Son'){ echo 'selected="selected"';}?> value="Son">Son</option>

                    <option <?php if(set_value('md_rel1') == 'Daughter'){ echo 'selected="selected"';}?> value="Daughter">Daughter</option>

              </select>
              
              </br>

            <span class="help-inline"><?php echo form_error('md_rel1'); ?></span>

            </div>

            </div>
     </div>       
    
    <div class="row">
    
    	<div class="control-group <?php if(form_error('md_address1')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Address</label>
			
				<div class="controls">

                    <textarea class="input-xlarge" id="covers_cat_name" name="md_address1" placeholder="Enter Address"><?php echo set_value('md_address1'); ?></textarea>
</br>
                    <span class="help-inline"><?php echo form_error('md_address1'); ?></span>

                </div>
       </div>    
        
        <div class="control-group <?php if(form_error('md_home_phone1')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Home Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_home_phone1" value="<?php echo set_value('md_home_phone1'); ?>" placeholder="Enter home phone">
</br>
                    <span class="help-inline"><?php echo form_error('md_home_phone1'); ?></span>

                </div>

		</div>      

		<div class="control-group <?php if(form_error('md_cellphone1')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Cell Phone</label>

			<div class="controls">

				<input class="input-xlarge" type="text" id="covers_cat_name" name="md_cellphone1" value="<?php echo set_value('md_cellphone1'); ?>" placeholder="Enter cell phone">
</br>
                <span class="help-inline"><?php echo form_error('md_cellphone1'); ?></span>

			</div>

		</div>
        
        
    </div>   
    
    	
       
    <div class="row">
    
    
    		<div class="control-group <?php if(form_error('md_state1')){ echo "error";}?>" style="float:left;width:290px;;;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_state');?></label>

            <div class="controls">
				<div class="row">
            	<select tabindex="13" class="input-xlarge" name="md_state1" id="mm_state_id1" style="width:270px;float:left">

                <!--/*edit*/-->

                <option value="">Please Select</option>

               <!-- /*edit*/-->

                <?php

					$get_states = $this->dbmedical->states();

					

					foreach($get_states as $get_states_row)

					{

						

						

						?>

                        <option <?php if(set_value('md_state1') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>

                        <?php

						

					}

				?>

                </select>
                <span id="mm_state_id_loading1" class="loading" style="display:none;float:left;margin-top:5px;width:15px;margin-left:5px;"></span>
                </div>
</br>                

            <span class="help-inline"><?php echo form_error('md_state1'); ?></span>

            </div>

            </div>
    
    
    		<div class="control-group <?php if(form_error('md_city1')){ echo "error";}?>" style="float:left;width:auto;margin-left:45px;">

            <label class="control-label"><?php echo $this->lang->line('text_city');?></label>

            <div class="controls">

            	<select tabindex="14" class="input-xlarge" name="md_city1" id="mm_city_id1">

                <option value="">Select City</option>

                </select>

</br>
            <span class="help-inline"><?php echo form_error('md_city1'); ?></span>

            </div>

            </div>
            
            <div class="control-group <?php if(form_error('md_zip1')){ echo "error";}?>" style="float:left;width:auto;margin-left:65px;margin-bottom:0px;">

            <label class="control-label">Zip</label>

            <div class="controls">

            	<input class="" type="text" id="covers_cat_name" name="md_zip1" value="<?php echo set_value('md_zip1'); ?>" placeholder="Enter Zip Code">

</br>
            <span class="help-inline"><?php echo form_error('md_zip1'); ?></span>

            </div>

            </div>
    
    </div>
    
    <h3 style="font-size:15px;"><b style="border-bottom: 1px solid #000000;
    padding-bottom: 3px;">IF EMERGENCY CONTACT IS NOT AVAILABLE, CONTACT</b></h3>
    
    	<div class="row">
		<div class="control-group <?php if(form_error('md_name2')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_name2" value="<?php echo set_value('md_name2'); ?>" placeholder="Enter Name">
</br>
                    <span class="help-inline"><?php echo form_error('md_name2'); ?></span>

                </div>

		</div>

    
    
    <div class="control-group <?php if(form_error('md_rel2')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_relationship');?></label>

            <div class="controls">

            	<select tabindex="17" class="input-small" name="md_rel2">

                	<option value="">Select</option>

                	<?php //if($cur_user->mm_gender == 0) {?>

                    <option <?php if(set_value('md_rel2') == 'Wife'){ echo 'selected="selected"';}?> value="Wife">Wife</option>

                    <?php //} else { ?>

                    <option <?php if(set_value('md_rel2') == 'Husband'){ echo 'selected="selected"';}?> value="Husband">Husband</option>

                    <?php //} ?>

                    <option <?php if(set_value('md_rel2') == 'Father'){ echo 'selected="selected"';}?> value="Father">Father</option>

                    <option <?php if(set_value('md_rel2') == 'Mother'){ echo 'selected="selected"';}?> value="Mother">Mother</option>

                    <option <?php if(set_value('md_rel2') == 'Brother'){ echo 'selected="selected"';}?> value="Brother">Brother</option>

                    <option <?php if(set_value('md_rel2') == 'Sister'){ echo 'selected="selected"';}?> value="Sister">Sister</option>

                    <option <?php if(set_value('md_rel2') == 'Son'){ echo 'selected="selected"';}?> value="Son">Son</option>

                    <option <?php if(set_value('md_rel2') == 'Daughter'){ echo 'selected="selected"';}?> value="Daughter">Daughter</option>

              </select>
              
</br>              

            <span class="help-inline"><?php echo form_error('md_rel2'); ?></span>

            </div>

            </div>
     </div>       
    
    <div class="row">
    
    	<div class="control-group <?php if(form_error('md_address2')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Address</label>
			
				<div class="controls">

                    <textarea class="input-xlarge" id="covers_cat_name" name="md_address2" placeholder="Enter Address"><?php echo set_value('md_address2'); ?></textarea>
</br>
                    <span class="help-inline"><?php echo form_error('md_address2'); ?></span>

                </div>
       </div>    
        
        <div class="control-group <?php if(form_error('md_home_phone2')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Home Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_home_phone2" value="<?php echo set_value('md_home_phone2'); ?>" placeholder="Enter home phone">
</br>
                    <span class="help-inline"><?php echo form_error('md_home_phone2'); ?></span>

                </div>

		</div>      

		<div class="control-group <?php if(form_error('md_cellphone2')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Cell Phone</label>

			<div class="controls">

				<input class="input-xlarge" type="text" id="covers_cat_name" name="md_cellphone2" value="<?php echo set_value('md_cellphone2'); ?>" placeholder="Enter cell phone">
</br>
                <span class="help-inline"><?php echo form_error('md_cellphone2'); ?></span>

			</div>

		</div>
        
        
    </div>   
    
    	
       
    <div class="row">
    
    
    		<div class="control-group <?php if(form_error('md_state2')){ echo "error";}?>" style="float:left;width:290px;;;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_state');?></label>

            <div class="controls">
				<div class="row">
            	<select tabindex="13" class="input-xlarge" name="md_state2" id="mm_state_id2" style="width:270px;float:left">

                <!--/*edit*/-->

                <option value="">Please Select</option>

               <!-- /*edit*/-->

                <?php

					$get_states = $this->dbmedical->states();

					

					foreach($get_states as $get_states_row)

					{

						

						

						?>

                        <option <?php if(set_value('md_state2') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>

                        <?php

						

					}

				?>

                </select>
                <span id="mm_state_id_loading2" class="loading" style="display:none;float:left;margin-top:5px;width:15px;margin-left:5px;"></span>
                </div>

</br>
            <span class="help-inline"><?php echo form_error('md_state2'); ?></span>

            </div>

            </div>
    
    
    		<div class="control-group <?php if(form_error('md_city2')){ echo "error";}?>" style="float:left;width:auto;margin-left:45px;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_city');?></label>

            <div class="controls">

            	<select tabindex="14" class="input-xlarge" name="md_city2" id="mm_city_id2">

                <option value="">Select City</option>

                </select>

</br>
            <span class="help-inline"><?php echo form_error('md_city2'); ?></span>

            </div>

            </div>
            
            <div class="control-group <?php if(form_error('md_zip2')){ echo "error";}?>" style="float:left;width:auto;margin-left:65px;margin-bottom:0px;">

            <label class="control-label">Zip</label>

            <div class="controls">

            	<input class="" type="text" id="covers_cat_name" name="md_zip2" value="<?php echo set_value('md_zip2'); ?>" placeholder="Enter Zip Code">

</br>
            <span class="help-inline"><?php echo form_error('md_zip2'); ?></span>

            </div>

            </div>
    
    </div>
    
    <h3 style="font-size:15px;"><b style="border-bottom: 1px solid #000000;
    padding-bottom: 3px;">PERSONAL DOCTOR</b></h3>
    
    	<div class="control-group <?php if(form_error('md_dr_name3')){ echo "error";}?>" style="margin-bottom:0px;">

			<label class="control-label" for="inputError">Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_dr_name3" value="<?php echo set_value('md_dr_name3'); ?>" placeholder="Enter Name">
</br>
                    <span class="help-inline"><?php echo form_error('md_dr_name3'); ?></span>

                </div>

		</div>
        
    <div class="row">
    	<div class="control-group <?php if(form_error('md_dr_address3')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Address</label>
			
				<div class="controls">

                    <textarea class="input-xlarge" id="covers_cat_name" name="md_dr_address3" placeholder="Enter Address"><?php echo set_value('md_dr_address3'); ?></textarea>
</br>
                    <span class="help-inline"><?php echo form_error('md_dr_address3'); ?></span>

                </div>
       </div>    
        
        <div class="control-group <?php if(form_error('md_dr_phone3')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_dr_phone3" value="<?php echo set_value('md_dr_phone3'); ?>" placeholder="Enter home phone">
</br>
                    <span class="help-inline"><?php echo form_error('md_dr_phone3'); ?></span>

                </div>

		</div>    
    </div> 
    
    <div class="row">
    
    
    		<div class="control-group <?php if(form_error('md_dr_state3')){ echo "error";}?>" style="float:left;width:290px;;;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_state');?></label>

            <div class="controls">
				<div class="row">
            	<select tabindex="13" class="input-xlarge" name="md_dr_state3" id="mm_state_id3" style="width:270px;float:left">

                <!--/*edit*/-->

                <option value="">Please Select</option>

               <!-- /*edit*/-->

                <?php

					$get_states = $this->dbmedical->states();

					

					foreach($get_states as $get_states_row)

					{

						

						

						?>

                        <option <?php if(set_value('md_dr_state3') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>

                        <?php

						

					}

				?>

                </select>
                <span id="mm_state_id_loading3" class="loading" style="display:none;float:left;margin-top:5px;width:15px;margin-left:5px;"></span>
                </div>
</br>                

            <span class="help-inline"><?php echo form_error('md_dr_state3'); ?></span>

            </div>

            </div>
    
    
    		<div class="control-group <?php if(form_error('md_dr_city3')){ echo "error";}?>" style="float:left;width:auto;margin-left:45px;margin-bottom:0px;">

            <label class="control-label"><?php echo $this->lang->line('text_city');?></label>

            <div class="controls">

            	<select tabindex="14" class="input-xlarge" name="md_dr_city3" id="mm_city_id3">

                <option value="">Select City</option>

                </select>

</br>
            <span class="help-inline"><?php echo form_error('md_dr_city3'); ?></span>

            </div>

            </div>
            
            <div class="control-group <?php if(form_error('md_dr_zip3')){ echo "error";}?>" style="float:left;width:auto;margin-left:65px;margin-bottom:0px;">

            <label class="control-label">Zip</label>

            <div class="controls">

            	<input class="" type="text" id="covers_cat_name" name="md_dr_zip3" value="<?php echo set_value('md_dr_zip3'); ?>" placeholder="Enter Zip Code">

</br>
            <span class="help-inline"><?php echo form_error('md_dr_zip3'); ?></span>

            </div>

            </div>
    
    </div>      	
    
    <div class="space10px"></div>   
       
     <div class="row">  
       <div class="control-group <?php if(form_error('radio')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

            <label class="control-label" style="float:left">Are there any limitations in physical activities?</label>

            <div class="controls" style="float:left;margin-left:20px;">

            	<input class="" style="margin-top:-1px;" type="radio" id="" name="radio" value="1" checked="checked"> yes
                
                <input class="" style="margin-top:-1px;margin-left:5px;" type="radio" id="" name="radio" value="0"> No

</br>
            <span class="help-inline"><?php echo form_error('radio'); ?></span>

            </div>

     	</div>
    </div>
    
    <div class="row">  
       <div class="control-group <?php if(form_error('radio1')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

            <label class="control-label" style="float:left">Are you allergic to any food or medications?</label>

            <div class="controls" style="float:left;margin-left:20px;">

            	<input class="" style="margin-top:-1px;" type="radio" id="" name="radio1" value="1" checked="checked"> yes
                
                <input class="" style="margin-top:-1px;margin-left:5px;" type="radio" id="" name="radio1" value="0"> No

</br>
            <span class="help-inline"><?php echo form_error('radio1'); ?></span>

            </div>

     	</div>
    </div>  
    
    <div class="row">  
       <div class="control-group <?php if(form_error('radio2')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

            <label class="control-label" style="float:left"> Are you currently taking any medication? </label>

            <div class="controls" style="float:left;margin-left:20px;">

            	<input class="" style="margin-top:-1px;" type="radio" id="" name="radio2" value="1" checked="checked"> yes
                
                <input class="" style="margin-top:-1px;margin-left:5px;" type="radio" id="" name="radio2" value="0"> No

</br>
            <span class="help-inline"><?php echo form_error('radio2'); ?></span>

            </div>

     	</div>
    </div>  
    
    <div class="row">  
       <div class="control-group <?php if(form_error('radio3')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

            <label class="control-label" style="float:left">Is there any other medical information that should be disclosed in case of emergency?</label>

            <div class="controls" style="float:left;margin-left:20px;">

            	<input class="" style="margin-top:-1px;" type="radio" id="" name="radio3" value="1" checked="checked"> yes
                
                <input class="" style="margin-top:-1px;margin-left:5px;" type="radio" id="" name="radio3" value="0"> No

</br>
            <span class="help-inline"><?php echo form_error('radio3'); ?></span>

            </div>

     	</div>
    </div>              
        <div class="space10px"></div>
        
        <label class="control-label" style="">Name of Health Insurance Company & Policy Number</label>
        
   <div class="row">     
        <div class="control-group <?php if(form_error('md_insurance_cmp_name')){ echo "error";}?>" style="float:left;width:auto;margin-bottom:0px;">

			<label class="control-label" for="inputError">Company Name</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_insurance_cmp_name" value="<?php echo set_value('md_insurance_cmp_name'); ?>" placeholder="Enter home phone">
</br>
                    <span class="help-inline"><?php echo form_error('md_insurance_cmp_name'); ?></span>

                </div>

		</div>
        
        <div class="control-group <?php if(form_error('md_insurance_plc_no')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;margin-bottom:0px;">

			<label class="control-label" for="inputError">Policy Number</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="md_insurance_plc_no" value="<?php echo set_value('md_insurance_plc_no'); ?>" placeholder="Enter policy number">
</br>
                    <span class="help-inline"><?php echo form_error('md_insurance_plc_no'); ?></span>

                </div>

		</div>
    </div>    
        
       <?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="md_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="md_created_by" value="<?php echo 'admin';?>">

          

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

<script type="text/javascript">

/*$(document).ready(function() {

	$('#mm_state_id_loading').show();

	$.ajax({

	  url: BASE_URI+'user/get_city/<?php //echo $cur_user->mm_state_id;?>/<?php //echo $cur_user->mm_city_id;?>',

	  success: function(data) {

		$('#mm_city_id').html(data);

		$('#mm_state_id_loading').hide();

	  }

	});

	

});

	*/

$('#mm_state_id').change(function() {

	

	$('#mm_state_id_loading').show();

	

	$.ajax({

	  url: '<?php echo base_url()?>admincp_convention_texas/medical/get_city/'+$('#mm_state_id').val(),

	  success: function(data) {

		$('#mm_city_id').html(data);

		$('#mm_state_id_loading').hide();

	  }

	});

});

</script>






<script type="text/javascript">

/*$(document).ready(function() {

	$('#mm_state_id_loading1').show();

	$.ajax({

	  url: BASE_URI+'user/get_city/<?php //echo $cur_user->mm_state_id;?>/<?php //echo $cur_user->mm_city_id;?>',

	  success: function(data) {

		$('#mm_city_id1').html(data);

		$('#mm_state_id_loading1').hide();

	  }

	});

	

});*/

	

$('#mm_state_id1').change(function() {

	

	$('#mm_state_id_loading1').show();

	

	$.ajax({

	  url: '<?php echo base_url()?>admincp_convention_texas/medical/get_city/'+$('#mm_state_id1').val(),

	  success: function(data) {

		$('#mm_city_id1').html(data);

		$('#mm_state_id_loading1').hide();

	  }

	});

});

</script>







<script type="text/javascript">

/*$(document).ready(function() {

	$('#mm_state_id_loading2').show();

	$.ajax({

	  url: BASE_URI+'user/get_city/<?php //echo $cur_user->mm_state_id;?>/<?php //echo $cur_user->mm_city_id;?>',

	  success: function(data) {

		$('#mm_city_id2').html(data);

		$('#mm_state_id_loading2').hide();

	  }

	});

	

});*/

	

$('#mm_state_id2').change(function() {

	

	$('#mm_state_id_loading2').show();

	

	$.ajax({

	  url: '<?php echo base_url()?>admincp_convention_texas/medical/get_city/'+$('#mm_state_id2').val(),

	  success: function(data) {

		$('#mm_city_id2').html(data);

		$('#mm_state_id_loading2').hide();

	  }

	});

});

</script>






<script type="text/javascript">

/*$(document).ready(function() {

	$('#mm_state_id_loading3').show();

	$.ajax({

	  url: BASE_URI+'user/get_city/<?php //echo $cur_user->mm_state_id;?>/<?php //echo $cur_user->mm_city_id;?>',

	  success: function(data) {

		$('#mm_city_id3').html(data);

		$('#mm_state_id_loading3').hide();

	  }

	});

	

});*/

	

$('#mm_state_id3').change(function() {

	

	$('#mm_state_id_loading3').show();

	

	$.ajax({

	  url: '<?php echo base_url()?>admincp_convention_texas/medical/get_city/'+$('#mm_state_id3').val(),

	  success: function(data) {

		$('#mm_city_id3').html(data);

		$('#mm_state_id_loading3').hide();

	  }

	});

});

</script>






