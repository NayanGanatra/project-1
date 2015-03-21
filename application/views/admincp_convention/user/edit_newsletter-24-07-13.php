<head>



<script src='<?php echo base_url(); ?>js/jquery-1.7.1.min.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/popup/jquery-ui.js' type='text/javascript'></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>css/popup/jquery-ui.css" />



<!--

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->



 <script>

  $(function() {

   

 	$( "#dialog-form" ).dialog({

      autoOpen: false,

      height: 520,

      width: 1000,

      modal: true,

      buttons: {

        "Submit": function() {

			alert("bye");

         $( this ).dialog( "close" );

         },

       /* Cancel: function() {

          $( this ).dialog( "close" );

        }*/

      },

      close: function() {

         $( this ).dialog( "close" );

      }

    });

 

    $( "#subscribelist" )

      .click(function() {

        $( "#dialog-form" ).dialog( "open" );

      });

  });

  </script>



<SCRIPT type="text/javascript">

$(function(){

 

   

    $("#selectall").click(function () {

		

          $('.case').attr('checked', this.checked);

    });

 

     $(".case").click(function(){

 	 if($(".case").length == $(".case:checked").length) {

            $("#selectall").attr("checked", "checked");

        } else {

            $("#selectall").removeAttr("checked");

        }

 

    });

});

</SCRIPT>







</head>

<?php $this->load->view('admincp_convention/layout/header'); ?>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>



<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <?php /*?><h1><?php echo $this->lang->line('text_newsletter');?> <small><?php echo $this->lang->line('btn_text_edit_newsletter');?></small></h1><?php */?>

                  <h1>Newsletter <small>Edit</small></h1> <!-- add by mayank 19/06/2013/13:33  -->

		</div>

        <hr>

        

  



	

            <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>



            <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">

             <label class="control-label">Subject Title</label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="subject" name="subject" style="height:30px;" value="<?php echo $item->subject; ?>">

                    <span class="help-inline"><?php echo form_error('subject'); ?></span>

                </div>

            </div>

            

			<div class="control-group <?php if(form_error('newsletter_template_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Select Template</label>

                <div class="controls">

                <select class="input-medium" name="newsletter_template_name" id="newsletter_template_name">

                <option value="">Please Select</option>

                <?php

					$get_template = $this->dbadminheader->get_template();

					

					foreach($get_template as $get_template_row)

					{

					

						if($item->template_id==$get_template_row->template_id)

						{?>

                            <option selected="selected"  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>

                        <?php

						}

						else

						{?>

                            <option  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>

                        <?php

						}

					}

				?>

                </select>

                <span class="help-inline"><?php echo form_error('newsletter_template_name'); ?></span>

                </div>

            </div>

			

			<div class="control-group <?php if(form_error('html')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>

                <div class="controls">

                    <textarea style="width:70%; min-height:150px;" name="html" id="html"><?php if($item) echo $item->html; ?></textarea>

                    <span class="help-inline"><?php echo form_error('html'); ?></span>

                </div>

            </div>

            

            <?php /*?><div class="control-group <?php if(form_error('html')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>

                <div class="controls">

                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php

					echo $item->html; ?></textarea>

                    <span class="help-inline"><?php echo form_error('html'); ?></span>

                </div>

            </div><?php */?>

            

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

                                

                                 <input <?php  $ch_to_newsletters = $this->dbadminheader->ch_to_newsletters($item->uid,$chapter_row->ch_id); 

								 if($ch_to_newsletters){echo 'checked="checked"'; }?> 

                    type="checkbox" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  

								 <?php echo $chapter_row->ch_name; ?>

                        

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

            <div class="control-group <?php if(form_error('newsletter_status')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>

                <div class="controls">

                <select name="newsletter_status" class="input-medium">

                <option <?php if($item->newsletter_status == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>

                <option <?php if($item->newsletter_status == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>

                </select>

                    <span class="help-inline"><?php echo form_error('newsletter_status'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">

            <label class="control-label">Queued Newsletter</label>

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>

                <div class="controls">

                    <select name="queued" style="width:150px;">

						<option <?php if($item->queued == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>

                        <option <?php if($item->queued == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('queued'); ?></span>

                </div>

            </div>

            

            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

            

		</form>







</td></tr></table>

<script>

$('#newsletter_template_name').change(function() {

	$.ajax({

	  url: BASE_URI+'admincp_convention/user/get_template_chapter/'+$('#newsletter_template_name').val(),

	  success: function(data) {

		$('.nicEdit-main').html(data);

		$('#html').html(data);

		}

	});

});

</script>





<?php $this->load->view('admincp_convention/layout/footer'); ?>