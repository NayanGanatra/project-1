<script>
function goBack()
  {
  window.history.back()
  }
</script>
<?php //$this->load->view('admincp/layout/header'); ?>
<h1>Unauthorised Access</h1>
<a href="#" onclick="goBack()"><?php echo $this->lang->line('btn_back');?></a>
<?php //$this->load->view('admincp/layout/footer'); ?>