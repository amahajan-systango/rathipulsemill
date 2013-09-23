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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<meta content="<?php echo $currentPage['meta_keywords']?>" name="KEYWORDS">
	<meta content="<?php echo $currentPage['meta_description']?>" name="DESCRIPTION">	
	<title>
		<?php echo $title; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('site_style.css');
		echo $this->Html->css($theme);
		
		echo $this->Html->script('site/jquery-1.7.2');
		echo $this->Html->script('jquery.validate');
		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		$image = $configData['header_image'];
		
			
	?>
		

	<?php if($image):
		$imageUrl = "images/".$image;
		$dynamicPageArray = array('5','6','7','8');
		if(in_array($currentPage['id'],$dynamicPageArray)){
			$imageUrl = "../images/".$image;
		}
		if(isset($headerImagealbumUrl)){
			$imageUrl = "../../images/".$image;
		}
		?>
		<style>
		#header {
				/*background-image: url("images/<?php //echo $image?>");*/
				background-image: url("<?php echo $imageUrl?>");
				height: 230px;
				margin: 0 auto;
				
			}
		</style>
	<?php endif; ?>

</head>

<body>

	<div id="wrapper">
		
		<?php echo $this->element('site/header'); ?>
		<div id="menu"><?php echo $this->element('site/menu'); ?></div>
		<?php echo $this->Session->flash(); ?>
		<div id="page"><?php echo $this->fetch('content'); ?></div>
		
		<div id="adSense">
			<a target="_blank" href="http://www.systango.com/">
				<img src="<?=SITE_URL?>/images/syatangobanner.png">
			</a>
			<a target="_blank" href="http://www.getwebsiteinaday.com/">
			  <img src="<?=SITE_URL?>/images/getwebsitebanner.png">
			</a>			
		</div>
		<div id="footer"><?php echo $this->element('site/footer'); ?></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
