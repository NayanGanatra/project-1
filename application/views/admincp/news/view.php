<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>News <small>Manage News</small></h1>
		</div>
        <hr>
<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Title</th>
            <th scope="col">Chapter</th>
            <th scope="col">Status</th>
            <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>
            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>
            <th scope="col">Action</th>
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
		{?>
        <tr>
    	<td><?php echo $row->news_create; ?></td>
        <td><a class="inline" href="#ads_code_<?php echo $row->news_id; ?>" title="<?php echo $row->news_title; ?>"><?php echo $row->news_title; ?></a></td>
        
          		<?php
                    $chapter = $this->dbadminheader->get_chapters();
					$chaptername='';
                    foreach($chapter as $chapter_row)
                    {
						$ch_to_news = $this->dbadminheader->ch_to_news($row->news_id,$chapter_row->ch_id); 
						if($ch_to_news)
						{
							
							$chaptername .=$chapter_row->ch_name.', ';
						}
						
					}
                ?>
    	<td><div style="width:200px;"><?php echo $rest = substr($chaptername, 0,-2);?></div></td>
        <td><?php if($row->news_status == "1") { ?> <img src="<?php echo base_url(); ?>images/approve_icon.gif"><?php }else{ ?><img src="<?php echo base_url(); ?>images/disapprove_icon.gif"><?php } ?></td>
        
        <td><?php echo $row->news_created_by; ?></td>
        <td><?php echo $row->news_created_date; ?></td>
        <td><?php echo $row->news_modified_by; ?></td>
        <td><?php echo $row->news_modified_date; ?></td>
        
        <td><a href="<?php echo base_url(); ?>admincp/news/edit/<?php echo $row->news_id; ?>" title="<?php echo $this->lang->line('misc_edit');?>"><i class="icon-edit"></i></a>
        <a href="<?php echo base_url();?>admincp/news/delete/<?php echo $row->news_id; ?>" title='<?php echo $this->lang->line('misc_delete');?>' onclick="javascript: return del();"><i class="icon-minus-sign"></i></a></td>
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