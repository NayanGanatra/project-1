<?php
	$sliders = $this->dbconvention_slider->get_sliders(); ?>
    <div class="bs-docs-example">
              <div id="myCarousel" class="carousel slide">
			  <div class="carousel-inner">
			  <?php
			  if($sliders)
			  {
			  	$temp = 0;
			  	foreach($sliders as $slider)
				{
					if($temp==0)
					{ ?>
					<div class="item active">
					<a target="_blank" href="<?php echo $slider->cs_link; ?>">
                    <img src="<?php echo base_url().'images/convention/slider/'.$slider->cs_image; ?>" alt="">
					</a>
                    </div>
					<?php }
					else
					{ ?>
					<div class="item">
					<a target="_blank" href="<?php echo $slider->cs_link; ?>">
                    <img src="<?php echo base_url().'images/convention/slider/'.$slider->cs_image; ?>" alt="">
					</a>
                    </div>
					<?php }
					$temp++;
					
				}
			  }
			  ?>
                 <!--<div class="carousel-inner">
                  <div class="item active">
                    <img src="<?php echo base_url(); ?>images/spcs_convention/banner1.jpg" alt="">
                    
                  </div>
                  <div class="item">
                    <img src="<?php echo base_url(); ?>images/spcs_convention/banner2.jpg" alt="">
                    
                  </div>
                  <div class="item">
                    <img src="<?php echo base_url(); ?>images/spcs_convention/banner3.jpg" alt="">
                    
                  </div>
                </div>-->
				</div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
              </div>
          </div>
<script type='text/javascript'>
	$(document).ready(function() {
    $('.carousel').carousel({
  		interval: 5000
  	})
});
 </script>