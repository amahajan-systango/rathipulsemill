<div id="topheader">
		<div class="logo"></div>
		</div>
 	</div>
 	<div id="search_strip">
 		<div class="freeregistration">
    			<div class="registration">
				<b class="free" >ADMIN</b>
			</div>
				
  		</div>
 	</div>

<div id="body_area">
	<div class="left">&nbsp;</div>
  	
	<div class="admin_login_midarea">
		
		<?php echo $this->Session->flash(); ?>
   		<!-- div class="head"> Forgot Password!</div -->
		<div style="color: #3C6F75;"> To reset your password, Enter your email address.</div>
    	<div class="body_textarea">
      		<div id="login" align="justify">
                <div style="clear:both">
                     <?php echo $this->Form->create('User'); ?>
                    <div style="clear: both; height: 75px;">
                        
                        <?php	echo $this->Form->input('email',
                                                            array('label' => false,
                                                            'type'  => 'text',
                                                            'div' 	=>false,
                                                            'class' => 'righttextbox email',
                                                            )
                                        );
                        ?>
                    </div>
                    
                </div>
                

                <?php
                    $options = array(
                        'label' => 'Continue',
                        'class' => 'sign',
                        'div' => array(
                                    'style' => 'padding-left:70px;',
                                )
                    );
                    echo $this->Form->end($options);
                ?>
               <div style="padding-top: 20px; text-align: center; width: 215px;">
		              <a href="<?=SITE_URL?>/admin/login">Go back to Login</a><br/>
                </div>
            </div>
    	</div>
    </div>
</div>
