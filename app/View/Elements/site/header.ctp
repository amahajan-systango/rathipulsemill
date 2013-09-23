<?php

  if(isset($configData['logo_image']) && $configData['logo_image']){
	$logo = $configData['logo_image'];
	$logoUrl = "images/".$logo;
	?>
	<div id="top_head">
      <div id="logo"><img src="<?php echo SITE_URL.'/'.$logoUrl?>"></div>
    </div>  
<?php }?>

<div id="header">



<object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="980" height="160">
  <param name="movie" value="images/innerflash.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="opaque" />
  <param name="swfversion" value="6.0.65.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don't want users to see the prompt. -->
  <param name="expressinstall" value="Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="images/innerflash.swf" width="980" height="160">
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



 </div>