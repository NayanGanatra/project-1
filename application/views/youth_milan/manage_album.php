<?php $this->load->view('youth_milan/layout/header'); ?>

<div class="photogallery">
	
      	<div class="logo-text2"><img align="absmiddle" alt="" src="<?php echo base_url();?>images/youth_milan/register-icon.png">Manage Album </div>
		<div id="photo_alubum" style="margin-left:5px" >
			<?php
						$i=0;
				
							foreach($photos as $photo)
							{
								
								if($photo->ym_photo!="")
								{
									
									
								
							?>
								
						<!-----------------------update_monita-------------------->		
											<div id="photo" style="float:left; position:respective; margin-left:20px; height:205px;">
											<div id="only_image" style=" border:1px solid #ddd; padding:5px; border-radius:7px; max-height:170px; max-width:160px;">
											<div id="inner_only_image" style="vertical-align:middle;">
					                 		<a title="<?php echo $photo->ym_photo; ?>" href="<?php echo base_url(); ?>images/youth_milan/profile/big/<?php echo $photo->ym_photo; ?>" rel="lightbox[]">
												<img onload="delete_link_css(this.id)"  id="image_<?php echo $i; ?>"  src="<?php echo base_url(); ?>images/youth_milan/profile/thumbs/<?php echo $photo->ym_photo; ?>"  /></a>
											</div>
											</div>
											<br>	
											<div id="delete_link_<?php echo $i;?>" style="height:20px;width:20px;margin:-18px 0 10px; display:none;">
											<a title="Delete" href="<?php echo base_url();?>youth_milan/registration/delete_img/<?php echo $photo->ym_album_id; ?>" onclick="javascript: return del();"><img  src="<?php echo base_url(); ?>images/youth_milan/delete.png" height="18" width="18"/> 
											</a>
											
											</div>
										</div>
								<!-----------------------update_monita-------------------->	
								
							<?php
								$i++;
							}
								
							}
						?>
						
							
			</div>
					
		
</div>
<?php $this->load->view('youth_milan/layout/footer'); ?>

<script>
function delete_link_css(id)
{
	var image=document.getElementById(id);
	
	var width1=image.width;
	
	var id1=id.split("_");
	
	$("#delete_link_"+id1[1]).css('margin-left',width1-10);
	$("#delete_link_"+id1[1]).css('display','block');
	

}
</script>