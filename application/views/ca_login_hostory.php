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
        
        <table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Date & Time</th>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col">Phone</th>
            <th scope="col"><?php echo $this->lang->line('text_email');?></th>
            <th scope="col">IP</th>
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

	?>
    <tr>
    	<td><?php echo $row->date_time; ?></td>
        <td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>
        <td><?php echo $row->mm_hphone; ?></td>
        <td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>
        <td><?php echo $row->ip; ?></td>
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