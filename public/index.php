<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/superhabber/libs/basic/aliases.php';
require LIBS . '/basic/functions.php';

use mill\core\Router;
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

new mill\core\App;

$query = \mill\html\Url::query_string();

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::add('^$', ['controller'=>'Pages', 'auth'=>true]);

Router::dispatch($query);