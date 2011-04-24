<?php 

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');  

define('DOC_ROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(DOC_ROOT . 'app') . DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath(DOC_ROOT . 'system') . DIRECTORY_SEPARATOR);

require APP_PATH . 'bootstrap.php';

Bootstrap::instance()->init();

Request::instance()->getResponse();