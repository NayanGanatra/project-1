<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbheader->get_setting(); ?>
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/'.$settings->logo.'');?>" border="0" /></a>
        <br /><br />
        Dear SPCS Member<br/><br />
        {message}
		<br />
        Please click on following link to isrsvp<br />
        {link}<br /><br />
        <div>
		Thank you,<br />
        {sitename} Team<br />
        {site_email}
        </div>
    </td>
  </tr>
</table>
