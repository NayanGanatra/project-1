<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="min_height">

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>



        <div class="dotted_line">

		        <h1><?php echo $this->lang->line('text_users');?> <small><?php echo $this->lang->line('text_edit');?></small></h1>

		</div>

        <hr>

        

            <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>

		<span class="span5">            

            <div class="control-group <?php if(form_error('mm_fname')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_fname');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_fname" name="mm_fname" placeholder="<?php echo $this->lang->line('text_fname');?>" value="<?php echo $user->mm_fname; ?>">

            <span class="help-inline"><?php echo form_error('mm_fname'); ?></span>

            </div>

            </div> 

            

            <div class="control-group <?php if(form_error('mm_lname')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_lname');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_lname" name="mm_lname" placeholder="<?php echo $this->lang->line('text_lname');?>" value="<?php echo $user->mm_lname; ?>">

            <span class="help-inline"><?php echo form_error('mm_lname'); ?></span>

            </div>

            </div>          

            

            <div class="control-group <?php if(form_error('mm_email')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_email');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_email" name="mm_email" placeholder="<?php echo $this->lang->line('text_email');?>" value="<?php echo $user->mm_email; ?>">

            <span class="help-inline"><?php echo form_error('mm_email'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('mm_cphone')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_mobile');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_cphone" name="mm_cphone" placeholder="<?php echo $this->lang->line('text_mobile');?>" value="<?php echo $user->mm_cphone; ?>">

            <span class="help-inline"><?php echo form_error('mm_cphone'); ?></span>

            </div>

            </div>



            <div class="control-group <?php if(form_error('mm_hphone')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_phone');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_hphone" name="mm_hphone" placeholder="<?php echo $this->lang->line('text_phone');?>" value="<?php echo $user->mm_hphone; ?>">

            <span class="help-inline"><?php echo form_error('mm_hphone'); ?></span>

            </div>

            </div>

            

            

            <span class="span3 nomargin">

            <div class="control-group">

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

            </div>

            </span>

            

            

            <div class="control-group <?php if(form_error('mm_status')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_Status');?></label>

            <div class="controls">

            	<select class="mm_status" name="mm_status">

                	<option <?php if($user->mm_status == '1'){ echo 'selected="selected"'; } ?> value="1" >Active</option>

                    <option <?php if($user->mm_status == '0'){ echo 'selected="selected"'; } ?>  value="0">Inactive</option>

                </select>

            <span class="help-inline"><?php echo form_error('mm_status'); ?></span>

            </div>

            </div>

            

              

            <div class="clear"></div>

            <div class="control-group">

            <div class="controls">

            <input type="hidden" name="mm_id" value="<?php echo $user->mm_id; ?>" />

            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-primary" />

            </div>

            </div>

            

        </span>

        

        <span class="span5"> 

            

            <div class="control-group <?php if(form_error('mm_username')){ echo "error";}?>">

            <label class="control-label">Username</label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_username" name="mm_username" placeholder="Username" value="<?php echo $user->mm_username; ?>">

            <span class="help-inline"><?php echo form_error('mm_username'); ?></span>

            </div>

            </div>



            <div class="control-group <?php if(form_error('mm_password')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_password');?></label>

            <div class="controls">

            <input class="input-xlarge" type="password" id="mm_password" name="mm_password" placeholder="Leave blank will not change password">

            <span class="help-inline"><?php echo form_error('mm_password'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('mm_address')){ echo "error";}?>">

            <label class="control-label">Address</label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="mm_address" name="mm_address" placeholder="Address" value="<?php echo $user->mm_address; ?>">

            <span class="help-inline"><?php echo form_error('mm_address'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('mm_state_id')){ echo "error";}?>">

            <label class="control-label"><?php echo $this->lang->line('text_state');?></label>

            <div class="controls">

            	<select class="input-xlarge" name="mm_state_id" id="mm_state_id">

                <option>Select State</option>

                <?php

					$get_states = $this->dbadminheader->states();

					

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

            <label class="control-label"><?php echo $this->lang->line('text_city');?></label>

            <div class="controls">

            	<select class="input-xlarge" name="mm_city_id" id="mm_city_id">

                

                </select>

            <span class="help-inline"><?php echo form_error('mm_city'); ?></span>

            </div>

            </div>

            

            <div>

            <span class="span5 nomargin">

            <div class="control-group <?php if(form_error('mm_disp_dir')){ echo "error";}?>">

            <label class="checkbox">

                <input <?php if($user->mm_disp_dir == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_dir" value="1" /> Display Profile In SPCS Directory



            </label>

            </div>

            </span>

            </div>

            

            <span class="span5 nomargin">

            <div class="control-group <?php if(form_error('mm_disp_birth')){ echo "error";}?>">

            <label class="checkbox">

                <input <?php if($user->mm_disp_birth == 1 ){ echo 'checked="checked"';}?> type="checkbox" name="mm_disp_birth" value="1" /> Show Birth Date in Profile

            </label>

            </div>

            </span>

            

            <div class="control-group <?php if(form_error('chapter')){ echo "error";}?>" style="display:none">

            <label class="control-label">Select Chapter to Assign Chapter Admin</label>

            <div class="controls">

            	<select class="input-xlarge" name="chapter" id="chapter">

                <option value="0">None</option>

                <?php

					$chapters = $this->dbadminheader->get_chapters();

					

					foreach($chapters as $chapters_row)

					{

						if($chapters_row->ch_id !=0)

						{

						?>

                        <option <?php if($chapters_row->ch_id == $user->mm_chapter_id){ echo 'selected="selected"';}?>  value="<?php echo $chapters_row->ch_id;?>"><?php echo $chapters_row->ch_name;?></option>

                        <?php

						}

					}

				?>

                </select>

            <span class="help-inline"><?php echo form_error('chapter'); ?></span>

            </div>

            </div>

                

        </span>

                    	

        

	</td></tr></table>

    

<script type="text/javascript">



$(document).ready(function() {



	$('#mm_state_id_loading').show();

	$.ajax({

	  url: BASE_URI+'chapteradmincp/user/get_city/<?php echo $user->mm_state_id;?>/<?php echo $user->mm_city_id;?>',

	  success: function(data) {

		$('#mm_city_id').html(data);

		$('#mm_state_id_loading').hide();

	  }

	});

	

});



$('#mm_state_id').change(function() {

	

	$('#mm_state_id_loading').show();

	

	$.ajax({

	  url: BASE_URI+'chapteradmincp/user/get_city/'+$('#mm_state_id').val(),

	  success: function(data) {

		$('#mm_city_id').html(data);

		$('#mm_state_id_loading').hide();

	  }

	});

});

</script>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>