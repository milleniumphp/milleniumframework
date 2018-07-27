<?php
namespace mill\core\base;

/**
 * Description of Application
 *
 * @author Документи
 */
class Application {
    public static $app;
    
    public static $bin;
    
    public static $uri;
    
    public static $loader;
    
    public function __construct($loader, $errorhandler) {
        self::$uri = str_replace('?', '&', ltrim(rtrim($_SERVER['REQUEST_URI'], '/'), '/'));
        
        self::$loader = $loader;         
        /**
         * error handler
         */
        new $errorhandler();
        /**
         * standart consts on production
         */
        defined(DEBUG) or define(DEBUG, 0);
        
        defined(DEBUGBAR) or define(DEBUGBAR, 0);
    }
    
}
