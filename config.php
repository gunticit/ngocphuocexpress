<?php
// HTTP
define('HTTP', $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']));
// HTTP
define('HTTP_SERVER', 'http://'.HTTP.'');

// HTTPS
define('HTTPS_SERVER', 'http://'.HTTP.'');

// DIR
define('BASE_DIR', realpath(dirname(__FILE__)));
define('DIR_HOME', BASE_DIR.'/');
define('DIR_APPLICATION', BASE_DIR.'/catalog/');
define('DIR_SYSTEM', BASE_DIR.'/system/');
define('DIR_LANGUAGE', BASE_DIR.'/catalog/language/');
define('DIR_TEMPLATE', BASE_DIR.'/catalog/view/theme/');
define('DIR_CONFIG', BASE_DIR.'/system/config/');
define('DIR_IMAGE', BASE_DIR.'/image/');
define('DIR_CACHE', BASE_DIR.'/system/storage/cache/');
define('DIR_DOWNLOAD', BASE_DIR.'/system/storage/download/');
define('DIR_LOGS', BASE_DIR.'/system/storage/logs/');
define('DIR_MODIFICATION', BASE_DIR.'/system/storage/modification/');
define('DIR_UPLOAD', BASE_DIR.'/system/storage/upload/');

function VndDot($strNum)
  {
    $len = strlen($strNum);
    $counter = 3;
    $result = "";
    while ($len - $counter >= 0)
    {
      $con = substr($strNum, $len - $counter , 3);
      $result = '.'.$con.$result;
      $counter+= 3;
    }
    $con = substr($strNum, 0 , 3 - ($counter - $len) );
    $result = $con.$result;
    if(substr($result,0,1)=='.'){
      $result=substr($result,1,$len+1);   
    }
    return $result;
  }

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'db');
define('DB_USERNAME', 'ngocphuoce_hai');
define('DB_PASSWORD', 'QnsY9uaH');
define('DB_DATABASE', 'ngocphuoce_hai');
define('DB_PORT', '3306');
define('DB_PREFIX', 'hew_');
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);