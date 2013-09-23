<?php

class AdminController extends AppController {

    public $components = array(
        'Email',
        'Session',
        'ImageManager',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'admin', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'admin', 'action' => 'login')
        )
    );
    
    var $uses = array('Page', 'User', 'Config', 'BlogCategory', 'BlogPost', 'BlogComment', 'ForumCategory', 'ForumQuestion', 'ForumComment','Event','GalleryAlbum','GalleryImage', 'Newsletter','NewsletterEmail');
    
   
    function beforeFilter(){
 		
		$this->paginate = array(
			'order' => array(
				'id' => 'asc'
			)
		);
		
		$this->set('pages',$this->paginate($this->Page));
 		$this->set('activePageFlag',true);

 		$this->set('activePageLink',false);
 	}
    
    public function index() {
   		
        $this->layout = 'admin';
        $this->set('pageHeading','Welcome');
    }
    


    function manage_page() {
    	
		$params = $this->request->params;
		$this->set('activePageLink',false);
		
		$this->layout = 'admin';
		$this->set('pageHeading','Manage');
		
		if(isset($this->data['Page'])){
			if(isset($this->data['Config']['feedback_email'])){
				$config['id'] = 8;
				$config['key'] = 'feedback_email';
				$config['value'] = $this->data['Config']['feedback_email'];
				$this->Config->save($config);
	   		}
			$page = $this->data['Page'];
			$page['content'] = $this->data['rte1'];
			$page['identifier'] = strtolower(str_replace(" ","-",$page['title']));
			if($this->Page->save($page)){
	   		    $this->Session->setFlash('Page has been saved successfully.','success');
	   		}    
		}
		
		if(isset($params['action_name'])){
			if(strstr($params['action_name'],'page:')){
				$page = explode(":",$params['action_name']);
				$pageNo = $page[1];
				$this->request->params['named'] = array('page' => $pageNo);
			}
			
			switch($params['action_name']){
				case 'add':
					$this->set('page',null);
					$this->render('add_page');		
					break;
				case 'edit':
					if(isset($params['page_id'])){
						$page = $this->Page->find('first',array('conditions'=>array('Page.id'=>$params['page_id'])));
						$this->set('page',$page['Page']);
						$this->set('pageHeading',ucfirst($page['Page']['name']));
						switch($params['page_id']){
							case 1:
									//$this->set('pageHeading','Page-1');									
									$this->set('activePageLink','1');
									$this->set('activePageFlag',false);
									break;
							case 2:
									//$this->set('pageHeading','Page-2');
									$this->set('activePageLink','2');
									$this->set('activePageFlag',false);
									break;
							case 3:
									//$this->set('pageHeading','Page-3');
									$this->set('activePageLink','3');
									$this->set('activePageFlag',false);
									break;
							case 4:
									//$this->set('pageHeading','Page-4');
									$this->set('activePageLink','4');
									$this->set('activePageFlag',false);
									break;						
							case 9:
									//$this->set('pageHeading','Contact Us');
									$this->set('activePageLink','contact_us');	
									$this->set('activePageFlag',false);
									$config = $this->Config->find('first',array('conditions'=>array('Config.key'=>'feedback_email')));
									$this->set('feedback_email',$config['Config']['value']);
									break;		
						}
						
						
						$this->render('add_page');
				   	}
					break;
				case 'delete':
					if(isset($params['page_id'])){
						if($params['page_id']>=10){
							if($this->Page->delete($params['page_id'])){
								$this->Session->setFlash('Page has been deleted successfully.','success');
							}
							else{
								$this->Session->setFlash('You are not authorized to perform this action.','error');
							}	
						}
						else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
						}	
				   	}
				   	else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
						}
				   	$this->redirect('/admin/manage_page');	
				   	break;
				
				case 'enabled':
					if(isset($params['page_id'])){
						$this->Page->id=$params['page_id'];
						$this->Page->read();
						if($this->Page->saveField('status',1)){
							$this->Session->setFlash('Page enabled successfully.','success');
						}
						else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
						}	
				   	}
				   	else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
					}
				   	$this->redirect('/admin/manage_page');		
				   	break;			
				case 'disabled':
					if(isset($params['page_id'])){
						$this->Page->id=$params['page_id'];
						$this->Page->read();
						if($this->Page->saveField('status',0)){
							$this->Session->setFlash('Page disabled successfully.','success');
						}
						else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
						}	
				   	}
				   	else{
							$this->Session->setFlash('You are not authorized to perform this action.','error');
					}
				   	$this->redirect('/admin/manage_page');		
				   	break;			
			}
		   	
		}
		$this->paginate = array(
			'order' => array(
				'id' => 'asc'
			)
		);
		
		$this->set('pages',$this->paginate($this->Page));		
	}
	
	function beforePagePreview(){
		$this->autoRender = false;
		$this->Session->write('admin_page_preview',$this->params['data']);
		return json_encode(array('data'=>1));
	}
	
	function pagePreview(){
		
		
		$currentPage = $this->Session->read('admin_page_preview');
		$currentPage['identifier'] = strtolower(str_replace(" ","-",$currentPage['title']));
		$this->set('title', $currentPage['title']);
		
		$this->set('currentPage', $currentPage);
		
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
		
		
		$config_params = array('fields' => array('Config.key','Config.value'));
		$config = $this->Config->find('list',$config_params);
		$this->set('configData',$config);
		$this->set('theme',"site/".$config['theme']);
		$this->set('companyName',ucfirst($config['company_name']));
		
	}
	
	private function uploadSiteConfigImage($image, $type){
		$image_name = rand().mktime();
		$error_uploading = false;
		$extension = strtolower(strrchr($image['name'], '.'));
		$support_extensions = array(".jpg",".jpeg",".png",".gif");
		if(in_array($extension, $support_extensions)){
			
			$imageManager = $this->ImageManager;
			$imageManagerObj = $imageManager->createObject($image['tmp_name'],$extension);
			$imageManager->getImgUploadingError();
			if($imageManager->getImgUploadingError()){
				$this->Session->setFlash('Error in uploading image!','error');	
	        	$this->redirect("/admin/site_setting");
	        	$error_uploading = true;
	        	return;
			}else{
				
				switch($type){
					case 'logo':
	  				 	$imageManager->resizeImage(160, 80,'crop');
	  				 	break;
	  				case 'header':
	  				 	$imageManager->resizeImage(820, 210,'crop');
	  				 	break; 	
	  				case 'footer':
	  				 	$imageManager->resizeImage(980, 100,'crop');
	  				 	break; 	 	
				}
				$path = APP."webroot/images/";
				$resize_img_name = $image_name.$extension;
				if($imageManager->saveImage($path.$resize_img_name, 100)){
					return $resize_img_name;
				}	
			}
		}
	}	
	
	public function site_setting() {
		
		$this->layout = 'admin';
		$this->set('pageHeading','Site Setting');
		if(isset($this->data['Setting'])){
			
		    $i = 1;
	   	    $c_array= array();
	   	    foreach($this->data['Setting'] as $key=>$value) {
				$c_array[$i]['id'] = $i;
				$c_array[$i]['key'] = $key;
				$c_array[$i]['value'] = $value;
				
				if($key=="logo_image"){
					$image= $c_array[$i]['value'];
					
					if($image['name']){
						if($logoImageName = $this->uploadSiteConfigImage($image,'logo')){
							$c_array[$i]['value'] = $logoImageName;
						}
					}
					else{
						if($this->data['Action']['remove_logo_image']){
							$c_array[$i]['value'] = "";
						}else{
							unset($c_array[$i]);
						}	
					}
				}
				if($key=="header_image"){
					$image= $c_array[$i]['value'];
					if($image['name']){
						if($logoImageName = $this->uploadSiteConfigImage($image,'header')){
							$c_array[$i]['value'] = $logoImageName;
						}
					}
					else{
						if($this->data['Action']['remove_header_image']){
							$c_array[$i]['value'] = "";
						}else{
							unset($c_array[$i]);
						}
					}
				}
				if($key=="footer_image"){
					$image= $c_array[$i]['value'];
					if($image['name']){
						if($logoImageName = $this->uploadSiteConfigImage($image,'footer')){
							$c_array[$i]['value'] = $logoImageName;
						}
					}
					else{
						if($this->data['Action']['remove_footer_image']){
							$c_array[$i]['value'] = "";
						}else{
							unset($c_array[$i]);
						}
					}
					break;
				}
				$i++;	
			}
			if(isset($this->data['Config']['newsletter'])){
				$i++;
				$c_array[$i]['id'] = 9;
				$c_array[$i]['key'] = 'newsletter';
				$c_array[$i]['value'] = $this->data['Config']['newsletter'];
			}
			if($this->Config->saveAll($c_array)){
				$this->Session->setFlash('Setting has been updated.','success');
				$this->redirect('/admin/site_setting');	    		
			}
	    }
		
		
		$params = array('fields' => array('Config.key','Config.value'));
		$this->set('config',$this->Config->find('list',$params));
		
	}
	
	
	function approveComment($id,$commentId){
		if(isset($id)){
            $comment = $this->ForumComment->findById($commentId);
            $comment['ForumComment']['is_approve'] = 1;			
            if($this->ForumComment->save($comment['ForumComment'])){
				$this->Session->setFlash('Comment has been approved.','success');
			}	
		}
		$this->redirect('/admin/forum/postdetail/'.$id);
	}

	function rejectComment($id,$commentId){
		if(isset($id)){
			if($this->ForumComment->delete($commentId,true)){
				$this->Session->setFlash('comment has been rejected.','success');
			}	
		}
		$this->redirect('/admin/forum/postdetail/'.$id);
	}


	
	/** change password **/
    public function change_password() {
        $this->layout = 'admin';
		$this->set('pageHeading','Change Password');
		$user = $this->User->findById($this->Auth->user('id'));
		
		
		$this->set('user',$user['User']);
		if(isset($this->data['User'])){

			//check for blank or empty field
			if(empty($this->data['User']['oldPassword'])){
				$this->set("old_password_error","Old Password Required");
				return;
			}
			
			// Password hashing
            $userObj['User']['id'] = $this->Auth->user('id');

			$userObj['User']['oldPassword']=AuthComponent::password($this->data['User']['oldPassword']);

			$userObj['User']['password']=AuthComponent::password($this->data['User']['password']);			
								
//            echo AuthComponent::password("admin");exit;
//            echo $userObj['User']['oldPassword'];
			//Check old password match
			$userData= $this->User->find('first',array('conditions'=>array('id'=>$userObj['User']['id'], 
																	'password'=>$userObj['User']['oldPassword'])));
			
			//set User data
			$this->User->set($userObj['User']);
			
			//Validate user data
		    if(!isset($userData['User'])){	
					unset($userObj['User']);
					$this->Session->setFlash("Old password not matched!.","error");
					return;
			}			
			
			if(isset($userData['User']['password']) && $userData['User']['password']==$userObj['User']['password']){
				$this->Session->setFlash("Old password and new password are same. Please try with different password","error");
				unset($userObj['User']);
				
				return;			
			}
			
			
			
			$this->User->updateAll(array('password'=>"'".$userObj['User']['password']."'"),array('id'=>$userObj['User']['id'], 'password'=>$userObj['User']['oldPassword']));
			unset($userObj['User']);
			$this->Session->setFlash("Password changed successfully.","success");
		}
    }
    /** end **/
	
	function blog() {
		$params = $this->request->params;

		$this->layout = 'admin';
		$this->set('pageHeading','Blog');
		
		
		
		if(isset($params['action_name'])){
			if(strstr($params['action_name'],'page:')){
				$page = explode(":",$params['action_name']);
				$pageNo = $page[1];
				$this->request->params['named'] = array('page' => $pageNo);
			}
			switch($params['action_name']){
				case 'category':
					if(isset($params['id'])){
						$BlogCategory = $this->BlogCategory->findById($params['id']);
						$this->set('blogCategory',$BlogCategory['BlogCategory']);
					}
					$this->paginate = array(
						//'limit'=>10,
						'order'=>array(
							'created'=>'desc'
						)
					);
					$this->set('blogCategories',$this->paginate($this->BlogCategory));
					$this->render('blog_category');		
					break;
				case 'post':
					if(isset($params['id'])){
						$blogPost = $this->BlogPost->findById($params['id']);
						$this->set('blogPost',$blogPost['BlogPost']);
					}
					$categoriesList = $this->BlogCategory->find('list');
					$this->set('categoriesList',$categoriesList);
					$this->render('blog_post');		
					break;
				case 'postdetail':
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
						
						$this->set('blogPost',$blogPost);
						$this->render('postdetail');		
					}else{
						$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    	$this->redirect('/admin/blog');	
					}
					break;	
			}
		}
		
		if(isset($this->data['BlogCategory'])){
			
		    if($this->BlogCategory->save($this->data['BlogCategory'])){
		    	$this->Session->setFlash('Category has been saved.','success');	
		    	$this->redirect('/admin/blog/category');		
		    }   
		}
		
		if(isset($this->data['BlogPost'])){
			
		    if($this->BlogPost->save($this->data['BlogPost'])){
		    	$this->Session->setFlash('Blog has been posted.','success');	
		    	$this->redirect('/admin/blog');		
		    }   
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
			//'limit' => 10,
			'order' => array(
				'created' => 'desc'
			),
			'fields'=>'BlogPost.*,BlogCategory.id,BlogCategory.name, count(BlogComment.blog_post_id) AS count',
			'group'=>'BlogPost.id',
		);
		
		
		$this->set('blogs',$this->paginate($this->BlogPost));
		
	}
	
	function deleteBlogCategory($id){
		if(isset($id)){
			if($this->BlogCategory->delete($id,true)){
				$this->Session->setFlash('Category has been deleted.','success');
			}	
		}
		$this->redirect('/admin/blog/category');
	}
	
	function deleteBlogPost($id) {
		if(isset($id)){
			if($this->BlogPost->delete($id,true)){
				$this->Session->setFlash('Blog post has been deleted.','success');
			}	
		}
		$this->redirect('/admin/blog');
	}
	  
	function deleteBlogComment($postId,$commentid) {
		
		if(isset($commentid)){
			if($this->BlogComment->delete($commentid)){
				$this->Session->setFlash('Blog Comment has been deleted.','success');
			}	
		}
		$this->redirect('/admin/blog/postdetail/'.$postId);
	}
	   
	function forum() {
		$params = $this->request->params;

		$this->layout = 'admin';
		$this->set('pageHeading','Forum');		
		
		if(isset($params['action_name'])){
			switch($params['action_name']){
				case 'category':
					if(isset($params['id'])){
						$ForumCategory = $this->ForumCategory->findById($params['id']);
						$this->set('forumCategory',$ForumCategory['ForumCategory']);
					}
					$this->set('forumCategories',$this->ForumCategory->find('all'));
					$this->render('forum_category');		
					break;
				case 'postdetail':
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
							'fields'=>array('ForumQuestion.*, ForumCategory.id, ForumCategory.name, count(ForumComment.forum_question_id) AS count'),
							'group'=>'ForumQuestion.id',
						));
						if(!isset($question['ForumQuestion'])){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
					    	$this->redirect('/admin/forum');	
						}
						$this->set('forum_question',$question);
						$this->render('forum_postdetail');		
					}else{
						$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    	$this->redirect('/admin/forum');	
					}
					break;	
			}
		}
		
		if(isset($this->data['ForumCategory'])){
			
		    if($this->ForumCategory->save($this->data['ForumCategory'])){
		    	$this->Session->setFlash('Category has been saved.','success');	
		    	$this->redirect('/admin/forum/category');		
		    }   
		}
/*		
		if(isset($this->data['BlogPost'])){
			
		    if($this->BlogPost->save($this->data['BlogPost'])){
		    	$this->Session->setFlash('Blog has been posted.','success');	
		    	$this->redirect('/admin/blog');		
		    }   
		}
		*/
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
			//'limit' => 10,
			'order' => array(
				'created' => 'desc'
			),
			'fields'=>'ForumQuestion.*,ForumCategory.id,ForumCategory.name, count(ForumComment.forum_question_id) AS count',
			'group'=>'ForumQuestion.id',
		);
		//pr($this->paginate($this->ForumQuestion));
		//exit;
		
		$this->set('forums',$this->paginate($this->ForumQuestion));
	}	   
	
	function deleteForumCategory($id){
		if(isset($id)){
			if($this->ForumCategory->delete($id,true)){
				$this->Session->setFlash('Forum Category has been deleted.','success');
			}	
		}
		$this->redirect('/admin/forum/category');
	}
	
	function deleteForumQuestion($id) {
		if(isset($id)){
			if($this->ForumQuestion->delete($id,true)){
				$this->Session->setFlash('Forum Question post has been deleted.','success');
			}	
		}
		$this->redirect('/admin/forum');
	}
	
	
	function event(){
		$params = $this->request->params;
		$this->layout = 'admin';
		$this->set('pageHeading','Event');
		
		if(isset($params['action_name'])){
			switch($params['action_name']){
				case 'add':
					$this->render('add_event');		
					break;
				case 'edit':
					if(isset($params['id'])){
						$event = $this->Event->findById($params['id']);
						//pr($event['Event']);
						if(!$event['Event']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    		$this->redirect('/admin/event');	
						}
						$this->set('event',$event['Event']);
					}else{
						$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    	$this->redirect('/admin/event');
					}
					$this->render('add_event');		
					break;
			}
		}
				
		if(isset($this->data['Event'])){
			
			if(isset($this->data['Event']['id'])){
				$eventData['id'] = $this->data['Event']['id'];
			}
			$eventData['title'] = $this->data['Event']['title'];
			$eventData['start_date'] = date("Y-m-d",strtotime($this->data['Event']['start_date']));
			$eventData['start_time'] = $this->data['Event']['start_time'];
			$eventData['end_date'] = date("Y-m-d",strtotime($this->data['Event']['end_date']));
			$eventData['location'] = $this->data['Event']['location'];
			$eventData['description'] = $this->data['Event']['description'];
		    if($this->Event->save($eventData)){
		    	$this->Session->setFlash('Event has been saved.','success');	
		    	$this->redirect('/admin/event');		
		    }   
		}
		
		$this->paginate = array(
			//'limit' => 10,
			'order' => array(
				'created' => 'desc'
			)
		);
		$this->set('events',$this->paginate($this->Event));
	}
	
	function deleteEvent($id){
		if(isset($id)){
			if($this->Event->delete($id)){
				$this->Session->setFlash('Event has been deleted.','success');
			}	
		}
		$this->redirect('/admin/event');
	}
	
	function gallery(){
		$params = $this->request->params;
		
		$this->layout = 'admin';
		$this->set('pageHeading','Photo Gallery');
		
		if(isset($this->data['GalleryAlbum'])){
			
			$image = $this->data['GalleryAlbum']['image'];
			if($this->data['GalleryAlbum']['id']>0){
				
				$galleryAlbum['id'] = $this->data['GalleryAlbum']['id'];
				$galleryAlbum['type'] = $this->data['GalleryAlbum']['type'];
				$galleryAlbum['description'] = $this->data['GalleryAlbum']['description'];	
				if(is_uploaded_file($image['tmp_name'])){		
					$image_name = $this->uploadAlbumPic($image,null,$galleryAlbum['id']);
					$galleryAlbum['image'] = $image_name;	
				}
				if($this->GalleryAlbum->save($galleryAlbum)){
					$this->Session->setFlash('Album has been updated successfully.','success');	
					$this->redirect("/admin/gallery");	
				}			
			}
			else{
			    if(is_uploaded_file($image['tmp_name'])){
					/******** Create Album Directory structure*******/
					$structurePath = APP."webroot/images/gallery/albums/";
					$dir = mktime();
					if (!mkdir($structurePath.$dir."/images", 0777, true)) {
				        $this->Session->setFlash('Failed to create album, album may be already exist!', 'error');	
				        $this->redirect("/admin/gallery");
				        return;
					}
					/***********************************************/
					if($image_name = $this->uploadAlbumPic($image,$dir)){
						$galleryAlbum['type'] = $this->data['GalleryAlbum']['type'];
						$galleryAlbum['dir'] = $dir;
						$galleryAlbum['description'] = $this->data['GalleryAlbum']['description'];
						$galleryAlbum['image'] = $image_name;
						if($this->GalleryAlbum->save($galleryAlbum)){
							$this->Session->setFlash('Album has been saved successfully.','success');	
							$this->redirect("/admin/gallery");	
						}
					}		
				}
				else {
					$this->Session->setFlash('Please upload correct image file!','error');	
                    $this->redirect("/admin/gallery");
                    $error_uploading = true;
				}   
			}
		}
		
		if(isset($this->data['GalleryImage'])){
			
			$image = $this->data['GalleryImage']['image'];
			if($this->data['GalleryImage']['id']>0){
				
				$galleryImage['id'] = $this->data['GalleryImage']['id'];
				$galleryImage['album_id'] = $this->data['GalleryImage']['album_id'];
				$galleryImage['caption'] = $this->data['GalleryImage']['caption'];	
				
				if(is_uploaded_file($image['tmp_name'])){		
					$structurePath = APP."webroot/images/gallery/albums/".$this->data['GalleryImage']['album_dir']."/images/";
					$image_name = $this->uploadImagePic($image,$structurePath,$galleryImage['id']);
					$galleryImage['image'] = $image_name;	
				}
				if($this->GalleryImage->save($galleryImage)){
					$this->Session->setFlash('Album has been updated successfully.','success');	
					$this->redirect("/admin/gallery/manage_album/".$galleryImage['album_id']);	
				}			
			}
			else{
			    if(is_uploaded_file($image['tmp_name'])){
					$structurePath = APP."webroot/images/gallery/albums/".$this->data['GalleryImage']['album_dir']."/images/";	
					if($image_name = $this->uploadImagePic($image,$structurePath)){
						$galleryImage['caption'] = $this->data['GalleryImage']['caption'];
						$galleryImage['album_id'] = $this->data['GalleryImage']['album_id'];
						$galleryImage['image'] = $image_name;
						if($this->GalleryImage->save($galleryImage)){
							$this->Session->setFlash('Album image has been saved successfully.','success');	
							$this->redirect("/admin/gallery/manage_album/".$galleryImage['album_id']);	
						}
					}	
					
				}
				else {
					$this->Session->setFlash('Please upload correct image file!','error');	
                    $this->redirect("/admin/gallery");
                    $error_uploading = true;
				}   
			}
		}
		
		$this->paginate = array(
			//'limit' => 10,
			'order' => array(
				'created' => 'desc'
			)
		);
		$this->set('galleryAlbums',$this->paginate($this->GalleryAlbum));
		
		if(isset($params['action_name'])){
			switch($params['action_name']){
				case 'album':
					if(isset($params['id'])){
						$galleryAlbum = $this->GalleryAlbum->findById($params['id']);

						if(!$galleryAlbum['GalleryAlbum']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    		$this->redirect('/admin/gallery');	
						}
						$this->set('galleryAlbum',$galleryAlbum['GalleryAlbum']);
					}else{
						$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    	$this->redirect('/admin/gallery');
					}
					$this->render('gallery');		
					break;
				case 'manage_album':
					
					if(isset($params['id'])){
						$galleryAlbum = $this->GalleryAlbum->findById($params['id']);
						//pr($galleryAlbum);
						//exit;
						if(!$galleryAlbum['GalleryAlbum']){
							$$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    		$this->redirect('/admin/gallery');	
						}
						$this->set('galleryAlbum',$galleryAlbum['GalleryAlbum']);
						//$this->set('galleryAlbum',$galleryAlbum['GalleryAlbum']);
						$this->paginate = array(
							'conditions'=>array('GalleryImage.album_id'=>$params['id']),
							//'limit' => 10,
							'order' => array(
								'created' => 'desc'
							)
						);

						$this->set('galleryImages',$this->paginate($this->GalleryImage));
					}
					elseif(isset($params['album_id']) && isset($params['image_id'])){
						$galleryAlbum = $this->GalleryAlbum->findById($params['album_id']);
						if(!$galleryAlbum['GalleryAlbum']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    		$this->redirect('/admin/gallery');	
						}
						$this->set('galleryAlbum',$galleryAlbum['GalleryAlbum']);
						
						$galleryImage = $this->GalleryImage->findById($params['image_id']);
						
						if(!$galleryImage['GalleryImage']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    		$this->redirect('/admin/gallery');	
						}
						$this->set('galleryImage',$galleryImage['GalleryImage']);
						//pr($galleryImage);
						//exit;
						$this->paginate = array(
							'conditions'=>array('GalleryImage.album_id'=>$params['album_id']),
							//'limit' => 10,
							'order' => array(
								'created' => 'desc'
							)
						);

						$this->set('galleryImages',$this->paginate($this->GalleryImage));
					}
					else{
						$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');
				    	$this->redirect('/admin/gallery');	
					}
									
					
					$this->render('manage_album');		
					break;
			}
		}
	}
	
	private function uploadAlbumPic($image, $dir=null, $albumId=null){
		
		$structurePath = APP."webroot/images/gallery/albums/";
		$error_uploading = false;
		$extension = strtolower(strrchr($image['name'], '.'));
		$support_extensions = array(".jpg",".jpeg",".png",".gif");
		if(in_array($extension, $support_extensions)){
			
			$imageManager = $this->ImageManager;
			$imageManagerObj = $imageManager->createObject($image['tmp_name'],$extension);
			$imageManager->getImgUploadingError();
			if($imageManager->getImgUploadingError()){
				$this->Session->setFlash('Error in uploading album image!','error');	
	        	$this->redirect("/admin/gallery");
	        	$error_uploading = true;
	        	return;
			}else{
				if(isset($albumId)){
					$album = $this->GalleryAlbum->findById($albumId);
					$dir = $album['GalleryAlbum']['dir'];
					$oldFile = $album['GalleryAlbum']['image'];
					@unlink($structurePath.$dir."/".$oldFile);	
				}
				$imageManager->resizeImage(90, 60,'crop');
				$resize_img_name = $dir.$extension;
				if($imageManager->saveImage($structurePath.$dir."/".$resize_img_name, 100)){
					return $resize_img_name;
				}	
			}
		}
	}
	
	private function uploadImagePic($image, $path, $imageId=null){
		$image_name = mktime();
		$error_uploading = false;
		$extension = strtolower(strrchr($image['name'], '.'));
		$support_extensions = array(".jpg",".jpeg",".png",".gif");
		if(in_array($extension, $support_extensions)){
			
			$imageManager = $this->ImageManager;
			$imageManagerObj = $imageManager->createObject($image['tmp_name'],$extension);
			$imageManager->getImgUploadingError();
			if($imageManager->getImgUploadingError()){
				$this->Session->setFlash('Error in uploading album\'s image!','error');	
	        	$this->redirect("/admin/gallery");
	        	$error_uploading = true;
	        	return;
			}else{
				if(isset($imageId)){
					$image = $this->GalleryImage->findById($imageId);
					$oldFile = $image['GalleryImage']['image'];
					@unlink($path.$oldFile);	
				}
				$imageManager->resizeImage(540, 360,'crop');
				$resize_img_name = $image_name.$extension;
				if($imageManager->saveImage($path.$resize_img_name, 100)){
					return $resize_img_name;
				}	
			}
		}
	}	
	
	function deleteGalleryAlbum($id) {
		$structurePath = APP."webroot/images/gallery/albums/";
		$album = $this->GalleryAlbum->findById($id);
		if(isset($album['GalleryAlbum'])){
			if($this->GalleryAlbum->delete($id,true)){
				$dir = $album['GalleryAlbum']['dir'];
				$dir = "test";
				//@remove_dir($structurePath.$dir);
				$this->Session->setFlash('Album has been deleted successfuly.','success');	
			}
		}else{
			$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
		}
		$this->redirect("/admin/gallery");
	}
	
	function deleteGalleryImage($id) {
		
		$galleryImage = $this->GalleryImage->find('first', array(
			'joins' => array(
				array(
					'table' => 'gallery_albums',
					'alias' => 'GalleryAlbum',
					'type' => 'INNER',
					'conditions' =>'GalleryAlbum.id = GalleryImage.album_id'
				)
			),
			'conditions' => array(
				'GalleryImage.id' => $id
			),
			'fields'=>array('GalleryAlbum.id, GalleryAlbum.dir, GalleryImage.id,GalleryImage.image'),
		));
		$structurePath = APP."webroot/images/gallery/albums/";
		$fileToDelete = $structurePath.$galleryImage['GalleryAlbum']['dir']."/images/".$galleryImage['GalleryImage']['image'];
		
		if(isset($galleryImage['GalleryAlbum'])){
			if($this->GalleryImage->delete($id)){
				@unlink($fileToDelete);
				$this->Session->setFlash('Album has been deleted successfuly.','success');	
			}
		}else{
			$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
		}
		$this->redirect("/admin/gallery/manage_album/".$galleryImage['GalleryAlbum']['id']);
	}
	
	
	private function isEmailExist($condition){
		$emailExist = $this->NewsletterEmail->find('first',array('conditions'=>array($condition)));
		if(isset($emailExist['NewsletterEmail'])){
			return true;	
		}
	}
	
	
	
	
	/**
    * Show all newsletter
    **/
  
    function newsletter(){
		$params = $this->request->params;
		
		$this->layout = 'admin';
		$this->set('pageHeading','Newsletter');
		
        $newsletters = $this->Newsletter->find('all');
        $this->set('newsletters',$newsletters);
		
		if(isset($this->data['Newsletter'])){
			if(isset($this->data['Newsletter'])){
				$newsletterList['id'] = $this->data['Newsletter']['id'];
			}
			$newsletterList['name'] = $this->data['Newsletter']['name'];
			if($this->Newsletter->save($newsletterList)){
				$this->Session->setFlash('List name has been saved successfully.','success');	
				$this->redirect("/admin/newsletter/list");	
			}
		}

		if(isset($this->data['NewsletterSend'])){
			
			$newsletter_id = $this->data['NewsletterSend']['newsletter_list_id'];
			
			$listEmails = $this->NewsletterEmail->find('list', array(
				'fields' => array('NewsletterEmail.id', 'NewsletterEmail.email'),
				'conditions' => array('NewsletterEmail.newsletter_id =' => $newsletter_id),
				'recursive' => 0
			));
			
			$tos = $listEmails;
			$subject = $this->data['NewsletterSend']['subject'];
			$messageBody = $this->data['NewsletterSend']['letter'];
			$from = ADMIN_ACCOUNT_SENDER_EMAIL;
			$fromName = EMAIL_SENDER_NAME;
			foreach($tos AS $to){
				if($this->sendEmail($to, $subject, $messageBody, $from, $fromName)){
			  		$this->Session->setFlash('Newsletter has been sent successfully.','success');	
			  	}
			}  	
		  	$this->redirect("/admin/newsletter/send");	
			
		}
		
		if(isset($this->data['NewsletterEmail'])){
			$emailExistcondition = array('NewsletterEmail.email'=>$this->data['NewsletterEmail']['email']);
			if($this->data['NewsletterEmail']['id']){
				$newsletterEmail['id'] = $this->data['NewsletterEmail']['id'];
				$emailExistcondition = array(
									 	"AND"=>array("NewsletterEmail.email"=>$this->data['NewsletterEmail']['email']),	
										"NOT"=>array("NewsletterEmail.id"=>$this->data['NewsletterEmail']['id'])
	   						   		   );
	   						   		   
	   			if($this->isEmailExist($emailExistcondition)){
					$this->Session->setFlash('This Email already exist.','error');	
					$this->redirect("/admin/newsletter/email");	
				}			   		   
			}
			
			if(!$this->data['NewsletterEmail']['id']){
				if($this->isEmailExist($emailExistcondition)){
					$this->Session->setFlash('This Email already exist.','error');	
					$this->redirect("/admin/newsletter/email");	
				}
			}
			
			$newsletterEmail['email'] = $this->data['NewsletterEmail']['email'];
			$newsletterEmail['newsletter_id'] = $this->data['NewsletterEmail']['newsletter_id'];
			if($this->NewsletterEmail->save($newsletterEmail)){
				$this->Session->setFlash('Newsletter Email has been saved successfully.','success');	
				$this->redirect("/admin/newsletter/email");	
			}
			
		}
		
		if(isset($params['action_name'])){
			switch($params['action_name']){
				case 'list':
					if(isset($params['id'])){
						$newsletter = $this->Newsletter->findById($params['id']);
						
						if(!$newsletter['Newsletter']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    		$this->redirect("/admin/newsletter");
						}
						$this->set('newsletter',$newsletter['Newsletter']);
					}
					$this->render('newsletter');	
					break;
				case 'email':
					if(isset($params['id'])){
						$newsletterEmail = $this->NewsletterEmail->findById($params['id']);
						
						if(!$newsletterEmail['NewsletterEmail']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    		$this->redirect("/admin/newsletter/email");
						}
						$this->set('newsletterEmail',$newsletterEmail['NewsletterEmail']);
					}
					$newsletterList = $this->Newsletter->find('list');
					$this->set('newsletterList',$newsletterList);
					
					$this->paginate = array(
						'joins' => array(
							array(
								'alias' => 'Newsletter',
								'table' => 'newsletters',
								'type' => 'INNER',
								'conditions' => 'NewsletterEmail.newsletter_id = Newsletter.id'
							)
						),
						//'limit' => 10,
						'order' => array(
							'created' => 'desc'
						),
						'fields'=>'Newsletter.*,NewsletterEmail.*'
					);
					$newsletterEmails = $this->paginate($this->NewsletterEmail);
					$this->set('newslettersEmails',$newsletterEmails);
					$this->render('newsletter_email');	
					break;
				case 'send':
					if(isset($params['id'])){
						$newsletterEmail = $this->NewsletterEmail->findById($params['id']);
						
						if(!$newsletterEmail['NewsletterEmail']){
							$this->Session->setFlash('You might have clicked an old link or entered url manually.','error');	
				    		$this->redirect("/admin/newsletter/email");
						}
						$this->set('newsletterEmail',$newsletterEmail['NewsletterEmail']);
					}
					$newsletterList = $this->Newsletter->find('list');
					$this->set('newsletterList',$newsletterList);
					
					$this->render('newsletter_send');	
					break;	
			}
		}

    }

    /**
     * Add newsletter
       **/
    function addNewsLetter(){

		$params = $this->request->params;
		$this->layout = 'admin';
        print_r($this->request->data);
        if(isset($params['action_name'])){
			switch($params['action_name']){
				case 'add':
                    echo "Save";exit;
            }
        }
		$this->set('pageHeading','Newsletter');
        $this->set('newsletters',$this->Newsletter->find('all'));
        $this->render("add_newsletter");
    }

    function deleteNewsletterList($id){
		
		if(isset($id)){
			if($id==1){
				$this->Session->setFlash('You are not authorized to this.','error');
				$this->redirect('/admin/newsletter');		
			}
			if($this->Newsletter->delete($id,true)){
				$this->Session->setFlash('Newsletter has been deleted.','success');
			}	
		}
		$this->redirect('/admin/newsletter');
	}
	
	function deleteNewsletterEmail($id){
		if(isset($id)){
			if($this->NewsletterEmail->delete($id)){
				$this->Session->setFlash('Email has been deleted.','success');
			}	
		}
		$this->redirect('/admin/newsletter/email');
	}
	    /** change admin account email **/
    public function change_email() {
        if(isset($this->data['User'])){
			
			$user['id'] = $this->Auth->user('id');
			$user['email'] = $this->data['User']['email'];
			
			if($this->User->save($user)){
				$subject = "Admin email updated";
				$messageBody = "Your email address has been updated for wind admin. And new email is ".$user['email'];
				if($this->sendEmail($user['email'], $subject, $messageBody)){
			  		$this->Session->setFlash("Email has been updated successfully.","success");	
			  	}				
			}
		}
		$this->redirect('/admin/change_password');	 
    }


}



