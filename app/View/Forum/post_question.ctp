<div id="content">
  
	<div style="margin-left: 30px;">
		<a href="<?=SITE_URL?>/forum">Forum</a>
	</div>
	<div style="text-align: center; font-size: 20px;">
		<span>Ask A Question</span>
	</div>
	<hr/>
	
	<div>
		<?php echo $this->Form->create('ForumQuestion', array('url' => array('controller' => 'forum', 'action' => 'postQuestion'))); ?>
		<table style="margin: auto; padding: 30px; box-shadow: 3px 0px 6px #888888;">
		  <tr>
			<td>Author</td>
			<td>	
			  <?php echo $this->Form->input('posted_by', array('label' => '',
								'type'  => 'text',
								'class' => 'required',
								'div'=>false,
								'required'=>'required',
								'error' => array('Author is required!',true)
								)
				  );
			   ?>	
			</td>
		  </tr>
		
		  <tr>
			<td>Category</td>
			<td>	
			   <?php echo $this->Form->input('category_id', array('label' => '',
						'type'  => 'select',
						'class' => 'required',
						'options'=>$categoriesList,
						'error' => array('Please select category!',true),
						'div'=>false
					)
				  );
			   ?>	
			</td>
		  </tr>
		  
		  <tr>
			<td>Title</td>
			<td>	
			  <?php echo $this->Form->input('title', array('label' => '',
								'type'  => 'text',
								'class' => 'required',
								'div'=>false,
								'required'=>'required',
								'error' => array('Title is required!',true)
								)
				  );
			   ?>	
			</td>
		  </tr>

		  <tr>
			<td>Description</td>
			<td>	
			  <?php echo $this->Form->input('description', array('label' => '',
								'type'  => 'textarea',
								'class' => 'required',
								'div'=>false,
								'required'=>'required',
								'error' => array('Description is required!',true)
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
									  'title'=>'CAPTCHA(Please enter the image code)',
									  'value'=>''
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