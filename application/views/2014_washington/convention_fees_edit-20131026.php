<script type="text/javascript" src="js/jquery.min.js"></script>
<style>
.anchor_add_remove{
	height: 1px;
    left: 96%;
    position: relative;
    top: -25px;
	float:left;
	padding:2px;
	/*padding-top: 3px;*/
	/*height: 25px;*/
}

.add_rm
{
	position:relative;
	margin-left:0% !important;
	float:left;
}

.add_rm_before
{
	position:relative;
	margin-left:3%;
}
@media screen and (-webkit-min-device-pixel-ratio:0) {
    .mystyle{float:left;}
}
.formA
{
	margin:0  !important;

}
.tbl_class1 tr td
{ 
border-radius:5px; background:#f9f8f8; border:solid #E8E8E8 1px;	
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
			

                //$form_attributes = array('class' => 'formA', 'id' => 'myform');

                //echo form_open(base_url().$this->config->item('convention_folder_with_slash').'convention/registration/'.$query1->fm_id, $form_attributes);

            ?>
            <form name="myform" id="myform" action = <?php echo base_url().$this->config->item('convention_folder_with_slash'); ?>convention/registration/<?php echo $query1->fm_id; ?> method="post">
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
			<?php
			
			
			//$chapter = $this->dbconvention_registration->get_chapter_from_mm_id($this->session->userdata('user_id'));
			//var_dump($chapter);
			?>
           <table border="1" width="100%" cellpadding="2" cellspacing="0" class="tbl_class1">
           <tr>
           <td  colspan="3">
           		<div style="float:left;">
                <b class="menu_clr  ped_l">Registration Form : </b>
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
           <div style="float:left;" class="ped_l">
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
                City : <b><?php if(isset($get_cities->city_name)){ echo $get_cities->city_name; } ?></b>
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
                    Zip Code : <input type="text" placeholder="Enter zip code" style="width:200px; margin:0;"  id="txtzipcode" name="txtzipcode" value="<?php echo $zipcode; ?>"/>
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
				Emergency Contact Name(Not Listed Below) :<input type="text" placeholder="Enter name" style="width:424px;margin:0;" name="txtem_con_name" value="<?php echo $em_name; ?>"/>
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
				<label style="width:68px; float:left">Phone :</label><input type="text" placeholder="Enter number" style="width:424px;margin-left:218px;" name="txtem_con_number" value="<?php echo $em_number; ?>"/>
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
           <div style="width:100%;  float:left;">
            <table width="93%"  border="1" style="margin-left:3.1%;" >
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th class="title-bor" width="30%">Name of Attendees</th>
                    <th class="title-bor" width="2%%">Relationship</th>
                    <th class="title-bor" width="8%">Age</th>
                    <th class="title-bor" width="15%">Menu Choice<br />T/C</th>
                    <th class="title-bor"  width="15%">Age Group<br />(A-E)</th>
                    <th class="title-bor" width="10%">Fee</th>
                    
                  </tr>
             </table>
             </div>
             <div style="width:100%;  float:left;">
             <div>
	<?php
	$family_array = array();
	$count1 = 0;
		if ($query)
		{
			
			$count1 = 0;
			foreach ($query as $row)
		    {
				
				$total=0;
					
			if($row->fm_rel_mm_id != 0){ 	 
			?>
			  <div  class="controls addremove mystyle"  style="height: 25px;">
			 <div style="width:20px; float:left;">
             <input type="checkbox" style="float: left; margin-right: 1%;" onclick="is_check(this.value);" name="chkbx<?php echo $row->fm_rel_mm_id; ?>" value="<?php echo $row->fm_rel_mm_id; ?>" <?php if($query1->fm_id == $row->fm_id) {?> checked="checked" <?php } ?> class="hdnids" id="chk_<?php echo $row->fm_rel_mm_id; ?>"/>
			<input type="hidden" value="<?php echo $row->fm_rel_mm_id; ?>" name="hdnids[]" class="hdnids"/>
			</div>
           	
				<table width="93%" border="1" class="add_rm_before" style="margin-left:3.1%" >
					<tr>
                  	<!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="">
                     <input class="toclear" type="text" id="name[]"  <?php if($row->fm_rel_mm_id != 0){ ?> readonly="" <?php } ?> name="name[]" value="<?php echo $row->fmg_att_name; ?>" style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="">
                     <input class="toclear guest fees" type="text" id="rel[]" readonly="" name="rel[]" value="<?php echo $row->fmg_mm_rel;//$chapter->mm_relationship; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td  width="8%" style="">
                 
                    <input class="toclear" onkeyup="ageof()" <?php if($row->fm_rel_mm_id != 0){ ?> readonly="" <?php } ?> onkeypress="ageof();"  onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();" id="age_<?php echo $row->fm_rel_mm_id; ?>"  name="age[]"  type="text" value="<?php echo $row->fmg_mm_age; ?>"  style=" width:100%; margin:0; padding:0;"/>
                    <input type="hidden" id="hdnage_<?php echo $row->fm_rel_mm_id; ?>" value="<?php echo $row->fmg_mm_age; ?>">
                    </td>
                    <td width="15%" style="background-color:#7d7d7d;">
                     <input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php echo $row->fmg_menu_choice; ?>" style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#b4b4b4;">
					<?php
					$group = '';
					$amount = '';
					$age = $row->fmg_mm_age;
					if($age<$itema->end_age)
					{
						$group ='A';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itema->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itema->fees_st_mm_fee;
						}
					}
					else if($age>=$itemb->start_age && $age<=$itemb->end_age)
					{
						$group = 'B';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemb->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemb->fees_st_mm_fee;
						}
					}
					else if($age>=$itemc->start_age)
					{
						$group = 'C';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemc->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemc->fees_st_mm_fee;
						}
					}
					$total +=$amount;
					$count1++;
					?>
                     <input class="toclear fees"  id="age_grp[]" readonly="" name="age_grp[]"  type="text" value="<?php echo $row->fmg_age_grp; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#b4b4b4;">
					<input class="toclear fees"  id="fees[]" readonly="" name="fees[]" type="text" value="<?php echo $row->fmg_fees; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                    </td>
                   		<input  id="id[]"  name="id[]" type="hidden"  value="<?php echo $row->fmg_id; ?>"/>
                     </tr>   
                  </table>
                  	 
				   <?php if($row->fm_rel_mm_id == 0){ ?>
				  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove" style="">
						<i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="">
						<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
                    <?php } 
                    elseif($count1-1 == count($get_relationship)){ ?>
				  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove">
						<i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="display:none;">
						<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
                    <?php } ?>
                    
				  <?php 
				  array_push($family_array,$row->fm_rel_mm_id);
				  ?>
                  </div>
             <?php } } }
			 
			 ?>
             <?php
			 	if(!in_array($chapter->mm_id,$family_array)){
			 ?>
             <div  class="controls addremove mystyle"  style="height: 25px;">
			 <div style="width:20px; float:left;"><input type="checkbox" style="float: left; margin-right: 1%;" id="chk_<?php echo $chapter->mm_id; ?>" onclick="is_check(this.value);" name="chkbx<?php echo $chapter->mm_id; ?>" value="<?php echo $chapter->mm_id; ?>" class="hdnids"/>
			<input type="hidden" value="<?php echo $chapter->mm_id; ?>" name="hdnids[]" class="hdnids"/>
			</div>
           	
				<table width="93%" border="1" class="add_rm_before" style="margin-left:3.1%" >
					<tr>
                  	<!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="">
                     <input class="toclear" type="text" id="name[]" readonly="" name="name[]" value="<?php echo $chapter->mm_fname.' '.$chapter->mm_lname; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="">
                     <input class="toclear guest fees" type="text" id="rel[]" readonly="" name="rel[]" value="<?php echo "Self";//$chapter->mm_relationship; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td  width="8%" style="">
                 
                    <input class="toclear" id="age_<?php echo $chapter->mm_id; ?>" onkeyup="ageof()" readonly="" onkeypress="ageof();" onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();" id="age[]"  name="age[]"  type="text" value=""  style=" width:100%; margin:0; padding:0;"/>						<input type="hidden" id="hdnage_<?php echo $chapter->mm_id; ?>" value="<?php $age = date("Y")-$chapter->mm_birth_year; echo $age; ?>">
                    </td>
                    <td width="15%" style="background-color:#7d7d7d;">
                     <input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php echo set_value('menu_ch[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#b4b4b4;">
					<?php
					$group = '';
					$amount = '';
					$age = date("Y")-$chapter->mm_birth_year;
					if($age<$itema->end_age)
					{
						$group ='A';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itema->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itema->fees_st_mm_fee;
						}
					}
					else if($age>=$itemb->start_age && $age<=$itemb->end_age)
					{
						$group = 'B';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemb->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemb->fees_st_mm_fee;
						}
					}
					else if($age>=$itemc->start_age)
					{
						$group = 'C';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemc->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemc->fees_st_mm_fee;
						}
					}
					$total +=$amount;
					?>
                     <input class="toclear fees"  id="age_grp[]" readonly="" name="age_grp[]"  type="text" value="<?php echo $group; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#b4b4b4;">
					<input class="toclear fees"  id="fees[]" readonly="" name="fees[]" type="text" value="<?php echo $amount; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                    </td>
                   
                     </tr>   
                  </table>
				  
				  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove">
						<i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="display:none;">
						<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
				  
                  </div>
                <?php
				}
				?>
             
             
             
              <?php
			 if($get_relationship) {
			 $countcheck = 0;
			 
			 foreach($get_relationship as $family) { 
			 	
				 $fullname = $family->mm_fname.' '.$family->mm_lname;
				 if(in_array($family->mm_id,$family_array))
				 {
					 
				 }
				 else
				 {
			 $family_relation = '';
			 if($chapter->mm_relationship == 'Son' || $chapter->mm_relationship == 'Daughter')

								{

									if($family->mm_relationship == 'Wife' || ($family->mm_relationship == '' && $family->mm_gender == '1'))

									{

										$family_relation = 'Mother';

									}

									if($family->mm_relationship == 'Husband' || ($family->mm_relationship == '' && $family->mm_gender == '0') )

									{

										$family_relation = 'Father';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Brother';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Sister';

									}

								}

								

								if($chapter->mm_relationship == 'Wife')

								{

									if($family->mm_relationship == '')

									{

										$family_relation = 'Husband';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Son';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Daughter';

									}

								}

								

								if($chapter->mm_relationship == '')

								{

									if($family->mm_relationship == 'Wife')

									{

										$family_relation = 'Wife';

									}

									if($family->mm_relationship == 'Husband')

									{

										$family_relation = 'Husband';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Daughter';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Son';

									}

								}
						if($family_relation!='')
						{
							$countcheck++;
						}
						
			 		}
					}
						 
			 }
			 
			 if($get_relationship) {
			 $count = 0;
			 foreach($get_relationship as $family) { 
			
			 $fullname = $family->mm_fname.' '.$family->mm_lname;
				 if(in_array($family->mm_id,$family_array))
				 {
					 
				 }
				 else
				 {
				 $family_relation = '';
				 if($chapter->mm_relationship == 'Son' || $chapter->mm_relationship == 'Daughter')

								{

									if($family->mm_relationship == 'Wife' || ($family->mm_relationship == '' && $family->mm_gender == '1'))

									{

										$family_relation = 'Mother';

									}

									if($family->mm_relationship == 'Husband' || ($family->mm_relationship == '' && $family->mm_gender == '0') )

									{

										$family_relation = 'Father';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Brother';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Sister';

									}

								}

								

								if($chapter->mm_relationship == 'Wife')

								{

									if($family->mm_relationship == '')

									{

										$family_relation = 'Husband';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Son';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Daughter';

									}

								}

								

								if($chapter->mm_relationship == '')

								{

									if($family->mm_relationship == 'Wife')

									{

										$family_relation = 'Wife';

									}

									if($family->mm_relationship == 'Husband')

									{

										$family_relation = 'Husband';

									}

									if($family->mm_relationship == 'Daughter')

									{

										$family_relation = 'Daughter';

									}

									if($family->mm_relationship == 'Son')

									{

										$family_relation = 'Son';

									}

								}
								if($family_relation!='')
								{
			 ?>
              <div  class="controls addremove mystyle"  style="height: 25px;">
           		<input type="checkbox" style="float: left; margin-right: 1%;position:absolute;" id="chk_<?php echo $family->mm_id; ?>" onclick="is_check(this.value);" name="chkbx<?php echo $family->mm_id; ?>" value="<?php echo $family->mm_id; ?>" class="hdnids"/>
				<input type="hidden" value="<?php echo $family->mm_id; ?>" name="hdnids[]" class="hdnids"/>
				<table width="93%" border="1" class="add_rm_before tbl_class1" style="margin-left:3.1%"  >
					<tr>
                  	<!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="">
                     <input class="toclear" type="text" id="name[]" readonly="" name="name[]" value="<?php echo $family->mm_fname.' '.$family->mm_lname; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="">
                     <input class="toclear guest fees" type="text" id="rel[]" readonly="" name="rel[]" value="<?php echo $family_relation; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td  width="8%" style="">
                 
				 <input class="toclear" id="age_<?php echo $family->mm_id; ?>" onkeyup="ageof()" readonly="" onkeypress="ageof();" onkeyup="ageof();" onchange="ageof();"   name="age[]"  type="text" value=""  style=" width:100%; margin:0; padding:0;"/>
				 	<input type="hidden" id="hdnage_<?php echo $family->mm_id; ?>" value="<?php $age = date("Y")-$family->mm_birth_year; echo $age; ?>">
				 	</td>
                    <td width="15%" style="background-color:#7d7d7d;">
                     <input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php echo set_value('menu_ch[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#b4b4b4;">
					<?php
					$group = '';
					$amount = '';
					$age = date("Y")-$family->mm_birth_year;
					if($age<$itema->end_age)
					{
						$group ='A';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itema->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itema->fees_st_mm_fee;
						}
					}
					else if($age>=$itemb->start_age && $age<=$itemb->end_age)
					{
						$group = 'B';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemb->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemb->fees_st_mm_fee;
						}
					}
					else if($age>=$itemc->start_age)
					{
						$group = 'C';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemc->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemc->fees_st_mm_fee;
						}
					}
					$total +=$amount;
					
					?>
                     <input class="toclear fees"  id="age_grp[]" name="age_grp[]" readonly="" type="text" value="<?php echo $group; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#b4b4b4;">
					<input class="toclear fees" id="fees[]"  name="fees[]" readonly="" type="text" value="<?php echo $amount; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                    </td>
                   
                     </tr>   
                  </table>
				  <?php $count++; if($countcheck==$count){ ?>
				  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove">
						<i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="display:none;">
						<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
				  <?php } ?>
                  </div>
                  <?php
				  }
			 } } }
			 ?>
             <?php
            if ($query)
			{
			
			
			foreach ($query as $row1)
		    {
				
				//$total=0;
			if($row1->fm_rel_mm_id == 0){ 	 
			?>
			  <div  class="controls addremove mystyle"  style="height: 25px;">
			 
           	
				<table width="93%" border="1" class="add_rm_before" style="margin-left:3.1%" >
					<tr>
                  	<!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
                    <td width="30%" style="">
                     <input class="toclear" type="text" id="name[]"  <?php if($row1->fm_rel_mm_id != 0){ ?> readonly="" <?php } ?> name="name[]" value="<?php echo $row1->fmg_att_name; ?>" style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="">
                     <input class="toclear guest fees" type="text" id="rel[]" readonly="" name="rel[]" value="<?php echo $row1->fmg_mm_rel;//$chapter->mm_relationship; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td  width="8%" style="">
                 
                    <input class="toclear" onkeyup="ageof()" <?php if($row1->fm_rel_mm_id != 0){ ?> readonly="" <?php } ?> onkeypress="ageof();"  onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();" id="age[]"  name="age[]"  type="text" value="<?php $age = $row1->fmg_mm_age; echo $age; ?>"  style=" width:100%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#7d7d7d;">
                     <input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php echo $row1->fmg_menu_choice; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="15%" style="background-color:#b4b4b4;">
					<?php
					$group = '';
					$amount = '';
					if($age<$itema->end_age)
					{
						$group ='A';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itema->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itema->fees_st_mm_fee;
						}
					}
					else if($age>=$itemb->start_age && $age<=$itemb->end_age)
					{
						$group = 'B';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemb->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemb->fees_st_mm_fee;
						}
					}
					else if($age>=$itemc->start_age)
					{
						$group = 'C';
						if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
						{
							$amount = $itemc->fees_st_mm_late_fee;
						}
						else
						{
							$amount = $itemc->fees_st_mm_fee;
						}
					}
					$total +=$amount;
					
					?>
                     <input class="toclear fees"  id="age_grp[]" readonly="" name="age_grp[]"  type="text" value="<?php echo $row1->fmg_age_grp; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#b4b4b4;">
					<input class="toclear fees"  id="fees[]" readonly="" name="fees[]" type="text" value="<?php echo $row1->fmg_fees; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                    </td>
                   		<input  id="id[]"  name="id[]" type="hidden"  value="<?php echo $row1->fmg_id; ?>"/>
                     </tr>   
                  </table>
                  	 
				   
				  <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove" style="">
						<i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="">
						<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
					</a>
                    
				  <?php 
				
				  ?>
                  </div>
             <?php } } }
			 
			 ?>
             
             
			 	<table width="93%" border="1" class="add_rm_before" style="margin-left:3.1%;">
                      <tr>
                          <td width="30%"   style=" color:#469AE9; border:solid #000 1px;"><b>Total</b></td>
                          <td  width="12%"  style=" text-align:center"></td>
                          <td width="8%"   style=" text-align:center"></td>
                          <td width="15%"  style=" text-align:center"></td>
                          <td width="15%"   style=" text-align:center"></td>
                          <td width="10%"   style=" text-align:center">
                          <input disabled="disabled"  id="fees_total" type="text"  name="fees_total" value="<?php echo $query1->fm_total_fee; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                          </td>                  
                      </tr>    
                </table>	
                  </div>
                  <div style="width:100%; line-height:20px; margin:20px 0 5px 0px; float:left">
           		<div style="float:left; width:100%">
                <b>
                *NOTE: If you will uncheck all then you will unregistered from(Including Program Entry Form, Medical Release Form, Event Membership Form).
                </b>

                </div>
           </div>
				  	
				  <div class="space10px"></div>
				  <!--<input type="button" value="Add new" class="btn primary" style="margin-left:3%;" id="addnew" onclick="displaythis();" />-->
             </div>
             <!-------------------------update-monita20130927------------------------------>
             <div style="clear:both"></div>
             <?php 
			 
			 for($m=0;$m<=$total_name;$m++)
			 		{
				 if(form_error('rel[]') || form_error('age['.$m.']') || form_error('menu_ch['.$m.']') || form_error('age_grp[]') || form_error('fees[]')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
			<?php } }?>
			<div class="space20px"></div>  
             
			<?php if(form_error('txtzipcode')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline"><?php echo form_error('txtzipcode'); ?></span>
                </div>
            </div>
			<?php } ?>
            
           <div class="space20px"></div> 
           <?php if(form_error('txtem_con_name')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline"><?php echo form_error('txtem_con_name'); ?></span>
                </div>
            </div>
			<?php } ?>
            
           <div class="space20px"></div>  
           
             <?php if(form_error('txtem_con_number')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline"><?php echo form_error('txtem_con_number'); ?></span>
                </div>
            </div>
			<?php } ?>
            
           <div class="space20px"></div>  
           
			<?php if(form_error('name[]')) { ?>
			 <div class="control-group error">
            	<div class="controls">
                    <span class="help-inline"><?php echo form_error('name[]'); ?></span>
                </div>
            </div>
			<?php } ?>
             <div class="space20px"></div>  
  			 <!-------------------------update-monita20130927------------------------------>
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="mm_id" value="<?php echo $chapter->mm_id; ?>">
            <input type="hidden" id="" name="fees_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="fees_modified_by" value="<?php echo $chapter->mm_fname;?>">
			
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
			<input type="hidden" id="fees_st_id" name="fees_st_id" value="<?php echo $item->fees_st_id; ?>"/>
             <input type="hidden" id="hdn_mm_id" name="hdn_mm_id" value="<?php echo $chapter->mm_id; ?>">
            
             <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" onclick="return checkMe();" class="btn" />
              
             </form>
              
              
            
             
	</td>
  </tr>
</table>
<script>
$( document ).ready(function() {
ageof();

});
</script>
<script>

function is_check(to)
{
	
	if(document.getElementById('chk_'+to+'').checked == true)
	{
		
		if(document.getElementById('age_'+to+'').value == "")
		{
			
		var ag = $('#hdnage_'+to+'').val();
		
		$('#age_'+to+'').attr("value",ag);
		
		}
		else
		{
		var ag = $('#age_'+to+'').val();
		
		$('#age_'+to+'').attr("value",ag);
		
		}
		ageof();
	}
	if(document.getElementById('chk_'+to+'').checked == false)
	{
		var hdn_age = $('#age_'+to+'').val();
		
		document.getElementById('age_'+to+'').value = "";
		ageof();
		
	}
	
}
</script>
<script>
function checkMe() {
	var $input = $('input[type=checkbox]');
	
	//document.myform.submit();
	if($input.not(':disabled').filter(':checked').length == 0)
	{
		//document.getElementById('myform').submit();
		//document.hdn_form.submit();
		var con = confirm("Are you sure you want to registration without any family member?");	
		//document.getElementById('hdn_form').action = 'http://localhost/spcsusa/2014/washington/convention/delete_registration';
		
		if (con) {
			//document.getElementById('myform').action = "http://localhost/spcsusa/2014/washington/convention/delete_registration";
			//document.myform.submit();
			//alert(ok);
			
			//document.myform.submit();
			//
			//
			//var succ = del();
			//return succ;
			return true;
			
		} else {
			
			return false;
			
		}
		
		
	}
}

function del() {
	var mm_id = $('#hdn_mm_id').val();
			
			$.ajax({
				   type: "POST",
			
			url: BASE_URI+"<?php echo $this->config->item('convention_folder_with_slash'); ?>convention/delete_registration/",
			data :'hdn_mm_id='+mm_id,
			success: function(data) {
				//alert(data);
				return true;
			}
			});
}
</script>
<script language="javascript">
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

		alert("Minimum 1 field required");

	}

	else

	{

		$(item).parent(".addremove").remove();	

	}
	ageof();

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
	//$(item).parent(".addremove").next(".addremove").find("table").addClass("add_rm");
	//$(item).parent(".addremove").next(".addremove").find("table").removeClass("add_rm_before");
	$(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('disabled');
	$(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('readonly');
	$(item).parent(".addremove").next(".addremove").find(".fees").attr('readonly','true');
	$(item).parent(".addremove").next(".addremove").find(".guest").val('Guest');
	$(item).parent(".addremove").next(".addremove").find(".anchor_add_remove").css('display','block');
	$(item).parent(".addremove").next(".addremove").find(".hdnids").remove();
	ageof();
}	
function displaythis()
{
	$(".displaythis").css("display",'block');
}
</script>
   