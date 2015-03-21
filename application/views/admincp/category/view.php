<?php $this->load->view('admincp/layout/header'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
    <div class="height10px"></div>
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <div class="span12"><h1><?php echo $title; ?> <small></small></h1></div>
                <div class="span2" align="right">
                <div class="control-group">
                <div class="controls">
                <a href="<?php echo base_url(); ?>admincp/category/add">
                  <input type="submit" value="ADD" class="btn btn-large btn-primary" />
                </a>
                </div>
                </div>
                </div>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Category</th>
            <th scope="col">Venders</th>
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
        <td><?php echo $row->category_name; ?></td>
          <td>
			<?php 
				//$chapters_states = $this->dbchapters->get_chapters_states($row->ch_id);
				$ven = $this->dbcategory->get_ven($row->category_id);
				$i=1;
				$count =  count($ven);
				foreach($ven as $ven_row)
				{
					echo $ven_row->vendor_name;
					
					if($i != count($ven))
					{
						 if($i ==$count)
						 {
							 echo '';
						 }
						 else
						 {
					 		 echo ' , ';
						 }
					}
					
					
				$i++;
				}
			 ?>
        </td>         
         <td>
         <a href="<?php echo base_url('admincp/category/edit/'.$row->category_id.'');?>" title="Edit"><i class="icon-edit"></i></a> 
        <a onclick="javascript: return del();" href="<?php echo base_url();?>admincp/category/delete/<?php echo $row->category_id; ?>"title="Delete"><i class="icon-minus-sign"></i></a>
        </td>
    </tr>
    
		<?php
   }
}
else
{
	echo "<tr><td colspan='5'>No result found!!!</td></tr>";
}
?>
     </table>
     <?php echo $this->pagination->create_links(); ?>
</body>
</html>
<?php $this->load->view('admincp/layout/footer'); ?>