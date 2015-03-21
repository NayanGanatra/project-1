<?php $this->load->view('admincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1 style="display:inline;">Sitemap</h1>
		</div>
        
        <div style="min-height:300px;">
       	<p>Click here to <a href="<?php echo base_url();?>admincp/sitemap/generate">Generate Sitemap</a></p>
        
       <?php
			   	if ($this->session->flashdata('message_type') == "success")
				{
					echo "<p><a target='_blank' href='http://www.google.com//webmasters/sitemaps/ping?sitemap=".base_url()."sitemap.xml.gz'>Submit Sitemap to Google</a></p>";
				}
	   ?>
		</div>
	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>