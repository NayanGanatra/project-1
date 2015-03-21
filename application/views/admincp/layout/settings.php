<?php $this->load->view('admincp/layout/header'); ?>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_settings');?> <small><?php echo $this->lang->line('text_general_settings');?></small></h1>
		</div>
<?php $settings = $this->dbadminheader->getsettings(); ?>
            <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>
            <legend></legend>
            <div class="control-group <?php if(form_error('sitename')){ echo "error";}?>">
            <label class="control-label" for="inputsitename"><?php echo $this->lang->line('text_site_title');?></label>
            <div class="controls">
            <input class="input-xxlarge" type="text" id="sitename" name="sitename" placeholder="<?php echo $this->lang->line('text_site_title');?>" value="<?php echo $settings->sitename; ?>">
            <span class="help-inline"><?php echo form_error('sitename'); ?></span>
            </div>
            </div>
                        
            <div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">
            <label class="control-label" for="inputkeywords"><?php echo $this->lang->line('text_meta_keywords');?></label>
            <div class="controls">
            <input class="input-xxlarge" type="text" id="keywords" name="keywords" placeholder="<?php echo $this->lang->line('text_meta_keywords');?>" value="<?php echo $settings->keywords; ?>">
            <span class="help-inline"><?php echo form_error('keywords'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('description')){ echo "error";}?>">
            <label class="control-label" for="inputdescription"><?php echo $this->lang->line('text_meta_description');?></label>
            <div class="controls">
            <textarea class="input-xxlarge" type="text" id="description" name="description" placeholder="<?php echo $this->lang->line('text_meta_description');?>"><?php echo $settings->description; ?></textarea>
            <span class="help-inline"><?php echo form_error('description'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('tracking')){ echo "error";}?>">
            <label class="control-label" for="inputtracking"><?php echo $this->lang->line('text_analytics_code');?></label>
            <div class="controls">
            <textarea class="input-xxlarge" type="text" id="tracking" name="tracking" placeholder="<?php echo $this->lang->line('text_analytics_code');?>"><?php echo $settings->tracking; ?></textarea>
            <span class="help-inline"><?php echo form_error('tracking'); ?></span>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('email')){ echo "error";}?>">
            <label class="control-label" for="inputemail"><?php echo $this->lang->line('text_email');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="email" name="email" placeholder="<?php echo $this->lang->line('text_email');?>" value="<?php echo $settings->email; ?>">
            <span class="help-inline"><?php echo form_error('email'); ?></span>
            </div>
            </div>
            
            <div class="control-group">
            <label class="control-label" for="inputtracking"><?php echo $this->lang->line('text_logo');?></label>
            <div class="controls">
            <input type="file" name="logo" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline"><img src="<?php echo base_url();?>images/<?php echo $settings->logo;?>" /></span>
                <input type="hidden" name="old_logo" value="<?php echo $settings->logo; ?>" />
            </div>
            </div>
            
            <div class="control-group">
            <label class="control-label" for="inputtracking"><?php echo $this->lang->line('text_favicon');?></label>
            <div class="controls">
            <input type="file" name="favicon" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline"><img src="<?php echo base_url();?>images/<?php echo $settings->favicon;?>" /></span>
            <input type="hidden" name="old_favicon" value="<?php echo $settings->favicon; ?>" />
            </div>
            </div>            
            
            <div class="control-group">
            <label class="control-label" for="inputsitename"><?php echo $this->lang->line('text_sharethis_id');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="sharethis_id" name="sharethis_id" placeholder="<?php echo $this->lang->line('text_sharethis_id');?>" value="<?php echo $settings->sharethis_id; ?>"><?php echo $this->lang->line('text_sharethis_help');?>
            </div>
            </div>
            
            <div class="control-group">
            <div class="controls">
            <input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn btn-large btn-primary" />
            </div>
            </div>
            </form>

</div>
	</td></tr></table>
<?php $this->load->view('admincp/layout/footer'); ?>