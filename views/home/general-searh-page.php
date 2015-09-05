<?php 
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){
			?>
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 hidden-xs" style="height: 300px;  margin-bottom: 5px;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-thumbnail" style="height: 300px;">
					<div class="row">

						<div class="col-xs-6">
							<div class="row" style="height: 172px;">
								<img
								src="<?php print $file['image']; ?>" 
								data-mime="<?php print $file['mimeType']; ?>" 
								alt="<?php print $file['title']; ?>" 
								title="<?php print $file['title']; ?>"
								class="img-thumbnail"
								style="max-height: 172px; margin-left: 2px; max-width: 128px;">
							</div>
							
						</div>
						<div class="col-xs-6" style="overflow: hidden;">
							<?php 
							print "<small class='small-list'>" . $file['description'] . "</small>";
							?>
						</div>

					</div>

					<div class="row">
						<div class="col-xs-12" style="height: 23px;">
							<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
								<img src="./img/icon/<?php print $file['icon']; ?>" 
								style="width: 32px;"
								alt="<?php print $file['mimeType']; ?>" 
								title="<?php print $file['mimeType']; ?>">
								<?php print $file['title']; ?>
							</a>
						</div>

						<div class="col-xs-12" style="position: relative; bottom: -32px; height: 32px;">
							<?php 
							if(isset($file['exportLinks'])){

								foreach($file['exportLinks'] as $keyb => $exportlink){ 
									print "<div id='exportlink' style='float: left;'><a href='" . $exportlink . "'><img width='32' src='./img/icon/" . $keyb . "'></a> </div>";
								} 

							}
							?>
						</div>

						<div class="col-xs-12" style="position: relative; bottom: -40px;">
							<button type="button" 
							style="float: right;"
							class="btn btn-danger btn-xs buttonProperies" 
							data-toggle="modal" data-target="#metaDataModal" 
							onclick="loadDocumentId('<?php print $file['id']; ?>')">
							<i class="glyphicon glyphicon-list-alt"></i> Metadatos
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 visible-xs">
			<div class="img-thumbnail" style="width: 100%; margin-bottom: 3px;">
				<div class="" >
					<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
						<img src="./img/icon/<?php print $file['icon']; ?>" 
						style="width: 40px;"
						alt="<?php print $file['mimeType']; ?>" 
						title="<?php print $file['mimeType']; ?>">
						<?php print $file['title']; ?>
					</a>
				</div>
				<div class="" >
					<button type="button" 
						style="float: right;"
						class="btn btn-danger btn-xs buttonProperies" 
						data-toggle="modal" data-target="#metaDataModal" 
						onclick="loadDocumentId('<?php print $file['id']; ?>')">
						<i class="glyphicon glyphicon-list-alt"></i> Metadatos
					</button>
				</div>
			</div>
		</div>
	<?php 
		}
	}
}
?>
