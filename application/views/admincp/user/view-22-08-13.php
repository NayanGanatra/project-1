<?php $this->load->view('admincp/layout/header'); ?>

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

                        <option value="1" <?php if($this->input->get('mm_type') == 1){ echo 'selected="selected"'; } ?>>Assigned members</option>

                        <option value="2" <?php if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Un-Assigned members</option>
                        
                        <option value="3" <?php if($this->input->get('mm_type') == 3){ echo 'selected="selected"'; } ?> >Verified members</option>
                        
                        <option value="4" <?php if($this->input->get('mm_type') == 4){ echo 'selected="selected"'; } ?> >Un-Verified members</option>

                        </select>

                        </span>

                        <span class="span4">

                        <input style="margin-top:10px;" class="input-large" type="text" id="search" name="search" placeholder="Search by name, username or email" value="<?php echo set_value('covers_cat_name'); ?>">

                        </span>

                        <span class="span2">

                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

                        </span>

					</div>
                    <div >
                    		<li class="dropdown" style=" clear:both;float:right;width:150px;list-style:none">

                        <a href="#" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" data-toggle="dropdown">Export to excel </a>

                        <ul class="dropdown-menu" style="" >

                          <li><a style="text-align:left;" href="<?php echo base_url('admincp/user/user_export_to_excel/1');?>" onclick="">All Members</a></li>

                          <li><a style="text-align:left;" href="<?php echo base_url('admincp/user/user_export_to_excel/2');?>" onclick="">Assigned Members</a></li>
                          
                          <li><a style="text-align:left;" href="<?php echo base_url('admincp/user/user_export_to_excel/3');?>" onclick="">Un-Assigned Members</a></li>
                          
                          <li><a style="text-align:left;" href="<?php echo base_url('admincp/user/user_export_to_excel/4');?>" onclick="">verified Members</a></li>
                          
                          <li><a style="text-align:left;" href="<?php echo base_url('admincp/user/user_export_to_excel/5');?>" onclick="">Un-verified Members</a></li>
                      
                        </ul>

                      </li>
                    </div>

				</div>

                

            </span>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

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

       <!--added by ketan 20130724-->

		<td><?php 

		$chkadmin = $this->dbuser->get_admin_user($row->mm_email);

		$admin = 0;

		if($chkadmin)

		{

			$admin = 1;

		}

		if($row->mm_type == '0')
		{
			if($admin==1)
			{
				echo 'Member'.'/<br />Admin';
			}
			else
			{
				echo 'Member';
			}
		}
		else
		{ 

			if($admin==1)

			{

				echo 'C.A. of '.$get_chapter->ch_name.'/<br />Admin';

			}

			else

			{

				echo 'C.A. of '.$get_chapter->ch_name;

			}

			} ?>

        </td>

<!--update end-->

        <td>

        <?php if($row->mm_varify=="1")

		{?>

        <a href="<?php echo base_url('admincp/user/status/'.$row->mm_id.'');?>" title="status">

      

        <img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />

        </a>

        <?php }

		else

		{?> 

        <a  href="<?php echo base_url('admincp/user/status/'.$row->mm_id.'');?>" title="status">

      

        <img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>

          

        </a>

        <?php }?>

        </td>

        

        <td><a href="<?php echo base_url('admincp/user/edit/'.$row->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a> 

        <a onclick="javascript: return del();" href="<?php echo base_url('admincp/user/delete/'.$row->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>

    </tr>

    

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
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<?php $this->load->view('admincp/layout/footer'); ?>