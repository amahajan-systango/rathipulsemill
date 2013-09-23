<div id="topheader">
		<div class="logo"></div>
		</div>
 	</div>
 	<div id="search_strip">
 		<div class="freeregistration">
    			<div class="registration">
				<b class="free" >ADMIN</b>Login 
			</div>
  		</div>
 	</div>
	
<div id="body_area">
	<div class="left">&nbsp;</div>
  	<div class="admin_login_midarea">
		<? if(isset($_GET['flag'])==1){?><div style="height:30px; text-align:left; font-weight:bold; font-size:13pt;color:red;"><? echo "Invalid username or password!";?></div><br/><br/><?}?>

		<? if(isset($_GET['sent']) && $_GET['sent']==1){?><div style="height:30px; text-align:left; font-weight:bold; font-size:13pt;color:red;"><? echo "*We have now sent the password to your email.";?></div><br/><br/><?}?>
<?php echo $this->Session->flash(); ?>
   		<div class="head"> Sign in to Simply Yours!</div>
    	<div class="body_textarea">
      		<div id="login" align="justify">
                <div style="clear:both">
                     <?php echo $this->Form->create('User'); ?>
                    <div style="clear: both; height: 75px;">
                        <div style="font-weight: bold; font-size: 13pt; height: 25px; margin-top: 2px;">Username</div>
                        
                        <?php	echo $this->Form->input('username',
                                                            array('label' => false,
                                                            'type'  => 'text',
                                                            'div' 	=>false,
                                                            'class' => 'righttextbox',
                                                            )
                                        );
                        ?>
                    </div>
                    <div style="clear: both; height: 75px;">
                        <div style="height:25px; text-align:left; font-weight:bold; font-size:13pt;clear: both;">Password</div>
                        <?php	echo $this->Form->input('password',
                                                            array('label' => false,
                                                            'type'  => 'password',
                                                            'div' 	=>false,
                                                            'class' => 'righttextbox',
                                                            )
                                         );
                        ?>
                    </div>
                    
                </div>
                

                <?php
                    $options = array(
                        'label' => 'Sign In',
                        'name' => 'signin',
                        'class' => 'sign',
                        'div' => array(
                                    'style' => 'padding-left:70px;',
                                )
                    );
                    echo $this->Form->end($options);
                ?>
                <div style="padding-top:20px;">
                <a href="<?=SITE_URL?>/admin/forgotPassword">Forgot your ID or password?</a><br/>
                    <span>Your password will be sent to your registered email.</span>
                </div>
            </div>
    	</div>
    </div>
</div>
