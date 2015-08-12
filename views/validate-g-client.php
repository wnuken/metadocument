<?php
$user = '';
if(isset($_REQUEST['username'])){
    $user = trim($_REQUEST['username']);
    // $_SESSION['user_path'] = $user;
}

$Settings = new Settings();
$GoogleClient = $Settings->GoogleClient();
$authUrl = $GoogleClient->createAuthUrl();
print '{"url" : "' . $authUrl . '"}';
