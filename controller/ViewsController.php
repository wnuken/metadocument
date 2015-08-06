
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

		$path = '';
		$filePath = './files/' . $_SESSION['user_path'] . '-home.json';
		$foldersPath = './files/' . $_SESSION['user_path'] . '-folders.json';

		/* --- Cache Home --- */
		if (file_exists($filePath) && (filemtime($filePath) > strtotime(CACHE_TIME_APP))) {
			$homeContent = file_get_contents($filePath, FILE_USE_INCLUDE_PATH);
			if($homeContent == 'null'){
				unlink($filePath);
				unlink($foldersPath);
				include './views/destroy.php';
			}else{
			$filesList = json_decode($homeContent, true);
			$folderContent = file_get_contents($foldersPath, FILE_USE_INCLUDE_PATH);
			$folderList = json_decode($folderContent, true);
			include './views/home/index.php';
		}

		}else if(isset($_SESSION['user_path']) && !empty($_SESSION['user_path'])){
			$Querys = new Querys();
			$paramsUser['user'] = $_SESSION['user_path'];
			$userValues = $Querys->AdminUserByUser($paramsUser);
			if(!empty($userValues)){
				$path = $userValues->getGFolder();
				$_SESSION['arrayFolder'][] = $path;

				if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
					$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
					//$params['q'] = "'$path' in parents";
					$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
					$linkToken = '';
				}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
					$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
					//$params['q'] = "'$path' in parents";
					$paramsFolder['q'] = "mimeType='application/vnd.google-apps.folder' and '$path' in parents";
					$arrayServiceToken = json_decode($_SESSION['service_token'], true);
					$linkToken = '&access_token=' . $arrayServiceToken['access_token'];
				}

				$General = new General();

				//$folderList = $General->getFolderArray($paramsFolder);
				$folderList = $General->getFilesArray($paramsFolder, $linkToken);

				$filesList = $General->getFilesArray($params, $linkToken);

				if(isset($filesList['error'])){
					include './views/destroy.php';
					die();
				}

				// $filesList = array_merge($folderList, $filesList);


				$handle = fopen($filePath, 'w+');
				$content = json_encode($filesList);
				fwrite($handle, $content);
				fclose($handle);

				$handleF = fopen($foldersPath, 'w+');
				$contentFolder = json_encode($folderList);
				fwrite($handleF, $contentFolder);
				fclose($handleF);

			}
			include './views/home/index.php';
		}else{
			include './views/info-error.php';
		}
	}

	static public function searh(){
		$query = '';
		$stringQuery = '';
		if(isset($_REQUEST['query']))
			$query = explode(' ', trim($_REQUEST['query']));

		if(is_array($query)){
			foreach ($query as $key => $value) {
				$stringQuery .= $stringQuery . " and title contains '" . $value . "'";
			}
		}

		// $paramsUser['user'] = $_SESSION['user_path'];

		if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
			$linkToken = '';
		}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
			$arrayServiceToken = json_decode($_SESSION['service_token'], true);
			$linkToken = '&access_token=' . $arrayServiceToken['access_token'];
		}

		if(isset($_REQUEST['path'])){
			$path = $_REQUEST['path'];
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' and '$path' in parents";
		}else{
			/*
			$Querys = new Querys();
			$userValues = $Querys->AdminUserByUser($paramsUser);
			$path = $userValues->getGFolder();
			$params['q'] = "'$path' in parents" . $stringQuery; 
			*/
			$params['q'] = "mimeType!='application/vnd.google-apps.folder' " . $stringQuery;
		}

		$General = new General();
		$filesList = $General->getFilesArray($params, $linkToken);
		include './views/home/general-searh.php';
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