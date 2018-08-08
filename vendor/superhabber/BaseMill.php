<?php
namespace mill;

class BaseMill {
    
    public static $user;
    
    public static $request;
    
    public static $session;
    
    public static function init() {
        self::$user = \mill\core\App::$app->user;
        self::$request = \mill\core\App::$app->request;
        self::$session = \mill\core\App::$app->session;
    }
    
}
