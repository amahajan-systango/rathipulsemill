<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Forum Category</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-right: 10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/forum')"><span>Post List</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<?php echo $this->Form->create('ForumCategory', array('url' => array('controller' => 'admin', 'action' => 'forum'),'type' => 'file')); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($forumCategory['id'])?$forumCategory['id']:'',));?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form">
	<tr>
	  <td>
		  <div><span>Category Name</span></div>
		  <div style="margin-top:10px">
			<?php	echo $this->Form->input('name', array('label' => '',
											'type'  => 'text',
											'class' => 'required',
											'div'=>false,
											'value'=>isset($forumCategory['name'])?$forumCategory['name']:'',
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	<tr>
		<td>
		  <?php echo $this->Form->submit('+ Add',array(
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
		<th>Category</th>
		<th>Action</th>
	</tr>
	
	<?php foreach($forumCategories as $forumCategory):?>
	<tr>
		<td><?php echo $this->Html->link($forumCategory['ForumCategory']['name'], '#', array('class' => 'button')); ?></td>
		<td>
		  <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteForumCategory/',$forumCategory["ForumCategory"]["id"] ),    array(),    "Are you sure you wish to delete this Category?"); echo " / ";?>
		  <?php echo $this->Html->link('Edit', '/admin/forum/category/'.$forumCategory["ForumCategory"]["id"], array('class' => 'button'));  ?>
		 </td>	
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#ForumCategoryForumForm").validate();
});
</script>
