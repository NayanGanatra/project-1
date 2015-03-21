<?php $this->load->view('chapteradmincp/layout/header'); ?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1 style="display:inline;">Add New Templates</h1>
		</div>
        
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
            ?>

            <div class="space10px"></div>
            <fieldset>
                <legend>Template Details</legend>                
               
                <div>
                	 <p><label>Set Dimentions:</label>
                     <div id="parent" style="display:inline-block; background-image:url(<?php echo base_url();?>covers-images/download/<?php echo $query->templates_img; ?>); height:315px; width:851px;">
                     	<?php
						$a = 0;
						for($i=1;$i<=$query->temp_numofpics;$i++)
						{
						?>
                            <div  class="ui-widget-content" id="mypicbox<?php echo $i; ?>" style=" position:absolute; display:inline-block; height: <?php echo $query->temp_img_size; ?>px; width: <?php echo $query->temp_img_size; ?>px; left:<?php echo ($a); ?>px;"><span style="font-size: 20px; margin-left: 10px; margin-top: 10px; position: absolute;"><?php echo $i; ?></span>
                            <img id="mypic" src="<?php echo base_url();?>images/user_pic.png" width="<?php echo $query->temp_img_size; ?>" height="<?php echo $query->temp_img_size; ?>"/>
                            </div>
                        <?php
						$a+=170;
						}
						?>
                     </div>
                      <?php
					  $temp = 0;
						for($i=1;$i<=$query->temp_numofpics;$i++)
						{
							?>
								<input type="hidden" name="imagex1-<?php echo $i; ?>" id="imagex1-<?php echo $i; ?>" size="5" value="<?php echo $temp; ?>" /><input type="hidden" name="imagey1-<?php echo $i; ?>" id="imagey1-<?php echo $i; ?>" size="5" value="0" />
							<?php
							$temp+=170;
						}
						?>
                   
                    </p>
                </div>
                
			
            </fieldset>
            
            
            
            <div style="margin-top:6px;"><input type="submit" value="Submit" class="submit_btn" name="submit" /></div>
            <div class="space20px"></div>
         
</table>
<script type="text/javascript" language="javascript">

var w_img = $("#mypic").width();
	
	// Plugin
		$.fn.AbsolutelyPosition = function() {
		    var $el;
		    return this.each(function() {
		    	$el = $(this);
		    	var newDiv = $("<div />", {
		    		"class": "innerWrapper",
		    		"css"  : {
		    			"height"  : $el.height(),
		    			"width"   : "100%",
		    			"position": "relative"
		    		}
		    	});
		    	$el.wrapInner(newDiv);    
		    });
		};
		
		// DOM Ready
		$(function() {
			// Usage
			$("#parent").AbsolutelyPosition();
		});
</script>
<?php

			echo '<script type="text/javascript" language="javascript">';
			for($i=1;$i<=$query->temp_numofpics;$i++)
			{
				echo "$('#mypicbox".$i."').draggable(
					{
							drag: function(){
								var position = $('#mypicbox".$i."').position();
								var xPos".$i." = position.left;
								var yPos".$i." = position.top;
								var xPoss".$i." = xPos".$i.";
								var yPoss".$i." = yPos".$i.";
								$('#imagex1-".$i."').val(xPoss".$i.");
								$('#imagey1-".$i."').val(yPoss".$i.");
					}
				});
				";

			}
			echo "</script>";
			?>
<!--<input type="text" id="posX_val" name="posX_val" value="0">
            <input type="text" id="posY_val" name="posY_val" value="0">-->
<?php $this->load->view('chapteradmincp/layout/footer'); ?>