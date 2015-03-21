<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script src="<?php echo base_url(); ?>js/jquery.dataTables.js"></script>
<link href="<?php echo base_url(); ?>css/data-table.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>css/email.css" rel="stylesheet" type="text/css">
<script>
/*window.onload = $('div#custom_box').addClass("custom_box_css");*/
</script>
<div id="custom_box" style="display:none">

					<div id="overlay">

						<div id="box_frame">

							<div id="box">

							<img src="<?php echo base_url(); ?>images/ajax-loader.gif" />

								<!--<div id="box_upper">

								</div>-->

							</div>

						</div>

					</div>

				</div>
<div class="min_height">
<div class="space10px"></div>
<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
<tr>
<td>
<div class="dotted_line">
<span class="span8">
<h1><?php echo $this->lang->line('text_users');?> <small><span id="memcount"></span></small></h1>
</span>
<div class="span5 offset sub_link" align="right">
<?php
$form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');
echo form_open(base_url().'chapteradmincp/user/view', $form_attributes);
?>
<div class="control-group <?php if(form_error('keywords'))
{
	echo "error";
}
?>">
<div class="controls">
<span class="span4">
<select name="member_type" class="input-large" style="margin:0;" id="member_type">
<option value="0">All Members</option>
<option value="1">Verified members</option>
<option value="2">Un-verified members</option>
</select>
</span>
<span class="span4">
<input style="margin-top:10px;" class="input-large" type="text" id="member_search" name="member_search" placeholder="Search by name, username or email">
</span>
<span class="span2" style="width:68px;">
<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn"/>
</span>
</div>
<div>
<li class="dropdown" style=" clear:both;float:right;width:150px;list-style:none">
<a href="#" id="exportexcel" style="width:100px;float:right;" class="dropdown-toggle" data-toggle="dropdown">Export to excel </a>
<ul class="dropdown-menu" style="" >
<li ><a style="text-align:left;" href="<?php echo base_url().'chapteradmincp/user/user_export_to_excel/1'; ?>">All Members</a></li>
<li><a style="text-align:left;" href="<?php echo base_url().'chapteradmincp/user/user_export_to_excel/2'; ?>">verified Members</a></li>
<li><a style="text-align:left;" href="<?php echo base_url().'chapteradmincp/user/user_export_to_excel/3'; ?>">Un-verified Members</a></li>
</ul>
</li>
</div>
</div>
</div>
<hr>
<div id="used_data">
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover" id="data-table">
<thead>
<tr>
<th scope="col">Username</th>
<th scope="col"><?php echo $this->lang->line('text_name');?></th>
<!-- <th scope="col">Chapter</th>-->
<th scope="col"><?php echo $this->lang->line('text_phone');?></th>
<th scope="col"><?php echo $this->lang->line('text_email');?></th>
<th scope="col"><?php echo $this->lang->line('text_type');?></th>
<th scope="col"><?php echo $this->lang->line('text_status');?></th>
<th scope="col"><?php echo $this->lang->line('text_action');?></th>
</tr>
</thead>
<tfoot>
<tr>
<td colspan="7"></td>
</tr>
</tfoot>
<?php
$memcount = 0;
if ($query)
{
	$parentmem = array();
	$childmem = array();
	$newarray = array();
	$finalarr = array();	
	foreach ($query as $family_id)
	{
		$row = $this->dbuser->get_user_detail_by_id($family_id->familyID);
		$get_chapter = $this->dbadminheader->get_chapter($row->mm_chapter_id);
		$user_ch = $this->dbuser->get_ch_from_state($row->mm_state_id);
		if($user_ch)
		{
			$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);
		}
		if($row->mm_family_id == 0)
		{
			$memcount++;
			$chk_sub_member_child = $this->dbadminheader->chk_sub_member($row->mm_id);
			?>
			<tr <?php if($chk_sub_member_child)
			{
				echo 'class="error"';
			}
			?> >
			<td><?php echo $row->mm_username; ?></td>
			<td><?php echo $row->mm_fname.' '.$row->mm_lname; ?></td>
			<td><?php echo $row->mm_hphone; ?></td>
			<td><a href="mailto:<?php echo $row->mm_email; ?>"><?php echo $row->mm_email; ?></a></td>
			<td><?php if($row->mm_type == '0')
			{
				echo 'Member';
			}
			else{ 
				echo 'C.A. of '.$get_chapter->ch_name;
			}
			?>
			</td>
			<td>
			<?php if($row->mm_varify=="1")
			{
				?>
				<a href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">
				<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
				</a>
			<?php }
			else
			{?> 
				<a  href="<?php echo base_url('chapteradmincp/user/status/'.$row->mm_id.'');?>" title="status">
				<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
				</a>
				<?php }?>
			</td>
			<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$row->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
			<a href="<?php echo base_url('chapteradmincp/user/add_user_family_member/'.$row->mm_id.'');?>" 
			title="Add Family Member"><?php if($row->mm_family_id == 0)
			{
				?><i class="icon-user"></i><?php } ?></a> 
			<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$row->mm_id.'');?>" 
			title="Delete"><i class="icon-minus-sign"></i></a>
			</td>
			</tr>
			<?php   if($chk_sub_member_child)
			{
				foreach ($chk_sub_member_child as $rowB)
				{
					$memcount++;
					?>
					<tr class="info">
					<td><?php echo $rowB->mm_username; ?></td>
					<td><?php echo $rowB->mm_fname.' '.$rowB->mm_lname; ?></td>
					<?php /*?> <td><?php if(isset($get_user_chapter))
					{
						echo $get_user_chapter->ch_name;
					}
					?></td><?php */?>
					<td><?php echo $rowB->mm_hphone; ?></td>
					<td><a href="mailto:<?php echo $rowB->mm_email; ?>"><?php echo $rowB->mm_email; ?></a></td>
					<td><?php if($rowB->mm_type == '0')
					{
						echo 'Member';
					}
					else{ 
						echo 'C.A. of '.$get_chapter->ch_name;
					}
					?>
					</td>
					<td>
					<?php if($rowB->mm_varify=="1")
					{
						?>
						<a href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
						</a>
					<?php }
					else
					{?> 
						<a  href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
						</a>
						<?php }?>
					</td>
					<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$rowB->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
					<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$rowB->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
					</tr>
				<?php 		}
				} 
		array_push($parentmem,$row->mm_id);
		}
		else
		{
			array_push($childmem,$row->mm_family_id);
		}
	}
	if(count($childmem)>0)
	{
		$newarray = array_intersect($parentmem,$childmem);
		$finalarr = array_diff($childmem,$newarray);
		$finalarr = array_unique($finalarr);
	}
		for($i=0;$i<=count($finalarr);$i++)
		{ 
		if(isset($finalarr[$i]))
		{			
		$parentdata = $this->dbuser->get_user_detail_by_id($finalarr[$i]);
		if($parentdata)
		{
		$get_chapter_name = $this->dbadminheader->get_chapter($parentdata->mm_chapter_id);
		$user_ch = $this->dbuser->get_ch_from_state($parentdata->mm_state_id);
		
		if($user_ch)
		{
			$get_user_chapter = $this->dbadminheader->get_chapter($user_ch->ch_id);
		}
		//$chk_sub_member = $this->dbadminheader->chk_sub_member($row->mm_id);
		//$search = $this->input->get('search');
		if($parentdata->mm_family_id == 0)
		{
			$memcount++;
			$chk_sub_member = $this->dbadminheader->chk_sub_member($parentdata->mm_id);
			?>
			<tr <?php if($chk_sub_member)
			{
				echo 'class="error"';
			}
			?> >
			<td><?php echo $parentdata->mm_username; ?></td>
			<td><?php echo $parentdata->mm_fname.' '.$parentdata->mm_lname; ?></td>
			<td><?php echo $parentdata->mm_hphone; ?></td>
			<td><a href="mailto:<?php echo $parentdata->mm_email; ?>"><?php echo $parentdata->mm_email; ?></a></td>
			<td><?php if($parentdata->mm_type == '0')
			{
				echo 'Member';
			}
			else{ 
				echo 'C.A. of '.$get_chapter_name->ch_name;
			}
			?>
			</td>
			<td>
			<?php if($parentdata->mm_varify=="1")
			{
				?>
				<a href="<?php echo base_url('chapteradmincp/user/status/'.$parentdata->mm_id.'');?>" title="status">
				<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
				</a>
			<?php }
			else
			{?> 
				<a  href="<?php echo base_url('chapteradmincp/user/status/'.$parentdata->mm_id.'');?>" title="status">
				<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
				</a>
				<?php }?>
			</td>
			<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$parentdata->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
			<a href="<?php echo base_url('chapteradmincp/user/add_user_family_member/'.$parentdata->mm_id.'');?>" 
			title="Add Family Member"><?php if($parentdata->mm_family_id == 0)
			{
				?><i class="icon-user"></i><?php } ?></a> 
			<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$parentdata->mm_id.'');?>" 
			title="Delete"><i class="icon-minus-sign"></i></a>
			</td>
			</tr>
			<?php   if($chk_sub_member)
			{
				foreach ($chk_sub_member as $rowB)
				{
					$memcount++;
					?>
					<tr class="info">
					<td><?php echo $rowB->mm_username; ?></td>
					<td><?php echo $rowB->mm_fname.' '.$rowB->mm_lname; ?></td>
					<?php /*?> <td><?php if(isset($get_user_chapter))
					{
						echo $get_user_chapter->ch_name;
					}
					?></td><?php */?>
					<td><?php echo $rowB->mm_hphone; ?></td>
					<td><a href="mailto:<?php echo $rowB->mm_email; ?>"><?php echo $rowB->mm_email; ?></a></td>
					<td><?php if($rowB->mm_type == '0')
					{
						echo 'Member';
					}
					else{ 
						echo 'C.A. of '.$get_chapter_name->ch_name;
					}
					?>
					</td>
					<td>
					<?php if($rowB->mm_varify=="1")
					{
						?>
						<a href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						<img src="<?php echo base_url()?>images/approve_icon.gif" width="16" height="16" />
						</a>
					<?php }
					else
					{?> 
						<a  href="<?php echo base_url('chapteradmincp/user/status/'.$rowB->mm_id.'');?>" title="status">
						<img src="<?php echo base_url()?>images/disapprove_icon.gif" width="16" height="16" /><b>&nbsp;New</b>
						</a>
						<?php }?>
					</td>
					<td><a href="<?php echo base_url('chapteradmincp/user/edit/'.$rowB->mm_id.'');?>" title="Edit"><i class="icon-edit"></i></a>
					<a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete/'.$rowB->mm_id.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>
					</tr>
				<?php 		}
				} 
		
		}
		}
}
}
}
else
{ ?>
	<tr><td>No result found!!!</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	<?php
}

?>
</table>
</div>
<?php echo $this->pagination->create_links(); ?>
</div>
</td></tr></table>
</div>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>
<script>
$(document).ready(function()
{
	$('#member_type').val('<?php echo $member_type; ?>');
	$('#member_search').val('<?php echo $member_search; ?>');
	$('#memcount').text('<?php echo $tot_rec; ?>');
	$('div#custom_box').removeClass("custom_box_css");
	/*if(parseInt($('#memcount').text())>20)
	{
	$('#data-table').dataTable({
			"iDisplayLength": 20,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"sPaginationType": "full_numbers",
			"bRetrieve": true
			});
	}*/
	
}
);
</script>