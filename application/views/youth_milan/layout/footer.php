<footer id="content-info" class="container">

      <div>
	  	
		<?php
					$footer_menu = $this->dbyouthmilan_header->get_footer_menu();
					foreach ($footer_menu as $footer_menu_row)
				    {
					?>
                    <a href="<?php echo base_url();?>info/<?php echo $footer_menu_row->page_seo; ?>.html"><?php echo $footer_menu_row->page_menu_name; ?></a> | 
                    <?php
					}
		?>
        <a href="<?php echo base_url();?>contacts.html">Contact Us</a>
        
	   <!--<a href="#">Welcome</a> | <a href="#">SPCS History</a> | <a href="#">Information About India</a> | <a href="#">Convention</a> | <a href="#">Preferred Vendors</a> | <a href="#">Contact Us</a> -->
	   
	  </div>
      
	  <div style="text-transform:capitalize; padding:10px 0 0 0;">&copy; Copyright  2013 testsite.spcsusa.org All rights reserved.
	  </div>

</footer>

</div>

</div>

</body>

</html>