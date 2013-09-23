<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Send Newsletter </span>
		
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter')"><span>Newsletter List</span></button>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/newsletter/email')"><span>Newsletter Email</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>
<?php echo $this->Form->create('NewsletterSend', array('url' => array('controller' => 'admin', 'action' => 'newsletter'))); ?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form gallery_table">
	<tr>
	  <td>
		  <div><span>Subject</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('subject', array('label' => '',
											'type'  => 'text',
											'class' => 'required',
											'div'=>false,
											'style'=>'width: 297px;'
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	<tr>
	  <td>
		  <div><span>To Newsletter List</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('newsletter_list_id', array('label' => '',
											'type'  => 'select',
											'class' => 'required',
											'options'=>$newsletterList,
											'div'=>false,
											'style'=>'width: 299px;',
											'empty'=>'Select List'
											)
										);
									?> 
		  </div>
	  </td>
	</tr>

	<tr>
	  <td>
		  <div><span>Write Letter(Content) to send</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('letter', array('label' => '',
											'type'  => 'textarea',
											'class' => 'required',
											'div'=>false,
											'rows' =>8,
											'cols'=>40
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	<tr>
      <td>
		  <?php echo $this->Form->submit('Send',array(
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




<script>
$(document).ready(function(){
	$("#NewsletterSendNewsletterForm").validate();
});
</script>
