<?php 
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){
			$_SESSION['document_ids'][$file['id']] = $file['title'];
			?>
			<div class='col-xs-6 col-sm-4 col-md-3 col-lg-2'>
				<div class="metadocument-element">
				<div class='position-button'>
						<button type='button' 
						style=''
						class='btn buttonProperies' 
						data-toggle='modal' data-target='#metaDataModal' 
						onclick="loadDocumentId('<?php print $file['id']; ?>'); loadFormDataModal();">
						<i class='glyphicon glyphicon-th-list'></i><small class="hidden-xs"> MetaDatos</small>
					</button>
				</div>
				<div class='metadocument-divider'></div>				
				<div class="text-center metadocument-image">
					<a href='<?php print $file['url']; ?>' target='_blank'>
						<img
						src='<?php print $file['image']; ?>' 
						data-mime='<?php print $file['mimeType']; ?>' 
						alt='<?php print $file['title']; ?>' 
						title='<?php print $file['title']; ?>'>
					</a>
				</div>
				<div class='metadocument-divider'></div>
				<div class="row">
					<div class='col-xs-12 matadocument-title'>				
						<a href='<?php print $file['url']; ?>' target='_blank' class='text-center' title='<?php print $file['title']; ?>'>
							<img src='./img/icon/<?php print $file['icon']; ?>' 
							style='width: 32px;'
							alt='<?php print $file['mimeType']; ?>' 
							>
							<span>
								<?php 
								$charters = array("_", "-");
								$title = str_replace($charters, " ", $file['title']);
								print $title; 
								?>
							</span>
						</a>
					</div>
				</div>
				<div class='metadocument-divider'></div>

				<?php 
				$classData = 'metadocument-metadata-one';
				if(isset($file['exportLinks'])){ 
					$classData = 'metadocument-metadata-two';
					?>
					<div class="row">
						<div class='col-xs-12 text-center metadata-down'>
							<small>Descargas</small>
							<div class="element-center">
								<?php
								foreach($file['exportLinks'] as $keyb => $exportlink){ 
									print '<div style="float: left;"><a href="' . $exportlink . '"><img title="'.$keyb.'" width="32" src="./img/icon/' . $keyb . '"></a> </div>';
								} ?>
							</div>
							
						</div>
					</div>
					<div class='metadocument-divider'></div>
					<?php
				}
				?>
				<div class="row">
					<div class='col-xs-12 <?php print $classData; ?>'>
						<div class="text-center"><small>Información</small></div>
						<?php if(!isset($file['description'])){ ?>
						<ul>
							<li><strong>Creación: </strong><?php print date('Y-m-d',strtotime($file['createdDate'])); ?></li>
							<li><strong>Actualización: </strong><?php print date('Y-m-d',strtotime($file['modifiedDate'])); ?></li>
						</ul>
						<?php }else {
							print $file['description']; 	
						} ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
	}
}
}
?>
