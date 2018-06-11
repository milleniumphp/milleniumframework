<?php
namespace mill\core\base;

/**
 * Description of Session
 *
 * @author Yaroslav Palamarchuk
 */
class Session {
    
    public $data;
    
    public $alert = [];
    
    public function __construct() {
        $this->data = $_SESSION;
    }
    
    public function alert($k, $m){
        $this->alert[$k] = $m;
        
    }
    
    public function __destruct() {
        $this->alert = [];
    }
    
}
