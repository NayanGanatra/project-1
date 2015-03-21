<?php $this->load->view('admincp/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Events <small>Add Event</small></h1>

		</div>

        <hr />

        

                <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open('', $form_attributes);

           		?>

                <div class="control-group <?php if(form_error('event_name')){ echo "error";}?>">

                <label class="control-label">Event Title</label>

                <div class="controls">

                <input class="input-xxlarge" type="text" id="event_name" name="event_name" placeholder="Event Title" value="<?php echo set_value('event_name'); ?>">

                <span class="help-inline"><?php echo form_error('event_name'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('event_description')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Event Description</label>

                <div class="controls">

                    <textarea style="width:100%; min-height:300px;"name="event_description" id="event_description"><?php echo set_value('event_description'); ?></textarea>

                    <span class="help-inline"><?php echo form_error('event_description'); ?></span>

                </div>

            	</div>

                

                <div class="control-group <?php if(form_error('event_location')){ echo "error";}?>">

                <label class="control-label">Event Location</label>

                <div class="controls">

                <input class="input-xxlarge" type="text" id="event_location" name="event_location" placeholder="Event Location" value="<?php echo set_value('event_location'); ?>">

                <span class="help-inline"><?php echo form_error('event_location'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('event_date_time')){ echo "error";}?>">

                <label class="control-label">Date</label>

                <div class="controls">

                <input class="input-large" type="text" id="datetimepicker" name="event_date_time" placeholder="Date" value="<?php echo set_value('event_date_time'); ?>">

                <span class="help-inline"><?php echo form_error('event_date_time'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('event_ch_id')){ echo "error";}?>" style="display:none">

                <label class="control-label">Chapter</label>

                <div class="controls">

                	<select name="event_ch_id">
							 <option value="select-chapter">---Select-Chapters---</option>
                        <?php

							$chapters = $this->dbadminheader->get_chapters();

							foreach($chapters as $chapters_row)

							{

								if(set_value('event_ch_id') == $chapters_row->ch_id)

								{

								?>

                                <option selected="selected" value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>

                                <?php

								}

								else

								{

								?>

                                <option value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>

                                <?php

								}

							}

						?>

                        

                    </select>

                <span class="help-inline"><?php echo form_error('event_ch_id'); ?></span>

                </div>

                </div>

                 <div class="space10px"></div>   
 				
                  <div class="row">

                    <div class="span11">

                    Select Chapter <input type="checkbox" name="" id="selectall" style="margin-top:-1px;">

            		<div class="space10px"></div>

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
               

                <div class="control-group <?php if(form_error('event_status')){ echo "error";}?>">

                <label class="control-label">Status</label>

                <div class="controls">

                	<select name="event_status">

                        <option <?php if(set_value('event_status') == '1') { ?> selected="selected" <?php } ?> value="1">Upcoming</option>

                        <option <?php if(set_value('event_status') == '2') { ?> selected="selected" <?php } ?> value="2"> Archived</option>

                        <option <?php if(set_value('event_status') == '0') { ?> selected="selected" <?php } ?> value="0"> Deactive</option>

                    </select>

                <span class="help-inline"><?php echo form_error('event_status'); ?></span>

                </div>

                </div>

                

                <div class="control-group">

                <div class="controls">

                <?php date_default_timezone_set("Asia/Kolkata"); ?>    

                <input type="hidden" id="" name="event_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

                <input type="hidden" id="" name="event_created_by" value="<?php echo 'admin';?>">

                

                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />

                </div>

                </div>

                



	</td>

  </tr>

</table>

<?php $this->load->view('admincp/layout/footer'); ?>

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