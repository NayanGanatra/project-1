<?php $this->load->view('admincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>News <small>Edit News</small></h1>
		</div>
        <hr />
        
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('news_title')){ echo "error";}?>">
                <label class="control-label">News Title</label>
                <div class="controls">
                <input class="input-xxlarge" type="text" id="news_title" name="news_title" placeholder="News Title" value="<?php echo $query->news_title; ?>">
                <span class="help-inline"><?php echo form_error('news_title'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('news_content')){ echo "error";}?>">
            	<label class="control-label" for="inputError">News Content</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;"name="news_content" id="news_content"><?php echo $query->news_content; ?></textarea>
                    <span class="help-inline"><?php echo form_error('news_content'); ?></span>
                </div>
            	</div>
                
                <div class="control-group <?php if(form_error('news_create')){ echo "error";}?>">
                <label class="control-label">Date</label>
                <div class="controls">
                <input class="input-large" type="text" id="datepicker" name="news_create" placeholder="Date" value="<?php echo $query->news_create; ?>">
                <span class="help-inline"><?php echo form_error('news_create'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('news_ch_id')){ echo "error";}?>">
                <label class="control-label">Chapter</label>
                <div class="controls">
                	<select name="news_ch_id">
                        <?php
							$chapters = $this->dbadminheader->get_chapters();
							foreach($chapters as $chapters_row)
							{
								if($query->news_ch_id == $chapters_row->ch_id)
								{
								?>
                                <option selected="selected" value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>
                                <?php
								}
								else
								{
								?>
                                <option value="<?php echo $chapters_row->ch_id; ?>"><?php echo $chapters_row->ch_name; ?></option>
                                <?php
								}
							}
						?>
                        
                    </select>
                <span class="help-inline"><?php echo form_error('news_ch_id'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('news_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                    <select name="news_status" style="width:100px;">
                        <option <?php if($query->news_status == 1){echo 'selected="selected"'; }?> value="1">Active</option>
                        <option <?php if($query->news_status == 0){echo 'selected="selected"'; }?> value="0">Inactive</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('news_status'); ?></span>
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
<?php $this->load->view('admincp/layout/footer'); ?>