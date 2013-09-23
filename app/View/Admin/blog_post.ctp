<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Add New Post</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog')"><span>Post List</span></button>
		<button class="button_style" style="float: right;margin-right: 10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/category')" ><span>Manage Category</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>


<?php echo $this->Form->create('BlogPost', array('url' => array('controller' => 'admin', 'action' => 'blog'))); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($blogPost['id'])?$blogPost['id']:''));?>
<table class="page_form">
  <tr>
	<td>
		Title  
	</td>
	<td style="width: 80%;">
	    <?php	echo $this->Form->input('title', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'div'=>false,
										'value'=>isset($blogPost['title'])?$blogPost['title']:'',
										)
									);
								?> 
	</td>
  </tr>
  <tr>
	<td>
	  Tags
	</td>
	<td>
      <?php	echo $this->Form->input('tag', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'div'=>false,
										'value'=>isset($blogPost['tag'])?$blogPost['tag']:''
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
						  'class' => 'required',
						  'div'=>false,
						  'value'=>isset($blogPost['description'])?$blogPost['description']:'',
					  )
			);
		 ?>

	</td>
  </tr>

  <tr>
	<td>
	  Category
	</td>
	<td>
	  <?php echo $this->Form->input('category_id', array('label' => '',
						'type'  => 'select',
						'class' => 'required',
						'options'=>$categoriesList,
						'div'=>false,
						'selected' =>isset($blogPost['category_id'])?$blogPost['category_id']:'',
					)
		  );
	   ?>	
	</td>
  </tr>  

  <tr>
	<td>
	  
	</td>
	<td>
	  <?php echo $this->Form->submit('Save Post',array(
											'div'=>false,
											'id'=>'submit',
											'class'=>'sign'
											)
									);
						?>
	  <?php if(isset($blogPost)):?>					
		  <input type="button" class="sign" value="Cancel" onclick="setLocation('<?=SITE_URL?>/admin/blog')"/>
	  <?php endif;?>						  
	</td>
  </tr>


</table>

<?php echo $this->Form->end(); ?>

<script>
$(document).ready(function(){
	$("#BlogPostBlogForm").validate();
});
 
</script>
