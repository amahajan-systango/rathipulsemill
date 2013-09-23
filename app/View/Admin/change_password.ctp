<script>
	$(document).ready(function(){
		$("#UserAccountChangePasswordForm").validate();
		$("#UserChangePasswordForm").validate({
			rules: {
				'data[User][password]': "required",
				'data[User][repeat_password]': {
				  equalTo: "#UserPassword"
				}
			  },
			errorClass: 'error',
				errorPlacement: function (error, element) {
					error.insertAfter(element)
			}
			});
		$("#clear_all").click(function(){ 
			$("input[type=password]").val("");		
			return false;
		});
	});
</script>


<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Admin Setting</span>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>

<?php echo $this->Form->create('User',array('url' => array('controller' => 'admin', 'action' => 'change_password'))); ?>
<table class="site_setting_form">
  <tr>
	<td style="width:165px">
		Old Password
	</td>
	<td>
	  <?php
				echo $this->Form->input('User.oldPassword',array(
									'label' => false,
									'type'  => 'password',
									'class' => 'required',
									'div'	=> false,
									/*'minlength' => '6',*/
									
								)
				);
			?>
	  
	</td>
  </tr>
  <tr>
	<td>
	 New Password
	</td>
	<td>
      <?php	echo $this->Form->input('User.password', array('label' => false,
												'type'  => 'password',
												'name'  => "data[User][password]",
												'class' => 'required',
												'minlength' => '6',
												'div'	=> false,
												
                                          			)
                                );
								?>
	</td>
  </tr>

 <tr>
	<td>
	  Confirm New Password
	</td>
	<td>
      <?php	echo $this->Form->input('repeat_password', array('label' => false,
                                       			'type'  => 'password',
												'name'  => "data[User][repeat_password]",
												'class' => 'required',
												'div'	=> false,
												
                                          		)
                                );
								?>
	</td>
  </tr>

  <tr>
	<td>
	  
	</td>
	<td>
	 <?php echo $this->Form->submit('CHANGE',array('type'=>'submit',
												'value'=>'Change',
												'div'	=>false,
												'class'=>'sign'
												)
											);
			?>
	</td>
  </tr>


</table>

<?php echo $this->Form->end();?>

<div></div>

<hr/>

<?php echo $this->Form->create('UserAccount',array('url' => array('controller' => 'admin', 'action' => 'change_email'))); ?>
<table class="site_setting_form">
  
  <tr>
	<td style="width:165px">
	  Admin Email
	</td>
	<td>
      <?php	echo $this->Form->input('email', array('label' => false,
                                       			'type'  => 'text',
												'name'  => "data[User][email]",
												'class' => 'required email',
												'div'	=> false,
												'value' => $user['email']
                                          		)
                                );
								?>
	</td>
  </tr>

  <tr>
	<td>
	  
	</td>
	<td>
	 <?php echo $this->Form->submit('Update',array('type'=>'submit',
												'value'=>'Change',
												'div'	=>false,
												'class'=>'sign'
												)
											);
			?>
	</td>
  </tr>


</table>

<?php echo $this->Form->end();?>