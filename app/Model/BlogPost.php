<?php
class BlogPost extends AppModel {
    public $name = 'BlogPost';
    var $useTable = 'blog_posts';   
    var $hasMany = array(
			'BlogComment' => array(
				'className' => 'BlogComment',
				'foreignKey' => 'blog_post_id',
				'dependent'=> true
			)						
	);
}


