<?php
require __DIR__.'/../vendor/mill/libs/basic/functions.php';
require_once __DIR__.'/../vendor/mill/libs/basic/aliases.php';

use mill\core\Router;

define('DEBUG', 1);
define('GZIP', 1);

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require __DIR__ . '/../vendor/autoload.php';

new mill\core\App;

Router::add('^$', ['controller'=>'Pages']);

Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix'=>'admin']);


Router::add('^pages/?(?P<action>[a-z-]+)$', ['controller'=>'Pages']);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::add('^', ['controller'=>'Error']);

Router::dispatch($query);
