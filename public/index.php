<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../vendor/mill/libs/basic/functions.php';
require_once __DIR__.'/../vendor/mill/libs/basic/aliases.php';

use mill\core\Router;
new mill\core\App;

define('DEBUG', 1);

/**
 * page debugbar
 * 1 - start 
 */
define('DEBUGBAR', 0);

/**
 * gzip for page/
 * warning - it is so dangare.
 * always check is your site working
 * 1 - maximum optimization[deleting all spaces]
 */
define('GZIP', 1);

$query = rtrim($_SERVER['QUERY_STRING'], '/');

Router::add('^$', ['controller'=>'Pages', 'auth'=>true]);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::add('^', ['controller'=>'Error']);

Router::dispatch($query);
