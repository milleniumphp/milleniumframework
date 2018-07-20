<?php
namespace mill\core;

/**
 * Description of App
 * Main Class for Application
 * @author Yaroslav Palamarchuk
 */
class App {

    public static $app;
    
    public static $bin;

    public function __construct() {
        
        new ErrorHandler();
        
        defined(DEBUG) or define(DEBUG, 0);
        
        defined(DEBUGBAR) or define(DEBUGBAR, 0);
        
        session_start();
        
        self::$app = Registry::instance();
        
        self::$bin = new Props('/config/config.php');

    }
    
    public static function debug($work = true){
        new Logger($work);
    }

}
