	<?php
	
	if(isset($configData['footer_image']) && $configData['footer_image']):
		$footer = $configData['footer_image'];
		$footerUrl = "images/".$footer;
		$dynamicPageArray = array('5','6','7','8');
		if(in_array($currentPage['id'],$dynamicPageArray)){
			$footerUrl = "../images/".$footer;
		}
		if(isset($headerImagealbumUrl)){
			$footerUrl = "../../images/".$footer;
		}
		?>
		<style>
		#footer {
				background-image: url("<?php echo $footerUrl?>");
				height: 145px;
				margin: 0 auto;
				width: 990px;
			}
		</style>
	<?php endif; ?>



<p id="legal"> Copyright &copy; <?php echo $companyName;?>. All Rights Reserved.<br>
  <span style="font-size:10px;">
	Designed and Developed by:
	<a target="_blank" href="http://www.systango.com/" style="text-decoration:underline;">
	  Systango
	</a>
	<br>
	<a target="_blank" style="text-decoration:underline;" href="http://getwebsiteinaday.com/">
	  WiND (Website in a day) - Simply Yours!
	</a>
  </span>
</p>