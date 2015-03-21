<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Latest News <small>Manage Latest News</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col"><?php echo $this->lang->line('text_name');?></th>
            <th scope="col"><?php echo $this->lang->line('text_status');?></th>
            <th scope="col">URL</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan=""></td>
        </tr>
    </tfoot>
    <?php
		if ($query)
		{
		  
		   foreach ($query as $row)
		   {
	?>
    <tr <?php if($row->latest_news_status == "1") { echo "class=''"; }else{ echo "class='error'"; } ;?>>
        <td><?php echo $row->latest_news_title; ?>
        	
        </td>
        <td><?php if($row->latest_news_status == "1") { ?> <img src="<?php echo base_url(); ?>images/approve_icon.gif"><?php }else{ ?><img src="<?php echo base_url(); ?>images/disapprove_icon.gif"><?php } ?></td>
       
        
        <td><?php echo $row->latest_news_link ; ?></td>
        <td><?php echo $row->latest_news_created_by; ?></td>
        <td><?php echo $row->latest_news_created_date; ?></td>
        <td><?php echo $row->latest_news_modified_by; ?></td>
        <td><?php echo $row->latest_news_modified_date; ?></td>
        <td>
        <a href="<?php echo base_url(); ?>chapteradmincp/latestnews/edit/<?php echo $row->latest_news_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>" ><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>chapteradmincp/latestnews/delete/<?php echo $row->latest_news_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();" > <i class="icon-minus-sign"></i></a></td>
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