<?php $this->load->view('admincp/layout/header'); ?>
<script type="text/javascript" language="javascript">
function setaction(x)
{
	if(x=='approveall'){ approveall(); }
	if(x=='disapproveall'){ disapproveall(); }
	if(x=='delete')	{ alertdel(); }
	if(x=='change_cat')	{ document.getElementById('cat_block').style.display = "inline-block"; }
}

function approveall()
{
	var y="";

	for (var i=0;i<document.covers.elements.length;i++)
	{
		var e = document.covers.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("<?php echo $this->lang->line('alert_sure_approve');?>");
				
				if(x==true)
				{
					document.covers.action = "<?php echo base_url();?>admincp/covers/approveall/";
					document.covers.submit();
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	if(y=="")
	{
		alert('Please select atleast 1 record');
		return false;
	}
}

function disapproveall()
{
	var y="";

	for (var i=0;i<document.covers.elements.length;i++)
	{
		var e = document.covers.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("<?php echo $this->lang->line('alert_sure_disapprove');?>");
				
				if(x==true)
				{
					document.covers.action = "<?php echo base_url();?>admincp/covers/disapproveall/";
					document.covers.submit();
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	if(y=="")
	{
		alert('<?php echo $this->lang->line('misc_select_one');?>');
		return false;
	}
}

function alertdel()
{
	var y="";

	for (var i=0;i<document.covers.elements.length;i++)
	{
		var e = document.covers.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("<?php echo $this->lang->line('alert_sure_delete');?>");
				
				if(x==true)
				{
					document.covers.action = "<?php echo base_url();?>admincp/covers/deleteall/";
					document.covers.submit();
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	if(y=="")
	{
		alert('<?php echo $this->lang->line('misc_select_one');?>');
		return false;
	}
}

function chng_cat(covers_cat_id)
{
	if(covers_cat_id)
	{
		var y="";
	
		for (var i=0;i<document.covers.elements.length;i++)
		{
			var e = document.covers.elements[i];
			if (e.type=='checkbox')
			{
				if(e.checked)
				{
					y=e.value;
					x=window.confirm("<?php echo $this->lang->line('alert_sure_change_category');?>");
					
					if(x==true)
					{
						document.covers.action = "<?php echo base_url();?>admincp/covers/change_cat/"+covers_cat_id;
						document.covers.submit();
						return true;
					}
					else
					{
						return false;
					}
				}
			}
		}
		if(y=="")
		{
			alert('<?php echo $this->lang->line('misc_select_one');?>');
			return false;
		}
	}
	else
	{
		alert('<?php echo $this->lang->line('misc_select_one');?>');
		return false;
	}
}
</script>

<div class="space40px"></div>
<div class="row">
<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    <?php
	$form_attributes = array('id' => 'covers','name' => 'covers', 'onsubmit' => 'javascript: goforsearch();');
	echo form_open('', $form_attributes);
	?>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_covers');?> <small><?php echo $this->lang->line('text_manage_covers');?></small></h1>
                <hr>
		</div>
        	
            
            <div class="span8">
            	<div align="left" style="clear:both; display:block; padding-top:10px;">
                    <input type="button" onclick="selectAllCheckBoxes('covers', 'covers_id[]', true);" value="<?php echo $this->lang->line('misc_select_all');?>" class="btn btn_field_size">
                    <input type="button" class="btn btn_field_size" onclick="selectAllCheckBoxes('covers', 'covers_id[]', false);" value="<?php echo $this->lang->line('misc_clear_all');?>">
            
                    <select name="goto" id="goto" onchange="javascript: setaction(this.value);" style="width:140px;">
                        <option value=""><?php echo $this->lang->line('misc_select');?></option>
                        <option value="approveall"><?php echo $this->lang->line('misc_approve');?></option>
                        <option value="disapproveall"><?php echo $this->lang->line('misc_disapprove');?></option>
                        <option value="delete"><?php echo $this->lang->line('misc_delete');?></option>
                        <option value="change_cat"><?php echo $this->lang->line('misc_change_category');?></option>
                    </select>
                    <input type="hidden" name="action" id="action" value="" />
                    
                    <span id="cat_block" style="display:none;">
                    <select name="covers_cat_id" id="covers_cat_id" onchange="javascript: chng_cat(this.value);">
                        <option value="" selected="selected"><?php echo $this->lang->line('misc_select');?></option>
                        <?php 
                        $cat = $this->dbcovers->get_categories();
                        foreach($cat as $row_cat)
                        {
                            ?>
                            <option value="<?php echo $row_cat->covers_cat_id; ?>"><?php echo $row_cat->covers_cat_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    </span>
            </div>
            </div>
            
            <div class="span6 offset3">
            <input type="text" name="search" id="search" class="input_text" style="width:180px; margin-right:4px; float:left;" value="<?php if(isset($_POST['search']) && $_POST['search'] != "") { echo $_POST['search']; } ?>" placeholder="<?php echo $this->lang->line('misc_search');?>"/>
            <select name="category" id="category" style="width:200px;">
                <option value=""><?php echo $this->lang->line('misc_select');?></option>
                <?php 
                $cat = $this->dbcovers->get_categories();
                foreach($cat as $row_cat)
                {
					if(isset($_POST['category']) && $_POST['category'] == $row_cat->covers_cat_id)
					{
						?>
						<option value="<?php echo $row_cat->covers_cat_id; ?>" selected="selected"><?php echo $row_cat->covers_cat_name; ?></option>
                    	<?php
					}
					else
					{
						?>
						<option value="<?php echo $row_cat->covers_cat_id; ?>"><?php echo $row_cat->covers_cat_name; ?></option>
                    	<?php
					}
                }
                ?>
            </select>
            <input class="btn btn_field_size" type="button" value="<?php echo $this->lang->line('misc_go');?>" onclick="javascript: goforsearch();">
            </div>
           <hr /> 
            
        	<div class="space20px"></div>
            
            <div class="row-fluid">
            	<ul class="thumbnails">
                <?php
				if ($query)
					{
					   $i = 0;
					   foreach ($query as $row)
					   {
						   if ($i%4==0)
	   						{
								$span_margin = "style='margin-left: 0;'";
							}
							else
							{
								$span_margin = '';
							}
				?>
                	<li class="span3" <?php echo $span_margin; ?> >
                    	<div class="thumbnail">
                        	<a rel="gallery" title="<?php echo $row->covers_name; ?>" class="gallery" href="<?php echo base_url();?>covers-images/download/<?php echo $row->covers_image; ?>" >
                            <img src="<?php echo base_url();?>covers-images/thumbs/<?php echo $row->covers_image; ?>" border="0" />
                            </a>
                            <input type="checkbox" name="covers_id[]" id="covers_id[]" class="checkbox_holder" value="<?php echo $row->covers_id; ?>" />
                                <div class="caption">
                                <p><?php echo substr($row->covers_name, 0, 18); ?></p>
                                
                                <div class="btn-group">
                               
                                <?php
								   if($row->covers_status == '0')
								   {
									   ?>
									   <a class="btn btn-danger" href="<?php echo base_url();?>admincp/covers/approve/<?php echo $row->covers_id; ?>" title='<?php echo $this->lang->line('misc_approve_now');?>'><?php echo $this->lang->line('misc_disapproved');?></a> 
									   <?php
								   }
								   else
								   {
									   ?>
									   <a  class="btn btn-success" href="<?php echo base_url();?>admincp/covers/disapprove/<?php echo $row->covers_id; ?>" title='<?php echo $this->lang->line('misc_disapprove_now');?>'><?php echo $this->lang->line('misc_approved');?></a> 
									   <?php
								   }
							   ?>
       
                                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <?php echo $this->lang->line('misc_action');?>
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url();?>admincp/covers/edit/<?php echo $row->covers_id; ?>"><?php echo $this->lang->line('misc_edit');?></a></li>
                                    <li><a href="<?php echo base_url();?>admincp/covers/delete/<?php echo $row->covers_id; ?>" title='Delete' onclick="javascript: return del();"><?php echo $this->lang->line('misc_delete');?></a></li>
                                  </ul>
                                  
                                </div>
                                    
                              </div>
                              <div class="span2" style="float:none !important; display:inline-block;"><i title="<?php echo $this->lang->line('misc_downloads');?>" class="icon-download-alt"><span class="margin_left20px"><?php echo $row->covers_downloads; ?></span></i></div>
                              <div class="span2" style="float:none !important; display:inline-block;"><i title="<?php echo $this->lang->line('misc_views');?>" class="icon-eye-open"><span class="margin_left20px"><?php echo $row->covers_views; ?></span></i></div>
                              <div class="span4" style="float:right; margin-right:10px;"><?php echo $this->ratings->bar($row->covers_id,5); ?></div>
                        </div>
                    </li>
                <?php
					$i++;
					   }
					}
				?>
                </ul>
            </div>


<div style="clear:both;">
<?php echo $this->pagination->create_links(); ?>
</div>
</form>

	</td></tr></table>
</div>
<?php $this->load->view('admincp/layout/footer'); ?>