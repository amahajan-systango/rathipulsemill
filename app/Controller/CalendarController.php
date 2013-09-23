<?php

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CalendarController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Calendar';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array('Config','Page','Event');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
 
  	function beforeFilter(){
 		if($this->action=='index' || $this->action=='events'){

 		}
 		else{
 			$this->Session->setFlash('404 Error, The page that you are looking for does not exist.','error');	
			$this->redirect('/calendar');	
 		}
 	}
 
 
	public function index() {
		$conditions = array('Page.identifier'=>'calendar','Page.status'=>array(1));
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
		
		$params = array('fields' => array('Config.key','Config.value'));
		$config = $this->Config->find('list',$params);
		$this->set('configData',$config);
		$this->set('theme',"site/".$config['theme']);
		$this->set('companyName',ucfirst($config['company_name']));
	}	
	
	function events(){
		$this->autoRender = false;
		/*$today = date("Y-m-d");
	    $events=$this->Event->find('all', array('conditions' => array('or'=>array('start_date >=' => $today,'end_date >=' => $today))));*/
		$events=$this->Event->find('all');
		$this->set('events',$events);
		$rows = array();
		  for ($a=0; count($events)> $a; $a++) {
		    $rows[] = array('id' => $events[$a]['Event']['id'],
		    'title' => $events[$a]['Event']['title'],
		    'location' => $events[$a]['Event']['location'],
		    'start' => date('Y-m-d',strtotime($events[$a]['Event']['start_date'])),
		    'end' => date('Y-m-d',strtotime($events[$a]['Event']['end_date'])),
		    'url'=> SITE_URL.'/events/view/'.$events[$a]['Event']['id'],
		    'desc'=> $events[$a]['Event']['description'],
		    );
		  }
		  echo json_encode($rows);			
		  exit;
	}
	
}
