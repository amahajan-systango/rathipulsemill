
<?php
$d = dir(APP."webroot/css/site");
while (false !== ($entry = $d->read())) {
  if($entry != "." && $entry != ".."){
	if(end(explode('.',$entry))=="css"){
	  $themes[basename($entry,'.css')] = ucfirst(basename($entry,'.css'));
	}
  }
}
$d->close();
?>

<script type="text/javascript" language="JavaScript">
	
	function previewSelectedTheme(theme){
		var theme= theme.value;
		$('#themePreview').attr('src','../images/'+theme+'/'+theme+'.jpg');
	}
</script>

<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  <td style="width:50%;font-size: 18px;">
		<span style="color:#D0910B;font-weight:bold;">Site Setting</span>
	  </td>
    </tr>
  </tbody>
</table>
<hr/>


<?php echo $this->Form->create('Setting', array('url' => array('controller' => 'admin', 'action' => 'site_setting'),'type' => 'file')); ?>
<table class="site_setting_form">
  <tr>
	<td>
		Theme
	</td>
	<td>
	  <?php echo $this->Form->input('theme', array('label' => '',
						'type'  => 'select',
						'options'=>$themes,
						'div'=>false,
						'selected' =>$config['theme'],
						'onchange'=>"previewSelectedTheme(this);" 
					)
		  );
	  ?>
	  <div style="height: 140px; width: 251px; padding-top: 10px;">
		<img id="themePreview" src="<?="../images/".$config['theme']."/".$config['theme']?>.jpg" height="130px" width="120px" border="0px" > 
		<span style="font-size: 11px; font-weight: normal;">(Theme Preview)</span> 
	  </div>
	</td>
  </tr>
  <tr>
	<td>
	  Company Name
	</td>
	<td>
      <?php	echo $this->Form->input('company_name', array('label' => '',
										'type'  => 'text',
										'div'=>false,
										'value'=>isset($config['company_name'])?$config['company_name']:''
										)
									);
								?>
	</td>
  </tr>

 <tr>
	<td>
	  Company Url
	</td>
	<td>
      <?php	echo $this->Form->input('company_url', array('label' => '',
										'type'  => 'text',
										'div'=>false,
										'value'=>isset($config['company_url'])?$config['company_url']:''
										)
									);
								?>
	</td>
  </tr>

  <tr>
	<td>
	  Company Logo
	</td>
	<td>
	  <div>
		<?php echo $this->Form->input('logo_image', array('label' => '',
						  'type'  => 'file',
						  'div'=>false
					  )
			);
		 ?>
	  </div>
	  <?php if($config['logo_image']):?>
		
		<div style="width: 268px;">
			<?php $imagePath = "/images/".$config['logo_image'];?>
			<div style="float:left"> 
			  <?php echo $this->Html->image($imagePath, array(
				  "alt" => "Logo Image",
				  'style'=>'margin-top: 5px;',
				  'width'=>'150px'
				  ));
			  ?>
			</div>
			<div style="float: right; padding: 4px;">
			  <?php echo $this->Form->input('Action.remove_logo_image', array('label' => '',
					  'type'  => 'checkbox',
					  'div'=>false,
					  'style'=>'padding:4px',
					  'after'=>"<span style='margin: 4px;'>Remove</span>"
				  )
				);
			  ?>
			</div>
		</div>
		
	  <?php else: ?>
		  <?php echo $this->Form->input('Action.remove_logo_image',array('type'  => 'hidden','value'  => 0)); ?>
	  <?php endif;?>

	  <div style="width: 260px; clear: both; padding-top: 12px; padding-bottom: 35px; font-weight: normal; font-size: 11px;">
		<div style="float: left; width: 75px;">Height : 80px</div>
		<div style="float: left; width: 110px;">Width : 160px</div>
	  </div>	
	</td>
  </tr>

	
 <tr>
	<td>
	  Header Image
	</td>
	<td>
	  <div>
	  	<?php echo $this->Form->input('header_image', array('label' => '',
						  'type'  => 'file',
						  'div'=>false
					  )
			);
		 ?>
	  </div>
	  <?php if($config['header_image']):?>
		<div style="width: 268px;">
			<?php $imagePath = "/images/".$config['header_image'];?>
			<div style="float:left"> 
			  <?php echo $this->Html->image($imagePath, array(
				  "alt" => "Header Image",
				  'style'=>'margin-top: 5px;',
				  'width'=>'150px'
				  ));
			  ?>
			</div>
			<div style="float: right; padding: 4px;">
			  <?php echo $this->Form->input('Action.remove_header_image', array('label' => '',
					  'type'  => 'checkbox',
					  'div'=>false,
					  'style'=>'padding:4px',
					  'after'=>"<span style='margin: 4px;'>Remove</span>"
				  )
				);
			  ?>
			</div>
		</div>
	  <?php else: ?>
		  <?php echo $this->Form->input('Action.remove_header_image',array('type'  => 'hidden','value'  => 0)); ?>
	  <?php endif;?>
	  
	  <div style="width: 260px; clear: both; padding-top: 12px; padding-bottom: 35px; font-weight: normal; font-size: 11px;">
		<div style="float: left; width: 75px;">Height: 210px</div>
		<div style="float: left; width: 110px;">Width: 820px</div>
	  </div>
	</td>
  </tr>

  <tr>
	<td>
	  Footer Image
	</td>
	<td>
	  <div>
		<?php echo $this->Form->input('footer_image', array('label' => '',
						  'type'  => 'file',
						  'div'=>false
					  )
			);
		 ?>
	 </div>
	 <?php if($config['footer_image']):?>
		<div style="width: 268px;">
				<?php $imagePath = "/images/".$config['footer_image'];?>
				<div style="float:left"> 
				  <?php echo $this->Html->image($imagePath, array(
					  "alt" => "Footer Image",
					  'style'=>'margin-top: 5px;',
					  'width'=>'150px'
					  ));
				  ?>
				</div>
				<div style="float: right; padding: 4px;">
				  <?php echo $this->Form->input('Action.remove_footer_image', array('label' => '',
						  'type'  => 'checkbox',
						  'div'=>false,
				  		  'style'=>'padding:4px',
						  'after'=>"<span style='margin: 4px;'>Remove</span>"
				  	  )
				  	);
				  ?>
				</div>
		</div>
		
	  <?php else: ?>
		  <?php echo $this->Form->input('Action.remove_footer_image',array('type'  => 'hidden','value'  => 0)); ?>
	  <?php endif;?>
	  
	 <div style="width: 260px; clear: both; padding-top: 12px; padding-bottom: 35px; font-weight: normal; font-size: 11px;">
		<div style="float: left; width: 75px;">Height: 100px</div>
		<div style="float: left; width: 110px;">Width: 980px</div>
	  </div>
	</td>
  </tr>
  
  <tr>
	<td>
	  Newsletter
	</td>
	<td>
								
	  <?php echo $this->Form->input('Config.newsletter', array(
								'legend' => false,
								'type'  => 'radio',
								'class' => 'required',
								'div'=>false,
								'required'=>'required',
								//'style'=>'width:300px',
								'options'=>array('1'=>' Show ','0'=>' Hide '),
								'default'=>$config['newsletter']
								)
				  );
	  ?>								
	</td>
  </tr>
  
  <tr>
	<td>
	  
	</td>
	<td>
	  <?php echo $this->Form->submit('Save ',array(
											'div'=>false,
											'id'=>'submit',
											'class'=>'sign'
											)
									);
						?>
	</td>
  </tr>


</table>

<?php echo $this->Form->end(); ?>
