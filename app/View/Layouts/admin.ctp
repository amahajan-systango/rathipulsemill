<?php
/**
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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php
			$title = 'Rathi Pulse Mill';
			echo $title;
		?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('global');
		echo $this->Html->css('index_css');
		echo $this->Html->css('index_style');
		echo $this->Html->css('information_input_css');

		echo $this->Html->script('admin');
		echo $this->Html->script('jquery_min');
		echo $this->Html->script('jquery.validate');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<style>
	.flash-message{
		text-align:center;
		font-size:13px;
	}
</style>

</head>



<body>
	<div id="container">
		<div id="topheader">
			<?php echo $this->Html->script('wz_tooltip');?>	
			<?php echo $this->element('admin_header'); ?>
		</div>
		
		<div id="search_strip">
			<div class="freeregistration">
					<div class="registration_a">
							<b class="free_a"><?php echo $pageHeading;?></b> Page
					</div>
			</div>
			<div class="search_area">   
				<a href="<?php echo SITE_URL."/admin/logout" ?>"><input type="button" value="Log out" class="sign" onClick="logout()"></a>
			</div>
		</div>
		
		<div id="content">
			
			<div id="body_area">
				<?php echo $this->Session->flash(); ?>	
				<div class="left"><?php echo $this->element('admin_left_sidebar'); ?></div>	
				<div class="midarea"><?php echo $this->fetch('content'); ?></div>
			</div>	
		</div>
		<div id="fotter"><?php echo $this->element('admin_footer'); ?></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
