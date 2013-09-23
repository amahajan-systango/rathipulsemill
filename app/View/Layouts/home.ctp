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

	<div id="wrapper" style="width:975px;">

<div style="width:765px\9; margin:0 auto\9;">

<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="765" height="460">
  <param name="movie" value="images/main_flash.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="6.0.65.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
  <param name="expressinstall" value="Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="images/main_flash.swf" width="975" height="460">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="opaque" />
    <param name="swfversion" value="6.0.65.0" />
    <param name="expressinstall" value="Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
     
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>


  <div style="clear:both;"></div>
</div>
    
    <div style="clear:both;"></div>
     	<div id="footer"><?php echo $this->element('site/footer'); ?></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
