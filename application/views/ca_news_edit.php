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
    	<a class="btn" href="<?php echo base_url('ca/news.html'); ?>">Manage News</a>
    </div>
</div>

<hr class="header_hr"/>

<div class="container">
	<div class="row">

<div class="span10 nomargin">
	<div class="page_content">
		<?php $this->load->view('action_status'); ?>
        
        <?php
			if($query)
			{
				?>
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('news_title')){ echo "error";}?>">
                <label class="control-label">News Title</label>
                <div class="controls">
                <input class="input-xlarge" type="text" id="news_title" name="news_title" placeholder="News Title" value="<?php echo $query->news_title; ?>">
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
                
            
                <?php
			}
			else
			{
				$this->session->set_flashdata('message_type', 'error');
				$this->session->set_flashdata('status_', 'You are not authorize to view this page.');
				redirect(base_url('user/account.html'));
			}
		?>
        
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