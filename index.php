<?php

require_once './classes.php';

$urlpost = explode('/', $_SERVER['REQUEST_URI']);
$classjson = file_get_contents('./config/postclass.json', FILE_USE_INCLUDE_PATH);
$classarray = json_decode($classjson, true);

if((isset($urlpost[1]) && in_array($urlpost[1] , $classarray['class'])) && !isset($_SESSION['access_token'])){
    getRoute()->run();
}else{
    if (isset($_GET['code']) && !isset($_SESSION['access_token'])) {
        $Settings = new Settings();
        $GoogleClient = $Settings->GoogleClient();
        $GoogleClient->authenticate($_GET['code']);
        $_SESSION['access_token'] = $GoogleClient->getAccessToken();
        $tokenArray = json_decode(getSession()->get('access_token'), true);
        $_SESSION['userinfo'] = json_decode(file_get_contents(GOOGLE_URL_USER_INFO . $tokenArray['access_token']), true);
        $_SESSION['user_path'] = $_SESSION['userinfo']['id'];
        $redirect = 'http://' . $_SERVER['HTTP_HOST'];
        header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    }


    if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
        unset($_SESSION['service_token']);
        $Settings = new Settings();
        $GoogleClient = $Settings->GoogleClient();
        $GoogleClient->setAccessToken(getSession()->get('access_token'));

        if(isset($urlpost[1]) && (in_array($urlpost[1] , $classarray['class']))){
            getRoute()->run();
        }else{
            require_once('./views/general.php');
        }
    }else if (isset($_SESSION['service_token']) && !empty($_SESSION['service_token'])) {
        // $Settings = new Settings();
        // $GoogleClient = $Settings->GoogleApp();

        if(isset($urlpost[1]) && (in_array($urlpost[1] , $classarray['class']))){
            getRoute()->run();
        }else{
            require_once('./views/general.php');
        }
    }else{   
        require_once './views/login.php';
    }

}