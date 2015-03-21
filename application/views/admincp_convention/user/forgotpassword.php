<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->lang->line('text_admin');?></title>
<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>css/adminstyle.css" rel="stylesheet" type="text/css">

</head>

<body>

<div class="tpopspace150px"></div>
<div id="stylized" class="loginform roundedCorners">

<h1><?php echo $this->lang->line('text_reset_password');?></h1>
<p><?php echo $this->lang->line('text_reset_password_desc');?></p>

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

<?php if(form_error('email')) { ?>
<div class="alert alert-error"><?php echo form_error('email'); ?></div>
<?php } ?>

			<?php
                $form_attributes = array('id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            
			<label><?php echo $this->lang->line('text_email');?>
            <span class="small"><?php echo $this->lang->line('text_username_note');?></span>
            </label>
            <input type="text" name="email" class="input_text" style="width:200px;" />
            
            <button type="submit" class="btn btn-inverse"><?php echo $this->lang->line('btn_submit');?></button>
            <a style="font-size:12px;" class="btn btn-link" href="login"><?php echo $this->lang->line('text_login');?></a>
            </form>
            
</div>        


</body>
</html>