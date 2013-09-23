<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Page List</span>
	  </td>
      <td><button type="button" class="button_style" style="float: right;" onclick="setLocation('<?=SITE_URL?>/admin/manage_page/add')" ><span>Add New Page</span></button></td>
    </tr>
  </tbody>
</table>
<hr/>

<table class="list_page">
  <tr>
	  <th>Title</th>
	  <th>Name</th>
	  <th style="width: 260px;">URL</th>
	  <th style="width: 80px;">Status</th>
	  <th style="width: 130px;">Action</th>
  </tr>
  
  <?php foreach($pages as $page):?>
  <tr>
	  <td><?php echo $this->Html->link($page['Page']['title'], '/admin/manage_page/edit/'.$page["Page"]["id"], array('class' => 'button')); ?></td>
	  <td><?php echo $page['Page']['name']; ?></td>
	  <td><?php echo SITE_URL."/".$page["Page"]["identifier"]; //$this->Time->format('d/m/Y H:i:s', $page['Page']['creation_time']); ?></td>
	  <?php if($page['Page']['status']==1){
		  $linkText = "Enabled";
		  $class = "enabled";
		  $changeLink = "disabled";
		  $title = "Click here to Disable";
		}
		else{
		  $linkText = "Disabled";
		  $class = "disabled";
		  $changeLink = "enabled";
		  $title = "Click here to Enable";
		}
		?>
	  <td><?php echo $this->Html->link($linkText, '/admin/manage_page/'.$changeLink.'/'.$page["Page"]["id"], array('class' => $class,'title'=>$title)); ?></td>
	  <td>
		<?php echo $this->Html->link('Edit', '/admin/manage_page/edit/'.$page["Page"]["id"], array('class' => 'button')); echo " / "; ?>
		<?php echo $this->Html->link('Preview', SITE_URL."/".$page["Page"]["identifier"], array('class' => 'button','target'=>'_blank')); ?>
		<?php if($page["Page"]["id"]>=10): ?>
		  <?php echo " / " . $this->Html->link('Delete',array('controller' => 'admin', 'action' => 'manage_page/delete',$page["Page"]["id"] ),    array(),    "Are you sure you wish to delete this Page?"); ?>
		<?php endif; ?>
		
	  </td>
  </tr>	  
  <?php endforeach;?>
</table>

<?php echo $this->Paginator->numbers(); ?>
