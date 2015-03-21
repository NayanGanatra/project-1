

<table class="tbl_class" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px; width:100%;"> 
  <tr>
  	<td>
    	 	
			
			<!--bharat3465@gmail.com-->
			<div style="float:left; width:100%;" class="by_paypal" id="by_paypal">
            		<h2>Wait payment is processing...</h2>
                	<?php $urlpaypal = "https://www.paypal.com/cgi-bin/webscr"; ?>
                	<form method="post" name="frmPayPal" id="frmPayPal" action="<?=$urlpaypal ?>">
						
                        <input type="hidden" name="cmd" value="_xclick">
                        <input type="hidden" name="business" value="bharat3465@gmail.com">
                        <input type="hidden" name="custom" value="<?php echo $query->fm_email.'/'.$query->fm_reg_num; ?>">
                        <input type="hidden" name="item_name" value="spcsusa_convention_fees">
                        <input type="hidden" name="rm" value="2">
                        <input type="hidden" name="return" value="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/success_payment.html') ?>">
                        <input type="hidden" name="notify_url" value="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/ipn_payment.html') ?>" />
                        <input type="hidden" name="currency_code" value="USD">
                        <?php 
                        //calculate paypal processing fee 2.2% + $0.30
                        //include 'sponsor_amount'
						//include 'lifemember_amount'
                        $totalFee = $query->fm_total_fee+$query->event_amount+$query->sponsor_amount;
                        $total_with_paypal = 1;//round($totalFee + ($totalFee * 0.022) + 0.30, 2);
                        ?>
                        <input type="hidden" name="amount" value="<?php echo $total_with_paypal;    ?>"/>
                        
                    </form>
                </div>
             
	</td>
  </tr>
</table>
<script type="text/javascript">
window.onload=function(){ 
    window.setTimeout(document.frmPayPal.submit.bind(document.frmPayPal), 5000);
};
</script>
   