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
                        <option value="1" <?php if($this->input->get('mm_type') == 1){ echo 'selected="selected"'; } ?>>Assigned members</option>
                        <option value="2" <?php if($this->input->get('mm_type') == 2){ echo 'selected="selected"'; } ?> >Un-Assigned members</option>
                        </select>
                        </span>
                        <span class="span4">
                        <input style="margin-top:10px;" class="input-large" type="text" id="search" name="search" placeholder="Search by name, username or email" value="<?php echo set_value('covers_cat_name'); ?>">
                        </span>
                        <span class="span2">
                        <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
                        </span>
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
</table>

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>