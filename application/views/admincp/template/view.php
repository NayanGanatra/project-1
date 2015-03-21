<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_template');?> <small><?php echo $this->lang->line('text_manage_template');?></small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th width="25%" scope="col"><?php echo $this->lang->line('text_name');?></th>
            
           <!-- <th scope="col"><?php //echo $this->lang->line('text_size');?></th>-->
            <th width="55%"   scope="col">Chapter</th>
            <th width="10%" scope="col" width="100"><?php echo $this->lang->line('text_status');?></th>
            <th width="5%" scope="col" width="30">Action</th>
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
    <tr <?php if($row->template_status == "1") { echo "class=''"; }else{ echo "class='error'"; } ;?>>
        <td><?php echo $row->template_title; ?>
        	
        </td>
        
        <!--<td><?php //echo $row->template_type; ?></td>-->
        <?php
                    
					$chapter = $this->dbadminheader->get_chapters();
					$chaptername='';
                    foreach($chapter as $chapter_row)
                    {
						$ch_to_template = $this->dbadminheader->ch_to_template($row->template_id,$chapter_row->ch_id); 
						if($ch_to_template)
						{
							
							$chaptername .=$chapter_row->ch_name.', ';
						}
						
					}
                ?>
    	 <td><div style="width:400px;"><?php echo $rest = substr($chaptername, 0,-2);?></div></td>
		<td><?php if($row->template_status == "1") { echo $this->lang->line('misc_active'); }else{ echo $this->lang->line('misc_deactive'); } ;?></td>
        <td><a href="<?php echo base_url(); ?>admincp/template/edit/<?php echo $row->template_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a> 
        <a  href="<?php echo base_url();?>admincp/template/delete/<?php echo $row->template_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></td>
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
<?php $this->load->view('admincp/layout/footer'); ?>