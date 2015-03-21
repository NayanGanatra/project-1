<?php $this->load->view('admincp/layout/header'); ?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_static_pages');?> <small><?php echo $this->lang->line('text_edit_page');?></small></h1>
		</div>
        <hr />
         	<?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>
            
            <div class="control-group <?php if(form_error('page_menu_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_menu_name');?></label>
                <div class="controls">
                    <input class="input-xlarge" type="text" id="page_menu_name" name="page_menu_name" value="<?php echo $get_page->page_menu_name; ?>">
                    <span class="help-inline"><?php echo form_error('page_menu_name'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('page_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_page_title');?></label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="page_title" name="page_title" value="<?php echo $get_page->page_title; ?>">
                    <span class="help-inline"><?php echo form_error('page_title'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('sub_title')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Sub Title</label>
                <div class="controls">
                    <input class="input-xxlarge" type="text" id="sub_title" name="sub_title" value="<?php echo $get_page->sub_title; ?>">
                    <span class="help-inline"><?php echo form_error('sub_title'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('page_content')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_content');?></label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;"name="page_content" id="page_content"><?php echo $get_page->page_content; ?></textarea>
                    <span class="help-inline"><?php echo form_error('page_content'); ?></span>
                </div>
            </div>
            
            <input type="hidden"  name="page_sub_id" value="0" />
            
            <div class="control-group <?php if(form_error('page_seo')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_slug');?></label>
                <div class="controls">
                    <input type="text" id="page_seo" name="page_seo" value="<?php echo $get_page->page_seo; ?>">
                    <span class="help-inline"><?php echo form_error('page_seo'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('page_order')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>
                <div class="controls">
                    <input style="width:90px;" type="text" id="page_order" name="page_order" value="<?php echo $get_page->page_order; ?>">
                    <span class="help-inline"><?php echo form_error('page_order'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('page_status')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                <div class="controls">
                    <select name="page_status" style="width:100px;">
					<?php if($get_page->page_status == '0')
                        {
                        ?>
                        <option selected="selected" value="0"><?php echo $this->lang->line('misc_deactive');?></option>
                        <option value="1"><?php echo $this->lang->line('misc_active');?></option>
                        <?php
                        }
                        else
                        {
                        ?>
                        <option value="0"><?php echo $this->lang->line('misc_deactive');?></option>
                        <option selected="selected" value="1"><?php echo $this->lang->line('misc_active');?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <span class="help-inline"><?php echo form_error('page_status'); ?></span>
                </div>
            </div>
            
            <?php date_default_timezone_set("Asia/Kolkata"); ?>
            <input type="hidden" id="" name="page_created_date" value="<?php echo $get_page->page_created_date; ?>">
            <input type="hidden" id="" name="page_created_by" value="<?php echo $get_page->page_created_by; ?>">
            <input type="hidden" id="" name="page_modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" id="" name="page_modified_by" value="<?php echo 'admin';?>">
            <input type="submit" value="<?php echo $this->lang->line('btn_save_changes');?>" class="btn" />
	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>