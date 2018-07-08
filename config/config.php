<?php
$config = [
    'components' => [
        'cache' => '\mill\libs\Cache',
        'user'=> '\mill\core\base\User',
        'request'=> '\mill\core\base\Request',
        'session' => '\mill\core\base\Session'
    ],
    
    'url'=>[
        'baseUrl'=>'/'
    ],

];
return $config;