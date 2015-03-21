  <style>
  .thumbnails{
	  height:160px;
	  position:relative;
	  width:30%;
	 
  }
  .row-fluid
  {
	  margin:28px!important;
  }
  .row-fluid .span2
  {
	  width: 1.894% !important;
	  margin:0.3em;
 }
  
  
  .my_thumbnail
  {
	  background-color:#FFF;
	   margin-left: 33px;
	   
  }
  .abs_class a{ 
	  /*position:absolute;*/
  }
  .my_thumbnail{
	   color: #C4C3C2;
    font-size: 64px;
   
    line-height: 226px;
    position: absolute;
  }
 /*<!------update_monita20130924-------------->*/ 
  .myrotation3{
	  transform: rotate(3deg);
	
     -webkit-transform: rotate(3deg);/*crome*/
 	 -webkit-transition: all 0.5s ease;
      transition: all 0.5s ease;
	  transition-property: width ease;
	  -webkit-transition-property:width ease;
	

	
  }
  .myrotation2{
 transform: rotate(6deg);
 
  -webkit-transform: rotate(6deg);/*crome*/
 -webkit-transition: all 0.5s ease;
  transition: all 0.5s ease;
  transition-property: width ease;
  -webkit-transition-property:width ease;

 
  }
  
  a.thums_hovers:hover .myrotation2 {
    left: -47px;
    transform: rotate(-22deg);
   -webkit-transform: rotate(-22deg);/*crome*/
	border-color:#0088CC;

}
 a.thums_hovers:hover .myrotation3 {
  left: 47px;
    transform: rotate(22deg);
   -webkit-transform: rotate(22deg);
	border-color:#0088CC;
	
	
}
/*<!------update_monita20130924-------------->*/ 
 a.thums_hovers:hover .myrotation1 {
  
	z-index:9999;
	border-color:#0088CC;

}
 a.thums_hovers .myrotation1 {
  
	z-index:9999;
	
	
}
  .my_thumbnail span.img {
    height: 164px;
    width: 164px;
}
.thums_hovers{
	float:left;
}
.title_span
{
	margin-bottom:12px!important;
}
  </style>

<div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" /> Gallery </div>
    </div> 
     <div class="row-fluid">  
     <!------update_monita20130924-------------->       
              <?php 
                 if(count($album) != 0)
                {
              ?>
              
                   <?php
                    foreach($album as $row)
			        {
				   ?>
                    
                   <?php
				         
						$gallery=$this->dbconvention->getgallary($row->ca_id);
						 $count=1;
						if($gallery)
						{
				   ?>	  
                
                    <div class="thumbnails" style="float:left; width:32%;margin-top:5px; margin-bottom:30px;">
                   <div style="margin-bottom:35px; margin-top:15px!important;" align="center"><span><strong><?php echo $row->ca_name; ?></strong></span></div> 
                  
                     <a class="thums_hovers" title="<?php //	echo $gallery->cg_title; ?>" href="<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/convention_gallarypage/'.$row->ca_id.""); ?>" style="margin-top:-9px;">
               
                   <?php
							 foreach($gallery as $gallery)
			                 {
							  
							 
                   ?>
                   
                    <span class="thumbnail my_thumbnail myrotation<?php echo $count; ?>">
                         
                  <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$gallery->cg_thumb.'');?>" alt="<?php echo $gallery->cg_title; ?>" style="height:111px !important; width:146px !important;">
                
                   </span>
                   <?php 
				                $count ++;
							 }
						?>  </a></div>
						<?php
						}
					?>
                  
				  <?php		
					}
				   ?>
              
              <?php 
				}?>
       
       <!------update_monita20130924-------------->
        </div> 
