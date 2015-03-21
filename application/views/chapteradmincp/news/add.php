<?php $this->load->view('chapteradmincp/layout/header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>News <small>Add News</small></h1>
		</div>
        <hr />
        
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('news_title')){ echo "error";}?>">
                <label class="control-label">News Title</label>
                <div class="controls">
                <input class="input-xxlarge" type="text" id="news_title" name="news_title" placeholder="News Title" value="<?php echo set_value('news_title'); ?>">
                <span class="help-inline"><?php echo form_error('news_title'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('news_content')){ echo "error";}?>">
            	<label class="control-label" for="inputError">News Content</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;"name="news_content" id="news_content"><?php echo set_value('news_content'); ?></textarea>
                    <span class="help-inline"><?php echo form_error('news_content'); ?></span>
                </div>
            	</div>
                
                <div class="control-group <?php if(form_error('news_create')){ echo "error";}?>">
                <label class="control-label">Date</label>
                <div class="controls">
                <input class="input-large" type="text" id="datetimepicker" name="news_create" placeholder="Date" value="<?php echo set_value('news_create'); ?>">
                <span class="help-inline"><?php echo form_error('news_create'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('news_ch_id')){ echo "error";}?>" style="display:none">
                <label class="control-label">Chapter</label>
                <div class="controls">
                	<select name="news_ch_id">
                        <?php
							$chapters = $this->dbadminheader->get_chapters();
							foreach($chapters as $chapters_row)
							{
								if(set_value('news_ch_id') == $chapters_row->ch_id)
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
                        <option <?php if(set_value('news_status') == '1'){echo 'selected="selected"'; }?> value="1">Active</option>
                        <option <?php if(set_value('news_status') == '0'){echo 'selected="selected"'; }?> value="0">Deactive</option>
                    </select>
                    <span class="help-inline"><?php echo form_error('news_status'); ?></span>
                </div>
            	</div>
                
                <div class="control-group">
                <div class="controls">
                <?php date_default_timezone_set("Asia/Kolkata"); ?>	
                <input type="hidden" id="" name="news_created_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
                <?php 
                    $get_username = $this->dbadminheader->get_username($this->session->userdata('username'));
                    
                    foreach($get_username as $username)
                    {		
                ?>
                        <input type="hidden" id="" name="news_created_by" value="<?php echo $username->mm_username;?>">
                <?php
                    }
                ?>
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
                

	</td>
  </tr>
</table>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>