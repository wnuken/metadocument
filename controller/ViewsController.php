
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



	static public function Home(){

		// print('<pre>'); print_r($_SESSION); print('</pre>');

		$path = '';
		$filePath = './files/' . $_SESSION['user_path'] . '-home.json';
		$foldersPath = './files/' . $_SESSION['user_path'] . '-folders.json'; // <-- Revisar para que sea solo un archivo

		if (file_exists($filePath) && filemtime($filePath) > strtotime(CACHE_TIME_APP)) {
			$homeContent = file_get_contents($filePath, FILE_USE_INCLUDE_PATH);

			if(file_exists($foldersPath)){
				$homeFolder = file_get_contents($foldersPath, FILE_USE_INCLUDE_PATH);
				$folderList = json_decode($homeFolder, true);
			}

			$filesList = json_decode($homeContent, true);
			if(is_array($filesList) && !isset($filesList['error'])){
				include './views/home/index.php';
			}else {
				unlink($filePath);
				unlink($foldersPath);
				include './views/destroy.php';
			}
		}else if(isset($_SESSION['user_path']) && !empty($_SESSION['user_path'])){

			$Querys = new Querys();
			$paramsUser['user'] = $_SESSION['user_path'];
			$userValues = $Querys->AdminUserByUser($paramsUser);

			if(!is_array($userValues)){
				$path = $userValues->getGFolder();
				$_SESSION['arrayFolder']['0'] = $path;
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
				print('<pre>'); print_r($arrayList); print('</pre>');*/
				


				
				$folderList = $General->getFilesArray($paramsFolder, $linkToken);
				//$folderList = $General->getFilesArray($paramsFolder, $linkToken);
				$filesList = $General->getFilesArray($params, $linkToken);

				$handle = fopen($filePath, 'w+');
				$content = json_encode($filesList);
				fwrite($handle, $content);
				fclose($handle);

				$handleF = fopen($foldersPath, 'w+'); // <-- Revisar para que sea solo un archivo
				$contentFolder = json_encode($folderList);
				fwrite($handleF, $contentFolder);
				fclose($handleF);


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
		// var_dump($stringQuery);

		// $paramsUser['user'] = $_SESSION['user_path'];

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
			/*
			$Querys = new Querys();
			$userValues = $Querys->AdminUserByUser($paramsUser);
			$path = $userValues->getGFolder();
			$params['q'] = "'$path' in parents" . $stringQuery; 
			*/
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery;
			
		}

		$General = new General();
		$folderList = $General->getFilesArray($paramsFolder, $linkToken);
		$filesList = $General->getFilesArray($params, $linkToken);
		include './views/home/general-searh.php';
	}


	static public function searhPage(){

		$query = '';
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
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			$params['q'] = "mimeType!='application/vnd.google-apps.folder'";
			$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
		}

		$General = new General();
		// $folderList = $General->getFilesArray($paramsFolder, $linkToken);
		$filesList = $General->getFilesArray($params, $linkToken);

		if(isset($_REQUEST['nextPage'])){
			$filesList['nextPage'] =  $_REQUEST['nextPage'];
		}

		
		include './views/home/general-searh-page.php';



	}

	static public function registerUser(){
		$General = new General();
		$register = $General->registerUser($_POST);
		include './views/register/finish.php';
	}



			static public function destroy(){
				include './views/destroy.php';
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

			static public function UploadFile(){
				/*$General = new General();
				$result = $General->insertFile($_POST);*/
				$result = json_encode($_FILES);

				print_r($result);

			}

			

		}	