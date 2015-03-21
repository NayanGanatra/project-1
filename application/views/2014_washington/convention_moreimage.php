          <?php 
                if($test)
				{
               ?>
              <?php
              foreach($test as $row)
			 {
              ?>
               <?php 
			     if($row->cg_type == 0)
			     { 
				?>
                      <li class="span2" style="width: 16.894%!important; margin:1.3em!important; padding-right:135px!important;"><!----------updatemonita---------->
                    <a rel="gallery" class="gallery thumbnail" title="<?php echo $row->cg_title; ?>" href="<?php echo base_url('images/convention/gallery/big/'.$row->cg_data); ?>" style="height:90px !important; width:150px !important; margin-right:3em!important;""><!----------updatemonita---------->
                  <img src="<?php echo base_url('images/convention/gallery/thumbs/'.$row->cg_thumb.'');?>" alt="<?php echo $row->cg_title; ?>" style="height:90px !important; width:150px !important;">
                 </a>
                    </li>
             <?php 
				 }
			  }
			}
			?>