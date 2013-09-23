<div id="content">
  
	<div style="margin-left: 30px;">
		<a href="<?=SITE_URL?>/forum">Forum</a>
	</div>
	<div>
		<div><b><?php echo ucfirst($forum_question['ForumQuestion']['title']); ?></b></div>
		<div>
			<b>Posted Date : </b> <?php echo $this->Time->format('d/m/Y', $forum_question['ForumQuestion']['date']); ?>
			<b>Posted By : </b> <?php echo ucfirst($forum_question['ForumQuestion']['posted_by']); ?>
			<b>Category : </b> <?php echo ucfirst($forum_question['ForumCategory']['name']); ?>
			<b>Responses : </b> <?php echo ucfirst($forum_question['0']['count']); ?>
		</div>
		<div>
			<?php echo $forum_question['ForumQuestion']['description']; ?>
		</div>
	</div>
	<hr/>
	
	
	<div><span style="font-weight:bold;text-decoration:underline">Comments</span></div>
	<?php foreach($forum_question['ForumComment'] AS $forum_comment):?>
		<?php if($forum_comment['is_approve']):?>
		<div><span class="comment_bg"> &nbsp; &nbsp;&nbsp;</span> <?php echo $forum_comment['comment_text']?></div>
		<?endif;?>
	<?php endforeach;?>
	
	<p/>
	
	
	<div>
		<?php echo $this->Form->create('ForumComment', array('url' => array('controller' => 'forum', 'action' => 'postComment'))); ?>
		<?php echo $this->Form->input('question_id', array('type'  => 'hidden',
														   'value'=>$forum_question["ForumQuestion"]["id"]
														   )
									  );
		?>	
		<table>
		  <tr>
			<td>Author</td>
			<td>	
			  <?php echo $this->Form->input('posted_by', array('label' => '',
								'type'  => 'text',
								'class' => 'required',
								'div'=>false,
								'required'=>'required'
								)
				  );
			   ?>	
			</td>
		  </tr>

		  <tr>
			<td>Comment</td>
			<td>	
			  <?php echo $this->Form->input('comment_text', array('label' => '',
								'type'  => 'textarea',
								'class' => 'required',
								'div'=>false,
								'required'=>'required'
								)
				  );
			   ?>	
			</td>
		  </tr>
		
		
		  <tr>
				<td></td>
				<td>
				  <div style="margin-top:10px">	
					<div style="float:left">	
						<img id="captcha" src="<?php echo $this->Html->url('/pages/captcha_image');?>" alt="sss" />
					</div>	  
					<div style="float:left;margin-left: 10px;">	
					<?php echo $this->Form->input('captcha', array('label' => '',
									  'type'  => 'text',
									  'class' => 'required',
									  'div'=>false,
									  'required'=>'required',
									  'style'=>'width: 85px; height: 18px;',
									  'title'=>'CAPTCHA(Please enter the image code)'
									  )
						);
						
					 ?>
					 
					 </div>
				  </div>
				</td>
		  </tr>
		
		
		  <tr>
			<td></td>
			<td>
			  <?php echo $this->Form->submit('Post',array(
													'div'=>false,
													'id'=>'',
													'class'=>''
													)
											);
								?>
			</td>
		  </tr>
		
		</table>
		
		<?php echo $this->Form->end(); ?>
		
	</div>
</div>