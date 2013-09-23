<?php
class ForumCategory extends AppModel {
    public $name = 'ForumCategory';
    var $useTable = 'forum_categories';   
    var $hasMany = array(
			'ForumQuestion' => array(
				'className' => 'ForumQuestion',
				'foreignKey' => 'category_id',
				'dependent'=> true
			)						
	);
}


