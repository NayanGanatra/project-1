<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbadminheader->getsettings(); ?>
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/'.$settings->logo.'');?>" border="0" /></a>
        <br /><br />
        Hi {fname}<br/><br />
        Welcome to Saurashtra Patel Cultural Samaj - SPCS new website. <br /><br />
        Please click on the below link to reset your password.<br /><br />
        <div>Username : {username}</div>
        <div><a href="<?php echo base_url();?>user/reset_password/{code}/{username}"><?php echo base_url();?>user/reset_password/{code}/{username}</a></div><br /><br />

        <div>
		Thanks again for support and help!!!<br />
        {sitename} Team<br />
        
        <br />
        If you already reset your password then ignore this email.
        </div>
    </td>
  </tr>
</table>