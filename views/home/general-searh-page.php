<?php 
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){
			?>
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 hidden-xs" style="height: 220px; margin-bottom: 5px;">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 img-thumbnail" style="height: 220px;">
					<div class="row">

						<div class="col-xs-6 text-center">
							<div class="row" style="height: 100px;">
								<img
								src="<?php print $file['image']; ?>" 
								data-mime="<?php print $file['mimeType']; ?>" 
								alt="<?php print $file['title']; ?>" 
								title="<?php print $file['title']; ?>"
								class="img-thumbnail"
								style="max-height: 100px; margin-left: 2px; max-width: 128px;">
							</div>
							
						</div>
						<div class="col-xs-6 img-thumbnail" style="overflow: hidden; height: 100px; max-width: 135px;">
							<?php 
							if(empty($file['description'])){
								print "<small> <strong>Creación: </strong> " . date('Y-m-d',strtotime($file['createdDate'])) . "</br>
								<strong>Actualización: </strong>  " . date('Y-m-d',strtotime($file['modifiedDate'])) . "</small>";
							}else{
								print "<small class='small-list'>" . $file['description'] . "</small>";
							}
							
							?>
						</div>

					</div>

					<div class="row">
						<div class="col-xs-12" style="height: 35px;overflow: hidden;">
							<a href="<?php print $file['url']; ?>" target="_blank" class="text-center">
								<img src="./img/icon/<?php print $file['icon']; ?>" 
								style="width: 32px;"
								alt="<?php print $file['mimeType']; ?>" 
								title="<?php print $file['title']; ?>">
								<span><?php print substr($file['title'], 0, 20); ?></span>
							</a>
						</div>

						<div class="col-xs-12" style="position: relative; bottom: -10px; height: 32px;">
							<?php 
							if(isset($file['exportLinks'])){

								foreach($file['exportLinks'] as $keyb => $exportlink){ 
									print "<div id='exportlink' style='float: left;'><a href='" . $exportlink . "'><img width='32' src='./img/icon/" . $keyb . "'></a> </div>";
								} 

							}
							?>
						</div>

						<div class="col-xs-12" style="position: relative; bottom: -20px;">
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
						title="<?php print $file['title']; ?>">
						<span><?php print $file['title']; ?></span>
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
