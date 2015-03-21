<style>
 .facebook-l  li{
	 float:left !important;
	 width:auto !important;
	 padding:0px 0px 0px 2px  !important;
	 
 }
  .facebook-l{
	  width:100%;
	  float:left;
 }
 .generalsponsors
 {
 	width: 100%;
	background-color: #333333;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .grandsponsors
 {
 	width: 100%;
	background-color:#F89406;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .silversponsors
 {
 	width: 100%;
	background-color: #999999;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .goldsponsors
 {
 	width: 100%;
	background-color: #FFD700;
	color: #ffffff;
	/*padding-left:10px;*/
	font-size:22px;
	line-height:30px;
 }
 .table th, .table td
 {
 	line-height:5px;
 }
 </style>
 <div class="welcome-title-logo">
       <div class="logo-text2" style=" font-size:24px;">
            
            <img src="<?php echo base_url(); ?>images/spcs_convention/post-icon.png" alt="" align="absmiddle" />
          
            Our Sponsors
      	</div>
	    <div class="row-fluid">
        <div class="span8" style="width:100%">
        <div id="content_gallery">
    	<h3 class="grandsponsors">&nbsp;GRAND SPONSORS</h3>
		<?php
		$grandname = array();
		$grandlink = array();
		$granddonation = array();
		if($grandsponsors)
		{ 
			foreach($grandsponsors as $grandsponsors)
			{
				if($grandsponsors->cs_code!='')
				{
				?>
           <a 	target="_blank" href="<?php echo $grandsponsors->cs_link ?>"><img src="<?php echo base_url(); ?>images/convention/sponsors/<?php echo $grandsponsors->cs_code; ?>" alt="" /></a>
              	<?php
				}
				else
				{
					array_push($grandname,$grandsponsors->cs_title);
					array_push($grandlink,$grandsponsors->cs_link);	
					array_push($granddonation,$grandsponsors->cs_donation);
				}
			}
			if(count($grandname)>0)
			{ ?>
			<table border="0" style="margin: 10px 0px 0px 0px; width:100%; border:#000 1px solid;" class="table">
				<tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:center;">Organization</th>
			<th style="text-align:center; width:65px;">Website</th>
			<th style="text-align:center;">Donation</th>
			</tr>
			<?php 
			for($i=0;$i<count($grandname);$i++)
			{
			if($i%2==0)
			{
			?>
			<tr class="error">
			<td><?php echo $grandname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $grandlink[$i]; ?>">Link</a></td>
			<td><?php echo $granddonation[$i]; ?></td>
			</tr>	
			<?php 
			}
			else
			{ ?>
				<tr class="info">
			<td><?php echo $grandname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $grandlink[$i]; ?>">Link</a></td>
			<td><?php echo $granddonation[$i]; ?></td>
			</tr>	
			<?php }
			}
			?>
			</table>
			<?php }
			?>
			<?php
		} 
		else
		{
			?>
			<span>Sponsors not found in this category</span>
			<?php 
		}
		?>
		<h3 class="goldsponsors">&nbspGOLD SPONSORS</h3>	
		<?php 
		$goldname = array();
		$goldlink = array();
		$golddonation = array();
		if($goldsponsors)
		{
			foreach($goldsponsors as $goldsponsors)
			{
				if($goldsponsors->cs_code!='')
				{
				?>
         <a target="_blank" href="<?php echo $goldsponsors->cs_link ?>"><img src="<?php echo base_url(); ?>images/convention/sponsors/<?php echo $goldsponsors->cs_code; ?>" alt="" /></a>
              	<?php
				}
				else
				{
					array_push($goldname,$goldsponsors->cs_title);
					array_push($goldlink,$goldsponsors->cs_link);
					array_push($golddonation,$goldsponsors->cs_donation);	
				}
			}
			if(count($goldname)>0)
			{ ?>
			<table border="0" style="margin: 10px 0px 0px 0px; width:100%; border:#000 1px solid;" class="table">
				<tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:left;">Organization</th>
			<th style="text-align:left; width:65px;">Website</th>
			<th style="text-align:left;">Donation</th>
			</tr>
			<?php 
			for($i=0;$i<count($goldname);$i++)
			{
			if($i%2==0)
			{
			?>
			<tr class="error">
			<td><?php echo $goldname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $goldlink[$i]; ?>">Link</a></td>
			<td><?php echo $golddonation[$i]; ?></td>
			</tr>	
			<?php 
			}
			else
			{ ?>
			<tr class="info">
			<td><?php echo $goldname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $goldlink[$i]; ?>">Link</a></td>
			<td><?php echo $golddonation[$i]; ?></td>
			</tr>		
			<?php }
			}
			?>
			</table>
			<?php }
			?><?php
			}
			else
			{
				?>
				<span>Sponsors not found in this category</span>
				<?php 
			}
		?>
		<h3 class="silversponsors">&nbsp;SILVER SPONSORS</h3>
		<?php
		$silvername = array();
		$silverlink = array();
		$silverdonation = array();
		if($silversponsors)
		{ 
			foreach($silversponsors as $silversponsors)
			{
				if($silversponsors->cs_code!='')
				{
				?>
                <a target="_blank" href="<?php echo $silversponsors->cs_link ?>"><img src="<?php echo base_url(); ?>images/convention/sponsors/<?php echo $silversponsors->cs_code; ?>" alt="" /></a>
              	<?php
				}
				else
				{
					array_push($silvername,$silversponsors->cs_title);
					array_push($silverlink,$silversponsors->cs_link);	
					array_push($silverdonation,$silversponsors->cs_donation);
				} 
			}
			if(count($silvername)>0)
			{ ?>
			<table border="0" style="margin: 10px 0px 0px 0px; width:100%; border:#000 1px solid;" class="table">
				<tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:left;">Organization</th>
			<th style="text-align:left; width:65px;">Website</th>
			<th style="text-align:left;">Donation</th>
			</tr>
			<?php 
			for($i=0;$i<count($silvername);$i++)
			{
			if($i%2==0)
			{				
			?>
			<tr class="error">
			<td><?php echo $silvername[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $silverlink[$i]; ?>">Link</a></td>
			<td><?php echo $silverdonation[$i]; ?></td>
			</tr>	
			<?php 
			}
			else
			{ ?>
				<tr class="info">
			<td><?php echo $silvername[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $silverlink[$i]; ?>">Link</a></td>
			<td><?php echo $silverdonation[$i]; ?></td>
			</tr>
			<?php }
			}
			?>
			</table>
			<?php }
			?><?php
			}
			else
			{
				?>
				<span>Sponsors not found in this category</span>
				<?php 
			}
		?>
		<h3 class="generalsponsors">&nbsp;GENERAL SPONSORS</h3>
		<?php
		$generalname = array();
		$generallink = array();
		$generaldonation = array();
		if($generalsponsors)
		{ 
			foreach($generalsponsors as $generalsponsors)
			{
				if($generalsponsors->cs_code!='')
				{
				?>
          <a target="_blank" href="<?php echo $generalsponsors->cs_link ?>"><img src="<?php echo base_url(); ?>images/convention/sponsors/<?php echo $generalsponsors->cs_code; ?>" alt="" /></a>
              	<?php
				}
				else
				{
					array_push($generalname,$generalsponsors->cs_title);
					array_push($generallink,$generalsponsors->cs_link);
					array_push($generaldonation,$generalsponsors->cs_donation);
				}
			}
			if(count($generalname)>0)
			{ ?>
			<table border="0" style="margin: 10px 0px 0px 0px; width:100%; border:#000 1px solid;" class="table">
				<tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:left;">Organization</th>
			<th style="text-align:left; width:65px;">Website</th>
			<th style="text-align:left;">Donation</th>
			</tr>
			<?php 
			for($i=0;$i<count($generalname);$i++)
			{
			if($i%2==0)
			{
			?>
			<tr class="error">
			<td><?php echo $generalname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $generallink[$i]; ?>">Link</a></td>
			<td>$<?php echo $generaldonation[$i]; ?></td>
			</tr>	
			<?php 
			}
			else
			{
			?>
			<tr class="info">
			<td><?php echo $generalname[$i]; ?></td>
			<td><a target="_blank" href="<?php echo $generallink[$i]; ?>">Link</a></td>
			<td>$<?php echo $generaldonation[$i]; ?></td>
			</tr>
			<?php
			}
			}
			?>
			</table>
			<?php }
			?><?php
			}
			else
			{
				?>
				<span>Sponsors not found in this category</span>
				<?php 
			}
		?>
         </div>
    	 </div>
       </div>
</div>