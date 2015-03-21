<?php $this->load->view('admincp_convention/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Menu <small>Add Menu</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','name' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>
            
            

	
		<div class="control-group <?php if(form_error('menu_name')){ echo "error";}?>">

			<label class="control-label" for="inputError">Menu title</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="menu_name" value="<?php echo set_value('menu_name'); ?>" placeholder="Enter Menu Name">
</br>
                    <span class="help-inline"><?php echo form_error('menu_name'); ?></span>

                </div>

		</div>
        
        
        
        <div class="control-group <?php if(form_error('menu_type')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Menu Type</label>

                <div class="controls">

                    <select name="menu_type" style="width:100px;">

						<option <?php if(set_value('menu_type') == '0') { ?> selected="selected" <?php } ?> value="0" id="internal">Internal</option>

                        <option <?php if(set_value('menu_type') == '1') { ?> selected="selected" <?php } ?> value="1" id="external">External</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('menu_type'); ?></span>

                </div>

            </div>
            
            <div id="menu_link" class="control-group <?php if(form_error('menu_link')){ echo "error";}?>" style="display:none;">

			<label class="control-label" for="inputError">Menu Link</label>

				<div class="controls">

                    <input class="input-xxlarge" type="text" id="covers_cat_name" name="menu_link" value="<?php echo set_value('menu_link'); ?>" placeholder="Enter Menu Name">
</br>
                    <span class="help-inline"><?php echo form_error('menu_link'); ?></span>

                </div>

			</div>

            

		<div class="control-group <?php if(form_error('sub_menu_name[]') || form_error('sub_menu_order[]')){ echo "error";}?>" >

				<label class="control-label">Submenu</label>
                 <div style="width:100%;  float:left;">
                  
            <table width="100%"  border="1">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th style="background-color:#D6E3BB" width="30%">Name of Submenu</th>
                    
                    <th style="background-color:#D6E3BB" width="15%">Order of Submenu</th>
                    
                    <th style="background-color:#D6E3BB" width="15%">Submenu Type</th>
                    
                    <th style="background-color:#D6E3BB; display:block;"  id="submenu_link1" >Submenu Link</th>
                   
                   
                  </tr>
             </table>
             
             </div>
                
             
             <div class="addremove" style="width:100%;float:left;height:25px">
             
             <a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:-35px;"></i>

				</a>
             
             <a title="Add New Field" onclick="addNewField(this);">

				<i class="icon-edit" style="background-position:0 -96px;float:right;margin-right:-20px;"></i>

				</a>

				
					
           		<table width="100%"   border="1" >
					<tr>
                  	<!--<td width="5%" style="background-color:#FAFCD9; text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="background-color:#FDE9D8;">
                    <input class="input-xlarge toclear" type="text" id="" name="sub_menu_name[]" placeholder="Enter Submenu title" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('sub_menu_name[]'); ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="sub_menu_order[]" placeholder="Enter Submenu order" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FDE9D8;">
                 
                   <select onchange="type_(this)" id="sub_menu_type[]" name="sub_menu_type[]" style="width:99.5%;margin:0; padding:0;height:22px;">
                   
                   	 <option <?php if(set_value('sub_menu_type[]') == '0') { ?> selected="selected" <?php } ?> value="0" id="sub_internal" >Internal</option>
					 <option <?php if(set_value('sub_menu_type[]') == '1') { ?> selected="selected" <?php } ?> value="1" id="sub_external" >External</option>
                    </select>
                    </td>
                    
                    <td width="40%" style="background-color:#FDE9D8;display:none;" id="submenu_link2">
                 
                   <input class="toclear" type="text" id="" name="sub_menu_link[]" placeholder="Enter Submenu link" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('sub_menu_link[]'); ?>">
                    </td>
                   
                     </tr>   
                  </table>
           		</div>	
            
             </br>  
                <span class="help-inline"> <?php echo form_error('sub_menu_name[]'); ?></span>
                 
             </div>	
       
       
       <div class="control-group <?php if(form_error('menu_order')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>

                <div class="controls">

                    <input style="width:90px;" type="text" id="page_order" name="menu_order" value="<?php echo set_value('menu_order'); ?>">

                    <span class="help-inline"><?php echo form_error('menu_order'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('menu_status')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Status</label>

                <div class="controls">

                    <select name="menu_status" style="width:100px;">

					<?php if(set_value('menu_status') == '0')

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

                    <span class="help-inline"><?php echo form_error('menu_status'); ?></span>

                </div>

            </div>

	   
	   <?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="menu_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="menu_created_by" value="<?php echo 'admin';?>">

          

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

<script type="text/javascript">

function removeThisField(item)

{

	if($(".addremove").length== '1')

	{

		alert("Minimum one field are required");

	}

	else

	{

		$(item).parent(".addremove").remove();	

	}

}

function addNewField(item)

{

	$(item).parent(".addremove").after($(item).parent(".addremove").clone());

	$(item).parent(".addremove").next(".addremove").find(".toclear").val("");
	

}	

</script>
<script language="javascript">
$(function(){



	$("#external").click(function () {

	$('#menu_link').show();

	});
	
	$("#internal").click(function () {

	$('#menu_link').hide();

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
function type_(id)
{
	if(id==0)
	{
		//document.getElementsByName('submenu_link1').display = "block";
		//document.getElementById("submenu_link1").display="block";
		//alert(document.getElementsByName('sub_menu_type[]').length);
		//alert($('#sub_menu_type[]').val()); 
		//cost=document.myform.elements['sub_menu_type[]'].value;
		//document.write(cost);
		//$("#submenu_link1").hide();
		
		$("#submenu_link2").hide();
		
	}
	else
	{
		//document.getElementById("submenu_link1").colSpan="1";	
		//$("#submenu_link1").show();
		$("#submenu_link2").show();
	}
}

</script>

