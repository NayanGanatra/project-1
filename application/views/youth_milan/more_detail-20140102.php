<style>
.clsheader
{
	background-color: #936263;
	color: #fff;
	margin: 0px 10px 0px 15px;
	width: auto; line-height: 25px;
	padding-left: 5px;
}
</style>

<style type="text/css">
 /* * {
    font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Verdana, Arial, sans-serif;
    color: #333;
    line-height: 140%;
  }*/
  select, input, textarea {
    font-size: 1em;
  }
  /*body {
    padding: 30px;
    font-size: 70%;
    width: 800px;
  }*/
  h2 {
    margin-top: 1.2em;
    margin-bottom: 0;
    padding: 0;
    border-bottom: 1px dotted #dedede;
  }
  h3 {
    margin-top: 1.2em;
    margin-bottom: 0;
    padding: 0;
  }
  .example {
    border: 1px solid #CCC;
    background: #f2f2f2;
    padding: 10px;
  }
  ul {
    list-style-image:url(list-style.gif);
  }
  pre {
    font-family: "Lucida Console", "Courier New", Verdana;
    border: 1px solid #CCC;
    background: #f2f2f2;
    padding: 10px;
  }
  code {
    font-family: "Lucida Console", "Courier New", Verdana;
    margin: 0;
    padding: 0;
  }

  #gallery {
    padding: 5px;
     background: url(../../images/youth_milan/trans.gif);/*updated by dharati 201309301730*/
  }
  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 640px;
    padding: 10px;
    overflow: hidden;
  }
    #descriptions .ad-image-description {
      position: absolute;
    }
      #descriptions .ad-image-description .ad-description-title {
        display: block;
      }
  </style>
  

<?php $this->load->view('youth_milan/layout/header'); ?>
   
	<div class="photogallery">
	
      	<!--<div class="logo-text2">More Detail <input type="button" onclick="window.history.back();" class="btn btn-primary" value="Go back" id="go_back" name="go_back" style="float:right;"></div>-->
		<div class="logo-text2"><img align="absmiddle" alt="" src="<?php echo base_url();?>images/youth_milan/register-icon.png">Detail About <?php if(sizeof($query1)!=0) echo $query1->ym_name; else $query8->mm_fname." ".$query8->mm_lname; ?><input type="button" onclick="window.location='<?php echo base_url().'youth_milan/registration/search'; ?>'" class="btn btn-primary" value="Go back to search results" id="go_back" name="go_back" style="float:right;"></div>
		
	  
	  <table width="100%" cellspacing="10" cellpadding="0" class="table-title-b-mai">
        <tbody>
          <tr>
            <td colspan="4"><table width="100%" cellspacing="0" cellpadding="0">
                <tbody>
                  <tr>
                    <td width="22%"><table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td width="13%" valign="middle" align="center">
								<!----updated by dharati 201310021830------->
								<?php
									if($query7_2)
									{
										$image_flag=true;
											
										if(sizeof($query7_2)==1)
										{
											foreach($query7_2 as $photo)
											{
																					
												if($photo->ym_photo=="")
												{
													$image_flag=false;
												?>
													<img  src="<?php echo base_url(); ?>images/youth_milan/profile/big/nophoto.jpg" height="225" width="200" style="height:225px;width:200px;"/>
													
												<?php
												}
												else
												{
													$image_flag=true;
												}
												
											}
										}
										if($image_flag)
										{
										?>
												<div id="gallery" class="ad-gallery">
											    	<div class="ad-image-wrapper">
											      	</div>
											      <!--<div class="ad-controls">
											      </div>-->
											      	<div class="ad-nav">
											        <div class="ad-thumbs">
											          	<ul class="ad-thumb-list">
											
											
										<?php
										
											foreach($query7_2 as $photo)
											{
											
												if($photo->ym_photo!="")
												{
											
												?>
															
															<li>
													            <a href="<?php echo base_url(); ?>images/youth_milan/profile/big/<?php echo $photo->ym_photo; ?>">
													            	<img src="<?php echo base_url(); ?>images/youth_milan/profile/big/<?php echo$photo->ym_photo; ?>" title="<?php echo $photo->ym_photo; ?>" alt="profile images">
													            </a>
													        </li>
														
												<?php
											  }
											}
											?>
											</ul>
										        </div>
										      </div>
										    </div>
											
											
											<?php
										}
									}
									else
									{
									?>
										<img  src="<?php echo base_url(); ?>images/youth_milan/profile/big/nophoto.jpg" height="225" width="200" style="height:225px;width:200px;"/>
											
										<?php
									}
									?>
									<!---------------end---------------->
								
							</td>
                          </tr>
                        </tbody>
                      </table>
					  </td>
                    <td width="9%" align="center">&nbsp;</td>
                    <td width="64%"><table width="100%" border="0" cellspacing="5" cellpadding="2">
                        <tr>
                          <td  width="49%"><table width="100%" cellspacing="5" cellpadding="2">
                              <tbody>
                                <tr>
                                  <td colspan="3" class="table-title-b"><strong>Basic Information/ Physical Attributes</strong></td>
                                </tr>
                                <!-- <tr><td class="DetailText" colspan="3" height="3"></td></tr>-->
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Name</strong> : <?php if(sizeof($query1)!=0) echo $query1->ym_name; else $query8->mm_fname." ".$query8->mm_lname; ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Gender</strong> : <?php if(sizeof($query1)!=0) {if($query1->ym_gender=='0' || $query1->ym_gender=='') { echo ''; }else { echo $query1->ym_gender; } } else{if($query8->mm_gender==false) echo "Male"; else echo "Female";} ?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Marital Status</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_marital_status=='0' || $query1->ym_marital_status=='') {echo '';} else { echo $query1->ym_marital_status;} ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Having Children</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_children=='0' || $query1->ym_children=='') {echo '';} else { echo $query1->ym_children;} ?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Height</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_height=='0' || $query1->ym_height==''){ echo '';} else  {echo $query1->ym_height." "."cms";} ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Weight</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_weight=='0' || $query1->ym_weight=='') { echo ''; }else { echo $query1->ym_weight." "."kgs / ".round($query1->ym_weight*2.20462)." lbs"; }?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Body Type</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_body_type=='0' || $query1->ym_body_type=='') { echo ''; }else { echo $query1->ym_body_type; } ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Complexion</strong> : <?php if(sizeof($query1)!=0) if($query1->ym_complexion=='0' || $query1->ym_complexion=='') { echo ''; }else { echo $query1->ym_complexion; } ?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Physical Status</strong> : <?php if(sizeof($query1)!=0) echo $query1->ym_physical_status; ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Blood Group</strong> : <?php if(sizeof($query1)!=0) echo $query1->ym_blood_group; ?></td>
                                </tr>
                                <tr>
                                  <td height="5" colspan="3" class="DetailText"></td>
                                </tr>
                              </tbody>
                            </table></td>
                          <td  width="3%">&nbsp;&nbsp;</td>
                          <td  valign="top" width="49%"><table width="100%" cellspacing="0" cellpadding="2">
                             
                                <tr>                              
                                  <td colspan="3" class="table-title-b"><strong>Astrological Information</strong></td>
                                </tr>
                                <!-- <tr><td class="DetailText" colspan="3" height="3"></td></tr>-->
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Age</strong> : <?php if(sizeof($query3)!=0) if($query3->ym_age=='0' || $query3->ym_age=='') { echo ''; }else { echo $query3->ym_age; } ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Birth Date</strong> : <?php if(sizeof($query3)!=0) echo $query3->ym_birth_date; else echo $query8->mm_birth_year."-".$query8->mm_birth_month; ?> </td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Birth Time</strong> : <?php if(sizeof($query3)!=0) echo $query3->ym_birth_time; ?></td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Birth Place</strong> : <?php if(sizeof($query3)!=0) echo $query3->ym_birth_place; ?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Manglik?</strong> :
              <?php if(sizeof($query3)!=0) if($query3->ym_manglik=='0' || $query3->ym_manglik=='') { echo ''; }else { echo $query3->ym_manglik; } ?> </td>
                                </tr>
                                <tr>
                                  <td width="54%" valign="top" align="left" class="DetailText"><strong>Moon Sign/Raasi</strong> :  <?php if(sizeof($query3)!=0) echo $query3->ym_raasi; ?></td>
                                </tr>
                                <tr>
                                  <td valign="top" align="left" class="DetailText" colspan="2"><strong>Star Sign/Nakshatra</strong> : <?php if(sizeof($query3)!=0) echo $query3->ym_nakshatra; ?></td>
                                </tr>
                                
                                
                                <tr>
                                  <td height="5" colspan="3" class="DetailText"></td>
                                </tr>
                                <tr>
                                  <td height="5" colspan="3" class="DetailText"></td>
                                </tr>
                                <tr>
                                  <td height="5" colspan="3" class="DetailText"></td>
                                </tr>
                           
                            </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </tbody>
              </table></td>
          </tr>
          <tr>
            <td colspan="4" class="table-title-b"><strong>Religious/ Social Background </strong></td>
          </tr>
          <tr>
            <td height="3" colspan="4" class="DetailText"></td>
          </tr>
          <tr>
            <td width="33%" class="DetailText">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Mother Tongue</strong> : <?php if(sizeof($query2)!=0) echo $query2->ym_mother_tongue; ?></td>
					</tr>
					<tr>
						<td><strong>Caste</strong> : <?php if(sizeof($query2)!=0) echo $query2->ym_caste; ?></td>
					</tr>
				</table>
			</td>
			 
            <td valign="top" align="left" class="DetailText" width="33%" style="padding-right:45px;">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Religion</strong> : <?php if(sizeof($query2)!=0) echo $query2->ym_community; ?>
						</td>
					</tr>
					<tr>
						<td><strong>Sub Caste</strong> :<?php if(sizeof($query2)!=0) echo $query2->ym_sub_caste; ?></td>
					</tr>
				</table>
			</td>
			
			<td class="DetailText" width="33%" style="width:200px; margin-left:-45px; float:left; " align="left" >
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Gothram</strong> : <?php if(sizeof($query2)!=0) echo $query2->ym_gothram; ?></td>
					</tr>
					<tr>
						<td class="DetailText">&nbsp;</td>
					</tr>
				</table>
			</td>
          </tr>
          <tr>
            <td colspan="4"  class="table-title-b"><strong>Educational and Professional Information </strong></td>
          </tr>
          
		  <tr>
            <td width="33%" class="DetailText">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Education</strong> : <?php if(sizeof($query4)!=0) echo $query4->ym_degree_level; ?></td>
					</tr>
					<tr>
						<td><strong>Occupation</strong> : <?php if(sizeof($query4)!=0) echo $query4->ym_occupation; ?></td>
					</tr>
				</table>
			</td>
			
            <td valign="top" align="left" class="DetailText" width="33%" style="padding-right:45px;">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Education  Detail </strong> : <?php if(sizeof($query4)!=0) echo $query4->ym_education_detail; ?></td>
					</tr>
					<tr>
						<td><strong>Occupation Detail</strong> :<?php if(sizeof($query2)!=0) echo $query4->ym_occupation_detail; ?></td>
					</tr>
				</table>
			</td>
			
			<td class="DetailText" width="33%" style="width:200px; margin-left:-45px; float:left; " align="left" >
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td><strong>Annual Income</strong> : <?php if(sizeof($query4)!=0) echo $query4->ym_annual_income; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
			</td>
          </tr>
		  
          <tr>
            <td height="7" colspan="4" class="DetailText"></td>
          </tr>
          <tr>
            <td colspan="4" class="table-title-b"><strong>Life Style </strong></td>
          </tr>
          <tr>
            <td width="33%" class="DetailText">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>Diet</strong> : <?php if(sizeof($query5)!=0) if($query5->ym_diet_preferences=='0' || $query5->ym_diet_preferences=='') { echo ''; }else { echo $query5->ym_diet_preferences; } ?>
						</td>
					</tr>
				</table>			
			</td>
            <td valign="top" align="left" class="DetailText" width="33%" style="padding-right:45px;">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>Smoking</strong> : <?php if(sizeof($query5)!=0) if($query5->ym_smoking=='0' || $query5->ym_smoking=='') { echo ''; }else { echo $query5->ym_smoking; } ?>
						</td>
					</tr>
				</table>
			</td>
            <td class="DetailText" style="width:200px; margin-left:-45px; float:left; " align="left" >
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>Drinking</strong> : <?php if(sizeof($query5)!=0) if($query5->ym_drinking=='0' || $query5->ym_drinking=='') { echo ''; }else { echo $query5->ym_drinking; } ?>
						</td>
					</tr>
				</table>
			</td>
          </tr>
          <tr>
            <td height="7" colspan="4" class="DetailText"></td>
          </tr>
          <tr>
            <td colspan="4" class="table-title-b"><strong>Contact Detail</strong></td>
          </tr>
          <tr>
            <td class="DetailText"><strong>Phone No</strong> : <?php if(sizeof($query6)!=0) echo $query6->ym_phone; else echo $query8->mm_hphone; ?></td>
            <td colspan="2" class="DetailText"><strong>Email</strong> : <a class="linkEditDelete" href="mailto:<?php if(sizeof($query6)!=0) echo $query6->ym_email; else echo $query8->mm_email; ?>"><?php if(sizeof($query6)!=0) echo $query6->ym_email; else echo $query8->mm_email; ?></a></td>
          </tr>
          <tr>
            <td colspan="3" valign="top" align="left" class="DetailText"><strong>Address</strong>:  <?php if(sizeof($query6)!=0) echo $query6->ym_address; else echo $query8->mm_address; ?></td>
          </tr>
         <!-- <tr>
            <td class="DetailText"><strong>Citizen Of</strong> : </td>
			
            <td width="30%" class="DetailText">
				<strong>Country</strong> -
              <?php if(sizeof($query6)!=0) { if($query6->ym_citizen_country=='0' || $query6->ym_citizen_country==''){echo '';} else {$country=$this->dbyouthmilan->get_country_name($query6->ym_citizen_country);echo $country->countryname;}}  ?>
			</td>
            <td width="25%" class="DetailText">
				<strong>State</strong> -
              <?php if(sizeof($query6)!=0) { if($query6->ym_citizen_state=='0' || $query6->ym_citizen_state==''){echo '';} else {$state=$this->dbyouthmilan->get_state_name($query6->ym_citizen_state);echo $state->statename;}} ?>
			</td>
            <td width="26%" class="DetailText"><strong>City</strong> -  <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_city; ?></td>
          </tr>
          <tr>
            <td valign="top" align="left" class="DetailText"><strong>Living In</strong> :</td>
            <td class="DetailText"><strong>Country</strong> -
              <?php if(sizeof($query6)!=0) { if($query6->ym_living_country=='0' || $query6->ym_living_country==''){echo '';} else {$country=$this->dbyouthmilan->get_country_name($query6->ym_living_country);echo $country->countryname;}} ?></td>
            <td class="DetailText"><strong>State</strong> -
               <?php if(sizeof($query6)!=0) { if($query6->ym_living_state=='0' || $query6->ym_living_state==''){echo '';} else {$state=$this->dbyouthmilan->get_state_name($query6->ym_living_state);echo $state->statename;}} ?></td>
            <td class="DetailText"><strong>City</strong> -
              <?php if(sizeof($query6)!=0) echo $query6->ym_living_city; ?></td>
          </tr>-->
		  
		  <tr>
            <td colspan="3" valign="top" align="left" class="DetailText"><strong>Citizen of </strong>:  </td>
          </tr>
		  <tr>
            <td width="33%" class="DetailText">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>Country</strong> : <?php if(sizeof($query6)!=0) { if($query6->ym_citizen_country=='0' || $query6->ym_citizen_country==''){echo '';} else {$country=$this->dbyouthmilan->get_country_name($query6->ym_citizen_country);echo $country->countryname;}}  ?>
						</td>
					</tr>
				</table>			
			</td>
            <td valign="top" align="left" class="DetailText" width="39%">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>State</strong> :<?php if(sizeof($query6)!=0) { if($query6->ym_citizen_state=='0' || $query6->ym_citizen_state==''){echo '';} else {$state=$this->dbyouthmilan->get_state_name($query6->ym_citizen_state);echo $state->statename;}} ?>
						</td>
					</tr>
				</table>
			</td>
            <td class="DetailText" style="width:200px; margin-left:-45px; float:left; " align="left" >
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>City</strong> : <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_city; ?>
						</td>
					</tr>
				</table>
			</td>
          </tr>
		  
		  <tr>
            <td colspan="3" valign="top" align="left" class="DetailText"><strong>Living of </strong>:  </td>
          </tr>
		  <tr>
            <td width="33%" class="DetailText">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>Country</strong> : <?php if(sizeof($query6)!=0) { if($query6->ym_living_country=='0' || $query6->ym_living_country==''){echo '';} else {$country=$this->dbyouthmilan->get_country_name($query6->ym_living_country);echo $country->countryname;}} ?>
						</td>
					</tr>
				</table>			
			</td>
            <td valign="top" align="left" class="DetailText" width="39%">
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>State</strong> : <?php if(sizeof($query6)!=0) { if($query6->ym_living_state=='0' || $query6->ym_living_state==''){echo '';} else {$state=$this->dbyouthmilan->get_state_name($query6->ym_living_state);echo $state->statename;}} ?>
						</td>
					</tr>
				</table>
			</td>
            <td class="DetailText" style="width:200px; margin-left:-45px; float:left; " align="left" >
				<table width="100%" border="0" cellspacing="5" cellpadding="2">
					<tr>
						<td>
							<strong>City</strong> :<?php if(sizeof($query6)!=0) echo $query6->ym_living_city; ?>
						</td>
					</tr>
				</table>
			</td>
          </tr>
		  
		  
          <tr>
            <td width="19%" colspan="3" valign="top" align="left" class="DetailText"><strong>Living Status</strong>: <?php if(sizeof($query6)!=0) echo $query6->ym_living_status; ?></td>
          </tr>
          <tr>
            <td height="7" colspan="4" class="DetailText"></td>
          </tr>
          <tr>
            <td colspan="4" class="table-title-b"><strong>About Me</strong></td>
          </tr>
          <tr>
            <td valign="top" align="left" class="DetailText" colspan="3"><strong>About My Self </strong>: <?php if(sizeof($query7_1)!=0) echo $query7_1->ym_brief_about_self; ?></td>
          </tr>
        </tbody>
      </table>
      
  	</div>
	
    <div class="clearfix"></div>
  
 <?php $this->load->view('youth_milan/layout/footer'); ?>