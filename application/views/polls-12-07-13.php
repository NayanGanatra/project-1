<?php
error_reporting(0);
$pollData = $this->dbheader->get_polls($chapter_id);

?>
<div class="bs-docs-sidebar">
<?php

for($count=0;$count<count($pollData);$count++)
{
	if(is_array($pollData[$count]))
	{
		if($pollData[$count][0][0]->poll_type=="radio"){
			?>
			<form name="frm" method="post" action="<?php echo base_url().'submit_poll'; ?>" style="border:1px solid #E5E5E5; border-radius:6px; padding:10px;">
			<span style="color:#999999;"><?php echo $pollData[$count][0][0]->poll_question; ?></span>
			<br />
			<?php
			for($fieldCount=0;$fieldCount<count($pollData[$count][1]);$fieldCount++)
				{?>
				
				<div style="margin-top:10px;">
				<span><?php echo $pollData[$count][1][$fieldCount]->poll_field_name; ?></span>
				<?php
				if($pollData[$count][0][0]->display=="counts")
				{
					$polls = $pollData[$count][1][$fieldCount]->field_count;
				}
				else
				{
					$temp = 0;
					for($fC=0;$fC<count($pollData[$count][1]);$fC++)
					{
						$temp += $pollData[$count][1][$fC]->field_count;
					}
					$polls = (int)((($pollData[$count][1][$fieldCount]->field_count)*(100))/$temp);
					if(empty($polls))
					{
						$polls = 0;
					}
					$polls .='%';
				}
				?>
				<span>(<?php echo $polls; ?>)</span>
				<input type="radio" name="fields[]" value="<?php echo $pollData[$count][1][$fieldCount]->poll_field_id; ?>" style="margin-top:-2px;"/>
				</div>
				
				<?php
				} ?>
			<input type="hidden" name="hdnpollid" value="<?php echo $pollData[$count][0][0]->poll_id; ?>"/>
			<input type="hidden" name="hdnchapter" value="<?php echo $this->uri->segment(2);?>"/>
			<input type="submit" value="submit" name="submit" class="btn btn-large btn-primary" style="margin-top:10px;"/>
			</form>
			<?php
		}
		else
		{
			?>
			<form name="frm" method="post" action="<?php echo base_url().'submit_poll'; ?>" style="border:1px solid #E5E5E5; border-radius:6px; padding:10px;">
			<span style="color:#999999;"><?php echo $pollData[$count][0][0]->poll_question; ?></span>
			<?php
			for($fieldCount=0;$fieldCount<count($pollData[$count][1]);$fieldCount++)
				{?>
				<div style="margin-top:10px;">
				<span><?php echo $pollData[$count][1][$fieldCount]->poll_field_name; ?></span>
				<?php
				if($pollData[$count][0][0]->display=="counts")
				{
					$polls = $pollData[$count][1][$fieldCount]->field_count;
				}
				else
				{
					$temp = 0;
					for($fC=0;$fC<count($pollData[$count][1]);$fC++)
					{
						$temp += $pollData[$count][1][$fC]->field_count;
					}
					$polls = (int)((($pollData[$count][1][$fieldCount]->field_count)*(100))/$temp);
					if(empty($polls))
					{
						$polls = 0;
					}
					$polls .='%';
				}
				?>
				<span>(<?php echo $polls; ?>)</span>
				<input type="checkbox" name="fields[]" value="<?php echo $pollData[$count][1][$fieldCount]->poll_field_id; ?>" style="margin-top:-2px;"/>
				</div>
				<?php
				} ?>
			<input type="hidden" name="hdnpollid" value="<?php echo $pollData[$count][0][0]->poll_id; ?>"/>
			<input type="hidden" name="hdnchapter" value="<?php echo $this->uri->segment(2);?>"/>
			<input type="submit" value="submit" name="submit" class="btn btn-large btn-primary" style="margin-top:10px;"/>
			</form>
			<?php
		}
		
	}
}
?>
</div>