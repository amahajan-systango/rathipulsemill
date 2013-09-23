<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
      <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Manage Album </span>
	  </td>
	  <?php if(isset($galleryAlbum['id'])):?>
      <td>
		<button class="button_style" style="float: right;" type="button" onclick="setLocation('<?=SITE_URL?>/admin/gallery')"><span>Album</span></button>
	  </td>
	  <?php endif;?>
    </tr>
  </tbody>
</table>
<hr/>
<div style="clear: both;width:600px">
  <?php if(isset($galleryAlbum['image'])):?>
    <div style="float:left">
	  <?php $imagePath = "/images/gallery/albums/".$galleryAlbum['dir']."/".$galleryAlbum['image'];?>
	  <?php echo $this->Html->image($imagePath, array(
		  "alt" => "Album Image",
		  'style'=>'border-radius: 8px;'
		  ));
	  ?>
    </div>
	<div style="float: left; width: 400px; margin: 0px 15px 10px;">
	  <?php $albumType  = array('fade'=>'Fade','shuffle'=>'Shuffle','zoom'=>'Zoom','turnDown'=>'Turn Down','curtainX'=>'Curtain-X','scrollRight'=>'Scroll Right'); ?>
	  <span class="post_category"> Album Type :  </span> <span class="post_desc"> <?php echo $albumType[$galleryAlbum['type']]; ?></span>
	  <br/>
	  <span class="post_category"> Description :  </span>
	  <span class="post_desc"> <?php echo $galleryAlbum['description']; ?></span>
	</div>
  <?php endif;?>
</div>
<hr style="clear:both">	

<?php echo $this->Form->create('GalleryImage', array('url' => array('controller' => 'admin', 'action' => 'gallery'),'type' => 'file')); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($galleryImage['id'])?$galleryImage['id']:'',));?>
<?php echo $this->Form->input('album_id', array('label' => '','type'  => 'hidden','value'=>isset($galleryAlbum['id'])?$galleryAlbum['id']:'',));?>
<?php echo $this->Form->input('album_dir', array('label' => '','type'  => 'hidden','value'=>isset($galleryAlbum['dir'])?$galleryAlbum['dir']:'',));?>
<div style="clear:both">
 <div style="float: left;">
  <table class="page_form gallery_table">
	<tr>
	  <td>
		  <div><span>Caption</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('caption', array('label' => '',
											'type'  => 'text',
											'class' => 'required',
											'div'=>false,
											'value'=>isset($galleryImage['caption'])?$galleryImage['caption']:'',
											)
										);
									?> 
		  </div>
	  </td>
	</tr>
	
	<tr>
	  <td>
		  <div><span>Image</span></div>
		  <div style="margin-top:5px">
			<?php	echo $this->Form->input('image', array('label' => '',
											'type'  => 'file',
											'class' => isset($galleryImage['image'])?'':'required',
											'div'=>false,
											)
										);
									?> 
		  </div>
	  </td>
	</tr>		
	
	<?php if(isset($galleryImage['image'])):?>
	<tr>
	  <td>
		<div style="">
				<?php $imagePath = "/images/gallery/albums/".$galleryAlbum['dir']."/images/".$galleryImage['image'];?>
				<?php echo $this->Html->image($imagePath, array(
					"alt" => "Album Image",
					 'style'=>'border-radius: 2px;width:70px'
					));
				?>
		</div>
	  </td>	
	</tr>
	<?php endif;?>
	
	<tr>
      <td>
		  <?php echo $this->Form->submit('Save',array(
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
	    <th><div style="width: 80px; ">Caption</div></th>
		<th><div style="width: 80px; ">Date</div></th>
		<th>Image</th>
        <th>Action</th>
	</tr>
	
	<?php foreach($galleryImages as $galleryimage):?>
	<tr>
		<td><?php echo $galleryimage['GalleryImage']['caption']; ?></td>
		<td><?php echo $this->Time->format('d/m/Y', $galleryimage['GalleryImage']['created']); ?></td> 
		<td>
		  <div style="width: 90px; text-align: center;">
  			<?php $imagePath = "/images/gallery/albums/".$galleryAlbum['dir']."/images/".$galleryimage['GalleryImage']['image'];?>
			<?php echo $this->Html->image($imagePath, array(
				"alt" => "Album Image",
				'style'=>'border-radius: 2px;width:70px'
				));
			?>
			</div>
		</td>
		<td>
		  <div style="width: 130px; text-align: center;">
		   <?php echo $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'deleteGalleryImage/',$galleryimage["GalleryImage"]["id"] ),    array(),    "Are you sure you wish to delete this image?"); echo " / ";?>
		   <?php echo $this->Html->link('Edit', '/admin/gallery/manage_album/'.$galleryAlbum["id"].'/image/'.$galleryimage["GalleryImage"]["id"], array('class' => 'button'));  ?>
		   </div>
		</td>	
  
	</tr>	  
	<?php endforeach;?>
  </table>
 </div>
</div>



<script>
$(document).ready(function(){
	$("#GalleryImageGalleryForm").validate();
});
</script>
