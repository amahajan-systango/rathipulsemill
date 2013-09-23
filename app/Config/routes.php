<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect('/calendar', array('controller' => 'calendar', 'action' => 'index'));
	
	Router::connect('/blog', array('controller' => 'blog', 'action' => 'index'));
	Router::connect('/blog/postComment', array('controller' => 'blog', 'action' => 'postComment'));
	Router::connect('/blog/:id', array('controller' => 'blog', 'action' => 'index'));
	
	Router::connect('/forum', array('controller' => 'forum', 'action' => 'index'));
	Router::connect('/forum/postQuestion', array('controller' => 'forum', 'action' => 'postQuestion'));
	Router::connect('/forum/postComment', array('controller' => 'forum', 'action' => 'postComment'));
	Router::connect('/forum/:id', array('controller' => 'forum', 'action' => 'index'));
	
	Router::connect('/gallery', array('controller' => 'gallery', 'action' => 'index'));
	Router::connect('/gallery/album/:id', array('controller' => 'gallery', 'action' => 'index'));
	Router::connect('/forum/postComment', array('controller' => 'forum', 'action' => 'postComment'));
	Router::connect('/forum/:id', array('controller' => 'forum', 'action' => 'index'));

	Router::connect('/:identifier', array('controller' => 'pages', 'action' => 'display'));
	
	
	
	
	Router::connect('/admin/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/admin/logout', array('controller' => 'users', 'action' => 'logout'));
	
	Router::connect('/admin/forgotPassword', array('controller' => 'users', 'action' => 'forgotPassword'));
	Router::connect('/admin/manage_page', array('controller' => 'admin', 'action' => 'manage_page'));
	Router::connect('/admin/manage_page/:action_name', array('controller' => 'admin', 'action' => 'manage_page'));
	Router::connect('/admin/manage_page/:action_name/:page_id', array('controller' => 'admin', 
																		'action' => 'manage_page'));
	Router::connect('/admin/blog/:action_name', array('controller' => 'admin', 'action' => 'blog'));
	Router::connect('/admin/blog/:action_name/:id', array('controller' => 'admin', 'action' => 'blog'));

	Router::connect('/admin/forum/:action_name', array('controller' => 'admin', 'action' => 'forum'));
	Router::connect('/admin/forum/:action_name/:id', array('controller' => 'admin', 'action' => 'forum'));
	Router::connect('/admin/forum/:action_name/:id/:commentId', array('controller' => 'admin', 'action' => 'forum'));

	Router::connect('/admin/event/:action_name', array('controller' => 'admin', 'action' => 'event'));
	Router::connect('/admin/event/:action_name/:id', array('controller' => 'admin', 'action' => 'event'));

	Router::connect('/admin/gallery/:action_name', array('controller' => 'admin', 'action' => 'gallery'));
	Router::connect('/admin/gallery/:action_name/:id', array('controller' => 'admin', 'action' => 'gallery'));
	Router::connect('/admin/gallery/:action_name/:album_id/image/:image_id', array('controller' => 'admin', 'action' => 'gallery'));

	Router::connect('/admin/newsletter/:action_name', array('controller' => 'admin', 'action' => 'newsletter'));
	Router::connect('/admin/newsletter/:action_name/:id', array('controller' => 'admin', 'action' => 'newsletter'));
	
	
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/dis', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
	
