<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/media.html'); ?>">Manage Media</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
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
                <span class="help-inline"> <?php echo form_error('photo'); ?></span>
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
                <input type="file" name="thumb" title="<?php echo $this->lang->line('text_browse');?>" /> <span class="help-inline">Select Image</span>
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
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>
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
<?php $this->load->view('footer'); ?>