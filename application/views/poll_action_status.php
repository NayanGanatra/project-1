<?php
	if ($this->session->flashdata('message_type') == "pollsuccess")
	{ 
		?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	
	} 
	if ($this->session->flashdata('message_type') == "polllogin")
	{ 
		?>
		<div class="alert alert-error"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	}
	if ($this->session->flashdata('message_type') == "pollsubmitted")
	{ 
		?>
		<div class="alert alert-error"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	} 

?>