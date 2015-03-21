<?php $this->load->view('admincp/layout/header'); ?>
<script language="javascript" type="text/javascript">
function getimagefield()
{
	document.getElementById('image').style.display = "block";
}
</script>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_covers');?> <small><?php echo $this->lang->line('text_upload_covers');?></small></h1>
		</div>
        <hr />
        	 <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform', 'name' => 'photos');
                echo form_open('', $form_attributes);
            ?>

            <div class="space10px"></div>
            
           <div id="cat">
        	<div class="alert alert-info"><?php echo $this->lang->line('text_help_uploads');?></div>
            	<select name="covers_cat_id" id="covers_cat_id" onChange="javascript: getimagefield();">
                	<option value=""><?php echo $this->lang->line('misc_select_category');?></option>
                    <?php
					$cat = $this->dbcovers->get_categories();
					foreach($cat as $row_cat)
					{
						if(isset($_POST['covers_cat_id']) && $_POST['covers_cat_id'] == $row_cat->covers_cat_id)
						{
							?>
                            <option value="<?php echo $row_cat->covers_cat_id; ?>" selected="selected"><?php echo $row_cat->covers_cat_name; ?></option>
							<?php
						}
						else
						{
							?>
                            <option value="<?php echo $row_cat->covers_cat_id; ?>"><?php echo $row_cat->covers_cat_name; ?></option>
							<?php
						}
					}
					?>
                </select>
                
                
<link href="<?php echo base_url(); ?>css/fileuploader.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url();?>js/fileuploader.js" type="text/javascript"></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js' type='text/javascript'></script>

<div id='file-uploader'>
<noscript>
<p>
<?php echo $this->lang->line('misc_javascript_enable');?>
</p>
</noscript>
</div>

    <script>
	
	function redirect(a){window.location=a}
	
	$('#covers_cat_id').change(function() {
		var uploader = new qq.FileUploader({
			element: document.getElementById('file-uploader'),
			params: {
            param1: document.getElementById('covers_cat_id').value
       		 },
			action: '<?php echo base_url();?>admincp/covers/upload_cover/'+document.getElementById('covers_cat_id').value,

			onComplete: function(id, fileName, responseJSON){
			  if (responseJSON) 
			  {
				$('.qq-upload-failed-text').html('<?php echo $this->lang->line('misc_success_upload');?>');
			  }
			  else
			  {
				$('.qq-upload-failed-text').first().update('<?php echo $this->lang->line('misc_fail_upload');?>');
			  }
        	}
		
		});
//		alert(document.getElementById('covers_cat_id').value);
window.onload = createUploader;
	});
	</script>
              
        </div>
        
<div style="height:250px; display:block;"></div>
	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>