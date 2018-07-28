<?php
namespace mill\core;

use mill\BaseMill;

/**
 * Description of App
 * Main Class for Application
 * @author Yaroslav Palamarchuk
 */
class App extends base\Application{

    public function __construct($loader) {
        /**
         * start new session
         */
        session_start();
        /**
         * properties variable
         */
        self::$bin = new Props('/config/config.php');
        
        parent::__construct($loader, self::$bin->error);

        /**
         * app variable
         */
        self::$app = Registry::instance();

    }
    
    public static function start(){
        /**
         * get url setting from config file
         * used Props class for config parsing
         */
        parent::addRoutes(self::$bin->getSetting('url')['rules']);

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
        $_SESSION['_csrf'] = bin2hex(openssl_random_pseudo_bytes(16));
        Props::setSetting('app', ['_csrf'=> $_SESSION['_csrf'] ]); 
        
        return (Props::getSetting('app')['_csrf']);
    }

}
