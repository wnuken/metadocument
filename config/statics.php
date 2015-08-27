<?php
/*
* Author: SoftwareAgil
* Developer: brisan
*
*/

$serverRedirect = 'http://' . $_SERVER['HTTP_HOST'];

/* ---- API CLIENT DATA ----*/

define('GOOGLE_CLIENT_ID', '322974934904-s2jkdhpko7np0cvp2ein9fmk8608q316.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRECT', 'tz0JNZWQfO9PhPVgOn_XMnw8');
define('GOOGLE_REDIRECT_URI', $serverRedirect);
// define('GOOGLE_CLIENT_MAIL', '322974934904@developer.gserviceaccount.com');



/* ---- API APP DATA ----*/

define('GOOGLE_CLIENT_ID_APP', '322974934904-m2g4rf3eucvft23p7jl2sbt3tvtekh1l.apps.googleusercontent.com');
define('GOOGLE_SERVICE_ACCOUNT_APP', '322974934904-m2g4rf3eucvft23p7jl2sbt3tvtekh1l@developer.gserviceaccount.com');
define('GOOGLE_LOCATION_KEY_APP', './llave-app/Metadocument-9481caa3d5da.p12');


/* ---- SERVER DATA ---- */
define('SERVER_KEY', 'LLAVE_DEL_SERVIDOR');

define('CACHE_TIME_APP', '-300 seconds');
define('MAX_FILES_PAGE', '50');

define('URL_GOOGLE_API', 'https://www.googleapis.com/drive/v2/files');

