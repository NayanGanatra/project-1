<?php 

	$login = $this->session->userdata('user_email');
	$data['user'] = $this->dbheader->user_details($login);
	
if(count($newsletters) != 0)
{
	if(count($newsletters_for_login) > 0)
	{
?>
        <div class="bs-docs-sidebar bs-docs-sidenav add-border" style="display:none">
        <ul class="nav nav-list bs-docs-sidenav" style="box-shadow:0 0 !important;">
<?php } else { ?>
<div class="bs-docs-sidebar bs-docs-sidenav add-border">
<ul class="nav nav-list bs-docs-sidenav" style="box-shadow:0 0 !important;">
<?php } ?>  
<?php
	
$form_attributes = array('class' => 'formA', 'id' => 'myform');
?>
<form method="post" action="<?php echo base_url().'submit_newsletter'; ?>" >
<?php			
	if(is_array($newsletters))
	{	
		foreach($newsletters as $get_newsletter_row)
		{
				//	$data['check_email'] = $this->dbchapter->latesr_check_email($get_newsletter_row->uid);
				//	var_dump($data['check_email']);
			if($get_newsletter_row->subject !='' && $get_newsletter_row->newsletter_status !=0)
			{
				if(!$login)
				{
?>
					<h3 style="font-size:22px;"><li class="title">Subscribe NewsLetter </li></h3>
					<div class="space10px"></div> 
					<span style="float:left;">
					<?php echo $get_newsletter_row->subject; ?></span><br />
					<div class="space10px"></div>			 
	            	<div class="control-group <?php if(form_error('ns_email')){ echo "error";}?>">
	             
	            	<label class="control-label" for="inputError"><?php echo $this->lang->line('text_ns_email');?>
					</label>
	                	<div class="controls">
	                    	<input type="text" id="ns_email" name="ns_email" placeholder="Enter your Email id" 
							value="<?php echo set_value('ns_email'); ?>">
	                    
	                    	<span class="help-inline"><?php echo form_error('ns_email'); ?></span>
	            		</div>
	         		</div>
				
	        		<input type="submit" value="<?php echo $this->lang->line('btn_subscribe');?>" 
					class="btn" name="submit" />
						
	<?php		}
				else
				{
					$data['check'] = $this->dbchapter->
					latesr_check($get_newsletter_row->uid,$login);
					if($data['check'] == 0)
					{
					?>
						<h3 style="font-size:22px;"><li class="title">Subscribe NewsLetter </li></h3>
						<div class="space10px"></div>
						<span style="float:left;"><?php echo $get_newsletter_row->subject; ?></span><br />
						<div class="space10px"></div>
						<input type="submit" value="<?php echo $this->lang->line('btn_subscribe');?>" 
						class="btn" name="submit" />
					<?php	
					}
				}
			}
							
		}
	}
?>
	<input type="hidden" name="hdnch_id" value="<?php echo $chapter->ch_id; ?>">
	<input type="hidden" name="hdnchapter" value="<?php echo $this->uri->segment(2);?>">
    </form>          
</ul>
</div>

<?php 
} ?>
