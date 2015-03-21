<?php $this->load->view('admincp_convention_texas/layout/header');
$item='';
 ?>
 <link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('html');});
</script>

<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <?php /*?><h1><?php echo $this->lang->line('text_newsletter');?> <small><?php echo $this->lang->line('btn_text_add_newsletter');?></small></h1><?php */?>
                 <h1>Newsletter <small>Add New</small></h1> <!-- add by mayank 19/06/2013/13:32  -->
		</div>
        <hr>
	
            <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

             <div class="control-group <?php if(form_error('subject')){ echo "error";}?>">
             <label class="control-label">Subject Title</label>
            	<?php /*?><label class="control-label" for="inputError"><?php echo $this->lang->line('text_subject');?></label><?php */?>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="subject" name="subject" value="<?php echo set_value('subject'); ?>">
                    <span class="help-inline"><?php echo form_error('subject'); ?></span>
                </div>
            </div>
			
			<div class="control-group <?php if(form_error('newsletter_template_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Select Template</label>
                <div class="controls">
                <select class="input-medium" name="newsletter_template_name" id="newsletter_template_name">
                <option value="0">Please Select</option>
                <?php
					$get_template = $this->dbadminheader->get_template();
					
					foreach($get_template as $get_template_row)
					{
						if($get_template_row->template_id!=15 && $get_template_row->template_id!=13)
						{
						?>
                        <option  value="<?php echo $get_template_row->template_id; ?>"><?php echo $get_template_row->template_title; ?></option>
                        <?php
						}
					}
				?>
                </select>
                <span class="help-inline"><?php echo form_error('newsletter_template_name'); ?></span>
                </div>
            </div>
            
			<div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:750px;min-height:150px;" name="html" id="html"><?php if($item) echo $item->html; ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div>
			 <!--  email -->
                <div style="position: absolute;    right: 288px;    top: 280px;    width: 97px;" id="email_preview" ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To See Email Preview.';?>"><center>Email Preview</center></a></div>
              
                <div class="row" style="display:none;" id="email_information" >
                      <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" 
                      href="javascript:void(0)">
    				<span id="fade_email" class="black_overlay"></span>
                    </a>
                  	<div class="white_content" id="quote_email" >
                        <a onclick="document.getElementById('quote_email').style.visibility='hidden';document.getElementById('fade_email').style.display='none'" href="javascript:void(0)" class="quote-close"><img width="24" height="22" alt="" style="margin:0px 0px 0 0; position:absolute; right:6px; top:4px " src="<?php echo base_url()?>images/close.png" /></a>
                        <div style="height:90%; margin-top:20px;">
                                <div class="used_email"  id="used_email" style=" height:100%; ">&nbsp;</div>
							
                        </div>
                	</div>
                </div>
                <!--  email -->
			  <div style="position: absolute;    right: 50px;    top: 80px;    width: 200px;">
                    <div  id="quick_add"   ><a href="javascript:void(0)" data-tip1="<?php  echo 'Press Here To Show List Of Tags Which Use In Email ';?>" ><center>Quick Add</center></a></div>
                    <div   id="quick_show" style="border:1px solid #E5E5E5; border-radius:6px; padding:10px;  display:none;" >
                        <b>UserName:</b>{username}<br />
                        <b>Code:</b>{code}<br />
                        <b>FullName:</b>{fullname}<br />
                        <b>Email:</b>{email}<br />
                        <b>Sitename:</b>{sitename}<br />
 <b>User Info:</b>{userinfo}<br />
                    </div>
                </div>
            <?php /*?><div class="control-group <?php if(form_error('html')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_message');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;" name="html" id="html"><?php echo set_value('html'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('html'); ?></span>
                </div>
            </div><?php */?>
            
            
             <div class="space10px"></div>   
             <div class="row">
            <div class="span11">
            <label class="control-label">Select Chapter</label>
            <table><tr>
            <?php
				$chapter = $this->dbadminheader->get_chapters();
				$i = 0;
				foreach($chapter as $chapter_row)
				{
					if($i%6==0)
					{
						?>
                        </tr><tr>
                        <?php
					}
					?>
                    <td>
						<span class="span3">
                            <label class="checkbox">
                                <input type="checkbox"  name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
                            </label>
                        </span>
                    </td>
                    <?php
				$i++;
				}
			?>
           </tr></table>
          
            </div>
            </div>
            
            <div class="space10px"></div>
            <div class="control-group <?php if(form_error('newsletter_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                <select name="newsletter_status" class="input-medium">
                <option <?php if(set_value('newsletter_status') == '1'){ echo 'selected="selected"'; } ?> value="1"><?php echo $this->lang->line('misc_active'); ?></option>
                <option <?php if(set_value('newsletter_status') == '0'){ echo 'selected="selected"'; } ?> value="0"><?php echo $this->lang->line('misc_deactive'); ?></option>
                </select>
                    <span class="help-inline"><?php echo form_error('newsletter_status'); ?></span>
                </div>
            </div>
            
            <div class="space10px"></div> 
            <div class="control-group <?php if(form_error('queued')){ echo "error";}?>">
            <label class="control-label">Queued Newsletter</label>
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('page_status');?></label>
                <div class="controls"  style="width:150px; height:26px"class="controls" data-tip1="<?php  echo 'First Option Only Save Data';?>"  >
                    <select name="queued" style="width:150px;">
						<option <?php if(set_value('queued') == 0) { echo 'selected="selected"'; } ?> value="0">Save and Close</option>
                        <?php /*?><option <?php if(set_value('queued') == 1) { echo 'selected="selected"'; } ?> value="1">Save and Send</option><?php */?>
                    </select>
                    <span class="help-inline"><?php echo form_error('queued'); ?></span>
                </div>
            </div>
            <div class="space20px"></div>  
            <?php date_default_timezone_set("Asia/Kolkata"); ?>    
        <input type="hidden" id="" name="newsletter_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" id="" name="newsletter_created_by" value="<?php echo 'admin';?>">
           <input onclick="document.getElementById('custom_box').style.display='block'" type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
        </form>

</td></tr></table>
<script>
$('#newsletter_template_name').change(function() {
	$.ajax({
	  url: BASE_URI+'admincp_convention_texas/user/get_template_chapter/'+$('#newsletter_template_name').val(),
	  success: function(data) {
		$('.nicEdit-main').html(data);
		$('#html').html(data);
		}
	});
});
$('#email_preview').click(function() {
	//alert($('.nicEdit-main').html());
	//$('.nicEdit-main').html(data);
	$('div#custom_box').addClass("custom_box_css");

	$.ajax({
		   type: "POST",
		   url: BASE_URI+"admincp_convention_texas/user/email_info/",
		   //$('#html').html(data);
		   data :'emailData='+encodeURIComponent($('.nicEdit-main').html())+'&subject='+$('#subject').val(),
		   //data :'username='+username+'&id='+0+'&ch_id='+ n+'&offset='+0+'&fetch_user_data='+fetch_user_data+'&check_uncheck_all_user_status='+$('#check_uncheck_all_user_status').val(),
		  success: function(data) {
			  	document.getElementById('email_information').style.display="block";
				$('#used_email').html(data);
				
				document.getElementById('quote_email').style. zIndex='1031';
				document.getElementById('quote_email').style.visibility='visible';
				document.getElementById('fade_email').style.display='block';
				(function(jQuery){
						jQuery(document).ready(function() {
							/* custom scrollbar fn call */
							jQuery(".used_email").mCustomScrollbar({
								scrollButtons:{
									enable:true
								},advanced:{  
							updateOnContentResize:true,   
							updateOnBrowserResize:true   
						
						  } 
							});	
							
						});
					})(jQuery);

$('div#custom_box').removeClass("custom_box_css");
			}
		});
});
$('#quick_add').click(function() {
$('#quick_show').toggle();
});
</script>
<div id="custom_box" style="display:none">

					<div id="overlay">

						<div id="box_frame">

							<div id="box">

							<img src="<?php echo base_url(); ?>images/ajax-loader.gif" />

								<!--<div id="box_upper">

								</div>-->

							</div>

						</div>

					</div>

				</div>  
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>
<script src="<?php echo base_url(); ?>/js/jquery.mCustomScrollbar.js"></script>
<link href="<?php echo base_url(); ?>css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">