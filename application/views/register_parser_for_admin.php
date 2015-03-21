<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbheader->get_setting(); ?>
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/'.$settings->logo.'');?>" border="0" /></a>
        <br /><br />
        <b><u>User Details</u></b><br> 
        Name:{name}<br />
        Username:{mm_username}<br />
        Email:{mm_email}<br />
        Contact Number:{mm_hphone}
        
    </td>
  </tr>
</table>
