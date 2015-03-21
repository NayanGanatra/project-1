<?php
			if($test)
			{
				foreach($test as $row1)
				{
					?>
                     <?php if($row1->cg_type == 1)
						     { 
						         $str_temp=$row1->cg_data;
								 $str=substr($str_temp,0,4);
						         if($str=='http')
								 {
						?>
   <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;"><!----------updatemonita---------->
                               <a class="youtube thumbnail cboxElement" href="<?php echo $row1->cg_data; ?>" title="<?php echo $row1->cg_title;?>" style="height:90px !important; width:150px !important; margin-right:3em!important;"><!----------updatemonita---------->

                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_thumb.'');?>" alt="<?php echo $row1->cg_title; ?>" style="height:90px !important; width:150px !important;">

                        </a>
                        </li>
						<?php 
							 }
						      else	
							  {
						     ?>
                              <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;"><!----------updatemonita---------->
                               <a class="video thumbnail cboxElement" href="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_data); ?>" title="<?php echo $row1->cg_title;?>" style="height:90px !important; width:150px !important; margin-right:3em!important;"><!----------updatemonita---------->
                               
                        
                          <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row1->cg_thumb.'');?>" alt="<?php echo $row1->cg_title; ?>" style="height:90px !important; width:150px !important;">
                         </a>
                         </li>
							<?php 
								}
							 }
						 ?>
                    <?php 
				 }
			 }
			 ?>
			 