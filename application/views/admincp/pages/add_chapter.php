<?php $this->load->view('admincp/layout/header'); ?>

<script type="text/javascript">

	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('page_content');});

</script>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Chapter <small><?php echo $this->lang->line('text_add_page');?></small></h1>

		</div>

        <hr />

         	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>

            

            <div class="control-group <?php if(form_error('page_menu_name')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_menu_name');?></label>

                <div class="controls">

                    <input class="input-xlarge" type="text" id="page_menu_name" name="page_menu_name" value="<?php echo set_value('page_menu_name'); ?>">

                    <span class="help-inline"><?php echo form_error('page_menu_name'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('page_title')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_page_title');?></label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="page_title" name="page_title" value="<?php echo set_value('page_title'); ?>">

                    <span class="help-inline"><?php echo form_error('page_title'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('sub_title')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Sub Title</label>

                <div class="controls">

                    <input class="input-xxlarge" type="text" id="sub_title" name="sub_title" value="<?php echo set_value('sub_title'); ?>">

                    <span class="help-inline"><?php echo form_error('sub_title'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('page_content')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_content');?></label>

                <div class="controls">

                    <textarea style="width:100%; min-height:300px;"name="page_content" id="page_content"><?php echo set_value('page_content'); ?></textarea>

                    <span class="help-inline"><?php echo form_error('page_content'); ?></span>

                </div>

            </div>

            

            <input type="hidden"  name="page_sub_id" value="0" />
			 <div class="span11">Chapters&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <input style=" margin-top:-1px" type="checkbox" id="all_ch"  name="all_ch" value="yes" onclick="check_all_chapter(this.value)" />&nbsp;&nbsp;Check All Chapter
            <div class="space10px"></div>   

            <table><tr>

            <?php

				$chapter = $this->dbadminheader->get_chapters();

				$i = 0;

				$ij=0;

				$arr_ch_id=array();

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

                                

                                 <input   type="checkbox" id="chapter[]" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>"  />  <?php echo $chapter_row->ch_name; ?>

                        <input  id='ch_<?php echo $chapter_row->ch_id; ?>' size="20"  type='hidden' name='ch_<?php echo $chapter_row->ch_id; ?>' value='yes'/>

                            </label>

                        </span>

                    </td>

                    <?php

				$i++;

				}

			?>

            </tr></table>

            </div>
			<div class="space10px"></div>   
            <div class="control-group <?php if(form_error('page_seo')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_slug');?></label>

                <div class="controls">

                    <input type="text" id="page_seo" name="page_seo" value="<?php echo set_value('page_seo'); ?>">

                    <span class="help-inline"><?php echo form_error('page_seo'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('page_order')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>

                <div class="controls">

                    <input style="width:90px;" type="text" id="page_order" name="page_order" value="<?php echo set_value('page_order'); ?>">

                    <span class="help-inline"><?php echo form_error('page_order'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('page_status')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>

                <div class="controls">

                    <select name="page_status" style="width:100px;">

					<?php if(set_value('page_status') == '0')

                        {

                        ?>

                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        else

                        {

                        ?>

                        <option value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        ?>

                    </select>

                    <span class="help-inline"><?php echo form_error('page_status'); ?></span>

                </div>

            </div>

            <?php date_default_timezone_set("Asia/Kolkata"); ?>    

            <input type="hidden" id="" name="page_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

            <input type="hidden" id="" name="page_created_by" value="<?php echo 'admin';?>">

            

            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

	</td>

  </tr>

</table>
<script>
function check_all_chapter(status)

{

	//alert(status);

	var checkbox = document.getElementsByName('chapter[]');

	var ln = checkbox.length;

	if(status=='yes')

	{

		for (var i = 0, l = ln; i < l; i++) {

			//alert(checkbox[i].disabled);

			if (checkbox[i].disabled==false)

			{

			checkbox[i].checked = true;	

			

			}

			else

			{

			checkbox[i].checked = false;			  		

			//checkbox[i].disabled==false

			

			}

			

			

		}

		document.getElementById("all_ch").value = "no";

	}

	else

	{

		for (var i = 0, l = ln; i < l; i++) {			

			if (checkbox[i].disabled==false)

			{

			checkbox[i].checked = false;	

			

			}

			else

			{

			checkbox[i].checked = false;			  		

			//checkbox[i].disabled==false

			}

			

			

		}

		document.getElementById("all_ch").value = "yes";

		

		

		//document.getElementById("check_all_user").checked=false;

	}

}
</script>
<?php $this->load->view('admincp/layout/footer'); ?>