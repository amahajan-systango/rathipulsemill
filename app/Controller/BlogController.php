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
class BlogController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Blog';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Config','Page','BlogPost','BlogComment');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 
 	function beforeFilter(){
 		if($this->action=='index' || $this->action=='postComment'){

 		}
 		else{
 			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
			$this->redirect('/blog');	
 		}
 	}
 
	public function index() {
		$params = $this->request->params;
		
		$renderedPage = 'index';
		
		/****************************/
		$conditions = array('Page.identifier'=>'blog','Page.status'=>array(1));
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
		/****************************/
		
		if(isset($params['id'])){
			
			$blogPost = $this->BlogPost->find('first', array(
				'joins' => array(
					array(
						'table' => 'blog_categories',
						'alias' => 'BlogCategory',
						'type' => 'INNER',
						'conditions' =>'BlogCategory.id = BlogPost.category_id'
					)
				),
				'conditions' => array(
					'BlogPost.id' => $params['id']
				),
				'fields'=>array('BlogPost.*,BlogCategory.id,BlogCategory.name'),
			));
			
			if(!isset($blogPost['BlogPost'])){
				$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
				$this->redirect('/blog');	
			}
			$this->set('blogPost',$blogPost);
			$renderedPage = 'blog_post';
		}
		$this->paginate = array(
			'joins' => array(
				array(
					'alias' => 'BlogCategory',
					'table' => 'blog_categories',
					'type' => 'INNER',
					'conditions' => 'BlogCategory.id = BlogPost.category_id'
				),
				array(
					'alias' => 'BlogComment',
					'table' => 'blog_comments',
					'type' => 'LEFT',
					'conditions' => 'BlogComment.blog_post_id = BlogPost.id'
				)
			),
			'limit' => 10,
			'order' => array(
				'created' => 'desc'
			),
			'fields'=>'BlogPost.*,BlogCategory.id,BlogCategory.name, count(BlogComment.blog_post_id) AS count',
			'group'=>'BlogPost.id',
		);
		
		
		$this->set('blogs',$this->paginate($this->BlogPost));
		$this->render($renderedPage);
		
	}	
	
	function postComment(){
		
		if($this->data['BlogComment']['captcha']!=$this->Session->read('captcha')){
			$this->Session->setFlash('Please enter correct captcha code.','error');
			$this->redirect("/blog/".$this->data['BlogComment']['blog_post_id']);		
		}
		
		$commentData['comment_text'] = $this->data['BlogComment']['comment_text'];
		$commentData['blog_post_id'] = $this->data['BlogComment']['blog_post_id'];
		$commentData['date'] = Date("Y-m-d");
		if($this->BlogComment->save($commentData)){
	    	$this->Session->setFlash('Your comment has been posted successfully!','success');	
	    } 
	    $this->redirect("/blog/".$this->data['BlogComment']['blog_post_id']);		
	}
	
}
