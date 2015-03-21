<?php $this->load->view('header'); ?>



<div class="container">

	<span class="span6">

	<h1 class="title"><?php echo $title;?></h1>

    <?php if(isset($sub_title)) { ?><div class="sub_title"><?php echo $sub_title;?></div><?php } ?>

    </span>

    

    <div class="span8" align="right">

    	<?php $this->load->view('action_status'); ?>

            <?php

                $form_attributes = array( 'id' => 'myform','class' => 'member_search', 'method' => 'GET');

                echo form_open('members/search/', $form_attributes);

            ?>



            <div class="control-group <?php if(form_error('keywords')){ echo "error";}?>" style="margin-top: 20px;">

            <div class="controls" >

            <input class="input-xlarge" type="text" id="keywords" name="keywords" placeholder="Search by Name, Surname, Phone, Email" value="<?php echo $this->input->get('keywords');?>">

            <span class="help-inline" style="margin-top:-10px;"><input type="submit" value="Search" class="btn btn-primary" /></span>

            </div>

            </div>

            

        </form>

    </div>

</div>



<hr class="header_hr"/>



<div class="container">

<table border="0" cellspacing="2" cellpadding="2" width="100%" class="table table-hover">

    <thead>

        <tr>

        	

            <th scope="col"><?php echo $this->lang->line('text_name');?></th>

            <th scope="col">Date Of Birth</th>

            <th scope="col">State</th>
            
            <th scope="col">City</th>

            

        </tr>

    </thead>

    <tfoot>

    	<tr>

        	<td colspan="4"></td>

        </tr>

    </tfoot>
    <?php
		if($query)
		{
			foreach($query as $row)
			{
				
    			$city_name = $this->dbmembers->get_city_name($row->mm_city_id);
				
        ?>        
				<tr>
                    <td><p class="nomargin"><a href="<?php echo base_url('profile/'.$row->mm_username.''); ?>"><?php echo $row->mm_fname.' '.$row->mm_lname; ?></a></p></td>
                    <td><?php if($row->mm_disp_birth == '1'){ echo $row->mm_birth_month.'/'.$row->mm_birth_year; }else { echo "";} ?></td>
                    <td><?php if(isset($row->state_name)){echo $row->state_name;} ?></td>
                    <td><?php if(isset($city_name)){ foreach($city_name as $city_row){ echo $city_row->city_name;}} ?></td>
                </tr>
    <?php            
			}
		}
	
	?>
    
</table>
<?php echo $this->pagination->create_links(); ?>    
</div>

<div class="space20px"></div>

<?php $this->load->view('footer'); ?>