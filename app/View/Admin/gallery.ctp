<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<?php $subValue = isset($galleryAlbum['id'])?"Update":" + Add" ?>
		<?php $headValue = isset($galleryAlbum['id'])?"Edit Album":"Gallery Album" ?>
		<span style="color:#D0910B;font-weight:bold;"><?php echo $headValue; ?> </span>
	  </td>
	  <?php if(isset($galleryAlbum['id'])):?>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/gallery')"><span>Add New Album</span></button>
	  </td>
	  <?php endif;?>
    </tr>
  </tbody>
</table>
<hr/>

<?php echo $this->Form->create('GalleryAlbum', array('url' => array('controller' => 'admin', 'action' => 'gallery'),'type' => 'file')); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($galleryAlbum['id'])?$galleryAlbum['id']:'',));?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form gallery_table">
	<tr>
	  <td>
		  <div><span>Album Type</span></div>
		  <div style="margin-top:5px">
			<?php $albumType  = array('fade'=>'Fade','shuffle'=>'Shuffle','zoom'=>'Zoom','turnDown'=>'Turn Down','curtainX'=>'Curtain-X','scrollRight'=>'Scroll Right'); ?>
			<?php	echo $this->Form->input('type', array('label' => '',
											'type'  => 'select',
											'class' => 'required album_type',
											'div'=>false,
											'options'=>$albumType,
											'selected'=>isset($galleryAlbum['type'])?$galleryAlbum['type']:''
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	<tr>
	  <td>
		  <div><span>Album Description</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('description', array('label' => '',
											'type'  => 'textarea',
											'class' => 'required',
											'div'=>false,
											'value'=>isset($galleryAlbum['description'])?$galleryAlbum['description']:'',
											'cols'=>23,
											'rows'=>3
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
		
	<tr>
	  <td>
		  <div><span>Album Image</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('image', array('label' => '',
											'type'  => 'file',
											'class' => isset($galleryAlbum['image'])?'':'required',
											'div'=>false,
											)
										);
									?> 
		  </div>
	  </td>
	</tr>		
	
	<?php if(isset($galleryAlbum['image'])):?>
	<tr>
	  <td>
		<div style="">
				<?php $imagePath = "/images/gallery/albums/".$galleryAlbum['dir']."/".$galleryAlbum['image'];?>
				<?php echo $this->Html->image($imagePath, array(
					"alt" => "Album Image",
					'style'=>'border-radius: 8px;'
					));
				?>
		</div>
	  </td>	
	</tr>
	<?php endif;?>
	
	<tr>
      <td>
		  <?php echo $this->Form->submit($subValue,array(
											  'div'=>false,
											  'class'=>'sign'
											  )
									  );
						  ?>
	  </td>
	</tr>
  <?php echo $this->Form->end(); ?>

  </table>
</div>

<div style="float: left; width: 370px; margin-left: 10px;">
  <table class="list_page">
	<tr>
	    <th><div style="width: 80px; ">Album Type</div></th>
		<th><div style="width: 100px; ">Description</div></th>
		<th><div style="width: 71px;">Date</div></th>
		<th>Image</th>
		<th>Action</th>
	</tr>
	
	<?php foreach($galleryAlbums as $galleryAlbum):?>
	<tr>
		<td><?php echo $albumType[$galleryAlbum['GalleryAlbum']['type']]; ?></td>
		<td><?php echo $galleryAlbum['GalleryAlbum']['description']; ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $galleryAlbum['GalleryAlbum']['created']); ?>
		</td>
		<td>
		  <div style="width: 90px; text-align: center;">
  			<?php $imagePath = "/images/gallery/albums/".$galleryAlbum['GalleryAlbum']['dir']."/".$galleryAlbum['GalleryAlbum']['image'];?>
			<?php echo $this->Html->image($imagePath, array(
				"alt" => "Album Image",
				'url' => array('controller' => 'admin', 'action' => 'gallery/manage_album', $galleryAlbum['GalleryAlbum']['id']),
				'style'=>'border-radius: 8px;'
				));
			?>
			</div>
		</td>
		 <td>
		  <div style="width: 52px; text-align: center;">
		   <?php echo $this->Html->link('Manage', '/admin/gallery/manage_album/'.$galleryAlbum["GalleryAlbum"]["id"], array('class' => 'button'));?>
		   <br/>
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteGalleryAlbum/',$galleryAlbum["GalleryAlbum"]["id"] ),    array(),    "Are you sure you wish to delete this Album?");?>
		   <br/>
		   <?php echo $this->Html->link('Edit', '/admin/gallery/album/'.$galleryAlbum["GalleryAlbum"]["id"], array('class' => 'button'));  ?>
		   </div>
		 </td>	
  
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#GalleryAlbumGalleryForm").validate();
});
</script>
