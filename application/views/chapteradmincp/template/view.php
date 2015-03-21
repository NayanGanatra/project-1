<?php $this->load->view('chapteradmincp/layout/header'); ?>
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
        <td><!--<a rel="gallery" class="gallery" href="<?php //echo base_url('images/template/'.$row->template_code); ?>" title="<?php //echo $row->template_title; ?>">--><?php echo $row->template_title; ?><!--</a>-->
        	
        </td>
        
        <!--<td><?php //echo $row->template_type; ?></td>-->
       <td ><?php $chapter = $this->dbadminheader->get_chapter($this->session->userdata('get_chapter_id')); if($chapter){echo $chapter->ch_name;}?></td>
       <td><?php if($row->template_status == "1") { echo $this->lang->line('misc_active'); }else{ echo $this->lang->line('misc_deactive'); } ;?></td>
        
        <td>
        <a href="<?php echo base_url(); ?>chapteradmincp/template/edit/<?php echo $row->template_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>chapteradmincp/template/delete/<?php echo $row->template_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></td>
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
<?php $this->load->view('chapteradmincp/layout/footer'); ?>