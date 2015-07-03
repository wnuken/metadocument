<?php

if(isset($_SESSION['google_service'])){

    $file = new Google_Service_Drive_DriveFile();
    $file->setTitle('Documento de prueba 7');
    $file->setDescription('Un documento de prueba');
    $file->setMimeType('application/vnd.google-apps.document');

    $data = file_get_contents('./documentpr.txt', FILE_USE_INCLUDE_PATH);
    

    $createdFile = $_SESSION['google_service']->files->insert($file, array(
        'data' => $data,
        'mimeType' => 'application/vnd.google-apps.document',
        'uploadType' => 'document'
    ));

    print_r($createdFile);
}