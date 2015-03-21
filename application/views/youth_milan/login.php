<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script type="text/javascript">var BASE_URI = "<?php echo base_url();?>";</script>

<title>Login - Youthmilan</title>

<link  href="<?php echo base_url();?>css/youth_milan/style_youthmilan.css" type="text/css" rel="stylesheet" />


</head>

<body>

<div class="row-fluid">

  <div class="container">
  
    <div id="topheader">
	
      <div id="logo"> <a href="#"><img alt="Slider" src="<?php echo base_url();?>images/youth_milan/logo1.png"></a> </div>
      
    </div>
	
    <div class="loginbox">
	
      <div class="logo-text21">Login</div>

		<div align="center" class="error"><?php echo form_error('loginid'),form_error('password'); ?></div>
		
		<div align="center" class="error"><?php if($this->session->userdata('error')){echo "Sorry,Incorrect Login Id and Password.";$this->session->unset_userdata('error');}?></div>
		
		<?php

                $form_attributes = array('id' => 'myform');

                echo form_open('', $form_attributes);

        ?>
		
	  	<table style="float:left;clear:both;width:30%" align="center">
	  
      	<tr>
		
        	<td align="right" class="txtBlack13Arial"><strong>Login ID <span class="err">*</span></strong></td>
        	
			<td class="txtBlack13Arial" width="50%">
					
				<input type="text" class="textBox_Admin" id="loginid" name="loginid">
				
					
			</td>	
						
    	</tr>
     
	 	<tr>
		
        	<td align="right" class="txtBlack13Arial"><strong>Password <span class="err">*</span></strong></td>
        			
			<td class="txtBlack13Arial">
						
				<input type="password" class="textBox_Admin" id="password" name="password">
				
					
			</td>
			
    	</tr>
     
	 	<tr>
        			
			<td></td>
			
        	<td align="left">
					
				<input type="submit" class="btn btn-primary" value="Login" id="login" name="login">&nbsp;
					
			</td>
    			
		</tr>
				
	</table>
           
		   
	<?php echo form_close(); ?>
	
	  
    </div>
	
    <div class="clearfix"></div>
    
  </div>
  
</div>

</body>

</html>