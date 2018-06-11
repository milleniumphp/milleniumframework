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
    /**
     * make base authentication
     */
    public function auth(){
        exec('php mill migration migrate user 1');
    }
    
    public function backup(){
        $backup = new \mill\core\console\database\Backup($this->argv); 
    }
    
    public function examples(){
        $e = new \mill\core\local\examples\Examples($this->argv);
        $e->make();
    }
}
