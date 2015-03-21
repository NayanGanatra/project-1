<?php $this->load->view('admincp_convention/layout/header');
if(isset($date_array))
{
	$newArray = array_count_values($date_array);
	$key_array = array();
	$value_array = array();
	foreach ($newArray as $key => $value) {
				array_push($key_array,$key);
				array_push($value_array,$value);
				
		}
		$js_key = json_encode($key_array);
		$js_value = json_encode($value_array);
		
		
}
if(isset($date_array_member))
{
	$newArray_member = array_count_values($date_array_member);
	$key_array_member = array();
	$value_array_member = array();
	foreach ($newArray_member as $key => $value) {
				array_push($key_array_member,$key);
				array_push($value_array_member,$value);
				
		}
		
		$js_value_member = json_encode($value_array_member);
		
		
}
if(isset($date_array_event))
{
	$newArray_event = array_count_values($date_array_event);
	$key_array_event = array();
	$value_array_event = array();
	foreach ($newArray_event as $key => $value) {
				array_push($key_array_event,$key);
				array_push($value_array_event,$value);
				
		}
		$js_key_event = json_encode($key_array_event);
		$js_value_event = json_encode($value_array_event);
}
if(isset($date_array_event_member))
{
	$newArray_event_member = array_count_values($date_array_event_member);
	$key_array_event_member = array();
	$value_array_event_member = array();
	foreach ($newArray_event_member as $key => $value) {
				array_push($key_array_event_member,$key);
				array_push($value_array_event_member,$value);
				 
		}
		
		$js_value_event_member = json_encode($value_array_event_member);
}
?>
<script src='<?php echo base_url(); ?>js/jquery.js' type='text/javascript'></script>
<script src="<?php echo base_url(); ?>js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>js/exporting.js"></script>
<script>
function check(test){
if(test == "registration"){
reg();
}
if(test == "event"){
even();
}
}
function reg(){
var cat_reg = <?php echo $js_key ?>;
var series_reg = <?php echo $js_value ?>;
var series_member = <?php echo $js_value_member ?>;

$('#chart_div').highcharts({
            chart: {
                type: 'spline',
				//width:
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'Month'
                },
                categories: cat_reg
            },
            yAxis: {
               title: {
                    text: 'value'
                },
				
                /*plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]*/
				min: 0
            },
            tooltip: {
                 valueSuffix: ''
            },
            
             series: [{
                name: 'Reg',
                data: series_reg
				},
				{
                name: 'Member',
                data: series_member
            
            }]
        });
}


</script>
<script>
function even(){
			
var cat_event = <?php echo $js_key_event ?>;
var series_event = <?php echo $js_value_event ?>;
var series_event_member = <?php echo $js_value_event_member ?>;

$('#chart_div').highcharts({
            chart: {
                type: 'spline',
				//width:
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                title: {
                    text: 'Month'
                },
                categories: cat_event
            },
            yAxis: {
               title: {
                    text: 'value'
                },
				
                /*plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]*/
				min: 0
            },
            tooltip: {
                 valueSuffix: ''
            },
            
             series: [{
                name: 'Event',
                data: series_event
				},
				{
                name: 'Member',
                data: series_event_member
            
            }]
        });
}
</script>



<div class="space10px"></div>



<table width="1020" border="0" cellspacing="0" cellpadding="0" align="center" style="min-height:300px;"> 

  <tr>

  	<td>
              
<div class="dotted_line">

        	<span class="span8">

		         <h1>Dashboard <small><?php //echo $tot_rec; //$this->dbuser->count_user();?></small></h1>

            </span>

            <div class="span5 offset sub_link" align="right">

            	<?php

                $form_attributes = array('class' => 'formA', 'id' => 'myform','style'=>'margin:0px;', 'method'=>'post');

                echo form_open(base_url() . 'admincp_convention/dashboard/view', $form_attributes);

				?>
					
			</div>
            
            <div >
                    		

                        <a href="<?php echo base_url('admincp_convention/convention_detail/view');?>" id="exportexcel" style="width:200px;float:right;" class="dropdown-toggle" >Registration Detail</a>

                        

                      
           </div>
            

        <hr>

<table border="1" style="margin: 10px 0px 0px 0px; width:70%; border:#000 1px solid;" class="table">

    

        	<tr style="background:linear-gradient(#ACABAB, #8F8E8E) repeat scroll 0 0 transparent;color:#FFF">
			<th style="text-align:left;">Convention Dashboard</th>
			<td></td>
			</tr>
			
			<tr class="error">
            <td>Total registration </td>
			<td><?php echo count($total_reg); ?></td>
			</tr>	
			
			<tr class="info">
            <td>Total member to attend convention</td>
			<td><?php echo count($total_member); ?></td>
			</tr>
            
            <tr class="error">
            <td>Total event registration </td>
			<td><?php echo count($total_event); ?></td>
			</tr>

    		<tr class="info">
            <td>Total member to attend event</td>
			<td><?php echo count($total_member_to_event); ?></td>
			</tr>
            
            <tr class="error">
            <td>Total program registration </td>
			<td><?php echo $total_program; ?></td>
			</tr>

   			<tr class="info">
            <td>Total partcipant of program</td>
			<td><?php echo $total_participant_to_program; ?></td>
			</tr>
            
            <tr class="error">
            <td>Total medical registration </td>
			<td><?php echo $total_medical; ?></td>
			</tr>
            

</table>
<div class="space20px"></div>
<div><span><strong>Registration and Event Chart:</strong></span>
	<span style="margin-left:10px;"><select id="chart" name="chart" onchange="check(this.value);">
    		<option>Please select</option>
            <option value="registration">Registration</option>
            <option value="event">Event</option>
            </select></span></div>
            <div class="space20px"></div>
	<div id="chart_div" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
    
</div>

	</td></tr></table>
<style>
 .table th, .table td
 {
 	line-height:20px;
 }
</style>

<?php $this->load->view('admincp_convention/layout/footer'); ?>

