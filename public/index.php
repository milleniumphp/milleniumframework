<?php
$loader = require __DIR__ . '/../vendor/autoload.php';

use mill\core\Router;
define('DEBUG', 1);

/**
 * page debugbar
 * 1 - start 
 */
define('DEBUGBAR', 1);

/**
 * gzip for page/
 * warning - it is so dangare.
 * always check is your site working
 * 1 - maximum optimization[deleting all spaces]
 */
define('GZIP', 0);

(new \mill\core\App($loader))->start();

Router::dispatch(mill\core\App::$uri);

if(DEBUGBAR){
    mill\core\App::debug();
}
