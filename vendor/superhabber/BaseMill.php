<?php
namespace mill;

class BaseMill {
    
    public static $user;
    
    public static $request;
    
    public static $session;
    
    public static function init() {
        self::$user = \mill\core\Registry::instance()->user;
        self::$request = \mill\core\Registry::instance()->request;
        self::$session = \mill\core\Registry::instance()->session;
    }
    
}
