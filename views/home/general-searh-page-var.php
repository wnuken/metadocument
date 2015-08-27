<?php 
$htmlData = '';
if(is_array($filesList)){
	foreach($filesList as $key => $file){
		if(is_numeric($key)){

			$htmlData .= "<div class='col-xs-6 col-sm-3 col-md-3 col-lg-2 multielemt' height='400'>
			<div class='toelement' >
				<div style='height:200px; overflow: hidden;' class='img-thumbnail text-center'>
					<img style='width:95%' 
					src='".$file['image']."' 
					data-mime='".$file['mimeType']."' 
					alt='".$file['title']."' 
					title='".$file['title']."'>
				</div>
				<h5 class='hidden-xs'>
					<a href='".$file['url']."' target='_blank' class='text-center'>
						<img src='".$file['icon']."' 
						alt='". $file['mimeType']."' 
						title='". $file['mimeType'].">'".
						$file['title'] .
						"</a>
					</h5>
				</div>
				<div class='fromelement' style='display:none;'>";

					if(isset($file['exportLinks'])){
						$htmlData .=  "<div class='row'>";
						foreach($file['exportLinks'] as $keyb => $exportlink){ 
							$htmlData .= "<div id='exportlink' class='col-xs-6 col-sm-3 col-md-2 col-lg-2'><a href='" . 
							$exportlink . "'><img width='32' src='./img/icon/" . $keyb . "'></a> </div>";
						} 
						$htmlData .= "</div>";
					}


					$htmlData .= "<div class='hidden-xs'>
					<small>Emisión: " . date('Y-m-d h:i:s a',strtotime($file['createdDate'])) . "</small><br />". 
					"<small>Actualización: " . date('Y-m-d h:i:s a',strtotime($file['modifiedDate'])) . "</small> <br />".
					"<small>descripción: " . $file['description'] . "</small>".
					"</div>
					<div class='hidden-xs'>
						<button type='button' class='btn btn-danger btn-xs buttonProperies' data-toggle='modal' data-target='#myModal' data-document-id=" .
						$file['id']. ">
						<i class='glyphicon glyphicon-list-alt'></i> Edición
					</button>
				</div>
			</div>
		</div>";
	}
}
}
?>
