<div class="space20px"></div>
<div class="footer">
<?php $settings = $this->dbheader->get_setting();

function GetDomain($url)
{
$nowww = preg_replace('/www\./','',$url);
$domain = parse_url($nowww);
if(!empty($domain["host"]))
    {
     return $domain["host"];
     } else
     {
     return $domain["path"];
     }
 
}
?>
<footer>
<table width="1050" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
  	<td>
    	<div class="footer-links-m">
        <div>
        <?php
			$footer_menu = $this->dbheader->get_footer_menu();
					
					foreach ($footer_menu as $footer_menu_row)
				    {
					?>
                    <a href="<?php echo base_url();?>info/<?php echo $footer_menu_row->page_seo; ?>.html"><?php echo $footer_menu_row->page_menu_name; ?></a> | 
                    <?php
					}
		?>
        <a href="<?php echo base_url();?>contacts.html">Contact Us</a>
        </div>
        <div style="text-transform:capitalize;"><?php echo $this->lang->line('text_copyright_info');?> <?php echo date('Y');?> <?php echo GetDomain($_SERVER['SERVER_NAME']); ?> <?php echo $this->lang->line('text_all_rights');?></div>
        <?php echo $settings->tracking; ?>
</div>
    </td>
    <td align="right">
   <div class="facebookbox-m">
        <ul class="facebook">
<li class="face"></li>
<li class="twitter"></li>
<li class="linked"></li>
</ul>
     </div>
  </tr>
</table>

</footer>
<!-------------------------------------------monita 20130713------------------------------------>
<?php 
$seg=$this->uri->segment(2);
$seg2=$this->uri->segment(3); 
if($seg != 'preferred-vendors' && $seg2 != 'preferred-vendors')
{
?>
<script src="<?php echo base_url('js/chosen.jquery.min.js'); ?>" type="text/javascript"></script>


<script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
<?php } ?>

<!-------------------------------------------monita 20130713------------------------------------>