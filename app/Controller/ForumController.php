<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ForumController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Forum';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Config','Page','ForumQuestion','ForumComment','ForumCategory');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 
 	function beforeFilter(){
 		if($this->action=='index' || $this->action=='postQuestion' || $this->action=='postComment'){

 		}
 		else{
 			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
			$this->redirect('/calendar');	
 		}
 	}
 
 
	public function index() {
		$params = $this->request->params;
		
		$renderedPage = 'index';
		
		/*****************************************/
		$conditions = array('Page.identifier'=>'forum','Page.status'=>array(1));
		$currentPage = $this->Page->find('first',array('conditions'=>$conditions));
		if(!isset($currentPage['Page'])){
			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
	    	$this->redirect('/home');	
		}
		$this->set('title', $currentPage['Page']['title']);
		$this->set('currentPage', $currentPage['Page']);
		
		$pages = $this->Page->find('all',array(
											'conditions'=>array(
															'Page.status'=>array(1),
															'Page.id <='=>9
										),
									'order' => 'id ASC'
							)
				);
		$this->set('pages', $pages);
		
		$config_params = array('fields' => array('Config.key','Config.value'));
		$config = $this->Config->find('list',$config_params);
		$this->set('configData',$config);
		$this->set('theme',"site/".$config['theme']);
		$this->set('companyName',ucfirst($config['company_name']));
		/*****************************************/
		if(isset($params['id'])){
			
			$question = $this->ForumQuestion->find('first', array(
				'joins' => array(
					array(
						'table' => 'forum_categories',
						'alias' => 'ForumCategory',
						'type' => 'INNER',
						'conditions' =>'ForumCategory.id = ForumQuestion.category_id'
					),
				array(
					'alias' => 'ForumComment',
					'table' => 'forum_comments',
					'type' => 'LEFT',
					'conditions' => 'ForumComment.forum_question_id = ForumQuestion.id'
				)
				),
				'conditions' => array(
					'ForumQuestion.id' => $params['id']
				),
				
				'fields'=>array('ForumQuestion.*, ForumCategory.id, ForumCategory.name, sum(ForumComment.is_approve) AS count'),
				'group'=>'ForumQuestion.id',
			));
			if(!isset($question['ForumQuestion'])){
				$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				$this->redirect('/forum');	
			}	
			$categoriesList = $this->ForumCategory->find('list');
			$this->set('categoriesList',$categoriesList);
			
			$this->set('forum_question',$question);
			$renderedPage = 'question_detail';
		}
		$this->paginate = array(
			'joins' => array(
				array(
					'alias' => 'ForumCategory',
					'table' => 'forum_categories',
					'type' => 'INNER',
					'conditions' => 'ForumCategory.id = ForumQuestion.category_id'
				),
				array(
					'alias' => 'ForumComment',
					'table' => 'forum_comments',
					'type' => 'LEFT',
					'conditions' => 'ForumComment.forum_question_id = ForumQuestion.id'
				)
			),
			
			'limit' => 10,
			'order' => array(
				'created' => 'desc'
			),
			'fields'=>'ForumQuestion.*,ForumCategory.id,ForumCategory.name, sum(ForumComment.is_approve) AS sum',
			'group'=>'ForumQuestion.id',
		);
		
		$this->set('forums',$this->paginate($this->ForumQuestion));
		
		$this->render($renderedPage);
	}	
	
	function postQuestion(){
		
		/*********************************************/
		$conditions = array('Page.identifier'=>'forum','Page.status'=>array(1));
		$currentPage = $this->Page->find('first',array('conditions'=>$conditions));
		if(!isset($currentPage['Page'])){
			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
	    	$this->redirect('/home');	
		}
		$this->set('title', $currentPage['Page']['title']);
		$this->set('currentPage', $currentPage['Page']);
		
		$pages = $this->Page->find('all',array(
											'conditions'=>array('Page.status'=>array(1),
											'Page.id <='=>9
										),
									'order' => 'id ASC'
							)
				);	
		$this->set('pages', $pages);
		
		$params = array('fields' => array('Config.key','Config.value'));
		$config = $this->Config->find('list',$params);
		$this->set('configData',$config);
		$this->set('theme',"site/".$config['theme']);
		$this->set('companyName',ucfirst($config['company_name']));
		/*********************************************/
		
		if(isset($this->data['ForumQuestion'])){ 
			
			
			$forumQuestionData['posted_by'] 	  = $this->data['ForumQuestion']['posted_by'];
			$forumQuestionData['category_id'] = $this->data['ForumQuestion']['category_id'];
			$forumQuestionData['title'] 	  = $this->data['ForumQuestion']['title'];
			$forumQuestionData['description'] = $this->data['ForumQuestion']['description'];
			$forumQuestionData['date']		  = Date("Y-m-d");
			$this->ForumQuestion->set( $forumQuestionData );
			
			if($this->data['ForumQuestion']['captcha']!=$this->Session->read('captcha')){
				$this->Session->setFlash('Please enter correct captcha code.','error');
				//$this->redirect('/forum/postQuestion');	
			}
			
			if ($this->ForumQuestion->validates()) {
				if($this->ForumQuestion->save($forumQuestionData)){
					$this->Session->setFlash('Your Question has been posted successfully!','success');	
					$this->redirect('/forum');	
				}
			}
	    }  
		
		$categoriesList = $this->ForumCategory->find('list');
		$this->set('categoriesList',$categoriesList);
		
		
	    $this->render('post_question');	
	}
	
	function postComment(){
		
		
		if($this->data['ForumComment']['captcha']!=$this->Session->read('captcha')){
				$this->Session->setFlash('Please enter correct captcha code.','error');
				$this->redirect('/forum/'.$this->data["ForumComment"]["question_id"]);	
		}
		if(isset($this->data['ForumComment'])){
			$forumCommentData['posted_by']   = $this->data['ForumComment']['posted_by'];
			$forumCommentData['forum_question_id'] = $this->data['ForumComment']['question_id'];
			$forumCommentData['comment_text'] 	  = $this->data['ForumComment']['comment_text'];
			$forumCommentData['date']		  = Date("Y-m-d");
			if($this->ForumComment->save($forumCommentData)){
				$this->Session->setFlash('Your Question Comment has been posted successfully!','success');	
				$this->redirect('/forum/'.$this->data["ForumComment"]["question_id"]);	
			} 
	    }		
			
	}
	
}
