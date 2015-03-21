<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" type="text/css">
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap-fileupload/bootstrap-fileupload.min.js' type='text/javascript'></script>


<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Sponsors <small> Edit Sponsors</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>

            

            <div class="control-group <?php if(form_error('ads_title')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_name');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="ads_title" value="<?php echo $get_sponsors->cs_title; ?>">

                    <span class="help-inline"><?php echo form_error('ads_title'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('ads_link')){ echo "error";}?>">

            	<label class="control-label" for="inputError">URL</label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="covers_cat_name" name="ads_link" value="<?php echo $get_sponsors->cs_link; ?>">

                    <span class="help-inline"><?php echo form_error('ads_link'); ?></span>

                </div>

            </div>

            

            <div class="row">

                <div class="control-group <?php if(form_error('ads_type')){ echo "error";}?>" style="width:290px;float:left;">

                    <label class="control-label" for="inputError"><?php echo $this->lang->line('text_size');?></label>

                    <div class="controls">

                        <select name="ads_type" class="input-medium">

                        <option <?php if($get_sponsors->cs_type == '250x125'){ echo 'selected="selected"'; } ?> value="250x125">250px X 125px</option>

                        </select>                	

                        <span class="help-inline"><?php echo form_error('ads_type'); ?></span>

                    </div>

                </div>

                    <label class="control-label hidethis" style="width:700px;float:left">Image</label>

                <div class="row hidethis">

                    <div class="controls" style="float:left;">

                        <input style="margin-top:-1px;" type="radio" id="selectimage" name="rdo_image" value="1" checked="checked"> Select Image

                        <input style="margin-left:50px;margin-top:-1px;" type="radio" id="imageurl"  name="rdo_image" value=""> Image URL

                    </div>

                </div>             
             

                <div class="controls hidethis" id="browse" style="margin-left:290px;">

                 <!--   <input type="file" name="image" title="<?php //echo $this->lang->line('text_browse');?>" />-->

                <div class="fileupload fileupload-new spandislaynone" data-provides="fileupload">
<div class="fileupload-new thumbnail" style="width: 120px; height: 90px; margin-top:20px;"><img src="<?php if($get_sponsors->cs_code!='') { echo base_url('images/convention/sponsors/'.$get_sponsors->cs_code); } else { echo '';}?>" style="height:87px; padding-bottom:0.1em;padding-top:0.1em;"/></div>
<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 90px; line-height: 20px;"></div>
<div>
     <input type="file" name="image" title="<?php echo $this->lang->line('text_browse');?>" />
<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div>
</div>

                    <input type="hidden" name="old_image" value="<?php echo $get_sponsors->cs_code; ?>" />

                </div>

            

                <div class="controls" id="url" style="margin-left:290px;">

                    <input class="input-xlarge" type="text" name="image1" placeholder="http://img.youtube.com/default.jpg" />

                    <span class="help-inline"><img src="<?php echo base_url('images/convention/sponsors/'.$get_sponsors->cs_code);?>" height="50" /></span>

                    <input type="hidden" name="old_image" value="<?php echo $get_sponsors->cs_code; ?>" />			

                </div>

            </div>    

                   

      			<div class="space10px"></div>

              

			<div class="row">   

				<div class="control-group <?php if(form_error('ads_start_date')){ echo "error";}?>" style="width:290px;float:left;">

            		<label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_from');?></label>

                	<div class="controls" style="width:290px;">

                    <input class="" type="text" id="datetimepickerFrom" name="ads_start_date" value="<?php echo $get_sponsors->cs_start_date; ?>">

                    <span class="help-inline"><?php echo form_error('ads_start_date'); ?></span>

                	</div>

            	</div>

            	<div class="control-group <?php if(form_error('ads_end_date')){ echo "error";}?>" style="width:290px;float:left;">

                    <label class="control-label" style="width:290px;" for="inputError"><?php echo $this->lang->line('text_to');?></label>

                    <div class="controls" style="width:290px;">

                        <input class="" type="text" id="datetimepickerTo" name="ads_end_date" value="<?php echo $get_sponsors->cs_end_date; ?>">

                        <span class="help-inline"><?php echo form_error('ads_end_date'); ?></span>

                    </div>

                </div>   

            </div>     
              
             <div class="space10px"></div>
          <div class="control-group <?php if(form_error('cs_ch_id')){ echo "error";}?>" style="display:none;">

            	<label class="control-label" for="inputError">Chapter</label>

                <div class="controls">

                    <select name="cs_ch_id" id="cs_ch_id">
                    <option value="Select Chapter">----Select Chapter----</option>

                    	<?php

						$get_chapters = $this->dbsponsors->get_chapters();//dbadminheader

						foreach($get_chapters as $get_chapters_row)

						{

							?>

                            <option <?php if($get_chapters_row->ch_id == $get_sponsors->cs_ch_id){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>

                            <?php

						}

						?>

                        

                    </select>

                    <!--<span class="help-inline"><?php //echo form_error('media_ch_id'); ?></span>-->
                   <span class="help-inline"> <?php echo form_error('cs_ch_id'); ?></span>
                </div>

           	 	</div>

                  <div class="space10px"></div>   
             
   
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

                                    

                                     <input <?php $ch_to_ads = $this->dbadminheader->ch_to_ads($get_ads->ads_id,$chapter_row->ch_id); if($ch_to_ads){echo 'checked="checked"'; }?>  type="checkbox" class="check" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>

                            

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
                 	
                    <option class="label label-important" style="border-radius:0px" <?php if($get_sponsors->cs_category == '3'){ echo 'selected="selected"'; } ?> value="3">Grand</option>
                 	<option class="label label-warning" style="border-radius:0px" <?php if($get_sponsors->cs_category == '2'){ echo 'selected="selected"'; } ?> value="2">Gold</option>
                  	<option class="label" style="border-radius:0px" <?php if($get_sponsors->cs_category == '1'){ echo 'selected="selected"'; } ?> value="1">Silver</option>
                  	<option class="label label-inverse" style="border-radius:0px" <?php if($get_sponsors->cs_category == '0'){ echo 'selected="selected"'; } ?> value="0">General</option>
                </select>

                    <span class="help-inline"><?php echo form_error('cs_category'); ?></span>

			</div>

		</div>     
              

              <div class="space10px"></div>
              <div class="control-group hidethis <?php if(form_error('cs_sidebar')){ echo "error";}?>">
			<label class="control-label" for="inputError">Show On Sidebar</label>
			<div class="controls">
                <select name="cs_sidebar" class="input-medium">
                <option <?php if($get_sponsors->cs_sidebar == '1'){ echo 'selected="selected"'; } ?> value="1">Yes</option>
                <option <?php if($get_sponsors->cs_sidebar == '2'){ echo 'selected="selected"'; } ?> value="2">No</option>
				</select>
                <span class="help-inline"><?php echo form_error('cs_sidebar'); ?></span>
			</div>
			</div>
            <div class="space10px"></div>
            <div class="control-group <?php if(form_error('cs_donation')){ echo "error";}?>">
			<label class="control-label" for="inputError">Donation</label>
			<div class="controls">
            	<input  type="text" id="cs_donation" name="cs_donation" value="<?php echo $get_sponsors->cs_donation; ?>">
                <span class="help-inline"><?php echo form_error('cs_donation'); ?></span>
			</div>
			</div>
            <div class="space10px"></div>

			<div class="control-group <?php if(form_error('ads_status')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>

                <div class="controls">

                    <select name="ads_status" class="input-medium">

                    <option <?php if($get_sponsors->cs_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>

                    <option <?php if($get_sponsors->cs_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>

                    </select>

                    <span class="help-inline"><?php echo form_error('ads_status'); ?></span>

                </div>

            </div>

            

            <?php date_default_timezone_set("Asia/Kolkata"); ?>

            <input type="hidden" id="" name="ads_created_date" value="<?php echo $get_sponsors->cs_created_date; ?>">

            <input type="hidden" id="" name="ads_created_by" value="<?php echo $get_sponsors->cs_created_by; ?>">

            <input type="hidden" id="" name="ads_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

            <input type="hidden" id="" name="ads_modified_by" value="<?php echo 'admin';?>">

           		

            <input type="hidden" name="ads_id" value="<?php echo $get_sponsors->cs_id; ?>" />

                  

          	<input type="submit" value="<?php echo $this->lang->line('btn_save_changes'); ?>" class="btn" />



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