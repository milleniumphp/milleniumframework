<?php
function dirname_r($path, $count=1){
    if ($count > 1){
       return dirname(dirname_r($path, --$count));
    }else{
       return dirname($path);
    }
}

define('WWW', dirname_r(__DIR__, 4).'/public');
define('CORE', dirname_r(__DIR__, 4).'/vendor/superhabber/millcore/core');
define('ROOT', dirname_r(__DIR__, 4));
define('APP', dirname_r(__DIR__, 4). '/app');
define('SECTIONS', dirname_r(__DIR__, 4). '/sections');
define('LIBS', dirname_r(__DIR__, 4). '/vendor/superhabber/libs');
define('CACHE', dirname_r(__DIR__, 4). '/tmp/cache');
define('LAYOUT', 'default');