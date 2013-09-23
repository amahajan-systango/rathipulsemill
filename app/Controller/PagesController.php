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
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Config','Page','BlogPost','NewsletterEmail');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
	
		$params = $this->request->params;
			
		$conditions = array('Page.id'=>'1','Page.status'=>array(1));
		if(isset($params['identifier'])){
			
			switch($params['identifier']){
				case 'home':
					//echo $params['identifier'];
					//$this->redirect("/");	
					break;
				case 'admin':
					$this->redirect("/admin/index/");
					break;
				case 'blog':
					$this->redirect("/blog/");
					break;
				case 'forum':
					$this->redirect("/forum/");	
					break;
				case 'calendar':
					$this->redirect("/calendar/");	
					break;	
				case 'gallery':
					$this->redirect("/gallery/");	
					break;		
			}
			$conditions = array('Page.identifier'=>$params['identifier'],'Page.status'=>array(1));
		}
		else{		
			$this->layout = 'home';
		}
		
		if(isset($params['identifier'])){
			if($params['identifier']=='home'){
				$this->layout = 'home';
			}
		}		
		$currentPage = $this->Page->find('first',array('conditions'=>$conditions));
		if(!isset($currentPage['Page'])){
			//$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');	
    		$this->redirect("/");	
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
		$this->set('theme','site/classics');  	
		
		
		$params = array('fields' => array('Config.key','Config.value'));
		$config = $this->Config->find('list',$params);
		$this->set('configData',$config);
		$this->set('theme',"site/".$config['theme']);
		$this->set('companyName',ucfirst($config['company_name']));
		
	}
	
	function sendFeedbackMail(){
		$contactUsPage = $this->Page->find('first',array('conditions'=>array('Page.id'=>9)));
		$this->Session->write('Feedback',$this->data['Feedback']);
		if(isset($this->data['Feedback'])){
			$feedback = $this->data['Feedback'];
			$from = $feedback['from'];
			if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $from)){
				$this->Session->setFlash('Please enter valid email address.','error');	
				$this->redirect("/".$contactUsPage['Page']['identifier']);	
			}
			/*************  Captcha  ********************/
			if($this->data['Feedback']['captcha']!=$this->Session->read('captcha')){
					$this->Session->setFlash('Please enter correct captcha code.','error');
					$this->redirect("/".$contactUsPage['Page']['identifier']);
			}
			/********************************************/
			$config = $this->Config->find('first',array('conditions'=>array('Config.key'=>'feedback_email')));
			$to = $config['Config']['value'];
			$subject = $feedback['subject'];
			$messageBody = $feedback['feedback'];
			
			$fromName = $from;
			if($this->sendEmail($to, $subject, $messageBody,$from,$fromName)){
		  		$this->Session->setFlash('Your feedback has been sent successfully. Thank you for your cooperation.','success');	
		  	}
		}
		else{
			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');
		}
		$this->redirect("/".$contactUsPage['Page']['identifier']);	
	}
	
	
	
	function subscription(){
		$contactUsPage = $this->Page->find('first',array('conditions'=>array('Page.id'=>9)));
		$this->Session->write('Feedback',$this->data['Feedback']);
		if(isset($this->data['Subscription'])){
			$subscription = $this->data['Subscription'];
			$email = $subscription['email'];
			if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)){
				$this->Session->setFlash('Please enter valid email address.','error');	
				$this->redirect("/".$contactUsPage['Page']['identifier']);	
			}
			
			$emailExistcondition = array('NewsletterEmail.email'=>$email);
			
			if($subscription['subscription']){
				
				if($this->isEmailExist($emailExistcondition)){
					$this->Session->setFlash('You have subscribed.','success');	
				}
				else{
					$subscription['newsletter_id'] = 1;
					if($this->NewsletterEmail->save($subscription))	{
						$this->Session->setFlash('You have subscribed successfully.','success');
					}
				}
				
			}else{
				if($this->isEmailExist($emailExistcondition)){					
					$newslatterEmail = $this->NewsletterEmail->find('first',array('conditions'=>array('NewsletterEmail.email'=>$email)));
					$newslatterId = $newslatterEmail['NewsletterEmail']['id'];
					
					if($this->NewsletterEmail->delete($newslatterId)){
						$this->Session->setFlash('You have unsubscribed successfully.','success');	
					}else{
						$this->Session->setFlash('Something went wrong, please contact the site administrator.','error');	
					}
					
				}	
				else{
					$this->Session->setFlash('You have already unsubscribed.','error');	
				}
			}
		}
		else{
			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');	
		}
		$this->redirect("/".$contactUsPage['Page']['identifier']);	
	}
	
	private function isEmailExist($condition){
		$emailExist = $this->NewsletterEmail->find('first',array('conditions'=>array($condition)));
		if(isset($emailExist['NewsletterEmail'])){
			return true;	
		}
	}
	function captcha_image(){
		App::import('Vendor', 'captcha/captcha');
		$captcha = new captcha();
		$captcha->show_captcha();
	}
	function deleteSession(){
		$this->Session->delete('Feedback');		
		return;
	}
}
