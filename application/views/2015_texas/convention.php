<?php $this->load->view($this->config->item('convention_texas_folder').'convention_header'); ?>
<div class="container">
<div class="container affix" style="z-index:99999">
<div class="toppest_header2">
    <header role="banner" class="navbar navbar-fixed-top navbar-inverse" id="banner">
  <div class="navbar-inner">
    <div class="container">
      <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <nav role="navigation" class="nav-collapse" id="nav-main">
       <ul class="nav" id="menu-primary-navigation" onmouseleave="hoverout()">
       <?php $get_menu = $this->dbconvention->get_menu(); 
			if(count($get_menu)>0)
			{
				foreach($get_menu as $allmenu)
				{
					$get_submenu = $this->dbconvention->get_submenu($allmenu->menu_id);
					
					if(count($get_submenu)>0)
					{ 
						
					?>
						<li class="dropdown menu-information <?php if($this->uri->segment(4) == strtolower($allmenu->menu_name)){echo "active"; }?>"><a href="<?php echo $allmenu->menu_link; ?>" id="main_menu-<?php echo $allmenu->menu_id;?>" onmouseover ="hover(this.id)" class="dropdown-toggle"><?php echo $allmenu->menu_name; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu" id="sub_menu-<?php echo $allmenu->menu_id; ?>" style="margin-top:-2px;"> 
                        <?php
						foreach($get_submenu as $allsubmenu)
						{
						?>
                        

						
                            <li class="menu-exhibit-hall"><a href="<?php echo $allsubmenu->sub_menu_link; ?>" ><?php echo $allsubmenu->sub_menu_name; ?></a></li>
                            
						
                        
					<?php }
					?>
                    </ul>
					</li>
                    <?php
					}
					else
					{
						
					?>
					<li onmouseover="hoverout()" class="<?php if($this->uri->segment(4) == strtolower($allmenu->menu_name)){echo "active"; }?>"> <a href="<?php echo $allmenu->menu_link;?>"> <?php echo $allmenu->menu_name; ?></a></li>
                    
                    <?php
					
					}
					
				}
			}
	   ?>
       </ul>
               </nav>
    </div>
  </div>
</header>
    	</div>
        <div class="toppest_header3">
        <div class="my-account-welcome2">
         <!--<a href="http://testsite.spcsusa.org/user/register.html">Logout</a>-->
             <!-- <div class="my-account-box2">
              <div class="photo"><img src="<?php //echo base_url(); ?>images/spcs_convention/photo.jpg" alt="" /> </div>
              <div class="text"><span>Rmani</span>
              Chief Executive Officer (CEO)
              </div>              
              
              </div>  -->    
             

        <?php


	
		$login = $this->session->userdata('user_email');



		if(!$login)

		{

			?>
			<div style=" margin-top:12px; margin-left:10px;">
            <span ><?php echo $this->lang->line('text_welcome');?></span> | 

            <a href="<?php echo base_url('user/login/convention_login'); ?>"><?php echo $this->lang->line('btn_login');?></a> | <a href="<?php echo base_url('user/register.html'); ?>"><?php echo $this->lang->line('btn_register');?></a>
            </div>

            

            <?php

		}

		else

		{
			$user = $this->dbconvention_header->user_details($login);
			?>

          <?php /*?> <span><?php echo $this->lang->line('text_welcome');?> </span> | 

			<a href="<?php echo base_url('user/account.html'); ?>"><?php echo $this->lang->line('btn_my_account');?></a> | <a href="<?php echo base_url('user/logout.html'); ?>"><?php echo $this->lang->line('btn_logout');?></a><?php */?>

            <div class="my-account-box2">

              <div class="photo">

              <?php if($user->mm_photo == NULL || $user->mm_photo == ''){ ?><img src="<?php echo base_url(); ?>images/profile/thumb/no_photo.jpg" height="40px" width="40px" alt="" /><?php } else { ?><img src="<?php echo base_url(); ?>images/profile/thumb/<?php echo $user->mm_photo;?>" height="40px" width="40px" alt="" /><?php }?>

              

              <!--<img src="<?php //echo base_url(); ?>images/<?php //echo $user->mm_photo;?>" height="40px" width="40px" alt="" />--> </div>

              <div class="text" style="width:122px;"><span><?php echo $user->mm_username;?></span>

             <?php 

			  $get_position = $this->dbconvention_header->get_position($user->mm_id);

			  $get_chapter = $this->dbconvention_header->get_chapter($user->mm_chapter_id);

			  	if(count($get_position) != 0)

				{

					 echo $get_position->cm_position;

				}

				else

				{

					if($user->mm_type == 0)

					{

						echo "Member";

					}

					else

					{

						echo "C.A of ".$get_chapter->ch_name;

					}

				}

              ?>

              </div>              

              <a href="<?php echo base_url(); ?>user/logout.html">Logout</a>
              <!--       pradip changes 201401281700-->
<a style="margin-left:12px;" href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'help'); ?>" data-tip1="<?php  echo 'help?';?>" target="_blank" ><img style="border-radius: 10px 10px 10px 10px; height:20px; width:20px;" src="<?php echo base_url(); ?>images/help.jpg"></a>
					  <!--		end-->
              </div> 

			<?php

		}



		?>

                   

        
        </div>
        </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="container-h" onmouseover="hoverout()">

<div class="container" onmouseover="hoverout()">
    <div class="clear"></div>
    <div style="float: left; width: 75%;">
	<div  style="padding:18px 0 0 0px;width: 19%; float:left;">
  
    <a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/welcome.html'); ?>"><img title="SPCSUSA.ORG" src="<?php echo base_url(); ?>images/spcs_convention/<?php echo $settings->cs_logo2; ?>" /></a></div>
    <div  style="padding:50px 0 0 0px; text-align:center; float:left; width:68%;  " ><h1 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif">7th SPCS International Convention - Texas, USA<!--<?php echo $settings->ch_name; ?> Convention  <?php echo $settings->ch_year ; ?>--></h1></div>
    <div  style="padding:31px 0 0 0px; " >
  
    <a href="<?php echo base_url(); ?>"><img title="SPCSUSA.ORG" src="<?php echo base_url(); ?>images/spcs_convention/<?php echo $settings->cs_logo; ?>" /></a></div>
    </div>
     <div class="span3" style="margin-top:-5px;">
<div class="bs-docs-sidebar bs-docs-sidenav add-border"><div style=" width:100%; float:left;"><p style=" margin:0 auto 10px; width:140px;" class="register-texx2"><?php  echo $settings->cs_place;?>
</p></div><table id="table" border="0">
    <tr>
        <td align="center" colspan="6"><div class="numbers" id="count2" style="padding: 10px; "></div></td>
    </tr>
    <tr id="spacer1">
        <td align="center" ><div class="title" ></div></td>
        <td align="center" ><div class="numbers" id="dday"></div></td>
        <td align="center" ><div class="numbers" id="dhour"></div></td>
        <td align="center" ><div class="numbers" id="dmin"></div></td>
        <td align="center" ><div class="numbers" id="dsec"></div></td>
        <td align="center" ><div class="title" ></div></td>
    </tr>
    <tr id="spacer2">
        <td align="center" ><div class="title" ></div></td>
        <td align="center" ><div class="title" id="days">Days</div></td>
        <td align="center" ><div class="title" id="hours">Hours</div></td>
        <td align="center" ><div class="title" id="minutes">Minutes</div></td>
        <td align="center" ><div class="title" id="seconds">Seconds</div></td>
        <td align="center" ><div class="title" ></div></td>
    </tr>
</table></div>

   </div>
    <div class="clear"></div>
   
</div>
</div>

 <div class="clear"></div>

<div class="container" onmouseover="hoverout()">
  <div class="welcome-title-logo-top2">
	<div class="bs-docs-sidebar bs-docs-sidenav add-border"><div class="row">
    
    

<div class="span10 nomargin" style="width: 775px !important;">
 <div class="page_content">
	<!--updated by ketan 201309201600-->
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='welcome')  {
		  $this->load->view($this->config->item('convention_texas_folder').'convention_slider'); 
		  
	}?>
		  <!--update end-->
    <!-- End Elastislide Carousel --> 
    <div class="clear"></div>
    <div class="welcome-title-logo-top" style="width:100%">
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='welcome')  { $this->load->view($this->config->item('convention_texas_folder').'convention_welcome'); }?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='program')  { $this->load->view($this->config->item('convention_texas_folder').'convention_program'); }?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='medical')  { $this->load->view($this->config->item('convention_texas_folder').'convention_medical'); }?>
    
	<?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='registration')  { $this->load->view($this->config->item('convention_texas_folder').'convention_fees_form'); } ?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='allregistration')  { $this->load->view($this->config->item('convention_texas_folder').'convention_fees_formall'); } ?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='process_payment')  { $this->load->view($this->config->item('convention_texas_folder').'convention_fees_formall'); } ?>
	<?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='eventmembership')  { $this->load->view($this->config->item('convention_texas_folder').'convention_event_form'); } ?>
	<?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='corporate_sponsors')  { $this->load->view($this->config->item('convention_texas_folder').'corporate_sponsors'); }?>
  	<?php if($this->uri->segment(3)=='convention'  && $this->uri->segment(4)=='convention_welcomepage')   { $this->load->view($this->config->item('convention_texas_folder').'convention_welcomepage'); }?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='detail_page')   { $this->load->view($this->config->item('convention_texas_folder').'convention_detailpage'); }?>
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='pages')   { $this->load->view($this->config->item('convention_texas_folder').'convention_pages'); }?>
    <!--added by ketan 201309181120-->
    <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='sponsors' && $this->uri->segment(5)=='all')  { $this->load->view($this->config->item('convention_texas_folder').'convention_sponsors_all'); }?>
	<?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='sponsors' && $this->uri->segment(5)=='individual')  { $this->load->view($this->config->item('convention_texas_folder').'convention_sponsors_individual');}?>
	<?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='sponsors' && $this->uri->segment(5)=='corporate')  { $this->load->view($this->config->item('convention_texas_folder').'convention_sponsors_corporate'); }?>
	<!--update end-->
     <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='gallery')   { $this->load->view($this->config->item('convention_texas_folder').'convention_gallary'); }?>
     <?php  if($this->uri->segment(3)=='convention' && $this->uri->segment(4)=='convention_gallarypage')   { $this->load->view($this->config->item('convention_texas_folder').'convention_gallarypage'); } ?>

    </div>
    <div class="clear"></div>
	</div>
</div>
<?php if($this->uri->segment(3)=='convention' && ($this->uri->segment(4)=='welcome' || $this->uri->segment(4)=='pages' || $this->uri->segment(4)=='detail_page' || $this->uri->segment(4)=='sponsors'|| $this->uri->segment(4)=='gallery'||$this->uri->segment(4)=='convention_gallarypage' || $this->uri->segment(4)=='image' || $this->uri->segment(4)=='video'))  { ?>
<script>
	function redirect_to_registration()
	{
		window.location = "<?php echo base_url('2015/texas/convention/allregistration');?>";
	}
	</script>
<div class="span3" style=" margin-left:13px; margin-top:-20px;width:234px;">
    <div class="sidebar">
                <div class="bs-docs-sidebar">
    <div class="bs-docs-sidebar bs-docs-sidenav add-border">
    <p class="lleft-hd-ex3"><img src="<?php echo base_url(); ?>images/spcs_convention/register-icon.png" alt="" /> Registration</p>
    <p class="register-texx">
	 Register Now for 7th SPCS International Convention <strong>"Asmita"</strong>, Texas.</p>
	
    <div class="space10px"></div>
    <?php
    if(!$this->session->userdata('user_id'))
	{?>
    <input name="" type="image" src="<?php echo base_url(); ?>images/spcs_convention/register-now-btn.png" class="fr" onclick="redirect_to_registration()"/>
	
    <?php
	}
	else
	{?>
    <a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/registration.html'.'');?>"><input name="" type="image" src="<?php echo base_url(); ?>images/spcs_convention/register-now-btn.png" class="fr" /></a>
    <?php
	}?>
    <div class="clear"></div>
	
    </div>
	<div class="bs-docs-sidebar bs-docs-sidenav add-border">
	<div style="background-color:#000000; color:#FFFFFF; font-size:larger"><strong>Total Registered Members of<br />Texas Convention 2015</strong><br /><br />
	<div style="color:#00FFFF; text-decoration:underline; font-size:xx-large"><?php 
	$sel = "select * from con_texas_fees_allmember_group";
	$ex = mysql_query($sel);
	$no_mem = mysql_num_rows($ex);
	echo $no_mem;
	 ?><br /><br /></div></div>
	</div>
</div>                
<div class="space20px"></div>
<?php }
else  if($this->uri->segment(3)=='convention' && ($this->uri->segment(4)=='registration' || $this->uri->segment(4)=='allregistration' || $this->uri->segment(4)=='program' || $this->uri->segment(4)=='medical' || $this->uri->segment(4)=='eventmembership')){
?>
<div class="span3" style=" margin-left:13px; margin-top:-20px;width:234px;">
    <div class="sidebar">
                <div class="bs-docs-sidebar">
                    <ul class="nav nav-list bs-docs-sidenav">
                                  <li <?php if($this->uri->segment(4)=='registration') { ?> class="active" <?php } ?>>
                                    <a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/allregistration'.'');?>">
                                    <?php if($this->uri->segment(4)=='registration') 
									{ ?> 
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up.png" alt="" /> 
									<?php } else { ?>
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up_gray.png" alt="" /> 
									<?php }  ?>
                                     Registration Form</a></li>
                                    
                                   <!-- <li <?php if($this->uri->segment(4)=='eventmembership') { ?> class="active" <?php } ?>><a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/eventmembership.html'.'');?>">
                                     <?php if($this->uri->segment(4)=='eventmembership') 
									{ ?> 
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up.png" alt="" /> 
									<?php } else { ?>
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up_gray.png" alt="" /> 
									<?php }  ?>
                                    Event Membership Form</a></li> -->
                                   <!-- <li <?php if($this->uri->segment(4)=='program') { ?> class="active" <?php } ?>><a href="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/program.html'.'');?>">
                                     <?php if($this->uri->segment(4)=='program') 
									{ ?> 
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up.png" alt="" /> 
									<?php } else { ?>
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up_gray.png" alt="" /> 
									<?php }  ?>
                                     Program Entry Form</a></li>
                                    <li <?php if($this->uri->segment(4)=='medical') { ?> class="active" <?php } ?>><a href="<?php echo "";//base_url($this->config->item('convention_texas_folder_with_slash').'convention/medical.html'.'');?>">
                                    <?php if($this->uri->segment(4)=='medical') 
									{ ?> 
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up.png" alt="" /> 
									<?php } else { ?>
                                    <img src="<?php echo base_url(); ?>images/spcs_convention/upload_arrow_up_gray.png" alt="" /> 
									<?php }  ?>
                                     Medical Release Form</a></li>-->
                                    
                                    
                        
                    </ul>
                    <div class="space10px"></div>
                    <div class="clear"></div>
                </div>
                
                
                
                
    <div class="space20px">
    </div>
<?php }?>        
<?php $this->load->view($this->config->item('convention_texas_folder').'convention_sponsors'); ?>
<div class="clear"></div>
</div></div>
 </div>
<div class="clear"></div></div>
</div>
<?php $this->load->view($this->config->item('convention_texas_folder').'convention_countdown'); ?>
<?php $this->load->view($this->config->item('convention_texas_folder').'convention_footer'); ?>

</body>
</html>
