<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Category<small>Edit Categoy</small></h1>
		</div>
        <hr />
        
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                 
                <div class="control-group <?php if(form_error('category_name')){ echo "error";}?>">
                <label class="control-label">Category Name</label>
                <div class="controls">
                <input class="input-xxlarge" type="text" id="category_name" name="category_name" placeholder="Category Name" value="<?php echo $query->category_name; ?>">
                <span class="help-inline"><?php echo form_error('category_name'); ?></span>
                </div>
                </div>
                   
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
                

	</td>
  </tr>
</table>
</body>
</html>
<?php $this->load->view('admincp/layout/footer'); ?>