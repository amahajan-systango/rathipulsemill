<style>
	.rte_content table tr td{
		padding:0px;
	}
</style>
<?php
	echo $this->Html->script('richtext_compressed');
	echo $this->Html->script('html2xhtml.min');
	echo $this->Html->script('nicEdit.js');
	?>
	<script type="text/javascript">
		bkLib.onDomLoaded(function() {
			new nicEditor({iconsPath : '<?php echo SITE_URL;?>/images/nicEditorIcons.gif', fullPanel : true}).panelInstance('rte1');
		});
</script>
	<?php
	
	function rteSafe($strText) {
		//returns safe code for preloading in the RTE
		$tmpString = $strText;
		
		//convert all types of single quotes
		$tmpString = str_replace(chr(145), chr(39), $tmpString);
		$tmpString = str_replace(chr(146), chr(39), $tmpString);
		$tmpString = str_replace("'", "&#39;", $tmpString);
		
		//convert all types of double quotes
		$tmpString = str_replace(chr(147), chr(34), $tmpString);
		$tmpString = str_replace(chr(148), chr(34), $tmpString);
		//$tmpString = str_replace("\"", "\"", $tmpString);
		
		//replace carriage returns & line feeds
		$tmpString = str_replace(chr(10), " ", $tmpString);
		$tmpString = str_replace(chr(13), " ", $tmpString);
		
		return $tmpString;
	}
	$rtePath = SITE_URL."/cbrte/";
?>

<script>

function updateRTEContent(){
	updateRTEs();
	return true;
}

$(document).ready(function(){
	$("#PageManagePageForm").validate();
});

initRTE("<?php echo $rtePath."images/"?>", "<?php echo $rtePath;?>", "", true);

function page_preview(){
	updateRTEs();
	pageId = $("#PageId").val();
	pageTitle = $("#PageTitle").val();
	pageName = $("#PageName").val();
	pageMetaKeywords = $("#PageMetaKeywords").val();
	pageMetaDescription = $("#PageMetaDescription").val();
	pageContent = htmlDecode(document.RTEDemo.rte1.value);
	
    $.ajax({
       type: "POST",
       url: "<?php echo SITE_URL;?>/admin/beforePagePreview",
       data:{
				id:pageId,
				title:pageTitle,
				name:pageName,
				meta_keywords:pageMetaKeywords,
				meta_description:pageMetaDescription,
				content:pageContent
			},
       success: function(msg){
		 myWindow=window.open('<?php echo SITE_URL;?>/admin/pagePreview','','scrollbars=1,width=900,height=700');
       }
    });
}

</script>


<table cellspacing="0" style="width:100%">
  <tbody>
	<tr>
	  
	  <td style="width:50%;font-size: 18px;">
		<?php $headValue = isset($page['id'])?"Edit Page":"Add New Page" ?>
		<span style="color:#D0910B;font-weight:bold;"><?php echo $headValue; ?> </span>
	  </td>
	  
      <td><button type="button" class="button_style" style="float: right;" onclick="setLocation('<?=SITE_URL?>/admin/manage_page')" ><span>Page List</span></button></td>
    </tr>
  </tbody>
</table>
<hr/>
       
<?php echo $this->Form->create('Page', array('name'=>'RTEDemo','url' => array('controller' => 'admin', 'action' => 'manage_page'))); ?>
<?php echo $this->Form->input('id', array('label' => '','type'  => 'hidden','value'=>isset($page['id'])?$page['id']:''));?>
<?php echo $this->Form->input('identifier', array('label' => '','type'  => 'hidden'));?> 
<table class="page_form">
  <tr>
	<td style="width: 110px;">
		Page Title  
	</td>
	<td>
	    <?php	echo $this->Form->input('title', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'div'=>false,
										'value'=>isset($page['title'])?$page['title']:'',
                                        'onkeyup'=>"if(this.value.match(/[^a-zA-Z0-9 ]/)) this.value=this.value.replace(/[^a-zA-Z0-9 ]/g,'')",
										'onkeypress'=>"if(this.value.match(/[^a-zA-Z0-9 ]/)) this.value=this.value.replace(/[^a-zA-Z0-9 ]/g,'')"
										)
									);
								?> 
	</td>
  </tr>
  <tr>
	<td>
	  Page Name
	</td>
	<td>
      <?php	echo $this->Form->input('name', array('label' => '',
										'type'  => 'text',
										'class' => 'required',
										'div'=>false,
										'value'=>isset($page['name'])?$page['name']:'',
                                        'onkeyup'=>"if(this.value.match(/[^a-zA-Z0-9 ]/)) this.value=this.value.replace(/[^a-zA-Z0-9 ]/g,'')",
										'onkeypress'=>"if(this.value.match(/[^a-zA-Z0-9 ]/)) this.value=this.value.replace(/[^a-zA-Z0-9 ]/g,'')"
										)
									);
								?>
	</td>
  </tr>

  <tr>
	<td>
	  Meta Keywords <br><span style="font-weight: normal; font-size: 11px;">(for SEO)</span>
	</td>
	<td>
	  <?php echo $this->Form->input('meta_keywords', array('label' => '',
						'type'  => 'textarea',
						'class' => 'required',
						'div'=>false,
						'value'=>isset($page['meta_keywords'])?$page['meta_keywords']:'',
					)
		  );
	   ?>	
	</td>
  </tr>

 <tr>
	<td>
	  Meta Description <br><span style="font-weight: normal; font-size: 11px;">(for SEO)</span>
	</td>
	<td>
		<?php echo $this->Form->input('meta_description', array('label' => '',
						  'type'  => 'textarea',
						  'class' => 'required',
						  'div'=>false,
						  'value'=>isset($page['meta_description'])?$page['meta_description']:'',
					  )
			);
		 ?>

	</td>
  </tr>
  <?php if($page['id']<=4 || $page['id']>=9):?>	
  <tr>
	<td>
	  Content
	</td>
	<td class="rte_content">
		<?php $content = isset($page["content"])?rteSafe($page["content"]):'';?>
		<textarea id="rte1" name="rte1" cols="65" rows="10"><?php echo $content; ?></textarea>
	</td>
  </tr>
  <?php endif;?>
  <tr>
	<td>
	  Status
	</td>
	<td>
	  <?php
		  $status ="";  
		  if(isset($page['status'])){
			if($page['status']==1){
			  $status =1;
			}else{
			  $status =0;  
			}
		  }
	  ?>
	  <?php echo $this->Form->input('status', array('label' => '',
						'type'  => 'select',
						'class' => 'required',
						'options'=>array('1'=>'Enabled','0'=>'Disabled'),
						'div'=>false,
						'selected' =>$status
					)
		  );
	   ?>	
	</td>
  </tr>  


  <?php if($page['id']==9):?>	
  <tr>
	<td>
	  Feedback Email
	</td>
	<td>
	  <?php echo $this->Form->input('Config.feedback_email', array('label' => '',
						  'type'  => 'text',
						  'class' => 'required email',
						  'id'=>'msgpost',
						  'style'=>'width:300px',
						  'div'=>false,
						  'value'=>isset($feedback_email)?$feedback_email:'',
					  )
			);
	 ?>
	</td>
  </tr>
  <?php endif;?>


  <tr>
	<td>
	  
	</td>
	<td>
	  <?php echo $this->Form->submit('Save Page',array(
											'div'=>false,
											'id'=>'submit',
											'class'=>'sign',
											'onclick'=>'updateRTEContent();'
											)
									);
						?>
	  <?php
		$dynamicPageArray = array('5','6','7','8');
		if(!in_array($page['id'],$dynamicPageArray)):?>
			<input type="button" value="Preview" class="sign" id="preview" onclick="page_preview();">
	  <?php	endif; ?>
						
	</td>
	
  </tr>


</table>

<?php echo $this->Form->end(); ?>
