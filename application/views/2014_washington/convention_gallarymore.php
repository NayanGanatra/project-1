 <?php 
                 if(count($test) != 0)
                {
              ?>
              
                   <?php
                    foreach($test as $row)
			        {
				   ?>
                    
                   <?php
						$gallery=$this->dbconvention->getgallary($row->ca_id);
						 $count=1;
						if($gallery)
						{
				   ?>	 <ul class="thumbnails" style="float:left; width:25%"> 
                    <div align="center" style="margin-bottom:20px;"><span><?php echo $row->ca_name; ?></span></div><br />
                   <?php
							 foreach($gallery as $gallery)
			                 {
							  
							 
                   ?>
                   
                    <li class="span2">
                            <a class="thumbnail myrotation<?php echo $count; ?>" title="<?php echo $gallery->cg_title; ?>" href="<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/convention_gallarypage/'.$gallery->cg_ca_id.""); ?>" style="height:90px !important; width:150px !important;">
                  <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$gallery->cg_thumb.'');?>" alt="<?php echo $gallery->cg_title; ?>" style="height:90px !important; width:150px !important;">
                 </a>
                   </li>
                   <?php 
				                $count ++;
							 }
						?> </ul><?php
						}
					?>
                    
				  <?php		
					}
				   ?>
              
              <?php 
				}?>