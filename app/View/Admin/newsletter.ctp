<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<?php $subValue = isset($newsletter['id'])?"Update":" + Add" ?>
		<?php $headValue = isset($newsletter['id'])?"Edit Newsletter":"Newsletter" ?>
		<span style="color:#D0910B;font-weight:bold;"><?php echo $headValue; ?> </span>
		
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter/email')"><span>Newsletter Email</span></button>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter/send')"><span>Send Newsletter</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>
<?php echo $this->Form->create('Newsletter', array('url' => array('controller' => 'admin', 'action' => 'newsletter'))); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($newsletter['id'])?$newsletter['id']:'',));?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form gallery_table">
	
	<tr>
	  <td title="Newsletter List Name">
		  <div><span>List Name</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('name', array('label' => '',
											'type'  => 'text',
											'class' => 'required',
											'div'=>false,
											'value'=>isset($newsletter['name'])?$newsletter['name']:'',
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	
	<tr>
      <td>
		  <?php echo $this->Form->submit($subValue,array(
											  'div'=>false,
											  'class'=>'sign'
											  )
									  );
						  ?>
	  </td>
	</tr>
  <?php echo $this->Form->end(); ?>

  </table>
</div>

<div style="float: right; margin-left: 10px;">
  <table class="list_page">
	<tr>
	    <th><div style="width: 160px; ">List Name</div></th>
		<th><div style="width: 130px;">Date</div></th>
		<th colspan="2">Action</th>
	</tr>
	
	<?php foreach($newsletters as $newsletter):?>
	<tr>
		<td><?php echo $newsletter['Newsletter']['name']; ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $newsletter['Newsletter']['created']); ?></td>
		
		<td>
		  <div style="width: 130px; text-align: center;">
		   <?php if($newsletter['Newsletter']['id']!=1): ?>
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteNewsletterList/',$newsletter["Newsletter"]["id"] ),    array(),    "Are you sure you wish to delete this Album?"); echo " / ";?>
		   <?php endif;?>
		   <?php echo $this->Html->link('Edit', '/admin/newsletter/list/'.$newsletter['Newsletter']["id"], array('class' => 'button'));  ?>
		   </div>
		</td>	
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#NewsletterNewsletterForm").validate();
});
</script>
