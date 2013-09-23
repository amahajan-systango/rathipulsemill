<?php
class BlogCategory extends AppModel {
    public $name = 'BlogCategory';
    var $useTable = 'blog_categories';   
    var $hasMany = array(
			'BlogPost' => array(
				'className' => 'BlogPost',
				'foreignKey' => 'category_id',
				'dependent'=> true
			)						
	);
}


