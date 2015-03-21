<?php $this->load->view('chapteradmincp/layout/header'); ?>

<script>
function selectAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}
</script>

<script type="text/javascript" language="javascript">

function setaction(x)
{
	if(x=='active')
	{
		approveall();
	}
	if(x=='deactive')
	{
		disapproveall();
	}
	if(x=='delete')
	{
		alertdel();
	}
}

function approveall()
{
	var y="";

	for (var i=0;i<document.templates.elements.length;i++)
	{
		var e = document.templates.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("Are You Sure Want to Active ?");
				
				if(x==true)
				{
					document.templates.action = "<?php echo base_url();?>chapteradmincp/templates/activeall/";
					document.templates.submit();
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

	for (var i=0;i<document.templates.elements.length;i++)
	{
		var e = document.templates.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("Are You Sure Want to Deactive ?");
				
				if(x==true)
				{
					document.templates.action = "<?php echo base_url();?>chapteradmincp/templates/deactiveall/";
					document.templates.submit();
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

function alertdel()
{
	var y="";

	for (var i=0;i<document.templates.elements.length;i++)
	{
		var e = document.templates.elements[i];
		if (e.type=='checkbox')
		{
			if(e.checked)
			{
				y=e.value;
				x=window.confirm("Are You Sure Want to Delete ?");
				
				if(x==true)
				{
					document.templates.action = "<?php echo base_url();?>chapteradmincp/templates/deleteall/";
					document.templates.submit();
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

</script>

<div class="min_height">
<div class="space10px"></div>
<form name="templates" method="post">
<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    
    	<div class="dotted_line">
		        <h1 style="display:inline;">Templates</h1>
		</div>
        <div class="space20px"></div>
<table border="0" cellspacing="0" cellpadding="0" align="left" style="min-height:300px;"> 
  <thead>
  	<tr>
   
<?php 

if ($query)
{
   $i = 0;
   foreach ($query as $row)
   {
	   if ($i%5==0)
	   {
		?>
        </tr>
        <td width="120" valign="top">
		<div>
        <?php echo substr($row->templates_name, 0, 18); ?>
        </div>        
        <div class="thumb_box">
        <a href="<?php echo base_url()."covers-images/download/".$row->templates_name;?>" rel="lightbox[photos]" title=""><img src="<?php echo base_url();?>covers-images/thumbs/<?php echo $row->templates_img; ?>" border="0" width="180" height="67" /></a></div>
        <div style="margin-top:4px;">
       <span style="float:right;">
       <input type="checkbox" name="templates_id[]" id="templates_id[]" value="<?php echo $row->templates_id; ?>" />
       <?php
		   if($row->temp_show == '0')
		   {
			   ?>
			   <a href="<?php echo base_url();?>chapteradmincp/templates/active/<?php echo $row->templates_id; ?>" title='Active'><img src="<?php echo base_url();?>images/approve_icon.gif" border="0" title='Active' alt="Active" /></a> 
			   <?php
		   }
		   else
		   {
			   ?>
			   <a href="<?php echo base_url();?>chapteradmincp/templates/deactive/<?php echo $row->templates_id; ?>" title='Deactive'><img src="<?php echo base_url();?>images/disapprove_icon.gif" border="0" title='Deactive' alt="Deactive" /></a> 
			   <?php
		   }
	   ?>
       <a href="<?php echo base_url();?>chapteradmincp/templates/delete/<?php echo $row->templates_id; ?>" title='Delete' onclick="javascript: return del();"><img src="<?php echo base_url();?>images/delete_16.gif" border="0" title='Delete' alt="Delete" /></a></span>
        </td>
        <td width="10"></td>
        <?php   
		}
		else
		{
		?>

<td width="120" valign="top">
		<div>
        <?php echo substr($row->templates_name, 0, 18); ?>
        </div>        
        <div class="thumb_box">
        <a href="<?php echo base_url()."covers-images/download/".$row->templates_img;?>" rel="lightbox[photos]" title=""><img src="<?php echo base_url();?>covers-images/thumbs/<?php echo $row->templates_img; ?>" border="0" width="180" height="67" /></a></div>
        <div style="margin-top:4px;">
        <span style="float:right;">
        <input type="checkbox" name="templates_id[]" id="templates_id[]" value="<?php echo $row->templates_id; ?>" />
        <?php
		   if($row->temp_show == '0')
		   {
			   ?>
			   <a href="<?php echo base_url();?>chapteradmincp/templates/active/<?php echo $row->templates_id; ?>" title='Active'><img src="<?php echo base_url();?>images/approve_icon.gif" border="0" title='Active' alt="Active" /></a> 
			   <?php
		   }
		   else
		   {
			   ?>
			   <a href="<?php echo base_url();?>chapteradmincp/templates/deactive/<?php echo $row->templates_id; ?>" title='Deactive'><img src="<?php echo base_url();?>images/disapprove_icon.gif" border="0" title='Deactive' alt="Deactive" /></a> 
			   <?php
		   }
	   ?>
       <a href="<?php echo base_url();?>chapteradmincp/templates/delete/<?php echo $row->templates_id; ?>" title='Delete' onclick="javascript: return del();"><img src="<?php echo base_url();?>images/delete_16.gif" border="0" title='Delete' alt="Delete" /></a></span>
        </td>
        <td width="10"></td>
        <?php
		}
		$i++;
   }
}
else
{
	echo "<tr><td colspan='5'>No result found!!!</td></tr>";
}
?>
<td></td>
</tr>
</table>

<?php echo $this->pagination->create_links(); ?>


<div align="left" style="clear:both; display:block; padding-top:10px;">
        <input type="button" onclick="selectAllCheckBoxes('templates', 'templates_id[]', true);" value="Select All" class="submit_btn">
        <input type="button" class="submit_btn" onclick="selectAllCheckBoxes('templates', 'templates_id[]', false);" value="Clear All">

        <select name="goto" id="goto" onchange="javascript: setaction(this.value);">
        	<option value=""> -- Select -- </option>
            <option value="active">Active</option>
            <option value="deactive">Deactive</option>
            <option value="delete">Delete</option>
        </select>
        <input type="hidden" name="action" id="action" value="" />
</div>
	</td></tr></table>
    
</form>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>