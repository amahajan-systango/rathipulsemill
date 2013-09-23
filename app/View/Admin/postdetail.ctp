<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:40%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Blog Post Detail</span>
	  </td>
      <td>
		<button class="button_style" style="float: right;margin-left:10px;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/post')"><span>Add New Post</span></button>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/blog/category')"><span>Manage Category</span></button>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<div style="font-family: tahoma;">
  
  <div>
	<div class="post_title"><?php echo $blogPost['BlogPost']['title'];  ?></div>
	<div><span class="post_category">Category : </span><span class="post_cat_val"><?php echo $blogPost['BlogCategory']['name'];  ?></span></div>
	<div class="post_desc"><?php echo $blogPost['BlogPost']['description'];  ?></div>
	<div class="post_date"><?php echo  $this->Time->format('d/m/Y', $blogPost['BlogPost']['created']);  ?></div>
  </div>
  
  <div>
	  <div><span  class="post_comment_head">Comments</span></div>
	  
		<?php foreach($blogPost['BlogComment'] AS $blogComment):?>
		  <div class="post_comments">
			  <span class="comment_bg"> &nbsp; &nbsp;&nbsp;</span>
			  <span><?php echo $blogComment['comment_text']?></span>
			  <br/>
			  <span style="float: right;"><?php echo $this->Html->link('Delete', '/admin/deleteBlogComment/'.$blogPost['BlogPost']["id"]."/".$blogComment['id'], array('class' => 'button', 'title'=>'Delete this post'),"Are you sure you wish to delete this comment?");?></span>
		  </div>
	    <?php endforeach;?>
	  	
	<div>
</div>
	