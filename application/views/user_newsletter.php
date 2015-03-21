<?php $this->load->view('header'); ?>

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
        
        
		<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><div style="width:300px">Subject</div></th>
           	
            <th scope="col"><?php echo $this->lang->line('text_action');?></th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="2"></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
		  
		   foreach ($query as $row)
		   {
			   
	?>
    <tr>
        <td><?php echo $row->subject; ?></td>
       	
        <td><a onclick="javascript: return del();" href="<?php echo base_url('user/unsubscribe_newsletter/'.$row->newsletter_id.'/'.$row->subject); ?>" title="Delete"><i class="icon-minus-sign"></i> Unsubscribe</a></td>
    </tr>
    
		
		<?php
   			}
		}
		else
		{
			echo "<tr><td colspan='1'>No result found!!!</td></tr>";
		}
?>

</table>
		<?php //echo $this->pagination->create_links(); ?>
   		
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
    <?php $this->load->view('ca_menu'); ?>
        <?php $this->load->view('member_menu'); ?>
        
       
        <?php $this->load->view('ads_panel'); ?>
         <div class="space20px"></div>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>