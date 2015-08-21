<div class="row">
	<?php
	if(is_array($folderList)): ?>
<div class="row">
	<div class="col-md-12 hidden-xs">
		
			<?php foreach($folderList as $key => $file):
			if(is_numeric($key)):
				?>
			<div class="col-sm-2 col-md-3 col-lg-2 img-thumbnail">
			<div id="generalfolder">
				<a href="javascript:void(0);" class="text-center" onclick="datasearhGD('<?php print $file['id']; ?>', this);">
					<div style="width:40px;float:left;">
						<img class="img-thumbnail" 
						src="./img/carpetas.png" 
						data-mime="<?php print $file['mimeType']; ?>" 
						alt="<?php print $file['title']; ?>" 
						title="<?php print $file['title']; ?>">
					</div>
					<div class="col-md-9">
						<h5 class="hidden-sm" >
						<!--img src="<?php print $file['icon']; ?>" 
						alt="<?php print $file['mimeType']; ?>" 
						title="<?php print $file['mimeType']; ?>"-->
						<?php print substr($file['title'], 0, 20); ?>
					</h5>
				</div>
			</a>
		</div>
</div>
		<?php 
		endif;
		endforeach;
		?>

	
</div>
</div>
<?php 
endif;
?>


<div class="col-md-10">
	<div class="row">
		<?php 
		if(is_array($filesList)):
			foreach($filesList as $key => $file):
				if(is_numeric($key)):
					?>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2 multielemt" height="400">
					<div class="toelement" >
						<div style="height:200px; overflow: hidden;" class="img-thumbnail text-center">
						<img style="width:95%"  
						src="<?php print $file['image']; ?>" 
						data-mime="<?php print $file['mimeType']; ?>" 
						alt="<?php print $file['title']; ?>" 
						title="<?php print $file['title']; ?>">
						</div>
						<h5 class="hidden-xs">
							<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
								<img src="<?php print $file['icon']; ?>" 
								alt="<?php print $file['mimeType']; ?>" 
								title="<?php print $file['mimeType']; ?>">
								<?php print substr($file['title'], 0, 20); ?>
							</a>
						</h5>
					</div>
					
					<div class="fromelement" style="display:none;">



						<?php 
						if(isset($file['exportLinks'])){
							print "<div class='row'>";
							foreach($file['exportLinks'] as $keyb => $exportlink){ 
								print "<div id='exportlink' class='col-xs-6 col-sm-3 col-md-2 col-lg-2'><a href='" . $exportlink . "'><img width='32' src='./img/icon/" . $keyb . "'></a> </div>";
							} 
							print "</div>";
						}
						?>

						<div class="hidden-xs">
							<?php 
							print "<small>Emisión: " . date('Y-m-d h:i:s a',strtotime($file['createdDate'])) . "</small><br />"; 
							print "<small>Actualización: " . date('Y-m-d h:i:s a',strtotime($file['modifiedDate'])) . "</small> <br />";
							print "<small>descripción: " . $file['description'] . "</small>";

							?>
						</div>
						<div class="hidden-xs">
							<button type="button" class="btn btn-danger btn-xs buttonProperies" data-toggle="modal" data-target="#myModal" data-document-id="<?php print $file['id']; ?>">
								<i class="glyphicon glyphicon-list-alt"></i> Edición
							</button>
						</div>
					</div>
				</div>
		<?php 
				endif;
			endforeach;
		endif;
		?>
	</div>
			<div class="row">
				<?php if(isset($filesList['pageToken']) && !empty($filesList['pageToken'])): ?>
					<div class="col-md-4">
						<a id="nextpage" 
						onclick="pagesearh(this);" 
						data-g-id="<?php print $filesList['pageToken']; ?>"
						data-g-parents="<?php print $filesList['parents']; ?>"
						href="javascript:void(0);">
							<small>Siguiente</small><i class="glyphicon glyphicon-arrow-right"></i>
						</a>
					</div>
				<?php endif; ?>
			</div>
</div>
</div>