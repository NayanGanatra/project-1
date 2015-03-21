<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_advertisement');?> <small><?php echo $this->lang->line('text_edit_advertisement');?></small></h1>
		</div>
        
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <hr>
            
            <div class="control-group <?php if(form_error('ads_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="covers_cat_name" name="ads_title" value="<?php echo $get_ads->ads_title; ?>">
                    <span class="help-inline"><?php echo form_error('ads_title'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('ads_link')){ echo "error";}?>">
            	<label class="control-label" for="inputError">URL</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="covers_cat_name" name="ads_link" value="<?php echo $get_ads->ads_link; ?>">
                    <span class="help-inline"><?php echo form_error('ads_link'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('ads_type')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_size');?></label>
                <div class="controls">
                <select name="ads_type" class="input-medium">
                <option <?php if($get_ads->ads_type == '250x125'){ echo 'selected="selected"'; } ?> value="250x125">250px X 125px</option>
                </select>                	
                    <span class="help-inline"><?php echo form_error('ads_type'); ?></span>
                </div>
            </div>
            
            <label class="control-label">Image</label>
                <div class="controls">
                <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline"><img src="<?php echo base_url('images/ads/'.$get_ads->ads_code);?>" height="50" />Select Image</span>
                <input type="hidden" name="old_image" value="<?php echo $get_ads->ads_code; ?>" />
                </div>
                </div>
            
           <div class="space10px"></div>   
             <div class="row">
            <div class="span11">
            <label class="control-label">Select Chapter</label>
            <table><tr>
            <?php
				$chapter = $this->dbadminheader->get_chapters();
				$i = 0;
				foreach($chapter as $chapter_row)
				{
					if($i%6==0)
					{
						?>
                        </tr><tr>
                        <?php
					}
					?>
                    <td>
						<span class="span3">
                            <label class="checkbox">
                                
                                 <input <?php $ch_to_ads = $this->dbadminheader->ch_to_ads($get_ads->ads_id,$chapter_row->ch_id); if($ch_to_ads){echo 'checked="checked"'; }?>  type="checkbox" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
                        
                            </label>
                        </span>
                    </td>
                    <?php
				$i++;
				}
			?>
            </tr></table>
            </div>
            </div>
             <div class="control-group <?php if(form_error('ads_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="ads_status" class="input-medium">
                <option <?php if($get_ads->ads_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if($get_ads->ads_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('ads_status'); ?></span>
                </div>
            </div>
                  <input type="hidden" name="ads_id" value="<?php echo $get_ads->ads_id; ?>" />
          <input type="submit" value="<?php echo $this->lang->line('btn_save_changes'); ?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>