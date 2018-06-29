<?php
namespace mill\widgets\language;

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
        
    }
    
}
