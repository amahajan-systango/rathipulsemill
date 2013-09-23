<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
    //...
	public $components = array('Email','Session');
    function beforeFilter(){
 		$params = $this->request->params;
 		$controller = $params['controller'];
 		$controllerArrays = array('pages','admin','users','blog','calendar','forum','gallery');
 		
		if(!in_array($controller,$controllerArrays)){
			//$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');	
    		$this->redirect("/");	
		}
 	}
    /*public $components = array(
        'Session',
        'Auth' => array(
            //'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            //'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        )
    );

  
    public function isAuthorized($user) {
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'admin') {
		    return true;
		}

		// Default deny
		return false;
	}*/
    //...
    
    
    /****	Common function to send email	****/
	protected function sendEmail($to,$subject,$body,$from=null,$fromName=null){
 		
 		
 		if(!isset($from)){
 			$from = ADMIN_ACCOUNT_SENDER_EMAIL;
 		}
 		if(!isset($fromName)){
 			$fromName = EMAIL_SENDER_NAME;
 		}
		
		$headers = "From:" . $fromName;
		if(mail($to,$subject,$body,$headers)){
			return true;
		}
		else{
			return false;
		}	
    }
    
}
