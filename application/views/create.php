<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/jquery.bxSlider.min.js' type='text/javascript'></script>
<div class="container" style="margin-top:60px;">
	<div class="row">
<div class="span3" style="margin-left:0; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('sidebar'); ?>
    </div>
    
</div>
<div class="span11">
		<?php $header_ads = $this->dbheader->get_ads('728x90'); if($header_ads){ ?>
        <div class="banner728" align="center"><?php echo $header_ads->ads_code; ?></div>
        <div class="space10px"></div>
        <?php } ?>
    
            <div class="navbar">
                <div class="navbar-inner">
                   <h1><?php echo $this->lang->line('text_create_cover');?></h1>
                   <div class="addthis_nav">
                   	<span class='st_facebook_large' displayText='Facebook'></span>
                    <span class='st_twitter_large' displayText='Tweet'></span>
                    <span class='st_pinterest_large' displayText='Pinterest'></span>
                    <span class='st_sharethis_large' displayText='ShareThis'></span>
                   </div>
                </div>
            </div>
            
            
            <div class="well well-small">
            <div class="tab-pane fade in active" id="background_tab">
                <input id="imageLoader" type="file" style="display:none">
  				<span class="btn btn-primary" onclick="$('input[id=imageLoader]').click();"><i class="icon-picture icon-white"></i> <?php echo $this->lang->line('btn_add_image');?></span>
                
                <a class="btn btn-inverse" id="add-text" href="javascript:void(0);"><i class="icon-text-height icon-white"></i> <?php echo $this->lang->line('btn_add_text');?></a>
                
                <span class="input-prepend" style="margin-right:5px;">
                <span class="add-on"><i class="icon-text-height"></i></span>
                <input type="text" id="text-input" name="text-input" class="span3" disabled />
                </span>
                
                <span class="input-prepend">
                    <span class="add-on"><i class="icon-font"></i></span>
                    <span id='font-button'>
                        <select data-class='disabled btn-small wide-select' id='font' name='font' disabled>
                            <option value='Arial'>Arial</option>
                            <option value='Verdana'>Verdana</option>
                            <option value='Geneva'>Geneva</option>
                            <option value='Georgia'>Georgia</option>
                            <option value='Times New Roman'>Times New Roman</option>
                            <option value='Trebuchet MS'>Trebuchet MS</option>
                            <option value='Helvetica'>Helvetica</option>
                        </select>
                    </span>
                </span>
                
                
                <div class="btn-toolbar" align="center">
                    <div class="btn-group">
                        <a id="bgcolor" title="<?php echo $this->lang->line('btn_background_color');?>" class="btn" href="javascript:void(0);"><i class="icon24-bg-color"></i></a>
                        <a id="flip-horizontal" title="<?php echo $this->lang->line('btn_flip_horizontal');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-horizontal"></i></a>
                        <a id="flip-vertical" title="<?php echo $this->lang->line('btn_flip_vertical');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-vertical"></i></a>
                        <a id="back" title="<?php echo $this->lang->line('btn_send_to_back');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-send-back"></i></a>
                        <a id="front" title="<?php echo $this->lang->line('btn_bring_to_front');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-bring-front"></i></a>                            
                        <a id="text-color" title="<?php echo $this->lang->line('btn_text_color');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-text-color"></i></a>
                        <a id="underline" title="<?php echo $this->lang->line('btn_underline');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-underline"></i></a>
                        <a id="italic" title="<?php echo $this->lang->line('btn_italic');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-italic"></i></a>
                        <a id="shadow" title="<?php echo $this->lang->line('btn_shadow');?>" class="btn disabled" href="javascript:void(0);"><i class="icon24-shadow"></i></a>
                        
                        
                        <input id="grayscale" type="checkbox" style="display:none">
                        <a class="btn disabled" title="<?php echo $this->lang->line('btn_grayscale');?>" id="grayscale_btn" href="javascript:void(0);"><i class="icon24-grayscale"></i></a>
                        
                        <input id="invert" type="checkbox" style="display:none">
                        <a class="btn disabled" title="<?php echo $this->lang->line('btn_invert');?>" id="invert_btn" href="javascript:void(0);"><i class="icon24-invert"></i></a>
                        
                        <input id="sepia" type="checkbox" style="display:none">
                        <a class="btn disabled" title="<?php echo $this->lang->line('btn_sepia');?>" id="sepia_btn" href="javascript:void(0);"><i class="icon24-sepia"></i></a>
                        
                        <a class="btn disabled" title="<?php echo $this->lang->line('btn_remove_selected');?>" id="remove-selected" href="javascript:void(0);"><i class="icon24-remove"></i></a>
                        <a class="btn" title="<?php echo $this->lang->line('btn_clear_all');?>" id="removeall" href="javascript:void(0);"><i class="icon24-clear-all"></i></a>
                        
                    </div>
                </div>
              </div>
              </div>
            
            <div id="cover-editor">
              <div style=" height: 315px; position: relative; width: 851px;">
              <canvas id="covermaker-canvas" width="851" height="315" class="lower-canvas" style=" border:1px solid #ddd; width: 851px; height: 315px; left: 0px; top: 0px; -webkit-user-select: none; "></canvas>
              </div>
          </div>
<div class="space10px"></div>
<div style="display: block; height:115px;" class="control cf tabArea5">
			<script type="text/javascript">
				$(function(){
					 $('#controlSR_friend').bxSlider({pager: false,displaySlideQty:8});
					<?php
						$l = 1;
						foreach($assets_cat as $assets_cat_row)
						{
							?>
                            $('#controlSR_in<?php echo $l;?>').bxSlider({pager: false,displaySlideQty:2});
                            <?php
						$l++;
						}
					?>
				});

				
			</script>

			<div id="controlSL">
				<ul>
					<?php
						$i = 1;
						foreach($assets_cat as $assets_cat_row)
						{
							?>
                            <li id="template<?php echo $i; ?>"><a href="#" onclick="return false;"><?php echo $assets_cat_row->assets_cat_name; ?></a></li>
                            <?php
						$i++;
						}
					?>
				</ul>
			</div>

			<div id="controlSR">
				
                <?php
						$a = 1;
						foreach($assets_cat as $assets_cat_rowB)
						{
							?>
                            <span id="template<?php echo $a; ?>_carousel" style=" <?php if($a != 1){ echo 'display:none;'; }?> ">
                                <div class="bx-wrapper">
                                    <div class="bx-window">
                                        <div id="controlSR_in<?php echo $a; ?>" class="controlSR_in">
                                    	
                                        <?php
											$assets_by_cat = $this->dbcreate->assets_by_cat($assets_cat_rowB->assets_cat_id);
											$b = 0;
											
											foreach($assets_by_cat as $assets_by_cat_row)
											{
												if($assets_cat_rowB->is_bg == '1')
												{
												?>
                                                <img src="<?php echo base_url();?>covers-images/assets/thumbs/<?php echo $assets_by_cat_row->assets_image;?>" onclick="applyTemplate(this);" title="<?php echo $assets_by_cat_row->assets_name ;?>" width="292"/>
                                                <?php
												}
												else
												{
												?>
                                                <img src="<?php echo base_url();?>covers-images/assets/thumbs/<?php echo $assets_by_cat_row->assets_image;?>" onclick="addObject(this);" title="<?php echo $assets_by_cat_row->assets_name ;?>" width="292"/>
                                                <?php
												}
											$b++;
											}
											
										?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <?php
						$a++;
						}
				?>
                	
			</div>

		</div>

					<?php
					$user = $this->fb_connect->getUser();
			  		if($user){
					?>
                    <div class="space10px"></div>
                    <div class="fb_friends">
                                        <ul id="controlSR_friend" class="multiple">
                                    	
                                        <?php
											$friends =  $this->fb_connect->api('/me/friends');
											$f = 0;
											$total_friends = count($friends['data']);
											foreach($friends['data'] as $friend) {
												?>                                                
                            <li style="width:100px; margin-right:1px;"><img id="<?php echo $friend['id']; ?>" src="https://graph.facebook.com/<?php echo $friend['id'];?>/picture?width=200&height=200" title="<?php echo $friend['name'];?>" onclick="addFriend(this);" width="100" height="100"/></li>
                                                
                                                <?php
											$f++;
											}
										?>
                                        </ul>
					</div>
                   <?php }else{ ?>
                   <div class="space10px"></div>

                                        	Please Login for Facebook Friends Photos

                   <?php } ?>
                   
<div style="clear:both;">
<div class="space10px"></div>

<input id="save" class="btn btn-large btn-block btn-primary" style="width:100%;" type="button" value="<?php echo $this->lang->line('btn_upload_to_facebook');?>">



</div>

</div>
</div></div>
<script src='<?php echo base_url(); ?>js/faball.min.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/colorpicker.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/eye.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/custom.js' type='text/javascript'></script>

<?php
	if($this->uri->segment(2) == 'customize' && $this->uri->segment(3) != '')
	{
		$cover = $this->dbcreate->getcover($this->uri->segment(3));
?>
<script type="text/javascript">
$(document).ready(function() {
	canvas.setBackgroundImage('<?php echo base_url(); ?>covers-images/download/<?php echo $cover->covers_image; ?>', function() { 
		canvas.renderAll(); 
	});

});
</script>
<?php } ?>
<?php $this->load->view('footer'); ?>