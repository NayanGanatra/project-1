<?php $this->load->view('chapteradmincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Polls <small>Add Poll</small></h1>
		</div>
        <hr>

        
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('polls_question')){ echo "error";}?>">
                <label class="control-label">Poll Question</label>
                <div class="controls">
                <input class="input-xlarge" type="text" id="polls_title" name="polls_question" placeholder="Polls Question" value="<?php echo set_value('polls_question'); ?>">
                <span class="help-inline"> <?php echo form_error('polls_question'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('polls_type')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Poll Type</label>
                <div class="controls">
					<label class="control-label" for="inputError" style="float:left; margin-right:5px; color:#A3A3A3;">Radio</label>
                    <input type="radio" name="polls_type" style="float:left; margin-right:10px;" value="radio"/>
					<label class="control-label" for="inputError" style="float:left; margin-right:5px; color:#A3A3A3;">Checkbox</label>
					<input type="radio" name="polls_type"  style="float:left; margin-right:10px;" value="checkbox"/>
                    <span class="help-inline"><?php echo form_error('polls_type'); ?></span>
                </div>
           	 	</div>
 
 				<br />
                <label class="control-label">Add Fields</label>
				
 				<div class="control-group <?php if(form_error('polls_fields[]')){ echo "error";}?>">
				
				
				
				
                <div class="controls addremove">
                <input class="input-xlarge toclear" type="text" id="polls_title " name="polls_fields[]" placeholder="Enter Field Name" value="<?php echo set_value('polls_fields[]'); ?>">
				
				<a title="Add New Field" onclick="addNewField(this);">
				<i class="icon-edit" style="background-position:0 -96px;"></i>
				</a>
				<a title="Remove This Field" onclick="removeThisField(this);">
				<i class="icon-minus-sign"></i>
				</a>
				
                <span class="help-inline"> <?php echo form_error('polls_fields[]'); ?></span>
                </div>
				</div>
				
				<div class="control-group <?php if(form_error('polls_fields[]')){ echo "error";}?>">
				<div class="controls addremove">
                <input class="input-xlarge toclear" type="text" id="polls_title" name="polls_fields[]" placeholder="Enter Field Name" value="<?php echo set_value('polls_fields[]'); ?>">
				
				<a title="Add New Field" onclick="addNewField(this);">
				<i class="icon-edit" style="background-position:0 -96px;"></i>
				</a>
				<a title="Remove This Field" onclick="removeThisField(this);">
				<i class="icon-minus-sign"></i>
				</a>
				
                <span class="help-inline"> <?php echo form_error('polls_fields[]'); ?></span>
                </div>
                </div>
				
				
              
                
                
               <!--
                <div class="control-group <?php if(form_error('polls_ch_id')){ echo "error";}?>" style="display:none">
            	<label class="control-label" for="inputError">Chapter ID</label>
                <div class="controls">
                    <select name="polls_ch_id" id="polls_ch_id">
                    	<?php
						$get_chapters = $this->dbadminheader->get_chapters();
						foreach($get_chapters as $get_chapters_row)
						{
							?>
                            <option <?php if($get_chapters_row->ch_id == set_value('polls_ch_id')){echo 'selected="selected"'; }?> value="<?php echo $get_chapters_row->ch_id; ?>"><?php echo $get_chapters_row->ch_name; ?></option>
                            <?php
						}
						?>
                        
                    </select>
                    <span class="help-inline"><?php echo form_error('polls_type'); ?></span>
                </div>
           	 	</div>
                  <div class="space10px"></div>   
             <div class="row">
            <div class="span11">
            <label class="control-label">Select Chapter</label>
            <table><tr>
            <?php
				$chapter = $this->dbadminheader->get_chapters();
				$i = 0;
				foreach($chapter as $chapter_row)
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
                                <input type="checkbox"  name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
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
            
                -->
			<div class="control-group ">
			<label class="control-label" for="inputError">Select Status</label>
			<div class="controls">
			<select style="width:112px;" name="poll_status">
			<option value="active">Active</option>
			<option value="inactive" selected="selected">Inactive</option>
			</select>
			<span class="help-inline"></span>
			</div>
			</div> 
			
			<div class="control-group ">
			<label class="control-label" for="inputError">Display As</label>
			<div class="controls">
			<select style="width:112px;" name="poll_display">
			<option value="counts" >Counts</option>
			<option value="percentage" selected="selected">Percentage</option>
			</select>
			<span class="help-inline"></span>
			</div>
			</div> 
			
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
         
        
		
</form>
	</td></tr></table>
<script type="text/javascript">
function removeThisField(item)
{
	if($(".addremove").length==2)
	{
		alert("Minimum two field are required");
	}
	else
	{
		$(item).parent(".addremove").remove();	
	}
}
function addNewField(item)
{
	$(item).parent(".addremove").after($(item).parent(".addremove").clone());
	$(item).parent(".addremove").next(".addremove").children(".toclear").val("");
}	
</script>
<?php $this->load->view('chapteradmincp/layout/footer'); ?>