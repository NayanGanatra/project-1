<?php $this->load->view('chapteradmincp/layout/header'); ?>
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.min.js' type='text/javascript'></script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Media <small>Add Media</small></h1>

		</div>

        <hr>



		<?php $this->load->view('action_status'); ?>

        

                <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

           		?>

                <div class="control-group <?php if(form_error('media_title')){ echo "error";}?>">

                <label class="control-label">Media Title</label>

                <div class="controls">

                <input class="input-xlarge" type="text" id="media_title" name="media_title" placeholder="Media Title" value="<?php echo set_value('media_title'); ?>">

                <span class="help-inline"> <?php echo form_error('media_title'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('media_type')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Media Type</label>

                <div class="controls">

                    <select name="media_type" id="media_type" style="width:100px;">

                        <option <?php if(set_value('media_type') == 1){echo 'selected="selected"'; }?> value="1">Video</option>

                        <option <?php if(set_value('media_type') == 0){echo 'selected="selected"'; }?> value="0">Photo</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('media_type'); ?></span>

                </div>

           	 	</div>             

                <div class="control-group" id="photo_holder" <?php if(set_value('media_type') == 1){echo 'style="display:none;"';}?> >

                <label class="control-label">Photo</label>
                  <div class="controls">
                    <input style="margin-top:-1px;" type="radio" id="selectimage" name="rdo_image" checked="checked"> Select Image
                    <input style="margin-left:50px;margin-top:-1px;" type="radio" id="imageurl"  name="rdo_image"> Image URL
                  </div>
                 <div class="controls" id="browse">
                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;margin-bottom:20px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
  <input type="file" name="photo" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
                 
                     <span class="help-inline"> <?php echo form_error('photo'); ?></span>
                </div>
                  <div class="controls" id="url" style="margin-top:20px;">
  <input class="input-xlarge" type="text" name="photo1" placeholder="http://img.youtube.com/default.jpg">			
                        <span class="help-inline"> <?php echo form_error('photo'); ?></span>
                 </div>

                </div>

                

                <div class="control-group <?php if(form_error('media_data')){ echo "error";}?>" id="media_data_holder" <?php if(set_value('media_type') == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?> >

            	<label class="control-label" for="inputError">Video Embed URL</label>
                
                  <div class="controls">
                    <input style="margin-top:-1px;" type="radio" id="selectvideo" name="rdo_video" checked="checked"> Select Video
                    <input style="margin-left:50px;margin-top:-1px;" type="radio" id="videourl"  name="rdo_video"> Video URL
                   </div>
                   <div class="controls" id="browse1">

                        <input type="file" id="media_data1" name="media_data1" title="<?php echo $this->lang->line('text_browse');?>" /><!----update_monita_20130812----->
                        <span class="help-inline"> <?php echo form_error('media_data'); ?></span>
                 </div>
                 <div class="controls" id="url1">

                    <input class="input-xxlarge" type="text" id="media_data" name="media_data" placeholder="http://www.youtube.com/embed/9n37f2IIH9w?rel=0" value="<?php echo set_value('media_data'); ?>">

                    <span class="help-inline"> <?php echo form_error('media_data'); ?></span>

                </div>
            	</div>             

                <div class="control-group" id="thumb_holder" <?php if(set_value('media_type') == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?>>

                <label class="control-label">Video Thumbnail</label>

                <div class="controls">
                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;margin-bottom:20px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
    <input type="file" name="thumb" title="<?php echo $this->lang->line('text_browse');?>" /> 
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
            <span class="help-inline">Select Image</span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('media_ch_id')){ echo "error";}?>" style="display:none">

            	<label class="control-label" for="inputError">Chapter ID</label>

                <div class="controls">

                    <select name="media_ch_id" id="media_ch_id">

                    	<?php

						$get_chapters = $this->dbadminheader->get_chapters();

						foreach($get_chapters as $get_chapters_row)

						{

							?>

                            <option <?php if($get_chapters_row->ch_id == set_value('media_ch_id')){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>

                            <?php

						}

						?>

                        

                    </select>

                    <span class="help-inline"><?php echo form_error('media_type'); ?></span>

                </div>

           	 	</div>

                

                <div class="control-group">

                <div class="controls">

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
	$('#url1').hide();

	$('#browse1').show();

		$("#videourl").click(function() {

			$('#url1').show();

			$('#browse1').hide();

		});

		$("#selectvideo").click(function() {

			$('#browse1').show();

			$('#url1').hide();

		});

});

</script>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>