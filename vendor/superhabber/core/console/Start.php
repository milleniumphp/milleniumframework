<?php
namespace mill\core\console;

/**
 * Description of Start Class
 * this class used to make base actions like authentication..
 * @author Yaroslav Palamarchuk
 */
class Start {
    public $argv;
    
    public function __construct($ar) {
        new \mill\core\base\Model();
        $this->argv = $ar;
    }

    public function backup(){
        $backup = new \mill\core\console\database\Backup($this->argv); 
    }

}
