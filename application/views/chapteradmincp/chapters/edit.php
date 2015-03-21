<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="space10px"></div>

<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Chapter <small></small></h1>
		</div>
        <hr />
         <?php
                $form_attributes = array('class' => 'formA', 'id' => 'myform');
                echo form_open('', $form_attributes);
            ?>

            <div class="span3">
            <div class="control-group <?php if(form_error('ch_name')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Chapter Name</label>
                <div class="controls">
                    <input  disabled="disabled" type="text" id="ch_name" name="ch_name" value="<?php echo $get_page->ch_name; ?>">
                    <span class="help-inline"><?php echo form_error('ch_name'); ?></span>
                </div>
            </div>
            </div>
            
            <div class="span4">
            <div class="control-group <?php if(form_error('ch_seo')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Seo</label>
                <div class="controls">
                    <input disabled="disabled" type="text" id="ch_seo" name="ch_seo" value="<?php echo $get_page->ch_seo; ?>">
                    <span class="help-inline"><?php echo form_error('ch_seo'); ?></span>
                </div>
            </div>
            </div>
            
            <div class="control-group <?php if(form_error('ch_desc')){ echo "error";}?>">
            <label class="control-label" for="inputError">Chapter Description</label>
            <div class="controls">
                <textarea disabled="disabled" style="width:80%; min-height:200px;"name="ch_desc" id="ch_desc"><?php echo $get_page->ch_desc; ?></textarea>
                <span class="help-inline"><?php echo form_error('ch_desc'); ?></span>
            </div>
            </div>
            
            <div class="row" style="display:none">
            <div class="span11">
            <label class="control-label">Select States</label>
            <table><tr>
            <?php
				$states = $this->dbadminheader->states();
				$i = 0;
				foreach($states as $states_row)
				{
					if($i%6==0)
					{
						?>
                        </tr><tr>
                        <?php
					}
					?>
                    <td>
						<span class="span3">
                        <label class="checkbox">
                        <?php
						$check_busy_states = $this->dbchapters->check_busy_states_edit($states_row->state_id,$get_page->ch_id);
						if($check_busy_states) { ?>
                        <input disabled="disabled" <?php $ch_to_state = $this->dbchapters->ch_to_state($states_row->state_id,$get_page->ch_id); if($ch_to_state){echo 'checked="checked"'; }?>  type="checkbox" name="states[]" value="<?php echo $states_row->state_id; ?>" />  <?php echo $states_row->state_name; ?>
                        <?php } else { ?>
                        <input <?php $ch_to_state = $this->dbchapters->ch_to_state($states_row->state_id,$get_page->ch_id); if($ch_to_state){echo 'checked="checked"'; }?>  type="checkbox" name="states[]" value="<?php echo $states_row->state_id; ?>" />  <?php echo $states_row->state_name; ?>
                        <?php } ?>
                        </label>

                        </span>
                    </td>
                    <?php
				$i++;
				}
			?>
            </tr></table>
            </div>
            </div>
            <div class="row">
            <div class="span11">
            <label class="control-label">States</label>
            <table><tr>
            <?php
				$states = $this->dbadminheader->states();
				$i = 0;
				foreach($states as $states_row)
				{
					if($i%6==0)
					{
						?>
                        </tr><tr>
                        <?php
					}
					?>
                  		
                        <?php
						$ch_to_state = $this->dbchapters->ch_to_state($states_row->state_id,$get_page->ch_id); 
						if($ch_to_state)
						{?>
                         <td>
                         <span class="span3">
                        <label class="checkbox">
						<input disabled="disabled" checked="checked" type="checkbox" name="states1[]" value="<?php echo $states_row->state_id; ?>" />  <?php echo $states_row->state_name; ?>
                         </label>

                        </span>
                        </td>
                        <?php 
						$i++;
						} ?>
        			 
                    
                    <?php
				
				}
			?>
            </tr></table>
            </div>
            </div>
            
            <div class="space20px"></div>
            <input type="hidden" name="ch_id" value="<?php echo $get_page->ch_id; ?>" />
			<input type="button" onclick="goBack()" value="<?php echo $this->lang->line('btn_back');?>" class="btn" />

	</td>
  </tr>
</table>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>
<script>
function goBack()
  {
  window.history.back()
  }
</script>