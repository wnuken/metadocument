<?php
session_save_path('/tmp');

if(!isset($_SESSION["access_token"])){
    session_start();
}

include_once dirname(__FILE__) . '/controller/src/Google/autoload.php';


function & retrieveAllFiles(&$params, $service) {
    $result = array();
    $pageToken = NULL;
    do {
        try {
            $params = array();
            if (isset($params['pageToken'])) {
                $params['pageToken'] = $pageToken;
                $params['q'] = "'0B89z_nEGskBCfjB2ajZGRU90aE1JeGVTb2hfbnlDWEJGaXNvWEpuak9PWkxvUV84VmxUb0U' in parents";    
            }
            //$params['q'] = "'0B89z_nEGskBCfjB2ajZGRU90aE1JeGVTb2hfbnlDWEJGaXNvWEpuak9PWkxvUV84VmxUb0U' in parents";
            //$params['maxResults'] = 100;
            $files = $service->files->listFiles($params);

            $result = array_merge($result, $files->getItems());
            $pageToken = $files->getNextPageToken();
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
            $pageToken = NULL;
            unset($_SESSION["access_token"]);
        }
    } while ($pageToken);
    return $result;
}


$client_id = '15826266280-nm2d3nfer39k95ob7sk6t0olv8t8ea9e.apps.googleusercontent.com'; //Client ID
$service_account_name = '15826266280-nm2d3nfer39k95ob7sk6t0olv8t8ea9e@developer.gserviceaccount.com'; //Email Address


$key_file_location = './llave-app/Metadocument-pre-eed2b1f1f81f.p12'; //key.p12
$SCOPES = array(
    'https://www.googleapis.com/auth/drive'
);

$client = new Google_Client(array('use_objects' => true));
$client->setApplicationName("Metadocument");
// $client->setClientId($client_id);

if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
}
$key = file_get_contents($key_file_location);
//$keyarray = json_decode($key, true);

$cred = new Google_Auth_AssertionCredentials(
    $service_account_name,
    $SCOPES,
    $key,
    'notasecret'/*,
    'http://oauth.net/grant_type/jwt/1.0/bearer', // Default grant type
    $user_to_impersonate*/
);

// $cred->sub = $user_to_impersonate;


$client->setAssertionCredentials($cred);


// var_dump($client);die();




if ($client->getAuth()->isAccessTokenExpired()) {
    try {
        $client->getAuth()->refreshTokenWithAssertion($cred);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
}
$_SESSION['access_token'] = $client->getAccessToken();

$service = new Google_Service_Drive($client);
$params['q'] = "'0B89z_nEGskBCfjB2ajZGRU90aE1JeGVTb2hfbnlDWEJGaXNvWEpuak9PWkxvUV84VmxUb0U' in parents";


/*
$file = new Google_Service_Drive_DriveFile();
$file->setTitle('Documento de prueba con otro cliente 1');
$file->setDescription('Un documento de prueba');
$file->setMimeType('application/vnd.google-apps.document');

$data = file_get_contents('./documentpr.txt', FILE_USE_INCLUDE_PATH);


$createdFile = $service->files->insert($file, array(
    'data' => $data,
    'mimeType' => 'application/vnd.google-apps.document',
    'uploadType' => 'document'
));
*/
// print_r($createdFile);
/*

{
"access_token" : "ya29.1.AADtN_XK16As2ZHlScqOxGtntIlevNcasMSPwGiE3pe5ANZfrmJTcsI3ZtAjv4sDrPDRnQ",
"token_type" : "Bearer",
"expires_in" : 3600
}

*/




$listFiles = retrieveAllFiles($params,$service);

print '<pre>';print_r($listFiles);print '</pre>';


print '<pre>';print_r($_SESSION['access_token']);print '</pre>';

?>
<!DOCTYPE html>
<html lang="es">
    <?php require_once('./views/head.php'); ?>
    <body role="document">
        <div class="site-wrapper">
            <div class="site-wrapper-inner">
                <?php require_once('./views/menu.php'); ?>
                <div class="container" id="content" role="main">
                    <?php foreach($listFiles as $file){
    print $file->getTitle();
} ?>
                </div>
            </div>

        </div>
    </body>
    <?php require_once('./views/foot.php'); ?>
</html>