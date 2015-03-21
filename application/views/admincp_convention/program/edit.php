
<?php $this->load->view('admincp_convention/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('pm_desc1');});
		bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('pm_desc2');});
</script>

<script type="text/javascript">

	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Program <small>Edit Program</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>
            
            <div >
                    		

                        <a href="<?php echo base_url('admincp_convention/program/program_detail_export_to_excel/'.$get_program->pm_id.'');?>" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" >Export to excel</a>

                        

                      
                    </div>
           
            <hr>
            
            <div class="control-group <?php if(form_error('pm_mm_id')){ echo "error";}?>">

                <label class="control-label">Member Name</label>

                <div class="controls">

                <select name="pm_mm_id" data-placeholder="Select a Member..." class="chzn-select" style="width:400px;" tabindex="1">

                  <option value="" <?php if(set_value('pm_mm_id') == '') {?> <?php } ?> ></option>

                  <?php

				  	$members = $this->dbprogram->all_members();

					foreach($members as $members_row)

					{
						$con_members = $this->dbprogram->all_con_members($members_row->mm_id);
						foreach($con_members as $con_members_row)
						{
						?>

							

						<option <?php if($get_program->pm_mm_id == $con_members_row->mm_id) { ;?> selected="selected" <?php }?> value="<?php echo $con_members_row->mm_id; ?>"><?php echo $con_members_row->mm_fname.' '.$con_members_row->mm_lname.' - '.$con_members_row->mm_email; ?></option>

                        <?php 
						}
					}

				  ?>                  

                </select>

                <span class="help-inline"> <?php echo form_error('pm_mm_id'); ?></span>

                </div>

                </div>

	<div class="row">
		<div class="control-group <?php if(form_error('pm_type')){ echo "error";}?>" style="float:left;width:auto;">

			<label class="control-label" for="inputError">Type</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_type" value="<?php echo $get_program->pm_type; ?>" placeholder="Enter Program Type">
</br>
                    <span class="help-inline"><?php echo form_error('pm_type'); ?></span>

                </div>

		</div>

            

		<div class="control-group <?php if(form_error('pm_length')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;">

			<label class="control-label" for="inputError">Length</label>

			<div class="controls">

				<input class="" type="text" id="covers_cat_name" name="pm_length" value="<?php echo $get_program->pm_length; ?>" placeholder="Enter Program Length">
</br>
                <span class="help-inline"><?php echo form_error('pm_length'); ?></span>

			</div>

		</div>
	</div>        
        
        
        <div class="control-group <?php if(form_error('pm_desc1')){ echo "error";}?>">
            <label style="" class="control-label <?php if(form_error('pm_desc1')){ echo "error";}?>" for="inputError">Description(1st Choice)</label>
				<div class="controls" style="">

                    <textarea class="" style="width:60%;" id="pm_desc1" name="pm_desc1"><?php echo $get_program->pm_ch1; ?></textarea>

                    <span class="help-inline"><?php echo form_error('pm_desc1'); ?></span>

                </div>
          </div>
          

		  <div class="control-group <?php if(form_error('pm_desc2')){ echo "error";}?>">   
          <label style="" class="control-label <?php if(form_error('pm_desc2')){ echo "error";}?>" for="inputError">Description(2nd Choice)</label>   
                <div class="controls" style="">

                    <textarea id="pm_desc2" class="" style="width:60%;"  name="pm_desc2"><?php echo $get_program->pm_ch2; ?></textarea>

                    <span class="help-inline"><?php echo form_error('pm_desc2'); ?></span>

                </div>
                
            </div>
        
       
				<?php $ch_name = $this->dbprogram->get_ch_name_from_setting(); 
                 $ch_id = $this->dbprogram->get_ch_id($ch_name->ch_name); ?>
           
    
           <input type="hidden" id="pm_ch_id" name="pm_ch_id" value="<?php echo $ch_id->ch_id; ?>">
    				
            <div class="control-group <?php if(form_error('pm_choreo_name')){ echo "error";}?>">
    
                <label class="control-label" for="inputError">Choreographer Name</label>
    
                    <div class="controls">
    
                        <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_name" value="<?php echo $get_program->pm_choreo_name; ?>" 
                        placeholder="Enter Choreographer Name">
                        </br>
                        <span class="help-inline"><?php echo form_error('pm_choreo_name'); ?></span>
    
                    </div>
            </div>
        
        
        
        
       
        
        <div class="row">
            
            <div class="control-group <?php if(form_error('pm_choreo_email')){ echo "error";}?>" style="float:left;width:auto;">

			<label class="control-label" for="inputError">Choreographer Email</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_email" value="<?php echo $get_program->pm_choreo_email; ?>" placeholder="Enter Choreographer Email">
					</br>
                    <span class="help-inline"><?php echo form_error('pm_choreo_email'); ?></span>

                </div>
            </div>
            
            <div class="control-group <?php if(form_error('pm_choreo_phone')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;">

			<label class="control-label" for="inputError">Choreographer Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_phone" value="<?php echo $get_program->pm_choreo_phone; ?>" placeholder="Enter Choreographer Phone">
					</br>
                    <span class="help-inline"><?php echo form_error('pm_choreo_phone'); ?></span>

                </div>
            </div>
    	</div>
        
        <?php $total_member = $this->dbprogram->total_member($get_program->pm_id); ?>
		
     <div class="control-group <?php if(form_error('pm_name[]') || form_error('pm_age[]')){ echo "error";}?>" >
       <label class="control-label">Participant</label>
       
       <div style="width:100%;  float:left;">
                  
            <table width="60%"  border="1">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th style="background-color:#D6E3BB" width="50%">Name of Participant</th>
                    
                    <th style="background-color:#D6E3BB" width="10%">Age</th>
                    
                  </tr>
             </table>
             
        </div>
       
       <?php 
	   			
	  		for($i=0;$i<count($total_member);$i++) {
	   ?>
       
       
       		 
                <div  class="addremove" style="width:100%;float:left;height:25px">
             
             <a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:370px;"></i>

				</a>
             
             <a title="Add New Field" onclick="addNewField(this);">

				<i class="icon-edit" style="background-position:0 -96px;float:right"></i>

				</a>

				
					
           		<table width="60%"   border="1" >
					<tr>
                  	<!--<td width="5%" style="background-color:#FAFCD9; text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="50%" style="background-color:#FDE9D8;">
                    <input class="input-xlarge toclear" type="text" id="" name="pm_name[]" placeholder="Enter Participant Name" style=" width:99.8%; margin:0; padding:0;" value="<?php echo $total_member[$i]->pm_member_name; ?>">
                    </td>
                    
                    <td  width="10%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="pm_age[]" placeholder="Age" style=" width:99%; margin:0; padding:0;" value="<?php echo $total_member[$i]->pm_age; ?>">
                    </td>
                    
                    
                   
                     </tr>   
                  </table>
                  
                
			</div>
            <?php } ?>
            </br>  
                <span class="help-inline"> <?php echo form_error('pm_name[]'); ?></span>	
           </div>          
        			

		<?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="pm_created_date" value="<?php echo $get_program->pm_created_date; ?>">

        <input type="hidden" id="" name="pm_created_by" value="<?php echo $get_program->pm_created_by; ?>">
        
        <input type="hidden" id="" name="pm_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="pm_modified_by" value="<?php echo 'admin';?>">

          

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />



	</td>

  </tr>

</table>
<style>
a#exportexcel {
    background-color: #0081C2;
    background-image: linear-gradient(to bottom, #0088CC, #0077B3);
    background-repeat: repeat-x;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 6px 6px 6px 6px;
    color: #FFFFFF;
    display: block;
    font-weight: normal;
    line-height: 20px;
    padding: 3px 20px;
    text-align: center;
    text-decoration: none;
    white-space: nowrap;
    width: 50px;
}
</style>
<?php $this->load->view('admincp_convention/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

<script type="text/javascript">

function removeThisField(item)

{

	if($(".addremove").length==4)

	{

		alert("Minimum four field are required");

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