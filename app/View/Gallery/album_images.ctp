<? echo $this->Html->script('site/jquery');?>
<? echo $this->Html->script('site/gallery');?>
<script language="javascript">
	<!--
	$(document).ready(
	function (){
	$('#s4').cycle({ 
		 fx:      '<?php echo $album["type"]?>',
		 speed:    700, 
		 timeout:  2000 
	});
	});
	-->
</script>
	<style type="text/css">
	.pics {  
		padding: 0;  
		margin:  0;  
		 
	} 
	.pics img {  
		padding: 15px;  
		border:  1px solid #ccc;  
		background-color: #eee;  
		width:  450px; 
		height: 300px; 
		top:  0; 
		left: 0 
	} 
</style>
	
	
<div id="content">
  
	<div style="margin-left: 30px;">
		<a href="<?=SITE_URL?>/gallery">Album</a>
	</div>
	<hr style="clear:both">
	<div style="clear: both; width: 550px; margin: auto;">
		<?php if(isset($album['image'])):?>
		  <div style="float: left; padding-bottom: 8px;">
			<?php $imagePath = "/images/gallery/albums/".$album['dir']."/".$album['image'];?>
			<?php echo $this->Html->image($imagePath, array(
				"alt" => "Album Image",
				'style'=>'border-radius: 8px;'
				));
			?>
		  </div>
		  <div style="float: left; width: 400px; margin: 0px 15px 10px;">
			<!-- ?php $albumType  = array('fade'=>'Fade','shuffle'=>'Shuffle','zoom'=>'Zoom','turnDown'=>'Turn Down','curtainX'=>'Curtain-X','scrollRight'=>'Scroll Right'); ?>
			<span style="font-weight: bold;"> Album Type :  </span> <span class="post_desc"> <?php echo $albumType[$album['type']]; ?></span>
			<br/ -->
			<span style="font-weight: bold;"> Description :  </span>
			<span class="post_desc"> <?php echo $album['description']; ?></span>
		  </div>
		<?php endif;?>
	</div>
	<hr style="clear:both">
	<div style="width:490px; clear: both; position: relative; overflow: visible; margin:auto" class="pics" id="s4">
		<?php $imagePath = "/images/gallery/albums/".$album['dir']."/images/";?>
		<?php if(count($albumImages)>0):?>
			<?php foreach($albumImages as $albumImage):?>
				<?php echo $this->Html->image($imagePath.$albumImage['image'], array(
					"alt" => "Album Image",
					'style'=>'border-radius: 8px;'
					));
				?>
			<?php endforeach;?>
		<?php else:?>
		<tr>
			<td colspan="4"><div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">There is no gallery images added in this album.</div></td>	
		</tr>	  
	  <?php endif;?>	
	</div>
	
</div>