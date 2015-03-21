<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Media <small>Edit Media</small></h1>
		</div>
        <hr>

		<?php $this->load->view('action_status'); ?>
        
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('news_title')){ echo "error";}?>">
                <label class="control-label">Media Title</label>
                <div class="controls">
                <input class="input-xlarge" type="text" id="media_title" name="media_title" placeholder="Media Title" value="<?php echo $get_media->media_title; ?>">
                <span class="help-inline"> <?php echo form_error('media_title'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('media_type')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Media Type</label>
                <div class="controls">
                    <select name="media_type" id="media_type" style="width:100px;">
                        <option <?php if($get_media->media_type == 1){echo 'selected="selected"'; }?> value="1">Video</option>
                        <option <?php if($get_media->media_type == 0){echo 'selected="selected"'; }?> value="0">Photo</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('media_type'); ?></span>
                </div>
           	 	</div>
                
                <div class="control-group" id="photo_holder" <?php if($get_media->media_type == 1){echo 'style="display:none;"';}?> >
                <label class="control-label">Photo</label>
                <div class="controls">
                <input type="file" name="photo" title="Select Image" />
                <span class="help-inline"> <?php echo $get_media->media_thumb; ?> <?php echo form_error('photo'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('media_data')){ echo "error";}?>" id="media_data_holder" <?php if($get_media->media_type == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?> >
            	<label class="control-label" for="inputError">Video Embed URL</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="media_data" name="media_data" placeholder="http://www.youtube.com/embed/9n37f2IIH9w?rel=0" value="<?php echo $get_media->media_data; ?>">
                    <span class="help-inline"> <?php echo form_error('media_data'); ?></span>
                </div>
            	</div>
                
                <div class="control-group" id="thumb_holder" <?php if($get_media->media_type == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?>>
                <label class="control-label">Video Thumbnail</label>
                <div class="controls">
                <input type="file" name="thumb" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline">Select Image <?php echo $get_media->media_thumb; ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('media_ch_id')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Chapter ID</label>
                <div class="controls">
                    <select name="media_ch_id" id="media_ch_id">
                    	<?php
						$get_chapters = $this->dbadminheader->get_chapters();
						foreach($get_chapters as $get_chapters_row)
						{
							?>
                            <option <?php if($get_chapters_row->ch_id == $get_media->media_ch_id){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>
                            <?php
						}
						?>
                        
                    </select>
                    <span class="help-inline"><?php echo form_error('media_type'); ?></span>
                </div>
           	 	</div>
                
                <div class="control-group">
                <div class="controls">
                <input type="hidden" name="old_media_thumb" value="<?php echo $get_media->media_thumb; ?>" />
                <input type="hidden" name="old_media_data" value="<?php echo $get_media->media_data; ?>" />
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
                
            
                <?php
			
		?>
        
		
</div>
	</td></tr></table>
    <script type="text/javascript">
	$('#media_type').change(function() {
		
		if($('#media_type').val() == 1)
		{
			$('#photo_holder').hide();
			$('#media_data_holder').show();
			$('#thumb_holder').show();
		}
		else
		{
			$('#photo_holder').show();
			$('#media_data_holder').hide();
			$('#thumb_holder').hide();
		}
	});
</script>
<?php $this->load->view('admincp/layout/footer'); ?>