<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'admin', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'admin', 'action' => 'login')
        )
    );
    
    
    public function beforeFilter() {
       
	    parent::beforeFilter();
        $this->Auth->allow('logout');
        $this->Auth->allow('forgotPassword');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function login() {
    	if($this->isAdminLoggedin()){
    		 $this->redirect($this->Auth->redirect());
    	}
    	$this->layout = 'admin_login';
		if ($this->request->is('post')) {
		    if ($this->Auth->login()) {
		        $this->redirect($this->Auth->redirect());
		    } else {
		        $this->Session->setFlash(__('Invalid username or password, try again'));
		    }
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	private function isAdminLoggedin(){

    	$user = $this->Session->read("Auth.User");
    	if($user['role']=="admin"){
    		return true;
    	}
    	return false;
	}
	
		function forgotPassword(){
		$this->layout = 'admin_login';
		if(isset($this->data['User'])){
			$userEmail = trim($this->data['User']['email']);
			$user = $this->User->find('first',array('conditions'=>array('email'=>$userEmail)));
			if(!$user['User'] && !isset($user['User'])){
				$this->Session->SetFlash('Not a valid email , Please try again .!','error');
				return;
			}
			if($user['User']){
				$newPassword = substr(md5(uniqid(mt_rand(), true)), 0, 6);
				$this->Auth->password($newPassword);
				$user['User']['password'] = $newPassword;
				
				$subject = 'WIND :: Account Password';
				
				$userEmail = '<a href="mailto:'.$userEmail.'" target="_blank">'.$userEmail.'</a>';
				$loginLink = '<p>Now you can <a href="'.SITE_URL.'/admin/login" target="_blank">login</a></p>';
				
				$message = '<b>Welcome to WIND</b><p/><span>Your password for account email '.$userEmail.
						   ' is <b>'. $newPassword .'</b></span><p/><p/>'.$loginLink;
				
				if($this->User->save($user['User'])){
					if($this->sendEmail($userEmail,$subject,$message)){
						$this->Session->setFlash('Your password has been sent to your email address.','success');
						$this->redirect('/admin/login');		
					}
				}else{
					$this->Session->SetFlash('Internal Error!','error');
				}
			}
		}
	}
}
