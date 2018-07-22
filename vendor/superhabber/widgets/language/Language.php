<?php
namespace mill\widgets\language;

use mill\core\App;

/**
 * Description of Language
 *
 * @author Yaroslav Palamarchuk
 */
class Language {
    /**
     * name of the change language button template 
     * @var string name of the template
     */
    protected $tpl;
    /**
     * all languages sorted by base parameter
     * @var array languages
     */
    protected $languages;
    /**
     * real language from App::$bin->getProperty() function
     * @var array real language array
     */
    protected $language;
    
    public function __construct() {
        $this->tpl =  __DIR__ . '/lang_tpl.php';
        $this->run();
    }
    
    protected function run(){
        $this->languages = App::$bin->getProperty('langs');
        $this->language = App::$bin->getProperty('lang');
        echo $this->getHtml();
    }
    
    public static function getLanguages(){
        /**
         * get all languages from user's settings file
         */
        $locales = require ROOT . '/config/locales.php';
        /**
         * sort locales by base param 1 or 0
         */
        arsort($locales);
        
        return $locales;
    }
    
    public static function getLanguage($languages){
        /**
         * if language in cookie get it
         * else get from settings file
         */
        if(isset($_COOKIE['lang']) && array_key_exists($_COOKIE['lang'], $languages)){
            $key = $_COOKIE['lang'];
        }else{
            $key = key($languages);
        }
        $lang = $languages[$key];
        $lang['code'] = $key;
        return $lang;
    }
    
    protected function getHtml(){
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
    
}
