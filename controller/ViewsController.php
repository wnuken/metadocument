
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
				$path = $userValues->getGFolder();
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
			foreach ($query as $key => $value) {
				$stringQuery .= " and fullText contains '" . $value . "'";
			}
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

	static public function metadataSave(){
		$General = new General();
		$resultFull = $General->setFileFullText($_POST);
		$result = json_encode($resultFull);
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