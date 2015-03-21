<?php $settings = $this->dbheader->get_setting();

$this->load->library('email');

		$this->load->library('parser');?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="padding:5px;"> 

  <tr>

  	<td>

		<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border:1px solid #CCCCCC;">

            <thead>

                <tr style="background:#0599E3; color:#FFF; "  >

                    <td colspan="7" style="text-align:center;">{subject}</td>

                </tr>

                <tr>
                    <td colspan="7" style="height:100px;"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/'.$settings->logo.'');?>" border="0" style="margin-left:10px;" /></a>

                   		<div style="float:right; margin:22px 10px 0px 0px; border-bottom-left-radius:5px !important;border-bottom-right-radius:5px !important">

                           <a href="https://www.facebook.com/"><img src="<?php echo base_url('images/facebook_mail.png');?>" border="0" style="margin-left:5px;" /></a>

                           <a href="https://twitter.com/"><img src="<?php echo base_url('images/twitter_mail.png');?>" border="0" style="margin-left:5px;" /></a>

                           <a href="http://in.linkedin.com/"><img src="<?php echo base_url('images/linkedin_mail.png');?>" border="0" style="margin-left:5px;" /></a>

                        </div>

                    </td>
                </tr>
            </thead>
 			<tbody >    
				<tr style="border:1px solid #CCCCCC; ">
                    <td  colspan="7" style="vertical-align:top;border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;  padding:10px 10px">
                             	{html}
                    </td>
                </tr>
            </tbody>
            <tfoot>

                <tr style="border:1px solid #CCCCCC; background:#6F6F6F; color:#FFF; text-decoration:none" >

                    <td colspan="7" style="height:50px;vertical-align:center" align="center">

					<?php

					$footer_menu = $this->dbheader->get_footer_menu();

					

					foreach ($footer_menu as $footer_menu_row)

				    {

					?>

                    <a style=" color:#FFF; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:12px"  href="<?php echo base_url();?>info/<?php echo $footer_menu_row->page_seo; ?>.html"><?php echo $footer_menu_row->page_menu_name; ?></a> | 

                    <?php

					}

					?>

        			<a style=" color:#FFF; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:12px"  href="<?php echo base_url();?>contacts.html">Contact Us</a>

					<br /><span style=" color:#FFF; text-decoration:none; font-family:Arial, Helvetica, sans-serif; font-size:12px">&copy; Copyright  2013 spcsusa.org All rights reserved.</span>

    				</td>

        		</tr>

            </tfoot>

           

        </table>

     </td>

  </tr>

</table>

       	        



