<?php

namespace mill\core;

class Props {
    /**
     * settings
     * @var array
    */
    protected static $properties = [];
    
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
}
