<?php
class Newsletter extends AppModel {
    public $name = 'Newsletter';
    var $useTable = 'newsletters';   
     var $hasMany = array(
			'NewsletterEmail' => array(
				'className' => 'NewsletterEmail',
				'foreignKey' => 'newsletter_id',
				'dependent'=> true
			)						
	);
    
}


