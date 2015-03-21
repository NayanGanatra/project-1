<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src='<?php echo base_url(); ?>js/verticaltabs/jquery-1.9.1.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>js/verticaltabs/jquery-ui.js' type='text/javascript'></script>
<link href="<?php echo base_url(); ?>css/tab_css/jquery-ui.css" rel="stylesheet" type="text/css">
<style>
#content_tab
{
	display:none;
}
</style>
</head>
<body>
 <div class="space20px"></div>  
<div id="content_tab">
<span class="front_style">National Level Vendors</span><br /><br />
<div id="tabs-c" >
    <ul>
    <?php    
	  $i=1;
	  $count=count($category);
      foreach($category as $category_row)
     {  	
     ?>
        <li class="ram"><a href="#tabs-c<?php echo $i;?>"><?php echo $category_row->category_name;?></a></li>
    <?php $i++;}?>
    </ul>
     <?php    
	  $j=1;
      foreach($category as $category_row)
     {
        $vendor= $this->dbvendor->get_venders($category_row->category_id);		
     ?>
    <div  id="tabs-c<?php echo $j;?>">
        <p>
            <div class="ui-tabs-vertical-ram1" id="tabsc<?php echo $j;?>">
                 <p>
				       <table cellpadding="0px;" cellspacing="0px;">           
					          <?php
								      $i=1;
			                          $con =  count($vendor);
									  
                                     foreach($vendor as $ven_row)
                                    {
									 
								?>
                               <tr>   
                                    <td>
                                           <?php  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ven_row->vendor_name;?>
                                   </td>
                               </tr>
								<?php	  
								    }
								  ?>
                         </table>
                 </p> 
            </div>        
        </p>
    </div>
    <?php $j++; }//end of category ?>
</div>	

<br /><br /><span class="front_style">Chapter Level Vendors</span><br /><br />
<div id="tabs-b" class="btab- margin">
    <ul>
    <?Php 
	 $a=1;
	  $count1=count($allcategory);
        foreach($allcategory as $cat_row1)
       {
		  // 
	  ?>
        <li class="ram"><a href="#tabs-b<?php echo $a;?>"><?php echo $cat_row1->category_name;?></a></li>
 <?php $a++; } ?>
    </ul>
     <?php  
	   $p=1;
       foreach($allcategory as $cat_row1)
     {
         $chap = $this->dbvendor->get_all_chapters($cat_row1->category_id);	
     ?>
     <div id="tabs-b<?php echo $p;?>">
        <p>
          <!-- <b>Chapters:</b>-->
            <div id="tabsb<?php echo $p;?>" class="tab-margin ui-tabs-vertical-ram2">
                <ul class="ui-widget-header-ram">
                   <?php
				    $s=1;
                       foreach($chap as $chap_row)
                      {	
					 // $ven = $this->dbvendor->get_all_venders($chapter_row1->ch_id,$cat_row->category_id);
                  ?>
                    <li><a href="#tabs-b<?php echo $p.$s;?>"><?php echo $chap_row->ch_name; ?></a></li>
                <?php $s++; }// end of category?>
                </ul>
                 <?php
				    $q=1;
                       foreach($chap as $chap_row)
                      {	
					  $ven = $this->dbvendor->get_all_venders($chap_row->ch_id,$cat_row1->category_id);
                  ?>
                <div id="tabs-b<?php echo $p.$q;?>">
                    <p> 
                         <table cellpadding="0px;" cellspacing="0px;">           
					          <?php
								      $i=1;
			                          $con =  count($ven);
									  
                                     foreach($ven as $ven_row)
                                    {
									 
								?>
                               <tr>   
                                    <td>
                                           <?php  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ven_row->vendor_name;?>
                                   </td>
                               </tr>
								<?php	  
								    }
								  ?>
                         </table>
                     </p>
                </div>
                 <?php  $q++; }// end of category?>
            </div>            
        </p>
    </div>
    <?php 
	   $p++; } // end of chapters?>
</div>
</div>
</body>
</html>
<script type="text/javascript">
jQuery.noConflict();
var i =0;
var j = <?php echo $count;?>;
var a=0;
var s= <?php echo $count1;?>;
jQuery(function() {
for(i = 1; i<= j ;i++)
{
jQuery('#tabs-c').tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
//jQuery('#tabs'+i).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" ).addClass("ui-corner-left");
}
for(a = 1; a<= s ;a++)
{
jQuery('#tabs-b'+a).tabs().addClass( "ui-tabs-horizontal ui-helper-clearfix" ).addClass('ui-corner-top');
jQuery('#tabs-b').tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
}
});

 $(window).load(function(){
 $("#content_tab").css({ display: "block" });
});
// Code that uses other library's $ can follow here.
</script>