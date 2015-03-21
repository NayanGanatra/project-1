<?php $this->load->view('header'); ?>
<div class="min_height" >
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <?php /*?><div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/add_news.html'); ?>">Add News</a>
    </div><?php */?>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
<div class="space10px"></div>
<a href="<?php echo base_url('forum/add_forum'); ?>" style="float:right;"><button class="btn btn-primary">Add Forum</button></a>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
			<th scope="col">Confirmed</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col" width="30">Action</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="9"></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
			$i=0;
		  foreach ($query as $row)
		   {
			?>
		    <tr>
		        <td><?php echo $row->title; ?></td>
                <td><?php if($row->status==1) { echo 'Active';} else { echo 'Inactive';} ?></td>
				<td style="text-align: center;"><?php if($row->verify==1) { ?><img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" /><?php } else { ?><img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><?php } ?></td>
				<td><?php echo $row->blog_created_by; ?></td>
                <td><?php echo $row->blog_created_date; ?></td>
                <td><?php echo $row->blog_modified_by; ?></td>
                <td><?php echo $row->blog_modified_date; ?></td>
		        <td>
				<a href="<?php echo base_url('forum/edit_forum/'.$row->bid);?>" title="Edit"><i class="icon-edit"></i></a>
				<a href="<?php echo base_url('forum/delete_forum/'.$row->bid);?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
    			</tr>
    
		<?php
		$i++;
   }
}
else
{
	echo "<tr><td colspan='9'>No result found!!!</td></tr>";
}
?>

</table>

	</td></tr></table>
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
       
        <?php $this->load->view('ads_panel'); ?>
         <div class="space20px"></div>
    </div>
</div>

</div></div>
<?php $this->load->view('footer'); ?>