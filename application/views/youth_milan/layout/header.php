<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php /*if($this->uri->segment(3)=='view') {?>
<style>

.photogallery

{


display:none;

}
$('#tabs')
{
	display:none;
}



</style>
<?php }*/ ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script type="text/javascript">var BASE_URI = "<?php echo base_url();?>";</script>

<?php $settings = $this->dbyouthmilan->getsettings(); ?>

<title><?php echo $title; ?> - <?php echo $settings->sitename; ?></title>

<link href="<?php echo base_url();?>css/youth_milan/style_youthmilan.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>css/youth_milan/bootstrap_youthmilan.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/youth_milan/bootstrap.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/youth_milan/smart_tab_vertical_youthmilan.css" rel="stylesheet" type="text/css">

<!--<link href="<?php echo base_url(); ?>css/colorbox.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>-->

<script src='<?php echo base_url(); ?>js/youth_milan/jquery-1.7.1.min.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/youth_milan/jquery.smartTab.js' type='text/javascript'></script>


<!--------------lightbox------------>

<script src="<?php echo base_url(); ?>js/youth_milan/lightbox.js"></script>

<link href="<?php echo base_url(); ?>css/youth_milan/lightbox.css" rel="stylesheet" />

<!-----------end of lightbox----------------->
<!-----------end of lightbox----------------->

<script src="<?php echo base_url(); ?>js/scripts.js"></script>


<!--------------image gallery --------------->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/youth_milan/jquery.ad-gallery.css" rel="stylesheet">
 
 <script type="text/javascript" src="<?php echo base_url(); ?>js/youth_milan/jquery.ad-gallery.js"></script>
 
 
 <script type="text/javascript">
  $(function() {
    /*$('img.image1').data('ad-desc', 'Whoa! This description is set through elm.data("ad-desc") instead of using the longdesc attribute.<br>And it contains <strong>H</strong>ow <strong>T</strong>o <strong>M</strong>eet <strong>L</strong>adies... <em>What?</em> That aint what HTML stands for? Man...');
    $('img.image1').data('ad-title', 'Title through $.data');
    $('img.image4').data('ad-desc', 'This image is wider than the wrapper, so it has been scaled down');
    $('img.image5').data('ad-desc', 'This image is higher than the wrapper, so it has been scaled down');*/
    var galleries = $('.ad-gallery').adGallery();
  /*  setTimeout(function() {
      galleries[0].addImage("images/thumbs/t7.jpg", "images/7.jpg");
    }, 1000);
    setTimeout(function() {
      galleries[0].addImage("images/thumbs/t8.jpg", "images/8.jpg");
    }, 2000);
    setTimeout(function() {
      galleries[0].addImage("images/thumbs/t9.jpg", "images/9.jpg");
    }, 3000);
    setTimeout(function() {
      galleries[0].removeImage(1);
    }, 4000);*/
    
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect ="slide-hori";
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
  </script>
  
<!--------------end of image gallery --------------->


<script type="text/javascript">

$(document).ready(function(){
	// Smart Tab
   	$('#tabs_ym').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide'});
		
});

</script>	

<?php

	/*if($this->session->userdata('tab_msg')=="sucess")
	{
	
?>
		<script> 
		
			//alert("<?php echo $this->session->userdata('tab_msg'); ?>");
			
			$('#tabs').smartTab('showTab',1);//alert("hello");
			
		</script> 
		
<?php 	

		//$this->session->unset_userdata('tab_msg');
		
	} */
	
?>

<script>	
function update1()
{
	$('#tabs_ym').smartTab('showTab',1);
}

function update2()
{
	$('#tabs_ym').smartTab('showTab',2);
}

function update3()
{
	$('#tabs_ym').smartTab('showTab',3);
}

function update4()
{
	$('#tabs_ym').smartTab('showTab',4);
}

function update5()
{
	$('#tabs_ym').smartTab('showTab',5);
}

function update6()
{
	$('#tabs_ym').smartTab('showTab',6);
}

/*function update7()
{
	$('#tabs').smartTab('showTab',7);
}*/

</script>

</head>

<body>

<div class="row-fluid">

  <div class="container">

		<div id="topheader">
		
		      <div id="logo"> <a href="<?php echo base_url(); ?>"><img alt="Youthmilan" src="<?php echo base_url();?>images/youth_milan/logo1.png"></a> </div>
			  
		      <div id="my_menu" style='background: url("<?php echo base_url(); ?>images/youth_milan/top-t-shadow.png") no-repeat scroll right bottom rgba(0, 0, 0, 0);'>
			  
		        <aside>
				
		          <ul class="tabs clearfix">
				  
		            <li <?php if($this->uri->segment(3)=="view"){echo "class='on'";} ?>> <a class="0" href="<?php echo base_url();?>youth_milan/registration/view"> <img alt="Launch for the Stars" src="<?php echo base_url();?>images/youth_milan/add_user.png"><span>Registration </span> </a> </li>
					
		            <li <?php if($this->uri->segment(3)=="manage_album"){echo "class='on'";} ?>> <a class="1" href="<?php echo base_url();?>youth_milan/registration/manage_album"> <img alt="Launch for the Stars" src="<?php echo base_url();?>images/youth_milan/gallery-64.png"><span>Manage Album</span></a> </li>
					
		            <li <?php if($this->uri->segment(3)=="search"){echo "class='on'";} ?>> <a class="2" href="<?php echo base_url();?>youth_milan/registration/clear"> <img alt="Launch for the Stars" src="<?php echo base_url();?>images/youth_milan/user_search.png"><span>Search Profiles</span></a> </li>
					
		          </ul>
				  
		        </aside>
				
		      </div>
			  
		</div>
		<input type="button" onclick="window.location='<?php echo base_url().'user/logout'; ?>'" class="btn btn-danger" value="Logout" id="ym_cancel1" name="ym_cancel1" style="float:right; margin-top:30px;" />
	
<!-----------------added by dharati 201309251815----------------------->	
	
<link href="<?php echo base_url(); ?>css/youth_milan/jquery_ui_blue/jquery-ui-1.9.1.custom.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url(); ?>css/youth_milan/jquery_ui_blue/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" type="text/css" />


<script src='<?php echo base_url(); ?>js/youth_milan/jquery-ui.js' type='text/javascript'></script>
	
<link href="<?php echo base_url(); ?>css/youth_milan/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">

<script src='<?php echo base_url(); ?>js/youth_milan/jquery-ui-timepicker-addon.js' type='text/javascript'></script>
		
<script type="text/javascript">
$(document).ready(function(){
	

	$('#ym_birth_date').datepicker({dateFormat: 'yy-mm'});

});

/*function test()
{
	$('#tabs').smartTab('showTab',0);
}*/

</script>

<!-----------------end-------------------->