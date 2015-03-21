<?php $this->load->view('header'); ?>
<script src='<?php echo base_url(); ?>js/nicEdit.js' type='text/javascript'></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<div class="container">
	<span class="span10">
	<h1 class="title"><?php echo $title;?></h1>
    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>
    </span>
    
    <div class="span3 offset sub_link" align="right">
    	<a class="btn" href="<?php echo base_url('ca/events.html'); ?>">Manage Events</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        

                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('page_title')){ echo "error";}?>">
                <label class="control-label">Page Title<em>*</em></label>
                <div class="controls">
                <input class="input-xxlarge" type="text" id="page_title" name="page_title" placeholder="Page Title" value="<?php echo $page->page_title; ?>">
                <span class="help-inline"><?php echo form_error('page_title'); ?></span>
                </div>
                </div>
                
                <div class="span5 nomargin">
                    <div class="control-group <?php if(form_error('sub_title')){ echo "error";}?>">
                    <label class="control-label">Sub Title</label>
                    <div class="controls">
                    <input class="input-xlarge" type="text" id="sub_title" name="sub_title" placeholder="Sub Title" value="<?php echo $page->sub_title; ?>">
                    <span class="help-inline"><?php echo form_error('sub_title'); ?></span>
                    </div>
                    </div>
                </div>
                
                <div class="span5">
                    <div class="control-group <?php if(form_error('page_menu_name')){ echo "error";}?>">
                    <label class="control-label">Menu Name</label>
                    <div class="controls">
                    <input class="input-xlarge" type="text" id="page_menu_name" name="page_menu_name" placeholder="Menu Name" value="<?php echo $page->page_menu_name; ?>">
                    <span class="help-inline"><?php echo form_error('page_menu_name'); ?></span>
                    </div>
                    </div>
                </div>
                
                <div class="control-group <?php if(form_error('page_content')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Page Content</label>
                <div class="controls">
                    <textarea style="width:100%; min-height:300px;"name="page_content" id="page_content"><?php echo $page->page_content; ?></textarea>
                    <span class="help-inline"><?php echo form_error('page_content'); ?></span>
                </div>
            	</div>
                
                <div class="span4 nomargin">
                    <div class="control-group <?php if(form_error('page_seo')){ echo "error";}?>">
                    <label class="control-label">URL Slug</label>
                    <div class="controls">
                    <input class="input-xlarge" type="text" id="page_seo" name="page_seo" placeholder="URL Slug" value="<?php echo $page->page_seo; ?>">
                    <span class="help-inline"><?php echo form_error('page_seo'); ?></span>
                    </div>
                    </div>
                 </div>
                
                <div class="span2">
                    <div class="control-group <?php if(form_error('page_order')){ echo "error";}?>">
                    <label class="control-label">Page Order</label>
                    <div class="controls">
                    <input class="input-small" type="text" id="page_order" name="page_order" placeholder="Page Order" value="<?php echo $page->page_order; ?>">
                    <span class="help-inline"><?php echo form_error('page_order'); ?></span>
                    </div>
                    </div>
                </div>
                
                    <div class="control-group <?php if(form_error('page_status')){ echo "error";}?>">
                    <label class="control-label" for="inputError"><?php echo $this->lang->line('text_status');?></label>
                    <div class="controls">
                        <select name="page_status" style="width:100px;">
                            <option <?php if($page->page_status == 1){echo 'selected="selected"'; }?> value="1">Active</option>
                            <option <?php if($page->page_status == 0){echo 'selected="selected"'; }?> value="0">Inactive</option>
                        </select>
                        <span class="help-inline"><?php echo form_error('page_status'); ?></span>
                    </div>
                    </div>

                <div class="span10 nomargin">
                    <div class="control-group">
                    <div class="controls">
                    <input type="hidden" name="page_ch_id" value="<?php echo $page->page_ch_id; ?>" />
                    <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                    </div>
                    </div>
                </div>

        
	</div>
</div>

<div class="span3" style=" margin-left:20px; margin-top:-20px;">
    <div class="sidebar">
        <?php $this->load->view('member_menu'); ?>
        <?php
		if($user->mm_type == 1)
		{
			$this->load->view('ca_menu');
		}
		?>
        <div class="space20px"></div>
        <?php $this->load->view('ads_panel'); ?>
    </div>
</div>

</div></div>

<?php $this->load->view('footer'); ?>