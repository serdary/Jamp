<?php 

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');  

define('DOC_ROOT', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APP_PATH', realpath(DOC_ROOT . 'app') . DIRECTORY_SEPARATOR);
define('SYS_PATH', realpath(DOC_ROOT . 'system') . DIRECTORY_SEPARATOR);
define('MODULE_PATH', realpath(DOC_ROOT . 'modules') . DIRECTORY_SEPARATOR);

define('APP_MODE', 'DEVELOPMENT');
//define('APP_MODE', 'TEST');
//define('APP_MODE', 'PRODUCTION');
//define('APP_MODE', 'STAGING');

// Start app!
require APP_PATH . 'bootstrap.php';

Bootstrap::instance()->init();

if (APP_MODE !== 'TEST')
	Request::instance()->getResponse();
