<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Blog Post/Comment</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/post')"><span>Add New Post</span></button>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/category')"><span>Manage Category</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<table class="list_page">
  <tr>
	  <th>Blogs</th>
	  <th>Comment</th>
	  <th>Category</th>
	  <th>Action</th>	  
  </tr>
  <?php if(count($blogs)>0):?>
	<?php foreach($blogs as $blog):?>
	<tr>
		<td><?php echo $this->Html->link($blog['BlogPost']['title'], '/admin/blog/postdetail/'.$blog["BlogPost"]["id"], array('class' => 'button')); ?></td>
		<td><?php echo $blog['0']['count'];?></td>
		<td><?php echo $this->Html->link($blog['BlogCategory']['name'], '/admin/blog/category/'.$blog["BlogCategory"]["id"], array('class' => 'button')); ?></td>
		<td>
		   <?php echo $this->Html->link('Delete', '/admin/deleteBlogPost/'.$blog["BlogPost"]["id"], array('class' => 'button'),"Are you sure you wish to delete this post?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/blog/post/'.$blog["BlogPost"]["id"], array('class' => 'button'));  ?>
		</td>	
	</tr>	  
	<?php endforeach;?>
  
  <?php else:?>
	<tr>
		<td colspan="4"><div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">There is no blog posted.</div></td>	
	</tr>	  
  <?php endif;?>
</table>
<?php echo $this->Paginator->numbers(); ?>
