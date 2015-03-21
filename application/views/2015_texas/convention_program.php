<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('pm_desc1');});
		bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('pm_desc2');});
</script>
<style>
 .facebook-l  li{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important;
	 
 }
  .facebook-l{
	  width:100%;
	  float:left;
 }
 .generalsponsors
 {
 	width: 100%;
	background-color: #333333;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .grandsponsors
 {
 	width: 100%;
	background-color:#F89406;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .silversponsors
 {
 	width: 100%;
	background-color: #999999;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .goldsponsors
 {
 	width: 100%;
	background-color: #FFD700;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .table th, .table td
 {
 	line-height:15px;
	border-top:solid #000 1px;
 }
 .trodd
{
	background-color:#F9F8F8;
}
.treven
{
	background-color:#F9F8F8;
}
.tbl_class1 tr td
{ 
 background:#f9f8f8; 
}
.tbl_class2 tr td,.tbl_class2 th
{ 
  border:solid #5A5A5A 1px;	
}

.tbl_class3 tr td,.tbl_class2 th
{ 
  border-left:solid #5A5A5A 1px;
  border-right:solid #5A5A5A 1px;	
}

.menu_clr
{
	color:#469AE9;

}
.ped_l {
	padding-left:5px;
}
.title-bor{background-color:#469AE9; color:#FFF; border:solid #004e97 1px; padding:0 0 0 5px;}
 </style>
 <?php if(count($query)>0) {?>
<div class="welcome-title-logo">
   <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
		Program List
    </div>
</div>
<div style="clear:both;" class="space10px"></div>
<table border="0" style="margin: 10px 0px 0px 0px; width:100%; border:#000 1px solid;" class="table" >
			<tr class="title-bor" style=" color:#FFF;">
        	<th scope="col">Type</th>
            <th scope="col">Member Name</th>
            <th scope="col">Participant Name(age)</th>
            <th scope="col">Choreographer Name</th>
            <th scope="col">Choreographer Email</th>
            <th scope="col">Choreographer Phone</th>
			</tr>
			<?php 
			if ($query)
			{
				$i=0;
			  foreach ($query as $row)
				{

					if($i%2==0)
					{
					?>
					<tr class="trodd">
					<td><?php echo $row->pm_type; ?></td>
					<td>
					<?php 
						$member_name = $this->dbconvention->get_member_name($row->pm_mm_id); 
						foreach($member_name as $member) 
						{
							echo $member->mm_fname.' '.$member->mm_lname;
						}
					?>
            		</td>
					<?php
						$participant='';
						$pm_to_participant = $this->dbconvention->pm_to_participant($row->pm_id);
						foreach($pm_to_participant as $allparticipant)
						{
							$participant .=$allparticipant->pm_member_name.'('.$allparticipant->pm_age.'),'.' ';
						}
					?>
                    <td><div style="width:200px;"><?php echo $rest = substr($participant, 0,-2);?></div></td>
					<td><?php echo $row->pm_choreo_name; ?></td>
					<td><?php echo $row->pm_choreo_email; ?></td>
					<td><?php echo $row->pm_choreo_phone; ?></td>
					</tr>	
					<?php 
					}
					else
					{
					?>
					<tr class="trodd">
					<td><?php echo $row->pm_type; ?></td>
					<td>
					<?php 
						$member_name = $this->dbconvention->get_member_name($row->pm_mm_id); 
						foreach($member_name as $member) 
						{
							echo $member->mm_fname.' '.$member->mm_lname;
						}
					?>
            		</td>
					<?php
						$participant='';
						$pm_to_participant = $this->dbconvention->pm_to_participant($row->pm_id);
						foreach($pm_to_participant as $allparticipant)
						{
							$participant .=$allparticipant->pm_member_name.'('.$allparticipant->pm_age.'),'.' ';
						}
					?>
                    <td><div style="width:200px;"><?php echo $rest = substr($participant, 0,-2);?></div></td>
					<td><?php echo $row->pm_choreo_name; ?></td>
					<td><?php echo $row->pm_choreo_email; ?></td>
					<td><?php echo $row->pm_choreo_phone; ?></td>
					</tr>
					<?php
					}
					$i++;
				}
			}				
			?>
			</table>
            <?php } ?>
		<div class="welcome-title-logo">
		<div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
		Program Entry Form</div>
		<div class="row-fluid">
           <div class="span10" style="margin:-10px 0 0 0;width:100%;">

			<div class="page_content">

            <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>

	
    <?php $member_detail = $this->dbconvention_header->get_username($this->session->userdata('user_email'));
	
			foreach($member_detail as $member){
?>
            <input class="" type="hidden" id="" name="pm_mm_id" value="<?php echo $member->mm_id; ?>">
            <?php } ?>

	<div class="row">
		<div class="control-group <?php if(form_error('pm_type')){ echo "error";}?>" style="float:left;width:auto;">

			<label class="control-label" for="inputError">Type</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_type" value="<?php echo set_value('pm_type'); ?>" placeholder="Enter Program Type">
</br>
                    <span class="help-inline"><?php echo form_error('pm_type'); ?></span>

                </div>

		</div>

            

		<div class="control-group <?php if(form_error('pm_length')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;">

			<label class="control-label" for="inputError">Length</label>

			<div class="controls">

				<input class="" type="text" id="covers_cat_name" name="pm_length" value="<?php echo set_value('pm_length'); ?>" placeholder="MM:SS">
</br>
                <span class="help-inline"><?php echo form_error('pm_length'); ?></span>

			</div>

		</div>
	</div>        
        
        <div class="control-group <?php if(form_error('pm_desc1')){ echo "error";}?>">
            <label style="" class="control-label <?php if(form_error('pm_desc1')){ echo "error";}?>" for="inputError">Description(1st Choice)</label>
				<div class="controls" style="">

                    <textarea class="" style="width:77%; height:116px;" id="pm_desc1" name="pm_desc1" placeholder="1st Choice"><?php echo set_value('pm_desc1'); ?></textarea>

                    <span class="help-inline"><?php echo form_error('pm_desc1'); ?></span>

                </div>
          </div>
          

		  <div class="control-group <?php if(form_error('pm_desc2')){ echo "error";}?>">   
          <label style="" class="control-label <?php if(form_error('pm_desc2')){ echo "error";}?>" for="inputError">Description(2nd Choice)</label>   
                <div class="controls" style="">

                    <textarea id="pm_desc2" class="" style="width:77%; height:116px;"  name="pm_desc2" placeholder="2nd Choice"><?php echo set_value('pm_desc2'); ?></textarea>

                    <span class="help-inline"><?php echo form_error('pm_desc2'); ?></span>

                </div>
                
            </div>    
			

		 
        <?php $ch_name = $this->dbconvention_header->get_ch_name_from_setting(); 
		 $ch_id = $this->dbconvention_header->get_ch_id($ch_name->ch_name); ?>
		
        <input type="hidden" id="pm_ch_id" name="pm_ch_id" value="<?php echo $ch_id->ch_id; ?>">
            
            <div class="control-group <?php if(form_error('pm_choreo_name')){ echo "error";}?>" >
    
                <label class="control-label" for="inputError">Choreographer Name</label>
    
                    <div class="controls">
    
                        <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_name" value="<?php echo set_value('pm_choreo_name'); ?>" 
                        placeholder="Enter Choreographer Name">
                        </br>
                        <span class="help-inline"><?php echo form_error('pm_choreo_name'); ?></span>
    
                    </div>
            </div>
     
        
        
        <div class="row">

            
            <div class="control-group <?php if(form_error('pm_choreo_email')){ echo "error";}?>" style="float:left;width:auto;">

			<label class="control-label" for="inputError">Choreographer Email</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_email" value="<?php echo set_value('pm_choreo_email'); ?>" placeholder="Enter Choreographer Email">
					</br>
                    <span class="help-inline"><?php echo form_error('pm_choreo_email'); ?></span>

                </div>
            </div>
            
            <div class="control-group <?php if(form_error('pm_choreo_phone')){ echo "error";}?>" style="float:left;width:auto;margin-left:50px;">

			<label class="control-label" for="inputError">Choreographer Phone</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="pm_choreo_phone" value="<?php echo set_value('pm_choreo_phone'); ?>" placeholder="Enter Choreographer Phone">
					</br>
                    <span class="help-inline"><?php echo form_error('pm_choreo_phone'); ?></span>

                </div>
            </div>
    	</div>            
        
        
      
                  
		<div class="control-group <?php if(form_error('pm_name[]') || form_error('pm_age[]')){ echo "error";}?>" >

				<label class="control-label">Participant</label>
                 <div style="width:100%;  float:left;">
                  
            <table width="60%"  border="1" class="tbl_class1">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th class="title-bor" width="50%">Name of Participant</th>
                    
                    <th class="title-bor"  width="10%">Age</th>
                   
                   
                    
                    
                  </tr>
             </table>
             
             </div>
                
             
             <div  class="addremove" style="width:100%;float:left;height:25px">
             
             <a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:250px;"></i>

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
                    <input class="input-xlarge toclear" type="text" id="" name="pm_name[]" placeholder="Enter Participant Name" style=" width:99.8%; margin:0; padding:0;" value="<?php echo set_value('pm_name[]'); ?>">
                    </td>
                    
                    <td  width="10%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="pm_age[]" placeholder="Age" style=" width:99%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    
                   
                     </tr>   
                  </table>
                  
                
			</div>		
                  
            <div  class="addremove" style="width:100%;float:left;height:25px">
             
            	<a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:250px;"></i>

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
                    <input class="input-xlarge toclear" type="text" id="" name="pm_name[]" placeholder="Enter Participant Name" style=" width:99.8%; margin:0; padding:0;" value="<?php echo set_value('pm_name[]'); ?>">
                    </td>
                    
                    <td  width="10%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="pm_age[]" placeholder="Age" style=" width:99%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    
                   
                     </tr>   
                  </table>
                  
               
			</div>      
					
            <div  class="addremove" style="width:100%;float:left;height:25px">
             
            	<a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:250px;"></i>

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
                    <input class="input-xlarge toclear" type="text" id="" name="pm_name[]" placeholder="Enter Participant Name" style=" width:99.8%; margin:0; padding:0;" value="<?php echo set_value('pm_name[]'); ?>">
                    </td>
                    
                    <td  width="10%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="pm_age[]" placeholder="Age" style=" width:99%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    
                   
                     </tr>   
                  </table>
                 
                
			</div>      
					
            <div  class="addremove" style="width:100%;float:left;height:25px">
             
             	<a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:250px;"></i>

				</a>
             
             <a title="Add New Field" onclick="addNewField(this);">

				<i class="icon-edit" style="background-position:0 -96px;float:right"></i>

				</a>
					
           		<table width="60%"   border="1" >
					<tr>
                  	
                    <td width="50%" style="background-color:#FDE9D8;">
                    <input class="input-xlarge toclear" type="text" id="" name="pm_name[]" placeholder="Enter Participant Name" style=" width:99.8%; margin:0; padding:0;" value="<?php echo set_value('pm_name[]'); ?>">
                    </td>
                    
                    <td  width="10%" style="background-color:#FDE9D8;">
                 
                   <input class="toclear" type="text" id="" name="pm_age[]" placeholder="Age" style=" width:99%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    
                   
                     </tr>   
                  </table>
               
			</div>
                 
                   </br>  
                <span class="help-inline"> <?php echo form_error('pm_name[]'); ?></span>
                 
             </div>
             

                
             
             <div style="clear:both"></div>

				
					

		<?php date_default_timezone_set("Asia/Kolkata"); ?>    

        <input type="hidden" id="" name="pm_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        
        <?php foreach($member_detail as $user){?>

        <input type="hidden" id="" name="pm_created_by" value="<?php echo $user->mm_username;?>">

          <?php } ?>

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />


        </div>



</div>
       </div>
</div>






<style>
[class^="icon-"],
[class*=" icon-"] {
  display: inline-block;
  width: 14px;
  height: 14px;
  margin-top: 1px;
  *margin-right: .3em;
  line-height: 14px;
  vertical-align: text-top;
  background-image: url("<?php echo base_url();?>images/glyphicons-halflings.png");
  /*background-position: 14px 14px;*/
  background-repeat: no-repeat;
}


</style>

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
</body>
</html>
