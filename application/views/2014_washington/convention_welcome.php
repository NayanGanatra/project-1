<style>
 .facebook-l  li{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important; border:none !important; background:none !important;
	 
 }
 
 .facebook-l  li:hover{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important; border:none !important; background:none !important;
	 
 }
 
  .facebook-l{
	  width:100%;
	  float:left;
 }
 ul.discover-item {
   margin:0px;
    min-height: 51px;
    list-style:none;
	
	}
	
ul.discover-item li{
    background: none repeat scroll 0 0 padding-box #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.1);
   /* border-bottom: 1px solid rgba(0, 0, 0, 0.1);*/
	 padding: 9px 12px;
	 margin:0 0 8px 0;
}
ul.discover-item li:hover{ padding: 9px 12px;
    background:#f5f5f5; transition: background-position 0.3s ease-in-out 0s;

}


.content_gallery_item{width:100%; float:left;}
.content_gallery_item h2{width:70%; float:left; font-size:24px; line-height:15px;}
.content_gallery_item .TIME-COLOR{width:30%; float:right; color:#990000;line-height:26px; text-align:right;}
 </style>
 <!--------------------- update-monita-20130913 -------------------> 
 <script type="text/javascript">

		jQuery(document).ready(function() {
		jQuery(window).scroll(function(){

		if (jQuery(window).scrollTop() == jQuery(document).height() - jQuery(window).height()){

		jQuery('#hdnstart').val(parseInt(jQuery('#hdnstart').val())+3);

		jQuery('#hdnend').val(parseInt(jQuery('#hdnend').val())+3);

		jQuery("#LoadingImage").show();

		$.ajax({

	   type: "POST", 

	   data: "limit="+jQuery('#hdnstart').val()+"&offset="+jQuery('#hdnend').val(),

	   url:'<?php echo base_url().$this->config->item("convention_folder");?>convention/convention_welcomepage',

		success: function(data) {
				
      //alert(data);
	if(data=='' || data==null || data==0)

	{

		jQuery("#LoadingImage").hide();

		jQuery('#nomore').css("display","block");

	}

	else

		{
		        
				
				jQuery("#LoadingImage").hide();
		
				jQuery('#content_gallery').append(data);
				
		
				jQuery(".hideall").hide();	
				stButtons.locateElements();
				
				
				
		
		}

	

		}

		});

		}

	});

});

function fb_click(url,desc,title,id){
var image='http://testsite.spcsusa.org/images/spcs_convention/convention-logo.png';
	 var id=window.open('https://www.facebook.com/dialog/feed?app_id=721442517869860&link='+url+'&picture=http://www.dealbind.com/site/media/images/dealimages/deal1440976.jpg&name=Stick+n+Click&caption=Check Out What I Found On DealBind.com&description=www.DealBind.com&message=www.DealBind.com&redirect_uri='+url,
	  
	  'feed',	 
      'width=626,height=436'
	  ); 
	  
	  
	  return false;
}
</script>
<?php 
if(count($pages) != 0)
{
?>
<div class="welcome-title-logo">
       
<?php
if ($this->session->flashdata('message_type') == "success")
{ ?>
<div class="alert alert-success" style="float:right; padding:1px 35px 1px 14px; width:93%; margin-bottom:1px; " ><?php echo $this->session->flashdata('status_');?></div>
<?php
} 
if ($this->session->flashdata('message_type') == "error")
{ 
?>
<div class="alert alert-error"><?php echo $this->session->flashdata('status_');?></div>
<?php
} 
?><br />
<div class="logo-text2" style=" font-size:24px; margin-bottom:10px"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Post</div>
 
       <div class="row-fluid">
           <div class="span8" style="width:100%">
        <!--  <h3 class="nomargin">Latest Post <span class="offset6 small" style="float: right;"><a href="<?php //echo base_url('/convention/pages'.'.html'); ?>">more</a></span></h3>--> <!--------------------- update-monita-20130913 -------------------> 
           <div id="content_gallery">
		   <ul class="discover-item">
		   
    	<?php
			foreach($pages as $pages)
			{
				?>
				
				<li>
                	<span class="content_gallery_item">	
                        <h2><a href="<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>"><?php echo $pages->page_title;?></a></h2>
             			<p class="TIME-COLOR"><?php echo $pages->page_created_date;?></p></span>
             			<p><?php $string= $pages->page_content;
						echo $str = word_limiter($string,50);
						$set=preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', strip_tags($str));
						$url_set=base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id."");
						?></p>
                         <p class="small"><a href="<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id."");?>">Read More</a>
                        </p>
       				<ul class="facebook-l">
					
		 
		 
						<li>
					<a href="javascript:void(0)" onclick=
					'fb_click(
					"<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>",
					"<?php echo $set;?>",
					"<?php echo $pages->page_title;?>",
					"<?php echo $pages->page_id;?>"
					)'>
    					<img src='http://w.sharethis.com/images/facebook_counter.png'/>
						<?php
						$ch = curl_init();
 
    // Now set some options (most are optional)
 $url='http://api.facebook.com/restserver.php?method=links.getStats&urls='.$url_set.'&format=json';
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $url);
 
    // Set a referer
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
	$header[] =  'Content-Type: application/json';
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false );
	//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
    //curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
 	//curl_setopt($ch, CURLOPT_PROXY, "192.168.0.101:808");
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
 
    // Download the given URL, and return output
    $string = curl_exec($ch);
	//var_dump($string);
 	$json = json_decode($string, true);
	//var_dump($json);
	//foreach($json->responseData->results as $result) // Loop through the objects in the result
	//var_dump($result);

echo $json[0]['share_count'];
	
    curl_close($ch);
?>
						
						
					</a>
						 
						</li>
					
                          <li><span class='st_twitter_hcount' st_summary='<?php echo $str; ?>' st_title='<?php echo $pages->page_title;?>'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>' displayText='Tweet'></span></li>
                          <li><span class='st_linkedin_hcount' st_summary='<?php echo $str; ?>' st_title='<?php echo $pages->page_title;?>'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>' displayText='LinkedIn'></span></li>
                          
						  <li><span st_summary='<?php echo $str; ?>' st_title='<?php echo $pages->page_title;?>' class='st_email_hcount'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>' displayText='Email'></span></li>
       </ul>
	   <div class="clear"></div>
	   			</li>
		
		
		
	
		 
          
          
              	<?php
			}
		?>
			</ul>
         </div>
    	 </div>
       </div>
</div>
<?php 
} ?>
 <!--------------------- update-monita-20130913 -------------------> 
<input type="hidden" id="hdnend" value="0"/>

<input type="hidden" id="hdnstart" value="3"/>

		<div id="LoadingImage" style="display:none; margin:10px 0 0 0px; text-align:center;float:left;  width:100%"><img src="<?php echo base_url(); //echo get_template_directory_uri(); ?>images/ajax-loader.gif" alt="" style="height:20px;"/> </div>

		<div id="nomore" style="display:none; margin:10px 0 0 0px;"><b><i>No more Posts</i></b></div>
         <!--------------------- update-monita-20130913 -------------------> 