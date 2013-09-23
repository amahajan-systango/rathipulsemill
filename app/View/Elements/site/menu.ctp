
<ul>
	<?php foreach($pages AS $page):?>
		<li>
		  <a class="<?php if($page['Page']['identifier']==$currentPage['identifier']){echo 'current';}?>" href="<?php echo SITE_URL.'/'.$page['Page']['identifier']?>">
			<?php echo $page['Page']['name']?>
		  </a>
		</li>  
	<?php endforeach;?>
</ul>
