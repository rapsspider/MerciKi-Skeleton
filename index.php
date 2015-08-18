<?php
/**
 * Framework
 * @author Jason BOURLARD<jason.bourlard@gmail.com>
 */


define('__ROOT_DIR__', __DIR__);

require_once  '/vendor/autoload.php'; // Autoload files using Composer autoload

require_once 'src\Config.php';
require_once 'src\Routes.php';

if(MerciKI\Config::$debug) {
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_ALL);
} else {
	error_reporting(0);
}

$application = new MerciKI\Application();
$application->execute();