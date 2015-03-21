<?php $this->load->view('admincp/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

	/**************************************update by monita20130726*****************************************************/

 bkLib.onDomLoaded(function() {

new nicEditor({buttonList :  ['save','bold','italic','underline','left','center','right','justify','ol','ul','fontSize','fontFamily','fontFormat','indent','outdent','link','unlink','forecolor','bgcolor']}).panelInstance('vender_desc');



});

/**************************************end update by monita20130726*****************************************************/

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

</head>



<body>

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Vendors <small>Edit Vendor</small></h1>

		</div>

        <hr/>

        

                <?php

                $form_attributes = array( 'id' => 'myform');

                echo form_open('', $form_attributes);

           		?>

                 

                <div class="control-group <?php if(form_error('vender_name')){ echo "error";}?>">

                <label class="control-label">Vendor Name</label>

                <div class="controls">

                <input class="input-xxlarge" type="text" id="vender_name" name="vender_name" placeholder="Vendor Name" value="<?php echo $query->vendor_name; ?>">

                <span class="help-inline"><?php echo form_error('vender_name'); ?></span>

                </div>

                </div>

                

                <div class="control-group <?php if(form_error('vender_email')){ echo "error";}?>">

                <label class="control-label">Vendor Email</label>

                <div class="controls">

                <input class="input-xxlarge" type="text" id="vender_email" name="vender_email" placeholder="Vendor Email" value="<?php echo $query->vendor_email; ?>">

                <span class="help-inline"><?php echo form_error('vender_email'); ?></span>

                </div>

                </div>

                   <!-- update by monita20130725-->

                <div class="control-group <?php if(form_error('vender_address')){ echo "error";}?>">

                <label class="control-label">Vendor Address</label>

                <div class="controls">

                <textarea name="vender_address" id="vender_address" style="min-width:530px; width:auto; min-height:100px;"><?php echo $query->vendor_address; ?></textarea>

                  <!-- end update by monita20130725-->  

                <span class="help-inline"><?php echo form_error('vender_address'); ?></span>

                </div>

                </div>

                

                 <div class="control-group <?php if(form_error('category_id')){ echo "error";}?>">

                 <label class="control-label">Category</label>

                 <div class="controls">

                	<select name="category_id">

                     <option value="select category">---Select-Category---</option>

                        <?php

							$chapters = $this->dbadminheader->get_catgory();

							foreach($chapters as $row)

							{

								if($query->category_id  == $row->category_id)

								{

								?>

                                <option selected="selected" value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>

                                <?php

								}

								else

								{

								?>

                                <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>

                                <?php

								}

							}

						?>

                       

                    </select>

                    

                   

                <span class="help-inline"><?php echo form_error('category_id'); ?></span>

                </div>

                </div>

                 <!-- update by monita20130725-->

                <div class="control-group <?php if(form_error('vender_desc')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Vendor Description</label>

                <div class="controls">

                    <textarea style="width:100%; min-height:300px;" name="vender_desc" id="vender_desc"><?php echo $query->vendor_desc; ?></textarea>

                    <span class="help-inline"><?php echo form_error('vender_desc'); ?></span>

                </div>

            	</div>

                   <!-- end update by monita20130725--> 

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

                                    

                                     <input <?php $ch_to_vender = $this->dbvendor->ch_to_vender($query->vendor_id,$chapter_row->ch_id); if($ch_to_vender){echo 'checked="checked"'; }?>  type="checkbox" class="check" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>

                            

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

                 

                 <?php date_default_timezone_set("Asia/Kolkata"); ?>

                <input type="hidden" id="" name="vendor_created_date" value="<?php echo $query->vendor_created_date; ?>">

                <input type="hidden" id="" name="vendor_created_by" value="<?php echo $query->vendor_created_by; ?>">

                <input type="hidden" id="" name="vendor_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

                <input type="hidden" id="" name="vendor_modified_by" value="<?php echo 'admin';?>">

                 

                <div class="control-group">

                <div class="controls">

                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />

                </div>

                </div>

                



	</td>

  </tr>

</table>

</body>

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

</html>

<?php $this->load->view('admincp/layout/footer'); ?>