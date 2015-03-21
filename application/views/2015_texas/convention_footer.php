<div class="space20px"></div>
<div class="footer">
<?php $settings = $this->dbconvention_header->get_setting();
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
<style>
#content-info
{
	padding:0;
}
</style>
<footer id="content-info" class="container" role="contentinfo" style="float:left; margin-top:10px;" >
<table width="1050" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
  	<td>
    	<div class="footer-links-m" style="width:100%" >
        <div>
        <?php
					$footer_menu = $this->dbconvention_header->get_footer_menu();
					foreach ($footer_menu as $footer_menu_row)
				    {
					?>
                    <a href="<?php echo base_url();?>index.php/info/<?php echo $footer_menu_row->page_seo; ?>.html"><?php echo $footer_menu_row->page_menu_name; ?></a> | 
                    <?php
					}
		?>
        <a href="<?php echo base_url();?>/index.php/contacts.html">Contact Us</a>
        </div>
        <div style="text-transform:capitalize;"><?php echo $this->lang->line('text_copyright_info');?> <?php echo date('Y');?> <?php echo GetDomain($_SERVER['SERVER_NAME']); ?> <?php echo $this->lang->line('text_all_rights');?></div>
        <?php echo $settings->tracking; ?>
</div>
    </td>
  </tr>
</table>
</footer>