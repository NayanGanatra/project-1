<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    	<?php $settings = $this->dbheader->get_setting(); ?>
        <div style="float:left; width:100%; margin-bottom:20px;">
        <span style="float:left;">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/spcs_convention/{logo2}');?>" border="0" /></a>
        </span>
        <span style="float:left; margin-left:20px; font-size:24px;">
        {con_title}
        </span>
        <span style="float:left; margin-left:30px;">
    	<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/spcs_convention/{logo}');?>" border="0" /></a>
        </span>
        </div>
        <br /><br />
        Hi {con_first_name}<br/><br />
        your payment successfully done at {sitename} with registration number {con_reg_num}.<br /><br />
        
    	<div><b>Login Email :</b> {con_hdn_email}</div>
		<br /><br />
    </td>
  </tr>
</table>