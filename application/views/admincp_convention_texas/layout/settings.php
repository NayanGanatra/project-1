<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1><?php echo $this->lang->line('text_settings');?> <small><?php echo $this->lang->line('text_general_settings');?></small></h1>

		</div>

<?php //$settings = $this->dbadminheader->getsettings(); ?>

            <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>

            <legend></legend>

            <div class="control-group <?php if(form_error('sitename')){ echo "error";}?>">

            <label class="control-label" for="inputsitename"><?php echo $this->lang->line('text_site_title');?></label>

            <div class="controls">

            <input class="input-xxlarge" type="text" id="sitename" name="sitename" placeholder="<?php echo $this->lang->line('text_site_title');?>" value="<?php echo $settings->cs_sitename; ?>">

            <span class="help-inline"><?php echo form_error('sitename'); ?></span>

            </div>

            </div>

                        

            <div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">

            <label class="control-label" for="inputkeywords"><?php echo $this->lang->line('text_meta_keywords');?></label>

            <div class="controls">

            <input class="input-xxlarge" type="text" id="keywords" name="keywords" placeholder="<?php echo $this->lang->line('text_meta_keywords');?>" value="<?php echo $settings->cs_keywords; ?>">

            <span class="help-inline"><?php echo form_error('keywords'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('description')){ echo "error";}?>">

            <label class="control-label" for="inputdescription"><?php echo $this->lang->line('text_meta_description');?></label>

            <div class="controls">

            <textarea class="input-xxlarge" type="text" id="description" name="description" placeholder="<?php echo $this->lang->line('text_meta_description');?>"><?php echo $settings->cs_description; ?></textarea>

            <span class="help-inline"><?php echo form_error('description'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('tracking')){ echo "error";}?>">

            <label class="control-label" for="inputtracking"><?php echo $this->lang->line('text_analytics_code');?></label>

            <div class="controls">

            <textarea class="input-xxlarge" type="text" id="tracking" name="tracking" placeholder="<?php echo $this->lang->line('text_analytics_code');?>"><?php echo $settings->cs_tracking; ?></textarea>

            <span class="help-inline"><?php echo form_error('tracking'); ?></span>

            </div>

            </div>

            

            <div class="control-group <?php if(form_error('email')){ echo "error";}?>">

            <label class="control-label" for="inputemail"><?php echo $this->lang->line('text_email');?></label>

            <div class="controls">

            <input class="input-xlarge" type="text" id="email" name="email" placeholder="<?php echo $this->lang->line('text_email');?>" value="<?php echo $settings->cs_email; ?>">

            <span class="help-inline"><?php echo form_error('email'); ?></span>

            </div>

            </div>

            

            <div class="control-group">

            <label class="control-label" for="inputtracking">Spcs Logo</label>

            <div class="controls">

            <input type="file" name="logo" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline"><img src="<?php echo base_url();?>images/spcs_convention/<?php echo $settings->cs_logo;?>" /></span>

                <input type="hidden" name="old_logo" value="<?php echo $settings->cs_logo; ?>" />

            </div>

            </div>

              <div class="control-group">

            <label class="control-label" for="inputtracking">Convention Logo</label>

            <div class="controls">

            <input type="file" name="logo1" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline"><img src="<?php echo base_url();?>images/spcs_convention/<?php echo $settings->cs_logo2;?>" /></span>

                <input type="hidden" name="old_logo1" value="<?php echo $settings->cs_logo2; ?>" />

            </div>

            </div>

           <?php /*?><div class="control-group">

            <label class="control-label" for="inputtracking"><?php echo $this->lang->line('text_favicon');?></label>

            <div class="controls">

            <input type="file" name="favicon" title="<?php echo $this->lang->line('text_browse');?>" id="favicon"/> <span class="help-inline"><img src="<?php echo base_url();?>images/<?php echo $settings->cs_favicon;?>" /></span>

            <input type="hidden" name="old_favicon" value="<?php echo $settings->cs_favicon; ?>" />
            
              <span class="help-inline"><?php echo form_error('favicon'); ?></span>

            </div>
            </div>            
			<?php */?>
            <div class="control-group <?php if(form_error('cs_ch_id')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Chapter</label>
                <div class="controls">
                <select name="cs_ch_id" id="cs_ch_id">
                    	<option value="">Select Chapter</option>
                    	<?php
						$get_chapters = $this->dbsettings->get_chapters();
						foreach($get_chapters as $get_chapters_row)
						{
							?>
                            <option <?php if($get_chapters_row->ch_name == $settings->ch_name){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_name; ?>"><?php echo $get_chapters_row->ch_name; ?></option>
                            <?php
						}
						?>
                </select>
                <span class="help-inline"> <?php echo form_error('cs_ch_id'); ?></span>
                </div>
           	</div>
            <div class="space10px"></div>
            <div class="control-group <?php if(form_error('year')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Convention Year</label>
                <div class="controls">
                    <select name="year" id="year">
                        <optgroup style="max-height: 200px;">
                        <option value="" >Select Year</option>
                        <?php for($i=date("Y")-3;$i<date("Y")+18; $i++)
                        {?>
                        <option  <?php if($i== $settings->ch_year){echo 'selected="selected"'; }?> value="<?php echo $i;?>" ><?php echo $i;?></option>  
                        <?php 
						}?>
                        </optgroup>
                    </select>
                   <span class="help-inline"> <?php echo form_error('year'); ?></span>
                </div>
           	</div>
			<div class="space10px"></div>   
            <div class="control-group">
            <label class="control-label" for="inputsitename">Place Of Event</label>
            <div class="controls">
           <input class="input-large" type="text" style=" width:500px;" id="cs_place" name="cs_place" placeholder="Enter Place" 
           value="<?php if($settings->cs_place=='') { echo "Rue Mauverney 28 CH-1196 Gland, USA"; } else{echo $settings->cs_place;} ?>">
            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="inputsitename">Enter Date</label>
            <div class="controls">
           <input class="input-large" type="text" id="datetimepicker" name="date" placeholder="Date" value="<?php echo $settings->cs_date; ?>">
            </div>
            </div>
            <div class="control-group" style="display:none">
            <label class="control-label" for="inputsitename"><?php echo $this->lang->line('text_sharethis_id');?></label>
            <div class="controls">
            <input class="input-xlarge" type="text" id="sharethis_id" name="sharethis_id" placeholder="<?php echo $this->lang->line('text_sharethis_id');?>" value="<?php echo $settings->cs_sharethis_id; ?>"><?php echo $this->lang->line('text_sharethis_help');?>
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

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>