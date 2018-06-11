<?php
namespace mill\html;

/**
 * Description of Url
 * base url manager
 * @author Yaroslav Palamarchuk
 */
class Url {
    
    /**
     * base site url[ default '/']
     * @var string
     */
    public static $baseUrl = '/';
    
    public static function domain(){
        return $_SERVER['HTTP_HOST'];
    }

        /**
     * constructor but easly
     */
    public static function start() {
        $baseUrl = require ROOT . '/config/config.php';
        self::$baseUrl = $baseUrl['url']['baseUrl'];
    }
    
    /**
     * go to page
     * @param string $page
     */
    public static function to($page){
        self::start();
        echo self::$baseUrl . ltrim($page, '/');
    }
    
    /**
     * get base site url
     */
    public static function base(){
        self::start();
        echo self::$baseUrl;
    }
    
    /**
     * make redirect
     * @param string $http
     */
    public static function redirect($http = false) {
        if ($http) {
            $redirect = $http;
        } else {
            $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
        }
        header("Location:$redirect");
        exit;
    }

}
