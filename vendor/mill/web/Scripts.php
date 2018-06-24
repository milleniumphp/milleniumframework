<?php
namespace mill\web;

/**
 * Description of Scripts
 * Scripts editing class
 * @author Yaroslav Palamarchuk
 */
class Scripts {
    
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
    
    public static $scriptsCache = true;
    
    public static $scripts;

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

    public static function miniscripts($js) {
        if (\mill\core\App::$app->cache->get($js) && self::$scriptsCache === true) {
            if(!file_exists(ROOT . '/public/js/minified/' . $js )){
                file_put_contents(ROOT . '/public/js/minified/' . $js, \mill\core\App::$app->cache->get($js));
            }
        }else{
            $minified = '';
            foreach (self::$scripts['js'] as $script) {
                if (preg_match("/https:/", $script, $match)) {
                    $s = file_get_contents($script);
                } else {
                    $s = file_get_contents('http://' . \mill\html\Url::domain() . '/' . $script);
                    $s = preg_replace(array("/\s+\n/", "/\n\s+/", "/ +/"), array("\n", "\n ", " "), $s);
                }
                $minified .= $s;
            }
            $data = preg_replace(self::$searchMin, self::$replaceMin, $minified);
            
            $data = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data);
            $data = str_replace(': ', ':', $data);
            $data = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $data);
            
            \mill\core\App::$app->cache->set($js, $data);
            file_put_contents(ROOT . '/public/js/minified/' . $js, $data);
            
        }
        echo "<script src='/js/minified/$js'></script>";
    }

    public static function styles() {
        foreach (self::$scripts['css'] as $script) {
            echo "<link href='/" . ltrim($script, '/') . "' rel='stylesheet'>";
        }
    }
}
