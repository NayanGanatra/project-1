<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="min_height">
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td valign="top">

        <div class="dotted_line">
        	<span class="span8">
		        <h1>Live Online <?php echo $this->lang->line('text_users');?> <small><?php //echo count($query); ?></small></h1>
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
		  $c=1;
		   foreach ($query as $online)
		   {
			   if($online->user_id !=0)
			   {
			   $row = $this->dbuser->get_user($online->user_id);
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
		$c++;
			   }
   }
   
   if($c == 1)
   {
	   echo "<tr><td colspan='6'>No result found!!!</td></tr>";
	}
}
else
{
	echo "<tr><td colspan='6'>No result found!!!</td></tr>";
}
?>
</table>

</div>
	</td></tr></table>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>