<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $settings = $this->dbheader->get_setting(); ?>
<title><?php if($title){ echo $title.' - '; } ?><?php echo $settings->sitename;?></title>
<link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/rating.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/colorpicker.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon" href="<?php echo base_url();?>images/<?php echo $settings->favicon;?>" type="image/x-icon" /> 
<meta name="description" content="<?php echo $settings->description; ?>">
<meta name="keywords" content="<?php echo $settings->keywords; ?>">
<style type="text/css">
img, div { behavior: url("<?php echo base_url(); ?>css/iepngfix.htc"); }
</style>
</head>
<body>
<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/scripts.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/jquery-ui.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap.min.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bootstrap.file-input.js' type='text/javascript'></script>
<link href="<?php echo base_url(); ?>css/jquery_ui_blue/jquery-ui-1.9.1.custom.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/colorbox.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>
<script src="<?php echo base_url(); ?>js/script.js"></script>
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
$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:480});
$(".iframe").colorbox({iframe:true, width:"640", height:"480"});
$(".ajax").colorbox({maxHeight:"90%"});
});
</script>

<script type="text/javascript">
    var BASE_URI = "<?php echo base_url();?>";
	
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
		$.get("<?php echo base_url();?>ratings_rpc",{j:vote,q:id_num,t:ip_num,c:units},function(result){
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
    	<div class="offset9 toppest_links" align="right">
        
        <?php
		$login = $this->session->userdata('user_email');

		if(!$login)
		{
			?>
            <?php echo $this->lang->line('text_welcome');?> <?php echo $this->lang->line('text_guest');?> | 
            <a href="<?php echo base_url('user/login.html'); ?>"><?php echo $this->lang->line('btn_login');?></a> | <a href="<?php echo base_url('user/register.html'); ?>"><?php echo $this->lang->line('btn_register');?></a>
            <?php
		}
		else
		{
			$user = $this->dbheader->user_details($login);
			?>
            <?php echo $this->lang->line('text_welcome');?> <?php echo $user->mm_username;?> | 
			<a href="<?php echo base_url('user/account.html'); ?>"><?php echo $this->lang->line('btn_my_account');?></a> | <a href="<?php echo base_url('user/logout.html'); ?>"><?php echo $this->lang->line('btn_logout');?></a>
			<?php
		}
		?>
        
        
        </div>
    </div>
</div>

<div class="container">
	<div class="space10px"></div>
	<div class="span3"><a href="<?php echo base_url();?>"><img title="<?php echo $settings->sitename; ?>" src="<?php echo base_url('images/logo.png'); ?>" /></a></div>
    <div class="span10 main_menu" align="right">
    	<ul>
        	<li><a href="<?php echo base_url('info/welcome.html');?>">Home</a></li>
            <!--<li><a href="<?php echo base_url();?>news.html">News</a></li>-->
            <li><a href="<?php echo base_url();?>chapter/national.html">Chapters</a></li>
            <!--<li><a href="<?php echo base_url();?>events.html">Events</a></li>
            <li><a href="<?php echo base_url();?>media.html">Media</a></li>-->
            <li><a href="<?php echo base_url();?>members.html">Member Directory</a></li>
            <li><a href="<?php echo base_url();?>committee/national.html">Committee</a></li>
            <li><a href="<?php echo base_url();?>contacts.html">Contact us</a></li>
        </ul>
    </div>
</div>

<hr class="header_hr"/>