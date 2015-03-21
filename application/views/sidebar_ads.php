<div class="space20px"></div>
<?php $get_ads250 = $this->dbheader->get_ads('250x250'); if($get_ads250){ ?>
<div class="250banner" align="center"><?php echo $get_ads250->ads_code; ?></div>
<?php } ?> 