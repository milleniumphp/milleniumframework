<?php
namespace mill\core\language;

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
    
}
