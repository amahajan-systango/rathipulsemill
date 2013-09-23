
<div id="content">
	
	<div style="margin-left: 30px;">
		<span style="font-weight: bold;">GALLERY ALBUMS</span>
	</div>
	<hr/>
	<table class="list_page" style="margin:auto">

	  <?php if(count($albums)>0):?>
		<?php foreach($albums as $album):?>
		<tr>
		  <td>
			<div style="margin-top: 15px;">
				<div style="float: left; margin-right: 20px;">
					<?php
						$imagePath = "/images/gallery/albums/".$album['GalleryAlbum']['dir']."/".$album['GalleryAlbum']['image'];
						echo $this->Html->image($imagePath, array(
						  "alt" => "Album Image",
						  'style'=>'border-radius: 8px;',
						  'url' => array('controller' => 'gallery', 'action' => 'album', $album['GalleryAlbum']['id']),
						  ));
					?>
				</div>
				<div style="float: left; width: 280px;"><?php echo $album['GalleryAlbum']['description'];?> </div>
			</div>	
		  </td>
		  
		</tr>	  
		<?php endforeach;?>
	  
	  <?php else:?>
		<tr>
			<td colspan="4"><div style="text-align: center; color: rgb(129, 16, 15); font-size: 18px;">There is no gallery album.</div></td>	
		</tr>	  
	  <?php endif;?>
	</table>
</div>	