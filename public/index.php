<?php
$loader = require __DIR__ . '/../vendor/autoload.php';

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
define('GZIP', 0);

new \mill\core\App($loader);

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