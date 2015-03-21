<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $settings = $this->dbadminheader->getsettings(); ?>
<script type="text/javascript">var BASE_URI = "<?php echo base_url();?>";</script>
<title><?php echo $title; ?> - Adminpanel - <?php echo $settings->sitename; ?></title>
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

<link rel="Shortcut Icon" href="<?php echo base_url();?>images/<?php echo $settings->favicon;?>" type="image/x-icon" /> 

<script>
$(function() {
	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
	$('#datetimepicker').datetimepicker({dateFormat: 'yy-mm-dd'});

});
</script>
<script type="text/javascript">
$(document).ready(function(){
$('.gallery').colorbox({rel:'gallery'});
$(".inline").colorbox({inline:true});
});

$(".alert").alert();
</script>
</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
                   <a class="brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>images/admin_logo.png" border="0" alt="<?php echo $settings->sitename;?>" title="<?php echo $settings->sitename;?>" /></a>
                  <div class="nav-collapse subnav-collapse">
                    <ul class="nav">
                      
                      
                    </ul>
                    
                    <ul class="nav pull-right">
                      
                      
                      
                      <li class="dropdown <?php if($this->uri->segment(2) =='chapters'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chapters <b class="caret"></b></a>
                       <ul class="dropdown-menu">
                          <li><a href="<?php  echo base_url(); ?>chapteradmincp/chapters">Manage Chapters</a></li>
                          <!-- <li><a href="<?php //echo base_url(); ?>chapteradmincp/chapters/add">Add Chapter</a></li>-->
                        </ul>
                      </li>
                       <li class="dropdown <?php if($this->uri->segment(2) =='user'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">(<?php echo "<b>".$not_varify=$this->dbadminheader->count_user_not_varify()."</b>";?>)Members <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url(); ?>chapteradmincp/user">Users Status</a></li>
                        </ul>
                      </li>
                     
                      <li class="divider-vertical"></li>
                      <li class="dropdown <?php if($this->uri->segment(2) =='password'){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('username');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url(); ?>chapteradmincp/password"><?php echo $this->lang->line('menu_text_change_password');?></a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo base_url(); ?>chapteradmincp/logout"><?php echo $this->lang->line('menu_text_logout');?></a></li>
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
	{ 
		?>
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