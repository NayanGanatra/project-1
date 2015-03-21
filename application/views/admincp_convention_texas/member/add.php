<?php $this->load->view('admincp_convention_texas/layout/header'); ?>

<style>
.stContainer
{
	height:520px  !important;
	min-height:520px !important;
	overflow-y:scroll;
}
.tbl_class
{
	width:94%   !important;
		
}
.tabContent{
	height:500px  !important;
	min-height:500px !important;
	width: 96%;
    overflow-y: scroll;
}
.container{
	width: 96%   !important;
}

</style>
<center style=" padding:12px 20px 20px 20px; ">
<div>
<div id="tabs" style="width:100%;height:10px !important;">
      <ul>
        <li><a href="#tabs-1">Fees<br />
          <small>structure</small> </a></li>
        <li><a href="#tabs-2">Registration<br />
          <small>Form</small> </a></li>
        <li><a href="#tabs-3">Membership<br />
          <small>Form</small> </a></li>
        <li><a href="#tabs-4">Program<br />
          <small>Entry Form</small></a></li>
        <li><a href="#tabs-5">Event<br />
          <small>Form</small> </a></li>
        <li><a href="#tabs-6">Medical<br />
          <small> Release Form</small> </a></li>
      </ul>
      <div id="tabs-1" >
      <?php	$this->load->view('admincp_convention_texas/fees/add'); ?>
      </div>
      <div id="tabs-2" >
      <?php	$this->load->view('admincp_convention_texas/form/add'); ?>
      
      </div>
      <div id="tabs-3" >
      Membership form
      <?php	//$this->load->view('admincp_convention_texas/fees/add'); ?>
      </div>
      <div id="tabs-4" >
      <?php	$this->load->view('admincp_convention_texas/program/add'); ?>
      </div>
      <div id="tabs-5" >
      <?php	$this->load->view('admincp_convention_texas/events/add'); ?>
      </div>
      <div id="tabs-6" >
      Medical Release form
      <?php	//$this->load->view('admincp_convention_texas/fees/add'); ?>
      </div>
</div>
</div>
</center>                 