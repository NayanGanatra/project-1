<?php $this->load->view('chapteradmincp/layout/header'); ?>

<div class="min_height" >

<div class="space10px"></div>



<table width="980" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>

		<div class="dotted_line">

		        <h1>Mass Email <small>Manage</small></h1>

		</div>

        <hr>

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

            <th scope="col"><?php echo $this->lang->line('text_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_subject');?></th>

            <th scope="col" >Chapter</th>

            <th scope="col"><center><?php echo $this->lang->line('text_status');?><br/>(Sent/Total)</center></th>

            <th style="display:none" scope="col">Queued</th>

             <th scope="col" width="200" >Mail Status</th>

             <th scope="col"><?php echo $this->lang->line('text_created_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_created_date');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_by');?></th>

            <th scope="col"><?php echo $this->lang->line('text_modified_date');?></th>

            <th scope="col" width="30">Action</th>

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="7"></td>

        </tr>

    </tfoot>

    <?php



		if ($query)

		{

			$i=0;

		  foreach ($query as $row)

		   {

			?>

		    <tr>

		        <td><?php echo date("Y-m-d",strtotime($row->created)); ?></td>

		        <td><?php echo $row->subject; ?></td>

                  <td ><?php $chapter = $this->dbadminheader->get_chapter($this->session->userdata('get_chapter_id')); if($chapter){echo $chapter->ch_name;}?></td>

		        <td><?php $tot_sub = $this->dbemail->countemailSubscribers($row->uid); echo $row->startNum.'/'.$tot_sub; ?></td>

		        <td style="display:none"><?php if($row->queued == 1){ echo 'Yes';}else{echo 'No';} ?></td>

                <td>

				<?php 

					if($row->queued == 1) 

					{

						if($row->email_template_status  == 0 && $row->email_send  == 0 && $row->stop_mail  == 0)

						{?>

						  <a href="<?php echo base_url().'chapteradmincp/email/queue_mail/'.$row->uid;?>" title="send"><b>Send</b></a>

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

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/email/start_mail/'.$row->uid;?>" ><center>start</center></a></div> 

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

							<div  id="stop" ><a href="<?php echo base_url().'chapteradmincp/email/stop_mail/'.$row->uid;?>" ><center>stop</center></a></div> 

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

							<div  id="stop"  ><a href="<?php echo base_url().'chapteradmincp/email/resume_mail/'.$row->uid;?>" ><center>Resume</center></a></div> 

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

                <td><?php echo $row->email_created_by; ?></td>

                <td><?php echo $row->email_created_date; ?></td>

                <td><?php echo $row->email_modified_by; ?></td>

                <td><?php echo $row->email_modified_date; ?></td>

		        <td>

                <a  onclick="check_cron(<?php echo $row->uid;?>,'edit')" id="check_id_cron"  href="javascript:void(0)" title="Edit"><i class="icon-edit"></i></a> 

               

		        <a onclick="check_cron(<?php echo $row->uid;?>,'delete')"   href="javascript:void(0)" title="Delete"><i class="icon-minus-sign"></i></a></td>

    </tr>

    

		<?php

		

		$i++;

   }

}

else

{

	echo "<tr><td colspan='6'>No result found!!!</td></tr>";

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

		  url: BASE_URI+"chapteradmincp/email/cron_check/"+uid,

		  success: function(data) {
					
					
					var str=data.split("|");

					if(str[0]==1 && str[1] ==0 &&  str[3] ==1 && (str[2] ==0 || str[2] ==1))

					{

						alert('     Please Wait\nEmails are Sending.');

					}

					else

					{

						if(status=='edit')

						{

						var url = "<?php echo base_url().'chapteradmincp/email/edit/'?>"+uid;    

						$(location).attr('href',url);

						}

						else

						{

							var url = "<?php echo base_url().'chapteradmincp/email/delete/'?>"+uid;    

						$(location).attr('href',url);

						}

						

					}
					$('div#custom_box').removeClass("custom_box_css");

			}
			

		});	

}

</script>

<style>

#stop

{

	width:60px;

	float:right;

}

#stop a

{

	width:60px;

	background-color: #0081C2;

    background-image: linear-gradient(to bottom, #fff, #bbb);

    background-repeat: repeat-x;

    color: #333333;

    display: block;

    font-weight: normal;

    line-height: 20px;

    padding-bottom: 3px;

    padding-left: 5px;

    padding-right: 5px;

    padding-top: 0px;

    white-space: nowrap;

}

#stop a:hover

{

	-moz-text-blink: none;

    -moz-text-decoration-color: -moz-use-text-color;

    -moz-text-decoration-line: none;

    -moz-text-decoration-style: solid;

    background-color: #0081C2;

    background-image: linear-gradient(to bottom, #0088CC, #0077B3);

    background-repeat: repeat-x;

    color: #FFFFFF;

}

</style>
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
	