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
            <?php $this->load->view('action_status'); ?>
            <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>
		<span class="span5">            
            <div class="control-group <?php if(form_error('mm_fname')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_fname');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_fname" name="mm_fname" placeholder="<?php echo $this->lang->line('text_fname');?>" value="<?php echo $user->mm_fname; ?>">
            <span class="help-inline"><?php echo form_error('mm_fname'); ?></span>
            </div>
            </div>    
            
            <?php /*?><div class="control-group <?php if(form_error('mm_father_name')){ echo "error";}?>">
            <label class="control-label">Father Name</label>
            <div class="controls">
            <input tabindex="3" class="input-xlarge" type="text" id="mm_father_name" name="mm_father_name" placeholder="Father's Name (First, Middle, Last)" value="<?php echo $user->mm_father_name; ?>">
            <span class="help-inline"><?php echo form_error('mm_father_name'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_original_surname')){ echo "error";}?>">
            <label class="control-label">Original Surname If last name is Patel</label>
            <div class="controls">
            <input tabindex="5" class="input-xlarge" type="text" id="mm_original_surname" name="mm_original_surname" placeholder="For wife, surname before marriage" value="<?php echo $user->mm_original_surname; ?>">
            <span class="help-inline"><?php echo form_error('mm_original_surname'); ?></span>
            </div>
            </div><?php */?>
            
            <div class="control-group <?php if(form_error('mm_lname')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_lname');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_lname" name="mm_lname" placeholder="<?php echo $this->lang->line('text_lname');?>" value="<?php echo $user->mm_lname; ?>">
            <span class="help-inline"><?php echo form_error('mm_lname'); ?></span>
            </div>
            </div>       

            <div class="control-group <?php if(form_error('mm_email')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_email');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_email" name="mm_email" placeholder="<?php echo $this->lang->line('text_email');?>" value="<?php echo $user->mm_email; ?>">
            <span class="help-inline"><?php echo form_error('mm_email'); ?></span>
            </div>
            </div>
            
            <?php /*?><div class="control-group <?php if(form_error('mm_cphone')){ echo "error";}?>">
            <label class="control-label"><?php echo $this->lang->line('text_mobile');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_cphone" name="mm_cphone" placeholder="<?php echo $this->lang->line('text_mobile');?>" value="<?php echo $user->mm_cphone; ?>">
            <span class="help-inline"><?php echo form_error('mm_cphone'); ?></span>
            </div>
            </div><?php */?>

           <?php /*?> <div class="control-group <?php if(form_error('mm_hphone')){ echo "error";}?>">
            <label class="control-label"><?php echo $this->lang->line('text_phone');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_hphone" name="mm_hphone" placeholder="<?php echo $this->lang->line('text_phone');?>" value="<?php echo $user->mm_hphone; ?>">
            <span class="help-inline"><?php echo form_error('mm_hphone'); ?></span>
            </div>
            </div><?php */?>
            
            <span class="span100 nomargin">
            <div class="control-group <?php if(form_error('mm_birth_month')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_birth_month');?></label>
            <div class="controls">
            	<select tabindex="11" class="input-small" name="mm_birth_month">
                	<option value="">Select</option>               
                	<option <?php if($user->mm_birth_month == 1){ echo 'selected="selected"';}?> value="1">Jan</option>
                    <option <?php if($user->mm_birth_month == 2){ echo 'selected="selected"';}?> value="2">Feb</option>
                    <option <?php if($user->mm_birth_month == 3){ echo 'selected="selected"';}?> value="3">Mar</option>
                    <option <?php if($user->mm_birth_month == 4){ echo 'selected="selected"';}?> value="4">Apr</option>
                    <option <?php if($user->mm_birth_month == 5){ echo 'selected="selected"';}?> value="5">May</option>
                    <option <?php if($user->mm_birth_month == 6){ echo 'selected="selected"';}?> value="6">Jun</option>
                    <option <?php if($user->mm_birth_month == 7){ echo 'selected="selected"';}?> value="7">Jul</option>
                    <option <?php if($user->mm_birth_month == 8){ echo 'selected="selected"';}?> value="8">Aug</option>
                    <option <?php if($user->mm_birth_month == 9){ echo 'selected="selected"';}?> value="9">Sep</option>
                    <option <?php if($user->mm_birth_month == 10){ echo 'selected="selected"';}?> value="10">Oct</option>
                    <option <?php if($user->mm_birth_month == 11){ echo 'selected="selected"';}?> value="11">Nov</option>
                    <option <?php if($user->mm_birth_month == 12){ echo 'selected="selected"';}?> value="12">Dec</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_birth_month'); ?></span>
            </div>
            </div>
            </span>
            
            <span class="span100 nomargin">
            <div class="control-group <?php if(form_error('mm_birth_year')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_birth_year');?></label>
            <div class="controls">
            <input tabindex="13" class="span1" type="text" id="mm_birth_year" name="mm_birth_year" placeholder="<?php echo $this->lang->line('text_birth_year');?>" value="<?php echo $user->mm_birth_year; ?>">
            <span class="help-inline"><?php echo form_error('mm_birth_year'); ?></span>
            </div>
            </div>
            </span>
            
            <span class="span100 nomargin">
            <div class="control-group <?php if(form_error('mm_gender')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_gender');?></label>
            <div class="controls">
            	<select tabindex="12" class="input-small" name="mm_gender">
                	<option value="">Select</option>     
                	<option <?php if($user->mm_gender == 0){ echo 'selected="selected"';}?> value="0">Male</option>
                    <option <?php if($user->mm_gender == 1){ echo 'selected="selected"';}?> value="1">Female</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_gender'); ?></span>
            </div>
            </div>
            </span>
            
          <?php /*?>  <div class="control-group <?php if(form_error('edu_qualification')){ echo "error";}?>">
            <label class="control-label">Education Qualification</label>
            <div class="controls">
            <input tabindex="16" class="input-xlarge" type="text" id="edu_qualification" name="edu_qualification" placeholder="Diagree" value="<?php echo $user->edu_qualification; ?>">
            <span class="help-inline"><?php echo form_error('edu_qualification'); ?></span>
            </div>
            </div><?php */?>
            
            <span class="span3 nomargin">
           <?php /*?> <div class="control-group">
            <label class="control-label"><?php echo $this->lang->line('text_photo');?></label>
            <div class="controls">
            <input type="hidden" name="old_photo" value="<?php echo $user->mm_photo; ?>" />

            <span>
            <?php if($user->mm_photo != ''){ ?>
            	<a rel="gallery" class="gallery" title="<?php echo $user->mm_fname.' '.$user->mm_lname;; ?>" href="<?php echo base_url('images/profile/big/'.$user->mm_photo); ?>"><img width="50" src="<?php echo base_url('images/profile/thumb/'.$user->mm_photo); ?>" class="img-rounded" /></a>
            <?php }else { ?>
            <img width="50" src="<?php echo base_url('images/profile/thumb/no_photo.jpg'); ?>" class="img-rounded" />
            <?php } ?>
            </span>

            <input type="file" name="mm_photo" title="Upload New Photo" /> <span class="help-inline"></span>
            </div>
            </div><?php */?>
            </span>
            
            
            <div class="clear"></div>
            <div class="control-group">
            <div class="controls">
            <input type="hidden" name="mm_id" value="<?php echo $user->mm_id; ?>" />
            <input type="submit" value="Save Changes" class="btn btn-primary" />
            </div>
            </div>

        </span>

        <span class="span5"> 
            
           <?php /*?> <div class="control-group <?php if(form_error('mm_mother_maiden_name')){ echo "error";}?>">
            <label class="control-label">Mother's Maiden Name</label>
            <div class="controls">
            <input tabindex="4" class="input-xlarge" type="text" id="mm_mother_maiden_name" name="mm_mother_maiden_name" placeholder="Mother's Maiden Name (First, Middle, Last)" value="<?php echo $user->mm_mother_maiden_name; ?>">
            <span class="help-inline"><?php echo form_error('mm_mother_maiden_name'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_hometown')){ echo "error";}?>">
            <label class="control-label">Hometown</label>
            <div class="controls">
            <input tabindex="6" class="input-xlarge" type="text" id="mm_hometown" name="mm_hometown" placeholder="Hometown / District in India" value="<?php echo $user->mm_hometown; ?>">
            <span class="help-inline"><?php echo form_error('mm_hometown'); ?></span>
            </div>
            </div><?php */?>
            
            <div class="control-group <?php if(form_error('mm_username')){ echo "error";}?>">
            <label class="control-label"><em>* </em>Username</label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_username" name="mm_username" placeholder="Username" value="<?php echo $user->mm_username; ?>">
            <span class="help-inline"><?php echo form_error('mm_username'); ?></span>
            </div>
            </div>

            <div class="control-group <?php if(form_error('mm_password')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_password');?></label>
            <div class="controls">
            <input class="input-xlarge" type="password" id="mm_password" name="mm_password" placeholder="Leave blank will not change password">
            <span class="help-inline"><?php echo form_error('mm_password'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_address')){ echo "error";}?>">
            <label class="control-label"><em>* </em>Address</label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="mm_address" name="mm_address" placeholder="Address" value="<?php echo $user->mm_address; ?>">
            <span class="help-inline"><?php echo form_error('mm_address'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_state_id')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_state');?></label>
            <div class="controls">
            	<select class="input-xlarge" name="mm_state_id" id="mm_state_id">
                <option>Please Select</option>
                <?php
					$get_states = $this->dbuser->states();
					foreach($get_states as $get_states_row)
					{
						?>
                        <option <?php if($get_states_row->state_id == $user->mm_state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                        <?php
					}
				?>

                </select>
            <span class="help-inline"><span id="mm_state_id_loading" class="loading" style="display:none;"></span><?php echo form_error('mm_state_id'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_city_id')){ echo "error";}?>">
            <label class="control-label"><em>* </em><?php echo $this->lang->line('text_city');?></label>
            <div class="controls">
            	<select class="input-xlarge" name="mm_city_id" id="mm_city_id">
                <option>Select City</option>
                </select>
            <span class="help-inline"><?php echo form_error('mm_city_id'); ?></span>
            </div>
            </div>
            
           <?php /*?> <div class="control-group <?php if(form_error('occupation_id')){ echo "error";}?>">
            <label class="control-label">Occupation</label>
            <div class="controls">
            	<select tabindex="14" class="input-xlarge" name="occupation_id" id="occupation_id">
                <option>Please Select</option>
                <?php
					$occupations = $this->db->get('occupations');
					foreach($occupations->result() as $occupation_row)
					{
						?>
                        <option <?php if($user->occupation_id == $occupation_row->occupation_id){ echo 'selected="selected"';}?> value="<?php echo $occupation_row->occupation_id; ?>"><?php echo $occupation_row->occupation_name; ?></option>
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
            <input tabindex="17" class="input-xlarge" type="text" id="univercity_college_name" name="univercity_college_name" placeholder="Univercity &amp; College Name" value="<?php echo $user->univercity_college_name; ?>">
            <span class="help-inline"><?php echo form_error('univercity_college_name'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('mm_life_id')){ echo "error";}?>">
            <label class="control-label">Life Member Number</label>
            <div class="controls">
            <input tabindex="18" class="input-xlarge" type="text" id="mm_life_id" name="mm_life_id" placeholder="Life Member Number" value="<?php echo $user->mm_life_id; ?>">
            <span class="help-inline"><?php echo form_error('mm_life_id'); ?></span>
            </div>
            </div>
            
            <span class="span3 nomargin">
            <div class="control-group <?php if(form_error('mm_disp_dir')){ echo "error";}?>">
            <label class="checkbox">
                <input <?php if($user->mm_disp_dir == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_dir" value="1" /> Display Profile In SPCS Directory
            </label>
            </div>
            </span>
            
            <span class="span3 nomargin">
            <div class="control-group <?php if(form_error('mm_disp_birth')){ echo "error";}?>">
            <label class="checkbox">
                <input <?php if($user->mm_disp_birth == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_birth" value="1" /> Show Birth Date in Profile
            </label>
            </div>
            </span><?php */?>
           
            
                
        </span>
                    	
        </div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
      
        <?php $this->load->view('ads_panel'); ?>
          <div class="space20px"></div>
          
    </div>
</div>

</div></div>

<script type="text/javascript">
$(document).ready(function() {
	$('#mm_state_id_loading').show();
	$.ajax({
	  url: BASE_URI+'user/get_city/<?php echo $user->mm_state_id;?>/<?php echo $user->mm_city_id;?>',
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
<?php $this->load->view('footer'); ?>