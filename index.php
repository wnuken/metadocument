<?php
require_once './classes.php';

$urlpost = explode('/', $_SERVER['REQUEST_URI']);
$classjson = file_get_contents(dirname(__FILE__) . '/config/postclass.json');
$classarray = json_decode($classjson, true);

if(isset($urlpost[1]) && !isset($_SESSION['access_token']) && (in_array($urlpost[1] , $classarray['public']))){
	getRoute()->run();
}else if (isset($_GET['code']) && !isset($_SESSION['access_token'])) {
	$Settings = new Settings();
	$GoogleClient = $Settings->GoogleClient();
	$GoogleClient->authenticate($_GET['code']);
	$_SESSION['access_token'] = $GoogleClient->getAccessToken();
	$googleUser = $Settings->getGoogleUser($_SESSION['access_token']);
	$_SESSION['user_path'] = $googleUser['id'];
	// *** Hacer el redirect o guardar datos y carpeta para usuarios google primera vez; *** //
	$redirect = 'http://' . $_SERVER['HTTP_HOST'];
	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}else if ((isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) || isset($_SESSION['service_token']) && !empty($_SESSION['service_token']))  {
	if(isset($urlpost[1]) && (in_array($urlpost[1] , $classarray['private']))){
		getRoute()->run();
	}else{
		require_once('./views/general.php');
	}
}else{   
	require_once('./views/login.php');
}