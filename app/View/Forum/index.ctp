
<div id="content">
	<div style="margin-left: 30px;">
		<a href="<?=SITE_URL?>/forum/postQuestion">Add Question</a>
	</div>
	<hr/>
	
	<table class="list_page" style="margin: auto;">
		<tr>
			<th>Title</th>
			<th>Posted By</th>
			<th>Category</th>
			<th>Posted Date</th>
		</tr>
	  <?php if(count($forums)>0):?>
		<?php foreach($forums as $forum):?>
		<tr>
			<?php
				$approvedCount = 0;
				if($forum[0]['sum']){
					$approvedCount = $forum[0]['sum'];
				}
			
			?>
			
			<td><?php echo $this->Html->link($forum['ForumQuestion']['title']."(".$approvedCount.")", SITE_URL.'/forum/'.$forum["ForumQuestion"]["id"], array('class' => 'button')); ?></td>
			<td><?php echo $forum['ForumQuestion']['posted_by']; ?></td>
			<td><?php echo $forum['ForumCategory']['name']; ?></td>
			<td><?php echo $this->Time->format('d/m/Y', $forum['ForumQuestion']['date']); ?></td>
		</tr>	  
		<?php endforeach;?>
	  
	  <?php else:?>
		<tr>
			<td colspan="4"><div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">No topic found.</div></td>	
		</tr>	  
	  <?php endif;?>
	</table>
</div>	
