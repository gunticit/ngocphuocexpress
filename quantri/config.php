<?php
// HTTP
define('HTTP', $_SERVER['HTTP_HOST'].str_replace('/quantri', '',dirname($_SERVER['PHP_SELF'])));
// HTTP
define('HTTP_SERVER', 'http://'.HTTP.'/quantri/');
define('HTTP_CATALOG', 'http://'.HTTP.'/');
 
// HTTPS
define('HTTPS_SERVER', 'http://'.HTTP.'/quantri/');
define('HTTPS_CATALOG', 'http://'.HTTP.'/');

// DIR
define('BASE_DIR', str_replace(DIRECTORY_SEPARATOR.'quantri', '', realpath(dirname(__FILE__))));
define('DIR_HOME', BASE_DIR.'/');
define('DIR_APPLICATION', BASE_DIR.'/quantri/');
define('DIR_SYSTEM', BASE_DIR.'/system/');
define('DIR_LANGUAGE', BASE_DIR.'/quantri/language/');
define('DIR_TEMPLATE', BASE_DIR.'/quantri/view/template/');
define('DIR_CONFIG', BASE_DIR.'/system/config/');
define('DIR_IMAGE', BASE_DIR.'/image/');
define('DIR_CACHE', BASE_DIR.'/system/storage/cache/');
define('DIR_DOWNLOAD', BASE_DIR.'/system/storage/download/');
define('DIR_LOGS', BASE_DIR.'/system/storage/logs/');
define('DIR_MODIFICATION', BASE_DIR.'/system/storage/modification/');
define('DIR_UPLOAD', BASE_DIR.'/system/storage/upload/');
define('DIR_CATALOG', BASE_DIR.'/catalog/');



define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'db');
define('DB_USERNAME', 'ngocphuoce_hai');
define('DB_PASSWORD', 'QnsY9uaH');
define('DB_DATABASE', 'ngocphuoce_hai');
define('DB_PORT', '3306');
define('DB_PREFIX', 'hew_');
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);