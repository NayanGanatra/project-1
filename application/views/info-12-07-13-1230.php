<?php $this->load->view('header'); ?>
<div class="welcome-back-bg">
    <div class="container">
        <h1 class="title"><?php echo $title;?></h1>
        <?php if(isset($sub_title)) { ?>
        
        <?php
            if($this->uri->segment(3) =='')
            {
                ?>
                <div class="ch_menu_links">
                <ul>
                <li style="background:none;"><b>Chapters :</b></li>
                <li><a href="<?php echo base_url('chapter/national.html'); ?>">National</a></li>
                <?php $chapters = $this->dbheader->get_all_chapters();
                    foreach($chapters as $chapters_row)
                    {
                        ?>
                        <li><a href="<?php echo base_url('chapter/'.$chapters_row->ch_seo.'.html'); ?>"><?php
                            echo str_replace("Chapter", "", $chapters_row->ch_name); ?></a></li>
                        <?php
                    }
        ?>
            </ul>
            </div>
        <?php }else{ ?>
            <div class="sub_title"><?php echo $sub_title;?></div>
            <?php } } ?>
    
    </div>
</div>

<div class="container">
<div class="row">
<div class="span10 nomargin">
 <div class="page_content">
    <div class="bx-wrapper">
    <div class="bx-viewport">
    <ul class="bxslider">
					<li><a href="#"><img src="../images/culture-img1.jpg" alt="image01" /></a></li>
					<li><a href="#"><img src="../images/culture-img2.jpg" alt="image02" /></a></li>
					<li><a href="#"><img src="../images/culture-img3.jpg" alt="image03" /></a></li>
					<li><a href="#"><img src="../images/culture-img4.jpg" alt="image04" /></a></li>
                    <li><a href="#"><img src="../images/culture-img5.jpg" alt="image04" /></a></li>
					</ul>
                    
              </div></div>
				<!-- End Elastislide Carousel --> 
    
    
    
    <div class="clear"></div>
       <div class="welcome-title-logo">
       <div class="logo-icon"><img src="../images/logo-icon.png" alt="" /> </div>
       <div class="logo-text"> HISTORY OF SAURASHTRA PATEL CULTURAL SAMAJ</div>
       
       </div>
        <div class="clear"></div>
        <!--TABS START--->
       <?php echo $query->page_content; ?>
    
      <!--TABS END--->
        
                          
                           	
        </div>
</div>
<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
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

<script src="../js/chosen.jquery.min.js" type="text/javascript"></script>
<script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>