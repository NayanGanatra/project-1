    <div id="unit_long<?php echo $id; ?>">
        <ul id="unit_ul<?php echo $id; ?>" class="unit-rating" style="width: <?php echo  $rating_unitwidth*$units; ?>px;">
            <li class="current-rating" style="width: <?php echo $rating_width; ?>px;">Currently <?php echo  $rating2.'/'.$units; ?></li>
            <?php 
                for ($i = 1; $i <= $units; $i++) // loop from 1 to the number of units
                { 
                   if (!$voted) // if the user hasn't yet voted, draw the voting stars
                   { 
                      // r=1 in url provides for javascript being disabled
                      echo '<li><a href="javascript:void(0)" onclick=RatePost("'.$i.'","'.$id.'","'.$ip.'","'.$units.'","1")  title="'.$i.' out of '.$units.'" class="r'.$i.'-unit rater" rel="nofollow">'.$i.'</a></li>';
                   }
                }
                $i = 0; 
                $pclass = ($voted) ? ' class="voted"' : '';
              ?>
        </ul>

    </div>