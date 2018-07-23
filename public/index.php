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
define('DEBUGBAR', 1);

/**
 * gzip for page/
 * warning - it is so dangare.
 * always check is your site working
 * 1 - maximum optimization[deleting all spaces]
 */
define('GZIP', 0);

new mill\core\App;

\mill\core\App::$uri = str_replace('?', '&', ltrim(rtrim($_SERVER['REQUEST_URI'], '/'), '/'));

Router::add('^pages/about$', ['controller'=>'Pages', 'action' => 'about', 'middleware'=> mill\core\base\User::middleware(function($obj){
    return [
        'preaction' => function($obj){
            
        },
        'type' => $obj::ALL_USER
    ];
    
})]);

Router::add('^$', ['controller'=>'Pages']);

Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


Router::dispatch(mill\core\App::$uri);

if(DEBUGBAR){
    mill\core\App::debug();
}