<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.min.js' type='text/javascript'></script>


<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div id="user_update"  style="display:none;" class="alert alert-error">Image not uploaded, please try again</div>


<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Sponsors <small> ADD Sponsors</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>

		<div class="control-group <?php if(form_error('ads_title')){ echo "error";}?>">

			<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="ads_title" value="<?php echo set_value('ads_title'); ?>">

                    <span class="help-inline"><?php echo form_error('ads_title'); ?></span>

                </div>

		</div>

            

		<div class="control-group <?php if(form_error('ads_link')){ echo "error";}?>">

			<label class="control-label" for="inputError">URL</label>

			<div class="controls">

				<input class="input-xxlarge" type="text" id="covers_cat_name" name="ads_link" value="<?php echo set_value('ads_link'); ?>">

                <span class="help-inline"><?php echo form_error('ads_link'); ?></span>

			</div>

		</div>

        

        <div class="row" style="height:110px;">    

            <div class="control-group <?php if(form_error('ads_type')){ echo "error";}?>" style="width:290px;float:left;">

                <label class="control-label" for="inputError"><?php echo $this->lang->line('text_size');?></label>

                    <div class="controls">

                        <select name="ads_type" class="input-medium">

                            <option <?php if(set_value('ads_type')  == '250x125'){ echo 'selected="selected"'; } ?> value="250x125">250px X 125px</option>

                        </select> 

                        <span class="help-inline"><?php echo form_error('ads_type'); ?></span>

                    </div>

            </div>

                

            

                <label class="control-label hidethis" style="width:700px;float:left">Image</label>

            <div class="row hidethis">            

                <div class="controls" style="float:left;">

                 

                    <input style="margin-top:-1px;" type="radio" id="selectimage" name="rdo_image" checked="checked"> Select Image

                    <input style="margin-left:50px;margin-top:-1px;" type="radio" id="imageurl"  name="rdo_image"> Image URL

                    

                </div>

            </div>

                          

            <div class="controls hidethis <?php if(form_error('image')){ echo "error";}?>" id="browse" style="margin-left:290px; "> 

               <!-- <input type="file" name="image" title="<?php //echo $this->lang->line('text_browse');?>" />-->

                  <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload" style="float:left; width:100%">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;margin-bottom:20px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
  <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>

  <span class="help-inline"><?php echo form_error('image'); ?></span>
            </div>

            

            <div class="controls" id="url" style="margin-left:290px;">
 			<input class="input-xlarge" type="text" name="image1" placeholder="http://img.youtube.com/default.jpg">
            </div>

        </div>		 

            

             <div class="space10px"></div>

             

        <div class="row">    

            <div class="control-group <?php if(form_error('ads_start_date')){ echo "error";}?>" style="width:290px;float:left;">

            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_from');?></label>

                <div class="controls" style="width:290px;">

                    <input class="" type="text" id="datetimepickerFrom" name="ads_start_date" value="<?php echo set_value('ads_start_date'); ?>">

                    <span class="help-inline"><?php echo form_error('ads_start_date'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('ads_end_date')){ echo "error";}?>" style="width:290px;float:left;">

            	<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_to');?></label>

                <div class="controls" style="width:290px;">

                    <input class="" type="text" id="datetimepickerTo" name="ads_end_date" value="<?php echo set_value('ads_end_date'); ?>">

                    <span class="help-inline"><?php echo form_error('ads_end_date'); ?></span>

                </div>

            </div>

		</div>
		<div class="control-group <?php if(form_error('cs_ch_id')){ echo "error";}?>"  style="display:none;">
	           	<label class="control-label" for="inputError">Chapter</label>
                <div class="controls">
                    <select name="cs_ch_id" id="cs_ch_id">
                    <option value="Select Chapter">Select Chapter</option>
                    	<?php
						$get_chapters = $this->dbsponsors->get_chapters();//dbadminheader
						foreach($get_chapters as $get_chapters_row)
						{
							?>

                            <option <?php if($get_chapters_row->ch_id == set_value('cs_ch_id')){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>

                            <?php

						}

						?>
					</select>
                   <span class="help-inline"> <?php echo form_error('cs_ch_id'); ?></span>
                </div>

           	 	</div>

                  <div class="space10px"></div>   
             
      <!--------------------------------------------------------------------------------------------------->

		<div class="row" style="display:none">

            <div class="span11">

            

            Select Chapter <input type="checkbox" name="" id="selectall" style="margin-top:-1px;">

            <div class="space10px"></div>

            <table><tr>

            <?php

				$chapter = $this->dbadminheader->get_chapters_without_national();

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

                                <input type="checkbox" class="check" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>

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
            
           <div class="space10px"></div>
            <div class="control-group <?php if(form_error('cs_category')){ echo "error";}?>">

			<label class="control-label" for="inputError">Category</label>
			<div class="controls">

                <select name="cs_category" class="input-medium" onchange="hideshow_div();" id="cs_category">
               <option class="label label-inverse" style="border-radius:0px" <?php if(set_value('cs_category') == '0'){ echo 'selected="selected"'; } ?> value="0">General</option>
                <option class="label label-important" style="border-radius:0px" <?php if(set_value('cs_category') == '2'){ echo 'selected="selected"'; } ?> value="3">Grand</option>
                <option class="label label-warning" style="border-radius:0px" <?php if(set_value('cs_category') == '2'){ echo 'selected="selected"'; } ?> value="2">Gold</option>
                <option class="label" style="border-radius:0px" <?php if(set_value('cs_category') == '1'){ echo 'selected="selected"'; } ?> value="1">Silver</option>
                
				</select>
                <span class="help-inline"><?php echo form_error('cs_category'); ?></span>

			</div>

			</div>
            <div class="space10px"></div>
    
            <div class="control-group hidethis <?php if(form_error('cs_sidebar')){ echo "error";}?>">
			<label class="control-label" for="inputError">Show On Sidebar</label>
			<div class="controls">
                <select name="cs_sidebar" class="input-medium">

                <option <?php if(set_value('cs_sidebar') == '2'){ echo 'selected="selected"'; } ?> value="2">No</option>
                                <option <?php if(set_value('cs_sidebar') == '1'){ echo 'selected="selected"'; } ?> value="1">Yes</option>
				</select>
                <span class="help-inline"><?php echo form_error('cs_sidebar'); ?></span>
			</div>
			</div>
            <div class="space10px"></div>
            <div class="control-group <?php if(form_error('cs_donation')){ echo "error";}?>">
			<label class="control-label" for="inputError">Donation</label>
			<div class="controls">
            	<input  type="text" id="cs_donation" name="cs_donation" value="<?php echo set_value('cs_donation'); ?>">
                <span class="help-inline"><?php echo form_error('cs_donation'); ?></span>
			</div>
			</div>
            <div class="space10px"></div>

		<div class="control-group <?php if(form_error('ads_status')){ echo "error";}?>">

			<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>

			<div class="controls">

                <select name="ads_status" class="input-medium">

                <option <?php if(set_value('ads_status') == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>

                <option <?php if(set_value('ads_status') == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>

                </select>

                    <span class="help-inline"><?php echo form_error('ads_status'); ?></span>

			</div>

		</div>

       

            	

		<?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="ads_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="ads_created_by" value="<?php echo 'admin';?>">

          

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

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

});

</script>



<script language="javascript">

$(function(){



	$("#selectall").click(function () {

	$('.check').attr('checked', this.checked);

	});

	

	$(".check").click(function(){

	if($(".check").length == $(".check:checked").length) {

	$("#selectall").attr("checked", "checked");

	} else {

	$("#selectall").removeAttr("checked");

	}

	});

});

</script>
<script>
$(document).ready(function(){
	hideshow_div();
});
function hideshow_div()
{
	if($('#cs_category').val()=='0')
	{
		$(".hidethis").slideUp();
		$('#browse').hide();
		$('#url').hide();
	}
	else
	{
		$(".hidethis").slideDown();
		if($("#imageurl").attr('checked')==true)
		{
			$('#url').show();
		}
		if($("#selectimage").attr('checked')==true)
		{
			$('#browse').show();
		}
	}
}
</script>