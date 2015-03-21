<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="min_height">

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>



        <div class="dotted_line">

        	<span class="span8">

		        <h1><?php echo $this->lang->line('text_users');?> <small><?php echo $tot_rec; //$this->dbuser->count_user();?></small></h1>

            </span>

            <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'get');

                echo form_open('', $form_attributes);

				?>

				<div class="control-group <?php if(form_error('keywords')){ echo "error";}?>">

					<div class="controls">

						<span class="span4">

                        <select name="mm_type" class="input-large" style="margin:0;">

                        <option value="0" <?php if($this->input->get('mm_type') == 0){ echo 'selected="selected"'; } ?> >All Members</option>

                        <option value="1" <?php if($this->input->get('mm_type') == 1){ echo 'selected="selected"'; } ?>>Verified members</option>

                        <option value="2" <?php if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Un-verified members</option>

                        </select>

                        </span>

                        <span class="span4">

                        <input style="margin-top:10px;" class="input-large" type="text" id="search" name="search" placeholder="Search by name, username or email" value="<?php echo set_value('covers_cat_name'); ?>">

                        </span>

                        <span class="span2" style="width:68px;">

                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>

                        </span>

					</div>
                     <div >
                    		<li class="dropdown" style=" clear:both;float:right;width:150px;list-style:none">

                        <a href="#" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" data-toggle="dropdown">Export to excel </a>

                        <ul class="dropdown-menu" style="" >

                          <li ><a style="text-align:left;" href="<?php echo base_url('chapteradmincp/user/user_export_to_excel/1');?>" onclick="">All Members</a></li>

                          <li><a style="text-align:left;" href="<?php echo base_url('chapteradmincp/user/user_export_to_excel/2');?>" onclick="">verified Members</a></li>
                          
                          <li><a style="text-align:left;" href="<?php echo base_url('chapteradmincp/user/user_export_to_excel/3');?>" onclick="">Un-verified Members</a></li>
                      
                        </ul>

                      </li>
                    </div>

				</div>

                

            </span>

		</div>

        <hr>

<?php /*?><table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	<th scope="col">Username</th>

            <th scope="col"><?php echo $this->lang->line('text_name');?></th>

            <th scope="col">Chapter</th>

            <th scope="col"><?php echo $this->lang->line('text_phone');?></th>

            <th scope="col"><?php echo $this->lang->line('text_email');?></th>

            <th scope="col"><?php echo $this->lang->line('text_type');?></th>

            <th scope="col"><?php echo $this->lang->line('text_status');?></th>

            <th scope="col"><?php echo $this->lang->line('text_action');?></th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="7"></td>

        </tr>

    </tfoot>

    <?php

		if ($query)

		{

		  

		   foreach ($query as $row)

		   {

			   

			   $get_chapter = $this->dbadminheader->get_chapter($row->mm_chapter_id);

			   

			   $user_ch = $this->dbuser->get_ch_from_state($row->mm_state_id);

			   

			   if($user_ch)

			   {

			   	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   }

	?>

    <tr>

    	<td><?php echo $row->mm_username; ?></td>

        <td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>

        <td><?php if(isset($get_user_chapter)){echo $get_user_chapter->ch_name;} ?></td>

        <td><?php echo $row->mm_hphone; ?></td>

        <td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>

        <td><?php if($row->mm_type == '0'){echo 'Member';}else{ 

			

			echo 'C.A. of '.$get_chapter->ch_name;} ?>

        </td>

        <td>

        <?php if($row->mm_varify=="1")

		{?>

        <a href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">

      

        <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />

        </a>

        <?php }

		else

		{?> 

        <a  href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">

      

        <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>

          

        </a>

        <?php }?>

        </td>

        

        <td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$row->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a> 

        <a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$row->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>

        

        

    </tr>

    

		<?php

   }

}

else

{

	echo "<tr><td colspan='6'>No result found!!!</td></tr>";

}

?>

</table><?php */?>


 <table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>
        
			<th scope="col">Username</th>
            
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            
           <!-- <th scope="col">Chapter</th>-->

            <th scope="col"><?php echo $this->lang->line('text_phone');?></th>

            <th scope="col"><?php echo $this->lang->line('text_email');?></th>
            
             <th scope="col"><?php echo $this->lang->line('text_type');?></th>

            <th scope="col"><?php echo $this->lang->line('text_status');?></th>

            <th scope="col"><?php echo $this->lang->line('text_action');?></th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="7"></td>

        </tr>

    </tfoot>

    <?php

		if ($query)

		{

		  

		   foreach ($query as $row)

		   {
			
			
				$get_chapter = $this->dbadminheader->get_chapter($row->mm_chapter_id);

			   

			   $user_ch = $this->dbuser->get_ch_from_state($row->mm_state_id);

			   

			   if($user_ch)

			   {

			   	$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);

			   }
			   
			   //$chk_sub_member = $this->dbadminheader->chk_sub_member($row->mm_id);
			   
			   if($row->mm_family_id == 0)
			   {
			   
					$chk_sub_member = $this->dbadminheader->chk_sub_member($row->mm_id);
					   
	?>
		
					<tr <?php if($chk_sub_member){ echo 'class="error"'; }?> >
			
                        <td><?php echo $row->mm_username; ?></td>
                
                        <td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>
                        
                        <?php /*?><td><?php if(isset($get_user_chapter)){echo $get_user_chapter->ch_name;} ?></td><?php */?>
                
                        <td><?php echo $row->mm_hphone; ?></td>
                
                        <td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>
                        
                        <td><?php if($row->mm_type == '0'){echo 'Member';}else{ 
                
                            echo 'C.A. of '.$get_chapter->ch_name;} ?>
                
                        </td>
                
                        <td>
                
                        <?php if($row->mm_varify=="1")
                
                        {?>
                
                        <a href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">
                
                        <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
                
                        </a>
                
                        <?php }
                
                        else
                
                        {?> 
                
                        <a  href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">
                
                      
                
                        <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
                
                          
                
                        </a>
                
                        <?php }?>
                
                        </td>
                
                        <td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$row->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
                        
                        <a href="<?php echo base_url('chapteradmincp/user/add_user_family_member/'.$row->mm_id.'');?>" 
                        title="Add Family Member"><?php if($row->mm_family_id == 0) {?><i class="icon-user"></i><?php } ?></a> 
                
                        <a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$row->mm_id.'');?>" 
                        title="Delete"><i class="icon-minus-sign"></i></a>
                        </td>
		
					</tr>
		
		  		<?php   if($chk_sub_member)
						{
      
							foreach ($chk_sub_member as $rowB)
		  
							{
		  
					?>
			
							<tr class="info">
							
								<td><?php echo $rowB->mm_username; ?></td>
						
								<td><?php echo $rowB->mm_fname.' '.$rowB->mm_lname; ?></td>
								
							   <?php /*?> <td><?php if(isset($get_user_chapter)){echo $get_user_chapter->ch_name;} ?></td><?php */?>
						
								<td><?php echo $rowB->mm_hphone; ?></td>
						
								<td><a href="mailto:<?php echo $rowB->mm_email; ?>"><?php echo $rowB->mm_email; ?></a></td>
								
								<td><?php if($rowB->mm_type == '0'){echo 'Member';}else{ 
						
									
						
									echo 'C.A. of '.$get_chapter->ch_name;} ?>
						
								</td>
						
								<td>
						
								<?php if($rowB->mm_varify=="1")
						
								{?>
						
								<a href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						
							  
						
								<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
						
								</a>
						
								<?php }
						
								else
						
								{?> 
						
								<a  href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						
							  
						
								<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
						
								  
						
								</a>
						
								<?php }?>
						
								</td>
						
								<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$rowB->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
						
								<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$rowB->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
					
						</tr>
			
				<?php 		}
		
						} 
			   		}
			   		else
			   		{
				   
					   $chk_parent_member = $this->dbadminheader->chk_parent_member($row->mm_family_id);
					   foreach($chk_parent_member as $rowc)
					   {
						  $chk_sub_member = $this->dbadminheader->chk_sub_member($rowc->mm_id); ?>
						  
						  <tr <?php if($chk_sub_member){ echo 'class="error"'; }?> >
		
							<td><?php echo $rowc->mm_username; ?></td>
					
							<td><?php echo $rowc->mm_fname.' '.$row->mm_lname; ?></td>
							
							<?php /*?><td><?php if(isset($get_user_chapter)){echo $get_user_chapter->ch_name;} ?></td><?php */?>
					
							<td><?php echo $rowc->mm_hphone; ?></td>
					
							<td><a href="mailto:<?php echo $rowc->mm_email; ?>"><?php echo $rowc->mm_email; ?></a></td>
							
							 <td><?php if($rowc->mm_type == '0'){echo 'Member';}else{ 
					
								
					
								echo 'C.A. of '.$get_chapter->ch_name;} ?>
					
							</td>
					
							<td>
					
							<?php if($rowc->mm_varify=="1")
					
							{?>
					
							<a href="<?php echo base_url('chapteradmincp/user/status/'.$rowc->mm_id.'');?>" title="status">
					
						  
					
							<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
					
							</a>
					
							<?php }
					
							else
					
							{?> 
					
							<a  href="<?php echo base_url('chapteradmincp/user/status/'.$rowc->mm_id.'');?>" title="status">
					
						  
					
							<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
					
							  
					
							</a>
					
							<?php }?>
					
							</td>
					
							<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$rowc->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
							
							<a href="<?php echo base_url('chapteradmincp/user/add_user_family_member/'.$rowc->mm_id.'');?>" 
                            title="Add Family Member"><?php if($rowc->mm_family_id == 0) {?><i class="icon-user"></i><?php } ?></a> 
					
							<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$rowc->mm_id.'');?>" 
                            title="Delete"><i class="icon-minus-sign"></i></a></td>
					
						</tr>
					
					  <?php if($chk_sub_member)
							{
					
								foreach ($chk_sub_member as $rowB)
					
							   {
					
							?>
					
								<tr class="info">
									
									<td><?php echo $rowB->mm_username; ?></td>
							
									<td><?php echo $rowB->mm_fname.' '.$rowB->mm_lname; ?></td>
									
								   <?php /*?> <td><?php if(isset($get_user_chapter)){echo $get_user_chapter->ch_name;} ?></td><?php */?>
							
									<td><?php echo $rowB->mm_hphone; ?></td>
							
									<td><a href="mailto:<?php echo $rowB->mm_email; ?>"><?php echo $rowB->mm_email; ?></a></td>
									
									 <td><?php if($rowB->mm_type == '0'){echo 'Member';}else{ 
							
										
							
										echo 'C.A. of '.$get_chapter->ch_name;} ?>
							
									</td>
							
									<td>
							
									<?php if($rowB->mm_varify=="1")
							
									{?>
							
									<a href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
							
								  
							
									<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
							
									</a>
							
									<?php }
							
									else
							
									{?> 
							
									<a  href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
							
								  
							
									<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
							
									  
							
									</a>
							
									<?php }?>
							
									</td>
							
									<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$rowB->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
							
									<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$rowB->mm_id.'');?>" 
                                    title="Delete"><i class="icon-minus-sign"></i></a></td>
			
								</tr>
	
		<?php 					}
	
					} 
							  
				}
				   
			}
			  
	?>

    

		<?php

   		}

	}

else

{

	echo "<tr><td colspan='6'>No result found!!!</td></tr>";

}

?>

</table>



<?php echo $this->pagination->create_links(); ?>

</div>

	</td></tr></table>

</div>

<?php $this->load->view('chapteradmincp/layout/footer'); ?>
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">