<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Forum Post/List</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/forum/category')"><span>Manage Category</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<table class="list_page">
  <tr>
	  <th>Title</th>
	  <th>Posted By</th>
	  <th>Category</th>
	  <th>Posted Date</th>
	  <th>Action</th>
  </tr>
  <?php if(count($forums)>0):?>
	<?php foreach($forums as $forum):?>
	<tr>
		<td><?php echo $this->Html->link($forum['ForumQuestion']['title'], '/admin/forum/postdetail/'.$forum["ForumQuestion"]["id"], array('class' => 'button')); ?></td>
		<td><?php echo $forum['0']['count'];?></td>
		<td><?php echo $this->Html->link($forum['ForumCategory']['name'], '/admin/forum/category/'.$forum["ForumCategory"]["id"], array('class' => 'button')); ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $forum['ForumQuestion']['date']);?></td>
		<td>
		   <?php echo $this->Html->link('Delete', '/admin/deleteForumQuestion/'.$forum["ForumQuestion"]["id"], array('class' => 'button'),"Are you sure you wish to delete this forum?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/forum/post/'.$forum["ForumQuestion"]["id"], array('class' => 'button'));  ?>
		</td>	
	</tr>	  
	<?php endforeach;?>
  
  <?php else:?>
	<tr>
	  <td colspan="5">
		  <div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">
			No forum posted.
		  </div>
	  </td>	
	</tr>	  
  <?php endif;?>
</table>
