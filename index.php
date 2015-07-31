<?php
require_once './classes.php';

$urlpost = explode('/', $_SERVER['REQUEST_URI']);
$classjson = file_get_contents(dirname(__FILE__) . '/config/postclass.json');
$classarray = json_decode($classjson, true);

if((isset($urlpost[1]) && in_array($urlpost[1] , $classarray['class'])) && !isset($_SESSION['access_token'])){
    getRoute()->run();

}else{


    if (isset($_GET['code']) && !isset($_SESSION['access_token'])) {
        $Settings = new Settings();
        $GoogleClient = $Settings->GoogleClient();
        $GoogleClient->authenticate($_GET['code']);
        $_SESSION['access_token'] = $GoogleClient->getAccessToken();
        $redirect = 'http://' . $_SERVER['HTTP_HOST'];
        header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
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


    if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token'])) {
        unset($_SESSION['service_token']);
        $Settings = new Settings();
        $GoogleClient = $Settings->GoogleClient();
        $GoogleClient->setAccessToken($_SESSION['access_token']);

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
/*

if(isset($_SESSION["m_username"]) && !empty($_SESSION["m_username"])){
    $urlpost = explode('/', $_SERVER['REQUEST_URI']);
    $classjson = file_get_contents(dirname(__FILE__) . '/config/postclass.json');
    $classarray = json_decode($classjson, true);

    if(isset($urlpost[2]) && (in_array($urlpost[2] , $classarray['class']))){
        getRoute()->run();
    }else{
        require_once('./views/general.php');
    }

}else{    
    require_once './views/login.php';
}*/
