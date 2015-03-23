<style>
body {
	font-family: Arial, sans-serif;
	font-size: 13px;
}

.anchor_add_remove {
	height: 1px;
	left: 96%;
	position: relative;
	top: -25px;
	float: left;
	padding: 2px;
	/*padding-top: 3px;*/
	/*height: 25px;*/
}

.add_rm {
	position: relative;
	margin-left: 0% !important;
	float: left;
}

.add_rm_before {
	position: relative;
	margin-left: 3%;
}

@media screen and (-webkit-min-device-pixel-ratio:0) {
	.mystyle {
		float: left;
	}
}

.formA {
	margin: 0 !important;
}

.tbl_class1 tr td {
	background: #fff; /* border:solid #ddd 1px;   border-radius:5px; */
}

.menu_clr {
	color: #271471;
}

.ped_l {
	padding-left: 5px;
}

.title-bor {
	background-color: #999;
	color: #FFF;
	border: solid #aaa 1px;
	padding: 0 0 0 5px;
	font-weight: normal;
}

.validation_star {
	color: red;
}

.tdaligncenter {
	text-align: center !important;
}

.pay_type>input {
	background: none repeat scroll 0 0 #bec3c7;
	border: medium none;
	border-radius: 1px;
	color: #fff;
	font-size: 15px;
	padding: 6px 17px;
	border-radius: 5px;
}

.pay_type>input:hover, .pay_type input.selected {
	background: none repeat scroll 0 0 #4799ed;
}

.selected {
	background: none repeat scroll 0 0 #4799ed;
}

.submit-btn {
	background: none repeat scroll 0 0 #4799ed;
	border: medium none;
	border-radius: 2px;
	color: #fff;
	padding: 7px 20px;
	text-transform: uppercase;
	margin-left: 20px;
	border-radius: 5px;
}

#activity_link {
	color: #000;
}

#activity_link:hover {
	color: #005580;
}

.pay_type {
	text-align: center;
}

.title01 {
	font-size: 20px;
	color: #dd0e78;
	border-bottom: 2px solid #ddd;
	padding: 10px 0;
	margin-bottom: 10px;
	font-weight: bold;
}

.pink_colored {
	color: #dd0e78;
}
</style>
<link rel="stylesheet" type="text/css" media="all"
	href="<?php echo base_url(); ?>css/jquery.modalbox.css" />
<table class="tbl_class" border="0" cellspacing="0" cellpadding="0"
	align="center" style="min-height: 300px; width: 100%;">
	<tr>
		<td>
        <?php
								
								$form_attributes = array (
										'class' => 'formA',
										'id' => 'myform' 
								);
								
								echo form_open ( '', $form_attributes );
								
								?>
      <?php
						
						// $chapter = $this->dbconvention_registration->get_chapter_from_mm_id($this->session->userdata('user_id'));
						// var_dump($chapter);
						?>
           <table border="0" width="100%" cellpadding="2"
				cellspacing="0" class="tbl_class1">
				<tr>
					<td colspan="3">
						<div class="title01">Registration Information</div>
					</td>
				</tr>
				<tr>
					<td style="width: 30%;">
						<div style="float: left;" class="ped_l">
							SPCS Chapter:<b
								style="border-bottom: 0px solid #000; padding-bottom: 3px;"><?php //echo $chapter->ch_name; ?></b>
						</div>
					</td>
					<td style="width: 60%;" colspan="2">
						<div class="ped_l">
							Life Member Number :
							<!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_life_id;?></b>-->
							<!--<input type="text" placeholder="Enter Life Member Number" style="width:200px; margin:0;"  id="txtzipcode" name="" value="<?php ?>"/>-->
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<div class="ped_l <?php if(form_error('lname')){ echo "error";}?>">
							<span class="validation_star">*</span>Last name :
							<!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_lname; ?></b>-->
							<input type="text" placeholder="Enter Last Name"
								style="width: 200px; margin: 0;" id="txtlname" name="lname"
								value="<?php echo set_value('lname'); ?>" />
						</div>
					</td>
					<td>
						<div class="ped_l <?php if(form_error('fname')){ echo "error";}?>">
							<span class="validation_star">*</span>First Name :
							<!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_fname; ?></b>-->
							<input type="text" placeholder="Enter First Name"
								style="width: 200px; margin: 0;" id="txtfname" name="fname"
								value="<?php echo set_value('fname'); ?>" />
						</div>
					</td>
					<td>
						<div
							class="ped_l <?php if(form_error('address')){ echo "error";}?>">
							<span class="validation_star">*</span>Address :
							<!--<b style=" border-bottom:0px solid #000; padding-bottom:3px;"><?php //echo $chapter->mm_address; ?></b>-->
							<textarea placeholder="Enter Address" style="" id="txtaddress"
								name="address"><?php echo set_value('address');?></textarea>
						</div>
					</td>
				</tr>

				<tr>
					<td>
						<div
							class="ped_l <?php if(form_error('txtphoneh')) echo 'error';?>">
							<span class="validation_star">*</span>Phone No (H) : <input
								type="text" placeholder="Enter Phone - 1234567890"
								style="width: 200px; margin: 0;" id="txtphoneh" name="txtphoneh"
								value="<?php echo set_value('txtphoneh'); ?>" />
						</div>
					</td>
					<td>
						<div style="float: left;"
							class="ped_l <?php if(form_error('txtphonec')) echo 'error';?>">
							<span class="validation_star">*</span>Phone No (C) :<br /> <input
								type="text" placeholder="Enter Phone - 1234567890"
								style="width: 200px; margin: 0;" id="txtphonec" name="txtphonec"
								value="<?php echo set_value('txtphonec'); ?>" />
						</div>
					</td>
					<td>
						<div
							class="ped_l <?php if(form_error('mm_state_id')){ echo "error";}?>">
                
                <?php //$get_state = $this->dbconvention_registration->state_reg($chapter->mm_state_id);?>
                <span class="validation_star">*</span>State : <span
								class="help-inline"><span id="mm_state_id_loading"
								class="loading" style="display: none;"></span></span> <select
								tabindex="13" class="input-large" name="mm_state_id"
								id="mm_state_id" style="width: 215px;">

								<option value="">Please Select</option>

                <?php
																
																$get_states = $this->dbconvention_registrationall->states ();
																foreach ( $get_states as $get_states_row ) {
																	?>
          <option
									<?php if(set_value('mm_state_id') == $get_states_row->state_id){ echo 'selected="selected"';}?>
									value="<?php echo $get_states_row->state_id; ?>"><?php echo $get_states_row->state_name; ?></option>
                    <?php } ?>

                </select>

						</div>
					</td>
				</tr>
				<tr>
					<td colspan="1">
						<div
							class="ped_l <?php if(form_error('txtemail')){ echo "error";}?>">
							<span class="validation_star">*</span>Email :<br /> <input
								type="text" placeholder="Enter Email"
								style="width: 200px; margin: 0;" id="txtemail" name="txtemail"
								value="<?php echo set_value('txtemail'); ?>" />
        <?php //echo form_error('txtemail');?>
                </div>

					</td>


					<td>
						<div
							class="ped_l <?php if(form_error('txtemail2')){ echo "error";}?>">
							Secondary Email : <br /> <input type="text"
								placeholder="Enter Secondary Email"
								style="width: 200px; margin: 0;" id="txtemail2" name="txtemail2"
								value="<?php echo set_value('txtemail2'); ?>" />
        <?php echo form_error('txtemail2');?>
                </div>
					</td>
					<td>
						<div
							class="ped_l <?php if(form_error('mm_city_id')){ echo "error";}?>">
                <?php //$get_cities = $this->dbconvention_registration->cities_reg($chapter->mm_city_id);?>
                <span class="validation_star">*</span>City : <input
								type="text" name="mm_city_id" id="mm_city_id"
								placeholder="Enter City"
								value="<?php echo set_value('mm_city_id'); ?>" />

						</div>
					</td>
				</tr>
				<tr>
					<td colspan="1">
						<div class="ped_l">
							<div
								class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
								<div class="controls">
									<span class="validation_star">*</span>Emergency Contact Name: <br />
									<input type="text" style="width: 200px; margin: 0;"
										placeholder="Enter name" name="txtem_con_name"
										value="<?php echo set_value('txtem_con_name'); ?>" />
								</div>
							</div>
						</div>
					</td>



					<td>
						<div class="ped_l">
							<div
								class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
								<div class="controls">
									<label style="width: 68px; float: left"><span
										class="validation_star">*</span>Phone : </label><br /> <input
										type="text" style="width: 200px; margin: 0;"
										placeholder="Enter number" name="txtem_con_number"
										value="<?php echo set_value('txtem_con_number'); ?>" />

								</div>
							</div>
						</div>
					</td>
					<td>
						<div class="ped_l">
							<div class="<?php if(form_error('txtzipcode')){ echo "error";}?>">
								<div class="controls">
									<span class="validation_star">*</span>Zip Code : 
									<input
										type="text" placeholder="Enter zip code"
										style="width: 200px; margin: 0;" id="txtzipcode"
										name="txtzipcode"
										value="<?php echo set_value('txtzipcode'); ?>" />
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
					<tr>
						<th><label class="pink_colored"
							style="width: 200px; font-width: bold;"><b>Become A Life Member :</b></label></th>
						<th><label class="pink_colored"
							style="width: 200px; font-width: bold;"><b>Become Sponsor :</b></label></th>
						<th><label class="pink_colored"
							style="width: 200px; font-width: bold; padding-left: 10px;"><b>Do
									You Accept Free Tickets :</b></label></th>
					</tr>
					</td>
					<td>
					<tr>

						<td>
							<input type="hidden" id="lifememberfeehidden" name="lifememberfeehidden" 
								value="<?php echo set_value('lifememberfeehidden'); ?>"/> 
							<input type="checkbox"
							name="txtem_life_member" id="txtem_life_member"
							<?php if(set_value('txtem_life_member') == '1'){ ?>
							checked="checked" <?php } ?> onchange="ageof()"
							style="vertical-align: sub;" /> ($250)
						</td>
						<td><select tabindex="15" class="input-large" name="spamount"
							id="spamount" style="width: 200px;" onchange="showSponserPopup()">
	
								<option value="0" selected="selected" onchange="ageof()">Please
									Select</option>
								<option value="600">600$</option>
								<option value="800">800$</option>
								<option value="1200">1200$</option>
								<option value="2000">2000$</option>
								<option value="5000">5000$</option>
								<option value="7500">7500$</option>
								<option value="12500">12500$</option>
								<option value="15000">15000$</option>
								<option value="20000">20000$</option>
								<option value="30000">30000$</option>
						</select> <input type="hidden" id="sponsorfeehidden"
							name="sponsorfeehidden" value=""/></td>
						<td style="padding-left: 10px;">
							<input type="checkbox"
							name="free_ticket" id="free_ticket"
							<?php if(set_value('free_ticket') == '1'){ ?> checked="checked"
							<?php } ?> onclick="ageof()" style="vertical-align: sub;" />Yes
						</td>
					</tr>
				  </td>
				</tr>
			</table>


			<div style="width: 100%; line-height: 20px; margin: 20px 0 5px 0px;">
				<div style="width: 100%; padding: 0 6px;">

					Please list and fill all details about each person registering for
					Convention (Including Registrant) <br /> Click on + sign to add
					additional attendees

				</div>
			</div>
			<div style="width: 100%;">

				<table width="95%" border="0" style="margin-left: 1.1%;">
					<tr>
          <?php $err = ''; if(form_error('name[]')){ $err = "color: #B94A48 !important;";}?>
          <?php $err1 = ''; if(form_error('rel[]')){ $err1 = "color: #B94A48 !important;";}?>
          <?php $err2 = ''; if(form_error('bod[]')){ $err2 = "color: #B94A48 !important;";}?>
          
                  <!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
						<th class="title-bor" style="<?php echo $err; ?>" width="24%">*Name of Attendees <?php echo form_error('name[]'); ?></th>
						<th class="title-bor" style="<?php echo $err1; ?>" width="10%">*Relationship</th>
						<th class="title-bor" style="<?php echo $err2; ?>" width="12%">*Year
							of Birth</th>
						<th class="title-bor" width="7%">Age</th>
						<th class="title-bor" width="15%">Menu Choice<br />T/C
						</th>
						<th class="title-bor" width="15%">Age Group<br />(A-E)
						</th>
						<th class="title-bor" width="10%">Fee</th>

					</tr>
				</table>
			</div>
			<div style="width: 100%;">
				<div>
       <?php
							
							$total = 0;
							if ($total_name > 0) {
								for($i = 0; $i < $total_name; $i ++) {
									?>
       <div class="controls addremove mystyle" style="height: 35px;">
       <?php
									/*
									 * ?><div style="width:20px; float:left;"><input type="checkbox" style="float: left; margin-right: 1%;" checked="checked" id="chk_<?php echo $chapter->mm_id; ?>" onclick="is_check(this.value);" name="chkbx<?php echo $chapter->mm_id; ?>" value="<?php echo $chapter->mm_id; ?>" class="hdnids"/>
									 * <input type="hidden" value="<?php echo $chapter->mm_id; ?>" name="hdnids[]" class="hdnids"/>
									 * </div><?php
									 */
									?>
              
        <table width="95%" border="0" class="add_rm_before age-Group"
							style="margin-left: 1.1%">
							<tr>
								<!--<td width="5%" style=" text-align:center" >
                    <label class="static" id="id[]" style="margin-bottom:0px !important" ><b>1</b></label>
          echo $total_mem_name;
       echo $total_mem_rel;
       echo $total_mem_bod;
       echo $total_mem_age;
       echo $total_mem_menu;
       echo $total_mem_age_group;
       echo $total_mem_age_fee;
       echo $total_mem_age_fee_total;
                    </td>-->
								<td width="24.1%" style="padding: 6px;"><input class="toclear "
									type="text" id="name[]" name="name[]"
									style="width: 99%; margin: 0; padding: 0;"
									value="<?php echo $total_mem_name[$i]; ?>" /></td>
								<td width="12.5%" style="padding: 6px;"><select
									class="toclear guest rel rel_<?php echo $i; ?>" type="text"
									id="rel[]" name="rel[]"
									style="width: 97%; margin: 0; padding: 0; height: 22px;"
									onchange="ageof();">
										<option value="Self"
											<?php if($total_mem_rel[$i] == "Self") { ?>
											selected="selected" <?php } ?>>Self</option>
										<option value="Wife"
											<?php if($total_mem_rel[$i] == "Wife") { ?>
											selected="selected" <?php } ?>>Wife</option>
										<option value="Husband"
											<?php if($total_mem_rel[$i] == "Husband") { ?>
											selected="selected" <?php } ?>>Husband</option>
										<option value="Son" <?php if($total_mem_rel[$i] == "Son") { ?>
											selected="selected" <?php } ?>>Son</option>
										<option value="Daughter"
											<?php if($total_mem_rel[$i] == "Daughter") { ?>
											selected="selected" <?php } ?>>Daughter</option>
										<option value="Father"
											<?php if($total_mem_rel[$i] == "Father") { ?>
											selected="selected" <?php } ?>>Father</option>
										<option value="Mother"
											<?php if($total_mem_rel[$i] == "Mother") { ?>
											selected="selected" <?php } ?>>Mother</option>
										<option value="Other"
											<?php if($total_mem_rel[$i] == "Other") { ?>
											selected="selected" <?php } ?>>Other</option>
								</select></td>
								<td width="12%" style="padding: 6px;"><input class="toclear bod"
									onblur="datediff(this.value,this.id);" type="text"
									id="bod_<?php echo $i; ?>" name="bod[]"
									value="<?php echo $total_mem_bod[$i]; ?>" placeholder="YYYY"
									style="width: 99%; margin: 0; padding: 0;" /></td>
								<td width="7%" style="padding: 6px;"><input class="toclear age"
									onkeyup="ageof()" id="age_<?php echo $i; ?>"
									onkeypress="ageof();" onkeyup="ageof();" onchange="ageof();"
									onmouseout="ageof();" id="age[]" name="age[]" type="text"
									value="<?php echo $total_mem_age[$i]; ?>"
									style="width: 98%; margin: 0; padding: 0;" /> <input
									type="hidden" id="" value=""></td>
								<td width="15%" style="background-color: #7d7d7d; padding: 6px;"><select
									class="toclear" id="menu_ch[]" name="menu_ch[]"
									style="width: 97%; margin: 0; padding: 0; height: 22px;">
										<option value="T"
											<?php if($total_mem_age_group[$i] == "T") echo "selected"; ?>>T</option>
										<option value="C"
											<?php if($total_mem_age_group[$i] == "C") echo "selected"; ?>>C</option>
								</select> <!--<input class="toclear" type="text"  id="menu_ch[]" name="menu_ch[]" value="<?php //echo set_value('menu_ch[]'); ?>"  style=" width:99%; margin:0; padding:0;"/>-->
								</td>
								<td width="15%" style="background-color: #b4b4b4; padding: 6px;">
          <?php
									$group = '';
									$amount = '';
									/*
									 * $age = date("Y")-$chapter->mm_birth_year;
									 * if($age<$itema->end_age)
									 * {
									 * $group ='A';
									 * if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
									 * {
									 * $amount = $itema->fees_st_mm_late_fee;
									 * }
									 * else
									 * {
									 * $amount = $itema->fees_st_mm_fee;
									 * }
									 * }
									 * else if($age>=$itemb->start_age && $age<=$itemb->end_age)
									 * {
									 * $group = 'B';
									 * if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
									 * {
									 * $amount = $itemb->fees_st_mm_late_fee;
									 * }
									 * else
									 * {
									 * $amount = $itemb->fees_st_mm_fee;
									 * }
									 * }
									 * else if($age>=$itemc->start_age)
									 * {
									 * $group = 'C';
									 * if(strtotime(date('Y-m-d'))>strtotime($item->final_date))
									 * {
									 * $amount = $itemc->fees_st_mm_late_fee;
									 * }
									 * else
									 * {
									 * $amount = $itemc->fees_st_mm_fee;
									 * }
									 * }
									 */
									$total += $amount;
									?>
                     <input class="toclear fees" id="age_grp[]"
									name="age_grp[]" readonly="" type="text"
									value="<?php echo $total_mem_age_group[$i]; ?>"
									style="width: 99%; margin: 0; padding: 0;" />
								</td>
								<td width="10%" style="background-color: #b4b4b4; padding: 6px;"><input
									class="toclear fees" id="fees[]" readonly="" name="fees[]"
									type="text" readonly=""
									value="<?php echo $total_mem_age_fee[$i]; ?>"
									style="width: 99%; margin: 0px; padding: 0px; text-align: right;" />
								</td>

							</tr>
						</table>

						<a title="Add New Field" onclick="addNewField(this);"
							class="anchor_add_remove"> <i class="icon-edit" style="background-position:0 -96px; background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
						</a> <a title="Remove This Field" onclick="removeThisField(this);" class="anchor_add_remove" style="<?php if($i > 0){echo 'display:block;';}else{ echo 'display:none;'; } ?>">
							<i class="icon-minus-sign" style="background-image:url('<?php echo base_url();?>images/glyphicons-halflings.png')"></i>
						</a>

					</div>
       <?php
								}
							}
							?>
                 
        <table width="95%" border="0" class="add_rm_before age-Group"
						style="margin-left: 1.1%;">
						<tr>
							<td width="81%"
								style="color: #271471; text-align: right; padding-right: 8px; color: #dd0e78;"><b>Total</b></td>

							<td width="9.4%" style="text-align: center; padding: 6px;"><input
								type="text" id="fees_total" readonly="readonly"
								name="fees_total"
								value="<?php echo $total_mem_age_fee_total; ?>"
								style="width: 99%; margin: 0px; padding: 0px; text-align: right;" />
							</td>
						</tr>
					</table>
				</div>

				<div class="space10px"></div>
				<!--<input type="button" value="Add new" class="btn primary" style="margin-left:3%;" id="addnew" onclick="displaythis();" />-->
			</div> <!-------------------------update-nirav20150120------------------------------>
    <?php
				/*
				 * $event_res = $this->dbconvention_registrationall->get_event_data();
				 * print_r($event_res);
				 */
				?>   
<table border="0" cellspacing="0" cellpadding="0" align="center"
				style="">
				<tr>
					<td><span style="font-weight: bold; padding: 6px;">Activity
							Registration</span>

						<div class="space10px"></div>
						<table class="tbl_class1 age-Group" border="0" cellspacing="0"
							cellpadding="0"
							style="width: 95%; margin-right: 35px; margin-left: 6px; text-align: center;"
							align="center">
							<tr>
								<!------<th class="tdfees title-bor" style="width:50px;">Age Group</th> --->
								<th class="tdfees title-bor"
									style="width: 800px; padding: 8px 0;">Activity</th>
								<th class="tdfees title-bor"
									style="width: 200px; padding: 8px 0;">Participant</th>
								<th class="tdfees title-bor"
									style="width: 100px; padding: 8px 0;">T-Shirt Size</th>
								<th class="tdfees title-bor"
									style="width: 50px; padding: 8px 0;">Amount</th>
							</tr>
          <?php
										
										if ($items) {
											foreach ( $items as $itemsgroup ) {
												?>
          <tr class="trodd ">
								<!------<td class="tdaligncenter"><?php echo $itemsgroup->ce_start_age; ?>-<?php echo $itemsgroup->ce_end_age; ?>
            <input type="hidden" value="<?php echo $itemsgroup->ce_start_age; ?>" name="startage[]"/>
            <input type="hidden" value="<?php echo $itemsgroup->ce_end_age; ?>" name="endage[]"/>
            </td>--->

								<td class="tdaligncenter"
									style="text-align: left !important; padding-left: 8px;"><a
									style="color: #271471;"
									href="<?php echo base_url()."2015/texas/convention/detail_page/9"; ?>"
									id="activity_link"><?php echo $itemsgroup->ce_activity; ?></a></td>

								<td class="tdaligncenter"><label
									style="line-height: 32px; display: inline;"><input type="text"
										class="tdtxt"
										style="width: 20px; margin: 6px; padding: 0 3px;"
										value="<?php echo set_value('txtpcount[]'); ?>"
										name="txtpcount[]" id="txtpcounta" onkeyup="ageoftotal();"
										onchange="ageoftotal();" onmouseout="ageoftotal();"
										onkeypress="return isNumber(event)" />x $</label><?php echo $itemsgroup->ce_age_fee; ?>
            <input type="hidden"
									value="<?php echo $itemsgroup->ce_start_age."-".$itemsgroup->ce_end_age; ?>"
									name="age-grup-event[]"> <input type="hidden"
									value="<?php echo $itemsgroup->ce_age_fee; ?>"
									name="getamount[]" /> <input type="hidden"
									value="<?php echo $itemsgroup->ce_id; ?>" name="eventid[]" /></td>

								<td><?php $set_tshirt_size = set_value('tshirt_size[]'); ?><select
									style="width: 100px;" name="tshirt_size[]">
										<option value="">Select</option>
										<option
											<?php if($set_tshirt_size == "YS") { echo 'selected'; } ?>
											value="YS">YS</option>
										<option
											<?php if($set_tshirt_size == "YM") { echo 'selected'; } ?>
											value="YM">YM</option>
										<option
											<?php if($set_tshirt_size == "YL") { echo 'selected'; } ?>
											value="YL">YL</option>
										<option
											<?php if($set_tshirt_size == "AS") { echo 'selected'; } ?>
											value="AS">AS</option>
										<option
											<?php if($set_tshirt_size == "AM") { echo 'selected'; } ?>
											value="AM">AM</option>
										<option
											<?php if($set_tshirt_size == "AL") { echo 'selected'; } ?>
											value="AL">AL</option>
										<option
											<?php if($set_tshirt_size == "AXL") { echo 'selected'; } ?>
											value="AXL">AXL</option>
										<option
											<?php if($set_tshirt_size == "AXXL") { echo 'selected'; } ?>
											value="AXXL">AXXL</option>
								</select></td>

								<td class="tdaligncenter" style="padding: 0 6px;"><input
									type="text" value="0"
									style="margin-bottom: 0px; width: 106px; text-align: right; padding: 0 3px;"
									name="amount[]" readonly="" id="amount_event" /></td>
							</tr> <?php }}?>
          <tr class="treven">
								<td colspan="3"><b
									style="float: right; margin-right: 5px; color: #dd0e78; padding: 8px;">Total
								</b></td>
								<td class="tdaligncenter" id="totalamount"
									style="text-align: right; padding-right: 8px;">0</td>
								<input type="hidden" id="totalamounthidden"
									name="totalamounthidden" value="">
							</tr>
						</table>
						<div class="space10px"></div>
                
        <?php if(form_error('txtpcount[]')) { ?>
       <div class="control-group error">
							<div class="controls">
								<span class="help-inline">All fileds are required.</span>
							</div>
						</div>
      <?php } ?>
            <input type="hidden" id="" name="event_mem_created_date"
						value="<?php echo date("Y-m-d H:i:s"); ?>"></td>
				</tr>
			</table>
			<table border="0" cellspacing="0" cellpadding="0" align="center"
				style="height: 50px;">
				<tr>
					<td><b style="color: #dd0e78;">Total : $<span
							id="total_with_paypal">0</span>
					</b> ($<span id="fees_total2">0</span> + $<span id="totalamount2">0</span>
						+ $<span id="paypal_fee">0</span> (2.2% + $0.30 - Paypal
						Processing Fee))</td>
				</tr>
			</table>
			
			<div style="clear: both"></div>
		  	<div style="margin-left: 20px; margin-top: 10px; float: left;">
				<span class="validation_star">*</span>Confirm Captcha <input
					size="40" type="text" name="confirmCaptcha" id="confirmCaptcha"
					value="" />

			</div> <img
			src="<?php  echo base_url().'images/captcha/'.$captcha['image']; ?>"
			style="float: left; margin-left: 10px;">

			<div style="clear: both;"></div>
			<div class="<?php if(form_error('confirmCaptcha')){ echo "error";}?>"
				style="margin-left: 20px;">
               <?php if(form_error('confirmCaptcha')) { ?>
       <div class="control-group error">
					<div class="controls">
						<span class="help-inline" style="font-size: 15px;"><?php echo form_error('confirmCaptcha'); ?></span>
					</div>
				</div>
      <?php } ?>
      
       </div>
			<div class="space20px "></div>
			<div style="margin-left: 20px; text-align: center;">
				<div class="pay_type" id="pay_type" style="">

					<!-- Vishal Comment 1/31/2015   <input type="radio" name="payment" id="check" value="by_check" style="vertical-align: sub;">Pay by CHECK -->

					<input style="margin-left: 20px; vertical-align: sub;"
						checked="checked" type="radio" id="paypal" name="payment"
						value="by_paypal">  Pay by PAYPAL or Credit/Debit card
					<!-- <input type="button" class="" value="Cheque" id="cheque" onclick="select_method('cheque')"></input>
           <input type="button" class="selected" value="Paypal" id="paypal" onclick="select_method('paypal')"></input>
           <input type="hidden" name="payment" id="payment" value="by_paypal" />-->
				</div>
				<div style="float: left; width: 100%; display: none;"
					class="by_check" id="by_check"></div>
				<div style="float: left; width: 100%; display: none;"
					class="by_paypal" id="by_paypal">
                  <?php //$urlpaypal = "https://www.sandbox.paypal.com/cgi-bin/webscr"; ?>
                  <!--<form method="post" name="frmPayPal" id="frmPayPal" action="<?=$urlpaypal ?>">
            
                        
                        
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="job_parth-facilitator@yahoo.com">
                        <input type="hidden" name="item_name" value="Item Name">
                        <input type="hidden" name="tx" value="TransactionID"> 
                        <input type="hidden" name="rm" value="2">
                        <input type="hidden" name="return" value="<?php echo current_url(); ?>">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="amount" value="1.00">
                        <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
                        </form>-->


				</div>

			</div>

			<div class="space20px"></div> 
             <?php
													/*
													 * for($m=0;$m<=$total_name;$m++)
													 * {
													 * if(form_error('rel[]') || form_error('age['.$m.']') || form_error('age_grp[]') || form_error('fees[]')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline">All fileds are required.</span>
													 * </div>
													 * </div>
													 * <?php } }?>
													 * <?php if(form_error('txtzipcode')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline"><?php echo form_error('txtzipcode'); ?></span>
													 * </div>
													 * </div>
													 * <?php } ?>
													 * <?php if(form_error('txtem_con_name')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline"><?php echo form_error('txtem_con_name'); ?></span>
													 * </div>
													 * </div>
													 * <?php } ?>
													 * <?php if(form_error('txtem_con_number')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline"><?php echo form_error('txtem_con_number'); ?></span>
													 * </div>
													 * </div>
													 * <?php } ?>
													 *
													 * <?php if(form_error('name[]')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline"><?php echo form_error('name[]'); ?></span>
													 * </div>
													 * </div>
													 * <?php } ?>
													 * <?php if(form_error('txtemail')) { ?>
													 * <div class="control-group error">
													 * <div class="controls">
													 * <span class="help-inline"><?php echo form_error('txtemail'); ?></span>
													 * </div>
													 * </div>
													 * <?php }
													 */
													?>
             
            
             
         <!-------------------------update-monita20130927------------------------------>
            <?php //date_default_timezone_set("Asia/Kolkata"); ?>    
            <input type="hidden" id="" name="mm_id" value="<?php //echo $chapter->mm_id; ?>"> 
            <input type="hidden" id="" name="fees_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
			<input type="hidden" id="" name="fees_created_by" value="<?php //echo $chapter->mm_fname;?>"> 
			
			<input type="hidden" id="groupaend" value="<?php echo $itema->end_age; ?>" /> 
			<input type="hidden" id="groupbstart" value="<?php echo $itemb->start_age; ?>" /> 
			<input type="hidden" id="groupbend" value="<?php echo $itemb->end_age; ?>" /> 
			<input type="hidden" id="groupcend" value="<?php echo $itemc->start_age; ?>" />

			<input type="hidden" id="childfeemem" value="<?php echo $itema->fees_st_mm_fee; ?>" /> 
			<input type="hidden" id="childfeenonmem" value="<?php echo $itema->fees_st_non_mm_fee; ?>" />
			<input type="hidden" id="childfeememlate" value="<?php echo $itema->fees_st_mm_late_fee; ?>" /> 
			<input type="hidden" id="childfeenonmemlate" value="<?php echo $itema->fees_st_non_mm_late_fee; ?>" /> 
			
			<input type="hidden" id="youngfeemem" value="<?php echo $itemb->fees_st_mm_fee; ?>" /> 
			<input type="hidden" id="youngfeenonmem" value="<?php echo $itemb->fees_st_non_mm_fee; ?>" />
			<input type="hidden" id="youngfeememlate" value="<?php echo $itemb->fees_st_mm_late_fee; ?>" /> 
			<input type="hidden" id="youngfeenonmemlate" value="<?php echo $itemb->fees_st_non_mm_late_fee; ?>" /> 
			
			<input type="hidden" id="oldfeemem" value="<?php echo $itemc->fees_st_mm_fee; ?>" /> 
			<input type="hidden" id="oldfeenonmem" value="<?php echo $itemc->fees_st_non_mm_fee; ?>" />
			<input type="hidden" id="oldfeememlate" value="<?php echo $itemc->fees_st_mm_late_fee; ?>" />
			<input type="hidden" id="oldfeenonmemlate" value="<?php echo $itemc->fees_st_non_mm_late_fee; ?>" />
			
			<input type="hidden" id="finaldate" value="<?php echo strtotime($item->final_date); ?>" /> 
			<input type="hidden" id="currentdate" value="<?php echo strtotime(date('Y-m-d')); ?>" /> 
			<input type="hidden" id="fees_st_id" name="fees_st_id" value="<?php echo $item->fees_st_id; ?>" />


			<div style="text-align: center">
				<input type="submit"
					value="<?php echo $this->lang->line('btn_submit');?>"
					class="submit-btn" />
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
function submit_check() {
  if($('#pay_type').css('display') == 'none'){ 
    $("#pay_type").css('display','block');
  }
  else {
    $( "#myform" ).submit();
  }
  
}
/*$("#check").click(function(){
  $("#by_check").css('display','block');
  $("#by_paypal").css('display','none');
});
$("#paypal").click(function(){
  $("#by_check").css('display','none');
  $("#by_paypal").css('display','block');
});*/
</script>
<script>


function showSponserPopup()
{
  
  var n = parseInt(document.getElementById('spamount').value);

  var total = $("#fees_total").val();
  if(n==600)
    {
      alert("You have selected for being Well Wisher Sponsorship Package"+"\n"+"Sponsorship Amount : 600$"+"\n"+"Directory Ad : Listed"+"\n"+"Free Adult Registration : 2"+"\n"+"Please SELECT if you want free tickets");
    }
  if(n==800)
    {
      alert("You have selected for being Samaj Sponsorship Package"+"\n"+"Sponsorship Amount : 800$"+"\n"+"Directory Ad : 1/4 Page "+"\n"+"Free Adult Registration : 2"+"\n"+"Please SELECT if you want free tickets");
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
    
    ageof();
    }
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
    
    document.getElementById('age_'+to+'').value = "";
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

  var become_member_checked = document.getElementById("txtem_life_member").checked

  

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
          if (become_member_checked) {
              if(rel[i].value == "Other")
              {
                fees[i].value = childfeenonmem;
              }
              else
              {
                fees[i].value = childfeemem;
              }
            }
            else
            {
              fees[i].value = childfeenonmem;
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
            if (become_member_checked) {
              if(rel[i].value == "Other")
              {
                fees[i].value = youngfeenonmem;
              }
              else
              {
                fees[i].value = youngfeemem;
              }
            }
            else
            {
              fees[i].value = youngfeenonmem;
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

          if (become_member_checked) {
            if(rel[i].value == "Other")
            {
              fees[i].value = oldfeenonmem;
            }
            else
            {
              fees[i].value = oldfeemem;
            }
          }
          else
          {
            fees[i].value = oldfeenonmem;
          }
          
        }
      }
      
    }
    if(age[i].value == '')
    {
      age_grp[i].value='';
      fees[i].value='';
      
    }
    
    var sponsership_fees = document.getElementById('spamount').value;

    console.log( "Selected sponsership", sponsership_fees);

    var free_ticket_checked = document.getElementById("free_ticket").checked
    if( free_ticket_checked ){
      $("#free_ticket").val("1");
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
      if(sponsership_fees == "30000" && age_grp[i].value == "C" && free_adult_registration < 12){
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
        $("#lifememberfeehidden").val("250");
        //document.getElementById('lifememberfeehidden').value=250;
        $("#txtem_life_member").val("1");
    }
    
    if(sponsership_fees != "0" ){
        total_price = parseInt(total_price) + parseInt(sponsership_fees) ;
        $("#sponsorfeehidden").val(sponsership_fees);
        //document.getElementById('sponsorfeehidden').value=parseInt(sponsership_fees);

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
  
  $(item).parent(".addremove").after($(item).parent(".addremove").clone());
  var fees = document.getElementsByName('fees[]');
  var ln = fees.length;
  
  //$(item).parent(".addremove").clone();
    /*var fees = document.getElementsByName('fees[]');
  var ln = fees.length;
  //alert(ln);
//  $(item).parent(".addremove").next(".addremove").children(".toclear").val("");
    /*$(item).parent(".addremove").next(".addremove").find(".static").html('<b>'+ln+'</b>');*/
  $(item).parent(".addremove").next(".addremove").find(".toclear").val("");
  //$(item).parent(".addremove").next(".addremove").find("table").addClass("add_rm");
  //$(item).parent(".addremove").next(".addremove").find("table").removeClass("add_rm_before");
  $(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('disabled');
/*  $(item).parent(".addremove").next(".addremove").find(".toclear").removeAttr('readonly');
  $(item).parent(".addremove").next(".addremove").find(".fees").attr('readonly','true');
  $(item).parent(".addremove").next(".addremove").find(".age").attr('readonly','true');*/
  $(item).parent(".addremove").next(".addremove").find(".rel").attr('id','rel_'+ln);
  $(item).parent(".addremove").next(".addremove").find(".bod").attr('id','bod_'+ln);
  $(item).parent(".addremove").next(".addremove").find(".age").attr('id','age_'+ln);
  //$(item).parent(".addremove").next(".addremove").find(".age").val('Guest');
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
//  var yy = date.split("/");
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
<script type="text/javascript">

$('#mm_state_id').change(function() {



  /*$('#mm_state_id_loading').show();



  $.ajax({

    url: BASE_URI+'2015_texas/convention/get_city/'+$('#mm_state_id').val(),

    success: function(data) 
    {
    
    $('#mm_city_id').html(data);

    $('#mm_state_id_loading').hide();

    }

  });*/

});

</script>
<script src="<?php echo base_url();?>js/jquery.modalbox-1.5.0-min.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
    jQuery(document).ready(function(){
        jQuery(".openmodalbox").modalBox({
            setTypeOfFaderLayer    : 'black', // options: white, black, disable
            killModalboxWithCloseButtonOnly : true, // options: true, false (close the modal box with close button only),
            setStylesOfFaderLayer : {// define the opacity and color of fader layer here
                white : 'background-color:#fff; filter:alpha(opacity=60); -moz-opacity:0.6; opacity:0.6;',
                black : 'background-color:#000; filter:alpha(opacity=40); -moz-opacity:0.4; opacity:0.4;',
                transparent : 'background-color:transparent;'
            },
            minimalTopSpacingOfModalbox : 50 // sets the minimum space between modalbox and visible area in the browser window
        });
    });
/* ]]> */

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
  ageof();
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
<!--<script>
function form_submit()
{
  $("#myform").trigger("submit");
  //document.getElementById("myform").submit();
  //document.location = "http://testsite.spcsusa.org/2015/texas/convention/allregistration.html";
}
function get_data()
{
  
  var txtfname = document.getElementById("txtfname").value;
  var txtlname = document.getElementById("txtlname").value;
  var reg_number = document.getElementById("reg_number").value;
  if((txtfname != "" && txtfname != null) && (txtlname != "" && txtlname != null))
  {
    $("#model").addClass("model");
    //var texthtml = "<div> First Name: "+txtfname"+</div>";
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    } 

    today = dd+'/'+mm+'/'+yyyy;
    
    $(".modalboxContent").html('<div style="text-align:center;"><b>Name :</b> '+txtfname+' '+txtlname+'</div><div style="text-align:center;"><b>Registration Number :</b> '+reg_number+'</div><div style="text-align:center;"><b>Registration Date :</b> '+today+'</div><input type="button" value="<?php echo $this->lang->line('btn_submit');?>" class="btn " onclick="form_submit()"/>');
  }
  else
  {
    $("#model").removeClass("model");
  }
}
</script>-->