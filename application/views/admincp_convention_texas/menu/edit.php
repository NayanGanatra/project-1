<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>

<script type="text/javascript">

	//bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>

<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

    	<div class="dotted_line">

		        <h1>Menu <small>Edit Menu</small></h1>

		</div>

        

        	 <?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform');

                echo form_open_multipart('', $form_attributes);

            ?>



            <hr>
            
            

	
		<div class="control-group <?php if(form_error('menu_name')){ echo "error";}?>">

			<label class="control-label" for="inputError">Menu title</label>

				<div class="controls">

                    <input class="input-xlarge" type="text" id="covers_cat_name" name="menu_name" value="<?php echo $get_menu->menu_name; ?>" placeholder="Enter Menu Name">
</br>
                    <span class="help-inline"><?php echo form_error('menu_name'); ?></span>

                </div>

		</div>
        
        
       
            <div class="row">
        
        <div class="control-group <?php if(form_error('menu_type')){ echo "error";}?>" style="float:left;width:auto;">

            	<label class="control-label" for="inputError">Menu Type</label>

                <div class="controls">

                    <select name="menu_type" onchange="menu_type_val(this.value)" style="width:100px;">

						<option <?php if($get_menu->menu_type == '0') { ?> selected="selected" <?php } ?> value="0" id="">Internal</option>

                        <option <?php if($get_menu->menu_type == '1') { ?> selected="selected" <?php } ?> value="1" id="">External</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('menu_type'); ?></span>

                </div>

            </div>
            
            <div id="int_menu" class="control-group <?php if(form_error('menu_int_link')){ echo "error";}?>" <?php if($get_menu->menu_type == '0'){ ?> style="float:left;width:auto;margin-left:20px;" <?php }else {?> style="display:none;float:left;width:auto;margin-left:20px;" <?php } ?>>

            	<label class="control-label" for="inputError">Internal Menu</label>
				
                <div class="controls">

                    <select name="menu_int_link" onchange="int_menu_show()" style="float:left;width:auto;" id="all_int_menu">
                    
                    	<option <?php if($get_menu->menu_type == '0' && $get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/welcome') { ?> selected="selected" <?php } ?>  value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/welcome" class="sub_home" id="home">home</option>
                    	
                        <option <?php if($get_menu->menu_type == '0' && $get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/registration') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/registration" id="registration">registration</option>

                        <option <?php if($get_menu->menu_type == '0' && $get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/program') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/program" id="program">program</option>
                       
                        <option <?php if($get_menu->menu_type == '0' && $get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/medical') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/medical" id="medical">medical</option>

                        <option <?php if($get_menu->menu_type == '0' && $get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/event') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/eventmembership" id="event">event</option>

						
						
						<?php 
				$urlparts = explode("/", $get_menu->menu_link);
				array_pop($urlparts);
				$newurl = implode($urlparts, '/');
				
				?>
                		<option <?php if($get_menu->menu_type == '0' && $newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/sponsors" id="sponsors">sponsors</option>
                        
                        <option <?php if($get_menu->menu_type == '0' && $newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/pages" id="pages">pages</option>

                    </select>

                    <span class="help-inline"><?php echo form_error('menu_int_link'); ?></span>

                </div>

            </div>
            
            
            <div id="int_pages" class="control-group <?php if(form_error('int_page')){ echo "error";}?>" <?php if($get_menu->menu_type == '0' && $newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page') { ?> style="float:left;width:auto;margin-left:20px;" <?php } else { ?> style="float:left;width:auto;margin-left:20px;display:none;" <?php }?>>

            	<label class="control-label" for="inputError">Internal Page</label>

                <div class="controls">
                	<select name="int_page" style="width:auto;" id="">
					<?php $pages = $this->dbmenu->get_pages();
					foreach($pages as $allpages)
					{
					?>
                    
                    	
                        <option <?php if($get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id) { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id; ?>" id=""><?php echo $allpages->page_title; ?></option>

                       

                   
			  <?php } ?>
               		</select>
                    <span class="help-inline"><?php echo form_error('int_page'); ?></span>

                </div>

            </div>
            
            
            <div id="int_sponsors" class="control-group <?php if(form_error('int_sponsors')){ echo "error";}?>" <?php if($get_menu->menu_type == '0' && $newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors') { ?> style="float:left;width:auto;margin-left:20px;" <?php } else { ?> style="float:left;width:auto;margin-left:20px;display:none;" <?php }?> >

            	<label class="control-label" for="inputError">Internal sponsors</label>

                <div class="controls">
                	<select name="int_sponsors" style="width:auto" id="">
					
                       <option <?php if($get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/all') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/all'; ?>" id="">Sponsors</option>
                    	
                       <option <?php if($get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/corporate') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/corporate'; ?>" id="">Corporate Sponsors</option>

                       <option <?php if($get_menu->menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/individual') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/individual'; ?>" id="">Individual Sponsors</option>

                   
			 
               		</select>
                    <span class="help-inline"><?php echo form_error('int_sponsors'); ?></span>

                </div>

            </div>
            
            
            <div id="menu_link" class="control-group <?php if(form_error('menu_ext_link')){ echo "error";}?>" <?php if($get_menu->menu_type == '0'){ ?> style="display:none;float:left;margin-left:20px;"<?php } ?> >

			<label class="control-label" for="inputError">Menu Link</label>

				<div class="controls">

                    <input class="input-xxlarge" type="text" id="covers_cat_name" name="menu_ext_link" value="<?php if($get_menu->menu_type == '1') { echo $get_menu->menu_link; }?>" placeholder="Enter Menu Name">
</br>
                    <span class="help-inline"><?php echo form_error('menu_ext_link'); ?></span>

                </div>

			</div>
            
		</div>
        
        

            <?php $total_submenu = $this->dbmenu->total_submenu($get_menu->menu_id); 
			
			?>
			
			
			
            

		<div class="control-group <?php if(form_error('sub_menu_name[]') || form_error('sub_menu_order[]')){ echo "error";}?>" >

				<label class="control-label">Submenu</label>
                 <div style="width:100%;  float:left;">
                  
            <table width="100%"  border="1">
				<tr>
                	<!--<th style="background-color:#FAFCD9" width="5%">No</th>-->
                    <th style="background-color:#D6E3BB" width="30%">Name of Submenu</th>
                    
                    <th style="background-color:#D6E3BB" width="15%">Order of Submenu</th>
                    
                    <th style="background-color:#D6E3BB" width="15%">Submenu Type</th>
                    
                    <th style="background-color:#D6E3BB;" width="40%" id="submenu_link" >Submenu Link</th>
                   
                   
                  </tr>
             </table>
             
             </div>
                
       <?php 
	   		$total = count($total_submenu);
			
	   			if($total == 0)
				{
					$total = 1;
				}
				if(count($total_submenu)==0)
				{
					for($i=1;$i<=1;$i++) { ?>
             <div class="addremove" style="width:100%;float:left;height:25px">
             
             <a id="icon-minus-sign" title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:-35px;"></i>

				</a>
             
             <a id="" title="Add New Field" onclick="addNewField(this);">

				<i class="icon-edit" style="background-position:0 -96px;float:right;margin-right:-20px;"></i>

				</a>

				
                <table width="100%"   border="1" >
					<tr>
                  	
                    <label class="static" id="id[]" style="display:none;margin-bottom:0px !important" ><b>1</b></label>
                    
                    <td width="30%" style="background-color:#FFF;">
                    <input class="input-xlarge toclear" type="text" id="" name="sub_menu_name[]" placeholder="Enter Submenu title" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('sub_menu_name[]'); ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FFF;">
                 
                   <input class="toclear" type="text" id="" name="sub_menu_order[]" placeholder="Enter Submenu order" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('pm_age[]'); ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FFF;">
                 
                   <select class="submenuclass toclear" id="sub_menu_type-<?php echo $i;?>" name="sub_menu_type[]" onchange="show1(this.value,this.id);" style="width:99.5%;margin:0; padding:0;height:22px;">
                   
                   	 <option <?php if(set_value('sub_menu_type[]') == '0') { ?> selected="selected" <?php } ?> class="sub1" value="0" id="sub_internal-<?php echo $i;?>" onclick="show(this.id)">Internal</option>

					 <option <?php if(set_value('sub_menu_type[]') == '1') { ?> selected="selected" <?php } ?> class="sub2" value="1" id="sub_external-<?php echo $i;?>" onclick="show(this.id)">External</option>

                        

                    </select>
                    </td>
                    <td width="40%" style="background-color:#FFF;" class="sub_int_menu_td" id="sub_int_menu_link1-<?php echo $i?>">
                    
                    <select name="sub_menu_int_link[]" id="sub_menu_int_link-<?php echo $i;?>" class="submenuclass1" onchange="show(this.value,this.id);" style="width:40%;margin:0; padding:0;height:22px;">
                    
                    	<option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/welcome" class="sub_home" id="sub_home-<?php echo $i;?>">home</option>
                    
                    	<option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/registration" class="sub_registration" id="sub_registration-<?php echo $i;?>">registration</option>

                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/program" class="sub_program" id="sub_program-<?php echo $i;?>">program</option>
                        
                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/medical" class="sub_medical" id="sub_medical-<?php echo $i;?>">medical</option>

                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/eventmembership" class="sub_event" id="sub_event-<?php echo $i;?>">event</option>

						<option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/sponsors" class="sub_sponsors" id="sub_sponsors-<?php echo $i;?>">sponsors</option>

                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash')?>convention/pages" class="sub_pages" id="sub_pages-<?php echo $i;?>">pages</option>

                    </select>
                    
                    <select name="sub_int_pages[]" class="sub_int_pages" style="width:40%;margin:0; padding:0;height:22px;display:none;" id="sub_int_pages-<?php echo $i;?>">
					<?php $pages = $this->dbmenu->get_pages();
					foreach($pages as $allpages)
					{
						
					?>
                    
                    	
                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id; ?>" id=""><?php echo $allpages->page_title; ?></option>

              <?php } ?>
               		</select>
                    
                    
                    <select name="sub_int_sponsors[]" class="sub_int_sponsors" style="width:40%;margin:0; padding:0;height:22px;display:none;" id="sub_int_sponsors-<?php echo $i;?>">
						<option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/all'; ?>" id="">Sponsors</option>
                        
                    	<option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/corporate'; ?>" id="">Corporat Sponsors</option>
                    	
                        <option value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/individual'; ?>" id="">Individual Sponsors</option>

              
               		</select>
                    </td>
                    
                    <td width="40%" style="background-color:#FFF;display:none;" class="submenu_td" id="submenu_link1-<?php echo $i?>">
                 
                   <input class="sub_ext_link toclear" type="text" id="" name="sub_menu_ext_link[]" placeholder="Enter Submenu link" style=" width:99.5%; margin:0; padding:0;" value="<?php echo set_value('sub_menu_ext_link[]'); ?>">
                   
                    </td>
                   
                     </tr>   
                  </table>
           		</div>	
            <?php } 
				}
				else
				{
	  		for($i=1;$i<=$total;$i++) {
				
	   ?>
             
             <div class="addremove" style="width:100%;float:left;height:25px">
             
             <a title="Remove This Field" onclick="removeThisField(this);">

				<i class="icon-minus-sign" style="float:right;margin-right:-35px;"></i>

				</a>
             
             <a title="Add New Field" onclick="addNewField(this);">

				<i class="icon-edit" style="background-position:0 -96px;float:right;margin-right:-20px;"></i>

				</a>

           		<table width="100%" border="1" >
					<tr>
                  	
                    <label class="static" id="id[]" style="display:none;margin-bottom:0px !important" ><b>1</b></label>
                    
                    <td width="30%" style="background-color:#FFF;">
                    <input class="input-xlarge toclear" type="text" id="" name="sub_menu_name[]" placeholder="Enter Submenu title" style=" width:99.5%; margin:0; padding:0;" value="<?php echo $total_submenu[$i-1]->sub_menu_name; ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FFF;">
                 
                   <input class="toclear" type="text" id="" name="sub_menu_order[]" placeholder="Enter Submenu order" style=" width:99.5%; margin:0; padding:0;" value="<?php echo $total_submenu[$i-1]->sub_menu_order; ?>">
                    </td>
                    
                    <td  width="15%" style="background-color:#FFF;">
                 
                   <select class="submenuclass toclear" id="sub_menu_type-<?php echo $i;?>" name="sub_menu_type[]" onchange="show1(this.value,this.id);" style="width:99.5%;margin:0; padding:0;height:22px;">
                   
                   	 <option <?php if($total_submenu[$i-1]->sub_menu_type == '0'){?> selected="selected" <?php } ?> class="sub1" value="0" id="sub_internal-<?php echo $i;?>" onclick="show(this.id)">Internal</option>

					 <option <?php if($total_submenu[$i-1]->sub_menu_type == '1'){?> selected="selected" <?php }?> class="sub2" value="1" id="sub_external-<?php echo $i;?>" onclick="show(this.id)">External</option>

                        

                    </select>
                    </td>
                    <td width="40%" <?php if($total_submenu[$i-1]->sub_menu_type == '1'){?> style="display:none;background-color:#FFF;" <?php } ?> class="sub_int_menu_td" id="sub_int_menu_link1-<?php echo $i?>">
                    
                    <select name="sub_menu_int_link[]" id="sub_menu_int_link-<?php echo $i;?>" class="submenuclass1" onchange="show(this.value,this.id);" style="width:40%;margin:0; padding:0;height:22px;" id="">
                    	
                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/welcome') { ?> selected="selected" <?php } ?>  value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/welcome" class="sub_home" id="sub_home-<?php echo $i;?>">home</option>
                        
                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/registration') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/registration" class="sub_registration" id="sub_registration-<?php echo $i;?>">registration</option>

                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/program') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/program" class="sub_program" id="sub_program-<?php echo $i;?>">program</option>
                        
                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/medical') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/medical" class="sub_medical" id="sub_medical-<?php echo $i;?>">medical</option>

                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/eventmembership') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/eventmembership" class="sub_event"  id="sub_event-<?php echo $i;?>">event</option>

						
						<?php 
				$sub_urlparts = explode("/", $total_submenu[$i-1]->sub_menu_link);
				array_pop($sub_urlparts);
				$sub_newurl = implode($sub_urlparts, '/');
				?>
                		<option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $sub_newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/sponsors" class="sub_sponsors" id="sub_sponsors-<?php echo $i;?>">sponsors</option>
                        
                        
                        <option <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $sub_newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash');?>convention/pages" class="sub_pages" id="sub_pages-<?php echo $i;?>">pages</option>

                    </select>
                    
                   <select name="sub_int_pages[]" class="sub_int_pages" <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $sub_newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page') { ?> style="width:40%;margin:0; padding:0;height:22px;" <?php } else { ?> style="width:40%;margin:0; padding:0;height:22px;display:none;" <?php } ?> id="sub_int_pages-<?php echo $i; ?>" >
                   
					<?php $pages = $this->dbmenu->get_pages();
					foreach($pages as $allpages)
					{
					?>
                    
                    	
                        <option <?php if($total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id) { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/detail_page/'.$allpages->page_id; ?>" id=""><?php echo $allpages->page_title; ?> </option>

              <?php } ?>
              
					</select>
                    
                    
                    <select name="sub_int_sponsors[]" class="sub_int_sponsors" <?php if($total_submenu[$i-1]->sub_menu_type == '0' && $sub_newurl == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors') { ?> style="width:40%;margin:0; padding:0;height:22px;" <?php } else { ?> style="width:40%;margin:0; padding:0;height:22px;display:none;" <?php } ?> id="sub_int_sponsors-<?php echo $i;?>">
                    
						<option <?php if($total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/all') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/all'; ?>" id="">Sponsors</option>
                        
                    	<option <?php if($total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/corporate') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/corporate'; ?>" id="">Corporat Sponsors</option>
                    	
                        <option <?php if($total_submenu[$i-1]->sub_menu_link == base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/individual') { ?> selected="selected" <?php } ?> value="<?php echo base_url().$this->config->item('convention_texas_folder_with_slash').'convention/sponsors/individual'; ?>" id="">Individual Sponsors</option>

              
               		</select>
                    
                    </td>
                    
                    <td width="40%" <?php if($total_submenu[$i-1]->sub_menu_type == '0'){?> style="background-color:#FFF;display:none;" <?php } ?> class="submenu_td" id="submenu_link1-<?php echo $i?>">
                 
                   <input class="toclear" type="text" id="" name="sub_menu_ext_link[]" placeholder="Enter Submenu link" style=" width:99.5%; margin:0; padding:0;" value="<?php if($total_submenu[$i-1]->sub_menu_type == '1'){ echo $total_submenu[$i-1]->sub_menu_link; } ?>">
                    </td>
                   
                     </tr>   
                  </table>
           		</div>	
            <?php } }
			
			
			?>
             </br>  
                <span class="help-inline"> <?php echo form_error('sub_menu_name[]'); ?></span>
                 
             </div>	
       
       
       <div class="control-group <?php if(form_error('menu_order')){ echo "error";}?>">

            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>

                <div class="controls">

                    <input style="width:90px;" type="text" id="page_order" name="menu_order" value="<?php echo $get_menu->menu_order; ?>">

                    <span class="help-inline"><?php echo form_error('menu_order'); ?></span>

                </div>

            </div>

            

            <div class="control-group <?php if(form_error('menu_status')){ echo "error";}?>">

            	<label class="control-label" for="inputError">Status</label>

                <div class="controls">

                    <select name="menu_status" style="width:100px;">

					<?php if($get_menu->menu_status == '0')

                        {

                        ?>

                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        else

                        {

                        ?>

                        <option value="0"><?php echo $this->lang->line('misc_deactive');?></option>

                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_active');?></option>

                        <?php

                        }

                        ?>

                    </select>

                    <span class="help-inline"><?php echo form_error('menu_status'); ?></span>

                </div>

            </div>

	   
	   <?php date_default_timezone_set("Asia/Kolkata"); ?>    

		<input type="hidden" id="" name="menu_created_date" value="<?php echo $get_menu->menu_created_date; ?>">

        <input type="hidden" id="" name="menu_created_by" value="<?php echo $get_menu->menu_created_by; ?>">
        
        <input type="hidden" id="" name="menu_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">

        <input type="hidden" id="" name="menu_modified_by" value="<?php echo 'admin';?>">

          

		<input type="submit" value="<?php echo $this->lang->line('btn_submit'); ?>" class="btn" />



	</td>

  </tr>

</table>

<?php $this->load->view('admincp_convention_texas/layout/footer'); ?>

<!--pradip changes for ads 201307041133-->

<script type="text/javascript">

function removeThisField(item)

{

	if($(".addremove").length== '1')

	{

		alert("Minimum one field are required");

	}

	else

	{

		$(item).parent(".addremove").remove();	

	}

}

function addNewField(item)

{
$(item).parent(".addremove").after($(item).parent(".addremove").clone());
	//$(item).parent(".addremove").after('<a title="Add New Field" onclick="addNewField(this,'+(id+1)+');"><i class="icon-edit" style="background-position:0 -96px;float:right;margin-right:-20px;"></i></a>'.clone());
	
	var sub_menu_name = document.getElementsByName('sub_menu_name[]');
	var ln = sub_menu_name.length;
	
	//alert(ln);
//	$(item).parent(".addremove").next(".addremove").children(".toclear").val("");
    $(item).parent(".addremove").next(".addremove").find(".static").html('<b>'+ln+'</b>');
	$(item).parent(".addremove").next(".addremove").find(".sub1").attr('id','sub_internal-'+ln);
	
	$(item).parent(".addremove").next(".addremove").find(".sub2").attr('id','sub_external-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".submenuclass").attr('id','sub_menu_type-'+ln);
	//$(item).parent(".addremove").next(".addremove").find(".submenuclass").attr('name','sub_menu_type-'+ln);
	
	$(item).parent(".addremove").next(".addremove").find(".submenuclass1").attr('id','sub_menu_int_link-'+ln);
//	$(item).parent(".addremove").next(".addremove").find(".submenuclass1").attr('name','sub_menu_int_link-'+ln);
	
	$(item).parent(".addremove").next(".addremove").find(".submenu_td").attr('id','submenu_link1-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_int_menu_td").attr('id','sub_int_menu_link1-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_registration").attr('id','sub_registration-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_program").attr('id','sub_program-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_medical").attr('id','sub_medical-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_event").attr('id','sub_event-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_sponsors").attr('id','sub_sponsors-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_pages").attr('id','sub_pages-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_int_pages").attr('id','sub_int_pages-'+ln);
	$(item).parent(".addremove").next(".addremove").find(".sub_int_sponsors").attr('id','sub_int_sponsors-'+ln);
	///$(item).parent(".addremove").next(".addremove").find(".sub_int_pages").attr('name','sub_int_pages-'+ln);
	//$(item).parent(".addremove").next(".addremove").find(".sub_int_sponsors").attr('name','sub_int_sponsors-'+ln);
	//$(item).parent(".addremove").next(".addremove").find(".sub_ext_link").attr('name','sub_menu_ext_link-'+ln);
	//$(item).parent(".addremove").next(".addremove").find(".sub_menu_name").attr('name','sub_menu_name-'+ln);
	//$(item).parent(".addremove").next(".addremove").find(".sub_menu_order").attr('name','sub_menu_order-'+ln);
	document.getElementById('sub_internal-'+ln).selected=true;
	//alert(ln);
	//document.getElementById('submenu_link1-'+ln).display= "none";
	//document.getElementById('sub_int_menu_link1-'+ln).display= "block";
	$('#sub_int_pages-'+ln).hide();
	$('#sub_int_sponsors-'+ln).hide();
	$('#submenu_link1-'+ln).hide();
	$('#sub_int_menu_link1-'+ln).show();
	$(item).parent(".addremove").next(".addremove").find(".toclear").val("");
	
	//$(item).parent(".addremove").next(".addremove").find(".toclear").val("");
	
	//if(n[0] == 'sub_pages')
	//{
	
	//}
	
}	
function show1(sel_val,id)
{
	//alert(sel_val);
	//var id = $("#sub_menu_type option:selected").attr("id");
	var n=id.split("-"); 
	//alert(n[1]);
	if(sel_val == 1)
	{
		
	$('#sub_int_menu_link1-'+n[1]+'').hide();
	$('#submenu_link1-'+n[1]+'').show();
	}
	
	else if(sel_val ==0) 
	{
	$('#submenu_link1-'+n[1]+'').hide();
	$('#sub_int_menu_link1-'+n[1]+'').show();
	}
	
}

function show(sel_val,id)
{
	//alert(id);
	var n=id.split("-"); 
	var id = $("#sub_menu_int_link-"+n[1]+" option:selected").attr("id");
	var n=id.split("-"); 
	//alert(n[0]);
	//alert(n[1]);
	if(n[0] == 'sub_pages')
	{
	$('#sub_int_pages-'+n[1]+'').show();
	$('#sub_int_sponsors-'+n[1]+'').hide();
	}
	
	else if(n[0] == 'sub_sponsors')
	{
	$('#sub_int_sponsors-'+n[1]+'').show();
	$('#sub_int_pages-'+n[1]+'').hide();
	}
	else if(n[0] == 'sub_external')
	{
		
	$('#sub_int_menu_link1-'+n[1]+'').hide();
	$('#submenu_link1-'+n[1]+'').show();
	}
	
	else if(n[0] == 'sub_internal')
	{
	$('#submenu_link1-'+n[1]+'').hide();
	$('#sub_int_menu_link1-'+n[1]+'').show();
	}
	else
	{
		$('#sub_int_pages-'+n[1]+'').hide();
		$('#sub_int_sponsors-'+n[1]+'').hide();
	}
}

</script>
<script language="javascript">
function int_menu_show()
{
	
	var id = $("#all_int_menu option:selected").attr("id");
	//alert(id);
	if(id == 'pages')
	{
		$('#int_pages').show();
		$('#int_sponsors').hide();
	}
	else if(id == 'sponsors')
	{
		
		$('#int_sponsors').show();
		$('#int_pages').hide();
	}
	else
	{
		$('#int_pages').hide();
		$('#int_sponsors').hide();
	}
	//alert(sel_val);
	//alert(id);
}
	
   
		   
</script>
<script language="javascript">
function menu_type_val(id)
{
	if(id==0)
	{
		$('#int_menu').show();
		$('#menu_link').hide();
		$('#int_pages').hide();
	}
	else
	{
		$('#menu_link').show();
		$('#int_menu').hide();
		$('#int_pages').hide();	
	}
}
$(document).ready(function(){
	$('#int_pages').hide();
	$('#menu_link').hide();
	$('#int_menu').show();
});		   
</script>

<script language="javascript">

$(function(){



	$("#selectall").click(function () {

	$('.check').attr('checked', this.checked);

	});

	

	$(".check").click(function(){

	if($(".check").length == $(".check:checked").length) {

	$("#selectall").attr("checked", "checked");

	} else {

	$("#selectall").removeAttr("checked");

	}

	});

});

</script>
