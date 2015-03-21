<?php $this->load->view('admincp/layout/header'); ?>
<div class="space10px"></div>

<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 
  <tr>
  	<td>
    	<div class="dotted_line">
		        <h1>Polls <small>Edit Polls</small></h1>
		</div>
        <hr>
                <?php
                $form_attributes = array( 'id' => 'myform');
                echo form_open_multipart('', $form_attributes);
           		?>
                <div class="control-group <?php if(form_error('polls_question')){ echo "error";}?>">
                <label class="control-label">Poll Question</label>
                <div class="controls">
                <input class="input-xlarge" type="text" id="media_title" name="polls_question" placeholder="Poll Question" value="<?php echo $query[0][0]->poll_question; ?>">
                <span class="help-inline"> <?php echo form_error('polls_question'); ?></span>
                </div>
                </div>
                
                <div class="control-group <?php if(form_error('polls_type')){ echo "error";}?>">
            	<label class="control-label" for="inputError">Poll Type</label>
                 <div class="controls">
					<label class="control-label" for="inputError" style="float:left; margin-right:5px; color:#A3A3A3;">Radio</label>
                    <input type="radio" name="polls_type" style="float:left; margin-right:10px;" value="radio" <?php if($query[0][0]->poll_type=="radio"){?>checked=""<?php } ?> />
					<label class="control-label" for="inputError" style="float:left; margin-right:5px; color:#A3A3A3;">Checkbox</label>
					<input type="radio" name="polls_type"  style="float:left; margin-right:10px;" value="checkbox" <?php if($query[0][0]->poll_type=="checkbox"){?>checked=""<?php } ?> />
                    <span class="help-inline"><?php echo form_error('polls_type'); ?></span>
                </div>
           	 	</div>
                <br />
              	 <label class="control-label">Add Fields</label>
				 <div class="control-group <?php if(form_error('polls_field')){ echo "error";}?>">
				<?php 
				if($query[1])
				{
					foreach($query[1] as $fields)
					{?>
						<div class="controls addremove">
                		<input class="input-xlarge toclear" type="text" id="polls_title " disabled="disabled" name="polls_field" placeholder="Enter Field Name" value="<?php echo $fields->poll_field_name; ?>">
			   			 <span class="help-inline"> <?php echo form_error('polls_field'); ?></span>
              			</div>
					<?php }	
				}
				else
				{ ?>
				<div class="controls addremove">
            		<input class="input-xlarge toclear" type="text" id="polls_title " name="polls_field" placeholder="Enter Field Name" value="<?php echo $fields->poll_field_name; ?>">
			
					<a title="Add New Field" onclick="addNewField(this);">
					<i class="icon-edit" style="background-position:0 -96px;"></i>
					</a>
					<a title="Remove This Field" onclick="removeThisField(this);">
					<i class="icon-minus-sign"></i>
					</a>
			
           			 <span class="help-inline"> <?php echo form_error('polls_field'); ?></span>
              		</div>
				<?php }
				?>
 				<input type="button" name="addnew" title="Click here to add new field" value="Add New Fields" onclick="addNew(this);"/>
                </div>
                <div class="row">
                <div class="span11">
                <label class="control-label">Select Chapter</label>
                <table><tr>
                <?php
					$CheckedChap = array();
					foreach($query[2] as $Chap)
					{
						array_push($CheckedChap,$Chap->ch_id);
					}
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
                                    
                                     <input <?php if(in_array($chapter_row->ch_id,$CheckedChap)){echo 'checked="checked"'; }?>  type="checkbox" name="chapter[]" value="<?php echo $chapter_row->ch_id; ?>" />  <?php echo $chapter_row->ch_name; ?>
                            
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
				
			<div class="control-group ">
			<label class="control-label" for="inputError">Select Status</label>
			<div class="controls">
			<select style="width:112px;" name="poll_status">
			<option value="active" <?php if($query[0][0]->poll_status=="active"){ echo 'selected="selected"'; } ?>>Active</option>
			<option value="inactive" <?php if($query[0][0]->poll_status=="inactive"){ echo 'selected="selected"'; } ?>>Inactive</option>
			</select>
			<span class="help-inline"></span>
			</div>
			</div> 
			
			<div class="control-group ">
			<label class="control-label" for="inputError">Display As</label>
			<div class="controls">
			<select style="width:112px;" name="poll_display">
			<option value="counts" <?php if($query[0][0]->display=="counts"){ echo 'selected="selected"'; } ?> >Counts</option>
			<option value="percentage" <?php if($query[0][0]->display=="percentage"){ echo 'selected="selected"'; } ?>>Percentage</option>
			</select>
			<span class="help-inline"></span>
			</div>
			</div> 
			
                <div class="control-group">
                <div class="controls">
                <input type="submit" value="<?php echo $this->lang->line('btn_submit');?>" class="btn btn-large btn-primary" />
                </div>
                </div>
                
            
                <?php
			
		?>
        
		
</div>
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
function addNew(item)
{
	$(item).parent().append('<div class="controls addremove"><input class="input-xlarge toclear" type="text" id="polls_title " name="polls_fields[]" placeholder="Enter Field Name" value=""><a title="Add New Field" onclick="addNewField(this);"><i class="icon-edit" style="background-position:0 -96px;"></i></a><a title="Remove This Field" onclick="removeThisField(this);"><i class="icon-minus-sign"></i></a><span class="help-inline"> <?php echo form_error("polls_fields[]"); ?></span></div>');
}	
</script>
<?php $this->load->view('admincp/layout/footer'); ?>