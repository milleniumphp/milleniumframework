<?php
namespace mill\core;

class Props {
    
    /**
     * settings
     * @var array
    */
    protected static $properties = [];
    
    protected static $settings = [];
    
    protected static $classes = [];


    public function __construct($config = '/config/config.php') {
        $config = require(ROOT . $config);
        foreach ($config as $k => $v){
            self::setSetting($k, $v);
            if($k == 'components'){
                foreach ($v as $key => $value){
                    self::setClass($key, $value);
                }
            }
        }  
    }
    
    public function __get($name) {
        return new self::$classes[$name];
    }


    public static function setClass($name, $value) {
        self::$classes[$name] = $value;
    }
    
    public static function getClass($name){
        if (isset(self::$classes[$name])) {
            return self::$classes[$name];
        }
        return null;
    }
    
    public static function getClasses(){
        return self::$classes;
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
