<style type="text/css">

.searchbox{
	margin-top: 8px;
	width: 83%;
	padding: 12px;
	font-size: 18px;
	}
.searchbtn{
	margin-top: -3px;
	background: #333;
	color: #fff;
	text-shadow: none;
	padding: 6px 16px;
	font-size: 18px;

		}
</style>
 

<div   style="width: 100%;
background: #eee;
margin-left: -10px;
padding: 5px 15px 0;">
	<h4 style="font-size:15px;margin-bottom:0; margin-top:5px;">If you are existing life member, enter your email address to find the information.
</h4>

		    <form style="margin:0;" action="<?php echo base_url($this->config->item('convention_texas_folder_with_slash').'convention/search') ?>" method="post">
           		 
				
            <input class="searchbox" style="margin-top: 6px;
width: 83%;
padding:6px 12px;
font-size: 16px;" type="text" id=""   name="search_email" placeholder="Search by Email or Phone Number or Life Member Number" value="">
			
            <input class="btn searchbtn" type="submit"   id="" value="search">
        
          </form>    

</div>

