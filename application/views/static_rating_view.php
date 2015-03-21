<div class="ratingblock">
    <div id="unit_long<?php echo $id; ?>">
        <ul id="unit_ul<?php echo $id; ?>" class="unit-rating" style="width: <?php echo $rating_unitwidth*$units; ?>px;">
            <li class="current-rating" style="width: <?php echo $rating_width; ?>px;">Currently <?php echo $rating2.'/'.$units; ?></li>
        </ul>
        <p class="static"><?php echo  $id; ?> Rating: <strong><?php echo $rating1; ?></strong>/<?php echo $units.' ('.$count.' '.$tense.' cast)'; ?> <em>This is static</em></p>
    </div>
</div>  