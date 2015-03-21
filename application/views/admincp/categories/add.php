<?php $this->load->view('admincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1><?php echo $this->lang->line('text_categories');?> <small><?php echo $this->lang->line('text_add_category');?></small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            
            <div class="control-group <?php if(form_error('covers_cat_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_category_name');?></label>
                <div class="controls">
                    <input type="text" id="covers_cat_name" name="covers_cat_name" value="<?php echo set_value('covers_cat_name'); ?>">
                    <span class="help-inline"><?php echo form_error('covers_cat_name'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('covers_cat_seo')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_slug');?></label>
                <div class="controls">
                    <input type="text" id="covers_cat_seo" name="covers_cat_seo" value="<?php echo set_value('covers_cat_seo'); ?>">
                    <span class="help-inline"><?php echo form_error('covers_cat_seo'); ?></span>
                </div>
            </div>
            
            <div class="control-group <?php if(form_error('covers_cat_order_by')){ echo "error";}?>">
            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_order');?></label>
                <div class="controls">
                    <input class="input-mini" type="text" id="covers_cat_order_by" name="covers_cat_order_by" value="<?php echo set_value('covers_cat_order_by'); ?>">
                    <span class="help-inline"><?php echo form_error('covers_cat_order_by'); ?></span>
                </div>
            </div>
			<input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('admincp/layout/footer'); ?>