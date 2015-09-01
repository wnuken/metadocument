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
include_once dirname(__FILE__) . '/config/src/Epi.php';

include_once dirname(__FILE__) . '/controller/SettingsController.php';
include_once dirname(__FILE__) . '/controller/QuerysController.php';
include_once dirname(__FILE__) . '/controller/ViewsController.php';
include_once dirname(__FILE__) . '/controller/GeneralController.php';

include_once dirname(__FILE__) . '/controller/src/Google/autoload.php';



Epi::setPath('base', dirname(__FILE__) . '/config/src');
Epi::setPath('config', dirname(__FILE__) . '/config');
Epi::init('route');
getRoute()->load('config.ini');

/*

include_once dirname(__FILE__) . '/controller/SettingsController.php';
include_once dirname(__FILE__) . '/controller/QuerysController.php';

include_once dirname(__FILE__) . '/controller/GeneralController.php';

//include_once dirname(__FILE__) . '/predis/autoload.php';

// Initialize Propel with the runtime configuration
Propel::init(dirname(__FILE__) . "/build/conf/atmadmin-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path(dirname(__FILE__) . "/build/classes" . PATH_SEPARATOR . get_include_path());

 Epi::setPath('base', dirname(__FILE__) . '/src');
 Epi::setPath('config', dirname(__FILE__) . '/config');
// Epi::init('route','cache-apc');
 Epi::init('route');
 getRoute()->load('config.ini');
 
*/
?>