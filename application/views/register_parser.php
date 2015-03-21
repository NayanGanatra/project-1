<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbheader->get_setting(); ?>
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/'.$settings->logo.'');?>" border="0" /></a>
        <br /><br />
        Hi {name}<br/><br />
        Thank you for registering with {sitename}. Please click on following link to active your account.<br /><br />
        <div><a href="<?php echo base_url();?>user/verify/{seq_code}/{username}"><?php echo base_url();?>user/verify/{seq_code}/{username}</a></div><br /><br />
    	<div><b>Login Email :</b> {user_email}</div>
		<br /><br />
        <div>
		Thank you,<br />
        {sitename} Team
        </div>
    </td>
  </tr>
</table>
