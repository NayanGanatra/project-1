<?php $this->load->view('header'); ?>

<!-----------------------------------------monita20130718---------------------------------------------------->

<style>



#bx_slider123456{

	display:none;

}

</style>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.bxslider.js"></script>

<script language="javascript" type="text/javascript">

  $(window).load(function() {	

    $('#loading').hide();

	$("#bx_slider123456").css({ display: "block" });

	$('.bxslider').bxSlider({

  minSlides: 1,

  maxSlides: 1,

  slideWidth: 768,

  slideMargin: 0,

  auto: true,

  pager: true,

  controls:false,

  

});

  });

 $(document).ready(function(){

$('#bxslider2').bxSlider({

	mode: 'vertical',

  slideWidth:0,

  slideMargin: 10,

  auto:true,

  controls:false,

  pager: true

  

});

  });

</script>



<!----------------------------------------end of----monita20130718---------------------------------------------------->

<div class="welcome-back-bg">



    <div class="container">

        <h1 class="title"><?php echo $title;?></h1>

        <?php if(isset($sub_title)) 
		{ ?>
		<?php
		
			
			if($this->uri->segment(3) =='')

            {

                ?>

                <div class="ch_menu_links">

                <ul>

                <li style="background:none;"><b>Chapters :</b></li>

                <li <?php if($this->uri->segment(2) =='national') { ?> class="act" <?php } ?> ><a href="<?php echo base_url('chapter/national.html'); ?>">National</a></li>

                <?php $chapters = $this->dbheader->get_all_chapters();

                    foreach($chapters as $chapters_row)

                    {

                        ?>

                        <li <?php if($this->uri->segment(2) == $chapters_row->ch_seo) { ?> class="act" <?php } ?>><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><?php

                            echo str_replace("Chapter", "", $chapters_row->ch_name); ?></a></li>

                        <?php

                    }

        ?>

            </ul>

            </div>

        <?php }
			else
			{
				if(isset($chapter->ch_id))
				{
					
					$menu = $this->dbheader->get_info_ch_menu_title($chapter->ch_id);
					if($this->uri->segment(2)==$chapter->ch_seo)
					{
	
					?>
	
					<div class="ch_menu_links">
	
					<ul>
	
					<li style="background:none;"><b>Chapters :</b></li>
	
					<li <?php if($this->uri->segment(2) =='national') { ?> class="act" <?php } ?>> <a href="<?php echo base_url('chapter/national.html'); ?>">National</a></li>
	
					<?php $chapters = $this->dbheader->get_all_chapters();
	
						foreach($chapters as $chapters_row)
	
						{
	
							?>
                            
	
							<li <?php if($this->uri->segment(2) == $chapters_row->ch_seo) { ?> class="act" <?php } ?>><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><?php
	
								echo str_replace("Chapter", "", $chapters_row->ch_name); ?></a></li>
	
							<?php
	
						}
	
					?>
	
					</ul>
		
					</div>
	
				<?php }
				 }
				else
				{?>
	
				<div class="sub_title"><?php echo $sub_title;?></div>
	
				<?php } 
			}
		} ?>

    

    </div>

</div>



<div class="container">

<div class="row">

<div class="span10 nomargin">

<div id="loading" align="center"><img src="<?php echo base_url();?>images/bx_loader.gif" /></div>

 <div class="page_content">

 <div id="bx_slider123456">

    <div class="bx-wrapper"  >

    <div class="bx-viewport">

    <ul class="bxslider">

    				

                    

					<li><a href="#"><img src="<?php echo base_url();?>images/culture-img1.jpg" alt="image01" /></a></li>

					<li><a href="#"><img src="<?php echo base_url();?>images/culture-img2.jpg" alt="image02" /></a></li>

					<li><a href="#"><img src="<?php echo base_url();?>images/culture-img3.jpg" alt="image03" /></a></li>

					<li><a href="#"><img src="<?php echo base_url();?>images/culture-img4.jpg" alt="image04" /></a></li>

                    <li><a href="#"><img src="<?php echo base_url();?>images/culture-img5.jpg" alt="image04" /></a></li>

					</ul>

                    

              </div></div>

              </div>

             

				<!-- End Elastislide Carousel --> 

    

    

    

    <div class="clear"></div>

       

        <!--TABS START--->

       <?php //echo $query->page_content; ?>

          <!-----------------------------------------monita20130703---------------------------------------------------->

        <?php $this->load->view('action_status'); ?>

			<?php 

			    $seg=$this->uri->segment(2); 

				  $seg2=$this->uri->segment(3); 

				

	             if($seg=="preferred-vendors")

				 {

					 

					

					$this->load->view('vendor');

			     ?>

               

                    <?php

				 }

				 elseif($seg=="national" && $seg2=="preferred-vendors")

				 {

					$this->load->view('vendor');

				 }

				 else

				 {
					if($this->uri->segment(2)=='welcome' || $this->uri->segment(3)=='')
					{
						
					echo $query->page_content;
					}
					else
					{
						/*$login = $this->session->userdata('user_email');
						if($login)
						{*/
							?>
					 <div class="clear"></div> 
						<div id="tabschap1">
							
							<div class="stContainer" style="margin-top:20px; overflow-y:auto; padding:10px" >
							<?php 
								$menu = $this->dbheader->get_info_ch_menu1($chapter->ch_id);
								$chapter = $this->dbheader->get_chapter_by_user($chapter->ch_id);
								foreach($menu as $menu_row)
								{
									if($this->uri->segment(3) == $menu_row->page_seo)
									{
														   
								?>
								<div id="tabs-<?php echo $menu_row->page_id;?>">
								<?php echo $menu_row->page_content; ?>
								
								</div>
								
							<?php
									}
									
								}
							//}?>
                            </div>
							
					</div>
					<?php
						/*}*/
                    }

				 }

			 ?>  

               <!-----------------------------------------End of monita20130703---------------------------------------------------->

    

      <!--TABS END--->

    

      <!--TABS END--->

        

                          

                           	

        </div>

</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">

    <div class="sidebar">

    <?php $this->load->view('ca_menu'); ?>

      <?php if($chapter){ $this->load->view('chapter_menu'); } else {?>

        <?php $this->load->view('sidebar'); ?>
        

        <?php }?>                      

<div class="space20px"></div>

        

<?php $this->load->view('ads_panel'); ?>



<div class="space20px"></div>

</div>



</div></div>



</div>

<div class="space10px"></div>

<div class="clear"></div>



<?php $this->load->view('footer'); ?>



<!--<script src="<?php //echo base_url();?>js/chosen.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>-->