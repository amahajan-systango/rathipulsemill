<?php
class ForumQuestion extends AppModel {
    public $name = 'ForumQuestion';
    var $useTable = 'forum_questions';   
    var $hasMany = array(
			'ForumComment' => array(
				'className' => 'ForumComment',
				'foreignKey' => 'forum_question_id',
				'dependent'=> true
			)						
	);
	
	public $validate = array(
        'category_id' => array(
            'rule' => 'notEmpty',
            'message' => 'Category is required'
        ),
        'posted_by' => array(
            'rule' => 'notEmpty',
            'message' => 'Auther is required'
        ),
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Title is required'
        ),
        'description' => array(
            'rule' => 'notEmpty',
            'message' => 'Description is required'
        )
    );
}


