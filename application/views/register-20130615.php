<?php $this->load->view('header'); ?>

<div class="container">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
</div>

<hr class="header_hr"/>
<div class="container">
	<div class="row">

<div class="span10" style="margin:-10px 0 0 0;">
			<div class="page_content">
            <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>
		<span class="span5">            
            <div class="control-group <?php if(form_error('mm_fname')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_fname');?></label>
            <div class="controls">
            <input tabindex="1" class="input-xlarge" type="text" id="mm_fname" name="mm_fname" placeholder="<?php echo $this->lang->line('text_fname');?>" value="<?php echo set_value('mm_fname'); ?>">
            <span class="help-inline"><?php echo form_error('mm_fname'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_father_name')){ echo "error";}?>">
            <label class="control-label">Father Name</label>
            <div class="controls">
            <input tabindex="3" class="input-xlarge" type="text" id="mm_father_name" name="mm_father_name" placeholder="Father's Name (First, Middle, Last)" value="<?php echo set_value('mm_father_name'); ?>">
            <span class="help-inline"><?php echo form_error('mm_father_name'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_original_surname')){ echo "error";}?>">
            <label class="control-label">Original Surname If last name is Patel</label>
            <div class="controls">
            <input tabindex="5" class="input-xlarge" type="text" id="mm_original_surname" name="mm_original_surname" placeholder="For wife, surname before marriage" value="<?php echo set_value('mm_original_surname'); ?>">
            <span class="help-inline"><?php echo form_error('mm_original_surname'); ?></span>
            </div>
            </div>

           <div class="control-group <?php if(form_error('mm_username')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_username');?></label>
            <div class="controls">
            <input tabindex="7" class="input-xlarge" type="text" id="mm_username" name="mm_username" placeholder="<?php echo $this->lang->line('text_username');?>" value="<?php echo set_value('mm_username'); ?>">
            <span class="help-inline"><?php echo form_error('mm_username'); ?></span>
            </div>
            </div>

            <div class="control-group <?php if(form_error('mm_email')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_email');?></label>
            <div class="controls">
            <input tabindex="9" class="input-xlarge" type="text" id="mm_email" name="mm_email" placeholder="<?php echo $this->lang->line('text_email');?>" value="<?php echo set_value('mm_email'); ?>">
            <span class="help-inline"><?php echo form_error('mm_email'); ?></span>
            </div>
            </div>

            <div class="control-group <?php if(form_error('mm_hphone')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_phone');?></label>
            <div class="controls">
            <input tabindex="11" class="input-xlarge" type="text" id="mm_hphone" name="mm_hphone" placeholder="<?php echo $this->lang->line('text_phone');?>" value="<?php echo set_value('mm_hphone'); ?>">
            <span class="help-inline"><?php echo form_error('mm_hphone'); ?></span>
            </div>
            </div>

            <div class="control-group <?php if(form_error('mm_state_id')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_state');?></label>
            <div class="controls">
            	<select tabindex="13" class="input-xlarge" name="mm_state_id" id="mm_state_id">
                <option>Please Select</option>
                <?php
					$get_states = $this->dbuser->states();
					if($this->uri->segment(3)){
						$cur_user = $this->dbheader->user_details_by_id($this->uri->segment(3));
					}
					foreach($get_states as $get_states_row)
					{
						if($this->uri->segment(3)){
						
							if($cur_user)
							{
							?>
                            <option <?php if($cur_user->mm_state_id == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                            <?php
							}
							else
							{
							?>
                            <option <?php if(set_value('mm_state_id') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                            <?php
							}
						}
						else
						{
						?>
                        <option <?php if(set_value('mm_state_id') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                        <?php
						}
					}
				?>
                </select>
            <span class="help-inline"><span id="mm_state_id_loading" class="loading" style="display:none;"></span><?php echo form_error('mm_state_id'); ?></span>
            </div>
            </div>

            <span class="span100 nomargin">
            <div class="control-group <?php if(form_error('mm_birth_month')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_birth_month');?></label>
            <div class="controls">
            	<select tabindex="15" class="input-small" name="mm_birth_month">
                	<option value="">Select</option>               
                	<option <?php if(set_value('mm_birth_month') == 1){ echo 'selected="selected"';}?> value="1">Jan</option>
                    <option <?php if(set_value('mm_birth_month') == 2){ echo 'selected="selected"';}?> value="2">Feb</option>
                    <option <?php if(set_value('mm_birth_month') == 3){ echo 'selected="selected"';}?> value="3">Mar</option>
                    <option <?php if(set_value('mm_birth_month') == 4){ echo 'selected="selected"';}?> value="4">Apr</option>
                    <option <?php if(set_value('mm_birth_month') == 5){ echo 'selected="selected"';}?> value="5">May</option>
                    <option <?php if(set_value('mm_birth_month') == 6){ echo 'selected="selected"';}?> value="6">Jun</option>
                    <option <?php if(set_value('mm_birth_month') == 7){ echo 'selected="selected"';}?> value="7">Jul</option>
                    <option <?php if(set_value('mm_birth_month') == 8){ echo 'selected="selected"';}?> value="8">Aug</option>
                    <option <?php if(set_value('mm_birth_month') == 9){ echo 'selected="selected"';}?> value="9">Sep</option>
                    <option <?php if(set_value('mm_birth_month') == 10){ echo 'selected="selected"';}?> value="10">Oct</option>
                    <option <?php if(set_value('mm_birth_month') == 11){ echo 'selected="selected"';}?> value="11">Nov</option>
                    <option <?php if(set_value('mm_birth_month') == 12){ echo 'selected="selected"';}?> value="12">Dec</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_birth_month'); ?></span>
            </div>
            </div>
            </span>

            <span class="span100 nomargin">
            <div class="control-group <?php if(form_error('mm_birth_year')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_birth_year');?></label>
            <div class="controls">
            <input tabindex="16" class="span1" type="text" id="mm_birth_year" name="mm_birth_year" placeholder="Year" value="<?php echo set_value('mm_birth_year'); ?>">
            <span class="help-inline"><?php echo form_error('mm_birth_year'); ?></span>
            </div>
            </div>
            </span>
            
            <span class="span2 nomargin">
             <?php
				if(!isset($cur_user))
				{
			?>
            <input type="hidden" tabindex="17" name="mm_relationship" value="" />
            <div class="control-group <?php if(form_error('mm_gender')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_gender');?></label>
            <div class="controls">
            	<select tabindex="18" class="input-small" name="mm_gender">
                	<option value="">Select</option>     
                	<option <?php if(set_value('mm_gender') == 0){ echo 'selected="selected"';}?> value="0">Male</option>
                    <option <?php if(set_value('mm_gender') == 1){ echo 'selected="selected"';}?> value="1">Female</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_gender'); ?></span>
            </div>
            </div>
			<?php } else { ?>
            <div class="control-group <?php if(form_error('mm_relationship')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_relationship');?></label>
            <div class="controls">
            	<select tabindex="17" class="input-small" name="mm_relationship">
                	<option value="">Select</option>
                	<?php if($cur_user->mm_gender == 0) {?>
                    <option <?php if(set_value('mm_relationship') == 'Wife'){ echo 'selected="selected"';}?> value="Wife">Wife</option>
                    <?php } else { ?>
                    <option <?php if(set_value('mm_relationship') == 'Husband'){ echo 'selected="selected"';}?> value="Husband">Husband</option>
                    <?php } ?>
                    <option <?php if(set_value('mm_relationship') == 'Father'){ echo 'selected="selected"';}?> value="Father">Father</option>
                    <option <?php if(set_value('mm_relationship') == 'Mother'){ echo 'selected="selected"';}?> value="Mother">Mother</option>
                    <option <?php if(set_value('mm_relationship') == 'Brother'){ echo 'selected="selected"';}?> value="Brother">Brother</option>
                    <option <?php if(set_value('mm_relationship') == 'Sister'){ echo 'selected="selected"';}?> value="Sister">Sister</option>
                    <option <?php if(set_value('mm_relationship') == 'Son'){ echo 'selected="selected"';}?> value="Son">Son</option>
                    <option <?php if(set_value('mm_relationship') == 'Daughter'){ echo 'selected="selected"';}?> value="Daughter">Daughter</option>
              </select>
            <span class="help-inline"><?php echo form_error('mm_relationship'); ?></span>
            </div>
            </div>
            <?php } ?>
            </span>
            
            <div class="control-group <?php if(form_error('edu_qualification')){ echo "error";}?>">
            <label class="control-label">Education Qualification</label>
            <div class="controls">
            <input tabindex="19" class="input-xlarge" type="text" id="edu_qualification" name="edu_qualification" placeholder="Academic Degree" value="<?php echo set_value('edu_qualification'); ?>">
            <span class="help-inline"><?php echo form_error('edu_qualification'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_life_id')){ echo "error";}?>">
            <label class="control-label">Life Member Number</label>
            <div class="controls">
            <input tabindex="21" class="input-xlarge" type="text" id="mm_life_id" name="mm_life_id" placeholder="Life Member Number" value="<?php echo set_value('mm_life_id'); ?>">
            <span class="help-inline"><?php echo form_error('mm_life_id'); ?></span>
            </div>
            </div>
            
            <div class="clear"></div>
            <div class="control-group">
            <div class="controls">
            <input type="hidden" name="mm_family_id" value="<?php if(isset($mm_family_id)){ echo $mm_family_id; }else{ echo '0';} ?>" />
            <input type="submit" value="<?php echo $this->lang->line('btn_register');?>" class="btn btn-large btn-primary" />
            </div>
            </div>
            
        </span>

        <span class="span5"> 

            <div class="control-group <?php if(form_error('mm_lname')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_lname');?></label>
            <div class="controls">
            <input tabindex="2" class="input-xlarge" type="text" id="mm_lname" name="mm_lname" placeholder="<?php echo $this->lang->line('text_lname');?>" value="<?php echo set_value('mm_lname'); ?>">
            <span class="help-inline"><?php echo form_error('mm_lname'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_mother_maiden_name')){ echo "error";}?>">
            <label class="control-label">Mother's Maiden Name</label>
            <div class="controls">
            <input tabindex="4" class="input-xlarge" type="text" id="mm_mother_maiden_name" name="mm_mother_maiden_name" placeholder="Mother's Maiden Name (First, Middle, Last)" value="<?php echo set_value('mm_mother_maiden_name'); ?>">
            <span class="help-inline"><?php echo form_error('mm_mother_maiden_name'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_hometown')){ echo "error";}?>">
            <label class="control-label">Hometown</label>
            <div class="controls">
            <input tabindex="6" class="input-xlarge" type="text" id="mm_hometown" name="mm_hometown" placeholder="Hometown / District in India" value="<?php if(isset($cur_user)){echo $cur_user->mm_hometown;}else{echo set_value('mm_hometown');} ?>">
            <span class="help-inline"><?php echo form_error('mm_hometown'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_password')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_password');?></label>
            <div class="controls">
            <input tabindex="8" class="input-xlarge" type="password" id="mm_password" name="mm_password" placeholder="<?php echo $this->lang->line('text_password');?>" value="<?php echo set_value('mm_password'); ?>">
            <span class="help-inline"><?php echo form_error('mm_password'); ?></span>
            </div>
            </div>
           
            <div class="control-group <?php if(form_error('mm_address')){ echo "error";}?>">
            <label class="control-label"><?php echo $this->lang->line('text_address');?></label>
            <div class="controls">
            <input tabindex="10" class="input-xlarge" type="text" id="mm_address" name="mm_address" placeholder="<?php echo $this->lang->line('text_address');?>" value="<?php if(isset($cur_user)){echo $cur_user->mm_address;}else{echo set_value('mm_address');} ?>">
            <span class="help-inline"><?php echo form_error('mm_address'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_cphone')){ echo "error";}?>">
            <label class="control-label"><?php echo $this->lang->line('text_mobile');?></label>
            <div class="controls">
            <input tabindex="12" class="input-xlarge" type="text" id="mm_cphone" name="mm_cphone" placeholder="<?php echo $this->lang->line('text_mobile');?>" value="<?php echo set_value('mm_cphone'); ?>">
            <span class="help-inline"><?php echo form_error('mm_cphone'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_city_id')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_city');?></label>
            <div class="controls">
            	<select tabindex="14" class="input-xlarge" name="mm_city_id" id="mm_city_id">
                <option>Select City</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_city_id'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('occupation_id')){ echo "error";}?>">
            <label class="control-label">Occupation</label>
            <div class="controls">
            	<select tabindex="18" class="input-xlarge" name="occupation_id" id="occupation_id">
                <option>Please Select</option>
                <?php
					$occupations = $this->db->get('occupations');
					foreach($occupations->result() as $occupation_row)
					{
						?>
                        <option <?php if(set_value('occupation_id') == $occupation_row->occupation_id){ echo 'selected="selected"';}?> value="<?php echo $occupation_row->occupation_id; ?>"><?php echo $occupation_row->occupation_name; ?></option>
                        <?php
					}
				?>
                </select>
            <span class="help-inline"><span id="mm_state_id_loading" class="loading" style="display:none;"></span><?php echo form_error('occupation_id'); ?></span>
            </div>
            </div>
            
             <div class="control-group <?php if(form_error('univercity_college_name')){ echo "error";}?>">
            <label class="control-label">Univercity/College </label>
            <div class="controls">
            <input tabindex="20" class="input-xlarge" type="text" id="univercity_college_name" name="univercity_college_name" placeholder="Univercity &amp; College Name" value="<?php echo set_value('univercity_college_name'); ?>">
            <span class="help-inline"><?php echo form_error('univercity_college_name'); ?></span>
            </div>
            </div>

            <span class="span3 nomargin">
            <div class="control-group">
            <label class="control-label"><?php echo $this->lang->line('text_photo');?></label>
            <div class="controls">
            <input  tabindex="22" type="file" name="mm_photo" title="Select Photo" /> <span class="help-inline"></span>
            </div>
            </div>
            </span>
            
            <span class="span3 nomargin">
            <div class="control-group <?php if(form_error('mm_disp_dir')){ echo "error";}?>">
            <label class="checkbox">
                <input tabindex="23"  <?php if(set_value('mm_disp_dir') == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_dir" value="1" /> Display Profile In SPCS Directory
            </label>
            </div>
            </span>
            
            <span class="span3 nomargin">
            <div class="control-group <?php if(form_error('mm_disp_birth')){ echo "error";}?>">
            <label class="checkbox">
                <input tabindex="24" <?php if(set_value('mm_disp_birth') == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_birth" value="1"/> Show Birth Date in Profile
            </label>
            </div>
            </span>
            
        </span>

        </div>

</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
    	<?php if(!isset($cur_user)) {?>
        <div class="bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
                    <li <?php if($this->uri->segment(2) == 'register'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/register.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_register');?></a></li>

                    <li <?php if($this->uri->segment(2) == 'login'){ ?>class="active"<?php } ?>><a href="<?php echo base_url('user/login.html'); ?>"><i class="icon-chevron-left"></i> <?php echo $this->lang->line('btn_login');?></a></li>

            </ul>
        </div>
        <?php }else { ?>
        <?php $this->load->view('member_menu'); ?>
        <?php } ?>
        
        <div class="space20px"></div>
        <?php
		if(isset($user->mm_type) && $user->mm_type == 1)
		{
			
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>

</div>

</div></div>
<?php if($this->uri->segment(3)){ ?>
<script type="text/javascript">
$(document).ready(function() {
	$('#mm_state_id_loading').show();
	$.ajax({
	  url: BASE_URI+'user/get_city/<?php echo $cur_user->mm_state_id;?>/<?php echo $cur_user->mm_city_id;?>',
	  success: function(data) {
		$('#mm_city_id').html(data);
		$('#mm_state_id_loading').hide();
	  }
	});
	
});
	
$('#mm_state_id').change(function() {
	
	$('#mm_state_id_loading').show();
	
	$.ajax({
	  url: BASE_URI+'user/get_city/'+$('#mm_state_id').val(),
	  success: function(data) {
		$('#mm_city_id').html(data);
		$('#mm_state_id_loading').hide();
	  }
	});
});
</script>

<?php } ?>
<script type="text/javascript">
$('#mm_state_id').change(function() {

	$('#mm_state_id_loading').show();

	$.ajax({
	  url: BASE_URI+'user/get_city/'+$('#mm_state_id').val(),
	  success: function(data) {
		$('#mm_city_id').html(data);
		$('#mm_state_id_loading').hide();
	  }
	});
});
</script>
<?php $this->load->view('footer'); ?>