<?php

session_save_path('/tmp');

if(!isset($_SESSION["access_token"])){
    session_start();
}

// print '<pre>'; print_r($_SESSION); print '</pre>';

(isset($_REQUEST["username"]))? $user = $_REQUEST["username"]: $user = "";
(isset($_REQUEST["password"]))? $password = $_REQUEST["password"]: $password = "";

// include_once dirname(__FILE__) . '/config/propelConect.php';
require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/generated-conf/config.php';

include_once dirname(__FILE__) . '/config/statics.php';
include_once dirname(__FILE__) . '/controller/src/epiphany/Epi.php';

include_once dirname(__FILE__) . '/controller/SettingsController.php';
include_once dirname(__FILE__) . '/controller/QuerysController.php';
include_once dirname(__FILE__) . '/controller/ViewsController.php';
include_once dirname(__FILE__) . '/controller/GeneralController.php';
include_once dirname(__FILE__) . '/controller/UsersController.php';

include_once dirname(__FILE__) . '/controller/src/Google/autoload.php';



Epi::setPath('base', dirname(__FILE__) . '/controller/src/epiphany');
Epi::setPath('config', dirname(__FILE__) . '/config');
Epi::init('route', 'session-php');

getRoute()->load('config.ini');

?>