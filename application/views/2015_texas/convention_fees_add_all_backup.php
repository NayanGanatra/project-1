<style>
body{
  font-family: Arial,sans-serif;
  font-size:13px;
  
  }
.anchor_add_remove{
  height: 1px;
    left: 96%;
    position: relative;
    top: -38px;
  float:left;
  padding:0 2px;
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
 background:#fff; /*border:solid #ddd 1px; border-radius:5px;;  */
}
.menu_clr
{
  color:#271471;

}
.ped_l {
  padding-left:5px;
}



.title-bor{background-color:#999; color:#FFF; border:solid #aaa 1px; padding:0 0 0 5px; font-weight:normal;}
.validation_star
{
  color:red;
}
.tdaligncenter {
text-align: center !important;
}
.pay_type > input {
    background: none repeat scroll 0 0 #bec3c7;
    border: medium none;
    border-radius: 1px;
    color: #fff;
    font-size: 15px;
    padding: 6px 17px;
  border-radius:5px;
}
.pay_type > input:hover, .pay_type input.selected {
    background: none repeat scroll 0 0 #4799ed;
}
.selected 
{
  background: none repeat scroll 0 0 #4799ed;
}
.submit-btn
{
    background: none repeat scroll 0 0 #4799ed;
    border: medium none;
    border-radius: 2px;
    color: #fff;
    padding: 7px 20px;
    text-transform: uppercase;
  margin-left: 20px;
  border-radius:5px;
}
.pay_type
{
  text-align: center;
}
#activity_link
{
  color: #000;
}
#activity_link:hover
{
  color: #005580;
}
.title01{
  font-size:20px;
  color:#dd0e78;
  border-bottom:2px solid #ddd;
  padding:10px 0;
  margin-bottom:10px;
    font-weight:bold;
  }
  
  .age-Group tr td {
border: 1px solid #ddd;
}
.age-Group {
border: 1px solid #ddd;
}
</style>

<table class="tbl_class" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; width:100%;"> 
  <tr> 
    <td>
        <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform' );

                echo form_open('', $form_attributes);

            ?>
      <?php
      //echo $search_email;
      //exit;
      $chapter = $this->dbconvention_registration->get_chapter_from_mm_id($user_id);
      
      //var_dump($chapter);
      //print_r($chapter);
      ?>
           <table border="0" width="100%" cellpadding="2" cellspacing="0" class="tbl_class1">
           <tr>
           <td  colspan="3">
              <div class="title01">
                 Registration Form : 
                </div>
           </td>
           </tr>
           <tr>
           <td style="width:30%;">
           <div class="ped_l">
                SPCS Chapter:<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->ch_name; ?></b>
                </div>
           </td>
           <td style="width:60%;" colspan="2">
           <div  class="ped_l">
                 Life Member Number :  <b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_life_id;?></b>
                </div>
           </td>
           </tr>
           <tr>
           <td>
              <div  class="ped_l">
                Last name : <!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_lname; ?></b>-->
                <input type="text" style="width:200px; margin:0;" readonly=""  id="txtlname" name="lname" value="<?php echo $chapter->mm_lname; ?>"/>
                </div>
           </td>
           <td>
              <div   class="ped_l">
                 First Name : 
                 <input type="text" style="width:200px; margin:0;" readonly="" id="txtfname" name="fname" value="<?php echo $chapter->mm_fname; ?>"/>
                </div>
           </td>
           <td>
        <div  class="ped_l <?php if(form_error('address')) echo 'error'; ?>">
                <span class="validation_star">*</span>Address :
                <textarea placeholder="Enter Address" style="width:200px;"  id="txtaddress" name="address" ><?php echo $chapter->mm_address; ?></textarea>
                </div>
           </td>
           </tr>
           
            
           <tr>
           <td  >
              <div  class="ped_l <?php if(form_error('txtphoneh')) echo 'error'; ?>">
                <span class="validation_star">*</span>Phone No (H) : <br /><!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_hphone ; ?></b>-->
                <input type="text" style="width:200px; margin:0;" placeholder="Enter Home Phone No." id="txtphoneh" name="txtphoneh" value="<?php  echo $chapter->mm_hphone ; ?>"/>
                </div>
           </td>
           <td >
              <div  class="ped_l <?php if(form_error('txtemail')) echo 'error'; ?>">
                <span class="validation_star">*</span>Email :<br /> <!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_email; ?></b>-->
                <input type="text" style="width:200px; margin:0;"  id="txtemail" name="txtemail" value="<?php echo $chapter->mm_email; ?>"/>
        
        <?php if(form_error('txtemail')) 
         echo "you are already registered";
        ?>
      
                </div>
           </td>
            <td>
              <div  class="ped_l <?php if(form_error('mm_state_id')){ echo "error";}?>">
                <?php //$get_state = $this->dbconvention_registration->state_reg($chapter->mm_state_id);?>
                <span class="validation_star">*</span>State :

                <select tabindex="13" class="input-large"  name="mm_state_id" id="mm_state_id" style="width:215px;">

                <option value="" >Please Select</option>

                <?php

          $get_states = $this->dbconvention_registrationall->states(); 
          foreach($get_states as $get_states_row){ ?>
          <option <?php if(set_value('mm_state_id') == $get_states_row->state_id){ echo 'selected="selected"';}?> value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                    <?php } ?>

                </select>

                <input type="hidden" style="width:200px; margin:0;"  id="hdn_mm_state_id" name="hdn_mm_state_id" value="<?php echo $chapter->mm_state_id; ?>"/>
                </div>
           </td>
          <!-- <td colspan="2">
               <div style="float:left;" class="ped_l">
                Phone No (C) :<br/> <!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php echo $chapter->mm_cphone; ?></b>
                <input type="text" readonly="readonly" style="width:200px; margin:0;"  id="txtphonec" name="txtphonec" value="<?php echo $chapter->mm_cphone; ?>"/>
                </div>
           </td>-->
            
           </tr>
           <tr>
           
       <!--<td colspan="2">
              <div style="float:left;" class="ped_l">
                Secondary Email : <br/>
                <input type="text" placeholder="Enter Secondary Email" style="width:200px; margin:0;"  id="txtemail2" name="txtemail2" value="" readonly="readonly" />
        
                </div>
           </td>-->
           </tr>
           <tr>
           <td  >
              <div   class="ped_l">
            <div class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
              <div class="controls"><span class="validation_star">*</span>
        Emergency Contact Name :<input type="text" style="margin-bottom:0; width:200px;" placeholder="Enter name" name="txtem_con_name" value="<?php echo set_value('txtem_con_name'); ?>"/>
        </div>
        </div>
                </div>
           </td>
          
        
           
       
       <td  >
               <div   class="ped_l">
               <div class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
              <div class="controls">
        <label style="width:100px; "><span class="validation_star">*</span>Phone No (C):</label> <input style="margin-bottom:0;width:200px;" type="text" placeholder="Enter number" name="txtem_con_number" value="<?php echo set_value('txtem_con_number'); ?>"/>
                </div>
        </div>
        </div>
           </td>
            <td valign="top">
              <div   class="ped_l <?php if(form_error('mm_city_id')) echo 'error'; ?>">
                <?php $get_cities = $this->dbconvention_registration->cities_reg($chapter->mm_city_id);?>
                <span class="validation_star">*</span>City : <!--<b><?php if(isset($get_cities->city_name)){ echo $get_cities->city_name; } ?></b>-->
                <input type="text" style="width:200px; margin-bottom:0;" placeholder="Enter City" id="mm_city_id" name="mm_city_id" value="<?php if(set_value('mm_city_id')){ echo set_value('mm_city_id'); } ?>"/>
                
                <input type="hidden" readonly="readonly" style="width:200px;  margin-bottom:0;"  id="hdn_mm_city_id" name="hdn_mm_city_id" value="<?php if(isset($chapter->mm_city_id)){ $chapter->mm_city_id; } ?>"/>
                </div>
           </td>
       </tr>
     <tr>
          
          <td></td>
          <td></td>
       
           <td valign="top">
        <div class="ped_l">
                <div class="<?php if(form_error('txtzipcode')){ echo "error";}?>"> 
              <div class="controls">
                    <span class="validation_star">*</span>Zip Code : <input type="text" placeholder="Enter zip code" style="width:200px; margin:0;"  id="txtzipcode" name="txtzipcode" value="<?php echo set_value('txtzipcode'); ?>"/>
                </div>
              </div>
                </div>
           </td>
            
           </tr>
       <?php if($chapter->mm_life_id == "" || $chapter->mm_life_id == NULL){ ?>
        <tr>
       <td colspan="3">
               <div   class="ped_l">
               <div class="">
              <div class="controls">
        
                

                </select>
        <table cellspacing="20" width="70%">
        <tr>
          <td><label style="width:200px; font-width:bold; "><b>Become A Life Member :</b></label></td>
          <td><label style="width:200px; font-width:bold; "><b>Become Sponsor :</b></label></Td>
          <th><label style="width:200px; font-width:bold; "><b>Do You Accept Free Tickets :</b></label></Th>
        </tr>
        <tr>
        <Td><input type="checkbox" name="txtem_life_member" id="txtem_life_member" onchange="add_in_total()" style="vertical-align: sub;"/>(250$)</Td>
        <td><select tabindex="15" class="input-large"  name="spamount" id="spamount" style="width:215px;" onchange="showSponserPopup()">

        <option value="0" selected="selected"  onchange="ageof()">Please Select</option>
        <option value="600" >600$</option>
        <option value="800" >800$</option>
        <option value="1200" >1200$</option>
        <option value="2000" >2000$</option>
        <option value="5000" >5000$</option>
        <option value="7500" >7500$</option>
        <option value="12500" >12500$</option>
        <option value="15000" >15000$</option>
        <option value="20000" >20000$</option>
        <option value="30000" >30000$</option>
        </select></td>
        <td><input type="checkbox" name="free_ticket" id="free_ticket" onclick="ageof()" style="vertical-align: sub;"/>Yes</Td>
        
        
       </tr>
       <?php } ?>
           </table>
       
           <div style="width:100%; line-height:20px; margin:20px 0 5px 0px; ">
              <div style=" padding:0 6px; width:100%">
                <b>
                 Please list and fill all details about each person registering for Convention (Including Registrant) <br />Calculate the fee based on table above.  
                </b>

                </div>
           </div>
           <div style="width:100%;   ">
            <table  width="93%"  border="0" style="margin-left:3.1%;" >
        <tr>
                  <!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
          
          <?php $err = ''; 
          for($m=0;$m<=$total_name;$m++)
       {
       if(form_error('rel[]') || form_error('age['.$m.']') || form_error('age_grp[]') || form_error('fees[]')) { $err = "color: #B94A48 !important;";} }?>
          <?php $err = ''; if(form_error('name[]')){ $err = "color: #B94A48 !important;";}?>
          <?php $err1 = ''; if(form_error('rel[]')){ $err1 = "color: #B94A48 !important;";}?>
          <?php $err2 = ''; if(form_error('bod[]')){ $err2 = "color: #B94A48 !important;";}?>
                    <th class="title-bor" style="<?php echo $err; ?>" width="24%">Name of Attendees</th>
                    <th class="title-bor" style="<?php echo $err1; ?>" width="10%">Relationship</th>
                    <th class="title-bor" style="<?php echo $err2; ?>" width="12%">Year of Birth</th>
                    <th class="title-bor" style="" width="7%" >Age</th>
                    <th class="title-bor" width="15%">Menu Choice<br />(T/C)</th>
                    <th class="title-bor" style="" width="15%" >Age Group<br />(A-E)</th>
                    <th class="title-bor" style="" width="10%" >Fee</th>
                    
                  </tr>
             </table>
             </div>
             <div style="width:100%; ">
             <div>
       <?php $total=0; 
            
       if($total_name > 0) 
       {
        
        for($i=0; $i<$total_name; $i++)
        {
          /*echo "<pre>";
          print_r($total_mem_bod[$i]);
          echo "</pre>";*/
          ?>
     <div  class="controls addremove"  style="height:35px; float:left;">
       <div style="width:20px; display:none; "><input type="checkbox" style="float: left; margin-right: 1%; margin-top: 10px;" checked="checked" id="chk_<?php echo $chapter->mm_id; ?>" onclick="is_check(this.value);" name="chkbx<?php echo $chapter->mm_id; ?>" value="<?php echo $chapter->mm_id; ?>" class="hdnids"/>
      <input type="hidden" value="<?php echo $chapter->mm_id; ?>" name="hdnids[]" class="hdnids"/>
      </div>
            
        <table width="93%" border="0" class="add_rm_before age-Group" style="margin-left:3.1%" >
          <tr>
                    <!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
                    </td>-->
          
                    <td width="24.1%" style="padding:6px;">
                     <input class="toclear" type="text" id="name[]" name="name[]" value="<?php if($total_mem_name[$i] == ""){  $chapter->mm_fname.' '.$chapter->mm_lname;} else {echo $total_mem_name[$i];} ?>"  style=" width:99%; margin:0; padding:0; "/>
                    </td>
                    <td width="12.5%" style="padding:6px;">
                     
          <select class="toclear guest rel rel_<?php echo $i; ?>" type="text" id="rel[]" name="rel[]" style="width:97%; margin:0; padding:0;height:22px;" onchange="ageof();" >
            <option value="Self" <?php if($total_mem_rel[$i] == "Self") { ?>selected="selected"<?php } ?> >Self</option>
            <option value="Wife" <?php if($total_mem_rel[$i] == "Wife") { ?>selected="selected"<?php } ?> >Wife</option>
            <option value="Husband" <?php if($total_mem_rel[$i] == "Husband") { ?>selected="selected"<?php } ?> >Husband</option>
            <option value="Son" <?php if($total_mem_rel[$i] == "Son") { ?>selected="selected"<?php } ?> >Son</option>
            <option value="Daughter" <?php if($total_mem_rel[$i] == "Daughter") { ?>selected="selected"<?php } ?> >Daughter</option>
            <option value="Father" <?php if($total_mem_rel[$i] == "Father") { ?>selected="selected"<?php } ?> >Father</option>
            <option value="Mother" <?php if($total_mem_rel[$i] == "Mother") { ?>selected="selected"<?php } ?> >Mother</option>
            <option value="Other" <?php if($total_mem_rel[$i] == "Other") { ?>selected="selected"<?php } ?> >Other</option>
          </select>

                    </td>
                    <td width="12%" style="padding:6px;">
                     <input class="toclear bod" type="text" id="bod_<?php echo $i; ?>" name="bod[]" value="<?php if(!isset($total_mem_bod[$i]))  $chapter->mm_birth_month.'/'.$chapter->mm_birth_year; else { echo $total_mem_bod[$i]; }?>" placeholder="YYYY" style=" width:99%; margin:0; padding:0;" <?php  echo 'onblur="datediff(this.value,this.id);"'; ?>/>
                     
                    </td>
                    <td  width="7%" style="padding:6px;">
                 
                    <input class="toclear age" onkeyup="ageof()" id="age_<?php echo $i; ?>"  onkeypress="ageof();" onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();" id="age[]"  name="age[]"  type="text" value="<?php if(!isset($total_mem_age[$i])) {$age = date("Y")-$chapter->mm_birth_year;  $age;  } else echo  $total_mem_age[$i]; ?>"  style=" width:97%; margin:0; padding:0;"/>
                    <input type="hidden" id="hdnage_<?php echo $chapter->mm_id; ?>" value="<?php $age = date("Y")-$chapter->mm_birth_year; echo $age; ?>">
                    </td>
                    <td width="15%" style="background-color:#7d7d7d; padding:6px;">
                    <select class="toclear" id="menu_ch[]" name="menu_ch[]" style=" width:99%; margin:0; padding:0;height:22px;">
                    <option value="T" <?php if($total_mem_menu[$i] == "T") "Selected"; ?>>T</option>
                    <option value="C" <?php if($total_mem_menu[$i] == "C") "Selected"; ?>>C</option>
                    </select>
                     
                    </td>
          
          
          <!--<td width="24%" style="">
                     <input class="toclear" type="text" id="name[]" readonly="" name="name[]" value="<?php echo $chapter->mm_fname.' '.$chapter->mm_lname; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="13%" style="">
                     <input class="toclear guest" type="text" id="rel[]" readonly="" name="rel[]" value="<?php echo "Self";//$chapter->mm_relationship; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="12%" style="">
                     <input class="toclear bod" type="text" id="bod_<?php echo $chapter->mm_id; ?>" name="bod[]" value="<?php if(($chapter->mm_birth_month && $chapter->mm_birth_year) != "") echo $chapter->mm_birth_month.'/'.$chapter->mm_birth_year; ?>" placeholder="MM/YYYY" style=" width:99%; margin:0; padding:0;" <?php if(($chapter->mm_birth_month && $chapter->mm_birth_year) == "") echo 'onblur="datediff(this.value,this.id);"'; ?>/>
                     
                    </td>
                    <td  width="7%" style="">
                 
                    <input class="toclear age" onkeyup="ageof()" id="age_<?php echo $chapter->mm_id; ?>" readonly="" onkeypress="ageof();" onkeyup="ageof();" onchange="ageof();" onmouseout="ageof();" id="age[]"  name="age[]"  type="text" value="<?php if($chapter->mm_birth_year != 0 && $chapter->mm_birth_month) {$age = date("Y")-$chapter->mm_birth_year; echo $age;} ?>"  style=" width:100%; margin:0; padding:0;"/>
                    <input type="hidden" id="hdnage_<?php echo $chapter->mm_id; ?>" value="<?php $age = date("Y")-$chapter->mm_birth_year; echo $age; ?>">
                    </td>
                    <td width="15%" style="background-color:#7d7d7d;">
                    <select class="toclear" id="menu_ch[]" name="menu_ch[]" style=" width:99%; margin:0; padding:0;height:22px;">
                    <option value="T">T</option>
                    <option value="C">C</option>
                    </select>-->
                     <!--<input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php //echo set_value('menu_ch[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>-->
                    </td>
                    <td width="15%" style="background-color:#b4b4b4;padding:6px;">
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
          
                     <input class="toclear fees"  id="age_grp[]" name="age_grp[]" readonly=""  type="text" value="<?php echo $group; ?>"  style=" width:99%; margin:0; padding:0;"/>
                    </td>
                    <td width="10%" style="background-color:#b4b4b4;padding:6px;">
          <input class="toclear fees"  id="fees[]" readonly="" name="fees[]" type="text" value="<?php echo $amount; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                    </td>
                   
                     </tr>   
                  </table>
          <?php //if(!$get_relationship || isset($total_mem_name[$i])){ ?>
          <a title="Add New Field" onclick="addNewField(this);" class="anchor_add_remove">
            <i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
          </a><br/>
          <a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="<?php if($total_mem_bod[$i] == "") {echo 'display:block;';}else{ echo 'display:none;'; } ?>">
            <i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
          </a>
          <?php // } ?>
               </div>
             <?php
       }
       }
       if($get_relationship) 
       {
        
       $countcheck = 0;
       foreach($get_relationship as $family) { 
       
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
       
       
       ?>
        <table width="93%" border="0" class="add_rm_before age-Group" style="margin-left: 3.1%; width: 701px;float: left;">
                      <tr>
                          <td width="89%" style="color:#dd0e78; border:solid #ddd 1px; text-align:right; padding:6px;"><b>Total</b></td>
                          <td width="15%"   style=" text-align:center; padding:6px;">
                          <input readonly="readonly" id="fees_total" type="text"  name="fees_total" value="<?php echo $total; ?>"  style="width: 99%; margin: 0px; padding: 0px; text-align: right;"/>
                          </td>                  
                      </tr>    
                </table>  
                  </div>
            
          <div class="space10px"></div>
          <!--<input type="button" value="Add new" class="btn primary" style="margin-left:3%;" id="addnew" onclick="displaythis();" />-->
             </div>
             <!-------------------------update-monita20130927------------------------------>
       <table  border="0" cellspacing="0" cellpadding="0" align="center" style=""> 
  <tr>
    <td>
         <span style="font-weight: bold; padding:6px; margin-top:10px;">Activity Registration...</span>
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
               <div class="space10px"></div> 
         <table class="tbl_class1 age-Group"  border="0" cellspacing="0" cellpadding="0" style="width:95%; margin-right:35px; margin-left: 6px;  text-align:center;" align="center"> 
          <tr>
               <!-----<th class="tdfees title-bor" style="width:50px;">Age Group</th>--->
            <th class="tdfees title-bor" style="width:800px; padding:8px 0;">Activity</th>
            <th class="tdfees title-bor" style="width:200px; padding:8px 0;">Number of Participant</th>
            <th class="tdfees title-bor" style="width:100px;  padding:8px 0;">T-Shirt Size</th>
            <th class="tdfees title-bor" style="width:50px; padding:8px 0;">Amount</th>
          </tr>
     
     <?php if($items) { foreach($items as $itemsgroup){
       ?>
          <tr class="trodd ">
              <!-----<td class="tdaligncenter"><?php echo $itemsgroup->ce_start_age; ?>-<?php echo $itemsgroup->ce_end_age; ?>
            <input type="hidden" value="<?php echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
            <input type="hidden" value="<?php echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
            </td>--->
            <td class="tdaligncenter" style="text-align:left !important; padding-left:8px;"><a style=" color:#271471; text-align:left;" href="<?php echo base_url()."2015/texas/convention/detail_page/9"; ?>" id="activity_link"><?php echo $itemsgroup->ce_activity; ?></a></td>
            <td class="tdaligncenter"><label style="line-height:32px; display:inline;"><input type="text" class="tdtxt" style="width: 20px; margin: 6px; " value="<?php echo set_value('txtpcount[]'); ?>" name="txtpcount[]" id="txtpcounta" onkeyup="ageoftotal();" onchange="ageoftotal();" onmouseout="ageoftotal();" onkeypress="return isNumber(event)"/>x $</label><?php echo $itemsgroup->ce_age_fee; ?>
            <input type="hidden" value="<?php echo $itemsgroup->ce_start_age."-".$itemsgroup->ce_end_age; ?>" name="age-grup-event[]">
            <input type="hidden" value="<?php echo $itemsgroup->ce_age_fee; ?>" name="getamount[]"/>
            <input type="hidden" value="<?php echo $itemsgroup->ce_id; ?>" name="eventid[]"/>
            </td>
            
            <td><?php $set_tshirt_size = set_value('tshirt_size[]'); ?><select style="width:100px;" name="tshirt_size[]">
              <option value="">Select</option>
              <option <?php if($set_tshirt_size == "YS") { echo 'selected'; } ?> value="YS">YS</option>
              <option <?php if($set_tshirt_size == "YM") { echo 'selected'; } ?> value="YM">YM</option>
              <option <?php if($set_tshirt_size == "YL") { echo 'selected'; } ?> value="YL">YL</option>
              <option <?php if($set_tshirt_size == "AS") { echo 'selected'; } ?> value="AS">AS</option>
              <option <?php if($set_tshirt_size == "AM") { echo 'selected'; } ?> value="AM">AM</option>
              <option <?php if($set_tshirt_size == "AL") { echo 'selected'; } ?> value="AL">AL</option>
              <option <?php if($set_tshirt_size == "AXL") { echo 'selected'; } ?> value="AXL">AXL</option>
              <option  <?php if($set_tshirt_size == "AXXL") { echo 'selected'; } ?> value="AXXL">AXXL</option>
            </select></td>

            <td class="tdaligncenter" style="padding:0 6px;"><input type="text" value="0" style="margin-bottom: 0px; width: 106px; text-align: right;" name="amount[]" readonly="" id="amount_event"/> </td>
          </tr> <?php }}?>

          <tr class="treven">
              <td colspan="2" style="padding:6px;"><b style="float: right; margin-right: 5px; color:#dd0e78;">Total</b></td>
            <td class="tdaligncenter" id="totalamount"   style="text-align:right; padding-right:8px;">0</td>
            <input type="hidden" id="totalamounthidden" name="totalamounthidden" value="">
            </tr>
          </table>
         <div class="space10px"></div> 
                
        <?php if(form_error('txtpcount[]')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline">All fields are required.</span>
                </div>
            </div>
      <?php } ?>
            <input type="hidden" id="" name="event_mem_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
      <?php /*$chapter = $this->dbconvention_registration->get_chapter_from_mm_id($this->session->userdata('user_id'));*/ ?>
         <!--   <input type="hidden" id="" name="event_mem_created_by" value="<?php echo $chapter->mm_fname; ?>">-->
      <!--<input id="submit_form" type="button" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" onclick="submit_myform();"/>-->
             
    </form>    
</td>
</tr></table>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="height: 50px;"> 
  <tr>
    <td>
    <b style="color:#dd0e78;">Total : $<span id="total_with_paypal">0</span> </b> ($<span id="fees_total2">0</span> + $<span id="totalamount2">0</span> + $<span id="paypal_fee">0</span> (2.2% + $0.30 - Paypal Processing Fee))
    </td>
  </tr>
</table>
             <div style="clear:both"></div>
             <div class="space20px"></div>  
             <div style="width:100%; float:left; margin-left: 20px;">
              <div class="pay_type" id="pay_type" style="">
                   
          <!-- Vishal Comment 1/31/2015  <input type="radio" name="payment" id="check" value="by_check" style="vertical-align: sub;">Pay by CHECK -->
          
                     <input style="margin-left:20px; vertical-align: sub;" type="radio" checked="checked" id="paypal" name="payment" value="by_paypal" >Pay by PAYPAL
           <!--<input type="button" class="" value="Cheque" id="cheque" onclick="select_method('cheque')"></input>
           <input type="button" class="selected" value="Paypal" id="paypal" onclick="select_method('paypal')"></input>
           <input type="hidden" name="payment" id="payment" value="by_paypal" />-->
                </div>
                <div style="float:left; width:100%; display:none;" class="by_check" id="by_check">
               
                </div>
             </div>
             <div class="space20px"></div>
             <?php 
       /*
       for($m=0;$m<=$total_name;$m++)
       {
       if(form_error('rel[]') || form_error('age['.$m.']') || form_error('age_grp[]') || form_error('fees[]')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline">All fileds are required.</span>
                </div>
            </div>
      <?php } }?>
      
      <?php if(form_error('txtzipcode')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline"><?php echo form_error('txtzipcode'); ?></span>
                </div>
            </div>
      <?php } ?>
           <?php if(form_error('txtem_con_name')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline"><?php echo form_error('txtem_con_name'); ?></span>
                </div>
            </div>
      <?php } ?>
            <?php if(form_error('txtem_con_number')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline"><?php echo form_error('txtem_con_number'); ?></span>
                </div>
            </div>
      <?php } ?>
            <?php if(form_error('name[]')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline"><?php echo form_error('name[]'); ?></span>
                </div>
            </div>
      <?php } ?>
            <?php if(form_error('txtemail')) { ?>
       <div class="control-group error">
              <div class="controls">
                    <span class="help-inline"><?php echo "you are already registered" ?></span>
                </div>
            </div>
      <?php } */?>
            
             <div class="space20px"></div>    
         <!-------------------------update-monita20130927------------------------------>
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="mm_id" value="<?php echo $chapter->mm_id; ?>">
            <input type="hidden" id="" name="fees_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="fees_created_by" value="<?php echo $chapter->mm_fname;?>">
      
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
      
      <div style="text-align: center">
            <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="submit-btn" />
      </div>
      </form>
  </td>
  </tr>
</table>
<script>
$( document ).ready(function() {
ageof();
ageoftotal();
});
function select_method(paymenttype)
{
  
  if(paymenttype=='paypal')
  {
    $('#cheque').removeClass('selected');
    $('#paypal').addClass('selected');
    document.getElementById('payment').value = 'by_paypal';
  }
  else
  {
    $('#cheque').addClass('selected');
    $('#paypal').removeClass('selected');
    document.getElementById('payment').value = 'by_check';
  }
}
</script>
<script language="javascript">

function add_in_total()
{
  var m = $("#txtem_life_member").prop('checked');
  
  if(m == true)
  
  {
    var total = $("#fees_total").val();
    total = parseInt(total)+250;
    $("#fees_total").val(total);
    $("#txtem_life_member").val("1");
    ageof();
  }
  if(m == false)
  {
    var total = $("#fees_total").val();
    total = parseInt(total)-250;
    $("#fees_total").val(total);
    ageof();
  }
  
}

function showSponserPopup()
{
  
  var n = parseInt(document.getElementById('spamount').value);

  var total = $("#fees_total").val();
  if(n==600)
    {
      alert("You have selected for being Well Wisher Sponsorship Package"+"\n"+"Sponsorship Amount : 600$"+"\n"+"Directory Ad : Listed"+"\n"+"Program Guide : N/A"+"\n"+"DVD Ad Time : N/A"+"\n"+"Free Adult Registration : 2"+"\n"+"Free DVD : N/A"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
  if(n==800)
    {
      alert("You have selected for being Samaj Sponsorship Package"+"\n"+"Sponsorship Amount : 800$"+"\n"+"Directory Ad : 1/4 Page "+"\n"+"Program Guide : N/A"+"\n"+"DVD Ad Time : N/A"+"\n"+"Free Adult Registration : 2"+"\n"+"Free DVD : N/A"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==1200)
    {
      alert("You have selected for being Family Sponsorship Package"+"\n"+"Sponsorship Amount : 1200$"+"\n"+"Directory Ad : 1/2 Page"+"\n"+"Program Guide : N/A"+"\n"+"DVD Ad Time : N/A"+"\n"+"Free Adult Registration : 2 Adults + 2 Kids"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==2000)
    {
      alert("You have selected for being Program** Sponsorship Package"+"\n"+"Sponsorship Amount : 2000$"+"\n"+"Directory Ad : 1/2 Page"+"\n"+"Program Guide : 1/4 Page"+"\n"+"DVD Ad Time : N/A"+"\n"+"Free Adult Registration : 4 Adults "+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");     
    }
    if(n==5000)
    {
      alert("You have selected for being Silver Sponsorship Package"+"\n"+"Sponsorship Amount : 5000$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : 1/2 Page"+"\n"+"DVD Ad Time : N/A"+"\n"+"Free Adult Registration : 4 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==7500)
    {
      alert("You have selected for being Breakfast or Snack* Sponsorship Package"+"\n"+"Sponsorship Amount : 7500$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : 1/2 Page"+"\n"+"DVD Ad Time : Flash Ad"+"\n"+"Free Adult Registration : 4 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : N/A"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==12500)
    {
      alert("You have selected for being Lunch or Dinner* Sponsorship Package"+"\n"+"Sponsorship Amount : 12500$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : Full Page"+"\n"+"DVD Ad Time : Flash Ad"+"\n"+"Free Adult Registration : 6 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : N/A"+"\n"+"Free Hotel Suite : 1"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==15000)
    {
      alert("You have selected for being Gold Sponsorship Package"+"\n"+"Sponsorship Amount : 15000$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : Full Page"+"\n"+"DVD Ad Time : Flash Ad"+"\n"+"Free Adult Registration : 8 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : Yes"+"\n"+"Free Hotel Suite : 1"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==20000)
    {
      alert("You have selected for being Platinum Sponsorship Package"+"\n"+"Sponsorship Amount : 20000$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : Full Page"+"\n"+"DVD Ad Time : 30 or 2x15 Ad"+"\n"+"Free Adult Registration : 8 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : Yes"+"\n"+"Free Hotel Suite : 2"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    if(n==30000)
    {
      alert("You have selected for being Grand Sponsorship Package"+"\n"+"Sponsorship Amount : 30000$"+"\n"+"Directory Ad : Full Page"+"\n"+"Program Guide : Full Page"+"\n"+"DVD Ad Time : 2x30 or 4x15"+"\n"+"Free Adult Registration : 12 Adults"+"\n"+"Free DVD : Yes"+"\n"+"30-Min Session : Yes"+"\n"+"Free Hotel Suite : 3"+"\n"+"\n"+"Please SELECT if you want free tickets");
    }
    
  /*total = parseInt(total);
  if(total > 250)
  {
    total = 0;
    total = parseInt(total)+parseInt(n);
    $("#fees_total").val(total);
    ageof();
  }
  else if(total==250)
  {
    total = 250;
    total = parseInt(total)+parseInt(n);
    $("#fees_total").val(total);
    ageof();
  }   
  else
  {
    total = 0;
    total = parseInt(total)+parseInt(n);
    $("#fees_total").val(total);
  }
  //alert("You have selected Sponsorship of:   $" + total +"\n"+"Please choose if you want free tickets");  
  
    
    else if(ft==800)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==1200)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==2000)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==5000)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==7500)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==12500)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==15000)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==20000)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else if(ft==30000)
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
    else
    {
      alert('You have selected for being Well Wisher Sponsorship Package<br>
      Sponsorship Amount : 600$<br>
      Directory Ad : Listed<br>
      Program Guide : N/A<br>
      DVD Ad Time : N/A<br>
      Free Adult Registration : 2<br>
      Free DVD : N/A<br>
      30-Min Session : N/A<br>
      Free Hotel Suite : N/A');
    }
  
  */
    
    ageof();
}

function add_in_sponser_total()
{
  var m = $("#txtem_sponser").prop('checked');
  
  if(m == true)
  {
    var total = $("#fees_total").val();
    total = parseInt(total)+1000;
    $("#fees_total").val(total);
    $("#txtem_sponser").val("1");
    ageof();
  }
  if(m == false)
  {
    var total = $("#fees_total").val();
    total = parseInt(total)-1000;
    $("#fees_total").val(total);
    ageof();
  }
}
function submit_check() {
  if($('#pay_type').css('display') == 'none'){ 
    $("#pay_type").css('display','block');
  }
  else {
    $( "#myform" ).submit();
  }
  
}
$("#check").click(function(){
  $("#by_check").css('display','block');
  $("#by_paypal").css('display','none');
});
$("#paypal").click(function(){
  $("#by_check").css('display','none');
  $("#by_paypal").css('display','block');
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
    //var hdn_age = $('#age_'+to+'').val();
    ageof();
    
  }
  
}
</script>

<script language="javascript">



function ageof()
{
  
  var total_price = 0;
  var free_adult_registration = 0;
  var free_child_registration = 0;
  
  var age = document.getElementsByName('age[]');
  var age_grp = document.getElementsByName('age_grp[]');
  var fees = document.getElementsByName('fees[]');
  var rel = document.getElementsByName('rel[]');
  var hdnids = document.getElementsByName('hdnids[]');
  
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
  
  $(".addremove").each(function() {
        var checkbox = $( this ).find('.hdnids').attr('checked');
        console.log(checkbox);
    });

  var ln = fees.length;
  var totalAdults = 0;
  var totalKids = 0;

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
          //fees[i].value = childfeemem;
           if(rel[i].value == "Other")  
              {
                fees[i].value = childfeenonmem;
              }
              else
              {
                fees[i].value = childfeemem;
              }
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
             if(rel[i].value == "Other")
              {
                fees[i].value = childfeenonmem;
              }
              else
              {
                fees[i].value = childfeemem;
              }
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
          //fees[i].value = youngfeemem;
          if(rel[i].value == "Other")
              {
                fees[i].value = youngfeenonmem;
              }
              else
              {
                fees[i].value = youngfeemem;
              }
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
           if(rel[i].value == "Other")
              {
                fees[i].value = youngfeenonmem;
              }
              else
              {
                fees[i].value = youngfeemem;
              }
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
          //fees[i].value = oldfeemem;
          if(rel[i].value == "Other")
            {
              fees[i].value = oldfeenonmem;
            }
            else
            {
              fees[i].value = oldfeemem;
            }
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
            //fees[i].value = oldfeemem;
          if(rel[i].value == "Other")
            {
              fees[i].value = oldfeenonmem;
            }
            else
            {
              fees[i].value = oldfeemem;
            }
          
        }
      }
      
    }
    if(age[i].value == '')
    {
      age_grp[i].value='';
      fees[i].value='';
      
    }
    
    
    var fees_total = 0;

    var sponsership_fees = document.getElementById('spamount').value;

    console.log( "Selected sponsership", sponsership_fees);

    var free_ticket_checked = document.getElementById("free_ticket").checked
    if( free_ticket_checked ){
      console.log ("Sponser wants to avail FREE tickets -- Nutan");
      //Allow 2 free tickets for adults with $600 sponsership level
      if((sponsership_fees == "600" || sponsership_fees == "800" || sponsership_fees == "1200" ) && age_grp[i].value == "C" && free_adult_registration < 2){
        free_adult_registration = free_adult_registration + 1;
        fees[i].value='';
      }

      //Allow 2 free tickets for children with $1200 sponsership level
      if(sponsership_fees == "1200" && age_grp[i].value == "B" && free_child_registration < 2 && age_grp[i].value == "B" && free_child_registration < 2){
        free_child_registration = free_child_registration + 1;
        fees[i].value='';
      }

      //Allow 4 free tickets for adults with $2000, $5000, $7500 sponsership level
      if((sponsership_fees == "2000" || sponsership_fees == "5000" || sponsership_fees == "7500" ) && age_grp[i].value == "C" && free_adult_registration < 4 ){
        free_adult_registration = free_adult_registration + 1;
        fees[i].value='';
      }

      //Allow 6 free tickets for adults with $12500 sponsership level
      if(sponsership_fees == "12500" && age_grp[i].value == "C" && free_adult_registration < 6){
        free_adult_registration = free_adult_registration + 1;
        fees[i].value='';
      }

      //Allow 8 free tickets for adults with $15000, $20000 sponsership level
      if((sponsership_fees == "15000"  || sponsership_fees == "20000" ) && age_grp[i].value == "C" && free_adult_registration < 8){
        free_adult_registration = free_adult_registration + 1;
        fees[i].value='';
      }

      //Allow 12 free tickets for adults with $30000 and above sponsership level
      if(sponsership_fees >= "30000" && age_grp[i].value == "C" && free_adult_registration < 12){
        free_adult_registration = free_adult_registration + 1;
        fees[i].value='';
      }
    }
    
      if(fees[i].value != ''){
        total_price =  parseInt(total_price)+parseInt(fees[i].value);
      }
  }
  
    var become_member_checked = document.getElementById("txtem_life_member").checked
   
    if(become_member_checked){
        total_price = parseInt(total_price) + 250 ;
    }
    
    if(sponsership_fees != "0" ){
        total_price = parseInt(total_price) + parseInt(sponsership_fees) ;
    }
  
  document.getElementById('fees_total').value=total_price;
  document.getElementById('fees_total2').innerHTML=total_price;
  calculate_total_with_paypal();
}
    
function calculate_total_with_paypal()
{
  var semi_total = parseInt(document.getElementById('fees_total').value) + parseInt(document.getElementById('totalamounthidden').value);
  //2.75% additional paypal
  var paypal_fee = (semi_total * 0.022) + 0.30;
  paypal_fee = Math.round(paypal_fee * 100) / 100;
  document.getElementById('paypal_fee').innerHTML=paypal_fee;
  document.getElementById('total_with_paypal').innerHTML=semi_total+parseFloat(paypal_fee);
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
    var fees = document.getElementsByName('fees[]');
  var ln = fees.length;
  //alert(ln);
//  $(item).parent(".addremove").next(".addremove").children(".toclear").val("");
    /*$(item).parent(".addremove").next(".addremove").find(".static").html('<b>'+ln+'</b>');*/
  $(item).parent(".addremove").next(".addremove").find(".toclear").val("");
  //$(item).parent(".addremove").next(".addremove").find("table").addClass("add_rm");
  //$(item).parent(".addremove").next(".addremove").find("table").removeClass("add_rm_before");
  $(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('disabled');
  $(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('readonly');
  $(item).parent(".addremove").next(".addremove").find(".fees").attr('readonly','true');
  $(item).parent(".addremove").next(".addremove").find(".bod").attr('id','bod_'+ln);
  $(item).parent(".addremove").next(".addremove").find(".age").attr('id','age_'+ln);
  $(item).parent(".addremove").next(".addremove").find(".bod").attr('onblur','datediff(this.value,this.id);');
  //$(item).parent(".addremove").next(".addremove").find(".guest").val('Guest');
  $(item).parent(".addremove").next(".addremove").find(".anchor_add_remove").css('display','block');
  $(item).parent(".addremove").next(".addremove").find(".hdnids").remove();
  ageof();
} 

function datediff(date,id)
{
  
  var pattern =/([0-9]{4})$/;
  if(!pattern.test(date)) {
    alert('Please follow YYYY format');
    return false;
  }
  var today = new Date();
  var yyyy = today.getFullYear();
  //var yy = date.split("/");
  var getyyyy = date;
  //var getyyyy = yy[1];
  var year = yyyy - getyyyy;
  
  var splited_id = id.split("_");
  $("#age_"+splited_id[1]).val(year);
  ageof();
  
}
function displaythis()
{
  $(".displaythis").css("display",'block');
}
</script>
<script language="javascript">
function ageoftotal()
{
  var t=0;
  var pcount = document.getElementsByName('txtpcount[]');
  var amount = document.getElementsByName('amount[]');
  var getamount = document.getElementsByName('getamount[]');
  
  var ln = pcount.length;
  for (var i = 0, l = ln; i < l; i++) 
  {
    if(pcount[i].value=='' || pcount[i].value==null)
    {
      amount[i].value = 0;
    }
    else
    {
      
      amount[i].value = parseInt(pcount[i].value)*parseInt(getamount[i].value);
    }
    t += parseInt(amount[i].value);
  }
  document.getElementById('totalamount').innerHTML=t;
  document.getElementById('totalamounthidden').value = t;
  document.getElementById('totalamount2').innerHTML=t;
  calculate_total_with_paypal();
}
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
   