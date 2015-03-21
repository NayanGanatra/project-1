<?php $this->load->view('admincp_convention_texas/layout/header'); ?>
<script type="text/javascript">
/*
bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('page_content');});
*/
</script>
<style>
.anchor_add_remove{
	height: 1px;
    left: 101%;
    position: relative;
    top: -25px;
	float:left;
	/*padding-top: 3px;*/
	/*height: 25px;*/
}
</style>

<table class="tbl_class" width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">

		        <h1>Form <small>Add</small></h1>

		</div>

        <hr />

         	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>
			<?php
			$chapter = $this->dbform->get_chapter_from_mm_id(12363);
			//var_dump($chapter->ch_name);
			?>
           
           <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:30%">
                <b>Registration Form : </b>
                </div>
                <div style="float:left; width:30%;">
                SPCS Chapter : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->ch_name; ?></b>
                </div>
                <div style="float:left; width:40%">
                 Life Member Number :    L M - <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_life_id;?></b>
                </div>
           </div>
         <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:33%">
                Last name : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_lname; ?></b>
                </div>
                <div style="float:left; width:33%">
                 First Name :  <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_fname; ?></b>
                </div>
                <div style="float:left; width:33%">
                 Middle Name : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_father_name;?></b>
                </div>
           </div>
          <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:100%">
                Address : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_address; ?></b>
                </div>
           </div>
           <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:33%">
                <?php $get_cities = $this->dbform->cities($chapter->mm_city_id);?>
                City : <b><?php echo $get_cities->city_name; ?></b>
                </div>
                <div style="float:left; width:33%">
                <?php $get_state = $this->dbform->state($chapter->mm_state_id);?>
                State : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $get_state->state_name; ?></b>
                </div>
                <div style="float:left; width:33%">
                <?php //$get_state = $this->dbform->state($chapter->mm_state_id);?>
                Zip Code : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php //echo $get_state->state_name; ?></b>
                </div>
           </div>
           <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:33%">
                Email : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_email; ?></b>
                </div>
                <div style="float:left; width:33%">
                Phone No (H) : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_hphone ; ?></b>
                </div>
                <div style="float:left; width:33%">
                (C) : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_cphone; ?></b>
                </div>
           </div>
           <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:66%">
                Emergency Contact Name (Not Listed Below) :  <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_email; ?></b>
                </div>
                <div style="float:left; width:33%">
                Phone : <b style=" border-bottom:1px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_hphone ; ?></b>
                </div>
           </div>
           <div style="width:100%; line-height:35px;">
           		<div style="float:left; width:100%">
                <b>
                * Please list and fill all details about each person registering for Convention (Including Registrant) - Calculate the fee based on table above.  
                </b>

                </div>
           </div>
           <div style="width:100%;  float:left;">
            <table width="100%"  border="1">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th style="background-color:#FAFCD9" width="30%">Name of Attendees</th>
                    <th style="background-color:#FAFCD9" width="12%">Relationship</th>
                    <th style="background-color:#FAFCD9" width="8%">Age</th>
                    <th style="background-color:#FFCC99"  width="15%">Menu Choice<br />T/C</th>
                    <th style="background-color:#CCEBFF" width="15%">Age Group<br />(A-E)</th>
                    <th style="background-color:#CCEBFF" width="10%">Fee</th>
                    
                  </tr>
             </table>
             </div>
             <div style="width:100%;  float:left;">
             <div>
             <?php
			 for($i=0;$i<4;$i++) { ?>
             <div  class="controls addremove"  style="height: 25px;">
           		<table width="100%"   border="1" >
					<tr>
                  	<!--<td width="5%" style="background-color:#FAFCD9; text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="background-color:#FAFCD9;">
                     <input class="toclear" type="text" id="name[]"  name="name[]"  value="<?php echo set_value('name[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="background-color:#FAFCD9;">
                     <input class="toclear" type="text" id="rel[]"  name="rel[]"  value="<?php echo set_value('rel[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td  width="8%" style="background-color:#FAFCD9;">
                 
                    <input class="toclear"  onkeyup="ageof()" onkeypress="ageof()"  id="age[]"  name="age[]"  type="text" value="<?php echo set_value('age[]'); ?>"  style=" width:98%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#FFCC99;">
                     <input class="toclear" type="text"  id="menu_ch[]"  name="menu_ch[]" value="<?php echo set_value('menu_ch[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#CCEBFF;">
                     <input class="toclear"  id="age_grp[]" name="age_grp[]"  type="text" value="<?php echo set_value('age_grp[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#CCEBFF;">
                     <input class="toclear"    id="fees[]"  name="fees[]" type="text"  value="<?php echo set_value('fees[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                   
                     </tr>   
                  </table>
                  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove">
						<i class="icon-edit" style="background-position:0 -96px;"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" >
						<i class="icon-minus-sign"></i>
					</a>
                  </div>
                  <?php
			 }?>
                  </div>
                  <table  border="1">
                      <tr>
                          <!--<td width="5%"   style="background-color:#FAFCD9; text-align:center"></td>-->
                          <td width="30%"   style="background-color:#FAFCD9;"><b><?php echo 'Total';?></b></td>
                          <td  width="12%"  style="background-color:#FAFCD9; text-align:center"></td>
                          <td width="8%"   style="background-color:#FAFCD9; text-align:center"></td>
                          <td width="15%"  style="background-color:#FAFCD9; text-align:center"></td>
                          <td width="15%"   style="background-color:#FAFCD9; text-align:center"></td>
                          <td width="10%"   style="background-color:#FAFCD9; text-align:center">
                          <input disabled="disabled"  id="fees_total" type="text"  name="fees_total" value=""  style="width:99%; margin:0; padding:0;"/>
                          </td>                  
                      </tr>    
                </table>
             </div>
             <div style="clear:both"></div>
             <?php if(form_error('name[]') || form_error('rel[]') || form_error('age[]') || form_error('menu_ch[]') || form_error('age_grp[]') || form_error('fees[]')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } ?>
             <div class="space20px"></div>  
  			
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="mm_id" value="12363">
            <input type="hidden" id="" name="fees_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="fees_created_by" value="<?php echo 'admin';?>">
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
	</td>
  </tr>
</table>
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>
<script language="javascript">
function ageof()
{
	var t=0;
	//for(var i=0;i<;i++)
	var age = document.getElementsByName('age[]');
	var age_grp = document.getElementsByName('age_grp[]');
	var fees = document.getElementsByName('fees[]');
	//alert(age.length);
		
	var ln = fees.length;
	for (var i = 0, l = ln; i < l; i++) 
	{
		if(age[i].value <= 6)
		{
			age_grp[i].value='A';
			fees[i].value='Free';
			
		}
		if(age[i].value > 6 &&  age[i].value <= 25)
		{
			age_grp[i].value='B';
			fees[i].value='49';
		}
		if(age[i].value >= 26)
		{
			age_grp[i].value='C';
			fees[i].value='149';
			
		}
		if(age[i].value == '')
		{
			age_grp[i].value='';
			fees[i].value='';
			
		}
		
		j=fees[i].value;
		if(j=='' || j=='Free')
		{
		j=0;
		}
		else
		{
		t=parseInt(t)+parseInt(fees[i].value);
		}
	}
	document.getElementById('fees_total').value=t;
}
function removeThisField(item)

{

	if($(".addremove").length==4)

	{

		alert("Minimum 4 field are required");

	}

	else

	{

		$(item).parent(".addremove").remove();	

	}

}

function addNewField(item)

{
	//alert(item);
	$(item).parent(".addremove").after($(item).parent(".addremove").clone());
	//$(item).parent(".addremove").clone();
  	/*var fees = document.getElementsByName('fees[]');
	var ln = fees.length;
	//alert(ln);
//	$(item).parent(".addremove").next(".addremove").children(".toclear").val("");
    /*$(item).parent(".addremove").next(".addremove").find(".static").html('<b>'+ln+'</b>');*/
	$(item).parent(".addremove").next(".addremove").find(".toclear").val("");
}	
</script>