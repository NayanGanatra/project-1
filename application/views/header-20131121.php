

						<!--pradip changes 201307111040-->



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<?php $settings = $this->dbheader->get_setting(); ?>

<!-- Mirrored from testsite.spcsusa.org/info/welcome.html by HTTrack Website Copier/3.x [XR&CO'2010], Fri, 05 Jul 2013 12:39:23 GMT -->

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Welcome to Saurashtra Patel Cultural Samaj - SPCSUSA.ORG</title>

<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/rating.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/colorpicker.css" rel="stylesheet" type="text/css">

<link rel="Shortcut Icon" href="<?php echo base_url();?>images/<?php echo $settings->favicon;?>" type="image/x-icon" /> 

<meta name="description" content="spcs description">

<meta name="keywords" content="spcs, patel">

<style type="text/css">

img, div { behavior: url("<?php echo base_url(); ?>css/iepngfix.htc"); }

</style>

<style type="text/css">

.smooth_m a {

    color: #003087;

}

.simply-scroll-container {

    position: relative;

}

.simply-scroll-clip {

    overflow: hidden;

    position: relative;

}

#scroller {

    height: 46px !important;

    overflow: hidden;

    position: relative;

}

.simply-scroll-list {

    height: 46px;

    list-style: none outside none;

    margin: 0;

    overflow: hidden;

    padding: 0;

}

.simply-scroll-list li {

    list-style: none outside none;

    margin: 0;

    padding: 0;

    position: relative;

}

.simply-scroll-list li img {

    border: medium none;

    display: block;

}

.simply-scroll {

    height: 40px;

    margin-bottom: 1em;

    width: 738px;

}

.simply-scroll .simply-scroll-clip {

    height: 46px;

    width: 762px;

}

.simply-scroll .simply-scroll-list li {

    float: left;

}





img, div { behavior: url("http://testsite.spcsusa.org/css/iepngfix.htc"); }

</style>



<!---add new js css ramnath--->

    



 <link rel="stylesheet" href="<?php echo base_url(); ?>css/lavalamp_test.css" type="text/css" media="screen">

 

<!--end js--->

<link href="<?php echo base_url(); ?>css/smart_tab_vertical.css" rel="stylesheet" type="text/css"></link>





<!--gallery ramnath jquery start-->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.bxslider.css" />



		

		



</head>

<body>

<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/jquery.simplyscroll.js' type='text/javascript'></script>

<script type="text/javascript">

(function($) {

	$(function() { //on DOM ready 

    		$("#scroller").simplyScroll();

			speed: 4

	});

 })(jQuery);

</script>

<!--bx slider-->

<!--<script type="text/javascript" src="<?php //echo base_url(); ?>js/jquery.bxslider.js"></script>



<script type="text/javascript">

  $(document).ready(function(){

    

$('.bxslider').bxSlider({

  minSlides: 1,

  maxSlides: 1,

  slideWidth: 100,

  slideMargin: 0,

  auto: true,

  pager: true,

  controls:false,

  

});

  });



  $(document).ready(function(){

    

$('#bxslider2').bxSlider({

	mode: 'vertical',

  slideWidth:0,

  slideMargin: 10,

  auto:true,

  controls:false,

  pager: true

  

});

  });

  

</script>-->

<!--bx slider-->



<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.smartTab.js"></script>



<script type="text/javascript">

    $(document).ready(function(){

    	// Smart Tab

  		$('#tabs').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide'});
		
		$('#tabschap').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide'});

	});

</script>

 <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing1.min.js"></script>

         <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.lavalamp.min.js"></script>

<script type="text/javascript">

    //Active link functionality using Javascript (thanks to Neha.S). Alternatively, you can use your favorite code to apply the class 'active' to the active page.

       var loc = window.location.href;

       var filename = loc.substring(loc.lastIndexOf('/') + 1, loc.length);

       $("#1 a").removeClass("current");

       $("#1 a[href*='" + decodeURIComponent(filename.replace(/\+/g, " ")) + "']").parent().addClass("current");

 

    //Call Lavalamp, Also assign properties

    $(function() { $(".lavaLamp").lavaLamp({ fx: "backout", speed: 700 })});

</script>

<script src='<?php echo base_url(); ?>js/scripts.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/jquery-ui.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/bootstrap.min.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/bootstrap.file-input.js' type='text/javascript'></script>

<link href="<?php echo base_url(); ?>css/jquery_ui_blue/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url(); ?>css/colorbox.css" rel="stylesheet" type="text/css">

<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>

<script src="<?php echo base_url(); ?>js/script.html"></script>

<link href="<?php echo base_url(); ?>css/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">

<script src='<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js' type='text/javascript'></script>

<script src='<?php echo base_url(); ?>js/jquery-ui-sliderAccess.js' type='text/javascript'></script>



<link href="<?php echo base_url(); ?>css/chosen.css" rel="stylesheet" type="text/css">



<script src='<?php echo base_url(); ?>js/jquery.vticker-min.js' type='text/javascript'></script>

<script type="text/javascript">



$(function() {

	$( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

	$('#datetimepicker').datetimepicker({dateFormat: 'yy-mm-dd'});

	

	$('#ads_slider').vTicker({ 

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
/*********************update monita20130821*******************/
$(".video").colorbox({
					    inline:true, 
						innerWidth:640, 
						innerHeight:480
	 });
/***************end of update monita20130821*******************/
$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:480});

$(".iframe").colorbox({iframe:true, width:"640", height:"480"});

$(".ajax").colorbox({maxHeight:"90%"});

});

</script>



<script type="text/javascript">

    var BASE_URI = "<?php echo base_url(); ?>";

	

	function goforsearch()

	{

		document.myform.action = '<?php echo base_url(); ?>search/result/'+document.getElementById('search').value;

		document.myform.submit();

	}

</script>



<script>

  //<![CDATA[

    $(document).ready(function() {

      $(".coverimage").mouseover(function() {

        $(this).find("span").css('display','block');    

      });  

      

      $(".coverimage").mouseout(function() {

          $(this).find("span").css('display','none');

      });

    });

  //]]>



function RatePost(vote,id_num,ip_num,units) {

		$("#unit_long"+id_num).append('<div class="loadingRating"></div>');

		$.get("<?php echo base_url(); ?>ratings_rpc",{j:vote,q:id_num,t:ip_num,c:units},function(result){

		$("#unit_long"+id_num+" .loadingRating").remove();

		$("#unit_long"+id_num).replaceWith(result);	

		

	});

}

</script>



<div id="fb-root"></div>

<script>(function(d, s, id) {

  var js, fjs = d.getElementsByTagName(s)[0];

  if (d.getElementById(id)) return;

  js = d.createElement(s); js.id = id;

  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";

  fjs.parentNode.insertBefore(js, fjs);

}(document, 'script', 'facebook-jssdk'));</script>







<div class="toppest_header">

	<div class="container">

    

    

    

    <div class="span10"> <div class="header-latest-update-lef">  Latest Updates:  </div>

    <div class="header-latest-update-righ">

  <!-- pradip changes for latest news 201307131700-->

 <?php /*?><marquee direction="left" style="width:618px; float:left;" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 4, 0);" >

 <ul>

 <?php $data['get_latest_news'] = $this->dbheader->get_latest_news();

 		foreach($data['get_latest_news'] as $row)

		{

?>			

			

            	<li><a href="<?php echo $row->latest_news_link;?>" <?php if($row->latest_news_tab == 1){?> target="_blank" <?php } ?>><?php echo $row->latest_news_title?></a> | </li>

           

  <?php          

		}

 ?>

  </ul>	

 </marquee><?php */?>

 <ul id="scroller" class="smooth_m" >



	 <?php $data['get_latest_news'] = $this->dbheader->get_latest_news();

            foreach($data['get_latest_news'] as $row)

            {

    ?>			

                

                    <li><a href="<?php echo $row->latest_news_link;?>" <?php if($row->latest_news_tab == 1){?> target="_blank" <?php } ?>><?php echo $row->latest_news_title?></a> | </li>

                    

      <?php          

            }

     ?>

 </ul>

    			<!--end-->

    

    </div>

    </div>

    

    	<div class="span3" align="right">

        <div class="my-account-welcome">

        <?php

		$login = $this->session->userdata('user_email');



		if(!$login)

		{

			?>

            <span><?php echo $this->lang->line('text_welcome');?></span> | 

            <a href="<?php echo base_url('user/login.html'); ?>"><?php echo $this->lang->line('btn_login');?></a> | <a href="<?php echo base_url('user/register.html'); ?>"><?php echo $this->lang->line('btn_register');?></a>

            

            <?php

		}

		else

		{

			$user = $this->dbheader->user_details($login);

			?>

           <span><?php echo $this->lang->line('text_welcome');?> </span> | 

			<a href="<?php echo base_url('user/account.html'); ?>"><?php echo $this->lang->line('btn_my_account');?></a> | <a href="<?php echo base_url('user/logout.html'); ?>"><?php echo $this->lang->line('btn_logout');?></a>

            <div class="my-account-box">

              <div class="photo">

              <?php if($user->mm_photo == NULL || $user->mm_photo == ''){ ?><img src="<?php echo base_url(); ?>images/profile/thumb/no_photo.jpg" height="40px" width="40px" alt="" /><?php } else { ?><img src="<?php echo base_url(); ?>images/profile/thumb/<?php echo $user->mm_photo;?>" height="40px" width="40px" alt="" /><?php }?>

              

              <!--<img src="<?php //echo base_url(); ?>images/<?php //echo $user->mm_photo;?>" height="40px" width="40px" alt="" />--> </div>

              <div class="text"><span><?php echo $user->mm_username;?></span>

             <?php 

			  $get_position = $this->dbheader->get_position($user->mm_id);

			  $get_chapter = $this->dbheader->get_chapter($user->mm_chapter_id);

			  

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

              

              </div> 

			<?php

		}



		?>

                   

        </div>

        </div>

        

    </div>

</div>



<div class="container">

	<div class="space10px"></div>

    <div class="clear"></div>

	<div class="span3">

  

    <a href="<?php echo base_url();?>"><img title="SPCSUSA.ORG" src="<?php echo base_url();?>images/logo.png" /></a></div>

    <div class="span10 main_menu" align="right"  style="width:580px;">

    	<ul class="lavaLamp">

        	<li <?php if($this->uri->segment(2) == "welcome") { ?> class="current" <?php } ?>><a href="<?php echo base_url('info/welcome.html');?>">Home</a></li>

            <!--<li><a href="<?php echo base_url();?>news.html">News</a></li>-->

            <li <?php if($this->uri->segment(1) == "chapter") { ?> class="current" <?php } ?>><a href="<?php echo base_url();?>chapter/national.html">Chapters</a></li>

            <!--<li><a href="<?php echo base_url();?>events.html">Events</a></li>

            <li><a href="<?php echo base_url();?>media.html">Media</a></li>-->

            <li <?php if($this->uri->segment(1) == "user" || $this->uri->segment(1) == "members" || $this->uri->segment(1) == "profile") { ?> class="current" <?php } ?>><a href="<?php echo base_url();?>members.html">Member Directory</a></li>

            <li <?php if($this->uri->segment(1) == "committee") { ?> class="current" <?php } ?>><a href="<?php echo base_url();?>committee/national.html">Committee</a></li>
          <!--added by ketan 20130807-->
			<li <?php if($this->uri->segment(2) == "mem_forum" || $this->uri->segment(2) == "read_forum") { ?> class="current" <?php } ?> ><a href="<?php echo base_url();?>forum/mem_forum">Forum</a></li>
			<!--update end-->
            <li <?php if($this->uri->segment(1) == "contacts") { ?> class="current" <?php } ?> ><a href="<?php echo base_url();?>contacts.html">Contact us</a></li>

        </ul>

    </div>

</div>



