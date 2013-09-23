<div id="content">
	<?php echo $currentPage['content']?>
	<?php if(isset($currentPage['id'])):?>
		<?php if($currentPage['id']==9):?>
		<div style="height: 280px;">
			<?php echo $this->Form->create('Feedback', array('url' => array('controller' => 'pages', 'action' => 'sendFeedbackMail'))); ?>
			<table style="margin: 17px auto auto; padding: 15px; box-shadow: 3px 0 6px #888888; width: 400px;">
	
			  <tr>
				<td style="font-weight: bold; padding-bottom: 6px; font-size: 16px;" colspan="2">FEEDBACK FORM</td>
			  </tr>
			  <tr>
				<td>	
				  <span>From </span>
				</td>  
				<td>	
				   <?php echo $this->Form->input('from', array('label' => '',
									'type'  => 'text',
									'class' => 'required email',
									'div'=>false,
									'required'=>'required',
									'email'=>'email',
									'title'=>'Enter Your Email',
									'style'=>'width:300px',
									'value'=>$this->Session->read('Feedback.from')
									)
					  );
				   ?>
				   
				</td>
			  </tr>
			  
			  <tr>
				<td>	
				  <span>Subject </span>
				</td>  
				<td>	
				  
				  <?php echo $this->Form->input('subject', array('label' => '',
									'type'  => 'text',
									'class' => 'required',
									'div'=>false,
									'required'=>'required',
									'style'=>'width:300px',
									'value'=>$this->Session->read('Feedback.subject')
									)
					  );
				   ?>	
				</td>
			  </tr>
			  
			  <tr>
				<td>	
				  <span>Feedback </span>
				</td>  
				<td>	
				  
				  <?php echo $this->Form->input('feedback', array('label' => '',
									'type'  => 'textarea',
									'class' => 'required',
									'div'=>false,
									'required'=>'required',
									'style'=>'width:300px',
									'value'=>$this->Session->read('Feedback.feedback')
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
				<td> </td>
				<td>
				  <?php echo $this->Form->submit('Send',array(
														'div'=>false,
														'id'=>'',
														'class'=>'',
														'style'=>'width:100px'
														)
												);
									?>
				</td>
			  </tr>
			
			</table>
			
			<?php echo $this->Form->end(); ?>
		</div>
     <?php endif;?>		
  <?php endif;?>
</div>

<img src="<?php echo $this->Html->url('/pages/deleteSession');?>"/>
