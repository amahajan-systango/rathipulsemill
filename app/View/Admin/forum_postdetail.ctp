<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:40%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Forum Post Detail</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/forum')"><span>Post List</span></button>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/forum/category')"><span>Manage Category</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>


<div style="font-family: tahoma;">

  <div>
	
	<div>
	  <span class="post_title" style="float: left;">asdfa</span>
	  <span style="float: right;">
		<?php echo $this->Html->link('Delete', '/admin/deleteForumQuestion/'.$forum_question["ForumQuestion"]["id"], array('class' => 'button', 'title'=>'Delete this post'),"Are you sure you wish to delete this forum?");?>
	  </span>
	</div>
	
	<div style="clear:both">
	  <span class="post_category">Category : </span><span class="post_cat_val"><?php echo $forum_question['ForumCategory']['name'];  ?></span>
	</div>
	
	<div>
	  <span class="post_category">Posted By : </span><span class="post_cat_val"><?php echo $forum_question['ForumQuestion']['posted_by'];  ?></span>
	</div>

	<div>
	  <span class="post_category">Posted Date : </span><span class="post_cat_val"><?php echo $this->Time->format('d/m/Y', $forum_question['ForumQuestion']['date']);  ?></span>
	</div>
	
	<div>
	  <span class="post_category">Responses : </span><span class="post_cat_val"><?php echo $forum_question['0']['count'];  ?></span>
	</div>

	<div>
	  <span class="post_category">description : </span><span class="post_cat_val"><?php echo $forum_question['ForumQuestion']['description'];  ?></span>
	</div>


  </div>
  
  <div>
	  <div><span  class="post_comment_head">Comments</span></div>
	  
		<?php foreach($forum_question['ForumComment'] AS $forumComment):?>
		  <div class="post_comments">
			<span class="comment_bg">&nbsp; &nbsp;&nbsp;</span>
			<?php echo $forumComment['comment_text']?>
			<?php if($forumComment['is_approve'] == 0){?>
			  <br><span style="float:right;">
			  <?php echo $this->Html->link('Approve', '/admin/approveComment/'.$forum_question["ForumQuestion"]["id"]."/".$forumComment['id'], array('class' => 'button', 'title'=>'approve'));?>
			  </span><span style="float:right;margin-right:10px;"><?php echo $this->Html->link('Reject', '/admin/rejectComment/'.$forum_question["ForumQuestion"]["id"]."/".$forumComment['id'], array('class' => 'button', 'title'=>'Delete this post'),"Are you sure you wish to reject this comment?");?></span><br><br>
			  <?php }else{ ?>
             <span style="float:right;margin-right:10px;"><?php echo $this->Html->link('Delete', '/admin/rejectComment/'.$forum_question["ForumQuestion"]["id"]."/".$forumComment['id'], array('class' => 'button', 'title'=>'Delete this post'),"Are you sure you wish to delete this comment?");?></span><br><?php } ?>
		  </div>
	    <?php endforeach;?>
	  	
	<div>
</div>
	
