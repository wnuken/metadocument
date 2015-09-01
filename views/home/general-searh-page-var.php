<?php
$htmlData = '';
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){

			$htmlData .= "<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2' style='height: 300px; margin-bottom: 5px;'>
			<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 img-thumbnail' style='height: 300px;'>
				<div class='col-xs-6'>
					<div class='row'>
						<img   
						src='" . $file['image'] . "' 
						data-mime='" . $file['mimeType'] . "' 
						alt='" . $file['title'] . "' 
						title='" . $file['title'] . "'
						class='img-thumbnail'>
					</div>
					<div class='row' style='overflow: hidden;'>
						<a href='" . $file['url'] . "' target='_blank' class='text-center'>
							<img src='" . $file['icon'] . "' 
							alt='" . $file['mimeType'] . "' 
							title='" . $file['mimeType'] . "'>
							" . $file['title'] . "
						</a>
					</div>
				</div>
				<div class='col-xs-6'>";

					if(isset($file['exportLinks'])){
						$htmlData .= "<div class='row'>";
						foreach($file['exportLinks'] as $keyb => $exportlink){ 
							$htmlData .= "<div id='exportlink' class='col-xs-2'>
							<a href='" . $exportlink . "'><img width='32' src='./img/icon/" . $keyb . "'></a> </div>";
						} 
						$htmlData .= "</div>";
					}

					$htmlData .= "<div >
					<small>Emisión: " . date('Y-m-d h:i:s a',strtotime($file['createdDate'])) . "</small><br />
					<small>Actualización: " . date('Y-m-d h:i:s a',strtotime($file['modifiedDate'])) . "</small> <br />
					<small>descripción: " . $file['description'] . "</small>";
					"</div>";
					$htmlData .=  "<div >
						<button type='button' 
						class='btn btn-danger btn-xs buttonProperies' 
						data-toggle='modal' data-target='#metaDataModal' 
						onclick='loadDocumentId(" . $file['id'] .")'>
							<i class='glyphicon glyphicon-list-alt'></i> Metadatos
						</button>
					</div>
				</div></div>
			</div>
		</div>";
	}
}
}
?>
