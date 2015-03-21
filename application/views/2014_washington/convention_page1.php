
    	<?php
			foreach($test as $test)
			{
				?>
                		
                        <h2 style="font-size:24px;"><?php echo $test->page_title;?></h2>
             			<p class="TIME-COLOR"><?php echo $test->page_created_date;?></p>
             			<p><?php $string = $test->page_content;
						    echo $str = word_limiter($string,50); ?></p>
                         <p class="small"><a href="<?php echo base_url().$this->config->item('convention_folder_with_slash');?>convention/detail_page/<?php echo $test->page_id;?>">Read More</a>

                        </p>
              	<?php
			}
		?>
        
		
	<?php  ?>
        
        