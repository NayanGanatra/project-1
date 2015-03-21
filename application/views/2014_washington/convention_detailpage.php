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
 <script>
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
if(count($page_detail) != 0)
{
?>

<div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;"><img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
 Post</div>
       <div class="row-fluid">
           <div class="span8" style="width:100%">		
                        <h2 style="font-size:24px;"><?php echo $page_detail->page_title;?></h2>
             			<p class="TIME-COLOR"><?php echo $page_detail->page_created_date;?></p>
             			<p><?php echo $page_detail->page_content;?></p>
						
                       <?php $url_set=base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$page_detail->page_id."");?>
					   <ul class="facebook-l">
                          <li>
					<a href="javascript:void(0)" onclick=
					'fb_click(
					"<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$pages->page_id.""); ?>",
					"<?php echo $set;?>",
					"<?php echo $page_detail->page_title;?>",
					"<?php echo $page_detail->page_id;?>"
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
                          <li><span class='st_twitter_hcount' st_summary='<?php echo $str; ?>' st_title='<?php echo $page_detail->page_title;?>'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$page_detail->page_id.""); ?>' displayText='Tweet'></span></li>
                          <li><span class='st_linkedin_hcount' st_summary='<?php echo $str; ?>' st_title='<?php echo $page_detail->page_title;?>'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$page_detail->page_id.""); ?>' displayText='LinkedIn'></span></li>
                          <li><span st_summary='<?php echo $str; ?>' st_title='<?php echo $page_detail->page_title;?>' class='st_email_hcount'  st_url='<?php echo base_url($this->config->item('convention_folder_with_slash').'convention/detail_page/'.$page_detail->page_id.""); ?>' displayText='Email'></span></li>
                          </ul>
						  <div class="clear"></div>
						  </li> 
         
    	 </div>
       </div>
</div>
<?php 
} ?>