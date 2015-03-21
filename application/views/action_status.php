<?php
if ($this->session->flashdata('message_type') == "success")
	{ 
		?>
		<div class="alert alert-success"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	
	} 
	if ($this->session->flashdata('message_type') == "error")
	{ 
		?>
		<div class="alert alert-error"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	}
	if ($this->session->flashdata('message_type') == "info")
	{ 
		?>
		<div class="alert alert-info"><?php echo $this->session->flashdata('status_');?></div>
		<?php
	} 

?>