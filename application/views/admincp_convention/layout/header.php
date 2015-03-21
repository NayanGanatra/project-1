<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php $settings = $this->dbsettings->getsetting(); ?>

<script type="text/javascript">var BASE_URI = "<?php echo base_url();?>";</script>

<title><?php echo $title; ?> - Adminpanel - <?php echo $settings->cs_sitename; ?></title>

<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/bootstrap.min.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/bootstrap.file-input.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/admin_scripts.js' type='text/javascript'></script>

<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>css/adminstyle.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/colorbox.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>

<script src='<?php echo base_url(); ?>js/jquery-ui.js' type='text/javascript'></script>

<link href="<?php echo base_url(); ?>css/jquery_ui_blue/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/chosen.css" rel="stylesheet" type="text/css">



<link href="<?php echo base_url(); ?>css/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">

<script src='<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/jquery-ui-sliderAccess.js' type='text/javascript'></script>



<link rel="Shortcut Icon" href="<?php echo base_url();?>images/<?php echo $settings->cs_favicon;?>" type="image/x-icon" /> 



<script>

$(function() {

	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

	$('#datetimepicker').datetimepicker({dateFormat: 'yy-mm-dd'});



///////////////pradip changes for ads 201306211745//////////////

	$('#datetimepickerFrom').datetimepicker({dateFormat: 'yy-mm-dd'});

	$('#datetimepickerTo').datetimepicker({dateFormat: 'yy-mm-dd'});

	///////////////////////end///////////////////////

});

</script>

<script type="text/javascript">

$(document).ready(function(){

$('.gallery').colorbox({rel:'gallery'});

<!--------------------------update-monita 20130808---------------------------->
$(".inline").colorbox({inline:true,innerWidth:640, innerHeight:350});

$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:480});

$(".video").colorbox({iframe:true, innerWidth:640, innerHeight:480});//update monita201308013


$(".iframe").colorbox({iframe:true, width:"640", height:"480"});

$(".ajax").colorbox({maxHeight:"90%"});

});

<!--------------------------end of update-monita 20130808---------------------------->




$(".alert").alert();

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.smartTab.js"></script>
<link href="<?php echo base_url(); ?>css/smart_tab_vertical.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript">
    $(document).ready(function(){
    	// Smart Tab
  		$('#tabs').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide'});
	});
</script>
</head>



<body>

<div class="navbar navbar-inverse navbar-fixed-top">

              <div class="navbar-inner">

                <div class="container" style="width:100%">
					
                   <a style="margin-top:10px;" class="brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>images/convention-logo.png" border="0" alt="<?php //echo $settings->cs_sitename;?>" title="<?php echo $settings->cs_sitename;?>" /></a>
                  <div class="nav-collapse subnav-collapse">
                    <ul class="nav">
                    </ul>
                    <ul class="nav pull-right">
						<li class="dropdown <?php if($this->uri->segment(2) =='dashboard'){echo 'active';}?>">
                        <a href="<?php echo base_url(); ?>admincp_convention/dashboard" class="dropdown-toggle" data-toggle="">Dashboard <b class="caret"></b></a>
                        </li>
						
						<li class="dropdown <?php if($this->uri->segment(2) =='fees' || $this->uri->segment(2) =='form' || $this->uri->segment(2) =='program' || $this->uri->segment(2) =='medical' || $this->uri->segment(2) =='events' || $this->uri->segment(2) =='event_member'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Manage Registration<b class="caret"></b></a>
                        <ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>admincp_convention/fees/view">Manage Fees structure</a></li>
                        <!--<li><a href="<?php //echo base_url(); ?>admincp_convention/fees/add">Add Fees structure</a></li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/form/view">Manage Registration Form</a></li>
                        <!--<li><a href="<?php //echo base_url(); ?>admincp_convention/form/add">Add Registration Form</a></li>-->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/program/destroy">Manage Program</a></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/program/add">Add Program</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/medical/destroy">Manage Medical</a></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/medical/add">Add Medical</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/events/view">Manage Events</a></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/events/add">Add Events</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url(); ?>admincp_convention/event_member/view">Manage Event Member</a></li>
						<li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>admincp_convention/convention_detail/view">Manage convention detail</a></li>
                        <!--<li><a href="<?php //echo base_url(); ?>admincp_convention/event_member/add">Add Event Member</a></li>-->
                        </ul>
                      </li> 
                      <li class="dropdown <?php if($this->uri->segment(2) =='gallery'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>admincp_convention/gallery/view">Manage Gallery</a></li>
                          <li><a href="<?php echo base_url(); ?>admincp_convention/gallery/add">Add Gallery</a></li>
                         <li class="divider"></li>
                          <li><a href="<?php echo base_url(); ?>admincp_convention/album/view">Manage Album</a></li>
                          
                          <li><a href="<?php echo base_url(); ?>admincp_convention/album/add">Add Album</a></li>
                          
                        </ul>
                      </li>
                      <li class="dropdown <?php if($this->uri->segment(2) =='sponsors'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sponsors<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url(); ?>admincp_convention/sponsors/view">Manage Sponsors</a></li>
                          <li><a href="<?php echo base_url(); ?>admincp_convention/sponsors/add">Add Sponsors</a></li>
                        </ul>
                      </li>
                     
						<li class="dropdown <?php if($this->uri->segment(2) =='menu' || $this->uri->segment(2) =='pages'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu<b class="caret"></b></a>
                        <ul class="dropdown-menu">
	                         <li><a href="<?php echo base_url(); ?>admincp_convention/menu/view">Manage Menu</a></li>
                             <li><a href="<?php echo base_url(); ?>admincp_convention/menu/add">Add Menu</a></li>
                              <li class="divider"></li>
                             <li><a href="<?php echo base_url(); ?>admincp_convention/pages/view"><?php echo $this->lang->line('menu_text_manage_pages');?></a></li>
	                         <li><a href="<?php echo base_url(); ?>admincp_convention/pages/add/0"><?php echo $this->lang->line('menu_text_add_page');?></a></li>
                        </ul>
                      </li>
                       <li class="dropdown <?php if($this->uri->segment(2) =='settings'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('menu_text_settings');?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>admincp_convention/settings"><?php echo $this->lang->line('menu_text_settings');?></a></li>

                         <li class="divider"></li>
                         	 <li><a href="<?php echo base_url(); ?>admincp_convention/settings/slider">Manage Slider</a></li>
                             <li><a href="<?php echo base_url(); ?>admincp_convention/settings/add_slider">Add Slider</a></li>
                        </ul>

                      </li>
                      <li class="divider-vertical"></li>

                      <li class="dropdown <?php if($this->uri->segment(2) =='password'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('username');?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>admincp_convention/password"><?php echo $this->lang->line('menu_text_change_password');?></a></li>

                          <li class="divider"></li>

                          <li><a href="<?php echo base_url(); ?>admincp_convention/logout"><?php echo $this->lang->line('menu_text_logout');?></a></li>
                          
                          <li class="divider"></li>

                          <li><a href="<?php echo base_url(); ?>admincp_convention/help" target="_blank">Help?</a></li>

                        </ul>

                      </li>

                    </ul>

                  </div><!-- /.nav-collapse -->

                </div>

              </div><!-- /navbar-inner -->

            </div>



<div class="height40px"></div>

<?php
if ($this->session->flashdata('message_type') == "success")
{ ?>
<div class="alert alert-success"><?php echo $this->session->flashdata('status_');?></div>
<?php
} 
if ($this->session->flashdata('message_type') == "error")
{ 
?>
<div class="alert alert-error"><?php echo $this->session->flashdata('status_');?></div>
<?php
} 
?>