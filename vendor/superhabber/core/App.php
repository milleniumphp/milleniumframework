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
        /**
         * error handler
         */
        new ErrorHandler();
        /**
         * standart consts on production
         */
        defined(DEBUG) or define(DEBUG, 0);
        
        defined(DEBUGBAR) or define(DEBUGBAR, 0);
        /**
         * start new session
         */
        session_start();
        /**
         * properties variable
         */
        self::$bin = new Props('/config/config.php');
        /**
         * app variable
         */
        self::$app = Registry::instance();   

    }
    
    /**
     * debug function for debug bar
     * @param bool $work work type
     */
    public static function debug($work = true){
        new Logger($work);
    }
    
    /**
     * generationg csrf code of application
     * @return string csrf code
     */
    public static function generateCsrfCode(){
        Props::setSetting('app', ['_csrf'=> bin2hex(openssl_random_pseudo_bytes(32)) ]);
        $_SESSION['_csrf'] = Props::getSetting('app')['_csrf'];   
        return (Props::getSetting('app')['_csrf']);
    }

}
