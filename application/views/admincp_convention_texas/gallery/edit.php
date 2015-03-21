<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.min.js' type='text/javascript'></script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Gallery <small>Edit Gallery</small></h1>

		</div>

        <hr>



		<?php $this->load->view('action_status'); ?>

        

                <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

           		?>

                <div class="control-group <?php if(form_error('news_title')){ echo "error";}?>">

                <label class="control-label">Gallery Title</label>

                <div class="controls">

                <input class="input-xlarge" type="text" id="media_title" name="media_title" placeholder="Media Title" value="<?php echo $get_gallery->cg_title; ?>">

                <span class="help-inline"> <?php echo form_error('media_title'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('media_type')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Gallery Type</label>

                <div class="controls">

                    <select name="media_type" id="media_type" style="width:100px;">

                        <option <?php if($get_gallery->cg_type == 1){echo 'selected="selected"'; }?> value="1">Video</option>

                        <option <?php if($get_gallery->cg_type == 0){echo 'selected="selected"'; }?> value="0">Photo</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('media_type'); ?></span>

                </div>

           	 	</div>               

                <div class="control-group" id="photo_holder" <?php if($get_gallery->cg_type == 1){echo 'style="display:none;"';}?> >

                <label class="control-label">Photo</label>
                <div class="controls">
                    <input style="margin-top:-1px;" type="radio" id="selectimage" name="rdo_image" checked="checked"> Select Image
                    <input style="margin-left:50px;margin-top:-1px;" type="radio" id="imageurl"  name="rdo_image"> Image URL
                  </div>
                  
                <div class="controls" id="browse">
                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;margin-bottom:20px;"><img src="<?php echo base_url('images/convention/gallery/thumbs/'.$get_gallery->cg_thumb.'');?>" /></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
   <input type="file" name="photo" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>
                <span class="help-inline"><?php echo form_error('photo'); ?></span>

                </div>
                  <div class="controls" id="url" style="margin-top:20px;">

                      <input class="input-xlarge" type="text" name="photo1" placeholder="http://img.youtube.com/default.jpg">	
                        <span class="help-inline"><img src="<?php echo base_url('images/media/thumbs/'.$get_gallery->cg_thumb.'');?>" style="height:50px !important; "/></span>	
                        <span class="help-inline"> <?php echo form_error('photo'); ?></span>
                 </div>

                </div>
                

                <div class="control-group <?php if(form_error('media_data')){ echo "error";}?>" id="media_data_holder" <?php if($get_gallery->cg_type == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?> >

            	<label class="control-label" for="inputError">Video Embed URL</label>
                
                 <div class="controls">
                    <input style="margin-top:-1px;" type="radio" id="selectvideo" name="rdo_video" checked="checked"> Select Video
                    <input style="margin-left:50px;margin-top:-1px;" type="radio" id="videourl"  name="rdo_video"> Video URL
                </div>
                
                    <div class="controls" id="browse1" style="margin-top:10px;">
                        <input type="file" id="media_data" name="media_data1" title="<?php echo $this->lang->line('text_browse');?>" />
                        <span class="help-inline"><?php echo $get_gallery->cg_data; ?><?php echo form_error('media_data'); ?></span>
                 </div>
                                 
                <div class="controls" id="url1">

                    <input class="input-xxlarge" type="text" id="media_data" name="media_data" placeholder="http://www.youtube.com/embed/9n37f2IIH9w?rel=0">

                    <span class="help-inline"> <?php echo form_error('media_data'); ?></span>

                </div>

            	</div>

              

                <div class="control-group" id="thumb_holder" <?php if($get_gallery->cg_type == 1){echo 'style="display:block;"';} else { ?>style="display:none;" <?php } ?>>

                <label class="control-label">Video Thumbnail</label>

                <div class="controls">

                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;margin-bottom:20px;"><img src="<?php echo base_url('images/convention/gallery/thumbs/'.$get_gallery->cg_thumb.'');?>" /></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
   <input type="file" name="thumb" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>

                </div>

                </div>

                
                
                
                 <div class="control-group <?php if(form_error('cg_ca_id')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Album</label>

                <div class="controls">

                    <select name="cg_ca_id" id="cg_ca_id">
                  

                    	<?php

						$get_album = $this->dbgallery->get_album();//dbadminheader

						foreach($get_album as $get_album)

						{

							?>

                            <option <?php if($get_album->ca_id == $get_gallery->cg_ca_id){echo 'selected="selected"'; }?> value="<?php echo $get_album->ca_id; ?>"><?php echo $get_album->ca_name; ?></option>

                            <?php

						}

						?>

                        

                    </select>

                    <!--<span class="help-inline"><?php //echo form_error('media_ch_id'); ?></span>-->
                   <span class="help-inline"> <?php echo form_error('cg_ca_id'); ?></span>
                </div>

           	 	</div>

                  <div class="space10px"></div>   

                
                <!---------------------------------------------------year--------------------------------------------------->
                  <!--  <div class="control-group <?php //if(form_error('year')){ echo "error";}?>" style="display:none">

            	<label class="control-label" for="inputError">Year</label>

                <div class="controls">

                    <select name="year" id="year">
                    <option <?php //if($get_gallery->cg_year == '0'){ echo 'selected="selected"'; } ?> value="0">----Select Year----</option>  
                    <option <?php //if($get_gallery->cg_year == '1'){ echo 'selected="selected"'; } ?> value="1" >2011</option>  
                    <option <?php //if($get_gallery->cg_year == '2'){ echo 'selected="selected"'; } ?> value="2">2012</option>
                    <option <?php //if($get_gallery->cg_year == '3'){ echo 'selected="selected"'; } ?> value="3">2013</option>                  
                    </select>
                   <span class="help-inline"> <?php //echo form_error('year'); ?></span>
                </div>

           	 	</div>

                  <div class="space10px"></div>   
-->
                <!--------------------------------------------end of year------------------------------------------------------->
                 <!----------------------------------------chepter-dropdown----------------------------------------------------->

               <!-- <div class="control-group <?php //if(form_error('media_ch_id')){ echo "error";}?>" style="display:none">

            	<label class="control-label" for="inputError">Chapter ID</label>

                <div class="controls">

                    <select name="media_ch_id" id="media_ch_id">
                     <option value="Select Chapter">----Select Chapter----</option>


                    	<?php

					/*	$get_chapters = $this->dbgallery->get_chapters();

						foreach($get_chapters as $get_chapters_row)

						{

							?>

                            <option <?php if($get_chapters_row->ch_id == $get_gallery->cg_ch_id){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>

                            <?php

						}
*/
						?>

                       
                    </select>

                    <span class="help-inline"><?php //echo form_error('media_ch_id'); ?></span>

                </div>

           	 	</div>-->
                 <!---------------------------------end of chepterdrop-down---------------------------------------->
                  <!---------------------------------end of chepter checkbox---------------------------------------->

             <!--   <div class="row" style="display:none">

                <div class="span11">

                <label class="control-label">Select Chapter</label>

                <table><tr>

                <?php
/*
                    $chapter = $this->dbadminheader->get_chapters();

                    $i = 0;

                    foreach($chapter as $chapter_row)

                    {

                        if($i%6==0)

                        {
*/
                            ?>

                            </tr><tr>

                            <?php

                       // }

                        ?>

                        <td>

                            <span class="span3">

                                <label class="checkbox">

                                    

                                     <input <?php //$ch_to_media= $this->dbgallery->ch_to_gallery($get_gallery->cg_id,$chapter_row->ch_id); if($ch_to_media){echo 'checked="checked"'; }?>  type="checkbox" name="chapter[]" value="<?php //echo $chapter_row->ch_id; ?>" />  <?php// echo $chapter_row->ch_name; ?>

                            

                                </label>

                            </span>

                        </td>

                        <?php

                   // $i++;

                 //   }

                ?>

                </tr></table>

                </div>

                </div>-->

                <div class="control-group">

                <div class="controls">

                <input type="hidden" name="old_media_thumb" value="<?php echo $get_gallery->cg_id; ?>" />

                <input type="hidden" name="old_media_thumb" value="<?php echo $get_gallery->cg_thumb; ?>" />

                <input type="hidden" name="old_media_data" value="<?php echo $get_gallery->cg_data; ?>" />
                
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
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>