<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbheader->get_setting(); ?>
        <div style="float:left; width:100%; margin-bottom:20px;">
        <span style="float:left;">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/spcs_convention/{logo2}');?>" border="0" /></a>
        </span>
        <span style="float:left; margin-left:20px; font-size:24px;">
        {con_title}
        </span>
        <span style="float:left; margin-left:30px;">
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/spcs_convention/{logo}');?>" border="0" /></a>
        </span>
        </div>
        <br /><br />
        Hi {con_hdn_first_name}<br/><br />
        Thank you for registering with {sitename}.<br /><br />
        
    	<div><b>Login Email :</b> {con_hdn_email}</div>
		<br /><br />
        
    </td>
  </tr>
</table>
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
                SPCS Chapter:<b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_ch_name}</b>
                </div>
           </td>
           <td style="width:60%;" colspan="2">
           <div style="float:left;" class="ped_l">
                 Life Member Number :    {con_hdn_lm_number}
                </div>
           </td>
           </tr>
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                Registration Number : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_reg_number}</b>
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                 Payment Method : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_payment_method}</b>
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                 Payment Status : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_payment_status}</b>
                </div>
           </td>
           </tr>
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                Last name : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_last_name}</b>
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                 First Name :  <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_first_name}</b>
                </div>
           </td>
           <td>
				<div style="float:left;" class="ped_l">
                Address : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_addr}</b>
                </div>
           </td>
           </tr>
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                
                City : <b>{con_hdn_city}</b>
                
                </div>
           </td>
           <td>
           		<div style="float:left;" class="ped_l">
                
                State : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_state}</b>
                </div>
           </td>
           <td>
				<div style="float:left;" class="ped_l">
                <div class="<?php if(form_error('txtzipcode')){ echo "error";}?>"> 
            	<div class="controls">
                    Zip Code : {zipcode}
                </div>
           		</div>
                </div>
           </td>
            
           </tr>
            
           <tr>
           <td>
           		<div style="float:left;" class="ped_l">
                Phone No (H) : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_phnH}</b>
                </div>
           </td>
           <td colspan="2">
           		 <div style="float:left;" class="ped_l">
                (C) : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_phnC}</b>
                </div>
           </td>
            
           </tr>
           <tr>
           <td colspan="3">
           		<div style="float:left;" class="ped_l">
                Email : <b style=" border-bottom:0px solid #000; padding-bottom:3px;">{con_hdn_email}</b>
                </div>
           </td>
           </tr>
           <tr>
           <td colspan="3">
           		<div style="float:left;" class="ped_l">
         		<div class="<?php if(form_error('txtem_con_name')){ echo "error";}?>">
            	<div class="controls">
				Emergency Contact Name(Not Listed Below) :{con_em_name}
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
				<label style="width:68px; float:left">Phone :</label>{con_em_number}
                </div>
				</div>
				</div>
           </td>
		   </tr>
           
</table>
<div style="width:100%; margin-top:10px; margin-bottom:10px;">
        <b>{life_member_text}</b>
</div>
<div style="width:100%; margin-top:10px; margin-bottom:10px;">
        <b>Members and Family Members</b>
</div>
<table width="100%"  border="1" style="" >
				<tr>
                	
                    <th class="title-bor" width="24%">Name of Attendees</th>
                    <th class="title-bor" width="10%">Relationship</th>
                    <th class="title-bor" width="12%">DOB</th>
                    <th class="title-bor" width="7%">Age</th>
                    <th class="title-bor" width="15%">Menu Choice<br />T/C</th>
                    <th class="title-bor"  width="15%">Age Group<br />(A-E)</th>
                    <th class="title-bor" width="10%">Fee</th>
                    
                  </tr>
                  
                  
</table>
{member}
<table width="100%" border="1" class="add_rm_before" style="">
                      <tr>
                          <td width="82%"   style=" color:#469AE9; border:solid #000 1px;"><b>Total</b></td>
                          <td width="9%"   style=" text-align:center">
                          {total_fees}
                          </td>                  
                      </tr>    
</table>
<div style="width:100%; margin-top:10px; margin-bottom:10px;">
        <b>Activity Registration List:</b>
</div>
<table width="100%"  border="1" style="" >
				<tr>
                	
                    <th class="title-bor" width="40%">Activity</th>
                    <th class="title-bor" width="20%">Number of Participants</th>
                    <th class="title-bor" width="20%">T-Shirt Size</th>
                    <th class="title-bor" width="20%">Amount</th>
                                        
                  </tr>
                  
                  
</table>
{activities}
<table width="100%" border="1" class="add_rm_before" style="">
                      <tr>
                          <td width="82%"   style=" color:#469AE9; border:solid #000 1px;"><b>Total</b></td>
                          <td width="9%"   style=" text-align:center">
                          {activity_fee}
                          </td>                  
                      </tr>    
</table>

<div style="width:100%; margin-top:10px; margin-bottom:10px;">
        {total_payment_with_paypal_fee_text}
</div>

<!-- {event} -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
        <div style="margin-top:10px;">
        Thank you,<br />
        {sitename} Team
        </div>
  </tr>
</table>
