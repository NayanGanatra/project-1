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
<!--<div class="photogallery" >

	<div class="logo-text2">More Detail</div>
	
	<div style="padding-left:600px">
	
		<a title="<?php echo $query7_2->ym_photo; ?>" href="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $query7_2->ym_photo; ?>" rel="lightbox">
			<img  src="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $query7_2->ym_photo; ?>" height="120" width="120"/>
		</a>
	</div>
	
	<a class="more_detail1" onclick="tab1()" >Basic Info</a><br>
	
	<div id="tab1" style="padding-top:10px;display:none; background-color:white" >
	
			<table class="more_detail">
		
			<tr>
			
				<td>Name:</td>
				
				<td><?php echo $query1->ym_name; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Gender:</td>
				
				<td><?php echo $query1->ym_gender; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Marital Status:</td>
				
				<td><?php echo $query1->ym_marital_status; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Having Children:</td>
				
				<td><?php echo $query1->ym_children; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Height:</td>
				
				<td><?php echo $query1->ym_height; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Weight:</td>
				
				<td><?php echo $query1->ym_weight; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Body Type:</td>
				
				<td><?php echo $query1->ym_body_type; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Complexion:</td>
				
				<td><?php echo $query1->ym_complexion; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Physical Status:</td>
				
				<td><?php echo $query1->ym_physical_status; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Blood Group:</td>
				
				<td><?php echo $query1->ym_blood_group; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
		<a class="more_detail1" onclick="tab2()" >Social Relogious Info</a><br>
		
		<div id="tab2" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Mother Tongue:</td>
				
				<td><?php echo $query2->ym_mother_tongue; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Religion/Community:</td>
				
				<td><?php echo $query2->ym_community; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Caste/Sect:</td>
				
				<td><?php echo $query2->ym_caste; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Sub Caste/Sect:</td>
				
				<td><?php echo $query2->ym_sub_caste; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Gothram:</td>
				
				<td><?php echo $query2->ym_gothram; ?></td>
			
			</tr>
			
			</table>
		
		</div>
		
		<a class="more_detail1" onclick="tab3()" >Astrological Info</a><br>
		
		<div id="tab3" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Age:</td>
				
				<td><?php echo $query3->ym_age; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Date of Birth:</td>
				
				<td><?php echo $query3->ym_birth_date; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Time of Birth:</td>
				
				<td><?php echo $query3->ym_birth_time; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Place of Birth:</td>
				
				<td><?php echo $query3->ym_birth_place; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Star Sign/Nakshatra:</td>
				
				<td><?php echo $query3->ym_nakshatra; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Moon Sign/Raasi:</td>
				
				<td><?php echo $query3->ym_raasi; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Manglik/Dosham:</td>
				
				<td><?php echo $query3->ym_manglik; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
		<a class="more_detail1" onclick="tab4()" >Education and Professional Info</a><br>
		
		<div id="tab4" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Degree Level:</td>
				
				<td><?php echo $query4->ym_degree_level; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Area Of Study:</td>
				
				<td><?php echo $query4->ym_study_area; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Education In Detail:</td>
				
				<td><?php echo $query4->ym_education_detail; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Occupation:</td>
				
				<td><?php echo $query4->ym_occupation; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Occupation In Detail:</td>
				
				<td><?php echo $query4->ym_occupation_detail; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Annual Income:</td>
				
				<td><?php echo $query4->ym_annual_income; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
		<a class="more_detail1" onclick="tab5()" >Life Style</a><br>
		
		<div id="tab5" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Diet Preferences:</td>
				
				<td><?php echo $query5->ym_diet_preferences; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Smoking:</td>
				
				<td><?php echo $query5->ym_smoking; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Drinking:</td>
				
				<td><?php echo $query5->ym_drinking; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
		<a class="more_detail1" onclick="tab6()" >Location Contact Info</a><br>
		
		<div id="tab6" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Citizen of Country:</td>
				
				<td><?php echo $query6->ym_citizen_country; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Citizen of State:</td>
				
				<td><?php echo $query6->ym_citizen_state; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Citizen of City:</td>
				
				<td><?php echo $query6->ym_citizen_city; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Living in Country:</td>
				
				<td><?php echo $query6->ym_living_country; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Living in State:</td>
				
				<td><?php echo $query6->ym_living_state; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Living in City:</td>
				
				<td><?php echo $query6->ym_living_city; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Contact Address:</td>
				
				<td><?php echo $query6->ym_address; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Contact Phone Number:</td>
				
				<td><?php echo $query6->ym_phone; ?></td>
			
			</tr>
			
			<tr>
			
				<td>Email:</td>
				
				<td><?php echo $query6->ym_email; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
		<a class="more_detail1" onclick="tab7()" >Brief about his/her Self</a><br>
		
		<div id="tab7" style="padding-top:10px;display:none; background-color:white">
			
			<table class="more_detail">
			
			<tr>
			
				<td>Brief of About his/her self:</td>
				
				<td><?php echo $query7_1->ym_brief_about_self; ?></td>
			
			</tr>
			
			</table>
			
		</div>
		
</div>-->



<script>
/*
function tab1()
{
	$("#tab1").toggle(1000);
}

function tab2()
{
	$("#tab2").toggle(1000);
}

function tab3()
{
	$("#tab3").toggle(1000);
}

function tab4()
{
	$("#tab4").toggle(1000);
}

function tab5()
{
	$("#tab5").toggle(1000);
}

function tab6()
{
	$("#tab6").toggle(1000);
}

function tab7()
{
	$("#tab7").toggle(1000);
}*/
</script>


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
		<div class="logo-text2">More Detail <input type="button" onclick="window.location='<?php echo base_url().'youth_milan/registration/search'; ?>'" class="btn btn-primary" value="Go back to search profile" id="go_back" name="go_back" style="float:right;"></div>
		
      	<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
       
	    <tr>
         
		  <td valign="top">
          <!--action="manageYouthMilan.php" onsubmit="return ValidateForm(this)" 
          <form method="post" action="" id="frmBasicInfo" name="frmBasicInfo">-->
		  
             
			  
			  
			<div id="tabs-1">
			  
               	<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
    			
				<tbody>
    
				<tr>
					<td width="10%" style="padding-left:15px;padding-right:50px;">
						<table style=" width:100%; padding-top:-10px;">
							<tr>
								<td>
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
													<img  src="<?php echo base_url(); ?>images/youth_milan/profile/nophoto.jpg" height="225" width="200" style="height:225px;width:200px;"/>
													
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
													            <a href="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $photo->ym_photo; ?>">
													            	<img src="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo$photo->ym_photo; ?>" title="<?php echo $photo->ym_photo; ?>" alt="profile images" style="height:65px; width:74px;" >
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
										<img  src="<?php echo base_url(); ?>images/youth_milan/profile/nophoto.jpg" height="225" width="200" style="height:225px;width:200px;"/>
											
										<?php
									}
									?>
									<!---------------end---------------->
								</td>
								
							</tr>
							
						</table>
													
					</td>
			
					<td width="80%" valign="top">
					<!--------------basic info tab---------------->
              
						<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;" >
						<tbody>
							<tr>
                    			<td class="SubTitle BorderBtm" colspan="2"><div class="logo-text2" style="margin-right:0;margin-left:10px;">Basic Information/ Physical Attributes</div></td>
              				</tr>
							
							
							<tr>
								<td width="40%">
								<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;">
									<tbody>
									
										<tr>
										  
						                    <td width="50%" valign="top" align="right" class="txtBlack13Arial"><strong>Name </strong></td>
						                    <td class="txtBlack13Arial">
												<!--updated by dharati 201309261720-->
												<?php if(sizeof($query1)!=0) echo $query1->ym_name; else $query8->mm_fname." ".$query8->mm_lname; ?>
												<!--end-->
											</td>
														
										</tr>
													  
						               	<tr>
						                    <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Gender </strong></td>
						                    <td class="txtBlack13Arial">
												<!--updated by dharati 201309261720-->
						                    	<?php if(sizeof($query1)!=0) echo $query1->ym_gender; else{if($query8->mm_gender==false) echo "Male"; else echo "Female";} ?>
												<!--end-->
											</td>
														
						                    </tr>
													  
						                    <tr>
						                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Marital Status </strong></td>
						                        <td class="txtBlack13Arial">
						                        	<?php if(sizeof($query1)!=0) echo $query1->ym_marital_status; ?>
												</td>
														  
						                    </tr>
													  
						                    <tr>
						                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Having Children </strong></td>
						                        <td class="txtBlack13Arial">
						                       		<?php if(sizeof($query1)!=0) echo $query1->ym_children; ?>
												</td>
														  
						                    </tr>
													  
						                    <tr>
						                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Height </strong></td>
						                        <td class="txtBlack13Arial">
													<?php if(sizeof($query1)!=0) echo $query1->ym_height." "."cms"; ?>
												</td>
														
						                    </tr>
									
										</tbody>
										
									</table>
								</td>
						
								<td width="50%">
									
									<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;">
										<tbody>
										
											<tr>
					                        <td valign="top" align="right" class="txtBlack13Arial"><strong>Weight </strong></td>
											<td class="txtBlack13Arial">
								           <?php if(sizeof($query1)!=0) if($query1->ym_weight=='0' || $query1->ym_weight=='') { echo ''; }else { echo $query1->ym_weight." "."kgs / ".round($query1->ym_weight*2.20462)." lbs"; }?>
					        				</td>
					                       </tr>
												  
					                    <tr>
					                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Body Type </strong></td>
											<td class="txtBlack13Arial">
						           <?php if(sizeof($query1)!=0) if($query1->ym_body_type=='0' || $query1->ym_body_type=='') { echo ''; }else { echo $query1->ym_body_type; } ?>
			        			</td>
					                    </tr>
												  
					                    <tr>
					                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Complexion</strong></td>
					                        <td class="txtBlack13Arial">
						           <?php if(sizeof($query1)!=0) if($query1->ym_complexion=='0' || $query1->ym_complexion=='') { echo ''; }else { echo $query1->ym_complexion; } ?>
			        			</td>
											
					                            </tr>
												  
					                    <tr>
					                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Physical Status </strong></td>
					                        <td class="txtBlack13Arial">
												<?php if(sizeof($query1)!=0) echo $query1->ym_physical_status; ?>
											</td>
													
					                    </tr>
												  
					                    <tr>
					                        <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Blood Group</strong></td>
					                        <td class="txtBlack13Arial">
												<?php if(sizeof($query1)!=0) echo $query1->ym_blood_group; ?>
											</td>
					                    </tr>
									
										
									
										</tbody>
										
									</table>
								
							 	</td>
								
							</tr>
									
						</tbody>
					
					</table>
					
					<!--------------end of basic info tab---------------->
					</td>
				
				</tr>
				
				</tbody>
				
			</table>
				
           </div>
			
			  <!--------------social info tab---------------->
              <div id="tabs-2">
			  
				<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
				
                <tbody>
				<tr>
                    <td class="SubTitle BorderBtm" colspan="2"><div class="logo-text2">Religious/ Social Background</div></td>
              	</tr>
				
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Mother Tongue </strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query2)!=0) echo $query2->ym_mother_tongue; ?>
			                    </td>
								
			                </tr>
							
			                <tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Religion/Community </strong></td>
			                   <td class="txtBlack13Arial">
			                   		<?php if(sizeof($query2)!=0) echo $query2->ym_community; ?>
			                   </td>
							   
			                </tr>
							
			                <tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Caste/Sect </strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query2)!=0) echo $query2->ym_caste; ?>
			                    </td>
								
			                </tr>
						
						</tbody>
					</table>
					</td>
			
				<td width="50%">
				
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;" >
						<tbody>
						
							<tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Sub Caste/Sect</strong></td>
			                   	<td class="txtBlack13Arial">
									<?php if(sizeof($query2)!=0) echo $query2->ym_sub_caste; ?>
								</td>
			                </tr>
							
			                 <tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Gothram</strong></td>
			                   	<td class="txtBlack13Arial">
									<?php if(sizeof($query2)!=0) echo $query2->ym_gothram; ?>
								</td>
			                </tr>
							
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"></td>
			                    <td class="txtBlack13Arial">&nbsp;</td>
								
			                </tr>
						
						</tbody>
					</table>
					</td>
				</tr>
				
            	</tbody>
			
				</table> 
			       
              </div>
			  
			  <!--------------end of social info tab---------------->
			  
			  <!-----------------astrological info tab--------------->
			  
             <div id="tabs-3">
			  
				<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
				
                <tbody>
				<tr>
                    <td class="SubTitle BorderBtm" colspan="2"><div class="logo-text2">Astrological Information</div></td>
              	</tr>
				
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Age </strong></td>
			                    <td class="txtBlack13Arial">
						           <?php if(sizeof($query3)!=0) if($query3->ym_age=='0' || $query3->ym_age=='') { echo ''; }else { echo $query3->ym_age; } ?>
			        			</td>
								
			                </tr>
							
			                 <tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Date of Birth </strong></td>
			                   <td class="txtBlack13Arial">
							   
							   		<!-------------updated by dharati 201309271130----------------->
			                   		<?php if(sizeof($query3)!=0) echo $query3->ym_birth_date; else echo $query8->mm_birth_year."-".$query8->mm_birth_month; ?>
									<!-------------end----------------->
			                   </td>
							   
			                </tr>
							
			                <tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Time of Birth </strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query3)!=0) echo $query3->ym_birth_time; ?>
			                    </td>
								
			                </tr>
				
			                <tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Place of Birth</strong></td>
			                   	<td class="txtBlack13Arial">
									<?php if(sizeof($query3)!=0) echo $query3->ym_birth_place; ?>
								</td>
			                </tr>
						
						</tbody>
					</table>
					</td>
			
				<td width="50%">
				
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;" >
						<tbody>
						
							<tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Star Sign/Nakshatra</strong></td>
			                   	<td class="txtBlack13Arial">
									<?php if(sizeof($query3)!=0) echo $query3->ym_nakshatra; ?>
								</td>
			                </tr>
							
							<tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Moon Sign/Raasi</strong></td>
			                   	<td class="txtBlack13Arial">
									<?php if(sizeof($query3)!=0) echo $query3->ym_raasi; ?>
								</td>
			                </tr>
							
							<tr>
			                   	<td width="33%" align="right" class="txtBlack13Arial"><strong>Manglik/Dosham</strong></td>
								<td class="txtBlack13Arial">
						           <?php if(sizeof($query3)!=0) if($query3->ym_manglik=='0' || $query3->ym_manglik=='') { echo ''; }else { echo $query3->ym_manglik; } ?>
			        			</td>
			                </tr>
							
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"></td>
			                    <td class="txtBlack13Arial">&nbsp;</td>
								
			                </tr>
				
						</tbody>
					</table>
					</td>
				</tr>
				
                </tbody>
			
				</table> 
			       
              </div>
			
			<!-----------end of astrological info tab------------->
			
			<!------education and profession info tab---------->
			
            <div id="tabs-4">
                
                <table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
                
				<tbody>
				
				<tr>
                    <td class="SubTitle BorderBtm" colspan="3"><div class="logo-text2">Educational and Professional Information</div></td>
              	</tr>
				
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Education-Degree Level</strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query4)!=0) echo $query4->ym_degree_level; ?>
			                    </td>
								
			                </tr>
							
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Area Of Study</strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query4)!=0) echo $query4->ym_study_area; ?>
			                    </td>
								
			                </tr>
							
			             
			              
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Occupation</strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query4)!=0) echo $query4->ym_occupation; ?>
			                    </td>
								
			                </tr>
							
						</tbody>
					</table>
					</td>
			
				<td width="50%">
				
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;" >
						<tbody>
						
							<tr>
			                   <td width="33%" align="right" class="txtBlack13Arial"><strong>Occupation Detail</strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query4)!=0) echo $query4->ym_occupation_detail; ?>
			                    </td>
			                </tr>
							
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Annual Income</strong></td>
			                    <td class="txtBlack13Arial">
			                    	<?php if(sizeof($query4)!=0) echo $query4->ym_annual_income; ?>
			                    </td>
								
			                </tr>
							
							<tr>
			                    <td width="33%" align="right" class="txtBlack13Arial"></td>
			                    <td class="txtBlack13Arial">&nbsp;</td>
								
			                </tr>
				
						</tbody>
					</table>
					</td>
				</tr>
				
				</tbody>
				
				</table>
				
              </div>
			  
			  <!----------end of education and profession info tab------------->
			  
			  
			  <!---------- life style tab-------------->
			  
              <div id="tabs-5">
			  
               	<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
    			
				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="2"><div class="logo-text2">Life Style</div></td>
    			</tr>
    
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
			        			<td width="33%" align="right" class="txtBlack13Arial"><strong>Diet Preferences  </strong></td>
			        			<td class="txtBlack13Arial">
						           <?php if(sizeof($query5)!=0) if($query5->ym_diet_preferences=='0' || $query5->ym_diet_preferences=='') { echo ''; }else { echo $query5->ym_diet_preferences; } ?>
			        			</td>
								
			    			</tr>
							
						    <tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Smoking  </strong></td>
								<td class="txtBlack13Arial">
						           <?php if(sizeof($query5)!=0) if($query5->ym_smoking=='0' || $query5->ym_smoking=='') { echo ''; }else { echo $query5->ym_smoking; } ?>
			        			</td>
								
						    </tr>
			    
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Drinking  </strong></td>
								<td class="txtBlack13Arial">
						           <?php if(sizeof($query5)!=0) if($query5->ym_drinking=='0' || $query5->ym_drinking=='') { echo ''; }else { echo $query5->ym_drinking; } ?>
			        			</td>
								
						    </tr>
						
						</tbody>
					</table>
					</td>
			
					<td width="50%">
					</td>
				
				</tr>
				
				</tbody>
				
				</table>
				
              </div>
			  
			  <!---------------end of life style tab----------------->
			  
			  <!------------------location contact info tab-------------------->
			  
              <div id="tabs-6">
			  
                <table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
    			
				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="2"><div class="logo-text2">Location / Contact Information</div></td>
    			</tr>
     			
				
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Citizen of Country</strong> </td>
						        <td class="txtBlack13Arial">
						             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_country; ?>
						        </td>
							</tr>
							
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Citizen of State</strong> </td>
						        <td class="txtBlack13Arial">
						             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_state; ?>
						        </td>
							</tr>
							
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Citizen of City</strong> </td>
						        <td class="txtBlack13Arial">
						             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_city; ?>
						        </td>
							</tr>
							
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Living of Country</strong> </td>
						        <td class="txtBlack13Arial">
						             <?php if(sizeof($query6)!=0) echo $query6->ym_living_country; ?>
						        </td>
							</tr>
							
							<tr>
						        <td width="33%" align="right" class="txtBlack13Arial"><strong>Living of State</strong> </td>
						        <td class="txtBlack13Arial">
						             <?php if(sizeof($query6)!=0) echo $query6->ym_living_state; ?>
						        </td>
							</tr>
				
						</tbody>
					</table>
					</td>
			
				<td width="50%">
				
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:20px;" >
						<tbody>
						<tr>
					        <td width="31%" align="right" class="txtBlack13Arial"><strong>Living of City</strong> </td>
					        <td class="txtBlack13Arial">
					             <?php if(sizeof($query6)!=0) echo $query6->ym_living_city; ?>
					        </td>
						</tr>
						
						<tr>
					        <td width="33%" align="right" class="txtBlack13Arial"><strong>Living Status</strong> </td>
					        <td class="txtBlack13Arial">
					             <?php if(sizeof($query6)!=0) echo $query6->ym_living_status; ?>
					        </td>
						</tr>
						
						<tr>
					        <td width="33%" align="right" class="txtBlack13Arial"><strong>Contact Address</strong></td>
					        <td class="txtBlack13Arial">
								<!--updated by dharati 201309261720-->
					            <?php if(sizeof($query6)!=0) echo $query6->ym_address; else echo $query8->mm_address; ?>
								<!--end-->
					        </td>
						</tr>
						
						<tr>
					        <td width="33%" align="right" class="txtBlack13Arial"><strong>Contact Phone Number</strong></td>
					        <td class="txtBlack13Arial">
								<!--updated by dharati 201309261720-->
					            <?php if(sizeof($query6)!=0) echo $query6->ym_phone; else echo $query8->mm_hphone; ?>
								<!--end-->
					        </td>
						</tr>
						
						<tr>
					        <td width="33%" align="right" class="txtBlack13Arial"><strong>Email</strong></td>
					        <td class="txtBlack13Arial">
								<!--updated by dharati 201309261720-->
					            <?php if(sizeof($query6)!=0) echo $query6->ym_email; else echo $query8->mm_email; ?>
								<!--end-->
					        </td>
						</tr>
				
					</tbody>
					</table>
				</td>
				</tr>
		
				</tbody>
				
				</table>
				
              </div>
			  
			  <!----------------------end of location contact info tab------------------------>
			  
			  <!------------------brief info tab------------------->
			  
              <div id="tabs-7">
			  
               	<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
  
  				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="3"><div class="logo-text2">Brief About his/her self</div></td>
    			</tr>
    
				<tr>
					<td width="40%">
					<table cellspacing="2" cellpadding="5" class="table-width" style="width:100%; margin-left:200px;">
						<tbody>
						
							<tr>
			        			<td width="33%" align="right" class="txtBlack13Arial"><strong>Brief of About his/her self</strong></td>
			       				<td class="txtBlack13Arial" colspan="3">
									<?php if(sizeof($query7_1)!=0) echo $query7_1->ym_brief_about_self; ?>
								</td>
			    			</tr>
    
						</tbody>
						
					</table>
					</td>
			
					<td width="50%">
					</td>
				
				</tr>
				

				
				<!--<tr>
        			<td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Photo</strong></td>
					
					<?php
						if(sizeof($query7_2)==0)
						{
							$photo1="nophoto.jpg";
						}
						else if($query7_2->ym_photo=='')
						{
							$photo1="nophoto.jpg";
						}
						else
						{
							$photo1=$query7_2->ym_photo;
						}
					?>
					
      				<td class="txtBlack13Arial" colspan="3">
                 		<a title="<?php echo $photo1; ?>" href="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $photo1; ?>" rel="lightbox">
							<img  src="<?php echo base_url(); ?>images/youth_milan/profile/<?php echo $photo1; ?>" height="120" width="120"/>
						</a>
					</td>
    			</tr>-->
    
				<!--<tr>
    				<td></td>
    				<td align="left">
						<input type="button" class="btn btn-primary" value="Next" onclick="update7()">
					</td>
    			</tr>-->
				
				</tbody>
				
				</table>
								
             </div>
			 
			 <!------------------end of brief info tab--------------------->
            
		
            </td>
        </tr>
		
      </table>
      
  	</div>
	
    <div class="clearfix"></div>
  
 <?php $this->load->view('youth_milan/layout/footer'); ?>