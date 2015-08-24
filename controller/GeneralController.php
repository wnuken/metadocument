<?php
/*
	* author: Software Agil
	* app: Metadocument
	* developer: Brian Sanabria
*/

	class General {

		public $service;
		//public $userinfo;
		//public $arraytoken;
		//var $client = "initial";

		public function General(){
			$Settings = new Settings();
			if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
				$GoogleClient = $Settings->GoogleClient();
				$GoogleClient->setAccessToken($_SESSION['access_token']);
				$this->service = new  Google_Service_Drive($GoogleClient);
				// $this->arrayToken = json_decode($_SESSION['access_token'], true);
			}else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
				$GoogleClient = $Settings->GoogleApp();
				$this->service = new  Google_Service_Drive($GoogleClient);
				// $this->arrayToken = json_decode($_SESSION['service_token'], true);
			}
		}

		public function & getOneFile(&$params) {
			try {
				$file = $this->service->files->get($params['fileId']);
				$result = $file;

			} catch (Exception $e) {
				$result = "An error occurred: " . $e->getMessage();
			}
			return $result;
		}


		public function getFilesListJson($params){
			$query = URL_GOOGLE_API . '?q=' . $params['q'] .
			'&access_token=' . $params['access_token'] .
			'&maxResults=' . $params['maxResults'] .
			'&pageToken=' . $params['nextPageToken'];
			$result = file_get_contents($query);
			return $result;
		}

		public function & getFilesList(&$params) {
			$result = array();
			$pageToken = NULL;
				try {
					if (!isset($params['pageToken'])) {
						$params['pageToken'] = $pageToken;
					}
					$files = $this->service->files->listFiles($params);

					$result['items'] = $files->getItems();
					$result['pageToken'] = $files->getNextPageToken();
				} catch (Exception $e) {
					$result = array(
						'error' => true,
						'message' => "An error occurred: " . $e->getMessage()
						);
					$pageToken = NULL;
				 	//unset($_SESSION["access_token"]);
				}
			return $result;
		}

		public function & retrieveAllFiles(&$params) {
			$result = array();
			$pageToken = NULL;
			do {
				try {
					if (isset($params['pageToken'])) {
						$params['pageToken'] = $pageToken;
					}
					$files = $this->service->files->listFiles($params);

					$result = array_merge($result, $files->getItems());
					$pageToken = $files->getNextPageToken();
				} catch (Exception $e) {
					$result = array(
						'error' => true,
						'message' => "An error occurred: " . $e->getMessage()
						);
					$pageToken = NULL;
					return $result;
				 	//unset($_SESSION["access_token"]);
				}
			} while ($pageToken);
			return $result;
		}

		function getFilesInFolder($folderId, $params) {
			$result = array();
			$pageToken = NULL;
			do {
				try {
					if (isset($params['pageToken'])) {
						$params['pageToken'] = $pageToken;
					}
					$params['maxResults'] = 100;
				// $params['projection'] = 'FULL';	
				// $files = $this->service->files->listFiles($params);
					$files = $this->service->children->listChildren($folderId, $params);

					$result = array_merge($result, $files->getItems());
					$pageToken = $files->getNextPageToken();
				} catch (Exception $e) {
					print "An error occurred: " . $e->getMessage();
					$pageToken = NULL;
				// unset($_SESSION["access_token"]);
				}
			} while ($pageToken);

			$jsonFileList = json_encode($result);

			return $result;
		}

		/*function & insertFile(&$params) {

		// $service, $title, $description, $parentId, $mimeType, ($filename o $filePath)
			$file = new Google_Service_Drive_DriveFile();
			$file->setTitle($params['title']);
			$file->setDescription($params['description']);
			$file->setMimeType($params['mimeType']);

		// Set the parent folder.
			if (isset($params['parentId']) && !empty($params['parentId'])) {
				$parent = new Google_Service_Drive_ParentReference();
				$parent->setId($params['parentId']);
				$file->setParents(array($parent));
			}

			try {
				$data = file_get_contents($params['filePath']);
				$dataFile = array(
					'data' => $data,
					'mimeType' => $params['mimeType']
					);

				$result = $this->service->files->insert($file, $dataFile);
			// Uncomment the following line to print the File ID
			// print 'File ID: %s' % $createdFile->getId();
			} catch (Exception $e) {
				$result = "An error occurred: " . $e->getMessage();
			}
			return $result;
		}*/

		public function insertFolder($params){
			
			$folder = new Google_Service_Drive_DriveFile();
			$folder->setTitle($params['title']);
			$folder->setMimeType('application/vnd.google-apps.folder');

			if (!isset($params['parentId']) || empty($params['parentId']))
				$params['parentId'] = 'root';

			$parent = new Google_Service_Drive_ParentReference();
			$parent->setId($params['parentId']);
			$folder->setParents(array($parent));

			try {
				$result = $this->service->files->insert($folder, array(
					'mimeType' => 'application/vnd.google-apps.folder'
					));
				// $result->id;
				
			} catch (Exception $e) {
				$result = array(
					'error' => true,
					'message' => "An error occurred: " . $e->getMessage()
					);
			}

			return $result;
		}

		public function insertFile($title, $description, $parentId, $mimeType, $filename) {
			$file = new Google_Service_Drive_DriveFile();
			$file->setTitle($title);
			$file->setDescription($description);
			$file->setMimeType($mimeType);

  // Set the parent folder.
			if ($parentId != null) {
				$parent = new Google_Service_Drive_ParentReference();
				$parent->setId($parentId);
				$file->setParents(array($parent));
			}

			try {
				$data = file_get_contents($filename);

				$createdFile = $this->service->files->insert($file, array(
					'data' => $data,
					'mimeType' => $mimeType,
					));

    // Uncomment the following line to print the File ID
    // print 'File ID: %s' % $createdFile->getId();

				return $createdFile;
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}


		function & renameFile(&$params) {
		// $service, $fileId, $newTitle
			try {
				$file = new Google_Service_Drive_DriveFile();
				$file->setTitle($params['newTitle']);

				$result = $this->service->files->patch($params['fileId'], $file, array(
					'fields' => 'title'
					));
			} catch (Exception $e) {
				$result = "An error occurred: " . $e->getMessage();
			}
			return $result;
		}

		function trashFile($service, $fileId) {
			try {
				return $service->files->trash($fileId);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
			return NULL;
		}

		function restoreFile($service, $fileId) {
			try {
				return $service->files->untrash($fileId);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
			return NULL;
		}

		function deleteFile($params) {
			try {
				$this->service->files->delete($params['fileId']);
				$result = true;
			} catch (Exception $e) {
				$result = "An error occurred: " . $e->getMessage();
			}
			return $result;
		}

		/* --- Comentarios --- */

		function insertComment($service, $fileId, $content) {
			$newComment = new Google_Service_Drive_Comment();
			$newComment->setContent($content);
			try {
				return $service->comments->insert($fileId, $newComment);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
			return NULL;
		}


		function printComment($service, $fileId, $commentId) {
			try {
				$comment = $service->comments->get($fileId, $commentId);

				print "Modified Date: " . $comment->getModifiedDate();
				print "Author: " . $comment->getAuthor()->getDisplayName();
				print "Content: " . $comment->getContent();
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}

		function retrieveComments($service, $fileId) {
			try {
				$comments = $service->comments->listComments($fileId);
				return $comments->getItems();
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
			return NULL;
		}

		function updateComment($service, $fileId, $commentId, $newContent) {
			try {
// First retrieve the comment from the API.
				$comment = $service->comments->get($fileId, $commentId);
				$comment->setContent(newContent);
				return $service->comments->update($fileId, $commentId, $comment);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
			return NULL;
		}

		function removeComment($service, $fileId, $commentId) {
			try {
				$service->comments->delete($fileId, $commentId);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}

		/* --- Propiedades --- */


		function removeProperty($service, $fileId, $key, $visibility) {
			try {
				$optParams = array('visibility' => $visibility);
				$service->properties->delete($fileId, $key, $optParams);
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}

		function printProperty($service, $fileId, $key, $visibility) {
			try {
				$optParams = array('visibility' => $visibility);
				$property = $service->properties->get($fileId, $key, $optParams);

				print "Key: " . $property->getKey();
				print "Value: " . $property->getValue();
				print "Visibility: " . $property->getVisibility();
			} catch (Exception $e) {
				print "An error occurred: " . $e->getMessage();
			}
		}

		public function & insertProperty(&$params) {

			if(!isset($params['visibility']))
			$params['visibility'] = 'PUBLIC'; // PRIVATE

		$newProperty = new Google_Service_Drive_Property();
		$newProperty->setKey($params['key']);
		$newProperty->setValue($params['value']);
		$newProperty->setVisibility($params['visibility']);
		try {
			$result['message'] = $this->service->properties->insert($params['fileId'], $newProperty);
			$result['result'] = 'true';
		} catch (Exception $e) {
			$result['result'] = 'false';
			$result['message'] = "An error occurred: " . $e->getMessage();
		}
		$result = json_encode($result);
		return $result;
	}

	function retrieveProperties($service, $fileId) {
		try {
			$properties = $service->properties->listProperties($fileId);
			return $properties->getItems();
		} catch (Exception $e) {
			print "An error occurred: " . $e->getMessage();
		}
		return NULL;
	}


	function patchProperty($service, $fileId, $key, $newValue, $visibility) {
		$patchedProperty = new Google_Service_Drive_Property();
		$patchedProperty->setValue($newValue);
		try {
			$optParams = array('visibility' => $visibility);
			return $service->properties->patch($fileId, $key, $patchedProperty, $optParams);
		} catch (Exception $e) {
			print "An error occurred: " . $e->getMessage();
		}
		return NULL;
	}

	function updateProperty($service, $fileId, $key, $newValue, $visibility) {
		try {
// First retrieve the property from the API.
			$optParams = array('visibility' => $visibility);
			$property = $service->properties->get($fileId, $key, $optParams);
			$property->setValue($newValue);
			return $service->properties->update($fileId, $key, $property, $optParams);
		} catch (Exception $e) {
			print "An error occurred: " . $e->getMessage();
		}
		return NULL;
	}


	/*public function & retrieveAllFolders($params) {
		$result = array();
		$pageToken = NULL;
		do 
		{
        try 
        {
		if (isset($params['pageToken'])) {
		$params['pageToken'] = $pageToken;
		}
		$params['maxResults'] = 100;
		$params['projection'] = 'FULL';			  
		
		$files = $this->service->files->listFiles($params);
		$result = array_merge($result, $files->getItems());
		$pageToken = $files->getNextPageToken();
		} catch (Exception $e) 
		{
		print "An error occurred: " . $e->getMessage();
		$pageToken = NULL;
		}
		} while ($pageToken);
		return $result;
	}*/
	
	public function getFilesArray($params, $linkToken){

		$getFilesList = $this->getFilesList($params);

		if(isset($getFilesList['error'])){
			return $getFilesList;
		}

		foreach ($getFilesList['items'] as $key => $file) {
			if($key == 0)
				$filesList['parents'] = $file->parents[0]->id;

			//if(in_array($file['modelData']['parents'][0]['id'], $_SESSION['arrayFolder'])){


				if($file->mimeType == 'application/vnd.google-apps.document'){
					$image = $file->thumbnailLink . $linkToken;
				}else{
					$image = $file->thumbnailLink;
				}

				$filesList[$key] = array(
					'id' => $file->getId(),
					'icon' => $file->iconLink,
					'title' => $file->getTitle(),
					'url' => $file->alternateLink,
					'image' => $image,
					'mimeType' => $file->mimeType,
					'createdDate' => $file->createdDate,
					'modifiedDate' => $file->modifiedDate,
					'description' => $file->getDescription()
					);

				if(isset($files->properties)){
					$filesList[$key]['properties']['key'] = $files->properties['key'];
					$filesList[$key]['properties']['value'] = $files->properties['value'];
				}

				if(isset($file->exportLinks)){
					foreach($file->exportLinks as $keyb => $exportlink){
						$iconlink = $this->setNameIcon($keyb);
						$filesList[$key]['exportLinks'][$iconlink] = $exportlink . $linkToken;
					}
				}else if(isset($file->downloadUrl)){
					$iconlink = $this->setNameIcon($file->mimeType);
					$filesList[$key]['exportLinks'][$iconlink] = $file->downloadUrl . $linkToken;
				}

			//}
		}
		$filesList['pageToken'] = $getFilesList['pageToken'];
		

		return $filesList;
	}

	public function getFolderArray($params){
		$result = array();
		$getAllFolder = $this->retrieveAllFiles($params);
		/*$result[] = array(
				'id' => $params,
				'title' => 'Principal'
				);*/
		
		if(!is_array($getAllFolder)){
			foreach ($getAllFolder as $key => $folder) {
			$result[] = array(
				'id' => $folder->getId(),
				'title' => $folder->getTitle()
				);
		}
		}
		

		return $result;

		/*if($getAllFolder){
			foreach ($getAllFolder as $key => $value) {
				$result['id'] = '';
				$this->getFolderArray($value);
			}
		}*/

	}

	public function registerUser($params){
		
		$paramsFolder['title'] = $params['folder'];
		$newFolder = $this->insertFolder($paramsFolder);

		$AdminUser = new AdminUser();
		$AdminUser->setUser($params['id']);
		$AdminUser->setPassword($params['email']);
		$AdminUser->setGFolder($newFolder->id);

		$result = $AdminUser->save();

		return $result;
	}

	private function & setNameIcon(&$params){

		$searh = array(
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
			'application/vnd.oasis.opendocument.text',
			'application/rtf',
			'text/html',
			'text/plain',
			'application/pdf',
			'text/csv',
			'image/png',
			'image/jpeg',
			'image/bmp',
			'image/tiff'
			);

		$replace = array(
			'application-msword.png',
			'application-vnd.ms-excel.png',
			'application-vnd.oasis.opendocument.text.png',
			'rtf.png',
			'text-html.png',
			'text.png',
			'application-pdf.png',
			'application-vnd.ms-excel.png',
			'application-image.png',
			'application-image.png',
			'application-image.png',
			'application-image.png'
			);

		$result = str_replace($searh, $replace, $params);
		return $result;
	}
	
	
}		