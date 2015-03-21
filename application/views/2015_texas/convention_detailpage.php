 <style>
 .facebook-l  li{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important; border:none !important; background:none !important;
	 
 }
 
 .facebook-l  li:hover{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important; border:none !important; background:none !important;
	 
 }
 
  .facebook-l{
	  width:100%;
	  float:left;
 }
 ul.discover-item {
   margin:0px;
    min-height: 51px;
    list-style:none;
	
	}
	
ul.discover-item li{
    background: none repeat scroll 0 0 padding-box #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.1);
   /* border-bottom: 1px solid rgba(0, 0, 0, 0.1);*/
	 padding: 9px 12px;
	 margin:0 0 8px 0;
}
ul.discover-item li:hover{ padding: 9px 12px;
    background:#f5f5f5; transition: background-position 0.3s ease-in-out 0s;

}


body {
font-family: 'Raleway', sans-serif;
}
.main{
width:auto;
position:relative;
top: 10%;
left: 30%;

}
#form_head{
text-align: center;
background-color: #FEFFED;
height: 66px;
margin: 0 0 -29px 0;
padding-top: 35px;
border-radius: 8px 8px 0 0;
color: rgb(97, 94, 94);
}
#content {
position: relative;
width: 481px;
height: auto;
border: 2px solid gray;
border-radius: 10px;
margin-top: 20px;
margin-left: -60px;
}
#content_result{
position: relative;
width: 522px;
height: auto;
border: 2px solid gray;
padding-bottom: 40px;
border-radius: 10px;
margin-left: 559px;
margin-top: -645px;
}
#form_input{
margin-left: 50px;
margin-top: 36px;
}
label{
margin-right: 6px;
font-weight: bold;
}

#form_button{
padding: 0 21px 15px 15px;
position: relative;
bottom: 0px;
width: 445px;
background-color: #FEFFED;
border-radius: 0px 0px 8px 8px;
border-top: 1px solid #9A9A9A;
}
.submit{
font-size: 16px;
background: linear-gradient(#ffbc00 5%, #ffdd7f 100%);
border: 1px solid #e5a900;
color: #4E4D4B;
font-weight: bold;
cursor: pointer;
width: 300px;
border-radius: 5px;
padding: 10px 0;
outline: none;
margin-top: 20px;
margin-left: 15%;
}
.submit:hover{
background: linear-gradient(#ffdd7f 5%, #ffbc00 100%);
}
.label_output{
color:#4A85AB;
margin-left: 10px;
}
.dropdown_box{
height:40px;
width:240px;
border-radius:3px;
background-color:#FEFFED;
}
#result_id{
text-align: center;
background-color: #FCD6F4;
height: 47px;
margin: 0 0 -29px 0;
padding-top: 12px;
border-radius: 8px 8px 0 0;
color: rgb(97, 94, 94);
}
#result_show{
margin-top: 35px;
margin-left: 45px;
}
.input_box{
height:40px;
width:240px;
padding:20px;
border-radius:3px;
background-color:#FEFFED;
}
#checkbox_list{
margin-left: 143px;
margin-top: -36px;
}
ul{
position: absolute;
list-style: none;
}
.qual_output{
margin-left: 176px;
margin-top: -17px;
}
#radio_list{
margin-left: 143px;
margin-top: -18px;
}
.textarea_input{
margin-left: 145px;
margin-top: -16px;
}
.upload{
margin-left: 144px;
margin-top: -19px;
}
textarea{
background-color:#FEFFED;
}
.address_div{
width: 50px;
height:auto;
}
pre.address_output{
font-family: 'Raleway', sans-serif;
margin-top: -19px;
margin-left: 217px;
width:500px;
height:auto;
font-size: 16px;
word-wrap: break-word;
}


.content_gallery_item{width:100%; float:left;}
.content_gallery_item h2{width:70%; float:left; font-size:24px; line-height:15px;}
.content_gallery_item .TIME-COLOR{width:30%; float:right; color:#990000;line-height:26px; text-align:right;}
 </style>
 <script>
 function fb_click(url,desc,title,id){
//var image='http://www.spcsusa.org/images/spcs_convention/convention-logo.png';
var image='http://loca
lhost/spcsusa/images/spcs_convention/convention-logo.png';
	 var id=window.open('https://www.facebook.com/dialog/feed?app_id=721442517869860&link='+url+'&picture=http://www.dealbind.com/site/media/images/dealimages/deal1440976.jpg&name=Stick+n+Click&caption=Check Out What I Found On DealBind.com&description=www.DealBind.com&message=www.DealBind.com&redirect_uri='+url,
	  
	  'feed',	 
      'width=626,height=436'
	  ); 
	  
	  
	  return false;
}
</script>
 <?php 
if(count($page_detail) != 0)
{
?>

<div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Post</div>
       <div class="row-fluid">
           <div class="span8" style="width:100%">		
                        <h2 style="font-size:24px;"><?php echo $page_detail->page_title;?></h2>
             			<p class="TIME-COLOR"><?php echo $page_detail->page_created_date;?></p>
             			<p><?php echo $page_detail->page_content;?>
<div class="main">
<div id="content">
<h2 id="form_head">Sponsorship Details</h2>
<div id="form_input">
<?php

//create  form open tag
echo form_open('/2015/texas/convention/detail_page/15/data_submitted');

//create label
echo form_label('Sponsor Name');

//create name input field
$data_name = array(
'name' => 'emp_name',
'id' => 'emp_name_id',
'class' => 'input_box',
'placeholder' => 'Please Enter Name'
);
echo form_input($data_name);
echo form_label('Sponsor Email-ID');

//create email input field
$data_email = array(
'type' => 'email',
'name' => 'emp_email',
'id' => 'e_email_id',
'class' => 'input_box',
'placeholder' => 'Please Enter Email'
);
echo form_input($data_email);







//create dropdown box
echo form_label('Sponsorship Type');

$data_sponsor = array(
'Other' => 'Other Sponsorships...........',
'Grand' => 'Grand Sponsor',
'Platinum' => 'Platinum Sponsor',
'Gold' => 'Gold Sponsor',
'Ld' => 'Lunch or Dinner Sponsor',
'Bs' => 'Breakfast or Snack Sponsor',
'Silver' => 'Silver Sponsor',
'Program' => 'Program Sponsor',
'Family' => 'Family Sponsor',
'Samaj' => 'Samaj Sponsor',
'Well' => 'Well Sponsor'

);
echo form_dropdown('select', $data_sponsor, 'Grand', 'class="dropdown_box"');




?>
</div>
<div id="form_button">

<!--create reset button-->
<?php echo form_reset('reset', 'Reset', "class='submit'"); ?>

<!--create submit button-->
<?php echo form_submit('submit', 'Submit', "class='submit'"); ?>
</div>

<!--close form tag-->
<?php echo form_close(); ?>
<?php

//check whether the value send from data_submitted() function of controller is set or not
if (isset($employee_name)) {
$checkbox_value = unserialize($employee_qualification);
echo "<div id='content_result'>";
echo "<h3 id='result_id'>You have submitted these values</h3>";
echo "<div id='result_show'>";
echo "<label class='label_output'>Entered Employee Name : </label>" . $employee_name;
echo "<label class='label_output'>Entered Employee Email : </label>" . $employee_email;
echo "<label class='label_output'>Entered Password : </label>" . $employee_password;
echo "<label class='label_output'>Entered Gender : </label>" . $employee_gender;
echo "<label class='label_output'>Entered Marital status : </label>" . $employee_marital_status;
echo "<label class='label_output'>Entered Qualification : </label>";
echo "<ul class='qual_output'>";
if (isset($checkbox_value) && $checkbox_value != NULL) {
foreach ($checkbox_value as $value) {
echo "<li>" . $value . "</li>";
}
}
echo "</ul>";
echo "<label class='label_output'>Entered Address : </label><pre class='address_output'>" . $employee_address . "</pre>";
echo "<label class='label_output'>Uploaded Image : </label>" . $employee_upload_file;
echo "<div>";
echo "</div>";
}
?>
</div>
</div>						
						</p>
						
                       
						  
						  
				
						 
						
         
    	 </div>
       </div>
</div>
<?php 
} ?>