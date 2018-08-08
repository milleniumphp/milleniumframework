<?php
function dirname_r($path, $count=4){
    if ($count > 1){
       return dirname(dirname_r($path, --$count));
    }
    return dirname($path);
}

define('WWW', dirname_r(__DIR__).'/public');
define('CORE', dirname_r(__DIR__).'/vendor/superhabber/core');
define('ROOT', dirname_r(__DIR__));
define('APP', dirname_r(__DIR__). '/app');
define('SECTIONS', dirname_r(__DIR__). '/sections');
define('LIBS', dirname_r(__DIR__). '/vendor/superhabber/libs');
define('CACHE', dirname_r(__DIR__). '/tmp/cache');
define('LAYOUT', 'default');
