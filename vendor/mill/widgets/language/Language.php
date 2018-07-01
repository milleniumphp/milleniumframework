<?php
namespace mill\widgets\language;
use mill\core\App;
/**
 * Description of Language
 *
 * @author Yaroslav Palamarchuk
 */
class Language {
    
    protected $tpl;
    protected $languages;
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
        return \R::getAssoc('SELECT code, title, base FROM languages ORDER BY base DESC');
    }
    
    public static function getLanguage($languages){
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
