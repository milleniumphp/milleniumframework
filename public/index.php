<?php
require __DIR__.'/../vendor/mill/libs/basic/functions.php';
require_once __DIR__.'/../vendor/mill/libs/basic/aliases.php';

use mill\core\Router;

define('DEBUG', 1);
/**
 * gzip for page/
 * warning - it is so dangare.
 * always check is your site working
 * 1 - maximum optimization[deleting all spaces]
 */
define('GZIP', 1);

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require __DIR__ . '/../vendor/autoload.php';

new mill\core\App;

Router::add('^$', ['controller'=>'Pages', 'auth'=>true]);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::add('^', ['controller'=>'Error']);

Router::dispatch($query);
