<?php

$config = [
    
    'app'=>[
        'name' => 'Application name',
        '_csrf' => \mill\core\App::generateCsrfCode(),
    ],
    
    'components' => [
        'cache' => '\mill\libs\Cache',
        'user'=> '\mill\core\base\User',
        'request'=> '\mill\core\base\Request',
        'session' => '\mill\core\base\Session',
        'error' => 'mill\core\ErrorHandler'
    ],
    
    'url'=>[
        'baseUrl' => '/',
        'rules' => [
            
            '^pages/about$' => [
                'controller' => 'Pages', 
                'action' => 'about', 
                'middleware' => mill\core\base\User::middleware(function($obj) {
                    return [
                        'preaction' => function($obj) {
                            
                        },
                        'type' => $obj::ALL_USER
                    ];
            })],
                    
            '^$' => [
                'controller'=>'Pages'
            ],
                    
            '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => []
                    
        ]
    ],

];

return $config;