
<?php
/*
* Author: SoftwareAgil
* Developer: Brian Sanabria
* App: Metadocument
*
*
* This Class only uses to REST call paths App
* Only allows statics public function
*/

class Views {



	static public function Home($RestParams = ''){

		/*getSession()->set('paths', array(
			'filePath' => './files/' . getSession()->get('user_path') .'-home-' . $RestParams . '.json',
			'foldersPath' => './files/' . getSession()->get('user_path') . '-folders-' . $RestParams . '.json',
			'foldersTotalPath' => './files/' . getSession()->get('user_path') . '-folders-total' . '.json'
			));*/

		$path = '';
		$filePath = './files/' . $_SESSION['user_path'] .'-home-' . $RestParams . '.json';
		$foldersPath = './files/' . $_SESSION['user_path'] . '-folders-' . $RestParams . '.json'; // <-- Revisar para que sea solo un archivo
		$foldersTotalPath = './files/' . $_SESSION['user_path'] . '-folders-total' . '.json';

		if (file_exists($filePath) && filemtime($filePath) > strtotime(CACHE_TIME_APP)) {
			$homeContent = file_get_contents($filePath, FILE_USE_INCLUDE_PATH);

			if(file_exists($foldersPath)){
				$homeFolder = file_get_contents($foldersPath, FILE_USE_INCLUDE_PATH);
				$folderList = json_decode($homeFolder, true);
			}

			if(file_exists($foldersTotalPath) && !isset($_SESSION['folders'])){
				$totalFolder = file_get_contents($foldersTotalPath, FILE_USE_INCLUDE_PATH);
				$_SESSION['folders'] = json_decode($totalFolder, true);
			}

			$filesList = json_decode($homeContent, true);
			if(is_array($filesList) && !isset($filesList['error'])){
				include './views/home/index.php';
			}else {
				unlink($filePath);
				unlink($foldersPath);
				unlink($foldersTotalPath);
				include './views/destroy.php';
			}
		}else if(isset($_SESSION['user_path']) && !empty($_SESSION['user_path'])){

			$Querys = new Querys();
			$paramsUser['user'] = $_SESSION['user_path'];

			$userValues = $Querys->AdminUserByUser($paramsUser);
			if(!is_array($userValues)){
				$path = $userValues->getFolderRoot();
				$paramsExtra['path'] = $path;

				if($RestParams != ''){
					$path = $RestParams;
				}

				$params['maxResults'] = MAX_FILES_PAGE;
				$params['pageToken'] = NULL;
				//$params['nextPageToken'] = '';
				if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])){
					$arrayAccessToken = json_decode($_SESSION['access_token'], true);
					//$params['access_token'] = $arrayAccessToken['access_token'];
					// $params['q'] = "mimeType!=" . rawurlencode("'application/vnd.google-apps.folder' and '$path' in parents");
					$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
					//$paramsFolder['q'] = "mimeType=". rawurlencode("'application/vnd.google-apps.folder' and '$path' in parents");
					$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
					$paramsExtra['linkToken'] = '';
				}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])){
					$arrayServiceToken = json_decode($_SESSION['service_token'], true);
					//$params['access_token'] = $arrayServiceToken['access_token'];
					$paramsExtra['linkToken'] = '&access_token=' . $arrayServiceToken['access_token'];
					// $params['q'] = "mimeType!=". rawurlencode("'application/vnd.google-apps.folder' and '$path' in parents");
					$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
					//$paramsFolder['q'] = "mimeType=". rawurlencode("'application/vnd.google-apps.folder' and '$path' in parents");
					$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
				}

				$General = new General();
				/*$params1['access_token'] = $arrayAccessToken['access_token'];
				$params1['q'] = "mimeType!=" . rawurlencode("'application/vnd.google-apps.folder' and '$path' in parents");
				
				$jsonList = $General->getFilesListJson($params1);
				$arrayList = json_decode($jsonList, true);
				print('<pre>'); print_r($$path); print('</pre>');*/

				// print('<pre>'); print_r($path); print('</pre>');
				// unset($_SESSION['folders']);
				
				if(!isset($_SESSION['folders']) && $path != 'root'){
					$_SESSION['folders'][] = $path;
					$folderTotal = $General->getFolderArray($paramsFolder);
				}else if($path == 'root' && !isset($_SESSION['folders'])){
					$_SESSION['folders'][] = $path;
				}
				
				$folderList = $General->getFilesArray($paramsFolder, $paramsExtra);
				
				$filesList = $General->getFilesArray($params, $paramsExtra);
				$filesList['parents'] = $path;

				$handle = fopen($filePath, 'w+');
				$content = json_encode($filesList);
				fwrite($handle, $content);
				fclose($handle);

				$handleF = fopen($foldersPath, 'w+'); // <-- Revisar para que sea solo un archivo
				$contentFolder = json_encode($folderList);
				fwrite($handleF, $contentFolder);
				fclose($handleF);

				$handleFT = fopen($foldersTotalPath, 'w+'); // <-- Revisar para que sea solo un archivo
				$contentFolderT = json_encode($_SESSION['folders']);
				fwrite($handleFT, $contentFolderT);
				fclose($handleFT);


				include './views/home/index.php';
			}else{
				include './views/register/index.php';
			}	
		}else{
			include './views/destroy.php';
		}
	}

	static public function searh(){
		$query = '';
		$stringQuery = '';		
		if(isset($_REQUEST['query']))
			$query = explode(' ', trim($_REQUEST['query']));

		if(is_array($query)){
			foreach ($query as $key => $value) {
				$stringQuery .= " and title contains '" . $value . "'";
			}
		}

		if(is_array($query)){
			$stringQuery .= ' or (';
			foreach ($query as $key => $value) {
				if($key == 0){
					$stringQuery .= " fullText contains '" . $value . "'";
				}else{
					$stringQuery .= " or fullText contains '" . $value . "'";
				}			
			}
			$stringQuery .= ')';
		}

		if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
			$paramsExtra['linkToken'] = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$paramsExtra['linkToken'] = '&access_token=' . $arrayServiceToken['access_token'];
		}

		if(isset($_REQUEST['path'])){
			$paramsExtra['path'] = $_REQUEST['path'];
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery;
		}

		$General = new General();
		$folderList = $General->getFilesArray($paramsFolder, $paramsExtra);
		$filesList = $General->getFilesArray($params, $paramsExtra);
		include './views/home/general-searh.php';
	}


	static public function searhPage(){
		$params['maxResults'] = MAX_FILES_PAGE;
		$params['pageToken'] = NULL;
		if(isset($_REQUEST['pageToken'])){
			$params['pageToken'] = $_REQUEST['pageToken'];
		}

		if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
			$paramsExtra['linkToken'] = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$paramsExtra['linkToken'] = '&access_token=' . $arrayServiceToken['access_token'];
		}

		if(isset($_REQUEST['parents'])){
			$path = $_REQUEST['parents'];
			$paramsExtra['path'] = $path;
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			$params['q'] = "mimeType!='application/vnd.google-apps.folder'";
		}

		$General = new General();
		$filesList = $General->getFilesArray($params, $paramsExtra);
		
		ob_start(); # open buffer
		include( './views/home/general-searh-page.php' );
		$htmlData = ob_get_contents();
		ob_end_clean(); # close buffer

		$resultArray['html'] = $htmlData;
		$resultArray['pageToken'] = $filesList['pageToken'];

		$resultJson = json_encode($resultArray);

		print $resultJson;

	}

	static public function advancedSearch(){

		$stringQuery = '';

		if(isset($_POST['content']) && !empty($_POST['content']))
			$queryContent = explode(' ', trim($_POST['content']));

		if(is_array($_POST['metaData'])){
			foreach ($_POST['metaData'] as $key => $value) {
				$queryContent[] = '"' . $value . '"';
			}
		}

		

		if(!empty($_POST['title'])){
				$stringQuery .= " and title contains '" . $_POST['title'] . "'";
		}

		if(is_array($queryContent) && (!empty($queryContent[0]))){
			if(empty($_POST['title'])){
				$stringQuery .= ' and (';
			}else{
				$stringQuery .= ' or (';
			}
			
			foreach ($queryContent as $key => $value) {
				if($key == 0){
					$stringQuery .= " fullText contains '" . $value . "'";
				}else{
					$stringQuery .= " or fullText contains '" . $value . "'";
				}
				
			}
			$stringQuery .= ')';
		}



		if(is_array($_POST['metaDataDate'])){
			$paramsExtra['filterDate'] = array();

			foreach ($_POST['metaDataDate'] as $key => $value) {

					$searhDate = explode('/', $value['date']);


					//$searchDateIni = $_POST[$key];
					//$searchDateend = $_POST[$key . '-fin'];

					if(!empty($searhDate[0])){
						if(!isset($searhDate[1]))
							$searhDate[1] = $searhDate[0];
						$DocumentDate = DocumentDateQuery::create()
						->filterByMetadataDate(array("min" => $searhDate[0]." 00:00:00", "max" => $searhDate[1]." 23:59:59"))
						->findByMetadataId($value['id']);

						foreach ($DocumentDate as $keyb => $valueb) {
							$idvar = $valueb->getDocumentId();
							$paramsExtra['filterDate'][$idvar] = $idvar;
						}
					}

			}

		}

		

		if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
			$paramsExtra['linkToken'] = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$paramsExtra['linkToken'] = '&access_token=' . $arrayServiceToken['access_token'];
		}


		if(empty($_POST['title']) && !isset($queryContent)){
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '".$_POST['parent']."' in parents";
		}else{
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery . " and '".$_POST['parent']."' in parents";
		}

		 $paramsExtra['path'] = $_POST['parents'];
		/*if(empty($_POST['title']) && empty($_POST['content'])){
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '".$_POST['parent']."' in parents";
		}else{
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery;
		}*/

		$General = new General();


		$filesList = $General->getFilesArray($params, $paramsExtra);

		ob_start(); # open buffer
		include( './views/home/general-searh-page.php' );
		$htmlData = ob_get_contents();
		ob_end_clean(); # close buffer

		$resultArray['html'] = $htmlData;
		$resultArray['pageToken'] = $filesList['pageToken'];
		$resultArray['filterDate'] = $paramsExtra;
		$resultJson = json_encode($resultArray);
		print $resultJson;
	}

	static public function registerUser(){
		$General = new General();
		$register = $General->registerUser($_POST);
		// include './views/register/finish.php';
	}



	static public function destroy(){
		include './views/destroy.php';
	}

	static public function createForm(){
		$params = $_POST;
		$folderMetadataContentArray = array();
		$Querys = new Querys();

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			unset($FolderMetadataForm);
			$FolderMetadataForm = new FolderMetadataForm();
			$FolderMetadataForm->setFolderId($params['id']);
		}else{
			$folderMetadataContent = $FolderMetadataForm->getFolderParams();
			$folderMetadataContentArray = json_decode($folderMetadataContent, true);
		}

		$idMeta = strtotime("now");
		$folderMetadataContentArray[$idMeta] = array(
			'name' => $params['name'],
			'type' => $params['type'],
			'id' => $idMeta
			);
		$content = json_encode($folderMetadataContentArray);

		$FolderMetadataForm->setFolderParams($content);
		$FolderMetadataForm->save();

		$message .= "<div class='form-group'>
					<div class='input-group'>
					<span class='input-group-btn'>
					<button class='btn btn-success' type='button' onclick='editMataDataField(this)'><i class='glyphicon glyphicon-edit'></i></button>
					</span>
					<input type='text' class='form-control' id='". $idMeta . "' name='". $idMeta ."' value='". $params['name'] . "' >
					<span class='input-group-btn'>
					<button class='btn btn-danger' type='button' onclick='removeMataDataField(this)'><i class='glyphicon glyphicon-trash'></i></button>
					</span></div>
					</div>";

					/*
	"<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' onclick='removeMataDataField(this)' data-dismiss='alert' aria-label='Close' data-position-id='".$idMeta."' >Elimiar</button>
				<span aria-hidden='true'>&times;</span></button><strong> Nombre: </strong>". $params['name'] . "<strong> Tipo:</strong>". $params['type'] . "</div>"
					*/
		
		$resultArray = array(
			"status" => true,
			"message" => $message,
				"post" => $params
				);

		$result = json_encode($resultArray);
		print_r($result);
	}

	static public function getMetadataFields(){
		$params = $_POST;
		$folderMetadataContentArray = array();
		// $folderMetadataJson = './files/folderMetadata.json';
		$totalMetada = '';

		$Querys = new Querys();

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			$totalMetada = "<div>Agrege nuevos campos </div>";

		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			foreach ($folderMetadataContentArray as $key => $metadada) {
				/*$totalMetada .= "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' onclick='removeMataDataField(this)' data-dismiss='alert' aria-label='Close' data-position-id='".$metadada['id'] ."'>Elimiar</button>
				<span aria-hidden='true'>&times;</span></button><strong> Nombre: </strong>". $metadada['name'] . "<strong> Tipo:</strong>". $metadada['type'] . "</div>";
*/

				$totalMetada .= "<div class='form-group'>
					<div class='input-group'>
					<span class='input-group-btn'>
					<button class='btn btn-success' type='button' onclick='editMataDataField(this)'><i class='glyphicon glyphicon-edit'></i></button>
					</span>
					<input type='text' class='form-control' id='". $metadada['id'] . "' name='". $metadada['id'] ."' value='". $metadada['name'] . "' >
					<span class='input-group-btn'>
					<button class='btn btn-danger' type='button' onclick='removeMataDataField(this)'><i class='glyphicon glyphicon-trash'></i></button>
					</span></div>
					</div>";

			}
		}

		$resultArray = array(
			"status" => true,
			"message" => $totalMetada
			);


		$result = json_encode($resultArray);
		print_r($result);
	}

	static public function removeMetadataField(){
		$params = $_POST;
		$metaData = "";
		$folderMetadataContentArray = array();
		$Querys = new Querys();

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			$metaData = "<div>No se encuentra el registro </div>";
		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			if(isset($folderMetadataContentArray[$params['metaid']])){
				$nameData = $folderMetadataContentArray[$params['metaid']]['name'];
				unset($folderMetadataContentArray[$params['metaid']]);
				
				$content = json_encode($folderMetadataContentArray);
				$FolderMetadataForm->setFolderParams($content);
				$FolderMetadataForm->save();
			}

			$metaData =  "<div class='alert alert-danger alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button><strong>Se elimino el MetaDato: </strong>". $nameData . "</div>";
		}


		$resultArray = array(
				"status" => true,
				"message" => $metaData
					);

		
			$result = json_encode($resultArray);
			print_r($result);
		
	}

	static public function editMetadataField(){
		$params = $_POST;
		$metaData = "";
		$folderMetadataContentArray = array();
		$Querys = new Querys();

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			$metaData = "<div>No se encuentra el registro </div>";
		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			if(isset($folderMetadataContentArray[$params['metaid']])){
				$nameData = $folderMetadataContentArray[$params['metaid']]['name'];
				$folderMetadataContentArray[$params['metaid']]['name'] = $params['name'];
				
				if($nameData != $params['name']){
					$content = json_encode($folderMetadataContentArray);
					$FolderMetadataForm->setFolderParams($content);
					$FolderMetadataForm->save();
				}
				
			}

			if($nameData != $params['name']){
				$metaData =  "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>El MetaDato <strong>" . $nameData . "</strong> ahora se llama: <strong>" . $params['name'] . "<strong></div>";
				}else{
					$metaData =  "<div class='alert alert-info alert-dismissible' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
					<span aria-hidden='true'>&times;</span></button>Es posible editar el MetaDato <strong>" . $params['name'] . "</strong>  escribiendo un nuevo valor</div>";
				}

			
		}


		$resultArray = array(
				"status" => true,
				"message" => $metaData
					);

		
			$result = json_encode($resultArray);
			print_r($result);
	}

	static public function getMetadataForm(){
		$params = $_POST;
		$Querys = new Querys();
		$folderMetadataContentArray = array();
		//$folderMetadataJson = './files/folderMetadata.json';
		$totalMetada = '';
		$isMetadata = true;

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			if($params['elementId']){
			$totalMetada = "<div class='alert alert-warning alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button><strong>No hay metadatos para esta carpeta </strong></div>";
			}else{
				$totalMetada = "<input type='hidden' class='form-control' id='parent' name='parent' value='". $params['id'] ."'>";
				/*$totalMetada .= "<div class='alert alert-info alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button><strong>No existen criterios de busqueda adicionales </strong></div>";*/
			}
			$isMetadata = false;
		}else if($params['elementId']){
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);
			$paramsDocument['id'] = $params['elementId'];
			$DocumentMetadata = $Querys->DocumentMetadatabyDocumentId($paramsDocument);
			if(is_array($DocumentMetadata) && $DocumentMetadata['status'] == false){

				foreach ($folderMetadataContentArray as $key => $metadada) {
					$datepicker = '';
					if($metadada['type'] == 'date'){
						$dateFormat = 'yyyy-mm-dd';
						$datepicker = " data-provide='datepicker' 
								data-date-format='yyyy-mm-dd' 
								data-date-language='es' ";
					}
					$totalMetada .= "<div class='form-group'>
					<label for='id'>". $metadada['name'] ."</label>
					<div class='input-group'>
					<input " . $datepicker . " type='text' class='form-control' id='". $metadada['id'] . "' name='". $metadada['id'] ."' value=''>
					<span class='input-group-btn'><button class='btn btn-warning' type='button' onclick='fieldMetadata(this)'><i class='glyphicon glyphicon-remove'></i></button></span></div>
					<input type='hidden' class='form-control' id='". $metadada['id'] . "-name' name='". $metadada['id'] ."-name' value='". $metadada['name'] ."'>
					</div>";
				}

			}else{
				$fileMetadataContent = $FolderMetadataForm->getFolderParams();
				$fileMetadataContentArray = json_decode($DocumentMetadata->getDocumentParams(), true);

				foreach ($folderMetadataContentArray as $key => $metadada) {
					$datepicker = '';
					if($metadada['type'] == 'date'){
						$dateFormat = 'yyyy-mm-dd';
						$datepicker = " data-provide='datepicker' 
								data-date-format='yyyy-mm-dd' 
								data-date-language='es' ";
					}
					$totalMetada .= "<div class='form-group'>
					<label for='id'>". $metadada['name'] ."</label>
					<div class='input-group'>
					<input " . $datepicker . " type='text' class='form-control' id='". $metadada['id'] . "' name='". $metadada['id'] ."' value='". $fileMetadataContentArray[$metadada['id']]['value'] . "'>
					<span class='input-group-btn'><button class='btn btn-warning' type='button' onclick='fieldMetadata(this)'><i class='glyphicon glyphicon-remove'></i></button></span></div>
					<input type='hidden' class='form-control' id='". $metadada['id'] . "-name' name='". $metadada['id'] ."-name' value='". $metadada['name'] ."'>
					</div>";
				}

				$totalMetada .= "<div class='page-header'>Otros Metadatos</div>";

				foreach ($fileMetadataContentArray as $key => $metadada) {
					if(!isset($folderMetadataContentArray[$metadada['id']])){
						$datepicker = '';
						if($metadada['type'] == 'date'){
							$dateFormat = 'yyyy-mm-dd';
							$datepicker = " data-provide='datepicker' 
									data-date-format='yyyy-mm-dd' 
									data-date-language='es' ";
						}
						$totalMetada .= "<div class='form-group'>
						<label for='id'>". $metadada['name'] ."</label>
						<div class='input-group'>
						<input " . $datepicker . " type='text' class='form-control' id='". $metadada['id'] . "' name='". $metadada['id'] ."' value='". $metadada['value'] . "'>
						<span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='fieldMetadata(this)'><i class='glyphicon glyphicon-trash'></i></button></span></div>
						<input type='hidden' class='form-control' id='". $metadada['id'] . "-name' name='". $metadada['id'] ."-name' value='". $metadada['name'] ."'>
						</div>";
					}
				}

			}
			$totalMetada .= "<input type='hidden' class='form-control' id='element' name='element' value='". $params['elementId'] ."'>";
		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			$totalMetada = '<form id="formVariables"><div class=""><div id="chagelogin" class="btn-group" data-toggle="buttons">';

			foreach ($folderMetadataContentArray as $key => $value) { 
             $totalMetada .= '<label onclick="loadinput(' . $value['id'] . ');" class="btn btn-danger btn-xs">
                  <input name="' . $value['id'] . '" id="' . $value['id'] . '" autocomplete="off" value="" class="product_change" type="radio">' . $value['name'] . '</label>';
            }

            $totalMetada .= '</div></div>';

			foreach ($folderMetadataContentArray as $key => $value) { 
                $datepiker = '';
                if($value['type'] == 'date'){
                  $datepiker = " data-provide='datepicker' 
                  data-date-format='yyyy-mm-dd' 
                  data-date-language='es' ";
                }

                $totalMetada .= '<div class="input-group" id="' . $value['id'] . '-group" style="display:none;">';
                  if(empty($datepiker)){ 
                $totalMetada .= '<input type="text" class="form-control" placeholder="' . $value['name'] . '" id="' . $value['id'] . '-value" name="' . $value['id'] . '-value">';
                  }else{ 
                   $totalMetada .= '<input type="date" ' . $datepiker . ' class="form-control date-meta-doble" placeholder="Igual o Desde" id="' . $value['id'] . '" name="' . $value['name'] . '">
                   		<input type="date" ' . $datepiker . ' class="form-control date-meta-doble" placeholder="Igual o Hasta" id="' . $value['id'] . '-end" name="' . $value['name'] . '-end">';
                  }
                  $totalMetada .=  '<span class="input-group-btn">
                    <button class="btn btn-success" type="button" onclick="getvalues(this);"><i class="glyphicon glyphicon-plus"></i></button>
                  </span>
                </div>';
            }

            $totalMetada .= '</form>';

			/*$selectMeta = "<div class='form-group'><div class='row'><div class='col-xs-4'><select class='form-control' name='filter' id='filter'>";
			$metaD = "<option value='all'>General</option>";*/

			/*foreach ($folderMetadataContentArray as $key => $metadata) {

					if($metadata['type'] == 'date'){
						
						$totalMetada0 .= "<div class='form-group'>
						<div class='row'>
							<div class='col-xs-6'>
								<input 
								type='text'  
								class='form-control' 
								id='".$metadata['id']."-ini' 
								name='".$metadata['id']."-ini' 
								placeholder='".$metadata['name']."'>
							</div>
							<div class='col-xs-6'>
								<input 
								type='text'  
								class='form-control' 
								id='".$metadata['id']."-end'
								name='".$metadata['id']."-end' 
								placeholder='".$metadata['name']."'>
							</div>
						</div>
					</div>";

				}/*else{
					$metaD .= "<option value='".$metadata['name']."'>".$metadata['name']."</option>";
				}*/
				/*}
				// $selectMeta .= $metaD . "</select></div><div class='col-xs-8'><input type='text' class='form-control' name='filter-value'></div></div></div>";
				$totalMetada .= $selectMeta . $totalMetada0;*/
				$totalMetada .= "<input type='hidden' class='form-control' id='parent' name='parent' value='". $params['id'] ."'>";


		}

		$resultArray = array(
			"status" => true,
			"message" => $totalMetada,
			"ismetadata" => $isMetadata
			);

		$result = json_encode($resultArray);
		print_r($result);
	}

	static public function saveMetada(){
		$params = $_POST;
		$format = 'Y-m-d';
		$fullText['text'] = '<ul>';
		$resultArray = array();
		$fileMetadataContentArray = array();
		//$fileMetadataJson = './files/fileMetadata.json';
		$paramsDocument['id'] = $params['element'];
		$Querys = new Querys();
		
		$DocumentMetadata = $Querys->DocumentMetadatabyDocumentId($paramsDocument);
		if(is_array($DocumentMetadata) && $DocumentMetadata['status'] == false){
			unset($DocumentMetadata);
			$DocumentMetadata = new DocumentMetadata();
			$DocumentMetadata->setDocumentId($params['element']);
		}else{
			// $fileMetadataContent = $FolderMetadataForm->getFolderParams();
			// $fileMetadataContentArray = json_decode($DocumentMetadata->getDocumentParams(), true);
		}


		/*if(file_exists($fileMetadataJson)){
			$fileMetadataContent = file_get_contents($fileMetadataJson, FILE_USE_INCLUDE_PATH);
			$fileMetadataContentArray = json_decode($fileMetadataContent, true);
		}*/

		foreach ($params as $key => $value) {
			if(is_numeric($key)){
				$fileMetadataContentArray[$key] = array(
					'name' => $params[$key . '-name'],
					'value' => $params[$key],
					'id' => $key
					);

				$dateCompare = DateTime::createFromFormat($format, $params[$key]);
				if($dateCompare && $dateCompare->format($format) == $params[$key]){
					$DocumentDate = new DocumentDate();
					$DocumentDate->setDocumentId($params['element']);
					$DocumentDate->setMetadataId($key);
					$DocumentDate->setMetadataDate($params[$key]);
					$resultArray['savemeta'][] = $DocumentDate->save();
				}else{
					 $resultArray['savemeta'][] = 'nada';
				}
			}
		}

		foreach ($fileMetadataContentArray as $key => $indexText) {
			$fullText['text'] .= "<li id='" . $indexText['id'] . "'><strong>" . $indexText['name'] . " </strong>" . $indexText['value'] . "</li>";
		}
		$fullText['text'] .= '</ul>';
		$fullText['fileId'] = $params['element'];

		/*$handle = fopen($fileMetadataJson, 'w+');
		$content = json_encode($fileMetadataContentArray);
		fwrite($handle, $content);
		fclose($handle);*/

		$content = json_encode($fileMetadataContentArray);
		$DocumentMetadata->setDocumentParams($content);
		$DocumentMetadata->save();

		$General = new General();
		$resultFull = $General->setFileFullText($fullText);
		
		if($resultFull['result'] === true){
			$resultArray['message'] = "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button><strong> El parametro fue indexado correctamente </strong></div>";
			$resultArray['status'] = true;
		}else{
			$resultArray = array(
			"status" => true,
			"message" => "<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button><strong> No hay conexión, intente nuevamente </strong></div>"
				);
		}
	
		$result = json_encode($resultArray);
		print_r($result);
		
	}


	static public function uploaddoc(){
		include './views/files/upload.php';
	}

	static public function ValidateGClient(){
		include './views/validate-g-client.php';
	}

	static public function ValidateGApp(){
		include './views/validate-g-app.php';
	}

	static public function Configuration(){
		include './views/configuration.php';
	}

	static public function ChagePhrase(){
		$Settings = new Settings();
		$result = $Settings->changePassword($_POST);

		print_r($result);

			//include './views/configuration.php';
	}

	static public function SetPropieties(){
		$General = new General();
		$result = $General->insertProperty($_POST);

		print_r($result);

	}

	static public function newFolder(){
		$General = new General();
		$resultFolder = $General->insertFolder($_POST);
		$result = json_encode($resultFolder);

		print_r($result);
	}

	static public function UploadFile(){
				/*$General = new General();
				$result = $General->insertFile($_POST);*/
				$result = json_encode($_FILES);

				print_r($result);

			}

			

		}	