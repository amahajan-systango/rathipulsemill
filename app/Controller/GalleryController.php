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
class GalleryController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Gallery';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Config','Page','GalleryAlbum','GalleryImage');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 	function beforeFilter(){
 		if($this->action!='index'){
 			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
			$this->redirect('/gallery');
 		}
 		
 	}
	function index() {
		$params = $this->request->params;
		
		$renderedPage = 'index';
		/***********************************/
		$conditions = array('Page.identifier'=>'gallery','Page.status'=>array(1));
		$currentPage = $this->Page->find('first',array('conditions'=>$conditions));
		if(!isset($currentPage['Page'])){
			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
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
		/***********************************/
		
		if(isset($params['id'])){
			
			$album = $this->GalleryAlbum->find('first',array('conditions'=>array('GalleryAlbum.id'=>$params['id'])));
			if(!isset($album['GalleryAlbum'])){
				$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');	
				$this->redirect('/gallery');	
			}
			$this->set('album',$album['GalleryAlbum']);
			$this->set('albumImages',$album['GalleryImages']);
			$this->set('headerImagealbumUrl',true);
			$renderedPage = 'album_images';
			
		}
		$this->paginate = array(
			'limit' => 10,
			'order' => array(
				'created' => 'desc'
			)
		);
		
		$this->set('albums',$this->paginate($this->GalleryAlbum));
		
		$this->render($renderedPage);
	}	
	
	
	
}
