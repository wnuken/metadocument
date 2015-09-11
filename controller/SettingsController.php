<?php
	/*
		* author: Brian Sanabria
		* app: Metadocument
	*/

class Settings {
	public function & encryptTwofish(&$param){
		
		$param['text'] = '19790603/Ab';
		$param['key'] = SERVER_KEY;
		
		$td = mcrypt_module_open('twofish', '', 'ecb', '');
		
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$key = substr($param['key'], 0, mcrypt_enc_get_key_size($td));
		mcrypt_generic_init($td, $key, $iv); 
		
		$encrypted_data = mcrypt_generic($td, $param['text']);
		
		$desencrypted_data = mdecrypt_generic($td, $encrypted_data); 
		
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td); 
		
		return $encrypted_data;
		
	}
	
	public function & decryptTwofish(&$param){
		
		$param['encrypted_data'] = '%$&%FGF#$W#DFERWER$$GG%#$TGR%$$$';
		$param['key'] = SERVER_KEY;
		
		$td = mcrypt_module_open('twofish', '', 'ecb', '');
		
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$key = substr($param['key'], 0, mcrypt_enc_get_key_size($td));
		mcrypt_generic_init($td, $key, $iv); 
		
		$desencrypted_data = mdecrypt_generic($td, $param['encrypted_data']); 
		
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td); 
		
		
		return $desencrypted_data;
	}
	
	public function & loginRolValidate(&$params){
		$result['validate'] = false;
		
		$Querys = new Querys();
		$userValues = $Querys->AdminUserByUser($params);
		if(is_object($userValues)){
			$passBd = $userValues->getPassword();
			$salt = explode(':', $passBd);
			$pass = $params['pass'];
			$passGen = hash('sha256',$salt[1]. $pass);
			if($salt[0] == $passGen){
				$result['validate'] = true;
				$result['rol'] = $userValues->getRolId();
			}
		} 
		return $result;
	}
	
	public function & GoogleClient(){
		$scopes = array(
			'https://www.googleapis.com/auth/userinfo.profile',
			'https://www.googleapis.com/auth/userinfo.email',
			'https://www.googleapis.com/auth/drive'
			);
		$client = new Google_Client();
	//$client->setUseObjects(true);
		$client->setApplicationName("Metadocument");
	// $client->setDeveloperKey($CLIENT_SECRET);
		$client->setScopes($scopes);
		$client->setClientId(GOOGLE_CLIENT_ID);
		$client->setClientSecret(GOOGLE_CLIENT_SECRECT);
		$client->setRedirectUri(GOOGLE_REDIRECT_URI);
		return $client;
	}
	
	public function & GoogleApp(){
		$scopes = array(
			'https://www.googleapis.com/auth/drive'
			);
		$client = new Google_Client();
		$client->setApplicationName("Metadocument");
		$key = file_get_contents(GOOGLE_LOCATION_KEY_APP);
		
		$credentials = new Google_Auth_AssertionCredentials(
			GOOGLE_SERVICE_ACCOUNT_APP,
			$scopes,
			$key,
			'notasecret'
			);
		
		$client->setAssertionCredentials($credentials);
		
		if ($client->getAuth()->isAccessTokenExpired()) {
			try {
				$client->getAuth()->refreshTokenWithAssertion($credentials);
			} catch (Exception $e) {
				var_dump($e->getMessage());
			}
		}
		$_SESSION['service_token'] = $client->getAccessToken();
		
		return $client;
		
	}

	public function getGoogleUser($params){
		$token = json_decode($params,true);
		$result = json_decode(file_get_contents(GOOGLE_USER_INFO_URI . "?alt=json&access_token=" . $token['access_token']), true);
		return $result;
	}
	
	public function & changePassword(&$params){
		$result = array();
		$paramsUser['pass'] = $params['oldphrase'];
		$paramsUser['user'] = $_SESSION['user_path'];
		$validate = $this->loginRolValidate($paramsUser);
		
		$resultArray = array(
			'response'=> false,
			'validate' => $validate['validate']
			);
		
		if($validate['validate'] === true && $params['newphrse'] == $params['newphrse1']){
			$salt = md5(strtotime('now'));
			$passGen = hash('sha256',$salt. $params['newphrse']);
			$passFinal = $passGen . ":" . $salt;
			$Querys = new Querys();
			$userValues = $Querys->AdminUserByUser($paramsUser);
			$userValues->setPassword($passFinal);
			$userValues->save();
			$resultArray['response'] = true;
			$resultArray['newphrse'] = $params['newphrse'];
		}
		$result = json_encode($resultArray);
		return $result;
	}
	
}

			    /*$salt = md5('prueba');
$pass = 'prueba';

$passGen = hash('sha256',$salt. $pass);

print $passGen . ":" . $salt;*/

    // $Setting = new Settings();

    /*if(!empty($user)){
    $sendValitate['user'] = $user;
    $sendValitate['pass'] = trim($password);

     $validation = $Setting->loginRolValidate($sendValitate);
     $_SESSION["validate"] = $validation['validate'];
     $_SESSION["m_rol"] = $validation['rol'];

    if(isset($_SESSION["validate"]) && $_SESSION["validate"] === true){
         $_SESSION["m_username"] = $user;
    }
}*/