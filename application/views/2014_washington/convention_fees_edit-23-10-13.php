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
.formA
{
	margin:0  !important;

}
.tbl_class1 tr td
{ 
 background:#f9f8f8; border:solid #E8E8E8 1px;	
}
.tbl_class2 tr td,.tbl_class2 th
{ 
  border:solid #5A5A5A 1px;	
}

.tbl_class3 tr td,.tbl_class2 th
{ 
  border-left:solid #5A5A5A 1px;	 border-right:solid #5A5A5A 1px;	
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
<table class="tbl_class" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; width:100%;"> 
  <tr>
  	<td>
    
         	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open('', $form_attributes);

            ?>
<?php
		if ($query1)
		{
			$grandtotal = $query1->fm_total_fee;
			$em_name = $query1->fm_em_con_name;
			$em_number = $query1->fm_em_con_num;
			$zipcode = $query1->fm_zipcode;
			$chapter = $this->dbconvention_registration->get_chapter_from_mm_id($query1->mm_id);
			$id = $query1->fees_st_id;
			$item = $this->dbconvention_registration->get_fees_st_detail_by_id($id);
			$itema = $this->dbconvention_registration->get_fees_group_detail_by_id($id,'A');
			$itemb = $this->dbconvention_registration->get_fees_group_detail_by_id($id,'B');
			$itemc = $this->dbconvention_registration->get_fees_group_detail_by_id($id,'C');
			
		}
		?>
		<table border="0" width="100%" cellpadding="2" cellspacing="0" class="tbl_class1">
           <tr>
           <td colspan="3">
           		<div style="float:left;">
                <b class="menu_clr ped_l">Registration Form : </b>
                </div>
           </td>
           </tr>
           <tr>
           <td style="width:30%;">
           <div style="float:left; " class="ped_l">
                SPCS Chapter:<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->ch_name; ?></b>
                </div>
           </td>
           <td style="width:60%;" colspan="2">
           <div style="float:left;" class="ped_l" >
                 Life Member Number :    L M - <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_life_id;?></b>
                </div>
           </td>
           </tr>
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                Last name : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_lname; ?></b>
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                 First Name :  <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_fname; ?></b>
                </div>
           </td>
           <td>
				<div style="float:left;" class="ped_l">
                Address : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_address; ?></b>
                </div>
           </td>
           </tr>
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                <?php $get_cities = $this->dbconvention_registration->cities_reg($chapter->mm_city_id);?>
                City : <b><?php echo $get_cities->city_name; ?></b>
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                <?php $get_state = $this->dbconvention_registration->state_reg($chapter->mm_state_id);?>
                State : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $get_state->state_name; ?></b>
                </div>
           </td>
           <td>
				<div style="float:left;" class="ped_l"> 
                <div class="<?php if(form_error('txtzipcode')){ echo "error";}?>"> 
            	<div class="controls">
                    Zip Code : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $zipcode; ?></b>
                </div>
           		</div>
                </div>
           </td>
            
           </tr>
            
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                Phone No (H) : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_hphone ; ?></b>
                </div>
           </td>
           <td colspan="2">
           		 <div style="float:left;" class="ped_l">
                (C) : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_cphone; ?></b>
                </div>
           </td>
           </tr>
           <tr>
           <td colspan="3">
           		<div style="float:left;" class="ped_l">
                Email : <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_email; ?></b>
                </div>
           </td>
           </tr>
           <tr>
           <td colspan="3">
           		<div style="float:left;" class="ped_l">
         		<div class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
            	<div class="controls">
				Emergency Contact Name(Not Listed Below) :<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $em_name; ?></b>
				</div>
				</div>
                </div>
           </td>
          
        
           </tr>
		   <tr>
		     <td colspan="3">
           		 <div style="float:left;" class="ped_l">
               <div class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
            	<div class="controls">
				<label style="width:68px; float:left">Phone :</label><b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $em_number; ?></b>
                </div>
				</div>
				</div>
           </td>
		   </tr>
           </table>
            <div style="width:100%; line-height:20px; margin:20px 0 5px 0px; float:left">
           		<div style="float:left; width:100%">
                <b>
                * Please list and fill all details about each person registering for Convention (Including Registrant) <br />- Calculate the fee based on table above.  
                </b>

                </div>
           </div>
           <div style="width:100%;  float:left;" >
            <table width="100%"  border="0" class="tbl_class2">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th class="title-bor" width="30%">Name of Attendees</th>
                    <th class="title-bor" width="12%">Relationship</th>
                    <th class="title-bor" width="8%">Age</th>
                    <th class="title-bor"  width="15%">Menu Choice<br />T/C</th>
                    <th class="title-bor" width="15%">Age Group<br />(A-E)</th>
                    <th class="title-bor" width="10%">Fee</th>
                    
                  </tr>
             </table>
             </div>
             <div style="width:100%;  float:left;">
             <div>
      	<?php
		if ($query)
		{
			foreach ($query as $row)
		    {
			?>
             <div  class="controls addremove">
           		<table width="100%"   border="0" class="tbl_class3" >
                
					<tr>
                  	<td width="30%" style="" class="ped_l">
                     <?php echo $row->fmg_att_name; ?>
                    </td>
                    <td width="12%" style="" class="ped_l">
                     <?php echo $row->fmg_mm_rel; ?>
                    </td>
                    <td  width="8%" style="" class="ped_l">
                 	<?php echo $row->fmg_mm_age; ?>
                    </td>
                    <td width="15%" style="" class="ped_l">
                    <?php echo $row->fmg_menu_choice; ?>
                    </td>
                    <td width="15%" style="" class="ped_l">
                    <?php echo $row->fmg_age_grp; ?>
                    </td>
                    <td width="10%" style=" text-align:right;" class="ped_l">
                     <?php echo $row->fmg_fees; ?>
                    </td>
                    </tr>   
                  </table>
                  </div>
                   <input  id="id[]"  name="id[]" type="hidden"  value="<?php echo $row->fmg_id; ?>"/>
                    
                 <?php
				 
			}
		}
			?>
                  </div>
                  <table  border="0" class="tbl_class2">
                      <tr>
                          <!--<td width="5%"   style=" text-align:center"></td>-->
                          <td width="30%" class="ped_l menu_clr"   style=""><b><?php echo 'Total';?></b></td>
                          <td  width="12%"  style=" text-align:center"></td>
                          <td width="8%"   style=" text-align:center"></td>
                          <td width="15%"  style=" text-align:center"></td>
                          <td width="15%"   style=" text-align:center"></td>
                          <td width="10%"   style=" text-align:center">
                          <input disabled="disabled" id="fees_total" type="text"  name="fees_total" value="<?php echo $grandtotal; ?>" class="ped_l"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                          </td>                  
                      </tr>    
                </table>
             </div>
             <div style="clear:both"></div>
             <div class="space20px"></div>  
   <?php if(form_error('name[]') || form_error('rel[]') || form_error('age[]') || form_error('menu_ch[]') || form_error('age_grp[]') || form_error('fees[]')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } ?>
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="mm_id" value="12363">
            <input type="hidden" id="" name="fees_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="fees_created_by" value="<?php echo 'admin';?>">
			
			<input type="hidden" id="groupaend" value="<?php echo $itema->end_age; ?>"/>
			<input type="hidden" id="groupbstart" value="<?php echo $itemb->start_age; ?>"/>
			<input type="hidden" id="groupbend" value="<?php echo $itemb->end_age; ?>"/>
			<input type="hidden" id="groupcend" value="<?php echo $itemc->start_age; ?>"/>
			
			<input type="hidden" id="childfeemem" value="<?php echo $itema->fees_st_mm_fee; ?>"/>
			<input type="hidden" id="childfeenonmem" value="<?php echo $itema->fees_st_non_mm_fee; ?>"/>
			<input type="hidden" id="childfeememlate" value="<?php echo $itema->fees_st_mm_late_fee; ?>"/>
			<input type="hidden" id="childfeenonmemlate" value="<?php echo $itema->fees_st_non_mm_late_fee; ?>"/>
			
			<input type="hidden" id="youngfeemem" value="<?php echo $itemb->fees_st_mm_fee; ?>"/>
			<input type="hidden" id="youngfeenonmem" value="<?php echo $itemb->fees_st_non_mm_fee; ?>"/>
			<input type="hidden" id="youngfeememlate" value="<?php echo $itemb->fees_st_mm_late_fee; ?>"/>
			<input type="hidden" id="youngfeenonmemlate" value="<?php echo $itemb->fees_st_non_mm_late_fee; ?>"/>
			
			<input type="hidden" id="oldfeemem" value="<?php echo $itemc->fees_st_mm_fee; ?>"/>
			<input type="hidden" id="oldfeenonmem" value="<?php echo $itemc->fees_st_non_mm_fee; ?>"/>
			<input type="hidden" id="oldfeememlate" value="<?php echo $itemc->fees_st_mm_late_fee; ?>"/>
			<input type="hidden" id="oldfeenonmemlate" value="<?php echo $itemc->fees_st_non_mm_late_fee; ?>"/>
			
			<input type="hidden" id="finaldate" value="<?php echo strtotime($item->final_date); ?>"/>
			<input type="hidden" id="currentdate" value="<?php echo strtotime(date('Y-m-d')); ?>"/>
			
	</td>
  </tr>
</table>

<script language="javascript">
/*function ageof()
{
	var t=0;
	
	var age = document.getElementsByName('age[]');
	
	var age_grp = document.getElementsByName('age_grp[]');
	var fees = document.getElementsByName('fees[]');
		
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
}*/
function ageof()
{
	var t=0;
	//for(var i=0;i<;i++)
	var age = document.getElementsByName('age[]');
	var age_grp = document.getElementsByName('age_grp[]');
	var fees = document.getElementsByName('fees[]');
	var hdnids = document.getElementsByName('hdnids[]');
	//alert(age.length);
	var groupaend = parseInt($("#groupaend").val());
	var groupbstart = parseInt($("#groupbstart").val());
	var groupbend = parseInt($("#groupbend").val());
	var groupcend = parseInt($("#groupcend").val());
	
	var childfeemem = parseInt($("#childfeemem").val());
	var childfeenonmem = parseInt($("#childfeenonmem").val());
	var childfeememlate = parseInt($("#childfeememlate").val());
	var childfeenonmemlate = parseInt($("#childfeenonmemlate").val());
	
	var youngfeemem = parseInt($("#youngfeemem").val());
	var youngfeenonmem = parseInt($("#youngfeenonmem").val());
	var youngfeememlate = parseInt($("#youngfeememlate").val());
	var youngfeenonmemlate = parseInt($("#youngfeenonmemlate").val());
	
	var oldfeemem = parseInt($("#oldfeemem").val());
	var oldfeenonmem = parseInt($("#oldfeenonmem").val());
	var oldfeememlate = parseInt($("#oldfeememlate").val());
	var oldfeenonmemlate = parseInt($("#oldfeenonmemlate").val());
	
	var finaldate = parseInt($("#finaldate").val());
	var currentdate = parseInt($("#currentdate").val());
	
	var ln = fees.length;
	for (var i = 0, l = ln; i < l; i++) 
	{
		if(age[i].value < groupaend)
		{
			age_grp[i].value='A';
			if(hdnids[i]!=undefined)
			{
				if(currentdate>finaldate)
				{
					fees[i].value = childfeememlate;
				}
				else
				{
					fees[i].value = childfeemem;
				}
			}
			else
			{
				if(currentdate>finaldate)
				{
					fees[i].value = childfeenonmemlate;
				}
				else
				{
					fees[i].value = childfeenonmem;
				}
			}
			
			
			
		}
		if(age[i].value >= groupbstart &&  age[i].value <= groupbend)
		{
			age_grp[i].value='B';
			if(hdnids[i]!=undefined)
			{
				if(currentdate>finaldate)
				{
					fees[i].value = youngfeememlate;
				}
				else
				{
					fees[i].value = youngfeemem;
				} 
			}
			else
			{
				if(currentdate>finaldate)
				{
					fees[i].value = youngfeenonmemlate;
				}
				else
				{
					fees[i].value = youngfeenonmem;
				}
			}
		}
		if(age[i].value >= groupcend)
		{
			age_grp[i].value='C';
			if(hdnids[i]!=undefined)
			{
				if(currentdate>finaldate)
				{
					fees[i].value = oldfeememlate;
				}
				else
				{
					fees[i].value = oldfeemem;
				}
			}
			else
			{
				if(currentdate>finaldate)
				{
					fees[i].value = oldfeenonmemlate;
				}
				else
				{
					fees[i].value = oldfeenonmem;
				}
			}
			
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

	if($(".addremove").length==1)

	{

		alert("Minimum 1 field is required");

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