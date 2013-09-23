<?php

class GalleryAlbum extends AppModel {
    public $name = 'GalleryAlbum';
    var $useTable = 'gallery_albums';   
    var $hasMany = array(
			'GalleryImages' => array(
				'className' => 'GalleryImage',
				'foreignKey' => 'album_id',
				'dependent'=> true
			)						
	);
}
