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
<!--------------------------------------tab style--------------------------------------------------->
<?php $this->load->view('youth_milan/layout/header'); ?>
    
	<div class="photogallery">
	
      	<div class="logo-text2">More Detail</div>
      
      <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
       
	    <tr>
         
		  <td valign="top"><!-- Tabs -->
          <!--action="manageYouthMilan.php" onsubmit="return ValidateForm(this)" 
          <form method="post" action="" id="frmBasicInfo" name="frmBasicInfo">-->
		  
            <div id="tabs1">
              
			 <!-- <ul>
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
              </ul>-->
			  
			  <!--------------basic info tab---------------->
              
              <div id="tabs-1">

               
                	<table cellspacing="0" cellpadding="0" class="table-width" style="width:100%;">
                  	
					<tbody>
                    
					<tr>
                      
					  <td>
                          <input type="hidden" value="BasicInfo" id="Process" name="Process">
                          
						  <table width="100%" cellspacing="2" cellpadding="5">
                            
							<tbody>
                              
							  <tr valign="top"> 
								<td class="SubTitle BorderBtm" colspan="2"><div class="clsheader">Basic Information/ Physical Attributes</div></td>
							  </tr>
							  
                              <tr>
                                <td align="center" colspan="2"></td>
                              </tr>
							  
                              <tr>
							  
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Name </strong></td>
                                <td class="txtBlack13Arial">
									<?php if(sizeof($query1)!=0) echo $query1->ym_name; ?>
								</td>
								
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Gender </strong></td>
                                <td class="txtBlack13Arial">
                                  <?php if(sizeof($query1)!=0) echo $query1->ym_gender; ?>
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
									<?php if(sizeof($query1)!=0) echo $query1->ym_height; ?>
								</td>
								
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Weight</strong></td>
                                <td class="txtBlack13Arial">
									<?php if(sizeof($query1)!=0) echo $query1->ym_weight; ?>								
								</td>
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Body Type </strong></td>
                                <td class="txtBlack13Arial">
                                  <?php if(sizeof($query1)!=0) echo $query1->ym_body_type; ?>
								</td>
                              </tr>
							  
                              <tr>
                                <td width="33%" valign="top" align="right" class="txtBlack13Arial"><strong>Complexion</strong></td>
                                <td class="txtBlack13Arial">
                                  <?php if(sizeof($query1)!=0) echo $query1->ym_complexion; ?>
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
				
              
				
              </div>
			  
			  <!--------------end of basic info tab---------------->
			  
			  <!--------------social info tab---------------->
			  
              <div id="tabs-2">
			  
				<table width="100%" cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
				
                <tbody>
				<tr>
                    <td class="SubTitle BorderBtm" colspan="2"><div class="clsheader">Religious/ Social Background</div></td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="2"></td>
   				</tr>
				
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
				
                
				
            	</tbody>
			
				</table> 
			       
              </div>
			  
			  <!--------------end of social info tab---------------->
			  
			  <!-----------------astrological info tab--------------->
			  
             <div id="tabs-3">
			  
				<table width="100%" cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
				
                <tbody>
				<tr>
                    <td class="SubTitle BorderBtm" colspan="2"><div class="clsheader">Astrological Information</div></td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="2"></td>
   				</tr>
				
                <tr>
                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Age </strong></td>
                    <td class="txtBlack13Arial">
                    	<?php if(sizeof($query3)!=0) echo $query3->ym_age; ?>
                    </td>
					
                </tr>
				
                 <tr>
                    <td width="33%" align="right" class="txtBlack13Arial"><strong>Date of Birth </strong></td>
                   <td class="txtBlack13Arial">
                   		<?php if(sizeof($query3)!=0) echo $query3->ym_birth_date; ?>
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
						<?php if(sizeof($query3)!=0) echo $query3->ym_manglik; ?>
					</td>
                </tr>
				
                </tbody>
			
				</table> 
			       
              </div>
			
			<!-----------end of astrological info tab------------->
			
			<!------education and profession info tab---------->
			
            <div id="tabs-4">
                
                <table width="100%" cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
                
				<tbody>
				
				<tr>
                    <td class="SubTitle BorderBtm" colspan="3"><div class="clsheader">Educational and Professional Information</div></td>
              	</tr>
				
               	<tr>
    				<td align="center" colspan="2"></td>
   				</tr>
				
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
				</tbody>
				
				</table>
				
              </div>
			  
			  <!----------end of education and profession info tab------------->
			  
			  
			  <!---------- life style tab-------------->
			  
              <div id="tabs-5">
			  
               	<table width="100%" cellspacing="2" cellpadding="10" class="table-width" style="width:100%;">
    			
				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="2"><div class="clsheader">Life Style</div></td>
    			</tr>
    
				<tr>
        			<td width="3%" align="right" class="txtBlack13Arial"><strong>Diet Preferences  </strong></td>
        			<td class="txtBlack13Arial">
			           <?php if(sizeof($query5)!=0) echo $query5->ym_diet_preferences; ?>
        			</td>
					
    			</tr>
				
			    <tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Smoking  </strong></td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query5)!=0) echo $query5->ym_smoking; ?>
			        </td>
					
			    </tr>
    
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Drinking  </strong></td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query5)!=0) echo $query5->ym_drinking; ?>
			        </td>
					
			    </tr>
				</tbody>
				
				</table>
				
              </div>
			  
			  <!---------------end of life style tab----------------->
			  
			  <!------------------location contact info tab-------------------->
			  
              <div id="tabs-6">
			  
                <table width="100%" cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
    			
				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="2"><div class="clsheader">Location / Contact Information</div></td>
    			</tr>
     			
				<tr>
			        <td align="center" colspan="2"></td>
			    </tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Citizen of Country</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_country; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Citizen of State</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_state; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Citizen of City</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_citizen_city; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Living of Country</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_living_country; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Living of State</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_living_state; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Living of City</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_living_city; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Living Status</strong> </td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_living_status; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Contact Address</strong></td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_address; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Contact Phone Number</strong></td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_phone; ?>
			        </td>
				</tr>
				
				<tr>
			        <td width="31%" align="right" class="txtBlack13Arial"><strong>Email</strong></td>
			        <td class="txtBlack13Arial">
			             <?php if(sizeof($query6)!=0) echo $query6->ym_email; ?>
			        </td>
				</tr>
    
				</tbody>
				
				</table>
				
              </div>
			  
			  <!----------------------end of location contact info tab------------------------>
			  
			  <!------------------brief info tab------------------->
			  
              <div id="tabs-7">
			  
               	<table width="100%" cellspacing="2" cellpadding="5" class="table-width" style="width:100%;">
  
  				<tbody>
				
				<tr>
        			<td class="SubTitle BorderBtm" colspan="3"><div class="clsheader">Brief About his/her self</div></td>
    			</tr>
    
				<tr>
        			<td align="center" colspan="2"></td>
    			</tr>
	
				<tr>
        			<td width="31%" align="right" class="txtBlack13Arial"><strong>Brief of About his/her self</strong></td>
       				<td class="txtBlack13Arial" colspan="3">
						<?php if(sizeof($query7_1)!=0) echo $query7_1->ym_brief_about_self; ?>
					</td>
    			</tr>
    
				<tr>
        			<td width="31%" valign="top" align="right" class="txtBlack13Arial"><strong>Photo</strong></td>
					
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
    			</tr>
    
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
            </div>
            </td>
        </tr>
		
      </table>
      
    </div>
	
    <div class="clearfix"></div>
  
 <?php $this->load->view('youth_milan/layout/footer'); ?>