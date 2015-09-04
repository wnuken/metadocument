
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
				// $_SESSION['arrayFolder']['0'] = $path;

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
					$linkToken = '';
				}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])){
					$arrayServiceToken = json_decode($_SESSION['service_token'], true);
					//$params['access_token'] = $arrayServiceToken['access_token'];
					$linkToken = '&access_token=' . $arrayServiceToken['access_token'];
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
				
				if(!isset($_SESSION['folders']) && $path != 'root'){
					$_SESSION['folders'][] = $path;
					$folderTotal = $General->getFolderArray($paramsFolder);
				}else if($path == 'root' && !isset($_SESSION['folders'])){
					$_SESSION['folders'][] = $path;
				}
				
				$folderList = $General->getFilesArray($paramsFolder, $linkToken);
				
				$filesList = $General->getFilesArray($params, $linkToken);
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
			$linkToken = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$linkToken = '&access_token=' . $arrayServiceToken['access_token'];
		}

		if(isset($_REQUEST['path'])){
			$path = $_REQUEST['path'];
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery;
		}

		$General = new General();
		$folderList = $General->getFilesArray($paramsFolder, $linkToken);
		$filesList = $General->getFilesArray($params, $linkToken);
		include './views/home/general-searh.php';
	}


	static public function searhPage(){
		$params['maxResults'] = MAX_FILES_PAGE;
		$params['pageToken'] = NULL;
		if(isset($_REQUEST['pageToken'])){
			$params['pageToken'] = $_REQUEST['pageToken'];
		}

		if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
			$linkToken = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$linkToken = '&access_token=' . $arrayServiceToken['access_token'];
		}

		if(isset($_REQUEST['parents'])){
			$path = $_REQUEST['parents'];
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			$params['q'] = "mimeType!='application/vnd.google-apps.folder'";
		}

		$General = new General();
		$filesList = $General->getFilesArray($params, $linkToken);
		
		include './views/home/general-searh-page-var.php';

		$resultArray['html'] = $htmlData;
		$resultArray['pageToken'] = $filesList['pageToken'];

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
			$FolderMetadataForm = $Querys->folderMetadata();
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
		
		$resultArray = array(
			"status" => true,
			"message" => "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' onclick='removeMataDataField(this)' data-dismiss='alert' aria-label='Close' data-position-id='".$idMeta."' >Elimiar</button>
				<span aria-hidden='true'>&times;</span></button><strong> Nombre: </strong>". $params['name'] . "<strong> Tipo:</strong>". $params['type'] . "</div>",
				"post" => $params
				);

		$result = json_encode($resultArray);
		print_r($result);
	}

	static public function getMetadataFields(){
		$params = $_POST;

		$folderMetadataContentArray = array();
		$folderMetadataJson = './files/folderMetadata.json';
		$totalMetada = '';

		$Querys = new Querys();

		$FolderMetadataForm = $Querys->FolderMetadataFormbyFolderId($params);
		if(is_array($FolderMetadataForm) && $FolderMetadataForm['status'] == false){
			$totalMetada = "<div>Agrege nuevos campos </div>";

		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			foreach ($folderMetadataContentArray as $key => $metadada) {
				$totalMetada .= "<div class='alert alert-success alert-dismissible' role='alert'>
				<button type='button' class='close' onclick='removeMataDataField(this)' data-dismiss='alert' aria-label='Close' data-position-id='".$metadada['id'] ."'>Elimiar</button>
				<span aria-hidden='true'>&times;</span></button><strong> Nombre: </strong>". $metadada['name'] . "<strong> Tipo:</strong>". $metadada['type'] . "</div>";
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
			$metaData = "<div>No se puede eliminar el registro </div>";

		}else{
			$folderMetadataContentArray = json_decode($FolderMetadataForm->getFolderParams(), true);

			if(isset($folderMetadataContentArray[$params['metaid']])){
				$nameData = $folderMetadataContentArray[$params['metaid']]['name'];
				unset($folderMetadataContentArray[$params['metaid']]);
				
				$content = json_encode($folderMetadataContentArray);
				$FolderMetadataForm->setFolderParams($content);
				$FolderMetadataForm->save();
			}

			$metaData =  "<div class='alert alert-warning alert-dismissible' role='alert'>
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

	static public function getMetadataForm(){
		$params = $_POST;

		$folderMetadataContentArray = array();
		$folderMetadataJson = './files/folderMetadata.json';
		$totalMetada = '';

		if(file_exists($folderMetadataJson)){
			$folderMetadataContent = file_get_contents($folderMetadataJson, FILE_USE_INCLUDE_PATH);
			$folderMetadataContentArray = json_decode($folderMetadataContent, true);

			if(isset($folderMetadataContentArray[$params['id']])){

				$fileMetadataContentArray = array();
				$fileMetadataJson = './files/fileMetadata.json';
				if(file_exists($fileMetadataJson)){
					$fileMetadataContent = file_get_contents($fileMetadataJson, FILE_USE_INCLUDE_PATH);
					$fileMetadataContentArray = json_decode($fileMetadataContent, true);
					$dataContent = $fileMetadataContentArray[$params['elementId']];
				}			
					
				foreach ($folderMetadataContentArray[$params['id']] as $key => $metadada) {
					$totalMetada .= "<div class='form-group'>
						<label for='id'>". $metadada['name'] ."</label>
						<input type='text' class='form-control' id='". $metadada['id'] . "' name='". $metadada['id'] ."' value='". $dataContent[$metadada['id']]['value'] . "'>
						<input type='hidden' class='form-control' id='". $metadada['id'] . "-name' name='". $metadada['id'] ."-name' value='". $metadada['name'] ."'>
					</div>";
				}
				$totalMetada .= "<input type='hidden' class='form-control' id='element' name='element' value='". $params['elementId'] ."'>";
			}
		}else{
		$totalMetada = "<div class='alert alert-warning alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span></button><strong>No hay metadatos para esta carpeta </strong></div>";
		}
		$resultArray = array(
			"status" => true,
			"message" => $totalMetada
			);

		$result = json_encode($resultArray);
		print_r($result);
	}

	static public function saveMetada(){
		$params = $_POST;
		$fullText['text'] = '<ul>';
		$fileMetadataContentArray = array();
		//$fileMetadataJson = './files/fileMetadata.json';


		if(file_exists($fileMetadataJson)){
			$fileMetadataContent = file_get_contents($fileMetadataJson, FILE_USE_INCLUDE_PATH);
			$fileMetadataContentArray = json_decode($fileMetadataContent, true);
		}

		foreach ($params as $key => $value) {
			if(is_numeric($key)){
				$fileMetadataContentArray[$params['element']][$key] = array(
					'name' => $params[$key . '-name'],
					'value' => $params[$key],
					'id' => $key
					);
			}
		}

		foreach ($fileMetadataContentArray[$params['element']] as $key => $indexText) {
			$fullText['text'] .= "<li id='" . $indexText['id'] . "'><strong>" . $indexText['name'] . " </strong>" . $indexText['value'] . "</li>";
		}
		$fullText['text'] .= '</ul>';
		$fullText['fileId'] = $params['element'];

		$handle = fopen($fileMetadataJson, 'w+');
		$content = json_encode($fileMetadataContentArray);
		fwrite($handle, $content);
		fclose($handle);


		$General = new General();
		$resultFull = $General->setFileFullText($fullText);
		
		if($resultFull['result'] === true){
			$resultArray = array(
			"status" => true,
			"message" => "<div class='alert alert-success alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span></button><strong> El parametro fue indexado correctamente </strong></div>"
				);
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