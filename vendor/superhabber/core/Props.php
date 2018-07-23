<?php
namespace mill\core;

class Props {
    
    /**
     * settings
     * @var array
    */
    protected static $properties = [];
    
    protected static $settings = [];
    
    public function __construct($config = '/config/config.php') {
        $config = require(ROOT . $config);
        foreach ($config as $k => $v){
            self::setSetting($k, $v);
        }  
    }

    public function setProperty($name, $value){
        self::$properties[$name] = $value;
    }
    
    public function getProperty($name){
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }
    
    public function getProperties(){
        return self::$properties;
    }
    
    public static function setSetting($name, $value){
        if(isset(self::$settings[$name])){
            self::$settings[$name] += $value;
            return true;
        }
        self::$settings[$name] = $value;
    }
    
    public static function getSetting($name){
        return self::$settings[$name];
    }
    
    public static function getSettings(){
        return self::$settings;
    }
    
}
