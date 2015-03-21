<div class="bs-docs-sidebar">

            <ul class="nav nav-list bs-docs-sidenav">

            <?php

			$con = $this->dbheader->get_con();

			if(isset($con))

			{
				
				foreach($con as $row)
				{
			?>

					<li><a href="<?php echo base_url().$row->con_year; ?>/<?php echo $row->con_link; ?>"><?php echo $row->con_name;?> Convention <?php echo $row->con_year; ?></a></li>

			<?php 

				}

			}

			?>

			</ul>

</div>
