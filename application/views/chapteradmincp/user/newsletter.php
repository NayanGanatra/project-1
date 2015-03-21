<?php error_reporting(0);		

$this->load->view('chapteradmincp/layout/header'); 

?>

<div class="min_height">

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>



        <div class="dotted_line">

		        <h1>Newsletter <small>Manage</small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

            <th scope="col"><?php echo $this->lang->line('text_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_title');?></th>

            <th scope="col">Chapter</th>

			<th scope="col">Total</th>

			<th scope="col"><center><?php echo $this->lang->line('text_status');?><br/>(Sent/Total) </center></th>

            <th scope="col"><?php echo $this->lang->line('text_status');?></th>

           <th scope="col">Mail Status</th>

           <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col" width="30">Action</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="8"></td>

        </tr>

    </tfoot>

    <?php

		if ($query)

		{

		  

		   foreach ($query as $row)

		   {

	?>

    <tr>

        <td><?php echo date("Y-m-d",strtotime($row->created)); ?></td>

        <td><a href="<?php echo base_url('chapteradmincp/user/view_newsletter/'.$row->uid);?>" target="_blank"><?php echo $row->subject; ?></a></td>

        <?php

               

			$chapter = $this->dbadminheader->get_ch_to_newsletters($row->uid);

		

			$chaptername='';

			if($chapter)

			{

				foreach($chapter as $chapter_row)

	            {

					$chapter_name = $this->dbadminheader->get_chapter($chapter_row->ch_id);

					$chaptername .= $chapter_name->ch_name.',';

				}	

			}

            

        ?>

      

         <td ><?php if($chaptername){echo $chaptername; }?></td>

        <td><?php echo $this->dbadminheader->countAllNewsletterSubscriber($row->uid); ?></td>

		<!--<td><?php $tot_sub = $this->dbadminheader->countQueuedNewsletterSubscriber($row->uid); echo $tot_sub.'/'.$row->startNum; ?></td>-->

		<td><?php echo $row->startNum.'/'.$row->count_queue; ?></td>

         <td><?php if($row->newsletter_status == '0'){ echo 'Inactive'; }elseif($row->newsletter_status == '1'){ echo 'Active'; } ?></td>

        <td><!--<?php if($row->queued == 1){ echo 'Yes';}else{echo 'No';} ?>-->

		<?php 

					if($row->queued == 1) 

					{

						if($row->email_template_status  == 0 && $row->email_send  == 0 && $row->stop_mail  == 0)

						{?>

						  <a href="<?php echo base_url().'chapteradmincp/user/queue_mail/'.$row->uid;?>" title="send"><b>Send</b></a>

						<?php 

						}

						

						elseif($row->email_template_status  == 1 && $row->email_send  == 0 && $row->stop_mail  == 0)

						{?>

						  <a href="#" title="send"><b>Queue</b></a>

						<?php 							

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 1 && $row->stop_mail  == 1)

						{

						?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Stopped</a>

							</div>

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/user/start_mail/'.$row->uid;?>" ><center>start</center></a></div> 

							<div style="clear:both"></div>

							</div>

							<?php	

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 1 && $row->stop_mail  == 0)

						{

						?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Sending</a>

							</div>

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/user/stop_mail/'.$row->uid;?>" ><center>stop</center></a></div> 

							<div style="clear:both"></div>

							</div>

							<?php	

						}

						elseif($row->email_template_status  == 1 && $row->email_send  == 2 && $row->stop_mail  == 0)

						{?>

							<div  style="width:130px;" >

							<div  style="float:left; width:70px;" >

							<a  href="#" title="send">Failed</a>

							</div>

							<div  id="stop"  ><a href="<?php echo base_url().'chapteradmincp/user/resume_mail/'.$row->uid;?>" ><center>Resume</center></a></div> 

							<div style="clear:both"></div>

							</div>

						<?php

                        }

						

						

                }

                else

				{

					if($row->email_template_status  == 0 && $row->email_send  == 3 && $row->stop_mail  == 0)

						{?>

							<a  href="#" title="send">Complete</a>  

						<?php

                        }

						else

						{

					?>

                   <a style="display:none;" href="#" title="send"></a>

					<?php

						}

                }

                ?>

		</td>

		<?php

				$num_rec = $this->dbadminheader->count_chapter_for_newslatter($row->uid);

		?>

        <td><?php echo $row->newsletter_created_by; ?></td>

        <td><?php echo $row->newsletter_created_date; ?></td>

        <td><?php echo $row->newsletter_modified_by; ?></td>

        <td><?php echo $row->newsletter_modified_date; ?></td>

        <!--<td><a href="<?php echo base_url('chapteradmincp/user/edit_newsletter/'.$row->uid.'');?>" title="Edit"><i class="icon-edit"></i></a> 

        <a onclick="javascript: return del();" href="<?php echo base_url('chapteradmincp/user/delete_newsletter/'.$row->uid.'');?>" title="Delete"><i class="icon-minus-sign"></i></a></td>-->

		<td>

                <a  onclick="check_cron(<?php echo $row->uid;?>,'edit')" id="check_id_cron"  href="javascript:void(0)" title="Edit"><i class="icon-edit"></i></a> 

               

		        <a onclick="check_cron(<?php echo $row->uid;?>,'delete')"   href="javascript:void(0)" title="Delete"><i class="icon-minus-sign"></i></a></td>

    </tr>

    

		<?php

   }

}

else

{

	echo "<tr><td colspan='8'>No result found!!!</td></tr>";

}

?>

</table>



<?php echo $this->pagination->create_links(); ?>

</div>

	</td></tr></table>

</div>

<script>

function check_cron(uid,status)

{
$('div#custom_box').addClass("custom_box_css");

	$.ajax({

		  url: BASE_URI+"chapteradmincp/user/cron_check/"+uid,

		  success: function(data) {

$('div#custom_box').removeClass("custom_box_css");
					var str=data.split("|");

					if(str[0]==1 && str[1] ==0 &&  str[3] ==1 && (str[2] ==0 || str[2] ==1))

					{

						alert('     Please Wait\nEmails are Sending.');

					}

					else

					{

						if(status=='edit')

						{

						var url = "<?php echo base_url().'chapteradmincp/user/edit_newsletter/'?>"+uid;    

						$(location).attr('href',url);

						}

						else

						{

							var url = "<?php echo base_url().'chapteradmincp/user/delete_newsletter/'?>"+uid;    

						$(location).attr('href',url);

						}

						

					}

			}

		});	

}

</script>
<div id="custom_box" style="display:none">

					<div id="overlay">

						<div id="box_frame">

							<div id="box">

							<img src="<?php echo base_url(); ?>images/ajax-loader.gif" />

								<!--<div id="box_upper">

								</div>-->

							</div>

						</div>

					</div>

				</div>  
<?php $this->load->view('chapteradmincp/layout/footer'); ?>