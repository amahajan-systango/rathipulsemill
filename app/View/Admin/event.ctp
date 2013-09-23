<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Calendar Event</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/event/add')"><span>Add Event</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<table class="list_page">
  <tr>
	  <th>Event</th>
	  <th>Event Start Date</th>
	  <th>Action</th>
	  
  </tr>
  <?php if(count($events)>0):?>
	<?php foreach($events as $event):?>
	<tr>
		<td><?php echo $event['Event']['title']; ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $event['Event']['start_date'])." ".$event['Event']['start_time']; ?></td>
		<td>
		   <?php echo $this->Html->link('Delete','/admin/deleteEvent/'.$event["Event"]["id"], array('class' => 'button'),"Are you sure you wish to delete this event?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/event/edit/'.$event["Event"]["id"], array('class' => 'button'));  ?>
		</td>	
	</tr>	  
	<?php endforeach;?>
  
  <?php else:?>
	<tr>
		<td colspan="4"><div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">There is no event added.</div></td>	
	</tr>	  
  <?php endif;?>
</table>

