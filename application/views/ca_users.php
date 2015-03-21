<?php $this->load->view('header'); ?>

<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_news.html'); ?>">Add News</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        <div class="row">
        <?php
		$form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'get');
		echo form_open('ca/search_users', $form_attributes);
		?>
        <span class="span4">
        <input style="margin-top:10px;" class="input-large" type="text" id="search" name="search" placeholder="Search by name, username or email" value="<?php echo set_value('search'); ?>"> <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />
        </span>
       
        </div>
        <table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col"><?php echo $this->lang->line('text_phone');?></th>
            <th scope="col"><?php echo $this->lang->line('text_email');?></th>
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
			   
			   $chk_sub_member = $this->dbheader->chk_sub_member($row->mm_id);
	?>
    <tr <?php if($chk_sub_member){ echo 'class="error"'; }?> >
        <td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>
        <td><?php echo $row->mm_hphone; ?></td>
        <td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>
        <td><a href="<?php echo base_url('ca/edit_user/'.$row->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url('user/add_user_family_member/'.$row->mm_id.'');?>" title="Add Family Member"><i class="icon-user"></i></a>
        <a onclick="javascript: return del();" href="<?php echo base_url('ca/delete_user/'.$row->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    </tr>
    <?php if($chk_sub_member){
			foreach ($chk_sub_member as $rowB)
		   {
		?>
    	<tr class="info">
        <td><?php echo $rowB->mm_fname.' '.$rowB->mm_lname; ?></td>
        <td><?php echo $rowB->mm_hphone; ?></td>
        <td><a href="mailto:<?php echo $rowB->mm_email; ?>"><?php echo $rowB->mm_email; ?></a></td>
        <td><a href="<?php echo base_url('ca/edit_user/'.$rowB->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
        <a onclick="javascript: return del();" href="<?php echo base_url('ca/delete_user/'.$rowB->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    </tr>
    <?php }
		} ?>
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
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>