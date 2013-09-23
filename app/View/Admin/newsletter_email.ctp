<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<?php $subValue = isset($newsletterEmail['id'])?"Update":" + Add" ?>
		<?php $headValue = isset($newsletterEmail['id'])?"Edit Newsletter Email":"Newsletter Email" ?>
		<span style="color:#D0910B;font-weight:bold;"><?php echo $headValue; ?> </span>
		
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter')"><span>Newsletter List</span></button>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter/send')"><span>Send Newsletter</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>
<?php echo $this->Form->create('NewsletterEmail', array('url' => array('controller' => 'admin', 'action' => 'newsletter'))); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($newsletterEmail['id'])?$newsletterEmail['id']:'',));?>
<div style="clear:both">
 <div style="float: left; width: 193px;">
  <table class="page_form gallery_table">
	
	<tr>
	  <td>
		  <div><span>Email</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('email', array('label' => '',
											'type'  => 'text',
											'class' => 'required email',
											'div'=>false,
											'value'=>isset($newsletterEmail['email'])?$newsletterEmail['email']:'',
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	<tr>
	  <td>
		  <div><span>Newsletter List</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('newsletter_id', array('label' => '',
											'type'  => 'select',
											'class' => 'required',
											'options'=>$newsletterList,
											'div'=>false,
											'selected' =>isset($newsletterEmail['newsletter_id'])?$newsletterEmail['newsletter_id']:'',
											'style'=>'width: 180px;'
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
		<th><div style="width: 150px; ">Email</div></th>
	    <th><div style="width: 150px; ">Newsletter List Name</div></th>
		<th><div style="width: 110px;">Date</div></th>
		<th colspan="2"> &nbsp;</th>
	</tr>
	
	<?php foreach($newslettersEmails as $newsletterEmail):?>
	<tr>
		<td><?php echo $newsletterEmail['NewsletterEmail']['email']; ?></td>
		<td><?php echo $newsletterEmail['Newsletter']['name']; ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $newsletterEmail['NewsletterEmail']['created']); ?></td>
		
		<td>
		  <div style="width: 70px; text-align: center;">
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteNewsletterEmail/',$newsletterEmail["NewsletterEmail"]["id"] ),    array(),    "Are you sure you wish to delete this Album?"); echo " / ";?>
		   
		   <?php echo $this->Html->link('Edit', '/admin/newsletter/email/'.$newsletterEmail['NewsletterEmail']["id"], array('class' => 'button'));  ?>
		   </div>
		</td>	
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#NewsletterEmailNewsletterForm").validate();
});
</script>
