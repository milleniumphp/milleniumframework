<?php
namespace mill\web;

use Asika\Minifier\MinifierFactory;

/**
 * Description of Scripts
 * Scripts editing class
 * @author Yaroslav Palamarchuk
 */
class Scripts {
    /**
     * search spaces and delete it for optimization
     * @var array
     */
    public static $searchMin = [
        '/(\n)+/',
        '/\r\n+/',
        '/\n(\t)+/',
        '/\n(\ )+/',
        '/\>(\n)+</',
        '/\r\n</'
    ];
    public static $replaceMin = [
        "\n",
        "\n",
        "\n",
        "\n",
        '><',
        '><'
    ];
    /**
     * array css and js scripts
     * @var array 
     */
    public static $scripts;
    /**
     * get scripts from config/scripts.php file
     */
    public function __construct() {
        self::$scripts = self::getScripts();
    }


    public static function getScripts() {
        $s = require ROOT . '/config/scripts.php';
        if(DEBUG && DEBUGBAR){
            /**
             * debug bar js file
             */
            $s['js'][] = '/assets/mill/system/js/debugbar/debugbar.js';
        }

        foreach ($s as $name => $script) {
            foreach ($script as $sc) {
                self::$scripts[$name][] = $sc;
            }
        }

        return self::$scripts;
    }

    /**
     * makes script tags
     */
    public static function scripts() {
        foreach (self::$scripts['js'] as $script) {
            echo "<script src='" . $script . "'> </script>";
        }
    }
    
    public static function addScript($ar = []){
        foreach ($ar as $t => $n){
            foreach($n as $k => $v){
                self::$scripts[$t][] = $v;
            }
        }
    }

    public static function styles() {
        foreach (self::$scripts['css'] as $script) {
            echo "<link href='/" . ltrim($script, '/') . "' rel='stylesheet'>";
        }
    }
}
