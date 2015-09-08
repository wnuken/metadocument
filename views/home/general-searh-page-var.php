<?php
$htmlData = '';
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){

			$htmlData .= "<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2 hidden-xs' style='height: 162px; margin-bottom: 5px;'>
				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 img-thumbnail' style='height: 162px;'>
					<div class='row'>
						<div class='col-xs-6 text-center' style='height: 123px;'>
							<div class='row' style='height: 123px;'>
								<img
								src='" . $file['image']. "' 
								data-mime='" . $file['mimeType']. "' 
								alt='" . $file['title']. "' 
								title='" . $file['title']. "'
								class='img-thumbnail'
								style='max-height: 123px; margin-left: 2px; max-width: 160px;'>
							</div>
							<div class='alert alert-info alert-dismissible info-download-gd' role='alert' 
							style='position: relative; width: 163px; top: -123px; height: 100px; z-index: 10; display:none;'>
								<button type='button' class='close' onclick='hideAlert(this);' aria-label='Close'>
									<span aria-hidden='true'>&times;</span>
								</button>";

								if(isset($file['exportLinks'])){
									foreach($file['exportLinks'] as $keyb => $exportlink){ 
										$htmlData .= '<div style="float: left;"><a href="' . $exportlink . '"><img width="32" src="./img/icon/' . $keyb . '"></a> </div>';
									} 
								}

			$htmlData .= "</div>
						</div>
						<div class='col-xs-6'>
							<div class='row' style='margin-bottom:3px; margin-right: -11px;'>
								<button type='button' 
								style='float: right;'
								class='btn btn-danger btn-xs buttonProperies' 
								data-toggle='modal' data-target='#metaDataModal' 
								onclick=\"loadDocumentId('" . $file['id']. "')\">
								<i class='glyphicon glyphicon-list-alt'></i> Metadatos
								</button>
							</div>
							<div class='row' style='margin-bottom:3px; margin-right: -11px;'>
								<button type='button' 
								style='float: right;'
								class='btn btn-default btn-xs buttonProperies' 
								data-toggle='modal' data-target='#modalDownload' 
								onclick='loadDownloadDocument(this)'
								data-element-id='" . $file['id']. "'>
								<i class='glyphicon glyphicon-list-alt'></i> Descargas
								</button>
							</div>
							<div class='row' style='margin-bottom:3px; margin-right: -11px;'>
								<button type='button' 
								style='float: right;'
								class='btn btn-info btn-xs buttonProperies' 
								data-toggle='modal' data-target='#modalInfo' 
								onclick='loadinfoDocument(this)'
								data-create-file='<p><strong>Creación: </strong>" . date('Y-m-d',strtotime($file['createdDate'])). "</p>'
								data-update-file='<p><strong>Actualización: </strong>" . date('Y-m-d',strtotime($file['modifiedDate'])). "</p>'
								data-description-file=\"" . $file['description']. "\"
								>
								<i class='glyphicon glyphicon-list-alt'></i> Detalles
								</button>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-xs-12' style='height: 35px;overflow: hidden;'>
							<a href='" . $file['url']. "' target='_blank' class='text-center'>
								<img src='./img/icon/" . $file['icon']. "' 
								style='width: 32px;'
								alt='" . $file['mimeType']. "' 
								title='" . $file['title']. "'>
								<span>" . substr($file['title'], 0, 20). "</span>
							</a>
						</div>
					</div>
			</div>
		</div>
		<div class='col-xs-12 visible-xs'>
			<div class='img-thumbnail' style='width: 100%; margin-bottom: 3px;'>
				<div class='' >
					<a href='" . $file['url']. "' target='_blank' class='text-center'>
						<img src='./img/icon/" . $file['icon']. "' 
						style='width: 40px;'
						alt='" . $file['mimeType']. "' 
						title='" . $file['title']. "'>
						<span>" . $file['title']. "</span>
					</a>
				</div>
				<div class='' >
					<button type='button' 
					style='float: right;'
					class='btn btn-danger btn-xs buttonProperies' 
					data-toggle='modal' data-target='#metaDataModal' 
					onclick='loadDocumentId('" . $file['id']. "')'>
					<i class='glyphicon glyphicon-list-alt'></i> Metadatos
				</button>
			</div>
		</div>
	</div>";
	}
}
}
?>
