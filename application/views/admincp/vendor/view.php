<?php $this->load->view('admincp/layout/header'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--------------------------------------monita20130726---------------------------------------->
<link href="<?php echo base_url(); ?>css/data-tip.css" rel="stylesheet" type="text/css">
<!-------------------------------------end-Of-monita20130726---------------------------------------->
</head>
<body>
<div class="space10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Vendors&nbsp;<small>Manage Vendors</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Vendor Name</th>
            <th scope="col">Vendor Email</th>
            <th scope="col">Vendor Address</th>
             <th scope="col">Category</th>
             <th scope="col">Chapter</th>
            <th scope="col">Vendor Description</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col" width="30">Action</th>
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
    	<td><?php echo $row->vendor_name; ?></td>
        <td><?php echo $row->vendor_email; ?></td>
        <td><?php echo $row->vendor_address; ?></td>
         <td><?php echo $row->category_name; ?></td>
       	<?php
                    
					$chapter = $this->dbadminheader->get_chapters();
					$chaptername='';
                    foreach($chapter as $chapter_row)
                    {
						$ch_to_events = $this->dbvendor->ch_to_vender($row->vendor_id,$chapter_row->ch_id); 
						if($ch_to_events)
						{
							
							$chaptername .=$chapter_row->ch_name.', ';
						}
						
					}
                ?>
    	<td><div style="width:200px;"><?php echo $rest = substr($chaptername, 0,-2);?></div></td>
     <!--------------------------------------monita20130726---------------------------------------->
        <td style="width:30%"><div data-tip="<?php  echo stripslashes(strip_tags($row->vendor_desc)); ?>"><?php $string=$row->vendor_desc;
		echo $str = word_limiter($string,6); ?></div>
        </td>
        <!--------------------------------------monita20130726---------------------------------------->
        <td><?php echo $row->vendor_created_by; ?></td>
        <td><?php echo $row->vendor_created_date; ?></td>
        <td><?php echo $row->vendor_modified_by; ?></td>
        <td><?php echo $row->vendor_modified_date; ?></td>
        <td>
        <a href="<?php echo base_url(); ?>admincp/vendor/edit/<?php echo $row->vendor_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
       <a href="<?php echo base_url();?>admincp/vendor/delete/<?php echo $row->vendor_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a>
       </td>
    </tr>
    
		<?php
   }
}
else
{
	echo "<tr><td colspan='5'>".$this->lang->line('text_no_result')."</td></tr>";
}
?>
</table>

<?php echo $this->pagination->create_links(); ?>
</div>
	</td></tr></table>
</body>
</html>