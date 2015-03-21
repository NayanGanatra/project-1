<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php $settings = $this->dbheader->get_setting(); ?>
<title><?php if($title){ echo $title.' - '; } ?><?php echo $settings->sitename;?></title>
<link href="<?php echo base_url(); ?>css/homestyle.css" rel="stylesheet" type="text/css">
<link rel="Shortcut Icon" href="<?php echo base_url();?>images/<?php echo $settings->favicon;?>" type="image/x-icon" /> 
<meta name="description" content="<?php echo $settings->description; ?>">
<meta name="keywords" content="<?php echo $settings->keywords; ?>">
<style type="text/css">
img, div { behavior: url("<?php echo base_url(); ?>css/iepngfix.htc"); }
</style>

<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/bjqs-1.3.min.js' type='text/javascript'></script>
<link href="<?php echo base_url(); ?>css/bjqs.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#my-slideshow').bjqs({
        'height' : 600,
        'width' : 1000,
		'animtype' : 'fade',
		'showcontrols' : false,
        'responsive' : true,
		'randomstart' : true,
		'hoverpause' : false,
    });
});
</script>

</head>
<body>

<div align="center" class="home_img">
	<div id="my-slideshow">
    <ul class="bjqs">
    	<?php
			redirect(base_url('info/welcome.html'));
			$slider = $this->dbheader->get_home_slider();
			foreach($slider as $slider_row)
			{
				if($slider_row->link !='')
				{
					?>
					<li><a href="<?php echo $slider_row->link; ?>"><img src="<?php echo base_url('images/slider/'.$slider_row->image.''); ?>" /></a></li>
					<?php
				}
				else
				{
					?>
					<li><img src="<?php echo base_url('images/slider/'.$slider_row->image.''); ?>" /></li>
					<?php
				}
			}
		?>
    </ul>
	</div>
	
</div>

</body>
</html>