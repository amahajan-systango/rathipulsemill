<div class="left_menutop"></div>
<div class="left_menu_area">
	<div align="right">
		<a href="<?php echo SITE_URL.'/admin/index'?>" class="left_menu <?php if($this->action=='index'){echo 'left_menu_current';}?>" onMouseOver="Tip('Welcome!')" onMouseOut="UnTip()">Welcome</a><br />	
		<a href="<?php echo SITE_URL.'/admin/change_password'?>" class="left_menu <?php if($this->action=='change_password'){echo 'left_menu_current';}?>" onMouseOver="Tip('Admin Setting!')" onMouseOut="UnTip()">Admin Setting</a><br />	
		<a href="<?php echo SITE_URL.'/admin/site_setting'?>" class="left_menu <?php if($this->action=='site_setting'){echo 'left_menu_current';}?>" onMouseOver="Tip('Change site theme, logo, header, footer etc!')" onMouseOut="UnTip()">Site Setting</a><br />	
		<a href="<?php echo SITE_URL.'/admin/manage_page'?>" class="left_menu <?php if($this->action=='manage_page' && $activePageFlag){echo 'left_menu_current';}?>" onMouseOver="Tip('Modify the site pages!')" onMouseOut="UnTip()" >Manage Pages</a><br />
				
		<?php foreach($pages AS $page):?>
	        <a href="<?php echo SITE_URL.'/admin/manage_page/edit/'.$page['Page']['id'] ?>" class="left_menu <?php if($activePageLink==$page['Page']['id']){echo 'left_menu_current';}?>" onMouseOver="Tip('<?php echo $page['Page']['name'];?>')" onMouseOut="UnTip()">Menu Page-<?php echo $page['Page']['id']?></a><br />
		    <?php if($page['Page']['id'] ==4){ break;}?>
		<?php endforeach;?>
		
		
		<a href="<?php echo SITE_URL.'/admin/blog'?>" class="left_menu <?php if($this->action=='blog'){echo 'left_menu_current';}?>" onMouseOver="Tip('Manage blog post and comments!')" onMouseOut="UnTip()">Blog</a><br />
		
		<a href="<?php echo SITE_URL.'/admin/forum'?>" class="left_menu <?php if($this->action=='forum'){echo 'left_menu_current';}?>" onMouseOver="Tip('Manage Forum question and comments!')" onMouseOut="UnTip()">Forum</a><br />
		<a href="<?php echo SITE_URL.'/admin/event'?>" class="left_menu <?php if($this->action=='event'){echo 'left_menu_current';}?>" onMouseOver="Tip('Manage Calander Events!')" onMouseOut="UnTip()">Calendar/Event</a><br />
		<a href="<?php echo SITE_URL.'/admin/gallery'?>" class="left_menu <?php if($this->action=='gallery'){echo 'left_menu_current';}?>" onMouseOver="Tip('Managing Photo Gallery/Album!')" onMouseOut="UnTip()">Photo Gallery</a><br />
		<a href="<?php echo SITE_URL.'/admin/manage_page/edit/9'?>" class="left_menu <?php if($activePageLink=='contact_us'){echo 'left_menu_current';}?>" onMouseMove="Tip('Contact Us!')" onMouseOver="return Close();"  onmouseout="UnTip()">Contact Us</a><br />
		
		<a href="<?php echo SITE_URL.'/admin/newsletter'?>" class="left_menu <?php if($this->action=='newsletter'){echo 'left_menu_current';}?>" onMouseOver="Tip('Manage Newsletters!')" onMouseOut="UnTip()">Newsletter</a><br />
		
	</div>
</div>
