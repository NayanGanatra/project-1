<hr>
<footer>
<div class="space10px"></div>
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
<div class="footer">
<table width="1050" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
  	<td>
    	<div style="margin-bottom:10px; line-height:18px;">
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
    <a href=""><img src="<?php echo base_url();?>images/twitter_icon.png" border="0" title="<?php echo $this->lang->line('twitter_icon_text');?>" /></a>
    <a href=""><img src="<?php echo base_url();?>images/facebook_icon.png" border="0" title="<?php echo $this->lang->line('facebook_icon_text');?>" /></a></td>
  </tr>
</table>

</footer>
</div>
<script src="<?php echo base_url('js/chosen.jquery.min.js'); ?>" type="text/javascript"></script>
<script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
</body>
</html>