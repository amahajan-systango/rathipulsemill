<?php echo $this->Html->css('jquery-ui');?>
<?php echo $this->Html->script('jquery-1.7.2');?>
<?php echo $this->Html->script('jquery-ui');?>
<?php echo $this->Html->script('jquery.timePicker');?>
<?php echo $this->Html->script('jquery.validate');?>

<style>
	.ui-widget {
		font-family: Verdana,Arial,sans-serif;
		font-size: 14px !important;
	}
	#time_pic {
		width: 70px;
	}
	div.time-picker {
	  position: absolute;
	  height: 191px;
	  width:4em; /* needed for IE */
	  overflow: auto;
	  background: #fff;
	  border: 1px solid #aaa;
	  z-index: 99;
	  margin: 0;
	}
	div.time-picker-12hours {
	  width:6em; /* needed for IE */
	}
	
	div.time-picker ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	div.time-picker li {
	  cursor: pointer;
	  height: 10px;
	  font: 12px/1 Helvetica, Arial, sans-serif;
	  padding: 4px 3px;
	}
	div.time-picker li.selected {
	  background: #0063CE;
	  color: #fff;
	}
	.ui-datepicker-trigger{
		cursor: pointer;
	}

</style>
  <script type="text/javascript">
  $(function() {
		
		// 02.00 AM - 03.30 PM, 15 minutes steps.
		$("#time_pic").timePicker({
			startTime: "00.00",  // Using string. Can take string or Date object.
			endTime: new Date(0, 0, 0, 23, 55, 0),  // Using Date object.
			show24Hours: false,
			separator:'.',
			step: 05
		});
		
  });
  </script>
 <script>
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "button",
            buttonImage: "<?=SITE_URL?>/images/calendar.gif",
            buttonImageOnly: true,
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
			
        });
        $( "#to" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            showOn: "button",
            buttonImage: "<?=SITE_URL?>/images/calendar.gif",
            buttonImageOnly: true,
            onClose: function( selectedDate ) {
               // $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        
     	$( "#from" ).datepicker( "option", "dateFormat","D, d M, yy");
     	$( "#to" ).datepicker( "option", "dateFormat","D, d M, yy");
		$( "#from" ).datepicker( "option", "minDate", "Now");
		$( "#to" ).datepicker( "option", "minDate", "Now");
		$( "#from" ).val('<?php echo isset($event['start_date'])?date("D, j M, Y",strtotime($event['start_date'])):'' ?>');
		$( "#to" ).val('<?php echo isset($event['end_date'])?date("D, j M, Y",strtotime($event['end_date'])):'' ?>');
		
        
    });
	
    </script>

<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;"><?php echo isset($event['id'])?"Edit Event":"Add New Event" ?> </span>
	  </td>
      <td><button type="button" class="button_style" style="float: right;" onclick="setLocation('<?=SITE_URL?>/admin/event')" ><span>Event List</span></button></td>
    </tr>
  </tbody>
</table>
<hr/>

       
<?php echo $this->Form->create('Event', array('url' => array('controller' => 'admin', 'action' => 'event'))); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($event['id'])?$event['id']:''));?>
<table class="page_form">
  <tr>
	<td style="width: 100px;">
		Event Title<span class="star"> *</span>
	</td>
	<td>
	    <?php	echo $this->Form->input('title', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'div'=>false,
										'value'=>isset($event['title'])?$event['title']:'',
										)
									);
								?> 
	</td>
  </tr>
  <tr>
	<td>
	  Start Date<span class="star"> *</span>
	</td>
	<td>
      <?php	echo $this->Form->input('start_date', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'id' => 'from',
										'readonly'=>true,
										'div'=>false,
										'value'=>isset($event['start_date'])?date("D, j M, Y",strtotime($event['start_date'])):''
										)
									);
								?>
	</td>
  </tr>

  <tr>
	<td>
		Start Time<span class="star"> *</span>
	</td>
	<td>
	  <?php echo $this->Form->input('start_time', array('label' => '',
						'type'  => 'text',
						'class' => 'required',
						'id'=>'time_pic',
						'readonly'=>true,
						'div'=>false,
						'value'=>isset($event['start_time'])?$event['start_time']:'',
					)
		  );
	   ?>	
	</td>
  </tr>

 <tr>
	<td>
	  End Date<span class="star"> *</span>
	</td>
	<td>
		
		<?php
		
		echo $this->Form->input('end_date', array('label' => '',
						  'type'  => 'text',
						  'class' => 'required dtp',
						  'id' => 'to',
						  
						  'div'=>false,
						 
					  )
			);
		 ?>

	</td>
  </tr>

  <tr>
	<td>
	  Location
	</td>
	<td>
		<?php echo $this->Form->input('location', array('label' => '',
						  'type'  => 'textarea',
						  'class' => '',
						  'id'=>'msgpost',
						  'cols'=>'30',
						  'rows'=>'3',
						  'div'=>false,
						  'value'=>isset($event['location'])?$event['location']:'',
					  )
			);
		 ?>
	   
	</td>
  </tr>
  
  <tr>
	<td>
	  Description
	</td>
	<td>
	 
	  <?php echo $this->Form->input('description', array('label' => '',
						'type'  => 'textarea',
						'class' => '',
						'div'=>false,
						'value'=>isset($event['description'])?$event['description']:'',
					)
		  );
	   ?>	
	</td>
  </tr>  

  <tr>
	<td>
	  
	</td>
	<td>
	  <?php echo $this->Form->submit('Save Event',array(
											'div'=>false,
											'id'=>'submit',
											'class'=>'sign'
											)
									);
						?>
	</td>
  </tr>


</table>

<?php echo $this->Form->end(); ?>



<script>

$(document).ready(function(){
	$("#EventEventForm").validate();
});
 
</script>
