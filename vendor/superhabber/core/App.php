<?php

namespace mill\core;

use \R;
/**
 * Description of App
 * Main Class for Application
 * @author Yaroslav Palamarchuk
 */
class App {

    public static $app;
    
    public static $bin;

    public function __construct() {
        
        defined(DEBUG) or define(DEBUG, 0);
        
        defined(DEBUGBAR) or define(DEBUGBAR, 0);
        
        new ErrorHandler();
        
        session_start();
        
        self::$app = Registry::instance();
        
        self::$bin = new Props();
    }

}
