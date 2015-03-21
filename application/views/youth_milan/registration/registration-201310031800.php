
<?php
/*include 'config.php';

if(isset($_POST['Update8']) && $_POST['Update8']=='Update')
{
	$name=$_POST['Name'];
	$gender=$_POST['Gender'];
	$maritalstatus=$_POST['MaritalStatus'];
	$children=$_POST['HavingChildren'];
	$height=$_POST['HeightID'];
	$weight=$_POST['WeightID'];
	$bodytype=$_POST['BodyTypeID'];
	$complexion=$_POST['ComplexionID'];
	$physicalstatus=$_POST['PhysicalStatus'];
	$bloodgroup=$_POST['BloodGroup'];
	$mothertongue=$_POST['MotherTongueID'];
	$community=$_POST['ReligionID'];
	$caste=$_POST['CasteID'];
	$subcaste=$_POST['SubCaste'];
	$gothram=$_POST['Gothram'];
	$age=$_POST[''];
	$birthdate=$_POST[''];
	$birthtime=$_POST[''];
	$birthplace=$_POST[''];
	$star=$_POST[''];
	$moon=$_POST[''];
	$manglik=$_POST[''];
	$degree=$_POST[''];
	$studyarea=$_POST[''];
	$educationdetail=$_POST[''];
	$occupation=$_POST[''];
	$occupationdetail=$_POST[''];
	$annualincome=$_POST[''];
	$diet=$_POST[''];
	$smoking=$_POST[''];
	$drinking=$_POST[''];
	$c_country=$_POST[''];
	$c_state=$_POST[''];
	$c_city=$_POST[''];
	$l_country=$_POST[''];
	$l_state=$_POST[''];
	$l_city=$_POST[''];
	$livingstatus=$_POST[''];
	$address=$_POST[''];
	$phone=$_POST[''];
	$email=$_POST[''];
	$self=$_POST[''];
	$photo=$_POST[''];
	$loginid=$_POST[''];
	$loginpassword=$_POST[''];
	
}*/
?>
<?php $this->load->view('youth_milan/layout/header'); ?>
<!--update_monita20131002-->
<style>
.photogallery

{

/*	opacity:0;*/
opacity:0;
/*display:none;*/

}
$('#tabs')
{
	display:none;
}
</style>
<!--update_monita20130928-->
     <div id="loading" align="center" style="margin-top:350px!important;"><img src="<?php echo base_url();?>images/youth_milan/10.gif" /></div>
   <!--  <div id="content_tab">--><!-------update-monita20130928--------->
	<div class="photogallery">
	
		
      	<div class="logo-text2"><img align="absmiddle" alt="" src="<?php echo base_url();?>images/register-icon.png"> Registration	</div>
		
      <table align="center" border="0" cellpadding="0" cellspacing="0">
       
	    <tr>
         
		  <td valign="top"><!-- Tabs -->
          <!--action="manageYouthMilan.php" onsubmit="return ValidateForm(this)" 
          <form method="post" action="" id="frmBasicInfo" name="frmBasicInfo">-->
		  
            <div id="tabs">
              
			  <ul>
                <li><a href="#tabs-1">Basic Info<br />
                  <small>Physical Attribute</small> </a></li>
                <li><a href="#tabs-2">Social<br />
                  <small>Religious Info</small> </a></li>
                <li><a href="#tabs-3">Astrological<br />
                  <small> Info</small> </a></li>
                <li><a href="#tabs-4">Educational and<br />
                  <small> Professional Info</small> </a></li>
                <li><a href="#tabs-5">Life Style </a></li>
                <li><a href="#tabs-6">Location Contact <br />
                  <small> Information</small></a></li>
                <li><a href="#tabs-7">Brief About<br />
                  <small> Yourself</small> </a></li>
                <!--<li><a href="#tabs-8">Login<br />
                  <small> Information </small> </a></li>-->
              </ul>
			  
			  <!--------------basic info tab---------------->
              
              <div id="tabs-1">
			 
			  <?php
                $form_attributes = array('id' => 'myform1');
                echo form_open('', $form_attributes);
           	  ?>
               	<p>
                	<table width="100%" cellspacing="0" cellpadding="0" class="table-width">
                  	
					<tbody>
                    
					<tr>
                      
					  <td>
                          <input type="hidden" value="BasicInfo" id="Process" name="Process">
                          
						  <table width="100%" cellspacing="2" cellpadding="5" align="center">
                            
							<tbody>
                              
							  <tr valign="top" bgcolor="#E6E6E6"> 
								<td class="SubTitle BorderBtm" colspan="2">Basic Information/ Physical Attributes</td>
							  </tr>
							  
                              <tr>
                                <td align="center" colspan="2"></td>
                              </tr>
							  
							  <tr>
							  	<td colspan="2">
									<div class="sucess"><?php echo $this->session->userdata('tab_msg1'); $this->session->unset_userdata('tab_msg1');?>		
									</div>
								</td>
							  </tr>
							  
                              <tr>
							  
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Name <span class="err">*</span></strong>
								</td>
								<!-------------updated by dharati 201309261145------------->
								
                                <td class="txtBlack13Arial">
									<input type="text" value="<?php if(!$check1) { echo $query1->ym_name; } else {echo $query8->mm_fname." ".$query8->mm_lname;}?>" class="textBox_Admin" id="ym_name" name="ym_name" placeholder="Name">	
									<div class="error"><?php echo form_error('ym_name'); ?></div>
								</td>
								
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Gender <span class="err">*</span></strong></td>
                                <td class="txtBlack13Arial">
                                  <input type="radio" class="radio1" <?php if($check1){if($query8->mm_gender==false){echo 'checked="checked"';}} elseif($query1->ym_gender=="Male") {echo 'checked="checked"';}?> value="Male" id="ym_gender_m" name="ym_gender" style="margin:0 2px 0 0 ;" >
                                  Male
                                  <input type="radio" <?php if($check1){if($query8->mm_gender==true){echo 'checked="checked"';}} elseif($query1->ym_gender=="Female") {echo 'checked="checked"'; }?> value="Female" id="ym_gender_f" name="ym_gender" style="margin:0 2px 0 15px ;">
                                  Female
								  <!---------------end--------------->
								  
								  <div class="error"><?php echo form_error('ym_gender'); ?></div>
								</td>
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Marital Status <span class="err">*</span></strong></td>
                                <td class="txtBlack13Arial">
                                  <input type="radio" <?php if($check1){echo set_radio('ym_marital_status','Unmarried');} elseif($query1->ym_marital_status=="Unmarried") {echo 'checked="checked"';}?> value="Unmarried" id="ym_marital_status_u" name="ym_marital_status" style="margin:0 2px 0 0 ;">
                                  Unmarried
                                  <input type="radio" <?php if($check1){echo set_radio('ym_marital_status','Divorcee');} elseif($query1->ym_marital_status=="Divorcee") {echo 'checked="checked"';}?> value="Divorcee" id="ym_marital_status_d" name="ym_marital_status" style="margin:0 2px 0 15px ;">
                                  Divorcee
                                  <input type="radio" <?php if($check1){echo set_radio('ym_marital_status','Widow/Widower');} elseif($query1->ym_marital_status=="Widow/Widower") {echo 'checked="checked"';}?> value="Widow/Widower" id="ym_marital_status_w" name="ym_marital_status" style="margin:0 2px 0 15px ;">
                                  Widow/Widower
                                  <input type="radio" <?php if($check1){echo set_radio('ym_marital_status','Separated');} elseif($query1->ym_marital_status=="Separated") {echo 'checked="checked"';}?> value="Separated" id="ym_marital_status_s" name="ym_marital_status" style="margin:0 2px 0 15px ;">
                                  Separated
								  <div class="error"><?php echo form_error('ym_marital_status'); ?></div>
								</td>
								  
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Having Children <span class="err">*</span></strong></td>
                                <td class="txtBlack13Arial">
                                <input type="radio" <?php if($check1){echo set_radio('ym_children','No');} elseif($query1->ym_children=="No") {echo 'checked="checked"';}?> value="No" id="ym_children_n" name="ym_children" style="margin:0 2px 0 0 ;">
                                  No
                                  <input type="radio" <?php if($check1){echo set_radio('ym_children','Yes-Living with me');} elseif($query1->ym_children=="Yes-Living with me") {echo 'checked="checked"';}?> value="Yes-Living with me" id="ym_children_y" name="ym_children" style="margin:0 2px 0 15px ;">
                                  Yes-Living with me
                                  <input type="radio" <?php if($check1){echo set_radio('ym_children','Yes-Not living with me');} elseif($query1->ym_children=="Yes-Not living with me") {echo 'checked="checked"';}?> value="Yes-Not living with me" id="ym_children_yn" name="ym_children" style="margin:0 2px 0 15px ;">
                                  Yes-Not living with me
								  <div class="error"><?php echo form_error('ym_children'); ?></div>
								</td>
								  
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Height <span class="err">*</span></strong></td>
                                <td class="txtBlack13Arial">
								
                                <select id="ym_height" name="ym_height">
                                    <option value="">Select</option>

                            		<!--SELECT Height,Height FROM height ORDER BY Height-->
									<option id="4 ft 0 in/121cms" <?php if($check4){echo set_select('ym_height','121');} elseif($query1->ym_height=="121") {echo 'selected="selected"';}?> value="121">4 ft 0 in/121cms</option>
                                	<<option id="4 ft 1 in/124cms" <?php if($check1){echo set_select('ym_height','124');} elseif($query1->ym_height=="124") {echo 'selected="selected"';}?> value="124">4 ft 1 in/124cms</option>
									<option id="4 ft 2 in/127cms" <?php if($check1){echo set_select('ym_height','127');} elseif($query1->ym_height=="127") {echo 'selected="selected"';}?> value="127">4 ft 2 in/127cms</option>
									<option id="4 ft 3 in/129cms" <?php if($check1){echo set_select('ym_height','129');} elseif($query1->ym_height=="129") {echo 'selected="selected"';}?> value="129">4 ft 3 in/129cms</option>
									<option id="4 ft 4 in/132cms" <?php if($check1){echo set_select('ym_height','132');} elseif($query1->ym_height=="132") {echo 'selected="selected"';}?> value="132">4 ft 4 in/132cms</option>
									<option id="4 ft 5 in/134cms" <?php if($check1){echo set_select('ym_height','134');} elseif($query1->ym_height=="134") {echo 'selected="selected"';}?> value="134">4 ft 5 in/134cms</option>
									<option id="4 ft 6 in/137cms" <?php if($check1){echo set_select('ym_height','137');} elseif($query1->ym_height=="137") {echo 'selected="selected"';}?> value="137">4 ft 6 in/137cms</option>
									<option id="4 ft 7 in/139cms" <?php if($check1){echo set_select('ym_height','139');} elseif($query1->ym_height=="139") {echo 'selected="selected"';}?> value="139">4 ft 7 in/139cms</option>
									<option id="4 ft 8 in/142cms" <?php if($check1){echo set_select('ym_height','142');} elseif($query1->ym_height=="142") {echo 'selected="selected"';}?> value="142">4 ft 8 in/142cms</option>
									<option id="4 ft 9 in/144cms" <?php if($check1){echo set_select('ym_height','144');} elseif($query1->ym_height=="144") {echo 'selected="selected"';}?> value="144">4 ft 9 in/144cms</option>
									<option id="4 ft 10 in/147cms" <?php if($check1){echo set_select('ym_height','147');} elseif($query1->ym_height=="147") {echo 'selected="selected"';}?> value="147">4 ft 10 in/147cms</option>
									<option id="4 ft 11 in/149" <?php if($check1){echo set_select('ym_height','149');} elseif($query1->ym_height=="149") {echo 'selected="selected"';}?> value="149">4 ft 11 in/149cms</option>
									<option id="5 ft 0 in/152cms" <?php if($check1){echo set_select('ym_height','152');} elseif($query1->ym_height=="152") {echo 'selected="selected"';}?> value="152">5 ft 0 in/152cms</option>
									<option id="5 ft 1 in/154cms" <?php if($check1){echo set_select('ym_height','154');} elseif($query1->ym_height=="154") {echo 'selected="selected"';}?> value="154">5 ft 1 in/154cms</option>
									<option id="5 ft 2 in/157cms" <?php if($check1){echo set_select('ym_height','157');} elseif($query1->ym_height=="157") {echo 'selected="selected"';}?> value="157">5 ft 2 in/157cms</option>
									<option id="5 ft 3 in/160cms" <?php if($check1){echo set_select('ym_height','160');} elseif($query1->ym_height=="160") {echo 'selected="selected"';}?> value="160">5 ft 3 in/160cms</option>
									<option id="5 ft 4 in/162cms" <?php if($check1){echo set_select('ym_height','162');} elseif($query1->ym_height=="162") {echo 'selected="selected"';}?> value="162">5 ft 4 in/162cms</option>
									<option id="5 ft 5 in/165cms" <?php if($check1){echo set_select('ym_height','165');} elseif($query1->ym_height=="165") {echo 'selected="selected"';}?> value="165">5 ft 5 in/165cms</option>
									<option id="5 ft 6 in/167cms" <?php if($check1){echo set_select('ym_height','167');} elseif($query1->ym_height=="167") {echo 'selected="selected"';}?> value="167">5 ft 6 in/167cms</option>
									<option id="5 ft 7 in/170cms" <?php if($check1){echo set_select('ym_height','170');} elseif($query1->ym_height=="170") {echo 'selected="selected"';}?> value="170">5 ft 7 in/170cms</option>
									<option id="5 ft 8 in/172cms" <?php if($check1){echo set_select('ym_height','172');} elseif($query1->ym_height=="172") {echo 'selected="selected"';}?> value="172">5 ft 8 in/172cms</option>
									<option id="5 ft 9 in/175cms" <?php if($check1){echo set_select('ym_height','175');} elseif($query1->ym_height=="175") {echo 'selected="selected"';}?> value="175">5 ft 9 in/175cms</option>
									<option id="5 ft 10 in/177cms" <?php if($check1){echo set_select('ym_height','177');} elseif($query1->ym_height=="177") {echo 'selected="selected"';}?> value="177">5 ft 10 in/177cms</option>
									<option id="5 ft 11 in/180cms" <?php if($check1){echo set_select('ym_height','180');} elseif($query1->ym_height=="180") {echo 'selected="selected"';}?> value="180">5 ft 11 in/180cms</option>
									<option id="6 ft 0 in/182cms" <?php if($check1){echo set_select('ym_height','182');} elseif($query1->ym_height=="182") {echo 'selected="selected"';}?> value="182">6 ft 0 in/182cms</option>
									<option id="6 ft 1 in/185cms" <?php if($check1){echo set_select('ym_height','185');} elseif($query1->ym_height=="185") {echo 'selected="selected"';}?> value="185">6 ft 1 in/185cms</option>
									<option id="6 ft 2 in/187cms" <?php if($check1){echo set_select('ym_height','187');} elseif($query1->ym_height=="187") {echo 'selected="selected"';}?> value="187">6 ft 2 in/187cms</option>
									<option id="6 ft 3 in/190cms" <?php if($check1){echo set_select('ym_height','190');} elseif($query1->ym_height=="190") {echo 'selected="selected"';}?> value="190">6 ft 3 in/190cms</option>
									<option id="6 ft 4 in/193cms" <?php if($check1){echo set_select('ym_height','193');} elseif($query1->ym_height=="193") {echo 'selected="selected"';}?> value="193">6 ft 4 in/193cms</option>
									<option id="6 ft 5 in/195cms" <?php if($check1){echo set_select('ym_height','195');} elseif($query1->ym_height=="195") {echo 'selected="selected"';}?> value="195">6 ft 5 in/195cms</option>
									<option id="6 ft 6 in/198cms" <?php if($check1){echo set_select('ym_height','198');} elseif($query1->ym_height=="198") {echo 'selected="selected"';}?> value="198">6 ft 6 in/198cms</option>
									<option id="6 ft 7 in/200cms" <?php if($check1){echo set_select('ym_height','200');} elseif($query1->ym_height=="200") {echo 'selected="selected"';}?> value="200">6 ft 7 in/200cms</option>
									<option id="6 ft 8 in/203cms" <?php if($check1){echo set_select('ym_height','203');} elseif($query1->ym_height=="203") {echo 'selected="selected"';}?> value="203">6 ft 8 in/203cms</option>
									<option id="6 ft 9 in/205cms" <?php if($check1){echo set_select('ym_height','205');} elseif($query1->ym_height=="205") {echo 'selected="selected"';}?> value="205">6 ft 9 in/205cms</option>
									<option id="6 ft 10 in/208cms" <?php if($check1){echo set_select('ym_height','208');} elseif($query1->ym_height=="208") {echo 'selected="selected"';}?> value="208">6 ft 10 in/208cms</option>
									<option id="6 ft 11 in/210cms" <?php if($check1){echo set_select('ym_height','210');} elseif($query1->ym_height=="210") {echo 'selected="selected"';}?> value="210">6 ft 11 in/210cms</option>
									<option id="7 ft 0 in/213cms" <?php if($check1){echo set_select('ym_height','213');} elseif($query1->ym_height=="213") {echo 'selected="selected"';}?> value="213">7 ft 0 in/213cms</option>
                                </select>
								<div class="error"><?php echo form_error('ym_height'); ?></div>
								
								</td>
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Weight</strong></td>
                                <td class="txtBlack13Arial">
								
								<select id="ym_weight" name="ym_weight">
                                    <option value="">Select</option>
                                    
                            		<!--SELECT Weight,Weight FROM weight ORDER BY Weight-->
									
                                    <option id="40 kgs/ 88 lbs" <?php if($check1){} elseif($query1->ym_weight=="40") echo "selected='selected'"; ?> value="40" >40 kgs/ 88 lbs</option>
									<option id="41 kgs/ 90 lbs" <?php if($check1){} elseif($query1->ym_weight=="41") echo "selected='selected'"; ?> value="41">41 kgs/ 90 lbs</option>
									<option id="42 kgs/ 92 lbs" <?php if($check1){} elseif($query1->ym_weight=="42") echo "selected='selected'"; ?> value="42">42 kgs/ 92 lbs</option>
									<option id="43 kgs/ 94 lbs" <?php if($check1){} elseif($query1->ym_weight=="43") echo "selected='selected'"; ?> value="43">43 kgs/ 94 lbs</option>
									<option id="44 kgs/ 97 lbs" <?php if($check1){} elseif($query1->ym_weight=="44") echo "selected='selected'"; ?> value="44">44 kgs/ 97 lbs</option>
									<option id="45 kgs/ 99 lbs" <?php if($check1){} elseif($query1->ym_weight=="45") echo "selected='selected'"; ?> value="45">45 kgs/ 99 lbs</option>
									<option id="46 kgs/ 101 lbs" <?php if($check1){} elseif($query1->ym_weight=="46") echo "selected='selected'"; ?> value="46">46 kgs/ 101 lbs</option>
									<option id="47 kgs/ 103 lbs" <?php if($check1){} elseif($query1->ym_weight=="47") echo "selected='selected'"; ?> value="47">47 kgs/ 103 lbs</option>
									<option id="48 kgs/ 105 lbs" <?php if($check1){} elseif($query1->ym_weight=="48") echo "selected='selected'"; ?> value="48">48 kgs/ 105 lbs</option>
									<option id="49 kgs/ 108 lbs" <?php if($check1){} elseif($query1->ym_weight=="49") echo "selected='selected'"; ?> value="49">49 kgs/ 108 lbs</option>
									<option id="50 kgs/ 110 lbs" <?php if($check1){} elseif($query1->ym_weight=="50") echo "selected='selected'"; ?> value="50">50 kgs/ 110 lbs</option>
									<option id="51 kgs/ 112 lbs" <?php if($check1){} elseif($query1->ym_weight=="51") echo "selected='selected'"; ?> value="51">51 kgs/ 112 lbs</option>
									<option id="52 kgs/ 114 lbs" <?php if($check1){} elseif($query1->ym_weight=="52") echo "selected='selected'"; ?> value="52">52 kgs/ 114 lbs</option>
									<option id="53 kgs/ 116 lbs" <?php if($check1){} elseif($query1->ym_weight=="53") echo "selected='selected'"; ?> value="53">53 kgs/ 116 lbs</option>
									<option id="54 kgs/ 119 lbs" <?php if($check1){} elseif($query1->ym_weight=="54") echo "selected='selected'"; ?> value="54">54 kgs/ 119 lbs</option>
									<option id="55 kgs/ 121 lbs" <?php if($check1){} elseif($query1->ym_weight=="55") echo "selected='selected'"; ?> value="55">55 kgs/ 121 lbs</option>
									<option id="56 kgs/ 123 lbs" <?php if($check1){} elseif($query1->ym_weight=="56") echo "selected='selected'"; ?> value="56">56 kgs/ 123 lbs</option>
									<option id="57 kgs/ 125 lbs" <?php if($check1){} elseif($query1->ym_weight=="57") echo "selected='selected'"; ?> value="57">57 kgs/ 125 lbs</option>
									<option id="58 kgs/ 127 lbs" <?php if($check1){} elseif($query1->ym_weight=="58") echo "selected='selected'"; ?> value="58">58 kgs/ 127 lbs</option>
									<option id="59 kgs/ 130 lbs" <?php if($check1){} elseif($query1->ym_weight=="59") echo "selected='selected'"; ?> value="59">59 kgs/ 130 lbs</option>
									<option id="60 kgs/ 132 lbs" <?php if($check1){} elseif($query1->ym_weight=="60") echo "selected='selected'"; ?> value="60">60 kgs/ 132 lbs</option>
									<option id="61 kgs/ 134 lbs" <?php if($check1){} elseif($query1->ym_weight=="61") echo "selected='selected'"; ?> value="61">61 kgs/ 134 lbs</option>
									<option id="62 kgs/ 136 lbs" <?php if($check1){} elseif($query1->ym_weight=="62") echo "selected='selected'"; ?> value="62">62 kgs/ 136 lbs</option>
									<option id="63 kgs/ 138 lbs" <?php if($check1){} elseif($query1->ym_weight=="63") echo "selected='selected'"; ?> value="63">63 kgs/ 138 lbs</option>
									<option id="64 kgs/ 141 lbs" <?php if($check1){} elseif($query1->ym_weight=="64") echo "selected='selected'"; ?> value="64">64 kgs/ 141 lbs</option>
									<option id="65 kgs/ 143 lbs" <?php if($check1){} elseif($query1->ym_weight=="65") echo "selected='selected'"; ?> value="65">65 kgs/ 143 lbs</option>
									<option id="66 kgs/ 145 lbs" <?php if($check1){} elseif($query1->ym_weight=="66") echo "selected='selected'"; ?> value="66">66 kgs/ 145 lbs</option>
									<option id="67 kgs/ 147 lbs" <?php if($check1){} elseif($query1->ym_weight=="67") echo "selected='selected'"; ?> value="67">67 kgs/ 147 lbs</option>
									<option id="68 kgs/ 149 lbs" <?php if($check1){} elseif($query1->ym_weight=="68") echo "selected='selected'"; ?> value="68">68 kgs/ 149 lbs</option>
									<option id="69 kgs/ 152 lbs" <?php if($check1){} elseif($query1->ym_weight=="69") echo "selected='selected'"; ?> value="69">69 kgs/ 152 lbs</option>
									<option id="70 kgs/ 154 lbs" <?php if($check1){} elseif($query1->ym_weight=="70") echo "selected='selected'"; ?> value="70">70 kgs/ 154 lbs</option>
									<option id="71 kgs/ 156 lbs" <?php if($check1){} elseif($query1->ym_weight=="71") echo "selected='selected'"; ?> value="71">71 kgs/ 156 lbs</option>
									<option id="72 kgs/ 158 lbs" <?php if($check1){} elseif($query1->ym_weight=="72") echo "selected='selected'"; ?> value="72">72 kgs/ 158 lbs</option>
									<option id="73 kgs/ 160 lbs" <?php if($check1){} elseif($query1->ym_weight=="73") echo "selected='selected'"; ?> value="73">73 kgs/ 160 lbs</option>
									<option id="74 kgs/ 163 lbs" <?php if($check1){} elseif($query1->ym_weight=="74") echo "selected='selected'"; ?> value="74">74 kgs/ 163 lbs</option>
									<option id="75 kgs/ 165 lbs" <?php if($check1){} elseif($query1->ym_weight=="75") echo "selected='selected'"; ?> value="75">75 kgs/ 165 lbs</option>
									<option id="76 kgs/ 167 lbs" <?php if($check1){} elseif($query1->ym_weight=="76") echo "selected='selected'"; ?> value="76">76 kgs/ 167 lbs</option>
									<option id="77 kgs/ 169 lbs" <?php if($check1){} elseif($query1->ym_weight=="77") echo "selected='selected'"; ?> value="77">77 kgs/ 169 lbs</option>
									<option id="78 kgs/ 171 lbs" <?php if($check1){} elseif($query1->ym_weight=="78") echo "selected='selected'"; ?> value="78">78 kgs/ 171 lbs</option>
									<option id="79 kgs/ 174 lbs" <?php if($check1){} elseif($query1->ym_weight=="79") echo "selected='selected'"; ?> value="79">79 kgs/ 174 lbs</option>
									<option id="80 kgs/ 176 lbs" <?php if($check1){} elseif($query1->ym_weight=="80") echo "selected='selected'"; ?> value="80">80 kgs/ 176 lbs</option>
									<option id="81 kgs/ 178 lbs" <?php if($check1){} elseif($query1->ym_weight=="81") echo "selected='selected'"; ?> value="81">81 kgs/ 178 lbs</option>
									<option id="82 kgs/ 180 lbs" <?php if($check1){} elseif($query1->ym_weight=="82") echo "selected='selected'"; ?> value="82">82 kgs/ 180 lbs</option>
									<option id="83 kgs/ 182 lbs" <?php if($check1){} elseif($query1->ym_weight=="83") echo "selected='selected'"; ?> value="83">83 kgs/ 182 lbs</option>
									<option id="84 kgs/ 185 lbs" <?php if($check1){} elseif($query1->ym_weight=="84") echo "selected='selected'"; ?> value="84">84 kgs/ 185 lbs</option>
									<option id="85 kgs/ 187 lbs" <?php if($check1){} elseif($query1->ym_weight=="85") echo "selected='selected'"; ?> value="85">85 kgs/ 187 lbs</option>
									<option id="86 kgs/ 189 lbs" <?php if($check1){} elseif($query1->ym_weight=="86") echo "selected='selected'"; ?> value="86">86 kgs/ 189 lbs</option>
									<option id="87 kgs/ 191 lbs" <?php if($check1){} elseif($query1->ym_weight=="87") echo "selected='selected'"; ?> value="87">87 kgs/ 191 lbs</option>
									<option id="88 kgs/ 194 lbs" <?php if($check1){} elseif($query1->ym_weight=="88") echo "selected='selected'"; ?> value="88">88 kgs/ 194 lbs</option>
									<option id="89 kgs/ 196 lbs" <?php if($check1){} elseif($query1->ym_weight=="89") echo "selected='selected'"; ?> value="89">89 kgs/ 196 lbs</option>
									<option id="90 kgs/ 198 lbs" <?php if($check1){} elseif($query1->ym_weight=="90") echo "selected='selected'"; ?> value="90">90 kgs/ 198 lbs</option>
									<option id="91 kgs/ 200 lbs" <?php if($check1){} elseif($query1->ym_weight=="91") echo "selected='selected'"; ?> value="91">91 kgs/ 200 lbs</option>
									<option id="92 kgs/ 202 lbs" <?php if($check1){} elseif($query1->ym_weight=="92") echo "selected='selected'"; ?> value="92">92 kgs/ 202 lbs</option>
									<option id="93 kgs/ 205 lbs" <?php if($check1){} elseif($query1->ym_weight=="93") echo "selected='selected'"; ?> value="93">93 kgs/ 205 lbs</option>
									<option id="94 kgs/ 207 lbs" <?php if($check1){} elseif($query1->ym_weight=="94") echo "selected='selected'"; ?> value="94">94 kgs/ 207 lbs</option>
									<option id="95 kgs/ 209 lbs" <?php if($check1){} elseif($query1->ym_weight=="95") echo "selected='selected'"; ?> value="95">95 kgs/ 209 lbs</option>
									<option id="96 kgs/ 211 lbs" <?php if($check1){} elseif($query1->ym_weight=="96") echo "selected='selected'"; ?> value="96">96 kgs/ 211 lbs</option>
									<option id="97 kgs/ 213 lbs" <?php if($check1){} elseif($query1->ym_weight=="97") echo "selected='selected'"; ?> value="97">97 kgs/ 213 lbs</option>
									<option id="98 kgs/ 216 lbs" <?php if($check1){} elseif($query1->ym_weight=="98") echo "selected='selected'"; ?> value="98">98 kgs/ 216 lbs</option>
									<option id="99 kgs/ 218 lbs" <?php if($check1){} elseif($query1->ym_weight=="99") echo "selected='selected'"; ?> value="99">99 kgs/ 218 lbs</option>
									<option id="100 kgs/ 220 lbs" <?php if($check1){} elseif($query1->ym_weight=="100") echo "selected='selected'"; ?> value="100">100 kgs/ 220 lbs</option>
									<option id="101 kgs/ 222 lbs" <?php if($check1){} elseif($query1->ym_weight=="101") echo "selected='selected'"; ?> value="101">101 kgs/ 222 lbs</option>
									<option id="102 kgs/ 224 lbs" <?php if($check1){} elseif($query1->ym_weight=="102") echo "selected='selected'"; ?> value="102">102 kgs/ 224 lbs</option>
									<option id="103 kgs/ 227 lbs" <?php if($check1){} elseif($query1->ym_weight=="103") echo "selected='selected'"; ?> value="103">103 kgs/ 227 lbs</option>
									<option id="104 kgs/ 229 lbs" <?php if($check1){} elseif($query1->ym_weight=="104") echo "selected='selected'"; ?> value="104">104 kgs/ 229 lbs</option>
									<option id="105 kgs/ 231 lbs" <?php if($check1){} elseif($query1->ym_weight=="105") echo "selected='selected'"; ?> value="105">105 kgs/ 231 lbs</option>
									<option id="106 kgs/ 233 lbs"<?php if($check1){} elseif($query1->ym_weight=="106") echo "selected='selected'"; ?> value="106">106 kgs/ 233 lbs</option>
									<option id="107 kgs/ 235 lbs" <?php if($check1){} elseif($query1->ym_weight=="107") echo "selected='selected'"; ?>  value="107">107 kgs/ 235 lbs</option>
									<option id="108 kgs/ 238 lbs" <?php if($check1){} elseif($query1->ym_weight=="108") echo "selected='selected'"; ?> value="108">108 kgs/ 238 lbs</option>
									<option id="109 kgs/ 240 lbs" <?php if($check1){} elseif($query1->ym_weight=="109") echo "selected='selected'"; ?> value="109">109 kgs/ 240 lbs</option>
									<option id="110 kgs/ 242 lbs" <?php if($check1){} elseif($query1->ym_weight=="110") echo "selected='selected'"; ?> value="110">110 kgs/ 242 lbs</option>
									<option id="111 kgs/ 244 lbs" <?php if($check1){} elseif($query1->ym_weight=="111") echo "selected='selected'"; ?> value="111">111 kgs/ 244 lbs</option>
									<option id="112 kgs/ 246 lbs" <?php if($check1){} elseif($query1->ym_weight=="112") echo "selected='selected'"; ?> value="112">112 kgs/ 246 lbs</option>
									<option id="113 kgs/ 249 lbs" <?php if($check1){} elseif($query1->ym_weight=="113") echo "selected='selected'"; ?> value="113">113 kgs/ 249 lbs</option>
									<option id="114 kgs/ 251 lbs" <?php if($check1){} elseif($query1->ym_weight=="114") echo "selected='selected'"; ?> value="114">114 kgs/ 251 lbs</option>
									<option id="115 kgs/ 253 lbs" <?php if($check1){} elseif($query1->ym_weight=="115") echo "selected='selected'"; ?> value="115">115 kgs/ 253 lbs</option>
									<option id="116 kgs/ 255 lbs" <?php if($check1){} elseif($query1->ym_weight=="116") echo "selected='selected'"; ?> value="116">116 kgs/ 255 lbs</option>
									<option id="117 kgs/ 257 lbs" <?php if($check1){} elseif($query1->ym_weight=="117") echo "selected='selected'"; ?> value="117">117 kgs/ 257 lbs</option>
									<option id="118 kgs/ 260 lbs" <?php if($check1){} elseif($query1->ym_weight=="118") echo "selected='selected'"; ?> value="118">118 kgs/ 260 lbs</option>
									<option id="119 kgs/ 262 lbs" <?php if($check1){} elseif($query1->ym_weight=="119") echo "selected='selected'"; ?> value="119">119 kgs/ 262 lbs</option>
									<option id="120 kgs/ 264 lbs" <?php if($check1){} elseif($query1->ym_weight=="120") echo "selected='selected'"; ?> value="120">120 kgs/ 264 lbs</option>
									<option id="121 kgs/ 266 lbs" <?php if($check1){} elseif($query1->ym_weight=="121") echo "selected='selected'"; ?> value="121">121 kgs/ 266 lbs</option>
									<option id="122 kgs/ 268 lbs" <?php if($check1){} elseif($query1->ym_weight=="122") echo "selected='selected'"; ?> value="122">122 kgs/ 268 lbs</option>
									<option id="123 kgs/ 271 lbs" <?php if($check1){} elseif($query1->ym_weight=="123") echo "selected='selected'"; ?> value="123">123 kgs/ 271 lbs</option>
									<option id="124 kgs/ 273 lbs" <?php if($check1){} elseif($query1->ym_weight=="124") echo "selected='selected'"; ?> value="124">124 kgs/ 273 lbs</option>
									<option id="125 kgs/ 275 lbs" <?php if($check1){} elseif($query1->ym_weight=="125") echo "selected='selected'"; ?> value="125">125 kgs/ 275 lbs</option>
									<option id="126 kgs/ 277 lbs" <?php if($check1){} elseif($query1->ym_weight=="126") echo "selected='selected'"; ?> value="126">126 kgs/ 277 lbs</option>
									<option id="127 kgs/ 279 lbs" <?php if($check1){} elseif($query1->ym_weight=="127") echo "selected='selected'"; ?> value="127">127 kgs/ 279 lbs</option>
									<option id="128 kgs/ 282 lbs" <?php if($check1){} elseif($query1->ym_weight=="128") echo "selected='selected'"; ?> value="128">128 kgs/ 282 lbs</option>
									<option id="129 kgs/ 284 lbs" <?php if($check1){} elseif($query1->ym_weight=="129") echo "selected='selected'"; ?> value="129">129 kgs/ 284 lbs</option>
									<option id="130 kgs/ 286 lbs" <?php if($check1){} elseif($query1->ym_weight=="130") echo "selected='selected'"; ?> value="130">130 kgs/ 286 lbs</option>
									<option id="131 kgs/ 288 lbs" <?php if($check1){} elseif($query1->ym_weight=="131") echo "selected='selected'"; ?> value="131">131 kgs/ 288 lbs</option>
									<option id="132 kgs/ 291 lbs" <?php if($check1){} elseif($query1->ym_weight=="132") echo "selected='selected'"; ?> value="132">132 kgs/ 291 lbs</option>
									<option id="133 kgs/ 293 lbs" <?php if($check1){} elseif($query1->ym_weight=="133") echo "selected='selected'"; ?> value="133">133 kgs/ 293 lbs</option>
									<option id="134 kgs/ 295 lbs" <?php if($check1){} elseif($query1->ym_weight=="134") echo "selected='selected'"; ?> value="134">134 kgs/ 295 lbs</option>
									<option id="135 kgs/ 297 lbs" <?php if($check1){} elseif($query1->ym_weight=="135") echo "selected='selected'"; ?> value="135">135 kgs/ 297 lbs</option>
									<option id="136 kgs/ 299 lbs" <?php if($check1){} elseif($query1->ym_weight=="136") echo "selected='selected'"; ?> value="136">136 kgs/ 299 lbs</option>
									<option id="137 kgs/ 302 lbs" <?php if($check1){} elseif($query1->ym_weight=="137") echo "selected='selected'"; ?> value="137">137 kgs/ 302 lbs</option>
									<option id="138 kgs/ 304 lbs" <?php if($check1){} elseif($query1->ym_weight=="138") echo "selected='selected'"; ?> value="138">138 kgs/ 304 lbs</option>
									<option id="139 kgs/ 306 lbs" <?php if($check1){} elseif($query1->ym_weight=="139") echo "selected='selected'"; ?> value="139">139 kgs/ 306 lbs</option>
									<option id="140 kgs/ 308 lbs" <?php if($check1){} elseif($query1->ym_weight=="140") echo "selected='selected'"; ?> value="140">140 kgs/ 308 lbs</option>
									<option id="141 kgs/ 310 lbs" <?php if($check1){} elseif($query1->ym_weight=="141") echo "selected='selected'"; ?> value="141">141 kgs/ 310 lbs</option>
									<option id="142 kgs/ 313 lbs" <?php if($check1){} elseif($query1->ym_weight=="142") echo "selected='selected'"; ?> value="142">142 kgs/ 313 lbs</option>
									<option id="143 kgs/ 315 lbs" <?php if($check1){} elseif($query1->ym_weight=="143") echo "selected='selected'"; ?> value="143">143 kgs/ 315 lbs</option>
									<option id="144 kgs/ 317 lbs" <?php if($check1){} elseif($query1->ym_weight=="144") echo "selected='selected'"; ?> value="144">144 kgs/ 317 lbs</option>
									<option id="145 kgs/ 319 lbs" <?php if($check1){} elseif($query1->ym_weight=="145") echo "selected='selected'"; ?> value="145">145 kgs/ 319 lbs</option>
									<option id="146 kgs/ 321 lbs" <?php if($check1){} elseif($query1->ym_weight=="146") echo "selected='selected'"; ?> value="146">146 kgs/ 321 lbs</option>
									<option id="147 kgs/ 324 lbs" <?php if($check1){} elseif($query1->ym_weight=="147") echo "selected='selected'"; ?> value="147">147 kgs/ 324 lbs</option>
									<option id="148 kgs/ 326 lbs" <?php if($check1){} elseif($query1->ym_weight=="148") echo "selected='selected'"; ?> value="148">148 kgs/ 326 lbs</option>
									<option id="149 kgs/ 328 lbs" <?php if($check1){} elseif($query1->ym_weight=="149") echo "selected='selected'"; ?> value="149">149 kgs/ 328 lbs</option>
									<option id="150 kgs/ 330 lbs" <?php if($check1){} elseif($query1->ym_weight=="150") echo "selected='selected'"; ?> value="150">150 kgs/ 330 lbs</option>
                                </select>
								
								</td>
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Body Type </strong></td>
                                <td class="txtBlack13Arial">
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_body_type=="Athletic") {echo 'checked="checked"';}?> value="Athletic" id="ym_body_type_at" name="ym_body_type" style="margin:0 2px 0 0 ;">
                                  Athletic
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_body_type=="Average") {echo 'checked="checked"';}?> value="Average" id="ym_body_type_av" name="ym_body_type" style="margin:0 2px 0 15px ;">
                                  Average
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_body_type=="Chubby") {echo 'checked="checked"';}?> value="Chubby" id="ym_body_type_c" name="ym_body_type" style="margin:0 2px 0 15px ;">
                                  Chubby
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_body_type=="Heavy") {echo 'checked="checked"';}?> value="Heavy" id="ym_body_type_c" name="ym_body_type" style="margin:0 2px 0 15px ;">
                                  Heavy
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_body_type=="Slim") {echo 'checked="checked"';}?> value="Slim" id="ym_body_type_c" name="ym_body_type" style="margin:0 2px 0 15px ;">
                                  Slim </td>
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Complexion</strong></td>
                                <td class="txtBlack13Arial">
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Dark") {echo 'checked="checked"';}?> value="Dark" id="ym_complexion_d" name="ym_complexion" style="margin:0 2px 0 0 ;">
                                  Dark
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Fair") {echo 'checked="checked"';}?> value="Fair" id="ym_complexion_f" name="ym_complexion" style="margin:0 2px 0 15px ;">
                                  Fair
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Very Fair") {echo 'checked="checked"';}?> value="Very Fair" id="ym_complexion_vf" name="ym_complexion" style="margin:0 2px 0 15px ;">
                                  Very Fair
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Wheatish") {echo 'checked="checked"';}?> value="Wheatish" id="ym_complexion_w" name="ym_complexion" style="margin:0 2px 0 15px ;">
                                  Wheatish <br>
                                  <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Wheatish Brown") {echo 'checked="checked"';}?> value="Wheatish Brown" id="ym_complexion_wb" name="ym_complexion" style="margin:0 2px 0 0 ;">
                                  Wheatish Brown
                                 <input type="radio" <?php if($check1){} elseif($query1->ym_complexion=="Wheatish medium") {echo 'checked="checked"';}?> value="Wheatish medium" id="ym_complexion_wm" name="ym_complexion" style="margin:0 2px 0 15px ;">
                                  Wheatish medium 
								</td>
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Physical Status <span class="err">*</span></strong></td>
                                <td class="txtBlack13Arial">
								
                                <select  class="combo" id="ym_physical_status" name="ym_physical_status">
                                    <option value="">Select</option>
                                    
                            		<!--SELECT Parameter,ParameterID FROM PhysicalStatus ORDER BY Parameter-->
									
                                    <option id="Any other" <?php if($check1){echo set_select('ym_physical_status','Any other');} elseif($query1->ym_physical_status=="Any other") echo "selected='selected'"; ?> value="Any other" >Any other</option>
									<option id="Mentally challenged due to accident" <?php if($check1){echo set_select('ym_physical_status','Mentally challenged due to accident');} elseif($query1->ym_physical_status=="Mentally challenged due to accident") echo "selected='selected'"; ?> value="Mentally challenged due to accident">Mentally challenged due to accident</option>
									<option id="Mentally challenged from birth" <?php if($check1){echo set_select('ym_physical_status','Mentally challenged from birth');} elseif($query1->ym_physical_status=="Mentally challenged from birth") echo "selected='selected'"; ?> value="Mentally challenged from birth">Mentally challenged from birth</option>
									<option id="Normal" <?php if($check1){echo set_select('ym_physical_status','Normal');} elseif($query1->ym_physical_status=="Normal") echo "selected='selected'"; ?> value="Normal">Normal</option>
									<option id="Physically challenged due to accident" <?php if($check1){echo set_select('ym_physical_status','Physically challenged due to accident');} elseif($query1->ym_physical_status=="Physically challenged due to accident") echo "selected='selected'"; ?> value="Physically challenged due to accident">Physically challenged due to accident</option>
									<option id="Physically challenged from birth" <?php if($check1){echo set_select('ym_physical_status','Physically challenged from birth');} elseif($query1->ym_physical_status=="Physically challenged from birth") echo "selected='selected'"; ?> value="Physically challenged from birth">Physically challenged from birth</option>
                                </select>
								<div class="error"><?php echo form_error('ym_physical_status'); ?></div>
								
								</td>
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Blood Group</strong></td>
                                <td class="txtBlack13Arial">
								
								<select  class="combo" id="ym_blood_group" name="ym_blood_group">
                                    <option value="">Select</option>
                                    
                            		<!--SELECT Parameter,ParameterID FROM bloodgroup ORDER BY Parameter-->
                                    <option id="Apo" <?php if($check1){} elseif($query1->ym_blood_group=="A+") echo "selected='selected'"; ?> value="A+">A+</option>
									<option id="Ane" <?php if($check1){} elseif($query1->ym_blood_group=="A-") echo "selected='selected'"; ?> value="A-">A-</option>
									<option id="A1po" <?php if($check1){} elseif($query1->ym_blood_group=="A1+") echo "selected='selected'"; ?> value="A1+">A1+</option>
									<option id="A1ne" <?php if($check1){} elseif($query1->ym_blood_group=="A1-") echo "selected='selected'"; ?> value="A1-">A1-</option>
									<option id="A1Bpo" <?php if($check1){} elseif($query1->ym_blood_group=="A1B+") echo "selected='selected'"; ?> value="A1B+">A1B+</option>
									<option id="A1Bne" <?php if($check1){} elseif($query1->ym_blood_group=="A1B-") echo "selected='selected'"; ?> value="A1B-">A1B-</option>
									<option id="A2po" <?php if($check1){} elseif($query1->ym_blood_group=="A2+") echo "selected='selected'"; ?> value="A2+">A2+</option>
									<option id="A2ne" <?php if($check1){} elseif($query1->ym_blood_group=="A2-") echo "selected='selected'"; ?> value="A2-">A2-</option>
									<option id="A2Bpo" <?php if($check1){} elseif($query1->ym_blood_group=="A2B+") echo "selected='selected'"; ?> value="A2B+">A2B+</option>
									<option id="A2Bne" <?php if($check1){} elseif($query1->ym_blood_group=="A2B-") echo "selected='selected'"; ?> value="A2B-">A2B-</option>
									<option id="ABpo" <?php if($check1){} elseif($query1->ym_blood_group=="AB+") echo "selected='selected'"; ?> value="AB+">AB+</option>
									<option id="ABne" <?php if($check1){} elseif($query1->ym_blood_group=="AB-") echo "selected='selected'"; ?> value="AB-">AB-</option>
									<option id="Bpo" <?php if($check1){} elseif($query1->ym_blood_group=="B+") echo "selected='selected'"; ?> value="B+">B+</option>
									<option id="Bne" <?php if($check1){} elseif($query1->ym_blood_group=="B-") echo "selected='selected'"; ?> value="B-">B-</option>
									<option id="Cpo" <?php if($check1){} elseif($query1->ym_blood_group=="C+") echo "selected='selected'"; ?> value="C+">C+</option>
									<option id="Cne" <?php if($check1){} elseif($query1->ym_blood_group=="C-") echo "selected='selected'"; ?> value="C-">C-</option>
									<option id="Opo" <?php if($check1){} elseif($query1->ym_blood_group=="O+") echo "selected='selected'"; ?> value="O+">O+</option>
									<option id="One" <?php if($check1){} elseif($query1->ym_blood_group=="O-") echo "selected='selected'"; ?> value="O-">O-</option>
                                </select>
								
								</td>
                              </tr>
							  
                              <tr>
                                <td></td>
                                <td align="left"><input type="submit" class="btn btn-primary" value="Update" id="ym_update1" name="ym_update1">
                                  &nbsp;
                                  <input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="ym_cancel1" name="ym_cancel1"></td>
                              </tr>
							  
                            </tbody>
							
                          </table>
						  
                          <!--<input type="hidden" value="Field=Name|Alias=Name|Validate=Blank^
	  		 Field=Gender|Alias=Gender|Validate=Select^
             Field=MaritalStatus|Alias=Marital Status|Validate=Select^
             Field=HavingChildren|Alias=Having Children|Validate=Select^
             Field=Height|Alias=Height|Validate=Combo^
             Field=PhysicalStatusID|Alias=Physical Status|Validate=Combo" name="Validation">-->
			 
                        </td>
						
                    </tr>
					
                  </tbody>
				  
                </table>
				
                </p>
				
				<?php echo form_close();?>
				
              </div>
			  
			  <!--------------end of basic info tab---------------->
			  
			  <!--------------social info tab---------------->
			  
              <div id="tabs-2">
			  
               <?php
                $form_attributes = array('id' => 'myform2');
                echo form_open('', $form_attributes);
           	   ?>
			   
				<table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
				
                <tbody>
				<tr bgcolor="#E6E6E6">
                    <td class="SubTitle BorderBtm" colspan="2">Religious/ Social Background </td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="2"></td>
   				</tr>
				
				<tr>
					<td colspan="2">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg2'); $this->session->unset_userdata('tab_msg2');?>		
						</div>
					</td>
				</tr>
				
                <tr>
                    <td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Mother Tongue <span class="err">*</span></strong></td>
                    <td class="txtBlack13Arial">
                    	<select  class="combo" id="ym_mother_tongue" name="ym_mother_tongue">
                            <option value="">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM mothertongue ORDER BY Parameter-->
							
							<option id="Aka" <?php if($check2){echo set_select('ym_mother_tongue','Aka');} elseif($query2->ym_mother_tongue=="Aka") echo "selected='selected'"; ?> value="Aka">Aka</option>
							<option id="Angika" <?php if($check2){echo set_select('ym_mother_tongue','Angika');} elseif($query2->ym_mother_tongue=="Angika") echo "selected='selected'"; ?> value="Angika">Angika</option>
							<option id="Arabic" <?php if($check2){echo set_select('ym_mother_tongue','Arabic');} elseif($query2->ym_mother_tongue=="Arabic") echo "selected='selected'"; ?> value="Arabic">Arabic</option>
							<option id="Assamese" <?php if($check2){echo set_select('ym_mother_tongue','Assamese');} elseif($query2->ym_mother_tongue=="Assamese") echo "selected='selected'"; ?> value="Assamese">Assamese</option>
							<option id="Aurnachali" <?php if($check2){echo set_select('ym_mother_tongue','Aurnachali');} elseif($query2->ym_mother_tongue=="Aurnachali") echo "selected='selected'"; ?> value="Aurnachali">Aurnachali</option>
							<option id="Awadhi" <?php if($check2){echo set_select('ym_mother_tongue','Awadhi');} elseif($query2->ym_mother_tongue=="Awadhi") echo "selected='selected'"; ?> value="Awadhi">Awadhi</option>
							<option id="Bagri" <?php if($check2){echo set_select('ym_mother_tongue','Bagri');} elseif($query2->ym_mother_tongue=="Bagri") echo "selected='selected'"; ?> value="Bagri">Bagri</option>
							<option id="Bengali" <?php if($check2){echo set_select('ym_mother_tongue','Bengali');} elseif($query2->ym_mother_tongue=="Bengali") echo "selected='selected'"; ?> value="Bengali">Bengali</option>
							<option id="Bhili" <?php if($check2){echo set_select('ym_mother_tongue','Bhili');} elseif($query2->ym_mother_tongue=="Bhili") echo "selected='selected'"; ?> value="Bhili">Bhili</option>
							<option id="Bhojpuri" <?php if($check2){echo set_select('ym_mother_tongue','Bhojpuri');} elseif($query2->ym_mother_tongue=="Bhojpuri") echo "selected='selected'"; ?> value="Bhojpuri">Bhojpuri</option>
							<option id="Bhutia" <?php if($check2){echo set_select('ym_mother_tongue','Bhutia');} elseif($query2->ym_mother_tongue=="Bhutia") echo "selected='selected'"; ?> value="Bhutia">Bhutia</option>
							<option id="Bihari" <?php if($check2){echo set_select('ym_mother_tongue','Bihari');} elseif($query2->ym_mother_tongue=="Bihari") echo "selected='selected'"; ?> value="Bihari">Bihari</option>
							<option id="Brij" <?php if($check2){echo set_select('ym_mother_tongue','Brij');} elseif($query2->ym_mother_tongue=="Brij") echo "selected='selected'"; ?> value="Brij">Brij</option>
							<option id="Chatisgarhi" <?php if($check2){echo set_select('ym_mother_tongue','Chatisgarhi');} elseif($query2->ym_mother_tongue=="Chatisgarhi") echo "selected='selected'"; ?> value="Chatisgarhi">Chatisgarhi</option>
							<option id="Chinese" <?php if($check2){echo set_select('ym_mother_tongue','Chinese');} elseif($query2->ym_mother_tongue=="Chinese") echo "selected='selected'"; ?> value="Chinese">Chinese</option>
							<option id="Czech" <?php if($check2){echo set_select('ym_mother_tongue','Czech');} elseif($query2->ym_mother_tongue=="Czech") echo "selected='selected'"; ?> value="Czech">Czech</option>
							<option id="Danish" <?php if($check2){echo set_select('ym_mother_tongue','Danish');} elseif($query2->ym_mother_tongue=="Danish") echo "selected='selected'"; ?> value="Danish">Danish</option>
							<option id="Deccani/Dakkhini" <?php if($check2){echo set_select('ym_mother_tongue','Deccani/Dakkhini');} elseif($query2->ym_mother_tongue=="Deccani/Dakkhini") echo "selected='selected'"; ?> value="Deccani/Dakkhini">Deccani/Dakkhini</option>
							<option id="Dogri-Kandri" <?php if($check2){echo set_select('ym_mother_tongue','Dogri-Kandri');} elseif($query2->ym_mother_tongue=="Dogri-Kandri") echo "selected='selected'"; ?> value="Dogri-Kandri">Dogri-Kandri</option>
							<option id="Dutch" <?php if($check2){echo set_select('ym_mother_tongue','Dutch');} elseif($query2->ym_mother_tongue=="Dutch") echo "selected='selected'"; ?> value="Dutch">Dutch</option>
							<option id="English" <?php if($check2){echo set_select('ym_mother_tongue','English');} elseif($query2->ym_mother_tongue=="English") echo "selected='selected'"; ?> value="English">English</option>
							<option id="Estonian" <?php if($check2){echo set_select('ym_mother_tongue','Estonian');} elseif($query2->ym_mother_tongue=="Estonian") echo "selected='selected'"; ?> value="Estonian">Estonian</option>
							<option id="Finnish" <?php if($check2){echo set_select('ym_mother_tongue','Finnish');} elseif($query2->ym_mother_tongue=="Finnish") echo "selected='selected'"; ?> value="Finnish">Finnish</option>
							<option id="French" <?php if($check2){echo set_select('ym_mother_tongue','French');} elseif($query2->ym_mother_tongue=="French") echo "selected='selected'"; ?> value="French">French</option>
							<option id="Garhwali" <?php if($check2){echo set_select('ym_mother_tongue','Garhwali');} elseif($query2->ym_mother_tongue=="Garhwali") echo "selected='selected'"; ?> value="Garhwali">Garhwali</option>
							<option id="Garo" <?php if($check2){echo set_select('ym_mother_tongue','Garo');echo set_select('ym_mother_tongue','');} elseif($query2->ym_mother_tongue=="Garo") echo "selected='selected'"; ?> value="Garo">Garo</option>
							<option id="German" <?php if($check2){echo set_select('ym_mother_tongue','German');} elseif($query2->ym_mother_tongue=="German") echo "selected='selected'"; ?> value="German">German</option>
							<option id="Gondi" <?php if($check2){echo set_select('ym_mother_tongue','Gondi');} elseif($query2->ym_mother_tongue=="Gondi") echo "selected='selected'"; ?> value="Gondi">Gondi</option>
							<option id="Greek" <?php if($check2){echo set_select('ym_mother_tongue','Greek');} elseif($query2->ym_mother_tongue=="Greek") echo "selected='selected'"; ?> value="Greek">Greek</option>
							<option id="Gujarati" <?php if($check2){echo set_select('ym_mother_tongue','Gujarati');} elseif($query2->ym_mother_tongue=="Gujarati") echo "selected='selected'"; ?> value="Gujarati">Gujarati</option>
							<option id="Haryanvi" <?php if($check2){echo set_select('ym_mother_tongue','');} elseif($query2->ym_mother_tongue=="Haryanvi") echo "selected='selected'"; ?> value="Haryanvi">Haryanvi</option>
							<option id="Hebrew" <?php if($check2){echo set_select('ym_mother_tongue','');} elseif($query2->ym_mother_tongue=="Hebrew") echo "selected='selected'"; ?> value="Hebrew">Hebrew</option>
							<option id="Himachali / Pahari" <?php if($check2){echo set_select('ym_mother_tongue','Himachali / Pahari');} elseif($query2->ym_mother_tongue=="Himachali / Pahari") echo "selected='selected'"; ?> value="Himachali / Pahari">Himachali / Pahari</option>
							<option id="Hindi" <?php if($check2){echo set_select('ym_mother_tongue','Hindi');} elseif($query2->ym_mother_tongue=="Hindi") echo "selected='selected'"; ?> value="Hindi">Hindi</option>
							<option id="Ho" <?php if($check2){echo set_select('ym_mother_tongue','Ho');} elseif($query2->ym_mother_tongue=="Ho") echo "selected='selected'"; ?> value="Ho">Ho</option>
							<option id="Hungarian" <?php if($check2){echo set_select('ym_mother_tongue','Hungarian');} elseif($query2->ym_mother_tongue=="Hungarian") echo "selected='selected'"; ?> value="Hungarian">Hungarian</option>
							<option id="Icelandic" <?php if($check2){echo set_select('ym_mother_tongue','Icelandic');} elseif($query2->ym_mother_tongue=="Icelandic") echo "selected='selected'"; ?> value="Icelandic">Icelandic</option>
							<option id="Italian" <?php if($check2){echo set_select('ym_mother_tongue','Italian');} elseif($query2->ym_mother_tongue=="Italian") echo "selected='selected'"; ?> value="Italian">Italian</option>
							<option id="Japanese" <?php if($check2){echo set_select('ym_mother_tongue','Japanese');} elseif($query2->ym_mother_tongue=="Japanese") echo "selected='selected'"; ?> value="Japanese">Japanese</option>
							<option id="Jews" <?php if($check2){echo set_select('ym_mother_tongue','Jews');} elseif($query2->ym_mother_tongue=="Jews") echo "selected='selected'"; ?> value="Jews">Jews</option>
							<option id="Kanauji" <?php if($check2){echo set_select('ym_mother_tongue','Kanauji');} elseif($query2->ym_mother_tongue=="Kanauji") echo "selected='selected'"; ?> value="Kanauji">Kanauji</option>
							<option id="Kannada" <?php if($check2){echo set_select('ym_mother_tongue','Kannada');} elseif($query2->ym_mother_tongue=="Kannada") echo "selected='selected'"; ?> value="Kannada">Kannada</option>
							<option id="Kashmiri" <?php if($check2){echo set_select('ym_mother_tongue','Kashmiri');} elseif($query2->ym_mother_tongue=="Kashmiri") echo "selected='selected'"; ?> value="Kashmiri">Kashmiri</option>
							<option id="Khandesi" <?php if($check2){echo set_select('ym_mother_tongue','Khandesi');} elseif($query2->ym_mother_tongue=="Khandesi") echo "selected='selected'"; ?> value="Khandesi">Khandesi</option>
							<option id="Khasi" <?php if($check2){echo set_select('ym_mother_tongue','Khasi');} elseif($query2->ym_mother_tongue=="Khasi") echo "selected='selected'"; ?> value="Khasi">Khasi</option>
							<option id="Kodava" <?php if($check2){echo set_select('ym_mother_tongue','Kodava');} elseif($query2->ym_mother_tongue=="Kodava") echo "selected='selected'"; ?> value="Kodava">Kodava</option>
							<option id="Kokborok" <?php if($check2){echo set_select('ym_mother_tongue','Kokborok');} elseif($query2->ym_mother_tongue=="Kokborok") echo "selected='selected'"; ?> value="Kokborok">Kokborok</option>
							<option id="Konkani" <?php if($check2){echo set_select('ym_mother_tongue','Konkani');} elseif($query2->ym_mother_tongue=="Konkani") echo "selected='selected'"; ?> value="Konkani">Konkani</option>
							<option id="Korean" <?php if($check2){echo set_select('ym_mother_tongue','Korean');} elseif($query2->ym_mother_tongue=="Korean") echo "selected='selected'"; ?> value="Korean">Korean</option>
							<option id="Koshali" <?php if($check2){echo set_select('ym_mother_tongue','Koshali');} elseif($query2->ym_mother_tongue=="Koshali") echo "selected='selected'"; ?> value="Koshali">Koshali</option>
							<option id="Kumoani" <?php if($check2){echo set_select('ym_mother_tongue','Kumoani');} elseif($query2->ym_mother_tongue=="Kumoani") echo "selected='selected'"; ?> value="Kumoani">Kumoani</option>
							<option id="Kurux" <?php if($check2){echo set_select('ym_mother_tongue','Kurux');} elseif($query2->ym_mother_tongue=="Kurux") echo "selected='selected'"; ?> value="Kurux">Kurux</option>
							<option id="Kutchi" <?php if($check2){echo set_select('ym_mother_tongue','Kutchi');} elseif($query2->ym_mother_tongue=="Kutchi") echo "selected='selected'"; ?> value="Kutchi">Kutchi</option>
							<option id="Ladacki" <?php if($check2){echo set_select('ym_mother_tongue','Ladacki');} elseif($query2->ym_mother_tongue=="Ladacki") echo "selected='selected'"; ?> value="Ladacki">Ladacki</option>
							<option id="Lamani" <?php if($check2){echo set_select('ym_mother_tongue','Lamani');} elseif($query2->ym_mother_tongue=="Lamani") echo "selected='selected'"; ?> value="Lamani">Lamani</option>
							<option id="Latvian" <?php if($check2){echo set_select('ym_mother_tongue','Latvian');} elseif($query2->ym_mother_tongue=="Latvian") echo "selected='selected'"; ?> value="Latvian">Latvian</option>
							<option id="Lepcha" <?php if($check2){echo set_select('ym_mother_tongue','Lepcha');} elseif($query2->ym_mother_tongue=="Lepcha") echo "selected='selected'"; ?> value="Lepcha">Lepcha</option>
							<option id="Lithuanian" <?php if($check2){echo set_select('ym_mother_tongue','Lithuanian');} elseif($query2->ym_mother_tongue=="Lithuanian") echo "selected='selected'"; ?> value="Lithuanian">Lithuanian</option>
							<option id="Magadhi" <?php if($check2){echo set_select('ym_mother_tongue','Magadhi');} elseif($query2->ym_mother_tongue=="Magadhi") echo "selected='selected'"; ?> value="Magadhi">Magadhi</option>
							<option id="Maithili" <?php if($check2){echo set_select('ym_mother_tongue','Maithili');} elseif($query2->ym_mother_tongue=="Maithili") echo "selected='selected'"; ?> value="Maithili">Maithili</option>
							<option id="Malay" <?php if($check2){echo set_select('ym_mother_tongue','Malay');} elseif($query2->ym_mother_tongue=="Malay") echo "selected='selected'"; ?> value="Malay">Malay</option>
							<option id="Malayalam" <?php if($check2){echo set_select('ym_mother_tongue','Malayalam');} elseif($query2->ym_mother_tongue=="Malayalam") echo "selected='selected'"; ?> value="Malayalam">Malayalam</option>
							<option id="Malvi" <?php if($check2){echo set_select('ym_mother_tongue','Malvi');} elseif($query2->ym_mother_tongue=="Malvi") echo "selected='selected'"; ?> value="Malvi">Malvi</option>
							<option id="Manipuri" <?php if($check2){echo set_select('ym_mother_tongue','Manipuri');} elseif($query2->ym_mother_tongue=="Manipuri") echo "selected='selected'"; ?> value="Manipuri">Manipuri</option>
							<option id="Marathi" <?php if($check2){echo set_select('ym_mother_tongue','Marathi');} elseif($query2->ym_mother_tongue=="Marathi") echo "selected='selected'"; ?> value="Marathi">Marathi</option>
							<option id="Marwari" <?php if($check2){echo set_select('ym_mother_tongue','Marwari');} elseif($query2->ym_mother_tongue=="Marwari") echo "selected='selected'"; ?> value="Marwari">Marwari</option>
							<option id="Meithei" <?php if($check2){echo set_select('ym_mother_tongue','Meithei');} elseif($query2->ym_mother_tongue=="Meithei") echo "selected='selected'"; ?> value="Meithei">Meithei</option>
							<option id="Merwari" <?php if($check2){echo set_select('ym_mother_tongue','Merwari');} elseif($query2->ym_mother_tongue=="Merwari") echo "selected='selected'"; ?> value="Merwari">Merwari</option>
							<option id="Miji" <?php if($check2){echo set_select('ym_mother_tongue','Miji');} elseif($query2->ym_mother_tongue=="Miji") echo "selected='selected'"; ?> value="Miji">Miji</option>
							<option id="Mizo" <?php if($check2){echo set_select('ym_mother_tongue','Mizo');} elseif($query2->ym_mother_tongue=="Mizo") echo "selected='selected'"; ?> value="Mizo">Mizo</option>
							<option id="Monpa" <?php if($check2){echo set_select('ym_mother_tongue','Monpa');} elseif($query2->ym_mother_tongue=="Monpa") echo "selected='selected'"; ?> value="Monpa">Monpa</option>
							<option id="Mundari" <?php if($check2){echo set_select('ym_mother_tongue','Mundari');} elseif($query2->ym_mother_tongue=="Mundari") echo "selected='selected'"; ?> value="Mundari">Mundari</option>
							<option id="Nepali" <?php if($check2){echo set_select('ym_mother_tongue','Nepali');} elseif($query2->ym_mother_tongue=="Nepali") echo "selected='selected'"; ?> value="Nepali">Nepali</option>
							<option id="Nicobarese" <?php if($check2){echo set_select('ym_mother_tongue','Nicobarese');} elseif($query2->ym_mother_tongue=="Nicobarese") echo "selected='selected'"; ?> value="Nicobarese">Nicobarese</option>
							<option id="Nimadi" <?php if($check2){echo set_select('ym_mother_tongue','Nimadi');} elseif($query2->ym_mother_tongue=="Nimadi") echo "selected='selected'"; ?> value="Nimadi">Nimadi</option>
							<option id="Norwegian" <?php if($check2){echo set_select('ym_mother_tongue','Norwegian');} elseif($query2->ym_mother_tongue=="Norwegian") echo "selected='selected'"; ?> value="Norwegian">Norwegian</option>
							<option id="Oriya" <?php if($check2){echo set_select('ym_mother_tongue','Oriya');} elseif($query2->ym_mother_tongue=="Oriya") echo "selected='selected'"; ?> value="Oriya">Oriya</option>
							<option id="Other" <?php if($check2){echo set_select('ym_mother_tongue','Other');} elseif($query2->ym_mother_tongue=="Other") echo "selected='selected'"; ?> value="Other">Other</option>
							<option id="Persian" <?php if($check2){echo set_select('ym_mother_tongue','Persian');} elseif($query2->ym_mother_tongue=="Persian") echo "selected='selected'"; ?> value="Persian">Persian</option>
							<option id="Polish" <?php if($check2){echo set_select('ym_mother_tongue','Polish');} elseif($query2->ym_mother_tongue=="Polish") echo "selected='selected'"; ?> value="Polish">Polish</option>
							<option id="Portuguese" <?php if($check2){echo set_select('ym_mother_tongue','Portuguese');} elseif($query2->ym_mother_tongue=="Portuguese") echo "selected='selected'"; ?> value="Portuguese">Portuguese</option>
							<option id="Punjabi" <?php if($check2){echo set_select('ym_mother_tongue','Punjabi');} elseif($query2->ym_mother_tongue=="Punjabi") echo "selected='selected'"; ?> value="Punjabi">Punjabi</option>
							<option id="Rajasthani" <?php if($check2){echo set_select('ym_mother_tongue','Rajasthani');} elseif($query2->ym_mother_tongue=="Rajasthani") echo "selected='selected'"; ?> value="Rajasthani">Rajasthani</option>
							<option id="Romanian"  <?php if($check2){echo set_select('ym_mother_tongue','Romanian');} elseif($query2->ym_mother_tongue=="Romanian") echo "selected='selected'"; ?>value="Romanian">Romanian</option>
							<option id="Russian" <?php if($check2){echo set_select('ym_mother_tongue','Russian');} elseif($query2->ym_mother_tongue=="Russian") echo "selected='selected'"; ?> value="Russian">Russian</option>
							<option id="Sadri" <?php if($check2){echo set_select('ym_mother_tongue','Sadri');} elseif($query2->ym_mother_tongue=="Sadri") echo "selected='selected'"; ?> value="Sadri">Sadri</option>
							<option id="Sankethi" <?php if($check2){echo set_select('ym_mother_tongue','Sankethi');} elseif($query2->ym_mother_tongue=="Sankethi") echo "selected='selected'"; ?> value="Sankethi">Sankethi</option>
							<option id="Sanskrit" <?php if($check2){echo set_select('ym_mother_tongue','Sanskrit');} elseif($query2->ym_mother_tongue=="Sanskrit") echo "selected='selected'"; ?> value="Sanskrit">Sanskrit</option>
							<option id="Santhali" <?php if($check2){echo set_select('ym_mother_tongue','Santhali');} elseif($query2->ym_mother_tongue=="Santhali") echo "selected='selected'"; ?> value="Santhali">Santhali</option>
							<option id="Shekhavati" <?php if($check2){echo set_select('ym_mother_tongue','Shekhavati');} elseif($query2->ym_mother_tongue=="Shekhavati") echo "selected='selected'"; ?> value="Shekhavati">Shekhavati</option>
							<option id="Sindhi" <?php if($check2){echo set_select('ym_mother_tongue','');} elseif($query2->ym_mother_tongue=="Sindhi") echo "selected='selected'"; ?> value="Sindhi">Sindhi</option>
							<option id="Sourashtra" <?php if($check2){echo set_select('ym_mother_tongue','Sourashtra');} elseif($query2->ym_mother_tongue=="Sourashtra") echo "selected='selected'"; ?> value="Sourashtra">Sourashtra</option>
							<option id="Spanish" <?php if($check2){echo set_select('ym_mother_tongue','Spanish');} elseif($query2->ym_mother_tongue=="Spanish") echo "selected='selected'"; ?> value="Spanish">Spanish</option>
							<option id="Swedish" <?php if($check2){echo set_select('ym_mother_tongue','Swedish');} elseif($query2->ym_mother_tongue=="Swedish") echo "selected='selected'"; ?> value="Swedish">Swedish</option>
							<option id="Tagalog" <?php if($check2){echo set_select('ym_mother_tongue','Tagalog');} elseif($query2->ym_mother_tongue=="Tagalog") echo "selected='selected'"; ?> value="Tagalog">Tagalog</option>
							<option id="Tamil" <?php if($check2){echo set_select('ym_mother_tongue','Tamil');} elseif($query2->ym_mother_tongue=="Tamil") echo "selected='selected'"; ?> value="Tamil">Tamil</option>
							<option id="Telugu" <?php if($check2){echo set_select('ym_mother_tongue','Telugu');} elseif($query2->ym_mother_tongue=="Telugu") echo "selected='selected'"; ?> value="Telugu">Telugu</option>
							<option id="Tripuri" <?php if($check2){echo set_select('ym_mother_tongue','Tripuri');} elseif($query2->ym_mother_tongue=="Tripuri") echo "selected='selected'"; ?> value="Tripuri">Tripuri</option>
							<option id="Tulu" <?php if($check2){echo set_select('ym_mother_tongue','Tulu');} elseif($query2->ym_mother_tongue=="Tulu") echo "selected='selected'"; ?> value="Tulu">Tulu</option>
							<option id="Urdu" <?php if($check2){echo set_select('ym_mother_tongue','Urdu');} elseif($query2->ym_mother_tongue=="Urdu") echo "selected='selected'"; ?> value="Urdu">Urdu</option>
							                       
						 </select>
						 <div class="error"><?php echo form_error('ym_mother_tongue'); ?></div>
						 
                    </td>
					
                </tr>
				
                 <tr>
                    <td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Religion/Community <span class="err">*</span></strong></td>
                   <td class="txtBlack13Arial">
                   		<select class="combo" id="ym_community" name="ym_community">
                            <option value="">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM religion ORDER BY Parameter-->
							
							<option id="Atheist" <?php if($check2){echo set_select('ym_community','Atheist');} elseif($query2->ym_community=="Atheist") echo "selected='selected'"; ?> value="Atheist">Atheist</option>
							<option id="Buddhist" <?php if($check2){echo set_select('ym_community','Buddhist');} elseif($query2->ym_community=="Buddhist") echo "selected='selected'"; ?> value="Buddhist">Buddhist</option>
							<option id="Caste No Bar" <?php if($check2){echo set_select('ym_community','Caste No Bar');} elseif($query2->ym_community=="Caste No Bar") echo "selected='selected'"; ?> value="Caste No Bar">Caste No Bar</option>
							<option id="Christian" <?php if($check2){echo set_select('ym_community','Christian');} elseif($query2->ym_community=="Christian") echo "selected='selected'"; ?> value="Christian">Christian</option>
							<option id="Hindu" <?php if($check2){echo set_select('ym_community','Hindu');} elseif($query2->ym_community=="Hindu") echo "selected='selected'"; ?> value="Hindu">Hindu</option>
							<option id="Inter Religion" <?php if($check2){echo set_select('ym_community','Inter Religion');} elseif($query2->ym_community=="Inter Religion") echo "selected='selected'"; ?> value="Inter Religion">Inter Religion</option>
							<option id="Jain" <?php if($check2){echo set_select('ym_community','Jain');} elseif($query2->ym_community=="Jain") echo "selected='selected'"; ?> value="Jain">Jain</option>
							<option id="Jewish" <?php if($check2){echo set_select('ym_community','Jewish');} elseif($query2->ym_community=="Jewish") echo "selected='selected'"; ?> value="Jewish">Jewish</option>
							<option id="Jews" <?php if($check2){echo set_select('ym_community','Jews');} elseif($query2->ym_community=="Jews") echo "selected='selected'"; ?> value="Jews">Jews</option>
							<option id="Muslim" <?php if($check2){echo set_select('ym_community','Muslim');} elseif($query2->ym_community=="Muslim") echo "selected='selected'"; ?> value="Muslim">Muslim</option>
							<option id="No Religion" <?php if($check2){echo set_select('ym_community','No Religion');} elseif($query2->ym_community=="No Religion") echo "selected='selected'"; ?> value="No Religion">No Religion</option>
							<option id="Other" <?php if($check2){echo set_select('ym_community','Other');} elseif($query2->ym_community=="Other") echo "selected='selected'"; ?> value="Other">Other</option>
							<option id="Parsi" <?php if($check2){echo set_select('ym_community','Parsi');} elseif($query2->ym_community=="Parsi") echo "selected='selected'"; ?> value="Parsi">Parsi</option>
							<option id="Sikh" <?php if($check2){echo set_select('ym_community','Sikh');} elseif($query2->ym_community=="Sikh") echo "selected='selected'"; ?> value="Sikh">Sikh</option>
							    
					    </select>
						<div class="error"><?php echo form_error('ym_community'); ?></div>
						
                   </td>
				   
                </tr>
				
                <tr>
                    <td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Caste/Sect <span class="err">*</span></strong></td>
                    <td class="txtBlack13Arial">
                    	<select  class="combo" id="ym_caste" name="ym_caste">
                            <option value="">Select</option>
							
                            <!--SELECT CastName,CasteID FROM caste ORDER BY CastName-->
							
							<option id="Ad Dharmi" <?php if($check2){echo set_select('ym_caste','Ad Dharmi');} elseif($query2->ym_caste=="Ad Dharmi") echo "selected='selected'"; ?> value="Ad Dharmi">Ad Dharmi</option>
							<option id="Adi Dravida" <?php if($check2){echo set_select('ym_caste','Adi Dravida');} elseif($query2->ym_caste=="Adi Dravida") echo "selected='selected'"; ?> value="Adi Dravida">Adi Dravida</option>
							<option id="Aggarwal" <?php if($check2){echo set_select('ym_caste','Aggarwal');} elseif($query2->ym_caste=="Aggarwal") echo "selected='selected'"; ?> value="Aggarwal">Aggarwal</option>
							<option id="Agnikula Kshatriya" <?php if($check2){echo set_select('ym_caste','Agnikula Kshatriya');} elseif($query2->ym_caste=="Agnikula Kshatriya") echo "selected='selected'"; ?> value="Agnikula Kshatriya">Agnikula Kshatriya</option>
							<option id="Agri" <?php if($check2){echo set_select('ym_caste','Agri');} elseif($query2->ym_caste=="Agri") echo "selected='selected'"; ?> value="Agri">Agri</option>
							<option id="Ahom" <?php if($check2){echo set_select('ym_caste','Ahom');} elseif($query2->ym_caste=="Ahom") echo "selected='selected'"; ?> value="Ahom">Ahom</option>
							<option id="Ambalavasi" <?php if($check2){echo set_select('ym_caste','Ambalavasi');} elseif($query2->ym_caste=="Ambalavasi") echo "selected='selected'"; ?> value="Ambalavasi">Ambalavasi</option>
							<option id="Anglicans" <?php if($check2){echo set_select('ym_caste','Anglicans');} elseif($query2->ym_caste=="Anglicans") echo "selected='selected'"; ?> value="Anglicans">Anglicans</option>
							<option id="Ansari" <?php if($check2){echo set_select('ym_caste','Ansari');} elseif($query2->ym_caste=="Ansari") echo "selected='selected'"; ?> value="Ansari">Ansari</option>
							<option id="Arain" <?php if($check2){echo set_select('ym_caste','Arain');} elseif($query2->ym_caste=="Arain") echo "selected='selected'"; ?> value="Arain">Arain</option>
							<option id="Arunthathiyar" <?php if($check2){echo set_select('ym_caste','Arunthathiyar');} elseif($query2->ym_caste=="Arunthathiyar") echo "selected='selected'"; ?> value="Arunthathiyar">Arunthathiyar</option>
							<option id="Arya Vysya" <?php if($check2){echo set_select('ym_caste','Arya Vysya');} elseif($query2->ym_caste=="Arya Vysya") echo "selected='selected'"; ?> value="Arya Vysya">Arya Vysya</option>
							<option id="Aryasamaj" <?php if($check2){echo set_select('ym_caste','Aryasamaj');} elseif($query2->ym_caste=="Aryasamaj") echo "selected='selected'"; ?> value="Aryasamaj">Aryasamaj</option>
							<option id="Awan" <?php if($check2){echo set_select('ym_caste','Awan');} elseif($query2->ym_caste=="Awan") echo "selected='selected'"; ?> value="Awan">Awan</option>
							<option id="Baghel/Pal/Gaderiya" <?php if($check2){echo set_select('ym_caste','Baghel/Pal/Gaderiya');} elseif($query2->ym_caste=="Baghel/Pal/Gaderiya") echo "selected='selected'"; ?> value="Baghel/Pal/Gaderiya">Baghel/Pal/Gaderiya</option>
							<option id="Bahi" <?php if($check2){echo set_select('ym_caste','Bahi');} elseif($query2->ym_caste=="Bahi") echo "selected='selected'"; ?> value="Bahi">Bahi</option>
							<option id="Baidya" <?php if($check2){echo set_select('ym_caste','Baidya');} elseif($query2->ym_caste=="Baidya") echo "selected='selected'"; ?> value="Baidya">Baidya</option>
							<option id="Baishnab" <?php if($check2){echo set_select('ym_caste','Baishnab');} elseif($query2->ym_caste=="Baishnab") echo "selected='selected'"; ?> value="Baishnab">Baishnab</option>
							<option id="Baishya" <?php if($check2){echo set_select('ym_caste','Baishya');} elseif($query2->ym_caste=="Baishya") echo "selected='selected'"; ?> value="Baishya">Baishya</option>
							<option id="Balija" <?php if($check2){echo set_select('ym_caste','Balija');} elseif($query2->ym_caste=="Balija") echo "selected='selected'"; ?> value="Balija">Balija</option>
							<option id="Balija Naidu" <?php if($check2){echo set_select('ym_caste','Balija Naidu');} elseif($query2->ym_caste=="Balija Naidu") echo "selected='selected'"; ?> value="Balija Naidu">Balija Naidu</option>
							<option id="Bania" <?php if($check2){echo set_select('ym_caste','Bania');} elseif($query2->ym_caste=="Bania") echo "selected='selected'"; ?> value="Bania">Bania</option>
							<option id="Banik" <?php if($check2){echo set_select('ym_caste','Banik');} elseif($query2->ym_caste=="Banik") echo "selected='selected'"; ?> value="Banik">Banik</option>
							<option id="Bari" <?php if($check2){echo set_select('ym_caste','Bari');} elseif($query2->ym_caste=="Bari") echo "selected='selected'"; ?> value="Bari">Bari</option> 
							<option id="Barujibi" <?php if($check2){echo set_select('ym_caste','Barujibi');} elseif($query2->ym_caste=="Barujibi") echo "selected='selected'"; ?> value="Barujibi">Barujibi</option>
							<option id="Bengali" <?php if($check2){echo set_select('ym_caste','Bengali');} elseif($query2->ym_caste=="Bengali") echo "selected='selected'"; ?> value="Bengali">Bengali</option>
							<option id="Besta" <?php if($check2){echo set_select('ym_caste','Besta');} elseif($query2->ym_caste=="Besta") echo "selected='selected'"; ?> value="Besta">Besta</option>
							<option id="Bhandari" <?php if($check2){echo set_select('ym_caste','Bhandari');} elseif($query2->ym_caste=="Bhandari") echo "selected='selected'"; ?> value="Bhandari">Bhandari</option>
							<option id="Bhatia" <?php if($check2){echo set_select('ym_caste','Bhatia');} elseif($query2->ym_caste=="Bhatia") echo "selected='selected'"; ?> value="Bhatia">Bhatia</option>
							<option id="Bhavasar Kshatriya" <?php if($check2){echo set_select('ym_caste','Bhavasar Kshatriya');} elseif($query2->ym_caste=="Bhavasar Kshatriya") echo "selected='selected'"; ?> value="Bhavasar Kshatriya">Bhavasar Kshatriya</option>
							<option id="Bhavsar" <?php if($check2){echo set_select('ym_caste','Bhavsar');} elseif($query2->ym_caste=="Bhavsar") echo "selected='selected'"; ?> value="Bhavsar">Bhavsar</option>
							<option id="Bhovi" <?php if($check2){echo set_select('ym_caste','Bhovi');} elseif($query2->ym_caste=="Bhovi") echo "selected='selected'"; ?> value="Bhovi">Bhovi</option>
							<option id="Billava" <?php if($check2){echo set_select('ym_caste','Billava');} elseif($query2->ym_caste=="Billava") echo "selected='selected'"; ?> value="Billava">Billava</option>
							<option id="Bohra" <?php if($check2){echo set_select('ym_caste','Bohra');} elseif($query2->ym_caste=="Bohra") echo "selected='selected'"; ?> value="Bohra">Bohra</option>
							<option id="Born Again" <?php if($check2){echo set_select('ym_caste','Born Again');} elseif($query2->ym_caste=="Born Again") echo "selected='selected'"; ?> value="Born Again">Born Again</option>
							<option id="Boyer" <?php if($check2){echo set_select('ym_caste','Boyer');} elseif($query2->ym_caste=="Boyer") echo "selected='selected'"; ?> value="Boyer">Boyer</option>
							<option id="Brahmbatt" <?php if($check2){echo set_select('ym_caste','Brahmbatt');} elseif($query2->ym_caste=="Brahmbatt") echo "selected='selected'"; ?> value="Brahmbatt">Brahmbatt</option>
							<option id="Brahmin" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Brahmin") echo "selected='selected'"; ?> value="Brahmin">Brahmin</option>
							<option id="Brahmin 6000 Niyogi" <?php if($check2){echo set_select('ym_caste','Brahmin 6000 Niyogi');} elseif($query2->ym_caste=="Brahmin 6000 Niyogi") echo "selected='selected'"; ?> value="Brahmin 6000 Niyogi">Brahmin 6000 Niyogi</option>
							<option id="Brahmin 96K Kokanastha" <?php if($check2){echo set_select('ym_caste','Brahmin 96K Kokanastha');} elseif($query2->ym_caste=="Brahmin 96K Kokanastha") echo "selected='selected'"; ?> value="Brahmin 96K Kokanastha">Brahmin 96K Kokanastha</option>
							<option id="Brahmin Anavil" <?php if($check2){echo set_select('ym_caste','Brahmin Anavil');} elseif($query2->ym_caste=="Brahmin Anavil") echo "selected='selected'"; ?> value="Brahmin Anavil">Brahmin Anavil</option>
							<option id="Brahmin Audichya" <?php if($check2){echo set_select('ym_caste','Brahmin Audichya');} elseif($query2->ym_caste=="Brahmin Audichya") echo "selected='selected'"; ?> value="Brahmin Audichya">Brahmin Audichya</option>
							<option id="Brahmin Barendra" <?php if($check2){echo set_select('ym_caste','Brahmin Barendra');} elseif($query2->ym_caste=="Brahmin Barendra") echo "selected='selected'"; ?> value="Brahmin Barendra">Brahmin Barendra</option>
							<option id="Brahmin Bengali" <?php if($check2){echo set_select('ym_caste','Brahmin Bengali');} elseif($query2->ym_caste=="Brahmin Bengali") echo "selected='selected'"; ?> value="Brahmin Bengali">Brahmin Bengali</option>
							<option id="Brahmin Bhatt" <?php if($check2){echo set_select('ym_caste','Brahmin Bhatt');} elseif($query2->ym_caste=="Brahmin Bhatt") echo "selected='selected'"; ?> value="Brahmin Bhatt">Brahmin Bhatt</option>
							<option id="Brahmin Bhumihar" <?php if($check2){echo set_select('ym_caste','Brahmin Bhumihar');} elseif($query2->ym_caste=="Brahmin Bhumihar") echo "selected='selected'"; ?> value="Brahmin Bhumihar">Brahmin Bhumihar</option>
							<option id="Brahmin Daivadnya" <?php if($check2){echo set_select('ym_caste','Brahmin Daivadnya');} elseif($query2->ym_caste=="Brahmin Daivadnya") echo "selected='selected'"; ?> value="Brahmin Daivadnya">Brahmin Daivadnya</option>
							<option id="Brahmin Danua" <?php if($check2){echo set_select('ym_caste','Brahmin Danua');} elseif($query2->ym_caste=="Brahmin Danua") echo "selected='selected'"; ?> value="Brahmin Danua">Brahmin Danua</option>
							<option id="Brahmin Deshastha" <?php if($check2){echo set_select('ym_caste','Brahmin Deshastha');} elseif($query2->ym_caste=="Brahmin Deshastha") echo "selected='selected'"; ?> value="Brahmin Deshastha">Brahmin Deshastha</option>
							<option id="Brahmin Dhiman" <?php if($check2){echo set_select('ym_caste','Brahmin Dhiman');} elseif($query2->ym_caste=="Brahmin Dhiman") echo "selected='selected'"; ?> value="Brahmin Dhiman">Brahmin Dhiman</option>
							<option id="Brahmin Divajna" <?php if($check2){echo set_select('ym_caste','Brahmin Divajna');} elseif($query2->ym_caste=="Brahmin Divajna") echo "selected='selected'"; ?> value="Brahmin Divajna">Brahmin Divajna</option>
							<option id="Brahmin Dravida" <?php if($check2){echo set_select('ym_caste','Brahmin Dravida');} elseif($query2->ym_caste=="Brahmin Dravida") echo "selected='selected'"; ?> value="Brahmin Dravida">Brahmin Dravida</option>
							<option id="Brahmin Garhwali" <?php if($check2){echo set_select('ym_caste','Brahmin Garhwali');} elseif($query2->ym_caste=="Brahmin Garhwali") echo "selected='selected'"; ?> value="Brahmin Garhwali">Brahmin Garhwali</option>
							<option id="Brahmin Gaud Saraswat (GSB)" <?php if($check2){echo set_select('ym_caste','Brahmin Gaud Saraswat (GSB)');} elseif($query2->ym_caste=="Brahmin Gaud Saraswat (GSB)") echo "selected='selected'"; ?> value="Brahmin Gaud Saraswat (GSB)">Brahmin Gaud Saraswat (GSB)</option>
							<option id="Brahmin Gaur" <?php if($check2){echo set_select('ym_caste','Brahmin Gaur');} elseif($query2->ym_caste=="Brahmin Gaur") echo "selected='selected'"; ?> value="Brahmin Gaur">Brahmin Gaur</option>
							<option id="Brahmin Goswami" <?php if($check2){echo set_select('ym_caste','Brahmin Goswami');} elseif($query2->ym_caste=="Brahmin Goswami") echo "selected='selected'"; ?> value="Brahmin Goswami">Brahmin Goswami</option>
							<option id="Brahmin Gurukkal" <?php if($check2){echo set_select('ym_caste','Brahmin Gurukkal');} elseif($query2->ym_caste=="Brahmin Gurukkal") echo "selected='selected'"; ?>  value="Brahmin Gurukkal">Brahmin Gurukkal</option>
							<option id="Brahmin Halua" <?php if($check2){echo set_select('ym_caste','Brahmin Halua');} elseif($query2->ym_caste=="Brahmin Halua") echo "selected='selected'"; ?> value="Brahmin Halua">Brahmin Halua</option>
							<option id="Brahmin Havyaka" <?php if($check2){echo set_select('ym_caste','Brahmin Havyaka');} elseif($query2->ym_caste=="Brahmin Havyaka") echo "selected='selected'"; ?> value="Brahmin Havyaka">Brahmin Havyaka</option>
							<option id="Brahmin Hoysala" <?php if($check2){echo set_select('ym_caste','Brahmin Hoysala');} elseif($query2->ym_caste=="Brahmin Hoysala") echo "selected='selected'"; ?> value="Brahmin Hoysala">Brahmin Hoysala</option>
							<option id="Brahmin Iyengar" <?php if($check2){echo set_select('ym_caste','Brahmin Iyengar');} elseif($query2->ym_caste=="Brahmin Iyengar") echo "selected='selected'"; ?> value="Brahmin Iyengar">Brahmin Iyengar</option>
							<option id="Brahmin Iyer" <?php if($check2){echo set_select('ym_caste','Brahmin Iyer');} elseif($query2->ym_caste=="Brahmin Iyer") echo "selected='selected'"; ?> value="Brahmin Iyer">Brahmin Iyer</option>
							<option id="Brahmin Jhadua" <?php if($check2){echo set_select('ym_caste','Brahmin Jhadua');} elseif($query2->ym_caste=="Brahmin Jhadua") echo "selected='selected'"; ?> value="Brahmin Jhadua">Brahmin Jhadua</option>
							<option id="Brahmin Kanada Madhva" <?php if($check2){echo set_select('ym_caste','"Brahmin Kanada Madhva');} elseif($query2->ym_caste=="Brahmin Kanada Madhva") echo "selected='selected'"; ?> value="Brahmin Kanada Madhva">Brahmin Kanada Madhva</option>
							<option id="Brahmin Kanyakubj" <?php if($check2){echo set_select('ym_caste','Brahmin Kanyakubj');} elseif($query2->ym_caste=="Brahmin Kanyakubj") echo "selected='selected'"; ?> value="Brahmin Kanyakubj">Brahmin Kanyakubj</option>
							<option id="Brahmin Karhade" <?php if($check2){echo set_select('ym_caste','Brahmin Karhade');} elseif($query2->ym_caste=="Brahmin Karhade") echo "selected='selected'"; ?> value="Brahmin Karhade">Brahmin Karhade</option>
							<option id="Brahmin Kashmiri Pandit" <?php if($check2){echo set_select('ym_caste','Brahmin Kashmiri Pandit');} elseif($query2->ym_caste=="Brahmin Kashmiri Pandit") echo "selected='selected'"; ?> value="Brahmin Kashmiri Pandit">Brahmin Kashmiri Pandit</option>
							<option id="Brahmin Koknastha" <?php if($check2){echo set_select('ym_caste','Brahmin Koknastha');} elseif($query2->ym_caste=="Brahmin Koknastha") echo "selected='selected'"; ?> value="Brahmin Koknastha">Brahmin Koknastha</option>
							<option id="Brahmin Kota" <?php if($check2){echo set_select('ym_caste','Brahmin Kota');} elseif($query2->ym_caste=="Brahmin Kota") echo "selected='selected'"; ?> value="Brahmin Kota">Brahmin Kota</option>
							<option id="Brahmin Kulin" <?php if($check2){echo set_select('ym_caste','Brahmin Kulin');} elseif($query2->ym_caste=="Brahmin Kulin") echo "selected='selected'"; ?> value="Brahmin Kulin">Brahmin Kulin</option>
							<option id="Brahmin Kumaoni" <?php if($check2){echo set_select('ym_caste','Brahmin Kumaoni');} elseif($query2->ym_caste=="Brahmin Kumaoni") echo "selected='selected'"; ?> value="Brahmin Kumaoni">Brahmin Kumaoni</option>
							<option id="Brahmin Madhwa" <?php if($check2){echo set_select('ym_caste','Brahmin Madhwa');} elseif($query2->ym_caste=="Brahmin Madhwa") echo "selected='selected'"; ?> value="Brahmin Madhwa">Brahmin Madhwa</option>
							<option id="Brahmin Maharashtrian" <?php if($check2){echo set_select('ym_caste','Brahmin Maharashtrian');} elseif($query2->ym_caste=="Brahmin Maharashtrian") echo "selected='selected'"; ?> value="Brahmin Maharashtrian">Brahmin Maharashtrian</option>
							<option id="Brahmin Maithil" <?php if($check2){echo set_select('ym_caste','Brahmin Maithil');} elseif($query2->ym_caste=="Brahmin Maithil") echo "selected='selected'"; ?> value="Brahmin Maithil">Brahmin Maithil</option>
							<option id="Brahmin Modh" <?php if($check2){echo set_select('ym_caste','Brahmin Modh');} elseif($query2->ym_caste=="Brahmin Modh") echo "selected='selected'"; ?> value="Brahmin Modh">Brahmin Modh</option>
							<option id="Brahmin Mohyal" <?php if($check2){echo set_select('ym_caste','Brahmin Mohyal');} elseif($query2->ym_caste=="Brahmin Mohyal") echo "selected='selected'"; ?> value="Brahmin Mohyal">Brahmin Mohyal</option>
							<option id="Brahmin Nagar" <?php if($check2){echo set_select('ym_caste','Brahmin Nagar');} elseif($query2->ym_caste=="Brahmin Nagar") echo "selected='selected'"; ?> value="Brahmin Nagar">Brahmin Nagar</option>
							<option id="Brahmin Namboodiri" <?php if($check2){echo set_select('ym_caste','Brahmin Namboodiri');} elseif($query2->ym_caste=="Brahmin Namboodiri") echo "selected='selected'"; ?> value="Brahmin Namboodiri">Brahmin Namboodiri</option>
							<option id="Brahmin Narmadiya" <?php if($check2){echo set_select('ym_caste','Brahmin Narmadiya');} elseif($query2->ym_caste=="Brahmin Narmadiya") echo "selected='selected'"; ?> value="Brahmin Narmadiya">Brahmin Narmadiya</option>
							<option id="Brahmin Niyogi" <?php if($check2){echo set_select('ym_caste','Brahmin Niyogi');} elseif($query2->ym_caste=="Brahmin Niyogi") echo "selected='selected'"; ?> value="Brahmin Niyogi">Brahmin Niyogi</option>
							<option id="Brahmin Niyogi Nandavariki" <?php if($check2){echo set_select('ym_caste','Brahmin Niyogi Nandavariki');} elseif($query2->ym_caste=="Brahmin Niyogi Nandavariki") echo "selected='selected'"; ?> value="Brahmin Niyogi Nandavariki">Brahmin Niyogi Nandavariki</option>
							<option id="Brahmin Panda" <?php if($check2){echo set_select('ym_caste','Brahmin Panda');} elseif($query2->ym_caste=="Brahmin Panda") echo "selected='selected'"; ?> value="Brahmin Panda">Brahmin Panda</option>
							<option id="Brahmin Pandit" <?php if($check2){echo set_select('ym_caste','Brahmin Pandit');} elseif($query2->ym_caste=="Brahmin Pandit") echo "selected='selected'"; ?> value="Brahmin Pandit">Brahmin Pandit</option>
							<option id="Brahmin Punjabi" <?php if($check2){echo set_select('ym_caste','Brahmin Punjabi');} elseif($query2->ym_caste=="Brahmin Punjabi") echo "selected='selected'"; ?> value="Brahmin Punjabi">Brahmin Punjabi</option>
							<option id="Brahmin Pushkarna" <?php if($check2){echo set_select('ym_caste','Brahmin Pushkarna');} elseif($query2->ym_caste=="Brahmin Pushkarna") echo "selected='selected'"; ?> value="Brahmin Pushkarna">Brahmin Pushkarna</option>
							<option id="Brahmin Rarhi" <?php if($check2){echo set_select('ym_caste','Brahmin Rarhi');} elseif($query2->ym_caste=="Brahmin Rarhi") echo "selected='selected'"; ?> value="Brahmin Rarhi">Brahmin Rarhi</option>
							<option id="Brahmin Rigvedi" <?php if($check2){echo set_select('ym_caste','Brahmin Rigvedi');} elseif($query2->ym_caste=="Brahmin Rigvedi") echo "selected='selected'"; ?> value="Brahmin Rigvedi">Brahmin Rigvedi</option>
							<option id="Brahmin Rudraj" <?php if($check2){echo set_select('ym_caste','Brahmin Rudraj');} elseif($query2->ym_caste=="Brahmin Rudraj") echo "selected='selected'"; ?> value="Brahmin Rudraj">Brahmin Rudraj</option>
							<option id="Brahmin Sakaldwipi" <?php if($check2){echo set_select('ym_caste','Brahmin Sakaldwipi');} elseif($query2->ym_caste=="Brahmin Sakaldwipi") echo "selected='selected'"; ?> value="Brahmin Sakaldwipi">Brahmin Sakaldwipi</option>
							<option id="Brahmin Sanadya" <?php if($check2){echo set_select('ym_caste','Brahmin Sanadya');} elseif($query2->ym_caste=="Brahmin Sanadya") echo "selected='selected'"; ?> value="Brahmin Sanadya">Brahmin Sanadya</option>
							<option id="Brahmin Sanketi" <?php if($check2){echo set_select('ym_caste','Brahmin Sanketi');} elseif($query2->ym_caste=="Brahmin Sanketi") echo "selected='selected'"; ?> value="Brahmin Sanketi">Brahmin Sanketi</option>
							<option id="Brahmin Saraswat" <?php if($check2){echo set_select('ym_caste','Brahmin Saraswat');} elseif($query2->ym_caste=="Brahmin Saraswat") echo "selected='selected'"; ?> value="Brahmin Saraswat">Brahmin Saraswat</option>
							<option id="Brahmin Saryuparin" <?php if($check2){echo set_select('ym_caste','Brahmin Saryuparin');} elseif($query2->ym_caste=="Brahmin Saryuparin") echo "selected='selected'"; ?> value="Brahmin Saryuparin">Brahmin Saryuparin</option>
							<option id="Brahmin Shivhalli" <?php if($check2){echo set_select('ym_caste','Brahmin Shivhalli');} elseif($query2->ym_caste=="Brahmin Shivhalli") echo "selected='selected'"; ?> value="Brahmin Shivhalli">Brahmin Shivhalli</option>
							<option id="Brahmin Shrimali" <?php if($check2){echo set_select('ym_caste','Brahmin Shrimali');} elseif($query2->ym_caste=="Brahmin Shrimali") echo "selected='selected'"; ?> value="Brahmin Shrimali">Brahmin Shrimali</option>
							<option id="Brahmin Smartha" <?php if($check2){echo set_select('ym_caste','Brahmin Smartha');} elseif($query2->ym_caste=="Brahmin Smartha") echo "selected='selected'"; ?> value="Brahmin Smartha">Brahmin Smartha</option>
							<option id="Brahmin Sri Vishnava" <?php if($check2){echo set_select('ym_caste','Brahmin Sri Vishnava');} elseif($query2->ym_caste=="Brahmin Sri Vishnava") echo "selected='selected'"; ?> value="Brahmin Sri Vishnava">Brahmin Sri Vishnava</option>
							<option id="Brahmin Stanika" <?php if($check2){echo set_select('ym_caste','Brahmin Stanika');} elseif($query2->ym_caste=="Brahmin Stanika") echo "selected='selected'"; ?> value="Brahmin Stanika">Brahmin Stanika</option>
							<option id="Brahmin Telugu" <?php if($check2){echo set_select('ym_caste','Brahmin Telugu');} elseif($query2->ym_caste=="Brahmin Telugu") echo "selected='selected'"; ?> value="Brahmin Telugu">Brahmin Telugu</option>
							<option id="Brahmin Tyagi" <?php if($check2){echo set_select('ym_caste','Brahmin Tyagi');} elseif($query2->ym_caste=="Brahmin Tyagi") echo "selected='selected'"; ?> value="Brahmin Tyagi">Brahmin Tyagi</option>
							<option id="Brahmin Vaidiki" <?php if($check2){echo set_select('ym_caste','Brahmin Vaidiki');} elseif($query2->ym_caste=="Brahmin Vaidiki") echo "selected='selected'"; ?> value="Brahmin Vaidiki">Brahmin Vaidiki</option>
							<option id="Brahmin Viswa" <?php if($check2){echo set_select('ym_caste','Brahmin Viswa');} elseif($query2->ym_caste=="Brahmin Viswa") echo "selected='selected'"; ?> value="Brahmin Viswa">Brahmin Viswa</option>
							<option id="Brahmin Vyas" <?php if($check2){echo set_select('ym_caste','Brahmin Vyas');} elseif($query2->ym_caste=="Brahmin Vyas") echo "selected='selected'"; ?> value="Brahmin Vyas">Brahmin Vyas</option>
							<option id="Bretheren" <?php if($check2){echo set_select('ym_caste','Bretheren');} elseif($query2->ym_caste=="Bretheren") echo "selected='selected'"; ?> value="Bretheren">Bretheren</option>
							<option id="Buddhists" <?php if($check2){echo set_select('ym_caste','Buddhists');} elseif($query2->ym_caste=="Buddhists") echo "selected='selected'"; ?> value="Buddhists">Buddhists</option>
							<option id="Bunt" <?php if($check2){echo set_select('ym_caste','Bunt');} elseif($query2->ym_caste=="Bunt") echo "selected='selected'"; ?> value="Bunt">Bunt</option>
							<option id="Caste No Bar" <?php if($check2){echo set_select('ym_caste','Caste No Bar');} elseif($query2->ym_caste=="Caste No Bar") echo "selected='selected'"; ?> value="Caste No Bar">Caste No Bar</option>
							<option id="Catholic" <?php if($check2){echo set_select('ym_caste','Catholic');} elseif($query2->ym_caste=="Catholic") echo "selected='selected'"; ?> value="Catholic">Catholic</option>
							<option id="Chaddo" <?php if($check2){echo set_select('ym_caste','Chaddo');} elseif($query2->ym_caste=="Chaddo") echo "selected='selected'"; ?> value="Chaddo">Chaddo</option>
							<option id="Chamar" <?php if($check2){echo set_select('ym_caste','Chamar');} elseif($query2->ym_caste=="Chamar") echo "selected='selected'"; ?> value="Chamar">Chamar</option>
							<option id="Chambhar" <?php if($check2){echo set_select('ym_caste','Chambhar');} elseif($query2->ym_caste=="Chambhar") echo "selected='selected'"; ?> value="Chambhar">Chambhar</option>
							<option id="Chandravanshi Kahar" <?php if($check2){echo set_select('ym_caste','Chandravanshi Kahar');} elseif($query2->ym_caste=="Chandravanshi Kahar") echo "selected='selected'"; ?> value="Chandravanshi Kahar">Chandravanshi Kahar</option>
							<option id="Chasa" <?php if($check2){echo set_select('ym_caste','Chasa');} elseif($query2->ym_caste=="Chasa") echo "selected='selected'"; ?> value="Chasa">Chasa</option>
							<option id="Chaudary" <?php if($check2){echo set_select('ym_caste','Chaudary');} elseif($query2->ym_caste=="Chaudary") echo "selected='selected'"; ?> value="Chaudary">Chaudary</option>
							<option id="Chaurasia" <?php if($check2){echo set_select('ym_caste','Chaurasia');} elseif($query2->ym_caste=="Chaurasia") echo "selected='selected'"; ?> value="Chaurasia">Chaurasia</option>
							<option id="Chettiar" <?php if($check2){echo set_select('ym_caste','Chettiar');} elseif($query2->ym_caste=="Chettiar") echo "selected='selected'"; ?> value="Chettiar">Chettiar</option>
							<option id="Chhetri" <?php if($check2){echo set_select('ym_caste','Chhetri');} elseif($query2->ym_caste=="Chhetri") echo "selected='selected'"; ?> value="Chhetri">Chhetri</option>
							<option id="Church of South India (CSI)" <?php if($check2){echo set_select('ym_caste','Church of South India (CSI)');} elseif($query2->ym_caste=="Church of South India (CSI)") echo "selected='selected'"; ?> value="Church of South India (CSI)">Church of South India (CSI)</option>
							<option id="CKP" <?php if($check2){echo set_select('ym_caste','CKP');} elseif($query2->ym_caste=="CKP") echo "selected='selected'"; ?> value="CKP">CKP</option>
							<option id="CMS" <?php if($check2){echo set_select('ym_caste','CMS');} elseif($query2->ym_caste=="CMS") echo "selected='selected'"; ?> value="CMS">CMS</option>
							<option id="Coorgi" <?php if($check2){echo set_select('ym_caste','Coorgi');} elseif($query2->ym_caste=="Coorgi") echo "selected='selected'"; ?> value="Coorgi">Coorgi</option>
							<option id="Dawoodi bohra" <?php if($check2){echo set_select('ym_caste','Dawoodi bohra');} elseif($query2->ym_caste=="Dawoodi bohra") echo "selected='selected'"; ?> value="Dawoodi bohra">Dawoodi bohra</option>
							<option id="Dekkani" <?php if($check2){echo set_select('ym_caste','Dekkani');} elseif($query2->ym_caste=="Dekkani") echo "selected='selected'"; ?> value="Dekkani">Dekkani</option>
							<option id="Devadigas" <?php if($check2){echo set_select('ym_caste','Devadigas');} elseif($query2->ym_caste=="Devadigas") echo "selected='selected'"; ?> value="Devadigas">Devadigas</option>
							<option id="Devandra Kula Vellalar" <?php if($check2){echo set_select('ym_caste','Devandra Kula Vellalar');} elseif($query2->ym_caste=="Devandra Kula Vellalar") echo "selected='selected'"; ?> value="Devandra Kula Vellalar">Devandra Kula Vellalar</option>
							<option id="Devang Koshthi" <?php if($check2){echo set_select('ym_caste','Devang Koshthi');} elseif($query2->ym_caste=="Devang Koshthi") echo "selected='selected'"; ?> value="Devang Koshthi">Devang Koshthi</option>
							<option id="Devanga" <?php if($check2){echo set_select('ym_caste','Devanga');} elseif($query2->ym_caste=="Devanga") echo "selected='selected'"; ?> value="Devanga">Devanga</option>
							<option id="Dhaneshawat Vaish" <?php if($check2){echo set_select('ym_caste','Dhaneshawat Vaish');} elseif($query2->ym_caste=="Dhaneshawat Vaish") echo "selected='selected'"; ?> value="Dhaneshawat Vaish">Dhaneshawat Vaish</option>
							<option id="Dhangar" <?php if($check2){echo set_select('ym_caste','Dhangar');} elseif($query2->ym_caste=="Dhangar") echo "selected='selected'"; ?> value="Dhangar">Dhangar</option>
							<option id="Dheevara" <?php if($check2){echo set_select('ym_caste','Dheevara');} elseif($query2->ym_caste=="Dheevara") echo "selected='selected'"; ?> value="Dheevara">Dheevara</option>
							<option id="Dhiman" <?php if($check2){echo set_select('ym_caste','Dhiman');} elseif($query2->ym_caste=="Dhiman") echo "selected='selected'"; ?> value="Dhiman">Dhiman</option>
							<option id="Dhoba" <?php if($check2){echo set_select('ym_caste','Dhoba');} elseif($query2->ym_caste=="Dhoba") echo "selected='selected'"; ?> value="Dhoba">Dhoba</option>
							<option id="Dhobi" <?php if($check2){echo set_select('ym_caste','Dhobi');} elseif($query2->ym_caste=="Dhobi") echo "selected='selected'"; ?> value="Dhobi">Dhobi</option>
							<option id="Digamber" <?php if($check2){echo set_select('ym_caste','Digamber');} elseif($query2->ym_caste=="Digamber") echo "selected='selected'"; ?> value="Digamber">Digamber</option>
							<option id="Dudekula" <?php if($check2){echo set_select('ym_caste','Dudekula');} elseif($query2->ym_caste=="Dudekula") echo "selected='selected'"; ?> value="Dudekula">Dudekula</option>
							<option id="Edigas" <?php if($check2){echo set_select('ym_caste','Edigas');} elseif($query2->ym_caste=="Edigas") echo "selected='selected'"; ?> value="Edigas">Edigas</option>
							<option id="Ehle-Hadith" <?php if($check2){echo set_select('ym_caste','Ehle-Hadith');} elseif($query2->ym_caste=="Ehle-Hadith") echo "selected='selected'"; ?> value="Ehle-Hadith">Ehle-Hadith</option>
							<option id="Evangelist" <?php if($check2){echo set_select('ym_caste','Evangelist');} elseif($query2->ym_caste=="Evangelist") echo "selected='selected'"; ?> value="Evangelist">Evangelist</option>
							<option id="Ezhava" <?php if($check2){echo set_select('ym_caste','Ezhava');} elseif($query2->ym_caste=="Ezhava") echo "selected='selected'"; ?> value="Ezhava">Ezhava</option>
							<option id="Ezhuthachan" <?php if($check2){echo set_select('ym_caste','Ezhuthachan');} elseif($query2->ym_caste=="Ezhuthachan") echo "selected='selected'"; ?> value="Ezhuthachan">Ezhuthachan</option>
							<option id="Gabit" <?php if($check2){echo set_select('ym_caste','Gabit');} elseif($query2->ym_caste=="Gabit") echo "selected='selected'"; ?> value="Gabit">Gabit</option>
							<option id="Gandla" <?php if($check2){echo set_select('ym_caste','Gandla');} elseif($query2->ym_caste=="Gandla") echo "selected='selected'"; ?> value="Gandla">Gandla</option>
							<option id="Ganiga" <?php if($check2){echo set_select('ym_caste','Ganiga');} elseif($query2->ym_caste=="Ganiga") echo "selected='selected'"; ?> value="Ganiga">Ganiga</option>
							<option id="Ganigashetty" <?php if($check2){echo set_select('ym_caste','Ganigashetty');} elseif($query2->ym_caste=="Ganigashetty") echo "selected='selected'"; ?> value="Ganigashetty">Ganigashetty</option>
							<option id="Garhwali" <?php if($check2){echo set_select('ym_caste','Garhwali');} elseif($query2->ym_caste=="Garhwali") echo "selected='selected'"; ?> value="Garhwali">Garhwali</option>
							<option id="Gavara" <?php if($check2){echo set_select('ym_caste','Gavara');} elseif($query2->ym_caste=="Gavara") echo "selected='selected'"; ?> value="Gavara"></option>
							<option id="Gavdi" <?php if($check2){echo set_select('ym_caste','Gavdi');} elseif($query2->ym_caste=="Gavdi") echo "selected='selected'"; ?> value="Gavdi">Gavdi</option>
							<option id="Ghumar" <?php if($check2){echo set_select('ym_caste','Ghumar');} elseif($query2->ym_caste=="Ghumar") echo "selected='selected'"; ?> value="Ghumar">Ghumar</option>
							<option id="Goala" <?php if($check2){echo set_select('ym_caste','Goala');} elseif($query2->ym_caste=="Goala") echo "selected='selected'"; ?> value="Goala">Goala</option>
							<option id="Goan" <?php if($check2){echo set_select('ym_caste','Goan');} elseif($query2->ym_caste=="Goan") echo "selected='selected'"; ?> value="Goan">Goan</option>
							<option id="Gomantak Maratha" <?php if($check2){echo set_select('ym_caste','Gomantak Maratha');} elseif($query2->ym_caste=="Gomantak Maratha") echo "selected='selected'"; ?> value="Gomantak Maratha">Gomantak Maratha</option>
							<option id="Goswami" <?php if($check2){echo set_select('ym_caste','Goswami');} elseif($query2->ym_caste=="Goswami") echo "selected='selected'"; ?> value="Goswami">Goswami</option>
							<option id="Goud" <?php if($check2){echo set_select('ym_caste','Goud');} elseif($query2->ym_caste=="Goud") echo "selected='selected'"; ?> value="Goud">Goud</option>
							<option id="Gounder" <?php if($check2){echo set_select('ym_caste','Gounder');} elseif($query2->ym_caste=="Gounder") echo "selected='selected'"; ?> value="Gounder">Gounder</option>
							<option id="Gowda" <?php if($check2){echo set_select('ym_caste','Gowda');} elseif($query2->ym_caste=="Gowda") echo "selected='selected'"; ?> value="Gowda">Gowda</option>
							<option id="Gudia" <?php if($check2){echo set_select('ym_caste','Gudia');} elseif($query2->ym_caste=="Gudia") echo "selected='selected'"; ?> value="Gudia">Gudia</option>
							<option id="Gujjar" <?php if($check2){echo set_select('ym_caste','Gujjar');} elseif($query2->ym_caste=="Gujjar") echo "selected='selected'"; ?> value="Gujjar">Gujjar</option>
							<option id="Gupta" <?php if($check2){echo set_select('ym_caste','Gupta');} elseif($query2->ym_caste=="Gupta") echo "selected='selected'"; ?> value="Gupta">Gupta</option>
							<option id="Hanafi" <?php if($check2){echo set_select('ym_caste','Hanafi');} elseif($query2->ym_caste=="Hanafi") echo "selected='selected'"; ?> value="Hanafi">Hanafi</option>
							<option id="Hegde" <?php if($check2){echo set_select('ym_caste','Hegde');} elseif($query2->ym_caste=="Hegde") echo "selected='selected'"; ?> value="Hegde">Hegde</option>
							<option id="Hindu: Arora" <?php if($check2){echo set_select('ym_caste','Hindu: Arora');} elseif($query2->ym_caste=="Hindu: Arora") echo "selected='selected'"; ?> value="Hindu: Arora">Hindu: Arora</option>
							<option id="Hulsavar" <?php if($check2){echo set_select('ym_caste','Hulsavar');} elseif($query2->ym_caste=="Hulsavar") echo "selected='selected'"; ?> value="Hulsavar">Hulsavar</option>
							<option id="Indian Orthodox" <?php if($check2){echo set_select('ym_caste','Indian Orthodox');} elseif($query2->ym_caste=="Indian Orthodox") echo "selected='selected'"; ?> value="Indian Orthodox">Indian Orthodox</option>
							<option id="Intercaste" <?php if($check2){echo set_select('ym_caste','Intercaste');} elseif($query2->ym_caste=="Intercaste") echo "selected='selected'"; ?> value="">Intercaste</option>
							<option id="Irani" <?php if($check2){echo set_select('ym_caste','Irani');} elseif($query2->ym_caste=="Irani") echo "selected='selected'"; ?> value="Irani">Irani</option>
							<option id="Iyengar" <?php if($check2){echo set_select('ym_caste','Iyengar');} elseif($query2->ym_caste=="Iyengar") echo "selected='selected'"; ?> value="Iyengar">Iyengar</option>
							<option id="Iyer" <?php if($check2){echo set_select('ym_caste','Iyer');} elseif($query2->ym_caste=="Iyer") echo "selected='selected'"; ?> value="Iyer">Iyer</option>
							<option id="Jacobite" <?php if($check2){echo set_select('ym_caste','Jacobite');} elseif($query2->ym_caste=="Jacobite") echo "selected='selected'"; ?> value="Jacobite">Jacobite</option>
							<option id="Jain Agarwal" <?php if($check2){echo set_select('ym_caste','Jain Agarwal');} elseif($query2->ym_caste=="Jain Agarwal") echo "selected='selected'"; ?> value="Jain Agarwal">Jain Agarwal</option>
							<option id="Jain Bania" <?php if($check2){echo set_select('ym_caste','Jain Bania');} elseif($query2->ym_caste=="Jain Bania") echo "selected='selected'"; ?> value="Jain Bania">Jain Bania</option>
							<option id="Jain Intercaste" <?php if($check2){echo set_select('ym_caste','Jain Intercaste');} elseif($query2->ym_caste=="Jain Intercaste") echo "selected='selected'"; ?> value="Jain Intercaste">Jain Intercaste</option>
							<option id="Jain Jaiswal" <?php if($check2){echo set_select('ym_caste','Jain Jaiswal');} elseif($query2->ym_caste=="Jain Jaiswal") echo "selected='selected'"; ?> value="Jain Jaiswal">Jain Jaiswal</option>
							<option id="Jain Khandelwal" <?php if($check2){echo set_select('ym_caste','Jain Khandelwal');} elseif($query2->ym_caste=="Jain Khandelwal") echo "selected='selected'"; ?> value="Jain Khandelwal">Jain Khandelwal</option>
							<option id="Jain Kutchi" <?php if($check2){echo set_select('ym_caste','Jain Kutchi');} elseif($query2->ym_caste=="Jain Kutchi") echo "selected='selected'"; ?> value="Jain Kutchi">Jain Kutchi</option>
							<option id="Jain No Bar" <?php if($check2){echo set_select('ym_caste','Jain No Bar');} elseif($query2->ym_caste=="Jain No Bar") echo "selected='selected'"; ?> value="Jain No Bar">Jain No Bar</option>
							<option id="Jain Oswal" <?php if($check2){echo set_select('ym_caste','Jain Oswal');} elseif($query2->ym_caste=="Jain Oswal") echo "selected='selected'"; ?> value="Jain Oswal">Jain Oswal</option>
							<option id="Jain Others" <?php if($check2){echo set_select('ym_caste','Jain Others');} elseif($query2->ym_caste=="Jain Others") echo "selected='selected'"; ?> value="Jain Others">Jain Others</option>
							<option id="Jain Porwal" <?php if($check2){echo set_select('ym_caste','Jain Porwal');} elseif($query2->ym_caste=="Jain Porwal") echo "selected='selected'"; ?> value="Jain Porwal">Jain Porwal</option>
							<option id="Jain Unspecified" <?php if($check2){echo set_select('ym_caste','Jain Unspecified');} elseif($query2->ym_caste=="Jain Unspecified") echo "selected='selected'"; ?> value="Jain Unspecified">Jain Unspecified</option>
							<option id="Jain Vaishya" <?php if($check2){echo set_select('ym_caste','Jain Vaishya');} elseif($query2->ym_caste=="Jain Vaishya") echo "selected='selected'"; ?> value="Jain Vaishya">Jain Vaishya</option>
							<option id="Jain Vania" <?php if($check2){echo set_select('ym_caste','Jain ');} elseif($query2->ym_caste=="Jain Vania") echo "selected='selected'"; ?> value="Jain Vania">Jain Vania</option>
							<option id="Jaiswal" <?php if($check2){echo set_select('ym_caste','Jaiswal');} elseif($query2->ym_caste=="Jaiswal") echo "selected='selected'"; ?> value="Jaiswal">Jaiswal</option>
							<option id="Jangam" <?php if($check2){echo set_select('ym_caste','Jangam');} elseif($query2->ym_caste=="Jangam") echo "selected='selected'"; ?> value="Jangam">Jangam</option>
							<option id="Jat" <?php if($check2){echo set_select('ym_caste','Jat');} elseif($query2->ym_caste=="Jat") echo "selected='selected'"; ?> value="Jat">Jat</option>
							<option id="Jatav" <?php if($check2){echo set_select('ym_caste','Jatav');} elseif($query2->ym_caste=="Jatav") echo "selected='selected'"; ?> value="Jatav">Jatav</option>
							<option id="Jews Dawoodi Bohra" <?php if($check2){echo set_select('ym_caste','Jews Dawoodi Bohra');} elseif($query2->ym_caste=="Jews Dawoodi Bohra") echo "selected='selected'"; ?> value="Jews Dawoodi Bohra">Jews Dawoodi Bohra</option>
							<option id="Jews Intercaste" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Jews Intercaste") echo "selected='selected'"; ?> value="Jews Intercaste">Jews Intercaste</option>
							<option id="Jews No Bar" <?php if($check2){echo set_select('ym_caste','Jews No Bar"');} elseif($query2->ym_caste=="Jews No Bar") echo "selected='selected'"; ?> value="Jews No Bar">Jews No Bar</option>
							<option id="Jews Unspecified" <?php if($check2){echo set_select('ym_caste','Jews Unspecified');} elseif($query2->ym_caste=="Jews Unspecified") echo "selected='selected'"; ?> value="Jews Unspecified">Jews Unspecified</option>
							<option id="Kadava Patel" <?php if($check2){echo set_select('ym_caste','Kadava Patel');} elseif($query2->ym_caste=="Kadava Patel") echo "selected='selected'"; ?> value="Kadava Patel">Kadava Patel</option>
							<option id="Kaibarta" <?php if($check2){echo set_select('ym_caste','Kaibarta');} elseif($query2->ym_caste=="Kaibarta") echo "selected='selected'"; ?> value="Kaibarta">Kaibarta</option>
							<option id="Kalar" <?php if($check2){echo set_select('ym_caste','Kalar');} elseif($query2->ym_caste=="Kalar") echo "selected='selected'"; ?> value="Kalar">Kalar</option>
							<option id="Kalavanthi" <?php if($check2){echo set_select('ym_caste','Kalavanthi');} elseif($query2->ym_caste=="Kalavanthi") echo "selected='selected'"; ?> value="Kalavanthi">Kalavanthi</option>
							<option id="Kalinga" <?php if($check2){echo set_select('ym_caste','Kalinga');} elseif($query2->ym_caste=="Kalinga") echo "selected='selected'"; ?> value="Kalinga">Kalinga</option>
							<option id="Kalinga Vysya" <?php if($check2){echo set_select('ym_caste','Kalinga Vysya');} elseif($query2->ym_caste=="Kalinga Vysya") echo "selected='selected'"; ?> value="Kalinga Vysya">Kalinga Vysya</option>
							<option id="Kalita" <?php if($check2){echo set_select('ym_caste','Kalita');} elseif($query2->ym_caste=="Kalita") echo "selected='selected'"; ?> value="Kalita">Kalita</option>
							<option id="Kalwar" <?php if($check2){echo set_select('ym_caste','Kalwar');} elseif($query2->ym_caste=="Kalwar") echo "selected='selected'"; ?> value="Kalwar">Kalwar</option>
							<option id="Kamboj" <?php if($check2){echo set_select('ym_caste','Kamboj');} elseif($query2->ym_caste=="Kamboj") echo "selected='selected'"; ?> value="Kamboj">Kamboj</option>
							<option id="Kamma" <?php if($check2){echo set_select('ym_caste','Kamma');} elseif($query2->ym_caste=="Kamma") echo "selected='selected'"; ?> value="Kamma">Kamma</option>
							<option id="Kannada Mogaveera" <?php if($check2){echo set_select('ym_caste','Kannada Mogaveera');} elseif($query2->ym_caste=="Kannada Mogaveera") echo "selected='selected'"; ?> value="Kannada Mogaveera">Kannada Mogaveera</option>
							<option id="Kansari" <?php if($check2){echo set_select('ym_caste','Kansari');} elseif($query2->ym_caste=="Kansari") echo "selected='selected'"; ?> value="Kansari">Kansari</option>
							<option id="Kapu" <?php if($check2){echo set_select('ym_caste','Kapu');} elseif($query2->ym_caste=="Kapu") echo "selected='selected'"; ?> value="Kapu">Kapu</option>
							<option id="Kapu Mannuru" <?php if($check2){echo set_select('ym_caste','Kapu Mannuru');} elseif($query2->ym_caste=="Kapu Mannuru") echo "selected='selected'"; ?> value="Kapu Mannuru">Kapu Mannuru</option>
							<option id="Kapu Naidu" <?php if($check2){echo set_select('ym_caste','Kapu Naidu');} elseif($query2->ym_caste=="Kapu Naidu") echo "selected='selected'"; ?> value="Kapu Naidu">Kapu Naidu</option>
							<option id="Karana" <?php if($check2){echo set_select('ym_caste','Karana');} elseif($query2->ym_caste=="Karana") echo "selected='selected'"; ?> value="Karana">Karana</option>
							<option id="Karmakar" <?php if($check2){echo set_select('ym_caste','Karmakar');} elseif($query2->ym_caste=="Karmakar") echo "selected='selected'"; ?> value="Karmakar">Karmakar</option>
							<option id="Karuneegar" <?php if($check2){echo set_select('ym_caste','Karuneegar');} elseif($query2->ym_caste=="Karuneegar") echo "selected='selected'"; ?> value="Karuneegar">Karuneegar</option>
							<option id="Kasar" <?php if($check2){echo set_select('ym_caste','Kasar');} elseif($query2->ym_caste=="Kasar") echo "selected='selected'"; ?> value="Kasar">Kasar</option>
							<option id="Kashyap" <?php if($check2){echo set_select('ym_caste','Kashyap');} elseif($query2->ym_caste=="Kashyap") echo "selected='selected'"; ?> value="Kashyap">Kashyap</option>
							<option id="Kayastha" <?php if($check2){echo set_select('ym_caste','Kayastha');} elseif($query2->ym_caste=="Kayastha") echo "selected='selected'"; ?> value="Kayastha">Kayastha</option>
							<option id="Khandayat" <?php if($check2){echo set_select('ym_caste','Khandayat');} elseif($query2->ym_caste=="Khandayat") echo "selected='selected'"; ?> value="Khandayat">Khandayat</option>
							<option id="Khandelwal" <?php if($check2){echo set_select('ym_caste','Khandelwal');} elseif($query2->ym_caste=="Khandelwal") echo "selected='selected'"; ?> value="Khandelwal">Khandelwal</option>
							<option id="Kharve" <?php if($check2){echo set_select('ym_caste','Kharve');} elseif($query2->ym_caste=="Kharve") echo "selected='selected'"; ?> value="Kharve">Kharve</option>
							<option id="Khatik" <?php if($check2){echo set_select('ym_caste','Khatik');} elseif($query2->ym_caste=="Khatik") echo "selected='selected'"; ?> value="Khatik">Khatik</option>
							<option id="Khatri" <?php if($check2){echo set_select('ym_caste','Khatri');} elseif($query2->ym_caste=="Khatri") echo "selected='selected'"; ?> value="Khatri">Khatri</option>
							<option id="Khoja" <?php if($check2){echo set_select('ym_caste','Khoja');} elseif($query2->ym_caste=="Khoja") echo "selected='selected'"; ?> value="Khoja">Khoja</option>
							<option id="Knanaya" <?php if($check2){echo set_select('ym_caste','Knanaya');} elseif($query2->ym_caste=="Knanaya") echo "selected='selected'"; ?> value="Knanaya">Knanaya</option>
							<option id="Knanaya Catholic" <?php if($check2){echo set_select('ym_caste','Knanaya Catholic');} elseif($query2->ym_caste=="Knanaya Catholic") echo "selected='selected'"; ?> value="Knanaya Catholic">Knanaya Catholic</option>
							<option id="Knanaya Jacobite" <?php if($check2){echo set_select('ym_caste','Knanaya Jacobite');} elseif($query2->ym_caste=="Knanaya Jacobite") echo "selected='selected'"; ?> value="Knanaya Jacobite">Knanaya Jacobite</option>
							<option id="Koli" <?php if($check2){echo set_select('ym_caste','Koli');} elseif($query2->ym_caste=="Koli") echo "selected='selected'"; ?> value="Koli">Koli</option>
							<option id="Kongu Vellala Gounder" <?php if($check2){echo set_select('ym_caste','Kongu Vellala Gounder');} elseif($query2->ym_caste=="Kongu Vellala Gounder") echo "selected='selected'"; ?> value="Kongu Vellala Gounder">Kongu Vellala Gounder</option>
							<option id="Konkani" <?php if($check2){echo set_select('ym_caste','Konkani');} elseif($query2->ym_caste=="Konkani") echo "selected='selected'"; ?> value="Konkani">Konkani</option>
							<option id="Kori" <?php if($check2){echo set_select('ym_caste','Kori');} elseif($query2->ym_caste=="Kori") echo "selected='selected'"; ?> value="Kori">Kori</option>
							<option id="Koshti" <?php if($check2){echo set_select('ym_caste','Koshti');} elseif($query2->ym_caste=="Koshti") echo "selected='selected'"; ?> value="Koshti">Koshti</option>
							<option id="Kshatriya" <?php if($check2){echo set_select('ym_caste','Kshatriya');} elseif($query2->ym_caste=="Kshatriya") echo "selected='selected'"; ?> value="Kshatriya">Kshatriya</option>
							<option id="Kudumbi" <?php if($check2){echo set_select('ym_caste','Kudumbi');} elseif($query2->ym_caste=="Kudumbi") echo "selected='selected'"; ?> value="Kudumbi">Kudumbi</option>
							<option id="Kulal" <?php if($check2){echo set_select('ym_caste','Kulal');} elseif($query2->ym_caste=="Kulal") echo "selected='selected'"; ?> value="Kulal">Kulal</option>
							<option id="Kulalar" <?php if($check2){echo set_select('ym_caste','Kulalar');} elseif($query2->ym_caste=="Kulalar") echo "selected='selected'"; ?> value="Kulalar">Kulalar</option>
							<option id="Kulita" <?php if($check2){echo set_select('ym_caste','Kulita');} elseif($query2->ym_caste=="Kulita") echo "selected='selected'"; ?> value="Kulita">Kulita</option>
							<option id="Kumawat" <?php if($check2){echo set_select('ym_caste','Kumawat');} elseif($query2->ym_caste=="Kumawat") echo "selected='selected'"; ?> value="Kumawat">Kumawat</option>
							<option id="Kumbhakar" <?php if($check2){echo set_select('ym_caste','Kumbhakar');} elseif($query2->ym_caste=="Kumbhakar") echo "selected='selected'"; ?> value="Kumbhakar">Kumbhakar</option>
							<option id="Kumbhar" <?php if($check2){echo set_select('ym_caste','Kumbhar');} elseif($query2->ym_caste=="Kumbhar") echo "selected='selected'"; ?> value="Kumbhar">Kumbhar</option>
							<option id="Kumhar" <?php if($check2){echo set_select('ym_caste','Kumhar');} elseif($query2->ym_caste=="Kumhar") echo "selected='selected'"; ?> value="Kumhar">Kumhar</option>
							<option id="Kummari" <?php if($check2){echo set_select('ym_caste','Kummari');} elseif($query2->ym_caste=="Kummari") echo "selected='selected'"; ?> value="Kummari">Kummari</option>
							<option id="Kunbi" <?php if($check2){echo set_select('ym_caste','Kunbi');} elseif($query2->ym_caste=="Kunbi") echo "selected='selected'"; ?> value="Kunbi">Kunbi</option>
							<option id="Kurmi" <?php if($check2){echo set_select('ym_caste','Kurmi');} elseif($query2->ym_caste=="Kurmi") echo "selected='selected'"; ?> value="Kurmi">Kurmi</option>
							<option id="Kurmi Kshatriya" <?php if($check2){echo set_select('ym_caste','Kurmi Kshatriya');} elseif($query2->ym_caste=="Kurmi Kshatriya") echo "selected='selected'"; ?> value="Kurmi Kshatriya">Kurmi Kshatriya</option>
							<option id="Kuruba" <?php if($check2){echo set_select('ym_caste','Kuruba');} elseif($query2->ym_caste=="Kuruba") echo "selected='selected'"; ?> value="Kuruba">Kuruba</option>
							<option id="Kuruhina Shetty" <?php if($check2){echo set_select('ym_caste','Kuruhina Shetty');} elseif($query2->ym_caste=="Kuruhina Shetty") echo "selected='selected'"; ?> value="Kuruhina Shetty">Kuruhina Shetty</option>
							<option id="Kurumbar" <?php if($check2){echo set_select('ym_caste','Kurumbar');} elseif($query2->ym_caste=="Kurumbar") echo "selected='selected'"; ?>  value="Kurumbar">Kurumbar</option>
							<option id="Kushwaha" <?php if($check2){echo set_select('ym_caste','Kushwaha');} elseif($query2->ym_caste=="Kushwaha") echo "selected='selected'"; ?> value="Kushwaha">Kushwaha</option>
							<option id="Kutchi" <?php if($check2){echo set_select('ym_caste','Kutchi');} elseif($query2->ym_caste=="Kutchi") echo "selected='selected'"; ?> value="Kutchi">Kutchi</option>
							<option id="Lambadi" <?php if($check2){echo set_select('ym_caste','Lambadi');} elseif($query2->ym_caste=="Lambadi") echo "selected='selected'"; ?> value="Lambadi">Lambadi</option>
							<option id="Latin Catholic" <?php if($check2){echo set_select('ym_caste','Latin Catholic');} elseif($query2->ym_caste=="Latin Catholic") echo "selected='selected'"; ?> value="Latin Catholic">Latin Catholic</option>
							<option id="Lebbai" <?php if($check2){echo set_select('ym_caste','Lebbai');} elseif($query2->ym_caste=="Lebbai") echo "selected='selected'"; ?> value="Lebbai">Lebbai</option>
							<option id="Leva patel" <?php if($check2){echo set_select('ym_caste','Leva patel');} elseif($query2->ym_caste=="Leva patel") echo "selected='selected'"; ?> value="Leva patel">Leva patel</option>
							<option id="Leva Patidar" <?php if($check2){echo set_select('ym_caste','Leva Patidar');} elseif($query2->ym_caste=="Leva Patidar") echo "selected='selected'"; ?> value="Leva Patidar">Leva Patidar</option>
							<option id="Leva patil" <?php if($check2){echo set_select('ym_caste','Leva patil');} elseif($query2->ym_caste=="Leva patil") echo "selected='selected'"; ?> value="Leva patil">Leva patil</option>
							<option id="Lingayat" <?php if($check2){echo set_select('ym_caste','Lingayat');} elseif($query2->ym_caste=="Lingayat") echo "selected='selected'"; ?> value="Lingayat">Lingayat</option>
							<option id="Lohana" <?php if($check2){echo set_select('ym_caste','Lohana');} elseif($query2->ym_caste=="Lohana") echo "selected='selected'"; ?> value="Lohana">Lohana</option>
							<option id="Lubana" <?php if($check2){echo set_select('ym_caste','Lubana');} elseif($query2->ym_caste=="Lubana") echo "selected='selected'"; ?> value="Lubana">Lubana</option>
							<option id="Madiga" <?php if($check2){echo set_select('ym_caste','Madiga');} elseif($query2->ym_caste=="Madiga") echo "selected='selected'"; ?> value="Madiga">Madiga</option>
							<option id="Madival" <?php if($check2){echo set_select('ym_caste','Madival');} elseif($query2->ym_caste=="Madival") echo "selected='selected'"; ?> value="Madival">Madival</option>
							<option id="Mahajan" <?php if($check2){echo set_select('ym_caste','Mahajan');} elseif($query2->ym_caste=="Mahajan") echo "selected='selected'"; ?> value="Mahajan">Mahajan</option>
							<option id="Mahar" <?php if($check2){echo set_select('ym_caste','Mahar');} elseif($query2->ym_caste=="Mahar") echo "selected='selected'"; ?> value="Mahar">Mahar</option>
							<option id="Mahendra" <?php if($check2){echo set_select('ym_caste','Mahendra');} elseif($query2->ym_caste=="Mahendra") echo "selected='selected'"; ?> value="Mahendra">Mahendra</option>
							<option id="Maheshwari" <?php if($check2){echo set_select('ym_caste','Maheshwari');} elseif($query2->ym_caste=="Maheshwari") echo "selected='selected'"; ?> value="Maheshwari">Maheshwari</option>
							<option id="Mahishya" <?php if($check2){echo set_select('ym_caste','Mahishya');} elseif($query2->ym_caste=="Mahishya") echo "selected='selected'"; ?> value="Mahishya">Mahishya</option>
							<option id="Majabi" <?php if($check2){echo set_select('ym_caste','Majabi');} elseif($query2->ym_caste=="Majabi") echo "selected='selected'"; ?>  value="Majabi">Majabi</option>
							<option id="Mala" <?php if($check2){echo set_select('ym_caste','Mala');} elseif($query2->ym_caste=="Mala") echo "selected='selected'"; ?> value="Mala">Mala</option>
							<option id="Malankara" <?php if($check2){echo set_select('ym_caste','Malankara');} elseif($query2->ym_caste=="Malankara") echo "selected='selected'"; ?> value="Malankara">Malankara</option>
							<option id="Malayalee Namboodiri" <?php if($check2){echo set_select('ym_caste','Malayalee Namboodiri');} elseif($query2->ym_caste=="Malayalee Namboodiri") echo "selected='selected'"; ?> value="Malayalee Namboodiri">Malayalee Namboodiri</option>
							<option id="Malayalee Variar" <?php if($check2){echo set_select('ym_caste','Malayalee Variar');} elseif($query2->ym_caste=="Malayalee Variar") echo "selected='selected'"; ?> value="Malayalee Variar">Malayalee Variar</option>
							<option id="Mali" <?php if($check2){echo set_select('ym_caste','Mali');} elseif($query2->ym_caste=="Mali") echo "selected='selected'"; ?> value="Mali">Mali</option>
							<option id="Malik" <?php if($check2){echo set_select('ym_caste','Malik');} elseif($query2->ym_caste=="Malik") echo "selected='selected'"; ?> value="Malik">Malik</option>
							<option id="Malla" <?php if($check2){echo set_select('ym_caste','Malla');} elseif($query2->ym_caste=="Malla") echo "selected='selected'"; ?> value="Malla">Malla</option>
							<option id="Mangalorean" <?php if($check2){echo set_select('ym_caste','Mangalorean');} elseif($query2->ym_caste=="Mangalorean") echo "selected='selected'"; ?> value="Mangalorean">Mangalorean</option>
							<option id="Mangalorean" <?php if($check2){echo set_select('ym_caste','Mangalorean');} elseif($query2->ym_caste=="Mangalorean") echo "selected='selected'"; ?> value="Mangalorean">Mangalorean</option>
							<option id="Manipuri" <?php if($check2){echo set_select('ym_caste','Manipuri');} elseif($query2->ym_caste=="Manipuri") echo "selected='selected'"; ?> value="Manipuri">Manipuri</option>
							<option id="Mapila" <?php if($check2){echo set_select('ym_caste','Mapila');} elseif($query2->ym_caste=="Mapila") echo "selected='selected'"; ?> value="Mapila">Mapila</option>
							<option id="Maraicar" <?php if($check2){echo set_select('ym_caste','Maraicar');} elseif($query2->ym_caste=="Maraicar") echo "selected='selected'"; ?> value="Maraicar">Maraicar</option>
							<option id="Maratha" <?php if($check2){echo set_select('ym_caste','Maratha');} elseif($query2->ym_caste=="Maratha") echo "selected='selected'"; ?> value="Maratha">Maratha</option>
							<option id="Marthoma" <?php if($check2){echo set_select('ym_caste','Marthoma');} elseif($query2->ym_caste=="Marthoma") echo "selected='selected'"; ?> value="Marthoma">Marthoma</option>
							<option id="Maruthuvar" <?php if($check2){echo set_select('ym_caste','Maruthuvar');} elseif($query2->ym_caste=="Maruthuvar") echo "selected='selected'"; ?> value="Maruthuvar">Maruthuvar</option>
							<option id="Marvar" <?php if($check2){echo set_select('ym_caste','Marvar');} elseif($query2->ym_caste=="Marvar") echo "selected='selected'"; ?> value="Marvar">Marvar</option>
							<option id="Marwari" <?php if($check2){echo set_select('ym_caste','Marwari');} elseif($query2->ym_caste=="Marwari") echo "selected='selected'"; ?> value="Marwari">Marwari</option>
							<option id="Matang" <?php if($check2){echo set_select('ym_caste','Matang');} elseif($query2->ym_caste=="Matang") echo "selected='selected'"; ?> value="Matang">Matang</option>
							<option id="Maurya" <?php if($check2){echo set_select('ym_caste','Maurya');} elseif($query2->ym_caste=="Maurya") echo "selected='selected'"; ?> value="Maurya">Maurya</option>
							<option id="Meena" <?php if($check2){echo set_select('ym_caste','Meena');} elseif($query2->ym_caste=="Meena") echo "selected='selected'"; ?> value="Meena">Meena</option>
							<option id="Meenavar" <?php if($check2){echo set_select('ym_caste','Meenavar');} elseif($query2->ym_caste=="Meenavar") echo "selected='selected'"; ?> value="Meenavar">Meenavar</option>
							<option id="Mehra" <?php if($check2){echo set_select('ym_caste','Mehra');} elseif($query2->ym_caste=="Mehra") echo "selected='selected'"; ?> value="Mehra">Mehra</option>
							<option id="Memon" <?php if($check2){echo set_select('ym_caste','Memon');} elseif($query2->ym_caste=="Memon") echo "selected='selected'"; ?> value="Memon">Memon</option>
							<option id="Menon" <?php if($check2){echo set_select('ym_caste','Menon');} elseif($query2->ym_caste=="Menon") echo "selected='selected'"; ?> value="Menon">Menon</option>
							<option id="Meru" <?php if($check2){echo set_select('ym_caste','Meru');} elseif($query2->ym_caste=="Meru") echo "selected='selected'"; ?> value="Meru">Meru</option>
							<option id="Meru Darji" <?php if($check2){echo set_select('ym_caste','Meru Darji');} elseif($query2->ym_caste=="Meru Darji") echo "selected='selected'"; ?> value="Meru Darji">Meru Darji</option>
							<option id="Mochi" <?php if($check2){echo set_select('ym_caste','Mochi');} elseif($query2->ym_caste=="Mochi") echo "selected='selected'"; ?> value="Mochi">Mochi</option>
							<option id="Modak" <?php if($check2){echo set_select('ym_caste','Modak');} elseif($query2->ym_caste=="Modak") echo "selected='selected'"; ?> value="Modak">Modak</option>
							<option id="Mogaveera" <?php if($check2){echo set_select('ym_caste','Mogaveera');} elseif($query2->ym_caste=="Mogaveera") echo "selected='selected'"; ?> value="Mogaveera">Mogaveera</option>
							<option id="Monchi" <?php if($check2){echo set_select('ym_caste','Monchi');} elseif($query2->ym_caste=="Monchi") echo "selected='selected'"; ?> value="Monchi">Monchi</option>
							<option id="Moopanar" <?php if($check2){echo set_select('ym_caste','Moopanar');echo set_select('ym_caste','');} elseif($query2->ym_caste=="Moopanar") echo "selected='selected'"; ?> value="Moopanar">Moopanar</option>
							<option id="Mudaliar Arcot" <?php if($check2){echo set_select('ym_caste','Mudaliar Arcot');} elseif($query2->ym_caste=="Mudaliar Arcot") echo "selected='selected'"; ?> value="Mudaliar Arcot">Mudaliar Arcot</option>
							<option id="Mudaliar Saiva" <?php if($check2){echo set_select('ym_caste','Mudaliar Saiva');} elseif($query2->ym_caste=="Mudaliar Saiva") echo "selected='selected'"; ?> value="Mudaliar Saiva">Mudaliar Saiva</option>
							<option id="Mudaliar Senguntha" <?php if($check2){echo set_select('ym_caste','Mudaliar Senguntha');} elseif($query2->ym_caste=="Mudaliar Senguntha") echo "selected='selected'"; ?> value="Mudaliar Senguntha">Mudaliar Senguntha</option>
							<option id="Mudaliyar" <?php if($check2){echo set_select('ym_caste','Mudaliyar');} elseif($query2->ym_caste=="Mudaliyar") echo "selected='selected'"; ?> value="Mudaliyar">Mudaliyar</option>
							<option id="Mudiraj" <?php if($check2){echo set_select('ym_caste','Mudiraj');} elseif($query2->ym_caste=="Mudiraj") echo "selected='selected'"; ?> value="Mudiraj">Mudiraj</option>
							<option id="Mughal" <?php if($check2){echo set_select('ym_caste','Mughal');} elseif($query2->ym_caste=="Mughal") echo "selected='selected'"; ?> value="Mughal">Mughal</option>
							<option id="Mukkulathor" <?php if($check2){echo set_select('ym_caste','Mukkulathor');} elseif($query2->ym_caste=="Mukkulathor") echo "selected='selected'"; ?> value="Mukkulathor">Mukkulathor</option>
							<option id="Muthuraja" <?php if($check2){echo set_select('ym_caste','Muthuraja');} elseif($query2->ym_caste=="Muthuraja") echo "selected='selected'"; ?> value="Muthuraja">Muthuraja</option>
							<option id="Nadar" <?php if($check2){echo set_select('ym_caste','Nadar');} elseif($query2->ym_caste=="Nadar") {echo 'selected="selected"';}?> value="Nadar">Nadar</option>
							<option id="Nai" <?php if($check2){echo set_select('ym_caste','Nai');} elseif($query2->ym_caste=="Nai") {echo 'selected="selected"';}?> value="Nai">Nai</option>
							<option id="Naicker" <?php if($check2){echo set_select('ym_caste','Naicker');} elseif($query2->ym_caste=="Naicker") {echo 'selected="selected"';}?> value="Naicker">Naicker</option>
							<option id="Naidu" <?php if($check2){echo set_select('ym_caste','Naidu');} elseif($query2->ym_caste=="Naidu") {echo 'selected="selected"';}?> value="Naidu">Naidu</option>
							<option id="Naik" <?php if($check2){echo set_select('ym_caste','Naik');} elseif($query2->ym_caste=="Naik") {echo 'selected="selected"';}?> value="Naik">Naik</option>
							<option id="Nair" <?php if($check2){echo set_select('ym_caste','Nair');} elseif($query2->ym_caste=="Nair") {echo 'selected="selected"';}?> value="Nair">Nair</option>
							<option id="Nair Vaniya" <?php if($check2){echo set_select('ym_caste','Nair Vaniya');} elseif($query2->ym_caste=="Nair Vaniya") {echo 'selected="selected"';}?> value="Nair Vaniya">Nair Vaniya</option>
							<option id="Nair Veluthedathu" <?php if($check2){echo set_select('ym_caste','Nair Veluthedathu');} elseif($query2->ym_caste=="Nair Veluthedathu") {echo 'selected="selected"';}?> value="Nair Veluthedathu">Nair Veluthedathu</option>
							<option id="Nair Vilakkithala" <?php if($check2){echo set_select('ym_caste','Nair Vilakkithala');} elseif($query2->ym_caste=="Nair Vilakkithala") {echo 'selected="selected"';}?> value="Nair Vilakkithala">Nair Vilakkithala</option>
							<option id="Nambiar" <?php if($check2){echo set_select('ym_caste','Nambiar');} elseif($query2->ym_caste=="Nambiar") {echo 'selected="selected"';}?> value="Nambiar">Nambiar</option>
							<option id="Namboodiri" <?php if($check2){echo set_select('ym_caste','Namboodiri');} elseif($query2->ym_caste=="Namboodiri") {echo 'selected="selected"';}?> value="Namboodiri">Namboodiri</option>
							<option id="Namosudra" <?php if($check2){echo set_select('ym_caste','Namosudra');} elseif($query2->ym_caste=="Namosudra") {echo 'selected="selected"';}?> value="Namosudra">Namosudra</option>
							<option id="Napit" <?php if($check2){echo set_select('ym_caste','Napit');} elseif($query2->ym_caste=="Napit") {echo 'selected="selected"';}?> value="Napit">Napit</option>
							<option id="Navayat" <?php if($check2){echo set_select('ym_caste','Navayat');} elseif($query2->ym_caste=="Navayat") {echo 'selected="selected"';}?> value="Navayat">Navayat</option>
							<option id="Nayaka" <?php if($check2){echo set_select('ym_caste','Nayaka');} elseif($query2->ym_caste=="Nayaka") {echo 'selected="selected"';}?> value="Nayaka">Nayaka</option>
							<option id="Nepali" <?php if($check2){echo set_select('ym_caste','Nepali');} elseif($query2->ym_caste=="Nepali") {echo 'selected="selected"';}?> value="Nepali">Nepali</option>
							<option id="Nhavi" <?php if($check2){echo set_select('ym_caste','Nhavi');} elseif($query2->ym_caste=="Nhavi") {echo 'selected="selected"';}?> value="Nhavi">Nhavi</option>
							<option id="No Caste" <?php if($check2){echo set_select('ym_caste','No Caste');} elseif($query2->ym_caste=="No Caste") {echo 'selected="selected"';}?> value="No Caste">No Caste</option>
							<option id="OBC - Barber (Nayee)" <?php if($check2){echo set_select('ym_caste','OBC - Barber (Nayee)');} elseif($query2->ym_caste=="OBC - Barber (Nayee)") {echo 'selected="selected"';}?> value="OBC - Barber (Nayee)">OBC - Barber (Nayee)</option>
							<option id="Oswal" <?php if($check2){echo set_select('ym_caste','Oswal');} elseif($query2->ym_caste=="Oswal") {echo 'selected="selected"';}?> value="Oswal">Oswal</option>
							<option id="Others" <?php if($check2){echo set_select('ym_caste','Others');} elseif($query2->ym_caste=="Others") {echo 'selected="selected"';}?> value="Others">Others</option>
							<option id="Padmasali" <?php if($check2){echo set_select('ym_caste','Padmasali');} elseif($query2->ym_caste=="Padmasali") {echo 'selected="selected"';}?> value="Padmasali">Padmasali</option>
							<option id="Pal" <?php if($check2){echo set_select('ym_caste','Pal');} elseif($query2->ym_caste=="Pal") {echo 'selected="selected"';}?> value="Pal">Pal</option>
							<option id="Panchal" <?php if($check2){echo set_select('ym_caste','Panchal');} elseif($query2->ym_caste=="Panchal") {echo 'selected="selected"';}?> value="Panchal">Panchal</option>
							<option id="Panicker" <?php if($check2){echo set_select('ym_caste','Panicker');} elseif($query2->ym_caste=="Panicker") {echo 'selected="selected"';}?> value="Panicker">Panicker</option>
							<option id="Parkava Kulam" <?php if($check2){echo set_select('ym_caste','Parkava Kulam');} elseif($query2->ym_caste=="Parkava Kulam") {echo 'selected="selected"';}?> value="Parkava Kulam">Parkava Kulam</option>
							<option id="Parsees" <?php if($check2){echo set_select('ym_caste','Parsees');} elseif($query2->ym_caste=="Parsees") {echo 'selected="selected"';}?> value="Parsees">Parsees</option>
							<option id="Pasi" <?php if($check2){echo set_select('ym_caste','Pasi');} elseif($query2->ym_caste=="Pasi") {echo 'selected="selected"';}?> value="Pasi">Pasi</option>
							<option id="Patel" <?php if($check2){echo set_select('ym_caste','Patel');} elseif($query2->ym_caste=="Patel") {echo 'selected="selected"';}?> value="Patel">Patel</option>
							<option id="Patel Desai" <?php if($check2){echo set_select('ym_caste','Patel Desai');} elseif($query2->ym_caste=="Patel Desai") {echo 'selected="selected"';}?> value="Patel Desai">Patel Desai</option>
							<option id="Patel Dodia" <?php if($check2){echo set_select('ym_caste','Patel Dodia');} elseif($query2->ym_caste=="Patel Dodia") {echo 'selected="selected"';}?> value="Patel Dodia">Patel Dodia</option>
							<option id="Pathan" <?php if($check2){echo set_select('ym_caste','Pathan');} elseif($query2->ym_caste=="Pathan") {echo 'selected="selected"';}?> value="Pathan">Pathan</option>
							<option id="Patil" <?php if($check2){echo set_select('ym_caste','Patil');} elseif($query2->ym_caste=="Patil") {echo 'selected="selected"';}?> value="Patil">Patil</option>
							<option id="Patnaick" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Patnaick") {echo 'selected="selected"';}?> value="Patnaick">Patnaick</option>
							<option id="Patra" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Patra") {echo 'selected="selected"';}?> value="Patra">Patra</option>
							<option id="Pentecost" <?php if($check2){echo set_select('ym_caste','Pentecost');} elseif($query2->ym_caste=="Pentecost") {echo 'selected="selected"';}?> value="Pentecost">Pentecost</option>
							<option id="Perika" <?php if($check2){echo set_select('ym_caste','Perika');} elseif($query2->ym_caste=="Perika") {echo 'selected="selected"';}?> value="Perika">Perika</option>
							<option id="Pillai" <?php if($check2){echo set_select('ym_caste','Pillai');} elseif($query2->ym_caste=="Pillai") {echo 'selected="selected"';}?> value="Pillai">Pillai</option>
							<option id="Porwal" <?php if($check2){echo set_select('ym_caste','Porwal');} elseif($query2->ym_caste=="Porwal") {echo 'selected="selected"';}?> value="Porwal">Porwal</option>
							<option id="Prajapati" <?php if($check2){echo set_select('ym_caste','Prajapati');} elseif($query2->ym_caste=="Prajapati") {echo 'selected="selected"';}?> value="Prajapati">Prajapati</option>
							<option id="Prashnora Brahmin" <?php if($check2){echo set_select('ym_caste','Prashnora Brahmin');} elseif($query2->ym_caste=="Prashnora Brahmin") {echo 'selected="selected"';}?> value="Prashnora Brahmin">Prashnora Brahmin</option>
							<option id="Protestant" <?php if($check2){echo set_select('ym_caste','Protestant');} elseif($query2->ym_caste=="Protestant") {echo 'selected="selected"';}?> value="Protestant">Protestant</option>
							<option id="Punjabi" <?php if($check2){echo set_select('ym_caste','Punjabi');} elseif($query2->ym_caste=="Punjabi") {echo 'selected="selected"';}?> value="Punjabi">Punjabi</option>
							<option id="Qureshi" <?php if($check2){echo set_select('ym_caste','Qureshi');} elseif($query2->ym_caste=="Qureshi") {echo 'selected="selected"';}?> value="Qureshi">Qureshi</option>
							<option id="Rajaka" <?php if($check2){echo set_select('ym_caste','Rajaka');} elseif($query2->ym_caste=="Rajaka") {echo 'selected="selected"';}?> value="Rajaka">Rajaka</option>
							<option id="Rajastani" <?php if($check2){echo set_select('ym_caste','Rajastani');} elseif($query2->ym_caste=="Rajastani") {echo 'selected="selected"';}?> value="Rajastani">Rajastani</option>
							<option id="Rajbonshi" <?php if($check2){echo set_select('ym_caste','Rajbonshi');} elseif($query2->ym_caste=="Rajbonshi") {echo 'selected="selected"';}?> value="Rajbonshi">Rajbonshi</option>
							<option id="Rajput" <?php if($check2){echo set_select('ym_caste','Rajput');} elseif($query2->ym_caste=="Rajput") {echo 'selected="selected"';}?> value="Rajput">Rajput</option>
							<option id="Rajput Garhwali" <?php if($check2){echo set_select('ym_caste','Rajput Garhwali');} elseif($query2->ym_caste=="Rajput Garhwali") {echo 'selected="selected"';}?> value="Rajput Garhwali">Rajput Garhwali</option>
							<option id="Rajput Kumaoni" <?php if($check2){echo set_select('ym_caste','Rajput Kumaoni');} elseif($query2->ym_caste=="Rajput Kumaoni") {echo 'selected="selected"';}?> value="Rajput Kumaoni">Rajput Kumaoni</option>
							<option id="Rajput Rohella/Tank" <?php if($check2){echo set_select('ym_caste','Rajput Rohella/Tank');} elseif($query2->ym_caste=="Rajput Rohella/Tank") {echo 'selected="selected"';}?> value="Rajput Rohella/Tank">Rajput Rohella/Tank</option>
							<option id="Ramdasia" <?php if($check2){echo set_select('ym_caste','Ramdasia');} elseif($query2->ym_caste=="Ramdasia") {echo 'selected="selected"';}?> value="Ramdasia">Ramdasia</option>
							<option id="Ramgariah" <?php if($check2){echo set_select('ym_caste','Ramgariah');} elseif($query2->ym_caste=="Ramgariah") {echo 'selected="selected"';}?> value="Ramgariah">Ramgariah</option>
							<option id="Ravidasia" <?php if($check2){echo set_select('ym_caste','Ravidasia');} elseif($query2->ym_caste=="Ravidasia") {echo 'selected="selected"';}?> value="Ravidasia">Ravidasia</option>
							<option id="Rawat" <?php if($check2){echo set_select('ym_caste','Rawat');} elseif($query2->ym_caste=="Rawat") {echo 'selected="selected"';}?> value="Rawat">Rawat</option>
							<option id="Reddiar" <?php if($check2){echo set_select('ym_caste','Reddiar');} elseif($query2->ym_caste=="Reddiar") {echo 'selected="selected"';}?> value="Reddiar">Reddiar</option>
							<option id="Reddy" <?php if($check2){echo set_select('ym_caste','Reddy');} elseif($query2->ym_caste=="Reddy") {echo 'selected="selected"';}?> value="Reddy">Reddy</option>
							<option id="Roman Catholic" <?php if($check2){echo set_select('ym_caste','Roman Catholic');} elseif($query2->ym_caste=="Roman Catholic") {echo 'selected="selected"';}?> value="Roman Catholic">Roman Catholic</option>
							<option id="Rowther" <?php if($check2){echo set_select('ym_caste','Rowther');} elseif($query2->ym_caste=="Rowther") {echo 'selected="selected"';}?> value="Rowther">Rowther</option>
							<option id="Sadgope" <?php if($check2){echo set_select('ym_caste','Sadgope');} elseif($query2->ym_caste=="Sadgope") {echo 'selected="selected"';}?> value="Sadgope">Sadgope</option>
							<option id="Saha" <?php if($check2){echo set_select('ym_caste','Saha');} elseif($query2->ym_caste=="Saha") {echo 'selected="selected"';}?> value="Saha">Saha</option>
							<option id="Sahu" <?php if($check2){echo set_select('ym_caste','Sahu');} elseif($query2->ym_caste=="Sahu") {echo 'selected="selected"';}?> value="Sahu">Sahu</option>
							<option id="Saliya" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Saliya") {echo 'selected="selected"';}?> value="Saliya">Saliya</option>
							<option id="Scheduled Caste" <?php if($check2){echo set_select('ym_caste','Scheduled Caste');} elseif($query2->ym_caste=="Scheduled Caste") {echo 'selected="selected"';}?> value="Scheduled Caste">Scheduled Caste</option>
							<option id="Scheduled Tribes" <?php if($check2){echo set_select('ym_caste','Scheduled Tribes');} elseif($query2->ym_caste=="Scheduled Tribes") {echo 'selected="selected"';}?> value="Scheduled Tribes">Scheduled Tribes</option>
							<option id="Senai Thalaivar" <?php if($check2){echo set_select('ym_caste','Senai Thalaivar');} elseif($query2->ym_caste=="Senai Thalaivar") {echo 'selected="selected"';}?> value="Senai Thalaivar">Senai Thalaivar</option>
							<option id="Sepahia" <?php if($check2){echo set_select('ym_caste','Sepahia');} elseif($query2->ym_caste=="Sepahia") {echo 'selected="selected"';}?> value="Sepahia">Sepahia</option>
							<option id="Setti Balija" <?php if($check2){echo set_select('ym_caste','Setti Balija');} elseif($query2->ym_caste=="Setti Balija") {echo 'selected="selected"';}?> value="Setti Balija">Setti Balija</option>
							<option id="Settibalija" <?php if($check2){echo set_select('ym_caste','Settibalija');} elseif($query2->ym_caste=="Settibalija") {echo 'selected="selected"';}?> value="Settibalija">Settibalija</option>
							<option id="Shafi" <?php if($check2){echo set_select('ym_caste','Shafi');} elseif($query2->ym_caste=="Shafi") {echo 'selected="selected"';}?> value="Shafi">Shafi</option>
							<option id="Shah" <?php if($check2){echo set_select('ym_caste','Shah');} elseif($query2->ym_caste=="Shah") {echo 'selected="selected"';}?> value="Shah">Shah</option>
							<option id="Sheikh" <?php if($check2){echo set_select('ym_caste','Sheikh');} elseif($query2->ym_caste=="Sheikh") {echo 'selected="selected"';}?> value="Sheikh">Sheikh</option>
							<option id="Sherager" <?php if($check2){echo set_select('ym_caste','Sherager');} elseif($query2->ym_caste=="Sherager") {echo 'selected="selected"';}?> value="Sherager">Sherager</option>
							<option id="Shetty" <?php if($check2){echo set_select('ym_caste','Shetty');} elseif($query2->ym_caste=="Shetty") {echo 'selected="selected"';}?> value="Shetty">Shetty</option>
							<option id="Shia" <?php if($check2){echo set_select('ym_caste','Shia');} elseif($query2->ym_caste=="Shia") {echo 'selected="selected"';}?> value="Shia">Shia</option>
							<option id="Shia Imami Ismaili" <?php if($check2){echo set_select('ym_caste','Shia Imami Ismaili');} elseif($query2->ym_caste=="Shia Imami Ismaili") {echo 'selected="selected"';}?> value="Shia Imami Ismaili">Shia Imami Ismaili</option>
							<option id="Shimpi" <?php if($check2){echo set_select('ym_caste','Shimpi');} elseif($query2->ym_caste=="Shimpi") {echo 'selected="selected"';}?> value="Shimpi">Shimpi</option>
							<option id="Shwetamber" <?php if($check2){echo set_select('ym_caste','Shwetamber');} elseif($query2->ym_caste=="Shwetamber") {echo 'selected="selected"';}?> value="Shwetamber">Shwetamber</option>
							<option id="Siddiqui" <?php if($check2){echo set_select('ym_caste','Siddiqui');} elseif($query2->ym_caste=="Siddiqui") {echo 'selected="selected"';}?> value="Siddiqui">Siddiqui</option>
							<option id="Sikh Ahluwalia" <?php if($check2){echo set_select('ym_caste','Sikh Ahluwalia');} elseif($query2->ym_caste=="Sikh Ahluwalia") {echo 'selected="selected"';}?> value="Sikh Ahluwalia">Sikh Ahluwalia</option>
							<option id="Sikh Arora" <?php if($check2){echo set_select('ym_caste','Sikh Arora');} elseif($query2->ym_caste=="Sikh Arora") {echo 'selected="selected"';}?> value="Sikh Arora">Sikh Arora</option>
							<option id="Sikh Bhatia" <?php if($check2){echo set_select('ym_caste','Sikh Bhatia');} elseif($query2->ym_caste=="Sikh Bhatia") {echo 'selected="selected"';}?> value="Sikh Bhatia">Sikh Bhatia</option>
							<option id="Sikh Clean Shaven" <?php if($check2){echo set_select('ym_caste','Sikh Clean Shaven');} elseif($query2->ym_caste=="Sikh Clean Shaven") {echo 'selected="selected"';}?> value="Sikh Clean Shaven">Sikh Clean Shaven</option>
							<option id="Sikh Ghumar" <?php if($check2){echo set_select('ym_caste','Sikh Ghumar');} elseif($query2->ym_caste=="Sikh Ghumar") {echo 'selected="selected"';}?> value="Sikh Ghumar">Sikh Ghumar</option>
							<option id="Sikh Gursikh" <?php if($check2){echo set_select('ym_caste','Sikh Gursikh');} elseif($query2->ym_caste=="Sikh Gursikh") {echo 'selected="selected"';}?> value="Sikh Gursikh">Sikh Gursikh</option>
							<option id="Sikh Intercaste" <?php if($check2){echo set_select('ym_caste','Sikh Intercaste');} elseif($query2->ym_caste=="Sikh Intercaste") {echo 'selected="selected"';}?> value="Sikh Intercaste">Sikh Intercaste</option>
							<option id="Sikh Jat" <?php if($check2){echo set_select('ym_caste','Sikh Jat');} elseif($query2->ym_caste=="Sikh Jat") {echo 'selected="selected"';}?> value="Sikh Jat">Sikh Jat</option>
							<option id="Sikh Kamboj" <?php if($check2){echo set_select('ym_caste','Sikh Kamboj');} elseif($query2->ym_caste=="Sikh Kamboj") {echo 'selected="selected"';}?> value="Sikh Kamboj">Sikh Kamboj</option>
							<option id="Sikh Kesadhari" <?php if($check2){echo set_select('ym_caste','Sikh Kesadhari');} elseif($query2->ym_caste=="Sikh Kesadhari") {echo 'selected="selected"';}?> value="Sikh Kesadhari">Sikh Kesadhari</option>
							<option id="Sikh Khashap Rajpoot" <?php if($check2){echo set_select('ym_caste','Sikh Khashap Rajpoot');} elseif($query2->ym_caste=="Sikh Khashap Rajpoot") {echo 'selected="selected"';}?> value="Sikh Khashap Rajpoot">Sikh Khashap Rajpoot</option>
							<option id="Sikh Khatri" <?php if($check2){echo set_select('ym_caste','Sikh Khatri');} elseif($query2->ym_caste=="Sikh Khatri") {echo 'selected="selected"';}?> value="Sikh Khatri">Sikh Khatri</option>
							<option id="Sikh Kshatriya" <?php if($check2){echo set_select('ym_caste','Sikh Kshatriya');} elseif($query2->ym_caste=="Sikh Kshatriya") {echo 'selected="selected"';}?> value="Sikh Kshatriya">Sikh Kshatriya</option>
							<option id="Sikh Lubana" <?php if($check2){echo set_select('ym_caste','Sikh Lubana');} elseif($query2->ym_caste=="Sikh Lubana") {echo 'selected="selected"';}?> value="Sikh Lubana">Sikh Lubana</option>
							<option id="Sikh Majabi" <?php if($check2){echo set_select('ym_caste','Sikh Majabi');} elseif($query2->ym_caste=="Sikh Majabi") {echo 'selected="selected"';}?> value="Sikh Majabi">Sikh Majabi</option>
							<option id="Sikh No Bar" <?php if($check2){echo set_select('ym_caste','Sikh No Bar');} elseif($query2->ym_caste=="Sikh No Bar") {echo 'selected="selected"';}?> value="Sikh No Bar">Sikh No Bar</option>B
							<option id="Sikh Others" <?php if($check2){echo set_select('ym_caste','Sikh Others');} elseif($query2->ym_caste=="Sikh Others") {echo 'selected="selected"';}?> value="Sikh Others">Sikh Others</option>
							<option id="Sikh Ramdasia" <?php if($check2){echo set_select('ym_caste','Sikh Ramdasia');} elseif($query2->ym_caste=="Sikh Ramdasia") {echo 'selected="selected"';}?> value="Sikh Ramdasia">Sikh Ramdasia</option>
							<option id="Sikh Ramgharia" <?php if($check2){echo set_select('ym_caste','Sikh Ramgharia');} elseif($query2->ym_caste=="Sikh Ramgharia") {echo 'selected="selected"';}?> value="Sikh Ramgharia">Sikh Ramgharia</option>
							<option id="Sikh Saini" <?php if($check2){echo set_select('ym_caste','Sikh Saini');} elseif($query2->ym_caste=="Sikh Saini") {echo 'selected="selected"';}?> value="Sikh Saini">Sikh Saini</option>
							<option id="Sindhi" <?php if($check2){echo set_select('ym_caste','Sindhi');} elseif($query2->ym_caste=="Sindhi") {echo 'selected="selected"';}?> value="Sindhi">Sindhi</option>
							<option id="Sindhi Amil" <?php if($check2){echo set_select('ym_caste','Sindhi Amil');} elseif($query2->ym_caste=="Sindhi Amil") {echo 'selected="selected"';}?> value="Sindhi Amil">Sindhi Amil</option>
							<option id="Sindhi Baibhand" <?php if($check2){echo set_select('ym_caste','Sindhi Baibhand');} elseif($query2->ym_caste=="Sindhi Baibhand") {echo 'selected="selected"';}?> value="Sindhi Baibhand">Sindhi Baibhand</option>
							<option id="Sindhi Bhanusali" <?php if($check2){echo set_select('ym_caste','Sindhi Bhanusali');} elseif($query2->ym_caste=="Sindhi Bhanusali") {echo 'selected="selected"';}?> value="Sindhi Bhanusali">Sindhi Bhanusali</option>
							<option id="Sindhi Bhatia" <?php if($check2){echo set_select('ym_caste','Sindhi Bhatia');} elseif($query2->ym_caste=="Sindhi Bhatia") {echo 'selected="selected"';}?> value="Sindhi Bhatia">Sindhi Bhatia</option>
							<option id="Sindhi Chhapru" <?php if($check2){echo set_select('ym_caste','Sindhi Chhapru');} elseif($query2->ym_caste=="Sindhi Chhapru") {echo 'selected="selected"';}?> value="Sindhi Chhapru">Sindhi Chhapru</option>
							<option id="Sindhi Dadu" <?php if($check2){echo set_select('ym_caste','Sindhi Dadu');} elseif($query2->ym_caste=="Sindhi Dadu") {echo 'selected="selected"';}?> value="Sindhi Dadu">Sindhi Dadu</option>
							<option id="Sindhi Hyderabadi" <?php if($check2){echo set_select('ym_caste','Sindhi Hyderabadi');} elseif($query2->ym_caste=="Sindhi Hyderabadi") {echo 'selected="selected"';}?> value="Sindhi Hyderabadi">Sindhi Hyderabadi</option>
							<option id="Sindhi Larai" <?php if($check2){echo set_select('ym_caste','Sindhi Larai');} elseif($query2->ym_caste=="Sindhi Larai") {echo 'selected="selected"';}?> value="Sindhi Larai">Sindhi Larai</option>
							<option id="Sindhi Larkana" <?php if($check2){echo set_select('ym_caste','Sindhi Larkana');} elseif($query2->ym_caste=="Sindhi Larkana") {echo 'selected="selected"';}?> value="Sindhi Larkana">Sindhi Larkana</option>
							<option id="Sindhi Lohana" <?php if($check2){echo set_select('ym_caste','Sindhi Lohana');} elseif($query2->ym_caste=="Sindhi Lohana") {echo 'selected="selected"';}?> value="Sindhi Lohana">Sindhi Lohana</option>
							<option id="Sindhi Rohiri" <?php if($check2){echo set_select('ym_caste','Sindhi Rohiri');} elseif($query2->ym_caste=="Sindhi Rohiri") {echo 'selected="selected"';}?> value="Sindhi Rohiri">Sindhi Rohiri</option>
							<option id="Sindhi Sahiti" <?php if($check2){echo set_select('ym_caste','Sindhi Sahiti');} elseif($query2->ym_caste=="Sindhi Sahiti") {echo 'selected="selected"';}?> value="Sindhi Sahiti">Sindhi Sahiti</option>
							<option id="Sindhi Sakkhar" <?php if($check2){echo set_select('ym_caste','Sindhi Sakkhar');} elseif($query2->ym_caste=="Sindhi Sakkhar") {echo 'selected="selected"';}?> value="Sindhi Sakkhar">Sindhi Sakkhar</option>
							<option id="Sindhi Sehwani" <?php if($check2){echo set_select('ym_caste','Sindhi Sehwani');} elseif($query2->ym_caste=="Sindhi Sehwani") {echo 'selected="selected"';}?> value="Sindhi Sehwani">Sindhi Sehwani</option>
							<option id="Sindhi Shikarpuri" <?php if($check2){echo set_select('ym_caste','Sindhi Shikarpuri');} elseif($query2->ym_caste=="Sindhi Shikarpuri") {echo 'selected="selected"';}?> value="Sindhi Shikarpuri">Sindhi Shikarpuri</option>
							<option id="Sindhi Thatai" <?php if($check2){echo set_select('ym_caste','Sindhi Thatai');} elseif($query2->ym_caste=="Sindhi Thatai") {echo 'selected="selected"';}?> value="Sindhi Thatai">Sindhi Thatai</option>
							<option id="SKP" <?php if($check2){echo set_select('ym_caste','SKP');} elseif($query2->ym_caste=="SKP") {echo 'selected="selected"';}?> value="SKP">SKP</option>
							<option id="Somavanshiya Sahasrarjuna Kshatriya(SSK)" <?php if($check2){echo set_select('ym_caste','Somavanshiya Sahasrarjuna Kshatriya(SSK)');} elseif($query2->ym_caste=="Somavanshiya Sahasrarjuna Kshatriya(SSK)") {echo 'selected="selected"';}?> value="Somavanshiya Sahasrarjuna Kshatriya(SSK)">Somavanshiya Sahasrarjuna Kshatriya(SSK)</option>
							<option id="Somvanshi" <?php if($check2){echo set_select('ym_caste','Somvanshi');} elseif($query2->ym_caste=="Somvanshi") {echo 'selected="selected"';}?> value="Somvanshi">Somvanshi</option>
							<option id="Somvanshi Kayastha Prabhu" <?php if($check2){echo set_select('ym_caste','Somvanshi Kayastha Prabhu');} elseif($query2->ym_caste=="Somvanshi Kayastha Prabhu") {echo 'selected="selected"';}?> value="Somvanshi Kayastha Prabhu">Somvanshi Kayastha Prabhu</option>
							<option id="Sonar" <?php if($check2){echo set_select('ym_caste','Sonar');} elseif($query2->ym_caste=="Sonar") {echo 'selected="selected"';}?> value="Sonar">Sonar</option>
							<option id="Soni" <?php if($check2){echo set_select('ym_caste','Soni');} elseif($query2->ym_caste=="Soni") {echo 'selected="selected"';}?> value="Soni">Soni</option>
							<option id="Sourashtra" <?php if($check2){echo set_select('ym_caste','Sourashtra');} elseif($query2->ym_caste=="Sourashtra") {echo 'selected="selected"';}?> value="Sourashtra">Sourashtra</option>
							<option id="Sozhiya Vellalar" <?php if($check2){echo set_select('ym_caste','Sozhiya Vellalar');} elseif($query2->ym_caste=="Sozhiya Vellalar") {echo 'selected="selected"';}?> value="Sozhiya Vellalar">Sozhiya Vellalar</option>
							<option id="Srisayani" <?php if($check2){echo set_select('ym_caste','Srisayani');} elseif($query2->ym_caste=="Srisayani") {echo 'selected="selected"';}?> value="Srisayani">Srisayani</option>
							<option id="Sudir" <?php if($check2){echo set_select('ym_caste','Sudir');} elseif($query2->ym_caste=="Sudir") {echo 'selected="selected"';}?> value="Sudir">Sudir</option>
							<option id="Sundhi" <?php if($check2){echo set_select('ym_caste','Sundhi');} elseif($query2->ym_caste=="Sundhi") {echo 'selected="selected"';}?> value="Sundhi">Sundhi</option>
							<option id="Sunni" <?php if($check2){echo set_select('ym_caste','Sunni');} elseif($query2->ym_caste=="Sunni") {echo 'selected="selected"';}?> value="Sunni">Sunni</option>
							<option id="Suthar" <?php if($check2){echo set_select('ym_caste','Suthar');} elseif($query2->ym_caste=="Suthar") {echo 'selected="selected"';}?> value="Suthar">Suthar</option>
							<option id="Swakula Sali" <?php if($check2){echo set_select('ym_caste','Swakula Sali');} elseif($query2->ym_caste=="Swakula Sali") {echo 'selected="selected"';}?> value="Swakula Sali">Swakula Sali</option>
							<option id="Swarnkar" <?php if($check2){echo set_select('ym_caste','Swarnkar');} elseif($query2->ym_caste=="Swarnkar") {echo 'selected="selected"';}?> value="Swarnkar">Swarnkar</option>
							<option id="Syed" <?php if($check2){echo set_select('ym_caste','Syed');} elseif($query2->ym_caste=="Syed") {echo 'selected="selected"';}?> value="Syed">Syed</option>
							<option id="Syrian" <?php if($check2){echo set_select('ym_caste','Syrian');} elseif($query2->ym_caste=="Syrian") {echo 'selected="selected"';}?> value="Syrian">Syrian</option>
							<option id="Syrian Catholic" <?php if($check2){echo set_select('ym_caste','Syrian Catholic');} elseif($query2->ym_caste=="Syrian Catholic") {echo 'selected="selected"';}?> value="Syrian Catholic">Syrian Catholic</option>
							<option id="Syrian Jacobite" <?php if($check2){echo set_select('ym_caste','Syrian Jacobite');} elseif($query2->ym_caste=="Syrian Jacobite") {echo 'selected="selected"';}?> value="Syrian Jacobite">Syrian Jacobite</option>
							<option id="Syrian Malabar" <?php if($check2){echo set_select('ym_caste','Syrian Malabar');} elseif($query2->ym_caste=="Syrian Malabar") {echo 'selected="selected"';}?> value="Syrian Malabar">Syrian Malabar</option>
							<option id="Syrian Orthodox" <?php if($check2){echo set_select('ym_caste','Syrian Orthodox');} elseif($query2->ym_caste=="Syrian Orthodox") {echo 'selected="selected"';}?> value="Syrian Orthodox">Syrian Orthodox</option>
							<option id="Tamboli" <?php if($check2){echo set_select('ym_caste','Tamboli');} elseif($query2->ym_caste=="Tamboli") {echo 'selected="selected"';}?> value="Tamboli">Tamboli</option>
							<option id="Tamil Yadava" <?php if($check2){echo set_select('ym_caste','Tamil Yadava');} elseif($query2->ym_caste=="Tamil Yadava") {echo 'selected="selected"';}?> value="Tamil Yadava">Tamil Yadava</option>
							<option id="Tanti" <?php if($check2){echo set_select('ym_caste','Tanti');} elseif($query2->ym_caste=="Tanti") {echo 'selected="selected"';}?> value="Tanti">Tanti</option>
							<option id="Tantubai" <?php if($check2){echo set_select('ym_caste','Tantubai');} elseif($query2->ym_caste=="Tantubai") {echo 'selected="selected"';}?> value="Tantubai">Tantubai</option>
							<option id="Tantuway" <?php if($check2){echo set_select('ym_caste','Tantuway');} elseif($query2->ym_caste=="Tantuway") {echo 'selected="selected"';}?> value="Tantuway">Tantuway</option>
							<option id="Telaga" <?php if($check2){echo set_select('ym_caste','Telaga');} elseif($query2->ym_caste=="Telaga") {echo 'selected="selected"';}?> value="Telaga">Telaga</option>
							<option id="Teli" <?php if($check2){echo set_select('ym_caste','Teli');} elseif($query2->ym_caste=="Teli") {echo 'selected="selected"';}?> value="Teli">Teli</option>
							<option id="Thakkar" <?php if($check2){echo set_select('ym_caste','Thakkar');} elseif($query2->ym_caste=="Thakkar") {echo 'selected="selected"';}?> value="Thakkar">Thakkar</option>
							<option id="Thakur" <?php if($check2){echo set_select('ym_caste','Thakur');} elseif($query2->ym_caste=="Thakur") {echo 'selected="selected"';}?> value="Thakur">Thakur</option>
							<option id="Thevar" <?php if($check2){echo set_select('ym_caste','Thevar');} elseif($query2->ym_caste=="Thevar") {echo 'selected="selected"';}?> value="Thevar">Thevar</option>
							<option id="Thigala" <?php if($check2){echo set_select('ym_caste','Thigala');} elseif($query2->ym_caste=="Thigala") {echo 'selected="selected"';}?> value="Thigala">Thigala</option>
							<option id="Thiyya" <?php if($check2){echo set_select('ym_caste','Thiyya');} elseif($query2->ym_caste=="Thiyya") {echo 'selected="selected"';}?> value="Thiyya">Thiyya</option>
							<option id="Tili" <?php if($check2){echo set_select('ym_caste','Tili');} elseif($query2->ym_caste=="Tili") {echo 'selected="selected"';}?> value="Tili">Tili</option>
							<option id="Udaiyar" <?php if($check2){echo set_select('ym_caste','Udaiyar');} elseif($query2->ym_caste=="Udaiyar") {echo 'selected="selected"';}?> value="Udaiyar">Udaiyar</option>
							<option id="Unspecified" <?php if($check2){echo set_select('ym_caste','Unspecified');} elseif($query2->ym_caste=="Unspecified") {echo 'selected="selected"';}?> value="Unspecified">Unspecified</option>
							<option id="Uppara" <?php if($check2){echo set_select('ym_caste','Uppara');} elseif($query2->ym_caste=="Uppara") {echo 'selected="selected"';}?> value="Uppara">Uppara</option>
							<option id="Vadagalai" <?php if($check2){echo set_select('ym_caste','Vadagalai');} elseif($query2->ym_caste=="Vadagalai") {echo 'selected="selected"';}?> value="Vadagalai">Vadagalai</option>
							<option id="Vaddera" <?php if($check2){echo set_select('ym_caste','Vaddera');} elseif($query2->ym_caste=="Vaddera") {echo 'selected="selected"';}?> value="Vaddera">Vaddera</option>
							<option id="Vaish" <?php if($check2){echo set_select('ym_caste','Vaish');} elseif($query2->ym_caste=="Vaish") {echo 'selected="selected"';}?> value="Vaish">Vaish</option>
							<option id="Vaishnav" <?php if($check2){echo set_select('ym_caste','Vaishnav');} elseif($query2->ym_caste=="Vaishnav") {echo 'selected="selected"';}?> value="Vaishnav">Vaishnav</option>
							<option id="Vaishnav Bhatia" <?php if($check2){echo set_select('ym_caste','Vaishnav Bhatia');} elseif($query2->ym_caste=="Vaishnav Bhatia") {echo 'selected="selected"';}?> value="Vaishnav Bhatia">Vaishnav Bhatia</option>
							<option id="Vaishnav Vanik" <?php if($check2){echo set_select('ym_caste','Vaishnav Vanik');} elseif($query2->ym_caste=="Vaishnav Vanik") {echo 'selected="selected"';}?> value="Vaishnav Vanik">Vaishnav Vanik</option>
							<option id="Vaishnava" <?php if($check2){echo set_select('ym_caste','Vaishnava');} elseif($query2->ym_caste=="Vaishnava") {echo 'selected="selected"';}?> value="Vaishnava">Vaishnava</option>
							<option id="Vaishya" <?php if($check2){echo set_select('ym_caste','Vaishya');} elseif($query2->ym_caste=="Vaishya") {echo 'selected="selected"';}?> value="Vaishya">Vaishya</option>echo set_select('ym_caste','');
							<option id="Vaishya Vani" <?php if($check2){echo set_select('ym_caste','Vaishya Vani');} elseif($query2->ym_caste=="Vaishya Vani") {echo 'selected="selected"';}?> value="Vaishya Vani">Vaishya Vani</option>
							<option id="Valmiki" <?php if($check2){echo set_select('ym_caste','Valmiki');} elseif($query2->ym_caste=="Valmiki") {echo 'selected="selected"';}?> value="Valmiki">Valmiki</option>
							<option id="Vania" <?php if($check2){echo set_select('ym_caste','Vania');} elseif($query2->ym_caste=="Vania") {echo 'selected="selected"';}?> value="Vania">Vania</option>
							<option id="Vaniya" <?php if($check2){echo set_select('ym_caste','Vaniya');} elseif($query2->ym_caste=="Vaniya") {echo 'selected="selected"';}?> value="Vaniya">Vaniya</option>
							<option id="Vanjara" <?php if($check2){echo set_select('ym_caste','Vanjara');} elseif($query2->ym_caste=="Vanjara") {echo 'selected="selected"';}?> value="Vanjara">Vanjara</option>
							<option id="Vanjari" <?php if($check2){echo set_select('ym_caste','Vanjari');} elseif($query2->ym_caste=="Vanjari") {echo 'selected="selected"';}?> value="Vanjari">Vanjari</option>
							<option id="Vankar" <?php if($check2){echo set_select('ym_caste','Vankar');} elseif($query2->ym_caste=="Vankar") {echo 'selected="selected"';}?> value="Vankar">Vankar</option>
							<option id="Vannar" <?php if($check2){echo set_select('ym_caste','Vannar');} elseif($query2->ym_caste=="Vannar") {echo 'selected="selected"';}?> value="Vannar">Vannar</option>
							<option id="Vannia Kula Kshatriyar" <?php if($check2){echo set_select('ym_caste','Vannia Kula Kshatriyar');} elseif($query2->ym_caste=="Vannia Kula Kshatriyar") {echo 'selected="selected"';}?> value="Vannia Kula Kshatriyar">Vannia Kula Kshatriyar</option>
							<option id="Vanniyar" <?php if($check2){echo set_select('ym_caste','Vanniyar');} elseif($query2->ym_caste=="Vanniyar") {echo 'selected="selected"';}?> value="Vanniyar">Vanniyar</option>
							<option id="Varshney" <?php if($check2){echo set_select('ym_caste','Varshney');} elseif($query2->ym_caste=="Varshney") {echo 'selected="selected"';}?> value="Varshney">Varshney</option>
							<option id="Veera Saivam" <?php if($check2){echo set_select('ym_caste','Veera Saivam');} elseif($query2->ym_caste=="Veera Saivam") {echo 'selected="selected"';}?> value="Veera Saivam">Veera Saivam</option>
							<option id="Veerashaiva" <?php if($check2){echo set_select('ym_caste','');} elseif($query2->ym_caste=="Veerashaiva") {echo 'selected="selected"';}?> value="Veerashaiva">Veerashaiva</option>
							<option id="Velama" <?php if($check2){echo set_select('ym_caste','Velama');} elseif($query2->ym_caste=="Velama") {echo 'selected="selected"';}?> value="Velama">Velama</option>
							<option id="Vellalar" <?php if($check2){echo set_select('ym_caste','Vellalar');} elseif($query2->ym_caste=="Vellalar") {echo 'selected="selected"';}?> value="Vellalar">Vellalar</option>
							<option id="Vellalar Devandra Kula" <?php if($check2){echo set_select('ym_caste','Vellalar Devandra Kula');} elseif($query2->ym_caste=="Vellalar Devandra Kula") {echo 'selected="selected"';}?> value="Vellalar Devandra Kula">Vellalar Devandra Kula</option>
							<option id="Vishwakarma" <?php if($check2){echo set_select('ym_caste','Vishwakarma');} elseif($query2->ym_caste=="Vishwakarma") {echo 'selected="selected"';}?> value="Vishwakarma">Vishwakarma</option>
							<option id="Vokkaliga" <?php if($check2){echo set_select('ym_caste','Vokkaliga');} elseif($query2->ym_caste=="Vokkaliga") {echo 'selected="selected"';}?> value="Vokkaliga">Vokkaliga</option>
							<option id="Vysya" <?php if($check2){echo set_select('ym_caste','Vysya');} elseif($query2->ym_caste=="Vysya") {echo 'selected="selected"';}?> value="Vysya">Vysya</option>
							<option id="Yadav" <?php if($check2){echo set_select('ym_caste','Yadav');} elseif($query2->ym_caste=="Yadav") {echo 'selected="selected"';}?> value="Yadav">Yadav</option>
							<option id="Yadava" <?php if($check2){echo set_select('ym_caste','Yadava');} elseif($query2->ym_caste=="Yadava") {echo 'selected="selected"';}?> value="Yadava">Yadava</option>
					
						</select>
						<div class="error"><?php echo form_error('ym_caste'); ?></div>
						
                    </td>
					
                </tr>
				
                 <tr>
                   	<td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Sub Caste/Sect</strong></td>
                   	<td class="txtBlack13Arial"><input type="text" value="<?php if(!$check2) echo $query2->ym_sub_caste; ?>" class="textBox_Admin" id="ym_sub_caste" name="ym_sub_caste"></td>
                </tr>
				
                 <tr>
                   	<td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Gothram</strong></td>
                   	<td class="txtBlack13Arial"><input type="text" value="<?php if(!$check2) echo $query2->ym_gothram;?>" class="textBox_Admin" id="ym_gothram" name="ym_gothram"></td>
                </tr>
				
                <tr>
              	  	<td></td>
           	 		<td align="left">
					<input type="submit" class="btn btn-primary" value="Update" id="ym_update2" name="ym_update2">&nbsp;
					<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel"></td>
   			 	</tr>
				
            	</tbody>
			
				</table> 
			       
				<?php echo form_close();?>
				          
              </div>
			  
			  <!--------------end of social info tab---------------->
			  
			  <!-----------------astrological info tab--------------->
			  
              <div id="tabs-3">
               
			   <?php
                $form_attributes = array('id' => 'myform3');
                echo form_open('', $form_attributes);
           	  ?>
			  
               <table width="100%" cellspacing="2" cellpadding="5" align="center" class="tblBorder">
			   
                <tbody>
				
				<tr bgcolor="#E6E6E6">
                    <td class="SubTitle BorderBtm" colspan="4">Astrological Information </td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="2"></td>
   				</tr>
                
				<tr>
					<td colspan="2">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg3'); $this->session->unset_userdata('tab_msg3');?>		
						</div>
					</td>
				</tr>
				
				<tr>
                    <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Age <span class="err">*</span></strong></td>
                    <td class="txtBlack13Arial" colspan="3">
                    	<input type="text" value="<?php if(!$check3) { echo $query3->ym_age; } else { echo set_value("ym_age");}?>" class="textBox_Admin" id="ym_age" name="ym_age">
						<div class="error"><?php echo form_error('ym_age'); ?></div>
					</td>
					
                </tr>
				
                <tr>
					<td align="right" colspan="4" class="BlueBold13">The date of birth information/other following below are optional. But if given enhances your profile. </td>
				</tr>
				
                <tr>
                   <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Date Of Birth </strong></td>
                   <td class="txtBlack13Arial" colspan="3">
				   		<!--onfocus="return scwShow(this,this),divisible('ustart');" onmouseover="return scwShow(this,this);"-->
						<!----updated by dharati 201309271130----------------->
                   		<input type="text" class="textBox_Admin" value="<?php if(!$check3) echo $query3->ym_birth_date; else echo $query8->mm_birth_year."-".$query8->mm_birth_month; ?>" id="ym_birth_date" name="ym_birth_date"> 
						<!----end--------->
						
					</td>
                </tr>
				
                <tr>
                	<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Time Of Birth</strong></td>
                    <td width="16%" class="txtBlack13Arial"><!-- Hour:-->
                    	
						<select class="small_txtBox input-wi" id="ym_hour" name="ym_hour">
                                <option value="">Hour</option>
                                <option id="1" value="1">1</option>
								<option id="2" value="2">2</option>
								<option id="3" value="3">3</option>
								<option id="4" value="4">4</option>
								<option id="5" value="5">5</option>
								<option id="6" value="6">6</option>
								<option id="7" value="7">7</option>
								<option id="8" value="8">8</option>
								<option id="9" value="9">9</option>
								<option id="10" value="10">10</option>
								<option id="11" value="11">11</option>
								<option id="12" value="12">12</option>
                    	</select>
						
					</td>
                    
                    <td width="65%" class="txtBlack13Arial"><!--Minutes:-->
					
                    	<select class="small_txtBox input-wi" id="ym_minute" name="ym_minute">
                      		<option value="">Minutes</option>
							<option id="1min" value="1">1</option>
							<option id="2min" value="2">2</option>
							<option id="3min" value="3">3</option>
							<option id="4min" value="4">4</option>
							<option id="5min" value="5">5</option>
							<option id="6min" value="6">6</option>
							<option id="7min" value="7">7</option>
							<option id="8min" value="8">8</option>
							<option id="9min" value="9">9</option>
							<option id="10min" value="10">10</option>
							<option id="11min" value="11">11</option>
							<option id="12min" value="12">12</option>
							<option id="13min" value="13">13</option>
							<option id="14min" value="14">14</option>
							<option id="15min" value="15">15</option>
							<option id="16min" value="16">16</option>
							<option id="17min" value="17">17</option>
							<option id="18min" value="18">18</option>
							<option id="19min" value="19">19</option>
							<option id="20min" value="20">20</option>
							<option id="21min" value="21">21</option>
							<option id="22min" value="22">22</option>
							<option id="23min" value="23">23</option>
							<option id="24min" value="24">24</option>
							<option id="25min" value="25">25</option>
							<option id="26min" value="26">26</option>
							<option id="27min" value="27">27</option>
							<option id="28min" value="28">28</option>
							<option id="29min" value="29">29</option>
							<option id="30min" value="30">30</option>
							<option id="31min" value="31">31</option>
							<option id="32min" value="32">32</option>
							<option id="33min" value="33">33</option>
							<option id="34min" value="34">34</option>
							<option id="35min" value="35">35</option>
							<option id="36min" value="36">36</option>
							<option id="37min" value="37">37</option>
							<option id="38min" value="38">38</option>
							<option id="39min" value="39">39</option>
							<option id="40min" value="40">40</option>
							<option id="41min" value="41">41</option>
							<option id="42min" value="42">42</option>
							<option id="43min" value="43">43</option>
							<option id="44min" value="44">44</option>
							<option id="45min" value="45">45</option>
							<option id="46min" value="46">46</option>
							<option id="47min" value="47">47</option>
							<option id="48min" value="48">48</option>
							<option id="49min" value="49">49</option>
							<option id="50min" value="50">50</option>
							<option id="51min" value="51">51</option>
							<option id="52min" value="52">52</option>
							<option id="53min" value="53">53</option>
							<option id="54min" value="54">54</option>
							<option id="55min" value="55">55</option>
							<option id="56min" value="56">56</option>
							<option id="57min" value="57">57</option>
							<option id="58min" value="58">58</option>
							<option id="59min" value="59">59</option>
                                          
						</select>
						
						<select class="small_txtBox input-wi" id="ym_am_pm" name="ym_am_pm" style="margin-left:5px;">
                      		<option value="" selected="selected">AM/PM</option>
                      		<option id="AM" value="AM">AM</option>
							<option id="PM" value="PM">PM</option>
                    	</select>
					</td>
					<!--<td width="19%" class="txtBlack13Arial"><!--AM/PM:
                   
                    	<select class="small_txtBox input-wi" id="ym_am_pm" name="ym_am_pm">
                      		<option value="" selected="selected">AM/PM</option>
                      		<option id="AM" value="AM">AM</option>
							<option id="PM" value="PM">PM</option>
                    	</select>
						
					</td>-->
                </tr>
				
                 <tr>
                   <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Place Of Birth</strong></td>
                   <td class="txtBlack13Arial" colspan="3"><input type="text" value="<?php if(!$check3) echo $query3->ym_birth_place; ?>" class="textBox_Admin" id="ym_birth_place" name="ym_birth_place"></td>
                </tr>
				
                <tr>
                    <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Star Sign/Nakshatra</strong></td>
                    <td class="txtBlack13Arial" colspan="3">
					
                        <select class="combo" id="ym_nakshatra" name="ym_nakshatra">
                            <option value="0">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM starsign ORDER BY Parameter-->
							
							<option id="Anuradha/Anusham" <?php if($check3){} elseif($query3->ym_nakshatra=="Anuradha/Anusham") {echo 'selected="selected"';}?> value="Anuradha/Anusham">Anuradha/Anusham</option>
							<option id="Arudra/Thiruvadhirai" <?php if($check3){} elseif($query3->ym_nakshatra=="Arudra/Thiruvadhirai") {echo 'selected="selected"';}?> value="Arudra/Thiruvadhirai">Arudra/Thiruvadhirai</option>
							<option id="Aslesha/Ayilyam" <?php if($check3){} elseif($query3->ym_nakshatra=="Aslesha/Ayilyam") {echo 'selected="selected"';}?> value="Aslesha/Ayilyam">Aslesha/Ayilyam</option>
							<option id="Aswini/Aswathi" <?php if($check3){} elseif($query3->ym_nakshatra=="Aswini/Aswathi") {echo 'selected="selected"';}?> value="Aswini/Aswathi">Aswini/Aswathi</option>
							<option id="Bharani" <?php if($check3){} elseif($query3->ym_nakshatra=="Bharani") {echo 'selected="selected"';}?> value="Bharani">Bharani</option>
							<option id="Chitta/Chithirai" <?php if($check3){} elseif($query3->ym_nakshatra=="Chitta/Chithirai") {echo 'selected="selected"';}?> value="Chitta/Chithirai">Chitta/Chithirai</option>
							<option id="Dhanishta/Avittam" <?php if($check3){} elseif($query3->ym_nakshatra=="Dhanishta/Avittam") {echo 'selected="selected"';}?> value="Dhanishta/Avittam">Dhanishta/Avittam</option>
							<option id="Hastha/Hastham" <?php if($check3){} elseif($query3->ym_nakshatra=="Hastha/Hastham") {echo 'selected="selected"';}?> value="Hastha/Hastham">Hastha/Hastham</option>
							<option id="Jyeshta/Kettai" <?php if($check3){} elseif($query3->ym_nakshatra=="Jyeshta/Kettai") {echo 'selected="selected"';}?> value="Jyeshta/Kettai">Jyeshta/Kettai</option>
							<option id="Krittika/Karthigai" <?php if($check3){} elseif($query3->ym_nakshatra=="Krittika/Karthigai") {echo 'selected="selected"';}?> value="Krittika/Karthigai">Krittika/Karthigai</option>
							<option id="Makha/Magam" <?php if($check3){} elseif($query3->ym_nakshatra=="Makha/Magam") {echo 'selected="selected"';}?> value="Makha/Magam">Makha/Magam</option>
							<option id="Moola/Moolam" <?php if($check3){} elseif($query3->ym_nakshatra=="Moola/Moolam") {echo 'selected="selected"';}?> value="Moola/Moolam">Moola/Moolam</option>
							<option id="Mrigasira/Mrigaseersham" <?php if($check3){} elseif($query3->ym_nakshatra=="Mrigasira/Mrigaseersham") {echo 'selected="selected"';}?> value="Mrigasira/Mrigaseersham">Mrigasira/Mrigaseersham</option>
							<option id="Poorva Phalguni/Pooram" <?php if($check3){} elseif($query3->ym_nakshatra=="Poorva Phalguni/Pooram") {echo 'selected="selected"';}?> value="Poorva Phalguni/Pooram">Poorva Phalguni/Pooram</option>
							<option id="Poorvabhadrapada/Pooratadhi" <?php if($check3){} elseif($query3->ym_nakshatra=="Poorvabhadrapada/Pooratadhi") {echo 'selected="selected"';}?> value="Poorvabhadrapada/Pooratadhi">Poorvabhadrapada/Pooratadhi</option>
							<option id="Punarvasu/Punarpusam" <?php if($check3){} elseif($query3->ym_nakshatra=="Punarvasu/Punarpusam") {echo 'selected="selected"';}?> value="Punarvasu/Punarpusam">Punarvasu/Punarpusam</option>
							<option id="Purvashadha/Pooradam" <?php if($check3){} elseif($query3->ym_nakshatra=="Purvashadha/Pooradam") {echo 'selected="selected"';}?> value="Purvashadha/Pooradam">Purvashadha/Pooradam</option>
							<option id="Pushya/Pusam" <?php if($check3){} elseif($query3->ym_nakshatra=="Pushya/Pusam") {echo 'selected="selected"';}?> value="Pushya/Pusam">Pushya/Pusam</option>
							<option id="Revathi" <?php if($check3){} elseif($query3->ym_nakshatra=="Revathi") {echo 'selected="selected"';}?> value="Revathi">Revathi</option>
							<option id="Rohini" <?php if($check3){} elseif($query3->ym_nakshatra=="Rohini") {echo 'selected="selected"';}?> value="Rohini">Rohini</option>
							<option id="Satabishak/Sadhayam" <?php if($check3){} elseif($query3->ym_nakshatra=="Satabishak/Sadhayam") {echo 'selected="selected"';}?> value="Satabishak/Sadhayam">Satabishak/Sadhayam</option>
							<option id="Sravana/Thiruvonam" <?php if($check3){} elseif($query3->ym_nakshatra=="Sravana/Thiruvonam") {echo 'selected="selected"';}?> value="Sravana/Thiruvonam">Sravana/Thiruvonam</option>
							<option id="Swathi" <?php if($check3){} elseif($query3->ym_nakshatra=="Swathi") {echo 'selected="selected"';}?> value="Swathi">Swathi</option>
							<option id="Uttara Phalguni/Uthiram" <?php if($check3){} elseif($query3->ym_nakshatra=="Uttara Phalguni/Uthiram") {echo 'selected="selected"';}?> value="Uttara Phalguni/Uthiram">Uttara Phalguni/Uthiram</option>
							<option id="Uttarabhadrapada/Utihratadhi" <?php if($check3){} elseif($query3->ym_nakshatra=="Uttarabhadrapada/Utihratadhi") {echo 'selected="selected"';}?> value="Uttarabhadrapada/Utihratadhi">Uttarabhadrapada/Utihratadhi</option>
							<option id="Uttarashadha/Uthiradam" <?php if($check3){} elseif($query3->ym_nakshatra=="Uttarashadha/Uthiradam") {echo 'selected="selected"';}?> value="Uttarashadha/Uthiradam">Uttarashadha/Uthiradam</option>
							<option id="Visakha/Visakam" <?php if($check3){} elseif($query3->ym_nakshatra=="Visakha/Visakam") {echo 'selected="selected"';}?> value="Visakha/Visakam">Visakha/Visakam</option>                  
						</select>
						                
				   </td>
                </tr>
				
                 <tr>
                   <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Moon Sign/Raasi</strong> </td>
                   <td class="txtBlack13Arial" colspan="3">
				   
                   		<select class="combo" id="ym_raasi" name="ym_raasi">
                            <option value="0">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM moonsign ORDER BY ParameterID-->
							
							<option id="Mesha/Aries" <?php if($check3){} elseif($query3->ym_raasi=="Mesha/Aries") {echo 'selected="selected"';}?> value="Mesha/Aries">Mesha/Aries</option>
							<option id="Vrishabha/Taurus" <?php if($check3){} elseif($query3->ym_raasi=="Vrishabha/Taurus") {echo 'selected="selected"';}?> value="Vrishabha/Taurus">Vrishabha/Taurus</option>
							<option id="Mithuna/Gemini" <?php if($check3){} elseif($query3->ym_raasi=="Mithuna/Gemini") {echo 'selected="selected"';}?> value="Mithuna/Gemini">Mithuna/Gemini</option>
							<option id="Karkataka/Cancer" <?php if($check3){} elseif($query3->ym_raasi=="Karkataka/Cancer") {echo 'selected="selected"';}?> value="Karkataka/Cancer">Karkataka/Cancer</option>
							<option id="Simha/Leo" <?php if($check3){} elseif($query3->ym_raasi=="Simha/Leo") {echo 'selected="selected"';}?> value="Simha/Leo">Simha/Leo</option>
							<option id="Kanya/Virgo" <?php if($check3){} elseif($query3->ym_raasi=="Kanya/Virgo") {echo 'selected="selected"';}?> value="Kanya/Virgo">Kanya/Virgo</option>
							<option id="Tula/Libra" <?php if($check3){} elseif($query3->ym_raasi=="Tula/Libra") {echo 'selected="selected"';}?> value="Tula/Libra">Tula/Libra</option>
							<option id="Vrischika/Scorpio" <?php if($check3){} elseif($query3->ym_raasi=="Vrischika/Scorpio") {echo 'selected="selected"';}?> value="Vrischika/Scorpio">Vrischika/Scorpio</option>
							<option id="Dhanur/Sagittarius" <?php if($check3){} elseif($query3->ym_raasi=="Dhanur/Sagittarius") {echo 'selected="selected"';}?> value="Dhanur/Sagittarius">Dhanur/Sagittarius</option>
							<option id="Makara/Capricorn" <?php if($check3){} elseif($query3->ym_raasi=="Makara/Capricorn") {echo 'selected="selected"';}?> value="Makara/Capricorn">Makara/Capricorn</option>
							<option id="Kumbha/Aquarius" <?php if($check3){} elseif($query3->ym_raasi=="Kumbha/Aquarius") {echo 'selected="selected"';}?> value="Kumbha/Aquarius">Kumbha/Aquarius</option>
							<option id="Meena/Pisces" <?php if($check3){} elseif($query3->ym_raasi=="Meena/Pisces") {echo 'selected="selected"';}?> value="Meena/Pisces">Meena/Pisces</option>          
						</select>   
						  
					</td>
                </tr>
				
                <tr>
                    <td width="31%" align="right" class="txtBlack13Arial" style="padding-bottom:12px;"><strong>Manglik/Dosham <span class="err">*</span> </strong></td>
                    <td class="txtBlack13Arial" colspan="3">
                    <input type="radio" <?php if($check3){echo set_radio('ym_manglik','No');} elseif($query3->ym_manglik=="No") {echo 'checked="checked"'; } ?> value="No" id="ym_manglik_n" name="ym_manglik" style="margin:0 2px 0 0 ;">No
                    <input type="radio" <?php if($check3){echo set_radio('ym_manglik','Yes');} elseif($query3->ym_manglik=="Yes") {echo 'checked="checked"'; } ?> value="Yes" id="ym_manglik_y" name="ym_manglik" style="margin:0 2px 0 15px ;">Yes
                    <input type="radio" <?php if($check3){echo set_radio('ym_manglik','Do Not know');} elseif($query3->ym_manglik=="Do Not know") {echo 'checked="checked"'; } ?> value="Do Not know" id="ym_manglik_nk" name="ym_manglik" style="margin:0 2px 0 15px ;">Do Not know
                    <input type="radio" <?php if($check3){echo set_radio('ym_manglik','Not applicable',true);} elseif($query3->ym_manglik=="Not applicable") {echo 'checked="checked"'; } ?> value="Not applicable" id="ym_manglik_na" name="ym_manglik" style="margin:0 2px 0 15px ;">Not applicable
					<div class="error"><?php echo form_error('ym_manglik'); ?></div>
                    </td>
					
                </tr>
				
                <tr>
              		<td></td>
           	 		<td align="left" colspan="3">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update3" name="ym_update3">&nbsp;
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel">
					</td>
   			 	</tr>
			 
            </tbody>
			
			</table>
               
			   <?php echo form_close();?>
			   
            </div>
			
			<!-----------end of astrological info tab------------->
			
			<!------education and profession info tab---------->
			
            <div id="tabs-4">
                
				 <?php
                	$form_attributes = array('id' => 'myform4');
                	echo form_open('', $form_attributes);
           	  	?>
			  
                <table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
                
				<tbody>
				
				<tr bgcolor="#E6E6E6">
                    <td class="SubTitle BorderBtm" colspan="3">Educational and Professional Information </td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="3"></td>
   				</tr>
				
				<tr>
					<td colspan="3">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg4'); $this->session->unset_userdata('tab_msg4');?>		
						</div>
					</td>
				</tr>
				
                <tr>
                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Education <span class="err">*</span></strong></td>
                    <td width="16%" class="txtBlack13Arial">
                    	
						<strong>Degree Level:<span class="err">*</span></strong><br>
                    	<select  class="combo" id="ym_degree_level" name="ym_degree_level">
                            <option value="">Select</option>
							
                           <!-- SELECT Parameter,ParameterID FROM degreelevel ORDER BY Parameter-->
						   
                            <option id="Associates Degree" <?php if($check4){echo set_select('ym_degree_level','Associates Degree');} elseif($query4->ym_degree_level=="Associates Degree") {echo 'selected="selected"';}?> value="Associates Degree">Associates Degree</option>
							<option id="Bachelors" <?php if($check4){echo set_select('ym_degree_level','Bachelors');} elseif($query4->ym_degree_level=="Bachelors") {echo 'selected="selected"';}?> value="Bachelors">Bachelors</option>
							<option id="Diploma" <?php if($check4){echo set_select('ym_degree_level','Diploma');} elseif($query4->ym_degree_level=="Diploma") {echo 'selected="selected"';}?> value="Diploma">Diploma</option>
							<option id="Doctorate" <?php if($check4){echo set_select('ym_degree_level','Doctorate');} elseif($query4->ym_degree_level=="Doctorate") {echo 'selected="selected"';}?> value="Doctorate">Doctorate</option>
							<option id="High School" <?php if($check4){echo set_select('ym_degree_level','High School');} elseif($query4->ym_degree_level=="High School") {echo 'selected="selected"';}?> value="High School">High School</option>
							<option id="Higher Secondary / Secondary" <?php if($check4){echo set_select('ym_degree_level','Higher Secondary / Secondary');} elseif($query4->ym_degree_level=="Higher Secondary / Secondary") {echo 'selected="selected"';}?> value="Higher Secondary / Secondary">Higher Secondary / Secondary</option>
							<option id="Honours Degree" <?php if($check4){echo set_select('ym_degree_level','Honours Degree');} elseif($query4->ym_degree_level=="Honours Degree") {echo 'selected="selected"';}?> value="Honours Degree">Honours Degree</option>
							<option id="Industrial Training" <?php if($check4){echo set_select('ym_degree_level','Industrial Training');} elseif($query4->ym_degree_level=="Industrial Training") {echo 'selected="selected"';}?> value="Industrial Training">Industrial Training</option>
							<option id="Less than High School" <?php if($check4){echo set_select('ym_degree_level','Less than High School');} elseif($query4->ym_degree_level=="Less than High School") {echo 'selected="selected"';}?> value="Less than High School">Less than High School</option>
							<option id="Masters" <?php if($check4){echo set_select('ym_degree_level','Masters');} elseif($query4->ym_degree_level=="Masters") {echo 'selected="selected"';}?> value="Masters">Masters</option>
							<option id="Trade School" <?php if($check4){echo set_select('ym_degree_level','Trade School');} elseif($query4->ym_degree_level=="Trade School") {echo 'selected="selected"';}?> value="Trade School">Trade School</option>
							<option id="Undergraduate" <?php if($check4){echo set_select('ym_degree_level','Undergraduate');} elseif($query4->ym_degree_level=="Undergraduate") {echo 'selected="selected"';}?> value="Undergraduate">Undergraduate</option>
							    
						</select>
						<div class="error"><?php echo form_error('ym_degree_level'); ?></div>
						
					</td>
                    <td width="51%" class="txtBlack13Arial">
                    <strong>Area Of Study:<span class="err">*</span></strong><br>
                    	
						<select  class="combo" id="ym_study_area" name="ym_study_area">
                            <option value="">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM areaofstudy ORDER BY Parameter-->
							
                            <option id="Administrative Services" <?php if($check4){echo set_select('ym_study_area','Administrative Services');} elseif($query4->ym_study_area=="Administrative Services") {echo 'selected="selected"';}?> value="Administrative Services">Administrative Services</option>
							<option id="Advertising / Marketing" <?php if($check4){echo set_select('ym_study_area','Advertising / Marketing');} elseif($query4->ym_study_area=="Advertising / Marketing") {echo 'selected="selected"';}?> value="Advertising / Marketing">Advertising / Marketing</option>
							<option id="Architecture" <?php if($check4){echo set_select('ym_study_area','Architecture');} elseif($query4->ym_study_area=="Architecture") {echo 'selected="selected"';}?> value="Architecture">Architecture</option>
							<option id="Armed Forces" <?php if($check4){echo set_select('ym_study_area','Armed Forces');} elseif($query4->ym_study_area=="Armed Forces") {echo 'selected="selected"';}?> value="Armed Forces">Armed Forces</option>
							<option id="Arts" <?php if($check4){echo set_select('ym_study_area','Arts');} elseif($query4->ym_study_area=="Arts") {echo 'selected="selected"';}?> value="Arts">Arts</option>
							<option id="Commerce" <?php if($check4){echo set_select('ym_study_area','Commerce');} elseif($query4->ym_study_area=="Commerce") {echo 'selected="selected"';}?> value="Commerce">Commerce</option>
							<option id="Education" <?php if($check4){echo set_select('ym_study_area','Education');} elseif($query4->ym_study_area=="Education") {echo 'selected="selected"';}?> value="Education">Education</option>
							<option id="Engineering / Technology/ Computers/ IT" <?php if($check4){echo set_select('ym_study_area','Engineering / Technology/ Computers/ IT');} elseif($query4->ym_study_area=="Engineering / Technology/ Computers/ IT") {echo 'selected="selected"';}?> value="Engineering / Technology/ Computers/ IT">Engineering / Technology/ Computers/ IT</option>
							<option id="Fashion" <?php if($check4){echo set_select('ym_study_area','Fashion');} elseif($query4->ym_study_area=="Fashion") {echo 'selected="selected"';}?> value="Fashion">Fashion</option>
							<option id="Finance" <?php if($check4){echo set_select('ym_study_area','Finance');} elseif($query4->ym_study_area=="Finance") {echo 'selected="selected"';}?> value="Finance">Finance</option>
							<option id="Fine Arts" <?php if($check4){echo set_select('ym_study_area','Fine Arts');} elseif($query4->ym_study_area=="Fine Arts") {echo 'selected="selected"';}?> value="Fine Arts">Fine Arts</option>
							<option id="Home Science" <?php if($check4){echo set_select('ym_study_area','Home Science');} elseif($query4->ym_study_area=="Home Science") {echo 'selected="selected"';}?> value="Home Science">Home Science</option>
							<option id="Law" <?php if($check4){echo set_select('ym_study_area','Law');} elseif($query4->ym_study_area=="Law") {echo 'selected="selected"';}?> value="Law">Law</option>
							<option id="Management" <?php if($check4){echo set_select('ym_study_area','Management');} elseif($query4->ym_study_area=="Management") {echo 'selected="selected"';}?> value="Management">Management</option>
							<option id="Medicine" <?php if($check4){echo set_select('ym_study_area','');} elseif($query4->ym_study_area=="Medicine") {echo 'selected="selected"';}?> value="Medicine">Medicine</option>
							<option id="Nursing / Health Sciences" <?php if($check4){echo set_select('ym_study_area','Nursing / Health Sciences');} elseif($query4->ym_study_area=="Nursing / Health Sciences") {echo 'selected="selected"';}?> value="Nursing / Health Sciences">Nursing / Health Sciences</option>
							<option id="Office Administration" <?php if($check4){echo set_select('ym_study_area','Office Administration');} elseif($query4->ym_study_area=="Office Administration") {echo 'selected="selected"';}?> value="Office Administration">Office Administration</option>
							<option id="Science" <?php if($check4){echo set_select('ym_study_area','Science');} elseif($query4->ym_study_area=="Science") {echo 'selected="selected"';}?> value="Science">Science</option>
							     
						</select> 
						<div class="error"><?php echo form_error('ym_study_area'); ?></div>
						    
                   </td>
                </tr>
			
               	<tr>
               	<td>&nbsp;</td>
               	<td align="left" colspan="3" class="BlueNormal13"><strong>Example for Education in detail:</strong> MS in Electrical Engineering.    </td>
               	</tr>
				
                <tr>
                   <td width="33%" align="right" class="txtBlack13Arial" style="padding-bottom:15px"><strong>Education In Detail</strong></td>
                   <td class="txtBlack13Arial" colspan="2"><input type="text" value="<?php if(!$check4) echo $query4->ym_education_detail; ?>" class="textBox_Admin input-wi-2" id="ym_education_detail" name="ym_education_detail"></td>
                </tr>
				
                <tr>
                    <td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Occupation <span class="err">*</span></strong></td>
                    <td class="txtBlack13Arial" colspan="2">
					
                    	<select  class="combo" id="ym_occupation" name="ym_occupation">
                            <option value="">Select</option>
							
                            <!--SELECT Parameter,ParameterID FROM occupationarea ORDER BY Parameter-->
							
							<option id="Accounts / Finance / Tax / CS / Audit" <?php if($check4){echo set_select('ym_occupation','Accounts / Finance / Tax / CS / Audit');} elseif($query4->ym_occupation=="Accounts / Finance / Tax / CS / Audit") {echo 'selected="selected"';}?> value="Accounts / Finance / Tax / CS / Audit">Accounts / Finance / Tax / CS / Audit</option>
							<option id="Advertising / Mass Communication" <?php if($check4){echo set_select('ym_occupation','Advertising / Mass Communication');} elseif($query4->ym_occupation=="Advertising / Mass Communication") {echo 'selected="selected"';}?> value="Advertising / Mass Communication">Advertising / Mass Communication</option>
							<option id="Agriculture" <?php if($check4){echo set_select('ym_occupation','Agriculture');} elseif($query4->ym_occupation=="Agriculture") {echo 'selected="selected"';}?> value="Agriculture">Agriculture</option>
							<option id="Anthropology" <?php if($check4){echo set_select('ym_occupation','Anthropology');} elseif($query4->ym_occupation=="Anthropology") {echo 'selected="selected"';}?> value="Anthropology">Anthropology</option>
							<option id="Architecture / Interior Design" <?php if($check4){echo set_select('ym_occupation','Architecture / Interior Design');} elseif($query4->ym_occupation=="Architecture / Interior Design") {echo 'selected="selected"';}?> value="Architecture / Interior Design">Architecture / Interior Design</option>
							<option id="Armed Forces" <?php if($check4){echo set_select('ym_occupation','Armed Forces');} elseif($query4->ym_occupation=="Armed Forces") {echo 'selected="selected"';}?> value="Armed Forces">Armed Forces</option>
							<option id="Arts &amp; Humanities" <?php if($check4){echo set_select('ym_occupation','Arts &amp; Humanities');} elseif($query4->ym_occupation=="Arts & Humanities") {echo 'selected="selected"';}?> value="Arts &amp; Humanities">Arts & Humanities</option>
							<option id="Bio - Chemistry / Bio - Technology" <?php if($check4){echo set_select('ym_occupation','Bio - Chemistry / Bio - Technology');} elseif($query4->ym_occupation=="Bio - Chemistry / Bio - Technology") {echo 'selected="selected"';}?> value="Bio - Chemistry / Bio - Technology">Bio - Chemistry / Bio - Technology</option>
							<option id="Biomedical" <?php if($check4){echo set_select('ym_occupation','Biomedical');} elseif($query4->ym_occupation=="Biomedical") {echo 'selected="selected"';}?> value="Biomedical">Biomedical</option>
							<option id="Biotechnology" <?php if($check4){echo set_select('ym_occupation','Biotechnology');} elseif($query4->ym_occupation=="Biotechnology") {echo 'selected="selected"';}?> value="Biotechnology">Biotechnology</option>
							<option id="Ceramics" <?php if($check4){echo set_select('ym_occupation','Ceramics');} elseif($query4->ym_occupation=="Ceramics") {echo 'selected="selected"';}?> value="Ceramics">Ceramics</option>
							<option id="Chemical" <?php if($check4){echo set_select('ym_occupation','Chemical');} elseif($query4->ym_occupation=="Chemical") {echo 'selected="selected"';}?> value="Chemical">Chemical</option>
							<option id="Chemistry" <?php if($check4){echo set_select('ym_occupation','Chemistry');} elseif($query4->ym_occupation=="Chemistry") {echo 'selected="selected"';}?> value="Chemistry">Chemistry</option>
							<option id="Civil" <?php if($check4){echo set_select('ym_occupation','Civil');} elseif($query4->ym_occupation=="Civil") {echo 'selected="selected"';}?> value="Civil">Civil</option>
							<option id="Commerce" <?php if($check4){echo set_select('ym_occupation','Commerce');} elseif($query4->ym_occupation=="Commerce") {echo 'selected="selected"';}?> value="Commerce">Commerce</option>
							<option id="Communication" <?php if($check4){echo set_select('ym_occupation','Communication');} elseif($query4->ym_occupation=="Communication") {echo 'selected="selected"';}?> value="Communication">Communication</option>
							<option id="Computers / IT" <?php if($check4){echo set_select('ym_occupation','Computers / IT');} elseif($query4->ym_occupation=="Computers / IT") {echo 'selected="selected"';}?> value="Computers / IT">Computers / IT</option>
							<option id="Dermatology" <?php if($check4){echo set_select('ym_occupation','Dermatology');} elseif($query4->ym_occupation=="Dermatology") {echo 'selected="selected"';}?> value="Dermatology">Dermatology</option>
							<option id="Diary Technology" <?php if($check4){echo set_select('ym_occupation','Diary Technology');} elseif($query4->ym_occupation=="Diary Technology") {echo 'selected="selected"';}?> value="Diary Technology">Diary Technology</option>
							<option id="Education" <?php if($check4){echo set_select('ym_occupation','Education');} elseif($query4->ym_occupation=="Education") {echo 'selected="selected"';}?> value="Education">Education</option>
							<option id="Engineering / Technology" <?php if($check4){echo set_select('ym_occupation','Engineering / Technology');} elseif($query4->ym_occupation=="Engineering / Technology") {echo 'selected="selected"';}?> value="Engineering / Technology">Engineering / Technology</option>
							<option id="ENT" <?php if($check4){echo set_select('ym_occupation','ENT');} elseif($query4->ym_occupation=="ENT") {echo 'selected="selected"';}?> value="ENT">ENT</option>
							<option id="Environmental" <?php if($check4){echo set_select('ym_occupation','Environmental');} elseif($query4->ym_occupation=="Environmental") {echo 'selected="selected"';}?> value="Environmental">Environmental</option>
							<option id="Fashion / Garments / Other Designing" <?php if($check4){echo set_select('ym_occupation','Fashion / Garments / Other Designing');} elseif($query4->ym_occupation=="Fashion / Garments / Other Designing") {echo 'selected="selected"';}?> value="Fashion / Garments / Other Designing">Fashion / Garments / Other Designing</option>
							<option id="Finance" <?php if($check4){echo set_select('ym_occupation','Finance');} elseif($query4->ym_occupation=="Finance") {echo 'selected="selected"';}?> value="Finance">Finance</option>
							<option id="Fine Arts" <?php if($check4){echo set_select('ym_occupation','Fine Arts');} elseif($query4->ym_occupation=="Fine Arts") {echo 'selected="selected"';}?> value="Fine Arts">Fine Arts</option>
							<option id="History" <?php if($check4){echo set_select('ym_occupation','History');} elseif($query4->ym_occupation=="History") {echo 'selected="selected"';}?> value="History">History</option>
							<option id="Home Science" <?php if($check4){echo set_select('ym_occupation','Home Science');} elseif($query4->ym_occupation=="Home Science") {echo 'selected="selected"';}?> value="Home Science">Home Science</option>
							<option id="Hotel Management" <?php if($check4){echo set_select('ym_occupation','Hotel Management');} elseif($query4->ym_occupation=="Hotel Management") {echo 'selected="selected"';}?> value="Hotel Management">Hotel Management</option>
							<option id="HR / Industrial Relations" <?php if($check4){echo set_select('ym_occupation','HR / Industrial Relations');} elseif($query4->ym_occupation=="HR / Industrial Relations") {echo 'selected="selected"';}?> value="HR / Industrial Relations">HR / Industrial Relations</option>
							<option id="Immunology" <?php if($check4){echo set_select('ym_occupation','Immunology');} elseif($query4->ym_occupation=="Immunology") {echo 'selected="selected"';}?> value="Immunology">Immunology</option>
							<option id="Instrumentation" <?php if($check4){echo set_select('ym_occupation','Instrumentation');} elseif($query4->ym_occupation=="Instrumentation") {echo 'selected="selected"';}?> value="Instrumentation">Instrumentation</option>
							<option id="International Business" <?php if($check4){echo set_select('ym_occupation','International Business');} elseif($query4->ym_occupation=="International Business") {echo 'selected="selected"';}?> value="International Business">International Business</option>
							<option id="Journalism" <?php if($check4){echo set_select('ym_occupation','Journalism');} elseif($query4->ym_occupation=="Journalism") {echo 'selected="selected"';}?> value="Journalism">Journalism</option>
							<option id="Law" <?php if($check4){echo set_select('ym_occupation','Law');} elseif($query4->ym_occupation=="Law") {echo 'selected="selected"';}?> value="Law">Law</option>
							<option id="Literature" <?php if($check4){echo set_select('ym_occupation','Literature');} elseif($query4->ym_occupation=="Literature") {echo 'selected="selected"';}?> value="Literature">Literature</option>
							<option id="Marine" <?php if($check4){echo set_select('ym_occupation','Marine');} elseif($query4->ym_occupation=="Marine") {echo 'selected="selected"';}?> value="Marine">Marine</option>
							<option id="Marketing" <?php if($check4){echo set_select('ym_occupation','Marketing');} elseif($query4->ym_occupation=="Marketing") {echo 'selected="selected"';}?> value="Marketing">Marketing</option>
							<option id="Maths" <?php if($check4){echo set_select('ym_occupation','Maths');} elseif($query4->ym_occupation=="India") {echo 'selected="selected"';}?> value="Maths">Maths</option>
							<option id="Mechanical" <?php if($check4){echo set_select('ym_occupation','Mechanical');} elseif($query4->ym_occupation=="Mechanical") {echo 'selected="selected"';}?> value="Mechanical">Mechanical</option>
							<option id="Medicine" <?php if($check4){echo set_select('ym_occupation','Medicine');} elseif($query4->ym_occupation=="Medicine") {echo 'selected="selected"';}?> value="Medicine">Medicine</option>
							<option id="Microbiology" <?php if($check4){echo set_select('ym_occupation','Microbiology');} elseif($query4->ym_occupation=="Microbiology") {echo 'selected="selected"';}?> value="Microbiology">Microbiology</option>
							<option id="Mineral" <?php if($check4){echo set_select('ym_occupation','Mineral');} elseif($query4->ym_occupation=="Mineral") {echo 'selected="selected"';}?> value="Mineral">Mineral</option>
							<option id="Mining" <?php if($check4){echo set_select('ym_occupation','Mining');} elseif($query4->ym_occupation=="Mining") {echo 'selected="selected"';}?> value="Mining">Mining</option>
							<option id="Neonatal" <?php if($check4){echo set_select('ym_occupation','Neonatal');} elseif($query4->ym_occupation=="Neonatal") {echo 'selected="selected"';}?> value="Neonatal">Neonatal</option>
							<option id="Nuclear" <?php if($check4){echo set_select('ym_occupation','Nuclear');} elseif($query4->ym_occupation=="Nuclear") {echo 'selected="selected"';}?> value="Nuclear">Nuclear</option>
							<option id="Obstretrics" <?php if($check4){echo set_select('ym_occupation','Obstretrics');} elseif($query4->ym_occupation=="Obstretrics") {echo 'selected="selected"';}?> value="Obstretrics">Obstretrics</option>
							<option id="Other Arts" <?php if($check4){echo set_select('ym_occupation','Other Arts');} elseif($query4->ym_occupation=="Other Arts") {echo 'selected="selected"';}?> value="Other Arts">Other Arts</option>
							<option id="Other Doctorate" <?php if($check4){echo set_select('ym_occupation','Other Doctorate');} elseif($query4->ym_occupation=="Other Doctorate") {echo 'selected="selected"';}?> value="Other Doctorate">Other Doctorate</option> 
							<option id="Other Engineering" <?php if($check4){echo set_select('ym_occupation','Other Engineering');} elseif($query4->ym_occupation=="Other Engineering") {echo 'selected="selected"';}?> value="Other Engineering">Other Engineering</option>
							<option id="Other Management" <?php if($check4){echo set_select('ym_occupation','Other Management');} elseif($query4->ym_occupation=="Other Management") {echo 'selected="selected"';}?> value="Other Management">Other Management</option>
							<option id="Other Science" <?php if($check4){echo set_select('ym_occupation','Other Science');} elseif($query4->ym_occupation=="Other Science") {echo 'selected="selected"';}?> value="Other Science">Other Science</option>
							<option id="Others" <?php if($check4){echo set_select('ym_occupation','Others');} elseif($query4->ym_occupation=="Others") {echo 'selected="selected"';}?> value="Others">Others</option>
							<option id="Paint / Oil" <?php if($check4){echo set_select('ym_occupation','Paint / Oil');} elseif($query4->ym_occupation=="Paint / Oil") {echo 'selected="selected"';}?> value="Paint / Oil">Paint / Oil</option>
							<option id="Pathology" <?php if($check4){echo set_select('ym_occupation','Pathology');} elseif($query4->ym_occupation=="Pathology") {echo 'selected="selected"';}?> value="Pathology">Pathology</option>
							<option id="Pediatrics" <?php if($check4){echo set_select('ym_occupation','Pediatrics');} elseif($query4->ym_occupation=="Pediatrics") {echo 'selected="selected"';}?> value="Pediatrics">Pediatrics</option>
							<option id="Petroleum" <?php if($check4){echo set_select('ym_occupation','Petroleum');} elseif($query4->ym_occupation=="Petroleum") {echo 'selected="selected"';}?> value="Petroleum">Petroleum</option>
							<option id="Pharmacy" <?php if($check4){echo set_select('ym_occupation','Pharmacy');} elseif($query4->ym_occupation=="Pharmacy") {echo 'selected="selected"';}?> value="Pharmacy">Pharmacy</option>
							<option id="Physics" <?php if($check4){echo set_select('ym_occupation','Physics');} elseif($query4->ym_occupation=="Physics") {echo 'selected="selected"';}?> value="Physics">Physics</option>
							<option id="Plastics" <?php if($check4){echo set_select('ym_occupation','Plastics');} elseif($query4->ym_occupation=="Plastics") {echo 'selected="selected"';}?> value="Plastics">Plastics</option>
							<option id="Production / Industrial" <?php if($check4){echo set_select('ym_occupation','Production / Industrial');} elseif($query4->ym_occupation=="Production / Industrial") {echo 'selected="selected"';}?> value="Production / Industrial">Production / Industrial</option>
							<option id="Psychiatry" <?php if($check4){echo set_select('ym_occupation','Psychiatry');} elseif($query4->ym_occupation=="Psychiatry") {echo 'selected="selected"';}?> value="Psychiatry">Psychiatry</option>
							<option id="Psychology" <?php if($check4){echo set_select('ym_occupation','Psychology');} elseif($query4->ym_occupation=="Psychology") {echo 'selected="selected"';}?> value="Psychology">Psychology</option>
							<option id="Rheumatology" <?php if($check4){echo set_select('ym_occupation','Rheumatology');} elseif($query4->ym_occupation=="Rheumatology") {echo 'selected="selected"';}?> value="Rheumatology">Rheumatology</option>
							<option id="Sanskrit" <?php if($check4){echo set_select('ym_occupation','Sanskrit');} elseif($query4->ym_occupation=="Sanskrit") {echo 'selected="selected"';}?> value="Sanskrit">Sanskrit</option>
							<option id="Sociology" <?php if($check4){echo set_select('ym_occupation','Sociology');} elseif($query4->ym_occupation=="Sociology") {echo 'selected="selected"';}?> value="Sociology">Sociology</option>
							<option id="Statistics" <?php if($check4){echo set_select('ym_occupation','Statistics');} elseif($query4->ym_occupation=="Statistics") {echo 'selected="selected"';}?> value="Statistics">Statistics</option>
							<option id="Systems" <?php if($check4){echo set_select('ym_occupation','Systems');} elseif($query4->ym_occupation=="Systems") {echo 'selected="selected"';}?> value="Systems">Systems</option>
							<option id="Textile" <?php if($check4){echo set_select('ym_occupation','Textile');} elseif($query4->ym_occupation=="Textile") {echo 'selected="selected"';}?> value="Textile">Textile</option>
							<option id="Vocational Courses" <?php if($check4){echo set_select('ym_occupation','Vocational Courses');} elseif($query4->ym_occupation=="Vocational Courses") {echo 'selected="selected"';}?> value="Vocational Courses">Vocational Courses</option>                        
							                       
						</select>   
						<div class="error"><?php echo form_error('ym_occupation'); ?></div>
						                 
					</td>
					
                </tr>
				
                <tr>
                <td>&nbsp;</td>
                <td align="left" colspan="3" class="BlueNormal13"><strong>Example for Occupation In Detail:</strong> Software Programmer in Omsai LLC.</td>
               	</tr>
				
                 <tr>
                   <td width="33%" align="right" class="txtBlack13Arial labelup"><strong>Occupation In Detail:</strong></td>
                   <td class="txtBlack13Arial" colspan="2"><input type="text" value="<?php if(!$check4) { echo $query4->ym_occupation_detail; } ?>" class="textBox_Admin input-wi-2" id="ym_occupation_detail" name="ym_occupation_detail"></td>
                </tr>
				
                <tr>
                   <td width="33%" valign="top" align="right" class="txtBlack13Arial labeldown"><strong>Annual Income</strong></td>
                   <td class="BlueNormal13" colspan="2"><input type="text" value="<?php if(!$check4) echo $query4->ym_annual_income; ?>" class="textBox_Admin" id="ym_annual_income" name="ym_annual_income">
				   			
						<!--added by dharati 201309251510-->
				   		<div class="error"><?php echo form_error('ym_annual_income'); ?></div>
						<!--end-->
						
				   		<br>
                   		<strong>Example:</strong> 100,000 IRS/year.
                   </td>
                </tr>
				
                <tr>
              		<td></td>
           	 		<td align="left" colspan="2">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update4" name="ym_update4">&nbsp;
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel"></td>
   			 	</tr>
				
          		</tbody>
				
				</table>
				
				<?php echo form_close();?>
				
              </div>
			  
			  <!----------end of education and profession info tab------------->
			  
			  
			  <!---------- life style tab-------------->
			  
              <div id="tabs-5">
			  
			  	<?php
                	$form_attributes = array('id' => 'myform5');
                	echo form_open('', $form_attributes);
           	  	?>
			  
               	<table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
    			
				<tbody>
				
				<tr bgcolor="#E6E6E6">
        			<td class="SubTitle BorderBtm" colspan="2">Life Style </td>
    			</tr>
    
				<tr>
        			<td align="center" colspan="2"></td>
    			</tr>
    			
				<tr>
				  	<td colspan="2">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg5'); $this->session->unset_userdata('tab_msg5');?>		
						</div>
					</td>
				</tr>
				
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong>Diet Preferences <span class="err">*</span> </strong></td>
        			<td class="txtBlack13Arial">
			            <input type="radio" <?php if($check5){ echo set_radio('ym_diet_preferences','Vegetarian');} elseif($query5->ym_diet_preferences=="Vegetarian") {echo 'checked="checked"'; }?> value="Vegetarian" id="ym_diet_preferences_v" name="ym_diet_preferences" style="margin:0 2px 0 0 ;">Vegetarian
			            <input type="radio" <?php if($check5){ echo set_radio('ym_diet_preferences','Non Vegetarian');} elseif($query5->ym_diet_preferences=="Non Vegetarian") {echo 'checked="checked"'; }?> value="Non Vegetarian" id="ym_diet_preferences_nv" name="ym_diet_preferences" style="margin:0 2px 0 15px ;">Non Vegetarian
			            <input type="radio" <?php if($check5){ echo set_radio('ym_diet_preferences','Eggarian');} elseif($query5->ym_diet_preferences=="Eggarian") {echo 'checked="checked"'; }?> value="Eggarian" id="ym_diet_preferences_e" name="ym_diet_preferences" style="margin:0 2px 0 15px ;">Eggarian
			            <input type="radio" <?php if($check5){ echo set_radio('ym_diet_preferences','Occasionally Non-Veg');} elseif($query5->ym_diet_preferences=="Occasionally Non-Veg") {echo 'checked="checked"'; }?> value="Occasionally Non-Veg" id="ym_diet_preferences_o" name="ym_diet_preferences" style="margin:0 2px 0 15px ;">Occasionally Non-Veg
						<div class="error"><?php echo form_error('ym_diet_preferences'); ?></div>
        			</td>
					
    			</tr>
				
			    <tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Smoking <span class="err">*</span> </strong></td>
			        <td class="txtBlack13Arial">
			            <input type="radio" <?php if($check5){echo set_radio('ym_smoking','No');} elseif($query5->ym_smoking=="No") {echo 'checked="checked"'; }?> value="No" id="ym_smoking_n" name="ym_smoking" style="margin:0 2px 0 0 ;">No
			            <input type="radio" <?php if($check5){echo set_radio('ym_smoking','Yes');} elseif($query5->ym_smoking=="Yes") {echo 'checked="checked"'; }?> value="Yes" id="ym_smoking_y" name="ym_smoking" style="margin:0 2px 0 15px ;">Yes
			            <input type="radio" <?php if($check5){echo set_radio('ym_smoking','Occasionally');} elseif($query5->ym_smoking=="Occasionally") {echo 'checked="checked"'; }?> value="Occasionally" id="ym_smoking_o" name="ym_smoking" style="margin:0 2px 0 15px ;">Occasionally
						<div class="error"><?php echo form_error('ym_smoking'); ?></div>
			        </td>
					
			    </tr>
    
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Drinking <span class="err">*</span> </strong></td>
			        <td class="txtBlack13Arial">
			            <input type="radio" <?php if($check5){echo set_radio('ym_drinking','No');} elseif($query5->ym_drinking=="No") {echo 'checked="checked"'; }?> value="No" id="ym_drinking_n" name="ym_drinking" style="margin:0 2px 0 0 ;">No
			            <input type="radio" <?php if($check5){echo set_radio('ym_drinking','Yes');} elseif($query5->ym_drinking=="Yes") {echo 'checked="checked"'; }?> value="Yes" id="ym_drinking_y" name="ym_drinking" style="margin:0 2px 0 15px ;">Yes
			            <input type="radio" <?php if($check5){echo set_radio('ym_drinking','Occasionally');} elseif($query5->ym_drinking=="Occasionally") {echo 'checked="checked"'; }?> value="Occasionally" id="ym_drinking_o" name="ym_drinking" style="margin:0 2px 0 15px ;">Occasionally
						<div class="error"><?php echo form_error('ym_drinking'); ?></div>
			        </td>
					
			    </tr>
				
			    <tr>
			        <td></td>
			        <td align="left">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update5" name="ym_update5">&nbsp;	
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel">
					</td>
			    </tr>
				
				</tbody>
				
				</table>
				
				<?php echo form_close();?>
				
              </div>
			  
			  <!---------------end of life style tab----------------->
			  
			  <!------------------location contact info tab-------------------->
			  
              <div id="tabs-6">
			  
			  	<?php
                	$form_attributes = array('id' => 'myform6');
                	echo form_open('', $form_attributes);
           	  	?>
			  
                <table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
    			
				<tbody>
				
				<tr bgcolor="#E6E6E6">
        			<td class="SubTitle BorderBtm" colspan="4">Location / Contact Information</td>
    			</tr>
     			
				<tr>
			        <td align="center" colspan="4"></td>
			    </tr>
    
				<tr>
				  	<td colspan="4">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg6'); $this->session->unset_userdata('tab_msg6');?>		
						</div>
					</td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Citizen Of <span class="err">*</span></strong></td>
			        <td width="24%" align="left" class="txtBlack13Arial">
					<!-------------------updated by dharati 201310011500----------------------->
	        			<select class="combo" id="ym_citizen_country" name="ym_citizen_country">
	                		<option value="">Country</option>
							
							<?php

								$get_country = $this->dbyouthmilan->country();
								
								foreach($get_country as $row)

								{
								?>
									<option <?php if($check6){echo set_select('ym_citizen_country','<?php echo $row->countryid; ?>');} else if($query6->ym_citizen_country==$row->countryid) {echo 'selected="selected"';}?> value="<?php echo $row->countryid; ?>"><?php echo $row->countryname; ?></option>
								<?php }
								
								?>
							
	                		<!--SELECT CountryName,CountryID FROM country ORDER BY CountryName-->
					
							<!--<option id="India" <?php if($check6){echo set_select('ym_citizen_country','India');} elseif($query6->ym_citizen_country=="India") {echo 'selected="selected"';}?> value="India">India</option>
							<option id="United Kingdom" <?php if($check6){echo set_select('ym_citizen_country','United Kingdom');} elseif($query6->ym_citizen_country=="United Kingdom") {echo 'selected="selected"';}?> value="United Kingdom">United Kingdom</option>
							<option id="United State" <?php if($check6){echo set_select('ym_citizen_country','United State');} elseif($query6->ym_citizen_country=="United State") {echo 'selected="selected"';}?> value="United State">United State</option> -->       
						</select>
						
						<span id="mm_state_id_loading1" class="loading" style="display:none;display:inline-table"></span>
						
						<div class="error"><?php echo form_error('ym_citizen_country'); ?></div>
					
					</td>
        			<td width="22%" align="left" class="txtBlack13Arial">
        			
						<select style="width:150px;" class="combo" id="ym_citizen_state" name="ym_citizen_state">
	                		<option value="">State</option>
							
	                		<!--SELECT StateName,StateID FROM state Where CountryID=2 ORDER BY StateName-->
					
							<!--<option id="Gujrat" <?php if($check6){echo set_select('ym_citizen_state','Gujrat');} elseif($query6->ym_citizen_state=="Gujrat") {echo 'selected="selected"';}?> value="Gujrat">Gujrat</option> 
							<option id="Maharashtra" <?php if($check6){echo set_select('ym_citizen_state','Maharashtra');} elseif($query6->ym_citizen_state=="Maharashtra") {echo 'selected="selected"';}?> value="Maharashtra">Maharashtra</option>
							<option id="Rajasthan" <?php if($check6){echo set_select('ym_citizen_state','Rajasthan');} elseif($query6->ym_citizen_state=="Rajasthan") {echo 'selected="selected"';}?> value="Rajasthan">Rajasthan</option>      -->
					 	</select>
						<div class="error"><?php echo form_error('ym_citizen_state'); ?></div>   
				
	                 </td>
        			<td width="23%" align="left" class="txtBlack13Arial">
        				<input type="text" value="<?php if(!$check6){ echo $query6->ym_citizen_city; } else { echo set_value('ym_citizen_city');}?>" class="textBox_Admin" id="ym_citizen_city" name="ym_citizen_city" style="width:150px;" placeholder="City" >
						
			        	<!--<select name="CitizenCityID" id="CitizenCityID" class="combo" style="width:150px;">
			                <option value="0">Select</option>
			                SELECT CityName,CityID FROM city Where StateID=1 ORDER BY CityName<Option Value='2'>Ahmedabad</Option><Option Value='5'>Baroda</Option><Option Value='1'>Bhavnagar</Option><Option Value='4'>Rajkot</Option><Option Value='3'>Surat</Option>      </select>--> 
						<div class="error"><?php echo form_error('ym_citizen_city'); ?></div>                       
					</td>
    			</tr>
    			
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Living In <span class="err">*</span></strong></td>
        			<td align="left" class="txtBlack13Arial">
        				
						<select id="ym_living_country" name="ym_living_country">
			                <option value="">Country</option>
							
							
							<?php

								$get_country = $this->dbyouthmilan->country();
								
								foreach($get_country as $row)

								{
								?>
									<option <?php if($check6){echo set_select('ym_living_country','<?php echo $row->countryid; ?>');} else if($query6->ym_living_country==$row->countryid) {echo 'selected="selected"';}?> value="<?php echo $row->countryid; ?>"><?php echo $row->countryname; ?></option>
								<?php }
								
								?>
			                <!--SELECT CountryName,CountryID FROM country ORDER BY CountryName-->
							
							<!--<option id="India" <?php if($check6){echo set_select('ym_living_country','India');} elseif($query6->ym_living_country=="India") {echo 'selected="selected"';}?> value="India">India</option>
							<option id="United Kingdom" <?php if($check6){echo set_select('ym_living_country','United Kingdom');} elseif($query6->ym_living_country=="United Kingdom") {echo 'selected="selected"';}?> value="United Kingdom">United Kingdom</option>
							<option id="United State" <?php if($check6){echo set_select('ym_living_country','United State');} elseif($query6->ym_living_country=="United State") {echo 'selected="selected"';}?> value="United State">United State</option>--> 
				  		</select>
						
							<span id="mm_state_id_loading" class="loading" style="display:none;display:inline-table"></span>
						
						<div class="error"><?php echo form_error('ym_living_country'); ?></div>
						
					</td>
        			<td align="left" class="txtBlack13Arial">
        				
						<select style="width:150px;" class="combo" id="ym_living_state" name="ym_living_state">
			                <option value="">Select</option>
			                
							<!--SELECT StateName,StateID FROM state Where CountryID=2 ORDER BY StateName-->
							
							<!--<option id="Gujrat" <?php if($check6){echo set_select('ym_living_state','Gujrat');} elseif($query6->ym_living_state=="Gujrat") {echo 'selected="selected"';}?> value="Gujrat">Gujrat</option>
							<option id="Maharashtra" <?php if($check6){echo set_select('ym_living_state','Maharashtra');} elseif($query6->ym_living_state=="Maharashtra") {echo 'selected="selected"';}?> value="Maharashtra">Maharashtra</option>
							<option id="Rajasthan" <?php if($check6){echo set_select('ym_living_state','Rajasthan');} elseif($query6->ym_living_state=="Rajasthan") {echo 'selected="selected"';}?> value="Rajasthan">Rajasthan</option>      -->        
      					</select> 
						<!---------------end 201310011500---------------->
						<div class="error"><?php echo form_error('ym_living_state'); ?></div>                 
						
				  	</td>
        			<td align="left" class="txtBlack13Arial">
        				<input type="text" value="<?php if(!$check6) {echo $query6->ym_living_city;}else{echo set_value('ym_living_city');} ?>" class="textBox_Admin" id="ym_living_city" name="ym_living_city" style="width:150px;" placeholder="City" >
						
				       <!-- <select name="LivingCityID" id="LivingCityID" class="combo" style="width:150px;">
				                <option value="0">Select</option>
				                SELECT CityName,CityID FROM city Where StateID=1 ORDER BY CityName<Option Value='2'>Ahmedabad</Option><Option Value='5'>Baroda</Option><Option Value='1'>Bhavnagar</Option><Option Value='4'>Rajkot</Option><Option Value='3'>Surat</Option>      </select>  -->  
						<div class="error"><?php echo form_error('ym_living_city'); ?></div>                    
					</td>
    			</tr>
			
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Living Status <span class="err">*</span></strong></td>
        			<td class="txtBlack13Arial" colspan="3">
         				
						<select class="combo" id="ym_living_status" name="ym_living_status">
                			<option value="">Select</option>
							
                			<!--SELECT Parameter,ParameterID FROM livingstatus ORDER BY Parameter-->
				
							<option id="citizen" <?php if($check6){echo set_select('ym_living_status','citizen');} elseif($query6->ym_living_status=="citizen") {echo 'selected="selected"';}?> value="citizen">citizen</option>
							<option id="permanent resident" <?php if($check6){echo set_select('ym_living_status','permanent resident');} elseif($query6->ym_living_status=="permanent resident") {echo 'selected="selected"';}?> value="permanent resident">permanent resident</option>
							<option id="student visa" <?php if($check6){echo set_select('ym_living_status','student visa');} elseif($query6->ym_living_status=="student visa") {echo 'selected="selected"';}?> value="student visa">student visa</option>
							<option id="temporary visa" <?php if($check6){echo set_select('ym_living_status','temporary visa');} elseif($query6->ym_living_status=="temporary visa") {echo 'selected="selected"';}?> value="temporary visa">temporary visa</option>
							<option id="work permit" <?php if($check6){echo set_select('ym_living_status','work permit');} elseif($query6->ym_living_status=="work permit") {echo 'selected="selected"';}?> value="work permit">work permit</option>
</select>    
						</select>
						<div class="error"><?php echo form_error('ym_living_status'); ?></div>
						
					</td>
    			</tr>
    			
				<!-------------updated by dharati 201309261200------------->
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Contact Address</strong></td>
       				<td class="txtBlack13Arial" colspan="3"><textarea class="textarea" id="ym_address" name="ym_address"><?php if(!$check6) echo $query6->ym_address; else echo $query8->mm_address; ?></textarea></td>
    			</tr>
    
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Contact Phone Number</strong></td>
        			<td class="txtBlack13Arial">
            			<input type="text" class="textBox_Admin" value="<?php if(!$check6) echo $query6->ym_phone; else echo $query8->mm_hphone; ?>" id="ym_phone" name="ym_phone"> 
						<div class="error"><?php echo form_error('ym_phone'); ?></div>                 
					</td>
        			<!--<td class="txtBlack13Arial" colspan="2">Format : nnn-nnn-nnnn</td>-->
    			</tr>
    			
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Email</strong></td>
			        <td class="txtBlack13Arial">
			            <input type="text" class="textBox_Admin" value="<?php if(!$check6) echo $query6->ym_email; else echo $query8->mm_email; ?>" id="ym_email" name="ym_email"> 
						
					<!---------end----------->
					
						<!----added by dharati 201309251500-->
						
						<div class="error"><?php echo form_error('ym_email'); ?></div>
						 
						<!--end-->                
					</td>
        			<td class="txtBlack13Arial labelup" colspan="2">Example : vishal@yahoo.com</td>
    			</tr>
    
				<tr>
        			<td></td>
        			<td align="left" colspan="3">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update6" name="ym_update6">&nbsp;	
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel">
					</td>
    			</tr>
				
				</tbody>
				
				</table>
				
				<?php echo form_close();?>
				
              </div>
			  
			  <!----------------------end of location contact info tab------------------------>
			  
			  <!------------------brief info tab------------------->
			  
              <div id="tabs-7">
			  
			  	<?php
                	$form_attributes = array('id' => 'myform7');
                	echo form_open_multipart('', $form_attributes);
           	  	?>
			  
               	<table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
  
  				<tbody>
				
				<tr bgcolor="#E6E6E6">
        			<td class="SubTitle BorderBtm" colspan="3">Brief About Yourself</td>
    			</tr>
    
				<tr>
        			<td align="center" colspan="2"></td>
    			</tr>
    
				<tr>
				  	<td colspan="2">
						<!-----------------added by dharati 201309301800------------------>
						<div style="color: #B94A48"><?php foreach ($error as $err){if(is_array($err)){foreach($err as $er){ echo $er;}}}?></div>
						<!--------------end---------------->
						<div class="sucess">
						<?php echo $this->session->userdata('tab_msg7'); $this->session->unset_userdata('tab_msg7');?>		
						</div>
					</td>
				</tr>
	
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial labelup"><strong>Brief of About Yourself</strong></td>
       				<td class="txtBlack13Arial" colspan="3">
						<textarea class="textarea" id="ym_brief_about_self" name="ym_brief_about_self"><?php if(!$check7) echo $query7->ym_brief_about_self; ?></textarea>
					</td>
    			</tr>
    
				<tr>
        			<td width="31%" valign="top" align="right" class="txtBlack13Arial"><strong>Upload Photo</strong></td>
      				<td class="txtBlack13Arial" colspan="3">
                 		Replace/upload Photo <br>
       					<input type="file" class="textBox_Admin" value="" id="ym_photo" name="ym_photo[]" multiple="true">
					</td>
    			</tr>
    
				<tr>
    				<td></td>
    				<td align="left">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update7" name="ym_update7">&nbsp;
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel">
					</td>
    			</tr>
				
				</tbody>
				
				</table>
				
				<?php echo form_close();?>
				
             </div>
			 
			 <!------------------end of brief info tab--------------------->
			 
			 <!---------------login info tab----------------->
			 
            <!--<div id="tabs-8">
               
			   	<?php
                	$form_attributes = array('id' => 'myform8');
                	echo form_open('', $form_attributes);
           	  	?>
			   
				<table width="100%" cellspacing="2" cellpadding="5" align="center" class="table-width">
    			
				<tbody>
				
				<tr bgcolor="#E6E6E6">
        			<td class="SubTitle BorderBtm" colspan="2">Login Information</td>
  				</tr>
   				
				<tr>
        			<td align="center" colspan="2"></td>
    			</tr>
    
				<tr>
				  	<td colspan="2">
						<div class="sucess"><?php echo $this->session->userdata('tab_msg8'); $this->session->unset_userdata('tab_msg8');?>		
						</div>
					</td>
				</tr>
	
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong>Login ID <span class="err">*</span></strong></td>
        			<td class="txtBlack13Arial">
						<input type="text" class="textBox_Admin" value="<?php echo $query8->mm_username; ?>" id="ym_login_id" name="ym_login_id">
						<div class="error"><?php echo form_error('ym_login_id'); ?></div>
					</td>					
    			</tr>
     
	 			<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong>Old Password</strong></td>
        			<td class="txtBlack13Arial">
						<input type="password" class="textBox_Admin" id="ym_password" name="ym_password" onkeyup="passwordValidation()">
						<div class="error"><?php echo form_error('ym_password'); ?></div>
					</td>
    			</tr>
				
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong> New Password</strong></td>
        			<td class="txtBlack13Arial">
						<input type="password" class="textBox_Admin" id="ym_new_password" name="ym_new_password">
						<div class="error"><?php echo form_error('ym_new_password'); ?></div>
					</td>
    			</tr>
				
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong>Confirm New Password</strong></td>
        			<td class="txtBlack13Arial">
						<input type="password" class="textBox_Admin" id="ym_confirm_new_password" name="ym_confirm_new_password">
						<div class="error"><?php echo form_error('ym_confirm_new_password'); ?></div>
					</td>
    			</tr>
     
	 			<tr>
        			<td></td>
        			<td align="left">
						<input type="submit" class="btn btn-primary" value="Update" id="ym_update8" name="ym_update8">&nbsp;
						<input type="button" onclick="window.location='index.php'" class="btn btn-danger" value="Cancel" id="Cancel" name="Cancel">
					</td>
    			</tr>
				
				</tbody>
				
				</table>
				
				<?php echo form_close();?>
				
              </div>-->
			  
			  <!--------------------end of login info tab---------------------->
			  
            </div>
			
            </td>
        </tr>
		
      </table>
      
   <!-- </div>--><!-------update_monita20131002-------->
	
    
    <div class="clearfix"></div>
 <?php $this->load->view('youth_milan/layout/footer'); ?>
 
 </div>
<!-------update_monita20131002--------> 
 <!--<style>

#content_tab

{

	display:none;

}

.stContainer {
	height:540px!important;
}

</style>-->
<!-------update_monita20131002-------->
<script>

$(document).ready(function(){

	 
	/*to make new password field disabled*/

	$("#ym_new_password").attr("disabled","disabled");
	
	$("#ym_confirm_new_password").attr("disabled","disabled");
	
	
	var time = "<?php if(!$check3) echo $query3->ym_birth_time; ?>";
	
	if(time!="")
	{
		
	
		var ampm=time.substring(time.length-2,time.length);
		
		var time_min=time.substring(0,time.length-2);
		
		var time_min1=time_min.split(":");
		
		var min1=time_min1[1].trim();
		
		$("#"+ampm).attr("selected","selected");
		
		$("#"+time_min1[0]).attr("selected","selected");
		
		$("#"+min1+"min").attr("selected","selected");
	}
	
	var myVar=setInterval(function(){myTimer()},1000);
	
	/*country combo*//*****************added by dharati 201310011400***********/
	$('#ym_citizen_country').change(function() {


		$('#mm_state_id_loading1').show();
	
		$.ajax({
	
		  url: BASE_URI+'youth_milan/registration/get_state/'+$('#ym_citizen_country').val(),
	
		  success: function(data) {
	
			$('#ym_citizen_state').html(data);
	
			$('#mm_state_id_loading1').hide();
	
		  }
	
		});

	});
	
	$('#ym_living_country').change(function() {


		$('#mm_state_id_loading').show();
	
		$.ajax({
	
		  url: BASE_URI+'youth_milan/registration/get_living_state/'+$('#ym_living_country').val(),
	
		  success: function(data) {
	
			$('#ym_living_state').html(data);
	
			$('#mm_state_id_loading').hide();
	
		  }
	
		});

	});
	/************end****************/
		
});
/*********update_monita20131002**********/
function myTimer()
{
    $('#loading').hide();
    $(".photogallery").css({ display: "block" });
	 $(".photogallery").css({ opacity: "1" });
	$("#tabs").css({ display: "block" });
}
/*********update_monita20131002**********/
function passwordValidation()
{
	
	if($("#ym_password").val()!="")

	{
		$("#ym_new_password").removeAttr("disabled");
		
		$("#ym_confirm_new_password").removeAttr("disabled");
		
	}
	
	if($("#ym_password").val()=="")
	{
	
		$("#ym_new_password").attr("disabled","disabled");
		
		$("#ym_confirm_new_password").attr("disabled","disabled");
		
	}
}
/*showing state*//****added by dharati 201310011330******/
$(document).ready(function() {


	$('#mm_state_id_loading1').show();

	$.ajax({

	  url: BASE_URI+'youth_milan/registration/get_state/<?php if(!$check6) echo $query6->ym_citizen_country."/".$query6->ym_citizen_state; else echo "";?>',

	  success: function(data) {

		$('#ym_citizen_state').html(data);

		$('#mm_state_id_loading1').hide();

	  }

	});

});

$(document).ready(function() {


	$('#mm_state_id_loading').show();

	$.ajax({

	  url: BASE_URI+'youth_milan/registration/get_living_state/<?php if(!$check6) echo $query6->ym_living_country."/".$query6->ym_living_state; else echo "";?>',

	  success: function(data) {

		$('#ym_living_state').html(data);

		$('#mm_state_id_loading').hide();

	  }

	});

});

/*****end****/

</script>
