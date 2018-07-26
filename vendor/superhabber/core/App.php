<?php
namespace mill\core;

/**
 * Description of App
 * Main Class for Application
 * @author Yaroslav Palamarchuk
 */
class App extends base\Application{

    public function __construct($loader) {
        
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
        Props::setSetting('app', ['_csrf'=> bin2hex(openssl_random_pseudo_bytes(16)) ]);
        $_SESSION['_csrf'] = Props::getSetting('app')['_csrf'];   
        
        return (Props::getSetting('app')['_csrf']);
    }

}
