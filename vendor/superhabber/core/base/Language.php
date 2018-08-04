<?php
namespace mill\core\base;

/**
 * Description of Language
 *
 * @author Yaroslav Palamarchuk
 */
class Language {
    /**
     * all tranlations
     * @var array
     */
    public static $lang_data = [];
    /**
     * translations for layout
     * @var array
     */
    public static $lang_layout = [];
    /**
     *
     * @var array
     */
    public static $lang_view = [];
    
    public static function load($code, $view){
        $lang_layout = APP . "/langs/{$code}.php";
        $lang_view = APP . "/langs/{$code}/{$view['controller']}/{$view['action']}.php";
        
        if(file_exists($lang_layout)) self::$lang_layout = require_once $lang_layout;

        if(file_exists($lang_view)) self::$lang_view = require_once $lang_view;
        
        self::$lang_data = array_merge(self::$lang_layout, self::$lang_view);
    }
    
    public static function get($key){
        return self::$lang_data[$key] ?? $key;
    }
  
}
