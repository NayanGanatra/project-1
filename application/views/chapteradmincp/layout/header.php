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

$(".video").colorbox({
					    inline:true, 
						innerWidth:640, 
						innerHeight:480
	 });//update monita20130821

$(".iframe").colorbox({iframe:true, width:"640", height:"480"});

$(".ajax").colorbox({maxHeight:"90%"});

});


$(".alert").alert();

</script>

</head>



<body>

<div class="navbar navbar-inverse navbar-fixed-top">

              <div class="navbar-inner">

                <div class="container" style="width:100%">

                   <a class="brand" href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>images/admin_logo.png" border="0" alt="<?php echo $settings->sitename;?>" title="<?php echo $settings->sitename;?>" /></a>

                  <div class="nav-collapse subnav-collapse">

                    <ul class="nav">

                      

                      

                    </ul>

                    

                    <ul class="nav pull-right">

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='advertisements'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('menu_text_advertisement');?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/advertisements/view"><?php echo $this->lang->line('menu_text_manage_advertisement');?></a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/advertisements/add"><?php echo $this->lang->line('menu_text_add_advertisement');?></a></li>

                         <!-- <li><a href="<?php //echo base_url(); ?>chapteradmincp/advertisements/add"><?php //echo $this->lang->line('menu_text_add_advertisement');?></a></li>-->

                        </ul>

                      </li>

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='news'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/news/view">Manage News</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/news/add">Add News</a></li>

                        </ul>

                      </li>

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='events'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Events <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/events/view">Manage Events</a></li>

                         <li><a href="<?php echo base_url(); ?>chapteradmincp/events/add">Add Event</a></li>

                        </ul>

                      </li>

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='media'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Media <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/media/view">Manage Media</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/media/add">Add Media</a></li>

                        </ul>

                      </li>

					  

                      

                       <li class="dropdown <?php if($this->uri->segment(2) =='template' || $this->uri->segment(2) =='email' || $this->uri->segment(2) =='verification'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Email<b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/template/view">Manage Email Template</a></li>

                         <li><a href="<?php echo base_url(); ?>chapteradmincp/template/add">Add Email Template</a></li>

						  <li class="divider"></li>

						  <li><a href="<?php echo base_url(); ?>chapteradmincp/email/view">Manage Mass Email</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/email/add">Add Mass Email</a></li>

						   <li class="divider"></li>

						   <li><a href="<?php echo base_url(); ?>chapteradmincp/verification/view">Manage Member verification Email</a></li>

                         <li><a href="<?php echo base_url(); ?>chapteradmincp/verification/add">Add Member verification Email</a></li>

                        </ul>

                      </li>

					    <!--update by ketan 21-06-2013 start-->

					  <li class="dropdown <?php if($this->uri->segment(2) =='polls'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Polls <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/polls/view">Manage Polls</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/polls/add">Add Polls</a></li>

                        </ul>

                      </li>

					  <!--update by ketan end-->

					   <!-------monita20130627-------->

                      <li class="dropdown <?php if($this->uri->segment(2) =='vendor' || $this->uri->segment(2) =='category'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vendors <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/vendor/view">Manage Vendors</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/vendor/add">Add vendors</a></li>

                           <li class="divider"></li>

                           <li><a href="<?php echo base_url(); ?>chapteradmincp/category/view">Category</a></li>

                        </ul>

                   </li><!-------monita20130627-------->

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='chapters'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chapters <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/chapters">Manage Chapters</a></li>

                          <!-- <li><a href="<?php //echo base_url(); ?>chapteradmincp/chapters/add">Add Chapter</a></li>-->

                        </ul>

                      </li>

                      

                     <!-- pradip changes for latestnews 201307121700-->

                      

                     <li class="dropdown <?php if($this->uri->segment(2) =='pages'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages<b class="caret"></b></a>

                        <ul class="dropdown-menu">

                        	<!--------   pradip changes 201307201500--->

                            <li><a href="<?php echo base_url(); ?>chapteradmincp/pages/view"><?php echo $this->lang->line('menu_text_manage_pages');?></a></li>

                            <li><a href="<?php echo base_url(); ?>chapteradmincp/pages/add/0"><?php echo $this->lang->line('menu_text_add_page');?></a></li>

                            <!-----------------end----------------->

                            <li class="divider"></li

                            ><li><a href="<?php echo base_url(); ?>chapteradmincp/latestnews/view">Manage Latestnews</a></li>

                            <li><a href="<?php echo base_url(); ?>chapteradmincp/latestnews/add">Add Latestnews</a></li>

                          <!--	pradip changes 201307201500-->  

                            <li class="divider"></li>

                          <?php



							$first_menu = $this->dbadminheader->get_first_menu();

							

							foreach ($first_menu as $first_menu_row)

							{

								$id = $first_menu_row->page_id;

								$base_id = $first_menu_row->page_sub_id;

								$title = $first_menu_row->page_menu_name;

								$seo = $first_menu_row->page_seo;

								$sort_order = $first_menu_row->page_order;

								$islink = $first_menu_row->islink;

								$this->dbadminheader->buildtree($id,$title,$islink);

							}

							

							?>

                            
 <li class="divider"></li>
                            <li><a href="<?php echo base_url(); ?>chapteradmincp/pages/chapter_view">Manage Chapter Pages</a></li>
                            <li><a href="<?php echo base_url(); ?>chapteradmincp/pages/add_chapter/0">Add New Chapter Page</a></li>
                            <!------------------end--------------->

                        </ul>

                      </li>

                      

                      						<!--	end-->

                      

                      <li class="dropdown <?php if($this->uri->segment(2) =='user'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php $not_varify=$this->dbadminheader->count_user_not_varify(); if($not_varify){ echo "(<b>".$not_varify."</b>)";}?>Members <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/user">Manage Users</a></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/user/login_history.html">Login History</a></li>

                          <li class="divider"></li>

                              <li><a href="<?php echo base_url(); ?>chapteradmincp/committee/view">Manage Committee Member</a></li>

                              <li><a href="<?php echo base_url(); ?>chapteradmincp/committee/add">Add Committee Member</a></li>

                           <!--pradip changes for newslatter-->

                          <li class="divider"></li>

                           <li><a href="<?php echo base_url(); ?>chapteradmincp/user/newsletter">Manage Newsletter</a></li>

						    <li><a href="<?php echo base_url(); ?>chapteradmincp/user/add_newsletter">Add Newsletter</a></li>

                          <!--  end-->
  <!--added by ketan 20130730-->
						  <li class="divider"></li>
						  <li><a href="<?php echo base_url(); ?>chapteradmincp/forum/view">Manage Forum</a></li>
                          <li><a href="<?php echo base_url(); ?>chapteradmincp/forum/add">Add Forum</a></li>
						  <!--update end-->
                        </ul>

                      </li>

                      

                     

                      

                      <li class="divider-vertical"></li>

                      <li class="dropdown <?php if($this->uri->segment(2) =='password'){echo 'active';}?>">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('username');?> <b class="caret"></b></a>

                        <ul class="dropdown-menu">

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/password"><?php echo $this->lang->line('menu_text_change_password');?></a></li>

                          <li class="divider"></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/logout"><?php echo $this->lang->line('menu_text_logout');?></a></li>
						  
						     <!--       pradip changes 201401281700-->
                            <li class="divider"></li>

                          <li><a href="<?php echo base_url(); ?>chapteradmincp/help" target="_blank">Help?</a></li>
                          
                          <!--		end-->

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

