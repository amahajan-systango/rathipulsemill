<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Gallery Album</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/post')"><span>Add New Album</span></button>
		<button class="button_style" style="float: right;margin-right: 10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog')"><span>Post List</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<?php echo $this->Form->create('BlogCategory', array('url' => array('controller' => 'admin', 'action' => 'blog'),'type' => 'file')); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($blogCategory['id'])?$blogCategory['id']:'',));?>
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
											'value'=>isset($blogCategory['name'])?$blogCategory['name']:'',
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
	
	<?php foreach($blogCategories as $blogCategory):?>
	<tr>
		<td><?php echo $this->Html->link($blogCategory['BlogCategory']['name'], '#', array('class' => 'button')); ?></td>
		<td>
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteBlogCategory/',$blogCategory["BlogCategory"]["id"] ),    array(),    "Are you sure you wish to delete this Category?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/blog/category/'.$blogCategory["BlogCategory"]["id"], array('class' => 'button'));  ?>
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
