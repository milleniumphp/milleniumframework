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
    
    'locales' => [

        'en' => [
            'title' => 'English',
            'base' => 1
        ],

        'ru' => [
            'title' => 'Русский'
        ],
        
    ],
    
    'url'=>[
        'baseUrl' => '/',
        'rules' => [
            
            '^pages/about$' => [
                'controller' => 'Pages', 
                'action' => 'about', 
            ],
                    
            '^$' => [
                'controller'=>'Pages'
            ],
                    
            '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => []
                    
        ]
    ],

];

return $config;