<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php //$settings = $this->dbconvention_settings->getsetting();?>
<script type="text/javascript">var BASE_URI = "<?php echo base_url();?>";</script>

<title><?php echo $title; ?> Welcome to Saurashtra Patel Cultural Samaj - Convention 2015 - <?php echo $settings->cs_sitename; ?></title>
<!--<title>Welcome to Saurashtra Patel Cultural Samaj - SPCSUSA.ORG</title>-->
<link href="<?php echo base_url(); ?>css/spcs_convention/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/spcs_convention/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/spcs_convention/rating.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/spcs_convention/colorpicker.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/spcs_convention/colorbox.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon" href="<?php echo base_url(); ?>images/spcs_convention/favicon.ico" type="image/x-icon" /> 
<!--       pradip changes 201401281700-->
<link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
  <!--		end-->
<meta name="description" content="spcs description">
<meta name="keywords" content="spcs, patel">
<style type="text/css">
img, div { behavior: url("<?php echo base_url(); ?>js/spcs_convention/iepngfix.htc"); }
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/spcs_convention/lavalamp_test.css" type="text/css" media="screen">
<link href="<?php echo base_url(); ?>css/spcs_convention/smart_tab_vertical.css" rel="stylesheet" type="text/css"></link>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/spcs_convention/jquery.bxslider.css" />
<style type="text/css">
.numbers {
   /* border-style: ridge;    /* options are none, dotted, dashed, solid, double, groove, ridge, inset, outset */
    /*border-width: 2px;
   /* border-color: #666666;  /* change the border color using the hexadecimal color codes for HTML */
    background: #222222;    /* change the background color using the hexadecimal color codes for HTML */
    padding: 5px 0px;
    width: 55px;
    text-align: center; 
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; 
    font-size: 28px;
    font-weight: bold;   /* options are normal, bold, bolder, lighter */
    font-style: normal;  /* options are normal or italic */
    color: #FFFFFF;      /* change color using the hexadecimal color codes for HTML */
    }
.title {        /* the styles below will affect the title under the numbers, i.e., “Days”, “Hours”, etc. */
    border: none;   
	background: #222222;
    padding: 0px;
    width: 55px;
    text-align: center; 
    font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;
    font-size: 10px; 
    font-weight: normal; /* options are normal, bold, bolder, lighter */
    color: #FFFFFF;      /* change color using the hexadecimal color codes for HTML */
      /* change the background color using the hexadecimal color codes for HTML */
    }
#table {
    width: 229px;
    border: none;  
	margin-left:-57px;
	/* options are none, dotted, dashed, solid, double, groove, ridge, inset, outset */
    }
</style>
<script>					
function hover(id)
{
	var n=id.split("-"); 
	$('.act').hide();
	$('#sub_menu-'+n[1]+'').toggle();
	$('#sub_menu-'+n[1]+'').attr('class','dropdown-menu act');
}
function hoverout()
{
//	alert('hi');
	$('.act').hide();
		
}
/*function fb_click(pid){
 //  alert(pid);
  var t = document.getElementById("fb_share"+pid).getAttribute("title");
  //alert(t);
 //var st_title1 =  $("#fb_share").attr("title");
 //var met = $('#fb_title_id').attr("content", st_title1);
 document.getElementById("fb_title_id").setAttribute("content", t);
 //alert(t);
 
 
 
}*/

</script>
<meta property="og:title" content=""/>
<meta property="og:description" content="" />

</head>
<body>
<script src='<?php echo base_url(); ?>js/spcs_convention/jquery.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/spcs_convention/scripts.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/spcs_convention/bootstrap.min.js' type='text/javascript'></script>
<link href="<?php echo base_url(); ?>css/spcs_convention/jquery_ui_blue/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/spcs_convention/script.html"></script>
<link href="<?php echo base_url(); ?>css/spcs_convention/chosen.css" rel="stylesheet" type="text/css">
 <script src="<?php echo base_url(); ?>js/spcs_convention/bootstrap-carousel.js"></script>
 <script src='<?php echo base_url(); ?>js/spcs_convention/jquery.vticker-min.js' type='text/javascript'></script>
 <script src='<?php echo base_url(); ?>js/spcs_convention/jquery.colorbox-min.js' type='text/javascript'></script>
 <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a7d2b4d7-da67-4093-ba72-fd7dd0846d98", doNotHash: false,  doNotCopy: false, hashAddressBar: false,onhover:false,servicePopup:true});</script>

 <script type="text/javascript">
$(function() {
	$('#sponsors').vTicker({ 
		speed: 500,
		pause: 3000,
		animation: 'fade',
		mousePause: false,
		showItems: 3
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$('.gallery').colorbox({rel:'gallery'});

$(".inline").colorbox({inline:true,innerWidth:640, innerHeight:350});

$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:480});

$(".video").colorbox({iframe:true, innerWidth:640, innerHeight:480});

$(".iframe").colorbox({iframe:true, width:"640", height:"480"});

$(".ajax").colorbox({maxHeight:"90%"});

});

<!--------------------------end of update-monita 20130914---------------------------->




$(".alert").alert();
</script>
<!-----------------end of updatemonita20130914--------------->