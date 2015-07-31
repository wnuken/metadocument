<?php
$Settings = new Settings();
//$sendValitate['user'] = 'admin';
//$sendValitate['pass'] = 'prueba';

if(isset($_REQUEST['username'])){
    $sendValitate['user']= trim($_REQUEST['username']);
    $_SESSION['user_path'] = $sendValitate['user'];
}
    

if(isset($_REQUEST['password']))
    $sendValitate['pass'] = trim($_REQUEST['password']);

$validation = $Settings->loginRolValidate($sendValitate);
if(isset($validation["validate"]) && $validation["validate"] === true){
    $GoogleClient = $Settings->GoogleApp();
}
$authUrl = '/';

print '{"url" : "' . $authUrl .'"}';