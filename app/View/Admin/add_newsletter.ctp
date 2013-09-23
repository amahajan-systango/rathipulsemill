<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Add Newsletter List</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/post')"><span>Add New Post</span></button>
		<button class="button_style" style="float: right;margin-right: 10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog')"><span>Post List</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<?php echo $this->Form->create('Newsletter', array('url' => array('controller' => 'admin', 'action' => 'addNewsLetter'),'type' => 'file')); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($newsletter['id'])?$newsletter['id']:'',));?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form">
  
	<tr>
	  <td>
		  <div><span>List Name</span></div>
		  <div style="margin-top:10px">
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
	   
		<td>	  <?php echo $this->Form->submit('+ Add',array(
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

<div style="margin-left: 34px; float: right; width: 370px;">
  <table class="list_page">
	<tr>
		<th colspan="2">Category</th>
	</tr>
	
	<?php foreach($newsletters as $newsletter):?>
	<tr>
		<td><?php echo $this->Html->link($newsletter['Newsletter']['name'], '#', array('class' => 'button')); ?></td>
		<td>
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteBlogCategory/',$newsletter["Newsletter"]["id"] ),    array(),    "Are you sure you wish to delete this Category?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/blog/category/'.$newsletter["Newsletter"]["id"], array('class' => 'button'));  ?>
		 </td>	
  
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#BlogCategoryBlogForm").validate();
});
</script>
